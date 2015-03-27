<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  $googleMap = 'https://www.google.com/maps/place/108+Blue+Star/@29.4094095,-98.4957518,933m/data=!3m1!1e3!4m2!3m1!1s0x865c58bb497b7483:0x88572f527dd38da2';

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
                .tickets { font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;font-weight:normal; }
                .contentArea .headerPart .title { color: #ac4825; }
              </style>
  
              <h1 class="primaryTextColor"><a href="http://www.atticrep.org/">Attic<i>Rep</i></a> <span style="font-weight:normal;">Celebrating the past &bull; Investing in the Future</span></h1>
  
              <div style="font-size:20px;margin-top:5px;margin-bottom:4px;">
                <span style="font-size:17px;font-weight:normal;">at <a href="http://bluestarartscomplex.com/">Blue Star Arts Complex</a>,</span>
                <span class="programInfoText small"><a href="<?php echo $googleMap; ?>">108 Blue Star, San Antonio, TX,</a></span><br>
                <span class="programInfoText small">in the King William Cultural Arts District</span>
              </div>
        		  <div class="secondaryTextColor" style="font-size:20px;margin-top:8px;"><?php echo SSFRunTimeValues::getEventDatesDescriptionStringLong($eventId); ?>, 7:00 PM</div>
              <div class="tickets tertiaryTextColor">Tickets $5 at the door</div>
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
