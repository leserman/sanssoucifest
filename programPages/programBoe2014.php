<!DOCTYPE html>
<?php 
  include_once '../bin/classes/SSFProgramPageParts.php'; 

  /* UPDATE THESE ITEMS as appropriate */
  SSFProgramPageParts::cachePage();            // for faster loading
  SSFProgramPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFProgramPageParts::setShowsEvent(31);      // the eventId for this program
  SSFProgramPageParts::setHeaderTitleText('at the Boe, 2014');  // This is the official HTML head title. It appears in the tab.
  SSFProgramPageParts::setContentTitleText('Sans Souci at the Boe, 2014');  // The is the title of the page in the Content Area.
	SSFProgramPageParts::setProgramPicBorderWidthInPixels(1);  // This is the border width in pixels for the image for each work.
	SSFProgramPageParts::setProgramHighlightColor('#586caf');  // This is the border color for the image for each work.
	
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
//	SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
  echo SSFProgramPageParts::getHtmlLine();
  echo SSFProgramPageParts::getHeader();

?>

    <body class='programPageContent'>
    <?php 
      echo SSFProgramPageParts::beginPageBody();
      echo SSFProgramPageParts::beginContentHeader();
     ?>

      <header> 
        <div class='title'></div>
      </header>
      
      <table>
        <tr>
      	  <td class="programInfoText topLeft" style="padding-top:6px;">              <!-- UPDATE --> 
            <!-- Boedecker at Dairy -->
            <div style="margin-bottom:20px;">
              <div id="oct" class="homeHeading1" style="margin:5px 0 3px 0;color:#FFFF99;font-weight:bold;font-size:19px;text-align:left;">
                Sundays, September 21 &amp; October 19<span style="font-size:14px;font-weight:normal;">&nbsp;&bull;&nbsp;1:00 PM</span>
              </div>
              <div style="font-size:19px;margin-top:0px;margin-bottom:0px;color:#E49548;font-weight:bold;">Boedecker Theater, <span style="font-size:16px;font-weight:normal;">Dairy Center for the Arts</span>
                <!-- <span class="programInfoTextSmall" style="font-size:10pt;color:#E49548;font-weight:normal;">(<a href="https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&BOparam::WScontent::loadArticle::article_id=0543C1D9-E624-4F3E-AFED-7CF05B7B8A95&menu_id=DDCC1202-68C9-4397-BFCE-39ECBA316C47&sToken=1%2C498caca1%2C53f3b06a%2CCDB6A624-7389-4BC5-91CD-7D72BAADBDC6%2CYlwvqJACX7WTsf%2FIyeLKqW%2BYxV8%3D">location</a>)</span> -->
              </div>
              <div class="bodyTextLeadedOnBlack" style="margin:1px 0;padding:0;">
                  with support from and in partnership with Dairy Center for the Arts
              </div>
              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:4px 0;padding:0;color:#CCC;">
                  Tickets: $6 - $11, 303-444-7328, <a href="<?php echo $onlineTicketsURL; ?>">online</a>, or at the door
              </div>
            </div>
      <?php include_once('../snippets/2014FundingAcknowledgement.html'); ?>
      		  <div style="font-size:15px;margin-top:12px;margin-bottom:-8px;line-height:120%;color:#E49548;font-weight:normal;">Different programs at each screening:</div>
          </td>
        </tr>
      </table>

<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  echo SSFProgramPageParts::endPageBody();

/*
      // Test Code 1/29/15
      // This block exercises SSFInit.
      $dbname = SSFInit::getDbName(); 
      $debug = new SSFDebug; 
      $debug->becho('dbname', $dbname, 1);
      // This block tests various PHP variables and methods.
      $debug->becho('__DIR__', __DIR__, 1);
      $debug->becho('__FILE__', __FILE__, 1);
      $debug->becho('PHP_URL_HOST', parse_url(SSFProgramPageParts::getHostName(), PHP_URL_HOST), 1);
*/
/* Test results 1/30/15.      
      ** BECHO ** dbname: sanssouci
      ** BECHO ** __DIR__: /home/hamelbloom/dev.sanssoucifest.org/programPages
      ** BECHO ** __FILE__: /home/hamelbloom/dev.sanssoucifest.org/programPages/programBoe2014.php
      ** BECHO ** PHP_URL_HOST: dev.sanssoucifest.org
*/

?>

</body>
</html>
