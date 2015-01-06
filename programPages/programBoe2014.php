<!DOCTYPE html>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
	SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
//  SSFProgramPageParts::initializePage(__FILE__, $doCache = false); 
?>
<?php  /* UPDATE THESE ITEMS */
  SSFProgramPageParts::setShowsEvent(31);  
  $allowRobotIndexing = true;
  SSFProgramPageParts::$pageHeaderTitleText = 'at the Boe, 2014';
  SSFProgramPageParts::$pageContentTitleText = 'Sans Souci at the Boe, 2014';
	SSFProgramPageParts::$programPicBorderWidthInPixels = '1';
	SSFProgramPageParts::$programHighlightColor = '#586caf';
  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
?>
<!-- <html lang="en"<?php echo SSFProgramPageParts::cacheString(); ?>> -->
<html lang="en">
  <head>
<?php 
  echo SSFProgramPageParts::htmlHeadContent(SSFProgramPageParts::$pageHeaderTitleText, $allowRobotIndexing); 
?>
    <style type="text/css">
      /* CSS inline style definitions go here. */
/*      td { padding:0;border:0px solid red;background-color:#2300ff;margin:0;border-collapse:collapse; }  */
      table { padding:0;margin:0;border-collapse:collapse; }
    </style>
<?php 
  echo SSFProgramPageParts::cssMediaQueries(); 
?>
  </head>

    <body>
    <?php 
      echo SSFProgramPageParts::beginPageBody();
      echo SSFProgramPageParts::beginContentHeader();
     ?>
  
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
?>

</body>
</html>