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

  <script>
  
    function formattedRunTimeString(seconds) {
      var minutes = Math.floor(seconds / 60);
      var secondsModMinutes = seconds % 60;
      var timeString = minutes + ":" + secondsModMinutes;
      return timeString;
    }

    function initSortableAttributesDisplay() {
      $( '.sortable' ).each(function( index, elem ) {
        displaySortableAttributes($(this)); 
      });
    }

    function displaySortableAttributes(sortable) {
      var runTimeSeconds = 0;
      var workIdList = '';
      var sortableListId = $( sortable ).attr('id');
      var sortableListIndex = sortableListId.split('-')[1];
      $( sortable ).find( 'li' ).each(function (sortable) {
        //for each list item in the sortable, add up the runtime seconds.
        runTimeSeconds += Number($( this ).attr('runTimeSeconds'));
        workIdList += $( this ).attr('id') + " ";
      });
      var totalRuntimeString = formattedRunTimeString(runTimeSeconds);
      // find the sortable's sibling eq(0) with class = runTimeDisplayText and
      // inside of that, find the span named '#trt-' + sortableListIndex
      var runtimeTextLocation = $( sortable ).siblings().find('#trt-' + sortableListIndex);
      $( runtimeTextLocation ).text(totalRuntimeString);
      var workIdTextLocation = $( sortable ).siblings().find('#wrks-' + sortableListIndex);
      $( workIdTextLocation ).text(workIdList);
      return totalRuntimeString;
    }
    
    function userChanged(e, ui) {
      var lists = $( 'ul' );
      var sortableLists = lists.filter( '.sortable' );
      var theTarget = e.target;
      var targetClasses = theTarget.className;
      if (window.console) console.log($( theTarget ).attr('id') + " with classes: " + targetClasses);
      $( sortableLists ).each(function() {
        // TODO: displaySortableAttributes gets called too often. It should only be called for a sortable that changed.
        // But I don't know how to detect only those sortables that have changed with "connected list"s. So, I
        // only get too many or (if I filter on "computable", as below in comments, too few.
        displaySortableAttributes($( this ));
      });
//      $( theTarget, function() {                    // THESE LINES ARE REFERENCED IN THE COMMENT ABOVE.
//        displaySortableAttributes( $( theTarget ));
//      });
    }

  </script>

</head>
<body>

  <style type="css">
    .progShowHeader {
      margin: auto 3px;
      padding: 1px;
    }
  </style>

  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
    <div class="progShowHeader datumDescription">Total Run Time: <span id="trt-0" class="runTimeDisplayText">0:00:00</span></div>
    <div class="progShowHeader datumDescription">Works: <span id="wrks-0" class="idDisplayText"></span></div>
    <ul class='computable sortable connected list' id='sortableList-0'>

<?php
  error_reporting(E_ALL);
  ini_set('display_errors', True);
    
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  
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

  $worksForShowsQuery = "SELECT workId, designatedId, title, name, runTime "
                      . "FROM works JOIN people ON submitter=personId "
                      . "WHERE callForEntries=14 AND accepted = 1 AND acceptFor = 'screening'";  
  SSFDebug::globalDebugger()->becho('$worksForShowsQuery', $worksForShowsQuery, -1);
  $worksForShowsRows = SSFDB::getDB()->getArrayFromQuery($worksForShowsQuery);
  SSFDebug::globalDebugger()->belch('$worksForShowsRows', $worksForShowsRows, -1);

  $rowOrdinal = 0;
  $totalRunTimeSeconds = 0;
  foreach ($worksForShowsRows as $workForShow) {
    $rowOrdinal++;
    $workId = $workForShow['workId'];
    $runTimeSeconds = runTimeSeconds($workForShow['runTime']);
    $totalRunTimeSeconds += $runTimeSeconds;
    $rowOrdinalText = ($rowOrdinal < 10) ? '0' . $rowOrdinal : $rowOrdinal;
    echo "     <li class='bodyTextOnDarkGray' id='" . $workId . "'><div class='work' id='work" . $workId . "'>" // . $rowOrdinalText . ". "
               . "<span style='color:#B7E5F7;overflow:visible;'>" . $workForShow['designatedId'] . " </span>"
               . "<span class='idDisplayText'>" . $workId . "</span>"
               . " <span style='color:#8de864;font-style:italic;'>" . htmlspecialchars($workForShow['title'], ENT_COMPAT, 'ISO-8859-1', true) . "</span> " // CCBD99 6db14e 8cbc77
               . " <span style='color:#EEC;'>" . htmlspecialchars($workForShow['name'], ENT_COMPAT, 'ISO-8859-1', true) . "</span> "
               . "<span class='runTimeDisplayText'>" . HTMLGen::timeAsMinutesAndSeconds($workForShow['runTime']) . "</span>"
               . "</div></li>" . PHP_EOL;
    echo "     <script>document.getElementById(" . $workId . ").setAttribute('runTimeSeconds', " . $runTimeSeconds . ")</script>" . PHP_EOL;
  }
  
?>

    </ul>
  </div>
  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
    <div class="progShowHeader datumDescription">Total Run Time: <span id="trt-1" class="runTimeDisplayText">0:00:00</span></div>
    <div class="progShowHeader datumDescription">Works: <span id="wrks-1" class="idDisplayText"></span></div>
    <ul class='sortable connected list' id='sortableList-1'> <!-- no2 -->
    </ul>
  </div>
  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
    <div class="progShowHeader datumDescription">Total Run Time: <span id="trt-2" class="runTimeDisplayText">0:00:00</span></div>
    <div class="progShowHeader datumDescription">Works: <span id="wrks-2" class="idDisplayText"></span></div>
    <ul class='sortable connected list' id='sortableList-2'>
    </ul>
  </div>
  <div style="clear:both"></div>

<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
  <script src="jquery.sortable.js"></script>
  <script>
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