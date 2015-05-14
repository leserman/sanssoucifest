<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  
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
  $venueName = SSFRunTimeValues::getVenueName($eventId); // 'Mima-Middlesbrough Institute of Modern Art'; // TODO get this from the event venue name in the DB
  $eventDatesDescriptionShort = SSFRunTimeValues::getEventDatesDescriptionStringLong($eventId);
  $venueLocation = SSFRunTimeValues::getVenueAddr1($eventId) . ' ' . SSFRunTimeValues::getVenueAddr2($eventId);

  echo SSFProgramPageParts::beginContentHeader();
?>
  
      <div style="margin-bottom:20px;">
        <div>
          <div class="floatLeft">
            <div class="venueText primaryTextColor nodeco"><?php echo $eventDatesDescriptionShort; ?><span class="timeText"><!-- times go here --></span></div>
            <div class="venueText nodeco"><a href="http://www.visitmima.com/"><?php echo $venueName; ?></a></div>
            <div class="venueText" style="margin-top:-4px;"><span class="locationLink nodeco"><a href="http://www.visitmima.com/plan-your-visit/getting-here/"><?php echo $venueLocation; ?></a></span></div>
          </div>
          <div class="floatLeft"><img alt="" src="images/logos/mimaLogo.png" style="width:106px;height:50px;padding-top:5px;padding-left:30px;vertical-align:bottom"></div>
          <div style="clear:both;"></div>
        </div>
      </div>
      
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
