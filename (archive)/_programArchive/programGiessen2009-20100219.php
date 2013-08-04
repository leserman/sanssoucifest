<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Highways 2008 Program</title>
<style type="text/css">
<!--
.programHighlightColor {color: #D74D17}
-->
</style>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top">
            <?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar();
            ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="programTablePageBackground">
  <tr>
    <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br>
      <span class="programHighlightColor">Giessen Germany, 2009</span><br>
    </td>
  </tr>
<!--
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText"><img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all">
	  <a href="http://www.maps.txstate.edu/campus/buildings/thea.html">Theatre Building </a><span style="font-size:14px;">(Room 206)</span>, <a href="http://www.txstate.edu/">Texas 
      State University, San Marcos</a><div style="padding-bottom:30px;">Wednesday, October 29, at 7:00 pm</div>
  </tr>
-->
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText"><img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all">
	  <div style="padding-bottom:30px;"> <a href="http://www.stadttheater-giessen.de/index.php?id=1825">tanzArt ostwest  09</a><br>
	    In the exterior walls of the new Town Hall<br>
	    May 26 - June 2, 2009<br>
	    <div class="filmInfoText" style="padding-top:7px;padding-bottom:7px;">Sans Souci was invited by <a href="http://www.stadttheater-giessen.de/index.php?id=536">Tarek Assam</a>, Artistic Director of <a href="http://www.stadttheater-giessen.de/">Stadttheater Giessen</a>.</div>
	    <div class="filmInfoText" style="padding-top:7px;padding-bottom:2px;">Works are listed in alphabetical order; each was screened two or more times.</div></div>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText">  
	  </tr>
<!--  <tr><td height="30" colspan="3" align="center" valign="top" class="bodyText">&nbsp;</td></tr> -->
  
<!-- BEGIN INSERT STUFF HERE -->
	

<?php
	include '../bin/database/databaseSupportFunctions.php';
	include '../bin/forms/entryFormFunctions.php';
	
  $showsEvent = 10;
	$programPicBorderWidth = '1';
	
  function displayShowIndex($showArray) {
		echo '<tr align="left">';
		echo '<td align="center" colspan="3" class="bodyTextOnBlack" style="font-size=12px;padding:20px 0 32px 0;">|';
		foreach ($showArray as $show)
		  echo '&nbsp;<a href="#' . HTMLGen::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>&nbsp;|';
		echo '&nbsp;&nbsp;</td></tr>' . "\r\n";
  }

	function displayDescription($showId, $text) {
		echo '<tr align="left">' . "\r\n";
		echo '	<td height="10" colspan="3" valign="top"  class="programInfoText"><a name="' . HTMLGen::genShowIdTag($showId)
		        . '"></a>' . $text . '<br clear="all">' . "\r\n";
		echo '		<img src="../images/dotClear.gif" alt="" width="1" height="10"></td>' . "\r\n";
		echo '</tr>' . "\r\n";
		//echo '<tr><td colspan="3" height="36" align="center" valign="top" class="bodyText">&nbsp;</td></tr>' . "\r\n";
	}
	
	function displayWork($index, $workRow) {
	  global $programPicBorderWidth;
	  $filmInfoDivSpanText = '<div class="filmInfoText"><span class="filmInfoSubtitleText">';
	  
	  $title = $workRow['title'];
	  
	  // define image parameters
    debugLogLine("workRow[fileName]=|" . $workRow['fileName'] . "|"); // NOTE: do not use $workRow['tablename.whatever'], just use $workRow['whatever']
    if ($workRow['fileName'] != '') {
      $imageFileName = $workRow['fileName'];
			$imageDirectory  = '../' . $workRow['directory'];
      $imageHeightInPixels = $workRow['heightInPixels'];
      $imageAltText = $workRow['altText'];
      $imageCaption = $workRow['caption'];
	  } else {
   	  $imageFileName = 'emptyImage.gif';
   	  $imageDirectory = '../images/';
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
    echo '    <td align="center" valign="top" class="programPic"><img class="programHighlightColor" src="' . $imageDirectory . $imageFileName . '" alt="' . $imageAltText 
              . '" title="' . $imageAltText . '" height="' . $imageHeightInPixels . ' "width="180" hspace="2" vspace="2" border="' . $programPicBorderWidth . '" align="left">';
    if ($imageCaption != '') echo '<br clear="all"><div class="filmFigureCaption">' . $imageCaption . '</div>';
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
    echo '      ' . $filmInfoDivSpanText . 'Synopsis: </span>' . $synopsis . '<span class="filmCityStateCountryText"> (' . $cityStateCountry . ')</span></div></td>' . "\r\n";
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
										 . "from shows where shows.event=" . $showsEvent . " order by showId";

	debugLogLineQuery($showsSelectString);
	$showsQueryResult = mysql_query($showsSelectString); 
	debugLogQuery($showsQueryResult, $showsSelectString);
	debugLogLine("Select Query Finished -- result = " . $showsQueryResult); 

  $showArray = array();
	while ($showsQueryResult && ($showRow = mysql_fetch_array($showsQueryResult))) $showArray[] = $showRow;
//  displayShowIndex($showArray);

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select personId, people.name, lastName, organization, city, stateProvRegion, country, "
										 . "workId, title, yearProduced, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
										 . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
										 . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, "
										 . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, images.directory, "
										 . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
										 . "shows.showId as showId, shows.description as showDescription "
										 . "from works "
										 . "left join (people) on (people.personId=works.submitter) "
										 . "left join (workImages) on (workImages.work=works.workId) "
										 . "left join (images) on (workImages.image=images.imageId) "
										 . "left join (runOfShow) on (runOfShow.work=works.workId) "
										 . "left join (shows) on (shows.showId=runOfShow.`show`) "
										 . "where accepted=1 and shows.event=" . $showsEvent . " "
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
	    //displayDescription($showId, $workRow['showDescription']);
	  }
    displayWork($index, $workRow);
	}

?>

<!-- END NSERT STUFF HERE -->
      </table>

	  	<!-- InstanceEndEditable --></td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
            <?php SSFWebPageAssets::displayCopyrightLine();?></td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
<!-- InstanceEnd --></html>