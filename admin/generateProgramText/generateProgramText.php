<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>2014 Program Text</title>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php
  include_once "../../bin/utilities/autoloadClasses.php";
  
  // TODO: Continue to test with $generateWithMarkup = 1;

  // PARAMETERS to set:
  
      // Set to 1 for program generation with markup for input to Adobe InDesign. Set to 0 for plain text.  
        $generateWithMarkup = 1;
        
      // Applies when $generateWithMarkup = 0. Set to '; ' for a single continuous wrapped line or to <br> for line breaks between items.
        $filmContentItemSeparatorForPlainText = '<br>'; // '<br>' for line breaks; '; ' for wrapped lines
        $filmContentItemSeparatorForPlainText = '; ';
    
      // SHOW selection:
      
          $imagePathFor2014 = 'file:///Volumes/iMac HD/Users/david/Projects/SansSouciDataFiles/_Sans Souci 2014/_printProgram/images/';

          // J.P.'s D.A.M show 10/17, 18, & 19/ 2014
            $showSetText = '(74)';
            $imagePathName = '';
            $generateWithMarkup = 1;
        
          // Atlas Sept 5 & 6, 2014
            $showSetText = '(67, 68, 69)';
            $imagePathName = $imagePathFor2014;
            $generateWithMarkup = 1;

          // BPL Canyon Theater 10/6/14
            $showSetText = '(72)';
            $imagePathName = $imagePathFor2014;
            $generateWithMarkup = 1;
        
          // Boe 10/19/14
            $showSetText = '(71)';
            $imagePathName = $imagePathFor2014;
            $generateWithMarkup = 1;
        
          // BIFF submission 10/18/14
            $showSetText = '(75)';
            $imagePathName = $imagePathFor2014;
            $generateWithMarkup = 0;
            $filmContentItemSeparatorForPlainText = '<br>'; // '<br>' for line breaks; '; ' for wrapped lines
        
      // END SHOW selection

  // END PARAMETERS to set.    

	function showIdTag($showId) { return 'show' . $showId; 	}
	function filmContentTag($generateWithMarkup) { return ($generateWithMarkup)	? '&lt;FilmContent&gt;' : ''; }
	function filmContentEndTag($generateWithMarkup) { return ($generateWithMarkup)	? '&lt;/FilmContent&gt;' : ''; }
	function filmContentTitleTag($generateWithMarkup) { return ($generateWithMarkup)	? '&lt;FilmContentTitle&gt;' : ''; }
	function filmContentTitleEndTag($generateWithMarkup) { return ($generateWithMarkup)	? '&lt;/FilmContentTitle&gt;' : ''; }
	function itemSeparator($generateWithMarkup) { global $filmContentItemSeparatorForPlainText; return ($generateWithMarkup) ? '; ' : $filmContentItemSeparatorForPlainText; }
//	function htmlify($str) { $htmlifiedStr = str_replace('&', '&amp;', $str); return $htmlifiedStr; } 
	function htmlify($str) { global $generateWithMarkup; $htmlifiedStr = ($generateWithMarkup) ? str_replace(' & ', ' &amp;amp; ', $str) : $str; return $htmlifiedStr; } 
