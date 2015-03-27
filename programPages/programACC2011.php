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
            <div>
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; }
              </style>

        	    <div class="venueText" style="margin-top:14px;">Gallery Theatre, Rio Grande Campus
        	    </div>
        		  <div class="miscInfo">1212 Rio Grande St., Austin, TX, USA</div>
        		  <div class="dateLine" style="font-size:20px;margin-top:16px">Thursday, October 6, 2011, <span class="timeText">6 p.m.</span></div>
        		  <div class="filmInfoSubtitleText" style="font-size:15px;font-weight:normal;margin-top:14px;line-height:130%;">Including student work by<br>Amie Elyn, Ale Madera, Hallie Odom, Trevor Revis, and Giovanni Sanchez</div>
        		  
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>
