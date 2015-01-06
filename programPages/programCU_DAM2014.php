<!DOCTYPE html>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
	SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
//  SSFProgramPageParts::initializePage(__FILE__, $doCache = false); 
?>
<?php              /* UPDATE THESE ITEMS */
  $pageTitle = 'Dance Art Media, 2014';
  $allowRobotIndexing = false;
  SSFProgramPageParts::setShowsEvent(35);
  SSFProgramPageParts::$pageHeaderTitleText = 'Sans Souci at the D.A.M.';
	SSFProgramPageParts::$programPicBorderWidthInPixels = '1';
	SSFProgramPageParts::$programHighlightColor = '#586caf';
  $onlineTicketsURL = 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media?utm_source=wordfly&amp;utm_medium=email&amp;utm_campaign=TheD.A.M.ShowBlast&amp;utm_content=version_A';
//  $programPageHeaderSnippet = '../snippets/2014DAMshowProgramPageHeader.html';
//  $fundingAcknowledgementSnippet = ''; // e.g., '../snippets/2014FundingAcknowledgement.html'
?>
<?php
/*
  // GET the number of shows in this event
  $showCountQuery = 'SELECT * from `shows` WHERE event = ' . $showsEvent;
  $showCountRows = SSFDB::getDB()->getArrayFromQuery($showCountQuery);
	SSFDebug::globalDebugger()->belch('showCountRows', $showCountRows, -1);
	$showCount = count($showCountRows);
*/
?>

<!-- <html lang="en"<?php echo SSFProgramPageParts::cacheString(); ?>> -->
<html lang="en">
  <head>
<?php 
  echo SSFProgramPageParts::htmlHeadContent($pageTitle, $allowRobotIndexing); 
?>
    <style type="text/css">
      /* CSS inline style definitions go here. */
/*      td { padding:0;border:0px solid red;background-color:#2300ff;margin:0;border-collapse:collapse; }  */
      table { padding:0;margin:0;border-collapse:collapse; }
    </style>
<?php 
  echo SSFProgramPageParts::cssMediaQueries(); 
?>
  </head>

    <body>
    <?php 
      echo SSFProgramPageParts::beginPageBody();
      echo SSFProgramPageParts::beginContentHeader($pageTitle, true);
     ?>
  
      <div style="margin-bottom:20px;">
        <div class="homeHeading1" style="margin:0px 0 3px 0;color:#FFFF99;font-size:19px;text-align:left;"><a href="http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media">The D.A.M. Show: Dance Art Media</a></div>
        <div class="homeHeading1" style="margin:5px 0 3px 0;color:#FFFF99;font-weight:bold;font-size:18px;text-align:left;">
          Friday &amp; Saturday, October 17 &amp; 18 <span style="font-size:15px;font-weight:normal;"> at 7:30 PM</span><br>and Sunday, October 19<span style="font-size:15px;font-weight:normal;"> at 2 PM</span>
        </div>
        <div style="font-size:20px;margin-top:0px;margin-bottom:0px;color:#E49548;font-weight:bold;">Irey Theater <span style="font-size:15px;font-weight:normal;">(<a href="http://www.colorado.edu/theatredance/eventstickets/venues-directions">directions</a>),</span> <span style="font-size:16px;font-weight:normal;">Theater Building, CU Boulder</span>
        </div>
        <div class="bodyTextLeadedOnBlack" style="margin:4px 0;padding:0;">
            produced by the Dance Division, Department of Theatre and Dance, CU Boulder
        </div>
      </div>

<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  echo SSFProgramPageParts::endPageBody();
?>

</body>
</html>