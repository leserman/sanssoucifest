<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
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
            <div style="margin-top:10px;margin-bottom:28px;">
              <style type="text/css" scoped>
              </style>
                      
              <!-- BPL - library -->
              <div id="dec" class="dateLine secondaryTextColor">Monday, October 6<span class="timeText">&nbsp;&bull;&nbsp;6:30 PM</span></div>
              <div class="venueText secondaryTextColor">Canyon Theater, 
                <span class="minorSpan locationLink"><a href="http://boulderlibrary.org/">Boulder Public Library</a></span>
                <span class="minorSpan locationLink">(<a href="http://boulderlibrary.org/locations/">Main Library location</a>)</span>
                <span class="tertiaryTextColor">FREE</span>
              </div>
              <div class="fundingInfo locationLink">with support from and in partnership with
                <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>
              </div><br style="clear:both;">
<?php include_once('../snippets/2014FundingAcknowledgement.html'); ?>
            </div>      
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
