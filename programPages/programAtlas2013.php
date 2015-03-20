<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  
  /* HMTL elided:
      <!--	    <div style="font-size:20px;margin-bottom:6px;"><a href="http://www.colorado.edu/atlas/newatlas/about/buildingoverview.html">Atlas Building</a> -->
      <!-- ATLAS Institute, Black Box Studio, lower level B2<br>University of Colorado at Boulder, 1125 18th St.<br>Boulder, CO 80309-0320 -->
      <!-- Google Map Link: http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&sll=39.959228,-105.213318&sspn=0.789471,0.873413&ie=UTF8&hq=Atlas+Institute,&hnear=1125+18th+St,+Boulder,+Colorado+80302&ll=40.007549,-105.269752&spn=0.012327,0.013647&t=h&z=16 -->
      <!-- Google Map Embed: <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&amp;sll=39.959228,-105.213318&amp;sspn=0.789471,0.873413&amp;ie=UTF8&amp;hq=Atlas+Institute,&amp;hnear=1125+18th+St,+Boulder,+Colorado+80302&amp;ll=40.007747,-105.269752&amp;spn=0.006295,0.006295&amp;t=h&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&amp;sll=39.959228,-105.213318&amp;sspn=0.789471,0.873413&amp;ie=UTF8&amp;hq=Atlas+Institute,&amp;hnear=1125+18th+St,+Boulder,+Colorado+80302&amp;ll=40.007747,-105.269752&amp;spn=0.006295,0.006295&amp;t=h" style="color:#0000FF;text-align:left">View Larger Map</a></small> -->
      <!-- http://www.eventbrite.com/ -->
  */
  
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
            </style>
      	    <div class="secondaryTextColor" style="font-size:20px;margin-top:8px;margin-bottom:0px;line-height:18px;">Atlas
      	      <span class="programInfoTextSmall" style="font-size:13pt;"><a class="nodeco" href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a></span>
      	      <span class="programInfoTextSmall" style="font-size:8pt;"><a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">(directions)</a></span>
      	    </div>

      		  <div class="programInfoTextSmall secondaryTextColor">University of Colorado at Boulder, Boulder, CO, USA</div>
      		  <div class="primaryTextColor" style="font-size:20px;margin-top:8px;font-style:italic;font-weight:normal;"><?php echo SSFRunTimeValues::getEventDatesDescriptionStringLong($eventId); ?></div>
      	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;line-height:120%;font-weight:normal;">7:00 PM: Video installations&nbsp;&bull;&nbsp;7:30 PM: Screenings</div>
            <div class="tertiaryTextColor" style="font-size:16px;margin-top:8px;margin-bottom:0px;line-height:130%;">FREE Admission. <span style="font-size:14px;color:black;">Come early to enjoy the looping video installations.</span>
            </div>
          </div>

<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
  
