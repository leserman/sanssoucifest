<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Projectionist Report</title>
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
  - Gracefully handle a duplicate workId in a show. 
    Now it causes ERROR # 1062: Duplicate entry '31-704' for key 'PRIMARY'
-->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $debugIt = -1;
  $restrictEditingToAcceptedWorksOnly = true; // HALT: Do not alter. If this is set to false, code will break below.
  
  date_default_timezone_set('America/Denver');
  
  function eventDayDisplay($startDate, $endDate) {
    $dayDisplay =  date('D', strtotime($startDate)) . "-" . date('D', strtotime($endDate));
    $dateDisplay =  date('n/j/y', strtotime($startDate)) . " - " . date('n/j/y', strtotime($endDate));
    $dayDateDisplay = $dayDisplay . ', ' . $dateDisplay;
    return $dayDateDisplay;
  }

  function tdTag($bgnd, $align, $valign="top", $padLeft="6px") {
    return "            <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align 
                                                  . ";padding-left:" . $padLeft . ";padding-right:6px;vertical-align:" . $valign . ";'>";
  }

  function displayShowDetailDataLine($lineIndex, $showRow, $bgnd, $aspectRatioTable) {
//      $codes = "";
      if (isset($showRow['includesLivePerformanceHere']) && $showRow['includesLivePerformanceHere'] != 0) $codes .= "L";
      if (isset($showRow['isInstallation']) && $showRow['isInstallation'] != 0) $codes .= "I";
//      if (isset($showRow['acceptFor']))
//        switch ($showRow['acceptFor']) {
//          case 'installationOnly': $codes .= "J"; break;
//          case 'installationMaybe': $codes .= "K"; break;
////          case 'screening': $codes .= "S"; break;
//          case 'documentary': $codes .= "D"; break;
//        }
      SSFDebug::globalDebugger()->belch('showRow', $showRow, -1);
      if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
      echo "        <tr>\r\n";
      echo tdTag($bgnd, 'center') . $lineIndex . ".&nbsp;</td>\r\n";
      echo tdTag($bgnd, 'center', "top", "0px") . $showRow['designatedId'] . "</td>\r\n";
      echo tdTag($bgnd, 'left') . $showRow['workDesc'] . "</td>\r\n";
//      echo tdTag($bgnd, 'center', 'bottom') . $codes . "</td>\r\n";
      echo tdTag($bgnd, 'center', 'top') . $showRow['runTime'] . "</td>\r\n";
      echo tdTag($bgnd, 'left', 'top') . getFrameParameters($showRow, $aspectRatioTable) . "</td>\r\n";
      echo tdTag($bgnd, 'left', 'top') . $showRow['projectionistNotes'] . "</td>\r\n";
      echo "        </tr>\r\n";
      return $bgnd;
  }
  
  function displayShowDetailHeaderLine($bgnd) {
    echo "      <table border='0' cellpadding='2' cellSpacing='0' style='padding-left:0px;'>\r\n";
    echo "        <tr>\r\n";
    echo tdTag($bgnd, 'right', 'bottom') . "</td>\r\n";
    echo tdTag($bgnd, 'center', 'bottom', "top", "0px") . "<b>Id</b></td>\r\n";
    echo tdTag($bgnd, 'left', 'bottom') . "<b>Work</b></td>\r\n";
//    echo tdTag($bgnd, 'center', 'bottom') . "Codes</td>\r\n";
    echo tdTag($bgnd, 'center', 'top') . "<b>Run&nbsp;Time</b></td>\r\n";
    echo tdTag($bgnd, 'left', 'top') . "<b>Frame&nbsp;Info</b></td>\r\n";
    echo tdTag($bgnd, 'left', 'bottom') . "<b>Projectionsit&nbsp;Notes</b></td>\r\n";
    echo "        </tr>\r\n";
  }
  
  function displayShowDetail($showSummaryRow, $showTable, $aspectRatioTable) {
    SSFDebug::globalDebugger()->belch('showSummaryRow', $showSummaryRow, -1);
    SSFDebug::globalDebugger()->belch('showTable', $showTable, -1);
    echo "    <div class='datumDescription' style='padding:10px 30px 6px 6px;min-width:580px;border:0px green solid;'>";
    // Table title lines
    echo "    <div class='datumDescription' style='margin-top:8px;margin-bottom:4px;'>" . $showSummaryRow['description'] . "<br><b>Show " 
                . $showSummaryRow['showId'] . "</b>. " . $showSummaryRow['date'] . " " 
                . $showSummaryRow['strtTime'] . ", <i>" . $showSummaryRow['shortDescription'] 
                . " </i>[" . $showSummaryRow['workCount'] . " works, TRT: " . $showSummaryRow['duration'] . "]</div>\r\n";
    $bgnd = '#FFFFCC';
    displayShowDetailHeaderLine($bgnd);
    $lineIndex = 0;
    foreach ($showTable[$showSummaryRow['showId']] as $showRow) {
      $lineIndex++;
      $bgnd = displayShowDetailDataLine($lineIndex, $showRow, $bgnd, $aspectRatioTable);
    }
    echo "      </table>\r\n";
    echo "    </div>\r\n";
  }

  function getFrameParameters($workArray, $aspectRatioTable) {
    $showDescription = true;
    $frameParameterString = '';
    // aspect ratio
    $aspectRatioId = (isset($workArray['aspectRatio']) && ($workArray['aspectRatio'] != '') && ($workArray['aspectRatio'] !== null)) ? $workArray['aspectRatio'] : 0;
    $separator = '';
//    $frameParameterString .= '<div style="margin-top:1px;"><div class="datumValue">';
//    $frameParameterString .= '<span class="datumDescription">Aspect Ratio: </span>' 
//         . $aspectRatioTable[$aspectRatioId]['ratio'] 
    $frameParameterString .= $aspectRatioTable[$aspectRatioId]['ratio'] 
         . (($showDescription && isset($aspectRatioTable[$aspectRatioId]['ratioDescription'])) ? " (" . $aspectRatioTable[$aspectRatioId]['ratioDescription'] . ")" : "" );
    $separator = ', ';
    // anamorphic
    if ($workArray['anamorphic'] == 1) {
//      $frameParameterString .= ($separator == '') ? '<div class="datumValue">Anamorphic' : ', anamorphic';
      $frameParameterString .= ($separator == '') ? 'Anamorphic' : ', anamorphic';
      $separator = ', ';
    }
    // frame width & height
    if ($workArray['frameWidthInPixels'] != '' && $workArray['frameHeightInPixels'] != '' 
          && $workArray['frameWidthInPixels'] != 0 && $workArray['frameHeightInPixels'] != 0) {
//      if  ($separator == '') $frameParameterString .= '<div class="datumValue">';
      $frameParameterString .= $separator . $workArray['frameWidthInPixels'] . 'x' . $workArray['frameHeightInPixels'];
      $separator = ', ';
    }
//    if ($separator != '') $frameParameterString .= '</div></div>' . "\r\n";
    return $frameParameterString;
  }
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" min-width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
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
                      <div class="programPageTitleText" style="padding-top:8px;padding-bottom:6px;padding-left:8px;text-align:left;">Projectionist Report</div>
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
  SSFDebug::globalDebugger()->belch('editorState', $editorState, -1);
  SSFDebug::globalDebugger()->becho('forceApplicationOfUnacceptedWorks', ($forceApplicationOfUnacceptedWorks) ? 'forced' : 'not forced', -1);
  
  SSFQuery::useAdministratorAsCreatorModifier();
  
  // initialize aspect ratio table
  $aspectRatioSelectString = "SELECT aspectRatioId, ratio, ratioDescription, shortDescription, description from aspectRatios";
  $aspectRatioRows = SSFDB::getDB()->getArrayFromQuery($aspectRatioSelectString);
  $aspectRatioTable = array();
  foreach ($aspectRatioRows as $aspectRatioRow) {
    $aspectRatioTable[$aspectRatioRow['aspectRatioId']]['ratio'] = $aspectRatioRow['ratio'];
    $aspectRatioTable[$aspectRatioRow['aspectRatioId']]['shortDescription'] = $aspectRatioRow['shortDescription'];
    $aspectRatioTable[$aspectRatioRow['aspectRatioId']]['ratioDescription'] = $aspectRatioRow['ratioDescription'];
  }
  
  $applyWasClicked = isset($editorState['submitWorks']) && $editorState['submitWorks'] == 'Apply' && isset($editorState['workIdsListWidget']);
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
    $insertQueryValues = '';
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
      $validWorkId = count($workOfInterest) != 0;
      if ($validWorkId) {
        $workIdentifier = HTMLGen::computedFileNameForWork($workOfInterest['designatedId'], $workOfInterest['titleForSort'], $workOfInterest['submitterName']);
      } else { // this workId does not exist, discard it.
        $workIdentifier = ' is not a valid workId. It will be omitted from the show even if you try to force it in.';
        $workOfInterest['workId'] = $workId;
        $workOfInterest['accepted'] = 0;
      }
      if (!$forceApplicationOfUnacceptedWorks && $restrictEditingToAcceptedWorksOnly && ($workOfInterest['accepted'] != 1)) {
        // error condition: work was not accepted
        if ($errors == 0) $errorString = "<br>ERROR<br>The following works were not accepted so the operation is cancelled.<br>";
        else $errorString .=  "<br>";
        $errorString .= '&bull; ' . $workOfInterest['workId'] . ' ' . $workIdentifier;
        $errors++;
      } else if ($validWorkId) {
        $insertQueryValues .= $priorLineEnd . "(" . $editorState['showSelector'] . ", " . $workOfInterest['workId'] . ", " . $showOrderIndex . ", 0, 0, 0, '" . $workIdentifier . "', '" . SSFRunTimeValues::nowForDB() . "', " . SSFAdmin::userIndex() . ")";
        $priorLineEnd = ",\r\n";
        $showOrderIndex += 10;
      }
    }
    if ($errors == 0) {
      SSFDB::getDB()->saveData($deleteQuery);
      if (($workIdsOrderString != '') && ($insertQueryValues != '')) {
        SSFDebug::globalDebugger()->belch('### ', $insertQuery, -1);
        SSFDB::getDB()->saveData($insertQuery . $insertQueryValues);
      }
    }
  }
