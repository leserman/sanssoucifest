<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<!-- InstanceBeginEditable name="doctitle" -->
<title>SSF - Manage Media</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="800"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <!-- was 745 -->
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
    <td align="center" valign="top">
      <table width="665" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr><!-- InstanceBeginEditable name="Content" -->
          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
          <div>
            <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;
                                                                    float:left;margin:0 4px 6px 4px;background-color:black;'>
            </div>
            <div style="clear:both;"></div>
            <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Manage Media
              <?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?>
            </div>
            <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
              <a href="../admin">Admin Home</a></div>
            <div style="clear:both"></div>
          </div>

<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>

<!-- Javascript Functions -->
<script type="text/javascript">

  function okToCreateNewWork() { 
    callForEntriesSelected = 
      ((document.getElementById("callForEntriesId") != null) && (document.getElementById("callForEntriesId").value != 0));
    personSelected = ((document.getElementById("personSelector") != null) && (document.getElementById("personSelector").value != 0));
    //alert(callForEntriesSelected + ' ' + personSelected);
    //alert(document.getElementById("personSelector") + ' ' + document.getElementById("personSelector").value + ' ' + personSelected);
    //return (callForEntriesSelected && personSelected);
    return (callForEntriesSelected);
  }

  function setHiddenBoolCacheWidget(checkboxId, hiddenCacheId) {
    isChecked = document.getElementById(checkboxId).checked;
    hiddenCacheWidget = document.getElementById(hiddenCacheId);
    if (isChecked) { hiddenCacheWidget.value = '1'; }
    else { hiddenCacheWidget.value ='0'; }
  }

  function postValidationSubmit(hiddenInputSavingId) {
    //alert("postValidationSubmit Id = |" + hiddenInputSavingId + "|"); 
    if (document.getElementById(hiddenInputSavingId) != null) {
      document.getElementById(hiddenInputSavingId).value = hiddenInputSavingId;
      //alert('about to submit ' + hiddenInputSavingId);
      document.getElementById('adeSelectorsForm').submit();  
    }
    else { alert("postValidationSubmit FAILED for |" + hiddenInputSavingId + "|. Please write this down and tell David."); }
  }

</script>

<?php

// ---- PHP functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  function addDesIdWidgetRow($desc, $idName, $initValue, $maxLength, $disable=false) {
    echo "<!-- TextWidgetRowDisabled IN AdminDataEntry : " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    $genId = HTMLGen::addTextWidgetRowHelper1($desc, $idName, $initValue, 8, "w", true);
    // Add the auto-gen button
    $result = SSFDB::getDB()->getArrayFromQuery('select max(designatedId) as maxId from works');
    $maxIdText = $result[0]['maxId'];
    $allowControlName = "toggle_" . $idName . "_ability";
    $genControlName = "generate_" . $idName;
    $onClickAllow = 'javascript:enable("' . $genId . '");disable("' . $allowControlName . '");';
    $onClickGenId = $onClickAllow . 'document.getElementById("' . $genId . '").value=nextDesId("' . $maxIdText . '");';
    echo "            <div style='float:left;padding-left:10px;padding-top:0px;'>\r\n";
    echo "              <input type='button' id='" . $genControlName . "' name='" . $genControlName . "' value='Gen Id' onClick='" 
                          . $onClickGenId . "' " . (($initValue == "") ? "" : "disabled") . ">\r\n";
    echo "            </div>\r\n";
    if ($disable) {
      // TODO: Change this from disable/enable to readonly/readwrite.
      echo "            <div style='float:left;padding-left:10px;padding-top:0px;'>\r\n";
      echo "              <input type='button' id='" . $allowControlName . "' name='" . $allowControlName . "' value='Allow Edit' onClick='" . $onClickAllow . "'>\r\n";
      echo "            </div>\r\n";
    }
    HTMLGen::addTextWidgetRowHelper2();
    if (HTMLGen::showFunctionMarkers()) echo "<!-- END TextWidgetRowDisabled IN AdminDataEntry -->\r\n";
  }


// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  $debugAdminSelection = 0;
  $displayDataStructures = 0;
  $debugChangeCount = -1;
  $debugInit = -1;

  $adeDEBUGGER = new SSFDebug();
  $adeDEBUGGER->enableBelch(false);
  $adeDEBUGGER->enableBecho(false);
  
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && $_POST['callForEntriesId'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']);
  else if (isset($_POST['priorCallForEntriesSelection']) && $_POST['priorCallForEntriesSelection'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['priorCallForEntriesSelection']);

  $editorState = array();
  
  // Initialize $editorState from POST and other sources. Note that priorXXX is used because the current values
  // of such widgets is undefined until they are created below.
  foreach ($_POST as $postKey => $postValue) {
//    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
    $editorState[$postKey] = (isset($postValue)) ? $postValue : '';
  }
  $adeDEBUGGER->belch('050. _POST', $_POST, $debugInit);
  $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
//  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) { // was === before 2/16/10
//    $editorState['adminSelector'] = (isset($editorState['priorAdminSelector'])) ? $editorState['priorAdminSelector'] : 0;
//  }
//  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) 
//    $editorState['adminSelector'] = SSFRunTimeValues::getDefaultAdministratorId();

  // $editorState['adminSelector'] - There is no longer any need to initialize this because it's value is handled 
  // behind the scenes by HTMLGen::displayAdministratorSelector (and therein by SSFAdmin::userIndex()).
  // We no longer use $editorState['adminSelector'], but in it's place, we call SSFQuery::useAdministratorAsCreatorModifier(). 6/11/11
  SSFQuery::useAdministratorAsCreatorModifier();

  if (!isset($editorState['orientationSelector']) || $editorState['orientationSelector'] == '') {  // was === before 2/16/10
    $editorState['orientationSelector']
      = ((isset($editorState['priorOrientationSelector']) && $editorState['priorOrientationSelector'] != '' ) // was !== before 2/16/10
      ? $editorState['priorOrientationSelector']
      : 'works'); // default value
  }

//  if (!isset($editorState['personSelector']) || $editorState['personSelector'] == 0) {  // was === before 2/16/10
  if (!isset($editorState['personSelector'])) {  // dropped condition ($editorState['personSelector'] == 0) 4/2/10 because with it one could not select All Submitters
    $editorState['personSelector'] = ((isset($editorState['priorPersonSelection'])) ? $editorState['priorPersonSelection'] : 0);
  }
  if (!isset($editorState['workSelector']) || $editorState['workSelector'] == 0) { // was === before 2/16/10
    $editorState['workSelector'] = ((isset($editorState['priorWorkSelection'])) ? $editorState['priorWorkSelection'] : 0); 
  }
  
  // set state variables
  // for saving changes
  $editorState['creatingNewPerson'] = (isset($editorState['createNewPerson']) && $editorState['createNewPerson'] == 'Create New Person');
  $editorState['creatingNewWork'] = (isset($editorState['createNewWork']) && $editorState['createNewWork'] == 'Create New Work');
  $editorState['editingPerson'] = (isset($editorState['editPerson']) && $editorState['editPerson'] == 'Edit');
  $editorState['editingWork'] = (isset($editorState['editWork']) && $editorState['editWork'] == 'Edit');
  // for detecting that the user changed a selection; these are unused
//  $personJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'personSelector');
//  $workJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'workSelector');
//  $orientationJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'orientationSelector');
//  $adminJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'adminSelector');

  $adeDEBUGGER->belch('055. editorState', $editorState, $debugInit);

// ---- Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ----
  
  // Save an updated work if appropriate
  if (/*$editorState['editingWork'] &&*/ isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
    $workId = (isset($editorState['editingWorkId'])) ? $editorState['editingWorkId'] : 0;
    if ($workId != 0) {
      $adeDEBUGGER->becho('40', 'Save an updated work');
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
//      $editorState['works_titleForSort'] = HTMLGen::getTitleForSort($editorState['works_title']);
      //SSFDB::DebugNextQuery(); 
      $changeCount = SSFQuery::updateDBFor('works', $currentWorkValueArray, $editorState, 'workId', $workId);
//      $changeCount += SSFQuery::updateDBForWorkContributors($editorState, $workId);
      $adeDEBUGGER->becho('work changeCount', $changeCount, $debugChangeCount);
    }
  }

  $adeDEBUGGER->belch('100 $editorState', $editorState, $displayDataStructures);
?>

<!-- BEGIN FORM ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- -->

    <form name='adeSelectorsForm' id='adeSelectorsForm' action='manageMedia.php' method='post'>
    
<?php HTMLGen::displayAdministratorSelector("padding-left:4px;padding-top:4px;", "rowTitleTextNarrow", 
                                            "document.adeSelectorsForm.submit();", "adminManageMedia"); ?>
            
      <div id='ADEContainer' style='float:left;margin-top:12px;padding-left:4px;padding-right:4px;width:98%;'>

<!-- Begin Filters -------------------------------------------------------- -->
        <div id = "ADESelectionDiv">
          <!-- By Person or By Works Selector -->
           <input type="hidden" id="orientationSelector" name="orientationSelector" value="works">
         
          <!-- Call for Entries Selector - Display only if $editorState['orientationSelector'] == 'works' -->
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Call for:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div style='float:left;'>\r\n";
                      HTMLGen::displayCallForEntriesSelector('adeSelectorsForm',
                         'getUniqueElement("personSelector").value=0;'
                       . 'getUniqueElement("workSelector").value=0;'); 
echo "              </div>\r\n";
echo "            </div>\r\n";
echo "          <div style='clear:both;'></div>\r\n";
echo "          </div>\r\n";
}
?>

<input type="hidden" id="personSelector" name="personSelector" value="<?php echo isset($editorState['personSelector']) ? $editorState['personSelector'] : 0?>">

          <!-- Work Selector -->
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Work:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div style='float:left;'>\r\n";
                      $editorState['workSelector'] = HTMLGen::displayWorkSelector('adeSelectorsForm', $editorState['personSelector'], $editorState, '-- select a work --'); 
                      //if ($unique) echo "<script type='text/javascript'>document.adeSelectorsForm.submit();></script>";
echo "              </div>\r\n";
echo "              <div style='clear:both;'></div>\r\n";
echo "            </div>\r\n";
echo "          <div style='clear:both;'></div>\r\n";
echo "          </div>\r\n";
}
?>
        </div> <!-- id = "ADESelectionDiv" -->
        <div style="clear:both;"></div>
