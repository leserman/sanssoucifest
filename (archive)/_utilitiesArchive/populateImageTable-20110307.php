<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Populate Image Table</title>
<link rel="stylesheet" href="../../database/sanssouci.css" type="text/css">
<link rel="stylesheet" href="../../database/sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php
  include_once "autoloadClasses.php";
  
  $debugOn = -1;
  
  $callForEntries = SSFRunTimeValues::getCallForEntriesId();
  $imagesDirectoryToWrite = SSFRunTimeValues::getCurrentImagesDirectory();
  $imagesDirectoryToRead = '../../' . $imagesDirectoryToWrite;
  $dpi = 72;
  $defaultWidth = 180;
  $defaultHeight = 120;
  
	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, titleForSort, name, dateMediaReceived, "
	                   . "submissionFormat, submitter, mediaNotes, photoCredits, "
	                   . "concat(workId, '-', replace(titleForSort,' ','')) as imageName "
//	                   . "concat(designatedId, '-', replace(titleForSort,' ',''), '-', replace(name,' ','')) as fileName "
	                   . "from works join people on personId=submitter "
	                   . "where callForEntries=" . $callForEntries . " and accepted=1 "
//	                   . "where callForEntries=" . $callForEntries . " and (designatedId='10-24' or designatedId='10-64' or designatedId='10-65') "
	                   . "order by designatedId";

  $worksArray = SSFDB::getDB()->getArrayFromQuery($worksSelectString); 
  
  // Get the list of images in the directory.
  $imageDirectoryFiles = '';
  if ($handle = opendir($imagesDirectoryToRead)) {
    while (false !== ($file = readdir($handle))) {
      if ($file != '.' && $file != '..') { $imageDirectoryFiles .= $file . ', '; }
    }
    closedir($handle);
  }

  //echo "FILES in " . $imagesDirectoryToRead . " are: " . $imageDirectoryFiles . "<br>\r\n";

  echo 'MODIFYING table ' . SSFDB::getSchemaName() . ".images.<br>\r\n";

	$index = 0;
	foreach ($worksArray as $work) {
	  $index++;
	  $fileName = HTMLGen::computedFileNameForWork($work['designatedId'], $work['titleForSort'], $work['name']); 
	  $fileName .= '.jpg'; 
	  $imagePath = $imagesDirectoryToRead . $fileName;
    if (stripos($imageDirectoryFiles, $fileName) === false) {
      $width = $defaultWidth;
      $height = $defaultHeight; 
    } else {
      $size = getimagesize($imagePath);
      //echo "SIZE = "; print_r($size); echo "<br>\r\n";
      $width = $size[0];
      $height = $size[1];
    }
    if ((!isset($work['photoCredits'])) || $work['photoCredits'] === '') {
      $screenCapOrProdPhoto = "ScreenCapture";
      $caption = "";
      $altText = "Frame from " . str_replace("'", "\'", str_replace('"', '\"', $work['title']));
    } else {
      $screenCapOrProdPhoto = "ProductionPhoto";
      $caption = "photo by " . $work['photoCredits'];
      $altText = $caption;
    }

    // Check that the directory / image file is not already in the table.
    $imageSelectString = "SELECT imageId, fileName FROM images "
//                       . "where fileName like '" . $fileName . "' "
                       . "where name like '" . $work['imageName'] . "' "
                       . "and directory = '" . $imagesDirectoryToWrite . "'";
    SSFDebug::globalDebugger()->becho('IMAGESELECTSTRING', $imageSelectString, $debugOn);
    $imageArray = SSFDB::getDB()->getArrayFromQuery($imageSelectString); 
    SSFDebug::globalDebugger()->belch('IMAGEARRAY', $imageArray, $debugOn);
    $imageId = (isset($imageArray[0]['imageId'])) ? $imageArray[0]['imageId'] : 0;
    if ($imageId != '' && $imageId != 0) {
      // If it's in the table, just do an update on the image height.
      SSFDebug::globalDebugger()->belch('UPDATING', $imageId . ", " . $fileName, $debugOn);
      $updateString = "UPDATE images set heightInPixels=" . $height . ", widthInPixels=" . $width . " where imageId = " . $imageId;
      echo $fileName . "&nbsp;&nbsp;&bull;&nbsp;&nbsp;" . $updateString . "<br>\r\n";
      SSFDB::getDB()->saveData($updateString);
    } else { // since the image file is not in the table.
      $insertString = "INSERT INTO images "
                      . "(name, fileName, directory, widthInPixels, heightInPixels, dpi, credit, "
                      . "screenCapOrProdPhoto, physicalOrElectronic, caption, altText, "
                      . "lastModificationDate, lastModifiedBy) "
                    . "VALUES (" 
                      . SSFQuery::quote($work['imageName']) . ", " 
                      . SSFQuery::quote($fileName) . ", " 
                      . SSFQuery::quote($imagesDirectoryToWrite) . ", " 
                      . $width . ", " . $height . ", " . $dpi . ", "
                      . SSFQuery::quote($work['photoCredits']) . ", " 
                      . SSFQuery::quote($screenCapOrProdPhoto) . ", "
                      . "'Electronic', '" . $caption . "', '" . $altText . "', NOW(), 1)";
        echo '  ' . $insertString . "<br>\r\n";
        SSFDB::getDB()->saveData($insertString);

        // OK, now get the imageId and make an entry into workImages with imageId and workId
        $imageId = SSFDB::getDB()->insertedId();
        $insertString = "INSERT INTO workImages (work, image, notes, lastModificationDate, lastModifiedBy) "
                      . "VALUES (" . $work['workId'] . ", " . $imageId . ", '" . $fileName . "', NOW(), 1)";
        echo '  ' . $insertString . "<br>\r\n";
        SSFDB::getDB()->saveData($insertString);
    }
	}

?>

</body>
</html>
