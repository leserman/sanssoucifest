<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<title>SSF - Curation Email Text</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
<SCRIPT type="text/javascript">
//<!--
function markListItemSentOnClick(DOMid, markup) {
  $setBreakpointHere = 0;
  $container = window.opener.document.getElementById(DOMid);
  $container.innerHTML = markup;
//  alert('markListItemSentOnClick\r\n  DOMid = ' + DOMid + '\r\n  markup = ' + markup); 
  return true;
}

// coordinate changes with the php function emailSentIconMarkup($workId)
function arEmailSentWidgetMarkupJS(workId) {
  text = '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' + workId + ')"><img '
       + 'src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"><\/a>';
  return text;
}

/*
// function markListItemSentOnClick, above, plugs innerHTML for the email icon on the row of interest in 
// the list of works on curationAccRejEmail.php. E.g.,
//   DOMid = emailSentMarkup-56
//   markup = <a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(56)"><img 
//            src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>
*/

//-->
</SCRIPT>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="630"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="600" align="center" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
    <tr>
    <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    <td width="530" align="left" valign="top" class="bodyTextGrayLight">


<?php // --- PHP ---------------------------------------------------------------------------------------

  $filePathArray = explode('/', __FILE__);
  $loopIndex = 0;
  foreach ($filePathArray as $element) { 
    $loopIndex++;
    if ($element == 'sanssoucifest.org') { break; } 
  }
  $codeBase = "";
  for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
  include_once $codeBase . "bin/utilities/autoloadClasses.php";
//  SSFWebPageAssets::displayNavBar($codeBase);
  
// --- class AREmail -----------------------------------------------------------------------------------

  class AREmail {
    public static $arEmail = null;
    public $commId = 0;
    private $to = '';
    public $from = '';
    public $subject = '';
    public $message = '';

    // If there are multiple email addresses in $emailString, use only the first. (Otherwise it semms that
    // php mail [e.g., sendmail] garbles the addresses.)
    private static function constructToField($nameString, $emailString) { 
    $emailStrings = explode (',', $emailString);
    return $nameString . ' <' . trim($emailStrings[0]) . '>'; 
  }
    public function setTo($to) { $this->to = $to; }
    
    public function setToFieldFromNameAndEmail($name, $email) { $this->to = self::constructToField($name, $email);  }
    
    public function to() { return $this->to; }
    
    public static function singleInstance() {
      if (!(self::$arEmail instanceof self)) { self::$arEmail = new self; }
      return self::$arEmail;
    }
    
    public function setValues($commId, $to, $from, $subject, $message) {
      $this->commId = ((isset($commId)) ? $commId : 0);
      $this->to = ((isset($to)) ? $to : '');
      $this->from = ((isset($from)) ? $from : '');
      $this->subject = ((isset($subject)) ? $subject : '');
      $this->message = ((isset($message)) ? $message : '');
    }
    
    public function setValuesFromDataArray($dataArray) {
      $this->commId = (isset($dataArray['communicationId']) ? $dataArray['communicationId'] : 0);
      if (isset($dataArray['emailTo']) && $dataArray['emailTo'] !='')  $this->to = $dataArray['emailTo'];
      else $this->setToFieldFromNameAndEmail($dataArray['name'], $dataArray['email']);
      $this->from = $dataArray['emailFrom'];
      $this->subject = $dataArray['emailSubject'];
      $this->message = $dataArray['contentText'];
    }
    
    public function copy($arEmail) {
      $this->commId = $arEmail->commId;
      $this->to = $arEmail->to;
      $this->from = $arEmail->from;
      $this->subject = $arEmail->subject;
      $this->message = $arEmail->message;
    }
    
    public function __construct() {
      $this->commId = 0;
      $this->to = '';
      $this->from = '';
      $this->subject = '';
      $this->message = '';
    }
  }

// --- constants -------------------------------------------------------------------------------------

  $checkedInQuotes = "'checked'";

// --- functions -------------------------------------------------------------------------------------

