<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Entry Form Redirect</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js " type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr><td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
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
<?php
// ---- Debugger setup ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----
  $displayDataStructures = -1;
  $debugStateVariablesAtTop = -1;
  $debugStateVariablesAtBottom = -1;
  $debugRefreshIssues = -1;
  $debugPhpValidEmailAddress = -1;

  $editorDEBUGGER = new SSFDebug();
  $editorDEBUGGER->enableBelch(false);
  $editorDEBUGGER->enableBecho(false);
?>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
                  
<!-- ---- Special DIVs for JavaScript ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>
<SCRIPT type="text/javascript">
//<!-- 
  window.name='EntryFormWindow';
//-->
</SCRIPT>

<!-- Javascript Functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<script type="text/javascript">

  function okToCreateNewWork() { return true; }

  function disableSelectors() { 
    disable("workSelector"); 
    disable("createNewWork");
    disable("editPerson");
    disable("editWork");
  }

  function enableSelectors() { 
    enable("workSelector"); 
    if (okToCreateNewWork()) { enable("createNewWork"); } 
    enable("editPerson");
    enable("editWork");
  }

  function setHiddenBoolCacheWidget(checkboxId, hiddenCacheId) {
    isChecked = document.getElementById(checkboxId).checked;
    hiddenCacheWidget = document.getElementById(hiddenCacheId);
    if (isChecked) { hiddenCacheWidget.value = '1'; }
    else { hiddenCacheWidget.value ='0'; }
  }

  function cancelSubmit() {
//    alert('cancelSubmit');
    document.getElementById('hiddenInputSavingKey').value = 'Cancel';
    if (document.getElementById('saveNewPerson') != null) document.getElementById('saveNewPerson').value = '';
    if (document.getElementById('savePerson') != null) document.getElementById('savePerson').value = '';
    if (document.getElementById('saveNewWork') != null) document.getElementById('saveNewWork').value = '';
    if (document.getElementById('saveWork') != null) document.getElementById('saveWork').value = '';
    document.entryForm.submit();
  }

  function preSubmitValidation() {
    hiddenInputSavingKey = document.getElementById('hiddenInputSavingKey').value;
    if (document.getElementById(hiddenInputSavingKey) != null) { document.getElementById(hiddenInputSavingKey).value = hiddenInputSavingKey; }
//    alert('hiddenInputSavingKey=' + hiddenInputSavingKey);
    if (hiddenInputSavingKey=='Cancel') { return true; }
//    if (hiddenInputSavingKey=='savingNewPerson') { return validPersonCreation($editorState['loginName'], $editorState['pwFromLogin']); }
    if (hiddenInputSavingKey=='savingNewPerson') { return validPersonCreation(); }
    if (hiddenInputSavingKey=='savingPerson') { return validPersonEntry(); }
    if (hiddenInputSavingKey=='savingNewWork') { return computeRunTimeAndValidateWorkEntry(); }
    if (hiddenInputSavingKey=='savingWork') { $valid = computeRunTimeAndValidateWorkEntry(); alert('savingWork is' + (($valid) ? '' : ' not') + ' valid'); return $valid; }
//    if (isset(document.getElementById('createNewPerson')) { document.getElementById('createNewPerson').value = ''; }
    return true; 
  }

</script>

