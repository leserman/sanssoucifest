<?php

// useful queries:
// select TABLE_SCHEMA, TABLE_NAME, ORDINAL_POSITION, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' order by TABLE_NAME, COLUMN_NAME, ORDINAL_POSITION
// select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' order by DATA_TYPE
// select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' and (DATA_TYPE='enum' or DATA_TYPE='set') order by DATA_TYPE
// select TABLE_NAME, COLUMN_NAME, ORDINAL_POSITION, COLUMN_DEFAULT, IS_NULLABLE, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION, COLUMN_TYPE, COLUMN_KEY, `EXTRA`, COLUMN_COMMENT from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed'
// select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed'
// select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY COLUMN_TYPE
// select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY DATA_TYPE
// select DATA_TYPE from information_schema.COLUMNS where TABLE_SCHEMA = 'sanssoucitestbed' GROUP BY DATA_TYPE
// DATA_TYPES as of 12/26/08: blob (communications.contentFormatted only), date, datetime, enum, int, mediumblob (images.imageData only), set, smallint, text, time, tinyint, tinytext, varchar

// properties for data items stored in the database 
class DatumProperties {
  private static $initialized = false;
  private static $dataPropertiesArray = null;
  private static $workContributorRoleKeys = array('Director', 'Producer', 'Choreographer', 'DanceCompany', 'PrincipalDancers', 
                                                  'MusicComposition', 'MusicPerformance', 'Camera', 'Editor', 'Other_1', 'Other_2');
  public $itemKey = null; // defined as <tableName>.<columnName>
  public $tableName = null; // table name
  public $columnName = null; // column name
  public $dbDataType = null; // blob, date, datetime, enum, int, mediumblob, set, smallint, text, time, tinyint, tinytext, varchar 
  public $dbColType = null; // this is the data_type with additional detail
  public $dbColKey = null; // 'PRI' for primary key; 'MUL' for indexing
  public $swDataType = null; // string, int, date, datetime, duration, enum, set, time, blob
  public $displayName = null; // on web pages
  public $possibleValues = null; // for sets and enums only
  // $printFormat // derived from dbDataType & dbDataType or something like that
  
  // Returns the dbDatumPropertiesArray, initializing it if necessary.
  public static function getArray() {
    if (self::$dataPropertiesArray == null) self::initializeClass();
    return self::$dataPropertiesArray;
  }

  // returns a DatumProperties object for the specified $key
  public static function forKey($key) {
    $a = self::getArray();
    return (isset($a[$key]) ? $a[$key] : null);
  }

  // return true if the $dbDataType for the specified $key is a date
  public static function isDate($key) {
    $datumProperties = self::forKey($key);
    if (is_null($datumProperties)) return false;
    else {
      $dataType = $datumProperties->dbDataType;
      $isDate = ($dataType == 'date');
      return $isDate;
    }
  }

  public static function getColsForTable($tableName) {
    $datumArray = self::getArray();
    $colArray = array();
    foreach ($datumArray as $datum) {
      if ($datum->tableName == $tableName) $colArray[] = $datum->columnName;
    }
    return $colArray;
  }
  
  public static function workContributorRoleKeys() { return self::$workContributorRoleKeys; }
  
  // Returns a print format for the data suitable for writing it to the database.
  // For date, time and datetime values, paramater $hint may be 's' for a multi-part string 
  // OR 'i' for a multi-part integer or null for a simple string representation.
  // For a set, paramater $hint may be the set itself.
  public function getPrintFormatString($hint = null) {
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
    $setElementFormat =  "%s";
    
    switch ($this->swDataType) {
      case 'string': return $stringFormat; break;
      case 'int': 
        return $intFormat; 
        break;
      case 'date': 
        if ($hint == null) return $stringFormat; 
        else if (substr($hint, 0, 1)  == 's') return $dateStringFormat;
        else if (substr($hint, 0, 1)  == 'i') return $dateIntFormat;
        else echo 'ERROR: Unidentified date hint in dbDatumProperties::getPrintFormatString() case date: |' 
                  . $hint . '|<br>';
        break;
      case 'datetime': 
        if ($hint == null) return $stringFormat; 
        else if (substr($hint, 0, 1)  == 's') return $datetimeStringFormat;
        else if (substr($hint, 0, 1)  == 'i') return $datetimeIntFormat;
        else echo 'ERROR: Unidentified datetime hint in dbDatumProperties::getPrintFormatString() case datetime: |'
                  . $hint . '|<br>';
        break;
      case 'time': // TODO: handle duration separately?
        if ($hint == null) return $stringFormat; 
        else if (substr($hint, 0, 1)  == 's') return $timeStringFormat;
        else if (substr($hint, 0, 1)  == 'i') return $timeIntFormat;
        else echo 'ERROR: Unidentified time hint in dbDatumProperties::getPrintFormatString() case time: |'
                  . $hint . '|<br>';
        break;
      case 'enum': return $enumFormat; break;
      case 'set':  return $stringFormat; break; // TODO: Make this work for an array someday.
        if ($hint == null) return $enumFormat;
        else if (is_array($hint) && (count($hint) > 0)) {
          $index = 0;
          foreach ($hint as $element) {
            if ($index == 0) $format = "'" . $setElementFormat;
            else $format += ", " . $setElementFormat;
            $index++;
          }
          $format += "'";
          return $format;
        }
        else return $stringFormat;
        break;
      case 'blob': return null; break; // TODO: implement this
    }
  }

