<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Runs of Shows</title>
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
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
                      <div class="programPageTitleText" style="padding-top:8px;padding-bottom:6px;padding-left:8px;text-align:left;">Runs of Shows</div>
                      <br><br><!-- TODO: Why is this <br> needed here? -->

<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $debugIt = -1;

  // $editorState['adminSelector'] - There is no longer any need to initialize this because it's value is handled 
  // behind the scenes by HTMLGen::displayAdministratorSelector (and therein by SSFAdmin::userIndex()).
  // We no longer use $editorState['adminSelector'], but in it's place, we call SSFQuery::useAdministratorAsCreatorModifier(). 6/11/11
  SSFQuery::useAdministratorAsCreatorModifier();
//  $userId = 1; // 6/11/11 Made this the Admin User
  $userId = SSFAdmin::userIndex();
  
  date_default_timezone_set('America/Denver');
  
  function eventDayDisplay($startDate, $endDate) {
    $dayDisplay =  date('D', strtotime($startDate)) . "-" . date('D', strtotime($endDate));
    $dateDisplay =  date('n/j/y', strtotime($startDate)) . " - " . date('n/j/y', strtotime($endDate));
    $dayDateDisplay = $dayDisplay . ', ' . $dateDisplay;
    return $dayDateDisplay;
  }

  if (count($_POST) == 0) {
    $editorState['eventSelector'] = 0;
    $editorState['showSelector'] = 0;
//    $editorState['adminSelector'] = 1; // There is no adminSelector. 6/11/11
  } 
  else $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('_POST', $_POST, -1);
  
  if (isset($editorState['submitWorks']) && $editorState['submitWorks'] == 'Submit Works' 
                                         && isset($editorState['workIdsListWidget']) && $editorState['workIdsListWidget'] != '') {
    $submitterWorkSelectString = 'SELECT workId, designatedId, titleForSort, name, acceptFor as submitterName FROM people JOIN works on submitter=personId WHERE accepted = 1';
    $worksArray = SSFDB::getDB()->getArrayFromQuery($submitterWorkSelectString); 
    SSFDebug::globalDebugger()->belch('worksArray', $worksArray, -1);
    $workIdsOrderString = $editorState['workIdsListWidget'];
    $workIdsOrderString = trim(str_replace(array("\r\n", "\n", "\r", ","), " ", $workIdsOrderString));
    // Replace two space characters by one in a loop until no more replacements can be made.
    $patterns = array("/  /");
    $replacements = array(" ");
    do {
      $workIdsOrderStringOld = $workIdsOrderString;
      $workIdsOrderString = preg_replace($patterns, $replacements, $workIdsOrderStringOld); 
//      SSFDebug::globalDebugger()->belch('workIdsOrderString', '|' . $workIdsOrderString . '|', -1);
    } while (isset($workIdsOrderString) && ($workIdsOrderString != $workIdsOrderStringOld));
    $worksIdsOrderArray = array();
    $worksIdsOrderArray = explode(" ", $workIdsOrderString);
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
      $insertQuery .= $priorLineEnd . "(" . $editorState['showSelector'] . ", " . $workOfInterest['workId'] . ", " . $showOrderIndex . ", 0, 0, 0, '" . $workIdentifier . "', '" . SSFRunTimeValues::nowForDB() . "', " . $userId . ")";
      $priorLineEnd = ",\r\n";
      $showOrderIndex += 10;
    }
    SSFDebug::globalDebugger()->belch('### ', $insertQuery, -1);
    SSFDB::getDB()->saveData($deleteQuery);
    SSFDB::getDB()->saveData($insertQuery);
  }

  function tdTag($bgnd, $align, $valign="top", $padLeft="4px") {
    return "            <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align 
                                                  . ";padding-left:" . $padLeft . ";padding-right:4px;vertical-align:" . $valign . ";'>";
  }
  
?>  

<div id="formEnclosingDiv" style="margin-top:4px;text-align:left;">
<form name='showOrderEntryForm' id='showOrderEntryForm' action='showShowOrder.php' method='post' style='margin:0;padding:0;'>
  <div style="margin:4px 20px 10px 20px;border:yellow dashed 0px;">
<!-- Begin Filters -------------------------------------------------------- -->
    <!-- Event Selector -->
          <div class='formRowContainer' style="padding-top:4px;">
            <div class='rowTitleText'>Event:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?php //SSFDB::debugNextQuery(); 
                $query = 'SELECT eventId, venues.name as venueName, venues.country as venueCountry, startDate, endDate, didOccur, cancelled '
                       . 'FROM events JOIN venues ON venue=venueId '
