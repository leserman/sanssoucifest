<?php 
  require_once('../bin/classes/SSFVimeo.php');
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<!-- InstanceBeginEditable name="doctitle" -->
<title>SSF - People &amp; Works</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000" onload="doNothingBreakpointOpportunity('adminDataEntry.php called from onload');">
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
            <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Manage People &amp; Works
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
    var callForEntriesSelected = 
      ((document.getElementById("callForEntriesId") != null) && (document.getElementById("callForEntriesId").value != 0));
    var personSelected = ((document.getElementById("personSelector") != null) && (document.getElementById("personSelector").value != 0));
    //alert(callForEntriesSelected + ' ' + personSelected);
    //alert(document.getElementById("personSelector") + ' ' + document.getElementById("personSelector").value + ' ' + personSelected);
    //return (callForEntriesSelected && personSelected);
    return (callForEntriesSelected);
  }

  function setHiddenBoolCacheWidget(checkboxId, hiddenCacheId) {
    var isChecked = document.getElementById(checkboxId).checked;
    var hiddenCacheWidget = document.getElementById(hiddenCacheId);
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
  
  // To be called when the Waive Pmt button is clicked.
  function waivePayment(waiveDate) {
    // 1) Set Date to NOW if '', 2) Set Amt = 0, 3) Set howPaid to Waived.
//    var waivePmtButton = getUniqueElement('waivePaymentCtl');
//    setCheckedValue(getElementById('waived-1') = 'waived'; // HACK to use the private id, waived-1.
// onclick="setCheckedValue(document.forms['radioExampleForm'].elements['number'], '4');"
    document.getElementById('waived-1').checked = true;  // HACK to use the private id, waived-1.
    getUniqueElement('works_datePaid').value = waiveDate;
    getUniqueElement('works_amtPaid').value = 0;
  }

</script>

<?php

// ---- PHP functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  // Based on HTMLGen::addRadioButtonWidgetRow(); // TODO: Get this dead code out of HTMLGen::addRadioButtonWidgetRow().
  // $width = "n" means use markup with class rowTitleTextNarrow, $width = "w" use markup with , $width = "" use markup with rowTitleText, 
  function addPaymentWidget($currentValue, $databaseState, $disable=false) {
    // Initialize what were the parameters to HTMLGen::addRadioButtonWidgetRow().
    $title = 'How Paid';
    $tableName = 'works';
    $colName = 'howPaid';
    $cols  = 4;
    $width="w"; // designating rowTitleTextWide
    echo "<!-- addPaymentWidget: " . $tableName . "." . $colName . ", " . $title . (($disable) ? " disabled" : "") . " -->\r\n";
    $titleMarkupClass = 'rowTitleTextWide';  // HACK for HTMLGen::getTitleMarkupClass($width); 
    echo "      <div class='formRowContainer' style='padding-top:2px;'>\r\n";
    echo "        <div class='" . $titleMarkupClass . "' style='padding-top:3px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn' style='padding-bottom:3px;'>\r\n";
    $dpArray = DatumProperties::getArray();
    $dataItemName = DatumProperties::getItemKeyFor($tableName, $colName);
    $possibleValues = $dpArray[$dataItemName]->possibleValues;
    $itemCount = count($possibleValues);
    $itemsPerCol = (int) ceil($itemCount/$cols);
    $itemsDisplayed = 0;
    $rowIndex = 0;
    // begin a column div
    echo "        <div style='float:left;'>\r\n";
    foreach ($possibleValues as $possVal) {
      $labelStr = ucfirst($possVal);
      $rowIndex++;
      $itemsDisplayed++;
      $isValue = ($currentValue == $possVal);  // $possVal is a substring of the enum
      $genId = HTMLGen::genId($possVal);
      echo "          <div>\r\n";
      echo "            <div style='float:left;'>\r\n";
      echo "              <input type='radio' name='" . $dataItemName . "' id='" . $genId;
      echo "' value='" . $possVal . "' onchange='userMadeAChange(1);'" . (($disable) ? ' disabled' : '');
      if ($isValue) echo " checked='checked'";
      echo ">\r\n";
      echo "            </div>\r\n";
      echo "            <div class='entryFormRadioButtonLabel' style='float:left;padding-right:16px;'>\r\n";
      echo "              <label for='" . $genId . "'>" . $labelStr . "</label>\r\n";
      echo "            </div>\r\n";
      echo "            <div style='clear:both;'></div>\r\n";
      echo "          </div>\r\n";
      // End a column div and start another if it's time.
      if (($rowIndex >= $itemsPerCol) && ($itemsDisplayed < $itemCount)) { 
        $rowIndex = 0;
        echo "        </div>\r\n";
        echo "        <div style='float:left;'>\r\n";
      }
    }    
    echo "        </div>\r\n";
    echo "          <div style='clear:both;'></div>\r\n";
    echo "        </div>\r\n";
    // Implementation of the Waive Payment button
    global $adeDEBUGGER;
    $adeDEBUGGER->belch('addPaymentWidget $databaseState', $databaseState, -1);
    $disableWaiveButton = isset($databaseState['checkOrPaypalNumber']) && ($databaseState['checkOrPaypalNumber'] !== '');
    $controlName = 'waivePaymentCtl';
    $waiveDate = date('Y-m-d');
    $onClick = "waivePayment(\'" . $waiveDate . "\');"; 
    echo "            <div style='float:left;padding-left:10px;padding-top:13px;'>\r\n";
    echo "              <input type='button' id='" . $controlName . "' name='" . $controlName . "' value='Waive Pmt'" . "onClick='waivePayment(\"" . $waiveDate . "\");'"
                                                   . (($disableWaiveButton) ? ' disabled' : '') . ">\r\n";
    echo "            </div>\r\n";
    // Close up the divs for this widget
    echo "        <div style='clear: both;'></div>\r\n";
    echo "      </div>\r\n";
    echo "<!-- END addPaymentWidget -->\r\n";
  }
  
  function addDesIdWidgetRow($desc, $idName, $initValue, $maxLength, $disable=false) {
    global $adeDEBUGGER;
    echo "<!-- TextWidgetRowDisabled IN AdminDataEntry : " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    $genId = HTMLGen::addTextWidgetRowHelper1($desc, $idName, $initValue, 8, "w", true);
    // Add the auto-gen button
    $result = SSFDB::getDB()->getArrayFromQuery('SELECT MAX(designatedId) AS maxId FROM works');
    $maxIdText = $result[0]['maxId'];
    $adeDEBUGGER->becho('005. maxIdText', $maxIdText, -1);
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

  function personExistsInDatabaseWithNameOrEmail($email, $name, $lastName, $nickName) {
    $personInDB = false;
    if ($email == '') { 
      $selectString = "SELECT personId FROM people WHERE (`lastName` = " . SSFQuery::quote($lastName) 
                                                  . " and `nickName` = " . SSFQuery::quote($nickName) . ")"
                                                  . " or `name` = " . SSFQuery::quote($name);
      //self::debugNextQuery();
      $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
      if (($rows !== null) && ($rows !== false) && (count($rows) > 0)) {
        $personInDB = true;
        echo '<script type="text/javascript">alert("The new person\'s email address is blank and their name, ' 
            . $name . ' (Last: ' . $lastName . ', First: ' . $nickName . ')'
            . ', duplicates one already in the database. Therefore, this person you just created will not be saved. '
            . '");</script>';
      }
    } else {
      $personInDB = SSFQuery::personExistsInDatabase($email);
      if ($personInDB != false) {
        echo '<script type="text/javascript">alert("The new person\'s email address, ' . $email 
            . ', duplicates one already in the database. Therefore, this person you just created will not be saved. '
            . '");</script>';
      }
    }
    return $personInDB;
  }


// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  $debugAdminSelection = 0;
  $displayDataStructures = 0;
  $debugChangeCount = -1;
  $debugInit = -1;

  $adeDEBUGGER = new SSFDebug();
  $adeDEBUGGER->enableBelch(false);
  $adeDEBUGGER->enableBecho(false);
  
/* This is all now accomplished transparently in SSFRunTimeValues.
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && $_POST['callForEntriesId'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']);
  else if (isset($_POST['priorCallForEntriesSelection']) && $_POST['priorCallForEntriesSelection'] != '') 
    SSFRunTimeValues::setCallForEntriesId($_POST['priorCallForEntriesSelection']);
*/

  $editorState = array();
  
  // Initialize $editorState from POST and other sources. Note that priorXXX is used because the current values
  // of such widgets is undefined until they are created below.
  foreach ($_POST as $postKey => $postValue) {
//    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
    $editorState[$postKey] = (isset($postValue)) ? $postValue : '';
  }

  // Fix up empty sets - TODO: This is a hack. We should look to the DatumProperties class to identify all the sets that need fixing up. Still OK as of 4/17/13
  $setsToFixUp = array('people_notifyOf', 'people_relationship', 'people_role');
  foreach ($setsToFixUp as $setToFixUp) {
    if (!isset($editorState[$setToFixUp])) $editorState[$setToFixUp] = array();
  }
  
  $adeDEBUGGER->belch('050. _POST', $_POST, $debugInit);
  $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  // There is no longer any need to initialize $editorState['adminSelector'] because it's value is handled 
  // behind the scenes by HTMLGen::displayAdministratorSelector (and therein by SSFAdmin::userIndex()).
  // WRONG: $editorState['adminSelector'] is used to communicate with SSFQuery::insertData()
  // 6/11/11 Eliminated this communication between modules via this global array element.
  // $editorState['adminSelector'] = SSFAdmin::userIndex(); 
  // We no longer use $editorState['adminSelector'], but in it's place, we do need to call SSFQuery::useAdministratorAsCreatorModifier(). 6/11/11
  SSFQuery::useAdministratorAsCreatorModifier();
  if (!isset($editorState['orientationSelector']) || $editorState['orientationSelector'] == '') {  
    $editorState['orientationSelector']
      = ((isset($editorState['priorOrientationSelector']) && $editorState['priorOrientationSelector'] != '' ) 
      ? $editorState['priorOrientationSelector']
      : 'works'); // default value
  }
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
  
  // Insert a newly created person if appropriate
  $debugPersonInsert = 0;
  $personInsertDebugFlag = (($debugPersonInsert == 1) || ($debugInit == 1)) ? 1 : -1;
  $adeDEBUGGER->becho('010.', 'Test to Insert a newly created person', $personInsertDebugFlag);
  if (isset($editorState['savingNewPerson']) && $editorState['savingNewPerson'] == 'savingNewPerson') {
    // We are saving a new person ...
    $adeDEBUGGER->becho('10a. editorState[personSelector] set to $editorState[people_personId]' , $editorState['people_personId'], $personInsertDebugFlag);
    $editorState['personSelector'] = $editorState['people_personId']; // so reset personSelector
    if(!personExistsInDatabaseWithNameOrEmail($editorState['people_email'], $editorState['people_name'], $editorState['people_lastName'], $editorState['people_nickName'])) {
//    if(($editorState['people_email'] == '') || !SSFQuery::personExistsInDatabase($editorState['people_email'])) {
      $adeDEBUGGER->becho('10b. !personExistsInDatabase' , 0, $personInsertDebugFlag);
      // The intention here (prior to 5/21/11) was to show whether this is a browser refresh. However, it seems that to 
      // allow a null email address and still check for person-uniqueness, this can no longer work. TODO Fix this?
      // How does one distinguish between a browser refresh and a resubmit? Use the Post Redirect Get Design Pattern.
      // See http://en.wikipedia.org/wiki/Post/Redirect/Get & http://www.theserverside.com/news/1365146/Redirect-After-Post. 
      // http://www.myhomepageindia.com/index.php/2009/03/19/post-redirect-get-design-pattern.html explains that this solution is not perfect.
      if (($editorState['people_email'] != '') && SSFQuery::personEmailAlreadyInDatabase($editorState["people_email"])) {
        echo '<script type="text/javascript">alert("The email address, ' . $editorState["people_email"] 
            . ', duplicates one already in the database. Therefore, this person you just created will not be saved. '
            . '");</script>';
  //          . 'And, the person with this email address is displayed.");</script>'; // TODO: Display the personSelector properly.
      } else {
        $adeDEBUGGER->becho('10c. !personEmailAlreadyInDatabase' , 0, $personInsertDebugFlag);
        //SSFQuery::debugNextQuery();
        $result = SSFQuery::insertData('people', $editorState);
        if ($result !== false) {
          $adeDEBUGGER->becho('10.', 'Insert a newly created person', $debugInit);
          $editorState['orientationSelector'] = 'people';
          $editorState['personSelector'] = $result;
          $editorState['people_personId'] = $result;
  //        $editorState['editingPersonId'] = $result;
        }
      }
    } else {
      $adeDEBUGGER->becho('10d. personExistsInDatabase' , 0, $personInsertDebugFlag);
    }
  }

  // Save an updated person if appropriate
  if (isset($editorState['savingPerson']) && $editorState['savingPerson'] == 'savingPerson') {
    $personId = (isset($editorState['editingPersonId'])) ? $editorState['editingPersonId'] : 0;
    if ($personId != 0) {
      $adeDEBUGGER->becho('20', 'Save an updated person', -1);
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      $adeDEBUGGER->belch('22 currentValueArray', $currentValueArray, -1);
      $adeDEBUGGER->belch('23 editorState', $editorState, -1);
//      SSFDB::DebugOn(); 
      $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $personId);
//      SSFDB::DebugOff(); 
      $adeDEBUGGER->becho('people changeCount', $changeCount, $debugChangeCount);
    }
  }

  // Insert a newly created work if appropriate
  if (isset($editorState['savingNewWork']) && ($editorState['savingNewWork'] == 'savingNewWork')
        && !SSFQuery::workExistsInDatabase($editorState['works_submitter'], $editorState['callForEntriesId'], $editorState['works_title'])) {
        //              ^^^^^ test to make sure this is not a browser refresh
    $editorState['works_callForEntries'] = SSFRunTimeValues::getCallForEntriesId();
    $editorState['works_titleForSort'] = HTMLGen::getTitleForSort($editorState['works_title']);
// Next line: Notice: Undefined index: works_designatedId; Notice: Undefined index: people_name 4/15/13
//    $editorState['works_filename'] = HTMLGen::computedFileNameForWork($editorState['works_designatedId'], $editorState['works_titleForSort'], $editorState['people_name']);
    $adeDEBUGGER->becho('30', 'Insert a newly created work', -1);
    $result = SSFQuery::insertData('works', $editorState);
    if ($result !== false) {
      $editorState['workSelector'] = $result;
      SSFQuery::addCurationRowsForNewWork($editorState['workSelector'], SSFRunTimeValues::getAdministratorId());
    }
  }

  // Save an updated work if appropriate
  if (isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
    $workId = (isset($editorState['editingWorkId'])) ? $editorState['editingWorkId'] : 0;
    if ($workId != 0) {
      $debugTitleForSort = -1;
      $adeDEBUGGER->becho('40.', 'Save an updated work', $debugTitleForSort);
      $currentDBWorkValues = SSFQuery::selectWorkFor($workId);
      // Update $editorState['works_titleForSort'] iff the the work titleForSort in the DB has never been set OR the (work title changed and the work titleForSort did not). modified 4/17/13
      if (isset($editorState['works_title']) && ($editorState['works_title'] != '') &&                        // Editor works_title is set AND
          ((!isset($currentDBWorkValues['titleForSort']) || ($currentDBWorkValues['titleForSort'] === '')) ||   // DB titleForSort value not set OR
          (!isset($editorState['works_titleForSort']) || ($editorState['works_titleForSort'] === '')) ||        // Editor works_titleForSort value not set OR
          (($currentDBWorkValues['title'] != $editorState['works_title']) &&                                    // Editor works_title changed AND
           ($currentDBWorkValues['titleForSort'] != $editorState['works_titleForSort']))))                        // the Editor titleForSort did not change
        $editorState['works_titleForSort'] = HTMLGen::getTitleForSort($editorState['works_title']);

      // Update $editorState['works_filename'] iff it is not set on the DB and the work designatedId is set. This should only happen once in the lifetime of a work unless the DB values are manipulated directly. // modified 4/17/13
      if (((!isset($currentDBWorkValues['filename']) || ($currentDBWorkValues['filename']) === '')) &&   // DB filename is not set
          isset($editorState['works_designatedId']) && ($editorState['works_designatedId'] != '')) { // Editor designatedId is set
        $submitterValues = SSFQuery::selectPersonFor($currentDBWorkValues['submitter']);
        $editorState['works_filename'] = HTMLGen::computedFileNameForWork($editorState['works_designatedId'], $editorState['works_titleForSort'], $submitterValues['name']);
      }
      //SSFDB::DebugNextQuery(); 
      $changeCount = SSFQuery::updateDBFor('works', $currentDBWorkValues, $editorState, 'workId', $workId);
      $changeCount += SSFQuery::updateDBForWorkContributors($editorState, $workId);
      $adeDEBUGGER->becho('work changeCount', $changeCount, $debugChangeCount);
    }
  }

  $adeDEBUGGER->belch('100 $editorState', $editorState, $displayDataStructures);
?>

<!-- BEGIN FORM ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- -->

    <form name='adeSelectorsForm' id='adeSelectorsForm' action='adminDataEntry.php' method='post'>
    
<?php HTMLGen::displayAdministratorSelector("padding-left:4px;padding-top:4px;", "rowTitleTextNarrow", 
                                            "document.adeSelectorsForm.submit();", "adminDataEntry"); ?>
            
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
<!--                <input type='submit' id='applyFilter' name='applyFilter' value='Apply'> -->
              </div>
              <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
          </div>
          <!-- Call for Entries Selector - Display only if $editorState['orientationSelector'] == 'works' -->
          
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Call for:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div style='float:left;'>\r\n";
//HTMLGen::displayCallForEntriesSelector('adeSelectorsForm', 'getUniqueElement("personSelector").value=0;' . 'getUniqueElement("workSelector").value=0;'); 
HTMLGen::displayCallForEntriesSelector('adeSelectorsForm'); 
echo "              </div>\r\n";
echo "            </div>\r\n";
echo "          <div style='clear:both;'></div>\r\n";
echo "          </div>\r\n";
}
?>

          <!-- Person Selector -->
          <?php $personOrSubmitterText = (($editorState['orientationSelector'] == 'works') ? 'Submitter: ' : 'Person: '); ?>
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'><?php echo $personOrSubmitterText ?></div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php // SSFDB::debugNextQuery(); 
                  $debugPersonSelection = 0;
                  $adeDEBUGGER->belch('ABC. $editorState', $editorState, $debugPersonSelection);
                  // Select the associated submitter if appropriate.
                    if (isset($editorState['showPerson']) && ($editorState['showPerson'] == 'Select Associated Submitter')) {
                      $adeDEBUGGER->becho('ABCD editorState[personSelector]', $editorState['personSelector'], $debugPersonSelection);
                      $adeDEBUGGER->becho('ABCD editorState[editingPersonId]', $editorState['editingPersonId'], $debugPersonSelection);
                      $editorState['personSelector'] = $editorState['editingPersonId'];
                    }
                    $personToBe = HTMLGen::displayPersonSelector('adeSelectorsForm', $editorState);
                    $editorState['personSelector'] = $personToBe;
                ?>
              </div>
              <div style="float:right;padding-left:20px;">
                <input type="submit" id="createNewPerson" name="createNewPerson" value="Create New Person">
              </div>
              <div style="clear:both;"></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          
          <!-- Work Selector -->
