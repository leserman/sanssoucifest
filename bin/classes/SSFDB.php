<?php

//echo 'Hi there.';

// singleton class for the mySQL database
class SSFDB {
  // TODO: Change from using MySQL to MySQLi 
  // This group of const vars should be private but PHP does not support private or protected const.
  // TODO: Get these values from ./bin/data/sanssouci.ini
/*
  const url = 'mysql.sanssoucifest.org';
  const username = 'sanssouci';
  const pw = '4DAMcdfss';  // previously 'minniekitty', 'ssfdcmad4'
*/
  
  private static $url = '';        // SSFInit::getDbURL();
  private static $username = '';   // SSFInit::dbusername();
  private static $pw = '';         // SSFInit::getDbPW(); 
  private static $schemaName = ''; // SSFInit::getDbSchemaName();

//  private static $schemaNamePaths = array('../bin/data/', './bin/data/', '../../bin/data/', './') ;
//  private static $schemaNameFile = 'emanamemchs.txt'; // TODO: Get this info from sanssouci.ini instead of emanamemchs.txt
//  private static $schemaName = null; // 'sanssoucitestbed'; // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

  private static $db = null; // the single instance
  
  private static $debug = false;
  private static $debugNextQuery = false;
  
  // TODO: Rather than store state variables, use the MySQLi API whereever possible.
  private $link = null;
  private $connected = false;
  private $lastErrorText = null;
  private $lastErrorNo = null;
  private $queryResult = null;
  private $querySuccess = false;
  private $queryResultArray = null;
  private $queryResultArrays = null;
  
  public static function getSchemaNameX() {
    if (!isset(self::$schemaName) || (self::$schemaName === '')) self::setSchemaName();
    return self::$schemaName;
  }
  
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
	  // Error while testing informArtistsOfMediaReceipt 5/2/10: 
	  // Notice: Undefined property: SSFCommunique::$link
	  // This causes the query to fail with a MYSQL ERROR 0
	  // It seems like memory is being trashed. $this should be an SSFDB object, not a SSFCommunique object.
    // $link = $this->link;
	  $this->queryResultArray = null;
	  self::debug($queryString);
    // The $this->link parameter was removed from the mysql_query call becuase of the error noted above. 5/2/10
    // $this->queryResult = mysql_query($queryString, $this->link);
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
		return $this->queryResultArray;
  }
  
	// Save a row to the open database
	public function saveData($queryString) {
	  self::debug($queryString);
	  $this->querySuccess = true;
	  if (mysql_query($queryString, $this->link) === false) {
      $this->querySuccess = false;
	    self::setErrorState('QUERY = ' . $queryString);
	  }
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
  
  private static function setSchemaNameX() { // 4/11/15 no longer used
    $token = false;
    foreach (self::$schemaNamePaths as $schemaNamePath) {
      $fileHandle = @fopen($schemaNamePath . self::$schemaNameFile, 'r');
      //echo '1. ' . $fileHandle . '<br>\r\n';
      if ($fileHandle === false) continue;
      else {
        $fileLine1 = @fgets($fileHandle);
        if ($fileLine1 === false) continue;
        else {
          @fclose($fileHandle);
          $eolArray = array("\r\n", "\n", "\r");
          $token = str_replace($eolArray, "", $fileLine1);
          $token = trim($token);
          //echo "\r\n<br>" . $token . "\r\n<br>";
        }
        break;
      }
    }
    if ($token !== false) {
      self::$schemaName = $token;
      //echo "\r\n<br>" . self::$schemaName . "\r\n<br>";
    } else {
      echo 'ERROR: Could not open schema name file. ' . "<br>\r\n";
      debug_print_backtrace();
    }
  }

  private function connectNow() {
    $this->connected = false;
    $this->link = mysql_connect(self::$url, self::$username, self::$pw);
    if(!is_resource($this->link)) {
      self::setErrorState('Could not connect to DB at: ' . self::url . '. ');
    } else { // $connectionSuccess
//      $selectDbSuccess = mysql_select_db(self::getSchemaName()); 
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
//    self::setSchemaName();
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
