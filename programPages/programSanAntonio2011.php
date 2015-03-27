<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $atticRepMap1 = 'http://www.mapquest.com/maps?city=San+Antonio&amp;country=US&amp;zipcode=78212&amp;state=TX&amp;address=1+Trinity+Pl%2c+Ruth+Taylor+Theatre+Building&amp;CID=lfmaplink';
  
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

        		  <div class="subtitle primaryTextColor" style="margin:0px 0 8px 0;">Friday, Saturday &amp; Sunday, January 21, 22 &amp; 23, 2011</div>
        		  <div class="venueText" style="margin:10px 0 0px 0;">Trinity University, San Antonio, Texas</div>
              <div class="miscInfo" style="">Attic Theater, <a href=" <?php echo $atticRepMap1; ?>">Ruth Taylor Theater Building</a>, across the street from Alamo Stadium</div>

            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>