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
  
  $callForEntries = 8; // TODO get from table
  $imagesDirectoryToWrite = 'images/Stills2010/'; // TODO get from table
  $imagesDirectoryToRead = '../../' . $imagesDirectoryToWrite;
  $dpi = 72;
  $defaultWidth = 180;
  $defaultHeight = 120;
  
	// READ the VALUES FROM the DATABASE FOR DISPLAY
	$worksSelectString = "select workId, designatedId, title, name, dateMediaReceived, "
	                   . "submissionFormat, submitter, mediaNotes, photoCredits, "
	                   . "concat(workId, '-', replace(titleForSort,' ','')) as imageName, "
	                   . "concat(designatedId, '-', replace(titleForSort,' ',''), '-', replace(name,' ','')) as fileName "
	                   . "from works join people on personId=submitter "
//	                   . "where callForEntries=" . $callForEntries . " and accepted=1 "
	                   . "where callForEntries=" . $callForEntries . " and (designatedId='10-24' or designatedId='10-64' or designatedId='10-65') "
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
  echo "FILES in " . $imagesDirectoryToRead . " are: " . $imageDirectoryFiles . "<br>\r\n";

  echo 'MODIFYING table ' . SSFDB::getSchemaName() . ".images.<br>\r\n";

	$index = 0;
	foreach ($worksArray as $work) {
	  $index++;
	  $fileName = str_replace('.', '', $work['fileName']); // TODO This is a hack to handle "a.k.a." in a fileName.
	  $fileName .= '.jpg'; // TODO Likewise, the concatenation of ".jpg" should occur in the query.
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
      $altText = "Frame from " . $work['title'];
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
    //echo "IMAGESELECTSTRING = " . $imageSelectString . "<br>\r\n";
    $imageArray = SSFDB::getDB()->getArrayFromQuery($imageSelectString); 
    //echo "IMAGEARRAY = "; print_r($imageArray); echo "<br>\r\n";
    $imageId = $imageArray[0]['imageId'];
    if (isset($imageId) && $imageId != '' && $imageId != 0) {
      // If it's in the table, just do an update on the image height.
      //echo 'UPDATING  ' . $imageId . ", " . $fileName . "<br>\r\n"; 
//      $updateString = "UPDATE images set heightInPixels = " . $height . " where imageId = " . $imageId;
      $updateString = "UPDATE images set heightInPixels=" . $height . ", widthInPixels=" . $width . " where imageId = " . $imageId;
      echo '  ' . $updateString . "<br>\r\n";
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

// select workId, designatedId, title, name, submissionFormat, submitter from works join people on personId=submitter where callForEntries=1
// select * from media join works on work=workId where accepted=1

?>

</body>
</html>