//  function requestClipPermissionText() { return ($arRequestClipPermission) ? "checked" : ""; }
//  function inviteFeedbackRequestText() { return ($arInviteFeedbackRequest) ? "checked" : ""; }

  function emailWasSentText($workRow) { 
    if (HTMLGen::emailWasSent($workRow)) return ' disabled ';
    else return '';
  }

  // Generates and returns a AREmail object.
  function generateAccRejEmail($dataArray, $requestClipPermission, $inviteFeedbackRequest) {
    global $debugger;   
    $debugger->belch('03', $dataArray); 

    $arEmail = new AREmail;
    
    $arEmail->setToFieldFromNameAndEmail($dataArray['name'], $dataArray['email']);
    $arEmail->from = 'Curators@sanssoucifest.org';
    $arEmail->subject = 'Sans Souci Festival of Dance Cinema';

    $debugger->belch('05', $arEmail); 

    $message     = "Dear " . $dataArray['name'] . ",\r\n\r\n";
    
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
    $message .= str_replace('<br>', "\r\n\r\n", SSFRunTimeValues::getSalutationAndSignature());
    $arEmail->message = $message;
    return $arEmail;
  }
  
  function sendEmail($to, $from, $subject, $message) {
    $headers = "From: " . $from . "\r\n"
             . "Reply-To: " . $from . "\r\n"
             . "Bcc: curators@sanssoucifest.org\r\n"
             . "X-Mailer: PHP" . phpversion() . "\r\n"
             . "X-Apparently-To: " . $to;
    $mailedData = mail('hamelb@sanssoucifest.org', $subject, $message . "\r\n\r\n", $headers); // FOR TESTING
//    $mailedData = mail($to, $subject, $message . "\r\n\r\n", $headers); // FOR REAL
  }
  
  // Inserts an new communication in the database and returns $communicationId
  function insertCommunication($entryId, $personId, $arEmailInstance, $sent, $userId) {
    global $debugger;
    $debugger->belch('30', $arEmailInstance); 
    $multipleWorks = is_array($entryId); // 4/22/10
    $referencedWork = ($multipleWorks) ? $entryId[0] : $entryId; // 4/22/10
    $commInsertString = "INSERT INTO communications (recipient, template, sent, dateSent, type, sender, referencedWork, contentText, "
                       . "contentFormatted, applicationToOpenFormattedText, physicalOrEmailOrVoice, inResponseTo, notes, "
                       . "emailTo, emailFrom, emailSubject, "
                       . "lastModificationDate, lastModifiedBy, contentLastModDate, contentLastModifiedBy) "
                       . "VALUES (" . $personId  . ", NULL, " . $sent . ", NULL, 'AcceptReject', " . $userId . ", " . $referencedWork . ", " // 4/22/10
                       . SSFQuery::quote($arEmailInstance->message) . ", NULL, NULL, 'Email', NULL, NULL, " 
                       . SSFQuery::quote($arEmailInstance->to()) . ", "
                       . SSFQuery::quote($arEmailInstance->from) . ", " 
                       . SSFQuery::quote($arEmailInstance->subject) . ", NOW(), " . $userId . ", NOW(), " . $userId . ")";
    //SSFDB::debugNextQuery();
    // TODO The next two calls to SSFDB::getDB()->saveData() should be an atomic indivisible operation.
    SSFDB::getDB()->saveData($commInsertString);
    $communicationId = SSFDB::getDB()->insertedId(); 
    $debugger->becho("37 arCommunicationId=", $communicationId, 1);
    SSFDB::getDB()->saveData("INSERT INTO communicationWork (communication, work) VALUES (" . $communicationId . ", " . $entryId . ")");
    return $communicationId;
  }

  // TODO fix this one like the one above.
  function updateCommunication($communicationId, $messageText, $sent, $userId) {
    $commUpdateString = "UPDATE communications set contentText = " 
                              . SSFQuery::quote($messageText)
                              . ", sent = " . $sent
                             // . ", emailTo = " . SSFQuery::quote($arEmailInstance->to())
                             // . ", emailFrom = " . SSFQuery::quote($arEmailInstance->from)
                             // . ", emailSubject = " . SSFQuery::quote($arEmailInstance->subject)
                              . ", lastModificationDate = NOW(), lastModifiedBy = " . $userId 
                              . ", contentLastModDate = NOW(), contentLastModifiedBy = " . $userId 
                              . " where communicationId = " . $communicationId;
    SSFDB::getDB()->saveData($commUpdateString);
  }

