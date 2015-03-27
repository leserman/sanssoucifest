<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  

  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';
  
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
              </style>

              <span style="font-size:20px;"><a href="http://thedairy.org/">Dairy Center for the Arts</a></span><br>
        		  <span class="programInfoText small">2590 Walnut Street &#8226; Boulder, CO, USA</span><br>
        		  Friday &amp; Saturday, March 20 &amp; 21, 2009<br>
              <div class="programInfoText small" style="font-weight:normal;padding-top:4px;padding-bottom:4px;">Tickets: $12 General Admission and $8 Students/Seniors &nbsp; <span style="font-size:small;">[<a href="javascript:void(0);" onClick="showHide('ticketDetail');"> show / hide detail </a>]</span></div>
              <div id="ticketDetail" style="font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#666666;padding-bottom:6px;display:none;">
                when purchased through the Dairy Community Box Office <br>2590 Walnut Street, Boulder, CO &#8226; 303.444.7328 &#8226; Tue-Fri 1-5<br>
                OR<br>
                $14 General Admission and $9.50 Students/Seniors (including fees)<br>
                when purchased through Front Gate Tickets &bull; 1.888.512.7469 &bull; Mon-Sat 8-8<br>
                or anytime online via <a href="http://thedairy.frontgatetickets.com/">Front Gate Tickets</a>.
              </div>
              <div class="programInfoText" style="margin-top:0.2em;font-size:13px;line-height:15px;font-weight:normal;text-align:left;color:#333333;padding-bottom:4px;padding-top:0px;">
                Download the <a href="PDF/ProgramSpreads/SSF2009ProgramSpreads.pdf">print version</a> of this program (4.8 MB PDF).
              </div>

              <div style="margin-top:24px;margin-bottom:18px;vertical-align:middle;">
               <div class="programInfoText small" style="float:left;width:270px;padding-right:20px;vertical-align:middle;margin-top:4px;">
                 <span style="font-weight:bold;">Support: </span>
                 <span>Sans Souci received support for this 2009 Festival in the form of a Neodata Grant and an Addison mini-Grant from <a href="http://www.bouldercountyarts.org/">Boulder Country Arts Alliance</a>.</span>
               </div>
               <div style="float:left;width:200px;vertical-align:middle;">
                 <a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-GRN-logo200.gif" 
                   alt="Boulder Country Arts Alliance - BCAA" style="width:200px;height:73px;margin:0;vertical-align:middle;border:none;" title="Boulder Country Arts Alliance - BCAA"></a>
                </div>
                <div style="clear:both"></div>
              </div>

              <div style="margin:0 auto;text-align:center;">
                <div style="margin-right:220px;padding-top:12px;padding-bottom:4px;">
                  <div style="padding-top:0px;padding-bottom:4px;">
                    <img src="images/Stills2009/09-26-Helenka-KarenRose-261x130.jpg" alt="Frame from &quot;Helenka&quot; (2008) by Karen Rose" 
                      style="width:261px;height:130px;margin:0;border:1px solid <?php echo $primaryTextColor; ?>;" title="Frame from &quot;Helenka&quot; (2008) by Karen Rose">
                  </div>
                  <div class="filmFigureCaption" style="text-align:center;padding-bottom:0px;color:#330000">Frame from &quot;Helenka&quot; (2008) by Karen Rose</div>
                </div>
              </div>

            </div>
<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  SSFWebPageParts::endPage();
?>
</html>
