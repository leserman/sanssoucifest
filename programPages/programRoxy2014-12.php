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
              </style>
              <table>
              	<tr>  <!-- Roxy 12/2014 -->
              	  <td class="topLeft programInfoText">
<!--
                	    <div style="font-size:20px;margin-top:8px;margin-bottom:0px;line-height:18px;color:#E49548;"><a href="http://www.theroxytheater.org/">The Roxy</a>&nbsp;<span class="programInfoTextSmall" style="color:#E49548;">718 South Higgins Ave, Missoula MT 59801, USA</span></div>
-->
              	    <div style="font-size:20px;margin-top:2px;margin-bottom:0px;line-height:18px;"><span class="programInfoText" style="color:<?php echo $secondaryTextColor; ?>;">718 South Higgins Ave, Missoula MT 59801, USA</span></div>
              		  <div style="font-size:15px;margin-top:2px;margin-bottom:0px;line-height:120%;color:<?php echo $secondaryTextColor; ?>;font-weight:normal;">Co-sponsored by <a class="nodeco" href="http://www.barebaitdance.org">Bare Bait Dance</a>.</div>
                  </td>
                </tr>
              </table>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  // Display the program index and listings
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