<!-- End Filters ------------------------------------------------------------- -->


<!-- State Initialization ------------------------------------------------------------- -->
<?php 
          $databaseState = $dbContributorsState = array();
          $personDefined = (isset($personToBe)); 
          $personIsSpecified = (isset($personToBe) && ($personToBe != 0) && ($personToBe != ''));
          $workIsSpecified = (isset($editorState['workSelector']) && $editorState['workSelector'] != '' && ($editorState['workSelector'] != 0));
//            && xxx.options[0] != '-- no works --' && xxx.options[0] != '-- no works --' && xxx != '-- select a work --');
          if ($workIsSpecified && $personDefined && !$editorState['creatingNewWork'] && ($editorState['orientationSelector'] == 'works')) {
            $adeDEBUGGER->becho('AA', '$workIsSpecified && $personDefined && ($editorState[orientationSelector] == works)', 0);
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
            if (SSFQuery::success()) { $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']); }
          } else if ($workIsSpecified && !$personIsSpecified && ($editorState['orientationSelector'] == 'works')) {
            $adeDEBUGGER->becho('BB', '$workIsSpecified && !$personIsSpecified && ($editorState[orientationSelector] == works', 0);
            //SSFDB::debugNextQuery();
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
            if (SSFQuery::success()) {
//              echo "<script type='text/javascript'>document.getElementById('personSelector').value = "
//                   . $databaseState['submitter'] . ";document.adeSelectorsForm.submit();</script>";
              $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
            }
          } else if ($personIsSpecified) {
            $adeDEBUGGER->becho('CC', '$personIsSpecified', 0);
            //SSFDB::DebugNextQuery();
            $databaseState = SSFQuery::selectPersonFor($personToBe);  
          }
?>
<!-- End State Initialization ------------------------------------------------------------- -->

<?php
  function displayWorkDetail1($workArray, $contributorsArray, $forAdmin=true) {
    $alwaysDisplay = (($forAdmin) ? false : true);
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // title, year, runtime, accepted/rejected, titleForSort
      $acceptRejectString = '';
      if ($workArray['callForEntries'] <= SSFRunTimeValues::getInitialCallForEntriesId());
        $acceptRejectString = " <span class='datumValue' style='font-size:14px;'>" . HTMLGen::acceptanceDisplay($workId, $workArray['accepted'], $workArray['rejected'], $workArray['acceptFor']) . "</span>"; 
//      $titleForSortString = ((isset($workArray['titleForSort']) && ($workArray['titleForSort'] != '')) ? '[' . $workArray['titleForSort'] . ']' : '[no title for sort]');
      $titleForSortString = ''; // $titleForSortString display not needed because it's incorporated into the computedFileName on the next display line.
      $countryOfProductionDisplay = ((!is_null($workArray['countryOfProduction']) && ($workArray['countryOfProduction'] !== '')))
                                  ? (', ' . $workArray['countryOfProduction']) : '';
      echo "<div>\r\n" 
           . '<div class="datumValue floatLeft">' . $workArray['title'] . ' (' . $workArray['yearProduced'] . $countryOfProductionDisplay
           . ') ' . $acceptRejectString . '<span class="datumDescription" style="margin-left:2em;">run time: </span>' 
           . $workArray['runTime']
           . (($workArray['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'>  LIVE</span>" : "")
           . (($workArray['invited'] == 1) ? "<span class='liveDisplayText'>  INVITED</span>" : "") . '</div>' . "\r\n"
           . '<div class="datumValue floatRight" style="padding-right:4px;">' . $titleForSortString . '</div>' . "\r\n"
           . '<div style="clear:both;"></div>' . "\r\n</div>\r\n";
      // media received // TODO Add mediaReceived?
      // media received & computed filename
      $computedFileName = HTMLGen::computedFileNameForWork($workArray['designatedId'], $workArray['titleForSort'], $workArray['name']);
      echo "<div>\r\n" .
           "<div class='datumValue floatLeft' style='padding-right:4px;'>\r\n[" . $computedFileName . "]</div>" 
                       . "\r\n<div style='clear:both;'></div>\r\n</div>\r\n";
      // submission & original formats
      echo HTMLGen::getMediaFormatsDisplayLine($workArray['submissionFormat'], $workArray['originalFormat']);
    }
  }  

  function displayWorkDetail2($workArray, $contributorsArray, $forAdmin=true) {
    $alwaysDisplay = (($forAdmin) ? false : true);
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // other notes
      $submissionNotes = isset($workArray['submissionNotes']) ? $workArray['submissionNotes'] : '';
      echo HTMLGen::getSimpleDataWithDescriptionLine('Submission Notes', $submissionNotes);
      $workNotes = isset($workArray['workNotes']) ? $workArray['workNotes'] : '';
      echo HTMLGen::getSimpleDataWithDescriptionLine('Work Notes', $workNotes);
      // work contributors
      $displayContributorsOnSeparateLines = true;
      $debugger = new SSFDebug();   $debugger->enableBelch(true);   $debugger->enableBecho(true);
      $debugger->belch('contributorsArray in HTMLGen::displayWorkDetailForAdmin()', $contributorsArray, -1);
      echo HTMLGen::getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);
      // synopsis
      $synopsis = HTMLGen::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workArray));
      echo $synopsis;
      // web site
      if ($alwaysDisplay || $workArray['webSite'] != '') echo HTMLGen::getWebSiteDisplayLine($workArray['webSite'], $workArray['webSitePertainsTo']);
      // previously shown at
      if ($alwaysDisplay || $workArray['previouslyShownAt'] != '') 
        echo HTMLGen::getSimpleDataWithDescriptionLine('Also shown at', $workArray['previouslyShownAt']);
    }
  }

  function displayWorkDetail($workArray, $contributorsArray, $forAdmin=true) {
    $alwaysDisplay = (($forAdmin) ? false : true);
    if (!is_null($workArray)) {
      displayWorkDetail1($workArray, $contributorsArray, $forAdmin);
      $frameParams = HTMLGen::getFrameParametersDisplayElement($workArray);
      if ($frameParams != '') echo '<div><div id="Q" style="margin-left:-10px;">' . $frameParams . '</div><div style="clear:both"></div></div>' . "\r\n";
//      if ($frameParams != '') echo $frameParams;
      else echo '<div class="datumValue floatLeft" style="padding-top:2px;padding-left:10px;"><span class="datumDescription">Aspect Ratio </span></div>' . "\r\n";
      // notes
      $mediaNotes = isset($workArray['mediaNotes']) ? $workArray['mediaNotes'] : '';
      echo HTMLGen::getSimpleDataWithDescriptionLine('Media Notes', $mediaNotes);
      $projectionistNotes = isset($workArray['projectionistNotes']) ? $workArray['projectionistNotes'] : '';
      echo HTMLGen::getSimpleDataWithDescriptionLine('Projectionist Notes', $projectionistNotes);
      displayWorkDetail2($workArray, $contributorsArray, $forAdmin);
    }
  }
