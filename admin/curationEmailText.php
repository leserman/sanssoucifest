<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  include_once '../bin/classes/HTMLGen.php';    // For some reason, HTMLGen was not being loaded without this explicit include.
?>
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
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<SCRIPT type="text/javascript">
//<!--
  function arEmailMarkupFunctionText(workId, commId, recipientId, imageText) {
    var setBreakpointHere = 0;
    var hrefText = "curationEntry.php?callContext=curationEmail&workId=" + workId;
    var functionText = '<a href="' + hrefText + '" target="curationEntry"' +
                     ' onClick="curationEmailTextWindow=openCurationEmailTextWindow(' + commId + ', ' + recipientId + ');' +
                     'setCookie(\'SSF_currentEntryIdCache_CurationEmail\', ' + workId + ');">' + imageText + '</a>';
    setBreakpointHere = 0;
    return functionText;
  }
  
  // coordinate changes with the php function SSFCommunique::arEmailSentWidgetMarkup()' . "\r\n";
  // This function replaces the statement: echo SSFCommunique::selectEntryAndArEmailSentWidgetMarkupJSText();
  function arEmailSentWidgetMarkupJS(workId, commId, recipientId, widgetId) {
  // imgage is SSFCommunique::$arEmailSentIconPic
  var imageText = '<img src="../images/emailSentIcon059c.gif" alt="View email sent." title="View email sent." ' + 
                  'border="0" width="18" height="14" style="vertical-align:text-top;padding:0px 0 0 2px;">';
  var functionText = arEmailMarkupFunctionText(workId, commId, recipientId, imageText);
//  alert("arEmailSentWidgetMarkupJS() workId=" + workId + ", commId=" + commId + ", recipientId=" + recipientId + 
//                                ", widgetId=" + widgetId + ", functionText=" + functionText);
  return functionText + "\r\n";
  }
  
  // coordinate changes with the php function SSFCommunique::arEmailSentWidgetMarkup()
  function arEmailSavedWidgetMarkupJS(workId, commId, recipientId, widgetId) {
  // imgage is SSFCommunique::$arEmailSendIconPic
  var imageText = '<img src="../images/emailSendIcon090g.gif" alt="View email sent." title="View email sent." ' + 
                  'border="0" width="18" height="14" style="vertical-align:text-top;padding:0px 0 0 2px;">';
  var functionText = arEmailMarkupFunctionText(workId, commId, recipientId, imageText);
//  alert("arEmailSavedWidgetMarkupJS() workId=" + workId + ", commId=" + commId + ", recipientId=" + recipientId + 
//                                ", widgetId=" + widgetId + ", functionText=" + functionText);
  return functionText + "\r\n";
  }
  
  // Message Cache vars annd functions
  
  var messageCache = '';
  
  function setMessageCache() {
    var currentMessageText;
    if ((typeof(document.getElementById('arEmailMessageText')) != 'undefined') && (document.getElementById('arEmailMessageText') !== null)) {
      currentMessageText = document.getElementById('arEmailMessageText').value;
      window.messageCache = currentMessageText;
    }
  }
  
  // setButtonStates() sets button states depending on context.
  function setButtonStates() {
    // id="submitRegen" value="Regenerate";
    // id="submitRevert" value="Revert";
    // id="submitSave" value="Save";
    // id="submitSend" value="Send";
    //alert('setButtonStates()');
//    (typeof obj.foo != 'undefined')
// typeof(variable) != "undefined" && variable !== null
    if ((typeof(document.getElementById('submitRegen')) != 'undefined') && (document.getElementById('submitRegen') !== null)) { 
      // Set the button states if the buttons are on-screen (using as submitRegen as the sample button tested).
      var currentMessageText = document.getElementById('arEmailMessageText').value;
      var dbMessageCache = document.getElementById('dbMessageCache').innerHTML;
      var freshlyGeneratedMessageCache = document.getElementById('freshlyGeneratedMessageCache').innerHTML;
      var cacheMatchesTextWidgetContents = (currentMessageText == window.messageCache);
      var cacheMatchesDbContents = (currentMessageText == dbMessageCache);
      var cacheMatchesRegenText = (currentMessageText == freshlyGeneratedMessageCache);
      var saved = (document.getElementById('emailSaved').value == 1);
      var undecided = (document.getElementById('emailUndecided').value == 1);
      // Regenerate button is enabled if the text is saved or the text has changed. 
        var regenerateButtonEabled = false;
  //      if (saved || !cacheMatchesTextWidgetContents) { regenerateButtonEabled = true; }
        if (!cacheMatchesRegenText) { regenerateButtonEabled = true; }
        document.getElementById('submitRegen').disabled = !regenerateButtonEabled; 
      // Revert button is enabled if the message has been saved and changed since then.
        var revertButtonEabled = false;
        if (saved && !cacheMatchesDbContents) { revertButtonEabled = true; } // BUG After regenerate (and previoudly saved), setButtonStates() is not called. 
        document.getElementById('submitRevert').disabled = !revertButtonEabled;
      // Save button is enabled if the message has not been saved or if it's been changed since the save but not if the curation status is [partially] undecided.    
        var saveButtonEabled = false;
        if (!undecided && (!saved || !cacheMatchesDbContents)) { saveButtonEabled = true; }
        document.getElementById('submitSave').disabled = !saveButtonEabled;
      // This function will never get called after the email has been sent because the text window will be disabled and the button div will be invisible. So the Send button is always enabled.
        var sendButtonEabled = true;
        if (undecided) sendButtonEabled = false;
        document.getElementById('submitSend').disabled = !sendButtonEabled;
    }  
  }
  
  function setMetaDataElements(to, from, subject) {
    if ((typeof(document.getElementById('arEmailMessageText')) != 'undefined') && (document.getElementById('arEmailMessageText') !== null)) {
      document.getElementById("to").value = to;
      document.getElementById("from").value = from;
      document.getElementById("subject").value = subject;
    }
  }
  
