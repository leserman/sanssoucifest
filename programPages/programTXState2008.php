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

  echo SSFProgramPageParts::beginContentHeader();
?>
            <div>
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; }
              </style>
              
              <div class="venueText primaryTextColor">
            	  <a class="nodeco" href="http://www.maps.txstate.edu/campus/buildings/thea.html">Theatre Building</a>
            	  <span style="font-size:14px;">(Room 206)</span>,
            	  <a href="http://www.txstate.edu/">Texas State University, San Marcos</a>
              </div>
           	  <div class="dateLine secondaryTextColor" style="padding-bottom:10px;padding-top:10px;">Wednesday, October 29, <span class="timeText">at 7:00 pm</span></div>

            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>