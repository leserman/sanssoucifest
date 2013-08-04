<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
  include_once './bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())); 'l' is weekday, e.g.,, Friday
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $entryFormFilename = 'entryForm' . $currentYearString . '.php';
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
  <title>Sans Souci Festival of Dance Cinema - Home</title>
  <link rel="icon" href="favicon.png" type="image/png">
<!--
  <script src="scripts/login.js" type="text/javascript"></script>
  <script src="scripts/validateEmailAddress.js" type="text/javascript"></script>
-->
  <link rel="stylesheet" href="sanssouci.css" type="text/css">
  <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
  <style type="text/css">
    .artistNews {font-size:14px;line-height:18px;text-align:center;color:#F9F9CC;padding:4px 0 4px 0;margin:auto;width:94%;}
  </style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
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
                  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
<!-- Dance Movies! -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:12px;color:#FFFF99;font-size:26px;">Sans Souci Festival of Dance Cinema</div>
                        <div  class="bodyTextLeadedOnBlack" style="padding:0;margin:2px auto 0 auto;width:36em;">is a niche film festival specializing in dance cinema<br>
                          and incorporating live performance.
                        </div>
	                    </td>
                    </tr>
<!-- 2013 -->                 
<!-- 2013 Call for Entries -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:28px;margin-bottom:-4px;">Call for Entries &nbsp;&bull;&nbsp; Dance Cinema</div>
                        <div class="callForEntriesText" style="text-align:center;">Sans Souci Festival of Dance Cinema invites submissions of<br>works that integrate dance and cinematography<br>for exhibition in Boulder CO USA <br>on <?php echo $eventDatesDescriptionString;?>.</div>
                        <div class="callForEntriesText" style="text-align:center;">We encourage submissions from all artists<br>regardless of credentials and affiliations.</div>
                     <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:16px;"><i>Deadlines: <?php echo $earlyDeadlineString . ' and ' . $finalDeadlineString; ?></i></span></div>
<!--
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i>Deadline this week: <?php echo $finalDeadlineString; ?></i></span></div>
-->
<!--
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i><b>Closed</b></i><br><span class="bodyTextLeadedOnBlack">(The deadline was May 18.)</span></span></div>
-->
                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:8;"><a href="./<?php echo $danceCinemaCallFilename;?>">Read more</a> and <a href="./onlineEntryForm/<?php echo $entryFormFilename;?>">submit an entry</a>.</div>
<!--
                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:5;"><a href="./danceCinemaCall2012.php">Read more</a></div>
-->
	                    </td>
                    </tr>


<!-- Sample Reel Link! -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:32px;margin-bottom:-20px;">Demo Reel</div>
                        <div class="bodyTextLeadedOnBlack" style="margin-top:28px;"><a href="./demoreel/"><img 
                            src="./images/Stills2011/11-150-NewLondonCalling-AllaKovgan-DemoReelStill.jpg"
                            width="240" height="135" alt="" style="border:1px black solid;"></a><br>
                          <div style="font-size:11px;margin:6px 0 4px 0;line-height:12px;">
                            <div style="font-size:12px;margin-bottom:2px;">Frame from &quot;New London Calling&quot; (2010)</div>
                            Robert Richter, Alla Kovgan, Kinodance, Alissa Cardone  &amp; Ingrid Schatz
                          </div>
                          <div style="font-size:15px;"><a href="./demoreel/">View Demo Reel</a></div>
                        </div>
	                    </td>
                    </tr>
<!-- Boulder, 2012 -->                 
                    <tr>
                      <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                        <div style="margin:30px 0 0px 0;text-align:center;">
                          <div class="homeHeading1" style="margin:38px 0 0px 0;">
                            Last year <span style="font-weight:normal;font-size:13px;color:#FFFF99">in</span> Boulder, Colorado, USA
                          </div>
                          <div class="homeHeading1" style="margin:3px 0 0px 0;color:#FFFF99;font-weight:normal;font-size:18px;">
                            Fri. &amp; Sat., Aug. 31 &amp; Sept. 1, 2012
                          </div>
                          <!--
                    	    <div style="font-size:16px;margin-top:3px;margin-bottom:0px;color:#E49548;font-weight:normal;">
                            7:00 PM: Video installation opens<br>7:30 PM: Films & live dance performance
                          </div>
                    	    <div style="font-size:18px;margin-top:3px;margin-bottom:0px;color:#E49548;font-weight:bold;">FREE Admission</div>
                    	    -->
                    	    <div style="font-size:20px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Atlas Building
                    	      <span class="programInfoTextSmall">University of Colorado at Boulder</span>
                    	      <span class="programInfoTextSmall" style="font-size:8pt;"><a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">directions</a></span>
                    	    </div>
                          <!-- <div class="programInfoTextSmall" style="color:#E49548;">University of Colorado at Boulder</div> -->
                          <div class="bodyTextLeadedOnBlack" style="margin-top:6px;">
                            View the Program <a href="./programPages/programAtlas2012.php">online</a> or in <a href="./PDF/ProgramSpreads/SSF2012ProgramSpreads.pdf">print</a> format (PDF)
                            <!-- &nbsp;&bull;&nbsp; <a href="http://sanssouci.eventbrite.com">Reserve your seat</a> &nbsp;&bull;&nbsp; -->
                          </div>
                          <a href="./programPages/programAtlas2012.php"><img src="./images/Stills2012/SSF2012PostcardFront403x312.jpg" alt="Click here to view program." title="Click here to view program." 
                            width="403" height="312" border="0" style="margin:12px 0 0 -2px;border:solid #000 1px;"></a>
                          <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                            <div class="bodyTextLeadedOnBlack" style="margin:8px 0 2px 0;padding:0;line-height:120%">2012 postcard</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:3px 0 0 0;padding:0;line-height:120%">with a frame from &quot;Beyond The Surface,&quot; 2011,</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:12px;margin:1px 0 0 0;color:#CCC;padding:0;line-height:120%">produced by Gloucestershire Dance, directed by Marie-Louise Flexen and Kevin Clifford, UK</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:5px 0 0 0;padding:0;line-height:120%">and a frame from &quot;Kild Mig Ihjel (Tickle Me to Death),&quot; 2010,</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:12px;margin:1px 0 0 0;padding:0;color:#CCC;line-height:120%">produced and directed by Maia Elisabeth S&ouml;rensen, Denmark.</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:2px 0;padding:0;">Download postcard PDF: 
                              <a href="./PDF/Postcards/SSF2012PostcardFront.pdf">front</a> 1 MB, <a href="./PDF/Postcards/SSF2012PostcardBack.pdf">back</a> 1.5 MB</div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:12px 0 2px 0;padding:0;"><a href="./PDF/PressReleases/SansSouciPressRelease2012.pdf">Download Press Release PDF</a>, 2.1 MB
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:0px 0 2px 0;padding:0;"><a href="./PDF/Posters/SSF2012AtlasPromoPoster.pdf">Download 11x17" Promo Poster PDF</a>, 3.4 MB
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
<!-- 2011 -->                 
<!-- Boulder, 2011 
                    <tr>
                      <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                        <div style="margin:40px 0 8px 0;text-align:center;">
                          <div class="homeHeading1" style="margin:0px 0 6px 0;">Fall 2011</div>
                          <div class="homeHeading1" style="margin:0px 0 0px 0;">Sans Souci Fest in Boulder, Colorado</div>
                          <div class="bodyTextLeadedOnBlack" style="margin-top:6px;">
                            <a href="http://sanssoucifest.org/programPages/programAtlas2011.php">View Atlas Program</a> &nbsp;&bull;&nbsp;
                            <a href="http://sanssoucifest.org/programPages/programBPL2011.php">View Boulder Public Library Program</a>
                          </div>
                          <img src="./images/Stills2011/SSF2011PostcardFront448x336.jpg" alt="" title="" 
                            width="448" height="336" border="0" style="margin:12px 0 0 -2px;border:solid #000 1px;">
                          <div class="bodyTextLeadedOnBlack" style="font-size:11px;margin:6px 0 8px 0;padding-bottom:0;text-align:center;line-height:120%"><span style="font-size:12px;">2011 
                            postcard with a frame from MELT (2010),</span><br>directed &amp; choreographed by Noémie Lafrance, produced by Natalie Galazka<br>
                            <div style="font-size:12px;margin-top:2px;">[Download postcard PDF: <a href="./PDF/Postcards/SSF2011PostcardFront.pdf">front</a> 0.9 MB, <a href="./PDF/Postcards/SSF2011PostcardBack.pdf">back</a> 0.3 MB]</div>
                          </div>
                        </div>
                      </td>
                    </tr>
-->
<!-- Curatorial Criteria -->
                    <tr>
                      <td><a name="danceCinemaDefinition"></a>
                      <div class="homeHeading1" style="margin-bottom:6px;">Curatorial Criteria</div>
                      <div class="bodyTextLeadedOnBlack" style="padding:2px 40px 2px 40px;text-align:left;"><span 
                        style="color:#FFFF99;font-style:italic;">Curatorial Criteria:</span> We're 
                        interested in film and video works that integrate dance and cinematography. When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Shorts are preferred. Documentaries and animations will be considered. Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</div>
                      </td>
                    </tr>
<!-- Film, Video, Camera, Cinema? -->
                    <tr>
                      <td class="bodyTextLeadedOnBlack">
                        <div class="homeHeading1" style="margin-bottom:8px;">Film, Video, Camera, Cinema?</div>
                        <div style="padding:2px 40px 2px 40px;text-align:center;">We thought about calling ourselves a <i>Dance Film Festival, </i>a <i>Video Dance Festival, 
                        </i>a <i>Dance Video Festival, </i> a <i>ScreenDance Festival</i>, or a <i>Dance for Camera Festival</i> but we settled on <i>Festival of Dance Cinema</i> 
                        because that seems to cover the bases best.</div></td>
                    </tr>
<!-- BEGIN Support SECTION -->
                    <tr>
                      <td align="center" valign="middle" class="bodyTextLeadedOnBlack">
                        <div style="margin-bottom:28px;">
                         <div class="homeHeading1" style="margin-bottom:8px;">Support</div>
                         <div style="margin-top:6px;margin-bottom:12px;">Sans Souci has received support from:</div>
                        <a href="http://www.artsresource.org/"><img src="images/logos/BAC-Low_Horizontal2.gif" 
                          alt="Boulder Arts Commission" width="200" height="45" hspace="2" vspace="0" border="0" align="middle"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                         <a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-GRN-logo200.gif" 
                           alt="Boulder Country Arts Alliance - BCAA" width="200" height="73" hspace="2" vspace="0" border="0" 
                           align="middle" title="Boulder Country Arts Alliance - BCAA"></a></div>
                      </td>
                    </tr>
<!-- END Support SECTION -->
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