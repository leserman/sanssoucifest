<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Sans Souci Festival of Dance Cinema - Administrative Email Generation</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php
  include '../bin/forms/entryFormFunctions.php';
  include 'dataEntryFunctions.php';
  include 'databaseSupportFunctions.php';

/* TODO: These 2 paired lines appear several times:
   
      $_SESSION['ArEmailMessage'] = $workRow['contentText'];
      $_SESSION['ArEmailTo'] = encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
             
   Really, the four items 

      $_SESSION['ArEmailMessage']
      $_SESSION['ArEmailTo'] 
      $_SESSION['ArEmailFrom']
      $_SESSION['ArEmailSubject'] 
        
    should be grouped into an object. As it is now, $_SESSION['ArEmailMessage'] is a return value from 
    generateAccRejEmail() and the other 3 are side-effected.
*/    

  // Generates and returns the email text. Side-effects $_SESSION['ArEmailTo'], $_SESSION['ArEmailFrom'] & $_SESSION['ArEmailSubject']
  function generateEmail($workRow, $requestClipPermission, $inviteFeedbackRequest) {
    //debugLogLineUn("executing generateAccRejEmail()");

    $_SESSION['ArEmailTo'] =      encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
    $_SESSION['ArEmailFrom'] =    'Curators@sanssoucifest.org';
    $_SESSION['ArEmailSubject'] = 'Sans Souci Festival of Dance Cinema';
    
    //debugLogLineUn("SESSION[ArEmailTo] = |" . $_SESSION['ArEmailTo'] . "|");
    
    $message     = "Dear " . $workRow['name'] . ",\r\n\r\n";
    
    if ($workRow['accepted']==1) {
/*
     $message .= "Thank you so much for submitting your film, \"" . $workRow['title'] . ",\" to the "
                . "Sans Souci Festival of Dance Cinema. It will be our pleasure to screen it at our 5th annual Festival. "
                . "We had entries from all over the world and we're excited to offer two evenings of dance cinema shorts, "
                . "documentaries, installations, and live multi-media dance performance.\r\n\r\n";
*/                
      $message .= "Congratulations! It will be our pleasure to screen your film, \"" . $workRow['title'] . 
                ",\" at our Fifth Annual Sans Souci Festival of Dance Cinema. Thank you so much for your submission.\r\n\r\n";
      $message .= "We had entries from all over the world and we're excited to offer two evenings of dance cinema shorts, "
                . "documentaries, installations, and live multi-media dance performance. ";
      $message .= "Screenings will be Friday and Saturday evenings, April 4 and 5, 2008, at BMoCA, "
                . "the Boulder Museum of Contemporary Art, 1750 13th Street, Boulder, Colorado, USA.\r\n\r\n";
      $message .= "You will be on our list for 2 complementary admission tickets to the event which you can use "
                . "to come both evenings or to bring a friend - just give your name at the door. We will publish the "
                . "run of the show by mid-March at http://sanssoucifest.org/programBMoCA2008.html so you see which day "
                . "your piece will be screened.\r\n\r\n";
//      $message .= "MICHELLE, HERE IS A GOOD PLACE TO ADD A PERSONALIZED PARAGRAPH IF YOU WANT. IN ANY CASE, BE SURE TO "
//                . "DELETE THIS REMINDER (AND THE BLANK LINE BELOW IT IF YOU DON'T WRITE SOME TEXT HERE).\r\n\r\n";
      if ($requestClipPermission) {
        $message .= "As part of our promotional effort we are creating a sample video of short clips "
                  . "(about 30 seconds) from pieces that we present. Please reply to permit or deny us use of a clip from "
                  . "\"" . $workRow['title'] . "\" for this purpose.\r\n\r\n";
      }
      if (stillImagesNeeded($workRow['photoLocation'])) {
        $message .= "We like to display a representative image of each piece we screen on our web site. Please send photos, "
                  . "screen captures, or web links to JPEGs of such to images@sanssoucifest.org. If you include a photo credit "
                  . "for the image we select, we'll use it; otherwise, we'll assume the image is an uncredited screen capture. "
                  . "Images should be 480 x 640 pixels or larger.\r\n\r\n";
      }
      $message .= "Again, congratulations and thank you for making such compelling work. I look forward to seeing more of "
                . "your work in the future and to the chance to meet and talk with you at the screening.\r\n\r\n";
    } else if ($workRow['rejected']==1) {
      $message .= "Thank you for submitting your film, \"" . $workRow['title'] . ",\" to the Sans Souci Festival of Dance Cinema.\r\n\r\n";
      $message .= "Regrettably we will be not presenting \"" . $workRow['title'] . "\" as part of our festival this year. "
                . "We had many excellent entries from all of over the world and our festival runs only two nights, "
                . "so we had to make some hard decisions.";
      if ($inviteFeedbackRequest) {          
        $message .= " If you would like specific feedback from our curators, please contact me and we'll gladly share our "
                  . "insights. I hope to see more of your work in the future.";
      }
      $message .= "\r\n\r\nVery best to you and your work.\r\n\r\n";
    }
    $message .= "Truly,\r\n\r\n"
              . "Michelle Ellsworth\r\n"
              . "Artistic Co-Director\r\n"
              . "Sans Souci Festival of Dance Cinema\r\n"
              . "http://sanssoucifest.org/";
    return $message;
  }
  
  function sendEmail($to, $from, $subject, $message) {
    $headers = "From: " . $from . "\r\n"
             . "Reply-To: " . $from . "\r\n"
             . "Bcc: curators@sanssoucifest.org\r\n"
             . "X-Mailer: PHP" . phpversion() . "\r\n"
             . "X-Apparently-To: " . $to;
//    $mailedData = mail('hamelb@sanssoucifest.org', $subject, $message . "\r\n\r\n", $headers); // FOR TESTING
    $mailedData = mail($to, $subject, $message . "\r\n\r\n", $headers); // FOR REAL
  }
  
  function requestClipPermissionText() {
    return ($_SESSION['RequestClipPermission']) ? "checked" : "";
  }
  
  function inviteFeedbackRequestText() {
    return ($_SESSION['InviteFeedbackRequest']) ? "checked" : "";
  }

  function emailWasSentText($workRow) {
    if (emailWasSent($workRow)) return ' disabled';
    else return '';
  }

  // Inserts an new person in the database from the $_SESSION array and returns $communicationId
  function insertCommunication($entryId, $personId, $arEmailMessageText, $sent, $userId) {
    $commInsertString = "INSERT INTO communications (recipient, template, sent, dateSent, type, sender, referencedWork, contentText, "
                                     . "contentFormatted, applicationToOpenFormattedText, physicalOrEmailOrVoice, inResponseTo, notes, "
                                     . "emailTo, emailFrom, emailSubject, "
                                     . "lastModificationDate, lastModifiedBy, contentLastModDate, contentLadModifiedBy) "
                                     . "VALUES (" . $personId  . ", NULL, " . $sent . ", NULL, 'AcceptReject', " . $userId . ", " . $entryId . ", "
                                     . quote($arEmailMessageText) . ", NULL, NULL, 'Email', NULL, NULL, " 
                                     . quote(decodeEmailAddress($_SESSION['ArEmailTo'])) . ", "
                                     . quote(decodeEmailAddress($_SESSION['ArEmailFrom'])) . ", " 
                                     . quote($_SESSION['ArEmailSubject']) . ", NOW(), " . $userId . ", NOW(), " . $userId . ")";
    debugLogLineQuery($commInsertString);
    $result = mysql_query($commInsertString); 
    $communicationId = ($result) ? mysql_insert_id() : 0;  // This is the RIGHT way to get an AUTO-INCREMENT Id from a table
    debugLogLine("Insert Query Finished -- result = " . $result); 
    debugLogQuery($result, $commInsertString);
    return $communicationId;
  }

  function updateCommunication($communicationId, $arEmailMessageText, $sent, $userId) {
    $commUpdateString = "UPDATE communications set contentText = " . quote($arEmailMessageText) 
                              . ", sent = " . $sent
                              . ", emailTo = " . quote(decodeEmailAddress($_SESSION['ArEmailTo']))
                              . ", emailFrom = " . quote(decodeEmailAddress($_SESSION['ArEmailFrom']))
                              . ", emailSubject = " . quote($_SESSION['ArEmailSubject'])
                              . ", lastModificationDate = NOW(), lastModifiedBy = " . $userId 
                              . ", contentLastModDate = NOW(), contentLadModifiedBy = " . $userId 
                              . " where communicationId = " . $communicationId;
    debugLogLineQuery($commUpdateString);
    $result = mysql_query($commUpdateString); 
    debugLogLine("Communication Update Query Finished -- result = " . $result); 
    debugLogQuery($result, $commUpdateString);
    return $result;
  }
  
  function debugLogLineTrace($string) {
    //debugLogLineUn($string);
  }

  $connectionSuccess = connectToDB();
  $emailBodyText = file_get_contents("callForEntriesTemplate.txt");

