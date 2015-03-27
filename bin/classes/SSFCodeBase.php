<?php 
  
//  spl_autoload_register('SSFCodeBase::my_autoloader');

class SSFCodeBase {

  private static $codeBase = null;
  private static $debug = false;
  private $codeBaseString = '';
  private $autoloadClassesPath = '';

  public static function my_autoloader($class) { include '../bin/classes/' . $class . '.php'; }
  
//  public static function my_autoloader($class) { include __DIR__ . '/' . $class . '.php'; }


  // Example use:
  // include_once SSFCodeBase::autoloadClasses();
  // SSFWebPageAssets::displayNavBar(SSFCodeBase::string());

  public static function string($filePath) { $me = SSFCodeBase::getInstance($filePath); return $me->codeBaseString; }
  
  public static function autoloadClasses($filePath) { 
    if (self::$debug) { echo 'filePath '; print_r($filePath); echo "<br>\r\n"; }
    $me = SSFCodeBase::getInstance($filePath); 
    return $me->autoloadClassesPath; 
  }
  
  // Sample use:  echo SSFCodeBase::relPathFor(images/titleBarGrayLight.gif);
  public static function relPathFor($pathFromBase) { return SSFCodeBase::string() . $pathFromBase; }
  
  private static function getInstance($filePath) {
    if (!(self::$codeBase instanceof self)) { 
      self::$codeBase = new self($filePath);
      if (self::$debug) { echo 'codeBase '; print_r(self::$codeBase); echo "<br>\r\n"; }
      if (self::$debug) { echo 'autoloadClassesPath '; print_r(self::$codeBase->autoloadClassesPath); echo "<br>\r\n"; }
    }
    return self::$codeBase;
  }

  public function __construct() {
    $args = func_get_args();
    if (self::$debug) { echo 'args '; print_r($args);  echo "<br>\r\n"; }
    $filePath = (count($args) >= 1 && isset($args[0]) && ($args[0] != '')) ? $args[0] : __FILE__;
    $filePathArray = explode('/', $filePath);
    if (self::$debug) { echo 'filePathArray '; print_r($filePathArray);  echo "<br>\r\n"; }
    $loopIndex = 0;
    foreach (array_reverse($filePathArray) as $element) { 
      if (($element == 'sanssoucifest.org') || ($element == 'dev.sanssoucifest.org')) { 
        if (self::$debug) { echo 'loopIndex '; print_r($loopIndex);  echo "<br>\r\n"; } 
        break; 
      } else {
        $loopIndex++;
      }
    }
    $this->codeBaseString = "";
    for ($i = 1; $i < $loopIndex; $i++) { 
      $this->codeBaseString .= '../'; 
      if (self::$debug) { echo 'i=' . $i . ' codeBaseString=' . $this->codeBaseString .  "<br>\r\n"; }
    }
    $this->autoloadClassesPath = $this->codeBaseString . "bin/utilities/autoloadClasses.php";
  }  


}

?>