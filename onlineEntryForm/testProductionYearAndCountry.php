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
            </style>


<div style='border:1px green solid;'>
<!--            <div class='formRowContainer'> -->
<div>Silly Billy</div>
              <div class="rowTitleTextNarrow">
                P
              </div>
<!--
              <div class='entryFormFieldContainer'>
                <div style='float:left;margin-right:10px;'>
                  <input type='text' id=works_yearProduced-1 name=works_yearProduced onKeyPress='return digitsOnly2(event);' class=entryFormInputFieldVeryShort value="2015" maxLength="4" onchange='javascript:userMadeAChange(0);'>
                </div>
                <div style="float:left;margin-top:-1;">
                  <span class="rowTitleTextWide" style="width:150px;"><span style="color:#CC3333;">&nbsp;*&nbsp;</span>Country of Production:</span>
                  <input class="entryFormInputFieldShort" style="width:110px;" type="text" id="works_countryOfProduction-1" name="works_countryOfProduction" value="USA" maxlength="64" onchange="javascript:userMadeAChange(0);">
                </div>
                <div style='clear:both;'></div>
              </div>
            </div>
-->
                <div style='clear:both;'></div>
</div>

          </article>

<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>

