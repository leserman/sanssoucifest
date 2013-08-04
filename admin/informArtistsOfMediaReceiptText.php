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

// --- Initialization ------------------------------------------------------------------------------

  $userId = 38; // Michelle  - TODO: detect the userId from login
  $userId = 22; // Steph  - TODO: detect the userId from login
  $userId = 1; // David  - TODO: detect the userId from login

  $belchFlow = 0;
  $debugger = new SSFDebug();
  $debugger->enableBelch(false);
  $debugger->enableBecho(false);
  
  $debugger->belch("_GET[commId]", (isset($_GET['commId']) ? $_GET['commId'] : 'not set'), 0);
  $debugger->belch("_GET[personId]", (isset($_GET['personId']) ? $_GET['personId'] : 'not set'), 0);
  $debugger->belch("_POST[commId]", (isset($_POST['commId']) ? $_POST['commId'] : 'not set'), 0);
  $debugger->belch("_POST[recipientId]", (isset($_POST['recipientId']) ? $_POST['recipientId'] : 'not set'), 0);

  $communique = new SSFCommunique($userId);
  echo SSFCommunique::mrEmailSentWidgetMarkupJSText();
  
  if (isset($_GET['commId']) && ($_GET['commId'] != 0)) { 
    $communique->initializeFromDatabase($_GET['commId'], $_GET);
  } else if (isset($_GET['personId']) && ($_GET['personId'] != 0)) {
    $communique->initializeAsMediaReceiptFromRecipient($_GET['personId'], $_GET['widgetId']);
  } else if (isset($_POST['commId']) && ($_POST['commId'] != 0)) {
    $debugger->belch("A Open _POST", $_POST, 0);
    $communique->restoreFromCache($_POST);
  } else if (isset($_POST['recipientId']) && ($_POST['recipientId'] != 0)) {
    $debugger->belch("B Open _POST", $_POST, 0);
    $communique->restoreFromCache($_POST);
  }
  
  // TODO Why is [emailWidgetId:private] => 0 immediately after a Save button click.
  $communique->belch("01", $belchFlow);

// --- Event Handling ------------------------------------------------------------------------------

  // Entry just selected from list.
  if (isset($_GET['commId']) || isset($_GET['personId'])) {
    $debugger->becho("Open", "GET[commId] = " . $_GET['commId'] . " GET[personId] = " . $_GET['personId'], -1);
    $communique->belch("08", $belchFlow);
  } 
  
  // Save was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Save') {
    $debugger->becho("Save communique->commId A", $communique->commId(), 0);
    if ($communique->commId() == 0) { // this is a new communication
      $communique->insertIntoDatabase($userId);
      $debugger->becho("Save communique->commId B", $communique->commId(), 0);
    } else { // this is an update
      $communique->updateDatabase($userId);
    }
    // Refresh after Save.
//      $communique->initializeFromDatabase($communique->commId(), $_POST);
//    $communique->belch("24", -1);
  } 

  // Send was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Send') {
    $debugger->becho("Send communique->commId", $communique->commId(), -1);
    if ($communique->commId() == 0) { // This is a new communication.
      $debugger->becho('30', "This is a new communication.", $belchFlow);
      $communique->insertIntoDatabase($userId);
      $communique->markupEmailListOnSend();
      $communique->belch("31", $belchFlow);
    } else { // This is a communication update.
      $debugger->becho('32', "This is a communication update.", $belchFlow);
      $communique->updateDatabase($userId);
      $communique->markupEmailListOnSend();
      $communique->belch("35", $belchFlow);
      }
    // Send the communique if it's yet to be done.
    $communique->belch("36", -1);
    if (!$communique->wasSent()) { // This check ensures that email can't be resent on a browser refresh.
      $communique->send($userId);
      $communique->belch("37", $belchFlow);
    }
  } 
  
  // Regenerate was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Regenerate') {
    $debugger->becho("Regenerate communique->commId", $communique->commId(), 0);
    $communique->regenerateMessage();
    $communique->belch('40', $belchFlow); 
  } 
  
  // Revert was clicked.
  else if (isset($_POST['Submit']) && $_POST['Submit'] == 'Revert') {
    $debugger->becho("Revert communique->commId", $communique->commId(), 0);
    if ($communique->commId() != 0) {
      $communique->initializeFromDatabase($communique->commId(), $_POST);
      $communique->belch('50', $belchFlow); 
    }
  } 
  else {
    echo ("ERROR - NO DATA POSTED. Tell David. <br>\r\n");
  }
    
