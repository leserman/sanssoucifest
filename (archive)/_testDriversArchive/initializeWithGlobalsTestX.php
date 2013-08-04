<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN">
<html>

	<head>
		<title></title>
	</head>
	<body>
<?php
                          include '../forms/entryFormFunctions.php';

                          // Connect to the DB when the Submit button was clicked.
                          $connectionSuccess = connectToDB();
echo $connectionSuccess . '<br>';

  // global variables for use ONLY by functions in this file
  $runTimeValuesInitializedFromDB = FALSE;
  $initialCallForEntriesId = 0;
  $callForEntriesId = 0;
  $permissionAskMeString = '';
  $permissionAllOKString = '';
  
  function initializeRunTimeValuesFromDB() {
    global $runTimeValuesInitializedFromDB;
    global $initialCallForEntriesId;
    global $callForEntriesId;
    global $permissionAskMeString;
    global $permissionAllOKString;
    $selectString = "SELECT * from runTime";
    $result = mysql_query($selectString);
    debugLogQuery($result, $selectString);
    while ($result && ($row = mysql_fetch_array($result))) { // item in db
      switch ($row['parameterName']) {
        case 'defaultCallId':   $initialCallForEntriesId = $row['parameterValue']; break;
        case 'permissionAskMe': $permissionAskMeString = $row['parameterValueString']; break;
        case 'permissionAllOK': $permissionAllOKString = $row['parameterValueString']; break;
      }
    }
    $runTimeValuesInitializedFromDB = TRUE;
  }
  
  function getInitialCallForEntriesId() { 
    global $runTimeValuesInitializedFromDB;
    global $initialCallForEntriesId;
    if (!$runTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $initialCallForEntriesId;
  }
  
  function getCallForEntriesId() { 
    global $runTimeValuesInitializedFromDB;
    global $callForEntriesId;
    if (!$runTimeValuesInitializedFromDB) { $callForEntriesId = getInitialCallForEntriesId(); }
    return $callForEntriesId;
  }
  
  function setCallForEntriesId($intValue) { 
    global $callForEntriesId;
    $callForEntriesId = $intValue; 
  }
  
  function getPermissionAskMeString() { 
    global $runTimeValuesInitializedFromDB;
    global $permissionAskMeString;
    if (!$runTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $permissionAskMeString;
  }
  
  function getPermissionAllOKString() { 
    global $runTimeValuesInitializedFromDB;
    global $permissionAllOKString;
    if (!$runTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $permissionAllOKString;
  }
  
echo getPermissionAllOKString() . ' ' . getPermissionAskMeString() . ' ' . getInitialCallForEntriesId();
?>

	</body>
</html>