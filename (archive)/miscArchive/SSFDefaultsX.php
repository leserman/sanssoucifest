<?php 

// The SSFDB runTimeValues table contains defaults to be associated with a given call for entries.
// This singleton class returns those and other defaults - and a little state as well.
// Save the singleton in a $_SESSION variable as appropriate.
class SSFDefaults {

  // $fixedRoleConstants is an array of DB-Name => Display-Name for the fixed work contributor roles.
  private static $fixedRoleConstants = array('Director' => 'Director', 
                                             'Producer' => 'Producer', 
                                             'Choreographer' => 'Choreographer', 
                                             'DanceCompany' => 'Dance Company', 
                                             'PrincipalDancers' => 'Principal Dancers', 
                                             'MusicComposition' => 'Music Composition', 
                                             'MusicPerformance' => 'Music Performance');

  private static $defaults = null; // the single instance
  
  private $initialCallForEntriesId = 0;
  private $currentCallForEntriesId = 0;        // This is state, not a default.
  private $defaultAdministratorId = 0;
  private $permissionAskMeString = '';
  private $permissionAllOKString = '';

  // returns the singleton SSFDefaults object
  public static function getDefaults() {
    if (!(self::$defaults instanceof self)) { 
      self::$defaults = new self;
    }
    return self::$defaults;
  }

  // Typically use these functions in the form SSFDefaults::getDefaultCallForEntriesId()
  public static function getFixedRoleConstants() { return self::getDefaults()->fixedRoleConstants; }
  public static function getDefaultCallForEntriesId() { return self::getDefaults()->initialCallForEntriesId; }
  public static function getCurrentCallForEntriesId() { return self::getDefaults()->currentCallForEntriesId; }  // This is state, not a default.
  public static function setCurrentCallForEntriesId($intValue) { return self::getDefaults()->currentCallForEntriesId = $intValue; }
  public static function getPermissionAskMeString() { return self::getDefaults()->permissionAskMeString; }
  public static function getPermissionAllOKString() { return self::getDefaults()->permissionAllOKString; }
  public static function getDefaultAdministratorId() { return self::getDefaults()->defaultAdministratorId; }

  // Creates the SSFdb object and connects to the mySQL database
  private function __construct() {
    $this->currentCallForEntriesId = $this->initialCallForEntriesId = 0;
    $this->defaultAdministratorId = 0;
    $this->permissionAskMeString = '';
    $this->permissionAllOKString = '';
    $this->initializeRunTimeValuesFromDB();
  }
  
  private function initializeRunTimeValuesFromDB() {
    $initialValues = SSFDB::getDB()->getArrayFromQuery("SELECT * from runTimeValues");
    foreach ($initialValues as $initialValue) {
      switch ($initialValue['parameterName']) {
        case 'defaultCallId': 
          $this->currentCallForEntriesId = $this->initialCallForEntriesId = $initialValue['parameterValue']; 
          break;
        case 'defaultAdministratorId': 
          $this->defaultAdministratorId = $initialValue['parameterValue']; 
          break;
        case 'permissionAskMe': 
          $this->permissionAskMeString = $initialValue['parameterValueString']; 
          break;
        case 'permissionAllOK': 
          $this->permissionAllOKString = $initialValue['parameterValueString']; 
          break;
      }
    }
  }
  
}

?>
