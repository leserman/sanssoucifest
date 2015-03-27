<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  $googleMap = 'https://www.google.com/maps/place/108+Blue+Star/@29.4094095,-98.4957518,933m/data=!3m1!1e3!4m2!3m1!1s0x865c58bb497b7483:0x88572f527dd38da2';

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
            <div style="margin-top:0px;margin-bottom:28px;">
  
              <style type="text/css" scoped>
                .tickets { font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;font-weight:normal; }
/*
                .page .contentArea .headerPart .title a:link,
                .page .contentArea .headerPart .title a:visited { color:<?php echo $primaryTextColor; ?>; text-decoration: underline; }
                .page .contentArea .headerPart .title a:hover { color: #990000; text-decoration: underline; }
*/
              </style>
<!--              <h1 class="dodeco programHighlightColor">Boulder Public Library Program, 2011</h1> -->
              <div style="font-size:20px;margin-top:0px;margin-bottom:0px;line-height:18px;">
                <span class="programInfoText small" style="font-size:13pt;font-weight:bold;"><a class="nodeco" href="http://boulderlibrary.org/">Boulder Public Library</a></span>
<!--	      <span class="programInfoTextSmall" style="font-size:8pt;"><a href="http://www.colorado.edu/atlas/newatlas/about/directions.html">directions</a></span> -->
              </div>
<!-- ATLAS Institute, Black Box Studio, lower level B2<br>University of Colorado at Boulder, 1125 18th St.<br>Boulder, CO 80309-0320 -->
<!-- Google Map Link: http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&sll=39.959228,-105.213318&sspn=0.789471,0.873413&ie=UTF8&hq=Atlas+Institute,&hnear=1125+18th+St,+Boulder,+Colorado+80302&ll=40.007549,-105.269752&spn=0.012327,0.013647&t=h&z=16 -->
<!-- Google Map Embed: <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&amp;sll=39.959228,-105.213318&amp;sspn=0.789471,0.873413&amp;ie=UTF8&amp;hq=Atlas+Institute,&amp;hnear=1125+18th+St,+Boulder,+Colorado+80302&amp;ll=40.007747,-105.269752&amp;spn=0.006295,0.006295&amp;t=h&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Atlas+Institute,+1125+18th+St.+Boulder,+CO+80309-0320&amp;sll=39.959228,-105.213318&amp;sspn=0.789471,0.873413&amp;ie=UTF8&amp;hq=Atlas+Institute,&amp;hnear=1125+18th+St,+Boulder,+Colorado+80302&amp;ll=40.007747,-105.269752&amp;spn=0.006295,0.006295&amp;t=h" style="color:#0000FF;text-align:left">View Larger Map</a></small> -->
<!-- http://www.eventbrite.com/ -->
              <div class="programInfoText small">1001 Arapahoe Avenue, Boulder, Colorado 80302, USA</div>
<!--		  <div style="font-size:20px;margin-top:8px;">Fall, 2011</div> -->
<!--
		  <div class="bodyTextOnBlack" style="padding:16px 0pt 0px;" align="left"><a href="scheduleAtlas2010.php">Full Schedule</a>&nbsp;&nbsp;&nbsp;&nbsp;
		    <a href="./scholarlyPanelAtlas2010.php">Scholarly Panel</a>
		  </div>
-->
<!--		  <div style="margin:20px 0 0px 0;width:480px;"> -->
<?php // include_once "./ticketsAtlas2010.php"; ?>
<!--      </div> -->
              <div class="programInfoText small" style="font-weight:normal;margin-top:14px;margin-bottom:14px;">No reservations needed.</div>
              <div class="programInfoText small" style="vertical-align:baseline;">Also view the <span style="font-size:14px;"><a class="dodeco" href="programPages/programAtlas2011.php"><b>2011 programs in the CU Atlas Black Box Theatre</b></a></span>.</div>
              <div style="padding-left:31px;padding-top:14px;max-width:550px;">
                <div style="margin-right:60px;margin-bottom:18px;border:none;">
                  <div style="text-align:left"><img src="images/Stills2011/OfBodiesAndBranches-Dagesse+French-4.jpg" alt="" title="" style="width:402px;height:230px;border:none;align-content:center;margin:12px 0 0 -2px;border:none;"></div>
                  <div class="bodyTextLeaded" style="font-size:11px;margin:3px 0 12px 0;padding-bottom:0;text-align:center;">Frame from "Of Bodies and Branches" (2011), Nicole Dagesse &amp; Joy French<br></div>
                </div>
                <div class="programInfoText small">
                  <b>Screenings:</b><br>
                  <i>Moving Images,</i><br>
                  Mondays, <a href="#show39">October 3</a> and <a href="#show45">October 10</a>, 6:30 p.m.<br>
                  Canyon Theater, Boulder Public Library<br>
                  Co-sponsored by Sans Souci Festival of Dance Cinema, <a href="http://www.artsresource.org/">Boulder Arts Commission</a> <a href="http://www.artsresource.org/dance">Dance Bridge</a>, and Boulder Public Library <a href="http://www.boulderlibrary.org/events/cinema.html">Cinema Program</a>.<br><br>
                  <b>Installations:</b><br>
                  <i>New & Other Worlds in Dance Cinema</i><br>
                  Wednesdays, <a href="#show43">October 5</a> and <a href="#show42">October 12</a>, 3:00 - 5:30 PM (Program repeats at 4:15.)<br>
                  Pulse Point Media and Reading Center, Boulder Public Library<br>
                  Co-sponsored by Sans Souci Festival of Dance Cinema and Boulder Arts Commission <a href="http://www.artsresource.org/dance">Dance Bridge</a>.
                </div>
              </div>
            </div>
<!--		  <div class="programHighlightColor" style="font-size:20px;margin:100px 0 270px 0;text-align:center;">Coming Soon...</div> -->
<!--
        <div class="programInfoTextSmall" style="font-weight:normal;padding-top:4px;padding-bottom:4px;">Tickets: 
          $12 General Admission and $8 Students/Seniors &nbsp; <span style="font-size:small;">[<a href="javascript:void(0);" onClick="showHide('ticketDetail');"> show / hide detail </a>]</span>
        </div>
        <div id="ticketDetail" style="font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#CCCCCC;padding-bottom:6px;display:none;">
          when purchased through the Dairy Community Box Office <br>2590 Walnut Street, Boulder, CO &#8226; 303.444.7328 &#8226; Tue-Fri 1-5<br>
          OR<br>
          $14 General Admission and $9.50 Students/Seniors (including fees)<br>
          when purchased through Front Gate Tickets &bull; 1.888.512.7469 &bull; Mon-Sat 8-8<br>
          or anytime online via <a href="http://thedairy.frontgatetickets.com/">Front Gate Tickets</a>.
        </div>
        <div class="programInfoText" style="margin-top:0.2em;font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#CCCCCC;padding-bottom:4px;padding-top:0px;">
          Download the <a href="PDF-ProgramSpreads/SSF2009ProgramSpreads.pdf">print version</a> of this program (4.8 MB PDF).
        </div>
-->

<?php
  echo SSFProgramPageParts::endContentHeader();
  // Call SSFWebPageParts::setComingSoonText() with appropriate text if the show has not yet been entered into the database.
  SSFProgramPageParts::setComingSoonText('Program details will appear here in mid-August.'); 
  SSFProgramPageParts::showWorks();
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
