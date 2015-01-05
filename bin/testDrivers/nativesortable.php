<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->

  <title>Sort Shows Test</title>
  <link rel="icon" href="favicon.png" type="image/png">


  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
  <link rel="stylesheet" href='nativesortable.css' type='text/css'>
</head>
<body>
<!--
    <h1>nativesortable</h1>
    <p>An implementation of HTML5 Drag and Drop API to provide a sortable list of items with <strong>no external dependancies.</strong></p>
    <p><a href='https://github.com/bgrins/nativesortable'>See the project repository for usage information.</a></p>
-->

  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
<?php

  error_reporting(E_ALL);
  ini_set('display_errors', True);
    
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $preQuery = "SELECT @rownum:=0; ";
  SSFDB::getDB()->getArrayFromQuery($preQuery);
  $worksForShowsQuery = "SELECT workId, designatedId, title, name, runTime "
                      . "FROM works JOIN people ON submitter=personId WHERE callForEntries=14 and accepted = 1";
/*
  $worksForShowsQuery = "SELECT @rownum:=0; "
                      . "SELECT workId, CONCAT(@rownum:=@rownum+1, '. ' , designatedId, ' \'', title, '\', ', name) AS titleAndSubmitter, runTime "
                      . "FROM works JOIN people ON submitter=personId WHERE callForEntries=14 and accepted = 1";
*/
  
  SSFDebug::globalDebugger()->becho('$worksForShowsQuery', $worksForShowsQuery, -1);
  $worksForShowsRows = SSFDB::getDB()->getArrayFromQuery($worksForShowsQuery);
  SSFDebug::globalDebugger()->belch('$worksForShowsRows', $worksForShowsRows, -1);


  echo "     <ul id='sortable' class='sortable'>" . PHP_EOL;

  $rowOrdinal = 0;
  foreach ($worksForShowsRows as $workForShow) {
    $rowOrdinal++;
    $rowOrdinalText = ($rowOrdinal < 10) ? '0' . $rowOrdinal : $rowOrdinal;
    echo "       <li class='bodyTextOnDarkGray'><div class='work' id=A-" . $workForShow['workId'] . ">" . $rowOrdinalText . ". "
                 . "<span style='color:#B7E5F7;overflow:visible;'>" . $workForShow['designatedId'] 
                 . " <span style='color:#8de864;font-style:italic;'>" . htmlspecialchars($workForShow['title'], ENT_COMPAT, 'ISO-8859-1', true) . "</span> " // CCBD99 6db14e 8cbc77
                 . " <span style='color:#EEC;'>" . htmlspecialchars($workForShow['name'], ENT_COMPAT, 'ISO-8859-1', true) . "</span> "
                 . "<span class='runTimeDisplayText'>" . HTMLGen::timeAsMinutesAndSeconds($workForShow['runTime']) . "</span></div></li>";
//    echo "       <li><div class='work' id=" . $workForShow['workId'] . "><a href='#'>" . $workForShow['titleAndSubmitter'] . " - " . $workForShow['runTime'] . "</a></div></li>";
  }



  echo "     </ul>" . PHP_EOL;


?>

  </div>
  <div style="float:left;background-color:#333;border:1px solid red;width:520px;margin:20px;padding:10px;">
    <ul id='sortable' class='sortable'>
    </ul>
  </div>
  <div style="clear:both"></div>
  
    <script src='nativesortable.js' type='text/javascript'></script>
    <script>
        var sortable = document.getElementById("sortable");
        nativesortable(sortable, {
            change: function() {
                // alert('Hi.');
            }
        });
    </script>
</body>
</html>