<?php 
// -- PHP functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  function getTitleForSort($title) {
    $bit7Title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", trim($title));
    $titleSansLeadingA = (stripos($bit7Title, 'A ') === 0) ? substr($bit7Title, 2) : $bit7Title;
    $titleSansLeadingThe = (stripos($titleSansLeadingA, 'The ') === 0) ? substr($titleSansLeadingA, 4) : $titleSansLeadingA;
    $titleInStrictMixedCase = ucwords(strtolower($titleSansLeadingThe));
    $titleInCamelCase = str_replace(" ", "", $titleInStrictMixedCase);
    $truncatedCamelCase = (strlen($titleInCamelCase > 20)) ? substr($titleInCamelCase, 0, 20) : $titleInCamelCase;
    global $editorDEBUGGER;
    $editorDEBUGGER->becho('truncatedCamelCase', $truncatedCamelCase, -1);
    return $truncatedCamelCase;
  }
  
  function badEmailAlert($n) { global $debugPhpValidEmailAddress; if ($debugPhpValidEmailAddress == 1) echo 'badEmailAlert ' . $n; }
  
  function validEmailAddress($str) {
    global $debugPhpValidEmailAddress;
		$at = "@";
		$dot = ".";
		$stringLength = strlen($str);
		$atIndex = strpos($str, $at);
		$dotIndex= strpos($str, $dot);
    global $editorDEBUGGER;
    $editorDEBUGGER->becho('atIndex', $atIndex, $debugPhpValidEmailAddress);
    $editorDEBUGGER->becho('stringLength', $stringLength, $debugPhpValidEmailAddress);
    $editorDEBUGGER->becho('dotIndex', $dotIndex, $debugPhpValidEmailAddress);
		if ($atIndex === false || $atIndex === 0 || $atIndex >= ($stringLength-4)) { badEmailAlert(1); return false; }
		if ($dotIndex === false || $dotIndex === 0 || $dotIndex >= ($stringLength-2)) { badEmailAlert(2); return false; }
    if (strpos($str, $at, ($atIndex+1)) !== false) { badEmailAlert(3); return false; }
		if (strpos($str, $atIndex-1, $atIndex) == $dot || substr($str, $atIndex+1, $atIndex+2) == $dot) { badEmailAlert(4); return false; }
		if (strpos($str, $dot, ($atIndex+2)) == -1) { badEmailAlert(5); return false; }
		if (strpos($str, " ") !== false) { badEmailAlert(6); return false; }
	  return true;
  }	

  function checkForValidLogin($editorState, $submitterDBState) {
    // TODO to do: FIX ERROR where user cannot return to submission form after bad password.
    // TODO Require a password for a new user.
    global $openErrorMessage; // TODO Bad boy - using a global here is bad style.
    global $editorDEBUGGER;
    $validLogin = 0;
    if (($editorState['pwFromLogin']=='') && ($submitterDBState['password'] != '')) { 
      // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
      $editorDEBUGGER->belch('User entered blank password that does not match the DB', '', -1);
      // Mail the user their password.
      $loginName = $editorState['loginName'];
      $to      =  $loginName;
      $subject = "To sign in";
      $message = "Dear " . $submitterDBState["name"] . ",\r\n\r\n"
               . "To sign in at http://sanssoucifest.org/onlineEntryForm/entryForm2010.php use " . $submitterDBState['password'] . "\r\n\r\n"
               . "Best Regards, \r\nYour Friendly Helper at SansSouciFest.org\r\n\r\nDo not reply to this message.\r\n";
      $headers = "From: YourFriendlyHelper@sanssoucifest.org" . "\r\n"
               . "Bcc: entryForm@sanssoucifest.org" . "\r\n"
               . "Reply-To: no-reply@sanssoucifest.org" . "\r\n"
               . "X-Mailer: PHP/" . phpversion();
      $editorDEBUGGER->becho('to', $to, -1);
      $editorDEBUGGER->becho('subject', $subject, -1);
      $editorDEBUGGER->becho('message', $message, -1);
      $editorDEBUGGER->becho('headers', $headers, -1);
      $mailedPassword = mail($to, $subject, $message, $headers);
      $openErrorMessage = "You did not enter your password. ";
      if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $loginName . "."
                                             . "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
    } else if (($submitterDBState['password'] != '') && ($submitterDBState['password'] != $editorState['pwFromLogin'])) { 
      // User entered incorrect non-blank password. Make them login again.
      $editorDEBUGGER->belch('User entered incorrect non-blank password', '', 0);
      $openErrorMessage = "The password you entered does not match your Sign In Email Address."
                        . "<br>If you simply forgot your password, leave it blank and Sign In again."
                        . "<br>You'll receive more help after that.";
    } else if ($editorState['passwordEntryRequired'] && ($editorState['pwFromLogin'] == '')) {
      // User entered blank password when a password is required.
      $editorDEBUGGER->belch('User entered blank password when a password is required.', '', 0);
      $openErrorMessage = "Please enter a password.";
    } else {
      // Username and password is OK.
      $validLogin = 1;
      echo '<input type="hidden" id="createNewPerson" name="createNewPerson" value="Create New Person">';
      $editorDEBUGGER->belch('validLogin', $validLogin, 0);
    }
    return $validLogin;
  }

// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  HTMLGen::setCaller('user');

  // Initialize $editorState from POST and other sources.
  $editorState = array();
  foreach ($_POST as $postKey => $postValue) {
    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
  }
  if (!isset($editorState['validLogin'])) { $editorState['validLogin'] = 0; }
  if (!isset($editorState['userLoggingIn'])) { $editorState['userLoggingIn'] = 1; }
  if (!isset($editorState['userLoggedIn'])) { $editorState['userLoggedIn'] = 0; }
  if (!isset($editorState['submitterInPeopleTable'])) { $editorState['submitterInPeopleTable'] = 0; }
  if (!isset($editorState['loginName'])) { $editorState['loginName'] = ''; }
  if (!isset($editorState['pwFromLogin'])) { $editorState['pwFromLogin'] = ''; }
  if (!isset($editorState['workSelector'])) { $editorState['workSelector'] = 0; }
  if (!isset($editorState['loginUserId'])) { $editorState['loginUserId'] = 0; }
  if (!isset($editorState['entryId'])) { $editorState['entryId'] = 0; }
  if (!isset($editorState['passwordEntryRequired'])) { $editorState['passwordEntryRequired'] = 0; }
  if (!isset($editorState['contributorArray'])) { $editorState['contributorArray'] = array(); }
  if (!isset($editorState['maxContributorOrder'])) { $editorState['maxContributorOrder'] = 0; }
  if (!isset($editorState['personLoggedInLastModified'])) { $editorState['personLoggedInLastModified'] = ''; }
  if (!isset($editorState['workLastModified'])) { $editorState['workLastModified'] = ''; }
  if (!isset($editorState['workSelector']) || $editorState['workSelector'] == 0) { // was === before 2/16/10
    $editorState['workSelector'] = ((isset($editorState['priorWorkSelection'])) ? $editorState['priorWorkSelection'] : 0); 
  }
  // Set $callForEntriesId to the current default value returned by SSFRunTimeValues.
  $callForEntriesId = $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
