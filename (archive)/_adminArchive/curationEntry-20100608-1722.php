<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Pragma" content="no-cache">
  <META http-equiv="Expires" content="-1"> 
  <META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>SSF - Curation Data Entry Detail</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" style="border:0px solid blue;" >
  <tr><td align="left" valign="top">
    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" style="border:0px solid pink;">
      <tr>
        <td width="10" align="center" valign="top">&nbsp;</td>
        <td width="125" align="center" valign="top">&nbsp;<!-- SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__));  --></td>
        <td align="center" valign="top">
          <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" class="programTablePageBackground" style="border:0px solid red;">
            <tr>
              <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
              <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
              <td align="center" valign="top" class="bodyTextGrayLight">
                <table width="98%" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333" border="0" style="border:0px solid green;">
<!-- BEGIN emptyEntryDetail rows -->
                  <tr>
                    <td>
                      <div id='entryDetail'>
<?php
  // PERFORM ANY STATUS UPDATES INDICATED
  if (isset($_GET['accepted']) && ($_GET['accepted'] != '') 
     && isset($_GET['rejected']) && ($_GET['rejected'] != '')
     && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    $entryUpdateString = "UPDATE works set accepted = " .  $_GET['accepted'] . ", rejected = " . $_GET['rejected']
                       . " where workId=" . $_GET['workId'];
    SSFDB::getDB()->saveData($entryUpdateString);
  }
  
  // Determine the current workId to save
  if ((isset($_GET['updateCurationData']) && ($_GET['updateCurationData'] == 'YES')) 
    || (($_POST['curatorChangeCount'] > 0) && ($_POST['saveCuratorChangesFirst'] == 'yes')))
                                                                $workIdToSave = $_GET['workId'];

  // PERFORM CURATION DATA UPDATES if any
  // TODO: rather than looping over all the curators, consider the ones where there is a changed value for notes or score
  // TODO: build a single query instead of issuing 3
  if (isset($workIdToSave) && ($workIdToSave != '')) {
    $curators = SSFQuery::getCuratorsForWork($workIdToSave);
    foreach ($curators as $curator) {
      $scoreSelectorIdName = "score" . $curator;
      $notesTextAreaIdName = "notes" . $curator;
      $score = ((isset($_GET[$scoreSelectorIdName]) && ($_GET[$scoreSelectorIdName] != '')) ? $_GET[$scoreSelectorIdName] : 'NULL');
      $notes = ((isset($_GET[$notesTextAreaIdName]) && ($_GET[$notesTextAreaIdName] != '')) ? $_GET[$notesTextAreaIdName] : '');
      SSFQuery::saveCuratorData($curator, $workIdToSave, $score, $notes);
    }
    $currentWorkValueArray = SSFQuery::selectWorkFor($workIdToSave);
    //SSFDB::debugOn(); 
    //SSFQuery::updateDBFor('works', $currentWorkValueArray, XXXX, 'workId', $workIdToSave) ; <<<<<<< TODO SAVE
    //SSFDB::debugOff(); 
  }
  
  // READ the VALUES FROM the DATABASE FOR DISPLAY
  $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($_GET['workId']);
  SSFDebug::globalDebugger()->belch('workRow', $workRow, -1);
  //print_r($workRow); echo "<br>\r\n";
  $rawContributorsArray = SSFQuery::selectContributorsFor($_GET['workId']);
  $debugger = new SSFDebug(false, false);
  $debugger->belch('rawContributorsArray', $rawContributorsArray, 0);
  $curationDataArray = SSFQuery::selectCurationDataFor($_GET['workId']);
  //echo 'curationDataArray: '; print_r($curationDataArray); echo "<br>\r\n";
  $widgets = array();
  foreach ($curationDataArray as $curationData) {
    $personId = $curationData['curator'];
    $scoreSelectorIdName = "score" . $personId;
    $notesTextAreaIdName = "notes" . $personId;
    $widgets[$notesTextAreaIdName] = $curationData['notes']; 
    if (($curationData['score'] >= 1) && ($curationData['score'] <= 10)) $widgets[$scoreSelectorIdName] = $curationData['score']; 
    else $widgets[$scoreSelectorIdName] = '--'; 
  }
?>

<!-- display Entry Details -->

            <div class="entryFormSectionHeading" style="padding-top:0px;margin-top:8px;">
              <div style="float:left;padding-top:0px;margin-top:0px;">Entry Detail</div>
              <div style="float:right;padding-right:10px;padding-bottom:0;">
                <input type="button" id="updateCurationData" name="updateCurationData" value="Apply Changes"
                   <?php echo "onClick=saveCuratorDataJS(" . $workRow['workId'] . ");" ?> > 
<!-- // TODO implement onclick -->
                <input type="button" id="cancelCurationChanges" name="cancelCurationChanges" value="Close"
                   onClick='hide("entryDetail");show("emptyEntryDetail");show("theWorksList");'
              </div>
              <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
            </div>
            <div class="bodyTextOnDarkGrayRowPadded">
