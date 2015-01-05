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
                  <table style="width:100%;border:0;align:center;margin:0;padding:0;background-color:#333">
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
<!-- Boulder, 2013 -->                 
                    <tr>
                      <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                        <div class="hideLinkUnderline">
                          <div style="margin:22px 0 0px 0;text-align:center;">
                            <div class="homeHeading1" style="margin:20px 0 0px 0;line-height:120%;">
<!--                              10th Annual Festivities <span style="font-weight:normal;font-size:13px;color:#FFFF99">in</span> <span style="font-size:17px;">Boulder, Colorado, USA</span> -->
                              10th Annual Festivities, 2013<!-- <br><span style="font-size:17px;">Boulder, Colorado, USA</span> -->
                            </div>
                            <div class="homeHeading1" style="margin:0px 0 0px 0;line-height:120%;font-size:17px;">Boulder, Colorado, USA</div>

                      	    <div style="font-size:18px;margin-top:4px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                      	      <span style="font-size:15px;font-weight:normal;">Five different programs: <a href="#sep">September</a>,  <a href="#oct">October/November</a>, <a href="#dec">December</a></span>
                      	   </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                              <a href="./programPages/programAtlas2013.php"><img src="./images/Stills2013/SSF2013PostcardFront403x312.jpg" alt="Click here to view program." title="Click here to view program." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;"></a>
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;"><span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>&quot;Outside in&quot; (2011), Tove Skeidsvoll & Petrus Sj&ouml;vik, Sweden
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Download postcard PDF: 
                                <a href="./PDF/Postcards/SSF2013PostcardFront.pdf">front</a> 3.5 MB, <a href="./PDF/Postcards/SSF2013PostcardBack.pdf">back</a> 3.4 MB
                              </div>

                            <div>
                              <div id="oct" class="homeHeading1" style="margin:14px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;">
                                Sundays, October 20 &amp; November 10&nbsp;&bull;&nbsp;<span style="font-size:14px;font-weight:normal;">4:00  &amp; 6:30 PM</span><br>
<!--                        	      <span style="font-size:15px;font-weight:normal;">Different <a href="./programPages/programAtlas2013.php">programs</a> on each date</span> -->
                        	      <span style="font-size:14px;font-weight:normal;">Different programs on each date</span><br>
                                
                              </div>
                        	    <div style="font-size:18px;margin-top:0px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">Boedecker Theater, <span style="font-weight:normal;">Dairy Center for the Arts</span></div>
                              <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">with support from and in partnership with Dairy Center for the Arts</div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Tickets: $7 - $10, 303-444-7328, <a href="http://www.thedairy.org/">thedairy.org</a>, or at the door</div>
                            </div>
  
                            <div>
                              <div id="dec" class="homeHeading1" style="margin:20px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;">Wednesday, December 4&nbsp;&bull;&nbsp;6:30 PM</div>	    <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://boulderlibrary.org/">Boulder Public Library Auditorium</a>&nbsp;&bull;&nbsp;FREE</div>
                              <div class="bodyTextLeadedOnBlack" style="margin02px 0;padding:0;">with support from and in partnership with<br><a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Film Series</a></div>
                            </div>

                        </div>

                            <div id="sep" class="homeHeading1" style="margin:20px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;">
                              Friday &amp; Saturday, September 20 &amp; 21
                            </div>
                      	    <div style="font-size:16px;margin-top:5px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"> <!-- #E49548 -->
                              7:00 PM Video installations &nbsp; &bull; &nbsp; 7:30 PM Screenings
                            </div>
                      	    <div style="font-size:18px;margin-top:2px;margin-bottom:0px;font-weight:bold;"><a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">Atlas Building</a>
                      	      <span class="programInfoTextSmall" style="font-weight:normal;">University of Colorado at Boulder</span>
                      	    </div>
                      	    <div style="font-size:18px;margin-top:4px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">FREE Admission &nbsp;&bull;&nbsp;
                      	      <span style="font-size:15px;font-weight:normal;">Different <a href="./programPages/programAtlas2013.php">programs</a> each evening</span>
                      	   </div>
  <!--
                            <div class="bodyTextLeadedOnBlack" style="margin-top:6px;">
                              <a href="./programPages/programAtlas2013.php">View the Program</a>
  <!                            View the Program <a href="./programPages/programAtlas2013.php">online</a> or in <a href="./PDF/ProgramSpreads/SSF2013ProgramSpreads.pdf">print</a> format (PDF) >
                              <! &nbsp;&bull;&nbsp; <a href="http://sanssouci.eventbrite.com">Reserve your seat</a> &nbsp;&bull;&nbsp; >
  -->
                            </div>
  <!--
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:12px 0 2px 0;padding:0;"><a href="./PDF/PressReleases/SansSouciPressRelease2012.pdf">Download Press Release PDF</a>, 2.1 MB
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:0px 0 2px 0;padding:0;"><a href="./PDF/Posters/SSF2012AtlasPromoPoster.pdf">Download 11x17" Promo Poster PDF</a>, 3.4 MB
                              </div>
  -->
                              <div  class="bodyTextLeadedOnBlack" style="padding:0;padding-right:0px;margin:10px auto 30px auto;width:30em;font-size:14px;line-height:130%;">
                                <span>with support from and in partnership with</span><br>
                                  the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater & Dance</a>,<br>
                                  all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>; and with<br>
                                  a <b>Neodata Endowment Grant</b> from<br>&nbsp;<a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-color-logo-6_11x100.jpg" style="vertical-align:middle;margin-top:3px;width:100px;height:36px;" alt="Boulder County Arts Alliance logo"></a>
                              </div>
  
                            </div>
                            
                      </td>
                    </tr>
           