<?php if ($editorState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Work:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div style='float:left;'>\r\n";
                      $editorState['workSelector'] = HTMLGen::displayWorkSelector('adeSelectorsForm', $editorState['personSelector'], $editorState, '-- select a work --'); 
                      //if ($unique) echo "<script type='text/javascript'>document.adeSelectorsForm.submit();></script>";
echo "              </div>\r\n";
echo "              <div style='float:right;padding-left:20px;'>\r\n";
echo "                <input type='submit' id='createNewWork' name='createNewWork' disabled value='Create New Work'>\r\n";
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
          $personEditAvailable = ($personIsSpecified && HTMLGen::personIsInOptionList($personToBe));
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
              echo "<script type='text/javascript'>document.getElementById('personSelector').value = "
                   . $databaseState['submitter'] . ";document.adeSelectorsForm.submit();</script>";
              $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
            }
          } else if ($personIsSpecified) {
            $adeDEBUGGER->becho('CC', '$personIsSpecified', 0);
            //SSFDB::DebugNextQuery();
            $databaseState = SSFQuery::selectPersonFor($personToBe);  
          }
          if ($personToBe != $editorState['personSelector']) 
            $adeDEBUGGER->becho('DD personToBe != editorState[personSelector]', '$personToBe=' . $personToBe . '  $editorState[personSelector]=' . $editorState['personSelector'], 1);
          $adeDEBUGGER->belch('102. $editorState', $editorState, 0);
          $adeDEBUGGER->belch('102. $databaseState', $databaseState, 0);
