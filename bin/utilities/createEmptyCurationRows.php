<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Sans Souci Festival of Dance Cinema</title>
  <script src="../scripts/databaseSupportFunctions.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php
  // include php code
  $filePathArray = explode('/', __FILE__);
  $loopIndex = 0;
  foreach ($filePathArray as $element) { 
    $loopIndex++;
    if ($element == 'sanssoucifest.org') { break; } 
  }
  $codeBase = "";
  for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
  include_once $codeBase . "bin/utilities/autoloadClasses.php";

  // Initialization
  $callForEntries = SSFRunTimeValues::getInitialCallForEntriesId();
  SSFDebug::globalDebugger()->becho('callForEntries', $callForEntries, 1);
  $curatorsSelectString = "SELECT curator, name, nickName FROM curators JOIN people ON curator=personId " .
                          " WHERE callForEntries=" . $callForEntries . " ORDER BY curator ASC;";
  $curatorRows = SSFDB::getDB()->getArrayFromQuery($curatorsSelectString);
  $curators = array();
  $curatorNames = array();
  foreach ($curatorRows as $curationRow) { 
    $curators[] = $curationRow['curator']; 
    $curatorNames[] = $curationRow['nickName']; 
  }
  SSFDebug::globalDebugger()->belch('curatorNames', $curatorNames, 1);
  $administrator = SSFRunTimeValues::getAdministratorId();
  SSFDebug::globalDebugger()->becho('administrator', $administrator, 1);
  
  // READ the VALUES FROM the curation table
	$curationSelectString = "SELECT entry, curator FROM curation JOIN works ON curation.entry = workId "
                        . " WHERE callForEntries=" . $callForEntries . " ORDER BY workId ASC;";
  //SSFDB::debugNextQuery();
  $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
  $curationIndices = array();
  foreach ($curationRows as $curationRow) {
    $curationIndices[$curationRow['entry']][$curationRow['curator']] = 1;
  }
  SSFDebug::globalDebugger()->belch('curationIndices', $curationIndices, -1);

  // READ the VALUES FROM the works table
	$worksSelectString = "select workId, designatedId, title from works "
										 . "where callForEntries=" . $callForEntries . " order by designatedId ASC;";
  //SSFDB::debugNextQuery();
  $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
  SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);

  $rowsAdded = 0;
  foreach ($workRows as $workRow) {
    SSFDebug::globalDebugger()->becho('workId', $workRow['workId'], -1);
    if (true || ($workRow['workId'] == 511) || ($workRow['workId'] == 650) || ($workRow['workId'] == 590)) {
      foreach ($curators as $person) {   
        if (!isset($curationIndices[$workRow['workId']][$person])) {
          $insertString = "INSERT INTO curation (entry, curator, lastModificationDate, lastModifiedBy) VALUES (" 
                        . $workRow['workId'] . ", " . $person . ", '" . SSFRunTimeValues::nowForDB() . "', " . $administrator . ")";
          //SSFDB::debugNextQuery();
          $success = SSFDB::getDB()->saveData($insertString);
          if ($success) {
            $rowsAdded++;
            echo '** Added curator ' . $person . ' for work ' . $workRow['workId'] . ', "' . $workRow['title'] . '."<br>' . "\r\n";
          } else {
            echo "<br>\r\n" . '** Failed to add curator ' . $person . ' for work ' . $workRow['workId'] . ', "' . $workRow['title'] 
                 . '," MySQL Error#' . SSFDB::getDB()->lastErrorNo() . ' ' . SSFDB::getDB()->lastErrorText() . ".<br><br>\r\n\r\n";
          }
        }
      }
    }
  }
  printf('*** %d rows added to the curation table. ***', $rowsAdded);
?>
</body>
</html>
