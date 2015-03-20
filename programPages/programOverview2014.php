<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media?utm_source=wordfly&amp;utm_medium=email&amp;utm_campaign=TheD.A.M.ShowBlast&amp;utm_content=version_A';
  //  $fundingAcknowledgementSnippet = ''; // e.g., '../snippets/2014FundingAcknowledgement.html'

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();

  echo SSFProgramPageParts::beginContentHeader();
?>
            <div style="padding-left:60px;margin:0 auto 28px auto;text-align:center;">
              <style type="text/css" scoped>
                 /* td { padding:0;border:0px solid red;background-color:#2300ff;margin:0;border-collapse:collapse; }  */
                .atVenue { margin-top:30px; border:0px solid pink; }
                .contentArea section h2 { padding-top: 0px; }
                .contentArea .headerPart .title { text-align:center; }
                .contentArea .headerPart a:link, 
                .contentArea .headerPart a:visited { color: #006956; text-decoration: none; }
              </style>

              <div class="title primaryTextColor">11th Annual Festivities</div>
              <div class="title primaryTextColor">September &amp; October, 2014</div>                            
              <div class="subtitle primaryTextColor" style="margin:5px 0 0px 0;font-size:16px;">Boulder, Colorado, USA</div>
        	    <p class="locationLink dodeco">Five unique programs at three venues:<br>
          	    <a href="programPages/programOverview2014.php/#atlas">CU Atlas Black Box</a>,
          	    <a href="programPages/programOverview2014.php/#boe">The Boe</a>,
          	    <a href="programPages/programOverview2014.php/#bpl">Canyon Theater</a>
        	    </p>
              <div><img src="images/Stills2014/SSF2014PostcardFront403x312.jpg" alt="2014 Publicity Postcard." style="width:403px;height:312px;margin:8px 0 0 -2px;"></div>
              <div class="" style="margin:3px 0;">
                <p class="miscInfo">postcard with a frame from</p>
                <p>&quot;<a href="programPages/programBoe2014.php#work_14-076">The Bridge</a>&quot; (2010), Caren McCaleb &amp; Ana Baer</p>
                <p class="miscInfo dodeco" style="padding-top:3px;">Download the postcard PDF: <a href="PDF/Postcards/SSF2014PostcardFront.pdf">front</a>, <a href="PDF/Postcards/SSF2014PostcardBack.pdf">back</a></p>
              </div>
              <!-- Atlas -->
              <div class="atVenue" id="atlas">
                <h1 class="venueText secondaryTextColor">at the Atlas Black Box<br><span class="dateLine">Friday &amp; Saturday, September 5 &amp; 6</span></h1>
          	    <p style="margin-top:3px;">7:00 PM Video installations &nbsp; &bull; &nbsp; 7:30 PM Screenings</p>
          	    <p class="venueText secondaryTextColor" style="margin-top:3px;"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">Atlas Building</a>
          	      <span style="font-size:15px;">University of Colorado at Boulder</span>
          	    </p>
          	    <div class="quaternaryTextColor" style="font-size:18px;margin-top:4px;margin-bottom:0px;font-weight:bold;">FREE Admission &nbsp;&bull;&nbsp;
          	      <span style="font-size:15px;font-weight:normal;">Different <a class="dodeco" href="programPages/programAtlas2014.php">programs</a> each evening</span>
          	    </div>
                <div class="bodyText dodeco" style="margin-top:5px;">View the Program <a href="programPages/programAtlas2014.php">online</a>
                 or in <a href="PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf">print</a> format (PDF)</div>
                <div  class="bodyText" style="padding:0;padding-right:0px;margin:10px auto 0px auto;width:30em;font-size:14px;line-height:130%;">
                  <span>with support from and in partnership with</span><br>
                    the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                    the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                    the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                    all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>
                </div>
              </div>

              <!-- Boe -->
              <div class="atVenue" id="boe">
                <h1 class="venueText secondaryTextColor">at the Boe<br>Sundays, September 21 &amp; October 19&nbsp;&bull;&nbsp;<span class="timeText">1 PM</span></h1>
         	      <p>Different <a class="dodeco" href="programPages/programBoe2014.php">programs</a> on each date</p>
          	    <p class="venueText" style="margin-top:3px;">Boedecker Theater, <span class="minorSpan">Dairy Center for the Arts</span></p>
                <div class="bodyText" style="margin:2px 0;padding:0;">with support from and in partnership with Dairy Center for the Arts</div>
                <div class="ticketInfo">Tickets: $6 - $11, 303-444-7328, <a class="dodeco" href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD">online</a>, or at the door
                </div>
              </div>

              <!-- BPL / Canyon Theater -->
              <div class="atVenue" id="bpl">
                <h1 class="venueText secondaryTextColor">at Canyon Theater<br>Monday, October 6<span class="timeText">&nbsp;&bull;&nbsp;6:30 PM</span></h1>
                <p class="venueText"><a href="http://boulderlibrary.org/">Boulder Public Library Auditorium</a>&nbsp;&bull;&nbsp;<span class="quaternaryTextColor">FREE</span></p>
                <div class="bodyText" style="margin-top:2px;padding:0;">with support from and in partnership with<br><a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Film Series</a>
                </div>
          	    <p style="margin-top:3px;">View the <a class="dodeco" href="programPages/programBPL2014.php">program</a></p>
              </div>

              <!-- Funded by -->
        		  <div class="atVenue">
        		    <p class="primaryTextColor" style="margin-bottom:3px;font-weight:bold;">All partially funded by</p>
        		    <div style="margin:0 auto;text-align:center;width:350px;border:0px solid pink;">
          		    <div style="float:left;"><a href="http://www.artsresource.org/bac/"><img src="images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission" style="width:156px;height:35px;margin:5px 0 5px 0;"></a></div>
          		    <div style="float:left;padding-top:15px;font-size:14px;">&nbsp;&nbsp;and&nbsp;&nbsp;</div>
          		    <div style="float:left;"><a href="http://bouldercountyarts.org"><img src="images/logos/BCAA-color-logo-6_11.jpg" style="width:145px;height:45px;margin-top:0px;" alt="Boulder County Arts Alliance"></a></div>
          		    <div style="clear:both;"></div>
        		    </div>
        		  </div>
        		                        		    
      		    <!-- Poster download -->
              <div class="bodyText atVenue" style="font-size:14px;margin:20px 0 2px 0;padding:0;"><a href="PDF/Posters/SSF2014AtlasPromoPoster.pdf">Download the 11x17" Promo Poster PDF</a></div>
              <div class="bodyText" style="font-size:14px;margin:4px 0 2px 0;padding:0;"><a href="PDF/PressReleases/SansSouciPressRelease_2014.pdf">Download the Press Release PDF</a></div>

        </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  echo SSFProgramPageParts::endPageBody();
?>
</html>