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
  <link rel="stylesheet" href="sanssouci.css" type="text/css">
  <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
  <style type="text/css">
  .artistNews {font-size:14px;line-height:18px;text-align:center;color:#F9F9CC;padding:4px 0 4px 0;margin:auto;width:94%;}
  .atVenue {margin-top:18px;}
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
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight">
                    <!-- InstanceBeginEditable name="ProgramRegion" -->
                    <table style="width:100%;border:0;align:center;margin:0;padding:0;background-color:#333">
                      <!-- Dance Movies! -->
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:12px;color:#FFFF99;font-size:26px;">
                            Sans Souci Festival of Dance Cinema
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="padding:0;margin:2px auto 0 auto;width:36em;">
                            is a niche film festival specializing in dance cinema<br>
                            and incorporating live performance.
                          </div>
                        </td>
                      </tr>

<!-- Upcoming Programs -->

<!-- 2014 -->
<!-- Boulder, 2014 -->                 
                    <tr>
                      <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                        <div class="hideLinkUnderline">

                          <!-- 2014 Festivities Section -->
                          <div style="margin:22px 0 0px 0;text-align:center;">
                                                    
                            <!-- 2014 Festivities Headline -->
                            <div class="homeHeading1" style="margin:0px 0 0px 0;font-size:18;">Coming soon</div>
                            <div class="homeHeading1" style="margin:7px 0 0px 0;">11th Annual Festivities</div>
                            <div class="homeHeading1" style="margin:7px 0 0px 0;font-size:22;">September &amp; October, 2014</div>                            
                            <div class="homeHeading1" style="margin:5px 0 0px 0;font-size:16px;">Boulder, Colorado, USA</div>
<!--                      	    <div style="font-size:18px;margin-top:4px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                      	      <span class="bodyTextOnBlack" style="font-size:15px;font-weight:normal;line-height:19px;">Five unique programs at three venues:<br><a href="#atlas">CU Atlas Black Box</a>,  <a href="#boe">The Boe</a>, <a href="#bpl">Canyon Theater</a></span>
                      	   </div> -->
                      	    <div class="bodyTextOnBlack" style="font-size:15px;margin:4px 0;line-height:19px;">Five unique programs at three venues:<br><a href="#atlas">CU Atlas Black Box</a>,  <a href="#boe">The Boe</a>, <a href="#bpl">Canyon Theater</a>
                      	   </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                              <a href="./programPages/programAtlas2014.php"><img src="images/Stills2014/SSF2014PostcardFront403x312.jpg" alt="Click here to view program." title="Click here to view program." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;"></a>
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;"><span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>&quot;<a href="./programPages/programBoe2014.php#work_14-076">The Bridge</a>&quot; (2010), Caren McCaleb &amp; Ana Baer
                            </div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Download the postcard PDF: 
                                <a href="./PDF/Postcards/SSF2014PostcardFront.pdf">front</a>, <a href="./PDF/Postcards/SSF2014PostcardBack.pdf">back</a>
                              </div>
                            <!-- Boe -->
                            <div class="atVenue" id="boe">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;line-height:22px;"><span style="font-weight:normal;">at the Boe</span><br>
                                Sundays, September 21 &amp; October 19&nbsp;&bull;&nbsp;<span style="font-size:14px;font-weight:normal;">1 PM</span><br>
                        	      <span style="font-size:15px;font-weight:normal;">Different <a href="./programPages/programBoe2014.php">programs</a> on each date</span>
                              </div>
                        	    <div style="font-size:18px;margin-top:0px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">Boedecker Theater, <span style="font-weight:normal;">Dairy Center for the Arts</span>
                        	    </div>
                              <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">with support from and in partnership with Dairy Center for the Arts</div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Tickets: $6 - $11, 303-444-7328, <a href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD">online</a>, or at the door
                              </div>
                            </div>

                            <!-- BPL / Canyon Theater -->
                            <div class="atVenue" id="bpl">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;line-height:22px;"><span style="font-weight:normal;">at Canyon Theater</span><br>Monday, October 6<span style="font-weight:normal;">&nbsp;&bull;&nbsp;6:30 PM</span></div>
                              <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://boulderlibrary.org/">Boulder Public Library Auditorium</a>&nbsp;&bull;&nbsp;FREE</div>
                              <div class="bodyTextLeadedOnBlack" style="margin02px 0;padding:0;">with support from and in partnership with<br><a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Film Series</a>
                              </div>
                            </div>

                            </div>
                          
                            <!-- Atlas -->
                            <div class="atVenue" id="atlas">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;line-height:22px;"><span style="font-weight:normal;">at the Atlas Black Box</span><br>
                                Friday &amp; Saturday, September 5 &amp; 6
                              </div>
                        	    <div style="font-size:16px;margin-top:5px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"> 
                                7:00 PM Video installations &nbsp; &bull; &nbsp; 7:30 PM Screenings
                              </div>
                        	    <div style="font-size:18px;margin-top:3px;margin-bottom:0px;font-weight:bold;"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">Atlas Building</a>
                        	      <span class="programInfoTextSmall" style="font-weight:normal;">University of Colorado at Boulder</span>
                        	    </div>
                        	    <div style="font-size:18px;margin-top:4px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">FREE Admission &nbsp;&bull;&nbsp;
                        	      <span style="font-size:15px;font-weight:normal;">Different <a href="./programPages/programAtlas2014.php">programs</a> each evening</span>
                        	    </div>
                              <div class="bodyTextLeadedOnBlack" style="margin-top:5px;">View the Program <a href=". /programPages/programAtlas2014.php">online</a>
                               or in <a href="./PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf">print</a> format (PDF)
                              <div  class="bodyTextLeadedOnBlack" style="padding:0;padding-right:0px;margin:10px auto 0px auto;width:30em;font-size:14px;line-height:130%;">
                                <span>with support from and in partnership with</span><br>
                                  the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                                  all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>
                              </div>
                            </div>

                            <!-- Funded by -->
                      		  <div class="atVenue" style="width:90%;font-size:15px;margin:20px auto 2px auto;line-height:120%;color:#E49548;font-weight:normal;text-align:center;">
                      		    <div style="margin:0 auto 8px auto;text-align:center;border:0px red solid;">All partially funded by</div>
                      		    <div style="margin:0 auto 0 auto;text-align:center;border:0px yellow solid;">
                        		    <div style="margin:0 auto 0 auto;text-align:center;width:345px;border:0px green dashed;">
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission" style="width:156px;height:35px;margin:5px 0 5px 0;"></a>
                          		    </div>
                          		    <div style="float:left;padding-top:15px;border:0px pink dashed;">&nbsp;&nbsp;and&nbsp;&nbsp;</div>
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://bouldercountyarts.org"><img src="../images/logos/BCAA-color-logo-6_11.jpg" style="width:145px;height:45px;margin-top:0px;" alt="Boulder County Arts Alliance"></a>
                          		    </div>
                          		    <div style="clear:both;"></div>
                        		    </div>
                      		    </div>
                      		  </div>
                      		                        		    
                    		    <!-- Poster download -->
                            <div class="bodyTextLeadedOnBlack atVenue" style="font-size:14px;margin:20px 0 2px 0;padding:0;"><a href="./PDF/Posters/SSF2014AtlasPromoPoster.pdf">Download the 11x17" Promo Poster PDF</a>
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:4px 0 2px 0;padding:0;"><a href="./PDF/PressReleases/SansSouciPressRelease_2014.pdf">Download the Press Release PDF</a>
                            </div>

                          </div> <!-- END 2014 Festivities Section -->
                    		
                    		</div> <!-- END div class hideLinkUnderline -->
                            
                      </td>
                    </tr>

<!-- Demo Reel Link! -->
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:40px;margin-bottom:-20px;">
                            Demo Reel
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="margin-top:28px;">
                            <a href="./demoreel/"><img src="images/Stills2013/13-106-OutsideIn-ToveSkeidsvoll-DemoReelStill.jpg" width="240" height="135" alt="" style="border:1px black solid;"></a><br>
                            <div style="font-size:11px;margin:6px 0 4px 0;line-height:12px;">
                              <div style="font-size:12px;margin-bottom:4px;">
                                Frame from "Outside In" (2011)
                              </div>
                              Tove Skeidsvoll & Petrus Sj&ouml;vik
                            </div>
                            <div style="font-size:15px;">
                              <a href="./demoreel/">View Demo Reel</a>
                            </div>
                          </div>
                        </td>
                      </tr>

<!-- 2014 -->
                      <tr>
                        <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                          <div class="hideLinkUnderline">
                            <div class="homeHeading1" style="margin-top:40px;margin-bottom:6px;">Recent Programs</div>
                            <!-- event list Recent Programs  -->
                            <!-- Guatemala 2014 -->
                            <div class="homeHeading1" style="margin:8px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Thursday, June 5, 2014, 11:00 AM
                            </div>
                            <div style="font-size:16px;margin-top:0px;margin-bottom:0px;color:#FFFF99;font-weight:normal;line-height:1.3;"><a href="http://sanssoucifest.org/programPages/programGuatemala2014.php">Universidad de San Carlos de Guatemala</a><br>
                              <span style="font-size:14px;">Departamento de Danza de la Escuela Superior<br>Guatemala City, Guatemala</span>
                            </div>
                            <!-- AtticRep 2014 -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, March 28 &amp; 29, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://www.atticrep.org/">Attic<i>Rep</i></a> - <a href="/programPages/programAtticRep2014.php">Celebrating the past &bull; Investing in the Future</a><br><span style="font-size:14px;">at <a href=" http://bluestarartscomplex.com/">Blue Star Arts Complex</a> in San Antonio, TX, USA</span>
                            </div>
                            <!-- Roxy 2014 -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, March 7 &amp; 8, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://www.theroxytheater.org/">The Roxy</a> - <a href="/programPages/programRoxy2014.php">Kinetoscope at the Roxy</a><br><span style="font-size:14px;">Co-sponsored by <a href=" http://barebaitdance.org/">Bare Bait Dance</a> in Missoula, MT, USA</span>
                            </div>
                            <!-- 10th Annual Festivities -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">10th Annual Festivities, Fall 2013</div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;">Boulder, Colorado, USA</div>
                            <!-- Headline detail line -->
                            <div style="font-size:18px;margin-top:4px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                              <span style="font-size:15px;font-weight:normal;line-height:1.4;">Featuring four different programs:<br>
                              &mdash; <a href="./programPages/programOverview2013.php">Overview</a> &mdash;<br>
                              <a href="./programPages/programAtlas2013.php">September</a>,  <a href="./programPages/program2013FallDates.php#show59">October</a>,  <a href="./programPages/program2013FallDates.php#show60">November</a>, <a href="./programPages/program2013FallDates.php#show61">December</a></span>
                            </div>
<!-- Postcard 
                            <div>
                              <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                                <a href="./programPages/programOverview2013.php"><img src="images/Stills2013/SSF2013PostcardFront403x312.jpg" alt="Click here to view program overview." title="Click here to view program overview." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;"></a>
                              </div>
             postcard caption
                              <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                                <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;">
                                  <span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>
                                  "Outside in" (2011), Tove Skeidsvoll &amp; Petrus Sj&ouml;vik, Sweden
                                </div>

                                <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">
                                  thi PDF: <a href="./PDF/Postcards/SSF2013PostcardFront.pdf">front</a> 3.5 MB, <a href="./PDF/Postcards/SSF2013PostcardBack.pdf">back</a> 3.4 MB
                                </div>
                              </div>
-->

                          </div>
                        </td>
                      </tr>

<!-- 2014 Call for Entries -->
<?php 
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
  $emailAddr = SSFRunTimeValues::getContactEmailAddress();
?>
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:40px;margin-bottom:8px;">Call for Entries</div>
                        <div class="bodyTextLeadedOnBlack">Our 2014 Call for Entries closed on May 23, 2014</div>
                        <div class="bodyTextLeadedOnBlack" style="margin-top:8px;">If you'd like to receive notice of our 2015 Call for Entries in the Spring,<br>please <a href="mailto:<?php echo $listManagementEmailAddress ?>?subject=Add me to your email list&amp;body=Edit below as appropriate.%0A%0AAdd me to your email list for Events.%0AAdd me to your email list for Calls for Entries.%0ARemove me from your email list.%0A%0AFirst name: %0ALast name: %0ACountry of residence: %0AAnything else you'd like us to know: %0A">click here</a> to be added to our email mailing list.</div>
                      </td>
                    </tr>

<!-- Curatorial Criteria -->
                      <tr>
                        <td>
                          <a name="danceCinemaDefinition" id="danceCinemaDefinition"></a>
                          <div class="homeHeading1" style="margin-bottom:6px;">
                            Curatorial Criteria
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="padding:2px 40px 2px 40px;text-align:left;">
                            <span style="color:#FFFF99;font-style:italic;">Curatorial Criteria:</span> We're interested in film and video works that integrate dance and cinematography. When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Shorts are preferred. Documentaries and animations will be considered. Note that we are not interested in simple recordings of dance on a proscenium stage &mdash; cinematic elements must be an integral part of the entry.
                          </div>
                        </td>
                      </tr>

<!-- Film, Video, Camera, Cinema? -->
                      <tr>
                        <td class="bodyTextLeadedOnBlack">
                          <div class="homeHeading1" style="margin-bottom:8px;">
                            Film, Video, Camera, Cinema?
                          </div>
                          <div style="padding:2px 40px 2px 40px;text-align:center;">
                            We thought about calling ourselves a <em>Dance Film Festival,</em> a <em>Video Dance Festival,</em> a <em>Dance Video Festival,</em> a <em>ScreenDance Festival</em>, or a <em>Dance for Camera Festival</em> but we settled on <em>Festival of Dance Cinema</em> because that seems to cover the bases best.
                          </div>
                        </td>
                      </tr>
                      
<!-- BEGIN Artificial Vertical Spacer SECTION -->
                      <tr>
                        <td>
                          <div style="margin-bottom:28px;"></div>
                        </td>
                      </tr>
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
