<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Populate Media Table</title>
<link rel="stylesheet" href="../../database/sanssouci.css" type="text/css">
<link rel="stylesheet" href="../../database/sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php
  include_once "autoloadClasses.php";

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, name, dateMediaReceived, "
	                   . "submissionFormat, submitter, mediaNotes, projectionistNotes "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=7 "
	                   . "order by designatedId";

  $worksArray = SSFDB::getDB()->getArrayFromQuery($worksSelectString); 

  echo 'Modifying table ' . SSFDB::getSchemaName() . ".media:<br>\r\n";

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
                  . "(dateReceived, format, labelText, work, physicalLocation, notes, lastModificationDate, lastModifiedBy) "
                  . "VALUES ('" . $work['dateMediaReceived'] . "', '" . $format . "', " . SSFQuery::quote($labelText) . ", "
                  .  $work['workId']  . ", 'David\'s house'," . SSFQuery::quote($work['mediaNotes'])  . ", '" . SSFRunTimeValues::nowForDB() . "', 1)";
    echo '  ' . $insertString . "<br>\r\n";
    SSFDB::getDB()->saveData($insertString);
	}

// select workId, designatedId, title, name, submissionFormat, submitter from works join people on personId=submitter where callForEntries=1
// select * from media join works on work=workId where accepted=1

?>

</body>
</html>
