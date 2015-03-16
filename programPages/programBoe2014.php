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
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();

  echo SSFProgramPageParts::beginContentHeader();

?>
            <div style="margin-top:18px;">
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; } /* 3b2873 */
              </style>
              <!-- Continue content header -->
              <div id="oct" class="dateLine secondaryTextColor">Sundays, September 21 &amp; October 19<span class="timeText">&nbsp;&bull;&nbsp;1:00 PM</span></div>
              <div class="venueText">Boedecker Theater, <span class="minorSpan">Dairy Center for the Arts</span>
  <!--
                <span class="locationLink">(<a href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;http://dev.sanssoucifest.org/programPages/programBoe2014.phpBOparam::WScontent::loadArticle::article_id=0543C1D9-E624-4F3E-AFED-7CF05B7B8A95&amp;menu_id=DDCC1202-68C9-4397-BFCE-39ECBA316C47&amp;sToken=1%2C498caca1%2C53f3b06a%2CCDB6A624-7389-4BC5-91CD-7D72BAADBDC6%2CYlwvqJACX7WTsf%2FIyeLKqW%2BYxV8%3D">location</a>)</span>
  -->
              </div>
              <div class="miscInfo">with support from and in partnership with Dairy Center for the Arts</div>
              <div class="ticketInfo">Tickets: $6 - $11, 303-444-7328, <a href="<?php echo $onlineTicketsURL; ?>">online</a>, or at the door</div>
  <?php // include_once('../snippets/2014FundingAcknowledgement.html'); ?>
              <!-- End content header -->
            </div>

<?php
  echo SSFProgramPageParts::endContentHeader();

//  SSFProgramPageParts::setShowsEvent(35);      // If this is placed here, it overrides initialization from the DB
  SSFProgramPageParts::showWorks();

  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>
