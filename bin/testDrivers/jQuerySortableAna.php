<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->

  <title>jQuery Sort Shows Test</title>
  <link rel="icon" href="favicon.png" type="image/png">

  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
  <link rel="stylesheet" href='jQuerySortable.css' type='text/css'>

  <style type='text/css'>
    .progShowHeader {
      margin: auto 3px;
      padding: 1px;
    }
  </style>

</head>
<body>
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', True);
    
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  
  $SSFUserIndex = 5;
  $callForEntries = 14;
  $showIdsOfInterest = array(67, 68, 69);
  $showIdsOfInterestText = "(67, 68, 69)";
?>  


  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
    <div class='smallBodyTextOnBlack' style='width:500;margin:4px 0 10px 3px;'>
      <div style='float:left;'><b>Codes Legend:</b></div>
      <div style='float:left;margin-left:10px;'>D: Documentary; L: Includes live performance; I: Designated as an installation in this show;<br>J: Accepted as an installation; K: Maybe accepted as an installation; V: Alternate Venue</div>
      <div style='clear:both;'></div>
    </div>
    <div class="datumDescription bodyTextOnBlack progShowHeader">Source: </div>
    <div class="progShowHeader datumDescription">Total Run Time: <span id="trt-0" class="runTimeDisplayText">0:00:00</span></div>
    <div class="progShowHeader datumDescription">Works: <span id="wrks-0" class="idDisplayText"></span></div>
    <ul class='computable sortable connected list' id='sortableList-0'>
<?php
  $worksForShowsQuery = "SELECT DISTINCT workId, designatedId, title, name, runTime, acceptFor, includesLivePerformance "
                      . "FROM works JOIN people ON submitter=personId LEFT JOIN runOfShow ON workId = work "
                      . "WHERE (callForEntries=" . $callForEntries . " AND accepted = 1 AND (acceptFor = 'screening' OR acceptFor = 'installationOnly')) OR workId=787 "
                      . "ORDER BY `show`, showOrder, acceptFor DESC, designatedId";  
  SSFDebug::globalDebugger()->becho('$worksForShowsQuery', $worksForShowsQuery, -1);
  $worksForShowsRows = SSFDB::getDB()->getArrayFromQuery($worksForShowsQuery);
  SSFDebug::globalDebugger()->belch('$worksForShowsRows', $worksForShowsRows, -1);

  $rowOrdinal = 0;
  $totalRunTimeSeconds = 0;
  foreach ($worksForShowsRows as $workForShow) {
    $rowOrdinal++;
    $runTimeSeconds = runTimeSeconds($workForShow['runTime']);
    $totalRunTimeSeconds += $runTimeSeconds;
    $rowOrdinalText = ($rowOrdinal < 10) ? '0' . $rowOrdinal : $rowOrdinal;
    echo listItemFor($rowOrdinalText, $workForShow, 'srcWrk-')  . PHP_EOL;
  }
?>
    </ul>
  </div>


<?php 

  function getCodes($showRow) {
    $codes = "";
//    if (isset($showRow['includesLivePerformanceHere']) && $showRow['includesLivePerformance'] != 0) $codes .= "L";
//    if (isset($showRow['isInstallation']) && $showRow['isInstallation'] != 0) $codes .= "I";
    if (isset($showRow['acceptFor'])) {
      switch ($showRow['acceptFor']) {
        case 'installationOnly': $codes .= "I"; break;
        case 'installationMaybe': $codes .= "K"; break;
        case 'screening': $codes .= "S"; break;
        case 'documentary': $codes .= "D"; break;
        case 'alternateVenue': $codes .= "V"; break; // added 7/18/13
      }
    }
    return $codes;  
  }
  
  function runTimeSeconds($runTime) {
    list($hours, $minutes, $seconds) = explode(":", $runTime);
    $runTimeSeconds = (360 * $hours) + (60 * $minutes) + $seconds; 
    return $runTimeSeconds;
  }

  function formattedRunTimeString($seconds) {
    $minutes = floor($seconds/60);
    $secondsModMinutes = $seconds % 60;
    $string = vsprintf("%.2u:%.2s",array($minutes, $secondsModMinutes));
    $string = str_replace("'", "", $string); // strip embedded single quotes
    return $string;
  }

  function listItemFor($rowOrdinalText, $workForShow, $listItemIdPrefix='destWrk-') {
    $workId = $workForShow['workId'];
    if (isset($workForShow['showId'])) {
      if ($workForShow['showId'] != "") { 
        $listItemIdPrefix = 'wrkForShow-' . $workForShow['showId'] . "-"; 
      } else {
        $listItemIdPrefix = 'destWrk-';
      }     
    } else { 
      $listItemIdPrefix = 'srcWrk-'; 
    }
    $workIdText = $listItemIdPrefix . $workId;
    $runTimeSeconds = runTimeSeconds($workForShow['runTime']);
//    $html = "     <li class='bodyTextOnDarkGray' id='li-" . $workIdText . "'><div class='work' id='" . $workIdText . "'>"
    $html = "     <li class='bodyTextOnDarkGray' id='li-" . $workIdText . "'><div class='work' id='work" . $workIdText . "'>" . $rowOrdinalText . ". "
               . "<span style='color:#B7E5F7;overflow:visible;'>" . $workForShow['designatedId'] . "</span>"
               . " <span class='idDisplayText'>" . $workId . "</span>"
               . " <span style='color:gray'>(" . getCodes($workForShow) . ")</span>" // #53c81e
               . " <span style='color:#8de864;font-style:italic;'>" . htmlspecialchars($workForShow['title'], ENT_COMPAT, 'ISO-8859-1', true) . "</span>" // CCBD99 6db14e 8cbc77
               . " <span style='color:#EEC;'>" . htmlspecialchars($workForShow['name'], ENT_COMPAT, 'ISO-8859-1', true) . "</span>"
               . " <span class='runTimeDisplayText'>" . HTMLGen::timeAsMinutesAndSeconds($workForShow['runTime']) . "</span>"
               . "<script type='text/javascript'>document.getElementById('li-" . $workIdText . "').setAttribute('runTimeSeconds', " . $runTimeSeconds . ")</script>"
               . "</div></li>";
//    $html .= "     <script type='text/javascript'>document.getElementById('li-" . $workIdText . "').setAttribute('runTimeSeconds', " . $runTimeSeconds . ")</script>" . PHP_EOL;
    return $html;
  }



  $errors = 0;
  $errorString = "";
  SSFDebug::globalDebugger()->belch('_POST', $_POST, 1);
  if (count($_POST) == 0) {
    $editorState['eventSelector'] = 0;
    $editorState['showSelector'] = 0;
  } 
  else $editorState = $_POST;
  $forceApplicationOfUnacceptedWorks = (isset($editorState['forcedWorkIdOrderString']) && ($editorState['forcedWorkIdOrderString'] != '')) ? true : false;
  SSFDebug::globalDebugger()->belch('editorState', $editorState, -1);
  
