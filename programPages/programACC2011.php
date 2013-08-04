<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - ACC 2011 Program</title>
<style type="text/css">
<!--
.programHighlightColor {color: #70B760; } /* 666, e49548 6A774B */ 
a.special:link { color : #FFFF99; text-decoration: none; }
a.special:visited { color : #FFFF99; text-decoration: none; }  /* was #9900CC */
a.special:hover { color : #990000; text-decoration: underline; }
-->
</style>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<!--        <table width="950" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> -->
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
<!--            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="805" height="63" hspace="0" vspace="8" border="0" align="top"></a></td> -->
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
<!--            <td width="805" align="center" valign="top"> -->
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="programTablePageBackground">
  <tr>
    <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br>
		  <div class="programHighlightColor" style="font-size:18px;margin-top:-4px;margin-bottom:4px;">Presented by the ACC Dance Department</div>
      <span class="programHighlightColor">Austin Community College <span style="font-size:15px;">(<a href="http://austincc.edu">ACC</a>)</span></span>
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText" style="padding-top:6px;">
	    <div style="font-size:20px;margin-top:14px;margin-bottom:0px;line-height:18px;">Gallery Theatre, Rio Grande Campus
	    </div>
		  <div class="programInfoTextSmall" style="margin-top:2px;">1212 Rio Grande St., Austin, TX, USA</div>
		  <div style="font-size:20px;margin-top:16px">Thursday, October 6, 2011, 6 p.m.</div>
		  <div class="filmInfoSubtitleText" style="font-weight:normal;margin-top:14px;line-height:130%;">Including student work by<br>Amie Elyn, Ale Madera, Hallie Odom, Trevor Revis, and Giovanni Sanchez</div>
    </td>
  </tr>
<!--  <tr><td height="30" colspan="3" align="center" valign="top" class="bodyText">&nbsp;</td></tr> -->
  
<!-- BEGIN Shows and Works Display -->
	
<?php
  $showsEvent = 16;
	$programPicBorderWidth = '1';
  $emptyImageDefaultHeightInPixels = '101';
  $emptyImageDefaultWidthInPixels = '180';
	
  // Display the on-page index of shows within this event.

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
//	$showRows = array();
//	HTMLGen::progPageDisplayShowIndex($showRows, 'Program details will appear here in mid-August.');

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	//SSFDB::debugNextQuery();
	$workRows = SSFQuery::selectWorksForEvent($showsEvent);
	SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);

  // Get the list of images in the directories.
  $imagesDirectories = SSFQuery::getStillImageDirectories();
  $imageDirectoryFiles = '';
  $codeBase = '../';
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

<!-- END Shows and Works Display -->

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