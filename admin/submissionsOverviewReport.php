<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
<!--  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
-->
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Submissions Overview Report for <?php echo SSFRunTimeValues::getCurrentYearString(); ?></title>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
<!--  <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css"> -->
  
  <!-- From from https://jqueryui.com/dialog/#modal-form on 5/6/15 -->
<!-- -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/ui-darkness/jquery-ui.css">
 
<!--  <script src="//code.jquery.com/jquery-1.11.3.js"></script> -->
  <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <!-- For jquery dialog/#modal-form on 5/6/15 -->
  <script type="text/javascript" src="http://sanssoucifest.org/bin/scripts/ssf-jqueryDialog.js"></script>
  <style>
  </style>

<style type="text/css">
  a.colTitle:link { color: blue; text-decoration: none; }
  a.colTitle:visited { color: blue; text-decoration: none; } 
  a.colTitle:hover { color: red; text-decoration: none; }
</style>
<script type="text/javascript">
  function setCache(id, priorValue) {
    newValue = 1;
    if (priorValue == 1) { newValue = 0; }
    document.getElementById(id + 'Cache').value = newValue;
  }
</script>
</head>
<!-- <body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000"> -->
<body>
<!-- NOTES
  JQuery potential download arrow icon - ui-icon-arrowthick-1-s - http://api.jqueryui.com/theming/icons/
-->
<?php
  $unknownSymbolText = "<img src='../images/QIcon16.png' alt='' style='margin:-1px 0;padding:0;height:16px;width=:16px;vertical-align:middle;'>";
  $notReceivedSymbolText = "<img src='../images/notSymbol2.gif' alt='' style='margin:-1px 0;padding:0;height:17px;width=:17px;vertical-align:middle;'>";
  $emptyDisplay = '<span style="color:#999999;">' . '|' . '</span>';
  $checkmark = '&#10003;';
  $checkmarkDisplay = '<span style="color:#999999;">' . $checkmark . '</span>';
  $dialogDesId = '';
?>

<!-- POPUP DIALOG FORM - POPUP DIALOG FORM - POPUP DIALOG FORM - POPUP DIALOG FORM - POPUP DIALOG FORM - POPUP DIALOG FORM  - POPUP DIALOG FORM - POPUP DIALOG FORM -->
<div id="dialog-form" title="Update <?php echo $dialogDesId; ?>" style="display:none;">
  <style type="text/css" scoped>
/*    body { font-size: 65%; } */
    #dialog-form label, #dialog-form input { display:block; }
    #dialog-form input.text { margin-top:2px; margin-bottom:12px; width:95%; padding: .4em; }
    #dialog-form fieldset { padding:0; border:0; margin-top:12px; }
    #dialog-form .ui-dialog .ui-state-error { padding: .3em; }
    #dialog-form .validateTips { border: 1px solid purple; padding: 0.3em; }
  	.ui-corner-all { border-radius: 0; }
  	.ui-widget.videoButton { font-size: 10px; font-weight: normal; color: black; }
  	.videoButton .ui-button-text { padding: 0; }
  	#dialog-form .uiButtonText { font-size: 75%; }
  	.videoButton.ui-button { margin-right: 0; }
  	.videoButton.ui-state-default { background-color: transparent; border-color: transparent; background-image: none; }
  	.ui-icon-custom { background-image: url(images/custom.png); }
  	.ui-dialog-title { font-size: 14px; }
  	.ui-dialog-titlebar-close { width: 10px; height: 10px; }
  </style>
  <form style="border:1px orange solid;margin:4px auto;padding:0px 18px 0 30px;font-size:75%">
    <fieldset>
      <label for="desId">Designated Id</label>
      <input type="text" name="desId" id="desId" value="<?php echo $dialogDesId; ?>" class="text ui-widget-content ui-corner-all" disabled>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="Jane Smith" class="text ui-widget-content ui-corner-all">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="jane@smith.com" class="text ui-widget-content ui-corner-all">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" value="xxxxxxx" class="text ui-widget-content ui-corner-all">
 
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
    </fieldset>
  </form>
