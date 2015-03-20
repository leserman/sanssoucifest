<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  
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
  
      <div class="nodeco" style="margin-top:20px;margin-bottom:40px;">
        <div style="margin-bottom:20px;">
          <div id="oct" class="venueText primaryTextColor nodeco">Friday, September 19<span class="timeText">&nbsp;&bull;&nbsp;7:30 PM</span><br>
            Lenfest Theater, 
            <span class="locationLink nodeco"><a href="http://www.ursinus.edu/netcommunity/page.aspx?pid=330">Kaleidoscope Performing Arts Center</a></span> 
          </div>
          <div class="venueText" style="margin-top:3px;"><a href="http://www.ursinus.edu/">Ursinus College</a>, <span class="minorInfo">Collegeville, PA</span></div>
          <p><span class="venueText tertiaryTextColor">FREE </span>as a part of the <a href="http://news.ursinus.edu/2013/events/annual-fringe-festival-features-comedy-dance/"><span style="font-size:12pt;">Ursinus College Fringe Festival</span></a></p>
        </div>
      </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
