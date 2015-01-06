<!DOCTYPE html>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
	SSFDebug::globalDebugger()->belch('_FILE_', __FILE__, -1);
//  SSFProgramPageParts::initializePage(__FILE__, $doCache = false); 
?>
<?php              /* UPDATE THESE ITEMS */
  $pageTitle = 'at the Roxy, Dec. 2014';
  $allowRobotIndexing = true;
  SSFProgramPageParts::setShowsEvent(37);
  SSFProgramPageParts::$pageHeaderTitleText = 'Kinetoscope at the Roxy, Dec. 2014';
  SSFProgramPageParts::$pageContentTitleText = '<a href="http://www.theroxytheater.org/films/kinetoscope-screendance-film-festival/">Kinetoscope at the Roxy</a>, Dec. 5 &amp; 6, 2014';
	SSFProgramPageParts::$programPicBorderWidthInPixels = '1';
	SSFProgramPageParts::$programHighlightColor = '#586caf';
//	SSFProgramPageParts::disallowRobotIndexing(); // Default is to allow robot indexing
//  $onlineTicketsURL = 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media?utm_source=wordfly&amp;utm_medium=email&amp;utm_campaign=TheD.A.M.ShowBlast&amp;utm_content=version_A';
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
      echo SSFProgramPageParts::beginContentHeader();
     ?>
  
    <table>
    	<tr>  <!-- Roxy 12/2014 -->
    	  <td class="topLeft programInfoText" style="padding-top:6px;">
<!--
      	    <div style="font-size:20px;margin-top:8px;margin-bottom:0px;line-height:18px;color:#E49548;"><a href="http://www.theroxytheater.org/">The Roxy</a>&nbsp;<span class="programInfoTextSmall" style="color:#E49548;">718 South Higgins Ave, Missoula MT 59801, USA</span></div>
-->
    	    <div style="font-size:20px;margin-top:8px;margin-bottom:0px;line-height:18px;color:#E49548;"><span class="programInfoText" style="color:#E49548;">718 South Higgins Ave, Missoula MT 59801, USA</span></div>
    		  <div style="font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;color:#E49548;font-weight:normal;">Two different programs each evening</div>
    		  <div style="font-size:15px;margin-top:6px;margin-bottom:0px;line-height:120%;color:#E49548;font-weight:normal;">Co-sponsored by <a href="http://www.barebaitdance.org">Bare Bait Dance</a>.</div>
        </td>
      </tr>
    </table>

<?php
  echo SSFProgramPageParts::endContentHeader();
  SSFProgramPageParts::showWorks();
  echo SSFProgramPageParts::endPageBody();
?>

</body>
</html>