</div>

<!-- For Submissions Overview Page -->
<div class='page' style="min-width:920px;"><div class='pageArea'>
<table style="width:100%;border:none;text-align:center;margin:0;padding:0;background-color:black;">
<tr><td style="text-align:center;vertical-align:top;">
  <table style="border:none;text-align:center;margin:0 auto;padding:0;"> <!-- was 745 background-color:black; -->
    <tr>
      <td colspan="3" class="topLeft"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" style="width:750px;height:63px;border:none;text-align:top;padding:8px 0;"></a></td>
      <td style="width:10px;" class="topLeft">&nbsp;</td>
    </tr>
    <tr>
      <td style="width:10px;text-align:center;vertical-align:top;">&nbsp;</td>
      <td  style="width:125px;text-align:center;vertical-align:top;"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
      <td class="topCenter">
        <table style="text-align:center;padding:0;margin:0;background-color:black;">
          <tr>
            <td style="width:25px;" class="topLeft sprocketHoles">&nbsp;</td>
            <td style="width:10px;" class="topLeft programTablePageBackground">&nbsp;</td>
            <td class="topLeft" style="background-color:#333;padding-bottom:12px;">
              <div style="background-color:#333333;text-align:center;float:none;">
<?php
  function tdTag($bgnd, $align, $padLeft="4px") {
    return "          <td class='bodyTextOriginal' style='color:#000;padding-top:1px;padding-bottom:1px;height:21px;min-width:40px;vertical-align:middle;background-color:"
                       . $bgnd . ";text-align:" . $align . ";padding-left:" . $padLeft . ";padding-right:4px;'>";
  }
  
  function makeCheckbox($checkboxNameId, $boolValue) {
//    echo "        <label for='" . $checkboxNameId . "'>" . $label . "</label>\r\n";
    echo "&nbsp;<input type='checkbox' name='" . $checkboxNameId . "' id='" . $checkboxNameId . "'" . (($boolValue) ? " checked='checked' " : " ") 
                   . "onclick='javascript:setCache(\"" . $checkboxNameId . "\"," . $boolValue . ");submit();'>&nbsp; \r\n";
  }

//SSFDB::beginInstrumentation();
$overallTimer = new SSFTimer('Overall Timer');
  SSFDebug::globalDebugger()->belch('_POST', $_POST, -1);
  
  $showVideoReceived = (isset($_POST['showVideoReceivedCache'])) ? $_POST['showVideoReceivedCache'] : 1;
  $showVideoNotReceived = (isset($_POST['showVideoNotReceivedCache'])) ? $_POST['showVideoNotReceivedCache'] : 1;
  $videoWhereClause = ($showVideoReceived && $showVideoNotReceived) ? "" 
                    : ((!$showVideoReceived && !$showVideoNotReceived) ? " AND FALSE"
                    : (($showVideoReceived) ? " AND (dateMediaReceived IS NOT NULL AND dateMediaReceived != '0000-00-00')" 
                    : (($showVideoNotReceived) ? " AND (dateMediaReceived IS NULL OR dateMediaReceived = '0000-00-00')" : "")));

  $showImagesReceived = (isset($_POST['showImagesReceivedCache'])) ? $_POST['showImagesReceivedCache'] : 1;
  $showImagesNotReceived = (isset($_POST['showImagesNotReceivedCache'])) ? $_POST['showImagesNotReceivedCache'] : 1;
  $stillsWhereClause = ($showImagesReceived && $showImagesNotReceived) ? "" 
                     : ((!$showImagesReceived && !$showImagesNotReceived) ? " AND FALSE"
                     : (($showImagesReceived) ? " AND ((photoLocation IS NOT NULL AND photoLocation != '') OR (photoURL IS NOT NULL AND photoURL != ''))" 
                     : (($showImagesNotReceived) ? " AND ((photoLocation IS NULL OR photoLocation = '') AND (photoURL IS NULL OR photoURL = ''))" : "")));

  $showPaymentReceived = (isset($_POST['showPaymentReceivedCache'])) ? $_POST['showPaymentReceivedCache'] : 1;
  $showPaymentNotReceived = (isset($_POST['showPaymentNotReceivedCache'])) ? $_POST['showPaymentNotReceivedCache'] : 1;
  $paidWhereClause = ($showPaymentReceived && $showPaymentNotReceived) ? "" 
                   : ((!$showPaymentReceived && !$showPaymentNotReceived) ? " AND FALSE"
                   : (($showPaymentReceived) ? " AND (datePaid IS NOT NULL AND datePaid != '0000-00-00')" 
                   : (($showImagesNotReceived) ? " AND (datePaid IS NULL OR datePaid = '0000-00-00')" : "")));

  if (isset($_POST['sortBy0'])) { $sortBy[] = $_POST['sortBy0']; $sortBy[] = $_POST['sortBy1']; $sortBy[] = $_POST['sortBy2']; }
