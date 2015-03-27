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
            <div>
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; }
              </style>

          	  <div class="venueText" style="font-weight:normal;"><a href="https://www.facebook.com/events/1511453345749943/">tanzArt ostwest  09</a></div>
         	    <div class="miscInfo">In the exterior walls of the new Town Hall</div>
          	  <div class="dateLine">May 26 - June 2, 2009</div>
        	    <div class="programInfoText" style="padding-top:14px;padding-bottom:7px;">Sans Souci was invited by <a href="http://www.stadttheater-giessen.de/index.php?id=536">Tarek Assam</a>, Artistic Director of <a href="http://www.stadttheater-giessen.de/">Stadttheater Giessen</a>.</div>
        	    <div class="programInfoText" style="padding-top:7px;padding-bottom:2px;">Works are listed in alphabetical order; each was screened two or more times.</div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>
