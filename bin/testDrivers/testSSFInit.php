<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS as appropriate */
  SSFWebPageParts::allowRobotIndexing(false);   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('exercise SSFInit');  // This is the official HTML head title. It appears in the tab.

  echo SSFWebPageParts::getHtmlLine();
  echo SSFWebPageParts::getHeader();
  echo SSFWebPageParts::beginPageBody($suppressNavArea=true);
  echo SSFWebPageParts::beginContentHeader();
	?>

            <h1>This is the content Header.</h1>

<?php
  
  echo SSFWebPageParts::endContentHeader();

  // Test Code 1/29/15
  // This block exercises SSFInit.
  $dbname = SSFInit::getDbName(); 
  $debug = new SSFDebug; 
  echo '<div>' . PHP_EOL;
  $debug->becho('dbname', $dbname, 1);
  // This block tests various PHP variables and methods.
  $debug->becho('__DIR__', __DIR__, 1);
  $debug->becho('__FILE__', __FILE__, 1);
  $debug->becho('PHP_URL_HOST', parse_url(SSFWebPageParts::getHostName(), PHP_URL_HOST), 1);
  echo '</div>' . PHP_EOL;

  echo SSFWebPageParts::endPageBody();

/* Test results 3/5/15
      ** BECHO ** dbname: sanssouci
      ** BECHO ** __DIR__: /home/hamelbloom/dev.sanssoucifest.org/bin/testDrivers
      ** BECHO ** __FILE__: /home/hamelbloom/dev.sanssoucifest.org/bin/testDrivers/testSSFInit.php
      ** BECHO ** PHP_URL_HOST: dev.sanssoucifest.org
*/