  // Creates a new DatumProperties object
  private function __construct($tblName, $colName, $dataType, $colType, $colKey) {
    $this->itemKey = self::getItemKeyFor($tblName, $colName);
    $this->tableName = $tblName;
    $this->columnName = $colName;
    $this->dbDataType = $dataType;
    $this->dbColType = $colType;
    $this->dbColKey = $colKey;
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
        $this->setPossibleValues();
        break;
      case 'int':
      case 'bigint':
      case 'smallint':
      case 'tinyint': 
        $this->swDataType = 'int';
        break;
      case 'set': 
        // example: set('DVD-NTSC','DVD-PAL','miniDV','16mmFilm','other')
        $this->setPossibleValues();
        break;
      case 'text':
      case 'tinytext':
      case 'mediumtext':
      case 'varchar':
        $this->swDataType = 'string';
        break;
      case 'time':
        // TODO: this could be time or duration
        break;
      default:
        echo 'ERROR: Unidentified swDataType in dbDatumProperties::__construct(): |' . $dataType . '|<br>';
        $debugger = new SSFDebug();
        $debugger->belch('debug_backtrace from DatumProperties::__construct', debug_backtrace(), 1);
        break;
    }
    $this->displayName = null;
    // $this->printFormat // derived from dbDataType & dbDataType or something like that
  }
  
  private function setPossibleValues() {
    // exmaple: enum('individual','several','organization')
    // example: set('DVD-NTSC','DVD-PAL','miniDV','16mmFilm','other')
    if ($this->dbDataType == 'enum') $offset = 5;
    else if ($this->dbDataType == 'set') $offset = 4;
    $strLength = strrpos($this->dbColType, ')', 0);
    $quotedValues = array();
    $quotedValues = explode(',', substr($this->dbColType, $offset, $strLength-$offset));
    $this->possibleValues  = array();
    foreach ($quotedValues as $possibleValue) $this->possibleValues[] = trim($possibleValue, "'");
    //echo '<br>'; print_r($this->possibleValues); echo '<br>';
  }

  // returns the item key
  public static function getItemKeyFor($tableName, $columnName) {
    return trim($tableName) . '_' . trim($columnName);
  }
  
  private static function initializeClass() {
//    $queryString = "select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE from information_schema.COLUMNS "
//                 . "where TABLE_SCHEMA = '" . SSFDB::getSchemaName() . "' order by DATA_TYPE";
    $queryString = "select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY from COLUMNS_SCHEMA_INFO";
    $dataItemsArray = SSFDB::getDB()->getArrayFromQuery($queryString);
    $debugger = new SSFDebug();
    $debugger->becho('DatumProperties::initializeClass', ' CALLED', -1);
    $debugger->belch('debug_backtrace from DatumProperties::initializeClass', debug_backtrace(), -1);
    self::$dataPropertiesArray = array();
    foreach ($dataItemsArray as $dataItem) {
      $tblName = $dataItem['TABLE_NAME'];
      $colName = $dataItem['COLUMN_NAME'];
      self::$dataPropertiesArray[self::getItemKeyFor($tblName, $colName)] =  
        new DatumProperties($tblName, $colName, $dataItem['DATA_TYPE'], $dataItem['COLUMN_TYPE'], $dataItem['COLUMN_KEY']);
    }
    //print_r(self::$dataPropertiesArray);
    $initialized = true;
  }
  
}

?>