$editorDEBUGGER->belch('editorState before Sign In', $editorState, $displayDataStructures);
$editorDEBUGGER->belch('_POST', $_POST, $displayDataStructures);

//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

  // Sign In
  $openErrorMessage = "";
  $creatingNewPerson = false;
  if (isset($editorState['signInSubmit']) && $editorState['signInSubmit'] == 'Sign In' && !$editorState['userLoggedIn']) {
    $editorDEBUGGER->becho('10', 'Sign In with ' . $editorState['loginName'], 0);
    $editorState['userLoggingIn'] = 1;
    $validUserName = validEmailAddress($editorState['loginName']);
    if ($validUserName) {
      // On Success
      $editorState['userLoggedIn'] = 1;
      $editorState['userLoggingIn'] = 0;
      // Check to see if the Submitter is in the DB
      $submitterDBState = SSFQuery::selectPersonByLoginName($editorState['loginName']);
      if ($submitterDBState !== false) { // The Submitter is in the DB.
        $editorState['submitterInPeopleTable'] = 1;
        $editorState['validLogin'] = checkForValidLogin($editorState, $submitterDBState);
        if (!$editorState['validLogin']) {
          $editorState['userLoggedIn'] = 0;
          $editorState['userLoggingIn'] = 1;
          $editorState['loginUserId'] = $submitterDBState['name'];
        }
        $editorState['loginUserId'] = $submitterDBState['personId'];
      } else { // since the submitter is not in the DB
        $editorState['createNewPerson'] = 'Create New Person';
        $creatingNewPerson = true;
        $editorState['submitterInPeopleTable'] = 0;
        $editorState['passwordEntryRequired'] = true;
        $editorState['validLogin'] = 1;
      }
    } else { // since this is not a valid user name
      $openErrorMessage = "Please enter a valid email address. ";
      $editorState['userLoggingIn'] = 1;
      $editorState['userLoggedIn'] = 0;
      $editorState['validLogin'] = 0;
      focus::prep('loginName');
    }
  }

