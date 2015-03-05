<?php

  spl_autoload_register('SSFProgramPageParts::my_autoloader');
  
  class SSFProgramPageParts extends SSFWebPageParts {
    
    public static function setProgramPicBorderWidthInPixels($widthInPixels = 1) { self::$programPicBorderWidthInPixels = $widthInPixels; }

    public static function getProgramHighlightColor() { return self::$programHighlightColor; }
    public static function setProgramHighlightColor($color) { self::$programHighlightColor = $color; }
    
    private static $showsEvent = NULL;
    private static $showCount = NULL;
    private static $showRows = NULL;

    protected static $programHighlightColor = 'black';
    protected static $programPicBorderWidthInPixels = 0;

    private static $emptyImageDefaultHeightInPixels = '101';
    private static $emptyImageDefaultWidthInPixels = '180';

    public static function showsEvent() { return self::$showsEvent; }

    public static function setShowsEvent($eventId) { 
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
    	$showRows = self::getShowRows();
    	$showCount = self::getShowCount();

    	// Get and display show descriptions as the page index iff there is more than one show in the event.
    	if ($showCount > 1) HTMLGen::progPageDisplayShowIndex($showRows);
    	    	
    	// Get the works from the database for display
    	$workRows = SSFQuery::selectWorksForEvent(self::$showsEvent);
    	
      // Get the list of images in the directories.
      $imageDirectoryFiles = self::getImageDirectoryFiles();
      
    	$workIndex = 0;
    	$showId = 0;
    	
    	$indent = '          ';
      
      // OPEN eventProgram div
 	    echo $indent . '<div class="eventProgram">' . PHP_EOL;
 	    
 	    // Define relevant CSS styles
      echo $indent . '  <style type="text/css" scoped>' . PHP_EOL;
      echo $indent . '    <!--' . PHP_EOL;
      echo $indent . '    /* CSS inline style definitions that apply to this Program Page event as defined by calls to' . PHP_EOL;
      echo $indent . '       SSFProgramPageParts::setProgramPicBorderWidthInPixels() and SSFProgramPageParts::setProgramHighlightColor(). */' . PHP_EOL;
      echo $indent . '    .programHighlightColor { color:' . self::$programHighlightColor . ';border-color:' . self::$programHighlightColor . ';border-width:' . self::$programPicBorderWidthInPixels . 'px; } ' . PHP_EOL;
      echo $indent . '    -->' . PHP_EOL;
      echo $indent . '  </style>' . PHP_EOL;


      // Display each work.
    	foreach($workRows as $workRow) {
    	  $workIndex++;
    	  if ($workRow['showId'] != $showId) {
    	    if ($showId != 0) {
      	    echo $indent . '  </div> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram div
      	  }
    	    echo $indent . '  <div class="screeningProgram">' . PHP_EOL; // BEGIN the screeningProgram div
    	    $showId = $workRow['showId'];
    	    if ($showCount > 1) HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
    	  }
        HTMLGen::progPageDisplayWork($workIndex, $workRow, $imageDirectoryFiles, self::$programPicBorderWidthInPixels, self::$emptyImageDefaultHeightInPixels, self::$emptyImageDefaultWidthInPixels, true);
    	}
 	    
 	    // CLOSE eventProgram div
 	    echo $indent . '  </div> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram div
 	    echo $indent . '</div> <!-- end eventProgram -->' . PHP_EOL; 
      echo $indent . '<!-- END showWorks() -->' . PHP_EOL;
    }
  
  }
?>