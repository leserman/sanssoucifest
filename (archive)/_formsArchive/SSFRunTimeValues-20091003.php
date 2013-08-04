<?php

class SSFRunTimeValues {
  private static $valuesAreInitialized = false;
  private static $initialCallForEntriesId = 0;
  private static $callForEntriesId = 0;
  private static $initialAdministratorId = 0;
  private static $administratorId = 0;
  private static $permissionAskMeString = '';
  private static $permissionAllOKString = '';
  private static $permissionStrings = array();
  private static $permissionAskMeDisplay = 'Invite to each separately.';
  private static $permissionAllOKDisplay = 'All OK for this season.';
  private static $acceptanceMessagePart1 = '';
  private static $acceptanceMessageClosing = '';
  private static $clipRequest = '';
  private static $imageRequest = '';
  private static $inviteFeedbackRequest = '';
  private static $rejectionMessageClosing = '';
  private static $rejectionMessagePart1 = '';
  private static $salutationAndSignature = '';

  // private initialization functions
  private static function initializeRunTimeValuesFromDB() {
    if (!self::$valuesAreInitialized) {
      $rows = SSFDB::getDB()->getArrayFromQuery("SELECT * from runTimeValues where parameterName='currentYear'");
      $currentYear = $rows[0]['parameterValue'];
      $selectString = "SELECT * from runTimeValues where yearIndex=$currentYear or yearIndex=0 or yearIndex is null";
      $rtvRows = SSFDB::getDB()->getArrayFromQuery($selectString);
      foreach ($rtvRows as $rtvRow) { // item in db
        switch ($rtvRow['parameterName']) {
          case 'defaultCallId': 
            self::$callForEntriesId = self::$initialCallForEntriesId = $rtvRow['parameterValue']; 
            self::initializePermissionsStringsArray();
            self::initializePermissionsStrings(self::$initialCallForEntriesId); // for legacy code
            break;
          case 'acceptanceMessagePart1': self::$acceptanceMessagePart1 = $rtvRow['parameterValueString']; break;
          case 'acceptanceMessageClosing': self::$acceptanceMessageClosing = $rtvRow['parameterValueString']; break;
          case 'clipRequest': self::$clipRequest = $rtvRow['parameterValueString']; break;
          case 'imageRequest': self::$imageRequest = $rtvRow['parameterValueString']; break;
          case 'inviteFeedbackRequest': self::$inviteFeedbackRequest = $rtvRow['parameterValueString']; break;
          case 'rejectionMessageClosing': self::$rejectionMessageClosing = $rtvRow['parameterValueString']; break;
          case 'rejectionMessagePart1': self::$rejectionMessagePart1 = $rtvRow['parameterValueString']; break;
          case 'salutationAndSignature': self::$salutationAndSignature = $rtvRow['parameterValueString']; break;
        }
      }
    }
    self::$valuesAreInitialized = true;
  }
  
  private static function checkInit() {
    if (!self::$valuesAreInitialized) { self::initializeRunTimeValuesFromDB(); }
  }
  
  // for legacy code
  private static function initializePermissionsStrings($callForEntriesIdParam) {
    $debug = new SSFDebug; $debug->bechoTrace('$permissionStrings00', '', 0);
    SSFDB::debugNextQuery();
    $permissionsQueryString = 'select permissionAllOKString, permissionAskMeString, permissionAllOKDisplay, '
                            . 'permissionAskMeDisplay from callsForEntries where callId = ' . $callForEntriesIdParam;
    $rows = SSFDB::getDB()->getArrayFromQuery($permissionsQueryString);
    self::$permissionAllOKString = isset($rows[0]['permissionAllOKString']) ? $rows[0]['permissionAllOKString'] : '';
    self::$permissionAskMeString = isset($rows[0]['permissionAskMeString']) ? $rows[0]['permissionAskMeString'] : '';
    self::$permissionAllOKDisplay = isset($rows[0]['permissionAllOKDisplay']) ? $rows[0]['permissionAllOKDisplay'] : '';
    self::$permissionAskMeDisplay = isset($rows[0]['permissionAskMeDisplay']) ? $rows[0]['permissionAskMeDisplay'] : '';
  }
  
