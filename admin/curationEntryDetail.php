<?php

  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

    // Functions
  
    function getAcceptForSelector($workId, $currentAcceptFor, $accepted) {
      // works.acceptFor	enum('installationOnly', 'installationMaybe', 'screening', 'documentary', 'alternateVenue') // added alternateVenue 7/18/13
      $options = array('screening' => 'Screen', 'installationOnly' => 'Install', 'installationMaybe' => 'Install?', 'documentary' => 'Documentary', 'alternateVenue' => 'Alt Venue');
      $selectorHTMLString = '<select id="works_acceptFor" name="works_acceptFor" style="width:80px" ';
      if ($accepted != 1) $selectorHTMLString .= ' disabled = disabled ';
      $updateAcceptForStatus = 'updateAcceptForStatus(' . $workId . ');';
      $selectorHTMLString .= 'onChange="javascript:' . $updateAcceptForStatus . '">';
      $selectorHTMLString .= HTMLGen::getSelectionOptionsText($options, $currentAcceptFor);
      $selectorHTMLString .= '</select>';
      return $selectorHTMLString;
    }
    
    function displayAlsoShownAt($workRow, $alwaysShow) {
      if ($alwaysShow || (isset($workRow['previouslyShownAt']) && ($workRow['previouslyShownAt'] != ''))) 
        echo '<div style="margin-top:2px;">' . HTMLGen::getSimpleDataWithDescriptionLine('Also shown at', $workRow['previouslyShownAt']) . '</div>';
    }

    function displayCredits($contributorsArray) {
      // Display Credits/Contributor Information
      $displayContributorsOnSeparateLines = false;
      echo '<div style="margin-top:1px;">' . HTMLGen::getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines) . '</div>';
    }

    function displayCurationControlsFor($workId, $designatedId, $personId, $personNickname, $widgets) {
      $scoreSelectorIdName = "score-" . $personId;
      $notesTextAreaIdName = "notes-" . $personId;
      $updateCurationNoteParamList = $workId . ', \'' . $designatedId . '\', \'' . $personId . '\', this.value';
      SSFDebug::globalDebugger()->becho('updateCurationNoteParamList', $updateCurationNoteParamList, -1);
      echo "        <tr>\r\n";
      echo '          <td align="right" valign="middle" class="bodyTextOnDarkGray" width="14%">' . $personNickname . '</td>' . "\r\n";
      echo '          <td align="center" valign="middle" class="bodyTextOnDarkGray" width="10%">';
      HTMLGen::displayCurationScoreSelector($workId, $scoreSelectorIdName, $scoreSelectorIdName, $widgets[$scoreSelectorIdName], $personId);
      echo '</td>' . "\r\n";
      SSFDebug::globalDebugger()->becho('widgetVal for widgets[' . $notesTextAreaIdName. ']', $widgets[$notesTextAreaIdName], -1);
      echo '          <td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:2px 0 2px 0"><textarea rows="2" ' 
           . 'cols="200" name="' . $notesTextAreaIdName . '" id="' . $notesTextAreaIdName 
           . '" class="curationFormTextArea" '
           . 'onChange="javascript:updateCurationNote(' . $updateCurationNoteParamList . ');">'
           . $widgets[$notesTextAreaIdName] . '</textarea></td>' . "\r\n";
      echo "          <td width='5%'>&nbsp;</td>\r\n";
      echo "        </tr>\r\n";
    } // end function displayCurationControlsFor
    
    function displayCurationForm($workRow, $widgets) {
      $workId = $workRow['workId'];
      // Curation Form
      echo '              <div class="bodyTextOnDarkGray" style="border:0px red dashed;">' . "\r\n";
      echo '                <form action="curationEntryDetail.php" method="post" name="curationData" id="curationData">' . "\r\n";
      echo '                  <div>' . "\r\n";
      echo '                    <input type="hidden" id="curatorChangeCount" name="curatorChangeCount" value=0 > ' . "\r\n";
      echo '                    <input type="hidden" id="saveCuratorChangesFirst" name="saveCuratorChangesFirst" value="yes" >' . "\r\n";
      SSFDebug::globalDebugger()->becho('workId', $workId, -1);
      echo '                    <input type="hidden" id="workId" name="workId" value=' . $workId . '>' . "\r\n";
      echo '                    <input type="hidden" id="acceptForCache" name="acceptForCache" value="' . $workRow['acceptFor'] . '"> ' . "\r\n";
      echo '                  </div>' . "\r\n";
  
      // Display Work-related Notes
      echo '                  <div style="margin:6px 0;padding:6px 0 6px 0;border:1px dashed #FFFFCC">' . "\r\n"; // chartreuse
      echo "                    <table align='center' width='96%' border='0' cellspacing='0' cellpadding='0'>\r\n";
      displayTextAreaItemRow($workId, 'Work&nbsp;Notes', 'works', 'workId', 'workNotes', $workRow['workNotes']);
      displayTextAreaItemRow($workId, 'Media&nbsp;Notes', 'works', 'workId', 'mediaNotes', $workRow['mediaNotes']);
// TODO: Add this stuff right.
//      HTMLGen::addAspectRatioAnamorphicRow($workRow['aspectRatio'], $workRow['anamorphic']);
//      HTMLGen::addPixelDimensionsWidgetsRow($workRow['frameWidthInPixels'], $workRow['frameHeightInPixels']);
      echo '      </table>' . "\r\n";
      echo '    </div>' . "\r\n";
      
      // Display Curator Widgets
      echo '                  <div style="margin:4px 0;padding:6px 0 6px 0;border:1px dashed #FFFFCC">' . "\r\n"; // purple
      echo "                    <table align='center' width='96%' border='0' cellspacing='0' cellpadding='0'>\r\n";
      $curatorRows = SSFQuery::getCuratorRowsForWork($workId, $workRow['callForEntries']);
      SSFDebug::globalDebugger()->belch('widgets', $widgets, -1);
      foreach ($curatorRows as $curatorRow) if (SSFQuery::curatorIsActive($curatorRow['curator'], $workRow['callForEntries'])) {
        $designatedId = (($workRow['designatedId'] == '') ? '00-00' : $workRow['designatedId']);
        displayCurationControlsFor($workId, $designatedId, $curatorRow['curator'], $curatorRow['nickName'], $widgets);
      }
      echo "                    </table>\r\n";
      echo '                  </div>' . "\r\n";
      echo '                </form>' . "\r\n";
      echo '              </div>' . "\r\n";
    }
    
    function displayCuratorResults($workId, $personId, $personNickname, $widgets) {
      SSFDebug::globalDebugger()->belch('displayCuratorResults widgets', $widgets, -1);
      $scoreSelectorIdName = "score-" . $personId;
      $notesTextAreaIdName = "notes-" . $personId;
      echo "        <tr>\r\n";
      echo '          <td align="right" valign="top" class="bodyTextOnDarkGray" width="14%">' . $personNickname . '</td>' . "\r\n";
      echo '          <td align="center" valign="top" class="bodyTextOnDarkGray" width="10%">' . $widgets[$scoreSelectorIdName] . '</td>' . "\r\n";
      echo '          <td align="left" valign="top" class="bodyTextOnDarkGray" style="padding:1px 0;line-height:17px">' . $widgets[$notesTextAreaIdName] . '</td>' . "\r\n";
      echo "        </tr>\r\n";
    }

    function displayCuratorRows($workRow, $widgets) {
      $workId = $workRow['workId'];
      echo '                  <div style="margin:4px 0;padding:4px 0;border:0px dashed orange">' . "\r\n"; // 1 px
      echo "                    <table align='center' width='96%' border='0' cellspacing='0' cellpadding='0'>\r\n";
      echo "                      <tr><td colspan='3'><div class='datumDescription' style='padding:0 0 2px 0;margin:0;'>Curation detail:</div></td></tr>\r\n";
      //SSFQuery::debugNextQuery();
      $curatorRows = SSFQuery::getCuratorRowsForWork($workId, $workRow['callForEntries']);
      SSFDebug::globalDebugger()->belch('displayCuratorRows curatorRows', $curatorRows, -1);
      foreach ($curatorRows as $curatorRow) displayCuratorResults($workId, $curatorRow['curator'], $curatorRow['nickName'], $widgets);
      echo "</table>\r\n";
      echo "</div>\r\n";
    }

    function displayDetailHeader($workRow, $acceptanceDisplay, $editAllowed) {
      $workId = $workRow['workId'];
      $countryOfProductionDisplay = ((!is_null($workRow['countryOfProduction']) && ($workRow['countryOfProduction'] !== '')))
                                  ? (', ' . $workRow['countryOfProduction']) : '';
      echo '              <div id="detailHead" style="border:0px purple solid;margin:0;padding:0;">' . "\r\n";
      echo "                <span style='font-size: 16px;color:#B7E5F7;'>"
        . (($workRow['designatedId'] == '') ? "00-00" : $workRow['designatedId'])
        . ". </span><span class='curationTitle'>" . $workRow['title'] . "</span>"
        . "&nbsp;(" . $workRow['yearProduced'] . $countryOfProductionDisplay . ")" 
        . ((!HTMLGen::mediaReceived($workRow['dateMediaReceived'])) ? "<span class='noMediaDisplayColor' style='margin-left:12px;'>&#8855;</span>" : "")
        . "<span class='datumDescription' style='padding-left:1.0em;'>TRT: </span>"
        . "<span class='datumValue' style='font-size:15px;'>" . HTMLGen::timeAsMinutesAndSeconds($workRow['runTime']) . "</span>"
        . (($workRow['includesLivePerformance']) ? "<span class='liveDisplayText'>&nbsp;Live</span>" : "")
        . "<span id='entryARSpan' style='padding-right:0.5em;padding-left:1.5em;'>" .  $acceptanceDisplay . "</span>"
        . ((!$editAllowed) ? "<span style='padding-right:1.5em;'></span>" 
                           : "<span style='padding-right:1.5em;padding-left:0.5em;'>" 
                                . getAcceptForSelector($workId, $workRow['acceptFor'], $workRow['accepted']) . "</span>" )
        . "<span id='entryScoreSpan' style='padding-right:1.5em;color:#DF7416'>" . HTMLGen::scoreString(HTMLGen::getDbScoreFor($workId)) . "</span>"
        . ((!$editAllowed) ? "" : "<span class='datumValue' style='padding-right:1.5em;font-size:11px;'>$"  . $workRow['amtPaid'] . "</span>" )
        . "<span style='color:#d25ec6;font-size:11px;'>" . $workId . "</span>". "\r\n";
      echo '              </div><!-- detailHead -->' . "\r\n";
    }
    
    function displayMediaFormatInfo($workRow) {
      $floatLeftDivs = array(HTMLGen::getMediaFormatsDisplayElement($workRow['submissionFormat'], $workRow['originalFormat']),
                             '<div class="datumValue floatLeft" style="padding:2px 0 0 6px;"><span class="datumDescription"> Frame: </span><span class="datumDescription"> ' . HTMLGen::getFrameParametersDisplayElement2($workRow) . '</span></div>');
                             
                             
//<div class="datumValue floatLeft" style="padding-top:2px;"><span class="datumDescription">Submitted as </span>HD-Vimeo<span class="datumDescription">. Originally recorded as </span>DVCAM.</div>


      echo '<div style="margin-top:2px;">' . HTMLGen::getDisplayLineFromElements($floatLeftDivs) . '</div>';
    }
    
    function displayMediaNotes($workRow, $alwaysShow) {
      if ($alwaysShow || (isset($workRow['mediaNotes']) && ($workRow['mediaNotes'] != ''))) 
        echo HTMLGen::getSimpleDataWithDescriptionLine('Media notes', $workRow['mediaNotes']);
    }

    function displayMediaReceivedAndPermissions($workRow) {
      $displayLinePart1 = HTMLGen::getMediaReceivedDisplayElement($workRow['dateMediaReceived'], $workRow['dateMediaPostmarked']);
      $displayLinePart2 = HTMLGen::getSimpleDataWithDescriptionElement('Permissions', $workRow['permissionsAtSubmission'], '2em');
      echo '<div style="margin-top:2px;border:0px cyan solid;"><div class="floatLeft" style="padding-top:1px;">' 
        . $displayLinePart1 . '</div><div class="floatRight" style="padding-top:1px;padding-right:4px;">' 
        . $displayLinePart2 . '</div><div style="clear:both;"></div></div>';
    }

    function displaySubmissionNotes($workRow, $alwaysShow) {
      if ($alwaysShow || (isset($workRow['submissionNotes']) && ($workRow['submissionNotes'] != ''))) 
        echo '<div style="margin-top:1px;">' . HTMLGen::getSimpleDataWithDescriptionLine('Submission notes', $workRow['submissionNotes']) . '</div>';
    }
    
    function displaySubmitterInfo($workRow) {
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
      echo '<div style="margin-top:2px;border:0px green solid;">' 
          . HTMLGen::getSimpleDataWithDescriptionLine('Submitted by', $valueString) . '</div>';
    }

    function displayTextAreaItemRow($workId, $itemTitle, $table, $indexCol, $itemCol, $initialValue) {
      $widgetIdName = 'notes-' . $table . '-' . $itemCol;
      $updateItemParamList = $workId . ', \'' . $table . '\', \'' . $indexCol . '\', \'' . $itemCol . '\', this.value';
      echo '        <tr>' . "\r\n";
      echo '          <td width="10%" align="right"><span class="datumDescription" style="margin-right:12px;">' . $itemTitle . ':</span></td>' . "\r\n";
      echo '          <td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:2px 0 2px 0"><textarea rows="1" ' 
           . 'cols="200" name="' . $widgetIdName . '" id="' . $widgetIdName . '" class="curationFormTextArea" '
           . 'onChange="javascript:updateItem(' . $updateItemParamList . ');">'
           . $initialValue . '</textarea></td>' . "\r\n";
      echo '        </tr>' . "\r\n";
    }

    function displayWebSite($workRow) {
      if ($workRow['webSite'] != '') 
        echo '<div style="margin-top:2px;">' . HTMLGen::getWebSiteDisplayLine($workRow['webSite'], $workRow['webSitePertainsTo']) . '</div>';
    }
    
    function displayWorkNotes($workRow, $alwaysShow) {
      if ($alwaysShow || (isset($workRow['workNotes']) && ($workRow['workNotes'] != ''))) 
        echo HTMLGen::getSimpleDataWithDescriptionLine('Work notes', $workRow['workNotes']);
    }


