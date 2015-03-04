<!DOCTYPE html>
<?php 
  include_once '../classes/SSFProgramPageParts.php'; 

  /* UPDATE THESE ITEMS as appropriate */
  SSFProgramPageParts::cachePage();            // for faster loading
  SSFProgramPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFProgramPageParts::setShowsEvent(35);      // the eventId for this program -- REALLY 31; 35 is for a single show event.
  SSFProgramPageParts::setHeaderTitleText('at the Boe, 2014');  // This is the official HTML head title. It appears in the tab.
  SSFProgramPageParts::setContentTitleText('Sans Souci at the Boe, 2014');  // The is the title of the page in the Content Area.
	SSFProgramPageParts::setProgramPicBorderWidthInPixels(1);  // This is the border width in pixels for the image for each work.
	SSFProgramPageParts::setProgramHighlightColor('#586caf');  // This is the border color for the image for each work.
	
	?>
	
	<h1>This is the content Header.</

<?php
  
  echo SSFProgramPageParts::endContentHeader();
//  SSFProgramPageParts::showWorks();
  echo SSFProgramPageParts::endPageBody();

      // Test Code 1/29/15
      // This block exercises SSFInit.
      $dbname = SSFInit::getDbName(); 
      $debug = new SSFDebug; 
      $debug->becho('dbname', $dbname, 1);
      // This block tests various PHP variables and methods.
      $debug->becho('__DIR__', __DIR__, 1);
      $debug->becho('__FILE__', __FILE__, 1);
      $debug->becho('PHP_URL_HOST', parse_url(SSFProgramPageParts::getHostName(), PHP_URL_HOST), 1);

/* Test results 1/30/15.      
      ** BECHO ** dbname: sanssouci
      ** BECHO ** __DIR__: /home/hamelbloom/dev.sanssoucifest.org/programPages
      ** BECHO ** __FILE__: /home/hamelbloom/dev.sanssoucifest.org/programPages/programBoe2014.php
      ** BECHO ** PHP_URL_HOST: dev.sanssoucifest.org
*/
