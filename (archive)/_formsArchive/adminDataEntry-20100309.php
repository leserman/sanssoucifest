<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<!-- InstanceBeginEditable name="doctitle" -->
<title>SSF - Administrative Data Entry</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js " type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
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
    <td width="125" align="center" valign="top"><?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar();
            ?></td>
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
            <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Administrative Data
              <?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?>
            </div>
            <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
              <a href="../admin">Admin Home</a> </div>
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

// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  $adeDEBUGGER = new SSFDebug();
  $adeDEBUGGER->enableBelch(false);
  $adeDEBUGGER->enableBecho(false);
  
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && $_POST['callForEntriesId'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']);
  else if (isset($_POST['priorCallForEntriesSelection']) && $_POST['priorCallForEntriesSelection'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['priorCallForEntriesSelection']);

  $editorState = array();
  
  $debugAdminSelection = 0;
  $displayDataStructures = 0;

  // Initialize $editorState from POST and other sources. Note that priorXXX is used because the current values
  // of such widgets is undefined until they are created below.
  foreach ($_POST as $postKey => $postValue) {
    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
  }
  $adeDEBUGGER->belch('RAW editorState 000.', $editorState, 0);
  $adeDEBUGGER->belch('adminSelector02.', $editorState, $debugAdminSelection);
  $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) { // was === before 2/16/10
    $editorState['adminSelector'] = (isset($editorState['priorAdminSelector'])) ? $editorState['priorAdminSelector'] : 0;
  }
  $adeDEBUGGER->belch('adminSelector03.', $editorState, $debugAdminSelection);
  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) 
    $editorState['adminSelector'] = SSFRunTimeValues::getDefaultAdministratorId();
  $adeDEBUGGER->belch('adminSelector04.', $editorState, $debugAdminSelection);
  if (!isset($editorState['orientationSelector']) || $editorState['orientationSelector'] == '') {  // was === before 2/16/10
    $editorState['orientationSelector']
      = ((isset($editorState['priorOrientationSelector']) && $editorState['priorOrientationSelector'] != '' ) // was !== before 2/16/10
      ? $editorState['priorOrientationSelector']
      : 'works'); // default value
  }
  if (!isset($editorState['personSelector']) || $editorState['personSelector'] == 0) {  // was === before 2/16/10
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
  $personJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'personSelector');
  $workJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'workSelector');
  $orientationJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'orientationSelector');
  $adminJustSelected = (isset($editorState['selectorSubmitter']) && $editorState['selectorSubmitter'] == 'adminSelector');

  $adeDEBUGGER->belch('05.', $editorState, 0);

// ---- Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ----
  
  // Insert a newly created person if appropriate
  if (isset($editorState['savingNewPerson']) && $editorState['savingNewPerson'] == 'savingNewPerson') {
    $adeDEBUGGER->becho('10.', 'Insert a newly created person');
    if (SSFQuery::personAlreadyInDatabase($editorState["people_email"])) {
      echo '<script type="text/javascript">alert("The email address, ' . $editorState["people_email"] 
          . ', duplicates one already in the database. Therefore, this person you just created will not be saved.");</script>';
    } else {
      $result = SSFQuery::insertData('people', $editorState);
      if ($result !== false) {
        $editorState['orientationSelector'] = 'people';
        $editorState['personSelector'] = $result;
        $editorState['people_personId'] = $result;
      }
    }
    $editorState['createNewPerson'] = '';
//    echo "<script type='text/javascript'>document.getElementById('savingNewPerson').value='';</script>";
  }

  // Save an updated person if appropriate
  if (isset($editorState['savingPerson']) && $editorState['savingPerson'] == 'savingPerson') {
    $personId = (isset($editorState['editingPersonId'])) ? $editorState['editingPersonId'] : 0;
    if ($personId != 0) {
      $adeDEBUGGER->becho('20', 'Save an updated person', 0);
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      $adeDEBUGGER->belch('22', $currentValueArray);
      $adeDEBUGGER->belch('23', $editorState);
      //SSFDB::DebugNextQuery(); 
      SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $personId);
    }
  }

  // Insert a newly created work if appropriate
  if ($editorState['creatingNewWork'] && isset($editorState['savingNewWork']) && $editorState['savingNewWork'] == 'savingNewWork') {
    $adeDEBUGGER->becho('30', 'Insert a newly created work');
    $result = SSFQuery::insertData('works', $editorState);
    if ($result !== false) {
      $editorState['workSelector'] = $result;
    }
  }

  // Save an updated work if appropriate
  if ($editorState['editingWork'] && isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
    $workId = (isset($editorState['editingWorkId'])) ? $editorState['editingWorkId'] : 0;
    if ($workId != 0) {
      $adeDEBUGGER->becho('40', 'Save an updated work');
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
      //SSFDB::DebugNextQuery(); 
      SSFQuery::updateDBFor('works', $currentWorkValueArray, $editorState, 'workId', $workId);
      SSFQuery::updateDBForWorkContributors($editorState, $workId);
    }
  }

  $adeDEBUGGER->belch('100 $editorState', $editorState, $displayDataStructures);
  $adeDEBUGGER->belch('101 $_POST', $_POST, 0);