?>

<!-- Begin Data Display ------------------------------------------------------------- -->
        <div id="ADEDataDiv" style="float:left;width:100%;">
        
<!-- display Work Information -->
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='entryFormSectionHeading'>\r\n";
echo "            <div style='float:left;padding-top:4px;'>Work: \r\n";
              if ($workIsSpecified) {
                echo $databaseState['title'] . " (";
                echo ((isset($databaseState['designatedId']) && ($databaseState['designatedId'] != '') && ($databaseState['designatedId'] != '')) 
                       ? $databaseState['designatedId'] : '-----');
                echo ") <span class='idDisplayText'>" . $databaseState['workId'] . "</span>";
              }
echo "            </div>\r\n";
echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
              if ($workIsSpecified) echo '<input type="submit" id="editWork" name="editWork" value="Edit">';
echo "            </div>\r\n";
echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
echo "          </div>\r\n";
echo "          <div id='ADEEntriesDiv' style='text-align:left;'>\r\n";
//              echo "<br>\r\n workIsSpecified=" . $workIsSpecified . "  workId=" . $databaseState['workId'] . "<br>\r\n";
//              echo "<br>\r\n dataArray="; print_r($databaseState) . "<br>\r\n";
              if ($workIsSpecified) displayWorkDetail($databaseState, $dbContributorsState);
