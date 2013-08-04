<?php

  // global variables for use ONLY by functions in this file
  $ifdfRunTimeValuesInitializedFromDB = FALSE;
  $ifdfInitialifdfCallForEntriesId = 0;
  $ifdfCallForEntriesId = 0;
  $ifdfPermissionAskMeString = '';
  $ifdfPermissionAllOKString = '';
  
  function initializeRunTimeValuesFromDB() {
    global $ifdfRunTimeValuesInitializedFromDB;
    global $ifdfInitialifdfCallForEntriesId;
    global $ifdfCallForEntriesId;
    global $ifdfPermissionAskMeString;
    global $ifdfPermissionAllOKString;
    $selectString = "SELECT * from runTime";
    $result = mysql_query($selectString);
    debugLogQuery($result, $selectString);
    while ($result && ($row = mysql_fetch_array($result))) { // item in db
      switch ($row['parameterName']) {
        case 'defaultCallId':   $ifdfInitialifdfCallForEntriesId = $row['parameterValue']; break;
        case 'permissionAskMe': $ifdfPermissionAskMeString = $row['parameterValueString']; break;
        case 'permissionAllOK': $ifdfPermissionAllOKString = $row['parameterValueString']; break;
      }
    }
    $ifdfRunTimeValuesInitializedFromDB = TRUE;
  }
  
  function getInitialCallForEntriesId() { 
    global $ifdfRunTimeValuesInitializedFromDB;
    global $ifdfInitialifdfCallForEntriesId;
    if (!$ifdfRunTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $ifdfInitialifdfCallForEntriesId;
  }
  
  function getCallForEntriesId() { 
    global $ifdfRunTimeValuesInitializedFromDB;
    global $ifdfCallForEntriesId;
    if (!$ifdfRunTimeValuesInitializedFromDB) { $ifdfCallForEntriesId = getInitialCallForEntriesId(); }
    return $ifdfCallForEntriesId;
  }
  
  function setCallForEntriesId($intValue) { 
    global $ifdfCallForEntriesId;
    $ifdfCallForEntriesId = $intValue;
    return $ifdfCallForEntriesId;
  }
  
  function getPermissionAskMeString() { 
    global $ifdfRunTimeValuesInitializedFromDB;
    global $ifdfPermissionAskMeString;
    if (!$ifdfRunTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $ifdfPermissionAskMeString;
  }
  
  function getPermissionAllOKString() { 
    global $ifdfRunTimeValuesInitializedFromDB;
    global $ifdfPermissionAllOKString;
    if (!$ifdfRunTimeValuesInitializedFromDB) { initializeRunTimeValuesFromDB(); }
    return $ifdfPermissionAllOKString;
  }

?>
