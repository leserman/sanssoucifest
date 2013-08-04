<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>SSF - Curation Process</title>
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
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
                    <div style="background-color:#333333">
<?php

  function tdTag($bgnd, $align, $valign='top', $rowSpan='1') {
    if ($rowSpan == '0') return "";
    return "  <td class='bodyTextOriginal' " . (($rowSpan == "1") ? "" : "rowSpan = " . $rowSpan . " ") . 
                  " style='color:#000;background-color:" . $bgnd . ";text-align:" . $align . ";vertical-align:" . $valign . ";padding-left:8px;padding-right:8px;'>";
  }

  function getCurationRows() {
    $query = "SELECT workCnt, entry, workId, designatedId, substr(designatedId, 4, 6) AS desId, title, substr(title, 1, 24) AS titleTruncated, substr(runTime, 2, 8) AS trt, name,"
           . " works.lastModificationDate AS workLastModDate,"
           . " IF(curation.lastModificationDate > works.lastModificationDate, IF(curation.lastModifiedBy=5,'Ana',IF(curation.lastModifiedBy=1, 'David', 'other')), IF(works.lastModifiedBy=5,'Ana',IF(works.lastModifiedBy=1, 'David', ''))) AS modBy,"
           . " curation.lastModificationDate AS lastModDate,"
           . " IF(rejected=1,'rejected',IF(accepted=1,CONCAT('',acceptFor), '')) AS entryStatus,"
           . " curation.curator, curatorNickname, curatorSortKey," 
           . " IF(score is null, IF(curation.curator=832, '', '--'), score) AS scor, curation.notes"
           . " FROM curation JOIN works ON entry = workId "
           . " LEFT JOIN people ON submitter=personId "
           . " JOIN curators  ON curation.curator = curators.curator "
           . " JOIN ((SELECT entry AS entr, COUNT(*) as workCnt,"
           . " IF(curation.lastModificationDate > works.lastModificationDate, curation.lastModificationDate, works.lastModificationDate) AS maxModDate,"
           . " MAX(IF(curation.lastModificationDate > works.lastModificationDate, curation.lastModificationDate, works.lastModificationDate)) AS maxMaxModDate"
           . " FROM works JOIN curation ON entry=workId WHERE withdrawn=0 and works.callForEntries = " . SSFRunTimeValues::getCallForEntriesId() . " GROUP BY entry) AS maxDateSelect) ON entry=entr"
           . " WHERE withdrawn=0 AND curators.callForEntries = " . SSFRunTimeValues::getCallForEntriesId() 
           . " ORDER BY maxMaxModDate desc, entry, lastModDate desc, curatorSortKey";
//    SSFDB::debugOn();
    $curationRows = SSFDB::getDB()->getArrayFromQuery($query);
    SSFDB::debugOff();
    SSFDebug::globalDebugger()->belch('getCurationRows() resultRows', $curationRows, -1);
    return $curationRows;
  }
  
  function formatLastModDate($dateTimeString) { 
    // YYYY-MM-DD HH:MM:SS
    // 0123456789012345678
    $monthStr = substr($dateTimeString, 5, 2);
    $domStr = substr($dateTimeString, 8, 2);
    $yearStr = substr($dateTimeString, 0, 4);
    $dateStr = substr($dateTimeString, 0, 10);
    $timeStr = substr($dateTimeString, 11, 5);
    date_default_timezone_set('America/Denver');
    // Get weekday OO (This requires php 5.3)
    $date = new DateTime($dateStr);
    $timeStamp = $date->getTimestamp();
    $dateArray = getdate($timeStamp);
    $dowStrOO = substr($dateArray['weekday'], 0, 2);
    // Get weekday UNIX
    $dateU = mktime(0, 0, 0, $monthStr, $domStr, $yearStr);
    $dowStrU = substr(date("l", $dateU), 0, 2);
    return $dowStrOO . ' ' . $monthStr . '/' . $domStr . ' ' . $timeStr;
  }
  
  function timeAsMinutesAndSeconds($timeAsHoursMinsSecs) {
    $parts = explode(':', $timeAsHoursMinsSecs);
    $moreMinutes = 60 * $parts[0];
    $totalMinutes = $moreMinutes + $parts[1];
    $timeAsMinutesAndSeconds = sprintf('%s:%s', $totalMinutes, $parts[2]);
    return $timeAsMinutesAndSeconds;
  }
  
  function echoCuratorRow($bgnd, $curationRow) {
    echo "      <tr>\r\n"; // begin the 1st curation item information row
    echo tdTag($bgnd, 'center') . str_replace(' ', '&nbsp;', formatLastModDate($curationRow['lastModDate'])) . "</td>\r\n";
    echo tdTag($bgnd, 'center') . str_replace(' ', '&nbsp;', $curationRow['curatorNickname']) . "</td>\r\n"; 
    echo tdTag($bgnd, 'center') . (($curationRow['scor'] != '--') ? ('&nbsp;' . $curationRow['scor'] . '&nbsp;') : '--') . "</td>\r\n"; 
    echo tdTag($bgnd, 'notes') . $curationRow['notes'] . "</td>\r\n";
    echo "    </tr>\r\n"; // end the curation item information row 
  }
  
  function endSubtableAndRow() {
    echo "    </table>  <!-- Curation Detail Subtable -->\r\n";
    echo "  </td> <!-- Work Cell -->\r\n"; 
    echo "</tr> <!-- 2nd Work Row -->\r\n";
  }

  $statusDisplay = array("screening" => "<span class='darkAcceptedDisplayColor'>SCREEN</span>",
                         "installationMaybe" => "<span class='darkAcceptedDisplayColor'>Install (?)</span>", 
                         "installationOnly" => "<span class='darkAcceptedDisplayColor'>Install</span>", 
                         "documentary" => "<span class='darkAcceptedDisplayColor'>Documentary</span>", // added 7/18/13
                         "alternateVenue" => "<span class='darkAcceptedDisplayColor'>Alt Venue</span>",// added 7/18/13 
                         "rejected" => "<span class='darkRejectedDisplayColor'>&#8659;</span>", 
                         "" => "<span class='darkOrangishHighlightDisplayColor' style='font:Times;font-weight:bold;font-size:16px;'>&#8855;</span>");
