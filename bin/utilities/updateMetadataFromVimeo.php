<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>SSF - Vimeo Metadata</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../sanssouci.css" type="text/css">
<!-- <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css"> -->
</head>

<body>
<h1 style="padding-left:20px;padding-top:20px;">Vimeo Media Info<span class="medSmallBodyTextLeaded"> (under construction - see notes in code)</span></h1>
<?php

  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  include "../classes/SSFVimeo.php";

  // TODO
  //   Create a UI for this utility.
  //   Copy the data into existing frameWidthInPixels and frameHeightInPixels fields in the works table.
  //   Eventually, all this should be moved into the media table.
  
  // Make the below parameters part of the UI
  $callForEntries = 13;
  $maxCount = 200; // maximum number of queries to Vimeo
  $reallyQueryVimeo = true;

  function styledTableCell($addedStyles='') {
    $styledTD = '    <td class="medSmallBodyTextLeaded" style="margin:0 12px;padding:2px 6px;text-align:center;vertical-align:top;border-bottom:1px solid #CCC;border-right:1px solid #CCC;' . $addedStyles . '">';
    return $styledTD;
  }
  
  function styledTableHeaderCell($addedStyles='') {
    $styledTH = styledTableCell('font-weight:bold;vertical-align:bottom;border:0;border-bottom:1px black solid;' . $addedStyles);
    return $styledTH;
  }

  function displaySize($sizeInput) {
    $displaySize = '---';
    if ($sizeInput != 0) $displaySize = $sizeInput;
    return $displaySize;        
  }

  function shortenedVimeoWebAddress($vimeoWebAddress) {
    $shortenedVimeoWebAddress = $vimeoWebAddress;
    if (strlen($vimeoWebAddress) > 0) {
      $foundIndex = strripos($vimeoWebAddress, 'https://vimeo.com/');
      if (($foundIndex !== false) && ($foundIndex == 0)) { $shortenedVimeoWebAddress = substr($vimeoWebAddress, strlen('https://vimeo.com/')); }
      $foundIndex = strripos($vimeoWebAddress, 'http://vimeo.com/');
      if (($foundIndex !== false) && ($foundIndex == 0)) { $shortenedVimeoWebAddress = substr($vimeoWebAddress, strlen('http://vimeo.com/')); }
      $foundIndex = strripos($vimeoWebAddress, 'vimeo.com/');
      if ($foundIndex === false) { 
        $foundIndex = strripos($vimeoWebAddress, 'dropbox.com/');
        if ($foundIndex !== false) $vimeoWebAddress = substr($vimeoWebAddress, $foundIndex);
        $shortenedVimeoWebAddress = (substr($vimeoWebAddress, 0, 12) . '...');
      }
    } else {
      $shortenedVimeoWebAddress = '---';
    }
    return $shortenedVimeoWebAddress;
  }
  
  function headerRows() {
    // pre-header row
    $headerRow = '  <tr>' . "\r\n";
    $headerRow .= '    <td colspan="10" class="medSmallBodyTextLeaded" '
               .                     ' style="margin-right:16px;text-align:center;font-weight:bold;vertical-align:middle;border-bottom:1px black solid;"'
               .                     '>Database</td>' . "\r\n";
    $headerRow .= '    <td colspan="1" class="medSmallBodyTextLeaded" style="border:0px;"> </td>' . "\r\n";
    $headerRow .= '    <td colspan="10" class="medSmallBodyTextLeaded" " '
               .                     ' style="margin-left:16px;text-align:center;font-weight:bold;vertical-align:middle;border-bottom:1px black solid;"'
               .                      '>Vimeo</td>' . "\r\n";
    $headerRow .= '  </tr>' . "\r\n";
    // primary header row
    $headerRow .= '  <tr>' . "\r\n";
    // SSFDB column headers
    $headerRow .= styledTableHeaderCell() . 'DesId</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell('text-align:left;') . 'Title</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Sbmssn Frmt</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell('max-width:100px;') . 'Original Frmt</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Aspect Ratio</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Width</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Height</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'RT</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Vimeo</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'PW</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell('border:0px;') . ' </td>' . "\r\n";
    // Vimeo column headers
    $headerRow .= styledTableHeaderCell() . 'ID</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'HD</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Trnscdng</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Width</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Height</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Secs</td>' . "\r\n";

    $headerRow .= styledTableHeaderCell() . 'Privacy</td>' . "\r\n";
//    $headerRow .= styledTableHeaderCell() . 'Priv Disp</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Embed Priv</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Upload Date</td>' . "\r\n";
    $headerRow .= styledTableHeaderCell() . 'Modification Date</td>' . "\r\n";
    $headerRow .= '  </tr>' . "\r\n";
    return $headerRow;
  }
  
  // Make query
  $query = "select workId, title, designatedId, submissionFormat, originalFormat, "
         . " aspectRatio, ratio, ratioDescription, useInUI, "
         . " anamorphic, frameWidthInPixels, frameHeightInPixels, "
         . " vimeoWebAddress, vimeoPassword, runTime "
         . " from works join aspectRatios on aspectRatio=aspectRatioId "
         . " where callForEntries = " . $callForEntries
         . " order by designatedId";
  $works = SSFDB::getDB()->getArrayFromQuery($query);
  SSFDebug::globalDebugger()->belch("Works", $works, -1);

  // Generate output
  echo '<table style="border:1 solid gray;margin:15px auto;padding:5px;">';
  echo headerRows();
  $count = 0;
  foreach ($works as $work) { 
    $count++;
    if ($count <= $maxCount) {
      $vimeoWebAddress = $work['vimeoWebAddress'];
      $outputRow = '  <tr>' . "\r\n";
      // SSFDB columns
      $outputRow .= styledTableCell() . $work['designatedId'] . '</td>' . "\r\n";
      $outputRow .= styledTableCell('min-width:100px;max-width:180px;text-align:left;') . $work['title'] . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $work['submissionFormat'] . '</td>' . "\r\n";
      $outputRow .= styledTableCell('max-width:100px') . $work['originalFormat'] . '</td>' . "\r\n";
      $aspectRatioDisplay = '---';
      if ($work['useInUI'] != 0) $aspectRatioDisplay = $work['ratio'] . ' (' . $work['ratioDescription'] . ')';
      $outputRow .= styledTableCell() . $aspectRatioDisplay . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . displaySize($work['frameWidthInPixels']) . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . displaySize($work['frameHeightInPixels']) . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $work['runTime'] . '</td>' . "\r\n";
      $outputRow .= styledTableCell('max-width:100px;') . shortenedVimeoWebAddress($vimeoWebAddress) . '</td>' . "\r\n";
      $outputRow .= styledTableCell('max-width:100px;') . (($work['vimeoPassword'] == '') ? '' : '1') . '</td>' . "\r\n";
      // Compute Vimeo columns
      $vimeoWidth = $vimeoHeight = $vimeoDration = 0;
      $vimeoId = $vimeoIsHD = $vimeoTranscoding = $vimeoPrivacyCode = $vimeoPrivacyDisplay = $vimeoEmbedPrivacy = $vimeoUploadDate = $vimeoModifiedDate = '';
      if ($reallyQueryVimeo && isset($vimeoWebAddress) && ($vimeoWebAddress != '')) {
        // isHD, title, description, uploadDate, modifiedDate, width, height, duration
        $vimeoObject = new SSFVimeoVideoInfo($vimeoWebAddress, $work['vimeoPassword'], -1);
        $vimeoId = $vimeoObject->id();
        $vimeoIsHD = ($vimeoObject->isHD() == 1) ? '1' : '';
        $vimeoWidth = $vimeoObject->width();
        $vimeoHeight = $vimeoObject->height();
        $vimeoDration = $vimeoObject->duration();
        $vimeoTranscoding = ($vimeoObject->isTranscoding() != 0) ? $vimeoObject->isTranscoding() : '';
        $vimeoPrivacyCode = $vimeoObject->privacyCode();
        $vimeoPrivacyDisplay = $vimeoObject->privacyDisplay();
        $vimeoEmbedPrivacy = $vimeoObject->embedPrivacy();
        $vimeoUploadDate = $vimeoObject->uploadDate();
        $vimeoModifiedDate = $vimeoObject->modifiedDate();
        $vimeoInfoDisplayString = $vimeoObject->getInfoString($includeDiagnostics=true);
        SSFDebug::globalDebugger()->belch("vimeoInfoDisplayString", $vimeoInfoDisplayString, -1);
      }

      // Display Vimeo columns
      $outputRow .= styledTableCell('border:0px;') . ' </td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoId . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoIsHD . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoTranscoding . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoWidth . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoHeight . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoDration . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoPrivacyCode . '</td>' . "\r\n";
//      $outputRow .= styledTableCell() . $vimeoPrivacyDisplay . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoEmbedPrivacy . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoUploadDate . '</td>' . "\r\n";
      $outputRow .= styledTableCell() . $vimeoModifiedDate . '</td>' . "\r\n";

      $outputRow .= '  </tr>' . "\r\n";
      echo $outputRow;
    }
  }
  echo '</table>' . "\r\n";

// ------------------------------------------------------------------------------------------------------------------------------------------------

// This is a TEST and only a TEST. I did not get it to work because 
//   - php-mp4info library (https://code.google.com/p/php-mp4info/) is a beta from 2009 and
//   - FF-MPEG extension for PHP (http://ffmpeg-php.sourceforge.net/) is hard to install and
//   - I didn't even try to get the information from Vimeo
// Ref: http://stackoverflow.com/questions/13239635/how-to-get-width-and-height-of-mp4-file-in-php-code-before-playing-them

/*  
  $filePath = '/Volumes/Drobo/Sans Souci Movie Files/SSF 2012 onward Videos/SSF 2013 Media for Curators/13-096-WithoutHimentropy-CraigOty_1280x720-HD.mp4';
  $video = new ffmpeg_movie($filePath);
  $duration = $video->getDuration();
  $width    = $video->getFrameWidth();
  $height   = $video->getFrameHeight();
*/

/* php-mp4info
  include("MP4Info.php");
  $info = MP4Info::getInfo('directory/to/file.mp4');
  if($info->hasVideo) {
    echo $info->video->width . ' x ' . $info->video->height;
  }
*/

  //echo $duration . ' ' . $width . ' ' . $height;

?>

</body>
</html>