echo "          </div> <!-- id=ADEEntriesDiv -->\r\n";
}
?>
        </div> <!-- id = "ADEDataDiv" -->
<!-- End Data Display ------------------------------------------------------------- -->


<!-- Begin Work Edit ------------------------------------------------------------- --> 
<?php
//  HTMLGen::displayEditDivHeader('ADEWorkEditDiv', 'Editing Work', 'saveWork', 'validAdminWorkEntry', 'savingWork', 'cancelWorkChanges');
  HTMLGen::displayEditDivHeader('ADEWorkEditDiv', 'Editing Work', 'saveWork', 'unconditionallyValidate', 'savingWork', 'cancelWorkChanges');
  $adeDEBUGGER->becho('$databaseState', $databaseState, 0);
  echo "            <div class='bodyTextOnBlack' style='float:none;padding-bottom:8px;text-align:left;color:#FFFF66'>\r\n";
  echo "              " . ((isset($databaseState['title']) && $databaseState['title'] != null) ? $databaseState['title'] : "") . " <span class='idDisplayText'>(" 
                        . ((isset($databaseState['workId']) && $databaseState['workId'] != null) ? $databaseState['workId'] : "") . ")</span> submitted by " 
                        . ((isset($databaseState['name']) && $databaseState['name'] != null) ? $databaseState['name'] : "") . " <span class='idDisplayText'>(" 
                        . ((isset($databaseState['personId']) && $databaseState['personId'] != null) ? $databaseState['personId'] : "") . ") </span><span style='font-size:11px;'>[call "
                        . ((isset($databaseState['callForEntries']) && $databaseState['callForEntries'] != null) ? 
                                         SSFRunTimeValues::getCallNameFor($databaseState['callForEntries'])  : "") . " <span class='idDisplayText'>(" 
                        . ((isset($databaseState['callForEntries']) && $databaseState['callForEntries'] != null) ? $databaseState['callForEntries'] : "") . ")</span>]</span>\r\n";
  echo "            </div>\r\n";
  $disable = false;
  if (isset($databaseState['workId']) && $databaseState['workId'] != null) {
    displayWorkDetail1($databaseState, $dbContributorsState);
    HTMLGen::addAspectRatioAnamorphicRow($databaseState['aspectRatio'], $databaseState['anamorphic'], $disable);
    HTMLGen::addPixelDimensionsWidgetsRow($databaseState['frameWidthInPixels'], $databaseState['frameHeightInPixels'], $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'mediaNotes'), 'Media Notes', $databaseState['mediaNotes'], 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'projectionistNotes'), 'Projectionist Notes', $databaseState['projectionistNotes'], 2048, 2, $disable);
    displayWorkDetail2($databaseState, $dbContributorsState);
  }
  echo "          </div><!-- end ADEWorkEditDiv -->\r\n";
