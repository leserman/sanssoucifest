<?php

class SSFRunTimeValues {
  private static $valuesAreInitialized = false;
  private static $copyrightYearsString;
  private static $contactEmailAddress;
  private static $listManagementEmailAddress;
  private static $currentYearString = "";
  private static $initialCallForEntriesId = 0;
  private static $callForEntriesId = 0;
//  private static $defaultAdministratorId = 0; // Obsolete as of 2/20/15
//  private static $administratorId = 0; // Obsolete as of 2/20/15
  private static $defaultWorkId = 0;

  private static $permissionStringsArray = array();

  // callsForEntries arrays
  private static $earlyDeadline = array();
  private static $earlyDeadlineFee = array();
  private static $finalDeadline = array();
  private static $finalDeadlineFee = array();
  private static $deadlineEventDescription = array();
  private static $callNames = array();
  private static $mailEntryToAddress = array();
  private static $associatedEvent = array();
  
  // Venue/Date arrays
  private static $eventDatesDescriptionStringLong = array();
  private static $eventDatesDescriptionStringShort = array();
  private static $eventDescriptionStringLong = array();
  private static $eventDescriptionStringShort = array();
  private static $venueDescriptionString = array();
  
  // curation message phrases
  private static $arMsgAcceptanceMessagePart2 = '';
  private static $arMsgRequestImages = false;
  private static $arMsgImageDetailPart = '';
  private static $arMsgInstallationExplanation = '';
  private static $arMsgInviteFeedbackRequest = '';
  private static $arMsgPlugTheShow = '';
  private static $arMsgRejectionMessagePart2 = '';
  private static $arMsgRejectionWithinAcceptanceMessage = '';
  private static $arMsgVenueDirections = '';
  private static $arMsgVenueTitle = '';
  
  // media received message phrases
  private static $mrMsgWhenYouCanHearFromUsAgain = '';
  
  // callsForEntries releaseInfo Statements & Widgets & imageDirectories
  private static $releaseInfoStatementIntro = '';
  private static $releaseInfoStatementAllOK = '';
  private static $releaseInfoStatementAskMe = '';
  private static $releaseInfoWidgetIntro = '';
  private static $releaseInfoWidgetAllOK = '';
  private static $releaseInfoWidgetAskMe = '';
  private static $imagesDirectory = "images/Stills/";
  
  // Aspect Ratio Table
  private static $aspectRatioTable = array();

  // private initialization functions
  private static function initializeRunTimeValuesFromDB() {
    if (!self::$valuesAreInitialized) {
//      $selectString = "SELECT * from runTimeValues where yearIndex=0 or yearIndex is null";
      $selectString = "SELECT * from runTimeValues";
      $rtvRows = SSFDB::getDB()->getArrayFromQuery($selectString);
      foreach ($rtvRows as $rtvRow) { // item in db
        switch ($rtvRow['parameterName']) {
          case 'contactEmailAddress': self::$contactEmailAddress = $rtvRow['parameterValueString']; break;
          case 'copyrightYearsString': self::$copyrightYearsString = $rtvRow['parameterValueString']; break;
          case 'currentYearString': self::$currentYearString = $rtvRow['parameterValueString']; break;
//          case 'defaultAdministratorId': self::$administratorId = self::$defaultAdministratorId = $rtvRow['parameterValue']; break; // overall beginning 3/9/11 // Obsolete 2/20/15
          case 'defaultCallId': self::$callForEntriesId = self::$initialCallForEntriesId = $rtvRow['parameterValue']; break;
          case 'defaultWorkId': self::$defaultWorkId = self::$defaultWorkId = $rtvRow['parameterValue']; break;
          case 'listManagementEmailAddress': self::$listManagementEmailAddress = $rtvRow['parameterValueString']; break;
        }
      }
      self::initializeCallsAttributes();
      self::initializeCallsAttributeArrays();
      self::initializeAspectRatioTable();
      self::initializeVenueDateDescription();
      date_default_timezone_set('America/Denver'); // Set Default Time Zone to 'America/Denver'.
      $debug = new SSFDebug; $debug->belch('associatedEvent', self::$associatedEvent, -1);
    }
    self::$valuesAreInitialized = true;
  }
  
  private static function checkInit() {
    if (!self::$valuesAreInitialized) { self::initializeRunTimeValuesFromDB(); }
  }