// -- compute global state variables ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  $creatingNewPerson = $creatingNewPerson || (isset($editorState['createNewPerson']) && $editorState['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($editorState['createNewWork']) && $editorState['createNewWork'] == 'Create New Work');
  $editingPerson = (isset($editorState['editPerson']) && $editorState['editPerson'] == 'Edit');
  $editingWork = (isset($editorState['editWork']) && $editorState['editWork'] == 'Edit');
  $displayingData = !($editorState['userLoggingIn'] || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);

  $editorDEBUGGER->becho('editorState[userLoggingIn]', (isset($editorState['userLoggingIn'])) ? $editorState['userLoggingIn'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[userLoggedIn]', (isset($editorState['userLoggedIn'])) ? $editorState['userLoggedIn'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[savingNewPerson]', (isset($savingNewPerson['savingNewPerson'])) ? $editorState['savingNewPerson'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[savingNewWork]', (isset($editorState['savingNewWork'])) ? $editorState['savingNewWork'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[savingPerson]', (isset($editorState['savingPerson'])) ? $editorState['savingPerson'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[savingWork]', (isset($editorState['savingWork'])) ? $editorState['savingWork'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtTop);
  

// Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ---- ---- ---- ---- ---- ---- 
  
  // Insert a newly created person if appropriate
  if (isset($editorState['savingNewPerson']) && $editorState['savingNewPerson'] == 'savingNewPerson') {
    $editorDEBUGGER->becho('10', 'Insert a newly created person', -1);
    $result = SSFQuery::insertData('people', $editorState);
    if ($result !== false) {
      $editorState['personSelector'] = $result;
      $editorState['people_personId'] = $result;
      $editorState['loginUserId'] = $result;
      $editorState['submitterInPeopleTable'] = 1;
    }
  }

  // Save an updated person if appropriate
  if (isset($editorState['savingPerson']) && $editorState['savingPerson'] == 'savingPerson') {
    $editorDEBUGGER->becho('20', 'Save an updated person', -1);
    $personId = (isset($editorState['editingPersonId'])) ? $editorState['editingPersonId'] : 0;
    if ($personId != 0) {
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $personId);
    }
  }

  // Insert a newly created work if appropriate
  if (isset($editorState['savingNewWork']) && ($editorState['savingNewWork'] == 'savingNewWork')) {
    $editorState['works_titleForSort'] = getTitleForSort($editorState['works_title']);
    $workInDatabase = SSFQuery::workExistsInDatabase($editorState['works_submitter'], $callForEntriesId, $editorState['works_title']);
    if ($workInDatabase !== false) { // This was a browser refresh
        $editorState['workSelector'] = $workInDatabase;
    } else { // OK, do the DB update
      $editorDEBUGGER->becho('30', 'Insert a newly created work', -1);
      $editorState['works_callForEntries'] = $callForEntriesId;
      $workId = SSFQuery::insertData('works', $editorState);
      if ($workId !== false) {
        $editorState['workSelector'] = $workId;
        $editorDEBUGGER->becho('500 editorState["workSelector"]', $editorState['workSelector'], $debugRefreshIssues);
        SSFQuery::updateDBForWorkContributors($editorState, $workId);
      }
    }
  }

  // Save an updated work if appropriate
  if (isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
    $editorState['works_titleForSort'] = getTitleForSort($editorState['works_title']);
    $workId = (isset($editorState['editingWorkId'])) ? $editorState['editingWorkId'] : 0;
    if ($workId != 0) {
      $editorDEBUGGER->becho('40', 'Save an updated work', 0);
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
      //SSFDB::debugOn(); 
      SSFQuery::updateDBFor('works', $currentWorkValueArray, $editorState, 'workId', $workId);
      SSFQuery::updateDBForWorkContributors($editorState, $workId);
      SSFDB::debugOff(); 
    }
  }

  $editorDEBUGGER->belch('100 editorState', $editorState, $displayDataStructures);
  $editorDEBUGGER->belch('101 _POST', $_POST, 0);

// -- Initialize $databaseState & $dbContributorsState  ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

          $loggedInPersonDefined = (isset($editorState['loginUserId'])); 
          $personIsZero = ($loggedInPersonDefined && ($editorState['loginUserId'] == 0)); 
          $personIsSpecified = ($loggedInPersonDefined && !$personIsZero);
          $workIdSelected = 0;
          $workIsSpecified = false;
          $databaseState = array();
          $dbContributorsState = array();

$editorDEBUGGER->belch('200 loggedInPersonDefined', $loggedInPersonDefined, 0);
$editorDEBUGGER->belch('200 editorState[loginUserId]', $editorState['loginUserId'], 0);
$editorDEBUGGER->belch('200 personIsZero', $personIsZero, 0);
$editorDEBUGGER->belch('200 personIsSpecified', $personIsSpecified, 0);

          if ($personIsSpecified) {
            // These next 2 lines about person selector are needed for HTMLGen::displayWorkSelector().
            $editorState['personSelector'] = $editorState['loginUserId'];
            echo '<input type="hidden" id="personSelector" name="personSelector" value="' . $editorState['loginUserId'] . '">';
            $workIsSpecified = (!$creatingNewWork && isset($editorState['workSelector']) && $editorState['workSelector'] != '' && ($editorState['workSelector'] != 0));
            if ($workIsSpecified) {
              $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
              $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
            } else {
              $databaseState = SSFQuery::selectPersonFor($editorState['loginUserId']);  
            }
          }        

        // support for passing $databaseState['email'] && $databaseState['password'] to preSubmitValidation() - What a hack!
        echo '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($databaseState['email']) ? $databaseState['email'] : '') . '">'; 
        echo '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($databaseState['password']) ? $databaseState['password'] : '') . '">'; 
        // support for computed full name
        echo '<input type="hidden" id="dbName" name="dbName" value="' . (isset($databaseState['name']) ? $databaseState['name'] : '') . '">'; 

$editorDEBUGGER->becho('501 editorState["workSelector"]', $editorState['workSelector'], $debugRefreshIssues);

$editorDEBUGGER->belch('200 editorState[personSelector]', (isset($editorState['personSelector']) ? $editorState['personSelector'] : ''), 0);
$editorDEBUGGER->belch('200 workIdSelected', $workIdSelected, 0);
          
$editorDEBUGGER->belch('102. $databaseState', $databaseState, $displayDataStructures);
$editorDEBUGGER->becho('personIsSpecified', $personIsSpecified, $displayDataStructures);
$editorDEBUGGER->becho('workIsSpecified', $workIsSpecified, $displayDataStructures);
?>
                                     
<!-- Switch from table-based formatting to primarily DIV-based formatting ---- ---- ---- ---- ---- ---- ---- ---- -->

   <div id="encloseEntireFormDiv" class="entryFormSection"> <!-- style="background-color:#333;" border:dashed 1px green; -->
                                     
<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<?php 
  $priorEmail = (isset($databaseState['email'])) ? $databaseState['email'] : '';
  $priorPassword = (isset($databaseState['password'])) ? $databaseState['password'] : ''; 
  $preSubmitValidationParamString = "'" . $priorEmail . "', '" . $priorPassword . "'";
?>
      <form name="entryForm" id="entryForm" style="border:none 1px pink;" 
            onSubmit="return preSubmitValidation(<?php echo $preSubmitValidationParamString; ?>);"
            action="entryForm2010.php" method="post">


<!-- Begin loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php if (!$editorState['userLoggedIn']) {
echo '        <div id="edLoginSectionDiv">  <!-- style="border: dashed 1px yellow;" -->' . "\r\n";
echo '          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center" valign="bottom" class="programPageTitleText" style="padding-top:24px;">Entry Form Sign In</td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td height="30" align="center" valign="middle"><hr align="center" size="1" noshade class="horizontalSeparator1"></td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center"> ' . "\r\n";
        if (!$editorState['validLogin'] && !$editorState['userLoggedIn']) { 
          echo '<div class="bodyTextOnBlack" '
             . 'style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 16px 4px;color: #FFFF66;">'
             . $openErrorMessage . '</div>';
        }
        $showBlurb = $editorState['userLoggingIn'] && !$editorState['validLogin'] && (!isset($openErrorMessage) || $openErrorMessage == '');
echo '              </td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">' . "\r\n";
  if ($showBlurb) echo '<div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="text-align:left;padding:0px 54px 24px 54px;">Sans '
                 . ' Souci, an international festival of dance cinema, invites and encourages submissions from all artists regardless of' 
                 . ' credentials and affiliations. Accepted works will be screened Friday &amp; Saturday, September 10th &amp; 11th, 2010'
                 . ' in Boulder, Colorado, USA.</div>' . "\r\n";
echo '                <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">' . "\r\n";
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in.</td></tr>' . "\r\n";
echo '                  <tr>' . "\r\n";
echo '                    <td height="28" align="right" class="entryFormDescription" style="width:242px;"> ' . "\r\n";
echo '                      <a href="javascript:window.void(0)" onMouseOver="flyoverPopup(' . HTMLGen::simpleQuote('Your login name is your email address.') . '"' . "\r\n";
echo '                        onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')">Email Aaddress / Login Name</a>: </td>' . "\r\n";
echo '                    <td height="28" align="left" class="entryFormField"><input type="text" name="loginName" id="loginName" ' . "\r\n";
echo '                         value="' . $editorState['loginName'] . '" ' . "\r\n";
echo '                         class="entryFormInputFieldShort" maxlength="100">' . "\r\n";
echo '                         <!-- onBlur="ValidEmail(this);" -->' . "\r\n";
echo '                    </td>' . "\r\n";
echo '                  </tr>' . "\r\n";
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0">If you have a password and you know what it is, enter it below.</td></tr>' . "\r\n";
echo '                  <tr>' . "\r\n";
echo '                    <td height="28" align="right" class="entryFormDescription">Password: </td>' . "\r\n";
echo '                    <td height="28" align="left" class="entryFormField"><input type="password" name="pwFromLogin" id="pwFromLogin" ' . "\r\n";
echo '                       value="' . $editorState['pwFromLogin'] . '" class="entryFormInputFieldShorter" maxlength="100"><span ' . "\r\n";
echo '                       class="entryFormDescription"> (leave blank if unknown)</span></td>' . "\r\n";
echo '                  </tr>' . "\r\n";
echo '                  <tr>' . "\r\n";
echo '                    <td colspan="2" height="28" align="center" style="padding:10px 0 16px 0"><input type="submit" id="signInSubmit" name="signInSubmit" value="Sign In"></td>' . "\r\n";
echo '                  </tr>' . "\r\n";
echo '                </table>' . "\r\n";
echo '              </td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '          </table>' . "\r\n";
echo '        </div> <!-- End edLoginSectionDiv -->' . "\r\n";
} ?>
<!-- End loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin entryFormSectionsDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id = "entryFormSectionsDiv" class="entryFormSection">
          <div class="programPageTitleText" style="float:none;">Entry Form, 2010</div>
          <!-- TODO: click the Submit or Save button depending on whether this is a new or existing entry. -->
          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="font-size:13.75px;text-align:left;padding:6px 8px 0px 8px;">To
            make a submission, complete this form and adhere
            to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.html',
            'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
            entryRequirementsWindow.focus();">Entry Requirements</a>. You may return later to print or edit this form
            by logging in again. Be sure to save your changes by clicking the Submit or Save button when it appears at the top of the form. 
<!--            Note that payment and release information is at the very bottom of the form. -->
          </div>
          <div id='editSectionsContainer' style='margin:0 auto 10px auto;padding:0 8px;border:none cyan 1px;'>
            <!-- TODO to do
              If there are existing entries for this call, then give this choice
                I am entering an additional entry for this call - if selected, then enable the Film Title entry field
                I am editing an existing entry for this call - if selected, then enable the Film Title dropdown list
              Otherwise, just show the Film Title entry field
              See MORE ON ENTRY CHOICE comment below.
            -->

<!-- TODO: Use workLastModified and submitterlastModified to verify that data has not changed since read.
         LastModified is set from DB at init & used to check (on server side before db update) that update from this form is still valid.
         That is, OK if LastModified value == DB value; otherwise, tell user they cannot submit from this form and must login again 
-->

<!-- Begin Data Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id="edDataDiv">
        
<!-- display Person Information -->
          <div class="entryFormSectionHeading">
            <div style="float:left;padding-top:4px;padding-bottom:4px;"><?php $personOrSubmitterText = 'Submitter:'; echo $personOrSubmitterText ?> <!-- TODO FIX $personOrSubmitterText -->
                <?php if ($personIsSpecified) echo $databaseState['name'] /* . " <span class='idDisplayText'>" . $databaseState['personId'] . "</span>" */; ?>
            </div>
            <div style="float:right;padding-right:4px;padding-bottom:0;">
<?php if ($personIsSpecified) { echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">' . "\r\n"; }                
?>                       
            </div>
            <div style="clear:both;padding:0;margin:0;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id = "edPersonDiv" style="text-align:left;">
            <?php if ($personIsSpecified) { HTMLGen::displayPersonDetail($databaseState, $forAdmin=false); } ?>
          </div> <!-- id = "edPersonDiv" -->

<!-- display Work Selector -->
          <div class="entryFormSectionHeading">
            <div style="float:left;padding-bottom:4px;">Select an entry or create a new one.</div>
            <div style='clear:both;'><hr class="horizontalSeparatorFull"></div>
          </div>
          <div class='formRowContainer'>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
<?php $workIdSelected = $editorState['workSelector'] = HTMLGen::displayWorkSelector('entryForm', $editorState, '-- select an entry --'); 
      $editorDEBUGGER->becho('502 editorState["workSelector"]', $editorState['workSelector'], $debugRefreshIssues);
       //if ($unique) echo "<script type='text/javascript'>document.entryForm.submit();></script>";
?>
              </div>
              <div style='float:left;padding-left:20px;'>
                <input type='submit' id='createNewWork' name='createNewWork' disabled value='Create New Work'>
              </div>
              <div style='clear:both;'></div>
            </div>
          <div style='clear:both;'></div>
          </div>

<!-- display Work Information -->
<?php 
  if ($workIsSpecified) {
echo "          <div class='entryFormSectionHeading'>\r\n";
echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;">Entry: "' . $databaseState['title'] . '"';
echo "            </div>\r\n";
echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
echo '              <input type="submit" id="editWork" name="editWork" value="Edit">' . "\r\n";
echo "            </div>\r\n";
echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
echo "          </div>\r\n";
echo "          <div id='edEntriesDiv' style='text-align:left;'>\r\n";
                $editorDEBUGGER->becho('504 databaseState["workId"]', $databaseState['workId'], $debugRefreshIssues);
                HTMLGen::displayWorkDetail($databaseState, $dbContributorsState);
echo "          </div> <!-- id=edEntriesDiv -->\r\n";
  }
?>

        </div> <!-- End edDataDiv -->
<!-- End Data Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Hidden Inputs to cache state ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

        <input type="hidden" id="loginUserId" name="loginUserId" value="<?php echo $editorState['loginUserId']; ?>" > 
        <input type="hidden" id="works_submitter" name="works_submitter" value="<?php echo isset($editorState['loginUserId']) ? $editorState['loginUserId'] : ''; ?>">
        <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>">
        <input type="hidden" id="entryId" name="entryId" value="<?php echo $editorState['entryId']; ?>" > 
        <input type="hidden" id="passwordEntryRequired" name="passwordEntryRequired" value="<?php echo $editorState['passwordEntryRequired']; ?>" > 
        <input type="hidden" id="validLogin" name="validLogin" value="<?php echo $editorState['validLogin']; ?>" > 
        <input type="hidden" id="userLoggedIn" name="userLoggedIn" value="<?php echo $editorState['userLoggedIn']; ?>" > 
        <input type="hidden" id="userLoggingIn" name="userLoggingIn" value="<?php echo $editorState['userLoggingIn']; ?>" > 
        <input type="hidden" id="submitterInPeopleTable" name="submitterInPeopleTable" value="<?php echo $editorState['submitterInPeopleTable']; ?>" > 
        <input type="hidden" id="editingPersonId" name="editingPersonId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
        <input type="hidden" id="editingWorkId" name="editingWorkId" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0);?>">
        <input type="hidden" id="maxContributorOrder" name="maxContributorOrder" value="<?php echo $editorState['maxContributorOrder']; ?>" > 
        <input type="hidden" id="workLastModified" name="workLastModified" value="<?php echo $editorState['workLastModified']; ?>" >
        <input type="hidden" id="personLoggedInLastModified" name="personLoggedInLastModified" value="<?php echo $editorState['personLoggedInLastModified']; ?>" >
        <input type="hidden" id="people_name" name="people_name" value="<?php echo isset($databaseState['name']) ? $databaseState['name'] : ''; ?>">
        <input type="hidden" id="works_runTime" name="works_runTime" value="<?php echo isset($editorState['works_runTime']) ? $editorState['works_runTime'] : '00:00:00'; ?>">
        <input type="hidden" id="works_titleForSort" name="works_titleForSort" value="<?php echo isset($editorState['works_titleForSort']) ? $editorState['works_titleForSort'] : ''; ?>">
        <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
        <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
        <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
        <input type="hidden" id="hiddenInputSavingKey" name="hiddenInputSavingKey" value="">
        <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> <!-- support for HTMLGen passing the name of the selector that initiated a Submit onchange. -->
        <input type="hidden" id="dbPassword" name="dbPassword" value=""> <!-- support for HTMLGen passing $databaseState['password'] to validPersonEntry() - What a hack! -->
        <input type="hidden" id="dbEmail" name="dbEmail" value=""> <!-- support for HTMLGen passing $databaseState['email'] to validPersonEntry() - What a hack!  -->
        <input type="hidden" id="dbName" name="dbName" value=""> <!-- support for HTMLGen passing $databaseState['name'] to validPersonEntry() - What a hack!  -->


<!-- Begin Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  if ($creatingNewPerson) {
    $disable = !$editorState['validLogin'];
    HTMLGen::displayEditDivHeader_2('edCreatePersonDiv', "Editing", 'saveNewPerson', 
                                  'validPersonCreation', 'savingNewPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRow('First Name', 'people_nickName', '', 64, $disable);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', '', 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', '', 128, $disable);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', '', 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', '', 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', '', 32, $disable);
    $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
    HTMLGen::addStateZipCountryRow($szcArray, $disable);
    $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
    HTMLGen::addTextWidgetTelephonesRow($phoneArray, $disable);
  
    //if ($editorState['submitterInPeopleTable'])
    echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow('Email Address', 'people_email', $editorState['loginName'], 128, $disable);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); // TODO FIX this
  
    //if ($editorState['submitterInPeopleTable']) 
    echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    HTMLGen::addTextWidgetRow('Password', 'people_password', '', 32, $disable);
    HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable); // TODO FIX this
  
    echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', '', 128, $disable);
    echo "          </div> <!-- End edCreatePersonDiv -->";
  }