// --- Initialization ------------------------------------------------------------------------------

  $userId = 38; // Michelle  - TODO: detect the userId from login
  
  $debugger = new SSFDebug();
  $debugger->enableBelch(false);
  $debugger->enableBecho(false);

//  if (isset($_POST['RequestClipPermission'])) 
//    $debugger->becho("000", "POST['RequestClipPermission'].checked " . $_POST['RequestClipPermission'].checked);
  
  AREmail::singleInstance()->commId = ((isset($_POST['CommunicationId'])) ? $_POST['CommunicationId'] : 0);
  AREmail::singleInstance()->setTo(((isset($_POST['To'])) ? $_POST['To'] : ''));
  AREmail::singleInstance()->from = ((isset($_POST['From'])) ? $_POST['From'] : '');
  AREmail::singleInstance()->subject = ((isset($_POST['Subject'])) ? $_POST['Subject'] : '');
  AREmail::singleInstance()->message = ((isset($_POST['ArEmailMessageText'])) ? $_POST['ArEmailMessageText'] : '');

  $arRequestClipPermission = (isset($_POST['RequestClipPermission']) && ($_POST['RequestClipPermission'] == 'clipPermission'));
  $arInviteFeedbackRequest = (isset($_POST['InviteFeedbackRequest']) && ($_POST['InviteFeedbackRequest'] == 'feedbackRequest'));
  
  $debugger->belch("0 _GET", $_GET, 1);

  if (isset($_GET['entryId'])) $entryId = $_GET['entryId']; else $entryId = $_POST['EntryId'];
  $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId);

  $debugger->belch("01 workRow", $workRow, 0);