//  SSFQuery::useAdministratorAsCreatorModifier();  // TODO
  
  $applyWasClicked = (isset($editorState['submitWorks']) && $editorState['submitWorks'] == 'Apply Changes');
  if ($applyWasClicked) {
    $filenameQuery = '';
    $priorLineEnd = "";
    foreach($_POST as $sortableId => $workIdsOrderString) { // foreach($sortables as $sortable)
      if ($ordinalPosition = strpos($sortableId, 'wrkIds-') !== false) {
        $sortablesIndex = substr($sortableId, 7);
        SSFDebug::globalDebugger()->becho('sortablesIndex', $sortablesIndex, -1);
        // get the workIds order text string
        $worksIdsOrderArray = array();
        SSFDebug::globalDebugger()->belch('workIdsOrderString', '|' . $workIdsOrderString . '|', -1);
        $doDatabaseInsert = false;
        if ($workIdsOrderString != '') {
          $doDatabaseInsert = true;
          if ($filenameQuery == '') {
            // get the works filename as the $workIdentifier for the notes field of the runOfShow table
            $filenameQuery = 'SELECT workId, filename FROM works WHERE callForEntries=' . $callForEntries . ' AND accepted=1';
            $filenameRows = SSFDB::getDB()->getArrayFromQuery($filenameQuery);
            foreach ($filenameRows as $filenameRow) {
              $filename[$filenameRow['workId']] = $filenameRow['filename'];
            }

          }
          $worksIdsOrderArray = explode(" ", ltrim(rtrim($workIdsOrderString)));
          SSFDebug::globalDebugger()->belch('worksIdsOrderArray', $worksIdsOrderArray, 1);
          $insertQueryText = 'INSERT INTO runOfShow (`show`, work, showOrder, media, includesLivePerformanceHere, '
                           . 'isInstallation, notes, lastModificationDate, lastModifiedBy) values' . "\r\n";
          $insertQueryValues = '';
          $priorLineEnd = "";
          $showOrderIndex = 0;
          foreach ($worksIdsOrderArray as $workId) {
            $showOrderIndex += 10;
            $workIdentifier = $filename[$workId];
            $insertQueryValues .= $priorLineEnd . "(" . $showIdsOfInterest[$sortablesIndex-1] . ", " 
                                                     . $workId . ", " 
                                                     . $showOrderIndex . ", 0, 0, 0, '" 
                                                     . $workIdentifier . "', '" 
                                                     . SSFRunTimeValues::nowForDB() . "', " 
                                                     . $SSFUserIndex // TODO Eventually make this SSFAdmin::userIndex().
                                                     . ")";
            $priorLineEnd = ",\r\n";
          }
          $insertQuery = $insertQueryText . $insertQueryValues;
        }
        $deleteQuery = 'DELETE FROM `runOfShow` WHERE `runOfShow`.`show` = ' . $showIdsOfInterest[$sortablesIndex-1];
        SSFDebug::globalDebugger()->becho('deleteQuery', $deleteQuery, -1);
        SSFDB::getDB()->saveData($deleteQuery);
        if ($doDatabaseInsert) {
          SSFDebug::globalDebugger()->becho('insertQuery', $insertQuery, -1);
          SSFDB::getDB()->saveData($insertQuery);        
        }
      }          
    }
  }

