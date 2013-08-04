<SCRIPT type="text/javascript">
//<!--

// Plugs innerHTML for the email icon on the row of interest in the list of works on curationAccRejEmail.php. E.g.,
//   DOMid = emailSentMarkup-56
//   markup = <a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(56)"><img 
//            src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>
function markListItemSentOnClick(DOMid, markup) {
  $setBreakpointHere = 0;
  $container = window.opener.document.getElementById(DOMid);
  $container.innerHTML = markup;
//  alert('markListItemSentOnClick\r\n  DOMid = ' + DOMid + '\r\n  markup = ' + markup); 
  return true;
}

// coordinate changes with the php function emailSentIconMarkup($workId)
function emailSentIconMarkupJS(workId) {
  text = '<a href="#" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' + workId + ');"><img '
       + 'src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"><\/a>';
  return text;
}

// coordinate changes with the php function SSFCommunique::mrEmailSentWidgetMarkup()
function mrEmailSentWidgetMarkupJS(commId, recipientId) {
  text = '<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(' + commId + ',' + recipientId + ');"><img ' +
         'src="../../images/emailSentIcon059.gif" alt="View email sent." title="View email sent." ' +
         'width="18" height="15" align="top" border="0" hspace="0" vspace="0"></a>';
  return text;
}

//-->
</SCRIPT>

<?php

// --- class SSFCommunique -----------------------------------------------------------------------------------

  class SSFAdmin {
    private static $users = array();
    private static $initialized = false;
    private $name = '';
    private $title = '';
    private $email = '';
    private $valediction = '';

    public function name() { return $this->name; }
    public function title() { return $this->title; }
    public function email() { return $this->email; }
    public function valediction() { return $this->valediction; }

    public static function user($index) { 
      $users = self::users();
      return $users[$index]; 
    }

    public static function users() {
      if (!self::$initialized) {
        // TODO Reimplement this to read from the database with a new adminUsers table.
        self::$users[1] = new self('Hamel Bloom', 'Executive Director', 'hamel@sanssoucifest.org', 'Best wishes,'); // David
        self::$users[5] = new self('Ana Baer', 'Artistic Co-Director', 'ana@sanssoucifest.org', 'Besos,');
        self::$users[22] = new self('Steph Kobes', 'Communications Director', 'steph@sanssoucifest.org', 'Good energy your way,');
        self::$users[38] = new self('Michelle Ellsworth', 'Artistic Co-Director', 'michelle@sanssoucifest.org', 'Truly,');
        self::$users[52] = new self('Hamel Bloom', 'Executive Director', 'hamel@sanssoucifest.org', 'Best wishes,');
      }
      self::$initialized = true;
      return self::$users;
    }

    // E.g., new SSFAdmin(name, title, email, valediction)
    private function __construct() {
      $args = func_get_args();
      $this->name = $args[0];
      $this->title = $args[1];
      $this->email = $args[2];
      $this->valediction = $args[3];
    }

  }
  

// --- class SSFCommunique -----------------------------------------------------------------------------------