<?php 
/* TODO: Fix emailWasSent so it can be used here.
              $acceptanceDisplay = (HTMLGen::emailWasSent($workRow) 
                                 ? HTMLGen::acceptanceDisplay($workRow['accepted'], $workRow['rejected'])
                                 : HTMLGen::acceptanceOperatorDisplay($workRow['workId'], $workRow['accepted'], $workRow['rejected'])); 
*/
              $arDisplay = HTMLGen::arWidgetDisplay($workRow['workId'], $workRow['accepted'], $workRow['rejected']);
              SSFDebug::globalDebugger()->becho('arDisplay', $arDisplay, 1);
              $acceptanceDisplay = str_replace('|', '"', $arDisplay);
              echo "<span style='font-size: 15px'>"
                . (($workRow['designatedId'] == '') ? "00-00" : $workRow['designatedId'])
                . ". </span><span class='curationTitle'>" . $workRow['title'] . "</span>"
                . "&nbsp;(" . $workRow['yearProduced'] . ")" 
                . "<span class='datumDescription' style='padding-left:1.0em;'>run time: </span>"
                . "<span class='datumValue' style='font-size:15px;'>" . $workRow['runTime'] . "</span>"
                . (($workRow['includesLivePerformance']) ? "<span class='liveDisplayText'>&nbsp;Live</span>" : "")
                . "<span id='entryARSpan' style='padding-right:1.5em;padding-left:1.5em;'>" 
                .  $acceptanceDisplay
                . "</span><span style='padding-right:1.5em;color:#DF7416'>" . substr(HTMLGen::getDbScoreFor($workRow['workId']), 0, 3) 
                . "</span><span class='datumValue' style='padding-right:1.5em;font-size:11px;'>$"  . $workRow['amtPaid'] . "</span>"
                . "<span style='color:#d25ec6;font-size:11px;'>" . $workRow['workId'] . "</span>"; 
?>
            </div>

<!-- display Submitter Information -->
<?php
      // name, organization, city, state, country, email, date media received
      // name
      $valueString = $workRow['name'] . ", ";
      // organization
      if (isset($workRow['organization']) && ($workRow['organization'] != '')) { $valueString .= $workRow['organization'] . ", "; }
      // city, state, country
      $cityLineExists = false; 
      $countryExists = (isset($workRow['country']) && ($workRow['country'] != ''));
      if (isset($workRow['city']) && ($workRow['city'] != '')) { $cityLineExists = true; $valueString .= $workRow['city'] . ", "; }; 
      if (isset($workRow['stateProvRegion']) && ($workRow['stateProvRegion'] != '')) { 
        $cityLineExists = true; $valueString .= $workRow['stateProvRegion']; 
      }
      if ($cityLineExists && $countryExists) { $valueString .= ", "; }
      if ($countryExists) { $valueString .= $workRow['country']; }
      // email
      $emailString = str_replace(array('<', '>'), '', $workRow['email']);
      $valueString .= ', ' . HTMLGen::getHTMLAnchoredEmailStringFor($workRow['name'], $emailString);
      $displayLinePart1 = HTMLGen::getSimpleDataWithDescriptionElement('Submitted by', $valueString);
      // media received
      $displayLinePart2 = HTMLGen::getMediaReceivedDisplayElement($workRow['dateMediaReceived']);
      //echo $displayLinePart2 , ' ' . stripos($displayLinePart2, 'NOT') . "<br>\r\n";
      if (HTMLGen::mediaReceived($workRow['dateMediaReceived'])) {
        echo '<div>' . $displayLinePart1 . '<div class="floatRight" style="padding-top:0px;padding-right:4px;">' 
                     . $displayLinePart2 . '</div><div style="clear:both;"></div></div>';
      } else {
        echo '<div>' . $displayLinePart2 . '</div><div style="clear:both;"></div></div>';
        echo '<div>' . $displayLinePart1 . '</div><div style="clear:both;"></div></div>';
      }

// Display Media Information
    $floatLeftDivs = array(HTMLGen::getMediaFormatsDisplayElement($workRow['submissionFormat'], $workRow['originalFormat']),
                           HTMLGen::getSimpleDataWithDescriptionElement('Permissions', $workRow['permissionsAtSubmission'], '2em'));
    echo HTMLGen::getDisplayLineFromElements($floatLeftDivs);

// Display Contributor Information
  $displayContributorsOnSeparateLines = false;
  echo HTMLGen::getContributorDisplayLines($rawContributorsArray, $displayContributorsOnSeparateLines);

