<?php

class SSFRunTimeValues {
  private static $valuesAreInitialized = false;
  private static $initialCallForEntriesId = 0;
  private static $callForEntriesId = 0;
  private static $defaultAdministratorId = 0;
  private static $administratorId = 0;
  private static $permissionStringsArray = array();
    //private static $permissionAskMeString = '';
    //private static $permissionAllOKString = '';
    //private static $permissionAskMeDisplay = 'Invite to each separately.';
    //private static $permissionAllOKDisplay = 'All OK for this season.';
  private static $earlyDeadline = array();
  private static $earlyDeadlineFee = array();
  private static $finalDeadline = array();
  private static $finalDeadlineFee = array();
  private static $callNames = array();
  private static $acceptanceMessagePart1 = '';
  private static $acceptanceMessageClosing = '';
  private static $clipRequest = '';
  private static $imageRequest = '';
  private static $inviteFeedbackRequest = '';
  private static $rejectionMessageClosing = '';
  private static $rejectionMessagePart1 = '';
  private static $salutationAndSignature = '';
  private static $defaultWorkId = 0;
  private static $releaseInfoStatementIntro = '';
  private static $releaseInfoStatementAllOK = '';
  private static $releaseInfoStatementAskMe = '';
  private static $releaseInfoWidgetIntro = '';
  private static $releaseInfoWidgetAllOK = '';
  private static $releaseInfoWidgetAskMe = '';
  private static $currentYearImagesDirectory = "images/Stills/";

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
          case 'defaultWorkId': self::$defaultWorkId = self::$defaultWorkId = $rtvRow['parameterValue']; break;
          case 'acceptanceMessagePart1': self::$acceptanceMessagePart1 = $rtvRow['parameterValueString']; break;
          case 'acceptanceMessageClosing': self::$acceptanceMessageClosing = $rtvRow['parameterValueString']; break;
          case 'clipRequest': self::$clipRequest = $rtvRow['parameterValueString']; break;
          case 'imageRequest': self::$imageRequest = $rtvRow['parameterValueString']; break;
          case 'inviteFeedbackRequest': self::$inviteFeedbackRequest = $rtvRow['parameterValueString']; break;
          case 'rejectionMessageClosing': self::$rejectionMessageClosing = $rtvRow['parameterValueString']; break;
          case 'rejectionMessagePart1': self::$rejectionMessagePart1 = $rtvRow['parameterValueString']; break;
          case 'salutationAndSignature': self::$salutationAndSignature = $rtvRow['parameterValueString']; break;
          case 'currentYearImagesDirectory': self::$currentYearImagesDirectory = $rtvRow['parameterValueString']; break;
          case 'releaseInfoStatementIntro': self::$releaseInfoStatementIntro = $rtvRow['parameterValueString']; break;
          case 'releaseInfoStatementAllOK': self::$releaseInfoStatementAllOK = $rtvRow['parameterValueString']; break;
          case 'releaseInfoStatementAskMe': self::$releaseInfoStatementAskMe = $rtvRow['parameterValueString']; break;
          case 'releaseInfoWidgetIntro': self::$releaseInfoWidgetIntro = $rtvRow['parameterValueString']; break;
          case 'releaseInfoWidgetAllOK': self::$releaseInfoWidgetAllOK = $rtvRow['parameterValueString']; break;
          case 'releaseInfoWidgetAskMe': self::$releaseInfoWidgetAskMe = $rtvRow['parameterValueString']; break;
        }
      }
      self::initializeCallsAttributes();
    }
    self::$valuesAreInitialized = true;
  }
  
  private static function checkInit() {
    if (!self::$valuesAreInitialized) { self::initializeRunTimeValuesFromDB(); }
  }
  
  private static function initializeCallsAttributes() {
    //$debug = new SSFDebug; $debug->bechoTrace('$permissionStrings0', '', 0);
    //SSFDB::debugNextQuery();
    $callsQueryString = 'select callId, name, '
                      . 'permissionAllOKString, permissionAskMeString, permissionAllOKDisplay, permissionAskMeDisplay, '
                      . 'earlyDeadline, earlyDeadlineFee, finalDeadline, finalDeadlineFee '
                      . 'from callsForEntries';
    $rows = SSFDB::getDB()->getArrayFromQuery($callsQueryString);
    foreach ($rows as $row) {
      self::$callNames[$row['callId']] = $row['name'];
      self::$earlyDeadline[$row['callId']] = $row['earlyDeadline'];
      self::$earlyDeadlineFee[$row['callId']] = $row['earlyDeadlineFee'];
      self::$finalDeadline[$row['callId']] = $row['finalDeadline'];
      self::$finalDeadlineFee[$row['callId']] = $row['finalDeadlineFee'];
      self::$permissionStringsArray[$row['callId']]['permissionAllOKString'] = $row['permissionAllOKString'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeString'] = $row['permissionAskMeString'];
      self::$permissionStringsArray[$row['callId']]['permissionAllOKDisplay'] = $row['permissionAllOKDisplay'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeDisplay'] = $row['permissionAskMeDisplay'];
    }
  }
  
  // callForEntriesId functions
  public static function getInitialCallForEntriesId() { self::checkInit(); return self::$initialCallForEntriesId; }
  public static function getCallForEntriesId() { self::checkInit(); return self::$callForEntriesId; }
  public static function setCallForEntriesId($intValue) { 
    self::checkInit(); 
    //$debug = new SSFDebug; $debug->belchTrace('setCallForEntriesId', $intValue, 0);
    self::$callForEntriesId = $intValue; return $intValue; 
  }

  // Calls for Entries attributes functions
  public static function getCallNameFor($callId) { self::checkInit(); return (isset(self::$callNames[$callId])) ? self::$callNames[$callId] : ''; }
  public static function getEarlyDeadlineDateString() { self::checkInit(); return self::$earlyDeadline[self::$callForEntriesId]; }
  public static function getEarlyDeadlineFeeString() { self::checkInit(); return self::$earlyDeadlineFee[self::$callForEntriesId]; }
  public static function getFinalDeadlineDateString() { self::checkInit(); return self::$finalDeadline[self::$callForEntriesId]; }
  public static function getFinalDeadlineFeeString() { self::checkInit(); return self::$finalDeadlineFee[self::$callForEntriesId]; }
  public static function earlyDeadlineHasPassed() { return self::dateHasPassed(self::getEarlyDeadlineDateString()); }
  public static function finalDeadlineHasPassed() { return self::dateHasPassed(self::getFinalDeadlineDateString()); }

  // Returns true if it is currently one minute or more past midnight on the day after the date given by $deadlineDateString (e.g., '2010-04-12')
  public static function dateHasPassed($deadlineDateString) {
    $deadlineDate = explode('-', $deadlineDateString);
    $deadline = mktime(23, 59, 59, $deadlineDate[1], $deadlineDate[2], $deadlineDate[0]) + 2; // that is, next day plus one minute
    $dateHasPassed = (time() > $deadline);
    return $dateHasPassed;
  }
  
  // administratorId & workId functions
  public static function getDefaultAdministratorId() { self::checkInit(); return self::$defaultAdministratorId; }
  public static function getAdministratorId() { self::checkInit(); return self::$administratorId; }
  public static function setAdministratorId($intValue) { self::checkInit(); self::$administratorId = $intValue; return $intValue; }
  public static function getDefaultWorkId() { self::checkInit(); return self::$defaultWorkId; }
  
  // releaseInfoStatement functions
  public static function getReleaseInfoStatementIntroString() { self::checkInit(); return self::$releaseInfoStatementIntro; }
  public static function getReleaseInfoStatementAllOKString() { self::checkInit(); return self::$releaseInfoStatementAllOK; }
  public static function getReleaseInfoStatementAskMeString() { self::checkInit(); return self::$releaseInfoStatementAskMe; }

  // releaseInfoWidget functions
  public static function getReleaseInfoWidgetIntroString() { self::checkInit(); return self::$releaseInfoWidgetIntro; }
  public static function getReleaseInfoWidgetAllOKString() { self::checkInit(); return self::$releaseInfoWidgetAllOK; }
  public static function getReleaseInfoWidgetAskMeString() { self::checkInit(); return self::$releaseInfoWidgetAskMe; }

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
  
  // other functions
  // getCurrentYearImagesDirectory() is used to build the images table
  public static function getCurrentYearImagesDirectory() { self::checkInit(); return self::$currentYearImagesDirectory; }

}

?>