?>

<!-- BEGIN FORM ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- -->

    <form name='adeSelectorsForm' id='adeSelectorsForm' action='adminDataEntry.php' method='post'>
    
<!-- Administrator Selector -->
          <div class='formRowContainer' style="padding-left:4px;padding-top:4px;">
            <div class='rowTitleTextNarrow'>Administrator:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?php //SSFDB::debugNextQuery(); 
                $personRows = SSFQuery::getAdministrators();
                echo '<select id="adminSelector" name="adminSelector" style="width:220px" onchange="document.adeSelectorsForm.submit();">';
                foreach ($personRows as $personRow) 
                  $selectionOptions[$personRow['personId']] = 
                    ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " 
                                                                                       : "") 
                                                                                       . $personRow['name'];
                HTMLGen::displaySelectionOptions($selectionOptions, $editorState['adminSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="float:left;"></div>
          </div>
<!-- End Administrator Selector -->
            
      <div id='ADEContainer' style='float:left;margin-top:12px;padding-left:4px;padding-right:4px;width:98%;'>

<!-- Begin Filters -------------------------------------------------------- -->
        <div id = "ADESelectionDiv">
          <!-- By Person or By Works Selector -->
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'>Orientation:</div>
            <div class="entryFormFieldContainer">
              <div class="floatLeft" style="padding-right:300px;">
                <?php HTMLGen::displayOrientationSelector('adeSelectorsForm', $editorState['orientationSelector']); 
                ?>
              </div>
              <div class="floatLeft">
                <input type='submit' id='applyFilter' name='applyFilter' value='Apply'>
              </div>
              <div style="clear:both;"></div>
            </div>
          </div>
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

          <!-- Person Selector -->
          <?php $personOrSubmitterText = (($editorState['orientationSelector'] == 'works') ? 'Submitter:' : 'Person:'); ?>
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'><?php echo $personOrSubmitterText ?></div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php //SSFDB::debugNextQuery(); 
                      $personToBe = HTMLGen::displayPersonSelector('adeSelectorsForm', $editorState);
                      $editorState['personSelector'] = $personToBe;
                ?>
              </div>
              <div style="float:right;padding-left:20px;">
                <input type="submit" id="createNewPerson" name="createNewPerson" value="Create New Person">
              </div>
            </div>
          </div>
          <div style="clear:both;"></div>
          
          <!-- Work Selector -->
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Work:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div style='float:left;'>\r\n";
                      $editorState['workSelector'] = HTMLGen::displayWorkSelector('adeSelectorsForm', $editorState, '-- select a work --'); 
                      //if ($unique) echo "<script type='text/javascript'>document.adeSelectorsForm.submit();></script>";
echo "              </div>\r\n";
echo "              <div style='float:right;padding-left:20px;'>\r\n";
echo "                <input type='submit' id='createNewWork' name='createNewWork' disabled value='Create New Work'>\r\n";
echo "              </div>\r\n";
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
          if ($workIsSpecified && $personDefined && ($editorState['orientationSelector'] == 'works')) {
            $adeDEBUGGER->becho('AA', '$workIsSpecified && $personDefined && ($editorState[orientationSelector] == works)', 0);
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
            $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
          } else if ($workIsSpecified && !$personIsSpecified && ($editorState['orientationSelector'] == 'works')) {
            $adeDEBUGGER->becho('BB', '$workIsSpecified && !$personIsSpecified && ($editorState[orientationSelector] == works', 0);
            //SSFDB::debugNextQuery();
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
            if (SSFQuery::success()) {
              echo "<script type='text/javascript'>document.getElementById('personSelector').value = "
                   . $databaseState['submitter'] . ";document.adeSelectorsForm.submit();</script>";
              $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
            }
          } else if ($personIsSpecified) {
            $adeDEBUGGER->becho('CC', '$personIsSpecified', 0);
            //SSFDB::DebugNextQuery();
            $databaseState = SSFQuery::selectPersonFor($personToBe);  
          }
          $adeDEBUGGER->becho('DD', '$personToBe=' . $personToBe . '  $editorState[personSelector]=' . $editorState['personSelector'], 0);
          $adeDEBUGGER->belch('102. $editorState', $editorState, 0);
          $adeDEBUGGER->belch('102. $databaseState', $databaseState, 0);
?>
<!-- End State Initialization ------------------------------------------------------------- -->

<!-- Begin Data Display ------------------------------------------------------------- -->
        <div id="ADEDataDiv" style="float:left;width:100%;">
        
<!-- display Person Information -->
          <div class="entryFormSectionHeading" style="padding-top:24px;">
            <div style="float:left;padding-top:4px;"><?php echo $personOrSubmitterText ?> 
                <?php if ($personIsSpecified) echo $databaseState['name'] . " <span class='idDisplayText'>" 
                                                                      . $databaseState['personId'] . "</span>"; ?>
            </div>
            <div style="float:right;padding-right:4px;padding-bottom:0;">
<?php if ($personIsSpecified) {      
  echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit" '
                             . ((!HTMLGen::personIsInOptionList($personToBe)) ? 'disabled' : '') . '>' . "\r\n";
  echo '                <input type="button" value="Show / Hide" onclick="showHide(\'ADEPersonDiv\')">';
}                
?>                       
            </div>
            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id = "ADEPersonDiv" style="text-align:left;">
            <?php if ($personIsSpecified) { $forAdmin = true; HTMLGen::displayPersonDetail($databaseState, $forAdmin); } ?>
          </div> <!-- id = "ADEPersonDiv" -->

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
              if ($workIsSpecified) HTMLGen::displayWorkDetailForAdmin($databaseState, $dbContributorsState);
echo "          </div> <!-- id=ADEEntriesDiv -->\r\n";
}
?>
        </div> <!-- id = "ADEDataDiv" -->
<!-- End Data Display ------------------------------------------------------------- -->


<!-- Begin Create New Person ------------------------------------------------------------- -->
<?php
  HTMLGen::displayEditDivHeader('ADECreatePersonDiv', 'Creating New Person', 'saveNewPerson', 
                                'validAdminPersonCreation', 'savingNewPerson', 'cancelPersonChanges');
  $disable = false;
  HTMLGen::addTextWidgetRow('Name', 'people_name', '', 128, $disable);
  HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', '', 64, $disable);
  HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', '', 64, $disable);
  HTMLGen::addTextWidgetRow('Organization', 'people_organization', '', 128, $disable);
  HTMLGen::addTextWidgetRow('Email Address', 'people_email', '', 128);
  //HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable);
  //HTMLGen::addTextWidgetRow('Password', 'people_password', '', 32, $disable);
  //HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable);
  HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', 'individual', 4, $disable); 
  HTMLGen::addCheckBoxWidgetRow('Notify of', 'people', 'notifyOf', '', 4, $disable); 
  HTMLGen::addCheckBoxWidgetRow('Relationship', 'people', 'relationship', '', 2, $disable); 
  HTMLGen::addCheckBoxWidgetRow('Role', 'people', 'role', '', 2, $disable); 
  HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', '', 2048, 2, $disable);
  HTMLGen::addTextWidgetRow('Web Sites', 'people_webSites', '', 512, $disable);
  HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', '', 128, $disable);
  HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', '', 64, $disable);
  HTMLGen::addTextWidgetRow('', 'people_streetAddr2', '', 64, $disable);
  HTMLGen::addTextWidgetRow('City', 'people_city', '', 32, $disable);
  $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = '';
  HTMLGen::addStateZipCountryRow($szcArray, $disable);
  $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = '';
  HTMLGen::addTextWidgetTelephonesRow($phoneArray, $disable);
  echo "          </div> <!-- id = 'ADECreatePersonDiv' -->\r\n";
?>
<!-- End Create New Person ------------------------------------------------------------- -->

     
<!-- Begin Person Edit ------------------------------------------------------------- -->
<?php
  $title = "Editing Person: ";
  if (isset($databaseState['name']) && isset($databaseState['name'])) $title .= $databaseState['name'] . " <span class='idDisplayText'>" . $databaseState['personId'] . "</span>";
    HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'savePerson', 
                                  'validAdminPersonEntry', 'savingPerson', 'cancelPersonChanges');
  if (isset($databaseState['personId']) && $databaseState['personId'] != null) {
    HTMLGen::addTextWidgetRowDisabled('Name', 'people_name', $databaseState['name'], 128, $disable);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $databaseState['lastName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', $databaseState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $databaseState['organization'], 128, $disable);
    HTMLGen::addTextWidgetRowDisabled('Email Address', 'people_email', $databaseState['email'], 128);
    //HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', $databaseState['email'], 128, $disable);
    //HTMLGen::addTextWidgetRow('Password', 'people_password', $databaseState['password'], 32, $disable);
    //HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', $databaseState['password'], 32, $disable);
    HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', $databaseState['recordType'], 4, $disable); 
    //echo "<div style='clear:both;'></div>\r\n";
    HTMLGen::addCheckBoxWidgetRow('Notify of', 'people', 'notifyOf', $databaseState['notifyOf'], 4, $disable); 
    //echo "<div style='clear:both;'></div>\r\n";
    HTMLGen::addCheckBoxWidgetRow('Relationship', 'people', 'relationship', $databaseState['relationship'], 2, $disable); 
    HTMLGen::addCheckBoxWidgetRow('Role', 'people', 'role', $databaseState['role'], 2, $disable); 
    HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', $databaseState['notes'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web Sites', 'people_webSites', $databaseState['webSites'], 512, $disable);
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $databaseState['howHeardAboutUs'], 128, $disable);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $databaseState['streetAddr1'], 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $databaseState['streetAddr2'], 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', $databaseState['city'], 32, $disable);
    HTMLGen::addStateZipCountryRow($databaseState, $disable);
    HTMLGen::addTextWidgetTelephonesRow($databaseState, $disable);
  }
  echo "          </div><!-- end ADEPersonEditDiv -->\r\n";