  private static function initializePermissionsStringsArray() {
    $debug = new SSFDebug; $debug->bechoTrace('$permissionStrings0', '', 0);
    SSFDB::debugNextQuery();
    $permissionsQueryString = 'select callId, permissionAllOKString, permissionAskMeString, permissionAllOKDisplay, '
                            . 'permissionAskMeDisplay from callsForEntries';
    $rows = SSFDB::getDB()->getArrayFromQuery($permissionsQueryString);
    foreach ($rows as $row) {
      self::$permissionStrings[$row['callId']]['permissionAllOKString'] = $row['permissionAllOKString'];
      self::$permissionStrings[$row['callId']]['permissionAskMeString'] = $row['permissionAskMeString'];
      self::$permissionStrings[$row['callId']]['permissionAllOKDisplay'] = $row['permissionAllOKDisplay'];
      self::$permissionStrings[$row['callId']]['permissionAskMeDisplay'] = $row['permissionAskMeDisplay'];
    }
  }
  
  // callForEntriesId functions
  public static function getInitialCallForEntriesId() { self::checkInit(); return self::$initialCallForEntriesId; }
  
  public static function getCallForEntriesId() { self::checkInit(); return self::$callForEntriesId; }
//    if (!self::$valuesAreInitialized) { 
//      self::initializeRunTimeValuesFromDB(); 
//      self::$callForEntriesId = getInitialCallForEntriesId();
//    }
//    return self::$callForEntriesId;
//  }
  
  public static function setCallForEntriesId($intValue) { 
    self::checkInit();
    self::$callForEntriesId = $intValue;
    self::initializePermissionsStrings(self::$callForEntriesId);
    return self::$callForEntriesId;
  }
  
  // administratorId functions
  public static function getInitialAdministratorId() { self::checkInit(); return self::$initialAdministratorId; }
  
  public static function getAdministratorId() { 
    if (!self::$valuesAreInitialized) { 
      self::initializeRunTimeValuesFromDB(); 
      self::$administratorId = getInitialAdministratorId();
    }
    return self::$administratorId;
  }
  
  public static function setAdministratorId($intValue) { 
    checkInit();
    self::$callAdministratorId = $intValue;
    return self::$administratorId;
  }
  
  // permissions functions
  public static function getPermissionAskMeString($callId = null) { 
    self::checkInit(); 
    if (isset($callId)) return self::getPermissionAskMeStringFor($callId);
    else return self::$permissionAskMeString; 
  }
  
  public static function getPermissionAllOKString($callId = null) { 
    self::checkInit(); 
    if (isset($callId)) return self::getPermissionAllOKStringFor($callId);
    else return self::$permissionAllOKString; 
  }
  
  public static function getPermissionAskMeDisplay($callId = null) { 
    self::checkInit(); 
    if (isset($callId)) {
      $str = self::$permissionStrings[$callId]['permissionAskMeDisplay'];
      if (isset($str)) return $str;
      else return '';
    }
    else return self::$permissionAskMeDisplay; 
  }
  
  public static function getPermissionAllOKDisplay($callId = null) { 
    self::checkInit(); 
    if (isset($callId)) {
      //$debug = new SSFDebug; $debug->belch('$permissionStrings1', self::$permissionStrings, 0);
      $str = self::$permissionStrings[$callId]['permissionAllOKDisplay'];
      if (isset($str)) return $str;
      else return '';
    }
    else return self::$permissionAllOKDisplay; 
  }
  
  public static function getPermissionAskMeStringFor($callId) { 
    self::checkInit(); 
    $str = self::$permissionStrings[$callId]['permissionAskMeString'];
    if (isset($str)) return $str;
    else return '';
  }
  
  public static function getPermissionAllOKStringFor($callId) { 
    self::checkInit(); 
    $str = self::$permissionStrings[$callId]['permissionAllOKString'];
    if (isset($str)) return $str;
    else return '';
  }

  // accept/reject email string functions
  public static function getAcceptanceMessagePart1() { self::checkInit(); return self::$acceptanceMessagePart1; }
  public static function getAcceptanceMessageClosing() { self::checkInit(); return self::$acceptanceMessageClosing; }
  public static function getClipRequest() { self::checkInit(); return self::$clipRequest; }
  public static function getImageRequest() { self::checkInit(); return self::$imageRequest; }
  public static function getInviteFeedbackRequest() { self::checkInit(); return self::$inviteFeedbackRequest; }
  public static function getRejectionMessagePart1() { self::checkInit(); return self::$rejectionMessagePart1; }
  public static function getRejectionMessageClosing() { self::checkInit(); return self::$rejectionMessageClosing; }
  public static function getSalutationAndSignature() { self::checkInit(); return self::$salutationAndSignature; }

}

?>
