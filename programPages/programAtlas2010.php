<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  
  
  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
//  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';

/*
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
*/
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
  $filename = SSFWebPageParts::getFilename();

  echo SSFProgramPageParts::beginContentHeader();
?>
            <div id="<?php echo $filename; ?>" class="eventHeader">
              <style type="text/css" scoped>
                .freeAdmissionSpan { font-size:16px; color:<?php echo $quaternaryTextColor; ?>}
                .comeEarly { font-size:14px;margin-top:9px;margin-bottom:12px;line-height:130%;font-weight:normal; }
                .showDescriptionHeader { color: <?php echo $programHighlightColor; ?> }
                .headerLine2 { font-size: 14px; }
              </style>
              <h2 class="secondaryTextColor">Atlas
                <span class="nodeco"><a class="secondaryTextColor" style="font-size:18px;font-weight:bold;color:<?php echo $secondaryTextColor; ?>" href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a></span>
                <span class="programInfoText tiny dodeco"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">directions</a></span><br>
                <span class="headerLine2">University of Colorado at Boulder, Boulder, CO, USA</span>
        	    </h2>
              <div class="eventDate primaryTextColor">Friday &amp; Saturday, September 10 &amp; 11, 2010</div>
<?php SSFProgramPageParts::showIndex(false); ?>
              <!-- Schedule links -->
        		  <div class="bodyText topCenter" style="padding:0px 120px 15px 0;"><a href="programPages/scheduleAtlas2010.php">Full Schedule</a>&nbsp;&nbsp;&nbsp;&nbsp;
        		    <a href="programPages/scholarlyPanelAtlas2010.php">Scholarly Panel</a>
        		  </div>
        		  <!-- postcard -->
              <div class="topCenter" style="padding-right:120px;">  
                <a href="programPages/programAtlas2010.php"><img src="images/Stills2010/SansSouciPostcard2010.jpg" alt="Click to see the Detail Program." title="Click to see the Detail Program." style="margin:0px auto 6px auto;align-content:center;width:402px;height:312px"></a>
                <div class="bodyText" style="font-size:11px;margin:0 auto 14px auto;padding-bottom:0;text-align:center;">
                  Postcard with screen capture from "Persecution" (2009), by John T. Williams<br>
                  <span style="font-size:11px;">[Download postcard PDF: <a href="http://sanssoucifest.org/PDF/Posters/SansSouciFest2010PostcardFront.pdf">front</a>
                  1.3MB, <a href="http://sanssoucifest.org/PDF/Posters/SansSouciFest2010PostcardBack.pdf">back</a> 1MB]</span>
                </div>
              </div>
              <!-- BCAA credit -->
              <div style="margin-top:0px;margin-bottom:0px;padding-left:55px;">
               <div class="programInfoText small" style="margin-bottom:8px;float:left;width:270px;padding-top:18px;padding-right:20px;font-weight:bold;"><span style="font-size:14px;">Support: </span>
                 <span class="filmInfoText" style="font-weight:normal;">Sans Souci has received support in the form of an Addison mini-Grant from <a href="http://www.bouldercountyarts.org/">Boulder Country Arts Alliance</a>.</span>
               </div>
               <div style="margin-top:0px;margin-bottom:8px;float:left;width:200px;">
                 <a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-GRN-logo200.gif" style="width:200px;height:73px;margin:2px 0;border:none;vertical-align:middle;" alt="Boulder Country Arts Alliance - BCAA" title="Boulder Country Arts Alliance - BCAA"></a>
                </div>
                <div style="clear:both"></div>
              </div>
             <!-- Supporters -->
              <div style="padding:8px 120px 24px 0;">
                <p class="programInfoText small topCenter">
                  <span style="font-weight:bold;">Our 7th Annual Festival was sponsored by</span><br>
                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>,<br>
                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater & Dance</a>, and<br>
                  the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                  all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>.
                </p>
              </div>
            </div>	


<?php
  echo SSFProgramPageParts::endContentHeader();
  // Call SSFWebPageParts::setComingSoonText() with appropriate text if the show has not yet been entered into the database.
  SSFProgramPageParts::setComingSoonText('Program details will appear here in mid-August.'); 
  SSFProgramPageParts::showWorks($withIndex = false);
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