//  else $sortBy = array('`howPaid`', '`datePaid`', '`lastName`, `name`');
  else $sortBy = array('submitted', 'video', 'des-Id'); // 5/8/12
  SSFDebug::globalDebugger()->belch('sortBy-0', $sortBy, -1);
  if (isset($_POST['sortOnMe'])) { 
    $sortOnMe = (($_POST['sortOnMe'] == 'submitter') ? "lastName, name" : (($_POST['sortOnMe'] == 'des-Id') ? "designatedId" : $_POST['sortOnMe']));
    $sortBy[2] = $sortBy[1];
    $sortBy[1] = $sortBy[0];
    $sortBy[0] = $sortOnMe; 
  } else { // since this is the first time around (no $_POST)
    
  }
  SSFDebug::globalDebugger()->belch('sortBy-1', $sortBy, -1);
  SSFDebug::globalDebugger()->belch('$_POST', $_POST, -1);

  if (isset($_POST['actionId'])) {
    if ($_POST['actionId'] == 'genIdAction') {
      if (isset($_POST['workId']) && ($_POST['workId'] != '')) {
        // Confirm that this is not a refresh by checking to see if the work in question already has a designagtedId
        //SSFDB::debugNextQuery();
        $query0 = "SELECT workId, designatedId, titleForSort, filename, name FROM works JOIN people ON submitter=personId WHERE workId=" . $_POST['workId'];
        $queryRows = SSFDB::getDB()->getArrayFromQuery($query0);
        SSFDebug::globalDebugger()->belch('$queryRows', $queryRows, -1);
        print_r($queryRows, true);
        SSFDebug::globalDebugger()->belch('$queryRows[0]', $queryRows[0], -1);
        if ((count($queryRows) > 0) && isset($queryRows[0]['designatedId']) && $queryRows[0]['designatedId'] != '') {
          SSFDebug::globalDebugger()->becho('This is a refresh. The designatedId for ' . $queryRows[0]['workId'], $queryRows[0]['designatedId'], -1);
        } else { // since this is a valid action
          // Get the next sequential unused designatedId.
          $newDesId = SSFQuery::nextDesignatedId();
          SSFDebug::globalDebugger()->becho('New designatedId = ', $newDesId, -1);
          // Update the DB with the newly computed designatedId for the work associated with workId.
//          SSFDB::getDB()->debugNextQuery();
          $createNewDirectories = false;
          $keyValuePairsText = 'designatedId="' . $newDesId . '", ';
          if (!isset($queryRows[0]['filename']) || ($queryRows[0]['filename'] == '')) {
            $createNewDirectories = true;
            $computedFileName = HTMLGen::computedFileNameForWork($newDesId, $queryRows[0]['titleForSort'], $queryRows[0]['name']);
            $keyValuePairsText .= 'filename="' . $computedFileName . '", ';
          }
          $success = SSFDB::getDB()->saveData('UPDATE works SET ' . $keyValuePairsText
                  . ' lastModificationDate="' . SSFRunTimeValues::nowForDB() . '", lastModifiedBy=' . SSFAdmin::userIndex() 
                  . ' WHERE workId=' . $_POST['workId']);
          if ($success && $createNewDirectories) {
            $newDirName = $computedFileName;
            $makeDirPHP = 'http://localhost/~david/SSF-MakeFolders.php';
            $makeDirURL = $makeDirPHP . '?dirName=' . $newDirName;
            $browserWindowName = 'SSF_directory_creation';
            $openOptions = 'location=0,width=400,height=200';
            $openWindowParameters = "'" . $makeDirURL . "', '" . $browserWindowName . "', '" . $openOptions . "'";
            echo '<script type="text/javascript">';
            echo '  window.open(' . $openWindowParameters . ');';
            echo '</script>';
          }
          SSFDebug::globalDebugger()->becho('success', ($success) ? 'UPDATED' : 'NOT UPDATED', -1);
        }
      }
    } else if ($_POST['actionId'] == 'videoCheckInAction') {
      // Popup with date selection for dateMediaPostmarked if that is not yet defined.
      // Popup with date selection for dateMediaReceived if that is not yet defined.
    } else if ($_POST['actionId'] == 'stillsCheckInAction') {
      // Popup for date stills received via email to set photoLocation to 'email <date> & filed' - Also consider photoURL 4/14/13
    } else if ($_POST['actionId'] == 'paymentAction') {
      // Opens Paypal Payments screen
    } else if ($_POST['actionId'] != '') SSFDebug::globalDebugger()->becho('ERROR: ' . $_POST['actionId'] . ' is not a valid actionId. Tell David', $_POST['actionId'], 1);
  }

  $orderByString = '';
  $orderByDisplayString = '';
  $separator = '';
  $iter = 0;
  foreach ($sortBy as $sortByItem) { 
    $sortByItemQueryString = ($sortByItem == 'submitted') ? 'works.creationDate DESC' : (($sortByItem == 'des-Id') ? 'designatedId' : $sortByItem);
    $sortByItemDisplayString = ($sortByItem == 'lastName, name') ? 'submitter lastName & fullName' : $sortByItem;
    $iter++; 
    if ($iter > 3) break; 
    else { 
      $orderByString .= ($separator . $sortByItemQueryString); 
      $orderByDisplayString .= ($separator . $sortByItemDisplayString);
      $separator = ', '; 
    }
  }

  // From SSFCommunique::getMediaReceiptEmailNeededRows(): communicationId, communications.type, dateSent
  $query = "SELECT DISTINCT workId, designatedId, title, submitter, name, (dateMediaReceived IS NOT NULL AND dateMediaReceived != '0000-00-00') AS video, "
         . "((photoLocation IS NOT NULL AND photoLocation != '') OR (photoURL IS NOT NULL AND photoURL != '')) AS stills, "
         . "(datePaid IS NOT NULL AND datePaid != '0000-00-00') AS paid, howPaid, "
         . "works.creationDate AS submissionTime, dateMediaPostmarked, dateMediaReceived, datePaid, photoLocation, photoURL, countryOfProduction, runTime, "
         . "permissionsAtSubmission, email, nickName, vimeoWebAddress, "
         . "communicationId, communications.type AS commType, communications.dateSent AS commDate "
         . "FROM works "
         . "JOIN people ON submitter = personId "
         . "LEFT JOIN communicationWork ON workId=work " // TODO Test this when there are both Download Requests AND Media Receipts.
         . "LEFT JOIN communications on communicationId = communication AND (communications.type = 'DownloadRequest' OR communications.type = 'MediaReceipt') "
         . "WHERE withdrawn=0 AND callForEntries=" . SSFRunTimeValues::getInitialCallForEntriesId() 
         . $videoWhereClause . $stillsWhereClause . $paidWhereClause
         . " ORDER BY " . $orderByString;
