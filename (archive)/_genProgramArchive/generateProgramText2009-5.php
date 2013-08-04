<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>2009 Program Text</title>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<?php
  include_once "../../bin/utilities/autoloadClasses.php";

  $initialShowId = 16;
  $eventId = 9;
  $outputString = '';
  $imagePathName = 'file:///Volumes/Filmmaker HD1/Users/david/Projects/SansSouci/_Sans Souci 2009/_program/images/';

/*
  function selectContributors($workId, $allFixedOptional) {
    $optionalString = '';
    if (($allFixedOptional) == 'all') $optionalString = '';
    else if (($allFixedOptional) == 'fixed') $optionalString = ' AND optionalContributor = 0';
    else if (($allFixedOptional) == 'optional') $optionalString = ' AND optionalContributor = 1';
    $selectContributorString = "SELECT work, contributorOrder, listingOrder, name, role FROM workContributors"
                             . " WHERE work = " . $workId . $optionalString 
                             . " ORDER BY listingOrder, contributorOrder";
    $contributorRows = SSFDB::getDB()->getArrayFromQuery($selectContributorString);
    return $contributorRows;
  }
*/

	function showIdTag($showId) {
	  return 'show' . $showId;
	}
	
	function displayDescription($showId, $text) {
    global $outputString;
		//$outputString .= "\r\n";
		$outputString .= '&lt;SectionTitle&gt;' . $text . '&lt;/SectionTitle&gt;' . "<br>\r\n";
//		$outputString .= '&lt;SectionTitle&gt;' . $text . '&lt;/SectionTitle&gt;' . "\r\n";
	}
	
	function displayWork($index, $workRow) {
    global $outputString;
    global $imagePathName;
	  $filmContentTag = '&lt;FilmContent&gt;';
	  $filmContentEndTag = '&lt;/FilmContent&gt;<br>';
//	  $filmContentEndTag = '&lt;/FilmContent&gt;';
	  
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
	  
	  // , includes live performance,
	  $liveText = '';
	  if ($workRow['includesLivePerformance'] == 1) $liveText = '<span class="filmLiveText">includes live performance, </span>';
	  
    // compute $runTimeMinutes
	  list($hours, $minutes, $seconds) = sscanf($workRow['runTime'], "%d:%d:%d");
	  $runTimeMinutes = $minutes + (60 * $hours);
	  if ($seconds >= 31) $runTimeMinutes++; 
	  // while ($runTime[0] == '0' || $runTime[0] == ':') $runTime = substr($runTime, 1);
	  
	  // define $originalFormat
    $originalFormat = ($workRow['originalFormat'] == 'selectSomething') ? '' : ', ' . $workRow['originalFormat'];

    // define $synopsis
		$synopsis = $workRow['synopsisEdit2'];
		if ($synopsis == '') $synopsis = $workRow['synopsisEdit1'];
		if ($synopsis == '') $synopsis = $workRow['synopsisOriginal'];

    // define $cityStateCountry
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

		// define Contributor Displays
		
		$contributorRows = SSFQuery::selectContributorsFor($workRow['workId'], $useListingOrder = true);
		$contributorRowsDisplayed = 0;
		$director = '';
		$producer = '';
		$choreographer = '';
		$danceCompany = '';
		$principalDancers = '';
		$musicComposer = ''; 
		$musicPerformer = '';
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
			else if ($contributorRole1 == "") {
				$contributorRole1 = $contributorRow['role'];
				$contributorName1 =  $contributorRow['name'];
			} else {
				$contributorRole2 = $contributorRow['role'];
				$contributorName2 =  $contributorRow['name'];
			}
		}
		$prodEqDir = ($director == $producer);
		$chorEqDancer = ($choreographer == $principalDancers);
		$performerEqComposer = ($musicComposer == $musicPerformer);
		
		$directorTitle = ($prodEqDir) ? 'Produced and Directed by ' : 'Directed by ';
		$directorDisplay = ($director == '') ? '<!-- No director given. -->' 
																				 : $filmContentTag . $directorTitle . ' ' . str_replace('&', '&amp;amp;', $director) . $filmContentEndTag;
		$producerDisplay = ($producer == '') ? '<!-- No producer given. -->' 
																					: ($prodEqDir) ? '<!-- Producer same as director. -->'
																												 : $filmContentTag . 'Produced by ' . str_replace('&', '&amp;amp;', $producer) . $filmContentEndTag; 
		$choreoTitle = ($chorEqDancer) ? 'Choreography and dancing by ' : 'Choreography by ' ;    
		$choreoDisplay = ($choreographer == '') ? '<!-- No choreographer given. -->'
																						: $filmContentTag . $choreoTitle . '' . str_replace('&', '&amp;amp;', $choreographer) . $filmContentEndTag;
		$companyDisplay = ($danceCompany == '') ? '<!-- No company given. -->'
																						: $filmContentTag . 'Featuring ' . str_replace('&', '&amp;amp;', $danceCompany) . $filmContentEndTag;
		$dancersDisplay = ($principalDancers == '') ? '<!-- No dancers given. -->'
																								: ($chorEqDancer) ? '<!-- Dancer is choreographer. -->'
																																	: $filmContentTag . 'Dancing by ' . str_replace('&', '&amp;amp;', $principalDancers) . $filmContentEndTag;
		$musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
		$musicCompDisplay = ($musicComposer ==  '') ? '<!-- No composer given. -->'
																								: $filmContentTag . str_replace('&', '&amp;amp;', $musicTitle) . ' ' . str_replace('&', '&amp;amp;', $musicComposer) . $filmContentEndTag;
		$musicPerfDisplay = ($musicPerformer ==  '') ? '<!-- No music performer given. -->'
																								 : ($performerEqComposer) ? '<!-- Music composer same as performer. -->'
																																					: $filmContentTag . 'Music performed by ' . str_replace('&', '&amp;amp;', $musicPerformer) . $filmContentEndTag;
		$otherContributor1Display = ($contributorRole1 == '') ? '<!-- No other given. -->'
																													: $filmContentTag . str_replace('&', '&amp;amp;', $contributorRole1) . ' by ' . str_replace('&', '&amp;amp;', $contributorName1) . $filmContentEndTag;
		$otherContributor2Display = ($contributorRole2 == '') ? '<!-- No other given. -->'
																													: $filmContentTag . str_replace('&', '&amp;amp;', $contributorRole2) . ' by ' . str_replace('&', '&amp;amp;', $contributorName2) . $filmContentEndTag;

    //$outputString .= '<!-- Item #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" Show time: ' . $workRow['showShortDescription'] . ' #' . $workRow['showOrder'] . ' -->' . "\r\n";
    $image .= '&lt;Image href="' . $imagePathName . $imageFileName . '"&gt;&lt;/Image&gt;';
    //if ($imageCaption != '') $outputString .= '<div class="filmFigureCaption">' . $imageCaption . '</div>';
    $outputString .= '&lt;Work&gt;&lt;FilmHeadline&gt;&lt;FilmTitle&gt;' . $image . str_replace('&', '&amp;amp;', $title) . ', &lt;/FilmTitle&gt;' . $workRow['yearProduced'] 
              . ', ' . $liveText . $runTimeMinutes . ' min' . $originalFormat . '&lt;/FilmHeadline&gt;' . "<br>\r\n";
