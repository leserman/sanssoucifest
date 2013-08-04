<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Sans Souci Fest - Database Initialization</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php

  error_reporting(E_ALL);
  ini_set('display_errors', True);
    
  include_once "../utilities/autoloadClasses.php";
  
  // Connects to database. Fill in values for $databaseURL, $username, $password, and $dbName. 
  // Returns true on success. Returns false and kills the session on failure.
  $db = SSFDB::getDB();

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, runTime, dateMediaReceived, "
	                   . "role, recordType, name, submissionFormat, submitter, notifyOf "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=7 and dateMediaReceived is not null and dateMediaReceived!='' "
	                   . "order by designatedId";
	                   
  // SSFDB::debugNextQuery();
	$worksArray = $db->getArrayFromQuery($worksSelectString); 

	if ($db->querySuccess()) {
    //DatumProperties::getArray();
    foreach ($worksArray as $work) {
      $dp = DatumProperties::forKey('people.role');
      //echo '<br>'; print_r($dp); echo '<br>' . $dp->getPrintFormatString() . '<br>';
//      print_r($work['notifyOf']);  echo '<br>'; 
      //$a = array(1, 2);
      //printf($dp->getPrintFormatString($a), $a[0]); echo '<br>'; 
      printf($dp->getPrintFormatString(), $work['notifyOf']); echo '<br>'; 
//      printf($dp->getPrintFormatString('i'), 2008, 12, 28); echo '<br>'; 
    }
  }

  // SSFDB::debugOn();
	if (false && $db->querySuccess()) {
    $index = 0;
    foreach ($worksArray as $work) {
      $index++;
      switch ($work['submissionFormat']) {
        case 'DVD': $format = 'DVD-NTSC'; break;
        case 'miniDV': $format = 'miniDV'; break;
        case 'film': $format = '16mmFilm'; break; // TODO fix this
        default: $format = 'other'; // TODO fix this
      }
      $labelText = $work['designatedId'] . " - " . $work['title'] . ", " . $work['name'];
      $insertString = "INSERT INTO media2 "
                    . "(dateReceived, format, labelText, work, physicalLocation, lastModificationDate, lastModifiedBy) "
                    . "VALUES ('" . $work['dateMediaReceived'] . "', '" . $format . "', '" . mysql_real_escape_string($labelText) . "', "
                    .  $work['workId']  . ", 'Davids house', NOW(), 1)";
      $saved = $db->saveData($insertString);
      echo (($saved) ? 'SUCCESS for ' : 'FAILURE for ') .  $work['title'] . '<br>' . "\r\n";
      // if ($index == 3) SSFDB::debugOff();
    }
  }
?>
</body>
</html>