?>
<!-- End State Initialization ------------------------------------------------------------- -->

<!-- Begin Data Display ------------------------------------------------------------- -->
<?php 
  if (!$editorState['editingWork'] && !$editorState['editingPerson'] && !$editorState['creatingNewPerson'] && !$editorState['creatingNewWork']) {
    echo '        <div id="ADEDataDiv" style="float:left;width:100%;">' . "\r\n";
    echo '<!-- display Person Information -->' . "\r\n";
    echo '          <div class="entryFormSectionHeading" style="padding-top:24px;">' . "\r\n";
    echo '            <div style="float:left;padding-top:4px;">' . $personOrSubmitterText;
    $disablePersonEditString = (!$personEditAvailable) ? 'disabled' : '';
    if ($personIsSpecified) echo $databaseState['name'] . " <span class='idDisplayText'>" . $databaseState['personId'] . "</span>";
    echo '</div>' . "\r\n";
    echo '            <div style="float:right;padding-right:4px;padding-bottom:0;">' . "\r\n";
    echo '              <input type="button" value="Show / Hide" ' . $disablePersonEditString . ' onclick="showHide(\'ADEPersonDiv\')">' . "\r\n";
    echo '              <input type="submit" id="editPerson" name="editPerson" value="Edit" ' . $disablePersonEditString . '>';
    echo '            </div>' . "\r\n";
    echo '            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>' . "\r\n";
    echo '          </div>' . "\r\n";
    echo '          <div id = "ADEPersonDiv" style="text-align:left;">' . "\r\n";
    if ($personIsSpecified) { 
      $forAdmin = true; 
      HTMLGen::displayPersonDetail($databaseState, $forAdmin); 
    }
    echo '        </div> <!-- id = "ADEPersonDiv" -->' . "\r\n";
    echo '<!-- display Work Information -->' . "\r\n";
    if ($editorState['orientationSelector'] == 'works') {
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
                    if (true || $workIsSpecified) {
                      $showPersonDisabledString = ($workIsSpecified && !$personEditAvailable) ? '' : ' disabled=disabled';
                      echo '<input type="submit" id="showPerson" name="showPerson" value="Select Associated Submitter"' . $showPersonDisabledString . '>&nbsp;';
                      $editWorkDisabledString = ($workIsSpecified) ? '' : ' disabled=disabled';
                      echo '<input type="submit" id="editWork" name="editWork" value="Edit"' . $editWorkDisabledString . '>';
                    }
      echo "            </div>\r\n";
      echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
      echo "          </div>\r\n";
      echo "          <div id='ADEEntriesDiv' style='text-align:left;'>\r\n";
      //              echo "<br>\r\n workIsSpecified=" . $workIsSpecified . "  workId=" . $databaseState['workId'] . "<br>\r\n";
      //              echo "<br>\r\n dataArray="; print_r($databaseState) . "<br>\r\n";
                    if ($workIsSpecified) HTMLGen::displayWorkDetailForAdmin($databaseState, $dbContributorsState);
      echo "          </div> <!-- id=ADEEntriesDiv -->\r\n";
    }
    echo '        </div> <!-- id = "ADEDataDiv" -->' . "\r\n";
  }