//  SSFDB::getDB()->debugNextQuery();
  $submissionRows = SSFDB::getDB()->getArrayFromQuery($query);
  
  echo "  <form id='submissionOverviewForm' name='submissionOverviewForm' action='submissionsOverviewReport.php' method='post' style='margin-bottom:0;'>\r\n";
  echo '    <div class="programPageTitleText" style="padding-top:12px;padding-bottom:8px;">Submissions Overview for ' . SSFRunTimeValues::getCurrentYearString() . '&nbsp;&nbsp;' . HTMLGen::getTestBedDisplayString() . "\r\n";

  function vimeoEmailString($submissionRow, $linkText) {
    $emailAddr = '"' . $submissionRow['name'] . '" %3C' . $submissionRow['email'] . '%3E';
    $emailSubject = "Permission%20needed%20to%20download%20from%20Vimeo";
    $emailBody = "Hi,%20";
    $emailBody .= $submissionRow['nickName'] . ",\r\n\r\n";
    $emailBody .= "Thanks for your entry to Sans Souci Festival.\r\n\r\nI need your permission to download \"" . $submissionRow['title'] . "\" from Vimeo. ";
    $emailBody .= "Please go to our %3Ca href='http://sanssoucifest.org/onlineEntryForm/vimeoDownloadabilityInfo.php'%3EHow to make your Vimeo video downloadable page%3C/a%3E ";
    $emailBody .= "and follow the steps there to accomplish that.";
    SSFDebug::globalDebugger()->becho('emailBody', $emailBody, -1);
    return '<a href="mailto:' . $emailAddr . '&subject=' . $emailSubject . '&body=' . $emailBody . '>' . $linkText . '</a>';
  }