// Display the Rest of the Entry Information
  echo HTMLGen::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workRow));

  if ($workRow['webSite'] != '') echo HTMLGen::getWebSiteDisplayLine($workRow['webSite'], $workRow['webSitePertainsTo']);
  $alwaysShow = false;
  $previouslyShownAt = $workRow['previouslyShownAt'];
  $submissionNotes = $workRow['submissionNotes'];
  $workNotes = $workRow['workNotes'];
  $mediaNotes = $workRow['mediaNotes'];
  if ($alwaysShow || (isset($previouslyShownAt) && ($previouslyShownAt != ''))) echo HTMLGen::getSimpleDataWithDescriptionLine('Also shown at', $previouslyShownAt);
  if ($alwaysShow || (isset($submissionNotes) && ($submissionNotes != ''))) echo HTMLGen::getSimpleDataWithDescriptionLine('Submission notes', $submissionNotes);
  if ($alwaysShow || (isset($workNotes) && ($workNotes != ''))) echo HTMLGen::getSimpleDataWithDescriptionLine('Work notes', $workNotes);
  if ($alwaysShow || (isset($mediaNotes) && ($mediaNotes != ''))) echo HTMLGen::getSimpleDataWithDescriptionLine('Media notes', $mediaNotes);
?>

<div class="bodyTextOnDarkGray">
  <form action="entryDetail.php" method="post" name="curationData" id="curationData">
    <div>
      <input type="hidden" id="curatorChangeCount" name="curatorChangeCount" value=0 > 
      <input type="hidden" id="saveCuratorChangesFirst" name="saveCuratorChangesFirst" value='yes' > 
      <input type="hidden" id="workId" name="WorkId" value=<?php echo $workRow['workId'] ?> > 
    </div>
    <div style="margin:6px 0;padding:6px 0 6px 0;border:1px dashed #FFFFCC">
      <table align='center' width='96%' border='0' cellspacing='0' cellpadding='0'>

<?php 
  function displayCurationControlsFor($personId, $personNickname, $widgets) {
    $scoreSelectorIdName = "score" . $personId;
    $notesTextAreaIdName = "notes" . $personId;
    echo "        <tr>\r\n";
    echo '          <td align="right" valign="middle" class="bodyTextOnDarkGray" width="10%">' . $personNickname . '</td>' . "\r\n";
    echo '          <td align="center" valign="middle" class="bodyTextOnDarkGray" width="10%">';
      HTMLGen::displayCurationScoreSelector($scoreSelectorIdName, $scoreSelectorIdName, $widgets[$scoreSelectorIdName], $personId);
    echo '</td>' . "\r\n";
    echo '          <td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:2px 0 2px 0"><textarea rows="2" ' 
         . 'cols="200" name="' . $notesTextAreaIdName . '" id="' . $notesTextAreaIdName 
         . '" class="curationFormTextArea" onChange="javascript:curatorMadeAChange(5);">'
         . $widgets[$notesTextAreaIdName] . '</textarea></td>' . "\r\n";
    echo "          <td width='5%'>&nbsp;</td>\r\n";
    echo "        </tr>\r\n";
  } // end function displayCurationControlsFor

  $curatorRows = SSFQuery::getCuratorRowsForWork($workRow['workId']);
  foreach ($curatorRows as $curatorRow) {
    displayCurationControlsFor($curatorRow['curator'], $curatorRow['nickName'], $widgets);
  }
//  echo '<tr><td align="center" colspan="4"><hr noshade="true" size="1" width="90%" style="color:#FFFFCC">' . "</td></tr>\r\n";
//  $disable = false;
//  echo '        <tr><td align="right" valign="middle" class="bodyTextOnDarkGray" colspan="4">';
//    HTMLGen::addTextAreaRow('works_submissionNotes', 'Submission Notes', $workRow['submissionNotes'], 2048, 2, $disable);
//  echo "        </td></tr>\r\n";
//  echo '        <tr><td align="right" valign="middle" class="bodyTextOnDarkGray" colspan="4">';
//    HTMLGen::addTextAreaRow('works_workNotes', 'Work Notes', $workRow['workNotes'], 2048, 2, $disable);
//  echo "        </td></tr>\r\n";
//  echo '        <tr><td align="right" valign="middle" class="bodyTextOnDarkGray" colspan="4">';
//    HTMLGen::addTextAreaRow('works_mediaNotes', 'Media Notes', $workRow['mediaNotes'], 2048, 2, $disable);
//  echo "        </td></tr>\r\n";

// TODO Add: installationOnly
?>
      </table>
    </div>
  </form>
</div>

                      </div>
                    </td>
                  </tr>
<!-- END emptyEntryDetail rows -->
                  <tr align="center" valign="top">
                    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"
                          style="padding-top:0px;padding-bottom:8px;"><?php SSFWebPageAssets::displayCopyrightLine();?></td>
                  </tr>
                </table>
              </td>
              <td width="10" align="left" valign="top" style="border:0px solid orange;" class="programTablePageBackground">&nbsp;</td>
              <td width="25" align="left" valign="top" style="border:0px solid orange;" class="sprocketHoles">&nbsp;</td>
            </tr>
          </table>
        </td>
        <td width="10" align="center" valign="top">&nbsp;</td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