?>
<!-- End Data Display ------------------------------------------------------------- -->


<!-- Begin Create New Person ------------------------------------------------------------- -->
<?php
  if ($editorState['creatingNewPerson']) {
    HTMLGen::displayEditDivHeader('ADECreatePersonDiv', 'Creating New Person', 'saveNewPerson', 
                                  'validAdminPersonCreation', 'savingNewPerson', 'cancelPersonChanges');
    $disable = false;
    HTMLGen::addTextWidgetRow('Full Name', 'people_name', '', 128, $disable);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', '', 64, $disable);
    HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', '', 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', '', 128, $disable);
    HTMLGen::addTextWidgetRow('Email Address', 'people_email', '', 128);
    //HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable);
    //HTMLGen::addTextWidgetRow('Password', 'people_password', '', 32, $disable);
    //HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable);
    HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', 'individual', 4, "w", $disable); 
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
    echo '<script type="text/javascript">if (getUniqueElement("people_name") != null) { getUniqueElement("people_name").focus(); }</script>';
    echo "          </div> <!-- id = 'ADECreatePersonDiv' -->\r\n";
  }
?>
<!-- End Create New Person ------------------------------------------------------------- -->

     
<!-- Begin Person Edit ------------------------------------------------------------- -->
<?php
  if ($editorState['editingPerson']) {
    $title = "Editing Person: ";
    if (isset($databaseState['name']) && isset($databaseState['name'])) 
            $title .= $databaseState['name'] . " <span class='idDisplayText'>" . $databaseState['personId'] . "</span>";
      HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'savePerson', 
                                    'validAdminPersonEntry', 'savingPerson', 'cancelPersonChanges');
    $disable = false;
    if (isset($databaseState['personId']) && $databaseState['personId'] != null) {
      HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $databaseState['name'], 128);
      HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $databaseState['lastName'], 64, $disable);
      HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', $databaseState['nickName'], 64, $disable);
      HTMLGen::addTextWidgetRow('Organization', 'people_organization', $databaseState['organization'], 128, $disable);
      HTMLGen::addTextWidgetRowDisabled('Email Address', 'people_email', $databaseState['email'], 128);
      //HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', $databaseState['email'], 128, $disable);
      //HTMLGen::addTextWidgetRow('Password', 'people_password', $databaseState['password'], 32, $disable);
      //HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', $databaseState['password'], 32, $disable);
      HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', $databaseState['recordType'], 4, "w", $disable); 
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
    echo '<script type="text/javascript">if (getUniqueElement("people_lastName") != null) { getUniqueElement("people_lastName").focus(); }</script>';
    echo "          </div><!-- end ADEPersonEditDiv -->\r\n";
  }
