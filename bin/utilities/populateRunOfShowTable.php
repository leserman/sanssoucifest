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
  
  $callForEntries = 7; // TODO get from table
  $showToInitialize = 16;
  
	// READ the VALUES FROM the DATABASE
	$worksSelectString = "select workId, "
	                   . "concat(designatedId, ' ', replace(titleForSort,' ',''), ', ', replace(name,' ','')) as itemNote "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=" . $callForEntries . " and accepted=1 "
	                   . "order by designatedId";

  $worksArray = SSFDB::getDB()->getArrayFromQuery($worksSelectString); 
  
  echo 'MODIFYING table ' . SSFDB::getSchemaName() . ".runOfShow.<br>\r\n";

	$index = 0;
	foreach ($worksArray as $work) {
	  $index++;
	  $initialShowOrder = 100 + ($index * 10);
    $insertString = "INSERT INTO runOfShow "
                    . "(`show`, work, showOrder, media, notes, lastModificationDate, lastModifiedBy) "
                  . "VALUES (" 
                    . $showToInitialize . ", "
                    . $work['workId'] . ", "
                    . $initialShowOrder . ", " 
                    . 0 . ", " 
                    . SSFQuery::quote($work['itemNote']) . ", " 
                    . "'" . SSFRunTimeValues::nowForDB() . "', 1)";
      echo '  ' . $insertString . "<br>\r\n";
      SSFDB::getDB()->saveData($insertString);
	}
?>

</body>
</html>