?>
<!-- End Work Edit ------------------------------------------------------------- -->


<!-- Hidden Inputs Cache Section -->        
<!--      <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<? echo $editorState['adminSelector']?>"> -->
      <input type="hidden" id="priorOrientationSelector" name="priorOrientationSelector" value="<?php echo $editorState['orientationSelector']?>">
      <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<?php echo $editorState['callForEntriesId']?>">
      <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $editorState['personSelector']?>">
      <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>">
      <input type="hidden" id="editingPerson" name="editingPersonId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
      <input type="hidden" id="editingWork" name="editingWorkId" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0);?>">
      <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0);?>">
      <!-- <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0);?>"> -->
      <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
      <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
      <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
      <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> <!-- support for HTMLGen passing the name of the selector that initiated a Submit onchange. -->
      <input type="hidden" id="loginUserId" name="loginUserId" value=0>

<script type="text/javascript">

  // Note: Using document.getElementById (rather than HTMLGen::genId()) for these widgets is OK because they are all unique.
  
  function disableSelectors() {
    disable("orientationSelector");
    disable("personSelector");
    disable("adminSelector");
    if (document.getElementById("workSelector") != null) { disable("workSelector"); }
    if (document.getElementById("applyFilter") != null) { disable("applyFilter"); }
    if (document.getElementById("createNewPerson") != null) { disable("createNewPerson"); }
    if (document.getElementById("createNewWork") != null) { disable("createNewWork"); }
    if (document.getElementById("callForEntriesId") != null) { disable("callForEntriesId"); }
  }

  function enableSelectors() {
    enable("orientationSelector");
    enable("personSelector");
    enable("adminSelector");
    if (document.getElementById("workSelector") != null) { enable("workSelector"); }
    if (document.getElementById("applyFilter") != null) { enable("applyFilter"); }
    if (document.getElementById("createNewPerson") != null) { enable("createNewPerson"); }
    //enable("createNewPerson");
    if (document.getElementById("createNewWork") != null && okToCreateNewWork()) { enable("createNewWork"); }
    if (document.getElementById("orientationSelector")  != null
      && document.getElementById('orientationSelector') == 'works'
      && document.getElementById("callForEntriesId") != null) { enable("callForEntriesId"); }
  }

</script>