?>
<!-- End Person Edit ------------------------------------------------------------- -->

        
<!-- Begin Create New Work  ------------------------------------------------------------- -->
<?php
  $title = 'Creating New Work <span class="orangishHighlightDisplayColor">for ' 
         . HTMLGen::callForEntriesDescription($editorState['callForEntriesId']) . '</span>';
  HTMLGen::displayEditDivHeader('ADECreateWorkDiv', $title, 'saveNewWork', 
                                'validAdminWorkEntry', 'savingNewWork', 'cancelWorkChanges');
  $disable = false;
  //HTMLGen::addTextWidgetRow('Call For', DatumProperties::getItemKeyFor('works', 'callForEntriesId'), '', 16, true);
?>
  <input type="hidden" id="works_callForEntries" name="works_callForEntries" value="<?php echo $editorState['callForEntriesId']?>">
  <div class="formRowContainer" style="margin-top:0;margin-bottom:0;"> 
    <div class="rowTitleTextWide">Submitter:</div>
    <div class="floatLeft">
        <?php 
          $person = (((isset($personToBe)) && $personToBe !=0) ? $personToBe : (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0));
          echo HTMLGen::getSubmitterSelector('adeSelectorsForm', DatumProperties::getItemKeyFor('works', 'submitter'), $person); 
        ?>
    </div>
    <div style="clear: both;"></div>
  </div>
