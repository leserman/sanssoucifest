<?php

//echo 'Hi there.';

// singleton class for the mySQL database
class SSFDB {
  // This group of const vars should be private but PHP does not support private or protected const.
  const url = 'mysql.sanssoucifest.org';
  const username = 'sanssouci';
  const pw = 'minniekitty';
  const databaseName = 'sanssoucitestbed'; // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

  private static $db = null; // the single instance
  
  private static $debug = false;
  private static $debugNextQuery = false;
  
  private $link = null;
  private $connected = false;
  private $lastErrorText = null;
  private $lastErrorNo = null;
  private $queryResult = null;
  private $querySuccess = false;
  private $queryResultArray = null;
  private $queryResultArrays = null;
  
  // returns the conntected SSFdb object
  public static function getDB() {
    if (!(self::$db instanceof self)) { 
      self::$db = new self;
    }
    return self::$db;
  }
  
	// Return a php array from a query on the open database.
	// Caller may invoke as SSFDB::getDB()->getArrayFromQuery($queryString)
	public function getArrayFromQuery($queryString) { 
	  $this->queryResultArray = null;
	  self::debug($queryString);
    if (self::$debug || self::$debugNextQuery) echo "### " . $queryString . "<br>"; 
	  $this->queryResult = mysql_query($queryString, $this->link);
		$this->queryResultArray = array();
	  if (!$this->queryResult) {
  	  $this->setErrorState('QUERY = ' . $queryString);
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
	  if (!mysql_query($queryString, $this->link)) 
	    self::setErrorState('QUERY = ' . $queryString);
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

  private function connectNow() {
    $this->connected = false;
    $this->link = mysql_connect(self::url, self::username, self::pw);
    if(!is_resource($this->link)) {
      $this->setErrorState('Could not connect to DB at: ' . self::url . '. ');
    } else { // $connectionSuccess
      $selectDbSuccess = mysql_select_db(self::databaseName); 
      if (!$selectDbSuccess) {
        $this->setErrorState('Could not select DB named: ' . self::databaseName . '. ');
      } else 
        $this->connected = true;
    }
    return $this->connected;
  }

  // Creates the SSFdb object and connects to the mySQL database
  private function __construct() {
    $this->link = null;
    $this->connected = false;
    $this->lastErrorText = null;
    $this->lastErrorNo = null;
    $this->queryResult = null;
    $this->querySuccess = false;
    $this->queryResultArray = null;
    $this->queryResultArrays = null;
    $this->connectNow();
  }
  
	private function setErrorState($errorString) {
    $this->lastErrorText = mysql_error();
    $this->lastErrorNo = mysql_errno();
    $errorReport = 'MySQL ERROR<br>' . $errorString . '<br>ERROR # ' . mysql_errno() . ': ' . mysql_error() . '<br>';
    echo $errorReport;
    //debug_print_backtrace();
    //die($errorReport);
    $this->querySuccess = false;
	}

	private function debug($string) {
    if (self::$debug || self::$debugNextQuery) echo "### " . $string . "<br><br>\r\n"; 
    self::$debugNextQuery = false;
  }

}


// ---------------------------------------------------------------------------------------------------------------------

// properties for data items stored in the database [Useful queries are listed at end of class.]
class DatumProperties {
  private static $initialized = false;
  private static $dataPropertiesArray = null;
  public $itemKey = null; // defined as <tableName>.<columnName>
  public $tableName = null; // table name
  public $columnName = null; // column name
  public $dbDataType = null; // blob, date, datetime, enum, int, mediumblob, set, smallint, text, time, tinyint, tinytext, varchar 
  public $dbColType = null; // this is the data_type with additional detail
  public $swDataType = null; // string, int, date, datetime, duration, enum, set, time, blob
  public $displayName = null; // on web pages
  public $possibleValues = null; // for sets and enums only
  // $printFormat // derived from dbDataType & dbDataType or something like that
  
  // Returns the dbDatumPropertiesArray, initializing it if necessary.
  public static function getArray() {
    if (self::$dataPropertiesArray == null) self::initializeClass();
    return self::$dataPropertiesArray;
  }

  public static function forKey($key) {
    $a = self::getArray();
    return $a[$key];
  }

  // Returns a print format for the data suitable for writing it to the database.
  // Paramater $internalDateType may be 's' or null for a string OR 'i' for a multi-part integer representation.
  public function getPrintFormatString($internalDateType = null) {
    $stringFormat = "'%s'";
    $intFormat =  "%d";
    $dateStringFormatRaw =  "%4s-%'02s-%'02s";
    $dateStringFormat =  "'$dateStringFormatRaw'";
    $dateIntFormatRaw = "%04d-%02d-%02d";
    $dateIntFormat = "'$dateIntFormatRaw'";
    $datetimeStringFormat =  "'$dateStringFormatRaw %'02s:%'02s:%'02s'";
    $datetimeIntFormat = "'$dateIntFormatRaw %'02d:%'02d:%'02d'";
    $timeStringFormat =  "'%'02s:%'02s:%'02s'";
    $timeIntFormat = "'%02d:%02d:%02d'";
    $enumFormat =  "'%s'";
    
    switch ($this->swDataType) {
      case 'string': return $stringFormat; break;
      case 'int': return $intFormat; break;
      case 'date': 
        if (($internalDateType == null) || (substr($internalDateType, 0, 1)  == 's')) return $dateStringFormat;
        else if (substr($internalDateType, 0, 1)  == 'i') return $dateIntFormat;
        else echo 'ERROR: Unidentified internalDateType in dbDatumProperties::getPrintFormatString() case date: |' . $internalDateType . '|<br>';
        break;
      case 'datetime': 
        if (($internalDateType == null) || (substr($internalDateType, 0, 1)  == 's')) return $dateStringFormat;
        else if (substr($internalDateType, 0, 1)  == 'i') return $dateIntFormat;
        else echo 'ERROR: Unidentified internalDateType in dbDatumProperties::getPrintFormatString() case datetime: |' . $internalDateType . '|<br>';
        break;
      case 'time': // TODO: handle duration separately?
        if (($internalDateType == null) || (substr($internalDateType, 0, 1)  == 's')) return $dateStringFormat;
        else if (substr($internalDateType, 0, 1)  == 'i') return $dateIntFormat;
        else echo 'ERROR: Unidentified internalDateType in dbDatumProperties::getPrintFormatString() case time: |' . $internalDateType . '|<br>';
        break;
      case 'enum': return $enumFormat; break;
      case 'set':  // TODO: implement this
        // <enum> [, <enum>]*
        return null;
        break;
      case 'blob': return null; break; // TODO: implement this
    }
  }

  // Creates a new DatumProperties object
  private function __construct($tblName, $colName, $dataType, $colType) {
    $this->itemKey = self::getItemKeyFor($tblName, $colName);
    $this->tableName = $tblName;
    $this->columnName = $colName;
    $this->dbDataType = $dataType;
    $this->dbColType = $colType;
    $this->swDataType = $dataType;
    switch ($dataType) {
      case 'blob':
      case 'mediumblob': 
        $this->swDataType = 'blob';
        break;
      case 'date': 
        break;
      case 'datetime': 
        break;
      case 'enum': 
        // exmaple: enum('individual','several','organization')
        $strLength = strrpos($colType, ')', 0);
        $this->possibleValues = explode(',', substr($colType, 5, $strLength-5));
        //echo '<br>'; print_r($this->possibleValues); echo '<br>';
        break;
      case 'int':
      case 'smallint':
      case 'tinyint': 
        $this->swDataType = 'int';
        break;
      case 'set': 
        // example: set('DVD-NTSC','DVD-PAL','miniDV','16mmFilm','other')
        $strLength = strrpos($colType, ')', 0);
        $this->possibleValues = explode(',', substr($colType, 4, $strLength-4));
        //echo '<br>'; print_r($this->possibleValues); echo '<br>';
        break;
      case 'text':
      case 'tinytext':
      case 'varchar':
        $this->swDataType = 'string';
        break;
      case 'time':
        // TODO: this could be time or duration
        break;
      default:
        echo 'ERROR: Unidentified swDataType in dbDatumProperties::__construct(): |' . $dataType . '|<br>';
        var_dump(debug_backtrace());
        break;
    }
    $this->displayName = null;
    // $this->printFormat // derived from dbDataType & dbDataType or something like that

  }
  
  // returns the item key
  private static function getItemKeyFor($tableName, $columnName) {
    return trim($tableName) . '.' . trim($columnName);
  }
  
  private static function initializeClass() {
    $queryString = "select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS "
                 . "where TABLE_SCHEMA = 'sanssoucitestbed' order by DATA_TYPE";
    $dataItemsArray = SSFDB::getDB()->getArrayFromQuery($queryString);
    self::$dataPropertiesArray = array();
    foreach ($dataItemsArray as $dataItem) {
      $tblName = $dataItem['TABLE_NAME'];
      $colName = $dataItem['COLUMN_NAME'];
      self::$dataPropertiesArray[self::getItemKeyFor($tblName, $colName)] =  
        new DatumProperties($tblName, $colName, $dataItem['DATA_TYPE'], $dataItem['COLUMN_TYPE']);
    }
    //print_r(self::$dataPropertiesArray);
    $initialized = true;
  }
  
  // useful queries:
  // select TABLE_NAME, COLUMN_NAME, ORDINAL_POSITION, COLUMN_DEFAULT, IS_NULLABLE, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, COLUMN_TYPE, COLUMN_KEY, `EXTRA`, COLUMN_COMMENT from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed'
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed'
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY COLUMN_TYPE
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY DATA_TYPE
  // select DATA_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY DATA_TYPE
  // DATA_TYPES as of 12/26/08: blob (communications.contentFormatted only), date, datetime, enum, int, mediumblob (images.imageData only), set, smallint, text, time, tinyint, tinytext, varchar
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' order by DATA_TYPE

}

?>
