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
                  .bodyText { font-size:14px; }
                  .almostEndBackground { background-image: url("http://sanssoucifest.org/images/almostEndBackground2.jpg"); background-color: #DDDDDD; }
                  .textColumn { width:55%;padding-left:15px;padding-right:33px; }
                  .intermission { padding-right:80px;font-size:12px;font-color:#666666; }
                  .page { background-image: none; }
                  /* table, th, td { border: 1px solid black; } */ /* for debugging the table */
                </style>
              <div style="padding:16px 28px 24px 28px;border:0px red dashed;" class="almostEndBackground">
                <table style="padding:0;margin:0;width:600px;border:0px blue dashed;">
          				<tr><td colspan="4" style="height:10px;" class="titleText">2005 Summary Program</td></tr> <!-- primaryTextColor NO, black. -->
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr>
          				  <td colspan="4" class="bodyTextWithEmphasis"><b><a href="http://www.bmoca.org/">BMoCA</a>, </b><span class="bodyText"><b>Boulder Museum of Contemporary Art</b><br>1750 13th Street, Boulder Colorado</span></td>
          			  </tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr><td colspan="4" style="height:10px;margin-top:20px;margin-bottom:20px;padding-top:15px;border-bottom:1px solid grey;" class="bodyTextWithEmphasis"><span style="font-weight:bold;">Saturday, April 23, 2005</span></td></tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          
          				<tr>
          				  <td class="bodyText middleCenter" style="width:2%;">&nbsp;</td>
          				  <td class="bodyText topRight" style="width:12%;"><b>6:30 PM&nbsp;&nbsp;</b></td>
          				  <td class="bodyText topCenter" style="width:26%;">
            				  <img src="images/returningHome10.jpg" alt="Returning Home" style="width:165px;height:118px;margin:0 auto;padding:0;padding-bottom:6px;border:none;"><br style="clear:both">
          					  <img src="images/returningHome3.jpg" alt="Returning Home" style="width:165px;height:118px;margin:0 auto;padding:0;border:none;">
          				  </td>
          				  <td class="bodyText topLeft textColumn"><span style="font-weight:bold;font-style:italic;">Returning Home, </span>a breathtaking and groundbreaking dance documentary in which 80-something Anna Halprin, pioneer of postmodern dance, uses movement as a means of connecting the individual to nature, and art to real life. In collaboration with performance artist Eeo Stubblefield, Halprin moves along thresholds of earth, wind, water and fire, discovering lessons in loss and liberation. Whether surveying the charred remains of her home, or her scars from cancer and aging, Halprin finds beauty and meaning even in the destructive forces of nature. A testament to the importance of honoring the human and earth bodies, this unforgettable film takes us on a mythic and very personal journey home. (45 min.) <a href="http://www.openeyepictures.com/returninghome/rh_reviews_full.html">more</a></td>
          			  </tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr>
            				<td></td>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          					<td colspan="2" class="bodyText topCenter intermission">Intermission. Snacks will be served.</td>
          			  </tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          				  <td class="bodyText topRight"><b>8:00 PM&nbsp;&nbsp;</b></td>
          					<td class="bodyText topCenter">
            					<img src="images/RiskingCardboard.jpg" alt="Risking Cardboard, Carrie Noel" style="width:165px;height:124px;margin:0 auto;padding:0;padding-bottom:6px;border:none;"><br style="clear:both">
          					  <img src="images/SevenSins.jpg" alt="Seven Sins, Cassandra Weston" style="width:165px;height:106px;margin:0 auto;padding:0;border:none;">
          				  </td>
          				  <td class="bodyText topLeft textColumn"><span style="font-weight:bold;">Short Souci - </span>selected dance-for-camera shorts curated from local,
          			    national and international film submissions.</td>
          				</tr>
  
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr><td colspan="4" style="height:10px;margin-top:20px;margin-bottom:20px;padding-top:15px;border-bottom:1px solid grey;" class="bodyTextWithEmphasis"><span style="font-weight:bold;">Sunday, April 24, 2005</span></td></tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          
          				<tr>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          				  <td class="bodyText topRight"><b>6:30 PM&nbsp;&nbsp;</b></td>
          				  <td class="bodyText topCenter">
            				  <img src="images/steelWork1.jpg" alt="Steel Work" style="width:165px;height:129px;margin:0 auto;padding:0;padding-bottom:6px;border:none;"><br style="clear:both">
            			    <img src="images/steelWork2.jpg" alt="Steel Work" style="width:165px;height:80px;margin:0 auto;padding:0;border:none;">
            			 </td>
          				  <td class="bodyText topLeft textColumn"><span style="font-weight:bold;font-style:italic;">Steel Work, </span>a film by <a href="http://picturestartfilms.com/">Elliot Caplan</a> with music by Philip Glass, David Bowie, and Brian Eno mixes dance with industrial elements which simulate dance movement and form. This film offers a unique dance for camera work through its application of non-dance elements as dance. At the core of this piece is choreography by Robert Poole which was inspired by principles of industry. Other elements include electronic manipulation of images, a steel mill, steel workers choreographed by Poole, and steel structures in New York.	(48 min.)</td>
          			  </tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr>
          				  <td style="margin-top:20px;margin-bottom:20px;" class="bodyText topLeft"><b>&nbsp;</b></td>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          					<td colspan="2" class="bodyText topCenter intermission">Intermission. Snacks will be served.</td>
          			  </tr>
          				<tr> <!-- spacer row --> <td colspan="4" style="height:10px;"></td></tr>
          				<tr>
          				  <td class="bodyText middleCenter">&nbsp;</td>
          				  <td class="bodyText topRight"><b>8:00 PM&nbsp;&nbsp;</b></td>
          				  <td class="bodyText topCenter">
            				  <img src="images/FamilyPortrait.jpg" alt="Family Portrait, Hamel Bloom" style="width:165px;height:124px;margin:0 auto;padding:0;border:none;">
          				  </td>
          				  <td class="bodyText topLeft textColumn"><span style="font-weight:bold;">Invitation Souci - </span>dance for camera works by Hamel Bloom, Bill
          				    Manka, Emilie Upczak, Ana Baer and more!</td>
          			  </tr>
          			</table>
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