?>

  <!-- Display checkbox filter table -->
  <div style="color:#AAAAAA;">
    <div class='datumDescription' style='float:left;margin:10px 6px 6px 0;width:40%;color:inherit;border:1px solid #666666;padding:6px;'>
      <table style="">
        <tr>
          <th class='datumDescription' style='text-align:left;width:150px;color:inherit;'>&nbsp;Show:</th>
          <th class='datumDescription' style='text-align:center;width:80px;color:inherit;'>&nbsp;Video&nbsp;</th>
          <th class='datumDescription' style='text-align:center;width:80px;color:inherit;'>&nbsp;Stills&nbsp;</th>
          <th class='datumDescription' style='text-align:center;width:80px;color:inherit;'>&nbsp;Payment&nbsp;</th>
        </tr>
        <tr>
          <td class='datumDescription' style='text-align:right;color:inherit;'>Received:&nbsp;</td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showVideoReceived', $showVideoReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showImagesReceived', $showImagesReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showPaymentReceived', $showPaymentReceived, ''); ?></td>
        </tr>
        <tr>
          <td class='datumDescription' style='text-align:right;color:inherit;'>Not&nbsp;Yet&nbsp;Received:&nbsp;</td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showVideoNotReceived', $showVideoNotReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showImagesNotReceived', $showImagesNotReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;color:inherit;'><?php echo makeCheckbox('showPaymentNotReceived', $showPaymentNotReceived, ''); ?></td>
        </tr>
      </table>
    </div> 
    <div class='datumDescription' style='text-align:left;float:left;width:50%;padding:10px 20px 0 20px;color:inherit;'>Legend for table below: 
      For the video column, nP means not Provided and nD means not Downloaded. For the paid column, Pp means Paypal and Ck means Check.
    </div>
    <div style='clear:both;'></div>
  </div>
  
