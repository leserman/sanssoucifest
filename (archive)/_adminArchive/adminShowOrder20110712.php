<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSFA - Program Shows</title>
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
<script type="text/javascript">
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!--
// Notes:
// - Shows are not editable if the corresponding event "didOccur" or was "cancelled".

TODO:
  - Add an Edit button?
    Page should behave like showShowOrder.php (with just the event selection) and an Edit button
    until the user presses the Edit button. So, the Administrator and Show dropdowns are disabled  
    and the Setup div is hidden. Also, the Edit button is disabled until the user selects an editable 
    event.
  - Gracefully handle a duplicate workId in a show. 
    Now it causes ERROR # 1062: Duplicate entry '31-704' for key 'PRIMARY'
-->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $debugIt = -1;
  $restrictEditingToAcceptedWorksOnly = true;
  
  date_default_timezone_set('America/Denver');
  
  function eventDayDisplay($startDate, $endDate) {
    $dayDisplay =  date('D', strtotime($startDate)) . "-" . date('D', strtotime($endDate));
    $dateDisplay =  date('n/j/y', strtotime($startDate)) . " - " . date('n/j/y', strtotime($endDate));
    $dayDateDisplay = $dayDisplay . ', ' . $dateDisplay;
    return $dayDateDisplay;
  }

  function tdTag($bgnd, $align, $valign="top", $padLeft="4px") {
    return "            <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align 
                                                  . ";padding-left:" . $padLeft . ";padding-right:4px;vertical-align:" . $valign . ";'>";
  }

  function displayShowDetailDataLine($showRow, $bgnd) {
      $codes = "";
      if (isset($showRow['includesLivePerformanceHere']) && $showRow['includesLivePerformanceHere'] != 0) $codes .= "L";
      if (isset($showRow['isInstallation']) && $showRow['isInstallation'] != 0) $codes .= "I";
      if (isset($showRow['acceptFor']))
        switch ($showRow['acceptFor']) {
          case 'installationOnly': $codes .= "J"; break;
          case 'installationMaybe': $codes .= "K"; break;
//          case 'screening': $codes .= "S"; break;
          case 'documentary': $codes .= "D"; break;
        }
      SSFDebug::globalDebugger()->belch('showRow', $showRow, -1);
      if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
      echo "        <tr>\r\n";
      echo tdTag($bgnd, 'center') . $showRow['workId'] . "</td>\r\n";
      echo tdTag($bgnd, 'center') . $showRow['designatedId'] . "</td>\r\n";
      echo tdTag($bgnd, 'left') . $showRow['workDesc'] . "</td>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . $codes . "</td>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . $showRow['runTime'] . "</td>\r\n";
      echo "        </tr>\r\n";
      return $bgnd;
  }
  
  function displayShowDetailHeaderLine($bgnd) {
    echo "      <table border='0' cellpadding='2' cellSpacing='0' style='padding-left:0px;'>\r\n";
    echo "        <tr>\r\n";
    echo tdTag($bgnd, 'center', 'bottom') . "Work Id</td>\r\n";
    echo tdTag($bgnd, 'center', 'bottom') . "Dsgntd Id</td>\r\n";
    echo tdTag($bgnd, 'left', 'bottom') . "Work</td>\r\n";
    echo tdTag($bgnd, 'center', 'bottom') . "Codes</td>\r\n";
    echo tdTag($bgnd, 'center', 'bottom') . "Run&nbsp;Time</td>\r\n";
    echo "        </tr>\r\n";
  }
  
  function displayShowDetail($showSummaryRow, $showTable) {
    SSFDebug::globalDebugger()->belch('showSummaryRow', $showSummaryRow, -1);
    SSFDebug::globalDebugger()->belch('showTable', $showTable, -1);
    echo "    <div class='datumDescription' style='padding:10px 30px 6px 6px;width:580px;border:0px green solid;'>";
    // Table title lines
    echo "    <div class='datumDescription' style='margin-top:8px;margin-bottom:4px;'>" . $showSummaryRow['description'] . "<br><b>Show " 
                . $showSummaryRow['showId'] . "</b>. " . $showSummaryRow['date'] . " " 
                . $showSummaryRow['strtTime'] . ", <i>" . $showSummaryRow['shortDescription'] 
                . " </i>[" . $showSummaryRow['workCount'] . " works, TRT: " . $showSummaryRow['duration'] . "]</div>\r\n";
    $bgnd = '#FFFFCC';
    displayShowDetailHeaderLine($bgnd);
    foreach ($showTable[$showSummaryRow['showId']] as $showRow) {
      $bgnd = displayShowDetailDataLine($showRow, $bgnd);
    }
    echo "      </table>\r\n";
    echo "    </div>\r\n";
  }