// ---------------------------------------------------------------------------------------------

$communiqueWasSent = $communique->wasSent();
?>
      <form name='MediaReceiptEmailText' action='informArtistsOfMediaReceiptText.php' method='post'>
<!--
            onSubmit='document.getElementById("to").value="<hp echo $communique->nominalTo(); ?>";
                      document.getElementById("from").value="<hp echo $communique->nominalFrom(); ?>";
                      document.getElementById("subject").value="<hp echo $communique->subject(); ?>";
                      '>
-->
          <table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right" valign="middle" class="bodyTextOnDarkGray" style="padding:12px 10px 4px 8px">
<!--                <div style="border:solid;border-width:thin;padding:8px">  -->
                  <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr style="padding:8px;">
                      <td style="text-align:left;">
                        <span class="programPageTitleText" style="vertical-align:text-bottom;"><?php
                          echo ((!$communiqueWasSent) ? 'Inform Artist' : 'Artist Informed') . ' of Media Receipt'; ?> </span>
<!-- Administrator Selector -->
<!-- This is done in the list window rather than this email text-oriented window. -->
<!-- End Administrator Selector -->
                      </td>
                      <td align="right">&nbsp;
                      </td>
                    </tr>
                  </table>
<!--                </div>  -->
              </td>
            </tr>
            <tr>
<?php 
  $padding = (!$communiqueWasSent) ? 'padding:4px 10px 8px 8px' : 'padding:0';
  echo '              <td align="center" valign="middle" class="bodyTextOnDarkGray" style="' . $padding . '">';
  echo '                <div style="border:solid;border-width:thin;padding:0 0 2px 0; margin-bottom:8px;">';
  $communique->displayPotentiallyReferencedWorks();
  echo '                </div>';
  if (!$communiqueWasSent) {
    echo '                <div class="bodyTextOnDarkGray" style="border:solid;border-width:thin;padding:8px">';
    echo '                  <input type="submit" id="submitRegen" name="Submit" style="margin:0 3px 0 3px;padding-left:2px;padding-right:2px;" value="Regenerate"';
    echo ($communiqueWasSent || $communique->suppress()) ? 'disabled>' : '>'; 
    echo '                  <input type="submit" id="submitRevert" name="Submit" style="margin:0 3px 0 3px" value="Revert"';
    echo ((!$communique->wasSaved() || $communiqueWasSent || $communique->suppress())) ? 'disabled>' : '>'; 
    echo '                  <input type="submit" id="submitSave" name="Submit" style="margin:0 3px 0 3px" value="Save"';
    echo ($communiqueWasSent || $communique->suppress()) ? 'disabled>' : '>';
    echo '									<input type="submit" id="submitSend" name="Submit" style="margin:0 3px 0 3px" value="Send"';
    echo ($communiqueWasSent || $communique->suppress()) ? 'disabled' : ''; 
/*
    // NOTE This is one of the two uses of $this->emailWidgetId(). 
//    $markMrListItemSentText = 'return markMrListItemSent(' . $communique->emailWidgetId() 
//      . ', mrEmailSentWidgetMarkupJS(' . $communique->commId() . ', ' . $communique->recipientId() . ', ' . $communique->emailWidgetId() . '));';
//    $debugger->becho('markMrListItemSentText', $markMrListItemSentText, 0);
//    echo ' onClick=\'' . $markMrListItemSentText;
*/
    echo '\'>';
    echo '                </div>';
  } 
  $communique->displayAsHiddenInputFields(); 
  echo '              </td>';
?>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                <?php echo htmlspecialchars($communique->to()) ?><br>
                From: <?php echo htmlspecialchars($communique->from()) ?><br>
                Subject: <?php echo htmlspecialchars($communique->subject()); ?><br>
                Date: <?php echo $communique->nominalDateSent(); ?> 
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:10px 10px 10px 12px"><textarea cols="80" 
                rows="25" name="contentText" id="contentText" class="curationFormTextArea"
                style="padding:12px;margin:0 -8px 0 -2px;line-height:125%;" 
                <?php if ($communiqueWasSent) echo 'readonly="readonly"' ?>><?php echo $communique->message() ?></textarea>
              </td>
            </tr>
          </table>
<?php unset($communique); ?>
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