?>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="630"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></td>
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

<?php

  $userId = 1; // David  - TODO: detect the userId from login
  
  $_SESSION['RequestClipPermission'] = (isset($_POST['RequestClipPermission']) && ($_POST['RequestClipPermission'] == 'clipPermission')) ? 1 : 0;
  //debugLogLineUn("SET A requestClipPermission=|" . $requestClipPermission . "|");
  $_SESSION['InviteFeedbackRequest'] = (isset($_POST['InviteFeedbackRequest']) && ($_POST['InviteFeedbackRequest'] == 'feedbackRequest')) ? 1 : 0;

  debugLogLine("POST[RequestClipPermission] = " . $_POST['RequestClipPermission']);
  //debugLogLineUn("SESSION(RequestClipPermission) = " . $_SESSION['RequestClipPermission']);
  debugLogLine("POST[Submit] = " . $_POST['Submit']);

  // Entry just selected from list.
  if (isset($_GET['entryId'])) {
    debugLogLineTrace("Open - GET[EntryId] = " . $_GET['entryId']);
    $entryId = $_GET['entryId'];
    $workRow = selectAccRejWorkRow($entryId);
    $_SESSION['communicationId'] = $workRow['communicationId'];
    if (!isset($_POST['RequestClipPermission'])) $_SESSION['RequestClipPermission'] = true;
    //debugLogLineUn("SET B requestClipPermission=|" . $requestClipPermission . "|");
    if (!isset($_POST['InviteFeedbackRequest'])) $_SESSION['InviteFeedbackRequest'] = true;
    if (isset($_SESSION['communicationId'])) {
      $_SESSION['ArEmailMessage'] = $workRow['contentText'];
      $_SESSION['ArEmailTo'] = encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
    }
    else $_SESSION['ArEmailMessage'] = generateAccRejEmail($workRow, $_SESSION['RequestClipPermission'], $_SESSION['InviteFeedbackRequest']);
  } 
  // Save was clicked.
  else if ($_POST['Submit'] == 'Save') {
    debugLogLineTrace("Save - POST[EntryId] = " . $_POST['EntryId']);
    $entryId = $_POST['EntryId'];
    if (!isset($_SESSION['communicationId'])) { // this is a new communication
      $workRow = selectAccRejWorkRow($entryId);
      $_SESSION['communicationId'] = insertCommunication($entryId, $workRow['personId'], $_POST['ArEmailMessageText'], 0, $userId);
    } else { // this is an update
      updateCommunication($_SESSION['communicationId'], $_POST['ArEmailMessageText'], 0, $userId);
    }
    $workRow = selectAccRejWorkRow($entryId);
    $_SESSION['ArEmailMessage'] = $workRow['contentText'];
    $_SESSION['ArEmailTo'] = encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
  } 
  // Send was clicked.
  else if ($_POST['Submit'] == 'Send') {
    debugLogLineTrace("Send - POST[EntryId] = " . $_POST['EntryId']);
    $emailWasAlreadySent = false;
    $entryId = $_POST['EntryId'];
    $tempWorkRow = selectAccRejWorkRow($entryId);
    if (!isset($_SESSION['communicationId'])) { // This is a new communication.
      debugLogLineTrace("This is a new communication.");
      $_SESSION['communicationId'] = insertCommunication($entryId, $tempWorkRow['personId'], $_POST['ArEmailMessageText'], 1, $userId);
    } else { // This is a communication update.
      debugLogLineTrace("This is a communication update.");
      $emailWasAlreadySent = emailWasSent($tempWorkRow);
      if (!$emailWasAlreadySent) { // This check ensures that won't be updated on a browser refresh.

        debugLogLineTrace("emailWasAlreadySent.");
        updateCommunication($_SESSION['communicationId'], $_POST['ArEmailMessageText'], 1, $userId);
      }
    }
    $workRow = selectAccRejWorkRow($entryId);
    $_SESSION['ArEmailMessage'] = $workRow['contentText'];
    $_SESSION['ArEmailTo'] = encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
    //debugLogLineUn("<br>workRow[contentText] = |" . $workRow['contentText'] . "|<br><br>");
    //debugLogLineUn("<br>SESSION[ArEmailMessage] = |" . $_SESSION['ArEmailMessage'] . "|<br><br>");
    //debugLogLineUn("<br>POST[ArEmailMessageText] = |" . $_POST['ArEmailMessageText'] . "|<br><br>");
    if (!$emailWasAlreadySent) { // This check ensures that email can't be resent on a browser refresh.
      sendEmail(decodeEmailAddress($_SESSION['ArEmailTo']), decodeEmailAddress($_SESSION['ArEmailFrom']),
                $_SESSION['ArEmailSubject'], $_SESSION['ArEmailMessage']);
    }
  } 
  // Regenerate was clicked.
  else if ($_POST['Submit'] == 'Regenerate') {
    debugLogLineTrace("Regenerate - POST[EntryId] = " . $_POST['EntryId']);
    $entryId = $_POST['EntryId'];
    $workRow = selectAccRejWorkRow($entryId);
    $_SESSION['ArEmailMessage'] = generateAccRejEmail($workRow, $_SESSION['RequestClipPermission'], $_SESSION['InviteFeedbackRequest']);
  } 
  // Revert was clicked.
  else if ($_POST['Submit'] == 'Revert') {
    debugLogLineTrace("Revert - POST[EntryId] = " . $_POST['EntryId']);
    $entryId = $_POST['EntryId'];
    $workRow = selectAccRejWorkRow($entryId);
    if (isset($_SESSION['communicationId'])) {
      $_SESSION['ArEmailMessage'] = $workRow['contentText'];
      $_SESSION['ArEmailTo'] = encodeEmailAddress('"' . $workRow['name'] . '"<' . $workRow['email'] . '>');
    }
  } 
  else {
    debugLogLine("ERROR - NO DATA POSTED");
  }

  debugLogLine("entryId = " . $entryId);
  
    
