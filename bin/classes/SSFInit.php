<?php
// SSFInit gets values from sanssouci.ini.
class SSFInit {
  
  private static $iniData = null;
  private static $failureNotice = 'Initialization failed.';
  private static $debugOn = false;
  
  public static function getDbName()       { if (self::initialized()) return self::$iniData['database']['dbname']; else return $failureNotice; }
  public static function getDbUsername()   { if (self::initialized()) return self::$iniData['database']['dbusername']; else return $failureNotice; }
  public static function getDbPW()         { if (self::initialized()) return self::$iniData['database']['dbpw']; else return $failureNotice; }
  public static function getDbSchemaName() { if (self::initialized()) return self::$iniData['database']['dbschemaname']; else return $failureNotice; }
  public static function getDbURL()        { if (self::initialized()) return self::$iniData['database']['dburl']; else return $failureNotice; }
  
  public static function getPpYourEmailAddr()         { if (self::initialized()) return self::$iniData['paypal']['ppYourEmailAddr']; else return $failureNotice; }
  public static function getPpYourPrimaryEmailAddr()  { if (self::initialized()) return self::$iniData['paypal']['ppYourPrimaryEmailAddr']; else return $failureNotice; }
  public static function getPpErrorLogFilename()  { if (self::initialized()) return self::$iniData['paypal']['ppErrorLogFilename']; else return $failureNotice; }

  private static function initialized() {
    if (is_null(self::$iniData)) {
      $debug = new SSFDebug; 
      // Note that the next line will break if the web server does not provide the DOCUMENT_ROOT information. 
      // See http://php.net/manual/en/reserved.variables.server.php
      self::$iniData = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/bin/data/sanssouci.ini', true); 
      
      // This next approach works but requires maintenance of the definition of SSFProgramPageParts::$rootPath().
      //      self::$iniData = parse_ini_file(SSFProgramPageParts::getRootPath() . '/bin/data/sanssouci.ini', true); 
      // This next approach fails because Dreamhost PHP settings do not allow URL_inlcude. See http://wiki.dreamhost.com/Allow_url_include.
      //      self::$iniData = parse_ini_file(SSFProgramPageParts::getHostName() . '/bin/daata/sanssouci.ini', true);
      // This next approach fails because the URL base is not implied for parse_ini_file as it is in <a href="...">.
      //      self::$iniData = parse_ini_file('./bin/data/sanssouci.ini', true);

      if (self::$iniData !== false) {
        if (self::$debugOn) $debug->belch('initialization data', self::$iniData, 1);
        return true;
      } else {
        if (self::$debugOn) $debug->belch('initialization failed', '', 1);
        return false;
      }
      
    }
    return true;
  }
}
?>