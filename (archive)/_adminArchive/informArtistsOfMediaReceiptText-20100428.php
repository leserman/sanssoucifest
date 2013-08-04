<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<title>SSF - Curation Acceptance / Rejection Email Text</title>
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
function emailSentIconMarkupJS(workId) {
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
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
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

// --- constants -------------------------------------------------------------------------------------

  $checkedInQuotes = "'checked'";

// --- functions -------------------------------------------------------------------------------------

  function emailWasSentText($workRow) { 
    if (HTMLGen::emailWasSent($workRow)) return ' disabled ';
    else return '';
  }
/*
  // If there are multiple email addresses in $emailString, use only the first. (Otherwise it semms that
  // php mail [e.g., sendmail] garbles the addresses.)
  function constructToField($nameString, $emailString) { 
    $emailStrings = explode (',', $emailString);
    global $debugger;  
    $debugger->belch('77 emailStrings', $emailStrings, 0);
    return $nameString . ' <' . trim($emailStrings[0]) . '>'; 
  }
*/
  // Inserts an new communication in the database and returns $communicationId
  function insertCommunication($entryId, $personId, $sent, $userId) {
    global $debugger;
    $debugger->belch('30', $this); 
    $multipleWorks = is_array($entryId); // 4/22/10
    $referencedWork = ($multipleWorks) ? $entryId[0] : $entryId; // 4/22/10
    $commInsertString = "INSERT INTO communications (recipient, template, sent, dateSent, type, sender, referencedWork, contentText, "
                       . "contentFormatted, applicationToOpenFormattedText, physicalOrEmailOrVoice, inResponseTo, notes, "
                       . "emailTo, emailFrom, emailSubject, "
                       . "lastModificationDate, lastModifiedBy, contentLastModDate, contentLastModifiedBy) "
                       . "VALUES (" . $personId  . ", NULL, " . $sent . ", NULL, 'AcceptReject', " . $userId . ", " . $referencedWork . ", " // 4/22/10
                       . SSFQuery::quote($this->message) . ", NULL, NULL, 'Email', NULL, NULL, " 
                       . SSFQuery::quote($this->to()) . ", "
                       . SSFQuery::quote($this->from) . ", " 
                       . SSFQuery::quote($this->subject) . ", NOW(), " . $userId . ", NOW(), " . $userId . ")";
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
                             // . ", emailTo = " . SSFQuery::quote($this->to())
                             // . ", emailFrom = " . SSFQuery::quote(($this->from)
                             // . ", emailSubject = " . SSFQuery::quote($this->subject)
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
  
  $communique = SSFCommunique::instance()->setValuesFromDataArray($_POST);

  if (isset($_GET['entryId'])) $entryId = $_GET['entryId']; else $entryId = $_POST['EntryId'];
  $communique->setValuesFromDatabase($entryId);
  $communique->belch("01", 0);

// --- Event Handling ------------------------------------------------------------------------------

  // Entry just selected from list.
  if (isset($_GET['entryId'])) {
    $debugger->becho("Open - GET[EntryId] = ", $_GET['entryId'], -1);
    $communique->belch("08", 0);
    $commId = $workRow['communicationId'];
    if (isset($commId) && $commId != 0) SSFCommunique::instance()->setValuesFromDataArray($workRow);
    else $communique->copy(generateemailCommunique($workRow));
    $communique->belch("10", 0);
    $debugger->becho("11 arCommunicationId=", SSFCommunique::instance()->commId, 1);
  } 
  
  // Save was clicked.
  else if ($_POST['Submit'] == 'Save') {
    $debugger->becho("Save - POST[EntryId] = ", $_POST['EntryId'], -1);
    $communique->belch("12", 0);
    if ($communique->commId == 0) { // this is a new communication
      $communique->belch("14", 0);
      $commId = insertCommunication($entryId, $workRow['personId'], SSFCommunique::instance(), 0, $userId);
      $communique->commId = $commId; 
      $communique->belch("20", 0);
    } else { // this is an update
      updateCommunication($communique->commId, $_POST['ArEmailMessageText'], 0, $userId);
    }
    // Refresh after Save.
//    $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId); 
    $communique = SSFCommunique::instance()->setValuesFromDatabase();
    $communique->message = $workRow['contentText'];
    $communique->setToFieldFromNameAndEmail($workRow['name'], $workRow['email']);
    $communique->belch("24", 0);
  } 
  
  // Send was clicked.
  // TODO This block is ineffecient with all the writes and reads to the DB.
  else if ($_POST['Submit'] == 'Send') {
    $debugger->belch("Send - POST[EntryId] = ", $_POST['EntryId'], -1);
    if ($communique->commId == 0) { // This is a new communication.
      $debugger->becho('30', "This is a new communication.", 1);
      $commId = insertCommunication($entryId, $workRow['personId'], SSFCommunique::instance(), 0, $userId);
      $communique->commId = $commId; 
      $communique->belch("31", -1);
    } else { // This is a communication update.
      $debugger->becho('32', "This is a communication update.", 1);
      updateCommunication($communique->commId, $_POST['ArEmailMessageText'], 0, $userId);
      $communique->belch("35", 0);
      }
    }
    // Refresh work row after Save & Send.
    $communique = SSFCommunique::instance()->setValuesFromDatabase($entryId);
    $communique->belch("36", 0);
    if (!$communique->wasSent()) { // This check ensures that email can't be resent on a browser refresh.
      $communique->send();
      $communique->belch("37", 0);
      $communique->updateDbSendFields();
      // Read the data back from the database to capture dateSent in workRow.
      $communique->setValuesFromDatabase($entryId);
    }
  } 
  
  // Regenerate was clicked.
  else if ($_POST['Submit'] == 'Regenerate') {
    $communique->regenerateMessage();
    $communique->belch('40', 1); 
  } 
  
  // Revert was clicked.
  else if ($_POST['Submit'] == 'Revert') {
    $debugger->belch("Revert - POST[EntryId] = ", $_POST['EntryId'], 1);
    if ($communique->commId != 0) {
      $communique->setValuesFromDatabase($entryId);
      $communique->belch('50', 1); 
    }
  } 
  else {
    echo ("ERROR - NO DATA POSTED. Tell David. <br>\r\n");
  }
    
// ---------------------------------------------------------------------------------------------
?>
      <form name='CurationEmailText' action='curationAccRejEmailText.php' method='post'
            onSubmit='document.getElementById("to").value="<?php echo SSFCommunique::instance()->to(); ?>";
                      document.getElementById("from").value="<?php echo SSFCommunique::instance()->from; ?>";
                      document.getElementById("subject").value="<?php echo SSFCommunique::instance()->subject; ?>";
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
                  <input type="submit" id="submitRegen" name="Submit" style="margin:0 3px 0 3px;padding-left:2px;padding-right:2px;" value="Regenerate" <?php 
                    if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitRevert" name="Submit" style="margin:0 3px 0 3px" value="Revert" <?php 
                    if ((!HTMLGen::emailWasSaved($workRow)) || HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitSave" name="Submit" style="margin:0 3px 0 3px" value="Save" <?php 
                    if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> >  
									<input type="submit" id="submitSend" name="Submit" style="margin:0 3px 0 3px" value="Send" 
									  <?php if (HTMLGen::emailWasSent($workRow)) echo 'disabled' ?> 
									  onClick="return markListItemSentOnClick('<?php echo SSFCommunique::emailWidgetId($entryId) ?>', 
									                                                emailSentIconMarkupJS(<?php echo $entryId ?>));">
                  <input type="hidden" id="entryId" name="EntryId" value=<?php echo $entryId; ?> >
<?php $communique->:displayHiddenInputFields(); ?>
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                <?php echo htmlspecialchars($communique->nominalTo()) ?><br>
                From: <?php echo htmlspecialchars($communique->nominalFrom()) ?><br>
                Subject: <?php echo htmlspecialchars($communique->subject()); ?><br>
                Date: <?php echo $communique->nominalDateSent(); ?> 
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:10px 10px 10px 12px"><textarea cols="80" 
                rows="37" style="padding:12px;margin:0 -8px 0 -2px;" name="ArEmailMessageText" id="emailCommuniqueMessageText" class="curationFormTextArea"
                <?php if (HTMLGen::emailWasSent($workRow)) echo 'readonly="readonly"' ?>><?php echo $communique->message ?></textarea>
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
