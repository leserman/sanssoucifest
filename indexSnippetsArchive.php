

<?php
  include_once './bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())); 'l' is weekday, e.g.,, Friday
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  //SSFDB::debugNextQuery();
  $venueDescriptionQuery = 'SELECT eventDatesDescription1, venueDescription1 FROM venues join events on venueId = venue WHERE eventId = ' . $associatedEventId;
  $rows = SSFDB::getDB()->getArrayFromQuery($venueDescriptionQuery);
  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
  SSFDebug::globalDebugger()->belch('rows', $rows, -1);
  SSFDebug::globalDebugger()->becho('venueDescriptionString', $venueDescriptionString, -1);
?>


<!-- Dance Movies! -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:12px;color:#FFFF99;font-size:26px;">Sans Souci Festival of Dance Cinema</div>
                        <div  class="bodyTextLeadedOnBlack" style="padding:0;margin:2px auto 0 auto;width:36em;">is a niche film festival specializing in dance cinema<br>
                          and incorporating live performance.
                        </div>
	                    </td>
                    </tr>


<!-- 2012 Call for Entries -->
                    <tr>
                      <td align="center" valign="middle">
                        <div class="homeHeading1" style="margin-top:28px;margin-bottom:-4px;">Call for Entries &nbsp;&bull;&nbsp; Dance Cinema</div>
<!--                        <div class="callForEntriesText" style="text-align:center;">Sans Souci Festival of Dance Cinema invites submissions of<br>works that integrate dance and cinematography<br>for exhibition in Boulder CO USA <br>on <?php // echo $eventDatesDescriptionString;?>.</div> -->
                        <div class="callForEntriesText" style="text-align:center;">For exhibition in Boulder CO USA <br>on <?php echo $eventDatesDescriptionString;?>.</div>
<!--                           <div class="callForEntriesText" style="text-align:center;">We encourage submissions from all artists<br>regardless of credentials and affiliations.</div>
                     <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:16px;"><i>Deadlines: <?php // echo $earlyDeadlineString . ' and ' . $finalDeadlineString; ?></i></span></div>
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i>Deadline this week: <?php echo $finalDeadlineString; ?></i></span></div>
-->
                        <div class="callForEntriesText"style="text-align:center;"><span style="color:ffff99;font-size:20px;"><i><b>Closed</b></i><br><span class="bodyTextLeadedOnBlack">(The deadline was May 18.)</span></span></div>
<!--                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:8;"><a href="./danceCinemaCall2012.php">Read more</a> and <a href="./onlineEntryForm/entryForm2012.php">submit an entry</a>.</div> -->
                        <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:5;"><a href="./danceCinemaCall2012.php">Read more</a></div>
	                    </td>
                    </tr>


<!-- TX State San Marcos March 2013 as of 4/16/13 -->
                    <tr>
                      <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                        <div style="margin:30px 0 8px 0;text-align:center;">
                          <div class="homeHeading1" style="margin:0px 0 0px 0;line-height:130%;">
                            <span style="">Coming in Winter 2013</span>
                          </div>
                        San Antonio 
                          <div class="homeHeading1" style="color:#FFFF99;font-size:20px;margin:12px 0 0px 0;line-height:130%;">San Antonio, TX</div>
                          <div class="bodyTextLeadedOnBlack" style="color:#FFFF99;font-size:18px;font-weight:normal;font-style:italic;margin:2px 0;">
                            Fri&ndash;Sun, February 22&ndash;24, 2013
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="font-size:11px;font-weight:normal;color:#FFFF99;margin:2px 0 0px 0;line-height:130%;">
                            Shows begin at dusk.
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="font-size:18px;margin:0px 0 0px 0;line-height:130%;font-weight:normal;font-style:italic;">
                            <a href="http://www.thesanantonioriverwalk.com/directory/pearl-brewery">Pearl Brewery Amphitheater</a>
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="font-size:11px;font-weight:normal;color:#CCC;margin:2px 0 0px 0;line-height:130%;">
                            200 E. Grayson St., San Antonio, TX
                          </div>
                    	    <div class="bodyTextLeadedOnBlack" style="margin-top:2px;margin-bottom:0px;line-height:130%;color:#FFFFCC;font-weight:normal;font-size:13px;">
                            Includes live music and dance on February 22 & 23.
                          </div>
                    	    <div class="bodyTextLeadedOnBlack" style="margin-top:2px;margin-bottom:0px;line-height:130%;color:#CCC;font-weight:normal;font-size:13px;">
                            Presented by <a href="http://atticrep.org/site/sans-souci/">AtticRep</a>.
                          </div>
                        TX State 
                          <div class="homeHeading1" style="color:#FFFF99;font-size:20px;margin:20px 0 2px 0;line-height:130%;">Texas State University at San Marcos</div>
                          <div class="bodyTextLeadedOnBlack" style="color:#FFFF99;font-size:18px;font-weight:normal;font-style:italic;margin:2px 0;">
                            Thursday, March 7, 2013
                          </div>
                          <div class="bodyTextLeadedOnBlack" style="font-size:18px;margin:2px 0 0px 0;line-height:130%;font-weight:normal;font-style:italic;">
                            <a href="http://www.maps.txstate.edu/driving_maps/evans_driving.html">Evans Auditorium</a>
                          </div>
                    	    <div class="bodyTextLeadedOnBlack" style="margin-top:1px;margin-bottom:0px;line-height:130%;color:##FFFFCC;font-weight:normal;font-size:13px;">
                            Produced by <a href="http://www.theatreanddance.txstate.edu">Department of Theatre and Dance</a> and  
                            <a href="http://www.music.txstate.edu">School of Music</a>
                          </div>
                    	    <div class="bodyTextLeadedOnBlack" style="margin-top:5px;margin-bottom:0px;line-height:130%;color:##FFFFCC;font-weight:normal;font-size:12px;">Read more on the
                            <a href="http://events.txstate.edu/recurrences/13457">Texas State Calendar</a>&nbsp;or&nbsp;<a href="https://www.facebook.com/events/284967068296093/">Facebook.</a>
                          </div>
                        </div>
	                    </td>
                    </tr>