<?php
  // echo hidden values
  echo "      <input type='hidden' id='showVideoReceivedCache' name='showVideoReceivedCache' value='" . $showVideoReceived . "'>\r\n";
  echo "      <input type='hidden' id='showVideoNotReceivedCache' name='showVideoNotReceivedCache' value='" . $showVideoNotReceived . "'>\r\n";
  echo "      <input type='hidden' id='showImagesReceivedCache' name='showImagesReceivedCache' value='" . $showImagesReceived . "'>\r\n";
  echo "      <input type='hidden' id='showImagesNotReceivedCache' name='showImagesNotReceivedCache' value='" . $showImagesNotReceived . "'>\r\n";
  echo "      <input type='hidden' id='showPaymentReceivedCache' name='showPaymentReceivedCache' value='" . $showPaymentReceived . "'>\r\n";
  echo "      <input type='hidden' id='showPaymentNotReceivedCache' name='showPaymentNotReceivedCache' value='" . $showPaymentNotReceived . "'>\r\n";
  echo "      <input type='hidden' id='workId' name='workId' value=''>\r\n";
  echo "      <input type='hidden' id='designatedId' name='designatedId' value=''>\r\n";
  echo "      <input type='hidden' id='actionId' name='actionId' value=''>\r\n";
  
  echo "      <input type='hidden' name='sortBy0' value='" . $sortBy[0] . "'>\r\n";
  echo "      <input type='hidden' name='sortBy1' value='" . $sortBy[1] . "'>\r\n";
  echo "      <input type='hidden' name='sortBy2' value='" . $sortBy[2] . "'>\r\n";

  echo '    </div>'  . '<br style="clear:both;">' . "\r\n";
  // echo summary line
  echo "    <div class='datumDescription' style='text-align:left;padding-left:10px;color:#AAAAAA;'>(" . count($submissionRows) . " records " . "sorted by " . $orderByDisplayString . ")</div>\r\n";
  // echo table header
  $bgnd = '#CCCCCC';
  echo "      <table style='border:none;padding:2px;margin:0;padding-left:10px;'>\r\n";
  echo "        <tr>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='des-Id'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='title'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '8px') . "\r\n              <input type='submit' name='sortOnMe' value='submitter'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='video'>\r\n           </td>\r\n";  // will be used to send download email and to download
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='ack'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='stills'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='paid'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left', '4px') . "\r\n              <input type='submit' name='sortOnMe' value='submitted'>\r\n           </td>\r\n";
/*
  echo "          <td><input type='hidden' name='sortBy0' value='" . $sortBy[0] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy1' value='" . $sortBy[1] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy2' value='" . $sortBy[2] . "'></td>\r\n";
*/
  echo "        </tr>\r\n";

  function getVideoDisplayButtonText($kind, $enabled) {
    // TODO Set the button disabled = !$enabled.
    // Next line from http://stackoverflow.com/questions/3224537/change-the-icon-of-a-jquery-ui-button-with-own-image answer-9216681
    $videoDisplayButtonText = 
      '<div class="videoButton"><table><tr><td><img src="../images/notSymbol2.gif" style="vertical-align:middle;width:17px;height:17px;" /></td><td>&nbsp;' . $kind . '</td></tr></table></div>';
    return $videoDisplayButtonText;
  }

