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
                .contentArea .headerPart { padding-left:0px; }
                .contentArea .headerPart .title { color:<?php echo $primaryTextColor; ?>;text-align:center; }
                .page a:link, .page a:visited { color: #3267cd; text-decoration: none; }
                .almostEndBackground { background-image: url("http://sanssoucifest.org/images/almostEndBackground2.jpg"); background-color: #DDDDDD; }
                .page { background-image: none; }
                /* table, th, td { border: 1px solid black; } */
                </style>
              <div style="padding:12px 60px 30px 60px;" class="almostEndBackground">
                <table>
                  <tr><td class="title primaryTextColor" style="line-height:115%;">The First<br>Sans Souci Tour of Projected Dance<br>Summer 2004</td></tr>
          				<tr>
          				  <td class="bodyText middleCenter" style="padding-top:14px;">
          				    <em>Mexico</em><br>
                      <a href="http://www.cenart.gob.mx/">Centro Nacional de las Artes</a>&nbsp;&#8226;&nbsp;July<br>
                      <a href="http://www.udg.mx/">Universidad de Guadalajara</a>&nbsp;&#8226;&nbsp;July<br><a href="http://canal23.cnart.mx/">Canal 23 de las Artes</a>&nbsp;&#8226;&nbsp;ongoing airings<br><br>
                      <em>Trinidad and Tobago</em><br>
                      &nbsp;<a href="http://www.trianglearts.org/detail.php?id=14">Caribbean Contemporary Arts (CCA)</a><br><br>
          				    <em>Artists&nbsp;&#8226;&nbsp;<i>Works</i></em><br>
          				    <a href="http://avantmedia.org/artists/principal.html">Ana Baer-Carrillo</a>&nbsp;&#8226;&nbsp;<i>Bare </i>and<i> Silent Salvoes</i><br>
                      <a href="http://hamelbloom.com">Hamel Bloom</a>&nbsp;&#8226;&nbsp;<i>Almost Together</i><br>
                      Robynn Butler&nbsp;&#8226;&nbsp;<i>Pink</i><br>
                      Shantal Ehrenberg<br>
                      <a href="http://michelleellsworth.com">Michelle Ellsworth</a> &amp; Michael Theodore&nbsp;&#8226;&nbsp;<i>The Lesbian Dancer</i><br>
                      D. Robin Hammer&nbsp;&#8226;&nbsp;<i>Light Dance</i><br>
                      Mary Kite&nbsp;&#8226;&nbsp;<i>Kite</i><br>
                      Robert A. McWilliams&nbsp;&#8226;&nbsp;<i>Over the Edge</i><br>
                      Amanda Raja Nora&nbsp;&#8226;&nbsp;<i>All My Relations</i><br>
                      Naomi Pressman&nbsp;&#8226;&nbsp;<i>Window Window Window</i><br>
                      <a href="http://www.performanceinventions.org/">Nancy Spanier</a>&nbsp;&#8226;&nbsp;<i>Echos, Esprits et Traces dans l'ancien Hospice D'Hautefort</i><br>
                      Theresa Venturini&nbsp;&#8226;&nbsp;<i>Halo Dancing</i>
                    </td>
          			  </tr>
          				<tr>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          				</tr>
          				<tr>
          				  <td class="bodyText middleCenter"><img src="images/postcardFront200407-520.jpg" alt="publicity postcard, July 2004" style="width:520px;height:354px;"></td>
          			  </tr>
          			</table>
              </div>
            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  // Display the program index and listings
//  SSFProgramPageParts::showWorks(); NO SHOWS HERE
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
