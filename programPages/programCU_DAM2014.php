<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media?utm_source=wordfly&amp;utm_medium=email&amp;utm_campaign=TheD.A.M.ShowBlast&amp;utm_content=version_A';
//  $programPageHeaderSnippet = '../snippets/2014DAMshowProgramPageHeader.html';
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
  
      <div style="margin-top:20px;margin-bottom:40px;">
        <div class="venueText primaryTextColor"><a href="http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media">The D.A.M. Show: Dance Art Media</a></div>
        <div class="dateLine">Fri &amp; Sat, Oct 17 &amp; 18 <span class="timeText"> at 7:30 PM</span> and Sun, Oct 19<span  class="timeText"> at 2 PM</span></div>
        <div class="venueText">Irey Theater <span class="minorSpan locationLink">(<a href="http://www.colorado.edu/theatredance/eventstickets/venues-directions">directions</a>),</span> <span class="minorSpan">Theater Building, CU Boulder</span>
        </div>
        <div class="fundingInfo">
            produced by the Dance Division, Department of Theatre and Dance, CU Boulder
        </div>
      </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
//  SSFProgramPageParts::setShowsEvent(35);      // If this is placed here, it overrides initialization from the DB
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
