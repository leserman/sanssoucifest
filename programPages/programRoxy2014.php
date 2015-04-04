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
/*              These lines would force the title to be the primaryTextColor even though it's in an anchor.
                .page .contentArea .headerPart .title a:link,
                .page .contentArea .headerPart .title a:visited { color:<?php echo $primaryTextColor; ?>; text-decoration: underline; }
                .page .contentArea .headerPart .title a:hover { color: #990000; text-decoration: underline; }
*/
              </style>
  
              <h1 class="dodeco"><a style="<?php echo $primaryTextColor; ?>;" href="http://www.theroxytheater.org/">The Roxy</a>&nbsp;
          	    <span class="programInfoText small">718 South Higgins Ave, Missoula MT 59801, USA</span>
          	  </h1>
        		  <div class="dateLine" style="font-size:20px;margin-top:8px;"><?php echo SSFRunTimeValues::getEventDatesDescriptionStringLong($eventId); ?>, <span class="timeText">8:00 PM</span></div>
        <!--      <div style="font-size:15px;margin-top:8px;margin-bottom:0px;line-height:120%;color:#E49548;font-weight:normal;">Tickets at the door.</div> -->
        		  <div style="font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;font-weight:normal;">Co-sponsored by <a href="http://www.barebaitdance.org">Bare Bait Dance</a>.</div>

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
