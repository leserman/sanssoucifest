<?php

  include_once "../../bin/utilities/autoloadClasses.php";

  function debuglogline($string) { if (false) echo $string . "\r\n"; }

  // PERFORM ANY STATUS UPDATES INDICATED
  //echo "GET[accepted] = |" . $_GET['accepted'] . "|    " . "GET[rejected] = |" . $_GET['rejected'] 
  //   . "|    " . "GET[workId] = |" . $_GET['workId'] . "|    " . "GET[entryId] = |" . $_GET['entryId'] . "|<br>\r\n"; 
  if (isset($_GET['accepted']) && ($_GET['accepted'] != '') 
     && isset($_GET['rejected']) && ($_GET['rejected'] != '')
     && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    $entryUpdateString = "UPDATE works set accepted = " .  $_GET['accepted'] . ", rejected = " . $_GET['rejected']
                       . " where workId=" . $_GET['workId'];
    SSFDB::getDB()->saveData($entryUpdateString);
  }
  
  // Determine the current workId to save
  //echo '$GET: '; print_r($_GET); echo "<br>\r\n";
  //echo '$POST: '; print_r($_POST); echo "<br>\r\n";
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

            <div class="entryFormSectionHeading">
              <div style="float:left;padding-top:4px;padding-top:2px;">Entry Detail</div>
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
              $acceptanceDisplay = (HTMLGen::acceptRejectEmailWasSent($workRow) 
                                 ? HTMLGen::acceptanceDisplay($workRow['accepted'], $workRow['rejected'])
                                 : HTMLGen::acceptanceOperatorDisplay($workRow['workId'], $workRow['accepted'], $workRow['rejected']));
              echo "<span style='font-size: 15px'>"
                . (($workRow['designatedId'] == '') ? "00-00" : $workRow['designatedId'])
                . ". </span><span class='curationTitle'>" . $workRow['title'] . "</span>"
                . "&nbsp;(" . $workRow['yearProduced'] . ")" 
                . "<span class='datumDescription' style='padding-left:1.0em;'>run time: </span>"
                . "<span class='datumValue' style='font-size:15px;'>" . $workRow['runTime'] . "</span>"
                . (($workRow['includesLivePerformance']) ? "<span class='liveDisplayText'>&nbsp;Live</span>" : "")
                . "<span style='padding-right:1.5em;padding-left:1.5em;'>" 
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

?>

<!-- display Media Information -->
  <?php 
    $floatLeftDivs = array(HTMLGen::getMediaFormatsDisplayElement($workRow['submissionFormat'], $workRow['originalFormat']),
                           HTMLGen::getSimpleDataWithDescriptionElement('Permissions', $workRow['permissionsAtSubmission'], '2em'));
    echo HTMLGen::getDisplayLineFromElements($floatLeftDivs);
  ?>

<!-- display Contributor Information -->
<?php       
  $displayContributorsOnSeparateLines = false;
  echo HTMLGen::getContributorDisplayLines($rawContributorsArray, $displayContributorsOnSeparateLines);
?>

<!-- display the Rest of the Entry Information -->
<?php 
  echo HTMLGen::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workRow));
?>

<?php 
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