<?php
  //HTMLGen::addTextWidgetRow('Submitter', DatumProperties::getItemKeyFor('works', 'submitter'), '', 16, $disable);
  HTMLGen::addTextWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), '', 16, $disable);
  HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 256, $disable);
  HTMLGen::addTextWidgetRow('Title for Sort', DatumProperties::getItemKeyFor('works', 'titleForSort'), '', 256, $disable);
  HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 32, $disable);
  HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTime'), '', 16, $disable);
  HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', '', 4, $disable); 
  HTMLGen::addTextWidgetRow('Original Format', DatumProperties::getItemKeyFor('works', 'originalFormat'), '', 64, $disable);
  HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable);
  HTMLGen::addTextWidgetRow('Photo Location', DatumProperties::getItemKeyFor('works', 'photoLocation'), '', 256, $disable);
  HTMLGen::addTextWidgetRow('Date Media Received', DatumProperties::getItemKeyFor('works', 'dateMediaReceived'), '', 16, $disable);
  HTMLGen::addTextWidgetRow('Date Paid', DatumProperties::getItemKeyFor('works', 'datePaid'), '', 16, $disable);
  HTMLGen::addTextWidgetRow('Amount Paid', DatumProperties::getItemKeyFor('works', 'amtPaid'), '', 16, $disable);
  HTMLGen::addRadioButtonWidgetRow('How Paid', 'works', 'howPaid', '', 4, $disable); 
  HTMLGen::addTextWidgetRow('Check or Paypal #', DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber'), '', 32, $disable);
  HTMLGen::addPermissionsWidgetRow($databaseState);
  HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
  HTMLGen::addRadioButtonWidgetRow('Web site pertains to', 'works', 'webSitePertainsTo', '', 4, $disable);
  HTMLGen::addBooleanCheckBoxWidgetRow('Includes live prfrmnce', 'works', 'includesLivePerformance', 0, 1, $disable); 
  HTMLGen::addBooleanCheckBoxWidgetRow('Invited', 'works', 'invited', 0, 1, $disable);
  HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously shown at', '', 2048, 2, $disable);
  HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable);
  HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Original Synopsis', '', 2048, 4, $disable);
  HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'submissionNotes'), 'Submission Notes', '', 2048, 2, $disable);
  HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'workNotes'), 'Work Notes', '', 2048, 2, $disable);
  HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'mediaNotes'), 'Media Notes', '', 2048, 2, $disable);
  echo "          </div> <!-- id = 'ADECreateWorkDiv' -->\r\n";
