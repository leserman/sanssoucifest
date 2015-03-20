<?php

  spl_autoload_register('SSFProgramPageParts::my_autoloader');
  
  class SSFProgramPageParts extends SSFWebPageParts {
    
    public static function setProgramPicBorderWidthInPixels($widthInPixels = 1) { self::$programPicBorderWidthInPixels = $widthInPixels; }

    public static function setProgramHighlightColor($color) { self::$programHighlightColor = $color; }
    
    public static function setShowIndexPrefix($text) { self::$showIndexPrefix = $text; }
    
    public static function setComingSoonText($text) { self::$comingSoonText = $text; }
    
    protected static function isProgramPage() { return true; }
    
    protected static function headerStyle() { return ' style="margin-left:0px;"'; }

    private static $showCount = NULL;
    private static $showRows = NULL;
    private static $comingSoonText = 'Coming Soon...';

    public static function setShowsEvent($eventId) { 
      self::$thisIsAProgramPage = true;
      self::$showsEvent = $eventId;
      self::$showCount = NULL;
      self::$showRows = NULL;
    }
    
    private static function getShowCount() { 
      if (is_null(self::$showRows)) 
        self::$showRows = SSFQuery::selectShowsFor(self::$showsEvent);
      return count(self::$showRows); 
    }
    
    private static function getShowRows() {
      if (is_null(self::$showRows)) 
        self::$showRows = SSFQuery::selectShowsFor(self::$showsEvent);
      return self::$showRows;
    }
    
    public static function getImageDirectoryFiles() {
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

    public static function showIndex() {
      $showRows = self::getShowRows();
     	if (self::$showIndexPrefix != '') { echo '        <div class="showIndexText" style="font-size:15px;color:purple;maring-bottom:3px;">' . self::$showIndexPrefix . '</div>' . PHP_EOL; }			
    	// Get and display show descriptions as the page index iff there is more than one show in the event.
      	$showIndexText = HTMLGen::getProgPageShowIndex($showRows, $multiLine = self::useLineBreaksInShowIndex());
      	$padding = 'padding-bottom:24px;';
      	$align = 'left';
      	echo '        <div class="showIndexText dodeco" style="' . $padding . ';text-align:' . $align . ';">' . $showIndexText . '</div>' . PHP_EOL;
      }

    public static function showWorks($withIndex = true) {
      echo '<!-- BEGIN showWorks() -->' . PHP_EOL;
      $indent = '          ';
      // Get showId & shortDescription for each show in this event.
    	$showRows = self::getShowRows();
    	$showCount = self::getShowCount();
      if ($withIndex && ($showCount == 0)) {
        echo $indent . '<div class="programHighlightColor" style="font-size:20px;margin:140px 0 230px 0;text-align:center;">' . self::$comingSoonText . '</div>';
      } else {
        if ($withIndex && ($showCount > 1)) self::showIndex();
      	// Get the works from the database for display
      	$workRows = SSFQuery::selectWorksForEvent(self::$showsEvent);
        // Get the list of images in the directories.
      	$workIndex = 0;
      	$showId = 0;
        // OPEN eventProgram div
   	    echo $indent . '<div class="eventProgram">' . PHP_EOL;
   	    // Define relevant CSS styles
        $defineH1Color = (self::$primaryTextColor != '');
        $defineH2Color = (self::$secondaryTextColor != '');
        // TODO $hiddenHeading is supposed to be usefull when the below div is changed to article.
        $hiddenHeading = '<h1 style="visibility: hidden;">INVISIBLE but here to suppress the w3c article heading-missing warning.</h1>';
        $defineProgramHighlightColor = (self::$programHighlightColor !== '') &&  (self::$programPicBorderWidthInPixels !== 0);
        echo $indent . '  <style type="text/css" scoped>' . PHP_EOL;
        echo $indent . '    /* CSS inline style definitions that apply to this Program Page event as defined by color entries in table webPageParameters' . PHP_EOL;
        echo $indent . '        and calls to SSFProgramPageParts::setProgramPicBorderWidthInPixels() and SSFProgramPageParts::setProgramHighlightColor(). */' . PHP_EOL;
        if ($defineProgramHighlightColor) echo $indent . '    .programHighlightColor { color:' . self::$programHighlightColor . ';border-color:' . self::$programHighlightColor . ';border-width:' . self::$programPicBorderWidthInPixels . 'px; } ' . PHP_EOL;
        if ($defineH1Color)  echo $indent . '    .contentArea article h1 { color:' . self::$primaryTextColor . '; }' . PHP_EOL;
        if ($defineH2Color)  echo $indent . '    .contentArea article section h2 { color:' . self::$secondaryTextColor . '; }' . PHP_EOL;
        echo $indent . '  </style>' . PHP_EOL;
        // Display each work.
      	foreach($workRows as $workRow) {
      	  $workIndex++;
      	  if ($workRow['showId'] != $showId) {
      	    if ($showId != 0) {
        	    echo $indent . '  </div> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram div // TODO: SHOULD BE article but that screws formatting
        	  }
      	    $showId = $workRow['showId'];
//      	    echo $indent . '  <article id="' . HTMLGen::genShowIdTag($showId) . '" class="screeningProgram">' . $hiddenHeading . PHP_EOL; // BEGIN the screeningProgram article // TODO use article
      	    echo $indent . '  <div id="' . HTMLGen::genShowIdTag($showId) . '" class="screeningProgram">' . PHP_EOL; // BEGIN the screeningProgram div TODO: SHOULD BE article but that screws formatting
      	    if ($showCount > 1) HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
      	  }
          HTMLGen::progPageDisplayWork($showId, $workIndex, $workRow, $suppressOriginalFormat = true); 
          // self::$programPicBorderWidthInPixels, self::$emptyImageDefaultHeightInPixels, self::$emptyImageDefaultWidthInPixels, removed from prior call 3/17/15
      	}
   	    // CLOSE eventProgram div
   	    echo $indent . '  </div> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram div // TODO: SHOULD BE article but that screws formatting
   	    echo $indent . '</div> <!-- end eventProgram -->' . PHP_EOL; 
        echo $indent . '<!-- END showWorks() -->' . PHP_EOL;
      }
    }
  }
?>