<!-- 2013 Call for Entries 
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:28px;margin-bottom:-4px;">Call for Entries &nbsp;&bull;&nbsp; Dance Cinema</div>
                        <div class="callForEntriesText" style="text-align:center;">Sans Souci Festival of Dance Cinema invites submissions of<br>works that integrate dance and cinematography<br>for exhibition in Boulder CO USA <br>on <?php echo $eventDatesDescriptionString;?>.</div>
                        <div class="callForEntriesText" style="text-align:center;">We encourage submissions from all artists<br>regardless of credentials and affiliations.</div>
                     <div class="callForEntriesText"style="text-align:center;"><span style="color:#ffff99;font-size:16px;"><i>Deadlines: <?php echo $earlyDeadlineString . ' and ' . $finalDeadlineString; ?></i></span></div>
<!
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i>Deadline this week: <?php echo $finalDeadlineString; ?></i></span></div>
>
<!
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i><b>Closed</b></i><br><span class="bodyTextLeadedOnBlack">(The deadline was May 18.)</span></span></div>
>
                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:8px;"><a href="./<?php echo $danceCinemaCallFilename;?>">Read more</a> and <a href="./onlineEntryForm/<?php echo $entryFormFilename;?>">submit an entry</a>.</div>
<!
                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:5;"><a href="./danceCinemaCall2012.php">Read more</a></div>
>
	                    </td>
                    </tr>
-->

<!-- Sample Reel Link! -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:36px;margin-bottom:-20px;">Demo Reel</div>
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
                    
<!-- 2014 Call for Entries -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:36px;margin-bottom:6px;">Call for Entries</div>
                        <div class="bodyTextLeadedOnBlack" style="text-align:center;">Our next Call for Entries will be published in the Spring of 2014.<br>
                          If you'd like to be notified, please <a href="mailto:mailme@sanssoucifest.org?subject=Add me to your email list&amp;body=Edit below as appropriate.%0A%0AAdd me to your email list for Events.%0A%0AAdd me to your email list for Calls for Entries.%0A%0ARemove me from your email list.%0A%0A">join our mailing list</a>.
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
 <!-- BEGIN Artificial Vertical Spacer SECTION -->
                   <tr><td><div  style="margin-bottom:28px;"></div></td></tr>
 <!-- END Artificial Vertical Spacer SECTION -->
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