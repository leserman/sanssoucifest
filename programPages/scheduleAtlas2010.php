<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  
  
  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
//  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';

/*
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
*/
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
  $filename = SSFWebPageParts::getFilename();
?>
            <article id="<?php echo $filename; ?>" class="eventHeader"> <!-- <div id="outerDiv" style="text-align:left;margin:10px 20px 30px 0px;"> -->
              <style type="text/css" scoped>
                li.installation { color:black; font-size:14px; font-weight:normal; font-style:normal; padding:0px; margin:0px 0 1px 40px; list-style-type:circle; line-height:140%; }
                li.noBull { color:<?php echo $tertiaryTextColor; ?>; margin:0px 0 1px 40px; list-style-type:none; }
                li.nada { padding:0px; margin:0px; list-style-type:none; }
                li.timePeriod { font-size:14px; font-weight:bold; font-style:normal; line-height:130%; color:black; margin:18px 0px 0px 2px; padding:0; list-style-type:none; line-height:140%; }
                li.roomName { padding:0; list-style-type:none; margin:0; }
                .subTitle { font-size:20px;  margin:20px 0 0px 0; font-weight:bold; }
                .periodName { color:<?php echo $quaternaryTextColor; ?>; }
                .roomName { font-size:14px; font-weight:normal; font-style:normal; color:<?php echo $quaternaryTextColor; ?>; }
                .minorTimeSpan { color:#999999; font-weight:normal; }

                .freeAdmissionSpan { font-size:16px; color:<?php echo $quaternaryTextColor; ?>}
                .comeEarly { font-size:14px;margin-top:9px;margin-bottom:12px;line-height:130%;font-weight:normal; }
                .showDescriptionHeader { color:<?php echo $programHighlightColor; ?> }
                .headerLine2 { font-size:14px; }
              </style>
              
              <h1 style="color:<?php echo $primaryTextColor; ?>"><?php echo $contentTitle; ?></h1>
              <h2 class="secondaryTextColor">Atlas
                <span class="nodeco"><a style="font-size:18px;font-weight:bold;color:<?php echo $secondaryTextColor; ?>" href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a></span>
                <span class="programInfoText tiny dodeco"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">directions</a></span><br>
                <span class="headerLine2">University of Colorado at Boulder, Boulder, CO, USA</span>
        	    </h2>
<!--              <div class="eventDate primaryTextColor">Friday &amp; Saturday, September 10 &amp; 11, 2010</div> -->
        		  <div class="bodyText" style="padding:16px 0pt 0px;text-align:left;"><a href="programPages/programAtlas2010.php">Detailed Program</a>&nbsp;&nbsp;&nbsp;&nbsp;
        		    <a href="programPages/scholarlyPanelAtlas2010.php">Scholarly Panel</a>
        		  </div>
<?php // include_once "programPages/ticketsAtlas2010.php"; ?>
              <div id="schedule" style="padding-left:31px;">
                <div class="subTitle secondaryTextColor">Friday, September 10, 2010</div>
                
                  <ul style="margin:0 0 0 0px;">
                    <li class="nada">
                      <ul style="margin:0 0 0 0px;padding-top:0;padding-bottom:0;">
                        <li class="timePeriod" style="margin-top:4px;">6:30 p.m. &ndash; 10:00 p.m.&nbsp;&nbsp;<span class="periodName">Installaltion Videos&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show27"><span style="font-size:12px;">details...</span></a></span></li>
                        <li class="roomName" style="margin:0px 0px 0px 18px;padding:0;">Ground Floor Lobby loop
                          <ul style="margin:0 0 0 -22px;">
                            <li class="installation"><span class="periodName">"2/6" by Orsola Valenti, 30 minutes</span></li>
                          </ul>
                        </li>
                        <li class="roomName" style="margin:8px 0px 0px 18px;padding:0;">Black Box Level (B2) Lobby loop
                          <ul style="margin-left:-22px;margin-top:0px;padding-top:0;padding-bottom:0;">
                            <li class="installation"><span class="periodName">"March Circles 2010" by Mimi Garrard, 19 minutes</span></li>
                            <li class="installation"><span class="periodName">"REALM" by Narelle Benjamin, 7 minutes</span></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="timePeriod">7:30 p.m. &ndash; 9:30 p.m.&nbsp;<span class="roomName">Black Box Theater</span>&nbsp;&nbsp;<span class="periodName">Short films &amp; live performance&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show22"><span style="font-size:12px;">details...</span></a></span></li>
                  </ul>
                
                  <div class="subTitle secondaryTextColor">Saturday, September 11, 2010</div>
                  <ul style="margin:0 0 0 0px;">
                    <li class="nada">
                      <ul style="margin:0 0 0 0px;padding-top:0;padding-bottom:0;">
                        <li class="timePeriod" style="margin-top:4px;">10:30 a.m. &ndash; 9:30 p.m.&nbsp;&nbsp;<span class="periodName">Installaltion Videos&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show27"><span style="font-size:12px;">details...</span></a></span></li>
                        <li class="roomName" style="margin:0px 0px 0px 18px;padding:0;">Ground Floor Lobby loop
                          <ul style="margin:0 0 0 -22px;">
                            <li class="installation"><span class="periodName">"2/6" by Orsola Valenti, 30 minutes</span></li>
                          </ul>
                        </li>
                        <li class="roomName" style="margin:8px 0px 0px 18px;padding:0;">Black Box Level (B2) Lobby loop
                          <ul style="margin-left:-22px;margin-top:0px;padding-top:0;padding-bottom:0;">
                            <li class="installation"><span class="periodName">"March Circles 2010" by Mimi Garrard, 19 minutes</span></li>
                            <li class="installation"><span class="periodName">"REALM" by Narelle Benjamin, 7 minutes</span></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li class="timePeriod">11 a.m. &ndash; 12:30 p.m. <span class="roomName">Black Box Studio</span>&nbsp;&nbsp;<span class="periodName">Scholarly Panel Session&nbsp;&nbsp;<a href="programPages/scholarlyPanelAtlas2010.php"><span style="font-size:12px;">details...</span></a></span></li>
                    <li class="timePeriod">1:00 p.m. &ndash; 3:50 p.m. <span class="roomName">Black Box Theater</span>&nbsp;&nbsp;<span class="periodName">Documentary Films&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show23"><span style="font-size:12px;">details...</span></a></span>
                      <ul style="margin-left:0px;margin-top:0;">
                        <li class="installation"><span class="timePeriod">1:00 p.m.</span> <span class="periodName">"Gotta Move: Women In Tap," Gayle Hooks &amp; Lynn Dally, 44 min.</span></li>
                        <li class="installation, noBull"><span class="minorTimeSpan">1:45 p.m.</span> <span class="periodName">INTERMISSION, 10 min.</span></li>
                        <li class="installation"><span class="timePeriod">1:55 p.m.</span> <span class="periodName">"Dancing the Big Apple 1937," Judy Pritchett, 29 min.</span></li>
                        <li class="installation, noBull"><span class="minorTimeSpan">2:25 p.m.</span> <span class="periodName">INTERMISSION, 10 min.</span></li>
                        <li class="installation"><span class="timePeriod">2:35 p.m.</span> <span class="periodName">"The Rising Sun," Julia kimoto, 74 min.</span></li>
                      </ul>
                    </li>
                
                    <li class="timePeriod">1:00 p.m. &ndash; 4:45 p.m. <span class="roomName">Room 342</span>&nbsp;&nbsp;<span class="periodName">Documentary Films&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show24"><span style="font-size:12px;">details...</span></a></span>
                      <ul style="margin-left:0;margin-top:0;">
                        <li class="installation"><span class="timePeriod">1:00 p.m.</span> <span class="periodName">"SAND," Cari Ann Shim Sham*, 10 min.</span></li>
                        <li class="installation, noBull"><span class="minorTimeSpan">1:11 p.m.</span> <span class="periodName">"Living-room dancers," Bastien Genoux, 23 min.</span></li>
                        <li class="installation, noBull"><span class="minorTimeSpan">1:35 p.m.</span> <span class="periodName">INTERMISSION, 10 min.</span></li>
                        <li class="installation"><span class="timePeriod">1:45 p.m.</span> <span class="periodName">"Passion - Last Stop Kinshasa," Brigitte Kramer, 90 min.</span></li>
                        <li class="installation, noBull"><span class="minorTimeSpan">3:15 p.m.</span> <span class="periodName">INTERMISSION, 15 min.</span></li>
                        <li class="installation"><span class="timePeriod">3:30 p.m.</span> <span class="periodName">"15 Days of Dance: 'The Making of Ghost Light'," Elliot Caplan, 69 min.</span></li>
                      </ul>
                    </li>
                    
                    <li class="timePeriod">4:00 p.m. &ndash; 5:30 p.m. <span class="roomName">Black Box Theater</span>&nbsp;&nbsp;<span class="periodName">Art Films&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show25"><span style="font-size:12px;">details...</span></a></span> 
                      <ul style="margin-left:0px;margin-top:0;">
                        <li class="installation"><span class="timePeriod">4:00 p.m. </span><span class="periodName">"North Horizon," Thomas Freundlich, 22 min.</span></li>
                        <li class="installation"><span class="timePeriod">4:23 p.m. </span><span class="periodName">"Domestic Animals #1," Erin Mei-Ling Stuart, 6 min.</span></li>
                        <li class="installation"><span class="timePeriod">4:30 p.m. </span><span class="periodName">"An Ant," Kimmo Alakunnas, 24 min.</span></li>
                        <li class="installation"><span class="timePeriod">4:55 p.m. </span><span class="periodName">"no," Michelle Ellsworth, 2 min.</span></li>
                        <li class="installation"><span class="timePeriod">4:58 p.m. </span><span class="periodName">"Le Jardinier de la Gafferie," Nancy Spanier, 8 min.</span></li>
                        <li class="installation"><span class="timePeriod">5:00 p.m. </span><span class="periodName">"Vesper," Labrenz Brock, 15 min.</span></li>
                        <li class="installation"><span class="timePeriod">4:00 p.m. </span><span class="periodName">"The Movement of Live," Ob-art produccions, 3 min.</span></li>
                      </ul>
                    </li>
                    <li class="timePeriod">7:30 p.m. &ndash; 9:30 p.m.&nbsp;<span class="roomName">Black Box Theater</span>&nbsp;&nbsp;<span class="periodName">Short films &amp; live performance</span>&nbsp;&nbsp;<a href="programPages/programAtlas2010.php#show26"><span style="font-size:12px;">details...</span></a></li>

                  </ul>
                </div>
              
                <!-- Support #1 -->
                <div style="margin:0 auto 28px auto;text-align:center;padding-right:45px;">
                  <div class="subTitle secondaryTextColor" style="margin-top:30px;margin-bottom:0px;font-style:italic;">Support</div>
                  <div class="secondaryTextColor" style="margin-top:0px;margin-bottom:0px;">Sans Souci receives support from:</div>
                  <a href="http://www.artsresource.org/"><img src="../images/logos/BAC-Low_Horizontal2.gif" alt="Boulder Arts Commission" style="width:200px;height:45px; margin:0 2px;border:none;vertical-align:middle;"></a>&nbsp;&nbsp;and&nbsp;&nbsp;<a href="http://www.bouldercountyarts.org/"><img src="../images/logos/BCAA-GRN-logo200.gif" alt="Boulder Country Arts Alliance - BCAA" style="width:200px;height:73;margin:0 2px;border:none;vertical-align:middle;" title="Boulder Country Arts Alliance - BCAA"></a>
                </div>
                
                <!-- Supporters -->
                <div style="margin:0 auto 28px auto;text-align:center;padding-right:45px;">
                  <p class="programInfoText small topCenter secondaryTextColor nodeco" style="font-weight:normal;"><span style="font-weight:bold;">Our 7th Annual Festival was sponsored by</span><br>
                  the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>,<br>
                  the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>, and<br>
                  the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                  all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>.</p>
                </div>

            </article>

<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