//	function htmlify($str) { $htmlifiedStr = htmlentities($str, ENT_COMPAT, ini_get("default_charset"), $double_encode = false); return $htmlifiedStr; } 
		
	function getWorkOutputString($index, $workRow) {
    global $imagePathName;
    global $generateWithMarkup;
    global $filmContentItemSeparatorForPlainText;
	  
	  $title = $workRow['title'];
	  
	  // define image parameters
    if ($workRow['fileName'] != '') {
      $imageFileName = $workRow['fileName'];
      $imageHeightInPixels = $workRow['heightInPixels'];
      $imageAltText = $workRow['altText'];
      $imageCaption = $workRow['caption'];
	  } else {
   	  $imageFileName = 'emptyImage.gif';
	    $imageHeightInPixels = '131';
	    $imageAltText = '';
      $imageCaption = '';
	  }
	  
	  // includes live performance,
	  $liveText = '';
	  if ($workRow['includesLivePerformance'] == 1) $liveText = '<span class="filmLiveText">includes live performance, </span>';
	  
    // compute $runTimeMinutes
	  list($hours, $minutes, $seconds) = sscanf($workRow['runTime'], "%d:%d:%d");
	  $runTimeMinutes = $minutes + (60 * $hours);
	  if ($seconds >= 31) $runTimeMinutes++; 
	  
	  // define $originalFormat
    $originalFormat = ($workRow['originalFormat'] == 'selectSomething') ? '' : ', ' . $workRow['originalFormat'];

    // define $synopsis
		$synopsis = $workRow['synopsisEdit2'];
		if ($synopsis == '') $synopsis = $workRow['synopsisEdit1'];
		if ($synopsis == '') $synopsis = $workRow['synopsisOriginal'];

    // define $cityStateCountry - NO LONGER USED - Use countryOfProduction instead
    $cityStateCountry = '';
	  $separator = '';
	  if ($workRow['city'] != '' ) { 
	    $cityStateCountry = $workRow['city']; 
	    $separator = ', '; 
	  }
	  if ($workRow['stateProvRegion'] != '') {
	    $cityStateCountry .= $separator . $workRow['stateProvRegion'];
	    $separator = ', '; 
	  }
	  if ($workRow['country'] != '') $cityStateCountry .= $separator . $workRow['country'];
	  
	  // define $countryOfProduction
	  $countryOfProduction = '';
	  if ($workRow['countryOfProduction'] != '') { $countryOfProduction = $workRow['countryOfProduction']; }

		// define Contributor Displays
		
		$contributorRows = SSFQuery::selectContributorsFor($workRow['workId'], $useListingOrder = true);
    SSFDebug::globalDebugger()->belch('contributorRows', $contributorRows, -1);
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
		foreach ($contributorRows as $contributorRow) {
			if ($contributorRow['role'] == 'Director') $director = $contributorRow['name'];
			else if ($contributorRow['role'] == 'Producer') $producer = $contributorRow['name'];
			else if ($contributorRow['role'] == 'Choreographer') $choreographer = $contributorRow['name'];
			else if ($contributorRow['role'] == 'DanceCompany') $danceCompany = $contributorRow['name'];
			else if ($contributorRow['role'] == 'PrincipalDancers') $principalDancers = $contributorRow['name'];
			else if ($contributorRow['role'] == 'MusicComposition') $musicComposer = $contributorRow['name']; 
			else if ($contributorRow['role'] == 'MusicPerformance')  $musicPerformer = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Camera')  $camera = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Editor')  $editor = $contributorRow['name'];
			else if ($contributorRole1 == "") {
				$contributorRole1 = $contributorRow['roleDescription'];
				$contributorName1 =  $contributorRow['name'];
			} else {
				$contributorRole2 = $contributorRow['roleDescription'];
				$contributorName2 =  $contributorRow['name'];
			}
		}
		$prodEqDir = ($director == $producer);
		$chorEqDancer = ($choreographer == $principalDancers);
		$performerEqComposer = ($musicComposer == $musicPerformer);
    $cameraEqEditor = ($camera == $editor);

    // 9/19/14 - There may still be some errors here, e.g., empty Produced by and empty Edited by and others ?
    //           This bug appears to be the result of nested ternary operators (i.e., ? : ? :) with missing parens (i.e.,  ? (: ? :))
    //           I think it's completely fixed as of 9/29/14.
    // 9/19/14 - omitted the final semicolon before synopsis and used the correct code (&bull;)for the bullet •
    // 9/18/14 - substituted • (&bull;)for Synopsis:
    // 9/18/14 - Changed location from submitter address to country of production.
    // 9/18/14 - Got rid of the comma after min, e.g., 4 min, FIXED by eliminating $originalFormat from output
    // 9/18/14 - Changed Year and Duration to an identifiable style named FilmHeadlineAfterTitle

		$directorTitle = filmContentTitleTag($generateWithMarkup) . (($prodEqDir) ? 'Produced and Directed by ' : 'Directed by ') . filmContentTitleEndTag($generateWithMarkup);
		$directorDisplay = ($director == '') ? '' // <!-- No director given. --> 
																				 : $directorTitle . htmlify($director);
		$producerDisplay = ($producer == '') ? '' // <!-- No producer given. -->
																					: (($prodEqDir) ? '' // <!-- Producer same as director. -->
																												 : filmContentTitleTag($generateWithMarkup) . 'Produced by ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($producer)); 
		$choreoTitle = filmContentTitleTag($generateWithMarkup) . (($chorEqDancer) ? 'Choreography and dancing by ' : 'Choreography by ') . filmContentTitleEndTag($generateWithMarkup);    
		$choreoDisplay = ($choreographer == '') ? '' // <!-- No choreographer given. -->
																						: $choreoTitle . '' . htmlify($choreographer);
		$companyDisplay = ($danceCompany == '') ? '' // <!-- No company given. -->
																						: filmContentTitleTag($generateWithMarkup) . 'Featuring ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($danceCompany);
		$dancersDisplay = ($principalDancers == '') ? '' // <!-- No dancers given. -->
																								: (($chorEqDancer) ? '' // <!-- Dancer is choreographer. -->
																																	: filmContentTitleTag($generateWithMarkup) . 'Dancing by ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($principalDancers));
    SSFDebug::globalDebugger()->becho('editor', $editor, -1);
    SSFDebug::globalDebugger()->becho('camera', $camera, -1);
    $cameraTitle = ($cameraEqEditor) ? 'Filmmaker ' : 'Cinematography by ';
    $cameraDisplay = ($camera ==  '') ? '' // <!-- No camera given. -->
                                                : filmContentTitleTag($generateWithMarkup) . $cameraTitle . filmContentTitleEndTag($generateWithMarkup) . htmlify($camera) . '</div>';
    $editorDisplay = ($editor ==  '') ? '' // <!-- No editor given. -->
                                                 : (($cameraEqEditor) ? '' // <!-- Camera same as editor. -->
                                                                          : (filmContentTitleTag($generateWithMarkup) . 'Edited by ' . filmContentTitleEndTag($generateWithMarkup)
                                                                                                 . htmlify($editor)));
		$musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
		$musicCompDisplay = ($musicComposer == '') ? '' // <!-- No composer given. -->
																							: filmContentTitleTag($generateWithMarkup) . htmlify($musicTitle) . filmContentTitleEndTag($generateWithMarkup) . htmlify($musicComposer);
		$musicPerfDisplay = ($musicPerformer == '') ? '' // <!-- No music performer given. -->  // TODO There's a bug here for 11-109 where there is no $musicPerformer but 
																							 : (($performerEqComposer) ? '' // <!-- Music composer same as performer. -->
																																					: (filmContentTitleTag($generateWithMarkup) . 'Music performed by ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($musicPerformer)));
		$otherContributor1Display = ($contributorRole1 == '') ? '' // <!-- No other given. -->
																													: filmContentTitleTag($generateWithMarkup) . htmlify($contributorRole1) . ' by ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($contributorName1);
		$otherContributor2Display = ($contributorRole2 == '') ? '' // <!-- No other given. -->
																													: filmContentTitleTag($generateWithMarkup) . htmlify($contributorRole2) . ' by ' . filmContentTitleEndTag($generateWithMarkup) . htmlify($contributorName2);

    $workOutputString = '';

    if ($generateWithMarkup) {
      $workOutputString .= '<!-- Item #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" Show time: ' . $workRow['showShortDescription'] . ' #' . $workRow['showOrder'] . ' -->' . "\r\n";
      $image = '&lt;Image href="' . $imagePathName . $imageFileName . '"&gt;&lt;/Image&gt;';
      //if ($imageCaption != '') $workOutputString .= '<div class="filmFigureCaption">' . $imageCaption . '</div>';
      $workOutputString .= '&lt;Work&gt;<br>&lt;FilmHeadline&gt;&lt;FilmTitle&gt;' . $image . htmlify($title) . ', &lt;/FilmTitle&gt;&lt;FilmHeadlineAfterTitle&gt;' . $workRow['yearProduced'] 
                . ', ' . $liveText . $runTimeMinutes . ' min' . '&lt;/FilmHeadlineAfterTitle&gt;&lt;/FilmHeadline&gt;' . "<br>";
    } else {
      $workOutputString .= '"' . $title . '" (' . $workRow['yearProduced'] . '), ' . $liveText . $runTimeMinutes . ' min' . "<br>";
    }
    $workOutputString .= filmContentTag($generateWithMarkup); 
    $workOutputString .= ($directorDisplay == '')  ? '' : ($directorDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($producerDisplay == '')  ? '' : ($producerDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($choreoDisplay == '')    ? '' : ($choreoDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($companyDisplay == '')   ? '' : ($companyDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($dancersDisplay == '')   ? '' : ($dancersDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($musicCompDisplay == '') ? '' : ($musicCompDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($musicPerfDisplay == '') ? '' : ($musicPerfDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($cameraDisplay == '') ? '' : ($cameraDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($editorDisplay == '') ? '' : ($editorDisplay . itemSeparator($generateWithMarkup));
    $workOutputString .= ($otherContributor1Display == '') ? '' : ($otherContributor1Display . itemSeparator($generateWithMarkup));
    $workOutputString .= ($otherContributor2Display == '') ? '' : ($otherContributor2Display . itemSeparator($generateWithMarkup));
    $workOutputString = trim($workOutputString);
    SSFDebug::globalDebugger()->becho('workOutputString', $workOutputString, -1);
    $lastSemicolonCharPosition = strrpos($workOutputString, ';');
    SSFDebug::globalDebugger()->becho('lastSemicolonChar', $lastSemicolonCharPosition, -1);
    SSFDebug::globalDebugger()->becho('strlen(workOutputString)', strlen($workOutputString), -1);
    if ($lastSemicolonCharPosition == strlen($workOutputString)-1) {
      SSFDebug::globalDebugger()->becho('lastSemicolonChar', $lastSemicolonCharPosition, -1);
      $workOutputString = substr($workOutputString, 0, $lastSemicolonCharPosition);
      SSFDebug::globalDebugger()->becho('workOutputString', $workOutputString, -1);
    }
    if ($generateWithMarkup) $workOutputString .= filmContentTitleTag($generateWithMarkup) . ' &bull; ' . filmContentTitleEndTag($generateWithMarkup) . '&lt;Synopsis&gt;' . htmlify($synopsis) 
                  . ' (' . htmlify($countryOfProduction) . ')&lt;/Synopsis&gt;';
    else $workOutputString .= (($filmContentItemSeparatorForPlainText == '; ') ? '; ' : '') . 'Synopsis: ' . $synopsis . ' (' . $countryOfProduction . ')' . "<br>\r\n";
    
    $workOutputString .= filmContentEndTag($generateWithMarkup) . (($generateWithMarkup) ? '&lt;/Work&gt;' : '') . "<br>\r\n";
    $workOutputString .= '<!-- END Item #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
    
    return $workOutputString;
  } // END function getWorkOutputString()


	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "SELECT DISTINCT personId, people.name, lastName, organization, city, stateProvRegion, country, "
										 . "workId, title, yearProduced, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
										 . "countryOfProduction, submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
										 . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, "
										 . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, "
										 . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
										 . "shows.showId as showId, shows.description as showDescription, "
										 . "shows.shortDescription as showShortDescription, showOrder "
                     . "FROM works "
										 . "  JOIN people on people.personId=works.submitter "
										 . "  LEFT JOIN workImages on workImages.work=works.workId "
										 . "  LEFT JOIN images on workImages.image=images.imageId "
										 . "  JOIN runOfShow on runOfShow.work=works.workId "
										 . "  JOIN shows on shows.showId=runOfShow.`show` "
										 . "WHERE shows.active=1 AND `show` IN " . $showSetText . " AND workId IN "
										 . "  (SELECT DISTINCT work FROM `runOfShow` WHERE `show` IN " . $showSetText . ") "
										 . "ORDER BY showId, showOrder";

//  SSFQuery::debugNextQuery();
  $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
  $outputString = '';
/*
  $outputString .= '<?xml version="1.0" encoding="UTF-8" ?>' . "<br>\r\n";
  $outputString .= '<!DOCTYPE Program SYSTEM "program.dtd">' . "<br>\r\n";
*/
  $outputString .= ($generateWithMarkup) ? '&lt;Program&gt;' . "<br>\r\n" : '';
	$index = 0;
	$showSetTextValues = trim(substr($showSetText, 1, strlen($showSetText)-2));
  SSFDebug::globalDebugger()->belch('showSetTextValues', '|' . $showSetTextValues . '|', -1);
  $showIds = explode(',', $showSetTextValues);
  $initialShowId = trim($showIds[0]);
  SSFDebug::globalDebugger()->belch('initialShowId', '|' . $initialShowId . '|', -1);
	$showId = $initialShowId;
	foreach ($workRows as $workRow) {
	  $index++;
	  if ($workRow['showId'] != $showId) {
	    $showId = $workRow['showId'];
	  }
    $outputString .= getWorkOutputString($index, $workRow);
	}
  $outputString .= ($generateWithMarkup) ? '&lt;/Program&gt;' . "\r\n" : '';  
  echo $outputString;

?>

</body>
</html>