// TODO: 
// 1) Remove (or at least ignore) the 'sent' field from the communications table.
// 2) Similarly treat the 'artistInformedOfMediaReceipt' in the works table, computing that boolean
//    as (isset(artistInformedOfMediaReceiptDate) && artistInformedOfMediaReceiptDate != '' && artistInformedOfMediaReceiptDate != '0000-00-00')

  class SSFCommunique {
    private static $TESTING = true;
    public static $emailCommunique = null;
    private static $adminUserId = 0;
    private static $debugger = null;
    private $commId = 0;
    private $recipientId = 0;
    private $recipientName = '';
    private $dateSent = '';
    private $commType = '';
    private $sender = 0;
    private $to = '';
    private $from = '';
    private $subject = '';
    private $message = '';
    private $inResponseTo = 0;
    private $emailWidgetId = '';
    private $referencedWorks = array();
    private $bcc = '';
    
    // Utility functions
     public function belch($idString, $doIt=0) { self::$debugger->belch($idString . ' Communique', $this, $doIt); }
  
    // Get the rows for the works where media has been received but not acknowledged by an email.
    public static function getMediaReceiptEmailNeededRows() {
      $query = "SELECT name, personId, email, title, workId, designatedId, dateMediaReceived,"
             . " artistInformedOfMediaReceipt, artistInformedOfMediaReceiptDate,"
             . " communicationId, communications.type"
             . " FROM people join works on submitter=personId"
             . " left join communicationWork on workId=work"
             . " left join communications on communication=communicationId"
             . " WHERE callForEntries = " . SSFRunTimeValues::getCallForEntriesId() 
             . " and (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . " and (artistInformedOfMediaReceipt = 0 or artistInformedOfMediaReceipt is null)"
             . " ORDER BY personId, communicationId desc, titleForSort";

//      SSFDB::debugOn();
      $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
      SSFDB::debugOff();
      return $resultRows;
    }

   // Initialization functions
   
    public function initializeFromDatabase($commId) {
      self::$debugger->becho('initializeFromDatabase commId', $commId, 1);
      //SSFDB::debugNextQuery();
      $commQueryString = "SELECT communicationId, recipient, dateSent, type, sender, emailTo, emailFrom, emailSubject, contentText, inResponseTo,"
                       . " personId, name, nickName, lastName "
                       . " FROM communications join people on recipient=personId"
                       . " WHERE communicationId = " . $commId;
      $dataRecord = SSFDB::getDB()->getArrayFromQuery($commQueryString);
      self::$debugger->belch('initializeFromDatabase dataRecord', $dataRecord, -1);
      $this->setValuesFromDataArray($dataRecord[0]);
      $this->initializeReferencedWorks($this->getReferencedWorksArray());
    }

    public function initializeAsMediaReceiptFromRecipient($personId) {
//      SSFDB::getDB()->debugOn();
      self::$debugger->becho('initializeAsMediaReceiptFromRecipient personId', $personId, 1);
      $query = "SELECT personId, name, nickName, lastName, email, "
             . " title, workId, designatedId, accepted, rejected, "
             . " dateMediaReceived, artistInformedOfMediaReceipt, artistInformedOfMediaReceiptDate"
             . " FROM people join works on submitter=personId"
             . " WHERE submitter = " . $personId . " and callForEntries = " . SSFRunTimeValues::getCallForEntriesId()
//             . " and (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . " and (artistInformedOfMediaReceipt = 0 or artistInformedOfMediaReceipt is null)"
             . " ORDER BY titleForSort";
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      SSFDB::getDB()->debugOff();
      self::$debugger->belch("worksArray", $worksArray, -1);
      $this->setValuesFromDataArray($worksArray[0]);
      $this->initializeReferencedWorks($worksArray);
      $this->beMediaReceived();
    }
    
    private function getReferencedWorksArray() {
      $query = "SELECT title, workId, designatedId, accepted, rejected, "
             . " dateMediaReceived, artistInformedOfMediaReceipt, artistInformedOfMediaReceiptDate"
             . " FROM people join works on submitter=personId"
             . " WHERE submitter = " . $this->recipientId . " and callForEntries = " . SSFRunTimeValues::getCallForEntriesId()
//             . " and (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . " and (artistInformedOfMediaReceipt = 0 or artistInformedOfMediaReceipt is null)"
             . " ORDER BY titleForSort";
//      SSFDB::getDB()->debugOn();
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      SSFDB::getDB()->debugOff();
      return $worksArray;
    }

    public function restoreFromCache($dataArray) {
      $this->setValuesFromDataArray($dataArray);
      $this->initializeReferencedWorks($this->getReferencedWorksArray());
    }
    
    private function initializeReferencedWorks($worksArray) {
      $iteration = 0;
      foreach ($worksArray as $work) {
        $referencedWork = $work;
        $dateMediaReceived = (isset($work['dateMediaReceived'])) ? $work['dateMediaReceived'] : '';
        $referencedWork['dateMediaReceived'] = $dateMediaReceived;
        $referencedWork['artistInformedOfMediaReceiptDate'] = isset($referencedWork['artistInformedOfMediaReceiptDate'])
                                                            ? $work['artistInformedOfMediaReceiptDate'] : '';
/*
        $referencedWork['workId'] = $work['workId'];
        $referencedWork['designatedId'] = $work['designatedId'];
        $referencedWork['title'] = $work['title'];
        $referencedWork['accepted'] = $work['accepted'];
        $referencedWork['rejected'] = $work['rejected'];
        $dateMediaReceived = (isset($work['dateMediaReceived'])) ? $work['dateMediaReceived'] : '';
        $referencedWork['dateMediaReceived'] = $dateMediaReceived;
        $referencedWork['artistInformedOfMediaReceipt'] = $work['artistInformedOfMediaReceipt'];
        $referencedWork['artistInformedOfMediaReceiptDate'] = $work['artistInformedOfMediaReceiptDate'];
*/
        $referencedWork['emailWidgetId'] = self::computeEmailWidgetId($referencedWork['workId']);
        $this->referencedWorks[$iteration] = $referencedWork;
        if ($iteration == 0) {
          $this->emailWidgetId = $referencedWork['emailWidgetId'];
        }
        $iteration++;
      }
    }

    private static function mediaReceivedFor($referencedWork) {
      $dateMediaReceived = (isset($referencedWork['dateMediaReceived'])) ? $referencedWork['dateMediaReceived'] : '';
      $mediaReceived = ($dateMediaReceived != '0000-00-00' && $dateMediaReceived != '');
      self::$debugger->becho('mediaReceivedFor mediaReceived', $mediaReceived, -1);
      self::$debugger->belch('mediaReceivedFor referencedWork', $referencedWork, -1);
      return $mediaReceived;
    }

    // Save to database functions
    
    // Inserts an new communication in the database and returns $communicationId
    public function insertIntoDatabase($adminUserId) {
      self::$debugger->becho('insertIntoDatabase userId', $adminUserId, 1);
      $this->belch('30', 0);
      $referencedWork = $this->referencedWorks[0]['workId'];
      // Insert this communique into the communcations table.
      $commInsertString = "INSERT INTO communications (recipient, template, sent, dateSent, type, sender, referencedWork, contentText, "
                         . "contentFormatted, applicationToOpenFormattedText, physicalOrEmailOrVoice, inResponseTo, notes, "
                         . "emailTo, emailFrom, emailSubject, "
                         . "lastModificationDate, lastModifiedBy, contentLastModDate, contentLastModifiedBy) "
                         . "VALUES (" . $this->recipientId  . ", NULL, " . (($this->sent()) ? 1 : 0) . ", NULL, '" . $this->commType . "', " 
                         . $adminUserId . ", " . $referencedWork . ", " 
                         . SSFQuery::quote($this->message) . ", NULL, NULL, 'Email', NULL, NULL, " 
                         . SSFQuery::quote($this->to) . ", "
                         . SSFQuery::quote($this->from) . ", " 
                         . SSFQuery::quote($this->subject) . ", NOW(), " . $adminUserId . ", NOW(), " . $adminUserId . ")";
      //SSFDB::debugNextQuery();
      // TODO The next two calls to SSFDB::getDB()->saveData() should be an atomic indivisible operation.
      SSFDB::getDB()->saveData($commInsertString);
      $this->commId = SSFDB::getDB()->insertedId(); 
      self::$debugger->becho("37 commId", $this->commId, 1);
      // Make the corresponding DB entries in the communicationWork table.
      $valuesClause = "";
      $separator = "";
      foreach ($this->referencedWorks as $work) {
        if (self::mediaReceivedFor($work)) {
          $valuesClause .= $separator . "(" . $this->commId . ", " . $work['workId'] . ")";
          $separator = ", ";
        }
      }
      $query = "INSERT INTO communicationWork (communication, work) VALUES " . $valuesClause;
      SSFDB::getDB()->saveData($query);
      return $this->commId;
    }

    public function updateDatabase($adminUserId) {
      self::$debugger->becho('updateDatabase userId', $adminUserId, 1);
      $commUpdateString = "UPDATE communications set contentText = " 
                                . SSFQuery::quote($this->message)
                                . ", sent = " . (($this->sent()) ? 1 : 0)
                                . ", emailTo = " . SSFQuery::quote($this->to)
                                . ", emailFrom = " . SSFQuery::quote($this->from)
                                . ", emailSubject = " . SSFQuery::quote($this->subject)
                                . ", lastModificationDate = NOW(), lastModifiedBy = " . $adminUserId 
                                . ", contentLastModDate = NOW(), contentLastModifiedBy = " . $adminUserId 
                                . " WHERE communicationId = " . $this->commId . "";
      SSFDB::getDB()->saveData($commUpdateString);
    }

    // HTML generation
    public function displayAsHiddenInputFields() {
      echo '<input type="hidden" id="commId" name="commId" value=' . $this->commId . '>' . "\r\n";
      echo '<input type="hidden" id="recipientId" name="recipientId" value=' . $this->recipientId . '>' . "\r\n";
      echo '<input type="hidden" id="recipientName" name="recipientName" value="' . $this->recipientName . '">' . "\r\n";
      echo '<input type="hidden" id="dateSent" name="dateSent" value="' . $this->dateSent . '">' . "\r\n";
      echo '<input type="hidden" id="type" name="type" value="' . $this->commType . '">' . "\r\n";
      echo '<input type="hidden" id="sender" name="sender" value=' . $this->sender . '>' . "\r\n";
      echo '<input type="hidden" id="to" name="to" value="' . $this->to() . '">' . "\r\n";
      echo '<input type="hidden" id="from" name="from" value="' . $this->from . '">' . "\r\n";
      echo '<input type="hidden" id="emailSubject" name="emailSubject" value="' . $this->subject . '">' . "\r\n";
      echo '<input type="hidden" id="contentText" name="contentText" value="' . htmlspecialchars($this->message) . '">' . "\r\n";
      echo '<input type="hidden" id="inResponseTo" name="inResponseTo" value="' . $this->inResponseTo . '">' . "\r\n";
      echo '<input type="hidden" id="emailWidgetId" name="emailWidgetId" value="' . $this->emailWidgetId . '">' . "\r\n";
      echo '<input type="hidden" id="bcc" name="bcc" value="' . $this->bcc . '">' . "\r\n";
    }
/*
    // instance generation
    public static function generate($commType, $dataArray) {
      $communique = self::instance();
      $communique->setValuesFromDataArray($dataArray);
      if (!$communique->sent()) $this->communique = $adminUserId;
      $communique->commType = $commType;
      switch ($commType) {
        case 'AcceptReject': return $communique->beAcceptReject(); break;
        case 'MediaReceipt': return $communique->beMediaReceived(); break;
      }
      return $communique;
    }
*/
    // Singleton pattern support.
    public static function instance($adminUserId = 0) {
      if (!(self::$emailCommunique instanceof self)) { 
        self::$emailCommunique = new self($adminUserId);
      }
      return self::$emailCommunique;
    }

    // One-line "getters"
    public function to() { return $this->to; }
    public function from() { return $this->from; }
    public function nominalDateSent() { return ($this->wasSent()) ? $this->dateSent : 'Nowish'; }
    public function message() { return $this->message; }
    public function subject() { return $this->subject; }
    public function commId() { return $this->commId; }
    public function recipientId() { return $this->recipientId; }
    
    // One line "setters"
    public function setFrom($from) { $this->from = $from; }
    public function setTo($to) { $this->to = $to; }

    // Multi-line "setters"
    
    public function setToFieldFromNameAndEmail($nameString, $commaSeparatedEmailAddressesString) { 
      $emailStrings = explode (',', $commaSeparatedEmailAddressesString);
      $this->to = $nameString . ' <' . trim($emailStrings[0]) . '>'; 
      return $this->to;
    }
    
    public function setValuesFromDataArray($dataArray) {
      // This function handles a data array from a query or from the hidden input cache.
      $this->commId = (isset($dataArray['commId']) ? $dataArray['commId'] 
                    : (isset($dataArray['communicationId']) ? $dataArray['communicationId'] : 0));
      $this->recipientId = (isset($dataArray['recipient']) ? $dataArray['recipient'] 
                         : (isset($dataArray['recipientId']) ? $dataArray['recipientId'] 
                         : (isset($dataArray['personId']) ? $dataArray['personId'] : 0)));
      $this->recipientName = (isset($dataArray['name']) ? $dataArray['name'] 
                           : (isset($dataArray['recipientName']) ? $dataArray['recipientName'] : 0));
/*      $this->sent = ((isset($dataArray['sent'])) 
                  ? ($dataArray['sent'] == 1) 
                  : (isset($dataArray['artistInformedOfMediaReceipt']) 
                  ? ($dataArray['artistInformedOfMediaReceipt'] == 1) 
                  : false));  */
      $this->dateSent = ((isset($dataArray['dateSent'])) 
                  ? $dataArray['dateSent'] 
                  : (isset($dataArray['artistInformedOfMediaReceiptDate']) 
                  ? $dataArray['artistInformedOfMediaReceiptDate']
                  : ''));
      $this->commType = (isset($dataArray['type']) ? $dataArray['type'] : '');
      $this->sender = (isset($dataArray['sender']) ? $dataArray['sender'] : 0);
      $this->to = (isset($dataArray['emailTo']) ? $dataArray['emailTo'] 
                : ((isset($dataArray['to'])) ? $dataArray['to'] : ''));
      if ($this->to =='') {
        $name = (isset($dataArray['name']) && $dataArray['name'] !='') ? $dataArray['name'] : '';
        $email = (isset($dataArray['email']) && $dataArray['email'] !='') ? $dataArray['email'] : '';
        $this->setToFieldFromNameAndEmail($name, $email);
      }
      $this->from = (isset($dataArray['emailFrom']) ? $dataArray['emailFrom'] 
                  : ((isset($dataArray['from'])) ? $dataArray['from'] : ''));
      $this->subject = (isset($dataArray['emailSubject']) ? $dataArray['emailSubject'] : '');
      $this->message =(isset($dataArray['contentText']) ? $dataArray['contentText'] : '');
      $this->inResponseTo = (isset($dataArray['inResponseTo']) ? $dataArray['inResponseTo'] : 0);
      // $this->referencedWorks is unaffected.
      // $this->emailWidgetId is unaffected.
      // $this->bcc is unaffected.
    }

    // summary display of referenced works for this email.
    public function displayReferencedWorks() {
      echo "<table border='0' width='92%' class='bodyTextOnDarkGray' style='padding:10px 0px 8px 0px;'>\r\n";
      echo "<tr><td colspan='5' align='left' style='padding:0px 4px 4px 4px;'>Works referenced in this communique:</td>";
//      echo "<tr><td align='center'>Work Id</td><td align='center'>&nbsp;</td><td align='left'>Title</td><td align='center'>&nbsp;</td><td align='left'>Widget Id</td></tr>\r\n";
      foreach ($this->referencedWorks as $workArray) { 
        $constStyle = "line-height:17px;margin:0;";
        echo "<tr>"
         . (($this->commType == "MediaReceipt")
           ? "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" . ((self::mediaReceivedFor($workArray)) ? "rec'd" : "") . "</td>"
           : '')
         . "<td align='left' style='" . $constStyle . "padding:0 0px 0 4px;'>" . $workArray['workId'] . "</td>"
         . "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" . $workArray['designatedId'] . "</td>"
         . "<td align='left' style='" . $constStyle . "padding:0 0px 0 4px;'>" . '"' . $workArray['title'] . '"' . "</td>"
         . (($this->commType == "AcceptReject")
           ? "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" 
             . HTMLGen::acceptanceDisplay($workArray['accepted'], $workArray['rejected']) . "</td>"
           : '')
         . "<td align='left' style='" . $constStyle . "padding:0 4px 0 4px;'>" . $workArray['emailWidgetId'] . "</td>"
         . "</tr>\r\n";
        }
      echo "</table>\r\n";
    }
    
    // Send this communique as an email.
    public function send() { 
      // Send the mail.
      if (!isset($this->bcc) || $this->bcc == '') $this->bcc = $this->from;
      $headers = "From: " . $this->from . "\r\n"
               . "Reply-To: " . $this->from . "\r\n"
               . "Bcc: " . $this->bcc . "\r\n"
               . "X-Mailer: PHP" . phpversion() . "\r\n"
               . "X-Apparently-To: " . $this->to;
      if (self::$TESTING) $mailedData = mail('hamelb@sanssoucifest.org', $this->subject, $this->message . "\r\n\r\n", $headers);
      else $mailedData = mail($this->to, $this->subject, $this->message . "\r\n\r\n", $headers);
      // Update the object and database sent and dateSent fields.
      $this->dateSent = date("Y-m-d H:i:s");
      // TODO - test for this db update
      $updateQuery = 'UPDATE communications set sent=1, dateSent=NOW() where communicationId=' . $this->commId;
      SSFDB::getDB()->saveData($updateQuery);
      // Mark the referenced works in the works table to show that the artist was informed of media receipt.
      $worksAffected = $this->referencedWorks;
      $worksWhereClause = "";
      $disjunctionString = "";
      // TODO test for this db update
      foreach ($worksAffected as $work) {
        if (self::mediaReceivedFor($work)) {
          $worksWhereClause .= $disjunctionString . "workId = " . $work['workId'];
          $disjunctionString = " or ";
        }
      }
      $query = "UPDATE works SET artistInformedOfMediaReceipt=1, artistInformedOfMediaReceiptDate=NOW()"
             . " WHERE " . $worksWhereClause;
      SSFDB::getDB()->saveData($query);

    }

    // constructor
    public function __construct() {
      $args = func_get_args();
      $this->commId = 0;
      $this->recipientId = 0;
      $this->recipientName = '';
      $this->dateSent = '';
      $this->commType = '';
      $this->sender = isset($args[0]) ? $args[0] : 0;
      $this->to = '';
      $this->from = '';
      $this->subject = '';
      $this->message = '';
      $this->inResponseTo = 0;
      $this->emailWidgetId = '';
      $this->referencedWorks = array();
      $this->bcc = '';
      // TODO Hack Alert! Initialization of a class variables inside the constructor.
      self::$adminUserId = isset($args[0]) ? $args[0] : 0;
      if (is_null(self::$debugger)) {
        self::$debugger = new SSFDebug();
        self::$debugger->enableBelch(false);
        self::$debugger->enableBecho(false);
      }
    }

    // message generation
    public function regenerateMessage() { return $this->generateMessage(); }
  
    private function generateMessage() {
      $this->message = "Dear " . $this->recipientName . ",\r\n\r\n";
      switch ($this->commType) {
        case 'AcceptReject': $this->message .= $this->newAcceptRejectMessageBody(); break;
        case 'MediaReceipt': $this->message .= $this->newMediaReceivedMessageBody(); break;
        default: self::$debugger->belch('Bad commType', $this->commType, 1);
      }
      $this->message .= "\r\n";
      // 'Gume Bye.'
      $user = SSFAdmin::user(self::$adminUserId);
      $this->message .= $user->valediction() . "\r\n\r\n";
      $this->message .= $user->name() . "\r\n";
      $this->message .= $user->title() . "\r\n";
      $this->message .= 'Sans Souci Festival of Dance Cinema' . "\r\n";
      //$this->message .= $user->email() . "\r\n";
      $this->message .= 'http://sanssoucifest.org' . "\r\n";
      return $this->message;
    }

    // BEGIN This group of functions is based on HTMLGen
  
    public static function computeEmailWidgetId($id) { return 'emailWidget-' . $id; }
    public function emailWidgetId() { return $this->emailWidgetId; }
    public function setEmailWidgetId($id) { $this->emailWidgetId = self::emailWidgetId($id); }
  
    public function wasSaved() { $wasSaved = (($this->commId != 0) && ($this->commId != '')); return $wasSaved; }
//    public function wasSent() { $emailWasSent = ($this->wasSaved() && $this->sent); return $emailWasSent; }
    public function wasSent() { return $this->sent(); }
    public function sent() { return (isset($this->dateSent) && ($this->dateSent != '') && ($this->dateSent != '0000-00-00 00:00:00')); }

    // END This group of functions is based on HTMLGen


// MediaReceipt Communique "subclass"

    private function newMediaReceivedMessageBody() {
      $worksReceived = array();
      $worksNotYetReceived = array();
      foreach ($this->referencedWorks as $referencedWork) {
        if (self::mediaReceivedFor($referencedWork)) $worksReceived[] = $referencedWork;
        else $worksNotYetReceived[] = $referencedWork;
      }      
      $remainingWorksCount = $worksCount = count($worksReceived);
      $message = 'Thank you very much for your submission';
      $message .= ($worksCount > 1) ? 's ' : ' ';
      $message .= 'to the 2010 Sans Souci Festival of Dance Cinema. We have received the media for ';
      foreach ($worksReceived as $referencedWork) {
        $remainingWorksCount--;
        $terminator = ($remainingWorksCount == 0  && $worksCount > 1) ? '.' : '';
        $punctuation = ($remainingWorksCount > 0 && $worksCount > 2) ? ',' : $terminator;
        $message .= '"' . $referencedWork['title'] . $punctuation . '"';
        $conjunction = ($remainingWorksCount == 1) ? ' and ' : ' ';
        $message .= $conjunction;
      }
      $nextPhraseStart = ($remainingWorksCount == 0 && $worksCount > 1) ? 'We ' : 'and we ';
      $pieceString = ($worksCount == 1) ? 'it' : 'them'; //  alternately:  ? 'this piece' : 'these pieces';
      $entryString = ($worksCount == 1) ? 'entry' : 'entries';
      $message .= $nextPhraseStart;
      $message .= 'look forward to viewing ' . $pieceString . ' as we curate the festival. ';
      if (count($worksNotYetReceived) > 0) { // We have not received all the submissions entered for this person.
        $message .= 'We have not yet received '; // (or, at least not yet checked in) ';
        $remainingWorksCount = $worksCount = count($worksNotYetReceived);
        foreach ($worksNotYetReceived as $referencedWork) {
          $remainingWorksCount--;
          $terminator = ($remainingWorksCount == 0) ? '.' : '';
          $punctuation = ($remainingWorksCount > 0 && $worksCount > 2) ? ',' : $terminator;
          $message .= '"' . $referencedWork['title'] . $punctuation . '"';
          $disjunction = ($remainingWorksCount == 1) ? ' or ' : ' ';
          $message .= $disjunction;
        }
      }
      $message .= "\r\n\r\n" . 'You can expect to hear from us again sometime in July.';
      $message .= "\r\n\r\n" . 'Again, thanks for your ' . $entryString . '.' . "\r\n";
      return $message;
    }
  
    // Generates and returns a emailCommunique object.
    private function beMediaReceived() {
      $this->commType = 'MediaReceipt';
      $this->from = 'info@sanssoucifest.org';
      $this->bcc = 'info@sanssoucifest.org';
      $this->subject = 'Sans Souci Festival of Dance Cinema - Media received';
      $this->message = $this->generateMessage();
      return $this;
    }

    private function mrEmailSentWidgetMarkup() {
      return mrEmailClassSentWidgetMarkup($this->commId, $this->recipientId);
    }

    // coordinate changes with the javascript function mrEmailSentWidgetMarkupJS()
    private static function mrEmailClassSentWidgetMarkup($commId, $recipientId) {
      return '<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(' . $commId . ',' . $recipientId . ');"><img '
           . 'src="../../images/emailSentIcon059.gif" alt="View email sent." title="View email sent." '
           . 'width="18" height="15" align="top" border="0" hspace="0" vspace="0"></a>';
    }

    private function mrEmailNotSentWidgetMarkup() {
      return mrEmailClassNotSentWidgetMarkup($this->commId, $this->recipientId);
    }
    
    private static function mrEmailClassNotSentWidgetMarkup($commId, $recipientId) {
      return '<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(' . $commId . ',' . $recipientId . ');"><img '
           . 'src="../../images/emailSendIcon090g.gif" width="18" height="15" align="top" border="0" hspace="0" vspace="0"></a>';
    }
    
    private function mrEmailWidgetMarkup() {
      $emailWidgetMarkup = ($this->wasSent()) 
                         ? $this->mrEmailSentWidgetMarkup() 
                         : $this->mrEmailNotSentWidgetMarkup();
      return $emailWidgetMarkup;
    }
  
    public static function mrEmailWidgetClassMarkup($commId, $recipientId, $artistInformed) {
      $emailWidgetMarkup = ($artistInformed) 
                         ? self::mrEmailClassSentWidgetMarkup($commId, $recipientId) 
                         : self::mrEmailClassNotSentWidgetMarkup($commId, $recipientId);
      return $emailWidgetMarkup;
    }
  

  
// AcceptReject Communique "subclass"  -- TODO Move the implementations from elsewhere to here. --

    private function newAcceptRejectMessageBody() {
      echo 'Implement newAcceptRejectMessageBody() based on generateAccRejEmail() in curationAccRejEmailText.php' . "<br>\r\n";
    }

    private function beAcceptReject() {
      $this->commType = 'AcceptReject';
      $this->from = 'Curators@sanssoucifest.org';
      $this->bcc = 'Curators@sanssoucifest.org';
      $this->subject = 'Sans Souci Festival of Dance Cinema';
      $this->message = $this->generateMessage();
      return $this;
    }

    // BEGIN This group of functions is based on HTMLGen

    // coordinate changes with the javascript function arEmailSentWidgetMarkupJS(workId)
    public function arEmailSentWidgetMarkup() {
      return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $this->workGroupId . ')"><img '
           . 'src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>';
    }
    
    private function arEmailNotSentWidgetMarkup($workId, $accepted, $rejected) {
      $kindOf = ($rejected==1) ? ' rejection ' : ' acceptance ';
      $sendKind = 'alt="Send' . $kindOf . 'email." title="Send' . $kindOf . 'email." ';
      return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $this->workGroupId . ')"><img '
           . 'src="../images/emailSendIcon3.gif" ' . $sendKind . ' width="34" height="18" align="top" border="0" ></a>';
    }
    
    private function arEmailWidgetMarkup($workRow, $workId, $accepted, $rejected) {
      $emailWidgetMarkup = '';
      if ((($accepted==1) && ($rejected!=1)) || (($accepted!=1) && ($rejected==1)))
        $emailWidgetMarkup = (self::emailWasSent($workRow)) 
                         ? self::arEmailSentWidgetMarkup($workId) 
                         : self::arEmailNotSentWidgetMarkup($workId, $accepted, $rejected);
      return $emailWidgetMarkup;
    }
  
    // END This group of functions is based on HTMLGen
  
  }
?>
