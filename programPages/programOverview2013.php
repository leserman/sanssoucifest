<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  //  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
  
  // Initialize useful PHP variables.
  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();  
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();

  echo SSFProgramPageParts::beginContentHeader();
?>
            <div style="margin:0 auto;text-align:center;">
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; } /* 3b2873 */
                .artistNews { font-size:14px;line-height:18px;text-align:center;color:#F9F9CC;padding:4px 0 4px 0;margin:auto;width:94%; }
                .contentArea section h2 { padding-top: 0px; }
                .contentArea .headerPart .title { text-align:center; }
                .contentArea .headerPart a:link, 
                .contentArea .headerPart a:visited { color: #006956; text-decoration: none; }
              </style>
              
              <!-- Boulder, 2013 -->
              <div>
                <div class="venueText secondaryTextColor" style="font-size:22px;margin:16px 0 0 0;line-height:120%;">10th Annual Festivities, 2013</div>
                <div class="venueText secondaryTextColor" style="font-size:17px;">Boulder, Colorado, USA</div>

                <!-- Headline detail line -->
                <div class="dodeco" style="font-size:18px;margin-top:18px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                  <span class="miscInfo" style="font-size:15px;font-weight:normal;line-height:1.4;">Featuring four different programs:<br><span style="font-size:18px;"><a href="programPages/programAtlas2013.php">September</a>,  <a href="programPages/program2013FallDates.php#show59">October</a>,  <a href="programPages/program2013FallDates.php#show60">November</a>, <a href="programPages/program2013FallDates.php#show61">December</a></span></span>
                </div>

                <!-- Postcard -->
                <div>
                  <div class="bodyTextLeadedOnBlack" style="margin:18px 0 0 0;">
                    <img src="images/Stills2013/SSF2013PostcardFront403x312.jpg" alt="" title="Click here to view program." style="width:403px;height:312px;margin:8px 0 0 -2px;border:solid #000 1px;">
                  </div>
                  <!-- postcard caption -->
                  <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                    <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;">
                      <span class="miscInfo">postcard with a frame from</span><br>
                      "Outside in" (2011), Tove Skeidsvoll &amp; Petrus Sj&ouml;vik, Sweden
                    </div>
                    <div class="miscInfo" style="margin-top:2px;">
                      Download postcard PDF: <a href="PDF/Postcards/SSF2013PostcardFront.pdf">front</a> 3.5 MB, <a href="PDF/Postcards/SSF2013PostcardBack.pdf">back</a> 3.4 MB
                    </div>
                  </div>
                </div>
                
                <!-- event list 2013 Recent Programs -->
                <div class="venueText" style="padding:28px 0 16px 0;">Program Synopsis</div>

                <!-- Atlas -->
                <div>
                  <div id="sep" class="tertiaryTextColor" style="margin-top:0;font-weight:bold;font-size:18px;">Friday &amp; Saturday, September 20 &amp; 21</div>
                  <p class="secondaryTextColor" style="margin-bottom:3px;">Different <a href="programPages/programAtlas2013.php">programs</a> each evening</p>
                  <p class="secondaryTextColor"> 7:00 PM Video installations &nbsp; &bull; &nbsp; 7:30 PM Screenings</p>
                  <p style="font-size:18px;margin-top:2px;margin-bottom:0px;font-weight:bold;">
                    <a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">Atlas Building</a> <span class="secondaryTextColor" style="font-size: 14px;font-weight:normal;">University of Colorado at Boulder</span>
                  </p>
                  <div class="quaternaryTextColor" style="font-size:18px;margin-top:5px;margin-bottom:0px;font-weight:bold;">FREE Admission</div>
                  <div class="bodyTextLeadedOnBlack" style="padding:0;padding-right:0px;margin:4px auto 0px auto;width:30em;font-size:14px;line-height:130%;">
                    <span>with support from and in partnership with</span><br>
                    the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                    the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                    the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                    all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>; and with<br>
                    a <strong>Neodata Endowment Grant</strong> from<br>
                    &nbsp;<a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-color-logo-6_11.jpg" style="vertical-align:middle;margin-top:3px;width:125px;height:45px;" alt="Boulder County Arts Alliance logo"></a>
                  </div>
                </div>

                <!-- Boedecker at Dairy -->
                <div>
                  <div id="oct" class="venueText" style="margin:28px 0 0px 0;font-weight:bold;font-size:18px;">
                    <span class="tertiaryTextColor">Sundays, October 20 &amp; November 10&nbsp;&bull;&nbsp;<span style="font-size:14px;font-weight:normal;">4:00 &amp; 6:30 PM</span></span><br>
                     <span style="font-size:14px;font-weight:normal;">Different <a href="programPages/program2013FallDates.php">programs</a> on each date</span><br>
                  </div>
                  <div class="secondaryTextColor" style="font-size:18px;margin-top:4px;margin-bottom:0px;font-weight:bold;">
                    Boedecker Theater, <span style="font-weight:normal;">Dairy Center for the Arts</span>
                  </div>
                  <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">
                    with support from and in partnership with Dairy Center for the Arts
                  </div>
                  <div class="bodyTextLeadedOnBlack" style="width:100%;font-size:14px;margin:2px auto 2px auto;line-height:120%;font-weight:normal;text-align:center;">and with funding from<br><a href="http://www.artsresource.org/bac/"><img src="images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission logo" style="width:156px;height:35px;margin:3px 0;"></a><br>an agency of the Boulder City Council
                  </div>
                </div>
                  
                <!-- BPL - library -->
                <div>
                  <div id="dec" style="margin:28px 0 0px 0;font-weight:bold;font-size:18px;">
                    <span class="tertiaryTextColor">Wednesday, December 4&nbsp;&bull;&nbsp;6:30 PM</span><br>
                     <span style="font-size:14px;font-weight:normal;padding-top:8px;padding-bottom:3px;">View the <a href="programPages/program2013FallDates.php#show61">program</a>.</span><br>
                  </div>
                  <div class="secondaryTextColor" style="font-size:16px;margin-top:2px;margin-bottom:0px;font-weight:bold;">
                    Canyon Theater, <a href="http://boulderlibrary.org/">Boulder Public Library</a>&nbsp;&bull;&nbsp;FREE
                  </div>
                  <div class="bodyTextLeadedOnBlack" style="margin:2px 0;padding:0;">
                    with support from and in partnership with<br>
                    <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>
                  </div>
            		  <div class="bodyTextLeadedOnBlack" style="width:100%;font-size:14px;margin:2px auto 2px auto;line-height:120%;font-weight:normal;text-align:center;">and with funding from<br><a href="http://www.artsresource.org/bac/"><img src="images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission logo" style="width:156px;height:35px;margin:3px 0;"></a><br>an agency of the Boulder City Council
            		  </div>
                </div>
                
              </div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  // Display the program index and listings
//  SSFProgramPageParts::showWorks(); NO WORKS HERE
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
