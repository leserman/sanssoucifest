<?php

class SSFRunTimeValues {
  private static $valuesAreInitialized = false;
  private static $initialCallForEntriesId = 0;
  private static $callForEntriesId = 0;
  private static $defaultAdministratorId = 0;
  private static $administratorId = 0;
  //private static $permissionAskMeString = '';
  //private static $permissionAllOKString = '';
  //private static $permissionAskMeDisplay = 'Invite to each separately.';
  //private static $permissionAllOKDisplay = 'All OK for this season.';
  private static $permissionStringsArray = array();
  private static $callNames = array();
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
          case 'defaultCallId': self::$callForEntriesId = self::$initialCallForEntriesId = $rtvRow['parameterValue']; break;
          case 'defaultAdminId': self::$administratorId = self::$defaultAdministratorId = $rtvRow['parameterValue']; break;
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
      self::initializePermissionsStringsArray();
    }
    self::$valuesAreInitialized = true;
  }
  
  private static function checkInit() {
    if (!self::$valuesAreInitialized) { self::initializeRunTimeValuesFromDB(); }
  }
  
  private static function initializePermissionsStringsArray() {
    //$debug = new SSFDebug; $debug->bechoTrace('$permissionStrings0', '', 0);
    //SSFDB::debugNextQuery();
    $permissionsQueryString = 'select callId, name, permissionAllOKString, permissionAskMeString, '
                            . 'permissionAllOKDisplay, permissionAskMeDisplay from callsForEntries';
    $rows = SSFDB::getDB()->getArrayFromQuery($permissionsQueryString);
    foreach ($rows as $row) {
      self::$permissionStringsArray[$row['callId']]['permissionAllOKString'] = $row['permissionAllOKString'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeString'] = $row['permissionAskMeString'];
      self::$permissionStringsArray[$row['callId']]['permissionAllOKDisplay'] = $row['permissionAllOKDisplay'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeDisplay'] = $row['permissionAskMeDisplay'];
      self::$callNames[$row['callId']] = $row['name'];
    }
  }
  
  // callForEntriesId functions
  public static function getInitialCallForEntriesId() { self::checkInit(); return self::$initialCallForEntriesId; }
  public static function getCallForEntriesId() { self::checkInit(); return self::$callForEntriesId; }
  public static function setCallForEntriesId($intValue) { self::checkInit(); 
    //$debug = new SSFDebug; $debug->belchTrace('setCallForEntriesId', $intValue, 0);
    self::$callForEntriesId = $intValue; return $intValue; }
  public static function getCallNameFor($callId) { self::checkInit(); return (isset(self::$callNames[$callId])) ? self::$callNames[$callId] : ''; }
  
  // administratorId functions
  public static function getDefaultAdministratorId() { self::checkInit(); return self::$defaultAdministratorId; }
  public static function getAdministratorId() { checkInit(); return self::$administratorId; }
  public static function setAdministratorId($intValue) { checkInit(); self::$administratorId = $intValue; return $intValue; }
  
  // permissions functions
  public static function getPermissionAskMeString($callId = null) { return self::getPermissionInfo('permissionAskMeString', $callId); }
  public static function getPermissionAllOKString($callId = null) { return self::getPermissionInfo('permissionAllOKString', $callId); }
  public static function getPermissionAskMeDisplay($callId = null) { return self::getPermissionInfo('permissionAskMeDisplay', $callId); }
  public static function getPermissionAllOKDisplay($callId = null) { return self::getPermissionInfo('permissionAllOKDisplay', $callId); }
  
  private static function getPermissionInfo($infoStringName, $callIdSelection) {
    self::checkInit(); 
    $callId = (isset($callIdSelection)) ? $callIdSelection :  self::$callForEntriesId;
    if ($callId <= 0) return ''; 
    else if (isset(self::$permissionStringsArray[$callId][$infoStringName])) {
      $str = self::$permissionStringsArray[$callId][$infoStringName];
      return (isset($str)) ? $str : '';
    }
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