?>
<!-- End Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  if ($editingPerson && isset($databaseState['personId']) && $databaseState['personId'] != null) {
    $disable = !$editorState['validLogin'];
SSFDebug::globalDebugger()->belch('100e. databaseState', $databaseState, -1);
    HTMLGen::displayEditDivHeader_2('edEditPersonDiv', "Editing " . $databaseState['name'], 'savePerson', 
                                  'validPersonEntry', 'savingPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRow('First Name', 'people_nickName', $databaseState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $databaseState['lastName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $databaseState['organization'], 128, $disable);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $databaseState['streetAddr1'], 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $databaseState['streetAddr2'], 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', $databaseState['city'], 32, $disable);
    $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
    HTMLGen::addStateZipCountryRow($databaseState, $disable);
    $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
    HTMLGen::addTextWidgetTelephonesRow($databaseState, $disable);
  
    if ($editorState['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow('Email Address', 'people_email', $databaseState['email'], 128, $disable);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); // TODO FIX this
  
    if ($editorState['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    HTMLGen::addTextWidgetRow('Password', 'people_password', $databaseState['password'], 32, $disable);
    HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable); // TODO FIX this
  
    echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $databaseState['howHeardAboutUs'], 128, $disable);
    echo "          </div> <!-- End edEditPersonDiv -->";
  }
?>
<!-- End Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

  <!-- TODO: MORE ON ENTRY CHOICE: For now, just allow editing of one entry associated with the current Call. Eventually, ask user if 
       they want to create a new entry, view an existing entry, or edit an existing entry. Only OK to edit for current Call for Entries. 
       Use a radio button to make the initial (new, view, edit) choice. Use drop-down menus plus select button for view/edit selection. 
  -->

<!-- Begin Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = !$editorState['validLogin'];
//  if (isset($databaseState['workId']) && $databaseState['workId'] != null) {
  if ($creatingNewWork) {
    HTMLGen::displayEditDivHeader_2('edCreateWorkDiv', 'Creating Entry', 'saveNewWork', 
                                  'computeRunTimeAndValidateWorkEntry', 'savingNewWork', 'cancelWorkChanges');
    HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 64, $disable);
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 4, $disable);
    HTMLGen::addRunTimeWidgetsRow('00:00:00', $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', 'DVD', 4, $disable); 
    HTMLGen::displayOriginalFormatSelector('', $disable); 
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Bried Synopsis', '', 2048, 3, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', '', 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable);
    $databaseState["howPaid"] = 'paypal';
    HTMLGen::addPaymentWidgetsSection($databaseState, $disable);
    $databaseState["permissionsAtSubmission"] = 'allOK2010';
    HTMLGen::addReleaseInfoWidgetsSection($databaseState, $disable);
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!-- End edCreateWorkDiv -->\r\n";
  }
