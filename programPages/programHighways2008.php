<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $mapURL = 'http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=Highways+Performance+Space;+1651+18th+Street;+Santa+Monica,+CA,+USA&amp;jsv=128e&amp;sll=34.02332,-118.477443&amp;sspn=0.060182,0.062485&amp;ie=UTF8&amp;ei=hmbRSKCPHJ3uiwPj5N3xAQ&amp;cd=1&amp;cid=34023320,-118477443,1374057131672289811&amp;li=lmd&amp;z=15&amp;t=m';
  
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
              
              <div class="venueText" style="padding-top:10px;"><a href="http://www.highwaysperformance.org/">Highways Performance Space &amp; Gallery</a><span class="programInfoTextTiny" style="vertical-align:baseline;"> @ the 18th Street Arts Center</span></div>
              <div class="programInfoText small">1651 18th Street &bull; Santa Monica, CA, USA &bull; <span class="programInfoTextTiny"><a href="<?php echo $mapURL; ?>" target="highwaysMap">1/2 block N of Olympic</a></span> &#8226; 310.415.1459</div>
              <div class="dateLine secondaryTextColor" style="padding-top:10px;">
                Friday &amp; Saturday, October 3rd &amp; 4th, 2008 at 8:30 pm</div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>

<!-- <a href="javascript:window.void(0)" onMouseOver="popup('7:00 - 8:00 pm: Video installations.<br>8:00 pm: Screenings of shorts.<br>5:00 pm Saturday only: 75 minute Belgian dance documentary.<br><br>$12 general admission, $8 for museum members, seniors and students.<br>Tickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.','#FFFF99')" onMouseOut="killPopup()" onClick="window.alert('7:00 - 8:00 pm: Video installations.\r\n8:00 pm: Screenings of shorts.\r\n5:00 pm Saturday only: 75 minute Belgian dance documentary.\r\n\r\n$12 general admission, $8 for museum members, seniors and students.\r\nTickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.')"> 
-->