//-->
</SCRIPT>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
  <tr>
    <!--<td align="left" valign="top"> -->
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    <td width="530" align="left" valign="top" class="bodyTextGrayLight">


<?php // --- PHP ---------------------------------------------------------------------------------------
  
// --- constants -------------------------------------------------------------------------------------

  $checkedInQuotes = "'checked'";

// --- functions -------------------------------------------------------------------------------------

//  function requestClipPermissionText() { return ($arRequestClipPermission) ? "checked" : ""; }
//  function inviteFeedbackRequestText() { return ($arInviteFeedbackRequest) ? "checked" : ""; }

  function emailWasSentText($workRow) { 
    if (HTMLGen::emailWasSent($workRow)) return ' disabled ';
    else return '';
  }


// --- Initialization ------------------------------------------------------------------------------

// from curationAccRejEmailText
//  if (isset($_POST['RequestClipPermission'])) 
//    $debugger->becho("000", "POST['RequestClipPermission'].checked " . $_POST['RequestClipPermission'].checked);
  
/* from curationAccRejEmailText
  $arRequestClipPermission = (isset($_POST['RequestClipPermission']) && ($_POST['RequestClipPermission'] == 'clipPermission'));
  $arInviteFeedbackRequest = (isset($_POST['InviteFeedbackRequest']) && ($_POST['InviteFeedbackRequest'] == 'feedbackRequest'));
  $debugger->belch("0 _GET", $_GET, 1);
  if (isset($_GET['entryId'])) $entryId = $_GET['entryId']; else $entryId = isset($_POST['EntryId']) ? $_POST['EntryId'] : 0;
  $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId);
  $debugger->belch("01a workRow", $workRow, 0);
*/

// Copied from informArtistsOfMediaReceiptText

//  $userId = 22; // Steph  - TODO: detect the userId from login
//  $userId = 1; // David  - TODO: detect the userId from login
//  $userId = 38; // Michelle  - TODO: detect the userId from login
  
  $debugger = new SSFDebug();
  $debugger->enableBelch(false);
  $debugger->enableBecho(false);
  
  $belchBasic = -1;
  $debug20120708 = -1;
  
  $debugger->belch("_GET[commId]", (isset($_GET['commId']) ? $_GET['commId'] : 'not set') 
                                 . ";&nbsp;&nbsp;&nbsp;_POST[commId] " . (isset($_POST['commId']) ? $_POST['commId'] : 'not set'), $belchBasic);
  $debugger->belch("_GET[personId]", (isset($_GET['personId']) ? $_GET['personId'] : 'not set')
                                 . ";&nbsp;&nbsp;_POST[recipientId] " . (isset($_POST['recipientId']) ? $_POST['recipientId'] : 'not set'), $belchBasic);
  $debugger->belch("_POST[commId]", (isset($_POST['commId']) ? $_POST['commId'] : 'not set'), -1);
  $debugger->belch("_POST[recipientId]", (isset($_POST['recipientId']) ? $_POST['recipientId'] : 'not set'), -1);

  if (isset($_GET)) $debugger->belch("B Open _GET", $_GET, $debug20120708);
  if (isset($_POST)) $debugger->belch("B Open _POST", $_POST, $debug20120708);

//  SSFQuery::debugOn();