?>
<!-- End Person Edit ------------------------------------------------------------- -->

        
<!-- Begin Create New Work  ------------------------------------------------------------- -->
<?php
  if ($editorState['creatingNewWork']) {
    $title = 'Creating New Work <span class="orangishHighlightDisplayColor">for ' 
           . HTMLGen::callForEntriesDescription($editorState['callForEntriesId']) . '</span>';
    HTMLGen::displayEditDivHeader('ADECreateWorkDiv', $title, 'saveNewWork', 
                                  'validAdminNewWork', 'savingNewWork', 'cancelWorkChanges');
    $disable = false;
    //HTMLGen::addTextWidgetRow('Call For', DatumProperties::getItemKeyFor('works', 'callForEntriesId'), '', 16, true);
    echo '<input type="hidden" id="works_callForEntries" name="works_callForEntries" value="<?php echo $editorState[\'callForEntriesId\']?>">' . "\r\n";
    echo '<div class="formRowContainer" style="margin-top:0;margin-bottom:0;">' . "\r\n";
    echo '  <div class="rowTitleTextWide">Submitter: </div>' . "\r\n";
    echo '  <div class="floatLeft">' . "\r\n";
    $person = (((isset($personToBe)) && $personToBe !=0) ? $personToBe : (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0));
    echo HTMLGen::getSubmitterSelector('adeSelectorsForm', DatumProperties::getItemKeyFor('works', 'submitter'), $person); 
    echo '  </div>' . "\r\n";
    echo '  <div style="clear: both;"></div>' . "\r\n";
    echo '</div>' . "\r\n";
    //HTMLGen::addTextWidgetRow('Submitter', DatumProperties::getItemKeyFor('works', 'submitter'), '', 16, $disable);
    HTMLGen::addSubHeading('The Basics', $first=true);
    // HTMLGen::addTextWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), '', 16, true); // Designated Id will not be entered by the administrator here.
    HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 256, $disable);
    // HTMLGen::addTextWidgetRow('Title for Sort', DatumProperties::getItemKeyFor('works', 'titleForSort'), '', 256, true); // Title for Sort will not be entered by the administrator here.
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 32, $disable);
    HTMLGen::addTextWidgetRow('Country of Production', DatumProperties::getItemKeyFor('works', 'countryOfProduction'), '', 256, $disable);
    HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTime'), '', 16, $disable);
    echo '<div class="entryFormSubheading" style="padding-top:12px;padding-bottom:2px">' . 'Electronic Media Submission Information' . '</div>';
    HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), '', 128, $disable);
    HTMLGen::addSubHeading('Still Images');
    HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable);
    HTMLGen::addTextWidgetRow('Image Location', DatumProperties::getItemKeyFor('works', 'photoLocation'), '', 256, $disable);
    HTMLGen::addTextWidgetRow('Image URL', DatumProperties::getItemKeyFor('works', 'photoURL'), '', 256, $disable);
    HTMLGen::addSubHeading('Media Receipt Dates');
    HTMLGen::addTextWidgetRow('Posted', DatumProperties::getItemKeyFor('works', 'dateMediaPostmarked'), '', 16, $disable);