// Query
  $showWorksQuery = 'SELECT showId, event, active, editable, shortDescription, description, shows.notes,'
                  . ' workId, designatedId, title, runTime, acceptFor, includesLivePerformance, name'
                  . ' FROM shows JOIN runOfShow ON showId = `show` JOIN works ON `work` = workId JOIN people ON submitter=personId'
                  . ' WHERE editable=1 AND showId IN ' . $showIdsOfInterestText 
                  . ' ORDER BY showId, showOrder';
  SSFDebug::globalDebugger()->becho('showWorksQuery', $showWorksQuery, -1);        // TURN THIS BACK ON?
  $showWorkRows = SSFDB::getDB()->getArrayFromQuery($showWorksQuery);
  SSFDebug::globalDebugger()->belch('showRows', $showWorkRows, -1);

  $showInfoQuery = 'SELECT showId, event, active, editable, shortDescription, description, notes'
                 . ' FROM shows WHERE editable=1 AND showId IN ' . $showIdsOfInterestText
                 . ' ORDER BY showId';
  $showRows = SSFDB::getDB()->getArrayFromQuery($showInfoQuery);
  SSFDebug::globalDebugger()->becho('showInfoQuery', $showInfoQuery, -1);
  foreach ($showRows as $showRow) {
    $showInfo[$showRow['showId']] = $showRow;
  }
  SSFDebug::globalDebugger()->belch('showInfo', $showInfo, -1);

?>

  <div id="destinations" style="float:left;background-color:#333;border:1px solid pink;margin:20px;padding:10px;max-width:600px;">
    <div class="datumDescription bodyTextOnBlack progShowHeader">Destinations
      <form name='showOrderDestinationForm' id='showOrderDestinationForm' action='jQuerySortableAna.php' method='post' style='margin:0;padding:0;'>
        <input type="submit" id="submitWorks" name="submitWorks" value="Apply Changes"> <!-- . $disabledString . '> -->
        
<?php

  // Build UI Destinations
  $wrkIds = '';
  $sortableIndex = 0;
  foreach($showIdsOfInterest as $showIdOfInterest) { // loop for each show/sortable.
    $totalRunTimeSeconds = 0;
    $rowOrdinal = 0;      
    $sortableIndex++;
    echo '        <div style="background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">' . PHP_EOL;
    echo '          <div class="datumDescription bodyTextOnBlack progShowHeader">' . $showInfo[$showIdOfInterest]['notes'] . '</div>' . PHP_EOL;
    echo '          <div class="progShowHeader datumDescription">Total Run Time: <span id="trt-' . $sortableIndex . '" class="runTimeDisplayText">0:00:00</span></div>' . PHP_EOL;
    echo '          <div class="progShowHeader datumDescription">Works: <span id="wrks-' . $sortableIndex . '" class="idDisplayText"></span></div>' . PHP_EOL;
//  . '" value="' . ($wrkIds .= $wrkIds . $showRow['designatedId']
    echo '          <ul class="sortable connected list" id="sortableList-' . $sortableIndex . '">' . PHP_EOL;
    foreach($showWorkRows as $showWorkRow) { // generate the list itmes within this sortable
      if ($showWorkRow['showId'] == $showIdOfInterest) {
        $rowOrdinal++;
        $runTimeSeconds = runTimeSeconds($workForShow['runTime']);
        $totalRunTimeSeconds += $runTimeSeconds;
        $rowOrdinalText = ($rowOrdinal < 10) ? '0' . $rowOrdinal : $rowOrdinal;
        echo listItemFor($rowOrdinalText, $showWorkRow) . PHP_EOL;
      }
    }
    echo '          </ul>' . PHP_EOL;
    echo '          <div><input type=hidden name="wrkIds-' . $sortableIndex . '" id="wrkIds-' . $sortableIndex . '" value="' . 'JHELLLO' . '"></div>' . PHP_EOL;
    echo '        </div>' . PHP_EOL;    
  }
?>
      <div style="clear:both"></div>
      </form>
    </div>
  </div>

<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
  <script type='text/javascript' src="jquery.sortable.js"></script>
  <script type='text/javascript' src="jQuerySortable.js"></script>
  <script type='text/javascript'>
    $(function() {      // equivalent to          $( document ).ready(function()
      $('.sortable').sortable();
      // The following line is from https://github.com/farhadi/html5sortable 
      $('.sortable').sortable().bind('sortupdate', function(e, ui) {
        // Triggered when the user stopped sorting and the DOM position has changed.
        // ui.item contains the current dragged element.
        userChanged(e, ui);
      });
      $('.handles').sortable({
        handle: 'span'
      });
      $('.connected').sortable({
        connectWith: '.connected'
      });
      $('.exclude').sortable({
        items: ':not(.disabled)'
      });
      initSortableAttributesDisplay();
    });
  </script>
</body>
</html>