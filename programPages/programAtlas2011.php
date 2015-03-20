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
              <div class="eventDate primaryTextColor">Friday &amp; Saturday, September 16 &amp; 17, 2011</div>
<!--
              <div class="eventTime primaryTextColor">7:00 PM: Video installation opens&nbsp;&bull;&nbsp;<span class="quaternaryTextColor">7:30 PM</span>: Film shorts & live dance performance</div>
              <div class="comeEarly primaryTextColor"><span class="freeAdmissionSpan">FREE Admission.</span> Come a little early to get a good seat and enjoy the installation videos in the lobby.</div>
-->
<?php SSFProgramPageParts::showIndex(); ?>
              <div style="width:420px;padding-bottom:10px;">
                <p class="programInfoText small topCenter">
                  <span style="font-weight:bold;">This 8th Annual Festival is sponsored by</span><br>
                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater & Dance</a>,<br>
                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
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