  private static function initializeVenueDateDescription() {
    $venueDescriptionQuery = 'SELECT eventId, eventDescriptionShort, eventDescriptionLong, eventDatesDescription1, eventDatesDescription2, venueDescription1 FROM venues join events on venueId = venue ';
    $rows = SSFDB::getDB()->getArrayFromQuery($venueDescriptionQuery);
    foreach ($rows as $row) {
      self::$eventDatesDescriptionStringLong[$row['eventId']] = $row['eventDatesDescription2'];
      self::$eventDatesDescriptionStringShort[$row['eventId']] = $row['eventDatesDescription1'];
      self::$eventDescriptionStringLong[$row['eventId']] = $row['eventDescriptionLong'];
      self::$eventDescriptionStringShort[$row['eventId']] = $row['eventDescriptionShort'];
      self::$venueDescriptionString[$row['eventId']] = $row['venueDescription1'];
    }
  $debug = new SSFDebug;
  $debug->belch('$eventDatesDescriptionStringLong', self::$eventDatesDescriptionStringLong, -1);
  $debug->belch('$eventDatesDescriptionStringShort', self::$eventDatesDescriptionStringShort, -1);
  $debug->belch('$eventDescriptionStringLong', self::$eventDescriptionStringLong, -1);
  $debug->belch('$eventDescriptionStringShort', self::$eventDescriptionStringShort, -1);
  $debug->belch('$venueDescriptionString', self::$venueDescriptionString, -1);
  }

  private static function initializeCallsAttributes() {
    //SSFDB::debugNextQuery();
    $callsQueryString = 'SELECT * FROM callsForEntries WHERE callId = "' . self::$callForEntriesId . '"';
    $rows = SSFDB::getDB()->getArrayFromQuery($callsQueryString);
    $column = $rows[0];
    
    // callsForEntries releaseInfo Statements & Widgets & imageDirectories
    if (isset($column['releaseInfoStatementIntro'])) self::$releaseInfoStatementIntro = $column['releaseInfoStatementIntro'];
    if (isset($column['releaseInfoStatementAllOK'])) self::$releaseInfoStatementAllOK = $column['releaseInfoStatementAllOK'];
    if (isset($column['releaseInfoStatementAskMe'])) self::$releaseInfoStatementAskMe = $column['releaseInfoStatementAskMe'];
    if (isset($column['releaseInfoWidgetIntro'])) self::$releaseInfoWidgetIntro = $column['releaseInfoWidgetIntro'];
    if (isset($column['releaseInfoWidgetAllOK'])) self::$releaseInfoWidgetAllOK = $column['releaseInfoWidgetAllOK'];
    if (isset($column['releaseInfoWidgetAskMe'])) self::$releaseInfoWidgetAskMe = $column['releaseInfoWidgetAskMe'];
    if (isset($column['imagesDirectory'])) self::$imagesDirectory = $column['imagesDirectory'];
    
      // current curation message phrases
    if (isset($column['arMsgAcceptanceMessagePart2'])) self::$arMsgAcceptanceMessagePart2 = $column['arMsgAcceptanceMessagePart2'];
    if (isset($column['arMsgRequestImages'])) self::$arMsgRequestImages = (($column['arMsgRequestImages'] == 1) ? true : false); 
    if (isset($column['arMsgImageDetailPart'])) self::$arMsgImageDetailPart = $column['arMsgImageDetailPart'];
    if (isset($column['arMsgInstallationExplanationPart'])) self::$arMsgInstallationExplanation = $column['arMsgInstallationExplanationPart'];
    if (isset($column['arMsgInviteFeedbackRequestPart'])) self::$arMsgInviteFeedbackRequest = $column['arMsgInviteFeedbackRequestPart'];
    if (isset($column['arMsgPlugTheShowPart'])) self::$arMsgPlugTheShow = $column['arMsgPlugTheShowPart'];
    if (isset($column['arMsgRejectionMessagePart2'])) self::$arMsgRejectionMessagePart2 = $column['arMsgRejectionMessagePart2'];
    if (isset($column['arMsgRejectionWithinAcceptanceMessage'])) self::$arMsgRejectionWithinAcceptanceMessage = $column['arMsgRejectionWithinAcceptanceMessage'];
    if (isset($column['arMsgVenueDirectionsPart'])) self::$arMsgVenueDirections = $column['arMsgVenueDirectionsPart'];
    if (isset($column['arMsgVenueTitle'])) self::$arMsgVenueTitle = $column['arMsgVenueTitle'];
    
    // media receipt message phrases
    if (isset($column['mrMsgWhenYouCanHearFromUsAgain'])) self::$mrMsgWhenYouCanHearFromUsAgain = $column['mrMsgWhenYouCanHearFromUsAgain'];
  }
  