// Initialization
    $editAllowed = true;
    $currentEntryIdCache = HTMLGen::currentEntryIdCacheName($withEmailInfo=false);
    if (isset($_GET['callContext']) && ($_GET['callContext'] == 'curationEmail')) { 
      $editAllowed = false;
      $currentEntryIdCache = HTMLGen::currentEntryIdCacheName($withEmailInfo=true);
    }      
    $workId = (isset($_COOKIE[$currentEntryIdCache])) ? $_COOKIE[$currentEntryIdCache] : SSFRunTimeValues::getDefaultWorkId();
    if (isset($_GET['workId']) && ($_GET['workId'] != 0)) $workId = $_GET['workId'];
    SSFDebug::globalDebugger()->becho('workId', $workId, -1);
    //SSFDB::debugNextQuery();
    $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor($workId);
    SSFDebug::globalDebugger()->belch('while initializing curationEntryDetail.php workRow=', $workRow, -1);
    if (!isset($workRow['workId'])) { // That is, if the workId cached no longer exists in the DB
      echo "WorkId " . $workId . " is not in the database. It was probably cached and then deleted. The default work is being displayed instead. Tell the database administrator.<br><br>\r\n";
      // So, try again with the default work Id.
      $workRow = SSFQuery::selectSubmitterAndWorkWithARCommsFor(SSFRunTimeValues::getDefaultWorkId());
    } 
    $rawContributorsArray = SSFQuery::selectContributorsFor($workId);
    $curationDataArray = SSFQuery::selectCurationDataFor($workId, $workRow['callForEntries'], $applyLocallyActiveCuratorFilter=($editAllowed));
    $curatorRowsForWork = SSFQuery::getCuratorRowsForWork($workId, $workRow['callForEntries']);

    // Initialize the $widgets array.
    $widgets = array();
    foreach ($curationDataArray as $curationData) {
      $personId = $curationData['curator'];
      if (!$editAllowed || SSFQuery::curatorIsActive($personId, $workRow['callForEntries'])) {
        $scoreSelectorIdName = "score-" . $personId;
        $notesTextAreaIdName = "notes-" . $personId;
        $widgets[$notesTextAreaIdName] = $curationData['notes']; 
        if (($curationData['score'] >= 1) && ($curationData['score'] <= 10)) $widgets[$scoreSelectorIdName] = $curationData['score']; 
        else $widgets[$scoreSelectorIdName] = '--'; 
      }
    }

   // Display Entry Details
    /* TODO: Fix emailWasSent so it can be used here.
    $acceptanceDisplay = (HTMLGen::emailWasSent($workRow) 
                       ? HTMLGen::acceptanceDisplay($workId, $workRow['accepted'], $workRow['rejected'], $workRow['acceptFor'])
                       : HTMLGen::acceptanceOperatorDisplay($workId, $workRow['accepted'], $workRow['rejected'], $workRow['acceptFor'])); 
    */
    $alwaysShow = false;
    $acceptanceDisplay = (!$editAllowed) 
                       ? HTMLGen::acceptanceDisplay($workId, $workRow['accepted'], $workRow['rejected'], $workRow['acceptFor'])
                       : HTMLGen::arWidgetDisplay($workId, $workRow['accepted'], $workRow['rejected'], $workRow['acceptFor']);
    echo '            <div id="dispEntryDetails" class="bodyTextOnDarkGrayRowPadded" style="margin:10px 10px 0 10px;border:0px pink dashed;">' . "\r\n";
    displayDetailHeader($workRow, $acceptanceDisplay, $editAllowed);
    echo '              <div id="detailEntry" style="border:0px yellow dashed;">' . "\r\n";
    displaySubmitterInfo($workRow);
    if ($editAllowed) {
      displayMediaFormatInfo($workRow);
      // vimeo publication info (added 4/11/12)
      echo HTMLGen::getSimpleDataWithDescriptionLine('Vimeo Info', HTMLGen::getVimeoInfoString($workRow));
      displayMediaReceivedAndPermissions($workRow);
      displayCredits($rawContributorsArray);
      echo HTMLGen::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workRow));
      displayWebSite($workRow);
      displayAlsoShownAt($workRow, $alwaysShow);
      displaySubmissionNotes($workRow, $alwaysShow);
      echo '              </div> <!-- detailEntry -->' . "\r\n";
      displayCurationForm($workRow, $widgets);
    } else { // since edit is not allowed
      displayCuratorRows($workRow, $widgets);
      displayWorkNotes($workRow, $alwaysShow);
      displayMediaNotes($workRow, $alwaysShow);
      displaySubmissionNotes($workRow, $alwaysShow);
      echo HTMLGen::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workRow));
      displayCredits($rawContributorsArray);
      displayWebSite($workRow);
      displayAlsoShownAt($workRow, $alwaysShow);
      displayMediaFormatInfo($workRow);
      displayMediaReceivedAndPermissions($workRow);
      echo '              </div> <!-- detailEntry -->' . "\r\n";
      echo "<div style='margin-top:12px;'></div>"; // vertical space
    }
    echo "                  </div>\r\n";
?>