//    $outputString .= '    &lt;Work&gt;&lt;FilmHeadline&gt;&lt;FilmTitle&gt;' . $title . ', &lt;/FilmTitle&gt;' . $workRow['yearProduced'] 
//              . ', ' . $liveText . $runTimeMinutes . ' min' . $originalFormat . '&lt;/FilmHeadline&gt;' . "\r\n";
    $outputString .= $directorDisplay . "\r\n";
    $outputString .= $producerDisplay . "\r\n";
    $outputString .= $choreoDisplay . "\r\n";
    $outputString .= $companyDisplay . "\r\n";
    $outputString .= $dancersDisplay . "\r\n";
    $outputString .= $musicCompDisplay . "\r\n";
    $outputString .= $musicPerfDisplay . "\r\n";
    $outputString .= $otherContributor1Display . "\r\n";
    $outputString .= $otherContributor2Display . "\r\n";
    $outputString .= '&lt;Synopsis&gt;' . str_replace('&', '&amp;amp;', $synopsis) 
                  . ' (' . str_replace('&', '&amp;amp;', $cityStateCountry) . ')&lt;/Synopsis&gt;' . "<br>\r\n";
    $outputString .= '&lt;SpaceAfterWork&gt; &lt;/SpaceAfterWork&gt;';
    $outputString .= '&lt;/Work&gt;' . "<br>\r\n";
//    $outputString .= '&lt;/Work&gt;';
//    $outputString .= '<!-- Item #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
  }

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select personId, people.name, lastName, organization, city, stateProvRegion, country, "
										 . "workId, title, yearProduced, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
										 . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
										 . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, "
										 . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, "
										 . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
										 . "shows.showId as showId, shows.description as showDescription, "
										 . "shows.shortDescription as showShortDescription, showOrder "
										 . "from works "
										 . "left join (people) on (people.personId=works.submitter) "
										 . "left join (workImages) on (workImages.work=works.workId) "
										 . "left join (images) on (workImages.image=images.imageId) "
										 . "left join (runOfShow) on (runOfShow.work=works.workId) "
										 . "left join (shows) on (shows.showId=runOfShow.`show`) "
										 . "where accepted=1 and shows.event=" . $eventId . " "
										 . "order by showId, showOrder";

  $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
/*
  $outputString .= '<?xml version="1.0" encoding="UTF-8" ?>' . "<br>\r\n";
  $outputString .= '<!DOCTYPE Program SYSTEM "program.dtd">' . "<br>\r\n";
*/
//  $outputString .= '&lt;Program&gt;' . "<br>\r\n";
  $outputString .= '&lt;Program&gt;';

	$index = 0;
	$showId = $initialShowId;
	foreach ($workRows as $workRow) {
	  $index++;
	  if ($workRow['showId'] != $showId) {
	    $showId = $workRow['showId'];
	    //displayDescription($showId, $workRow['showShortDescription']);
	  }
    displayWork($index, $workRow);
	}

//  $outputString .= '&lt;/Program&gt;' . "<br>\r\n";
  $outputString .= '&lt;/Program&gt;' . "\r\n";
  
  echo $outputString;

?>

</body>
</html>
