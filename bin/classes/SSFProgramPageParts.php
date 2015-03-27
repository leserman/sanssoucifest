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

  // From HTMLGen 3/26/15
  private static function genShowIdTag($showId) {
    return 'show' . $showId;
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

  // From HTMLGen 3/26/15
  private static function progPageDisplayShowIndexX($showArray, $comingSoonText='Coming Soon...', $center=false, $multiLine=false, $noPadding=false) {
    self::debugger()->belch('displayShowIndex($showArray)', $showArray, -1);
    $align = ($center) ? 'center' : 'left';
//    echo '<div>'; // line REMOVED 3/2/15
//    $padding = ($noPadding) ? '0' : '20px 0 24px 0'; // 3/3/15
    $padding = ($noPadding) ? '0' : '0 0 24px 0';
    echo '          <div class="bodyText, eventIndexText" style="padding:' . $padding . ';text-align:' . $align . ';">';
    if ((sizeOf($showArray) > 0) && !$multiLine) { echo '|'; }
    foreach ($showArray as $show) {
      echo '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '#' . self::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>'; // changed 3/4/15
      echo ($multiLine) ? '<br>' : '&nbsp;|';
    }
    if (sizeOf($showArray) > 0) echo '&nbsp;&nbsp;'; 
    else echo '<div class="programHighlightColor" style="font-size:20px;margin:140px 0 230px 0;text-align:center;">' . $comingSoonText . '</div>';
   echo '          </div>' . PHP_EOL; // end div eventIndexText
  }

  // From HTMLGen 3/26/15
  private static function getProgPageShowIndex($showArray, $multiLine=false) {
    $showIndexText = '';
    SSFDebug::globalDebugger()->becho('getProgPageShowIndex() multiLine', ($multiLine) ? 'TRUE' : 'FALSE', -1);
    if ((sizeOf($showArray) > 0) && !$multiLine) { $showIndexText .= '|'; }
    foreach ($showArray as $show) {
      $showIndexText .= '&nbsp;<a href="' . $_SERVER['PHP_SELF'] . '#' . self::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>'; // changed 3/4/15
      $showIndexText .= ($multiLine) ? '<br>' : '&nbsp;|';
    }
   return $showIndexText;
  }

  // From HTMLGen 3/26/15
  private static function progPageDisplayShowDescription($showId, $text) {
    echo '              <h1 class="showDescriptionHeader">' . $text . '</h1>' . PHP_EOL; // 3/17/15
  }
  
  // From HTMLGen 3/26/15
  // progPageDisplayNoDescription() is just cosmetic to add some vertical space.
  private static function progPageDisplayNoDescription($height=20) {
    echo '              <h1 class="showDescriptionHeader" style="display:none;">This is a deliberately empty heading to satisfy the HTML5 validator.</h1>' . PHP_EOL; // 3/23/15
  }





  // From HTMLGen 3/26/15
/*  public static function progPageDisplayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, 
                       $emptyImageDefaultHeightInPixels, $emptyImageDefaultWidthInPixels, $suppressOriginalFormat=false) {  3/17/15 */
  private static function progPageDisplayWork($showId, $index, $workRow, $suppressOriginalFormat=false) {
    $filmInfoDivSpanText = '<div class="filmInfoText"><span class="filmInfoSubtitleText">';
    $title = $workRow['title'];
    
    // define image parameters
    // NOTE: do not use $workRow['tablename.whatever'], just use $workRow['whatever']
    if ($workRow['fileName'] != '') {
      $imageFileName = $workRow['fileName'];
//      $imageDirectory  = '../' . $workRow['directory'];
      $imageDirectory  = $workRow['directory'];
      $imageHeightInPixels = $workRow['heightInPixels'];
      $imageWidthInPixels = $workRow['widthInPixels'];
      if (stripos(SSFProgramPageParts::getImageDirectoryFiles(), $imageDirectory . $imageFileName) === false) {
        $imageDirectory = 'images/'; // 3/17/15 Changed from ../images/
        $imageTitleText = 'File ' . $imageDirectory . $imageFileName . ' is missing.';
        $imageFileName = 'emptyImage.gif';
        $imageHeightInPixels = SSFProgramPageParts::getEmptyImageDefaultHeightInPixels();    // $emptyImageDefaultHeightInPixels;
        $imageWidthInPixels = SSFProgramPageParts::getEmptyImageDefaultWidthInPixels();     // $emptyImageDefaultWidthInPixels;
        $imageAltText = '';
        $imageCaption = '';
      } else {
        $imageTitleText = $imageAltText = HTMLGen::htmlEncode($workRow['altText']); // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here? NOTE: validation error if not called. Text disappears if called.
        $imageCaption = HTMLGen::htmlEncode($workRow['caption']); // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here? NOTE: validation error if not called. Text disappears if called.
      }
    } else {
      $imageFileName = 'emptyImage.gif';
      $imageDirectory = '../images/';
      $imageHeightInPixels = SSFProgramPageParts::getEmptyImageDefaultHeightInPixels();  // $emptyImageDefaultHeightInPixels;
      $imageWidthInPixels = SSFProgramPageParts::getEmptyImageDefaultWidthInPixels();   // $emptyImageDefaultWidthInPixels;
      $imageTitleText = $imageAltText = '';
      $imageCaption = '';
    }

    // define $yearProduced
    $yearProduced = $workRow['yearProduced'];
    if ($yearProduced == '0000' || $yearProduced == '9999') $yearProduced = '';

    // compute $runTimeMinutes
    list($hours, $minutes, $seconds) = sscanf($workRow['runTime'], "%d:%d:%d");
    $runTimeMinutes = $minutes + (60 * $hours);
    if ($seconds >= 31) $runTimeMinutes++; 
    // while ($runTime[0] == '0' || $runTime[0] == ':') $runTime = substr($runTime, 1);
    
    // define $originalFormat
    $originalFormat = (!isset($workRow['originalFormat']) || $workRow['originalFormat'] == '' 
                           || $workRow['originalFormat'] == 'selectSomething') ? '' : $workRow['originalFormat'];
    if ($suppressOriginalFormat) $originalFormat = ''; // Added 2/6/14 to suppress original format info

    // define existential vaviables to be used for inserting commas
    $yearProducedExists = isset($yearProduced) && $yearProduced != '';
    $liveTextExists = ($workRow['includesLivePerformance'] == 1);
    $runTimeMinutesExists = isset($runTimeMinutes) && $runTimeMinutes != 0;
    $originalFormatExists = ($originalFormat != '');
    
    // define $liveText depending on whether it includes live performance
    $liveText = (($liveTextExists) ? '<span class="filmLiveText">includes live performance' . (($runTimeMinutesExists || $originalFormatExists) ? ', ' : '') . '</span>' : '');
    
    // define $synopsis
    // TODO htmlEncode 3/18/15 - When htmlEncode is called, items like '<i>' in the text are ourput literally rather than as html commands.
    $synopsis = HTMLGen::htmlEncode(HTMLGen::getSynopsisFrom($workRow)); // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here? NOTE: validation error if not called. Text disappears if called.
    $synopsisTitle = ($suppressOriginalFormat) ? '' : 'Synopsis: '; // This is a kludgy use of $suppressOriginalFormat which was not originally intended.
    
/*  TODO: This hack is in relation to the task "Add two more Other Roles - they seem to be needed."
    This block was an attempt to figure out why I could not put an anchor tag into the synopsis.
    Answer: htmlEncode changed the quotes with the tag to special characters.
    Additionally, when first entering the quoted string adminDataEntry, escape characters for the quotes were pre-filtered before DB storage.
    if ($workRow['workId'] == 869) {
      self::debugger()->becho('$synopsis', $synopsis, 1);
      self::debugger()->becho('HTMLGen::htmlEncode(synopsis)', HTMLGen::htmlEncode($synopsis), 1); // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
    }
*/

    // define $cityStateCountry
    $cityStateCountry = '';
    // As of 3/30/12 we are using countryOfProduction instead of cityStateCountry if countryOfProduction exists.
    if ((!is_null($workRow['countryOfProduction'])) && ($workRow['countryOfProduction'] !== '')) {
      $cityStateCountry = $workRow['countryOfProduction'];
    } else {
      $separator = '';
      $city = $workRow['city'];
      if ($city != '' ) { 
        $cityStateCountry = $city; 
        $separator = ', '; 
      }
      $stateProvRegion = $workRow['stateProvRegion'];
      if ($stateProvRegion == $city) $stateProvRegion = '';
      if ($stateProvRegion != '') {
        $cityStateCountry .= $separator . $stateProvRegion;
        $separator = ', '; 
      }
      if ($workRow['country'] != '') $cityStateCountry .= $separator . $workRow['country'];
    }
    
    // define Contributor Displays
    //SSFDB::debugNextQuery();
    $contributorSelectAllRows = SSFQuery::selectContributorsFor($workRow['workId'], $useListingOrder = true);
    $contributorRowsDisplayed = 0;
    $director = '';
    $producer = '';
    $choreographer = '';
    $danceCompany = '';
    $principalDancers = '';
    $musicComposer = ''; 
    $musicPerformer = '';
    $camera = '';
    $editor = '';
    $contributorRole1 = '';
    $contributorName1 = '';
    $contributorRole2 = '';
    $contributorName2 = '';
    $contributorRole3 = '';
    $contributorName3 = '';
    foreach ($contributorSelectAllRows as $contributorRow) { 
      // TODO - It's not clear that using utf8_encode() is the right thing to do here! 
      //        The characters get mangled if they're already UTF-8. 11/15/14
      $properlyCodedName = utf8_encode($contributorRow['name']);        // TODO Which is it? THIS?
      // Maybe I should be using htmlentities(). 11/15/14
      $properlyCodedName = HTMLGen::htmlEncode($contributorRow['name']); // Which is it? OR THIS?
//      $properlyCodedName = $contributorRow['name'];                     // Which is it? OR THIS?
// TODO: Really, when the displayXXX functions get converted to the getXXX versions, I should apply htmlEntitites to the return string before it gets echoed.
      SSFDebug::globalDebugger()->belch('Contributor', $contributorRow['role'] . ': ' . $properlyCodedName, -1);
      if ($contributorRow['role'] == 'Director') $director = $properlyCodedName;
      else if ($contributorRow['role'] == 'Producer') $producer = $properlyCodedName;
      else if ($contributorRow['role'] == 'Choreographer') $choreographer = $properlyCodedName;
      else if ($contributorRow['role'] == 'DanceCompany') $danceCompany = $properlyCodedName;
      else if ($contributorRow['role'] == 'PrincipalDancers') $principalDancers = $properlyCodedName;
      else if ($contributorRow['role'] == 'MusicComposition') $musicComposer = $properlyCodedName; 
      else if ($contributorRow['role'] == 'MusicPerformance')  $musicPerformer = $properlyCodedName;
      else if ($contributorRow['role'] == 'Camera')  $camera = $properlyCodedName;
      else if ($contributorRow['role'] == 'Editor')  $editor = $properlyCodedName;
      else if ($contributorRole1 == "") {
        $contributorRole1 = $contributorRow['roleDescription']; // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
        $contributorName1 =  $properlyCodedName;
      } else if ($contributorRole2 == "") {
        $contributorRole2 = $contributorRow['roleDescription']; // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
        $contributorName2 =  $properlyCodedName;
      } else {
        $contributorRole3 = $contributorRow['roleDescription']; // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
        $contributorName3 =  $properlyCodedName;
      }
    }
    SSFDebug::globalDebugger()->belch('editor', $editor, -1);
    $prodEqDir = ($director == $producer);
    $chorEqDancer = ($choreographer == $principalDancers);
    $performerEqComposer = ($musicComposer == $musicPerformer);
    $cameraEqEditor = ($camera == $editor);

    $webSite = ((isset($workRow['webSite'])) ? $workRow['webSite'] : '');
    if ($webSite  != '' && strripos($webSite, 'http') === false) $webSite = 'http://' . $webSite;
    if ($webSite != '') switch ($workRow['webSitePertainsTo']) {
      case "director":      $director = "<a class=\"dodeco\" href='" . $webSite . "'>" . $director . "</a>"; break; // 3/17/15 added class=\"dodeco\" 5 times
      case "producer":      $producer = "<a class=\"dodeco\" href='" . $webSite . "'>" . $producer . "</a>"; 
                            if ($prodEqDir) $director = $producer; // make sure the producer-associated website also applies to the director 
                            break;
      case "choreographer": $choreographer = "<a class=\"dodeco\" href='" . $webSite . "'>" . $choreographer . "</a>"; break;
      case "company":       $danceCompany = "<a class=\"dodeco\" href='" . $webSite . "'>" . $danceCompany . "</a>"; break;
      case "movie":         $title = "<a class=\"dodeco\" href='" . $webSite . "'>" . $title . "</a>"; break;
    }

    $directorTitle = ($prodEqDir) ? 'Produced and Directed by ' : 'Directed by ';
    $directorDisplay = ($director == '') ? '<!-- No director given. -->' 
                                         : $filmInfoDivSpanText . $directorTitle . ' </span>' . $director . '</div>';
    $producerDisplay = ($producer == '') ? '<!-- No producer given. -->' 
                                          : (($prodEqDir) ? '<!-- Producer same as director. -->'
                                                         : $filmInfoDivSpanText . 'Produced by </span>' . $producer . '</div>'); 
    $choreoTitle = ($chorEqDancer) ? 'Choreography and dancing by ' : 'Choreography by ' ;    
    $choreoDisplay = ($choreographer == '') ? '<!-- No choreographer given. -->'
                                            : $filmInfoDivSpanText . $choreoTitle . '</span>' . $choreographer . '</div>';
    $companyDisplay = ($danceCompany == '') ? '<!-- No company given. -->'
                                            : $filmInfoDivSpanText . 'Featuring </span>' . $danceCompany . '</div>';
    $dancersDisplay = ($principalDancers == '') ? '<!-- No dancers given. -->'
                                                : (($chorEqDancer) ? '<!-- Dancer is choreographer. -->'
                                                                  : $filmInfoDivSpanText . 'Dancing by </span>' 
                                                                                         . $principalDancers . '</div>');
    $cameraTitle = ($cameraEqEditor) ? 'Filmmaker: ' : 'Cinematography by ';
    $cameraDisplay = ($camera ==  '') ? '<!-- No camera given. -->'
                                                : $filmInfoDivSpanText . $cameraTitle . ' </span>' . $camera . '</div>';
    $editorDisplay = ($editor ==  '') ? '<!-- No editor given. -->'
                                                 : (($cameraEqEditor) ? '<!-- Camera same as editor. -->'
                                                                          : $filmInfoDivSpanText . 'Edited by </span>' 
                                                                                                 . $editor . '</div>');
    $musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
    $musicCompDisplay = ($musicComposer ==  '') ? '<!-- No composer given. -->'
                                                : $filmInfoDivSpanText . $musicTitle . ' </span>' . $musicComposer . '</div>';
    $musicPerfDisplay = ($musicPerformer ==  '') ? '<!-- No music performer given. -->'
                                                 : (($performerEqComposer) ? '<!-- Music composer same as performer. -->'
                                                                          : $filmInfoDivSpanText . 'Music performed by </span>' 
                                                                                                 . $musicPerformer . '</div>');
    $otherContributor1Display = ($contributorRole1 == '') ? '<!-- No 1st other given. -->'
                                                          : $filmInfoDivSpanText . $contributorRole1 . ' by </span>' 
                                                                                 . $contributorName1 . '</div>';
    $otherContributor2Display = ($contributorRole2 == '') ? '<!-- No 2nd other given. -->'
                                                          : $filmInfoDivSpanText . $contributorRole2 . ' by </span>' 
                                                                                 . $contributorName2 . '</div>';
    // TODO: Fix this sloppy hack
    // This hack is in relation to the task "Add two more Other Roles - they seem to be needed."
    // In this case, this item is conditionally a link when $workRow['workId'] == 869.
    $otherContributor3Display = ($contributorRole3 == '') ? '<!-- No 3rd other given. -->'
                                                          : $filmInfoDivSpanText . $contributorRole3 . ' by </span>' 
                                                                                 . (($workRow['workId'] == 869) ? '<a href=\'http://DancesMadeToOrder.com\'>' : '')
                                                                                 . $contributorName3 
                                                                                 . (($workRow['workId'] == 869) ? '</a>' : '')
                                                                                 . '</div>';
    
    $useWorkNameId = ($workRow['designatedId'] != '00-000'); // HACK: omit the element id if this is an intermission, i.e., workId == '00-000'
    $showIdTag = self::genShowIdTag($showId);
    $workNameIdString = ($useWorkNameId) ? ('id="' . $showIdTag . '_work' . $workRow['designatedId'] . '"') : '';  // 3/17/15 changed format of id value from 'work_99-999' to 'work99-999'.    
    $programPicBorderWidth = SSFProgramPageParts::getProgramPicBorderWidthInPixels();
    $emptyImageDefaultHeightInPixels = SSFProgramPageParts::getEmptyImageDefaultHeightInPixels();
    $emptyImageDefaultWidthInPixels = SSFProgramPageParts::getEmptyImageDefaultWidthInPixels();
    $indent = '            ';
    echo '<!-- BEGIN Web #' . $index . ', Film ' . $workRow['designatedId'] . ' (' . $workRow['workId'] . '), "' . $workRow['title'] . '" ' . $workRow['shortDescription'] 
                      . ' #' . $workRow['showOrder'] . ' -->' . PHP_EOL;
    echo $indent . '  <section ' . $workNameIdString . ' class="filmDescriptionCell">' . PHP_EOL; // 3/17/15 changed div to section
    $hideOverflow = ($imageCaption != '') ? 'overflow:hidden;' : '';
    $hideOverflow = ''; // TODO: Decide if this overflow:hidden is helpful or if its causing the border edges to be too narrow sometimes.
    echo $indent . '    <div class="imagePart">' . PHP_EOL;
    echo $indent . '      <div  style="width:' . ($imageWidthInPixels+(2*$programPicBorderWidth)) . 'px;float:right;' . $hideOverflow . '">' . PHP_EOL;
    echo $indent . '        <img class="programHighlightColor" src="' . $imageDirectory . $imageFileName . '" alt="' . $imageAltText . '" title="' . $imageTitleText . '" style="height:'
                 . $imageHeightInPixels . 'px;width:' . $imageWidthInPixels . 'px;border:' . $programPicBorderWidth . 'px solid;margin:0 2px;margin-left:1px;">' . PHP_EOL;
    if ($imageCaption != '') echo '      <div class="figCaption">' . $imageCaption . '</div>';  // 10/09/14 added overflow:hidden; removed <br clear="all"> before <div...
    echo $indent . '      </div> <!-- figure frame -->' . PHP_EOL;
    echo $indent . '    </div> <!-- end imagePart -->' . PHP_EOL;
    echo $indent . '    <div class="textPart">' . PHP_EOL . $indent . '      <h2 class="filmTitleText">'
              . $title . (($yearProducedExists || $liveTextExists || $runTimeMinutesExists || $originalFormatExists) ? ', ' : '')
              . (($yearProducedExists) ? '<span class="filmYearText">' . $yearProduced . (($liveTextExists || $runTimeMinutesExists || $originalFormatExists) ? ', ' : '') . '</span>' : '')
              . $liveText
              . (($runTimeMinutesExists) ? '<span class="filmRunTimeText">' . $runTimeMinutes . ' min' . (($originalFormatExists) ? ', ' : '') . '</span>' : '')
              . '<span class="filmFormatText">' . $originalFormat . '</span></h2>' . PHP_EOL;
    echo $indent . '      ' . $directorDisplay . PHP_EOL;
    echo $indent . '      ' . $producerDisplay . PHP_EOL;
    echo $indent . '      ' . $choreoDisplay . PHP_EOL;
    echo $indent . '      ' . $companyDisplay . PHP_EOL;
    echo $indent . '      ' . $dancersDisplay . PHP_EOL;
    echo $indent . '      ' . $musicCompDisplay . PHP_EOL;
    echo $indent . '      ' . $musicPerfDisplay . PHP_EOL;
    echo $indent . '      ' . $cameraDisplay . PHP_EOL;
    echo $indent . '      ' . $editorDisplay . PHP_EOL;
    echo $indent . '      ' . $otherContributor1Display . PHP_EOL;
    echo $indent . '      ' . $otherContributor2Display . PHP_EOL;
    echo $indent . '      ' . $otherContributor3Display . PHP_EOL;
    if ($suppressOriginalFormat) { // KLUDGE
      echo $indent . '      ' . $filmInfoDivSpanText . $synopsisTitle . '</span>' . '<span class="synopsis">' . $synopsis . "</span>" // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
                    . (($cityStateCountry != '') ? '<span class="filmCityStateCountryText" style="font-style:normal;"> (' . HTMLGen::htmlEncode($cityStateCountry) . ')</span>' : '') . '</div>' . PHP_EOL; 
// TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
    } else {
      echo $indent . '      ' . $filmInfoDivSpanText . $synopsisTitle . '</span>' . '<span style="font-style:normal;">' . $synopsis . "</span>" // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
                    . (($cityStateCountry != '') ? '<span class="filmCityStateCountryText"> (' . HTMLGen::htmlEncode($cityStateCountry) . ')</span>' : '') . '</div>' .  PHP_EOL; // TODO 11/18/14 Should HTMLGen::htmlEncode() be called here?
    }
    echo $indent . '    </div> <!-- end textPart -->' . PHP_EOL;
    echo $indent . '    <div style="clear:both"></div>' . PHP_EOL;
    echo $indent . '  </section> <!-- END Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . PHP_EOL; // 3/17/15 Changed /div to /section
//    echo '<!--   END Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . PHP_EOL;
  }
  
    public static function showIndex() {
      $showRows = self::getShowRows();
     	if (self::$showIndexPrefix != '') { echo '        <div class="showIndexText" style="font-size:15px;color:purple;maring-bottom:3px;">' . self::$showIndexPrefix . '</div>' . PHP_EOL; }			
    	// Get and display show descriptions as the page index iff there is more than one show in the event.
      	$showIndexText = self::getProgPageShowIndex($showRows, $multiLine = self::useLineBreaksInShowIndex());
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
        // NOTE Creating a $hiddenHeading as the first element of the screeningProgram section could be useful if the w3c Validator complains of the lack of such heading.
        $hiddenHeading = '<h1 style="visibility: hidden;">INVISIBLE but here to suppress the w3c article heading-missing warning.</h1>';
        $hiddenHeading = ''; // NOTE For now, the $hiddenHeading is disabled by setting it to ''
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
        	    echo $indent . '  </article> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram article
        	  }
      	    $showId = $workRow['showId'];
      	    if ($hiddenHeading !== '') echo $indent . '  <article id="' . self::genShowIdTag($showId) . '" class="screeningProgram">' . $hiddenHeading . PHP_EOL;
      	    echo $indent . '  <article id="' . self::genShowIdTag($showId) . '" class="screeningProgram">' . PHP_EOL; // BEGIN the screeningProgram article
      	    if ($showCount > 1) self::progPageDisplayShowDescription($showId, $workRow['showDescription']);
      	    else self::progPageDisplayNoDescription();
      	  }
          self::progPageDisplayWork($showId, $workIndex, $workRow, $suppressOriginalFormat = true); 
      	}
   	    // CLOSE screeningProgram article and the enclosing eventProgram div.
   	    echo $indent . '  </article> <!-- end screeningProgram -->' . PHP_EOL; // END the prior screeningProgram div // TODO: SHOULD BE article but that screws formatting
   	    echo $indent . '</div> <!-- end eventProgram -->' . PHP_EOL; 
        echo $indent . '<!-- END showWorks() -->' . PHP_EOL;
      }
    }
  }
?>