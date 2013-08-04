<SCRIPT type="text/javascript">
//<!--

// Plugs innerHTML for the email icon on the row of interest in the list of works on curationAccRejEmail.php. E.g.,
//   DOMid = emailSentMarkup-56
//   markup = <a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(56)"><img 
//            src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>
function markMrListItemSent(DOMid, markup) {
  setBreakpointHere = 0;
  //alert('markMrListItemSent\r\n  DOMid = |' + DOMid + '|\r\n  markup = |' + markup + '|');
  if (DOMid !== undefined && DOMid !== '') {
    var container = window.opener.document.getElementById(DOMid);
    container.innerHTML = markup;
  }
  return true;
}

function markArListItemSent(DOMid, markup) {
  setBreakpointHere = 0;
  if (DOMid !== undefined && DOMid !== '') {
    var listFrame = this.parent.getUniqueElement('curationEmailList');
    var container = listFrame.contentDocument.getElementById(DOMid);
    container.innerHTML = markup;
    alert('markArListItemSent\r\n  DOMid = |' + DOMid + '|\r\n  markup = |' + markup + '|');
  }
  return true;
}

//-->
</SCRIPT>

<?php

// --- class SSFCommunique -----------------------------------------------------------------------------------

// TODO: 
// 1) Remove the 'sent' field from the communications table. All references should have been removed by now.
// 2) Finish removing references to works.artistInformedOfMediaReceipt and works.artistInformedOfMediaReceiptDate which
//    are no longer used.
// 3) Clarify the confustion between the roles of $adminUserId vs $sender. $adminUserId is used for setting the lastModifiedBy fields,
//    but also to initialize the $sender? From then on, $sender is a separate database value. Since $adminUserId is static, the value
//    may be lost or change on refreshs and reinitializations.
// 4) <input type="hidden" id="bcc" name="bcc" value=""> gets lost on calls to initializeFromDatabase().


  class SSFCommunique {
    private static $TESTING = true;
    private static $mrEmailSentIconPic = "images/emailSentIcon059c.gif"; // (18x15)
    private static $mrEmailSendIconPic = "images/emailSendIcon090g.gif"; // (18x15)
    private static $mrEmailIconWidth = 18;
    private static $mrEmailSendIconHeight = 15;
    private static $mrEmailSentIconHeight = 14;
    private static $arEmailSentIconPic = "images/emailSentIcon059c.gif";  // (18x15)   // or alternately /images/emailSentIcon3.gif (34x18)
    private static $arEmailSendIconPic = "images/emailSendIcon090g.gif";  // (18x15)  // or alternately /images/emailSendIcon3.gif (34x18)
    private static $arEmailIconWidth = 18;
    private static $arEmailSendIconHeight = 15;
    private static $arEmailSentIconHeight = 14;
    public static $emailCommunique = null; // Singleton pattern support
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
    private $mrEmailWidgetId = '';
    private $referencedWorks = array();
    private $bcc = '';
    private $suppress;
    
    // Utility functions
     public function belch($idString, $doIt=0) { self::$debugger->belch($idString . ' Communique', $this, $doIt); }
  
    private static function selectWorksForWhichEmailWasAlreadySent($commTypeString) {
      $selectWorksForWhichEmailWasAlreadySent =
                 " SELECT `work`"
             .   " FROM communicationWork"
             .   " JOIN communications ON communicationId = communication"
             .   " AND `type` = '" . $commTypeString . "'"
             .   " AND dateSent != '' AND dateSent != '0000-00-00 00:00:00' AND dateSent != '0000-00-00' AND dateSent IS NOT NULL";
      return $selectWorksForWhichEmailWasAlreadySent;
    }

    // Get the rows for the works where media has been received but not acknowledged by an email.
    public static function getMediaReceiptEmailNeededRows() {
/*
      $query = " SELECT name, personId, email, title, workId, designatedId, dateMediaReceived,"
             . " communicationId, communications.type, dateSent"
             . " FROM people JOIN works on submitter=personId"
             . " LEFT JOIN communicationWork on workId=work"
             . " LEFT JOIN communications on communication=communicationId"
//             . " and communications.type = 'MediaReceipt'"  // line added 7/14/10 and moved from WHERE to ON 7/15
             . " WHERE callForEntries = " . SSFRunTimeValues::getCallForEntriesId() 
             . " and (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . " and (dateSent is null or dateSent = '' or dateSent = '0000-00-00' or dateSent = '0000-00-00 00:00:00')"
             . " ORDER BY personId, workId";
*/
      $query = " SELECT name, personId, email, title, workId, designatedId, dateMediaReceived,"
             . " communicationId, communications.type, dateSent"
             . " FROM people JOIN works on submitter=personId"
             . " LEFT JOIN communicationWork on workId=work"
             . " LEFT JOIN communications on communication=communicationId"
             . " WHERE callForEntries = " . SSFRunTimeValues::getCallForEntriesId() 
             . "   AND (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . "   AND workId NOT IN "
             . "     (SELECT work FROM communicationWork JOIN communications on communication=communicationId"
             . "      WHERE communications.type = 'MediaReceipt'" 
             . "         AND (dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00'))"
             . " ORDER BY personId, workId";
/*
      $query = "SELECT * FROM"
             . " ((SELECT name, personId, email, title, workId, designatedId, dateMediaReceived"
             . " FROM people JOIN works on submitter=personId"
             . " WHERE callForEntries=" . SSFRunTimeValues::getCallForEntriesId()
             . " AND (dateMediaReceived != '0000-00-00' AND dateMediaReceived is not null AND dateMediaReceived != ''))"
             . " AS selectedWorks)"
             . " LEFT JOIN"
             . " ((SELECT communicationId, communications.type, dateSent, `work`"
             . " FROM communications"
             . " JOIN communicationWork"
             . " ON communication=communicationId"
//             . " WHERE (communications.type = 'MediaReceipt'"
//             . " AND (dateSent is null OR dateSent = '' OR dateSent = '0000-00-00' OR dateSent = '0000-00-00 00:00:00')))"
             . " WHERE (dateSent is null OR dateSent = '' OR dateSent = '0000-00-00' OR dateSent = '0000-00-00 00:00:00'))"
             . " AS selectedComms)"
             . " ON selectedWorks.workId=selectedComms.work"
//             . " WHERE xxx"
             . " ORDER BY personId, workId";
*/
      SSFDB::debugOn();
      $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
      SSFDB::debugOff();
      SSFDebug::globalDebugger()->belch('getMediaReceiptEmailNeededRows() resultRows', $resultRows, -1);
      return $resultRows;
    }

   // Initialization functions
   
    public function initializeFromDatabase($commId, $dataArray) {
      //$this->beMediaReceived(); commented out 7/14/10
      self::$debugger->becho('initializeFromDatabase commId', $commId, 0);
      //SSFDB::debugNextQuery();
      $commQueryString = "SELECT communicationId, recipient, dateSent, type, sender, emailTo, emailFrom, emailSubject, contentText, inResponseTo,"
                       . " personId, name, nickName, lastName "
                       . " FROM communications JOIN people on recipient=personId"
                       . " WHERE communicationId = " . $commId;
      $dataRecord = SSFDB::getDB()->getArrayFromQuery($commQueryString);
      self::$debugger->belch('initializeFromDatabase() dataRecord', $dataRecord, -1);
      $this->setValuesFromDataArray($dataRecord[0]);
      if (isset($dataArray['bcc'])) $this->bcc = $dataArray['bcc']; // initialized separately because it's not stored in the database
      if (($this->commType == 'MediaReceipt') && isset($dataArray['widgetId'])) $this->setMrEmailWidgetId($dataArray['widgetId']); 
      $this->initializeReferencedWorks($this->getReferencedWorksFromDB());
    }


    private static function initializationQueryFor($commTypeString, $personId) {
      // This query created/modified 5/3/10 10PM to do without works.artistInformedOfMediaReceipt 
      // and works.artistInformedOfMediaReceiptDate
      $query = "SELECT personId, name, nickName, lastName, email, " 
//             . " title, workId, designatedId, accepted, rejected, acceptFor, photoLocation, dateMediaReceived, " // commented out 7/16/10
             . " workId, dateMediaReceived, " 
             . " communication, dateSent "
//             . " FROM works" // commented out 7/16/10
//             . " JOIN people on submitter=personId" // commented out 7/16/10
             . " FROM people" 
             . " JOIN works on submitter=personId"
             . " LEFT JOIN communicationWork on work=workId"
/* ??? */    . " LEFT JOIN communications on communication=communicationId" // changed from left join to join 7/15/10
             . " AND `type` = '" . $commTypeString . "'" // line added 7/14/10
             . " WHERE submitter = " . $personId . " and callForEntries = " . SSFRunTimeValues::getCallForEntriesId()
             . " AND workId NOT IN (" . self::selectWorksForWhichEmailWasAlreadySent($commTypeString) . ")"
             . " order by titleForSort";
      return $query;
    }

    public function initialize($type, $personId, $widgetId='') {
      switch ($type) {
        case 'AcceptReject': $this->beAcceptReject(); break;
        case 'MediaReceipt': $this->beMediaReceived($widgetId); break;
        default: self::$debugger->belch('INTERNAL ERROR. Bad commType in Communique::initialize. Tell David.', $this->commType, 1);
      }
      self::$debugger->becho('initialize personId', $personId, 0);
      $query = self::initializationQueryFor($type, $personId);
      //SSFDB::getDB()->debugOn();
      $dataArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace("initialize() dataArray", $dataArray, -1);
      if (count($dataArray) >= 1) {
        $this->setValuesFromDataArray($dataArray[0]);
        $this->initializeReferencedWorks($this->findReferencedWorks());
      }
      $this->message = $this->generateMessage();
      SSFDB::getDB()->debugOff();
    }
    
    public function initializeAsMediaReceiptFromRecipient($personId, $widgetId='') {
      $this->initialize('MediaReceipt', $personId, $widgetId);
    }
    
    public function initializeAsAcceptRejectFromSubmitter($personId, $widgetId='') {
      $this->initialize('AcceptReject', $personId, $widgetId);
    }
    
    private function getReferencedWorksFromDB() {
      $query = "SELECT title, workId, designatedId, accepted, rejected, acceptFor, dateMediaReceived, photoLocation "
             . " FROM communicationWork JOIN works on work=workId "
             . " WHERE communication=" . $this->commId;
      //SSFDB::getDB()->debugOn();
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace('getReferencedWorksFromDB() worksArray', $worksArray, -1);
      SSFDB::getDB()->debugOff();
      return $worksArray;
    }
    
    private function findReferencedWorks() {
      $query = "SELECT title, workId, designatedId, accepted, rejected, acceptFor, dateMediaReceived, photoLocation "
             . " FROM people JOIN works on submitter=personId"
             . " WHERE submitter = " . $this->recipientId . " and callForEntries = " . SSFRunTimeValues::getCallForEntriesId()
             . " AND workId NOT IN (" . self::selectWorksForWhichEmailWasAlreadySent($this->commType) . ")"
             . " ORDER BY titleForSort";
      //SSFDB::getDB()->debugOn();
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace('findReferencedWorks() worksArray', $worksArray, -1);
      SSFDB::getDB()->debugOff();
      return $worksArray;
    }

    public function restoreFromCache($dataArray) {
      $this->setValuesFromDataArray($dataArray);
      if ($this->sent()) {
        $this->initializeReferencedWorks($this->getReferencedWorksFromDB());
      } else {
        $this->initializeReferencedWorks($this->findReferencedWorks());
      }
    }
    
    private function initializeReferencedWorks($worksArray) {
      $iteration = 0;
      foreach ($worksArray as $work) {
        $referencedWork = $work;
/*    These items are all subsumed by $referencedWork = $work
        $referencedWork['workId'] = $work['workId'];
        $referencedWork['designatedId'] = $work['designatedId'];
        $referencedWork['title'] = $work['title'];
        $referencedWork['accepted'] = $work['accepted'];
        $referencedWork['rejected'] = $work['rejected'];    
*/
        $dateMediaReceived = (isset($work['dateMediaReceived'])) ? $work['dateMediaReceived'] : '';
        $referencedWork['dateMediaReceived'] = $dateMediaReceived;
        $referencedWork['arEmailWidgetId'] = self::computeEmailWidgetId($referencedWork['workId']);
        $this->referencedWorks[$iteration] = $referencedWork;
        $iteration++;
      }
      self::$debugger->belchTrace('initializeReferencedWorks this->referencedWorks', $this->referencedWorks, -1);
    }

    private static function mediaReceivedFor($referencedWork) {
      $dateMediaReceived = (isset($referencedWork['dateMediaReceived'])) ? $referencedWork['dateMediaReceived'] : '';
      $mediaReceived = ($dateMediaReceived != '0000-00-00' && $dateMediaReceived != '');
      self::$debugger->becho('mediaReceivedFor mediaReceived', $mediaReceived, 0);
      self::$debugger->belch('mediaReceivedFor referencedWork', $referencedWork, 0);
      return $mediaReceived;
    }

    // NOTE This is one of the two uses of $this->mrEmailWidgetId(). 
    // Call to change the icon and onClick behavior of the widget in the list.
    public function mrMarkupEmailListOnSend() {
      // Invoke javascript:markMrListItemSent(updatedString) so that the button in the listing window has the new commId.
      $markMrListItemSentText = 'markMrListItemSent("' . $this->mrEmailWidgetId() 
        . '", mrEmailSentWidgetMarkupJS(' . $this->commId() . ', ' . $this->recipientId() . ', "' . $this->mrEmailWidgetId() . '"))';
      $script = "<script type='text/javascript'>eval('" . $markMrListItemSentText . "');</script>\r\n";
      self::$debugger->becho('mrMarkupEmailListOnSend script', $script, 0);
      echo $script;
    }

    // Call to change the icon and onClick behavior of the affected widgets in the list.
    public function arMarkupEmailListOnSend() {
      // Invoke javascript:markArListItemSent(updatedString) so that the button in the listing window has the new commId.
      $markArListItemSentText = "";
      foreach ($this->referencedWorks as $referencedWork) {
        $markArListItemSentText .= 'markArListItemSent("' . $referencedWork['arEmailWidgetId'] 
          . '", arEmailSentWidgetMarkupJS(' . $referencedWork['workId'] . ', ' . $this->commId() . ', ' . $this->recipientId() . ', "' . $referencedWork['arEmailWidgetId'] . '"));';
      }
      $script = "<script type='text/javascript'>eval('" . $markArListItemSentText . "');</script>\r\n";
      self::$debugger->bechoTrace('arMarkupEmailListOnSend script','', -1);
      echo $script;
    }
    
    public function markupEmailListOnSend() {
      self::$debugger->belchTrace('Communique::markupEmailListOnSend', $this, -1);
      switch ($this->commType) {
        case 'AcceptReject': $this->arMarkupEmailListOnSend(); break;
        case 'MediaReceipt': $this->mrMarkupEmailListOnSend(); break;
        default: self::$debugger->belch('INTERNAL ERROR. Bad commType in Communique::markupEmailListOnSend. Tell David.', $this->commType, 1);
      }
    }

    // Save to database functions
    
    // Inserts an new communication in the database and returns $communicationId
    public function insertIntoDatabase($adminUserId) {
      self::$debugger->becho('insertIntoDatabase userId', $adminUserId, 0);
      $this->belch('30', 0);
      if (count($this->referencedWorks) > 0) {
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
        self::$debugger->becho("37 commId", $this->commId, 0);
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
      }
      return $this->commId;
    }

    public function updateDatabase($adminUserId) {
      self::$debugger->becho('updateDatabase userId', $adminUserId, 0);
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
      echo '<input type="hidden" id="inResponseTo" name="inResponseTo" value=' . $this->inResponseTo . '>' . "\r\n";
      echo '<input type="hidden" id="emailWidgetId" name="emailWidgetId" value=' . $this->mrEmailWidgetId() . '>' . "\r\n";
      echo '<input type="hidden" id="bcc" name="bcc" value="' . $this->bcc . '">' . "\r\n";
      echo '<input type="hidden" id="contentText" name="contentText" value="' . htmlspecialchars($this->message) . '">' . "\r\n";
    }

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
    public function nominalDateSent() { return ($this->sent()) ? $this->dateSent : 'Nowish'; }
    public function message() { return $this->message; }
    public function subject() { return $this->subject; }
    public function commId() { return $this->commId; }
    public function recipientId() { return $this->recipientId; }
    public function suppress() { return $this->suppress; }
//    public function workId() { return $this->referencedWorks[0]['workId']; }
    
    // One line "setters"
    public function setFrom($from) { $this->from = $from; }
    public function setTo($to) { $this->to = $to; }
    public function setMessage($message) { $this->message = $message; }

    // Multi-line "setters"
    
    public function setToFieldFromNameAndEmail($nameString, $commaSeparatedEmailAddressesString) { 
      $emailStrings = explode (',', $commaSeparatedEmailAddressesString);
      $this->to = $nameString . ' <' . trim($emailStrings[0]) . '>'; 
      return $this->to;
    }
    
    public function setValuesFromDataArray($dataArray) {
      // This function handles a data array from a query or from the hidden input cache.
      self::$debugger->belch("48 setValuesFromDataArray() dataArray", $dataArray, -1);
      self::$debugger->belchTrace('49 from setValuesFromDataArray() dataArray', $dataArray, -1);
      $this->commId = (isset($dataArray['commId']) ? $dataArray['commId'] 
                    : (isset($dataArray['communicationId']) ? $dataArray['communicationId'] : 0));
      $this->recipientId = (isset($dataArray['recipient']) ? $dataArray['recipient'] 
                         : (isset($dataArray['recipientId']) ? $dataArray['recipientId'] 
                         : (isset($dataArray['personId']) ? $dataArray['personId'] : 0)));
      $this->recipientName = (isset($dataArray['name']) ? $dataArray['name'] 
                           : (isset($dataArray['recipientName']) ? $dataArray['recipientName'] : 0));
      $this->dateSent = ((isset($dataArray['dateSent'])) ? $dataArray['dateSent'] : '');
      $this->sender = (isset($dataArray['sender']) ? $dataArray['sender'] : 0);
      $this->to = (isset($dataArray['emailTo']) ? $dataArray['emailTo'] 
                : ((isset($dataArray['to'])) ? $dataArray['to'] : ''));
      if ($this->to =='') {
        $name = (isset($dataArray['name']) && $dataArray['name'] !='') ? $dataArray['name'] : '';
        $email = (isset($dataArray['email']) && $dataArray['email'] !='') ? $dataArray['email'] : '';
        $this->setToFieldFromNameAndEmail($name, $email);
      }
      $this->message =(isset($dataArray['contentText']) ? $dataArray['contentText'] : '');
      $this->inResponseTo = (isset($dataArray['inResponseTo']) ? $dataArray['inResponseTo'] : 0);
      // mrEmailWidgetId may have been pre-set by the caller, so do not override the current value. // WHAT? 7/15/10
      if (isset($dataArray['emailWidgetId']) && ($this->mrEmailWidgetId() == '')) $this->setMrEmailWidgetId($dataArray['emailWidgetId']); // added conjunctive clause 7/17/10
      // The following attributes may have been pre-set by beMediaReceived(), so do not override the current value. // WHAT? 7/15/10
      if (isset($dataArray['type'])) $this->commType = $dataArray['type'];
      else if (isset($dataArray['commType'])) $this->commType = $dataArray['commType'];
      if (isset($dataArray['emailFrom'])) $this->from = $dataArray['emailFrom'];
      else if (isset($dataArray['from'])) $this->from = $dataArray['from'];
      if (isset($dataArray['emailSubject'])) $this->subject = $dataArray['emailSubject'];
      if (isset($dataArray['bcc'])) $this->bcc =  $dataArray['bcc'];
      self::$debugger->belch("50 setValuesFromDataArray() this", $this, 0);
      // $this->referencedWorks is unaffected.
    }

    // summary display of referenced works for this email.
    public function displayReferencedWorks() {
      $displayText = '';
      $displayText .= "<table border='0' width='92%' class='bodyTextOnDarkGray' style='padding:4px 0px 8px 0px;'>\r\n";
      $displayText .= "<tr><td colspan='5' align='left'><div style='margin:0 0 4px 0;border-bottom:thin #999 solid'>Works referenced in this communique:</div></td>";
//      $displayText .= "<tr><td align='center'>Work Id</td><td align='center'>&nbsp;</td><td align='left'>Title</td><td align='center'>&nbsp;</td><td align='left'>Widget Id</td></tr>\r\n";
      $constStyle = "line-height:17px;margin:0;vertical-align:text-top;";
      self::$debugger->belch("AA displayReferencedWorks() this", $this, -1);
      foreach ($this->referencedWorks as $workArray) { 
        $displayText .= "<tr>";
        if ($this->commType == "MediaReceipt") $displayText .= 
           "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" . ((self::mediaReceivedFor($workArray)) ? "rec'd" : "") . "</td>";
        $displayText .= "<td align='left' style='" . $constStyle . "padding:0 0px 0 4px;'>" . $workArray['workId'] . "</td>";
        $displayText .= "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" . $workArray['designatedId'] . "</td>";

        if ($this->commType == "MediaReceipt") $displayText .= "<td align='left' style='" . $constStyle . "padding:0 0px 0 4px;'>" . $workArray['title'];
        else if ($this->commType == "AcceptReject") {
          $displayText .= "<td align='left' style='" . $constStyle . "font-style:italic;padding:0 0px 0 4px;'>" 
            . HTMLGen::clickableForDetailDisplay($workArray['workId'], $workArray['title'], $withEmailInfo=true) . "</td>";
          $displayText .= "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" 
             . HTMLGen::acceptanceDisplay($workArray['workId'], $workArray['accepted'], $workArray['rejected'], $workArray['acceptFor']) . "</td>";
        }
        $displayText .= "<td align='left' style='" . $constStyle . "padding:0 4px 0 4px;'>" . $workArray['arEmailWidgetId'] . "</td>";
        $displayText .= "</tr>\r\n";
        if ($workArray['workId'] == SSFRunTimeValues::getDefaultWorkId()) {
          $displayText .= ("<tr><td colspan='4' align='left' style='margin:0;padding:0 0px 0 4px;'><span style='color:yellow;'>^^^^</span>&nbsp;This is the default test entry.</td></tr>\r\n");
        }
      }
      $displayText .= "</table>\r\n";
      echo $displayText;
    }
    
    // Save this communique to the database.
    public function save($userId) {
      if ($this->commId() == 0) { $this->insertIntoDatabase($userId); } 
      else { $this->updateDatabase($userId); }
    }
    
    // Send this communique as an email. The communique will be saved or updated in the database appropriately.
    public function send($userId) { 
      // Save the communique.
      $this->save($userId);
      // Send the mail.
      if (!isset($this->bcc) || $this->bcc == '') $this->bcc = $this->from;
      $headers = "From: " . $this->from . "\r\n"
               . "Reply-To: " . $this->from . "\r\n"
               . "Bcc: " . $this->bcc . "\r\n"
               . "X-Mailer: PHP" . phpversion() . "\r\n"
               . "X-Apparently-To: " . $this->to;
      if (self::$TESTING) $mailedData = mail('snoopy@leserman.com', $this->subject, $this->message . "\r\n\r\n", $headers);
      else $mailedData = mail($this->to, $this->subject, $this->message . "\r\n\r\n", $headers);
      // Update the object and database sent and dateSent fields.
      $updateQuery = 'UPDATE communications set sent=1, dateSent=NOW() where communicationId=' . $this->commId;
      SSFDB::getDB()->saveData($updateQuery);
      //SSFDB::debugNextQuery();
      $getDateQuery = 'SELECT dateSent from communications where communicationId=' . $this->commId;
      $dateResult = SSFDB::getDB()->getArrayFromQuery($getDateQuery); 
      self::$debugger->belch('send() dateResult', $dateResult, -1);
      $this->dateSent =  (count($dateResult) > 0) ? $dateResult[0]['dateSent'] : date("Y-m-d H:i:s");
/* The fields works.artistInformedOfMediaReceipt and works.artistInformedOfMediaReceiptDate are no longer used.
      // Mark the referenced works in the works table to show that the artist was informed of media receipt.
//      $worksAffected = $this->referencedWorks; $worksWhereClause = ""; $disjunctionString = "";
//      foreach ($worksAffected as $work) { if (self::mediaReceivedFor($work)) { $worksWhereClause .= $disjunctionString . "workId = " . $work['workId']; $disjunctionString = " or "; }}
//      $query = "UPDATE works SET artistInformedOfMediaReceipt=1, artistInformedOfMediaReceiptDate=NOW()" . " WHERE " . $worksWhereClause;
//      SSFDB::getDB()->saveData($query);
*/
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
      $this->mrEmailWidgetId = '';
      $this->referencedWorks = array();
      $this->bcc = '';
      $this->suppress = false;
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
        default: self::$debugger->belch('INTERNAL ERROR. Bad commType in Communique::generateMessage. Tell David.', $this->commType, 1);
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

    // widgetId functions
    public static function computeEmailWidgetId($id) { return 'emailWidget-' . $id; }
    public static function extractIdFromEmailWidgetId($emailWidgetId) { $parts = explode('-', $emailWidgetId);  return $parts[1]; }
    public static function extractIdFunctionJSText() { return "function extractId(widgetId) {var parts=widgetId.split('-');return parts[1];}"; }
    public function mrEmailWidgetId() { return $this->mrEmailWidgetId; }
    private function setMrEmailWidgetId($id) { self::$debugger->bechoTrace('setMrEmailWidgetId()', $id, -1); $this->mrEmailWidgetId = $id; }
  
    // Sent/Saved boolean functions
    public function wasSaved() { $wasSaved = (($this->commId != 0) && ($this->commId != '')); return $wasSaved; }
    public function wasSent() { $sent = $this->sent(); self::$debugger->becho("51 sent", ($sent) ? 'SENT.' : 'NOT Sent.' , 1); return $sent; }
    public static function emailWasSent($dateSent) { return (($dateSent != 0) && ($dateSent != '') && ($dateSent != '0000-00-00') && ($dateSent != '0000-00-00 00:00:00')); }
    private function sent() { return (isset($this->dateSent) && ($this->dateSent != '') && ($this->dateSent != '0000-00-00 00:00:00') && ($this->dateSent != '0000-00-00')); }


// MediaReceipt Communique "subclass"

    private function newMediaReceivedMessageBody() {
      $worksReceived = array();
      $worksNotYetReceived = array();
      foreach ($this->referencedWorks as $referencedWork) {
        if (self::mediaReceivedFor($referencedWork)) $worksReceived[] = $referencedWork;
        else $worksNotYetReceived[] = $referencedWork;
      }      
      $remainingWorksCount = $worksCount = count($worksReceived);
      $entryString = 'NOTHING';
      if ($worksCount > 0) {
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
        $entryString = ($worksCount == 1) ? 'your entry' : 'your entries';
        $message .= $nextPhraseStart;
        $message .= 'look forward to viewing ' . $pieceString . ' as we curate the festival. ';
      } else {
        $message = "NOTICE TO ADMINISTRATOR:\r\nNo works have been received for which the artist has not already been notified.\r\n\r\n";
        $this->suppress = true;
      }
      if (count($worksNotYetReceived) > 0) { // We have not received all the submissions entered for this person.
        $message .= "\r\n\r\n" . 'We have not yet received '; // (or, at least not yet checked in) ';
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
      $message .= "\r\n";
      if (!$this->suppress) {
        $message .= "\r\nYou can expect to hear from us again sometime in July.";
        $message .= "\r\n\r\n" . 'Again, thanks for ' . $entryString . '.' . "\r\n";
      }
      return $message;
    }
  
    // Generates and returns a emailCommunique object.
    private function beMediaReceived($widgetId) {
      $this->commType = 'MediaReceipt';
      $this->from = 'info@sanssoucifest.org';
      $this->bcc = 'info@sanssoucifest.org';
      $this->subject = 'Sans Souci Festival of Dance Cinema - Media received';
      $this->setMrEmailWidgetId($widgetId);
      return $this;
    }

    public static function mrEmailWidgetMarkup($commId, $recipientId, $widgetId, $artistInformed) {
      $emailWidgetMarkup = ($artistInformed) 
                         ? self::mrEmailSentWidgetMarkup($commId, $recipientId, $widgetId) 
                         : self::mrEmailNotSentWidgetMarkup($commId, $recipientId, $widgetId);
      return $emailWidgetMarkup;
    }
    
    // coordinate changes with the javascript function mrEmailSentWidgetMarkupJS() returned by SSFCommunique::mrEmailSentWidgetMarkupJSText() 
    private static function mrEmailSentWidgetMarkup($commId, $recipientId, $widgetId) {
      $widgetIdInSingleQuotes = "'" . $widgetId . "'";
      // NOTE: return false on the next line prevents the current page from reloading. This would otherwise happen because the href="#".
      return '<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(' . $commId . ',' . $recipientId . ',' . $widgetIdInSingleQuotes . ');return false;"><img '
           . 'src="../../' . self::$mrEmailSentIconPic . '" alt="View email sent." title="View email sent." border="0" hspace="0" vspace="0"'
           . 'width="' . self::$mrEmailIconWidth . '" height="' . self::$mrEmailSentIconHeight . '" style="vertical-align:text-top;padding:0px 0 0 0px;"></a>';
    }

   // coordinate changes with the php function SSFCommunique::mrEmailSentWidgetMarkup()
    public static function mrEmailSentWidgetMarkupJSText() {
      $script = '<SCRIPT type="text/javascript">' . "\r\n";
      $script .= '//<!--' . "\r\n";
      $script .= '  // coordinate changes with the php function SSFCommunique::mrEmailSentWidgetMarkup()' . "\r\n";
      $script .= '  function mrEmailSentWidgetMarkupJS(commId, recipientId, widgetId) {' . "\r\n";
      $script .= '    widgetIdInSingleQuotes = "\'" + widgetId + "\'";' . "\r\n";
      $script .= '    text = \'<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(\' + commId + \',\' + recipientId + \',\' + widgetIdInSingleQuotes + \');return false;"><img \' + ' . "\r\n";
      $script .= '           \'src="../../' . self::$mrEmailSentIconPic . '" alt="View email sent." title="View email sent." border="0" hspace="0" vspace="0" \' + ' . "\r\n";
      $script .= '           \'width="' . self::$mrEmailIconWidth . '" height="' . self::$mrEmailSentIconHeight . '" style="vertical-align:text-top;padding:0px 0 0 0px;" ></a>\'; ' . "\r\n";
      $script .= '    return text;' . "\r\n";
      $script .= '  }' . "\r\n";
      $script .= '//-->' . "\r\n";
      $script .= '</SCRIPT>' . "\r\n";
      return $script;
    }

    private static function mrEmailNotSentWidgetMarkup($commId, $recipientId, $widgetId) {
      $widgetIdInSingleQuotes = "'" . $widgetId . "'";
      return '<a href="#" onClick="mrEmailTextWindow=openMediaReceiptTextWindow(' . $commId . ',' . $recipientId . ',' . $widgetIdInSingleQuotes . ');return false;"><img '
           . 'src="../../' . self::$mrEmailSendIconPic . '" title="Compose/Send Email." alt="Compose/Send Email." border="0" hspace="0" vspace="0" '
           . 'width="' . self::$mrEmailIconWidth . '" height="' . self::$mrEmailSendIconHeight . '" style="vertical-align:text-top;padding:0px 0 0 0px;"></a>';
    }
    
  
// AcceptReject Communique "subclass" 

    // based on generateAccRejEmail() in curationAccRejEmailText.php
    private function newAcceptRejectMessageBody($requestClipPermission=true, $inviteFeedbackRequest=false) {
      // TODO: Include clause in letter for live-performance.
      self::$debugger->belchTrace('newAcceptRejectMessageBody this->referencedWorks[0]', $this->referencedWorks[0], -1);
      $dataArray = $this->referencedWorks[0];
      $message = '';
      if ($dataArray['accepted']==1) {
        $msgPart = str_replace('<title>', $dataArray['title'], SSFRunTimeValues::getAcceptanceMessagePart1());
        $msgPart = str_replace('<br>', "\r\n\r\n", $msgPart);
        $message .= $msgPart;
        if ($requestClipPermission) {
          $msgPart = str_replace('<title>', $dataArray['title'], SSFRunTimeValues::getClipRequest());
          $msgPart = str_replace('<br>', "\r\n\r\n", $msgPart);
          $message .= $msgPart;
        }
        if (HTMLGen::stillImagesNeeded($dataArray['photoLocation'])) {
          $message .= str_replace('<br>', "\r\n\r\n", SSFRunTimeValues::getImageRequest());        
        }
        $message .= SSFRunTimeValues::getAcceptanceMessageClosing();
      } else if ($dataArray['rejected']==1) {
        $msgPart = str_replace('<title>', $dataArray['title'], SSFRunTimeValues::getRejectionMessagePart1());
        $msgPart = str_replace('<br>', "\r\n\r\n", $msgPart);
        $message .= $msgPart;
        if ($inviteFeedbackRequest) {          
          $message .= SSFRunTimeValues::getInviteFeedbackRequest();
        }
        $message .= str_replace('<br>', "\r\n\r\n", SSFRunTimeValues::getRejectionMessageClosing());
      }
      return $message;
    }

    private function beAcceptReject() {
      $this->commType = 'AcceptReject';
      $this->from = 'Curators@sanssoucifest.org';
      $this->bcc = 'Curators@sanssoucifest.org';
      $this->subject = 'Sans Souci Festival of Dance Cinema';
      return $this;
    }

    // coordinate changes with the javascript function arEmailSentWidgetMarkupJS(workId)
    private static function selectEntryAndArEmailSentWidgetMarkup($commId, $submitter, $workId, $dateSent) {
      $text = '<!--selectEntryAndArEmailSentWidgetMarkup-->'
            . '<a href="' . HTMLGen::curationEntryHREFText($workId) . '" target="' . HTMLGen::curationEntryAnchorTargetText() . '" ' 
            . 'onClick="' . self::arEmailWidgetOnClickText($commId, $submitter, $dateSent) . ';' . HTMLGen::curationEntryAnchorOnClickText($workId)
            . ';"><img ' . 'src="../' . self::$arEmailSentIconPic . '" alt="View email sent." title="View email sent." border="0" '
            . 'width="' . self::$arEmailIconWidth . '" height="' . self::$arEmailSentIconHeight . '" style="vertical-align:text-top;padding:0px 0 0 2px;"></a>';
      SSFDebug::globalDebugger()->bechoTrace('selectEntryAndArEmailSentWidgetMarkup text', $text, -1); // The $text is exactly right as of 7/20/10 22:00
      return $text;
    }

/*
    public static function selectEntryAndArEmailSentWidgetMarkupJSText() {
      $script = '<SCRIPT type="text/javascript">' . "\r\n";
      $script .= '//<!--' . "\r\n";
      $script .= self::extractIdFunctionJSText() . "\r\n";
      $script .= '// coordinate changes with the php function SSFCommunique::arEmailSentWidgetMarkup()' . "\r\n";
      $script .= 'function arEmailSentWidgetMarkupJS(workId, commId, recipientId, widgetId) {' . "\r\n";
      $script .= '  alert("arEmailSentWidgetMarkupJS() workId=" + workId + ", commId=" + commId + ", recipientId=" + recipientId + ", widgetId=" + widgetId);' . "\r\n";
//      $script .= '  text = \'<a href="' . HTMLGen::curationEntryHREFJSText(' extractId(widgetId) ') 
//      $script .= '  text = \'<a href="' . HTMLGen::curationEntryHREFJSText() 
      $script .= '  var hrefText = "curationEntry.php?callContext=curationEmail&workId=" + workId;' . "\r\n";
      $script .= '  var text = \'<a href="hrefText" target="' . HTMLGen::curationEntryAnchorTargetText() . "\"' + \r\n";
      $script .= '         \' onClick="' . self::arEmailWidgetOnClickJSText() . ";' + \r\n";
      $script .= '         \'' . HTMLGen::curationEntryAnchorOnClickJSText() . ";' + \r\n";
      $script .= '         \'">\' +' . "\r\n"; // deleted "return false;" as the last element in the onclick action list.
      $script .= '         \'<img src="../' . self::$arEmailSentIconPic . '" alt="View email sent." title="View email sent." border="0" \' +' . "\r\n";
      $script .= '         \'width="' . self::$arEmailIconWidth . '" height="' . self::$arEmailSentIconHeight 
                         . '" style="vertical-align:text-top;padding:0px 0 0 2px;"><\/a>\';' . "\r\n";
      $script .= '  return text;' . "\r\n";
      $script .= '  }' . "\r\n";
      $script .= '//-->' . "\r\n";
      $script .= '</SCRIPT>' . "\r\n";
      SSFDebug::globalDebugger()->bechoTrace('selectEntryAndArEmailSentWidgetMarkupJSText script', $script, -1);
      return $script;
    }
*/

    private static function selectEntryAndArEmailNotSentWidgetMarkup($commId, $submitter, $workId, $rejected) {
      $kindOf = ($rejected==1) ? ' rejection ' : ' acceptance ';
      $sendKind = 'alt="Send' . $kindOf . 'email." title="Send' . $kindOf . 'email." ';
      return '<!--selectEntryAndArEmailNotSentWidgetMarkup-->'
           . '<a href="' . HTMLGen::curationEntryHREFText($workId) . '" target="' . HTMLGen::curationEntryAnchorTargetText()
           . '" onClick="' . self::arEmailWidgetOnClickText($commId, $submitter) . ';' 
           . HTMLGen::curationEntryAnchorOnClickText($workId) . ';"><img '
           . 'src="../../' . self::$arEmailSendIconPic . '" ' . $sendKind . 'style="vertical-align:text-top;padding:0px 0 0 2px" '
           . ' width="' . self::$arEmailIconWidth . '" height="' . self::$arEmailSendIconHeight . '" align="top" border="0" ></a>';
    }

    public static function selectEntryForDetailDisplayWithEmailWidgetMarkup($workRow) {
      $accepted = $workRow['accepted'];
      $rejected = $workRow['rejected'];
      $commId = isset($workRow['communicationId']) ? $workRow['communicationId'] : 0;
      $dateSent = isset($workRow['dateSent']) ? $workRow['dateSent'] : 0;
      if (isset($workRow['communications.dateSent']) && $dateSent == 0) $dateSent = $workRow['communications.dateSent'];

      if ($workRow['workId'] == 670) SSFDebug::globalDebugger()->belchTrace('selectEntryForDetailDisplayWithEmailWidgetMarkup() workRow', $workRow, -1);
      
      $wasSent = self::emailWasSent($dateSent);
      $emailWidgetMarkup = '';
      if ((($accepted==1) && ($rejected!=1)) || (($accepted!=1) && ($rejected==1)))
        $emailWidgetMarkup = ($wasSent) 
                         ? self::selectEntryAndArEmailSentWidgetMarkup($commId, $workRow['personId'], $workRow['workId'], $dateSent) 
                         : self::selectEntryAndArEmailNotSentWidgetMarkup($commId, $workRow['personId'], $workRow['workId'], $rejected);
    return $emailWidgetMarkup;
    }

    public static function arEmailWidgetOnClickText($commId, $submitter, $dateSent=0) {
      if (self::emailWasSent($dateSent)) $submitter = 0;
      $onClick = "curationEmailTextWindow=openCurationEmailTextWindow(" . $commId . ", " . $submitter . ")";
      return $onClick;
    }

    public static function arEmailWidgetOnClickJSText() {
      return 'curationEmailTextWindow=openCurationEmailTextWindow(\' + commId + \', \' + recipientId + \')';
    }

    public static function arEmailWidgetAltTitle($dateSent, $accepted=0, $rejected=0) {
      $accepted = $workRow['accepted'];
      $emailWidgetAlt = '';
      if ($accepted != $workRow['rejected']) {
        $dateSent = isset($workRow['dateSent']) ? $workRow['dateSent'] : 0;
        $kindOf = ($accepted==1) ? ' acceptance ' :' rejection ';
        $emailWidgetAlt = (self::emailWasSent($dateSent)) ? "View email sent." : "Send' . $kindOf . 'email.";
      }
      return $emailWidgetAlt;
    }

  }
?>