?>
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
                  <td align="center" valign="top" style="background-color:#333;padding-bottom:10px;">
                    <div style="background-color:#333333;text-align:left;">
                      <div class="programPageTitleText" style="padding-top:8px;padding-bottom:6px;padding-left:8px;text-align:left;">Program Shows</div>
                      <div style="clear:both;"></div>

<?php
  $errors = 0;
  $errorString = "";
  SSFDebug::globalDebugger()->belch('_POST', $_POST, -1);
  if (count($_POST) == 0) {
    $editorState['eventSelector'] = 0;
    $editorState['showSelector'] = 0;
  } 
  else $editorState = $_POST;
  $forceApplicationOfUnacceptedWorks = (isset($editorState['forcedWorkIdOrderString']) && ($editorState['forcedWorkIdOrderString'] != '')) ? true : false;
  if ($forceApplicationOfUnacceptedWorks) $editorState['workIdsListWidget'] = $editorState['forcedWorkIdOrderString'];
  SSFDebug::globalDebugger()->belch('editorState', $editorState, -1);
  
  SSFQuery::useAdministratorAsCreatorModifier();
  
  $applyWasClicked = isset($editorState['submitWorks']) && $editorState['submitWorks'] == 'Apply' && isset($editorState['workIdsListWidget']);
  $forceApplyWasClicked = isset($editorState['forceApplicationOfUnacceptedWorks'])
                          && ($editorState[forceApplicationOfUnacceptedWorks] == 'Force application of the unaccepted works as entered.')
                          && isset($editorState['forcedWorkIdOrderString']) && ($editorState['forcedWorkIdOrderString'] != '');
  if ($forceApplicationOfUnacceptedWorks) {
    $applyWasClicked = true;
    $editorState['workIdsListWidget'] = $editorState['forcedWorkIdOrderString'];
  }
  if ($applyWasClicked) {
    $submitterWorkSelectString = 'SELECT workId, designatedId, titleForSort, name as submitterName, accepted, acceptFor '
                               . 'FROM people JOIN works on submitter=personId';
    $worksArray = SSFDB::getDB()->getArrayFromQuery($submitterWorkSelectString); 
    SSFDebug::globalDebugger()->belch('worksArray', $worksArray, -1);
    $cachedWorkIdOrderString = $workIdsOrderString = $editorState['workIdsListWidget'];
    $workIdsOrderString = trim(str_replace(array("\r\n", "\n", "\r", ","), " ", $workIdsOrderString));
    // Replace two space characters by one in a loop until no more replacements can be made.
    $patterns = array("/  /");
    $replacements = array(" ");
    do {
      $workIdsOrderStringOld = $workIdsOrderString;
      $workIdsOrderString = preg_replace($patterns, $replacements, $workIdsOrderStringOld); 
    } while (isset($workIdsOrderString) && ($workIdsOrderString != $workIdsOrderStringOld));
    SSFDebug::globalDebugger()->belch('workIdsOrderString', '|' . $workIdsOrderString . '|', -1);
    $worksIdsOrderArray = array();
    if ($workIdsOrderString != '') $worksIdsOrderArray = explode(" ", $workIdsOrderString);
    SSFDebug::globalDebugger()->belch('workIdsOrderString', $workIdsOrderString, -1);
    SSFDebug::globalDebugger()->belch('worksIdsOrderArray', $worksIdsOrderArray, -1);
    $deleteQuery = 'DELETE FROM `runOfShow` WHERE `runOfShow`.`show` = ' . $editorState['showSelector'];
    $insertQuery = 'INSERT INTO runOfShow (`show`, work, showOrder, media, includesLivePerformanceHere, '
                 . 'isInstallation, notes, lastModificationDate, lastModifiedBy) values' . "\r\n";
    $priorLineEnd = "";
    $showOrderIndex = 10;
    foreach ($worksIdsOrderArray as $workId) {
      $workOfInterest = array();
      foreach ($worksArray as $work) {
        if ($work['workId'] == $workId) {
          $workOfInterest = $work;
          SSFDebug::globalDebugger()->belch('workOfInterest', $workOfInterest, -1);
          break;
        }
      }
      $workIdentifier = HTMLGen::computedFileNameForWork($workOfInterest['designatedId'], $workOfInterest['titleForSort'], $workOfInterest['submitterName']);
      if (!$forceApplicationOfUnacceptedWorks && $restrictEditingToAcceptedWorksOnly && ($workOfInterest['accepted'] != 1)) {
        // error condition: work was not accepted
        if ($errors == 0) $errorString = "<br>ERROR<br>The following works were not accepted so the operation is cancelled.<br>";
        else $errorString .=  "<br>";
        $errorString .= '&bull; ' . $workOfInterest['workId'] . ' ' . $workIdentifier;
        $errors++;
      } else {
        $insertQuery .= $priorLineEnd . "(" . $editorState['showSelector'] . ", " . $workOfInterest['workId'] . ", " . $showOrderIndex . ", 0, 0, 0, '" . $workIdentifier . "', NOW(), " . SSFAdmin::userIndex() . ")";
        $priorLineEnd = ",\r\n";
        $showOrderIndex += 10;
      }
    }
    if ($errors == 0) {
      SSFDB::getDB()->saveData($deleteQuery);
      if ($workIdsOrderString != '') {
        SSFDebug::globalDebugger()->belch('### ', $insertQuery, -1);
        SSFDB::getDB()->saveData($insertQuery);
      }
    }
  }