// TODO: turn on dateMediaReceivedAtPOBox when it makes sense.
//    HTMLGen::addTextWidgetRow('Received at PO Box', DatumProperties::getItemKeyFor('works', 'dateMediaReceivedAtPOBox'), '', 16, true);
    HTMLGen::addTextWidgetRow('Picked Up/Downloaded', DatumProperties::getItemKeyFor('works', 'dateMediaReceived'), '', 16, $disable);
    HTMLGen::addSubHeading('Payment');
    HTMLGen::addTextWidgetRow('Date Paid', DatumProperties::getItemKeyFor('works', 'datePaid'), '', 16, $disable);
    HTMLGen::addTextWidgetRow('Amount Paid', DatumProperties::getItemKeyFor('works', 'amtPaid'), '', 16, $disable);
    addPaymentWidget('', $databaseState, $disable); 
    HTMLGen::addTextWidgetRow('Check or Paypal #', DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber'), '', 32, $disable);
    HTMLGen::addSubHeading('Formats');
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', '', 4, "w", $disable); 
//    HTMLGen::addTextWidgetRow('Original Format', DatumProperties::getItemKeyFor('works', 'originalFormat'), '', 64, $disable);
    HTMLGen::displayOriginalFormatSelector('', $disable); 
    HTMLGen::addAspectRatioAnamorphicRow(0, 0, $disable);
    HTMLGen::addPixelDimensionsWidgetsRow(0, 0, $disable);
    HTMLGen::addSubHeading('Miscellaneous');
    HTMLGen::addPermissionsWidgetRow($databaseState);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addRadioButtonWidgetRow('Web site pertains to', 'works', 'webSitePertainsTo', '', 4, "w", $disable);
    HTMLGen::addBooleanCheckBoxWidgetRow('Includes live prfrmnce', 'works', 'includesLivePerformance', 0, 1, $disable); 
    HTMLGen::addBooleanCheckBoxWidgetRow('Invited', 'works', 'invited', 0, 1, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously shown at', '', 2048, 2, $disable);
    HTMLGen::addSubHeading('Credits');
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable);
    HTMLGen::addSubHeading('Synopsis');
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Original Synopsis', '', 2048, 4, $disable);
    HTMLGen::addSubHeading('Notes');
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'submissionNotes'), 'Submission Notes', '', 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'workNotes'), 'Work Notes', '', 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'mediaNotes'), 'Media Notes', '', 2048, 2, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'projectionistNotes'), 'Projectionist Notes', '', 2048, 2, $disable);
    echo '<script type="text/javascript">if (getUniqueElement("works_submitter") != null) { getUniqueElement("works_submitter").focus(); }</script>';
    echo "          </div> <!-- id = 'ADECreateWorkDiv' -->\r\n";
  }
