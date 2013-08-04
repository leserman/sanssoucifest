<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Populate Media Table</title>
<link rel="stylesheet" href="sanssouci.css" type="text/css">
<link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
HELLO
<?php
  include './databaseSupportFunctions.php';
	include '../bin/forms/entryFormFunctions.php';

  function queryDatabaseGetArray($query) {
    if (!($queryResultSet = mysql_query($query))) {
      debugLogQuery($queryResultSet, $query);
      die(mysql_error());
    }
    $rowArray = array();
    while ($queryRow = mysql_fetch_assoc($queryResultSet)) $rowArray[] = $queryRow;
    return $rowArray;
  }

  function saveToDatabase($query) {
    if (!($queryResultSet = mysql_query($query))) {
      debugLogQuery($queryResultSet, $query);
      die(mysql_error());
    }
    return;    
  }

  $connectionSuccess = connectToDB();

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, name, dateMediaReceived, "
	                   . "submissionFormat, submitter "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=1 "
	                   . "order by designatedId";

	$worksArray = queryDatabaseGetArray($worksSelectString); 

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
    $insertString = "INSERT INTO media "
                  . "(dateReceived, format, labelText, work, physicalLocation, lastModificationDate, lastModifiedBy) "
                  . "VALUES ('" . $work['dateMediaReceived'] . "', '" . $format . "', " . quote($labelText) . ", "
                  .  $work['workId']  . ", 'David\'s house', NOW(), 1)";
    saveToDatabase($insertString);
	}

// select workId, designatedId, title, name, submissionFormat, submitter from works join people on personId=submitter where callForEntries=1
// select * from media join works on work=workId where accepted=1


?>

</body>
</html>