  private static function initializeCallsAttributeArrays() {
    //SSFDB::debugNextQuery();
    $callsQueryString = 'SELECT callId, name, '
                      . 'permissionAllOKString, permissionAskMeString, permissionAllOKDisplay, permissionAskMeDisplay, '
                      . 'mailEntryToAddress, earlyDeadline, earlyDeadlineFee, finalDeadline, finalDeadlineFee, deadlineEventDescription, '
                      . 'associatedEvent FROM callsForEntries';
    $rows = SSFDB::getDB()->getArrayFromQuery($callsQueryString);
    foreach ($rows as $row) {
      self::$callNames[$row['callId']] = $row['name'];
      self::$earlyDeadline[$row['callId']] = $row['earlyDeadline'];
      self::$earlyDeadlineFee[$row['callId']] = $row['earlyDeadlineFee'];
      self::$finalDeadline[$row['callId']] = $row['finalDeadline'];
      self::$finalDeadlineFee[$row['callId']] = $row['finalDeadlineFee'];
      self::$deadlineEventDescription[$row['callId']] = $row['deadlineEventDescription'];
      self::$mailEntryToAddress[$row['callId']] = $row['mailEntryToAddress'];
      self::$associatedEvent[$row['callId']] = $row['associatedEvent'];
      self::$permissionStringsArray[$row['callId']]['permissionAllOKString'] = $row['permissionAllOKString'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeString'] = $row['permissionAskMeString'];
      self::$permissionStringsArray[$row['callId']]['permissionAllOKDisplay'] = $row['permissionAllOKDisplay'];
      self::$permissionStringsArray[$row['callId']]['permissionAskMeDisplay'] = $row['permissionAskMeDisplay'];
    }
    $debug = new SSFDebug; $debug->belch('permissionStringsArray', self::$permissionStringsArray, -1);
  }
  
  private static function initializeAspectRatioTable() {
    //SSFDB::debugNextQuery();
    $aspectRatioQueryString = 'SELECT aspectRatioId, ratio, useInUI, ratioDescription, shortDescription, description FROM aspectRatios';
    $rows = SSFDB::getDB()->getArrayFromQuery($aspectRatioQueryString);
    foreach ($rows as $row) {
      self::$aspectRatioTable[$row['aspectRatioId']]['aspectRatioId'] = $row['aspectRatioId'];
      self::$aspectRatioTable[$row['aspectRatioId']]['ratio'] = $row['ratio'];
      self::$aspectRatioTable[$row['aspectRatioId']]['useInUI'] = $row['useInUI'];
      self::$aspectRatioTable[$row['aspectRatioId']]['ratioDescription'] = $row['ratioDescription'];
      self::$aspectRatioTable[$row['aspectRatioId']]['shortDescription'] = $row['shortDescription'];
      self::$aspectRatioTable[$row['aspectRatioId']]['description'] = $row['description'];
    }
    $debug = new SSFDebug; $debug->belch('aspectRatioTable', self::$aspectRatioTable, -1);
  }
  
  // general functions
    public static function getCopyrightYearsString() { self::checkInit(); return self::$copyrightYearsString; }
    public static function getCurrentYearString() { self::checkInit(); return self::$currentYearString; }
    public static function getContactEmailAddress() { self::checkInit(); return self::$contactEmailAddress; }
    public static function getListManagementEmailAddress() { self::checkInit(); return self::$listManagementEmailAddress; }
  
  // callForEntriesId functions
  public static function getInitialCallForEntriesId() { self::checkInit(); return self::$initialCallForEntriesId; }
  public static function getCallForEntriesId() { // BEWARE: the return result of this function is dependent on a cookie named ssf_callForEntriesId.
    self::checkInit(); 
    $callCookieName = "ssf_callForEntriesId";
// 4/15/12 - If 0 is eliminated as a possible value for $_COOKIE[$callCookieName], then All Events will never be selected.
//    if (isset($_COOKIE[$callCookieName]) && ($_COOKIE[$callCookieName] != 0) && ($_COOKIE[$callCookieName] != '')) self::$callForEntriesId =  $_COOKIE[$callCookieName];
    if (isset($_COOKIE[$callCookieName]) && ($_COOKIE[$callCookieName] != '')) self::$callForEntriesId = $_COOKIE[$callCookieName];
    return self::$callForEntriesId; 
  }
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
  public static function getMailEntryToAddress() { self::checkInit(); return (isset(self::$mailEntryToAddress[self::$callForEntriesId])) ? self::$mailEntryToAddress[self::$callForEntriesId] : ''; }
  public static function getDeadlineEventDescription() { self::checkInit(); return (isset(self::$deadlineEventDescription[self::$callForEntriesId])) ? self::$deadlineEventDescription[self::$callForEntriesId] : ''; }
  public static function getAssociatedEventId() { 
    self::checkInit(); return (isset(self::$associatedEvent[self::$callForEntriesId])) ? self::$associatedEvent[self::$callForEntriesId] : 0; 
  }

  //  Returns midnight for the date given in $dateString.
  public static function midnightEndingTimeFor($dateString) { 
    $date = explode('-', $dateString);
    $midnight = mktime(24, 0, 0, $date[1], $date[2], $date[0]);
    return $midnight;
  }
  
  // Cheats in favor of the person trying to make the deadline and returns true if it is
  // currently past 1 AM on the day after the date given by $deadlineDateString (e.g., '2010-04-12')
  public static function dateHasPassed($deadlineDateString) {
    $oneHour = (60 * 60);
    $dateHasPassed = (time() > (self::midnightEndingTimeFor($deadlineDateString) + $oneHour));
    return $dateHasPassed;
  }
  
  // administratorId & workId functions
//  public static function getDefaultAdministratorId() { self::checkInit(); return self::$defaultAdministratorId; } // Obsolete as of 2/20/15
//  public static function getAdministratorId() { self::checkInit(); return self::$administratorId; } // Obsolete as of 2/20/15
// TODO Find all calls to getAdministratorId() and get the information from elsewhere.
  public static function getAdministratorId() { return 1; } // Hack to avoid reading this from runTimeValues as $defaultAdministratorId as of 2/20/15
//  public static function setAdministratorId($intValue) { self::checkInit(); self::$administratorId = $intValue; return $intValue; } // Unused as of 2/20/15
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
  
  // Venue/Date functions
  public static function getEventDatesDescriptionStringLong($eventId) {
    self::checkInit(); 
    return (isset(self::$eventDatesDescriptionStringLong[$eventId])) ? self::$eventDatesDescriptionStringLong[$eventId] : "";
  }
  public static function getEventDatesDescriptionStringShort($eventId) {
    self::checkInit(); 
    return (isset(self::$eventDatesDescriptionStringShort[$eventId])) ? self::$eventDatesDescriptionStringShort[$eventId] : "";
  }
  public static function getEventDescriptionStringLong($eventId) {
    self::checkInit(); 
    return (isset(self::$eventDescriptionStringLong[$eventId])) ? self::$eventDescriptionStringLong[$eventId] : "";
  }
  public static function getEventDescriptionStringShort($eventId) {
    self::checkInit(); 
    return (isset(self::$eventDescriptionStringShort[$eventId])) ? self::$eventDescriptionStringShort[$eventId] : "";
  }
  public static function getVenueDescriptionString($eventId) {
    self::checkInit(); 
    return (isset(self::$venueDescriptionString[$eventId])) ? self::$venueDescriptionString[$eventId] : "";
  }
  
  // accept/reject message (arMsg) email string functions 
  public static function getAcceptanceMessagePart2() { self::checkInit(); return self::$arMsgAcceptanceMessagePart2; }
  public static function requestImages() { self::checkInit(); return self::$arMsgRequestImages; }
  public static function getImageDetailPart() { self::checkInit(); return self::$arMsgImageDetailPart; }
  public static function getInstallationExplanationPart() { self::checkInit(); return self::$arMsgInstallationExplanation; }
  public static function getInviteFeedbackRequestPart() { self::checkInit(); return self::$arMsgInviteFeedbackRequest; }
  public static function getPlugTheShowPart() { self::checkInit(); return self::$arMsgPlugTheShow; }
  public static function getRejectionMessagePart2() { self::checkInit(); return self::$arMsgRejectionMessagePart2; }
  public static function getRejectionWithinAcceptanceMessage() { self::checkInit(); return self::$arMsgRejectionWithinAcceptanceMessage; }
  public static function getVenueDirectionsPart() { self::checkInit(); return self::$arMsgVenueDirections; }
  public static function getVenueTitle() { self::checkInit(); return self::$arMsgVenueTitle; }
  
  // media receipt email string functions
  public static function getMrMsgWhenYouCanHearFromUsAgain() { self::checkInit(); return self::$mrMsgWhenYouCanHearFromUsAgain; }
  
  // other functions
  public static function getAspectRatioTable() { self::checkInit(); return self::$aspectRatioTable; }
  public static function nowForDB() { self::checkInit(); return date('Y-m-d H:i:s'); }

  // getCurrentCallImagesDirectory() is used to build the images table
  public static function getCurrentCallImagesDirectory() { self::checkInit(); return self::$imagesDirectory; }

}

?>