// --- Event Handling ------------------------------------------------------------------------------

  // Entry just selected from list.
  if (isset($_GET['entryId'])) {
    $debugger->becho("Open - GET[EntryId] = ", $_GET['entryId'], -1);
    $debugger->belch('08', $workRow); 
    $commId = $workRow['communicationId'];
    if (isset($commId) && $commId != 0) AREmail::singleInstance()->setValuesFromDataArray($workRow);
    else AREmail::singleInstance()->copy(generateAccRejEmail($workRow, $arRequestClipPermission, $arInviteFeedbackRequest));
    $debugger->belch('10', AREmail::singleInstance()); 
    $debugger->becho("11 arCommunicationId=", AREmail::singleInstance()->commId, 1);
  } 
  
  // Save was clicked.
  else if ($_POST['Submit'] == 'Save') {
    $debugger->becho("Save - POST[EntryId] = ", $_POST['EntryId'], -1);
    $debugger->belch('12', AREmail::singleInstance()); 
    if (AREmail::singleInstance()->commId == 0) { // this is a new communication
      $debugger->belch('14', AREmail::singleInstance(), 0); 
      $commId = insertCommunication($entryId, $workRow['personId'], AREmail::singleInstance(), 0, $userId);
      AREmail::singleInstance()->commId = $commId; 
      $debugger->belch('20', AREmail::singleInstance(), 0); 
    } else { // this is an update
      updateCommunication(AREmail::singleInstance()->commId, $_POST['ArEmailMessageText'], 0, $userId);
    }
    // Refresh after Save.
    $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId); 
    AREmail::singleInstance()->message = $workRow['contentText'];
    AREmail::singleInstance()->setToFieldFromNameAndEmail($workRow['name'], $workRow['email']);
    $debugger->belch('24', AREmail::singleInstance(), 0); 
  } 
  
  // Send was clicked.
  // TODO This block is ineffecient with all the writes and reads to the DB.
  else if ($_POST['Submit'] == 'Send') {
    $debugger->belch("Send - POST[EntryId] = ", $_POST['EntryId'], -1);
    if (AREmail::singleInstance()->commId == 0) { // This is a new communication.
      $debugger->becho('30', "This is a new communication.", 1);
      $commId = insertCommunication($entryId, $workRow['personId'], AREmail::singleInstance(), 0, $userId);
      AREmail::singleInstance()->commId = $commId; // unnecessary
      $debugger->belch('31  AREmail::singleInstance', AREmail::singleInstance(), -1); 
    } else { // This is a communication update.
      $debugger->becho('32', "This is a communication update.", 1);
      updateCommunication(AREmail::singleInstance()->commId, $_POST['ArEmailMessageText'], 0, $userId);
      $debugger->belch('35 AREmail::singleInstance', AREmail::singleInstance()); 
    }
    // Refresh work row after Save & Send.
//    SSFQuery::debugNextQuery();
    $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId); 
    $debugger->belch('36 workRow', $workRow, 0); 
    AREmail::singleInstance()->setValuesFromDataArray($workRow);
    if (!HTMLGen::emailWasSent($workRow)) { // This check ensures that email can't be resent on a browser refresh.
      sendEmail(AREmail::singleInstance()->to(), AREmail::singleInstance()->from,
                AREmail::singleInstance()->subject, AREmail::singleInstance()->message);
      $debugger->belch('37 AREmail::singleInstance', AREmail::singleInstance(), 1); 
//      SSFDB::getDB()->debugNextQuery();
      $updateQuery = 'UPDATE communications set sent=1, dateSent=NOW() where communicationId=' . AREmail::singleInstance()->commId;
      SSFDB::getDB()->saveData($updateQuery);
      // Read the data back from the database to capture dateSent in workRow.
      $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId); 
    }
  } 
  
  // Regenerate was clicked.
  else if ($_POST['Submit'] == 'Regenerate') {
    $debugger->belch("Regenerate - POST[EntryId] = ", $_POST['EntryId'], -1);
    AREmail::singleInstance()->copy(generateAccRejEmail($workRow, $arRequestClipPermission, $arInviteFeedbackRequest));
    $debugger->belch('40', AREmail::singleInstance()); 
  } 
  
  // Revert was clicked.
  else if ($_POST['Submit'] == 'Revert') {
    $debugger->belch("Revert - POST[EntryId] = ", $_POST['EntryId'], -1);
    AREmail::singleInstance()->commId = (isset($workRow['communicationId']) ? $workRow['communicationId'] : 0);
    $debugger->belch('D50', $workRow); 
    if (AREmail::singleInstance()->commId != 0) AREmail::singleInstance()->setValuesFromDataArray($workRow);
    $debugger->belch('50', AREmail::singleInstance()); 
  } 
  else {
    echo ("ERROR - NO DATA POSTED. Tell David. <br>\r\n");
  }
    
// ---------------------------------------------------------------------------------------------
?>
      <form name='CurationEmailText' action='curationAccRejEmailText.php' method='post'
            onSubmit='document.getElementById("to").value="<?php echo AREmail::singleInstance()->to(); ?>";
                      document.getElementById("from").value="<?php echo AREmail::singleInstance()->from; ?>";
                      document.getElementById("subject").value="<?php echo AREmail::singleInstance()->subject; ?>";
                      '>
          <table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right" valign="middle" class="bodyTextOnDarkGray" style="padding:12px 10px 4px 8px">
<!--                <div style="border:solid;border-width:thin;padding:8px">  -->
                  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr style="padding:8px;">
                      <td style="text-align:left;">
                        <span class="programPageTitleText" style="vertical-align:text-bottom;">Curation 
                          <?php if ($workRow['accepted']==1) echo "Acceptance "; else if ($workRow['rejected']==1) echo "Rejection " ?>
                          Email</span>
                      </td>
                      <td align="right">&nbsp;
                      </td>
                    </tr>
                  </table>
