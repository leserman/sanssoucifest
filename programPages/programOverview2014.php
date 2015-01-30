<!DOCTYPE html>
<?php 
//  include_once '../bin/classes/SSFCodeBase.php'; 
//  SSFCodeBase::autoloadClasses(__FILE__);
  function my_autoloader($class) { 
    include '../bin/classes/' . $class . '.php';
  }
  spl_autoload_register('my_autoloader');
	SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
//  SSFProgramPageParts::initializePage(__FILE__, $doCache = false); 
?>
<?php              /* UPDATE THESE ITEMS */
//  SSFProgramPageParts::setShowsEvent(35);

  SSFProgramPageParts::$pageHeaderTitleText = '2014 Festival Overview';
  SSFProgramPageParts::$pageContentTitleText = 'Sans Souci in Boulder, CO, USA, 2014';
  SSFProgramPageParts::$pageContentTitleText = '';

//  SSFProgramPageParts::$pageHeaderTitleText = '<span style="margin:0 auto;text-align:center;">Sans Souci in Boulder, CO, USA, 2014</span>';
  SSFProgramPageParts::$pageHeaderTitleTextAlignment = 'topCenter'; // default is topLeft
//	SSFProgramPageParts::$programPicBorderWidthInPixels = '1';
//	SSFProgramPageParts::$programHighlightColor = '#586caf';
//  $onlineTicketsURL = 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media?utm_source=wordfly&amp;utm_medium=email&amp;utm_campaign=TheD.A.M.ShowBlast&amp;utm_content=version_A';
//  $programPageHeaderSnippet = '../snippets/2014DAMshowProgramPageHeader.html';
//  $fundingAcknowledgementSnippet = ''; // e.g., '../snippets/2014FundingAcknowledgement.html'
?>
<?php
/*
  // GET the number of shows in this event
  $showCountQuery = 'SELECT * from `shows` WHERE event = ' . $showsEvent;
  $showCountRows = SSFDB::getDB()->getArrayFromQuery($showCountQuery);
	SSFDebug::globalDebugger()->belch('showCountRows', $showCountRows, -1);
	$showCount = count($showCountRows);
*/
?>

<!-- <html lang="en"<?php echo SSFProgramPageParts::cacheString(); ?>> -->
<html lang="en">
  <head>
<?php 
  $pageTitle = 'Boulder, CO, USA, 2014';
  $allowRobotIndexing = false;
  echo SSFProgramPageParts::htmlHeadContent($pageTitle, $allowRobotIndexing); 
?>
    <style type="text/css">
      /* CSS inline style definitions go here. */
/*      td { padding:0;border:0px solid red;background-color:#2300ff;margin:0;border-collapse:collapse; }  */
      table { padding:0;margin:0;border-collapse:collapse; }
     .atVenue {margin-top:18px;}
    </style>
<?php 
  echo SSFProgramPageParts::cssMediaQueries(); 
