<?php 
  require_once('../classes/SSFVimeo.php');
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Plug Frame Sizes from Vimeo</title>
  <script src="../scripts/databaseSupportFunctions.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000" onload="doNothingBreakpointOpportunity('adminDataEntry.php called from onload');">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<!-- <table width="800"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <! was 745 -->
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <!-- was 745 -->
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../../index.php"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
    <td align="center" valign="top">
<!--      <table width="665" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> -->
      <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr><!-- InstanceBeginEditable name="Content" -->
          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
            <div>
              <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;margin:0 4px 6px 4px;background-color:black;'>
              </div>
              <div class="programPageTitleText" style="padding-top:8px;padding-bottom:4px;padding-left:8px;text-align:left;">Plug Frame Sizes from Vimeo
                <?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?><br>
              </div>
              <div style="clear:both;"></div>
            </div>
            <div style="text-align:left;">

<?php
  // include php code
  $filePathArray = explode('/', __FILE__);
  $loopIndex = 0;
  foreach ($filePathArray as $element) { 
    $loopIndex++;
    if ($element == 'sanssoucifest.org') { break; } 
  }
  $codeBase = "";
  for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
  include_once $codeBase . "bin/utilities/autoloadClasses.php";

  // Initialization
  $callForEntries = SSFRunTimeValues::getInitialCallForEntriesId();
  $acceptedOnly = TRUE;
  SSFDebug::globalDebugger()->becho('callForEntries', $callForEntries, 1);
  
  $worksSelectString = "SELECT workId, designatedid, title, frameWidthInPixels, frameHeightInPixels, aspectRatio, ratio,"
                     . " frameWidthInPixels/frameHeightInPixels as computedAspectRatio, anamorphic, vimeoWebAddress, vimeoPassword"
                     . " FROM works LEFT JOIN aspectRatios ON aspectRatio = aspectRatioId"
                     . " WHERE callForEntries=" . $callForEntries . (($acceptedOnly) ? " AND accepted=1" : "");
  $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
  
  foreach ($workRows as $workRow) { 
    $diagnosticInfoString = $workRow['workId'] . ', ' . $workRow['designatedid'] . ', "' . $workRow['title'] . '"';
    $frameSizeStringDB = ' Frame Size: DB:' . $workRow['frameWidthInPixels'] . 'x' . $workRow['frameHeightInPixels'];
    $vimeoWebAddress = (isset($workRow['vimeoWebAddress']) ? $workRow['vimeoWebAddress'] : "");
    $vimeoPassword =  (isset($workRow['vimeoPassword']) ? $workRow['vimeoPassword'] : "");
//    $diagnosticInfoString .= "vimeoWebAddress = |" . $vimeoWebAddress . "|  vimeoPassword = |" . $vimeoPassword . "|";
    SSFDebug::globalDebugger()->becho('', $diagnosticInfoString, -1);
    if ($vimeoWebAddress !== "") {
      $vimeoVideoInfo =  new SSFVimeoVideoInfo($vimeoWebAddress, $vimeoPassword, -1);
      $vimeoFrameWidthInPixels = $vimeoVideoInfo->width();
      $vimeoFrameHeightInPixels = $vimeoVideoInfo->height();
      $frameSizeStringVIMEO = ", VIMEO:" . $vimeoFrameWidthInPixels . "x" . $vimeoFrameHeightInPixels;
      if (($vimeoFrameWidthInPixels != 0) && ($vimeoFrameHeightInPixels !== 0)) {
        if (($workRow['frameWidthInPixels'] == 0) && ($workRow['frameHeightInPixels'] == 0)) {
          // Update the database
          echo "<div class='datumValue floatLeft'><span class='datumDescription'>Updating DB for: "
               . $diagnosticInfoString . "</span>" . $frameSizeStringDB . $frameSizeStringVIMEO . "</div><div style='clear:both;'></div>\r\n";
          $updateQuery = "UPDATE works SET frameWidthInPixels=" . $vimeoFrameWidthInPixels . ", frameHeightInPixels=" . $vimeoFrameHeightInPixels . " WHERE workId=" . $workRow['workId'];
          SSFDB::getDB()->saveData($updateQuery);
          SSFDebug::globalDebugger()->becho('$updateQuery', $updateQuery, -1);
        } else if (($workRow['frameWidthInPixels'] != $vimeoFrameWidthInPixels) || ($workRow['frameHeightInPixels'] != $vimeoFrameHeightInPixels)) {
          // Warn the user
          echo "<div class='datumValue floatLeft'><span class='datumDescription' style='color:#FF9900;font-weight:bold'>Manually check: " 
               . $diagnosticInfoString . "</span>" . $frameSizeStringDB . $frameSizeStringVIMEO . "</div><div style='clear:both;'></div>\r\n";
          } else {
          echo "<div class='datumValue floatLeft'><span class='datumDescription' style='color:#33CC00;font-weight:bold'>DB &amp; Vimeo match: " 
               . $diagnosticInfoString . "</span>" . $frameSizeStringDB . $frameSizeStringVIMEO . "</div><div style='clear:both;'></div>\r\n";
          }
      }
    }    
  }

  
  
  //SSFDB::debugNextQuery();
/*
  $rowsAdded = 0;
  foreach ($workRows as $workRow) {
    SSFDebug::globalDebugger()->becho('workId', $workRow['workId'], -1);
    if (true || ($workRow['workId'] == 511) || ($workRow['workId'] == 650) || ($workRow['workId'] == 590)) {
      foreach ($curators as $person) {   
        if (!isset($curationIndices[$workRow['workId']][$person])) {
          $insertString = "INSERT INTO curation (entry, curator, lastModificationDate, lastModifiedBy) VALUES (" 
                        . $workRow['workId'] . ", " . $person . ", '" . SSFRunTimeValues::nowForDB() . "', " . $administrator . ")";
          //SSFDB::debugNextQuery();
          $success = SSFDB::getDB()->saveData($insertString);
          if ($success) {
            $rowsAdded++;
            echo '** Added curator ' . $person . ' for work ' . $workRow['workId'] . ', "' . $workRow['title'] . '."<br>' . "\r\n";
          } else {
            echo "<br>\r\n" . '** Failed to add curator ' . $person . ' for work ' . $workRow['workId'] . ', "' . $workRow['title'] 
                 . '," MySQL Error#' . SSFDB::getDB()->lastErrorNo() . ' ' . SSFDB::getDB()->lastErrorText() . ".<br><br>\r\n\r\n";
          }
        }
      }
    }
  }
  printf('*** %d rows added to the curation table. ***', $rowsAdded);
*/
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
            <td align="center" valign="bottom" class="smallbodyTextOriginalLeadedGrayLight"><br>
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