?>  

<div id="formEnclosingDiv" style="margin-top:4px;text-align:left;">
<form name='showOrderEntryForm' id='showOrderEntryForm' action='adminShowOrder.php' method='post' style='margin:0;padding:0;'>
  <div style="margin:4px 20px 10px 20px;border:yellow dashed 0px;">

<?php 
  // initialize $eventRows
  $query = 'SELECT eventId, venues.name as venueName, venues.country as venueCountry, startDate, endDate, didOccur, cancelled '
         . 'FROM events JOIN venues ON venue=venueId '
         . 'WHERE (cancelled=0 or cancelled="" or cancelled IS NULL) ' // and (didOccur=0 or didOccur="" or didOccur IS NULL)
         . 'ORDER BY startDate desc';
  $eventRows = SSFDB::getDB()->getArrayFromQuery($query);
  $eventSelectionOptions = array();
  $selectedEventRow = array();
  if (count($_POST) == 0 && count($eventRows) > 0) $editorState['eventSelector'] = $eventRows[0]['eventId'];
  foreach ($eventRows as $eventRow) {
    $dayDateDisplay = eventDayDisplay($eventRow['startDate'], $eventRow['endDate']);
    $yearMonthDisplay = date('n/y', strtotime($eventRow['startDate']));
    $eventSelectionOptions[$eventRow['eventId']] = $eventRow['eventId'] . ". (" . $yearMonthDisplay . ') ' 
                                            . $eventRow['venueName'] . ", " . $eventRow['venueCountry'] . ", " . $dayDateDisplay;
    if ($eventRow['eventId'] == $editorState['eventSelector']) $selectedEventRow = $eventRow;
  }

  // Display Administrator
  // TODO someday It would be nice to dim this selector when there are no editable shows for the event or the  
  // event is cancelled or in the past, but displayAdministratorSelector() does not take a $disable parameter.
  HTMLGen::displayAdministratorSelector("padding-top:4px;", "rowTitleText", 
                                    "document.showOrderEntryForm.submit();", "adminShowOrder");

  // initialize $showRows
  $showSummaryFilter1 = "(active=1 or editable=1) and "; // 6/29/11
  $query = "SELECT showId, `date`, startTime, DATE_FORMAT(startTime,'%l:%i %PM') AS strtTime, shortDescription, description, "
         . "active, editable, workId, count(*) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration "
         . "FROM `shows` LEFT JOIN runOfShow ON `show` = showId LEFT JOIN works ON workId = `work` "
         . "WHERE " . $showSummaryFilter1 . "event = " . $editorState['eventSelector'] . " " // 6/29/11
         . "GROUP BY showId "
         . 'ORDER BY date, startTime, shortDescription';
  $showRows = SSFDB::getDB()->getArrayFromQuery($query);
  $showsExist = count($showRows) > 0;
  
  if (isset($editorState['showSelector'])) SSFDebug::globalDebugger()->becho('editorState[showSelector]-1', $editorState['showSelector'], -1);
  if ((!isset($editorState['showSelector']) || ($editorState['showSelector'] == 0)) && $showsExist) $editorState['showSelector'] = $showRows[0]['showId'];

  $workIdsList = "";
  $eventAlreadyOccured = true;
  if ($showsExist) {
    $workIdsListQuery = "SELECT work from runOfShow where `show` = " . $editorState['showSelector'] . " ORDER BY showOrder";
    $workIdsRows = SSFDB::getDB()->getArrayFromQuery($workIdsListQuery);
    $commaSpace = "";
    foreach ($workIdsRows as $workIdRow) {
      $workIdsList .= $commaSpace . $workIdRow['work'];
      $commaSpace = ", ";
    }
    $eventAlreadyOccured = (!isset($selectedEventRow['didOccur']) || $selectedEventRow['didOccur'] != 0) ? true : false;
  }

  $selectorDisabledText = ($eventAlreadyOccured) ? ' disabled="disabled" ' : '';
  $showSelectionOptions = array();
  $selectedShowRow = array();
  foreach ($showRows as $showRow) {
    SSFDebug::globalDebugger()->belch('showRow', $showRow, -1);
    $showSelectionOptions[$showRow['showId']] = $showRow['showId'] . ". " . date('D, n/j/y', strtotime($showRow['date'])) . ", " 
                                          . date('g:i A', strtotime($showRow['startTime'])) . ", " . $showRow['shortDescription'];
    if ($showRow['showId'] == $editorState['showSelector']) $selectedShowRow = $showRow;
  }
  SSFDebug::globalDebugger()->becho('editorState[showSelector]-2', $editorState['showSelector'], -1);
  SSFDebug::globalDebugger()->belch('selectedShowRow', $selectedShowRow, -1);
  $selectedShow = ($showsExist) ? $selectedShowRow['showId'] : '';
