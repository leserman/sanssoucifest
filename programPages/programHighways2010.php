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
                <div class="venueText" style="margin-top:15px;">
                  <a href="http://www.highwaysperformance.org/">Highways Performance Space &amp; Gallery</a>
                  <span class="miscInfo"> @ the 18th Street Arts Center</span>
                </div>
           		  <div class="venueText primaryTextColor" style="font-size:17px;margin-top:2px;">1651 18th Street &#8226; Santa Monica, CA, USA</div>
          		  <div class="miscInfo">1/2 block N of Olympic &#8226; <a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=Highways+Performance+Space;+1651+18th+Street;+Santa+Monica,+CA,+USA&amp;jsv=128e&amp;sll=34.02332,-118.477443&amp;sspn=0.060182,0.062485&amp;ie=UTF8&amp;ei=hmbRSKCPHJ3uiwPj5N3xAQ&amp;cd=1&amp;cid=34023320,-118477443,1374057131672289811&amp;li=lmd&amp;z=15&amp;t=m" target="highwaysMap">map</a> &#8226; Tickets: 310.415.1459</div>
          		  <div class="dateLine" style="margin-top:17px;margin-bottom:30px;">Friday &amp; Saturday, May 21 &amp; 22, 2010 <span class="timeText">at 8:30 pm</span></div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  // Call SSFWebPageParts::setComingSoonText() with appropriate text if the show has not yet been entered into the database.
  SSFProgramPageParts::setComingSoonText('Program details will appear here in mid-August.'); 
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