$imagesAvailableTimer = new SSFTimer('HTMLGen::stillImagesAvailable()');
$imagesAvailableTimer->pause();

  // echo table rows
  foreach ($submissionRows as $submissionRow) {
    SSFDebug::globalDebugger()->belch('submissionRow', $submissionRow, -1);

    // DesignatedId column display
    $genIdString = "<a href='javascript:void(0);' "
                 . "onclick='javascript:document.getElementById(\"workId\").value=" . $submissionRow["workId"] 
                 . ";document.getElementById(\"actionId\").value=\"genIdAction\";document.submissionOverviewForm.submit();'>" 
                 . $notReceivedSymbolText . "</a>";
    SSFDebug::globalDebugger()->becho('genIdString', $genIdString, -1);
    $desIdIsSet = (isset($submissionRow['designatedId']) && ($submissionRow['designatedId'] != ''));
    $dialogDesIdDisplay =  ($desIdIsSet) ?  $submissionRow['designatedId'] : $genIdString;
    SSFDebug::globalDebugger()->becho('dialogDesId', $dialogDesId, -1);

    // Video symbol computation
    $videoDisplay = $checkmarkDisplay;
    $mayNeedAcknowledgement = true;
    if ($submissionRow['video'] == 0) {
      $mayNeedAcknowledgement = false;
      $videoDisplay = $notReceivedSymbolText;
      if (!isset($submissionRow['vimeoWebAddress']) || ($submissionRow['vimeoWebAddress'] == '')) $kind = 'nP'; 
      else {
        $kind = 'nD'; // $kind is NotPublished or NotDownloaded.
        if (isset($submissionRow['commDate']) && $submissionRow['commDate'] !== '') $kind = '<span style="color:green;font-weight:bold;">nDpR</span>';
      }
      $videoDisplay = getVideoDisplayButtonText($kind, $desIdIsSet);
    }

    // Media Acknowledgement symbol computation
    $mediaAcknowledgementSent = ((isset($submissionRow['commType']) && $submissionRow['commType'] == 'MediaReceipt') &&
                               (isset($submissionRow['commDate']) && ($submissionRow['commDate'] != '') && $submissionRow['commDate'] != '0000-00-00 00:00:00'));
    if ($mayNeedAcknowledgement && !$mediaAcknowledgementSent) {
      $widgetId = SSFCommunique::computeEmailWidgetId($submissionRow['workId']); // for reference see SSFCommunique::mrEmailWidgetMarkup
      $ackRecptDisplay = '<span id="' . $widgetId . '" class="smallBodyText" style="font-size:10px;color:#666666;">' . $notReceivedSymbolText . '&nbsp;ack</span>';
    }
    else if ($mediaAcknowledgementSent) $ackRecptDisplay = $checkmarkDisplay;
    else $ackRecptDisplay = ''; // $emptyDisplay;
    
    // Stills symbol computation
    $stillsDisplay = $checkmarkDisplay;
    $stillsImagesDownloaded = HTMLGen::stillImagesDownloaded($submissionRow['photoLocation']);
$imagesAvailableTimer->resume();
    $stillsImagesAvailable = HTMLGen::stillImagesAvailable($submissionRow['photoLocation'], $submissionRow['photoURL']);
$imagesAvailableTimer->pause();
    if (!$stillsImagesDownloaded) {
      $stillsDisplay = $notReceivedSymbolText;
      if ($stillsImagesAvailable) 
        $stillsDisplay .= '<span class="smallBodyText" style="font-size:10px;color:#af253c;">&nbsp;url</span>';
      else
        $stillsDisplay = $unknownSymbolText;
    }
    
    // Payment symbol computation
    $paidDislay = $checkmarkDisplay;
    SSFDebug::globalDebugger()->becho('submissionRow[paid]', $submissionRow['paid'], -1);
    SSFDebug::globalDebugger()->becho('submissionRow[howPaid]', $submissionRow['howPaid'], -1);
    if ($submissionRow['paid'] == 0) {
      $paidDislay = $notReceivedSymbolText;
      if (isset($submissionRow['howPaid']) && ($submissionRow['howPaid'] != '')) {
        if (($submissionRow['howPaid']) == 'paypal') $paidDislay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;Pp</span>';
        else if (($submissionRow['howPaid']) == 'check') $paidDislay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;Ck</span>';
      }
    }
    
    if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
    echo "        <tr>\r\n";
    echo tdTag($bgnd, 'center') . $dialogDesIdDisplay  . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $submissionRow['title'] . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $submissionRow['name'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $videoDisplay . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $ackRecptDisplay . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $stillsDisplay . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $paidDislay . "</td>\r\n";
    echo tdTag($bgnd, 'center') . '&nbsp;' . str_replace(' ', '&nbsp;', date('D m/d H:i', strtotime($submissionRow['submissionTime']))) . "&nbsp;</td>\r\n";
    echo "        </tr>\r\n";
    

  }
  echo "      </table><br>\r\n";
  echo "  </form>\r\n";
  
//$imagesAvailableTimer->stopAndDisplayResult();
//$overallTimer->stopAndDisplayResult();
?>
                    </div>
                  </td>
                  <td style="width:10px;" class="topLeft programTablePageBackground">&nbsp;</td>
                  <td style="width:25px;" class="topLeft sprocketHoles">&nbsp;</td>
                </tr>
              </table>
            </td>
            <td style="width:10px;" class="topLeft">&nbsp;</td>
          </tr>
          <tr class="topCenter">
            <td colspan="2">&nbsp;</td>
            <td class="bottomCenter"><br>
            <?php SSFWebPageAssets::displayCopyrightLine();?></td>
            <td style="width:10px">&nbsp;</td>
          </tr>
          <tr class="topCenter">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
                    </div></div>
</body>
</html>