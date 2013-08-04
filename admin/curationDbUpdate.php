<?php

  include_once "../bin/utilities/autoloadClasses.php";
  include_once "../bin/classes/SSFQuery.php"; // just for SendLog
  
  $adminId = SSFAdmin::userIndex();
  
  // showAction does not do it's job because HTML generated herein is never posted to a web page,
  // just returned to the javascript xmlHttpObject.onreadystatechange in ssf.js.
  function showAction($a) {
    $showActions = false;
    if ($showActions) { 
      //echo '<script type="text/javascript">alert(' . $a . ');</script>' + "\r\n"; 
    SendLog::initInfo("curationDbUpdate.php Log", "curationlog@sanssoucifest.org", "curationlog@sanssoucifest.org");
//    SendLog::$message = 'curationDbUpdate.php Action is ' . print_r($a, true);
    SendLog::$message = 'curationDbUpdate.php Action is ' . $a;
    SendLog::sendItNow();
    }
  }

  // Update the accepted/rejected status of the entry in the works table
  if (isset($_GET['updating']) && ($_GET['updating'] == 'arStatus') 
     && isset($_GET['accepted']) && ($_GET['accepted'] != '') 
     && isset($_GET['rejected']) && ($_GET['rejected'] != '')
     && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    $entryUpdateString = "UPDATE works set accepted = " .  $_GET['accepted'] . ", rejected = " . $_GET['rejected']
                       . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminId // TODO: Do we really want to update lastModificationDate & lastModifiedBy in the works table at this time?
                       . " where workId=" . $_GET['workId'];
    SSFDB::getDB()->saveData($entryUpdateString);
    showAction($entryUpdateString);
    SSFDebug::globalDebugger()->becho('curationDbUpdate.php accepted/rejected status', $_GET['workId'] . ', ' . $_GET['accepted'] . ', ' . $_GET['rejected'], -1);
    $dispStr = HTMLGen::arWidgetDisplay($_GET['workId'], $_GET['accepted'], $_GET['rejected'], $_GET['acceptFor']);
    echo $dispStr;
  }
  
  // Update the acceptFor status of the entry in the works table
  if (isset($_GET['updating']) && ($_GET['updating'] == 'acceptForStatus') 
     && isset($_GET['acceptFor']) && ($_GET['acceptFor'] != '') 
     && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    // TODO: Do we really want to update lastModificationDate & lastModifiedBy in the works table at this time? 
    $entryUpdateString = "UPDATE works set acceptFor = '" .  $_GET['acceptFor'] . "'"
                       . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminId 
                       . " where workId=" . $_GET['workId'];
    SSFDB::getDB()->saveData($entryUpdateString);
    showAction($entryUpdateString);
    SSFDebug::globalDebugger()->becho('curationDbUpdate.php acceptFor status', $_GET['workId'] . ', |' . $_GET['acceptFor'] . '|', -1);
//    $dispStr = HTMLGen::arWidgetDisplay($_GET['workId'], 1, 0, $_GET['acceptFor']);
//    echo $dispStr;
  }
  
  // Update the score of the entry for this curator in the curation table
  SSFDebug::globalDebugger()->belch('_GET A', $_GET,- 1);
  if (isset($_GET['updating']) && ($_GET['updating'] == 'score') 
     && isset($_GET['curator']) && ($_GET['curator'] != '') && ($_GET['curator'] != 0) 
     && isset($_GET['score']) && ($_GET['score'] != '') // && ($_GET['score'] != 0) This test succeeds when score == '--' YIPES
     && isset($_GET['entry']) && ($_GET['entry'] != '') && ($_GET['entry'] != 0)) { 
    $entry = $_GET['entry'];
    if (($_GET['score'] == '--') || ($_GET['score'] == 0)) $newScore = 'NULL'; else $newScore = $_GET['score'];
    //SSFDB::debugNextQuery();
    $curationUpdateString = "UPDATE curation set score=" . $newScore
                          . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminId
                          . " where entry=" . $entry . " and curator=" . $_GET['curator'];
    echo $entry;
    SSFDB::getDB()->saveData($curationUpdateString);
    showAction($curationUpdateString);
    // | is the delimiter separating the two parameters
    echo '|' . substr(HTMLGen::getDbScoreFor($entry), 0, 3);
  }

  // Update the note for the entry by this curator in the curation
  SSFDebug::globalDebugger()->belch('_GET A', $_GET, -1);
  if (isset($_GET['updating']) && ($_GET['updating'] == 'curationNote') 
       && isset($_GET['entry']) && ($_GET['entry'] != '') && ($_GET['entry'] != 0)
       && isset($_GET['curator']) && ($_GET['curator'] != '') && ($_GET['curator'] != 0) 
       && isset($_GET['note'])) { 
    $entry = $_GET['entry'];
//    $curationNoteText = str_replace('^^^', '&', $_GET['note']); // See comment in ssf.js htmlEntities().
    $curationNoteText = $_GET['note'];
    $curationUpdateString = "UPDATE curation set notes=" . HTMLGen::simpleQuote($curationNoteText)
                          . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminId
                          . " where entry=" . $entry . " and curator=" . $_GET['curator'];
//    error_log($curationUpdateString);
    $result = SSFDB::getDB()->saveData($curationUpdateString);
    showAction($curationUpdateString);
    // | is the delimiter separating the two parameters
//    echo $entry . '|' . $curationNoteText;
    echo $entry . '|' . $curationNoteText. '|' . $curationUpdateString . ' note: ^^|' . $curationNoteText . '|^^' . ' note: ^^|' . $curationNoteText . '|^^';
  }

  // Update a single data item
  SSFDebug::globalDebugger()->belch('_GET C', $_GET, -1);
  if (isset($_GET['updating']) && ($_GET['updating'] == 'item') 
       && isset($_GET['itemId']) && ($_GET['itemId'] != '') && ($_GET['itemId'] != 0) 
       && isset($_GET['itemTable']) && ($_GET['itemTable'] != '')
       && isset($_GET['itemColumn']) && ($_GET['itemColumn'] != '')
       && isset($_GET['indexColumn']) && ($_GET['indexColumn'] != '')
       && isset($_GET['itemValue'])) { 
    $dbUpdateString = "UPDATE " . $_GET['itemTable'] . " set " . $_GET['itemColumn'] . "=" 
                    . HTMLGen::simpleQuote($_GET['itemValue']) 
                    . ", lastModificationDate = '" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy = " . $adminId
                    . " where " . $_GET['indexColumn'] . "=" . $_GET['itemId'];
    SSFDebug::globalDebugger()->becho('dbUpdateString', $dbUpdateString, -1);
    //SSFDB::debugNextQuery();
    $result = SSFDB::getDB()->saveData($dbUpdateString);
    showAction($dbUpdateString);
    echo $result;
  }

?>