<?php
// <!-- Div Control -------------------------------------------- >
        echo '<script type="text/javascript">show("ADEDataDiv");</script>';
        echo '<script type="text/javascript">enableSelectors();</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADEPersonEditDiv") !== null) { hide("ADEPersonEditDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADECreatePersonDiv") !== null) { hide("ADECreatePersonDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADEWorkEditDiv") !== null) { hide("ADEWorkEditDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADECreateWorkDiv") !== null) { hide("ADECreateWorkDiv"); }</script>';
        if ($editorState['editingWork'] || $editorState['editingPerson'] || $editorState['creatingNewPerson'] || $editorState['creatingNewWork']) {
          echo '<script type="text/javascript">hide("ADEDataDiv");</script>';
          echo '<script type="text/javascript">disableSelectors();</script>';
        }
        //echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
        // Note: using document.getElementById for these widgets is OK because they are all unique.
        if ($editorState['editingPerson']) echo '<script type="text/javascript">'
                               . 'if (document.getElementById("ADECreatePersonDiv") !== null) { document.getElementById("ADECreatePersonDiv").innerHTML = ""; }'
                               . 'show("ADEPersonEditDiv");'
                               . '</script>';
        if ($editorState['creatingNewPerson']) echo '<script type="text/javascript">'
                                   . 'if (document.getElementById("ADEPersonEditDiv") !== null) { document.getElementById("ADEPersonEditDiv").innerHTML = ""; }'
                                   . 'show("ADECreatePersonDiv");'
                                   . 'if (getUniqueElement("people_name") != null) { getUniqueElement("people_name").focus(); }'
                                   . ' </script>';
        if ($editorState['editingWork']) echo '<script type="text/javascript">'
                                   . 'if (document.getElementById("ADECreateWorkDiv") !== null) { document.getElementById("ADECreateWorkDiv").innerHTML = ""; }'
                                   . 'show("ADEWorkEditDiv");'
                                   . '</script>';
        if ($editorState['creatingNewWork']) echo '<script type="text/javascript">'
                                   . 'if (document.getElementById("ADEWorkEditDiv") !== null) { document.getElementById("ADEWorkEditDiv").innerHTML = ""; }'
                                   . 'show("ADECreateWorkDiv");'
                                   . '</script>';
?>

<!-- More hidden inputs -->
<!--
      <input type="hidden" id="savePersonChangesFirst" name="SavePersonChangesFirst" value='no'> 
      <input type="hidden" id="saveEntryChangesFirst" name="SaveEntryChangesFirst" value='no'> 
      <input type="hidden" id="personNickName" name="PersonNickName" value="<?php //echo $_SESSION['PersonNickName']; ?>">
      <input type="hidden" id="personLastName" name="PersonLastName" value="<?php //echo $_SESSION['PersonLastName']; ?>"> 

      <input type="hidden" id="personPassword" name="PersonPassword" value="<?php //echo $_SESSION['PersonPassword']; ?>" >
      <input type="hidden" id="personEmail" name="PersonEmail" value="<?php //echo $_SESSION['PersonEmail']; ?>" >
-->
<!--  TODO Fix this for submitter data entry:
      <input type="hidden" id="emailAddressUID" name="EmailAddressUID" value="document.WorkDataEntryForm.PersonEmail.value"> 
-->
<!-- 
      <input type="hidden" id="personId" name="PersonId" value="<?php //echo $_SESSION['personId']; ?>"> 
      <input type="hidden" id="entryId" name="EntryId" value="<?php //echo $_SESSION['entryId']; ?>"> 
-->

<!--  TODO: use workLastModified and personlastModified to verify that data has not changed since read 
      <input type="hidden" id="workLastModified" name="WorkLastModified" value="<?php //echo $_SESSION['WorkLastModified']; ?>"> 
      <input type="hidden" id="personlastModified" name="PersonLastModified" value="<?php //echo $_SESSION['PersonLastModified']; ?>"> 
-->

      <!-- <input type="hidden" id="callForEntriesId" name="CallForEntriesId" value="<?php //echo $_SESSION['CallForEntriesId']; ?>"> -->

      </div>  <!-- id="ADEContainer" -->
    </form>
<!-- END FORM --------------------------------------------------------------------------------------------------------- -->

          </td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
        <!-- InstanceEndEditable --></tr>
      </table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
<tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
    <?php SSFWebPageAssets::displayCopyrightLine();?></td>
		<td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>