//                         "" => "<span style='color:darkOrangishHighlightDisplayColor;'>&#8855;</span>");
 
  $debugger = new SSFDebug();
  $debugger->enableBelch(false);
  $debugger->enableBecho(false);

  $curationRows = getCurationRows();
  $debugger->belch('SSFCommunique::getMediaReceiptEmailNeededRows emailRows', $curationRows, -1);
  $debugger->belch('_POST', $_POST, -1);
  
  $callForEntriesId = SSFRunTimeValues::getInitialCallForEntriesId();
  
  $workCountQuery = "SELECT COUNT(*) as cnt FROM works WHERE withdrawn=0 AND callForEntries = " . $callForEntriesId . " GROUP BY callForEntries";
  $workCountRows = SSFDB::getDB()->getArrayFromQuery($workCountQuery);
  SSFDebug::globalDebugger()->belch('workCountRows', $workCountRows, -1);
  SSFDebug::globalDebugger()->belch('workCountRows[0]', $workCountRows[0], -1);
 
/* 
  // Create $curatorNicknames[] using the people table.
  $curatorQuery = 'SELECT curator as curatorId, isActive, nickName FROM curators JOIN people ON curator = personId '
                . 'WHERE callForEntries = ' . $callForEntriesId . ' ORDER BY nickName';
  $curatorRows = SSFDB::getDB()->getArrayFromQuery($curatorQuery);
  SSFDebug::globalDebugger()->belch('$curatorRows', $curatorRows, -1);
  $curators = array();
  foreach ($curatorRows as $curatorRow) {
    $curatorNicknames[$curatorRow['curatorId']] = $curatorRow['nickName']; 
  }
  SSFDebug::globalDebugger()->belch('$curatorNicknames', $curatorNicknames, -1);
*/

//  $currentEntryIdCache = HTMLGen::$currentEntryIdCacheNameForCuration;

  echo '<div class="programPageTitleText" style="padding-top:12px;">Curation Process Report ' . HTMLGen::getTestBedDisplayString() . '</div><br clear="all">' . "\r\n";
  echo "<div class='datumValue' style='margin:10px 0;padding-left:10px;'>There are a total of " . count($curationRows) . " curation records for " . $workCountRows[0]['cnt'] . " works sorted by Last Modification Date.</div>" . "\r\n";

  $bgnd = '#CCCCCC';
  $align = 'left';
  echo "<table cellpadding='2' cellSpacing='0' style='text-align:left;border:0px cyan solid;'>\r\n";
  echo "<tr>\r\n";
  $priorWorkId = 0;
  $priorCuratorId = 0;
  $priorSubtableExists = false;
  $curationArray = array();
  foreach ($curationRows as $curationRow) {
    
  }
  foreach ($curationRows as $curationRow) {
    $workId = isset($curationRow['workId']) ? $curationRow['workId'] : 0;
    $curatorId = isset($curationRow['curator']) ? $curationRow['curator'] : 0;
    SSFDebug::globalDebugger()->becho('$curatorId', $curatorId, -1);
    if ($priorWorkId != $workId ) {
      // close the prior subtable if one exists
      if ($priorSubtableExists) {
        echo endSubtableAndRow();
        echo "  <tr><td style='font-size:8px;line-height:10px;'>&nbsp;</td></tr>";
        echo "  <tr>\r\n"; // begin the next work row
      }
      $workLastModDate = new DateTime($curationRow['workLastModDate']);
      $maxCuratorLastModDate = new DateTime($curationRow['lastModDate']);
      $lastModDateTimeDisplay = '';
      if ($workLastModDate > $maxCuratorLastModDate) $lastModDateTimeDisplay = " <span style='color:#333;font-size:12px;'>(" . formatLastModDate($curationRow['workLastModDate']) . ")</span>";
      if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
      $curationArray[$workId][$curatorId] = $curationRow;
      echo tdTag($bgnd, 'left', 'middle') . "<b>" . $curationRow['designatedId'] . "</b> <span class='idDisplayTextDark'>" . $workId . "</span> " . "<b><i>" . $curationRow['title'] . ", </i>" . $curationRow['name'] . "</b>, " . HTMLGen::timeAsMinutesAndSeconds($curationRow['trt']) . " " . $statusDisplay[$curationRow['entryStatus']] . $lastModDateTimeDisplay . "</td>\r\n";
      echo "</tr>\r\n"; // end the work information row
      // begin the subtable
      echo "<tr>\r\n";   // begin the curation item information row
      echo "  <td>\r\n"; // begin the curation item information cell
      echo "    <table style='align:left;border:0px red solid;'>\r\n"; // begin the curation item information table
    } 
    echoCuratorRow($bgnd, $curationRow);
    $priorWorkId = $workId;
    $priorSubtableExists = true;
  }
  echo endSubtableAndRow();
  echo "</table><br><!-- last -->\r\n";
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