/*  todo 
      if (isset(communicationId)) then 
        this comm has been saved so display it rather than generate it.
        if (sent) then it can't be edited, sent, saved, or regenerated
*/        

?>
      <form name='CurationEmailText' action='curationAccRejEmailText.php' method='post'>
          <table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right" valign="middle" class="bodyTextOnDarkGray" style="padding:12px 10px 4px 8px">
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
              </td>
            </tr>
            <tr>
              <td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:4px 10px 8px 8px">
                <div style="border:solid;border-width:thin;padding:8px">
                  <?php if ($workRow['accepted']==1) echo '<input type="checkbox" name="RequestClipPermission" id="requestClipPermission" value="clipPermission" ' . 
                    requestClipPermissionText() . emailWasSentText($workRow) . '><label for="requestClipPermission">Request clip permission. </label>' ?>
                  <?php if ($workRow['rejected']==1) echo '<input type="checkbox" name="InviteFeedbackRequest" id="inviteFeedbackRequest" value="feedbackRequest" ' .
                    inviteFeedbackRequestText() . emailWasSentText($workRow) . '><label for="inviteFeedbackRequest">Invite feedback request. </label>' ?>
                  <input type="submit" id="submitRegen" name="Submit" style="margin:0 3px 0 3px;padding-left:2px;padding-right:2px;" 
                                                                                            value="Regenerate" <?php if (emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitRevert" name="Submit" style="margin:0 3px 0 3px" value="Revert" <?php if ((!emailWasSaved($workRow)) || emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitSave" name="Submit" style="margin:0 3px 0 3px" value="Save" <?php if (emailWasSent($workRow)) echo 'disabled' ?> >  
                  <input type="submit" id="submitSend" name="Submit" style="margin:0 3px 0 3px" value="Send" <?php if (emailWasSent($workRow)) echo 'disabled' ?> 
                    onClick="return markListItemSentOnClick('<?php echo emailSentMarkupId($entryId) ?>', emailSentIconMarkupJS(<?php echo $entryId ?>));">
                  <input type="hidden" id="entryId" name="EntryId" value=<?php echo $entryId; ?> >
                </div>
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:0px 10px 0px 10px">To: 
                    <?php echo (emailWasSent($workRow)) ? encodeEmailAddress($workRow['emailTo']) : $_SESSION['ArEmailTo']; ?><br>
              From: <?php echo (emailWasSent($workRow)) ? encodeEmailAddress($workRow['emailFrom']) : $_SESSION['ArEmailFrom']; ?><br>
              Subject: <?php echo (emailWasSent($workRow)) ? $workRow['emailSubject'] : $_SESSION['ArEmailSubject']; ?><br>
              Date: <?php echo (emailWasSent($workRow)) ? $workRow['contentLastModDate'] : 'Now'; ?> 
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle" class="bodyTextOnDarkGray" style="padding:10px 10px 10px 10px"><textarea cols="80" 
                rows="37" style="padding:4px 4px 4px 4px;" name="ArEmailMessageText" id="arEmailMessageText" class="curationFormTextArea"
                <?php if (emailWasSent($workRow)) echo 'readonly' ?>><?php echo $_SESSION['ArEmailMessage'] ?></textarea>
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
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br><!-- #BeginLibraryItem "/Library/CopyrightContactBarOnBlack.lbi" --><?php SSFWebPageAssets::displayCopyrightLine();?><!-- #EndLibraryItem --></td>
    <td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
</html>

