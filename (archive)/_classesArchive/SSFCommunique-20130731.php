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
    //alert('markArListItemSent\r\n  DOMid = |' + DOMid + '|\r\n  markup = |' + markup + '|');
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
//    may be lost or change on refreshs and reinitializations. *** Partially done 7/4/11 by removing the $adminUserId and $userId parameters 
//    in favor of calls to SSFAdmin::user() for both $adminUserId and $userId/sender.
// 4) <input type="hidden" id="bcc" name="bcc" value=""> gets lost on calls to initializeFromDatabase().


  class SSFCommunique {
    private static $TESTING = false;
    private static $debugWasSent = 0;
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
    private $sender = null;
    private $senderId = 0;
    private $to = '';
    private $from = '';
    private $subject = '';
    private $message = '';
    private $requestClipPermission;
    private $dbMessageCache = '';
    private $inResponseTo = 0;
    private $mrEmailWidgetId = '';
    private $potentiallyReferencedWorks = array();
    private $bcc = '';
    private $suppress;
//    private $saved = false;
    private $undecided = false;
    private $debug20120708 = -1;
    private $debug20120709 = -1;
    private static $debugStatuc20120708 = -1;
    // 7/26/13 - TODO If $worksForAltVenueButNotSoIndicatedOtherwise is ever used again, it should not me hard-coded.
    private static $worksForAltVenueButNotSoIndicatedOtherwise = array('13-011', '13-037', '13-046', '13-083');     
    private static $worksForWhichToRequestClipPermiission = array('13-046', '13-005', '13-037');     
     
    // Utility functions
    public function belch($idString, $doIt=0) { self::$debugger->belch('Communique::belch() ' . $idString, $this, $doIt); }
  
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
      $query = " SELECT name, personId, email, title, workId, designatedId, dateMediaPostmarked, dateMediaReceived,"
             . " communicationId, communications.type, dateSent"
             . " FROM people JOIN works ON submitter=personId"
             . " LEFT JOIN communicationWork ON workId=work"
             . " LEFT JOIN communications ON communication=communicationId AND communications.type = 'MediaReceipt'"
             . " WHERE callForEntries = " . SSFRunTimeValues::getCallForEntriesId() 
             . "   AND designatedId is not null AND designatedId != ''"
             . "   AND ((dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
             . "   OR (dateMediaPostmarked != '0000-00-00' and dateMediaPostmarked is not null and dateMediaPostmarked != ''))"
             . "   AND workId NOT IN "
             . "     (SELECT work FROM communicationWork JOIN communications on communication=communicationId"
             . "      WHERE communications.type = 'MediaReceipt'" 
             . "         AND (dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00'))"
             . " ORDER BY dateMediaPostmarked, designatedId, personId, workId";
      //SSFDB::debugOn();
      $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
      SSFDB::debugOff();
      SSFDebug::globalDebugger()->belch('getMediaReceiptEmailNeededRows() resultRows', $resultRows, -1);
      return $resultRows;
    }

   // Initialization functions
   
    public function initializeFromDatabase($commId, $dataArray) {
      //$this->beMediaReceived(); commented out 7/14/10
      self::$debugger->bechoTrace('initializeFromDatabase commId', $commId, -1); // $this->debug20120708
      //SSFDB::debugNextQuery();
      $commQueryString = "SELECT communicationId, recipient, dateSent, type, sender, emailTo, emailFrom, emailSubject, contentText, inResponseTo,"
                       . " personId, name, nickName, lastName "
                       . " FROM communications JOIN people on recipient=personId"
                       . " WHERE communicationId = " . $commId;
      $dataRecord = SSFDB::getDB()->getArrayFromQuery($commQueryString);
      self::$debugger->belch('initializeFromDatabase() dataRecord', $dataRecord, -1); // used 7/20/13
      $this->setValuesFromDataArray($dataRecord[0]);
//      $this->saved = true;
      $this->dbMessageCache = $this->message;
      if (isset($dataArray['bcc'])) $this->bcc = $dataArray['bcc']; // initialized separately because it's not stored in the database
      if (($this->commType == 'MediaReceipt') && isset($dataArray['widgetId'])) $this->setMrEmailWidgetId($dataArray['widgetId']); 
      $this->initializePotentiallyReferencedWorks($this->getPotentiallyReferencedWorksFromDB());
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
        default: self::$debugger->belch('INTERNAL ERROR. Bad commType in Communique::initialize ("' . $this->commType . '"). Tell David.', $this->commType, 1);
      }
      self::$debugger->becho('initialize personId', $personId, 0);
      $query = self::initializationQueryFor($type, $personId);