?>

<!-- Begin Filters -------------------------------------------------------- -->
    <!-- Event Selector -->
          <div class='formRowContainer' style="padding-top:4px;">
            <div class='rowTitleText'>Event:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?php 
                echo '<select id="eventSelector" name="eventSelector" style="width:480px;" '
                     // NOTE: It seems that setting the selectedIndex of an HTML SELECT object to -1 will cause supress posting of the object's value.
                     . 'onchange="document.getElementById(\'showSelector\').selectedIndex=-1;document.getElementById(\'showOrderEntryForm\').submit();">';
                HTMLGen::displaySelectionOptions($eventSelectionOptions, $editorState['eventSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
    <!-- Show Selector -->
          <div class='formRowContainer' style="padding-top:4px;">
            <div class='rowTitleText'>Show:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?php  
                echo '<select id="showSelector" name="showSelector" style="width:480px;"' . $selectorDisabledText . 'onchange="document.getElementById(\'showOrderEntryForm\').submit();">';
                HTMLGen::displaySelectionOptions($showSelectionOptions, $editorState['showSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
<!-- End Filters ------------------------------------------------------------- -->

<?php 
  $countShowSummaryRows = 0;
  if ($showsExist) {
    $showSummaryFilter2 = "(active=1 or editable=1) and "; // 6/29/11
    $showSummaryQuery = "SELECT showId, `date` , DATE_FORMAT(startTime,'%l:%i %PM') AS strtTime, shortDescription, description, "
                      . "active, editable, workId, count(*) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration "
                      . "FROM `runOfShow` JOIN shows ON `show` = showId JOIN works ON workId = `work` "
                      . "WHERE " . $showSummaryFilter2 . "event = " . $editorState['eventSelector'] . " " // 6/29/11
                      . "GROUP BY `show` "
//                      . "ORDER BY `show`, showOrder"; // 7/12/11
                      . "ORDER BY date, startTime, shortDescription, showOrder"; // 7/12/11
    $showSummaryRows = SSFDB::getDB()->getArrayFromQuery($showSummaryQuery);
    $countShowSummaryRows = count($showSummaryRows);
    $showSummaryTable = array();
    foreach ($showSummaryRows as $showSummaryRow) { $showSummaryTable['showId'] = $showSummaryRow; }
    $showListQuery = "SELECT showId, `shows`.`date` , DATE_FORMAT(shows.startTime, '%l:%i %PM') AS strtTime, shows.shortDescription, "
                   . "shows.active, shows.editable, shows.description, runOfShow.isInstallation, runOfShow.includesLivePerformanceHere, "
                   . "workId, designatedId, CONCAT('\"', title, ',\" ', name) AS workDesc, runTime, acceptFor "
                   . "FROM `shows` LEFT JOIN runOfShow ON `show` = showId LEFT JOIN works ON workId = `work` LEFT JOIN people ON personId = submitter "
                   . "WHERE " . $showSummaryFilter2 . "event = " . $editorState['eventSelector'] 
                   . " ORDER BY `show`, showOrder"; // 6/30/11
    $showRows2 = SSFDB::getDB()->getArrayFromQuery($showListQuery);
    $showTable = array();
    foreach ($showRows2 as $showRow) { $showTable[$showRow['showId']][] = $showRow; }
    SSFDebug::globalDebugger()->belch('showTable', $showTable, -1);
  } 
  $eventText = $selectedEventRow['venueName'] . ", " . $selectedEventRow['venueCountry'] . ", " 
             . eventDayDisplay($selectedEventRow['startDate'], $selectedEventRow['endDate']);
  $eventTextWithId = "<b>Event " . $selectedEventRow['eventId'] . ".</b> " . $eventText;
  $showText = "<b>Show " . $selectedShowRow['showId'] . "</b>. " . $selectedShowRow['date'] . " " 
        . $selectedShowRow['strtTime'] . ", <i>" . $selectedShowRow['shortDescription'] 
        . "</i> [" . $selectedShowRow['workCount'] . " works, TRT: " . $selectedShowRow['duration'] . "]";

  if (!$eventAlreadyOccured) {
    echo '<!-- Begin Setup works-in-order section -->';
    echo '<div style="padding:12px 0 9px 10px;margin-left:-10px;margin-top:14px;margin-bottom:5px;border:dashed grey thin;">';
    echo '<div class="homePageTitleText" style="text-align:left;margin-left:4px;">Setup ';
    echo '  <span class="datumDescription">for ' . $eventTextWithId . '</span>';  
    echo '</div>';
    echo '<div class="homePageTitleText" style="text-align:left;margin-top:-4px;margin-left:4px;color:#333333;">Setup ';
    echo "  <span class='datumDescription' style='color:#F7FF6F;'>" . $showText . "</span>";
    echo '</div>';
    echo '<div style="margin:10px 0 -8px;">'; // work-ids-in-order row. 
    $disabledString = ($eventAlreadyOccured) ? ' disabled="disabled" ' : '';
  //HTMLGen::addTextWidgetRowWithTitleWidth('Work Ids in Order', 'workIdsListWidget', $workIdsList, 80, "", $eventAlreadyOccured);
    HTMLGen::addTextWidgetRowHelper1('Work Ids in Order', 'workIdsListWidget', $workIdsList, 250, "", $eventAlreadyOccured);  // 250 was 120
    echo "        </div>\r\n";
    echo "        <div style='float:left;padding-left:12px;padding-top:3px;'>\r\n";
    echo '          <input type="submit" id="submitWorks" name="submitWorks" value="Apply"' . $disabledString . '>' . "\r\n";
                    /* <!-- for <? echo $selectedShowRow['shortDescription'] ?> --> */
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    echo "    </div>\r\n";
    echo "    <div style='margin-left:20px;'>";
    if ($errors != 0) { 
      echo '<div class="datumDescription" style="color:yellow;margin:6px 0 2px 50px;">' . $errorString . '<br>'; 
      // Button to force application of unaccepted works.
      $onClickString = 'javascript:document.getElementById(\'forcedWorkIdOrderString\').value = \'' . $cachedWorkIdOrderString . '\';' 
                     . 'alert(\'' . $cachedWorkIdOrderString  . '\');document.showOrderEntryForm.submit();';
      echo '<input type="button" id="forceApplicationOfUnacceptedWorks" name="forceApplicationOfUnacceptedWorks" '
             . 'value="Force application of the unaccepted works as entered." onClick="' . $onClickString . '" style="margin-top:8px;">' . "<br>";
      echo "</div>\r\n";
    }
    SSFDebug::globalDebugger()->becho('selectedShowRow[workId]', $selectedShowRow['workId'], -1);
    if (!($selectedShowRow['workCount']==1 and !isset($selectedShowRow['workId']))) {
      displayShowDetail($selectedShowRow, $showTable);
    }
    echo "    </div>\r\n";
    echo "  </div>\r\n";
    echo '<!-- End Setup works-in-order section -->';
  }
  
  // Begin Display Event section
  echo "<div style='padding:6px 0 10px 0;margin-left:0px;margin-top:16px;margin-bottom:0px;border:0px dashed grey;'>\r\n"; // <!-- was border:thin -->

  echo "<div class='homePageTitleText' style='text-align:left;margin-left:4px;'>Event " . $selectedEventRow['eventId'] . " <span class='datumDescription'>"
      . $eventText . " (" . $countShowSummaryRows . " shows)</span></div>";
  echo "<div class='smallBodyTextOnBlack' style='width:500;margin:10px 0 -10px 25px;'>\r\n";
  echo "  <div style='float:left;'><b>Codes Legend:</b></div>\r\n";
  echo "  <div style='float:left;margin-left:10px;'>D: Documentary; L: Includes live performance; I: Designated as an installation in this show;"
     . "<br>J: Accepted as an installation; K: Maybe accepted as an installation;</div>\r\n";
  echo "  <div style='clear:both;'></div>\r\n";
  echo "</div>\r\n";
  
  echo "<div style='padding-top:2px;margin-top:0px;margin-left:20px;border:0px red solid;'>\r\n";

  // First display the accepted works not yet programmed.
  if (!$eventAlreadyOccured) {
    $noShowSummaryQuery = 'SELECT accepted, SEC_TO_TIME(SUM(TIME_TO_SEC(runTime))) AS duration, count(*) AS workCount '
                        . 'FROM works '
                        . 'WHERE callForEntries=' . SSFRunTimeValues::getCallForEntriesId()
                        . ' AND accepted=1 AND workId NOT IN ' 
                        . '(SELECT DISTINCT `work` FROM runOfShow WHERE `show` IN '
                        . '(SELECT DISTINCT `showId` FROM shows WHERE shows.editable=1 AND event=' . $editorState['eventSelector'] . ')) '
                        . ' GROUP BY accepted';
    $noShowSummaryRows = SSFDB::getDB()->getArrayFromQuery($noShowSummaryQuery);
    $noShowSummaryRow = $noShowSummaryRows[0];
    $noShowSummaryTable = array();
    foreach ($noShowSummaryRows as $noShowSummaryRow) { $noShowSummaryTable['showId'] = $noShowSummaryRow; }

    $noShowListQuery = 'SELECT workId, designatedId, title, acceptFor, '
                                        . 'CONCAT("\'", title, ",\' ", name) AS workDesc, runTime, acceptFor '
                                        . 'FROM works JOIN people on submitter=personId '
                                        . 'WHERE callForEntries=' . SSFRunTimeValues::getCallForEntriesId()
                                        . ' AND accepted=1 AND workId NOT IN ' 
                                        . '(SELECT DISTINCT `work` FROM runOfShow WHERE `show` IN '
                                        . '(SELECT DISTINCT `showId` FROM shows WHERE shows.editable=1 AND event=' . $editorState['eventSelector'] . '))'
                                        . ' ORDER BY acceptFor DESC, designatedId';
    $noShowRows = SSFDB::getDB()->getArrayFromQuery($noShowListQuery);
    $noShowTable = array();
    foreach ($noShowRows as $noShowRow) { 
      $noShowRow['showId'] = 0;
      $noShowTable[$noShowRow['workId']] = $noShowRow; 
    }
    SSFDebug::globalDebugger()->belch('noShowTable', $noShowTable, -1);
    $noShowSummaryRow['shortDescription'] = 'Not Yet Programmed';
    $noShowSummaryRow['description'] = 'Works Accepted but Not Yet Programmed from Call for Entries ' . SSFRunTimeValues::getCallForEntriesId();
    echo "    <div class='datumDescription' style='padding:10px 30px 6px 6px;width:580px;border:0px green solid;'>";
    echo "    <div class='datumDescription' style='margin-top:10px;margin-bottom:4px;'>" . $noShowSummaryRow['shortDescription'] . "<br>" 
                . "<i>" . $noShowSummaryRow['description'] . " </i>[" . $noShowSummaryRow['workCount'] . " works, TRT: " . $noShowSummaryRow['duration'] . "]</div>\r\n";
    $bgnd = '#FFFFCC';
    displayShowDetailHeaderLine($bgnd);
    foreach ($noShowTable as $noShowRow) {
      $bgnd = displayShowDetailDataLine($noShowRow, $bgnd);
    }
    echo "      </table>\r\n";
    echo "    </div>\r\n";
  }
  
  // Now display the existing shows for this event.
  if ($showsExist) {
    SSFDebug::globalDebugger()->belch('showSummaryRows', $showSummaryRows, -1);
    foreach ($showSummaryRows as $showSummaryRow) {
      displayShowDetail($showSummaryRow, $showTable);
    }
  }
  echo "    </div>\r\n";
  // End Display Event section
?>
    </div>
    <div style="clear: both;"></div>
    </div>
  </div> <!-- border:dashed grey thin -->
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="forcedWorkIdOrderString" name="forcedWorkIdOrderString" value="">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
</form>

</div> <!-- id=formEnclosingDiv -->
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