?>
<!-- End Create New Work ------------------------------------------------------------- -->


<!-- Begin Work Edit ------------------------------------------------------------- --> 
<?php
  HTMLGen::displayEditDivHeader('ADEWorkEditDiv', 'Editing Work', 'saveWork', 'validAdminWorkEntry', 'savingWork', 'cancelWorkChanges');
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
    HTMLGen::addTextWidgetRowDisabled('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), $databaseState['designatedId'], 128);
    //HTMLGen::addTextWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), $databaseState['designatedId'], 16, $disable);
    HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), $databaseState['title'], 256, $disable);
    HTMLGen::addTextWidgetRow('Title for Sort', DatumProperties::getItemKeyFor('works', 'titleForSort'), $databaseState['titleForSort'], 256, $disable);
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 32, $disable);
    HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTime'), $databaseState['runTime'], 16, $disable);
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 4, $disable); 
    HTMLGen::addTextWidgetRow('Original Format', DatumProperties::getItemKeyFor('works', 'originalFormat'), $databaseState['originalFormat'], 64, $disable);
    HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $databaseState['photoCredits'], 256, $disable);
    HTMLGen::addTextWidgetRow('Photo Location', DatumProperties::getItemKeyFor('works', 'photoLocation'), $databaseState['photoLocation'], 256, $disable);
    HTMLGen::addTextWidgetRow('Date Media Received', DatumProperties::getItemKeyFor('works', 'dateMediaReceived'), $databaseState['dateMediaReceived'], 16, $disable);
    HTMLGen::addTextWidgetRow('Date Paid', DatumProperties::getItemKeyFor('works', 'datePaid'), $databaseState['datePaid'], 16, $disable);
    HTMLGen::addTextWidgetRow('Amount Paid', DatumProperties::getItemKeyFor('works', 'amtPaid'), $databaseState['amtPaid'], 16, $disable);
    HTMLGen::addRadioButtonWidgetRow('How Paid', 'works', 'howPaid', $databaseState['howPaid'], 4, $disable); 
    HTMLGen::addTextWidgetRow('Check or Paypal #', DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber'), $databaseState['checkOrPaypalNumber'], 32, $disable);
    HTMLGen::addPermissionsWidgetRow($databaseState); // NOTE TODO: This is the only such function with the $disable arg. Fix?
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $databaseState['webSite'], 1024, $disable);
    HTMLGen::addRadioButtonWidgetRow('Web site pertains to', 'works', 'webSitePertainsTo', $databaseState['webSitePertainsTo'], 4, $disable);
    HTMLGen::addBooleanCheckBoxWidgetRow('Includes live prfrmnce', 'works', 'includesLivePerformance', $databaseState['includesLivePerformance'], 1, $disable); 
    HTMLGen::addBooleanCheckBoxWidgetRow('Invited', 'works', 'invited', $databaseState['invited'], 1, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously shown at', $databaseState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Original Synopsis', $databaseState['synopsisOriginal'], 2048, 4, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit1'), 'Synopsis Edit 1', $databaseState['synopsisEdit1'], 2048, 4, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit2'), 'Synopsis Edit 2', $databaseState['synopsisEdit2'], 2048, 4, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'submissionNotes'), 'Submission Notes', $databaseState['submissionNotes'], 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'workNotes'), 'Work Notes', $databaseState['workNotes'], 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'mediaNotes'), 'Media Notes', $databaseState['mediaNotes'], 2048, 2, $disable);
  }
  echo "          </div><!-- end ADEWorkEditDiv -->\r\n";
