<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 
  
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
            <div id="dek"><script type="text/javascript">initFlyoverPopup();</script></div>
            <div>
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; }
              </style>
              
              <div class="venueText" style="padding-top:10px;"><a href="http://www.bmoca.org">Boulder Museum of Contemporary Art</a></div>
              <div class="programInfoText small">1750 13th Street &#8226; Boulder, CO, USA</div>
              <div class="dateLine primaryTextColor" style="padding-top:10px;">Friday &amp; Saturday, April 4th &amp; 5th, 2008 <span class="miscInfo" style="font-weight:normal;"> <a href="javascript:window.void(0)" onMouseOver="flyoverPopup('7:00 - 8:00 pm: Video installations.<br>8:00 pm: Screenings of shorts.<br>5:00 pm Saturday only: 75 minute Belgian dance documentary.<br><br>$12 general admission, $8 for museum members, seniors and students.<br>Tickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.','#FFFF99')" onMouseOut="killFlyoverPopup()" onClick="window.alert('7:00 - 8:00 pm: Video installations.\r\n8:00 pm: Screenings of shorts.\r\n5:00 pm Saturday only: 75 minute Belgian dance documentary.\r\n\r\n$12 general admission, $8 for museum members, seniors and students.\r\nTickets can be purchased on-line at bmoca.org, at the museum, or by calling visitor services at 303.443.2122.')">details</a></span></div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>
