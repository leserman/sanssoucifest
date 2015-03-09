<?php

  spl_autoload_register('SSFWebPageParts::my_autoloader');
  
  class SSFWebPageParts {
    private static $hostName = 'http://dev.sanssoucifest.org/';
    public static function getHostName() { return self::$hostName; }

    private static $headerTitleText = '';
    public static function setHeaderTitleText($text) { self::$headerTitleText = $text; }
  
    private static $contentTitleText = '';
    public static function setContentTitleText($text) { self::$contentTitleText = $text; }

    protected static $thisIsAProgramPage = false;    
//    public static function thisIsAProgramPage($soItIs) { self::$thisIsAProgramPage = $soItIs; }

    private static $cssInlineStyleDefinitions = null;
    public static function addCssInlineStyleDefinition($text) { self::$cssInlineStyleDefinitions[] = $text; }

    private static $manifestString =  '';
    public static function manifestString() { return self::$manifestString; }

    private static $siteIsLive = false;
        
    public static function my_autoloader($class) { include __DIR__ . '/' . $class . '.php'; }
    
    private static $allowRobotIndexing = false;
    // If this method is not called or if $siteIsLive == false, robots will be directed to suppress indexing of this page.
    // Otherwise, if this method is called omitting the parameter value or if the parameter value is true, robots will be directed to index this page.
    // Otherwise, if the parameter value is false, robots will be directed to suppress indexing this page.
    public static function allowRobotIndexing($allowRobotIndexing = true) { self::$allowRobotIndexing = (self::$siteIsLive) ? $allowRobotIndexing : false; }

    private static $pageHeaderTitleTextAlignment = 'topLeft';
    
    public static function cachePage($doCache = false) { // HTML5 page caching is loaded with bugaboos, so we avoid it.
      SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
      // From http://www.massfxmedia.com/work.php, http://www.w3schools.com/html/html5_app_cache.asp and
      //      http://stackoverflow.com/questions/15228697/prevent-html5-page-from-caching-what-replaces-cache-control-pragmano-cache
      // Don't worry about this caching stuff. The default is the equivalent of the old pragma nocache.
      // Presumably this means that the page contents will not be cached as long as $doCache = false.
      self::$manifestString = ($doCache) ? ' manifest="' . self::$hostName . 'bin/data/sanssouci.appcache"' : '';
    }
    
    public static function beginPage() {
      echo SSFWebPageParts::getHtmlLine();
      echo SSFWebPageParts::getHeader();
      echo SSFWebPageParts::beginPageBody();
    }

    public static function endPage() {
      echo SSFWebPageParts::endPageBody();
    }

    public static function getHtmlLine() { return '<html lang="en"' . self::manifestString() . '>' . PHP_EOL; }

    public static function getHeader() {
      $pageHeader = '';
      $pageHeader .= '  <head>' . PHP_EOL;
      $pageHeader .= self::getHeaderContent();
      if (!is_null(self::$cssInlineStyleDefinitions) && (count(self::$cssInlineStyleDefinitions) !== 0)) {
        $pageHeader .= '    <style type="text/css">' . PHP_EOL;
        $pageHeader .= '      /* CSS inline style definitions added by prior calls to SSFWebPageParts::addCssInlineStyleDefinition(). */' . PHP_EOL;
         foreach (self::$cssInlineStyleDefinitions as $style) {
          $pageHeader .= '      ' . $style . PHP_EOL;
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
      $headContent .= '      /* CSS inline style definitions hard-coded into SSFWebPageParts::htmlHeadContent() for items based on variables. */' . PHP_EOL;
//      $headContent .= '      a.special:link { color : #FFFF99; text-decoration: none; } ' . PHP_EOL;
//      $headContent .= '      a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */ ' . PHP_EOL;
//      $headContent .= '      a.special:hover { color : #990000; text-decoration: underline; } ' . PHP_EOL;
      $headContent .= '    </style>' . PHP_EOL;
      $headContent .= '    <script src="bin/scripts/ssfDisplay.js" type="text/javascript"></script>' . PHP_EOL;
      $headContent .= "    <link rel=icon href=favicon.png sizes='16x16' type='image/png'>" . PHP_EOL;
      return $headContent;
    }  

    public static function getCSSMediaQueries() {  
      return ''; // Narrow screen settings are shorted out for now.
      return '<link rel="stylesheet" media="only screen and (max-width: 677px) and (min-width: 250px)" href="' . self::$hostName . 'cvNarrowScreen.css" />' . PHP_EOL;
    }
    
    public static function beginPageBody($suppressNavArea=false) {
      $indent = '  ';
      $pageContent = '';
      $pageContent .= '<!-- BEGIN beginPageBody() -->' . PHP_EOL;
      $pageContent .= $indent . '<body>' . PHP_EOL;
      $pageContent .= $indent . '<div id="fb-root"></div>' . PHP_EOL; // See https://developers.facebook.com/docs/plugins/like-button
      $pageContent .= $indent . '  <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0"; fjs.parentNode.insertBefore(js, fjs); }(document, "script", "facebook-jssdk"));</script>' . PHP_EOL;
      $pageContent .= $indent . '  <div class="page">' . PHP_EOL;
      $pageContent .= $indent . '    <div class="pageBanner"><a href="../index.php"><img src="images/bannerImage4.png" alt="Sans Souci Festival of Dance Cinema, SansSouciFest.org"></a></div>' . PHP_EOL;
      $pageContent .= $indent . '    <div class="pageArea">' . PHP_EOL;
      if (!$suppressNavArea) {
        $pageContent .= $indent . '      <div class="nav navArea">' . PHP_EOL; // nav navArea
        $pageContent .= SSFWebPageAssets::getNavBar();
        $pageContent .= $indent . '      </div>' . PHP_EOL;
      }
      $pageContent .= $indent . '      <div class="content contentArea">' . PHP_EOL; // content contentArea
      $pageContent .= '<!-- END beginPageBody() -->' . PHP_EOL;
      return $pageContent;
    }
        
    public static function endPageBody() {
      $indent = '  ';
      $pageContent = '';
      $pageContent .= '<!-- BEGIN endPageBody() -->' . PHP_EOL;
      $pageContent .= $indent . '      </div> <!-- end contentArea -->' . PHP_EOL; // <!-- end contentArea -->
      $pageContent .= $indent . '      <div style="clear: both;"></div>' . PHP_EOL; // <!-- clear float left -->
      $pageContent .= $indent . '    </div> <!-- end pageArea -->' . PHP_EOL; // <!-- end pageArea -->
      $pageContent .= $indent . '    <div style="clear: both;"></div>' . PHP_EOL; // <!-- clear float left -->
      $pageContent .= $indent . '    <div class="pageFooter">' . PHP_EOL; // footer pageFooter
      $pageContent .= SSFWebPageAssets::getCopyrightLine() . PHP_EOL;
      $pageContent .= $indent . '    </div> <!-- end pageFooter -->' . PHP_EOL; // <!-- end pageFooter -->
      $pageContent .= $indent . '  </div> <!-- end page -->' . PHP_EOL; // <!-- end page -->
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
      $headerStyle = (self::$thisIsAProgramPage) ? ' style="margin-left:31px;"' : '';
      $contentHeader .= $indent . '<!-- BEGIN beginContentHeader() -->' . PHP_EOL;
      $contentHeader .= $indent . '      <div class="headerPart"' . $headerStyle . '><header>' . PHP_EOL;
      if (self::$contentTitleText !== '') $contentHeader .= $indent . '        <div class="title">' . self::$contentTitleText . '</div>' . PHP_EOL;
      $contentHeader .= '<!-- END beginContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }

    public static function endContentHeader() {
      $indent = '    ';
      $contentHeader = '';
      $contentHeader .= $indent . '<!-- BEGIN endContentHeader() -->' . PHP_EOL;
      $contentHeader .= $indent . '      </header></div>' . PHP_EOL;
      $contentHeader .= $indent . '<!-- END endContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }
    
  } // END class SSFWebPageParts

?>