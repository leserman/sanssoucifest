<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $finalDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDescriptionShort = SSFRunTimeValues::getEventDescriptionStringShort(SSFRunTimeValues::getAssociatedEventId($associatedEventId)); // 3/29/14
  $eventDescriptionLong = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($associatedEventId));   // 3/29/14
  $eventDatesDescriptionStringShort = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $eventDatesDescriptionStringLong = SSFRunTimeValues::getEventDatesDescriptionStringLong($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $entryFormFilename = 'entryForm' . $currentYearString . '.php'; 
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();

  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
?>
          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
              .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; }
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }

              ol { font-size: 15px; line-height: 1.3; margin-right: 24px; margin-left:25px; }
              ol { list-style-type:decimal; }
              ol li { line-height:1.3; padding-top:10px; margin-bottom:18px; type="1"; }
              ol li:first-of-type { padding-top:6px; }

              .page { background-image: none; }
              
              .highlightedWordColor { color: <?php echo $quaternaryTextColor; ?>; }
            </style>

            <h1><?php echo $contentTitle; ?></h1>
            <div class="howTo dodeco" style="margin:14px 0;">Follow these steps to make your video <i>downloadable</i>. <!-- <br>
              <span style="font-size:12px;">(These instructions presume that you are using the vimeo website that is <b>&quot;new&quot;</b> as of May 2012 in the US.<br>
                <a href="./vimeoInfo1.php">If you are using the <b>&quot;old&quot;</b> website follow these steps</a> instead.)</span> -->
              <ol class="howTo">
                <li class="howTo">Login to <a href="http://vimeo.com">Vimeo</a> and select <span class="highlightedWordColor"><b>Videos</b></span> from the menubar.<br>
                  <img src="../images/vimeo/vimeoSpanshot-Videos.png" style="width:507px;height:71px;margin:12px 0 6px 0;">
                </li>
                <li class="howTo">Locate the video of interest and click on the <span class="highlightedWordColor"><b>Settings</b></span> gear in the upper right corner of that video's screen image.<br>
                  <img src="../images/vimeo/vimeoSpanshot-VideoSettings.png" style="width:351px;height:222px;margin:5px 0 6px 0;"><br>
                  This will load the Basic Settings page for the video of interest.</li>
                <li class="howTo">Click on <span class="highlightedWordColor"><b>Privacy</b></span> in the menubar of the Basic Settings page.<br><img src="../images/vimeo/vimeoSpanshot-BasicSettings.png" style="width:569px;height:226px;margin:12px 0 6px 0;"><br>This will take you to the Basic Settings/Privacy page pictured below.</li>
                <li class="howTo">On the Settings/Privacy page, check the <span class="highlightedWordColor"><b>Download the video</b></span> checkbox. This item is at the bottom of the page in the <b>"What other people can do with this video?"</b> section as shown in the image below.
                  <img src="../images/vimeo/vimeoSpanshot-PrivacySettings.png" style="width:598px;height:813px;margin:12px 0 0px 0;"></li>
                <li class="howTo" style="padding-top:0px;">Click <span class="highlightedWordColor"><b>Save changes</b></span>.</li>
              </ol>
              These steps will work whether your video allows <b>Anyone</b> or <b>Only people with a password</b> to watch it.
            </div>
          </article>
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
