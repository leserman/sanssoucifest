<?php
// singleton class for the mySQL database
class SSFDB {
  // TODO: Change from using MySQL to MySQLi 

  private static $url = '';        // SSFInit::getDbURL();
  private static $username = '';   // SSFInit::dbusername();
  private static $pw = '';         // SSFInit::getDbPW(); 
  private static $schemaName = ''; // SSFInit::getDbSchemaName();

  private static $db = null; // the single instance
  
  private static $debug = false;
  private static $debugNextQuery = false;
  private static $instrumented = false;
  
  // TODO: Rather than store state variables, use the MySQLi API whereever possible.
  private $link = null;
  private $connected = false;
  private $lastErrorText = null;
  private $lastErrorNo = null;
  private $queryResult = null;
  private $querySuccess = false;
  private $queryResultArray = null;
  private $queryResultArrays = null;
  private $startTime;  // Query start time
  private $currentQueryString = '';
  private $timer;
  
  public static function getSchemaName() { return self::$schemaName; }
  
  // returns the conntected SSFdb object, SSFDB::getDB()
  public static function getDB() {
    if (!(self::$db instanceof self)) { 
      self::$db = new self;
    }
    return self::$db;
  }

	// Return a php array from a query on the open database.
	// May call as SSFDB::getDB()->getArrayFromQuery($queryString)
	public function getArrayFromQuery($queryString) { 
	  $this->queryResultArray = null;
	  self::debug($queryString);
	  if (self::$instrumented) $this->timer = new SSFTimer($queryString);
	  $this->queryResult = mysql_query($queryString);
		$this->queryResultArray = array();
	  if ($this->queryResult === false) {
  	  self::setErrorState('QUERY = ' . $queryString);
	  } else {
	    $this->querySuccess = true;
	  	while ($queryRow = mysql_fetch_assoc($this->queryResult)) {
	  	  $this->queryResultArray[] = $queryRow;
	  	}
    }
		// transfer the result set into a php array
	  if (self::$instrumented) $this->timer->stopAndDisplayResult();
		return $this->queryResultArray;
  }
  
	// Save a row to the open database
	public function saveData($queryString) {
	  self::debug($queryString);
	  if (self::$instrumented) $this->timer = new SSFTimer($queryString);
	  $this->querySuccess = true;
	  if (mysql_query($queryString, $this->link) === false) {
      $this->querySuccess = false;
	    self::setErrorState('QUERY = ' . $queryString);
	  }
	  if (self::$instrumented) $this->timer->stopAndDisplayResult();
	  return $this->querySuccess;
	}
	
  public function connected() { return $this->connected; }
  public function lastErrorText() { return $this->lastErrorText; }
  public function lastErrorNo() { return $this->lastErrorNo; }
  public function querySuccess() { return $this->querySuccess; }
  public function rowsSelected() { return mysql_num_rows($this->queryResult); }
  public function queryResultArray() { return $this->queryResultArray; }
  public function queryResultArrays() { return $this->queryResultArrays; }
  public function insertedId() { return mysql_insert_id(); }

  public static function debugOn() { self::$debug = true; }
  public static function debugOff() { self::$debug = false; }
  public static function debugNextQuery() { self::$debugNextQuery = true; }
  public static function beginInstrumentation() { self::$instrumented = true; }
  public static function endInstrumentation() { self::$instrumented = false; }
  
  
  private function connectNow() {
    $this->connected = false;
    $this->link = mysql_connect(self::$url, self::$username, self::$pw);
    if(!is_resource($this->link)) {
      self::setErrorState('Could not connect to DB at: ' . self::url . '. ');
    } else { // $connectionSuccess
      $selectDbSuccess = mysql_select_db(self::$schemaName); 
      if (!$selectDbSuccess) {
        self::setErrorState('Could not select DB named: ' . self::$schemaName . '. ');
      } else 
        $this->connected = true;
    }
    return $this->connected;
  }

  private static function initializeFromFile() {
    self::$url = SSFInit::getDbURL();
    self::$username = SSFInit::getDbUsername();
    self::$pw = SSFInit::getDbPW(); 
    self::$schemaName = SSFInit::getDbSchemaName();
  }
  
  // Creates the SSFdb object and connects to the mySQL database
  private function __construct() {
    self::initializeFromFile();
    $this->link = null;
    $this->connected = false;
    $this->lastErrorText = null;
    $this->lastErrorNo = null;
    $this->queryResult = null;
    $this->querySuccess = false;
    $this->queryResultArray = null;
    $this->queryResultArrays = null;
    $connected = $this->connectNow();
    if ($connected) mysql_set_charset("utf8"); // Added 11/19/14 - TODO This function is deprecated as of PHP 5.5.
  }
  
	private function setErrorState($errorString) {
    $this->lastErrorText = mysql_error();
    $this->lastErrorNo = mysql_errno();
    $errorReport = 'MySQL ERROR<br>' . $errorString . '<br>ERROR # ' . mysql_errno() . ': ' . mysql_error() . '<br>';
    echo $errorReport . "\r\n";
    debug_print_backtrace();
    //die($errorReport);
    $this->querySuccess = false;
	}

	private function debug($string) {
    if (self::$debug || self::$debugNextQuery) {
      echo "### " . $string . "<br><br>\r\n"; 
      //debug_print_backtrace();
    }
    self::$debugNextQuery = false;
  }

}

?>