//    SSFDB::getDB()->debugOn();
      $dataArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace("initialize() dataArray", $dataArray, -1);
      if (count($dataArray) >= 1) {
        $this->setValuesFromDataArray($dataArray[0]);
        $this->initializePotentiallyReferencedWorks($this->findPotentiallyReferencedWorks());
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
    
    private static $worksSelectString = "SELECT title, workId, designatedId, submitter, accepted, rejected, acceptFor, dateMediaReceived, photoLocation, photoURL, includesLivePerformance"; // 7/10/13
    
    private function getPotentiallyReferencedWorksFromDB() {
      $query = self::$worksSelectString
             . " FROM communicationWork JOIN works on work=workId "
             . " WHERE communication=" . $this->commId;
      //SSFDB::getDB()->debugOn();
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace('getPotentiallyReferencedWorksFromDB() worksArray', $worksArray, -1);
      SSFDB::getDB()->debugOff();
      return $worksArray;
    }
    
    private function findPotentiallyReferencedWorks() {
      $query = self::$worksSelectString
             . " FROM people JOIN works on submitter=personId"
             . " WHERE submitter = " . $this->recipientId . " AND callForEntries = " . SSFRunTimeValues::getCallForEntriesId()
             . " AND withdrawn=0" // added 7/5/12
             . " AND workId NOT IN (" . self::selectWorksForWhichEmailWasAlreadySent($this->commType) . ")"
             . " ORDER BY titleForSort";
      //SSFDB::getDB()->debugOn();
      $worksArray = SSFDB::getDB()->getArrayFromQuery($query);
      self::$debugger->belchTrace('findPotentiallyReferencedWorks() worksArray', $worksArray, -1);
      SSFDB::getDB()->debugOff();
      return $worksArray;
    }

    public function restoreFromCache($dataArray) {
      $this->setValuesFromDataArray($dataArray);
      if ($this->sent()) {
        $this->initializePotentiallyReferencedWorks($this->getPotentiallyReferencedWorksFromDB());
      } else {
        $this->initializePotentiallyReferencedWorks($this->findPotentiallyReferencedWorks());
      }
    }
    
    private function initializePotentiallyReferencedWorks($worksArray) {
      $iteration = 0;
      foreach ($worksArray as $work) {
        $referencedWork = $work;
/*    These items are all subsumed by $referencedWork = $work
        $referencedWork['workId'] = $work['workId'];
        $referencedWork['designatedId'] = $work['designatedId'];
        $referencedWork['title'] = $work['title'];
        $referencedWork['accepted'] = $work['accepted'];
        $referencedWork['rejected'] = $work['rejected'];    
        $referencedWork['acceptFor'] = $work['acceptFor'];    
        $referencedWork['includesLivePerformance'] = $work['includesLivePerformance'];    
*/
        $dateMediaReceived = (isset($work['dateMediaReceived'])) ? $work['dateMediaReceived'] : '';
        $referencedWork['dateMediaReceived'] = $dateMediaReceived;
        $referencedWork['arEmailWidgetId'] = self::computeEmailWidgetId($referencedWork['workId']);
        $this->potentiallyReferencedWorks[$iteration] = $referencedWork;
        $iteration++;
      }
      self::$debugger->belchTrace('initializePotentiallyReferencedWorks this->potentiallyReferencedWorks', $this->potentiallyReferencedWorks, -1);
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
      self::$debugger->becho('mrMarkupEmailListOnSend script', $script, $this->debug20120709);
      echo $script;
    }
    
    // Call to change the icon and onClick behavior of the affected widgets in the list.
    public function arMarkupEmailListOnSend($reallyOnSave = false) {
      // Invoke javascript:markArListItemSent(updatedString) so that the button in the listing window has the new commId.
      $markArListItemSentText = "";
      $jsFunctionText = (($reallyOnSave) ? 'arEmailSavedWidgetMarkupJS' : 'arEmailSentWidgetMarkupJS');
      foreach ($this->potentiallyReferencedWorks as $referencedWork) {
        $markArListItemSentText .= 'markArListItemSent("' . $referencedWork['arEmailWidgetId'] 
          . '", ' . $jsFunctionText . '(' . $referencedWork['workId'] . ', ' . $this->commId() . ', ' . $this->recipientId() . ', "' . $referencedWork['arEmailWidgetId'] . '"));';
      }
//      $script = "<script type='text/javascript'>eval('alert(\'echoing script from arMarkupEmailListOnSend\');" . $markArListItemSentText . "');</script>\r\n";
      $script = "<script type='text/javascript'>eval('" . $markArListItemSentText . "');</script>\r\n";
      self::$debugger->becho('arMarkupEmailListOnSend script eval', $markArListItemSentText, -1); // $this->debug20120709
      echo $script;
    }
    
    public function markupEmailListOnSend($reallyOnSave = false) {
      self::$debugger->belchTrace('Communique::markupEmailListOnSend', $this, -1);
      switch ($this->commType) {
        case 'AcceptReject': $this->arMarkupEmailListOnSend($reallyOnSave); break;
        case 'MediaReceipt': $this->mrMarkupEmailListOnSend(); break;
        default: self::$debugger->belch('INTERNAL ERROR. Bad commType in Communique::markupEmailListOnSend. Tell David.', $this->commType, 1);
      }
    }

    public function markupEmailListOnSave() {
      self::$debugger->becho('markupEmailListOnSave()', 'CALLED', $this->debug20120709);
      $reallyOnSave = true;
      $this->markupEmailListOnSend($reallyOnSave);
    }

    // Save to database functions
    
    // Inserts an new communication in the database and returns $communicationId
    public function insertIntoDatabase($adminUserId_Parameter_DO_NOT_USE=0) {
      $adminUserId = SSFAdmin::user()->id();
      self::$debugger->becho('SSFCommunique::insertIntoDatabase userId', $adminUserId, -1);
      $this->belch('30', 0);
      if (count($this->potentiallyReferencedWorks) > 0) {
        $referencedWork = $this->potentiallyReferencedWorks[0]['workId'];
        // Insert this communique into the communcations table.
        $commInsertString = "INSERT INTO communications (recipient, template, sent, dateSent, type, sender, referencedWork, contentText, "
                           . "contentFormatted, applicationToOpenFormattedText, physicalOrEmailOrVoice, inResponseTo, notes, "
                           . "emailTo, emailFrom, emailSubject, "
                           . "lastModificationDate, lastModifiedBy, contentLastModDate, contentLastModifiedBy, creationDate, createdBy) "
                           . "VALUES (" . $this->recipientId  . ", NULL, " . (($this->sent()) ? 1 : 0) . ", NULL, '" . $this->commType . "', " 
                           . $adminUserId . ", " . $referencedWork . ", " 
                           . SSFQuery::quote($this->message) . ", NULL, NULL, 'Email', NULL, NULL, " 
                           . SSFQuery::quote($this->to) . ", "
                           . SSFQuery::quote($this->from) . ", " 
                           . SSFQuery::quote($this->subject()) . ", '" . SSFRunTimeValues::nowForDB() . "', " 
                           . $adminUserId . ", '" . SSFRunTimeValues::nowForDB() . "', " . $adminUserId . ", '" . SSFRunTimeValues::nowForDB() . "', " . $adminUserId . ")";
        //SSFDB::debugNextQuery();
        // TODO The next two calls to SSFDB::getDB()->saveData() should be an atomic indivisible operation.
        SSFDB::getDB()->saveData($commInsertString);
        $this->setDbMessageCache();
        $this->commId = SSFDB::getDB()->insertedId(); 
        self::$debugger->becho("37 commId", $this->commId, 0);
        // Make the corresponding DB entries in the communicationWork table.
        $valuesClause = "";
        $separator = "";
        foreach ($this->potentiallyReferencedWorks as $work) {
          // TODO Figure out why the test self::mediaReceivedFor($work) was here and if it's still needed.
          if (true || self::mediaReceivedFor($work)) { 
            $valuesClause .= $separator . "(" . $this->commId . ", " . $work['workId'] . ")";
            $separator = ", ";
          }
        }
        if ($valuesClause == "") self::$debugger->bechoTrace('INTERNAL ERROR: insertIntoDatabase valuesClause is empty. Tell David.', $adminUserId, 1);
        $query = "INSERT INTO communicationWork (communication, work) VALUES " . $valuesClause;
        SSFDB::getDB()->saveData($query);
        $this->setDbMessageCache();
      }
      return $this->commId;
    }

    public function updateDatabase($adminUserId_Parameter_DO_NOT_USE=0) {
      $adminUserId = SSFAdmin::user()->id();
      self::$debugger->becho('updateDatabase userId', $adminUserId, -1);
      $commUpdateString = "UPDATE communications set contentText = " 
                                . SSFQuery::quote($this->message)
                                . ", sent = " . (($this->sent()) ? 1 : 0)
                                . ", sender = " . $adminUserId        // line added 7/20/13 so that the sender is updated in the DB
                                . ", emailTo = " . SSFQuery::quote($this->to)
                                . ", emailFrom = " . SSFQuery::quote($this->from)
                                . ", emailSubject = " . SSFQuery::quote($this->subject())
                                . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminUserId 
                                . ", contentLastModDate = '" . SSFRunTimeValues::nowForDB() . "', contentLastModifiedBy = " . $adminUserId 
                                . " WHERE communicationId = " . $this->commId . "";
      SSFDB::getDB()->saveData($commUpdateString);
      $this->setDbMessageCache();
    }

    // HTML generation
    public function displayAsHiddenInputFields() {
      echo '<input type="hidden" id="commId" name="commId" value=' . $this->commId . '>' . "\r\n";
      echo '<input type="hidden" id="recipientId" name="recipientId" value=' . $this->recipientId . '>' . "\r\n";
      echo '<input type="hidden" id="recipientName" name="recipientName" value="' . $this->recipientName . '">' . "\r\n";
      echo '<input type="hidden" id="dateSent" name="dateSent" value="' . $this->dateSent . '">' . "\r\n";
      echo '<input type="hidden" id="type" name="type" value="' . $this->commType . '">' . "\r\n";
      echo '<input type="hidden" id="senderId" name="senderId" value=' . $this->sender->id() . '>' . "\r\n";
      echo '<input type="hidden" id="to" name="to" value="' . $this->to() . '">' . "\r\n";
      echo '<input type="hidden" id="from" name="from" value="' . $this->from . '">' . "\r\n";
      echo '<input type="hidden" id="emailSubject" name="emailSubject" value="' . $this->subject() . '">' . "\r\n";
      echo '<input type="hidden" id="inResponseTo" name="inResponseTo" value=' . $this->inResponseTo . '>' . "\r\n";
      echo '<input type="hidden" id="emailWidgetId" name="emailWidgetId" value=' . $this->mrEmailWidgetId() . '>' . "\r\n";
      echo '<input type="hidden" id="bcc" name="bcc" value="' . $this->bcc . '">' . "\r\n";
      echo '<input type="hidden" id="emailSaved" name="emailSaved" value=' . (($this->wasSaved()) ? 1 : 0) . '>' . "\r\n";
      echo '<input type="hidden" id="emailUndecided" name="emailUndecided" value=' . (($this->undecided) ? 1 : 0) . '>' . "\r\n";
      echo '<input type="hidden" id="contentText" name="contentText" value="' . htmlspecialchars($this->message) . '">' . "\r\n";
      echo '<div style="display:none;" id="dbMessageCache">' . $this->dbMessageCache . '</div>' . "\r\n";
      echo '<div style="display:none;" id="freshlyGeneratedMessageCache">' . $this->generateMessage() . '</div>' . "\r\n";
      // Cache $requestClipPermission which is set in newAcceptRejectMessageBody() and used in send(). 7/29/13
      echo '<div style="display:none;" id="requestClipPermission">' . $this->requestClipPermission . '</div>' . "\r\n"; 
      
    }

    // Singleton pattern support.
    public static function instance($adminUserId_Parameter_DO_NOT_USE=0) {
      $adminUserId = SSFAdmin::user()->id();
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
    public function subject() { 
      $text = $this->subject; 
      $tstPrefixExists = stripos($text, 'TEST ');
      SSFDebug::globalDebugger()->belch('subject() tstPrefixExists', ($tstPrefixExists !== false) ? $tstPrefixExists : 'false', -1);
      if (self::$TESTING && ($tstPrefixExists === false || $tstPrefixExists != 0)) $text = 'TEST ' . $text;  
      return $text; 
    }
    public function commId() { return $this->commId; }
    public function recipientId() { return $this->recipientId; }
    public function suppress() { return $this->suppress; }
//    public function workId() { return $this->potentiallyReferencedWorks[0]['workId']; }
    
    // One line "setters"
    public function setFrom($from) { $this->from = $from; }
    public function setTo($to) { $this->to = $to; }
    public function setMessage($message) { $this->message = $message; }
    public function setDbMessageCache() { $this->dbMessageCache = $this->message; }

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
      $this->senderId = (isset($dataArray['sender']) ? $dataArray['sender'] : 0);
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
      // $this->potentiallyReferencedWorks is unaffected.
    }
    
    private static function displayWorkIds($constStyle, $workArray) {
      return "<td align='left' width='30%' style='" . $constStyle . "padding:0 0px 0 4px;'>" . $workArray['designatedId'] 
                                                   . "&nbsp;&nbsp;<span class='idDisplayText'>" . $workArray['workId'] . "</span>";    
    }

    // summary display of referenced works for this email.
    public function displayPotentiallyReferencedWorks() {
      $displayText = '';
      $displayText .= "<table border='0' width='92%' class='bodyTextOnDarkGray' style='padding:4px 0px 8px 0px;'>\r\n";
      $displayText .= "<tr><td colspan='5' align='left'><div style='margin:0 0 4px 0;border-bottom:thin #999 solid'>Works referenced in this communique:</div></td>";
//      $displayText .= "<tr><td align='center'>Work Id</td><td align='center'>&nbsp;</td><td align='left'>Title</td><td align='center'>&nbsp;</td><td align='left'>Widget Id</td></tr>\r\n";
      $constStyle = "line-height:17px;margin:0;vertical-align:text-top;";
      self::$debugger->belch("AA displayPotentiallyReferencedWorks() this", $this, -1);
      foreach ($this->potentiallyReferencedWorks as $workArray) { 
        $displayText .= "<tr>";
        if ($this->commType == "MediaReceipt") { 
          $displayText .= "<td align='center' style='" . $constStyle . "padding:0 4px 0 4px;'>" . ((self::mediaReceivedFor($workArray)) ? "rec'd" : "") . "</td>";
          $displayText .= self::displayWorkIds($constStyle, $workArray) . "</td>";
          $displayText .= "<td align='left' style='" . $constStyle . "padding:0 0px 0 4px;'>&nbsp;" . $workArray['title'];

        } else if ($this->commType == "AcceptReject") { 
          $displayText .= self::displayWorkIds($constStyle, $workArray);
          $displayText .= "&nbsp;&nbsp;" 
                       . HTMLGen::acceptanceDisplay($workArray['workId'], $workArray['accepted'], $workArray['rejected'], $workArray['acceptFor'])
                       . "&nbsp" . "</td>";
          $clickableMarkup = HTMLGen::clickableForDetailDisplay($workArray, $workArray['title'], $withEmailInfo=true, $forReferencedWork=true);
          $liveString = ($workArray['includesLivePerformance'] == 1) ? "<span class='liveDisplayText' style='font-style:normal;font-weight:bold;'>LIVE</span>&nbsp;&nbsp;" : "";
          $displayText .= "<td align='left' style='" . $constStyle . "font-style:italic;padding:0 0px 0 4px;'>" . $liveString . $clickableMarkup . "</td>";
        }
        $displayText .= "</tr>\r\n";
        if ($workArray['workId'] == SSFRunTimeValues::getDefaultWorkId()) {
          $displayText .= ("<tr><td colspan='4' align='left' style='margin:0;padding:0 0px 0 4px;'><span style='color:yellow;'>^^^^</span>&nbsp;This is the default test entry.</td></tr>\r\n");
        }
      }
      $displayText .= "</table>\r\n";
      echo $displayText;
    }
    
    // Save this communique to the database.
    public function save($userId_Parameter_DO_NOT_USE=0) {
      $userId = SSFAdmin::user()->id();
      if ($this->commId() == 0) { $this->insertIntoDatabase($userId); } 
      else { $this->updateDatabase($userId); }
    }

    // Assumes that the curation acceptance email requests clip-for-demoreel permissions for every accepted work.
    private function storePermissionRequests($userId_Parameter_DO_NOT_USE=0) {
      // TODO: When the user has an option to omit some works, use only those works, not $this->potentiallyReferencedWorks.
      // TODO: Parse message text to confirm that the deom-reel permission was actually requested.
      $userId = SSFAdmin::user()->id();
      foreach($this->potentiallyReferencedWorks as $work) {
        if (self::computedRequestForClipPermissionFor($work)) {
          // 7/20/13 - dateGenerated removed from this query because elsewhere the code now properly references the communications.dateSent for the associated record. 
          // Previously dateGenerated was inserted with the value $this->dateSent
          $insertQuery = "INSERT INTO `sanssouci`.`permissionRequest` "
                       . "(event, permissionType, requestComm, work, lastModificationDate, lastModifiedBy) "
                       . "VALUES (" . SSFRunTimeValues::getCallForEntriesId() . ", 'DemoReelClip', " . $this->commId 
                       . ", " . $work['workId'] . ", '" . SSFRunTimeValues::nowForDB() . "', " . $userId . ")";
          //SSFDB::debugNextQuery(); 
          SSFDB::getDB()->saveData($insertQuery);
        }
      }
    }

    // Send this communique as an email. The communique will be saved or updated in the database appropriately.
    public function send($userId_Parameter_DO_NOT_USE=0) { 
      $userId = SSFAdmin::user()->id();
      // Save the communique.
      $this->save($userId);
      // Send the mail.
      if (!isset($this->bcc) || $this->bcc == '') $this->bcc = $this->from;
      $headers = "From: " . $this->from . "\r\n"
               . "Reply-To: " . $this->from . "\r\n"
               . "Bcc: " . $this->bcc . "\r\n"
               . "X-Mailer: PHP" . phpversion() . "\r\n"
               . "X-Apparently-To: " . $this->to;
      if (self::$TESTING) $mailedData = mail('snoopy@leserman.com', $this->subject(), $this->message . "\r\n\r\n", $headers);
      else $mailedData = mail($this->to, $this->subject(), $this->message . "\r\n\r\n", $headers);
      // Update the object and database sent and dateSent fields.
      $updateQuery = 'UPDATE communications set sent=1, dateSent="' . SSFRunTimeValues::nowForDB() . '" where communicationId=' . $this->commId;
      SSFDB::getDB()->saveData($updateQuery);
      $this->setDbMessageCache();
      //SSFDB::debugNextQuery();
      $getDateQuery = 'SELECT dateSent from communications where communicationId=' . $this->commId;
      $dateResult = SSFDB::getDB()->getArrayFromQuery($getDateQuery); 
      self::$debugger->belch('send() dateResult', $dateResult, -1);
      $this->dateSent =  (count($dateResult) > 0) ? $dateResult[0]['dateSent'] : date("Y-m-d H:i:s");
      // Assume that the curation acceptance email requests clip-for-demoreel permissions for every accepted work.
      if ($this->commType == 'AcceptReject') $this->storePermissionRequests($userId);
/* The fields works.artistInformedOfMediaReceipt and works.artistInformedOfMediaReceiptDate are no longer used.
      // Mark the referenced works in the works table to show that the artist was informed of media receipt.
//      $worksAffected = $this->potentiallyReferencedWorks; $worksWhereClause = ""; $disjunctionString = "";
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
//      $this->sender = isset($args[0]) ? $args[0] : 0; // NOW INGNORING userId parameter.
      $this->sender = SSFAdmin::user();
      $this->senderId = SSFAdmin::user()->id();
      $this->to = '';
      $this->from = '';
      $this->subject = '';
      $this->message = '';
      $this->inResponseTo = 0;
      $this->mrEmailWidgetId = '';
      $this->potentiallyReferencedWorks = array();
      $this->bcc = '';
      $this->suppress = false;
//      $this->saved = false;
      $this->undecided = false;
      // TODO Hack Alert! Initialization of a class variables inside the constructor.
//      self::$adminUserId = isset($args[0]) ? $args[0] : 0; // NOW INGNORING userId parameter.
      self::$adminUserId = SSFAdmin::user()->id();
      if (is_null(self::$debugger)) {
        self::$debugger = new SSFDebug();
        self::$debugger->enableBelch(false);
        self::$debugger->enableBecho(false);
      }
    }

    // widgetId functions
    // TODO: computeEmailWidgetId() should be an HTMLGen fn, not a SSFCommunique fn.
    //       How about these other widgetId functions
    public static function computeEmailWidgetId($id) { 
      if ($id=='735') SSFDebug::globalDebugger()->bechoTrace('computeEmailWidgetId', $id, -1); 
      return 'emailWidget-' . $id; 
    }
    public static function extractIdFromEmailWidgetId($emailWidgetId) { $parts = explode('-', $emailWidgetId);  return $parts[1]; }
    public static function extractIdFunctionJSText() { return "function extractId(widgetId) {var parts=widgetId.split('-');return parts[1];}"; }
    public function mrEmailWidgetId() { return $this->mrEmailWidgetId; }
    private function setMrEmailWidgetId($id) { self::$debugger->bechoTrace('setMrEmailWidgetId()', $id, -1); $this->mrEmailWidgetId = $id; }
  
    // Sent/Saved boolean functions
    public function wasSaved() { $wasSaved = (($this->commId != 0) && ($this->commId != '')); return $wasSaved; }
    public function isUndecided() { return $this->undecided; }
    public function wasSent() { $sent = $this->sent(); self::$debugger->becho("51 sent", ($sent) ? 'SENT.' : 'NOT Sent.' , self::$debugWasSent); return $sent; }
    public static function emailWasSent($dateSent) { return (($dateSent != 0) && ($dateSent != '') && ($dateSent != '0000-00-00') && ($dateSent != '0000-00-00 00:00:00')); }
    private function sent() { return (isset($this->dateSent) && ($this->dateSent != '') && ($this->dateSent != '0000-00-00 00:00:00') && ($this->dateSent != '0000-00-00')); }

    
    // message generation
    public function messageSalutation() { return "Dear " . $this->recipientName . ",\r\n\r\n"; }
    
    public function messageClosing() {
      $closing = '';
      $user = SSFAdmin::user();
      self::$debugger->belch('SSFCommunique::messageClosing userId', $user, -1); // line added 7/20/13
      $closing .= $user->valediction() . "\r\n\r\n";
      $closing .= $user->name() . "\r\n";
      $closing .= $user->title() . "\r\n";
      $closing .= 'Sans Souci Festival of Dance Cinema' . "\r\n";
      //$closing .= $user->email() . "\r\n";
      $closing .= 'http://sanssoucifest.org';
      return $closing;
    }
    
    public function regenerateMessage() { 
      $this->message = $this->generateMessage(); 
      return $this->message; 
    }
  
    private function generateMessage() {
      $message = '';
      switch ($this->commType) {
        case 'AcceptReject': $message = $this->newAcceptRejectMessageBody(); break; // Assigned directly into $this->message prior to 7/20/13
        case 'MediaReceipt': $message = $this->newMediaReceivedMessageBody(); break; // Assigned directly into $this->message prior to 7/20/13
        default: self::$debugger->belchTrace("\r\n\r\n" . 'INTERNAL ERROR. Bad commType ("' . $this->commType . '") in Communique::generateMessage. Tell David.' . "\r\n\r\n", $this->commType, 1);
      }
      return $message;
    }


// MediaReceipt Communique "subclass"

    private function newMediaReceivedMessageBody() {
      $worksReceived = array();
      $worksNotYetReceived = array();
      foreach ($this->potentiallyReferencedWorks as $referencedWork) {
        if (self::mediaReceivedFor($referencedWork)) $worksReceived[] = $referencedWork;
        else $worksNotYetReceived[] = $referencedWork;
      }      
      $remainingWorksCount = $worksCount = count($worksReceived);
      $entryString = 'NOTHING';
      if ($worksCount > 0) {
        $message = $this->messageSalutation();
        $message .= 'Thank you very much for your submission';
        $message .= ($worksCount > 1) ? 's ' : ' ';
        $year = SSFRunTimeValues::getCurrentYearString();                                         // 5/21/13 added ", still images, and entry fee"
        $message .= 'to the ' . $year . ' Sans Souci Festival of Dance Cinema. We have received the media, EDITMEHERE still images, and entry fee' . (($worksCount > 1) ? 's' : '') . ' for '; 
        foreach ($worksReceived as $referencedWork) {
          $remainingWorksCount--;
//          $terminator = ($remainingWorksCount == 0  && $worksCount > 1) ? '.' : ''; 5/31/13
          $terminator = ($remainingWorksCount == 0) ? '.' : '';
          $punctuation = ($remainingWorksCount > 0 && $worksCount > 2) ? ',' : $terminator;
          $message .= '"' . $referencedWork['title'] . $punctuation . '"';
          $conjunction = ($remainingWorksCount == 1) ? ' and ' : ' ';
          $message .= $conjunction;
        }
        $nextPhraseStart = ($remainingWorksCount == 0 && $worksCount > 1) ? 'We ' : 'and we ';
        $nextPhraseStart = 'We '; // 5/21/2013 HACK to make this two sentences.
        $pieceString = ($worksCount == 1) ? 'it' : 'them'; //  alternately:  ? 'this piece' : 'these pieces';
        $entryString = ($worksCount == 1) ? 'your entry' : 'your entries';
        $message .= $nextPhraseStart;
        $message .= 'look forward to viewing ' . $pieceString . ' as we curate the festival. ' . "\r\n\r\n";
        $whenYouCanHearFromUsAgain = SSFRunTimeValues::getMrMsgWhenYouCanHearFromUsAgain();
        $message .= "You can expect to hear from us again " . $whenYouCanHearFromUsAgain . ".";
        $message .= "\r\n\r\n" . 'Again, thanks for ' . $entryString . '.' . "\r\n\r\n";
        $message .= $this->messageClosing();
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
//        $whenYouCanHearFromUsAgain = 'sometime in July';
//        $message .= "\r\nYou can expect to hear from us again " . $whenYouCanHearFromUsAgain . ".";
//        $message .= "\r\n\r\n" . 'Again, thanks for ' . $entryString . '.' . "\r\n";
      }
      return $message;
    }
  
    // Generates and returns a emailCommunique object.
    private function beMediaReceived($widgetId) {
      $this->commType = 'MediaReceipt';
      $this->from = SSFAdmin::user()->email();  // 'hamelb@sanssoucifest.org';  // 'info@sanssoucifest.org';
      $this->bcc = SSFAdmin::user()->email();  // 'hamelb@sanssoucifest.org';  // 'info@sanssoucifest.org';
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

    // 2010 Curation Email Messages
    
    // These message parts are arranged, more or less, in order of their use in the email.
    // <br> will be replaced by a line feed and carriage return.
    // Other text in angle brackets, e.g., <film>, is conditionally replaced in the procedural code.
    
    public function venueTitle() { return SSFRunTimeValues::getVenueTitle(); }
    //return "Seventh Annual Sans Souci Festival of Dance Cinema"; }
    
    public function acceptanceMessagePart1a() {
      $part = "Congratulations! It will be our pleasure to <screen> your <film>, <title>"
            . " <at our> " . $this->venueTitle() . ".";
      return $part;
      }
    
    public function acceptanceMessagePart1b() {
      $part = " Thank you so much for your <submission>.<br><br>";
      return $part;
      }
    
    private function rejectionWithinAcceptanceMessage() { return SSFRunTimeValues::getRejectionWithinAcceptanceMessage(); }
    /*
      $part = "Regrettably, we will be not presenting <title> as part of our festival this year. We had a large number of excellent"
            . " entries and we had to make some very hard decisions.<br><br>";
      return $part;
    }
    */
    
    public function plugTheShow() { return SSFRunTimeValues::getPlugTheShowPart(); }
    /*
      $plug = "<We'll> be presenting works from all over the world"
            . " and we're excited to offer our most substantive program to date."
            . " We'll have two evenings of dance cinema shorts, including a live multi-media dance performance,"
            . " and installations to peruse prior to the screenings."
            . " Additionally, on Saturday, we'll have documentary screenings and a scholarly paper panel.<br><br>"
            . "The Festival will be held on Friday and Saturday, September 10 and 11, 2010, in the Black Box Theatre of"
            . " the Atlas Building at the University of Colorado at Boulder, Boulder, Colorado, USA (directions below)."
            . " Our Sans Souci team looks forward to seeing you there<if you're able to come>.<br><br>";
      return $plug;
    }
    */

    // Alternatives for acceptanceMessagePart2:
    
    //  "You'll be on our list for 2 complementary admissions which you can use to come both evenings"
    //            . " or to bring a friend - just give your name at the door when you arrive at the theater."
    //            . " (Please arrive a bit early to claim your seat.)            
    
    // Let us know if you're coming at least 10 days before the show and we'll hold two tickets for you - either 
    // one each night or two for one night. Just write to tickets@sanssoucifest.org and tell us which night(s). 
    // Then, arrive a bit early to claim your seat - we expect a sold-out show.
    
    // Synonyms with slightly different meanings: "screen," "present," "exhibit."

    public function acceptanceMessagePart2() { return SSFRunTimeValues::getAcceptanceMessagePart2(); }
    /*
      $part = "If you let us know you're coming at least 10 days before the show, we'll hold two tickets for you -"
            . " either one for each night or two for one night. Just write to tickets@sanssoucifest.org and tell us"
            . " which night(s). Then, arrive a bit early to claim your seat - we expect a sold-out show."
            . " <br><br>We'll publish the run of the show by late August at http://sanssoucifest.org/programPages/programAtlas2010.php"
            . " so you can see which day your work will be exhibited.<br><br>";
      return $part;
    }
    */

    public function clipRequest() {
      $request = "CLIP REQUEST: As part of our promotional effort we periodically create a sample video of short clips (about 30 seconds)"
               . " from pieces that we present."
               . " For an example, see our demo reel at http://sanssoucifest.org/demoreel."
               . " Please reply to this email to permit or deny us use of <clip> from <title> for this purpose.<br><br>";
      return $request;
    }
    
    public function imageRequest() {
      $request = "IMAGE REQUEST: We display a representative image of each piece we screen on our web site and in our program."
               . " If you would, please send us images for <title> Details are below.<br><br>";
      return $request;
    }
    
    public function acceptanceMessageClosing() {
      $closing = "Again, congratulations and thank you for making such compelling work. We look forward to seeing more of your work in the future.<br><br>";
      return $closing;
    }
      
    private function rejectionMessagePart1() {
      $part = "Thank you for submitting your <film>, <title> to the Sans Souci Festival of Dance Cinema.<br><br>";
      return $part;
    }
    
    private function rejectionMessagePart2() { return SSFRunTimeValues::getRejectionMessagePart2(); }
    /*
      $part = "Regrettably we will be not presenting <title> as part of our festival this year. We had a large number of excellent"
            . " entries from all of over the world, so we had to make some very hard decisions.<br><br>";
      return $part;
    }
    */
    
    public function inviteFeedbackRequest() { return SSFRunTimeValues::getInviteFeedbackRequest(); } // Unused as of 7/24/10
    /*
      $invite = " If you would like specific feedback from our curators, please contact me and we'll gladly share our insights."
              . " I hope to see more of your work in the future.<br><br>";
      return $invite;
    }
    */
    
    private function rejectionMessageClosing() {
      $closing = "Again, thank you for your <submission> and your interest in the Sans Souci Festival of Dance Cinema.<br><br>"
               . "Very best to you and your work.<br><br>";
      return $closing;
    }
    
    private function imageDetailPart() { return SSFRunTimeValues::getImageDetailPart(); }
    /*
      $part = "The boring details regarding submitting images:<br>"
           . "Please send electronic images of photos or screen captures of your film(s) to images@sanssoucifest.org."
           . " We will choose one image to represent each work on the website and in the printed program."
           . " You may send the actual images or, preferably, web links to them."
           . " If you send links, be sure to send web addresses (URLs) that link directly to the images of interest."
           . " We will assume that the images you send are screen captures unless you specify a photo credit for the image."
           . " Pixel dimensions for screen captures should be the same as the screen size (in pixels), but properly adjusted" 
           . " so each image renders in the appropriate aspect ratio with square pixels."
           . " Production photos should also be roughly the same size.";
      return $part;
    }
    */

    private function venueDirections() { return SSFRunTimeValues::getVenueDirectionsPart(); }
    /*
      $directions = "Directions to the Atlas Building:<br>"
                  . "For directions to the Atlas Building see http://www.colorado.edu/atlas/newatlas/about/directions.html."
                  . " If you're a stranger to these parts, we suggest you use the Euclid AutoPark for on-campus parking."
                  . " Go to http://www.colorado.edu/parking/maps/ for various campus parking maps.";
      return $directions;
    }
    */
    
    private function installationExplanation() { return SSFRunTimeValues::getInstallationExplanationPart(); }
    /*
      $explanation = "About Our Installation Exhibit:<br>"
                   . "Works selected as \"installations\" will play in loops on monitors and surfaces in the lobby areas"
                   . " before and after the screenings and during intermissions";
      return $explanation;
    }
    */
    
    private function altVenueExplanation() { // TODO - 7/26/13 - This should probably not be hard-coded.
      $explanation = "About Our Alternate Venues:<br>"
                   . "We received more works worthy of screening than there is time for at our main event."
                   . " So, we're adding additional screening dates."
                   . " <title> will be screened at either" 
                   . " the Boulder Public Library or"
                   . " at the Boedecker Theater at the Dairy Center for the Arts in Boulder"
                   . " in the colder months of 2013-2014; exact dates to be announced (and you'll be informed)."
                   . "<br>http://bplnow.boulderlibrary.org/event/movies" 
                   . "<br>http://www.thedairy.org/boedecker-theater2/";
      return $explanation;
    }
    
    private static function computedRequestForClipPermissionFor($work) {
      $requestClipPermission = false;
      $workAccepted = ($work['accepted'] == 1);
      if ($workAccepted) {
        $requestClipPermission = true;
        if (SSFRunTimeValues::getCallForEntriesId() == 13) { // 2013 call
          if (!in_array($work['designatedId'], self::$worksForWhichToRequestClipPermiission) &&
              ($work['acceptFor'] != 'screening')) $requestClipPermission = false;
        }
      }
      return $requestClipPermission;
    }
    
    // Returns a string that is the list of $titles input. 
    // $titles must be an array of length 1 to 4. $conjunction is 'and' or 'or'. $terminatingPunctuation is typically '.' or ',' or omitted.
    private static function generateTitleString($titles, $conjunction, $terminatingPunctuation='') {
      switch (count($titles)) {
        case 0: $titleString = "INTERNAL ERROR. There are no titles in this group. Tell David."; break;
        case 1: $titleString = '"' .                                                                                        $titles[0] . $terminatingPunctuation . '"'; break;
        case 2: $titleString = '"' .                                             $titles[0] .  '" ' . $conjunction . ' "' . $titles[1] . $terminatingPunctuation . '"'; break;
        case 3: $titleString = '"' .                       $titles[0] . '," "' . $titles[1] . '," ' . $conjunction . ' "' . $titles[2] . $terminatingPunctuation . '"'; break;
        case 4: $titleString = '"' . $titles[0] . '," "' . $titles[1] . '," "' . $titles[2] . '," ' . $conjunction . ' "' . $titles[3] . $terminatingPunctuation . '"'; break;
        default: self::$debugger->belch('INTERNAL ERROR. This letter has more than 4 titles in a group. Tell David.', $this->commType, 1);
      }
      return $titleString;
    }

    // Returns 'work' or 'works' or 'film' or 'films'
    private function replaceTheWordFilm($useTheWordWork, $referencedWorkCount) {
      $filmReplacementWord = ($useTheWordWork) ? 'work' : 'film';
      if ($referencedWorkCount > 1) $filmReplacementWord .= 's';
      return $filmReplacementWord;
    }
    
    // based on generateAccRejEmail() in curationAccRejEmailText.php
    private function newAcceptRejectMessageBody($inviteFeedbackRequest=false) {    
      SSFDebug::globalDebugger()->belch('this->potentiallyReferencedWorks', $this->potentiallyReferencedWorks, -1); // 7/20/13
      // Count the referenced works by category and form a list of titles for each category.
      $totalNumberOfWorks = 0;                  $allWorksTitles = array();
      $numberOfWorksToScreen = 0;               $screenWorkTitles = array();
      $numberOfAcceptedWorks = 0;               $acceptedWorkTitles = array();
      $numberOfAccWorksForInstall = 0;          $installWorkTitles = array();
      $numberOfAccWorksForAltVenue = 0;         $altVenueWorkTitles = array();
      $numberOfWorksNeedingImages = 0;          $worksNeedingImagesTitles = array();
      $numberOfRejectedWorks = 0;               $rejectedWorkTitles =array();
      $numberOfUndecidedWorks = 0;              $undecidedWorkTitles = array();
      $numberOfClipRequests = 0;                $clipRequestTitles = array();
      $forInstallation = false; // set to true if any of the referenced works are for installation
      $forAltVenue = false; // set to true if any of the referenced works are for exhibition at an alternate venue
      $explainInstallation = false; // set to true if any of the referenced works will be part of the installation.
      $explainAltVenue = false; // set to true if any of the referenced works will be part of the installation.
      $includesLivePerfAccepted = false; // set to true if any of the accepted referenced works include live performance
      $includesLivePerfRejected = false; // set to true if any of the accepted referenced works include live performance
      $requestClipPermission = false;
      // TODO: When the user has an option to omit some works, use only those works, not $this->potentiallyReferencedWorks.
      foreach($this->potentiallyReferencedWorks as $work) {
        $workAccepted = ($work['accepted'] == 1);
        $stillImagesNeeded = SSFRuntimeValues::requestImages() && HTMLGen::stillImagesNeeded($work['photoLocation'], $work['photoURL']);
        $thisOneForInstallation = $workAccepted && stripos($work['acceptFor'], 'installation') !== false;
        $forInstallation |= $thisOneForInstallation;
        $thisWorkForAltVenueButNotSoIndicatedOtherwise = $workAccepted && in_array($work['designatedId'], self::$worksForAltVenueButNotSoIndicatedOtherwise);
        $requestClipPermissionForThisWork = ($workAccepted && self::computedRequestForClipPermissionFor($work));
        $requestClipPermission |= $requestClipPermissionForThisWork;
        SSFDebug::globalDebugger()->becho('newAcceptRejectMessageBody thisWorkForAltVenueButNotSoIndicatedOtherwise', ($thisWorkForAltVenueButNotSoIndicatedOtherwise) ? 1 : 0, -1); // 7/26/13
        SSFDebug::globalDebugger()->becho('newAcceptRejectMessageBody work[acceptFor] contains alternateVenue', (stripos($work['acceptFor'], 'alternateVenue') !== false) ? 1 : 0, -1); // 7/26/13
        $thisOneForAltVenue = ((stripos($work['acceptFor'], 'alternateVenue') !== false) || $thisWorkForAltVenueButNotSoIndicatedOtherwise);
        $forAltVenue |= $thisOneForAltVenue;
        SSFDebug::globalDebugger()->becho('newAcceptRejectMessageBody forAltVenue', ($forAltVenue) ? 1 : 0, -1); // 7/26/13
        if (true)                                   { $totalNumberOfWorks++;          $allWorksTitles[] = $work['title']; }
        if ($work['accepted'] == $work['rejected']) { $numberOfUndecidedWorks++;      $undecidedWorkTitles[] = $work['title']; }
        else if ($work['rejected'] == 1)            { $numberOfRejectedWorks++;       $rejectedWorkTitles[] = $work['title']; }
        else if ($workAccepted) { 
                                                      $numberOfAcceptedWorks++;       $acceptedWorkTitles[] = $work['title'];
          if ($stillImagesNeeded)                   { $numberOfWorksNeedingImages++;  $worksNeedingImagesTitles[] = $work['title']; }
          if ($thisOneForInstallation)              { $numberOfAccWorksForInstall++;  $installWorkTitles[] = $work['title']; }
          if ($thisOneForAltVenue)                  { $numberOfAccWorksForAltVenue++; $altVenueWorkTitles[] = $work['title']; }
          else if (!$thisOneForInstallation & !$thisOneForAltVenue)
                                                    { $numberOfWorksToScreen++;       $screenWorkTitles[] = $work['title']; }
          if ($requestClipPermissionForThisWork)    { $numberOfClipRequests++;        $clipRequestTitles[] = $work['title']; }
          }
        if ($work['includesLivePerformance'] == 1) {
          if ($work['accepted'] == 1) $includesLivePerfAccepted = true;
          else if ($work['rejected'] == 1) $includesLivePerfRejected = true;
        }
      }
      if ($totalNumberOfWorks != 0) {
        self::$debugger->belchTrace('newAcceptRejectMessageBody this->potentiallyReferencedWorks[0]', $this->potentiallyReferencedWorks[0], -1);
      }
      if ($totalNumberOfWorks == 0) {
        // There are no works. Produce no letter but rather a note to the administrator.
        $this->suppress = true;
        $message = 'There are no works selected. Thus, there is no email message. It may be that your browser cache and/or cookies got cleared.<br><br>'
                 . 'To get the thing working properly again, follow these steps.<br><br>'
                 . '  1. Make sure that cookies are enabled for your browser.<br><br>'
                 . '  2. At the top of the frame to the left, change the value of the Acc/Rej Email Filter<br>'
                 . '    a) to Not Sent, <br>'
                 . '    b) then to Sent, <br>'
                 . '    c) then to All, and <br>'
                 . '    d) finally to whatever you want.<br><br>'
                 . '  3. Then, you can select any envelope icon in the list on the left and everything will be fine and dandy.<br>';
      } else if ($numberOfUndecidedWorks > 0) { 
        // UNDECIDED. If there are any works for which the acceptance status is undecided, produce no letter but rather a note to the administrator.
        $this->undecided = true;
        $this->suppress = true;
        $verb = ($numberOfUndecidedWorks > 1) ? ' are ' : ' is ';
        $message = 'The acceptance status of ' . self::generateTitleString($undecidedWorkTitles, 'and') . $verb . 'UNDECIDED so no email is generated.<br>';
      } else { // DECIDED. We can create a valid message.
        $message = $this->messageSalutation();
        $dataArray = $this->potentiallyReferencedWorks[0];
        // Generate the email based on the categories of the referenced works.
        if ($numberOfAcceptedWorks > 0) { // If any works at all were accepted
          // ACCEPTED
          self::$debugger->belchTrace('newAcceptRejectMessageBody this->potentiallyReferencedWorks[0]', $this->potentiallyReferencedWorks[0], -1);
          // TODO Mention documentary vs installation or screening
          $msgPartA = str_replace('<title>', self::generateTitleString($acceptedWorkTitles, 'and', ','), $this->acceptanceMessagePart1a());
          $filmReplacementWord = $this->replaceTheWordFilm($includesLivePerfAccepted, $numberOfAcceptedWorks);
          $msgPartA = str_replace('<film>', $filmReplacementWord, $msgPartA);
          $msgPartA = str_replace('<screen>', ($forInstallation || $includesLivePerfAccepted) ? 'present' : 'screen', $msgPartA);
          if ($forInstallation && $numberOfWorksToScreen == 0 ) $msgPartA = str_replace('<at our>', 'as part of our installation exhibit (see below) at the', $msgPartA);
          else if ($forAltVenue) $msgPartA = str_replace('<at our>', 'at one of the alternate venues (see below) associated with the', $msgPartA);
          else $msgPartA = str_replace('<at our>', 'at our', $msgPartA);
//          $msgPartA = str_replace('<at our>', ($forInstallation && $numberOfWorksToScreen == 0) ? 'as part of our installation exhibit (see below) at the' : 'at our', $msgPartA);
//          $msgPartA = str_replace('<at our>', ($forAltVenue && $numberOfWorksToScreen == 0) ? 'at one of the alternate venues (see below) associated with' : 'at our', $msgPartA);
          $msgPartB = str_replace('<submission>', ($numberOfAcceptedWorks == 1) ? 'submission' : 'submissions', $this->acceptanceMessagePart1b());
          $msgPartC = '';
          
          if ($forInstallation) $explainInstallation = true;
          if ($forAltVenue) $explainAltVenue = true;

          if ($forInstallation) { 
            if ($numberOfWorksToScreen != 0) {
              $msgPartC = ' ' . self::generateTitleString($screenWorkTitles, 'and') . ' will be screened while '
                              . self::generateTitleString($installWorkTitles, 'and') . ' will be part of our installation exhibit (see below).';
              SSFDebug::globalDebugger()->becho('newAcceptRejectMessageBody forAltVenue A', ($forAltVenue) ? 1 : 0, -1); // 7/26/13
              }
            if ($forAltVenue) {
              $msgPartC = ' Additionally, ' . self::generateTitleString($altVenueWorkTitles, 'and') . ' will be screened at one of the alternate venues (see below).';
            }
          }

          SSFDebug::globalDebugger()->becho('newAcceptRejectMessageBody forAltVenue B', ($forAltVenue) ? 1 : 0, -1); // 7/26/13
          if (!$forInstallation && $forAltVenue && $numberOfWorksToScreen != 0) { 
            $msgPartC = ' ' . self::generateTitleString($screenWorkTitles, 'and') . ' will be screened at our primary event while '
                            . self::generateTitleString($altVenueWorkTitles, 'and') . ' will be screened at one of the alternate venues (see below).';
          }
          // TODO: Not handled is the case of one for installation or screening in addition to another for an alternate venue 
          
          $message .= $msgPartA . $msgPartC . $msgPartB;
          if ($numberOfRejectedWorks > 0) {
            // and also REJECTED
            $message .= str_replace('<title>', self::generateTitleString($rejectedWorkTitles, 'or'), $this->rejectionWithinAcceptanceMessage());
          }
          $plugTheShow = str_replace("<if you're able to come>", (($includesLivePerfAccepted) ? '' : " if you're able to come"), $this->plugTheShow()); // _if_you_are_able_to_come
          $part2 = str_replace('<title>', self::generateTitleString($rejectedWorkTitles, 'nor'), $plugTheShow . $this->acceptanceMessagePart2());
          $message .= str_replace("<We'll>", ($numberOfRejectedWorks > 0) ? 'We will' : "We'll", $part2);
          $stillImagesNeeded = SSFRuntimeValues::requestImages() && HTMLGen::stillImagesNeeded($dataArray['photoLocation'], $dataArray['photoURL']);
          if ($stillImagesNeeded) {
            $message .= str_replace('<title>', self::generateTitleString($acceptedWorkTitles, 'and', '.'), $this->imageRequest());
          }

          if ($requestClipPermission) {
            $msgPart = str_replace('<title>', self::generateTitleString($clipRequestTitles, 'and'), $this->clipRequest());
            $msgPart = str_replace('<clip>', ($numberOfClipRequests == 1) ? 'a clip' : 'clips', $msgPart);
            $message .= $msgPart;
          }
          $message .= $this->acceptanceMessageClosing();
        } else if ($numberOfRejectedWorks > 0) {
          // REJECTED only
          $msgPart1 = str_replace('<title>', self::generateTitleString($rejectedWorkTitles, 'and', ','), $this->rejectionMessagePart1());
          $msgPart2 = str_replace('<title>', self::generateTitleString($rejectedWorkTitles, 'nor'), $this->rejectionMessagePart2());
          $filmReplacementWord = $this->replaceTheWordFilm($includesLivePerfRejected, $numberOfRejectedWorks);
          $message .= str_replace('<film>', $filmReplacementWord, $msgPart1 . $msgPart2);
          $plugTheShow = str_replace("<We'll>", 'This year we will', $this->plugTheShow());
          $message .= str_replace("<if you're able to come>", (($includesLivePerfAccepted) ? '' : " if you're able to come"), $plugTheShow);
          if ($inviteFeedbackRequest) $message .= $this->InviteFeedbackRequest(); 
          $message .= str_replace("<submission>", ($numberOfRejectedWorks == 1) ? 'submission' : 'submissions', $this->rejectionMessageClosing());
        }
        // Close the message.
        $message .= $this->messageClosing() . "<br>";
        // Add conditional notes below the signature.
        //if ($numberOfAcceptedWorks > 0) 
        if ($explainInstallation && ($this->installationExplanation() != '')) 
          $message .= "<br><br>" . str_replace('<title>', self::generateTitleString($installWorkTitles, 'and', ','), $this->installationExplanation()); // 7/16/11
        if ($explainAltVenue && ($this->altVenueExplanation() != '')) 
          $message .= "<br><br>" . str_replace('<title>', self::generateTitleString($altVenueWorkTitles, 'and', ','), $this->altVenueExplanation()); // 7/26/11
        if (($numberOfAcceptedWorks > 0) && ($this->venueDirections() != '') 
                                         && (($numberOfWorksToScreen + $numberOfAccWorksForInstall) >= 1) 
                                         && ($this->venueDirections() != '')) 
          $message .= "<br><br>" . $this->venueDirections();
        if (($numberOfWorksNeedingImages > 0) && ($this->imageDetailPart() != '')) $message .= "<br><br>" . $this->imageDetailPart();
      }
//      $messageWithCRs = str_replace("<br>", "\r\n", $message . "<br>");
      $messageWithCRs = str_replace("<br>", "\r\n", $message);
      self::$debugger->belchTrace('newAcceptRejectMessageBody messageWithCRs', $messageWithCRs, -1);
      return $messageWithCRs;
    }

    private function beAcceptReject() {
      $this->commType = 'AcceptReject';
      $this->from = 'Curators@sanssoucifest.org';
      $this->bcc = 'Curators@sanssoucifest.org';
      $this->subject = 'Sans Souci Festival of Dance Cinema';
      return $this;
    }

    // coordinate changes with the javascript function arEmailSentWidgetMarkupJS(workId)
    private static function selectEntryAndArEmailSentAnchor($commId, $submitter, $workId, $dateSent) {
      return '<a href="' . HTMLGen::curationEntryHREFText($workId) . '" target="' . HTMLGen::curationEntryAnchorTargetText() . '" ' 
           . 'onClick="' . self::arEmailWidgetOnClickText($commId, $submitter, $dateSent) . ';' . HTMLGen::curationEntryAnchorOnClickText($workId)
           . ';">';
    }
    
    // coordinate changes with the javascript function arEmailSentWidgetMarkupJS(workId)
    private static function selectEntryAndArEmailSentWidgetMarkup($commId, $submitter, $workId, $dateSent) {
      $text = '<!--selectEntryAndArEmailSentWidgetMarkup-->'
            . self::selectEntryAndArEmailSentAnchor($commId, $submitter, $workId, $dateSent)
            . '<img ' . 'src="../' . self::$arEmailSentIconPic . '" alt="View email sent." title="View email sent." border="0" '
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

    private static function selectEntryAndArEmailNotSentAnchor($commId, $submitter, $workId) {
      return '<a href="' . HTMLGen::curationEntryHREFText($workId) . '" target="' . HTMLGen::curationEntryAnchorTargetText()
           . '" onClick="' . self::arEmailWidgetOnClickText($commId, $submitter) . ';' 
           . HTMLGen::curationEntryAnchorOnClickText($workId) . ';">';
    }

    private static function selectEntryAndArEmailNotSentWidgetMarkup($commId, $submitter, $workId, $rejected) {
      $kindOf = ($rejected==1) ? ' rejection ' : ' acceptance ';
      $sendKind = 'alt="Send' . $kindOf . 'email." title="Send' . $kindOf . 'email." ';
      return '<!--selectEntryAndArEmailNotSentWidgetMarkup-->'
           . self::selectEntryAndArEmailNotSentAnchor($commId, $submitter, $workId)
           . '<img src="../../' . self::$arEmailSendIconPic . '" ' . $sendKind . 'style="vertical-align:text-top;padding:0px 0 0 2px" '
           . ' width="' . self::$arEmailIconWidth . '" height="' . self::$arEmailSendIconHeight . '" align="top" border="0" ></a>';
    }

    public static function anchorMarkupForDetailEntryDisplayWithEmail($workRow) {
      $accepted = $workRow['accepted'];
      $rejected = $workRow['rejected'];
      $commId = isset($workRow['communicationId']) ? $workRow['communicationId'] : 0;
      $dateSent = isset($workRow['dateSent']) ? $workRow['dateSent'] : 0;
      if (isset($workRow['communications.dateSent']) && $dateSent == 0) $dateSent = $workRow['communications.dateSent'];
      if ($workRow['workId'] == 670) SSFDebug::globalDebugger()->belchTrace('anchorMarkupForDetailEntryDisplayWithEmail() workRow', $workRow, -1);
      $wasSent = self::emailWasSent($dateSent);
      $emailWidgetMarkup = '';
      $personId = 0;
      if ((($accepted==1) && ($rejected!=1)) || (($accepted!=1) && ($rejected==1)))
        if (isset($workRow['personId'])) $personId = $workRow['personId'];
        else if (isset($workRow['submitter'])) $personId = $workRow['submitter'];
        $emailWidgetMarkup = ($wasSent) 
                         ? self::selectEntryAndArEmailSentAnchor($commId, $personId, $workRow['workId'], $dateSent) 
                         : self::selectEntryAndArEmailNotSentAnchor($commId, $personId, $workRow['workId'], $rejected);
    return $emailWidgetMarkup;
    }

    public static function selectEntryForDetailDisplayWithEmailWidgetMarkup($workRow) {
      $accepted = $workRow['accepted'];
      $rejected = $workRow['rejected'];
      $commId = isset($workRow['communicationId']) ? $workRow['communicationId'] : 0;
      $dateSent = isset($workRow['dateSent']) ? $workRow['dateSent'] : 0;
      if (isset($workRow['communications.dateSent']) && $dateSent == 0) $dateSent = $workRow['communications.dateSent'];
      if ($workRow['workId'] == 868) SSFDebug::globalDebugger()->belchTrace('selectEntryForDetailDisplayWithEmailWidgetMarkup() workRow', $workRow, -1); //self::$debugStatuc20120708
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
