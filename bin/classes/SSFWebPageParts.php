<?php

  spl_autoload_register('SSFWebPageParts::my_autoloader');
  
/*
mixed pathinfo ( string $path [, int $options = PATHINFO_DIRNAME | PATHINFO_BASENAME | PATHINFO_EXTENSION | PATHINFO_FILENAME ] ) - http://php.net/manual/en/function.pathinfo.php

REQUEST_URI - The URI which was given in order to access this page; for instance, '/index.html'

*/

  class SSFWebPageParts {
    private static $hostName = 'http://dev.sanssoucifest.org/';
    public static function getHostName() { return self::$hostName; }

    private static $siteIsLive = false;
        

    protected static $thisIsAProgramPage = false;    
//    public static function thisIsAProgramPage($soItIs) { self::$thisIsAProgramPage = $soItIs; }

    protected static $pageArticleId = 'EMPTY';             public static function getArticleId() { return self::$pageArticleId; }
    protected static $showsEvent = '';                     public static function getProgramPageEvent() { return self::$showsEvent; } // DEPRECATED TODO: replace occurances
                                                           public static function getProgramPageEventId() { return self::$showsEvent; }
    private   static $headerTitleText = '';                public static function setHeaderTitleText($text) { self::$headerTitleText = $text; } 
    private   static $contentTitleText = '';               public static function setContentTitleText($text) { self::$contentTitleText = $text; }
                                                           public static function getContentTitleText() { return self::$contentTitleText; } 
    protected static $showIndexLineBreaks = 0;             public static function useLineBreaksInShowIndex() { return (self::$showIndexLineBreaks == 1) ? true : false; } 
    protected static $showIndexPrefix = '';                // Text that precedes the Event Show Index on Program Pages, e.g., "Different programs for each date:"
    protected static $programPicBorderWidthInPixels = 0;   public static function getProgramPicBorderWidthInPixels() { return self::$programPicBorderWidthInPixels; } 
    protected static $programHighlightColor = 'black';     public static function getProgramHighlightColor() { return self::$programHighlightColor; }
    protected static $primaryTextColor = '';               public static function getPrimaryTextColor() { return self::$primaryTextColor; }
    protected static $secondaryTextColor = '';             public static function getSecondaryTextColor() { return self::$secondaryTextColor; }
    protected static $tertiaryTextColor = '';              public static function getTertiaryTextColor() { return self::$tertiaryTextColor; }
    protected static $quaternaryTextColor = '';            public static function getQuaternaryTextColor() { return self::$quaternaryTextColor; }
    
    protected static $emptyImageDefaultHeightInPixels = '101';  public static function getEmptyImageDefaultHeightInPixels() { return self::$emptyImageDefaultHeightInPixels; } 
    protected static $emptyImageDefaultWidthInPixels = '180';   public static function getEmptyImageDefaultWidthInPixels() { return self::$emptyImageDefaultWidthInPixels; } 

    private static $allowRobotIndexing = false;
    // If this method is not called or if $siteIsLive == false, robots will be directed to suppress indexing of this page.
    // Otherwise, if this method is called omitting the parameter value or if the parameter value is true, robots will be directed to index this page.
    // Otherwise, if the parameter value is false, robots will be directed to suppress indexing this page.
    public static function allowRobotIndexing($allowRobotIndexing = true) { self::$allowRobotIndexing = (self::$siteIsLive) ? $allowRobotIndexing : false; }

    private static $cssInlineStyleDefinitions = null;
    public static function addCssInlineStyleDefinition($text) { self::$cssInlineStyleDefinitions[] = $text; }

    private static $manifestString =  '';
    public static function manifestString() { return self::$manifestString; }

    public static function my_autoloader($class) { include __DIR__ . '/' . $class . '.php'; }
    
    public static function cachePage($doCache = false) { // HTML5 page caching is loaded with bugaboos, so we avoid it.
      SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
      // From http://www.massfxmedia.com/work.php, http://www.w3schools.com/html/html5_app_cache.asp and
      //      http://stackoverflow.com/questions/15228697/prevent-html5-page-from-caching-what-replaces-cache-control-pragmano-cache
      // Don't worry about this caching stuff. The default is the equivalent of the old pragma nocache.
      // Presumably this means that the page contents will not be cached as long as $doCache = false.
      self::$manifestString = ($doCache) ? ' manifest="' . self::$hostName . 'bin/data/sanssouci.appcache"' : '';
    }
    
    // Fix up hex character color ccodes that are missing the leading '#'
    private static function fixColor($colorCode) {
      $fixedCode = trim($colorCode);
      if (strlen($colorCode) == 6) {
        $hexChars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F", "a", "b", "c", "d", "e", "f");
        $chars = str_split($colorCode);
        foreach($chars as $char) { 
          if (!in_array($char, $hexChars)) { 
            SSFDebug::globalDebugger()->becho('fixColor() non-hex char encountered', $char, 1);
            return $fixedCode; // Sometimes RETURN from here
          } 
        } 
        $fixedCode = "#" . $fixedCode;
      }
      return $fixedCode;
    }
    
    public static function getFilename() {
      $fileMetadata = pathinfo($_SERVER["PHP_SELF"]);
     	SSFDebug::globalDebugger()->belch('initializePageParameters() fileMetadata', $fileMetadata, -1);
      $filename = $fileMetadata['basename'];
      return $filename; 
    }
    
    private static function initializePageParameters() {
      $fileMetadata = pathinfo($_SERVER["PHP_SELF"]);
     	SSFDebug::globalDebugger()->belch('initializePageParameters() fileMetadata', $fileMetadata, -1);
      $filename = $fileMetadata['basename'];
      $dirname = $fileMetadata['dirname'];
      $query = "SELECT id, directory, filename, articleId, eventId, allowRobots, headerTitle, contentTitle, shwNdxBr, showIndexPrefix, imageBorderWidth, "
             . "highlightColor, primaryTextColor, secondaryTextColor, tertiaryTextColor, quaternaryTextColor "
             . "FROM webPageParameters WHERE filename = '" . $filename . "' AND directory = '" . $dirname . "'";
//      SSFDB::debugNextQuery();
      $resultArrayArray = SSFDB::getDB()->getArrayFromQuery($query);
      if (count($resultArrayArray) == 1) {
        $resultArray = $resultArrayArray[0];
        SSFDebug::globalDebugger()->belch('$resultArray', $resultArray, -1);
        // Copy metadata values to class variables.
        // [id] => 1
        // [directory] => /
        // [filename] => index.php
  
        if (isset($resultArray['articleId']) && ($resultArray['articleId'] !== ''))                      { self::$pageArticleId =                  $resultArray['articleId']; }
        if (isset($resultArray['eventId']) && ($resultArray['eventId'] !== ''))                          { self::$showsEvent =                     $resultArray['eventId']; }
        if (isset($resultArray['allowRobots']) && ($resultArray['allowRobots'] !== ''))                  { self::allowRobotIndexing                (($resultArray['allowRobots'] == 1) ? true : false); }
        if (isset($resultArray['headerTitle']) && ($resultArray['headerTitle'] !== ''))                  { self::$headerTitleText =                $resultArray['headerTitle']; }
        if (isset($resultArray['contentTitle']) && ($resultArray['contentTitle'] !== ''))                { self::$contentTitleText =               $resultArray['contentTitle']; }
        if (isset($resultArray['shwNdxBr']) && ($resultArray['shwNdxBr'] !== ''))                        { self::$showIndexLineBreaks =            $resultArray['shwNdxBr']; }
        if (isset($resultArray['showIndexPrefix']) && ($resultArray['showIndexPrefix'] !== ''))          { self::$showIndexPrefix =                $resultArray['showIndexPrefix']; }
        if (isset($resultArray['imageBorderWidth']) && ($resultArray['imageBorderWidth'] !== ''))        { self::$programPicBorderWidthInPixels =  $resultArray['imageBorderWidth']; }
        if (isset($resultArray['highlightColor']) && ($resultArray['highlightColor'] !== ''))            { self::$programHighlightColor =          self::fixColor($resultArray['highlightColor']); }
        if (isset($resultArray['primaryTextColor']) && ($resultArray['primaryTextColor'] !== ''))        { self::$primaryTextColor =               self::fixColor($resultArray['primaryTextColor']); }
        if (isset($resultArray['secondaryTextColor']) && ($resultArray['secondaryTextColor'] !== ''))    { self::$secondaryTextColor =             self::fixColor($resultArray['secondaryTextColor']); }
        if (isset($resultArray['tertiaryTextColor']) && ($resultArray['tertiaryTextColor'] !== ''))      { self::$tertiaryTextColor =              self::fixColor($resultArray['tertiaryTextColor']); }
        if (isset($resultArray['quaternaryTextColor']) && ($resultArray['quaternaryTextColor'] !== ''))  { self::$quaternaryTextColor =            self::fixColor($resultArray['quaternaryTextColor']); }

        if ($debug=false) {
          SSFDebug::globalDebugger()->becho('$pageArticleId', self::$pageArticleId, 1);
          SSFDebug::globalDebugger()->becho('$showsEvent', self::$showsEvent, 1);
          SSFDebug::globalDebugger()->becho('$allowRobotIndexing', (self::$allowRobotIndexing) ? 'Allowed' : 'NOT allowed', 1);
          SSFDebug::globalDebugger()->becho('$headerTitleText', self::$headerTitleText, 1);
          SSFDebug::globalDebugger()->becho('$contentTitleText', self::$contentTitleText, 1);
          SSFDebug::globalDebugger()->becho('$showIndexLineBreaks', (self::useLineBreaksInShowIndex()) ? 'TRUE' : 'FALSE', 1);
          SSFDebug::globalDebugger()->becho('$showIndexPrefix', self::$showIndexPrefix, 1);
          SSFDebug::globalDebugger()->becho('$programPicBorderWidthInPixels', self::$programPicBorderWidthInPixels, 1);
          SSFDebug::globalDebugger()->becho('$programHighlightColor', self::$programHighlightColor, 1);
          SSFDebug::globalDebugger()->becho('$primaryTextColor', self::$primaryTextColor, 1);
          SSFDebug::globalDebugger()->becho('$secondaryTextColor', self::$secondaryTextColor, 1);
          SSFDebug::globalDebugger()->becho('$tertiaryTextColor', self::$tertiaryTextColor, 1);
          SSFDebug::globalDebugger()->becho('$quaternaryTextColor', self::$quaternaryTextColor, 1);
        }
      }
    }
    
    public static function beginPage() {
      self::initializePageParameters();
      echo SSFWebPageParts::getHtmlLine();
      echo SSFWebPageParts::getHeader();
      echo SSFWebPageParts::beginPageBody();
    }

    public static function endPage() {
      echo SSFWebPageParts::endPageBody();
    }

    public static function getHtmlLine() { return '<html lang="en"' . self::manifestString() . '>' . PHP_EOL; }

    public static function getHeader() {
      $displayCssStyleDefs = ((isset(self::$primaryTextColor) && (self::$primaryTextColor !== ''))
                           || (isset(self::$secondaryTextColor) && (self::$secondaryTextColor !== ''))
                           || (isset(self::$tertiaryTextColor) && (self::$tertiaryTextColor !== ''))
                           || (isset(self::$quaternaryTextColor) && (self::$quaternaryTextColor !== ''))
                           || (!is_null(self::$cssInlineStyleDefinitions) && (count(self::$cssInlineStyleDefinitions) !== 0)));
      $pageHeader = '';
      $pageHeader .= '  <head>' . PHP_EOL;
      $pageHeader .= self::getHeaderContent();
      if ($displayCssStyleDefs) {
        $pageHeader .= '    <style type="text/css">' . PHP_EOL;
        $pageHeader .= '      /* CSS inline style definitions added by prior calls to SSFWebPageParts::addCssInlineStyleDefinition(). */' . PHP_EOL;
        if (!is_null(self::$cssInlineStyleDefinitions) && (count(self::$cssInlineStyleDefinitions) !== 0)) {
          foreach (self::$cssInlineStyleDefinitions as $style) { $pageHeader .= '      ' . $style . PHP_EOL; }
        }
        if ((isset(self::$primaryTextColor) && (self::$primaryTextColor !== '')))       $pageHeader .= '      .primaryTextColor { color:' . self::$primaryTextColor . '; }' . PHP_EOL;
        if ((isset(self::$secondaryTextColor) && (self::$secondaryTextColor !== '')))   $pageHeader .= '      .secondaryTextColor { color:' . self::$secondaryTextColor . '; }' . PHP_EOL;
        if ((isset(self::$tertiaryTextColor) && (self::$tertiaryTextColor !== '')))     $pageHeader .= '      .tertiaryTextColor { color:' . self::$tertiaryTextColor . '; }' . PHP_EOL;
        if ((isset(self::$quaternaryTextColor) && (self::$quaternaryTextColor !== ''))) $pageHeader .= '      .quaternaryTextColor { color:' . self::$quaternaryTextColor . '; }' . PHP_EOL;
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
      if (self::$primaryTextColor !== '') {
        $headContent .= '      .contentArea .headerPart .title,' . PHP_EOL;
        $headContent .= '      .contentArea article h1 { color:' . self::$primaryTextColor . '; ?>; }' . PHP_EOL;
      }
      if (self::$secondaryTextColor !== '') $headContent .= '      .contentArea article h2 { color:' . self::$secondaryTextColor . '; ?>; }' . PHP_EOL;
//      $headContent .= '      a.special:link { color : #FFFF99; text-decoration: none; } ' . PHP_EOL;
//      $headContent .= '      a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */ ' . PHP_EOL;
//      $headContent .= '      a.special:hover { color : #990000; text-decoration: underline; } ' . PHP_EOL;
      $headContent .= '    </style>' . PHP_EOL;
      // TODO: Add these javascript files conditionally. For instance, we need dataEntry.js only when the user is entering data.
      $headContent .= '    <script src="bin/scripts/dataEntry.js" type="text/javascript"></script>' . PHP_EOL;
      $headContent .= '    <script src="bin/scripts/ssfDisplay.js" type="text/javascript"></script>' . PHP_EOL;
      $headContent .= '    <script src="bin/scripts/flyoverPopup.js" type="text/javascript"></script>' . PHP_EOL;
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
      $pageContent .= $indent . '    <div class="pageBanner"><a href="../index.php"><img src="images/bannerImage5.png" style="height:62px;width:735px;" alt="Sans Souci Festival of Dance Cinema, SansSouciFest.org"></a></div>' . PHP_EOL;
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
      $contentHeader .= $indent . '      </header>' . PHP_EOL;
      $contentHeader .= $indent . '    </div>' . PHP_EOL;
      $contentHeader .= $indent . '<!-- END endContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }
    
  } // END class SSFWebPageParts

?>