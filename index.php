<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('Sans Souci Festival of Dance Cinema');  // This is the official HTML head title. It appears in the tab.
  SSFWebPageParts::setContentTitleText('<div style="margin:0 auto;text-align:center;">Sans Souci Festival of Dance Cinema</div>');  // The is the title of the page in the Content Area.
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
	SSFWebPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse;23skido:0; }');  
  
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


  echo SSFWebPageParts::getHtmlLine();
  echo SSFWebPageParts::getHeader();
  echo SSFWebPageParts::beginPageBody();
  echo SSFWebPageParts::beginContentHeader();

?>

<!-- <div class="bodyTextLeadedOnBlack" style="padding:0;margin:2px auto 0 auto;width:36em;"> -->
<div style="margin:0 auto;text-align:center;">is a niche film festival specializing in dance cinema<br>and incorporating live performance.</div>
                          
<?php
  echo SSFWebPageParts::endContentHeader();


?>

<table class="pageContent" style="border:red 1px solid;margin:0 auto;text-align:center;">

<!-- Demo Reel Link! -->
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:40px;margin-bottom:-20px;">
                            Sample Reel
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="margin-top:28px;">
                            <a href="./demoreel/"><img src="images/Stills2014/14-083-Gaia-NickGraalman_DemoReelStill.jpg" width="240" height="135" alt="" style="border:1px black solid;"></a><br>
                            <div style="font-size:11px;margin:6px 0 4px 0;line-height:12px;">
                              <div style="font-size:12px;margin-top:4px;margin-bottom:4px;">
                                Frame from "Gaia" (2014)
                              </div>
                              Nick Graalman & Erin Fowler
                            </div>
                            <div style="font-size:13px;">
                              <a href="./demoreel/">View our 5-minute reel.</a>
                            </div>
                          </div>
                        </td>
                      </tr>


<!-- 2015 Call for Entries -->
<?php 
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
  $emailAddr = SSFRunTimeValues::getContactEmailAddress();
?>
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:40px;margin-bottom:8px;">Call for Entries</div>
<!--                        <div class="bodyTextLeadedOnBlack">Our 2014 Call for Entries closed on May 23, 2014</div> -->
                        <div class="bodyTextLeadedOnBlack" style="margin-top:8px;">If you'd like to receive notice of our 2015 Call for Entries in the Spring,<br>please <a href="mailto:<?php echo $listManagementEmailAddress ?>?subject=Add me to your email list&amp;body=Edit below as appropriate.%0A%0AAdd me to your email list for Events.%0AAdd me to your email list for Calls for Entries.%0ARemove me from your email list.%0A%0AFirst name: %0ALast name: %0ACountry of residence: %0AAnything else you'd like us to know: %0A">click here</a> to be added to our email mailing list.</div>
                      </td>
                    </tr>

<!-- 2014 -->
<!-- Boulder, 2014 -->
                      <tr>
                        <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                          <div class="hideLinkUnderline">
                            <div class="homeHeading1" style="margin-top:44px;margin-bottom:6px;">Recent Programs</div>
                            <!-- event list Recent Programs  -->

                          <!-- 2014 Festivities Section -->
                          <div style="margin:22px 0 0px 0;text-align:center;">
                                                    
                            <!-- 2014 Festivities Headline -->
<!--                            <div class="homeHeading1" style="margin:0px 0 0px 0;font-size:18;">Coming soon</div> -->
                            <div class="homeHeading1" style="margin:7px 0 0px 0;font-size:20px;line-height:normal;">11th Annual Festivities</div>
                            <div class="homeHeading1" style="margin:3px 0 0px 0;font-size:18px;line-height:normal;">September &amp; October, 2014</div>                            
                            <div class="homeHeading1" style="margin:4px 0 0px 0;font-size:16px;line-height:normal;">Boulder, Colorado, USA</div>
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

                    		    <!-- Poster download -->
                            <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:8px 0 0 0;padding:0;"><a href="./PDF/Posters/SSF2014AtlasPromoPoster.pdf">Download the 11x17" Promo Poster PDF</a></div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:0;padding:0;"><a href="./PDF/PressReleases/SansSouciPressRelease_2014.pdf">Download the Press Release PDF</a></div>



                            <!-- Atlas -->
                            <div class="atVenue" id="atlas">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:15px;">Friday &amp; Saturday, September 5 &amp; 6
                              </div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">Atlas Building</a>,
                        	      <span class="programInfoTextSmall">University of Colorado at Boulder</span>
                        	    </div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;">Different <a href="./programPages/programAtlas2014.php">programs</a> each evening
                        	    </div>
                              <div class="bodyTextLeadedOnBlack" style="margin-top:2px;">View the Program <a href=". /programPages/programAtlas2014.php">online</a>
                               or in <a href="./PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf">print</a> format (PDF)
                            </div>

                            <!-- Boe -->
                            <div class="atVenue" id="boe">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:15px;">Sundays, September 21 &amp; October 19</div>
                              <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Different <a href="./programPages/programBoe2014.php">programs</a> on each date</div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Boedecker Theater, Dairy Center for the Arts</div>
                            </div>

                            <!-- BPL / Canyon Theater -->
                            <div class="atVenue" id="bpl">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:15px;">Monday, October 6</div>
                              <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Canyon Theater, <a href="http://boulderlibrary.org/">Boulder Public Library</a></div>
                            </div>

                            </div>
                          
                            <!-- Funded by -->
                      		  <div class="atVenue" style="width:90%;font-size:14px;margin:20px auto 2px auto;line-height:120%;color:#E49548;font-weight:normal;text-align:center;">
                      		    <div style="margin:0 auto 8px auto;text-align:center;border:0px red solid;">All above partially funded by</div>
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
                      		                        		    
                          </div> <!-- END 2014 Festivities Section -->
                    		
                    		</div> <!-- END div class hideLinkUnderline -->
                    		
                    		                            <div class="homeHeading1" style="margin:26px 0 0px 0;font-size:18px;line-height:normal;">Other Recent Programs</div>                            

                            <!-- Roxy 2014-12 -->
                            <div class="homeHeading1" style="margin:8px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, December 5 &amp; 6, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="/programPages/programRoxy2014-12.php">Kinetoscope at the Roxy, Dec., 2014</a><br><span style="font-size:14px;">Co-sponsored by <a href=" http://barebaitdance.org/">Bare Bait Dance</a> in Missoula, MT, USA</span>
                            </div>

                          </div>
                        </td>
                      </tr>

<!-- Curatorial Criteria -->
                      <tr>
                        <td style="max-width:500px;">
                          <a name="danceCinemaDefinition" id="danceCinemaDefinition"></a>
                          <div class="homeHeading1" style="margin-bottom:6px;">
                            Curatorial Criteria
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="margin:0 auto;padding:2px 40px 2px 40px;text-align:left;">
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

<?php
  echo SSFProgramPageParts::endPageBody();
?>

</html>
