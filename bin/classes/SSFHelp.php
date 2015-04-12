<?php
  class SSFHelp {

  private static $valuesAreInitialized = false;
  private static $helpString = array();
  private static $debugger;
  private static $doBelchAndBecho = false; // true false
  private static $float = '';

  public static function setFloat($string) { self::$float = $string; }
  public static function clearFloat($string) { self::$float = ''; }
  
  private static function debugger() { 
    if (!isset($debugger)) $debugger = new SSFDebug($initBelchEnabled=self::$doBelchAndBecho, $initBechoEnabled=self::$doBelchAndBecho);
    return $debugger;
  }

  private static function initializeRunTimeValuesFromDB() {
    if (!self::$valuesAreInitialized) {
      $helpRows = SSFDB::getDB()->getArrayFromQuery("SELECT * from editorHelp");
      foreach ($helpRows as $helpRow) {
        self::$helpString[$helpRow['helpKey']] = $helpRow['helpString'];
      }
    }
    self::$valuesAreInitialized = true;
    self::debugger()->belch('self::$helpString', self::$helpString, 0);
  }

  public static function helpStringFor($helpStringKey) {
    if (!self::$valuesAreInitialized) self::initializeRunTimeValuesFromDB();
    $helpStringValue = ((isset(self::$helpString[$helpStringKey])) ? self::$helpString[$helpStringKey] : '');
    return $helpStringValue;
  }
  
  public static function getHTMLIconFor($popupHelpStringKey, $alertHelpStringKey='') {
    if (!self::$valuesAreInitialized) self::initializeRunTimeValuesFromDB();
    if ($alertHelpStringKey == '') $alertHelpStringKey = $popupHelpStringKey;
    self::debugger()->becho('getHTMLIconFor popupHelpStringKey', $popupHelpStringKey, 0);
    self::debugger()->becho('getHTMLIconFor alertHelpStringKey', $alertHelpStringKey, 0);
    $popupHelpString = self::helpStringFor($popupHelpStringKey);
    $alertHelpString = self::helpStringFor($alertHelpStringKey);
    self::debugger()->becho('getHTMLIconFor popupHelpString', $popupHelpString, 0);
    self::debugger()->becho('getHTMLIconFor alertHelpString', $alertHelpString, 0);
    if ($popupHelpString == '') $htmlEmbed = '';
    else {
      $floatString = (self::$float == 'left') ? 'float:left;' 
                   : (self::$float == 'right') ? 'float:right;' 
                   : (self::$float == 'none') ? 'float:none;' : '';
      $htmlEmbed = '<a href="javascript:void(0)" onMouseOver="flyoverPopup(' . 
                    HTMLGen::simpleQuote($popupHelpString) . ', ' . HTMLGen::simpleQuote('#ad000b') . ')"' .
                    ' onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote($alertHelpString) . ')">' .
                    '<img src="images/helpIcon16.png" alt="HELP" ' .
                    'style="' . $floatString . 'padding:0 8px;margin:-4px 0 0 0;border:none;text-align:center;position:relative;top:-1;' . // 4/5/15 Added margin top -4px
                    'vertical-align:middle;"></a>';
    }
    self::debugger()->becho('getHTMLIconFor htmlEmbed', $htmlEmbed, 0);
    return $htmlEmbed;
  }
}
?>
