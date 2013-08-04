<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>SSF - Media Receipt Notifications</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr><td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            </td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
                    <div style="background-color:#333333">
<?php

  function tdTag($bgnd, $align) {
    return "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align . ";padding-left:8px;padding-right:8px;'>";
  }

  $debugger = new SSFDebug();
  $debugger->enableBelch(false);
  $debugger->enableBecho(false);

  $emailRows = SSFCommunique::getMediaReceiptEmailNeededRows();
  $debugger->belch('SSFCommunique::getMediaReceiptEmailNeededRows emailRows', $emailRows, -1);
  $debugger->belch('_POST', $_POST, -1);

//  $currentEntryIdCache = HTMLGen::$currentEntryIdCacheNameForCuration;

  echo '<div class="programPageTitleText" style="padding-top:12px;padding-bottom:12px;">Inform Artists of Media Receipt';
  echo ' ' . HTMLGen::getTestBedDisplayString() . " <span class='datumValue'>(" . count($emailRows) . " records)</span>";
  echo '</div>'  . '<br clear="all">' . "\r\n";

  echo "<form name='informArtistsForm' id='informArtistsForm' action='informArtistsOfMediaReceipt.php' method='post'>";

  // BUG TODO - Wire it up so parameter 3 refreshes the email text window.
  HTMLGen::displayAdministratorSelector("padding-left:10px;padding-top:2px;padding-bottom:16px;", "rowTitleTextNarrow", 
                                        "document.informArtistsForm.submit()", "informArtistsOfMediaReceipt");

  $bgnd = '#CCCCCC';
  $align = 'left';
  echo "<table border='0' cellpadding='2' cellSpacing='0'>\r\n";
  echo "<tr>\r\n";
  echo tdTag($bgnd, $align) . "</td>\r\n";
  echo tdTag($bgnd, $align) . "Prsn Id</td>\r\n";
  echo tdTag($bgnd, $align) . "Name</td>\r\n";
  echo tdTag($bgnd, $align) . "Wrk Id</td>\r\n";
  echo tdTag($bgnd, $align) . "Des. Id</td>\r\n";
  echo tdTag($bgnd, $align) . "Title</td>\r\n";
  echo tdTag($bgnd, $align) . "Postmarked</td>\r\n";
  echo tdTag($bgnd, $align) . "Picked Up</td>\r\n";
  echo "</tr>\r\n";
  $priorPersonId = 0;
  $priorWorkId = 0;
  $emailArray = array();
  foreach ($emailRows as $resultRow) {
    $workId = isset($resultRow['workId']) ? $resultRow['workId'] : 0;
    if ($priorWorkId != $workId ) {
      $personId = isset($resultRow['personId']) ? $resultRow['personId'] : 0;
      $commId = isset($resultRow['communicationId']) ? $resultRow['communicationId'] : 0;
      if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
      echo "<tr>\r\n";
      if ($priorPersonId != $personId) { 
        $emailArray[$personId][$workId] = $resultRow;
        echo tdTag($bgnd, 'center');
        $widgetId = SSFCommunique::computeEmailWidgetId($workId);
        echo '<div id=' . $widgetId . '>';
        $dateSent = $resultRow['dateSent'];
        $artistInformed = (isset($resultRow['dateSent']) && ($resultRow['dateSent'] != '') && $resultRow['dateSent'] != '0000-00-00 00:00:00'
                        && isset($resultRow['type']) && $resultRow['type'] == 'MediaReceipt');
        echo SSFCommunique::mrEmailWidgetMarkup($commId, $personId, $widgetId, $artistInformed);
        echo '</div>';
        echo "</td>\r\n"; // emailSentIcon059, emailSendIcon090
        echo tdTag($bgnd, 'center') . $personId . "</td>\r\n";
        echo tdTag($bgnd, 'left') . "" . $resultRow['name'] . "</td>\r\n";
      } else {
        $emailArray[$personId][$workId] = $resultRow;
        echo tdTag($bgnd, 'center') . "</td>\r\n";
        echo tdTag($bgnd, 'center') . "</td>\r\n";
        echo tdTag($bgnd, 'left') . "</td>\r\n";
      }
      echo tdTag($bgnd, 'center') . $workId . "</td>\r\n";
      echo tdTag($bgnd, 'center') . $resultRow['designatedId'] . "</td>\r\n";
      echo tdTag($bgnd, 'left') . $resultRow['title'] . "</td>\r\n";
      echo tdTag($bgnd, 'center') . $resultRow['dateMediaPostmarked'] . "</td>\r\n";
      echo tdTag($bgnd, 'center') . $resultRow['dateMediaReceived'] . "</td>\r\n";
      $priorPersonId = $personId;
    }
      $priorWorkId = $workId;
  }
  echo "</table><br>\r\n";
  echo "</form><br>\r\n";
?>
                    </div>
	  	<!-- InstanceEndEditable --></td>
                 <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                 <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
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
<!-- InstanceEnd -->
</html>
