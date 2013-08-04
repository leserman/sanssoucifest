<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - 2008 Program</title>
<style type="text/css">
<!--
.programHighlightColor {color: #000099}
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
      BMoCA
      Program, 2008<br>
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText"><img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all"><a href="http://www.bmoca.org">Boulder Museum of Contemporary Art</a><br>
		  <span class="programInfoTextSmall">1750 13th Street &#8226; Boulder, CO, USA</span><br>		  
		  <a href="javascript:window.void(0)" 
		    onMouseOver="popup('7:00 - 8:00 pm: Video installations.<br>8:00 pm: Screenings of shorts.<br>5:00 pm Saturday only: 75 minute Belgian dance documentary.<br><br>$12 general admission, $8 for museum members, seniors and students.<br>Tickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.','#FFFF99')" 
		    onMouseOut="killPopup()" 
		    onClick="window.alert('7:00 - 8:00 pm: Video installations.\r\n8:00 pm: Screenings of shorts.\r\n5:00 pm Saturday only: 75 minute Belgian dance documentary.\r\n\r\n$12 general admission, $8 for museum members, seniors and students.\r\nTickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.')">Friday 
		      &amp; Saturday,</a> April 4th &amp; 5th, 2008<br>
  </tr>
<!--  <tr><td height="30" colspan="3" align="center" valign="top" class="bodyText">&nbsp;</td></tr> -->
  
<!-- BEGIN INSERT STUFF HERE -->
	

<?php
  $showsEvent = 1;
	$programPicBorderWidth = '1';
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
	
  // Display the on-page index of shows within this event.

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
	HTMLGen::progPageDisplayShowIndex($showRows);

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
	    HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
	  }
    HTMLGen::progPageDisplayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, 
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