//  $communique = new SSFCommunique($userId);
  $communique = new SSFCommunique();
  
  if (isset($_GET['commId']) && ($_GET['commId'] != 0)) { 
    $communique->initializeFromDatabase($_GET['commId'], $_GET);
  } else if (isset($_GET['personId']) && ($_GET['personId'] != 0)) {
    $communique->initializeAsAcceptRejectFromSubmitter($_GET['personId']); 
  } else if (isset($_POST['commId']) && ($_POST['commId'] != 0)) {
    $debugger->belch("A Open _POST", $_POST, $debug20120708);
    $communique->restoreFromCache($_POST);
  } else if (isset($_POST['recipientId']) && ($_POST['recipientId'] != 0)) {
    $debugger->belch("B Open _POST", $_POST, $debug20120708);
    $communique->restoreFromCache($_POST);
  }
  
  // TODO Why is [emailWidgetId:private] => 0 immediately after a Save button click. Comment copied from informArtistsOfMediaReceiptText
  $communique->belch("01", 0);
  
// --- Event Handling ------------------------------------------------------------------------------

  // Entry just selected from list.
  if ((isset($_GET['personId']) && ($_GET['personId'] != 0)) || (isset($_GET['commId']) && ($_GET['commId'] != 0))) {
    $pid = isset($_GET['personId']) ? $_GET['personId'] : 0;
    $cid = isset($_GET['commId']) ? $_GET['commId'] : 0;
    $debugger->becho("Open", "GET[commId]=" . $cid . "; GET[personId]=" . $pid, $belchBasic);
    $communique->belch("08 Entry just selected", -1);
  } 

  // Save was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Save') {
    if (isset($_POST['ArEmailMessageText'])) $communique->setMessage($_POST['ArEmailMessageText']);
    $communique->belch("09 Save was clicked", $belchBasic);
    $communique->save(); // previously $communique->save($userId);
    echo '<script type="text/javascript">setMessageCache();setButtonStates();</script>';
    $communique->markupEmailListOnSave(); // changed 7/8/12 
  }

  // Send was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Send') {
    $debugger->becho("Send communique->commId", $communique->commId(), 0);
    if (!$communique->wasSent()) { // This check ensures that email can't be resent on a browser refresh.
      if (isset($_POST['ArEmailMessageText'])) $communique->setMessage($_POST['ArEmailMessageText']);
      $communique->send(); // previously $communique->send($userId);
      $communique->markupEmailListOnSend();  // ************
    }
  } 
  
  // Regenerate was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Regenerate') {
    $debugger->becho("Regenerate communique->commId", $communique->commId(), 0);
    $communique->regenerateMessage();
//    echo '<script type="text/javascript">setButtonStates();</script>' . "\r\n";
  } 
  
  // Revert was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Revert') {
    $debugger->becho("Revert communique->commId", $communique->commId(), 0);
    if ($communique->commId() != 0) {
      $communique->initializeFromDatabase($communique->commId(), $_POST);
    }
  } 

  // Repeating code above for if (isset($_GET['entryId'])) 
  else {
    $currentEntryIdCache = HTMLGen::currentEntryIdCacheName($withEmailInfo=true);
    $entryId = (isset($_COOKIE[$currentEntryIdCache])) ? $_COOKIE[$currentEntryIdCache] : SSFRunTimeValues::getDefaultWorkId();
    $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($entryId);
    $commId = (isset($workRow['communicationId'])) ? $workRow['communicationId'] : 0;
    if ($commId != 0) $communique->initializeFromDatabase($commId, $workRow);
    else $communique->initializeAsAcceptRejectFromSubmitter($workRow['personId']);
    $debugger->belch('10b', $communique, 0); 
    $debugger->becho("11b arCommunicationId=", $communique->commId(), $belchBasic);
  } 

// ---------------------------------------------------------------------------------------------
?>
      <form name='CurationEmailText' action='curationEmailText.php' method='post'
            onSubmit="setMetaDataElements(<?php echo $communique->to() . ', ' . $communique->from() . ', ' . $communique->subject(); ?>)">
          <table align="center" width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right" valign="middle" class="bodyTextOnDarkGray" style="padding:12px 10px 4px 8px">
                  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr style="padding:8px;">
                      <td style="text-align:left;">
                        <span class="programPageTitleText" style="vertical-align:text-bottom;">Curation 
                          <?php // if ($workRow['accepted']==1) echo "Acceptance "; else if ($workRow['rejected']==1) echo "Rejection "; ?>
                          Email</span>
                      </td>
                      <td align="right">&nbsp;
                      </td>
                    </tr>
                  </table>
              </td>
            </tr>
            <tr>
