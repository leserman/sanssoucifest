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

	// Return a php array from a query on the open database
	function queryDatabaseArray($query) { 
	  // get the result set
	  $queryResultSet = mysql_query($query);
	  if (!$queryResultSet) {
	    die('QUERY = ' . $query . "<br>" . mysql_error() . "<br>");
	  }
		// transfer the result set into a php array
		$array = array();
		while ($queryRow = mysql_fetch_assoc($queryResultSet)) $array[] = $queryRow;
		return $array;
  }
  
	// Save a row to the open database
	function saveToDatabase($query) {
	  if (!mysql_query($query)) die('QUERY = ' . $query . "<br>" . mysql_error() . "<br>");
	  return true;
	}
	
  // Connects to database. Fill in values for $databaseURL, $username, $password, and $dbName. 
  // Returns true on success. Returns false and kills the session on failure.
  function connectToDB() {
    $databaseURL = 'something like mysql.sanssoucifest.org';
    $username = 'yourUserName';
    $password = 'yourPassword';
    $dbName = 'yourDatabaseName';
    $connection = mysql_connect($databaseURL, $username, $password);
    if ($connection) { 
      $result = mysql_select_db($dbName); 
      if (!$result) {
        die('Could not connect to DB named: ' . $dbName . '. ' . mysql_errno() . ": " . mysql_error() . '<br>'); 
      }
      else return $result;
    } else { // since connection failed
      die('Could not connect to DB at: ' . $databaseURL . '. ' . mysql_errno() . ": " . mysql_error() . '<br>'); 
      return false; // Presumably, this line of code will never be executed.
      } // !connection
    }
    

  $connectionSuccess = connectToDB();

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, dateMediaReceived, name, submissionFormat, submitter "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=1 "
	                   . "order by designatedId";

//	$worksArray = queryDatabaseArray($worksSelectString); 
	  $queryResultSet = mysql_query($worksSelectString);
	  if (!$queryResultSet) {
	    die('QUERY = ' . $query . "<br>" . mysql_error() . "<br>");
	  }

	$index = 0;
//	foreach ($worksArray as $work) {
		while ($work = mysql_fetch_assoc($queryResultSet)) {
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
    $saved = saveToDatabase($insertString);
    echo (($saved) ? 'SUCCESS for ' : 'FAILURE for ') .  $work['title'] . '<br>' ;
  }
?>
</body>
</html>

