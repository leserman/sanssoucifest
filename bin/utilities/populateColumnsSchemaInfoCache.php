<html>
<head>
</head>
<body>
<?php

  include_once "./autoloadClasses.php";
  
  echo "<br>Recreating `" . SSFDB::getSchemaName() . "`.`COLUMNS_SCHEMA_INFO`.<br><br>";
  echo "Use the browser's Back button to return to the Admin screen.<br><br>";

  $getDataQueryString = "select TABLE_SCHEMA, TABLE_NAME, ORDINAL_POSITION, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY "
                      . "from information_schema.COLUMNS where TABLE_SCHEMA='" . SSFDB::getSchemaName() . "' "
                      . "and TABLE_NAME != 'COLUMNS_SCHEMA_INFO' "
                      . "order by TABLE_NAME, COLUMN_NAME, ORDINAL_POSITION";
  
  $dropTableString = "DROP TABLE IF EXISTS `" . SSFDB::getSchemaName() . "`.`COLUMNS_SCHEMA_INFO`";
  $createTableString = " CREATE TABLE `" . SSFDB::getSchemaName() . "`.`COLUMNS_SCHEMA_INFO` ("
                     . " `TABLE_NAME` VARCHAR(128) NOT NULL COMMENT 'Primary Key',"
                     . " `COLUMN_NAME` VARCHAR(128) NOT NULL COMMENT 'Primary Key',"
                     . " `DATA_TYPE` VARCHAR(128),"
                     . " `COLUMN_TYPE` TEXT, "
                     . " `COLUMN_KEY` VARCHAR(3), "
                     . " `lastModificationDate` datetime default NULL,"
                     . " PRIMARY KEY  (`TABLE_NAME`,`COLUMN_NAME`)"
                     . ") ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Cache for information_schema COLUMNS'";
  
  echo 'getDataQueryString:<br> ' . $getDataQueryString . "<br><br>\r\n";
  echo 'dropTableString:<br> ' . $dropTableString . "<br><br>\r\n";
  echo 'createTableString:<br> ' . $createTableString . "<br><br>\r\n";
  
  $rows = SSFDB::getDB()->getArrayFromQuery($getDataQueryString);
  
  $forDisplayOnly = false;
  $eolString = ($forDisplayOnly) ? '<br>' : ' ';
  $insertInfoString = "INSERT INTO " . SSFDB::getSchemaName() . ".COLUMNS_SCHEMA_INFO (TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, lastModificationDate) VALUES ";
  $insertInfoString .= $eolString;
  $rowCount = 1;
  $rowsCount = count($rows);
  foreach ($rows as $row) {
    $insertInfoString .= "('" . $row['TABLE_NAME'] . "', '" .  $row['COLUMN_NAME'] . "', '" .  $row['DATA_TYPE'] . "', " 
                      .  SSFQuery::quote($row['COLUMN_TYPE']) . ", " .  SSFQuery::quote($row['COLUMN_KEY']) . ", '" . SSFRunTimeValues::nowForDB() . "')";
    if ($rowCount++ < $rowsCount) $insertInfoString .= ', ';
    $insertInfoString .= $eolString;
  }

  echo 'insertInfoString:<br> ' . $insertInfoString . "<br><br>\r\n";
  
  SSFDB::getDB()->saveData($dropTableString);
  SSFDB::getDB()->saveData($createTableString);
  SSFDB::getDB()->saveData($insertInfoString);

?>
</body>
</html>