?>
<!-- End Create New Work ------------------------------------------------------------- -->

<!-- Begin Work Edit ------------------------------------------------------------- --> 
<?php
  if ($editorState['editingWork']) {
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
      // Kludge to get vimeo values from data display into database if they're not in the db and we do have them from Vimeo.
      if ((!isset($databaseState['frameWidthInPixels']) || ($databaseState['frameWidthInPixels']) == 0) && 
          (!isset($databaseState['frameHeightInPixels']) || ($databaseState['frameHeightInPixels']) == 0))
      {
      }
      HTMLGen::addSubHeading('The Basics', $first=true);
      addDesIdWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), $databaseState['designatedId'], 128, true); // true so 'Allow Edit' button appears 4/17/13
      //HTMLGen::addTextWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), $databaseState['designatedId'], 16, $disable);
      HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), $databaseState['title'], 256, $disable);
      HTMLGen::addTextWidgetRow('Title for Sort', DatumProperties::getItemKeyFor('works', 'titleForSort'), $databaseState['titleForSort'], 256, $disable);
      HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 32, $disable);
      HTMLGen::addTextWidgetRow('Country of Production', DatumProperties::getItemKeyFor('works', 'countryOfProduction'), $databaseState['countryOfProduction'], 256, $disable);
      HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTime'), $databaseState['runTime'], 16, $disable);
      echo '<div class="entryFormSubheading" style="padding-top:12px;padding-bottom:2px">' . 'Electronic Media Submission Information' . '</div>';
      HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), $databaseState['vimeoWebAddress'], 1024, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), $databaseState['vimeoPassword'], 128, $disable);
      HTMLGen::addSubHeading('Still Images');
      HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $databaseState['photoCredits'], 256, $disable);
      HTMLGen::addTextWidgetRow('Image Location', DatumProperties::getItemKeyFor('works', 'photoLocation'), $databaseState['photoLocation'], 256, $disable);
      HTMLGen::addTextWidgetRow('Image URL', DatumProperties::getItemKeyFor('works', 'photoURL'), $databaseState['photoURL'], 256, $disable);
      HTMLGen::addSubHeading('Media Receipt Dates');
      HTMLGen::addTextWidgetRow('Posted', DatumProperties::getItemKeyFor('works', 'dateMediaPostmarked'), $databaseState['dateMediaPostmarked'], 16, $disable);
// TODO: turn on dateMediaReceivedAtPOBox when it makes sense.
//      HTMLGen::addTextWidgetRow('Received at PO Box', DatumProperties::getItemKeyFor('works', 'dateMediaReceivedAtPOBox'), $databaseState['dateMediaReceivedAtPOBox'], 16, true);
      HTMLGen::addTextWidgetRow('Picked Up/Downloaded', DatumProperties::getItemKeyFor('works', 'dateMediaReceived'), $databaseState['dateMediaReceived'], 16, $disable);
      HTMLGen::addSubHeading('Payment');
      HTMLGen::addTextWidgetRow('Date Paid', DatumProperties::getItemKeyFor('works', 'datePaid'), $databaseState['datePaid'], 16, $disable);
      HTMLGen::addTextWidgetRow('Amount Paid', DatumProperties::getItemKeyFor('works', 'amtPaid'), $databaseState['amtPaid'], 16, $disable);
      addPaymentWidget($databaseState['howPaid'], $databaseState, $disable); 
      HTMLGen::addTextWidgetRow('Check or Paypal #', DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber'), $databaseState['checkOrPaypalNumber'], 32, $disable);
      HTMLGen::addSubHeading('Formats');
      HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 4, "w", $disable); 
