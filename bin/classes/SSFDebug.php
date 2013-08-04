<?php

class SSFDebug {

  // belch($idString, $dataStructure, $enabled = 0) echos the $idString and recursively prints the $dataStructure input
  // becho($idString, $displayString, $enabled = 0) echos the $idString and prints the $displayString input
  // Upon creation of either object, the default for output production is set ON.
  // The functions enableBelch($enabled=true) and enableBecho($enabled=true) set default output production ON or OFF.
  // For both functions, $enabled=1 overrides the default and creates the output.
  // For both functions, $enabled=0 overrides the default and suppresses the output.
  
  private $belchEnabled = true;
  private $bechoEnabled = true;
  private $logLineEnabled = true;
  private $globalDebugger = null;

  private static $tracebackColor = 'pink';
  private static $echoColor = '#CCFFFF';
  
  public static function globalDebugger() {
    if (!isset($globalDebugger)) $globalDebugger = new SSFDebug($initBelchEnabled=true, $initBechoEnabled=true);
    return $globalDebugger;
  }

  public function __construct($initBelchEnabled=true, $initBechoEnabled=true) {
    $this->belchEnabled = $initBelchEnabled;
    $this->bechoEnabled = $initBechoEnabled;
    error_reporting(E_ALL);
    ini_set('display_errors', true);
  }

  public function enableBelch($enabled = true) { $this->belchEnabled = $enabled; }
  public function enableBecho($enabled = true) { $this->bechoEnabled = $enabled; }
  public function enableLogLine($enabled = true) { $this->logLineEnabled = $enabled; }
  
  public function becho($idString, $displayString, $enabled = 0) { 
    if ($enabled == -1) $becho = false;
    else if ($enabled == 1) $becho = true;
    else if ($enabled == 0) $becho = $this->bechoEnabled;
    else $becho = $this->bechoEnabled;
    $idStringCooked = ($idString == '') ? '' : ' ' . $idString;
    if ($becho) { self::echoVisible("** BECHO ** " . $idStringCooked . ": " . $displayString); } /*  . "<br>\r\n") 5/4/12 */
    return $becho;
  }
  
  public function bechoTrace($idString, $displayString, $enabled = 0) { 
    $trace = $this->becho('** TRACE ** ' . $idString, $displayString, $enabled);
    if ($trace) self::showTrace();
  }

  public function belch($idString, $dataStructure, $enabled = 0) { 
    if ($enabled == -1) $belch = false;
    else if ($enabled == 1) $belch = true;
    else if ($enabled == 0) $belch = $this->belchEnabled;
    else $belch = $this->belchEnabled;
    if ($belch) { self::echoVisible("** BELCH ** " . $idString . ": " . "<span style='color:" . self::$tracebackColor . ";'>" . print_r($dataStructure, true) . "</span>"); /* echo "<br>\r\n"; 5/4/12 */ } 
    return $belch;
  }
  
  public function belchTrace($idString, $dataStructure, $enabled = 0) { 
    $trace = $this->belch('** TRACE ** ' . $idString, $dataStructure, $enabled);
//    if ($trace) { self::traceVisible(print_r(debug_backtrace(), true) . '</span>'); echo "<br>\r\n"; } 
    if ($trace) self::showTrace();
  }

  public function prettyBelch($idString, $dataStructure, $enabled = 0) { 
    if ($enabled == -1) $belch = false;
    else if ($enabled == 1) $belch = true;
    else if ($enabled == 0) $belch = $this->belchEnabled;
    else $belch = $this->belchEnabled;
    $prettyBelchString = "";
    if ($belch) { $prettyBelchString = "** <b>" . $idString . "</b> ** " . str_replace(" ", "&nbsp", str_replace("\n", "<br>", str_replace("\n\n", "\n", print_r($dataStructure, true)))); } 
    return $prettyBelchString;
  }
  
  // Same as becho() without the $idString parameter. For backward compatibility.
  public function logLine($string, $enabled = 0) { 
    if ($enabled == -1) $logLine = false;
    else if ($enabled == 1) $logLine = true;
    else if ($enabled == 0) $logLine = $this->logLineEnabled;
    else $logLine = $this->logLineEnabled;
    if ($logLine) { echo $string . "<br>\r\n"; }
    return $logLine;
  }
  
  // Same as calling $debug->logLine($string, 1).  For backward compatibility.
  public function debugLogLineUN($string) { $this->debugLogLine($string, 1); }

  public function debugLogLineTrace($string, $enabled = 0) { 
    $trace = $this->logLine($string, $enabled);
    if ($trace) debug_print_backtrace(); // var_dump(debug_backtrace())
  }

  private static function echoVisible($text) {
    echo '<span style="color:' . self::$echoColor . ';">' . $text . '</span>' . "<br>\r\n";
  }
  
  private static function traceVisible($text) {
    echo '<span style="color:' . self::$tracebackColor . ';">' . $text . '</span>';
  }

  private static function showTrace() {
    self::traceVisible(print_r(debug_backtrace(), true)); echo "<br>\r\n";
  }
}
?>
