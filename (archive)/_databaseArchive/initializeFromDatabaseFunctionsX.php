<?php session_start(); if (isset($_SESSION['ifdfCount'])) $_SESSION['ifdfCount']++; else $_SESSION['ifdfCount'] = 1;

  // global variables for use ONLY by functions in this file
  if ($_SESSION['ifdfCount'] == 1) {
    $_SESSION['ifdfRunTimeValuesInitializedFromDB'] = FALSE;
    $_SESSION['ifdfInitialCallForEntriesId'] = 0;
    $_SESSION['ifdfCallForEntriesId'] = 0;
    $_SESSION['ifdfPermissionAskMeString'] = '';
    $_SESSION['ifdfPermissionAllOKString'] = '';
  }
  
  function initializeRunTimeValuesFromDB() {
    $selectString = "SELECT * from runTime";
    $result = mysql_query($selectString);
    debugLogQuery($result, $selectString);
    while ($result && ($row = mysql_fetch_array($result))) { // item in db
      switch ($row['parameterName']) {
        case 'defaultCallId':   $_SESSION['ifdfInitialCallForEntriesId'] = $row['parameterValue']; break;
        case 'permissionAskMe': $_SESSION['ifdfPermissionAskMeString'] = $row['parameterValueString']; break;
        case 'permissionAllOK': $_SESSION['ifdfPermissionAllOKString'] = $row['parameterValueString']; break;
      }
    }
    $_SESSION['ifdfRunTimeValuesInitializedFromDB'] = TRUE;
  }
  
  function getInitialCallForEntriesId() { 
    if (!$_SESSION['ifdfRunTimeValuesInitializedFromDB']) { initializeRunTimeValuesFromDB(); }
    return $_SESSION['ifdfInitialCallForEntriesId'];
  }
  
  function getCallForEntriesId() { 
    if (!$_SESSION['ifdfRunTimeValuesInitializedFromDB']) { $_SESSION['ifdfCallForEntriesId'] = getInitialCallForEntriesId(); }
    return $_SESSION['ifdfCallForEntriesId'];
  }
  
  function setCallForEntriesId($intValue) { 
    $_SESSION['ifdfCallForEntriesId'] = $intValue;
    return $_SESSION['ifdfCallForEntriesId'];
  }
  
  function getPermissionAskMeString() { 
    if (!$_SESSION['ifdfRunTimeValuesInitializedFromDB']) { initializeRunTimeValuesFromDB(); }
    return $_SESSION['ifdfPermissionAskMeString'];
  }
  
  function getPermissionAllOKString() { 
    if (!$_SESSION['ifdfRunTimeValuesInitializedFromDB']) { initializeRunTimeValuesFromDB(); }
    return $_SESSION['ifdfPermissionAllOKString'];
  }

?>
