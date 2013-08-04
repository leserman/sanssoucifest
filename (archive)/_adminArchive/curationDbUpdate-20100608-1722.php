<?php

  include_once "../bin/utilities/autoloadClasses.php";

  // Update the accepted/rejected status of the entry in the database
  if (isset($_GET['accepted']) && ($_GET['accepted'] != '') 
     && isset($_GET['rejected']) && ($_GET['rejected'] != '')
     && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    $entryUpdateString = "UPDATE works set accepted = " .  $_GET['accepted'] . ", rejected = " . $_GET['rejected']
                       . " where workId=" . $_GET['workId'];
    SSFDB::getDB()->saveData($entryUpdateString);
    $baseDispStr = HTMLGen::arWidgetDisplay($_GET['workId'], $_GET['accepted'], $_GET['workId']);
    $dispStr1 = str_replace('\"', "'", $baseDispStr);
    $dispStr2 = str_replace('|', '"', $dispStr1);
    echo $dispStr2;
  }
  
?>