//      HTMLGen::addTextWidgetRow('Original Format', DatumProperties::getItemKeyFor('works', 'originalFormat'), $databaseState['originalFormat'], 64, $disable);
      HTMLGen::displayOriginalFormatSelector($databaseState['originalFormat'], $disable); 
      $adeDEBUGGER->becho('Work Edit databaseState[anamorphic]', $databaseState['anamorphic'], -1);
      HTMLGen::addAspectRatioAnamorphicRow($databaseState['aspectRatio'], $databaseState['anamorphic'], $disable);
      HTMLGen::addPixelDimensionsWidgetsRow($databaseState['frameWidthInPixels'], $databaseState['frameHeightInPixels'], $disable);
      HTMLGen::addSubHeading('Miscellaneous');
      HTMLGen::addPermissionsWidgetRow($databaseState, $off=true); 
      HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $databaseState['webSite'], 1024, $disable);
      HTMLGen::addRadioButtonWidgetRow('Web site pertains to', 'works', 'webSitePertainsTo', $databaseState['webSitePertainsTo'], 4, "w", $disable);
      HTMLGen::addBooleanCheckBoxWidgetRow('Includes live prfrmnce', 'works', 'includesLivePerformance', $databaseState['includesLivePerformance'], 1, $disable); 
      HTMLGen::addBooleanCheckBoxWidgetRow('Invited', 'works', 'invited', $databaseState['invited'], 1, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously shown at', $databaseState['previouslyShownAt'], 2048, 2, $disable);
      HTMLGen::addSubHeading('Credits');
      HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable);
      HTMLGen::addSubHeading('Synopsis');
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Original Synopsis', $databaseState['synopsisOriginal'], 2048, 4, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit1'), 'Synopsis Edit 1', $databaseState['synopsisEdit1'], 2048, 4, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit2'), 'Synopsis Edit 2', $databaseState['synopsisEdit2'], 2048, 4, $disable);
      HTMLGen::addSubHeading('Notes');
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'submissionNotes'), 'Submission Notes', $databaseState['submissionNotes'], 2048, 2, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'workNotes'), 'Work Notes', $databaseState['workNotes'], 2048, 2, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'mediaNotes'), 'Media Notes', $databaseState['mediaNotes'], 2048, 2, $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'projectionistNotes'), 'Projectionist Notes', $databaseState['projectionistNotes'], 2048, 2, $disable);
    }
    echo '<script type="text/javascript">if (getUniqueElement("works_title") != null) { getUniqueElement("works_title").focus(); }</script>';
    echo "          </div><!-- end ADEWorkEditDiv -->\r\n";
  }  
?>
<!-- End Work Edit ------------------------------------------------------------- -->


<!-- Hidden Inputs Cache Section -->        
<!-- 6/11/11      <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<? // echo $editorState['adminSelector']; ?>"> -->
      <input type="hidden" id="priorOrientationSelector" name="priorOrientationSelector" value="<?php echo $editorState['orientationSelector']; ?>">
      <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<?php echo $editorState['callForEntriesId']; ?>">
      <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $editorState['personSelector']; ?>">
      <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']; ?>">
<!-- 5/21/11      <input type="hidden" id="editingPerson" name="editingPersonId" value="<? // echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>"> -->
      <input type="hidden" id="editingPersonId" name="editingPersonId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
<!-- 5/21/11      <input type="hidden" id="editingWork" name="editingWorkId" value="<? // echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0); ?>"> -->
      <input type="hidden" id="editingWorkId" name="editingWorkId" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0); ?>">
      <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0); ?>">
      <!-- <input type="hidden" id="people_personId" name="people_personId" value="<? // echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>"> -->
      <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
      <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
      <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
      <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> <!-- support for HTMLGen passing the name of the selector that initiated a Submit onchange. -->
      <input type="hidden" id="loginUserId" name="loginUserId" value=0>
      <input type="hidden" id="vimeoFrameWidthInPixels" name="vimeoFrameWidthInPixels" value="<?php echo HTMLGen::vimeoFrameWidthInPixels(); ?>">
      <input type="hidden" id="vimeoFrameHeightInPixels" name="vimeoFrameHeightInPixels" value="<?php echo HTMLGen::vimeoFrameHeightInPixels(); ?>">

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
/*
        echo '<script type="text/javascript">if (document.getElementById("ADEPersonEditDiv") !== null) { hide("ADEPersonEditDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADECreatePersonDiv") !== null) { hide("ADECreatePersonDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADEWorkEditDiv") !== null) { hide("ADEWorkEditDiv"); }</script>';
        echo '<script type="text/javascript">if (document.getElementById("ADECreateWorkDiv") !== null) { hide("ADECreateWorkDiv"); }</script>';
*/
        //echo '<script type="text/javascript">show("ADEDataDiv");</script>';
        echo '<script type="text/javascript">enableSelectors();</script>';
        if ($editorState['editingWork'] || $editorState['editingPerson'] || $editorState['creatingNewPerson'] || $editorState['creatingNewWork']) {
          echo '<script type="text/javascript">hide("ADEDataDiv");</script>';
          echo '<script type="text/javascript">disableSelectors();</script>';
        }
        //echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
        // Note: using document.getElementById for these widgets is OK because they are all unique.
/*
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

        if ($editorState['editingPerson']) echo '<script type="text/javascript">'
                                   . 'if (getUniqueElement("people_lastName") != null) { getUniqueElement("people_lastName").focus(); }'
                               . '</script>';
        if ($editorState['creatingNewPerson']) echo '<script type="text/javascript">'
                                   . 'if (getUniqueElement("people_name") != null) { getUniqueElement("people_name").focus(); }'
                                   . ' </script>';
        if ($editorState['editingWork']) echo '<script type="text/javascript">'
                                   . 'if (getUniqueElement("works_title") != null) { getUniqueElement("works_title").focus(); }'
                                   . '</script>';
        if ($editorState['creatingNewWork']) echo '<script type="text/javascript">'
                                   . 'if (getUniqueElement("works_submitter") != null) { getUniqueElement("works_submitter").focus(); }'
                                   . '</script>';
*/
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
