<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>SSF Data Properties Test Driver</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php

  error_reporting(E_ALL);
  ini_set('display_errors', True);
    
  include_once "../utilities/autoloadClasses.php";
  
  // Connects to database. Fill in values for $databaseURL, $username, $password, and $dbName. 
  // Returns true on success. Returns false and kills the session on failure.
  //$db = SSFDB::getDB();
  
  $dpArray = DatumProperties::getArray();
  
  foreach ($dpArray as $dpObject) {
    if ($dpObject->swDataType == 'enum') displayEnumOrSet($dpObject);
    if ($dpObject->swDataType == 'set') displayEnumOrSet($dpObject);
  }
  
  function displayEnumOrSet($dpObject) {
    $dataItemName = DatumProperties::getItemKeyFor($dpObject->tableName, $dpObject->columnName);
    echo "<br>" . $dpObject->dbDataType . " " . $dataItemName;
    foreach ($dpObject->possibleValues as $possibleValue) echo "<br>&nbsp;&nbsp;&nbsp;" . $possibleValue;
    echo "<br>\r\n";
  }

?>
</body>
</html>

