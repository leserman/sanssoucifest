<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>2008 Program Text</title>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
<tr><td align="left" valign="top">
<table width="745"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
  <tr>
    <td width="600" align="center" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
    <tr>
	  <td width="530" align="center" valign="top" class="bodyTextGrayLight">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="programTablePageBackground">
  <tr>
    <td colspan="3" align="left" valign="middle" class="programPageTitleText">BMoCA Program, 2008<br>
    </td>
  </tr>
	
<?php
	include '../../databaseX/databaseSupportFunctions.php';
	include '../../bin/forms/entryFormFunctions.php';
	
	function showIdTag($showId) {
	  return 'show' . $showId;
	}
	
  function displayShowIndex($showArray) {
		echo '<tr align="left">';
		echo '<td align="center" colspan="3" class="bodyTextOnBlack" style="font-size:6px;padding:20px 0 32px 0;">|';
		foreach ($showArray as $show)
		  echo '&nbsp;<a href="#' . showIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>&nbsp;|';
		echo '&nbsp;&nbsp;</td></tr>' . "\r\n";
  }

	function displayDescription($showId, $text) {
		echo '<tr align="left">' . "\r\n";
		echo '	<td height="10" colspan="3" valign="top"  class="programInfoText"><a name="' . showIdTag($showId) . '"></a>' . $text . '<br clear="all">' . "\r\n";
		echo '</tr>' . "\r\n";
	}
	
	function displayWork($index, $workRow) {
	  $filmInfoDivSpanText = '<div class="filmInfoText"><span class="filmInfoSubtitleText">';
	  
	  $title = $workRow['title'];
	  
	  // define image parameters
    debugLogLine("workRow[fileName]=|" . $workRow['fileName'] . "|"); // NOTE: do not use $workRow['tablename.whatever'], just use $workRow['whatever']
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
		$contributorSelectAllResult = selectContributors2($workRow['workId'], 'all');
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
		while ($contributorSelectAllResult && ($contributorRow = mysql_fetch_array($contributorSelectAllResult))) { 
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
		
		$webSite = $workRow['webSite'];
		if ($webSite != '') switch ($workRow['webSitePertainsTo']) {
			case "director":      $director = "<a href='" . $webSite . "'>" . $director . "</a>"; break;
			case "producer":      $producer = "<a href='" . $webSite . "'>" . $producer . "</a>"; break;
			case "choreographer": $choreographer = "<a href='" . $webSite . "'>" . $choreographer . "</a>"; break;
			case "company":       $danceCompany = "<a href='" . $webSite . "'>" . $danceCompany . "</a>"; break;
			case "movie":         $title = "<a href='" . $webSite . "'>" . $title . "</a>"; break;
		}

		$directorTitle = ($prodEqDir) ? 'Produced and Directed by ' : 'Directed by ';
		$directorDisplay = ($director == '') ? '<!-- No director given. -->' 
																				 : $filmInfoDivSpanText . $directorTitle . ' </span>' . $director . '</div>';
		$producerDisplay = ($producer == '') ? '<!-- No producer given. -->' 
																					: ($prodEqDir) ? '<!-- Producer same as director. -->'
																												 : $filmInfoDivSpanText . 'Produced by </span>' . $producer . '</div>'; 
		$choreoTitle = ($chorEqDancer) ? 'Choreography and dancing by ' : 'Choreography by ' ;    
		$choreoDisplay = ($choreographer == '') ? '<!-- No choreographer given. -->'
																						: $filmInfoDivSpanText . $choreoTitle . '</span>' . $choreographer . '</div>';
		$companyDisplay = ($danceCompany == '') ? '<!-- No company given. -->'
																						: $filmInfoDivSpanText . 'Featuring </span>' . $danceCompany . '</div>';
		$dancersDisplay = ($principalDancers == '') ? '<!-- No dancers given. -->'
																								: ($chorEqDancer) ? '<!-- Dancer is choreographer. -->'
																																	: $filmInfoDivSpanText . 'Dancing by </span>' . $principalDancers . '</div>';
		$musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
		$musicCompDisplay = ($musicComposer ==  '') ? '<!-- No composer given. -->'
																								: $filmInfoDivSpanText . $musicTitle . ' </span>' . $musicComposer . '</div>';
		$musicPerfDisplay = ($musicPerformer ==  '') ? '<!-- No music performer given. -->'
																								 : ($performerEqComposer) ? '<!-- Music composer same as performer. -->'
																																					: $filmInfoDivSpanText . 'Music performed by </span>' . $musicPerformer . '</div>';
		$otherContributor1Display = ($contributorRole1 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . $contributorRole1 . ' by </span>' . $contributorName1 . '</div>';
		$otherContributor2Display = ($contributorRole2 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . $contributorRole2 . ' by </span>' . $contributorName2 . '</div>';

    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" Show time: $weekday #$showOrder -->' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td align="center" valign="top">' . $imageFileName;
    if ($imageCaption != '') echo '<div class="filmFigureCaption">' . $imageCaption . '</div>';
    echo      '</td>' . "\r\n";
    echo '    <td width="12" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" align="left" valign="top" class="bodyText"><div class="filmTitleText">' . $title . ', <span class="filmYearText">' . $workRow['yearProduced'] 
              . ', </span>' . $liveText . '<span class="filmRunTimeText">' . $runTimeMinutes . ' min</span><span class="filmFormatText">' . $originalFormat . '</span></div>' . "\r\n";
    echo '      ' . $directorDisplay . "\r\n";
    echo '      ' . $producerDisplay . "\r\n";
    echo '      ' . $choreoDisplay . "\r\n";
    echo '      ' . $companyDisplay . "\r\n";
    echo '      ' . $dancersDisplay . "\r\n";
    echo '      ' . $musicCompDisplay . "\r\n";
    echo '      ' . $musicPerfDisplay . "\r\n";
    echo '      ' . $otherContributor1Display . "\r\n";
    echo '      ' . $otherContributor2Display . "\r\n";
    echo '      ' . $filmInfoDivSpanText . '</span><i>' . $synopsis . '<span class="filmCityStateCountryText"> (' . $cityStateCountry . ')</span></i></div></td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td width="188" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="2" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" height="36"  align="left" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
  }

  $connectionSuccess = connectToDB();

	// GET THE SHOW DESCRIPTIONS
	$showsSelectString = "select showId, shortDescription "
										 . "from shows where shows.event=1 order by showId";

	debugLogLineQuery($showsSelectString);
	$showsQueryResult = mysql_query($showsSelectString); 
	debugLogQuery($showsQueryResult, $showsSelectString);
	debugLogLine("Select Query Finished -- result = " . $showsQueryResult); 

 $showArray = array();
	while ($showsQueryResult && ($showRow = mysql_fetch_array($showsQueryResult))) $showArray[] = $showRow;
  displayShowIndex($showArray);


	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select personId, people.name, lastName, organization, city, stateProvRegion, country, "
										 . "workId, title, yearProduced, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
										 . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
										 . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, "
										 . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, "
										 . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
										 . "shows.showId as showId, shows.description as showDescription "
										 . "from works "
										 . "left join (people) on (people.personId=works.submitter) "
										 . "left join (workImages) on (workImages.work=works.workId) "
										 . "left join (images) on (workImages.image=images.imageId) "
										 . "left join (runOfShow) on (runOfShow.work=works.workId) "
										 . "left join (shows) on (shows.showId=runOfShow.`show`) "
										 . "where accepted=1 and shows.event=1 "
										 . "order by showId, showOrder";

	debugLogLineQuery($worksSelectString);
	$worksQueryResult = mysql_query($worksSelectString); 
	debugLogQuery($worksQueryResult, $worksSelectString);
	debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 

	$index = 0;
	$showId = 0;
	while ($worksQueryResult && ($workRow = mysql_fetch_array($worksQueryResult))) {
	  $index++;
	  if ($workRow['showId'] != $showId) {
	    $showId = $workRow['showId'];
	    displayDescription($showId, $workRow['showDescription']);
	  }
    displayWork($index, $workRow);
	}

?>

      </table>
       </td>
    </tr></table>
    </td>
    </tr>
</table>
</td></tr></table>
</body>
</html>