?>  

<div id="formEnclosingDiv" style="margin-top:4px;text-align:left;">
<form name='showOrderEntryForm' id='showOrderEntryForm' action='projectionistReport.php' method='post' style='margin:0;padding:0;'>
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
//  HTMLGen::displayAdministratorSelector("padding-top:4px;", "rowTitleText", 
//                                    "document.showOrderEntryForm.submit();", "projectionistReport");

  // initialize $showRows
  $showSummaryFilter1 = "(active=1 or editable=1) and "; // 6/29/11
  $query = "SELECT showId, `date`, startTime, DATE_FORMAT(startTime,'%l:%i %PM') AS strtTime, shortDescription, description, "
         . "workId, active, editable, count(*) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration, works.projectionistNotes "
         . "FROM `shows` LEFT JOIN runOfShow ON `show` = showId LEFT JOIN works ON workId = `work` "
         . "WHERE " . $showSummaryFilter1 . "event = " . $editorState['eventSelector'] . " " // 6/29/11
         . "GROUP BY showId "
         . 'ORDER BY date, startTime, shortDescription';
//  SSFQuery::debugNextQuery();
  $showRows = SSFDB::getDB()->getArrayFromQuery($query);
  $showsExist = count($showRows) > 0;
  $noneRow = array();
  $noneRow['showId'] = 'none';
  array_unshift($showRows, $noneRow); // push in $noneRow as the 1st of the $showRows
  if (isset($editorState['showSelector'])) SSFDebug::globalDebugger()->becho('editorState[showSelector]-1a', $editorState['showSelector'], -1);
  if (((!isset($editorState['showSelector'])) || ($editorState['showSelector'] == 0)) && $showsExist) $editorState['showSelector'] = $showRows[0]['showId'];
  $workIdsList = "";
  $eventAlreadyOccured = true;
  if ($showsExist) {
    $workIdsListQuery = "SELECT work from runOfShow where `show` = '" . $editorState['showSelector'] . "' ORDER BY showOrder";
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
    SSFDebug::globalDebugger()->belch('showRow in foreach', $showRow, -1);
    if ($showRow['showId'] != 'none') {
      $showSelectionOptions[$showRow['showId']] = $showRow['showId'] . ". " . date('D, n/j/y', strtotime($showRow['date'])) . ", " 
                                          . date('g:i A', strtotime($showRow['startTime'])) . ", " . $showRow['shortDescription'];
    } else { $showSelectionOptions['none'] = '00. -- select one -- '; }
    if ($showRow['showId'] == $editorState['showSelector']) { 
      SSFDebug::globalDebugger()->belch('setting selectedShowRow to ', $showRow, -1);
      $selectedShowRow = $showRow;
    }
  }
  if ((count($selectedShowRow) == 0) && $showsExist) $selectedShowRow = $showRows[0];
  SSFDebug::globalDebugger()->belch('showSelectionOptions', $showSelectionOptions, -1);
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
//                     . 'onchange="document.getElementById(\'showSelector\').selectedIndex=-1;document.getElementById(\'showOrderEntryForm\').submit();">';
                     . 'onchange="document.getElementById(\'showOrderEntryForm\').submit();">';
                HTMLGen::displaySelectionOptions($eventSelectionOptions, $editorState['eventSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
    <!-- Show Selector 
          <div class='formRowContainer' style="padding-top:4px;">
            <div class='rowTitleText'>Show to set up:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?  
                echo '<select id="showSelector" name="showSelector" style="width:480px;"' . $selectorDisabledText . 'onchange="document.getElementById(\'showOrderEntryForm\').submit();">';
                HTMLGen::displaySelectionOptions($showSelectionOptions, $editorState['showSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
-->
<!-- End Filters ------------------------------------------------------------- -->

<?php 
  $countShowSummaryRows = 0;
  if ($showsExist) {
    $showSummaryFilter2 = "(active=1 or editable=1) and "; // 6/29/11
    $showSummaryQuery = "SELECT showId, `date` , DATE_FORMAT(startTime,'%l:%i %PM') AS strtTime, shortDescription, description, "
                      . "active, editable, workId, count(*) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration, works.projectionistNotes "
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
                   . "works.workId, works.designatedId, CONCAT('\"', works.title, ',\" ', people.name) AS workDesc, works.acceptFor, works.runTime, "
                   . "works.aspectRatio, works.anamorphic, works.frameWidthInPixels, works.frameHeightInPixels, works.projectionistNotes "
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

  if ((!$eventAlreadyOccured) && ($selectedShowRow['showId'] != 'none')) {
    $showIsEmpty = $selectedShowRow['duration'] == '';
    $showText = "<b>Show " . $selectedShowRow['showId'] . "</b>. " . $selectedShowRow['date'] . " " 
              . $selectedShowRow['strtTime'] . ", <i>" . $selectedShowRow['shortDescription'] 
              . "</i> [" . $selectedShowRow['workCount'] . " works, TRT: " . $selectedShowRow['duration'] . "]";
    SSFDebug::globalDebugger()->belch("selectedShowRow", $selectedShowRow, -1); 
    echo '<!-- Begin Setup works-in-order section -->';
    $setupSectionStyle = "padding:12px 0 9px 10px;margin-left:-10px;margin-top:14px;margin-bottom:5px;border:dashed grey thin;";
    $setupSectionStylePaddingBottom = ($showIsEmpty) ? 'padding-bottom:20px;' : 'padding-bottom:8px;';
    echo '<div id="setupSection" style="' . $setupSectionStyle . $setupSectionStylePaddingBottom . '">';
    echo '<div class="homePageTitleText" style="text-align:left;margin-left:4px;">Setup ';
    echo '  <span class="datumDescription">for ' . $eventTextWithId . '</span>';  
    echo '</div>';
    echo '<div class="homePageTitleText" style="text-align:left;margin-top:-4px;margin-left:4px;color:#333333;">Setup ';
    echo "  <span class='datumDescription' style='color:#F7FF6F;'>" . $showText . "</span>";
    echo '</div>';
    // Lines below are like HTMLGen::addTextWidgetRowWithTitleWidth('Work Ids in Order', 'workIdsListWidget', $workIdsList, 80, "", $eventAlreadyOccured);
    echo '<div id="workIdsEditRow" style="margin:10px 0 -8px;">'; // work-ids-in-order row. 
    $disabledString = ($eventAlreadyOccured) ? ' disabled="disabled" ' : '';
    HTMLGen::addTextWidgetRowHelper1('Work Ids in Order', 'workIdsListWidget', $workIdsList, 250, "", $eventAlreadyOccured);  // 250 was 120
    echo "        </div>\r\n";
    echo "        <div style='float:left;padding-left:12px;padding-top:3px;'>\r\n";
    echo '          <input type="submit" id="submitWorks" name="submitWorks" value="Apply"' . $disabledString . '>' . "\r\n";
                    /* <!-- for <? echo $selectedShowRow['shortDescription'] ?> --> */
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    echo "    </div>\r\n";
    echo "    <div id='showWidget' style='margin-left:20px;'>";
    if ($errors != 0) { 
      echo '<div class="datumDescription" style="color:yellow;margin:6px 0 2px 50px;">' . $errorString . '<br>'; 
      // Button to force application of unaccepted works.
      $onClickStringForCancel = 'javascript:document.getElementById(\'forcedWorkIdOrderString\').value = \'\';'
                              . 'document.showOrderEntryForm.submit();';
      echo '<input type="button" id="cancelApplicationOfUnacceptedWorks" name="cancelApplicationOfUnacceptedWorks" '
             . 'value="OK, forget it." onClick="' . $onClickStringForCancel . '" style="margin-top:8px;">' . "&nbsp;&nbsp;";
      $onClickStringForForce = 'javascript:document.getElementById(\'forcedWorkIdOrderString\').value = \'' . $cachedWorkIdOrderString . '\';'
//                             . 'alert(\'' . $cachedWorkIdOrderString  . '\');document.showOrderEntryForm.submit();';
                              . 'document.showOrderEntryForm.submit();';
      echo '<input type="button" id="forceApplicationOfUnacceptedWorks" name="forceApplicationOfUnacceptedWorks" '
             . 'value="Force application of the unaccepted works as entered." onClick="' . $onClickStringForForce . '" style="margin-top:8px;">' . "<br>";
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
//  echo "<div class='smallBodyTextOnBlack' style='width:500;margin:10px 0 -10px 25px;'>\r\n";
//  echo "  <div style='float:left;'><b>Codes Legend:</b></div>\r\n";
//  echo "  <div style='float:left;margin-left:10px;'>D: Documentary; L: Includes live performance; I: Designated as an installation in this show;"
//     . "<br>J: Accepted as an installation; K: Maybe accepted as an installation;</div>\r\n";
//  echo "  <div style='clear:both;'></div>\r\n";
//  echo "</div>\r\n";
  
  echo "<div style='padding-top:2px;margin-top:0px;margin-left:20px;border:0px red solid;'>\r\n";

  // First display the accepted works not yet programmed.
  if (FALSE && !$eventAlreadyOccured) {
    $noShowSummaryQuery = 'SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(runTime))) AS duration, count(*) AS workCount '
                        . 'FROM works '
                        . 'WHERE callForEntries=' . SSFRunTimeValues::getCallForEntriesId()
                        . ' AND accepted=1 AND workId NOT IN ' 
                        . '(SELECT DISTINCT `work` FROM runOfShow WHERE `show` IN '
                        . '(SELECT DISTINCT `showId` FROM shows WHERE shows.editable=1 AND event=' . $editorState['eventSelector'] . ')) '
                        . ' GROUP BY accepted';
    $noShowSummaryRows = SSFDB::getDB()->getArrayFromQuery($noShowSummaryQuery);
    if (count($noShowSummaryRows) >=1) $noShowSummaryRow = $noShowSummaryRows[0];
    else { 
      $noShowSummaryRow['duration'] = 0;
      $noShowSummaryRow['workCount'] = 0;
    }
    $noShowSummaryTable = array();
    foreach ($noShowSummaryRows as $noShowSummaryRow) { $noShowSummaryTable['showId'] = $noShowSummaryRow; }

    $noShowListQuery = 'SELECT workId, designatedId, title, acceptFor, '
                                        . 'CONCAT("\'", title, ",\' ", name) AS workDesc, runTime, works.projectionistNotes, acceptFor '
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
    echo "    <div class='datumDescription' style='padding:10px 30px 6px 6px;min-width:580px;border:0px green solid;'>";
    echo "    <div class='datumDescription' style='margin-top:10px;margin-bottom:4px;'>" . $noShowSummaryRow['shortDescription'] . "<br>" 
                . "<i>" . $noShowSummaryRow['description'] . " </i>[" . $noShowSummaryRow['workCount'] . " works, TRT: " . $noShowSummaryRow['duration'] . "]</div>\r\n";
    $bgnd = '#FFFFCC';
    displayShowDetailHeaderLine($bgnd);
    foreach ($noShowTable as $noShowRow) {
      $bgnd = displayShowDetailDataLine($noShowRow, $bgnd, $aspectRatioTable);
    }
    echo "      </table>\r\n";
    echo "    </div>\r\n";
  }
  
  // Now display the existing shows for this event.
  if ($showsExist) {
    SSFDebug::globalDebugger()->belch('showSummaryRows', $showSummaryRows, -1);
    foreach ($showSummaryRows as $showSummaryRow) {
      if (stripos($showSummaryRow['shortDescription'], 'installation') == false) displayShowDetail($showSummaryRow, $showTable, $aspectRatioTable);
    }
  }
  echo "    </div>\r\n";
  // End Display Event section
?>
    </div>
    <div style="clear: both;"></div>
    </div>
  </div> <!-- border:dashed grey thin -->
<!-- These changeCount hidden inputs are needed because os legacy code in HTMLGen -->
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
<!--  <input type="hidden" id="loginUserId" name="loginUserId" value=0> -->
  <input type="hidden" id="forcedWorkIdOrderString" name="forcedWorkIdOrderString" value="">
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