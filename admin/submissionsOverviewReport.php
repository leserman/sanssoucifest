<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Submissions Overview Report for <?php echo SSFRunTimeValues::getCurrentYearString(); ?></title>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
                    <div style="background-color:#333333;text-align:center;float:none;">
<?php
  function tdTag($bgnd, $align, $padLeft="4px") {
    return "          <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align 
                                                                 . ";padding-left:" . $padLeft . ";padding-right:4px;'>";
  }
  function makeCheckbox($checkboxNameId, $boolValue) {
//    echo "        <label for='" . $checkboxNameId . "'>" . $label . "</label>\r\n";
    echo "&nbsp;<input type='checkbox' name='" . $checkboxNameId . "' id='" . $checkboxNameId . "'" . (($boolValue) ? " checked='checked' " : " ") 
                   . "onclick='javascript:setCache(\"" . $checkboxNameId . "\"," . $boolValue . ");submit();'>&nbsp; \r\n";
  }

  function nextDesignatedId() { // This does the same thing as nextDesId() in ssf.js
    // Query to get the current max designatedId
    // Compute the new designagtedId
    $result = SSFDB::getDB()->getArrayFromQuery('SELECT MAX(designatedId) AS maxId FROM works');
    $maxIdText = $result[0]['maxId'];
    SSFDebug::globalDebugger()->becho('maxIdText', $maxIdText, -1);
    $parts = explode('-', $maxIdText);
    SSFDebug::globalDebugger()->belch('parts', $parts, -1);
    $suffixValue = intval($parts[1]);
    $newDesId = sprintf('%02d-%03d', $parts[0], ++$suffixValue);
    SSFDebug::globalDebugger()->belch('newDesId', $newDesId, -1);
    return $newDesId;
  }

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
          $newDesId = nextDesignatedId();
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
  
  $query = "SELECT workId, designatedId, title, submitter, name, (dateMediaReceived IS NOT NULL AND dateMediaReceived != '0000-00-00') AS video, "
         . "((photoLocation IS NOT NULL AND photoLocation != '') OR (photoURL IS NOT NULL AND photoURL != '')) AS stills, "
         . "(datePaid IS NOT NULL AND datePaid != '0000-00-00') AS paid, howPaid, "
         . "works.creationDate AS submissionTime, dateMediaPostmarked, dateMediaReceived, datePaid, photoLocation, photoURL, countryOfProduction, runTime, "
         . "permissionsAtSubmission, email, nickName, vimeoWebAddress "
         . "FROM works JOIN people ON submitter = personId "
         . "WHERE withdrawn=0 AND callForEntries=" . SSFRunTimeValues::getInitialCallForEntriesId() . $videoWhereClause . $stillsWhereClause . $paidWhereClause
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
  <div>
    <div class='datumDescription' style='float:left;margin:6px;margin-top:10px;'>
      <table border='1'>
        <tr>
          <th class='datumDescription' style='text-align:left;width:150px;'>&nbsp;Show:</th>
          <th class='datumDescription' style='text-align:center;width:80px;'>&nbsp;Video&nbsp;</th>
          <th class='datumDescription' style='text-align:center;width:80px;'>&nbsp;Stills&nbsp;</th>
          <th class='datumDescription' style='text-align:center;width:80px;'>&nbsp;Payment&nbsp;</th>
        </tr>
        <tr>
          <td class='datumDescription' style='text-align:right;'>Received:&nbsp;</td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showVideoReceived', $showVideoReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showImagesReceived', $showImagesReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showPaymentReceived', $showPaymentReceived, ''); ?></td>
        </tr>
        <tr>
          <td class='datumDescription' style='text-align:right;'>Not&nbsp;Yet&nbsp;Received:&nbsp;</td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showVideoNotReceived', $showVideoNotReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showImagesNotReceived', $showImagesNotReceived, ''); ?></td>
          <td class='datumDescription' style='text-align:center;'><?php echo makeCheckbox('showPaymentNotReceived', $showPaymentNotReceived, ''); ?></td>
        </tr>
      </table>
    </div> 
    <div class='datumDescription' style='float:left;max-width:240px;padding:10px 20px 0 20px;'>Legend for table below: 
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
  echo '    </div>'  . '<br clear="all">' . "\r\n";
  // echo summary line
  echo "    <div class='datumDescription' style='padding-left:10px;'>(" . count($submissionRows) . " records " . "sorted by " . $orderByDisplayString . ")</div>\r\n";
  // echo table header
  $bgnd = '#CCCCCC';
  echo "      <table border='0' cellpadding='2' cellSpacing='0' style='padding-left:10px;'>\r\n";
  echo "        <tr>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='des-Id'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='title'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='submitter'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='video'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='stills'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='paid'>\r\n           </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='submitted'>\r\n           </td>\r\n";
  echo "          <td><input type='hidden' name='sortBy0' value='" . $sortBy[0] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy1' value='" . $sortBy[1] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy2' value='" . $sortBy[2] . "'></td>\r\n";
  echo "        </tr>\r\n";

  // echo table rows
  $notReceivedSymbolText = "<img src='../images/notSymbol2.gif' alt='' style='margin:-1px 0;padding:0;height:17px;width=:17px;vertical-align:middle;'>";
  foreach ($submissionRows as $submissionRow) {
    SSFDebug::globalDebugger()->belch('', $submissionRow, -1);
    $genIdString = "<a href='javascript:void(0);' "
                 . "onclick='javascript:document.getElementById(\"workId\").value=" . $submissionRow["workId"] 
                 . ";document.getElementById(\"actionId\").value=\"genIdAction\";document.submissionOverviewForm.submit();'>" 
                 . $notReceivedSymbolText . "</a>";
    SSFDebug::globalDebugger()->becho('genIdString', $genIdString, -1);
    $paidDislay = '';
    SSFDebug::globalDebugger()->becho('submissionRow[paid]', $submissionRow['paid'], -1);
    SSFDebug::globalDebugger()->becho('submissionRow[howPaid]', $submissionRow['howPaid'], -1);
    if ($submissionRow['paid'] == 0) {
      $paidDislay = $notReceivedSymbolText;
      if (isset($submissionRow['howPaid']) && ($submissionRow['howPaid'] != '')) {
        if (($submissionRow['howPaid']) == 'paypal') $paidDislay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;Pp</span>';
        else if (($submissionRow['howPaid']) == 'check') $paidDislay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;Ck</span>';
      }
    }
    $videoDisplay = '';
    if ($submissionRow['video'] == 0) {
      $videoDisplay = $notReceivedSymbolText;
      if (!isset($submissionRow['vimeoWebAddress']) || ($submissionRow['vimeoWebAddress'] == '')) {
        $videoDisplay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;nP</span>';
        SSFDebug::globalDebugger()->becho('$videoDisplay', 'Concat 0', -1);
      } else { 
        $videoDisplay .= '<span class="smallBodyText" style="font-size:10px;">&nbsp;nD</span>';
        SSFDebug::globalDebugger()->becho('$videoDisplay', 'Concat 1', -1);
      }
    }
    if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
    echo "        <tr>\r\n";
    echo tdTag($bgnd, 'center') . ((isset($submissionRow['designatedId']) && ($submissionRow['designatedId'] != '')) ?  $submissionRow['designatedId'] : $genIdString)  . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $submissionRow['title'] . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $submissionRow['name'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . (($submissionRow['video'] == 0) ? $videoDisplay : "") . "</td>\r\n";
//    echo tdTag($bgnd, 'center') . (($submissionRow['stills'] == 0) ? $notReceivedSymbolText : "") . "</td>\r\n";
    echo tdTag($bgnd, 'center') . (HTMLGen::stillImagesAvailable($submissionRow['photoLocation'], $submissionRow['photoURL']) ? "" : $notReceivedSymbolText) . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $paidDislay . "</td>\r\n";
    echo tdTag($bgnd, 'center') . '&nbsp;' . str_replace(' ', '&nbsp;', date('D m/d H:i', strtotime($submissionRow['submissionTime']))) . "&nbsp;</td>\r\n";
    echo "        </tr>\r\n";
  }
  echo "      </table><br>\r\n";
  echo "  </form>\r\n";
?>
                    </div>
                  </td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom"><br>
            <?php SSFWebPageAssets::displayCopyrightLine();?></td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>