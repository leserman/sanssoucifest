<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  //  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
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
                p:first-of-type { margin-top:0px; }
              </style>

              <div style="margin-top:13px;">
                <!-- Boedecker -->
                <div id="oct" >
                  <h2 class="dateLine secondaryTextColor">Sundays, October 20 &amp; November 10<span class="timeText">&nbsp;&bull;&nbsp;4:00 &amp; 6:30 PM</span></h2>
                  <div class="venueText quaternaryTextColor">Boedecker Theater, 
                    <span style="font-size:16px;font-weight:normal;">Dairy Center for the Arts</span>
                    <span class="programInfoTextSmall" style="font-size:10pt;font-weight:normal;"><a href="http://www.thedairy.org/visitor-info/">(location)</a></span>
                  </div>
                  <div class="fundingInfo">with support from and in partnership with Dairy Center for the Arts</div>
                  <div class="ticketInfo locationLink grey">Tickets: $7 - $10, 303-444-7328, <a href="http://www.thedairy.org/">thedairy.org</a>, or at the door</div>
                </div>
                <!-- BPL - library -->
                <div id="dec">
                  <h2 class="venueText secondaryTextColor" style="margin-top:20px;">Wednesday, December 4<span style="font-size:14px;font-weight:normal;">&nbsp;&bull;&nbsp;6:30 PM</span></h2>
                  <div class="venueText quaternaryTextColor">Canyon Theater, 
                    <span style="font-size:16px;font-weight:normal;"><a href="http://boulderlibrary.org/">Boulder Public Library</a></span>
                    <span class="programInfoTextSmall" style="font-size:10pt;font-weight:normal;"><a href="http://boulderlibrary.org/locations/">(Main Library location)</a></span>
                    <span class="secondaryTextColor" style="font-size:18px;margin-top:4px;margin-bottom:0px;font-weight:bold;">FREE</span>
                  </div>
                  <div class="fundingInfo" style="padding:0;">with support from and in partnership with 
                    <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>
                  </div>
                </div>
          		  <div class="fundingInfo" style="padding:0;padding-top:20px;vertical-align:middle;">All with support from <a href="http://www.artsresource.org/bac/"><img src="images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="BAC logo" style="width:156px;height:35px;margin:0px 3px 0 3px;vertical-align:middle;"></a>an agency of the Boulder City Council.</div>
              </div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>

</html>
