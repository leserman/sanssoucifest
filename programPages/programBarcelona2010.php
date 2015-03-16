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
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();

  echo SSFProgramPageParts::beginContentHeader();
?>
<!--            <div class="programPageTitleText" style="padding-left:0;padding-bottom:4px;color:#ebeb14;">Punt Multimedia, Barcelona, 2010</div><br> -->
            <div class="programInfoTextSmall">in collaboration with <a href="http://www.ob-art.com/">ob-art video</a></div>            <div>
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; } /* 3b2873 */
              </style>
              <div class="programInfoText topLeft">Casa del Mig, Parc de L'Espanya Industrial<br>
                <span class="programInfoTextSmall">calle Muntadas 5 - 08014 Barcelona<br></span>14 de julio, de 19h a 00h<br>
              <!--
                <span class="programInfoTextSmall">1/2 block N of Olympic &#8226; <a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=Highways+Performance+Space;+1651+18th+Street;+Santa+Monica,+CA,+USA&amp;jsv=128e&amp;sll=34.02332,-118.477443&amp;sspn=0.060182,0.062485&amp;ie=UTF8&amp;ei=hmbRSKCPHJ3uiwPj5N3xAQ&amp;cd=1&amp;cid=34023320,-118477443,1374057131672289811&amp;li=lmd&amp;z=15&amp;t=m" target="highwaysMap">map</a></span> &#8226; Tickets: 310.415.1459</span><br>
              -->
                <img src="../images/barcelonaCartel.jpg" height="881" width="524" border="0" hspace="0" vspace="0" usemap="#offsiteLinks" alt="Ob-Art Poster" style="margin-bottom:20px;">
                <map name="offsiteLinks">
                  <area shape="rect" coords="60,24,500,100" href="http://www.ob-art.com/" alt="Ob-Art" title="Ob-Art">
                  <area shape="rect" coords="120,782,500,830" href="http://www.ob-art.com/" alt="Ob-Art" title="Ob-Art">
                </map>
              </div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  // Display the program index and listings
//  SSFProgramPageParts::showWorks(); NO WORKS HERE
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
