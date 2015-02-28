<?php

  spl_autoload_register('SSFProgramPageParts::my_autoloader');

  class SSFProgramPageParts {
    
    /* Modify the next two values depending on whether the site is live */
    private static $siteIsLive = false;
    
//    private static $hostName = 'http://dev.sanssoucifest.org/';
    private static $hostName = 'http://sanssoucifest.local/';
    public static function getHostName() { return self::$hostName; }
  
// The following are unused.  
//    private static $rootPath = '/home/hamelbloom/dev.sanssoucifest.org';
//    public static function getRootPath() { return self::$rootPath; }
    
    private static $columnCount = 3; // Most program pages render content in 3 table columns.

    private static $headerTitleText = '';
    public static function setHeaderTitleText($text) { self::$headerTitleText = $text; }
    
    private static $contentTitleText = '';
    public static function setContentTitleText($text) { self::$contentTitleText = $text; }
    
    private static $cssInlineStyleDefinitions = null;
    public static function addCssInlineStyleDefinition($text) { self::$cssInlineStyleDefinitions[] = $text; }
    
    private static $allowRobotIndexing = false;
    // If this method is not called or if $siteIsLive == false, robots will be directed to suppress indexing of this page.
    // Otherwise, if this method is called omitting the parameter value or if the parameter value is true, robots will be directed to index this page.
    // Otherwise, if the parameter value is false, robots will be directed to suppress indexing this page.
    public static function allowRobotIndexing($allowRobotIndexing = true) { self::$allowRobotIndexing = (self::$siteIsLive) ? $allowRobotIndexing : false; }


    private static $pageHeaderTitleTextAlignment = 'topLeft';
    
    
    private static $programPicBorderWidthInPixels = 0;
    public static function setProgramPicBorderWidthInPixels($widthInPixels = 1) { self::$programPicBorderWidthInPixels = $widthInPixels; }

    private static $programHighlightColor = 'black';
    public static function getProgramHighlightColor() { return self::$programHighlightColor; }
    public static function setProgramHighlightColor($color) { self::$programHighlightColor = $color; }
    
    private static $showsEvent = 0;
    private static $showCount = 0;

    private static $manifestString =  '';
    public static function manifestString() { return self::$manifestString; }

    private static $emptyImageDefaultHeightInPixels = '101';
    private static $emptyImageDefaultWidthInPixels = '180';

    public static function my_autoloader($class) { include '../bin/classes/' . $class . '.php'; }
        
    public static function showsEvent() { return self::$showsEvent; }

    public static function setShowsEvent($eventId) { 
      self::$showsEvent = $eventId; 
      
      // Compute the number of shows in this event and save that value as a side-effect
      $showCountQuery = 'SELECT * FROM `shows` WHERE event = ' . self::$showsEvent;
      $showCountRows = SSFDB::getDB()->getArrayFromQuery($showCountQuery);
    	SSFDebug::globalDebugger()->belch('showCountRows', $showCountRows, -1);
    	self::$showCount = count($showCountRows);
    }
    
    public static function showCount() { return self::$showCount; }
        
    public static function getHtmlLine() { return '<html lang="en"' . self::manifestString() . '>' . PHP_EOL; }

    public static function cachePage($doCache = true) { 
      SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
      // From http://www.massfxmedia.com/work.php, http://www.w3schools.com/html/html5_app_cache.asp and
      //      http://stackoverflow.com/questions/15228697/prevent-html5-page-from-caching-what-replaces-cache-control-pragmano-cache
      // Don't worry about this caching stuff. The default is the equivalent of the old pragma nocache.
      // Presumably this means that the page contents will not be cached as long as $doCache = false.
      self::$manifestString = ($doCache) ? ' manifest="' . self::$hostName . 'bin/data/sanssouci.appcache"' : '';
    }

    public static function getHeader() {
      $pageHeader = '';
      $pageHeader .= '  <head>' . PHP_EOL;
      $pageHeader .= self::getHeaderContent();
      if (!is_null(self::$cssInlineStyleDefinitions)) {
        $pageHeader .= '    <style type="text/css">' . PHP_EOL;
        $pageHeader .= '          /* CSS inline style definitions go here. */' . PHP_EOL;
         foreach (self::$cssInlineStyleDefinitions as $style) {
          $pageHeader .= '         ' . $style . PHP_EOL;
        }
        $pageHeader .= '    </style>' . PHP_EOL;
      }
      $pageHeader .= self::getCSSMediaQueries();
      $pageHeader .= '  </head>' . PHP_EOL;
      return $pageHeader;
    }
    
    public static function getHeaderContent() { return self::htmlHeadContent(); }
    
    public static function htmlHeadContent() {
      $robotsDirectiveMetaTag = (!self::$allowRobotIndexing) ? '    <meta name="robots" content="noindex, nofollow">' . PHP_EOL : ''; // TODO: Should noarchive be in this list as it was prior to 1/29/15.
      $headContent = '';
      $headContent .= '    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . PHP_EOL;
      $headContent .= '    <base href="' . self::$hostName . '">' . PHP_EOL;
      $headContent .= '    <title>' . self::$headerTitleText . '</title>' . PHP_EOL;
      $headContent .= ($robotsDirectiveMetaTag === '') ? '' : $robotsDirectiveMetaTag; 
      $headContent .= '    <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">' . PHP_EOL;
      $headContent .= '    <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, '
                   .  'live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, '
                   .  'projected, tour, touring">' . PHP_EOL;
      $headContent .= '    <meta name="viewport" content="width=device-width">' . PHP_EOL; // alternately, content='width=device-width, initial-scale=1.0'
      $headContent .= '    <link rel="stylesheet" href="sanssouci.css" type="text/css">' . PHP_EOL;
      $headContent .= '    <style type="text/css">' . PHP_EOL;
//      $headContent .= '    <!--' . PHP_EOL;
      $headContent .= '      .programHighlightColor { color:' . self::$programHighlightColor . ';border-color:' . self::$programHighlightColor . ';border-width:' . self::$programPicBorderWidthInPixels . 'px; } ' . PHP_EOL;
//      $headContent .= '      .differentProgramsText { font-size:15px;margin:12px 0 -8px 0;line-height:120%;color:#E49548;font-weight:normal; } ' . PHP_EOL;
//      $headContent .= '      a.special:link { color : #FFFF99; text-decoration: none; } ' . PHP_EOL;
//      $headContent .= '      a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */ ' . PHP_EOL;
//      $headContent .= '      a.special:hover { color : #990000; text-decoration: underline; } ' . PHP_EOL;
//      $headContent .= '    -->' . PHP_EOL;
      $headContent .= '    </style>' . PHP_EOL;
      $headContent .= '    <script src="bin/scripts/ssfDisplay.js" type="text/javascript"></script>' . PHP_EOL;
      $headContent .= "    <link rel=icon href=favicon.png sizes='16x16' type='image/png'>" . PHP_EOL;
      return $headContent;
    }  

    public static function getCSSMediaQueries() {  
      return ''; // Narrow screen settings are shorted out for now.
      return '<link rel="stylesheet" media="only screen and (max-width: 677px) and (min-width: 250px)" href="' . self::$hostName . 'cvNarrowScreen.css" />' . PHP_EOL;
    }
    
    public static function beginPageBody() {
      $pageContent = '<!-- BEGIN beginPageBody() -->' . PHP_EOL;
      $pageContent .= '    <table style="width:100%;border:0;text-align:center;margin:0 auto;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '      <tr>' . PHP_EOL;
      $pageContent .= '        <td class="topCenter">' . PHP_EOL;
      $pageContent .= '          <table style="width:745px;border:0;border-collapse:collapse;text-align:center;margin:0 auto;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '            <tr>' . PHP_EOL;
      $pageContent .= '              <td colspan="3" style="text-align:left;vertical-align:top;margin:0;"><a href="../index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org" style="width:600px;height:63px;vertical-align:top;border:0;margin:8px 0;padding:0;"></a></td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '            </tr>' . PHP_EOL;
      $pageContent .= '            <tr>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:125px;">' . PHP_EOL;
      $pageContent .= SSFWebPageAssets::getNavBar();
      $pageContent .= '              </td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:600px;">' . PHP_EOL;
      $pageContent .= '                <table style="width:100%;text-align:center;margin:0;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '                  <tr>' . PHP_EOL;
      $pageContent .= '                    <td class="topLeft sprocketHoles" style="width:25px;padding:0;">&nbsp;</td>' . PHP_EOL; // was &nbsp;
      $pageContent .= '                    <td class="topLeft programTablePageBackground" style="width:10px;padding:0;">&nbsp;</td>' . PHP_EOL; // was &nbsp;
      $pageContent .= '                    <td class="topCenter bodyTextGrayLight" style="width:530px;;padding:0;">' . PHP_EOL;
      $pageContent .= '                      <table class="programTablePageBackground" style="width:100%;border:0;margin:0;padding:0;">' . PHP_EOL;

      $pageContent .= '<!-- END beginPageBody() -->' . PHP_EOL;
      return $pageContent;
    }
    
    public static function endPageBody() {
      $pageContent = '<!-- BEGIN endPageBody() -->' . PHP_EOL;
      $pageContent .= '                    </table>' . PHP_EOL;
      $pageContent .= '                  	</td>' . PHP_EOL;
      $pageContent .= '                   <td class="topLeft programTablePageBackground" style="width:10px;" ></td>' . PHP_EOL;
      $pageContent .= '                  	<td class="topLeft sprocketHoles" style="width:25px"></td>' . PHP_EOL;    
      $pageContent .= '                 </tr>' . PHP_EOL;
      $pageContent .= '               </table>' . PHP_EOL;
      $pageContent .= '             </td>' . PHP_EOL;
      $pageContent .= '             <td class="topCenter" style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '           </tr>' . PHP_EOL;
      $pageContent .= '           <tr class="topCenter">' . PHP_EOL;
      $pageContent .= '             <td colspan="2">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '             <td style="text-align:center;vertical-align:bottom;" class="smallBodyTextLeadedGrayLight"><br>' . PHP_EOL;
      $pageContent .= SSFWebPageAssets::getCopyrightLine() . '</td>' . PHP_EOL;
      $pageContent .= '             <td style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '           </tr>' . PHP_EOL;
      $pageContent .= '           <tr class="topCenter">' . PHP_EOL;
      $pageContent .= '             <td colspan="4">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '           </tr>' . PHP_EOL;
      $pageContent .= '         </table>' . PHP_EOL;
      $pageContent .= '       </td>' . PHP_EOL;
      $pageContent .= '     </tr>' . PHP_EOL;
      $pageContent .= '   </table>' . PHP_EOL;
      $pageContent .= '<!-- END endPageBody() -->' . PHP_EOL;
      return $pageContent;      
    }

    public static function setContentColumnCount($columnCount=3) {  // Call this before beginContentHeader() when program pages render content in other than 3 table columns.
      self::$columnCount = $columnCount;
    }
    
    public static function beginContentHeader() {
      $contentHeader = '<!-- BEGIN beginContentHeader() -->' . PHP_EOL;
      $contentHeader .= '                        <tr>' . PHP_EOL;
      $contentHeader .= '                          <td colspan="' . self::$columnCount . '" class="programPageTitleText ' . self::$pageHeaderTitleTextAlignment . '" style="padding-top:14px;">' . PHP_EOL;
      if (self::$contentTitleText !== '') $contentHeader .= '                          <div>' . self::$contentTitleText . '</div>' . PHP_EOL;
      $contentHeader .= '<!-- END beginContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }

    public static function endContentHeader() {
      $contentHeader = '<!-- BEGIN endContentHeader() -->' . PHP_EOL;
      $contentHeader .= '                          </td>' . PHP_EOL;
      $contentHeader .= '                        </tr>' . PHP_EOL;
      $contentHeader .= '<!-- END endContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }


    public static function showWorks() {
      echo '<!-- BEGIN showWorks() -->' . PHP_EOL;

    	// Get and display the show descriptions as the page index.
    	if (self::$showCount > 1) {
      	$showRows = SSFQuery::selectShowsFor(self::$showsEvent);
      	HTMLGen::progPageDisplayShowIndex($showRows);
    	}
    	
    	// Get the works from the database for display
//      SSFDB::debugNextQuery();
    	$workRows = SSFQuery::selectWorksForEvent(self::$showsEvent);
    	
      // Debug
    	SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);
    
      // Get the list of images in the directories.
      $imagesDirectories = SSFQuery::getStillImageDirectories();
      $imageDirectoryFiles = '';
      $codeBase = '../';
      $separator = '';
      foreach ($imagesDirectories as $imagesDirectory) {
        if ($handle = opendir($codeBase . $imagesDirectory)) {
        	SSFDebug::globalDebugger()->becho('$imagesDirectory', $imagesDirectory, -1);
          while (false !== ($file = readdir($handle))) {
          	SSFDebug::globalDebugger()->becho('$file', $file, -1);
            if ($file != '.' && $file != '..') { 
              $imageDirectoryFiles .= ($separator . $codeBase . $imagesDirectory . $file); 
              $separator = ', ';
            }
          }
          closedir($handle);
        }
      }
      
      // Debug
    	SSFDebug::globalDebugger()->belch('$imagesDirectories', $imagesDirectories, -1);
    	SSFDebug::globalDebugger()->becho('$imageDirectoryFiles', $imageDirectoryFiles, -1);
    
      // Display each work.
    	$index = 0;
    	$showId = 0;
    	foreach($workRows as $workRow) {
    	  $index++;
    	  if ($workRow['showId'] != $showId) {
          // Insert a name anchor for each show above the 1st work listed for that show to support the on-page navigation from the index of shows.
    	    $showId = $workRow['showId'];
    	    if (self::$showCount > 1) HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
    	    else HTMLGen::progPageDisplayNoDescription();
    	  }
        HTMLGen::progPageDisplayWork($index, $workRow, $imageDirectoryFiles, self::$programPicBorderWidthInPixels, self::$emptyImageDefaultHeightInPixels, self::$emptyImageDefaultWidthInPixels, true);
    	}

      echo '                      <tr>' . PHP_EOL;
      echo '                        <td colspan="3" class="topLeft programInfoText" style="padding-top:6px;">' . PHP_EOL;

      echo '<!-- END showWorks() -->' . PHP_EOL;
    }
  
  }

// SSFInit gets values from sanssouci.ini.
class SSFInit {
  
  private static $iniData = null;
  private static $failureNotice = 'Initialization failed.';
  private static $debugOn = false;
  
  public static function getDbName() { if (self::initialized()) return self::$iniData['database']['dbname']; else return $failureNotice; }
  public static function getDbUsername() { if (self::initialized()) return self::$iniData['database']['dbusername']; else return $failureNotice; }
  public static function getDbPW() { if (self::initialized()) return self::$iniData['database']['4DAMcdfss']; else return $failureNotice; }
  public static function getDbSchemaName() { if (self::initialized()) return self::$iniData['database']['sanssouci']; else return $failureNotice; }

  private static function initialized() {
    if (is_null(self::$iniData)) {
      $debug = new SSFDebug; 
      // Note that the next line will break if the web server does not provide the DOCUMENT_ROOT information. See http://php.net/manual/en/reserved.variables.server.php
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