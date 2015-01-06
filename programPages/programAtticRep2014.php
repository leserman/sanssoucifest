<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">                                                  <!-- UPDATE -->
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - AtticRep 2014 Program</title>                    <!-- UPDATE -->
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
  $showsEvent = 28;                                                                                 /* UPDATE */
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
    <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br><span class="programHighlightColorX">Attic<i>Rep</i> Program, 2014</span><br>   <!-- UPDATE -->
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText" style="padding-top:6px;">               <!-- UPDATE --> 
	    <div style="font-size:20px;margin-top:8px;margin-bottom:0px;line-height:18px;"><a href="http://www.atticrep.org/">Attic<i>Rep</i></a> <span style="font-weight:normal;">Celebrating the past &bull; Investing in the Future</span></div>
      <div style="font-size:20px;margin-top:5px;margin-bottom:4px;">
        <span style="font-size:17px;font-weight:normal;">at <a href=" http://bluestarartscomplex.com/">Blue Star Arts Complex</a>, <span class="programInfoTextSmall" style="font-size:10pt;line-height:18px;"><a href="https://www.google.com/maps/place/108+Blue+Star/@29.4094095,-98.4957518,933m/data=!3m1!1e3!4m2!3m1!1s0x865c58bb497b7483:0x88572f527dd38da2">108 Blue Star, San Antonio, TX,</a></span><br>
        <span class="programInfoTextSmall" style="font-size:10pt;line-height:18px;font-weight:normal;"></a> in the King William Cultural Arts District
        </span>
      </div>
		  <div style="font-size:20px;margin-top:8px;"><?php echo SSFRunTimeValues::getEventDatesDescriptionStringLong($showsEvent); ?>, 7:00 PM</div>
      <div style="font-size:15px;margin-top:8px;margin-bottom:0px;line-height:120%;color:#E49548;font-weight:normal;">Tickets $5 at the door</div>
		  <div style="font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;color:#E49548;font-weight:normal;">Different programs each evening</div>
      </div>
    </td>
  </tr>
  
<!-- BEGIN Shows and Works Display -->
	
<?php

  // Display the on-page index of shows within this event.

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
	HTMLGen::progPageDisplayShowIndex($showRows);
	
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
	    HTMLGen::progPageDisplayShowDescription($showId, $workRow['showDescription']);
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