<!--                </div>  -->
              </td>
            </tr>
            <tr>
              <td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:4px 10px 8px 8px">
                <div style="border:solid;border-width:thin;padding:8px">
                  <?php 
                    if ($workRow['accepted']==1) 
                      echo '<input type="checkbox" name="RequestClipPermission" id="requestClipPermission" value="clipPermission" '
                            //. requestClipPermissionText() 
                            . emailWasSentText($workRow) 
                            . (($arRequestClipPermission) ? " checked=$checkedInQuotes" : "") . '>' 
                            . '<label for="requestClipPermission">Request clip permission. </label>&nbsp;&nbsp;' . "\r\n";
                    if ($workRow['rejected']==1) 
                      echo '<input type="checkbox" name="InviteFeedbackRequest" id="inviteFeedbackRequest" value="feedbackRequest" '
                            //. inviteFeedbackRequestText() 
                            . emailWasSentText($workRow)
                            . (($arInviteFeedbackRequest) ? " checked=$checkedInQuotes " : "") . '>' 
                            . '<label for="inviteFeedbackRequest">Invite feedback request. </label>&nbsp;&nbsp;' . "\r\n";
                  ?>
                  <input type="submit" id="submitRegen" name="Submit" style="margin:0 3px 0 3px;padding-left:2px;padding-right:2px;" value="Regenerate" <?php 
                    if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitRevert" name="Submit" style="margin:0 3px 0 3px" value="Revert" <?php 
                    if ((!HTMLGen::emailWasSaved($workRow)) || HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitSave" name="Submit" style="margin:0 3px 0 3px" value="Save" <?php 
                    if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
									<input type="submit" id="submitSend" name="Submit" style="margin:0 3px 0 3px" value="Send" 
									  <?php if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> 
									  onClick="return markListItemSentOnClick('<?php echo HTMLGen::emailWidgetId($entryId) ?>', 
									                                                  arEmailSentWidgetMarkupJS(<?php echo $entryId ?>));">
                  <input type="hidden" id="entryId" name="EntryId" value=<?php echo $entryId; ?> >
                  <input type="hidden" id="to" name="To" value='<?php echo AREmail::singleInstance()->to(); ?>' >
                  <input type="hidden" id="from" name="From" value="<?php echo AREmail::singleInstance()->from; ?>" >
                  <input type="hidden" id="subject" name="Subject" value="<?php echo AREmail::singleInstance()->subject; ?>" >
                  <input type="hidden" id="communicationId" name="CommunicationId" value="<?php echo AREmail::singleInstance()->commId; ?>" >
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                    <?php echo ((HTMLGen::emailWasSaved($workRow)) ? htmlspecialchars($workRow['emailTo']) 
                                                                   : htmlspecialchars(AREmail::singleInstance()->to())); ?><br>
              From: <?php echo ((HTMLGen::emailWasSaved($workRow)) ? htmlspecialchars($workRow['emailFrom']) 
                                                                   : htmlspecialchars(AREmail::singleInstance()->from)); ?><br>
              Subject: <?php echo ((HTMLGen::emailWasSaved($workRow)) ? $workRow['emailSubject'] 
                                                                      : AREmail::singleInstance()->subject); ?><br>
              Date: <?php echo ((HTMLGen::emailWasSent($workRow)) ? $workRow['dateSent'] : 'Now'); ?> 
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:10px 10px 10px 12px"><textarea cols="80" 
                rows="37" style="padding:12px;margin:0 -8px 0 -2px;" name="ArEmailMessageText" id="arEmailMessageText" class="curationFormTextArea"
                <?php if (HTMLGen::emailWasSent($workRow)) echo 'readonly="readonly"' ?>><?php echo AREmail::singleInstance()->message ?></textarea>
              </td>
            </tr>
          </table>
      </form>
     </td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    </tr></table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
<tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
    <?php SSFWebPageAssets::displayCopyrightLine();?></td>
    <td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
</html>
