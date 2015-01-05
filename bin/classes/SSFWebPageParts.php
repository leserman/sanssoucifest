<?php

  class SSFWebPageParts {
    private static $hostName = 'http://sanssoucifest.org/';
    private static $columnCount = 3; // Most program pages render content in 3 table columns.
    private static $pageFilename = '';
    private static $pageHeaderTitleText = '';
    private static $pageHeaderTitleTextAlignmentCSS = 'topLeft';
    private static $allowRobotIndexing = true;
    private static $allowCaching = false;
    private static $cacheString =  ''; 

    public static function cacheString() { return self::$cacheString; }
    
    public static function setPageHeaderTitleText($titleText) { self::$pageHeaderTitleText = $titleText; }
    public static function setPageHeaderTitleTextAlignment($textAlignmentCSSClass) { self::$pageHeaderTitleTextAlignmentCSS = $textAlignmentCSSClass; }
    
    public static function robotIndexingIsAllowed() { return self::$allowRobotIndexing; }
    public static function disallowRobotIndexing() { self::$allowRobotIndexing = false; }
    
    public static function allowCaching() { // default is true, pages may be cached
      self::$allowCaching = true;
      // From http://www.massfxmedia.com/work.php, http://www.w3schools.com/html/html5_app_cache.asp and
      //      http://stackoverflow.com/questions/15228697/prevent-html5-page-from-caching-what-replaces-cache-control-pragmano-cache
      // Don't worry about this caching stuff. The default is the equivalent of the old pragma nocache.
      // Presumably this means that the page contents will not be cached as long as $doCache = false.
      SSFProgramPageParts::$cacheString = ($doCache) ? ' manifest="' . self::$hostName . 'components/coopVillage.appcache"' : '';
    }

    public static function initializePage($location = "") { 
      self::$pageFilename = $location;
      SSFDebug::globalDebugger()->belch('_FILE_', self::$pageFilename, -1);
    }

    public static function beginHTML() {
      if (self::$allowCaching) $returnString = '<html lang="en" ' . SSFProgramPageParts::cacheString() . '>' . PHP_EOL;
      else $returnString = '<html lang="en">' . PHP_EOL;
      return $returnString;
    }

    public static function endHTML() {
      return '</html>' . PHP_EOL;
    }

    public static function endHead() {
      return '</head>' . PHP_EOL;
    }

    public static function htmlHeadContent() {
      $headContent = '<!-- BEGIN SSFWebPageParts::htmlHeadContent() -->' . PHP_EOL;
      $headContent .= '<head>' . PHP_EOL;
      $headContent .= '    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . PHP_EOL; // short form for HTML5 is <meta charset="utf-8">
//      $headContent .= '    <base href="' . self::$hostName . '">' . PHP_EOL;
      $headContent .= '    <title>' . self::$pageHeaderTitleText . ' || Sans Souci Festival of Dance Cinema' . '</title>' . PHP_EOL;
      $headContent .= (self::$allowRobotIndexing) ? '' : ('    <meta name="robots" content="noarchive, noindex, nofollow">' . PHP_EOL);
      $headContent .= '    <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">' . PHP_EOL;
      $headContent .= '    <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, '
                   .  'live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, '
                   .  'projected, tour, touring">' . PHP_EOL;
      $headContent .= '    <meta name="viewport" content="width=device-width">' . PHP_EOL; // alternately, content='width=device-width, initial-scale=1.0'
      $headContent .= '    <style type="text/css">' . PHP_EOL;
      $headContent .= '    <!--' . PHP_EOL;
      $headContent .= '      a.special:link { color : #FFFF99; text-decoration: none; } ' . PHP_EOL;
      $headContent .= '      a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */ ' . PHP_EOL;
      $headContent .= '      a.special:hover { color : #990000; text-decoration: underline; } ' . PHP_EOL;
      $headContent .= '    -->' . PHP_EOL;
      $headContent .= '    </style>' . PHP_EOL;
      $headContent .= '    <script src="' . self::$hostName . 'bin/scripts/ssfDisplay.js" type="text/javascript"></script>' . PHP_EOL;
      $headContent .= '    <link rel="stylesheet" href="' . self::$hostName . 'sanssouci.css" type="text/css">' . PHP_EOL;
      $headContent .= '    <link rel="stylesheet" href="' . self::$hostName . 'sanssouciBlackBackground.css" type="text/css">' . PHP_EOL;
      $headContent .= '    <link rel=icon href="' . self::$hostName . 'favicon.png" sizes="16x16" type="image/png">' . PHP_EOL;
      $headContent .= '<!-- END SSFWebPageParts::htmlHeadContent() -->' . PHP_EOL;
      return $headContent;
    }  

    public static function cssMediaQueries() {  
      return ''; // Narrow screen settings are shorted out for now.
      return '<link rel="stylesheet" media="only screen and (max-width: 677px) and (min-width: 250px)" href="' . self::$hostName . 'cvNarrowScreen.css" />' . PHP_EOL;
    }
    
    public static function beginPageBody() {
      $pageContent = '<!-- BEGIN SSFWebPageParts::beginPageBody() -->' . PHP_EOL;
      $pageContent .= '    <table style="width:100%;border:0;text-align:center;margin:0 auto;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '      <tr>' . PHP_EOL;
      $pageContent .= '        <td class="topCenter">' . PHP_EOL;
      $pageContent .= '          <table style="width:745px;border:0;border-collapse:collapse;text-align:center;margin:0 auto;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '            <tr>' . PHP_EOL;
      $pageContent .= '              <td colspan="3" style="text-align:left;vertical-align:top;margin:0;"><a href="' . self::$hostName . 'index.php"><img src="' . self::$hostName . 'images/titleBarGrayLight.gif" alt="SansSouciFest.org" style="width:600px;height:63px;vertical-align:top;border:0;margin:8px 0;padding:0;"></a></td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '            </tr>' . PHP_EOL;
      $pageContent .= '            <tr>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:10px;">&nbsp;</td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:125px;">' . PHP_EOL;
      $pageContent .= SSFWebPageAssets::getNavBar(SSFCodeBase::string(self::$pageFilename));
      $pageContent .= '              </td>' . PHP_EOL;
      $pageContent .= '              <td  class="topCenter" style="width:600px;">' . PHP_EOL;
      $pageContent .= '                <table style="width:100%;text-align:center;margin:0;padding:0;background-color:black;">' . PHP_EOL;
      $pageContent .= '                  <tr>' . PHP_EOL;
      $pageContent .= '                    <td class="topLeft sprocketHoles" style="width:25px;padding:0;">&nbsp;</td>' . PHP_EOL; // was &nbsp;
      $pageContent .= '                    <td class="topLeft programTablePageBackground" style="width:10px;padding:0;">&nbsp;</td>' . PHP_EOL; // was &nbsp;
      $pageContent .= '                    <td class="topCenter bodyTextGrayLight" style="width:530px;;padding:0;">' . PHP_EOL;
      $pageContent .= '                      <table class="programTablePageBackground" style="width:100%;border:0;margin:0;padding:0;">' . PHP_EOL;
      $pageContent .= '<!-- END SSFWebPageParts::beginPageBody() -->' . PHP_EOL;
      return $pageContent;
    }
    
    public static function endPageBody() {
      $pageContent = '<!-- BEGIN SSFWebPageParts::endPageBody() -->' . PHP_EOL;
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
      $pageContent .= '</body>' . PHP_EOL;
      $pageContent .= '<!-- END SSFWebPageParts::endPageBody() -->' . PHP_EOL;
      return $pageContent;      
    }

    public static function setContentColumnCount($columnCount=3) {  // Call this before beginContentHeader() when program pages render content in other than 3 table columns.
      self::$columnCount = $columnCount;
    }
    
    public static function beginContentHeader() {
      $contentHeader = '<!-- BEGIN SSFWebPageParts::beginContentHeader() -->' . PHP_EOL;
      $contentHeader .= '                        <tr>' . PHP_EOL;
      $contentHeader .= '                          <td colspan="' . self::$columnCount . '" class="' . self::$pageHeaderTitleTextAlignmentCSS . '" style="padding-top:14px;"><span class="programPageTitleText ' . self::$pageHeaderTitleTextAlignmentCSS . '">' . self::$pageHeaderTitleText . '</span><br>' . PHP_EOL;
      $contentHeader .= '<!-- END SSFWebPageParts::beginContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }

    public static function endContentHeader() {
      $contentHeader = '<!-- BEGIN SSFWebPageParts::endContentHeader() -->' . PHP_EOL;
      $contentHeader .= '                          </td>' . PHP_EOL;
      $contentHeader .= '                        </tr>' . PHP_EOL;
      $contentHeader .= '<!-- END SSFWebPageParts::endContentHeader() -->' . PHP_EOL;
      return $contentHeader;
    }
  
  }

?>