<?php
  $commmmuniqueWasSent = $communique->wasSent();
  $commmmuniqueWasSaved = $communique->wasSaved();
  $commmmuniqueIsUndecided = $communique->isUndecided();
  $suppressCommmmunique = $communique->suppress();
  $showDiagnosticsHere = -1;
  $debugger->becho("50 date('D, d M Y H:i:s')", date('D, d M Y H:i:s'), $showDiagnosticsHere);
  $debugger->becho("50 commmmuniqueWasSent", ($commmmuniqueWasSent ? 1 : 0), $showDiagnosticsHere);
  $debugger->becho("50 commmmuniqueWasSaved", ($commmmuniqueWasSaved ? 1 : 0), $showDiagnosticsHere);
  $debugger->becho("50 commmmuniqueIsUndecided", ($commmmuniqueIsUndecided ? 1 : 0), $showDiagnosticsHere);
  $debugger->becho("50 suppressCommmmunique", ($suppressCommmmunique ? 1 : 0), $showDiagnosticsHere);
  $padding = (!$commmmuniqueWasSent) ? 'padding:4px 10px 8px 8px' : 'padding:0';
  echo '              <td align="center" valign="middle" class="bodyTextOnDarkGray" style="' . $padding . '">';
  echo '                <div style="border:solid thin #999;padding:0 0 2px 0; margin-bottom:8px;">';
  $debugger->belchTrace('_POST', $_POST, -1);  // used 7/24/14
  $communique->displayPotentiallyReferencedWorks();
  echo '                </div>';
  if (!$commmmuniqueWasSent) {
    echo '                <div class="bodyTextOnDarkGray" style="border:solid thin #999;padding:8px">';
    echo '                  <input type="submit" id="submitRegen" name="Submit" style="margin:0 3px 0 3px;padding-left:2px;padding-right:2px;" value="Regenerate"';
    echo                      ($commmmuniqueIsUndecided || $suppressCommmmunique) ? 'disabled>' : '>'; 
    echo '                  <input type="submit" id="submitRevert" name="Submit" style="margin:0 3px 0 3px" value="Revert"';
    echo                      ($commmmuniqueIsUndecided || !$commmmuniqueWasSaved || $suppressCommmmunique) ? 'disabled>' : '>'; 
    echo '                  <input type="submit" id="submitSave" name="Submit" style="margin:0 3px 0 3px" value="Save"';
    echo                      ($commmmuniqueIsUndecided || $suppressCommmmunique) ? 'disabled>' : '>';
    echo '									<input type="submit" id="submitSend" name="Submit" style="margin:0 3px 0 3px" value="Send"';
    echo                      ($commmmuniqueIsUndecided || $suppressCommmmunique) ? 'disabled' : ''; 
/*
    // NOTE This is one of the two uses of $this->emailWidgetId(). 
//    $markArListItemSentText = 'return markArListItemSent(' . $communique->emailWidgetId() // TODO Make this work for multiple works. *****
//      . ', arEmailSentWidgetMarkupJS(' . $communique->commId() . ', ' . $communique->recipientId() . ', ' . $communique->emailWidgetId() . '));';
//    $debugger->becho('62 markArListItemSentText', $markArListItemSentText, 1);
//    echo ' onClick=\'' . $markArListItemSentText; 
*/
    echo '\'>';
    echo '                </div>';
  } 
  $communique->displayAsHiddenInputFields(); 
  echo '              </td>';

  SSFQuery::debugOff();
?>
            </tr>
<!--
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                    <?php /* echo ((HTMLGen::emailWasSaved($workRow)) ? htmlspecialchars($workRow['emailTo']) 
                                                                   : htmlspecialchars($communique->to())); */ ?><br>
              From: <?php /* echo ((HTMLGen::emailWasSaved($workRow)) ? htmlspecialchars($workRow['emailFrom']) 
                                                                   : htmlspecialchars($communique->from())); */ ?><br>
              Subject: <?php /* echo ((HTMLGen::emailWasSaved($workRow)) ? $workRow['emailSubject'] 
                                                                      : $communique->subject()); */ ?><br>
              Date: <?php /* echo ((HTMLGen::emailWasSent($workRow)) ? $workRow['dateSent'] : 'Now'); */ ?> 
              </td>
            </tr>
-->
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                      <?php echo htmlspecialchars($communique->to()); ?><br>
                From: <?php echo htmlspecialchars($communique->from()); ?><br>
                Subject: <?php echo $communique->subject(); ?><br>
                Date: <?php echo $communique->nominalDateSent(); ?> 
              </td>
            </tr>

            <tr>
              <!-- // TODO: Add an on-keystroke event to arEmailMessageText that will enable the Revert and Save buttons. 7/20/13 -->
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:10px 10px 10px 12px"><textarea cols="80" 
                rows="42" style="padding:12px;margin:0 -8px 0 -2px;" name="ArEmailMessageText" id="arEmailMessageText" class="curationFormTextArea"
                <?php if ($commmmuniqueWasSent) echo 'readonly="readonly"'; else echo 'onkeyup="setButtonStates()"'; ?>><?php echo $communique->message(); ?></textarea>
                <script type="text/javascript">setMessageCache();setButtonStates();</script>
              </td>
            </tr>
          </table>
      </form>
     </td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    </tr></table>
</body>
</html>