?>
  </head>

    <body>
    <?php 
      echo SSFProgramPageParts::beginPageBody();
      SSFProgramPageParts::setContentColumnCount(1);
      echo SSFProgramPageParts::beginContentHeader();
     ?>
                  <div style='margin:0 auto 0 auto;'>
                      <div class="programInfoText" style="text-align:center;vertical-align:middle;padding-top:0px;">
                        <div class="hideLinkUnderline">

                          <!-- 2014 Festivities Section -->
                          <div style="text-align:center;">
                                                    
                            <!-- 2014 Festivities Headline -->
                            <div class="homeHeading1" style="margin:7px 0 0px 0;">11th Annual Festivities</div>
                            <div class="homeHeading1" style="margin:7px 0 0px 0;font-size:22;">September &amp; October, 2014</div>                            
                            <div class="homeHeading1" style="margin:5px 0 0px 0;font-size:16px;">Boulder, Colorado, USA</div>
                      	    <div class="bodyTextOnBlack" style="font-size:15px;margin:4px 0;line-height:19px;">Five unique programs at three venues:<br><a href="./programPages/programOverview2014.php/#atlas">CU Atlas Black Box</a>,  <a href="./programPages/programOverview2014.php/#boe">The Boe</a>, <a href="./programPages/programOverview2014.php/#bpl">Canyon Theater</a>
                      	   </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                              <img src="../images/Stills2014/SSF2014PostcardFront403x312.jpg" alt="2014 Publicity Postcard." style="width:403px;height:312px;margin:8px 0 0 -2px;border:solid #000 1px;">
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;"><span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>&quot;<a href="./programPages/programBoe2014.php#work_14-076">The Bridge</a>&quot; (2010), Caren McCaleb &amp; Ana Baer
                            </div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Download the postcard PDF: 
                                <a href="../PDF/Postcards/SSF2014PostcardFront.pdf">front</a>, <a href="../PDF/Postcards/SSF2014PostcardBack.pdf">back</a>
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
                              <div class="bodyTextLeadedOnBlack" style="margin-top:5px;">View the Program <a href="./programPages/programAtlas2014.php">online</a>
                               or in <a href="../PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf">print</a> format (PDF)</div>
                              <div  class="bodyTextLeadedOnBlack" style="padding:0;padding-right:0px;margin:10px auto 0px auto;width:30em;font-size:14px;line-height:130%;">
                                <span>with support from and in partnership with</span><br>
                                  the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                                  all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>
                              </div>
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
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Tickets: $6 - $11, 303-444-7328, <a href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD">online</a>, or at the door
                              </div>
                            </div>

                            <!-- BPL / Canyon Theater -->
                            <div class="atVenue" id="bpl">
                              <div class="homeHeading1" style="margin:0px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:18px;line-height:22px;"><span style="font-weight:normal;">at Canyon Theater</span><br>Monday, October 6<span style="font-weight:normal;">&nbsp;&bull;&nbsp;6:30 PM</span></div>
                              <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://boulderlibrary.org/">Boulder Public Library Auditorium</a>&nbsp;&bull;&nbsp;FREE</div>
                              <div class="bodyTextLeadedOnBlack" style="margin02px 0;padding:0;">with support from and in partnership with<br><a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Film Series</a>
                              </div>
                            </div>

                          </div><!-- 2014 Festivities Section -->
                          
                            <!-- Funded by -->
                      		  <div class="atVenue" style="width:90%;font-size:15px;margin:20px auto 2px auto;line-height:120%;color:#E49548;font-weight:normal;text-align:center;">
                      		    <div style="margin:0 auto 8px auto;text-align:center;border:0px red solid;">All partially funded by</div>
                      		    <div style="margin:0 auto 0 auto;text-align:center;border:0px yellow solid;">
                        		    <div style="margin:0 auto 0 auto;text-align:center;width:345px;border:0px green dashed;">
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission" style="width:156px;height:35px;margin:5px 0 5px 0;"></a></div>
                          		    <div style="float:left;padding-top:15px;border:0px pink dashed;">&nbsp;&nbsp;and&nbsp;&nbsp;</div>
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://bouldercountyarts.org"><img src="../images/logos/BCAA-color-logo-6_11.jpg" style="width:145px;height:45px;margin-top:0px;" alt="Boulder County Arts Alliance"></a></div>
                          		    <div style="clear:both;"></div>
                        		    </div>
                      		    </div>
                      		  </div>
                      		                        		    
                    		    <!-- Poster download -->
                            <div class="bodyTextLeadedOnBlack atVenue" style="font-size:14px;margin:20px 0 2px 0;padding:0;"><a href="../PDF/Posters/SSF2014AtlasPromoPoster.pdf">Download the 11x17" Promo Poster PDF</a></div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:4px 0 2px 0;padding:0;"><a href="../PDF/PressReleases/SansSouciPressRelease_2014.pdf">Download the Press Release PDF</a></div>

                          </div> <!-- END 2014 Festivities Section -->
                    		
                        </div> <!-- END div class hideLinkUnderline -->
                            
                      </div>

                      <div title='verticalSpace' style="margin:26px 0 0 0;"></div>

                  </div>

<?php
  echo SSFProgramPageParts::endContentHeader();
//  SSFProgramPageParts::showWorks();
  echo SSFProgramPageParts::endPageBody();
?>

</body>
</html>