?>
<!-- End Work Edit ------------------------------------------------------------- -->


<!-- Hidden Inputs Cache Section -->        
      <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<?php echo $editorState['adminSelector']?>">
      <input type="hidden" id="priorOrientationSelector" name="priorOrientationSelector" value="<?php echo $editorState['orientationSelector']?>">
      <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<?php echo $editorState['callForEntriesId']?>">
      <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $editorState['personSelector']?>">
      <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>">
      <input type="hidden" id="editingPerson" name="editingPersonId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
      <input type="hidden" id="editingWork" name="editingWorkId" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0);?>">
      <!-- <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0);?>"> -->
      <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0);?>">
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
                               . 'document.getElementById("ADECreatePersonDiv").innerHTML = "";'
                               . 'show("ADEPersonEditDiv");'
                               . '</script>';
        if ($editorState['creatingNewPerson']) echo '<script type="text/javascript">'
                                   . 'document.getElementById("ADEPersonEditDiv").innerHTML = "";'
                                   . 'show("ADECreatePersonDiv");'
                                   . ' </script>';
        if ($editorState['editingWork']) echo '<script type="text/javascript">'
//                                   . 'document.getElementById("ADECreateWorkDiv").innerHTML = "";'
                                   . 'show("ADEWorkEditDiv");'
                                   . '</script>';
        if ($editorState['creatingNewWork']) echo '<script type="text/javascript">'
//                                   . 'document.getElementById("ADEWorkEditDiv").innerHTML = "";'
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
