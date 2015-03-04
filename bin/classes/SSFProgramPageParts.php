

<?php

  spl_autoload_register('SSFProgramPageParts::my_autoloader');

  class SSFProgramPageParts {
    
    /* Modify the next two values depending on whether the site is live */
    private static $siteIsLive = false;
    
    private static $hostName = 'http://dev.sanssoucifest.org/';
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

//    public static function my_autoloader($class) { include self::$hostName . 'bin/classes/' . $class . '.php'; }
//    public static function my_autoloader($class) { include 'bin/classes/' . $class . '.php'; }
//    public static function my_autoloader($class) { include '../bin/classes/' . $class . '.php'; }
    public static function my_autoloader($class) { include __DIR__ . '/' . $class . '.php'; }
        
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
      $indent = '  ';
      $pageContent = '';
      $pageContent .= '<!-- BEGIN beginPageBody() -->' . PHP_EOL;
      $pageContent .= $indent . '<body>' . PHP_EOL;
      $pageContent .= $indent . '  <div class="page">' . PHP_EOL;

//      $pageContent .= $indent . '    <div class="pageBanner"><a href="../index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org"></a></div>' . PHP_EOL;
//      $pageContent .= $indent . '    <div class="pageBanner"><a href="../index.php" style="vertical-align:middle;margin-bottom:-10;"><img src="images/bannerImage2.png" alt="Sans Souci Festival of Dance Cinema, SansSouciFest.org" style="position:relative;left:0px;top:0px;z-index:-1;"></a></div>' . PHP_EOL;
      $pageContent .= $indent . '    <div class="pageBanner"><a href="../index.php"><img src="images/bannerImage4.png" alt="Sans Souci Festival of Dance Cinema, SansSouciFest.org"></a></div>' . PHP_EOL;
      $pageContent .= $indent . '    <div class="pageArea">' . PHP_EOL;
      $pageContent .= $indent . '      <div class="nav navArea">' . PHP_EOL; // nav navArea
      $pageContent .= SSFWebPageAssets::getNavBar();
      $pageContent .= $indent . '      </div>' . PHP_EOL;
      $pageContent .= $indent . '      <div class="content contentArea">' . PHP_EOL; // content contentArea
      $pageContent .= '<!-- END beginPageBody() -->' . PHP_EOL;
      return $pageContent;
    }
    
    public static function endPageBody() {
      $indent = '  ';
      $pageContent = '';
      $pageContent .= '<!-- BEGIN endPageBody() -->' . PHP_EOL;
      $pageContent .= $indent . '      </div>' . PHP_EOL; // <-- end content -->
      $pageContent .= $indent . '      <div style="clear: both;"></div>' . PHP_EOL; // <!-- clear float left -->
      $pageContent .= $indent . '    </div>' . PHP_EOL; // <-- end contentArea -->
      $pageContent .= $indent . '  </div>' . PHP_EOL; // <-- end pageArea -->
      $pageContent .= $indent . '  <div class="pageFooter">' . PHP_EOL; // footer pageFooter
      $pageContent .= SSFWebPageAssets::getCopyrightLine() . PHP_EOL;
      $pageContent .= $indent . '  </div>' . PHP_EOL; // <!-- end pageFooter -->
      $pageContent .= $indent . '  </div>' . PHP_EOL; // <!-- end page -->
      $pageContent .= $indent . '</body>' . PHP_EOL;
      $pageContent .= '<!-- END endPageBody() -->' . PHP_EOL;
      return $pageContent;      
    }

    public static function setContentColumnCount($columnCount=3) {  // Call this before beginContentHeader() when program pages render content in other than 3 table columns.
      self::$columnCount = $columnCount;
    }
    
    public static function beginContentHeader() {
      $indent = '    ';
      $contentHeader = '';
      $contentHeader .= $indent . '<!-- BEGIN beginContentHeader() -->' . PHP_EOL;
      $contentHeader .= $indent . '      <header>' . PHP_EOL;
      $contentHeader .= $indent . '        <div class="title">' . self::$contentTitleText . '</div>' . PHP_EOL;
      $contentHeader .= '<!-- END beginContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }

    public static function endContentHeader() {
      $indent = '    ';
      $contentHeader = '';
      $contentHeader .= $indent . '<!-- BEGIN endContentHeader() -->' . PHP_EOL;
      $contentHeader .= $indent . '      </header>' . PHP_EOL;
      $contentHeader .= $indent . '<!-- END endContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }

    private static function getImageDirectoryFiles() {
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
      return $imageDirectoryFiles;
    }
    
    private static function decorateScreeningProgramBottom() {
      echo '<div style="float:right;height:12px; width:12px;float:right;border-bottom:1px black solid;border-right:1px black solid;border-left:1px black solid;margin-right:1px;"></div>' . PHP_EOL;
    }

    public static function showWorks() {
      echo '<!-- BEGIN showWorks() -->' . PHP_EOL;

      // Get showId & shortDescription for each show in this event.
    	$showRows = SSFQuery::selectShowsFor(self::$showsEvent);
    	$showCount = count($showRows);

      $debug = new SSFDebug; 
      $debug->becho('showCount', $showCount, -1);
      $debug->belch('showRows', $showRows, -1);

    	// Get and display show descriptions as the page index iff there is more than one show in the event.
    	if ($showCount > 1) HTMLGen::progPageDisplayShowIndex($showRows);
    	    	
    	// Get the works from the database for display
    	$workRows = SSFQuery::selectWorksForEvent(self::$showsEvent);
    	
      // Get the list of images in the directories.
      $imageDirectoryFiles = self::getImageDirectoryFiles();
      
 	    echo '          <div class="eventProgram">' . PHP_EOL;

    	$workIndex = 0;
    	$showId = 0;

        // Display each work.
      	foreach($workRows as $workRow) {
      	  $workIndex++;
      	  if ($workRow['showId'] != $showId) {
      	    if ($showId != 0) {
        	    echo '            </div>' . PHP_EOL; // END the prior screeningProgram div
        	  }
      	    echo '            <div class="screeningProgram">' . PHP_EOL; // BEGIN the screeningProgram div
      	    $showId = $workRow['showId'];
      	    if ($showCount > 1) HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
      	  }
          HTMLGen::progPageDisplayWork($workIndex, $workRow, $imageDirectoryFiles, self::$programPicBorderWidthInPixels, self::$emptyImageDefaultHeightInPixels, self::$emptyImageDefaultWidthInPixels, true);
      	}
//      	echo '            </div>' . PHP_EOL; // END the prior screeningProgram div
 	    
 	    echo '          </div>' . PHP_EOL; // END eventProgram div
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