<!-- Our Calendar as of 4/10/13 -->
                    <tr>
                      <td><a name="danceCinemaDefinition"></a>
                      <div class="homeHeading1" style="margin-top:30px;margin-bottom:2px;">2013 Dates</div>
                      <div class="bodyTextLeadedOnBlack" style="padding:2px 40px 2px 40px;text-align:center;">
                        Our next <span style="color:#FFFF99;font-style:italic;">Call for Entries</span> to go out in mid-April<br>
                        with a <span style="color:#FFFF99;font-style:italic;">Final Submission Deadline</span> in early June and<br>
                        the <span style="color:#FFFF99;font-style:italic;">Annual Festival</span> on September 20 & 21, 2013.
                      </div>
                      <div class="bodyTextLeadedOnBlack" style="padding:6px 40px 2px 40px;text-align:center;">
            <?php
              $emailSignUpText = "subject=Add me to your email list for Calls for Entries&amp;";
              $emailSignUpText .= "body=Add me to your email list for Calls for Entries.%0D%0A%0D%0AName: %0D%0AEmail: %0D%0ACountry of residence: %0D%0A%0D%0A%0D%0A";
              $emailSignUpText .= "NOTE:%0D%0A%20%20%20%20Dear Sender,";
              $emailSignUpText .= "%0D%0A%20%20%20%20%20%20%20%20Please clear the domain name sanssoucifest.org";
              $emailSignUpText .= "%0D%0A%20%20%20%20%20%20%20%20in your spam filter so that you can receive our emails.";
              SSFDebug::globalDebugger()->becho('emailSignUpText', $emailSignUpText, -1);
            ?>
                        If you'd like to be notified when the Call for Entries goes out,<br>please sign up for our 
                        <a href="mailto:mailme@sanssoucifest.org? <?php echo $emailSignUpText?>">mailing list</a>.
                      </div>
                      </td>
                    </tr>


<!-- Sample Reel Link!  as of 4/16/13 -->
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


<!-- Boulder, 2012 as of 4/16/13 -->                 
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

             
<!-- Boulder, 2011  as of early 2012 -->
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


<!-- Curatorial Criteria  as of 4/16/13 -->
                    <tr>
                      <td><a name="danceCinemaDefinition"></a>
                      <div class="homeHeading1" style="margin-bottom:6px;">Curatorial Criteria</div>
                      <div class="bodyTextLeadedOnBlack" style="padding:2px 40px 2px 40px;text-align:left;"><span 
                        style="color:#FFFF99;font-style:italic;">Curatorial Criteria:</span> We're 
                        interested in film and video works that integrate dance and cinematography. When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Shorts are preferred. Documentaries and animations will be considered. Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</div>
                      </td>
                    </tr>


<!-- Film, Video, Camera, Cinema?  as of 4/16/13 -->
                    <tr>
                      <td class="bodyTextLeadedOnBlack">
                        <div class="homeHeading1" style="margin-bottom:8px;">Film, Video, Camera, Cinema?</div>
                        <div style="padding:2px 40px 2px 40px;text-align:center;">We thought about calling ourselves a <i>Dance Film Festival, </i>a <i>Video Dance Festival, 
                        </i>a <i>Dance Video Festival, </i> a <i>ScreenDance Festival</i>, or a <i>Dance for Camera Festival</i> but we settled on <i>Festival of Dance Cinema</i> 
                        because that seems to cover the bases best.</div></td>
                    </tr>


<!-- BEGIN Support SECTION as of 4/16/13 -->
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


