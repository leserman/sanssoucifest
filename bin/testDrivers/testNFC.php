<!DOCTYPE html>
<?php
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<html>
<!--
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>NFC Test</title>
  </head>
-->
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <base href="http://sanssoucifest.org/">
    <title>Test ICU NFC</title>
    <meta name="robots" content="noarchive, noindex, nofollow">
    <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
    <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
    <!--
      .programHighlightColor { color:#586caf;border-color:#586caf;border-width: 1px; } 
      .differentProgramsText { font-size:15px;margin:12px 0 -8px 0;line-height:120%;color:#E49548;font-weight:normal; } 
      a.special:link { color : #FFFF99; text-decoration: none; } 
      a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */ 
      a.special:hover { color : #990000; text-decoration: underline; } 
    -->
    </style>
    <script src="bin/scripts/ssfDisplay.js" type="text/javascript"></script>
    <link rel="stylesheet" href="sanssouci.css" type="text/css">
    <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
    <link rel=icon href=favicon.png sizes='16x16' type='image/png'>
    <style type="text/css">
      /* CSS inline style definitions go here. */
/*      td { padding:0;border:0px solid red;background-color:#2300ff;margin:0;border-collapse:collapse; }  */
      table { padding:0;margin:0;border-collapse:collapse; }
    </style>
  </head>

  <body>

<?php error_reporting(E_ALL); ?>

<?php
  function htmlEncodeX($string) {
    $encodedString = '';
    if (isset($string) && $string != '') {
      // NORMALIZE
      $encodedString = Normalizer::normalize($string, Normalizer::FORM_D);
      // Convert all characters to the corresponding html entity codes.
      $encodedString = htmlentities($encodedString, ENT_COMPAT | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false); // 11/16/14 Added , ENT_COMPAT | ENT_IGNORE (or ENT_SUBSTITUTE) | ENT_HTML5
      // Unmap (decode) some entities.
      $encodedString = str_replace('&lt;', '<', $encodedString);     // Convert the htmlentities for < and > back to < and > because they're used in markup in the database.
      $encodedString = str_replace('&gt;', '>', $encodedString);     // Convert the htmlentities for < and > back to < and > because they're used in markup in the database.
      $encodedString = str_replace('&period;', '.', $encodedString); // Correcting having "." (period) mapped to &period;
      $encodedString = str_replace('&comma;', '.', $encodedString);  // Correcting having "," (comma) mapped to &comma;
      $encodedString = str_replace('&colon;', '.', $encodedString);  // Correcting having "," (colon) mapped to &colon;
      $encodedString = str_replace('&semi;', ';', $encodedString);   // Correcting having "," (semi) mapped to &semi;
    }
    return $encodedString;
  }
  
  function htmlEncode($string) {
    $thisIsASpecialCase = false;
    if (stristr($string, 'lisabeth') !== false) $thisIsASpecialCase = true;
    if (stristr($string, 'Jamnikar') !== false) $thisIsASpecialCase = true;
    if ($thisIsASpecialCase) $showDebug = 1; else $showDebug = -1;
    $encodedString = '';
    SSFDebug::globalDebugger()->becho('htmlEncode() input', $string, $showDebug);
    if (isset($string) && $string != '') {
      // Normalize the string to Unicode UTF-8 Form C.
      $encodedString = Normalizer::normalize($string, Normalizer::FORM_C);
      if (!$encodedString) {
        SSFDebug::globalDebugger()->becho('htmlEncode NORMALIZE ERROR', intl_get_error_code(), 1);  
      }
      SSFDebug::globalDebugger()->becho('htmlEncode() NORMALIZED', $encodedString, $showDebug);
      // Convert all characters to the corresponding html entity codes.
      $encodedString = htmlentities($encodedString, ENT_COMPAT | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false); // 11/16/14 Added , ENT_COMPAT | ENT_IGNORE (or ENT_SUBSTITUTE) | ENT_HTML5
    }
    SSFDebug::globalDebugger()->becho('htmlEncode() output', $encodedString, $showDebug);
    return $encodedString;
  }


?>

<h1>ICU is <a href="http://site.icu-project.org/home">International Components for Unicode</a><span style="font-size:14px;"> - http://site.icu-project.org/home</span></h1>
<h1>NFC is <a href="unicode.org/reports/tr15/">Unicode Normalization Form C</a><span style="font-size:14px;"> - unicode.org/reports/tr15/, <a href="macchiato.com/unicode/nfc-faq">macchiato.com/unicode/nfc-faq</a></span></h1>
Essentially htmlEncode does this:<pre>      
  // NORMALIZE
  $encodedString = Normalizer::normalize($inputString, Normalizer::FORM_D);
  // Convert all characters to the corresponding html entity codes.
  $encodedString = htmlentities($encodedString, ENT_COMPAT | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8', false);
</pre>
<br>
<h2>1. Neža - <span style="font-size:16px;">copied from http://sanssoucifest.org/programPages/programBoe2014.php</span></h2>
<h2>2. <?php echo htmlEncode('Neža'); ?> - <span style="font-size:16px;">htmlEncode of string copied from http://sanssoucifest.org/programPages/programBoe2014.php</span></h2>
<h2>3. Ne&#780;a - <span style="font-size:16px;">the string 'Ne&amp;#780;a'</span></h2>
<h2>4. <?php echo htmlEncode('Nez&#780;a'); ?> - <span style="font-size:16px;"> htmlEncode of the string 'Ne&amp;#780;a'</span></h2>
<h2>5. Ne&#x017E;a - <span style="font-size:16px;">the string 'Ne&amp;#x017E;a' which is normalized Form C</span></h2>
<h2>6. <?php echo htmlEncode('Ne&#x017E;a'); ?> - <span style="font-size:16px;">htmlEncode of the string 'Ne&amp;#x017E;a' which is normalized Form C</span></h2>
<h2>7. <?php echo Normalizer::normalize('Neža Jamnikar'); ?> - <span style="font-size:16px;">NORMALIZE string copied from http://sanssoucifest.org/programPages/programBoe2014.php</span></h2>
<h2>8. <?php echo htmlEncode('Neža Jamnikar'); ?> - <span style="font-size:16px;">htmlEncode of string copied from http://sanssoucifest.org/programPages/programBoe2014.php</span></h2>
<h2>9. <?php echo Normalizer::normalize('Élisabeth Desbiens'); ?> - <span style="font-size:16px;">NORMALIZE string copied from admin/adminDataEntry.php source listing</span></h2>
<h2>10. <?php echo htmlEncode('Élisabeth Desbiens'); ?> - <span style="font-size:16px;">htmlEncode of string copied from admin/adminDataEntry.php source listing</span></h2>

<b>Note: Items 1-4 above are expected to produce W3 Validation Warnings: </b><i>Text run is not in Unicode Normalization Form C.</i>
<br><br><br>
<b>Results of print_r(get_env()):<br></b>
<?php print_r(getenv('default_charset')); ?>
<br><br>
<b>Results of print_r(ini_get_all()):<br></b>
<?php // print_r(ini_get_all()); ?>
<br><br>
<?php //phpinfo(INFO_ENVIRONMENT); ?>



<!-- <h2>4. <?php echo htmlEncode('Neža'); ?> - <span style="font-size:13px;"></span></h2> -->


<?php
  /*
    
<h2>7. Ne&#x017E;a - <span style="font-size:16px;">the string 'Ne&amp;#x017E;a' which is normalized Form C</span></h2>
<h2>8. <?php echo htmlEncode('Ne&#x017E;a'); ?> - <span style="font-size:16px;">htmlEncode of the string 'Ne&amp;#x017E;a' which is normalized Form C</span></h2>


$char_A_ring = "\xC3\x85"; // 'LATIN CAPITAL LETTER A WITH RING ABOVE' (U+00C5)
$char_combining_ring_above = "\xCC\x8A";  // 'COMBINING RING ABOVE' (U+030A)
 
$char_orig = 'A' . $char_combining_ring_above;
$char_norm = normalizer_normalize( 'A' . $char_combining_ring_above, Normalizer::FORM_C );
 
echo ( normalizer_is_normalized($char_orig, Normalizer::FORM_C) ) ? "normalized" : "not normalized";
echo '; ';
echo ( normalizer_is_normalized($char_norm, Normalizer::FORM_C) ) ? "normalized" : "not normalized";
*/
?>

  </body>
</html>