?>
<!-- End Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Begin Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = !$editorState['validLogin'];
  SSFDebug::globalDebugger()->belch('100d. databaseState', $databaseState, -1);
  $title = (isset($databaseState['title'])) ? $databaseState['title'] : 'No Title'; 
  if ($editingWork && isset($databaseState['workId']) && $databaseState['workId'] != null) {
    HTMLGen::displayEditDivHeader_2('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'saveWork', 
                                  'computeRunTimeAndValidateWorkEntry', 'savingWork', 'cancelWorkChanges');
    HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), $databaseState['title'], 64, $disable);
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 4, $disable);
    HTMLGen::addRunTimeWidgetsRow($databaseState['runTime'], $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 4, $disable); 
    HTMLGen::displayOriginalFormatSelector($databaseState['originalFormat'], $disable); 
    // TODO Edit credits separately from the other stuff.
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
//    echo'<div class="entryFormSectionHeading" style="text-align:left;margin-top:20px;line-height:13px;">Credits:<br><hr class="horizontalSeparatorFull"></div>' . "\r\n";
//    echo HTMLGen::getAllContributorDisplayLines($dbContributorsState, $displayContributorsOnSeparateLines = true);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Bried Synopsis', $databaseState['synopsisOriginal'], 2048, 3, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $databaseState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $databaseState['photoCredits'], 256, $disable);
    HTMLGen::addPaymentWidgetsSection($databaseState, $disable);
    HTMLGen::addReleaseInfoWidgetsSection($databaseState, $disable);
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!--  End edEditWorkDiv -->\r\n";
  }
