<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS as appropriate */
  SSFProgramPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFProgramPageParts::setShowsEvent(31);      // the eventId for this program -- REALLY 31; 35 is for a single show event.
  SSFProgramPageParts::setHeaderTitleText('at the Boe, 2014');  // This is the official HTML head title. It appears in the tab.
  SSFProgramPageParts::setContentTitleText('Sans Souci at the Boe, 2014');  // The is the title of the page in the Content Area.
	SSFProgramPageParts::setProgramPicBorderWidthInPixels(1);  // This is the border width in pixels for the image for each work.
	SSFProgramPageParts::setProgramHighlightColor('#586caf');  // This is the border color for the image for each work.
	SSFProgramPageParts::setShowIndexPrefix('Different programs at each screening:');
	
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
  echo SSFProgramPageParts::beginContentHeader();

?>
            <!-- Continue content header -->
            <div id="oct" class="dateLine">Sundays, September 21 &amp; October 19<span class="timeText">&nbsp;&bull;&nbsp;1:00 PM</span></div>
            <div class="venueText">Boedecker Theater, <span class="minorSpan">Dairy Center for the Arts</span>
<!--
              <span class="locationLink">(<a href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;http://dev.sanssoucifest.org/programPages/programBoe2014.phpBOparam::WScontent::loadArticle::article_id=0543C1D9-E624-4F3E-AFED-7CF05B7B8A95&amp;menu_id=DDCC1202-68C9-4397-BFCE-39ECBA316C47&amp;sToken=1%2C498caca1%2C53f3b06a%2CCDB6A624-7389-4BC5-91CD-7D72BAADBDC6%2CYlwvqJACX7WTsf%2FIyeLKqW%2BYxV8%3D">location</a>)</span>
-->
            </div>
            <div class="miscInfo">with support from and in partnership with Dairy Center for the Arts</div>
            <div class="ticketInfo">Tickets: $6 - $11, 303-444-7328, <a href="<?php echo $onlineTicketsURL; ?>">online</a>, or at the door</div>
<?php // include_once('../snippets/2014FundingAcknowledgement.html'); ?>
<!--            <div class="miscInfo" style="font-size:15px;color:purple;margin-bottom:0;">Different programs at each screening:</div> -->
            <!-- End content header -->


<?php
  echo SSFProgramPageParts::endContentHeader();

  SSFProgramPageParts::showWorks();

  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>
