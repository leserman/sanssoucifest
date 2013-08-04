<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Boulder 2009 Program</title>
<style type="text/css">
<!--
.programHighlightColor {color: #CC3333}
-->
</style>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
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
      <span class="programHighlightColor">Boulder Program, 2009</span><br>
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText" style="padding-top:6px;">
	  <span style="font-size:20px;"><a href="http://thedairy.org/">Dairy Center for the Arts</a></span><br>
		  <span class="programInfoTextSmall">2590 Walnut Street &#8226; Boulder, CO, USA</span><br>		  
		  Friday &amp; Saturday, March 20 &amp; 21, 2009<br>
       <div class="programInfoTextSmall" style="font-weight:normal;padding-top:4px;padding-bottom:4px;">Tickets: 
          $12 General Admission and $8 Students/Seniors &nbsp; <span style="font-size:small;">[<a href="javascript:void(0);" onClick="showHide('ticketDetail');"> show / hide detail </a>]</span>        </div>
        <div id="ticketDetail" style="font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#CCCCCC;padding-bottom:6px;display:none;">
          when purchased through the Dairy Community Box Office <br>2590 Walnut Street, Boulder, CO &#8226; 303.444.7328 &#8226; Tue-Fri 1-5<br>
          OR<br>
          $14 General Admission and $9.50 Students/Seniors (including fees)<br>
          when purchased through Front Gate Tickets &bull; 1.888.512.7469 &bull; Mon-Sat 8-8<br>
          or anytime online via <a href="http://thedairy.frontgatetickets.com/">Front Gate Tickets</a>.
        </div>
        <div class="programInfoText" style="margin-top:0.2em;font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#CCCCCC;padding-bottom:4px;padding-top:0px;">
          Download the <a href="../PDF-ProgramSpreads/SSF2009ProgramSpreads.pdf">print version</a> of this program (4.8 MB PDF).
        </div>
  </tr>
<!--  <tr><td height="30" colspan="3" align="center" valign="top" class="bodyText">&nbsp;</td></tr> -->
  
<!-- BEGIN INSERT STUFF HERE -->
	

<?php
  $showsEvent = 9;
	$programPicBorderWidth = '2';
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
	
  // Display the on-page index of shows within this event.
  function displayShowIndex($showArray) {
    $debugger = new SSFDebug($initBelchEnabled=false, $initBechoEnabled=false);
    $debugger->belch('displayShowIndex($showArray)', $showArray);
		echo '<tr align="left">';
		echo '<td align="left" colspan="3" class="bodyTextOnBlack" style="text-size=6px;padding:20px 0 24px 0;">|';
		foreach ($showArray as $show) {
		  echo '&nbsp;<a href="#' . HTMLGen::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>&nbsp;|';
		}
		echo '&nbsp;&nbsp;</td></tr>' . "\r\n";
  }

	// Insert the name anchor for the show for on-page navigation from the index of shows.
	function displayShowDescription($showId, $text) {
		echo '<tr align="left">' . "\r\n";
		echo '	<td height="10" colspan="3" valign="top"  class="programInfoText"><a name="' . HTMLGen::genShowIdTag($showId) 
		          . '"></a>' . $text . '<br clear="all">' . "\r\n";
		echo '		<img src="../images/dotClear.gif" alt="" width="1" height="10"></td>' . "\r\n";
		echo '</tr>' . "\r\n";
		//echo '<tr><td colspan="3" height="36" align="center" valign="top" class="bodyText">&nbsp;</td></tr>' . "\r\n";
	}
	
	function displayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, 
	                     $emptyImageDefaultHeightInPixels, $emptyImageDefaultWidthInPixels) {
	  $filmInfoDivSpanText = '<div class="filmInfoText"><span class="filmInfoSubtitleText">';
	  $title = $workRow['title'];
	  
	  // define image parameters
    // NOTE: do not use $workRow['tablename.whatever'], just use $workRow['whatever']
    if ($workRow['fileName'] != '') {
      $imageFileName = $workRow['fileName'];
			$imageDirectory  = '../' . $workRow['directory'];
      $imageHeightInPixels = $workRow['heightInPixels'];
      $imageWidthInPixels = $workRow['widthInPixels'];
      if (stripos($imageDirectoryFiles, $imageDirectory . $imageFileName) === false) {
        $imageAltText = '';
        $imageTitleText = 'File ' . $imageDirectory . $imageFileName . ' is missing.';
        $imageCaption = '';
      } else {
        $imageTitleText = $imageAltText = $workRow['altText'];
        $imageCaption = $workRow['caption'];
      }
	  } else {
   	  $imageFileName = 'emptyImage.gif';
   	  $imageDirectory = '../images/';
	    $imageHeightInPixels = $emptyImageDefaultHeightInPixels;
	    $imageWidthInPixels = $emptyImageDefaultWidthInPixels;
	    $imageTitleText = $imageAltText = '';
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
		$contributorSelectAllRows = SSFQuery::selectContributorsFor($workRow['workId'], $useListingOrder = true);
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
		foreach ($contributorSelectAllRows as $contributorRow) { 
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
		
		$webSite = ((isset($workRow['webSite'])) ? $workRow['webSite'] : '');
		if ($webSite  != '' && strripos($webSite, 'http') === false) $webSite = 'http://' . $webSite;
		if ($webSite != '') switch ($workRow['webSitePertainsTo']) {
			case "director":      $director = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($director) . "</a>"; break;
			case "producer":      $producer = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($producer) . "</a>"; break;
			case "choreographer": $choreographer = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($choreographer) . "</a>"; break;
			case "company":       $danceCompany = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($danceCompany) . "</a>"; break;
			case "movie":         $title = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($title) . "</a>"; break;
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
																																	: $filmInfoDivSpanText . 'Dancing by </span>' 
																																	                       . HTMLGen::htmlEncode($principalDancers) . '</div>';
		$musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
		$musicCompDisplay = ($musicComposer ==  '') ? '<!-- No composer given. -->'
																								: $filmInfoDivSpanText . $musicTitle . ' </span>' . HTMLGen::htmlEncode($musicComposer) . '</div>';
		$musicPerfDisplay = ($musicPerformer ==  '') ? '<!-- No music performer given. -->'
																								 : ($performerEqComposer) ? '<!-- Music composer same as performer. -->'
																																					: $filmInfoDivSpanText . 'Music performed by </span>' 
																																					                       . HTMLGen::htmlEncode($musicPerformer) . '</div>';
		$otherContributor1Display = ($contributorRole1 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . HTMLGen::htmlEncode($contributorRole1) . ' by </span>' 
																													                       . HTMLGen::htmlEncode($contributorName1) . '</div>';
		$otherContributor2Display = ($contributorRole2 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . HTMLGen::htmlEncode($contributorRole2) . ' by </span>' 
																													                       . HTMLGen::htmlEncode( $contributorName2) . '</div>';

    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" ' . $workRow['shortDescription'] 
                      . ' #' . $workRow['showOrder'] . ' -->' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td align="center" valign="top" class="programPic"><img class="programHighlightColor" src="' 
              . $imageDirectory . $imageFileName . '" alt="' . HTMLGen::htmlEncode($imageAltText) 
              . '" title="' . HTMLGen::htmlEncode($imageTitleText) . '" height="' . $imageHeightInPixels 
              . ' "width="' . $imageWidthInPixels . '" hspace="2" vspace="2" border="' . $programPicBorderWidth . '" align="right">';
    if ($imageCaption != '') echo '<br clear="all"><div class="filmFigureCaption">' . HTMLGen::htmlEncode($imageCaption) . '</div>';
    echo      '</td>' . "\r\n";
    echo '    <td width="12" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" align="left" valign="top" class="bodyText"><div class="filmTitleText">' 
              . $title . ', <span class="filmYearText">' . $workRow['yearProduced'] 
              . ', </span>' . $liveText . '<span class="filmRunTimeText">' 
              . $runTimeMinutes . ' min</span><span class="filmFormatText">' . $originalFormat . '</span></div>' . "\r\n";
    echo '      ' . $directorDisplay . "\r\n";
    echo '      ' . $producerDisplay . "\r\n";
    echo '      ' . $choreoDisplay . "\r\n";
    echo '      ' . $companyDisplay . "\r\n";
    echo '      ' . $dancersDisplay . "\r\n";
    echo '      ' . $musicCompDisplay . "\r\n";
    echo '      ' . $musicPerfDisplay . "\r\n";
    echo '      ' . $otherContributor1Display . "\r\n";
    echo '      ' . $otherContributor2Display . "\r\n";
    echo '      ' . $filmInfoDivSpanText . 'Synopsis: </span>' . HTMLGen::htmlEncode($synopsis) 
                  . '<span class="filmCityStateCountryText"> (' . HTMLGen::htmlEncode($cityStateCountry) . ')</span></div></td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td width="188" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="2" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" height="36"  align="left" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
  }

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
	displayShowIndex($showRows);

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$workRows = SSFQuery::selectWorksForEvent($showsEvent);

  // Get the list of images in the directories.
  $imagesDirectories = SSFQuery::getStillImageDirectories();
  $imageDirectoryFiles = '';
  foreach ($imagesDirectories as $imagesDirectory) {
    if ($handle = opendir($codeBase . $imagesDirectory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') { $imageDirectoryFiles .= ($codeBase . $imagesDirectory . $file . ', '); }
      }
      closedir($handle);
    }
  }

  // Display each work.
	$index = 0;
	$showId = 0;
	foreach($workRows as $workRow) {
	  $index++;
	  if ($workRow['showId'] != $showId) {
      // Insert a name anchor for each show above the 1st work listed for that show
      //  to support the on-page navigation from the index of shows.
	    $showId = $workRow['showId'];
	    displayShowDescription($showId, $workRow['showDescription']);
	  }
    displayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, 
                $emptyImageDefaultHeightInPixels, $emptyImageDefaultWidthInPixels);
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