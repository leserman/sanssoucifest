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
            <div style="margin-left:20px;margin-top:20px;padding:3px 5px 10px 15px;border:1px #CCCCCC solid">
              <style type="text/css" scoped>
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>; } /* 3b2873 */
                .contentArea table tr td { margin:0;padding:10px 30px 0 10px;text-align:center;vertical-align:middle;border:0px blue dashed; }
                .contentArea table tr td .left  { width:200px;padding-left:60px; }
                .contentArea table tr td .right { width:300px;color:purple; }
                img .here  { width:180px;margin:10px 0;border:none;vertical-align:middle; }
                .contentArea table tr td h2 { color:<?php echo $secondaryTextColor; ?>; margin-left:auto; margin-right:auto; text-align:center; }
                .contentArea table { margin:10px 4px;line-height:130%;border:0px red dashed; }
                p:first-of-type { margin-top:0px; }
              </style>

              <table>
                <tr>
                  <td class="left"><img class="here" src="images/posterlet200404.jpg" alt="posterlet 4/2004" style="height:127px;"></td>
                  <td class="right">
                    <h2>The <span style="font-weight:bold;">First</span><br>Sans Souci <span style="font-weight:bold;">Festival</span> of Projected Dance</h2>
                    <p><a href="http://www.bmoca.org/">Boulder Museum of Contemporary Art (BMoCA)</a><br>Sunday, April 4, 2004</p>
                  </td>
                </tr>
                <tr>
                  <td class="left"><img class="here" src="../images/postcardFront200407.jpg" alt="postcard 7/2004" style="height:122px;"></td>
                  <td class="right">
                    <h2>The <span style="font-weight:bold;">First</span><br>Sans Souci <span style="font-weight:bold;">Tour</span> of Projected Dance</h2>
              	    <p>&#8226;&nbsp;Mexico<br>
              		  &#8226;&nbsp;Trinidad and Tobago<br>
              			<a href="programPages/summerTour2004.php">details...</a></p>
                  </td>
                </tr>
                <tr>
                  <td class="left"><img class="here" src="images/silentSalvosStill1.jpg" alt="Silent Salvoes, Ana Baer" style="height:135px;"></td>
                  <td class="right">
                    <h2>The <span style="font-weight:bold;">Second</span> Annual<br>Sans Souci <span style="font-weight:bold;">Festival</span> of Dance Cinema</h2>
                    <p>BMoCA, Boulder, Colorado, USA<br>
                    Sat. &amp; Sun., April 23 &amp; 24, 2005<br><br>
                    <a href="programPages/summaryProgram2005.php">details...</a></p>
                  </td>
                </tr>
              </table>
              
            </div>

<?php
  echo SSFProgramPageParts::endContentHeader();
  // Display the program index and listings
//  SSFProgramPageParts::showWorks(); NO WORKS HERE
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