?>
<!-- End Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- TODO Show the Submit button for Work Creation but not for Work Edit
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submit"></a>Submit this Form:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" align="center" colspan="2"><input type="submit" id="submit" name="Submit" value="        Submit        "></td>
                </tr>
              </table>
-->
                </div>  <!-- editSectionsContainer -->
              </div> <!-- End entryFormSectionsDiv -->
            </form> <!-- End FORM -->
        </div> <!-- End encloseEntireFormDiv -->

<?php
// <!-- Div Control -------------------------------------------- >

  $editorDEBUGGER->becho('editorState[userLoggingIn]', $editorState['userLoggingIn'], $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editorState[userLoggedIn]', $editorState['userLoggedIn'], $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtBottom);

        echo '<script type="text/javascript">show("entryFormSectionsDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edLoginSectionDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edEditPersonDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edCreatePersonDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edEditWorkDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edCreateWorkDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">enableSelectors();</script>' . "\r\n";
        if ($displayingData) {
          echo '<script type="text/javascript">show("edDataDiv");</script>' . "\r\n";
          echo '<script type="text/javascript">enableSelectors();</script>' . "\r\n";
        } else {
          echo '<script type="text/javascript">hide("edDataDiv");</script>' . "\r\n";
          echo '<script type="text/javascript">disableSelectors();</script>' . "\r\n";
        }
        echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
        // Note: using document.getElementById for these widgets is OK because they are all unique.
        if ($editorState['userLoggingIn']) echo '<script type="text/javascript">'
                               . 'show("edLoginSectionDiv");'
                               . 'hide("entryFormSectionsDiv");'
                               . 'if (getUniqueElement("loginName") != null) { getUniqueElement("loginName").focus(); }'
                               . '</script>' . "\r\n";
        if ($editingPerson) echo '<script type="text/javascript">'
                               . 'show("edEditPersonDiv");'
                               . 'if (document.getElementById("edCreatePersonDiv") !== null) '
                               .    '{ document.getElementById("edCreatePersonDiv").innerHTML = ""; }'
                               . 'if (getUniqueElement("people_nickName") != null) { getUniqueElement("people_nickName").focus(); }'
                               . '</script>' . "\r\n";
        if ($creatingNewPerson) echo '<script type="text/javascript">'
                                   . 'show("edCreatePersonDiv");'
                                   . 'if (document.getElementById("edEditPersonDiv") !== null) '
                                   .    '{ document.getElementById("edEditPersonDiv").innerHTML = ""; }'
                                   . 'if (getUniqueElement("people_nickName") != null) { getUniqueElement("people_nickName").focus(); }'
                                   . ' </script>' . "\r\n";
        if ($editingWork) echo '<script type="text/javascript">'
                                   . 'show("edEditWorkDiv");'
                                   . 'if (document.getElementById("edCreateWorkDiv") !== null) '
                                   .    '{ document.getElementById("edCreateWorkDiv").innerHTML = ""; }'
                                   . 'if (getUniqueElement("works_title") != null) { getUniqueElement("works_title").focus(); }'
                                   . '</script>' . "\r\n";
        if ($creatingNewWork) echo '<script type="text/javascript">'
                                   . 'show("edCreateWorkDiv");'
                                   . 'if (document.getElementById("edEditWorkDiv") !== null) '
                                   .    '{ document.getElementById("edEditWorkDiv").innerHTML = ""; }'
                                   . 'if (getUniqueElement("works_title") != null) { getUniqueElement("works_title").focus(); }'
                                   . '</script>' . "\r\n";
        focus::set();
?>
<!-- End encloseEntireFormDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- END SWITCH FROM TABLE TO DIV ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
	  	<!-- InstanceEndEditable --></td>
                 <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                 <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                </tr>
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
          <tr align="center" valign="top">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
<!-- InstanceEnd -->
</html>
