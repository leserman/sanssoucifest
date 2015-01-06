<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">                                                  <!-- UPDATE -->
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci at Ursinus College, 2014</title>                    <!-- UPDATE -->
<style type="text/css">
<!--
.programHighlightColor { color: #586caf;border-width: 1px; } /* b2dac2 dab2cb ffd0ed */
a.special:link { color : #FFFF99; text-decoration: none; }
a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */
a.special:hover { color : #990000; text-decoration: underline; }
-->
</style>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<?php
  $showsEvent = 34;                                                                                 /* UPDATE */
	$programPicBorderWidth = '1';
  $emptyImageDefaultHeightInPixels = '101';
  $emptyImageDefaultWidthInPixels = '180';
?>
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
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="programTablePageBackground">
  <tr>
    <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br><span class="programHighlightColorX">Sans Souci at Ursinus College, 2014</span><br>   <!-- UPDATE -->
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText" style="padding-top:6px;">              <!-- UPDATE --> 
      <!-- Ursinus -->
      <div style="margin-bottom:20px;">
        <div id="oct" class="homeHeading1" style="margin:5px 0 3px 0;color:#FFFF99;font-weight:bold;font-size:19px;text-align:left;">
          Friday, September 19<span style="font-size:14px;font-weight:normal;">&nbsp;&bull;&nbsp;7:30 PM</span>
        </div>
        <div style="font-size:19px;margin-top:0px;margin-bottom:0px;color:#E49548;font-weight:bold;">Lenfest Theater, <span class="programInfoTextSmall" style="font-size:12pt;color:#E49548;font-weight:normal;"><a href="http://www.ursinus.edu/netcommunity/page.aspx?pid=330">Kaleidoscope Performing Arts Center</a></span>, </div>
        <div class="programInfoTextSmall" style="font-size:14pt;margin:3px 0;color:#E49548;font-weight:normal;"><a href="http://www.ursinus.edu/">Ursinus College</a>, <span class="programInfoTextSmall" style="font-size:12pt;color:#E49548;font-weight:normal;">Collegeville, PA</span>
        </div>
        <div class="bodyTextLeadedOnBlack" style="margin:6px 0;padding:0;">as a part of the <a href="http://news.ursinus.edu/2013/events/annual-fringe-festival-features-comedy-dance/"><span style="font-size:12pt;">Ursinus College Fringe Festival</span></a></div>
        <div style="font-size:18px;margin-top:4px;margin-bottom:0px;color:#E49548;font-weight:bold;">FREE</div>
      </div>
<!--		  <div style="font-size:15px;margin-top:12px;margin-bottom:-8px;line-height:120%;color:#E49548;font-weight:normal;">Different programs at each screening:</div> -->
    </td>
  </tr>
  
<!-- BEGIN Shows and Works Display -->
	
<?php

  // Display the on-page index of shows within this event.

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
//	HTMLGen::progPageDisplayShowIndex($showRows);
	
	// READ the VALUES FROM the DATABASE FOR DISPLAY
	//SSFDB::debugNextQuery();
	$workRows = SSFQuery::selectWorksForEvent($showsEvent);
	SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);

  // Get the list of images in the directories.
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
	SSFDebug::globalDebugger()->belch('$imagesDirectories', $imagesDirectories, -1);
	SSFDebug::globalDebugger()->becho('$imageDirectoryFiles', $imageDirectoryFiles, -1);

  // Display each work.
	$index = 0;
	$showId = 0;
	foreach($workRows as $workRow) {
	  $index++;
	  if ($workRow['showId'] != $showId) {
      // Insert a name anchor for each show above the 1st work listed for that show to support the on-page navigation from the index of shows.
	    $showId = $workRow['showId'];
//	    HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
	  }
    HTMLGen::progPageDisplayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, $emptyImageDefaultHeightInPixels, $emptyImageDefaultWidthInPixels, true);
	}

?>

<!-- END Shows and Works Display -->

      </table>

	  </td>
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
</html>