//                       . 'WHERE (didOccur=0 or didOccur="" or didOccur IS NULL) and (cancelled=0 or cancelled="" or cancelled IS NULL) '
                       . 'WHERE (cancelled=0 or cancelled="" or cancelled IS NULL) '
                       . 'ORDER BY startDate desc';
                //SSFDB::debugNextQuery();
                $eventRows = SSFDB::getDB()->getArrayFromQuery($query);
                echo '<select id="eventSelector" name="eventSelector" style="width:480px;" '
                     // NOTE: It seems that setting the selectedIndex of an HTML SELECT object to -1 will cause supress posting of the object's value.
//                     . 'onchange="document.getElementById(\'showSelector\').selectedIndex=-1;document.getElementById(\'showOrderEntryForm\').submit();">';
                     . 'onchange="document.getElementById(\'showOrderEntryForm\').submit();">';
                $selectionOptions = array();
                $selectedEventRow = array();
                if (count($_POST) == 0 && count($eventRows) > 0) $editorState['eventSelector'] = $eventRows[0]['eventId'];
                foreach ($eventRows as $eventRow) {
                  $dayDateDisplay = eventDayDisplay($eventRow['startDate'], $eventRow['endDate']);
                  $yearMonthDisplay = date('n/y', strtotime($eventRow['startDate']));
                  $selectionOptions[$eventRow['eventId']] = $eventRow['eventId'] . ". (" . $yearMonthDisplay . ') ' 
                                                          . $eventRow['venueName'] . ", " . $eventRow['venueCountry'] . ", " . $dayDateDisplay;
                  if ($eventRow['eventId'] == $editorState['eventSelector']) $selectedEventRow = $eventRow;
                }
                HTMLGen::displaySelectionOptions($selectionOptions, $editorState['eventSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
    <!-- Show Selector -->
<!--
          <div class='formRowContainer' style="padding-top:4px;">
            <div class='rowTitleText'>Show:</div>
            <div class="entryFormFieldContainer">
              <div>
-->
        <?php //SSFDB::debugNextQuery(); 
                $query = 'SELECT showId, event, date, startTime, shortDescription '
                       . 'FROM shows '
                       . 'WHERE event = ' .  $editorState['eventSelector'] . ' '
                       . 'ORDER BY date, startTime';
                $showRows = SSFDB::getDB()->getArrayFromQuery($query);
                $showsExist = count($showRows) > 0;
//                echo '<select id="showSelector" name="showSelector" style="width:480px;" onchange="document.getElementById(\'showOrderEntryForm\').submit();">';
                $selectionOptions = array();
                $selectedShowRow = array();
                if ((!isset($editorState['showSelector']) || ($editorState['showSelector'] == 0)) && $showsExist) $editorState['showSelector'] = $showRows[0]['showId'];
                foreach ($showRows as $showRow) {
                  $selectionOptions[$showRow['showId']] = $showRow['showId'] . ". " . date('D, n/j/y', strtotime($showRow['date'])) . ", " 
                                                        . date('g:i A', strtotime($showRow['startTime'])) . ", " . $showRow['shortDescription'];
                  if ($showRow['showId'] == $editorState['showSelector']) $selectedShowRow = $showRow;
                }
                  $selectedShow = ($showsExist) ? $selectedShowRow['showId'] : '';
//                HTMLGen::displaySelectionOptions($selectionOptions, $editorState['showSelector']);
//                echo '</select>' . "\r\n";
        ?>
<!--
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
-->          
<!-- End Filters ------------------------------------------------------------- -->

<div style="padding:4px 0;margin-left:-20px;margin-top:14px;margin-bottom:5px;border:thin dashed grey;">

<!-- <div class='homePageTitleText' style='text-align:left;margin-left:4px;'>Setup <span class="smallBodyTextOnBlack">for Show <?php echo $selectedShow; ?></span></div> -->
<div style="padding-top:2px;margin-left:20px;">
<?php 
  $workIdsList = "";
  $disabled = true;
/*
  if ($showsExist) {
    $workIdsListQuery = "SELECT work from runOfShow where `show` = " . $editorState['showSelector'] . " ORDER BY showOrder";
    $workIdsRows = SSFDB::getDB()->getArrayFromQuery($workIdsListQuery);
    $commaSpace = "";
    foreach ($workIdsRows as $workIdRow) {
      $workIdsList .= $commaSpace . $workIdRow['work'];
      $commaSpace = ", ";
    }
    $disabled = (!isset($selectedEventRow['didOccur']) || $selectedEventRow['didOccur'] != 0) ? true : false;
  }
  $disabledString = ($disabled) ? ' disabled="disabled" ' : '';
//  HTMLGen::addTextWidgetRowWithTitleWidth('Work Ids in Order', 'workIdsListWidget', $workIdsList, 80, "", $disabled);
    HTMLGen::addTextWidgetRowHelper1('Work Ids in Order', 'workIdsListWidget', $workIdsList, 120, "", $disabled);
    echo "        </div>\r\n";
    echo "        <div style='float:left;padding-left:12px;padding-top:3px;'>\r\n";
    echo '          <input type="submit" id="submitWorks" name="submitWorks" value="Submit Works"' . $disabledString . '>' . "\r\n";
                    /* <!-- for <? echo $selectedShowRow['shortDescription'] ?> --> 
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    echo "            </div>\r\n";
    echo "          </div>\r\n";
    echo "<div style='padding:6px 0 10px 0;margin-left:-20px;margin-top:16px;margin-bottom:0px;border:thin dashed grey;'>\r\n";
*/
  $countShowSummaryRows = 0;
  if ($showsExist) {
    $showSummaryQuery = "SELECT showId, `date` , DATE_FORMAT(startTime,'%l:%i %PM') AS strtTime, shortDescription, description, "
                      . "workId, count(*) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration "
                      . "FROM `runOfShow` JOIN shows ON `show` = showId JOIN works ON workId = `work` "
                      . "WHERE event = " . $editorState['eventSelector'] . " "
                      . "GROUP BY `show` ORDER BY `show` , showOrder";
    $showSummaryRows = SSFDB::getDB()->getArrayFromQuery($showSummaryQuery);
    $countShowSummaryRows = count($showSummaryRows);
    $showSummaryTable = array();
    foreach ($showSummaryRows as $showSummaryRow) { $showSummaryTable['showId'] = $showSummaryRow; }
    $showListQuery = "SELECT showId, `date` , DATE_FORMAT(startTime, '%l:%i %PM') AS strtTime, shortDescription, includesLivePerformanceHere, "
                   . "description, isInstallation, workId, designatedId, CONCAT('\"', title, ',\" ', name) AS workDesc, runTime, acceptFor "
                   . "FROM `runOfShow` JOIN shows ON `show` = showId JOIN works ON workId = `work` JOIN people ON personId = submitter "
                   . "WHERE event = " . $editorState['eventSelector'] . " ORDER BY `show` , showOrder";
    $showRows2 = SSFDB::getDB()->getArrayFromQuery($showListQuery);
    $showTable = array();
    foreach ($showRows2 as $showRow) { $showTable[$showRow['showId']][] = $showRow; }
    SSFDebug::globalDebugger()->belch('showTable', $showTable, -1);
  } 

  $eventText = "<b>Event " . $selectedEventRow['eventId'] . ".</b> " . $selectedEventRow['venueName'] . ", " . $selectedEventRow['venueCountry'] . ", " 
             . eventDayDisplay($selectedEventRow['startDate'], $selectedEventRow['endDate']);
//  echo "<div class='homePageTitleText' style='text-align:left;margin-left:4px;'>Display <span class='datumDescription'>"
  echo "<div class='homePageTitleText' style='text-align:left;margin-left:4px;'><span class='datumDescription'>"
      . $eventText . " (" . $countShowSummaryRows . " shows)</span></div>";
  echo "<div class='smallBodyTextOnBlack' style='width:500;margin:10px 0 0 25px;'>\r\n";
  echo "  <div style='float:left;'><b>Codes Legend:</b></div>\r\n";
  echo "  <div style='float:left;margin-left:10px;'>D: Documentary; I: Designated as an installation in this show;<br>"
//     . "J: Accepted as an installation; L: Includes live performance; S: Screen;</div>\r\n";
     . "J: Accepted as an installation; L: Includes live performance;</div>\r\n";
  echo "  <div style='clear:both;'></div>\r\n";
  echo "</div>\r\n";
  echo "<div style='padding-top:2px;margin-left:20px;border:0px red solid;'>\r\n";
//  echo "    <div class='datumDescription' style='padding-left:10px;'>(" . count($showSummaryRows) . " shows) </div>\r\n";

  if ($showsExist) {
    foreach ($showSummaryRows as $showSummaryRow) {
  //    echo "      <div>Show " . $showSummaryRow['showId'] . ". " . $showSummaryRow['date'] . " "
  //                            . $showSummaryRow['strtTime'] . ", " . $showSummaryRow['shortDescription'] . "</div>";
      echo "    <div class='datumDescription' style='padding:10px 30px 6px 6px;width:580px;border:0px green solid;'>";
      echo "    <div class='datumDescription' style='padding-bottom:4px;'>" . $showSummaryRow['description'] . "<br><b>Show " 
                  . $showSummaryRow['showId'] . "</b>. " . $showSummaryRow['date'] . " " 
                  . $showSummaryRow['strtTime'] . ", " . $showSummaryRow['shortDescription'] 
                  . " [" . $showSummaryRow['workCount'] . " works, TRT: " . $showSummaryRow['duration'] . "]</div>\r\n";
      $bgnd = '#FFFFCC';
      echo "      <table border='0' cellpadding='2' cellSpacing='0' style='padding-left:0px;'>\r\n";
      echo "        <tr>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . "Work Id</td>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . "Dsgntd Id</td>\r\n";
      echo tdTag($bgnd, 'left', 'bottom') . "Work</td>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . "Codes</td>\r\n";
      echo tdTag($bgnd, 'center', 'bottom') . "Run&nbsp;Time</td>\r\n";
      echo "        </tr>\r\n";
      foreach ($showTable[$showSummaryRow['showId']] as $showRow) {
        $codes = "";
        if (isset($showRow['includesLivePerformanceHere']) && $showRow['includesLivePerformanceHere'] != 0) $codes .= "L";
        if (isset($showRow['isInstallation']) && $showRow['isInstallation'] != 0) $codes .= "I";
        if (isset($showRow['acceptFor']))
          switch ($showRow['acceptFor']) {
            case 'installationOnly': $codes .= "J"; break;
            case 'installationMaybe': $codes .= "J"; break;
  //          case 'screening': $codes .= "S"; break;
            case 'documentary': $codes .= "D"; break;
            case 'alternateVenue': $codes .= "V"; break;  // added 7/18/13
          }
        SSFDebug::globalDebugger()->belch('showRow', $showRow, -1);
        $howPaidIsDefined = isset($paymentRow['howPaid']) && ($paymentRow['howPaid'] != '');
        $howPaid = ($howPaidIsDefined) ? $paymentRow['howPaid'] : 'undefined';
        if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
        echo "        <tr>\r\n";
        echo tdTag($bgnd, 'center') . $showRow['workId'] . "</td>\r\n";
        echo tdTag($bgnd, 'center') . $showRow['designatedId'] . "</td>\r\n";
        echo tdTag($bgnd, 'left') . $showRow['workDesc'] . "</td>\r\n";
        echo tdTag($bgnd, 'center', 'bottom') . $codes . "</td>\r\n";
        echo tdTag($bgnd, 'center', 'bottom') . $showRow['runTime'] . "</td>\r\n";
        echo "        </tr>\r\n";
      }
      echo "      </table>\r\n";
      echo "    </div>\r\n";
    }
  }
?>
    </div>
    <div style="clear: both;"></div>
    </div>
  </div>
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
</form>

<!-- /*
// Time summaries for the shows for an event
SELECT showId, `date` , DATE_FORMAT( startTime, '%l:%i %PM' ) AS strtTime, shortDescription, count( * ) AS workCount, SEC_TO_TIME( SUM( TIME_TO_SEC( runTime ) ) ) AS duration
FROM `runOfShow` JOIN shows ON `show` = showId JOIN works ON workId = `work` WHERE event =11
GROUP BY `show` ORDER BY `show` , showOrder LIMIT 0 , 500 

// Runs of shows for an event with runTime
SELECT showId, `date` , DATE_FORMAT( startTime, '%l:%i %PM' ) AS strtTime, shortDescription, CONCAT( designatedId, ', ', title, ', ', name ) AS workDesc, runTime
FROM `runOfShow`
JOIN shows ON `show` = showId
JOIN works ON workId = `work`
JOIN people ON personId = submitter
WHERE event =11
ORDER BY `show` , showOrder
LIMIT 0 , 500 
*/ -->


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
<!-- InstanceEnd --></html>