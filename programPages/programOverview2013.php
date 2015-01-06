<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
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
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">

  <title>Sans Souci Festival of Dance Cinema - 2013 Programs</title>
  <link rel="icon" href="../favicon.png" type="image/png">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
            <td colspan="3" align="left" valign="top"><a href="index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
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
                    <table style="width:100%;border:0;align:center;margin:0;padding:0;background-color:#333">
                      <!-- Dance Movies! -->
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:12px;color:#FFFF99;font-size:26px;">
                            Sans Souci Festival of Dance Cinema
                          </div>
                        </td>
                      </tr>

<!-- 2013 -->
                      <!-- Boulder, 2013 -->
                      <tr>
                        <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                          <div class="hideLinkUnderline">
                            <div class="homeHeading1" style="margin:16px 0 0px 0;line-height:120%;">
                              10th Annual Festivities, 2013
                            </div>
                            <div class="homeHeading1" style="margin:0px 0 0px 0;line-height:120%;font-size:17px;">
                              Boulder, Colorado, USA
                            </div>
                            <!-- Headline detail line -->
                            <div style="font-size:18px;margin-top:18px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                              <span style="font-size:15px;font-weight:normal;line-height:1.4;">Featuring four different programs:<br><span style="font-size:18px;"><a href="./programAtlas2013.php">September</a>,  <a href="./program2013FallDates.php#show59">October</a>,  <a href="./program2013FallDates.php#show60">November</a>, <a href="./program2013FallDates.php#show61">December</a></span></span>
                            </div>
                            <!-- Postcard -->
                            <div>
                              <div class="bodyTextLeadedOnBlack" style="margin:18px 0 0 0;">
                                <img src="../images/Stills2013/SSF2013PostcardFront403x312.jpg" alt="" title="Click here to view program." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;">
                              </div>
                              <!-- postcard caption -->
                              <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                                <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;">
                                  <span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>
                                  "Outside in" (2011), Tove Skeidsvoll &amp; Petrus Sj&ouml;vik, Sweden
                                </div>
                                <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">
                                  Download postcard PDF: <a href="./PDF/Postcards/SSF2013PostcardFront.pdf">front</a> 3.5 MB, <a href="./PDF/Postcards/SSF2013PostcardBack.pdf">back</a> 3.4 MB
                                </div>
                              </div>
                            </div>
                            <!-- event list 2013 Recent Programs -->
                            <div class="homeHeading1" style="margin:28px 0 16px 0;line-height:120%;font-size:22px;">Program Synopsis</div>

                            <div>
                              <!-- Atlas -->
                              <div id="sep" class="homeHeading1" style="margin-top:0;color:#FFFF99;font-weight:bold;font-size:18px;color:#E49548;">
                                Friday &amp; Saturday, September 20 &amp; 21
                              </div>
                              <div style="font-size:18px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:bold;"><span style="font-size:15px;font-weight:normal;">Different <a href="./programAtlas2013.php">programs</a> each evening</span>
                              </div>
                              <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"> <!-- #E49548 -->
                                7:00 PM Video installations &nbsp; &bull; &nbsp; 7:30 PM Screenings
                              </div>
                              <div style="font-size:18px;margin-top:2px;margin-bottom:0px;font-weight:bold;">
                                <a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">Atlas Building</a> <span class="programInfoTextSmall" style="font-weight:normal;">University of Colorado at Boulder</span>
                              </div>
                              <div style="font-size:18px;margin-top:4px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">
                                FREE Admission
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="padding:0;padding-right:0px;margin:4px auto 0px auto;width:30em;font-size:14px;line-height:130%;">
                                <span>with support from and in partnership with</span><br>
                                the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                                the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                                the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                                all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>; and with<br>
                                a <strong>Neodata Endowment Grant</strong> from<br>
                                &nbsp;<a href="http://www.bouldercountyarts.org/"><img src="../images/logos/BCAA-color-logo-6_11.jpg" style="vertical-align:middle;margin-top:3px;width:125px;height:45px;" alt="Boulder County Arts Alliance logo"></a>
                              </div>
                            </div>

                            <div>
                              <!-- Boedecker at Dairy -->
                              <div id="oct" class="homeHeading1" style="margin:28px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;">
                                <span style="color:#E49548;">Sundays, October 20 &amp; November 10&nbsp;&bull;&nbsp;<span style="font-size:14px;font-weight:normal;">4:00 &amp; 6:30 PM</span></span><br>
                                 <span style="font-size:14px;font-weight:normal;">Different <a href="./program2013FallDates.php">programs</a> on each date</span><br>
                              </div>
                              <div style="font-size:18px;margin-top:0px;margin-bottom:0px;color:#FFFF99;font-weight:bold;">
                                Boedecker Theater, <span style="font-weight:normal;">Dairy Center for the Arts</span>
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">
                                with support from and in partnership with Dairy Center for the Arts
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="width:100%;font-size:14px;margin:2px auto 2px auto;line-height:120%;font-weight:normal;text-align:center;">and with funding from<br><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission logo" style="width:156px;height:35px;margin:3px 0;"></a><br>an agency of the Boulder City Council
                              </div>
                            </div>
                              
                            <div>
                              <!-- BPL - library -->
                              <div id="dec" class="homeHeading1" style="margin:28px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;">
                                <span style="color:#E49548;">Wednesday, December 4&nbsp;&bull;&nbsp;6:30 PM</span><br>
                                 <span style="font-size:14px;font-weight:normal;">View the <a href="./program2013FallDates.php#show61">program</a>.</span><br>
                              </div>
                              <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;">
                                Canyon Theater, <a href="http://boulderlibrary.org/">Boulder Public Library</a>&nbsp;&bull;&nbsp;FREE
                              </div>
                              <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">
                                with support from and in partnership with<br>
                                <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>
                              </div>
                        		  <div class="bodyTextLeadedOnBlack" style="width:100%;font-size:14px;margin:2px auto 2px auto;line-height:120%;font-weight:normal;text-align:center;">and with funding from<br><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission logo" style="width:156px;height:35px;margin:3px 0;"></a><br>an agency of the Boulder City Council
                        		  </div>
                            </div>
                            
                          </div> <!-- hideLinkUnderline -->

                        </td>
                      </tr>
                      
<!-- BEGIN Artificial Vertical Spacer SECTION -->
                      <tr>
                        <td>
                          <div style="margin-bottom:40px;"></div>
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
