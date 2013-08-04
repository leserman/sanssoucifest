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
/* ** CHANGE THIS ** */
.programHighlightColor {color: #000033;}
.programTitleColor {color: #22c47a;} /* 4255e1 5878e2 */
-->
</style>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
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
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="programTablePageBackground">
  <tr>
    <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br>
      <!-- ** CHANGE THIS ** -->
      <span class="programTitleColor">Highways Program, 2010</span><br>
    </td>
  </tr>
	<tr>
	  <td colspan="3" align="left" valign="top" class="programInfoText"><img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all"><a href="http://www.highwaysperformance.org/">Highways Performance Space &amp; Gallery</a><span class="programInfoTextTiny"> @ the 18th Street Arts Center</span><br>
      <!-- ** CHANGE THIS ** -->
		  <span class="programInfoTextSmall">1651 18th Street &#8226; Santa Monica, CA, USA<br> 
		  <span class="programInfoTextSmall">1/2 block N of Olympic &#8226; <a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=Highways+Performance+Space;+1651+18th+Street;+Santa+Monica,+CA,+USA&amp;jsv=128e&amp;sll=34.02332,-118.477443&amp;sspn=0.060182,0.062485&amp;ie=UTF8&amp;ei=hmbRSKCPHJ3uiwPj5N3xAQ&amp;cd=1&amp;cid=34023320,-118477443,1374057131672289811&amp;li=lmd&amp;z=15&amp;t=m" target="highwaysMap">map</a></span> &#8226; Tickets: 310.415.1459</span><br>
		      Friday &amp; Saturday, May 21 &amp; 22, 2010 at 8:30 pm<br>
  </tr>
  
<!-- BEGIN INSERT STUFF HERE -->
	
<?php

  // ** CHANGE THIS **
  $showsEvent = 12;
	$programPicBorderWidth = '2';
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
	
  // Display the on-page index of shows within this event.

	// GET THE SHOW DESCRIPTIONS
	$showRows = SSFQuery::selectShowsFor($showsEvent);
	HTMLGen::progPageDisplayShowIndex($showRows);

	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$workRows = SSFQuery::selectWorksForEvent($showsEvent);
//	$workRows = selectWorksForEvent($showsEvent);
  SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);


  // Get the list of images in the directories.
  $imagesDirectories = SSFQuery::getStillImageDirectories();
  $imageDirectoryFiles = '';
  $codeBase = SSFCodeBase::string(__FILE__);
  foreach ($imagesDirectories as $imagesDirectory) {
    if ($handle = opendir($codeBase . $imagesDirectory)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') { $imageDirectoryFiles .= ($codeBase . $imagesDirectory . $file . ', '); }
      }
      closedir($handle);
    }
  }
?>

                    <tr>
                      <td align="left" valign="middle" colspan="3">
                        <div style="margin:-10px 0px 24px 50px;">
                          <img 
                            src="../images/highwaysPostcardFront.jpg" alt="Highways, Santa Monica, May 21 & 22, 2010" 
                            title="Highways, Santa Monica, May 21 & 22, 2010" 
                            width="389" height="259" border="0" style="margin:8px 0 6px 0;border:solid gray 2px;"></a>
                          </div>
                        </div>
	                    </td>
                    </tr>

<?php
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