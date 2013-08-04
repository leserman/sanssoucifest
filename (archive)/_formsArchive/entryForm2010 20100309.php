<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - 2010 Entry Form</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js " type="text/javascript"></script>
<!-- <script src="../scripts/entryForm.js" type="text/javascript"></script> -->
<!-- <script src="../scripts/validateEmailAddress.js" type="text/javascript"></script> -->
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
  $displayDataStructures = 0;
  $debugStateVariablesAtTop = 0;
  $debugStateVariablesAtBottom = 0;

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

  function userMadeAChange(entity) { 
    document.getElementById('changeCount').value++; 
    //if (entity == 0)  document.getElementById('personChangeCount').value++; 
    //if (entity == 1)  document.getElementById('entryChangeCount').value++; 
  }

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
    if (document.getElementById(hiddenInputSavingId) != null) {
      document.getElementById(hiddenInputSavingId).value = hiddenInputSavingId;
      //alert('Performing post-javascript validation');
      document.getElementById('entryForm').submit();  
    }
    else { alert("postValidationSubmit FAILED for |" + hiddenInputSavingId + "|. Please copy this error message and email it to webdude@sanssoucifest.org."); }
  }

</script>

<?php 
// -- PHP functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  class focus {
    private static $setFocusTo = '';
    public static function prep($widgetId) { self::$setFocusTo = $widgetId; }
    public static function set() {
     if (isset(self::$setFocusTo) && self::$setFocusTo != '') 
       echo "<script type='text/javascript'>document.getElementById('" . self::$setFocusTo . "').focus();</script>\r\n";
    }
  }

  function badEmailAlert($n) { echo 'badEmailAlert ' . $n; }
  
  function validEmailAddress($str) {
    $debugValidEmailAddress = 1;
		$at = "@";
		$dot = ".";
		$stringLength = strlen($str);
		$atIndex = strpos($str, $at);
		$dotIndex= strpos($str, $dot);
    global $editorDEBUGGER;
    $editorDEBUGGER->becho('atIndex', $atIndex, $debugValidEmailAddress);
    $editorDEBUGGER->becho('stringLength', $stringLength, $debugValidEmailAddress);
    $editorDEBUGGER->becho('dotIndex', $dotIndex, $debugValidEmailAddress);
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
  // Set $callForEntriesId to the current default value returned by SSFRunTimeValues.
  $callForEntriesId = $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
$editorDEBUGGER->belch('editorState before Sign In', $editorState, $displayDataStructures);
$editorDEBUGGER->belch('_POST', $_POST, $displayDataStructures);

//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

  // Sign In
  $openErrorMessage = "";
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

  // -- compute global state variables ---- ---- ---- ---- ---- ---- ---- ---- ---- 
  $creatingNewPerson = (isset($editorState['createNewPerson']) && $editorState['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($editorState['createNewWork']) && $editorState['createNewWork'] == 'Create New Work');
  $editingPerson = (isset($editorState['editPerson']) && $editorState['editPerson'] == 'Edit');
  $editingWork = (isset($editorState['editWork']) && $editorState['editWork'] == 'Edit');
  $displayingData = !($editorState['userLoggingIn'] || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);

  $editorDEBUGGER->becho('editorState[userLoggingIn]', $editorState['userLoggingIn'], $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editorState[userLoggedIn]', $editorState['userLoggedIn'], $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtTop);

  // Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work
  
  // Insert a newly created person if appropriate
  if (isset($editorState['savingNewPerson']) && $editorState['savingNewPerson'] == 'savingNewPerson') {
    $editorDEBUGGER->becho('10', 'Insert a newly created person');
    $result = SSFQuery::insertData('people', $editorState);
    if ($result !== false) {
      $editorState['personSelector'] = $result;
      $editorState['people_personId'] = $result;
    }
  }

  // Save an updated person if appropriate
  if (isset($editorState['savingPerson']) && $editorState['savingPerson'] == 'savingPerson') {
    $editorDEBUGGER->becho('20', 'Save an updated person');
    $personId = (isset($editorState['editingPerson'])) ? $editorState['editingPerson'] : 0;
    if ($personId != 0) {
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $personId);
    }
  }

  // Insert a newly created work if appropriate
  if (isset($editorState['savingNewWork']) && $editorState['savingNewWork'] == 'savingNewWork') {
    $editorDEBUGGER->becho('30', 'Insert a newly created work');
    $result = SSFQuery::insertData('works', $editorState);
    if ($result !== false) {
      $editorState['workSelector'] = $result;
    }
  }

  // Save an updated work if appropriate
  if (isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
    $workId = (isset($editorState['editingWork'])) ? $editorState['editingWork'] : 0;
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

// -- $databaseState & $dbContributorsState state initialization ---- ---- ---- ---- 

          $databaseState = $dbContributorsState = array();
          $loggedInPersonDefined = $workIsSpecified = false;
          $loggedInPersonDefined = (isset($editorState['loginUserId'])); 
          $personIsZero = ($loggedInPersonDefined && ($editorState['loginUserId'] == 0)); 
          $personIsSpecified = ($loggedInPersonDefined && !$personIsZero);

          if ($personIsSpecified) { // TODO - Fix this to incorporate a works selector
            $works = SSFQuery::selectWorksFor($editorState['loginUserId']);
            $workIdToBe = $works[0]['workId'];
SSFDebug::globalDebugger()->belch('SSFQuery::selectWorksFor(' . $editorState['loginUserId'] . ')', $works, -1);
          }        
          
          $workIsSpecified = (isset($workIdToBe) && $workIdToBe != '' 
                                                 && ($workIdToBe != 0));
          if ($workIsSpecified && $loggedInPersonDefined) {
            $editorDEBUGGER->becho('AA', 'workIsSpecified && personDefined', 0);
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($workIdToBe); 
            $dbContributorsState = SSFQuery::selectContributorsFor($workIdToBe);  
          } else if ($workIsSpecified && !$personIsSpecified) {
            $editorDEBUGGER->becho('BB', 'workIsSpecified && !personIsSpecified', 0);
            //SSFDB::debugNextQuery();
            $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($workIdToBe); 
            if (SSFQuery::success()) {
              // echo "<script type='text/javascript'>document.getElementById('personSelector').value = "
              //     . $databaseState['submitter'] . ";document.adeSelectorsForm.submit();</script>";
              $dbContributorsState = SSFQuery::selectContributorsFor($workIdToBe);  
            }
          } else if ($personIsSpecified) {
            $editorDEBUGGER->becho('CC', '$personIsSpecified', -1);
SSFDebug::globalDebugger()->belch('100b. databaseState', $databaseState, -1);
            $databaseState = SSFQuery::selectPersonFor($editorState['loginUserId']);  
          }

  $editorDEBUGGER->belch('102. $databaseState', $databaseState, $displayDataStructures);
  $editorDEBUGGER->becho('personIsSpecified', $personIsSpecified, $displayDataStructures);
  $editorDEBUGGER->becho('workIsSpecified', $workIsSpecified, $displayDataStructures);

?>
                                     
<!-- Switch from table-based formatting to primarily DIV-based formatting ---- ---- ---- ---- ---- ---- ---- ---- -->

   <div id="encloseEntireFormDiv" class="entryFormSection"> <!-- style="background-color:#333;" border:dashed 1px green; -->
                                     
<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

      <form name="entryForm" id="entryForm" 
            onSubmit="return validateEntryForm(this, '<?php echo $editorState["loginName"] ?>', '<?php echo $editorState["pwFromLogin"] ?>')" 
            action="entryForm2010.php" method="post"> <!-- style="border:dashed 1px pink;" -->

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
          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="text-align:left;padding:6px 8px 0px 8px;">To
            make a submission, complete this form and adhere
            to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.html',
            'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
            entryRequirementsWindow.focus();">Entry Requirements</a>. You may return later to print or edit this form
            by logging in again.	Be sure to save your changes by clicking the <a href="#submit">Submit</a> button
            at the bottom of the form. 
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
<!-- Hidden Inputs to cache state -->
            <input type="hidden" id="loginUserId" name="loginUserId" value="<?php echo $editorState['loginUserId']; ?>" > 
            <input type="hidden" id="entryId" name="entryId" value="<?php echo $editorState['entryId']; ?>" > 
            <input type="hidden" id="passwordEntryRequired" name="passwordEntryRequired" value="<?php echo $editorState['passwordEntryRequired']; ?>" > 
            <input type="hidden" id="validLogin" name="validLogin" value="<?php echo $editorState['validLogin']; ?>" > 
            <input type="hidden" id="userLoggedIn" name="userLoggedIn" value="<?php echo $editorState['userLoggedIn']; ?>" > 
            <input type="hidden" id="userLoggingIn" name="userLoggingIn" value="<?php echo $editorState['userLoggingIn']; ?>" > 
            <input type="hidden" id="submitterInPeopleTable" name="submitterInPeopleTable" value="<?php echo $editorState['submitterInPeopleTable']; ?>" > 
            <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
            <input type="hidden" id="editingWork" name="editingWork" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0);?>">
            <input type="hidden" id="maxContributorOrder" name="maxContributorOrder" value="<?php echo $editorState['maxContributorOrder']; ?>" > 
            <input type="hidden" id="workLastModified" name="workLastModified" value="<?php echo $editorState['workLastModified']; ?>" >
            <input type="hidden" id="personLoggedInLastModified" name="personLoggedInLastModified" value="<?php echo $editorState['personLoggedInLastModified']; ?>" >
            <input type="hidden" id="people_name" name="people_name" value="<?php echo isset($databaseState['people_name']) ? $databaseState['people_name'] : ''; ?>">
            <input type="hidden" id="works_runTime" name="works_runTime" value="<?php echo isset($editorState['works_runTime']) ? $editorState['works_runTime'] : '00:00:00'; ?>">
            <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
            <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
            <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">

<!-- Begin Data Display ------------------------------------------------------------- -->
        <div id="edDataDiv">
        
<!-- display Person Information -->
          <div class="entryFormSectionHeading"> <!-- style="padding-top:24px;" -->
            <div style="float:left;padding-top:4px;"><?php $personOrSubmitterText = 'Submitter:'; echo $personOrSubmitterText ?> <!-- TODO FIX $personOrSubmitterText -->
                <?php if ($personIsSpecified) echo $databaseState['name'] /* . " <span class='idDisplayText'>" . $databaseState['personId'] . "</span>" */; ?>
            </div>
            <div style="float:right;padding-right:4px;padding-bottom:0;">
<?php if ($personIsSpecified) { echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">' . "\r\n"; }                
?>                       
            </div>
            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id = "edPersonDiv" style="text-align:left;">
            <?php if ($personIsSpecified) { HTMLGen::displayPersonDetail($databaseState, $forAdmin=false); } ?>
          </div> <!-- id = "edPersonDiv" -->

<!-- display Work Information -->
<?php 
echo "          <div class='entryFormSectionHeading'>\r\n";
echo '            <div style="float:left;padding-top:4px;">Entry: "';
              if ($workIsSpecified) {
                echo $databaseState['title'] . '"';
              }
echo "            </div>\r\n";
echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
              if ($workIsSpecified) echo '<input type="submit" id="editWork" name="editWork" value="Edit">';
echo "            </div>\r\n";
echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
echo "          </div>\r\n";
echo "          <div id='edEntriesDiv' style='text-align:left;'>\r\n";
              if ($workIsSpecified) HTMLGen::displayWorkDetail($databaseState, $dbContributorsState);
echo "          </div> <!-- id=edEntriesDiv -->\r\n";
echo "        </div> <!-- End edDataDiv -->\r\n";
echo "<!- -- End Data Display ------------------------------------------------------------- -->\r\n";

echo "<!- -- Begin Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->\r\n";
  if (isset($databaseState['personId']) && $databaseState['personId'] != null) {
    $disable = !$editorState['validLogin'];
SSFDebug::globalDebugger()->belch('100e. databaseState', $databaseState, -1);
    HTMLGen::displayEditDivHeader('edEditPersonDiv', "Editing " . $databaseState['name'], 'savePerson', 
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
    echo "          </div> <!-- id = End edEditPersonDiv -->";
  }
?>
<!-- End Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

  <!-- TODO: MORE ON ENTRY CHOICE: For now, just allow editing of one entry associated with the current Call. Eventually, ask user if 
       they want to create a new entry, view an existing entry, or edit an existing entry. Only OK to edit for current Call for Entries. 
       Use a radio button to make the initial (new, view, edit) choice. Use drop-down menus plus select button for view/edit selection. 
  -->

<!-- Begin Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = !$editorState['validLogin'];
  SSFDebug::globalDebugger()->belch('100d. databaseState', $databaseState, -1);
  $title = (isset($databaseState['title'])) ? $databaseState['title'] : 'No Title'; 
  if (isset($databaseState['workId']) && $databaseState['workId'] != null) {
    HTMLGen::displayEditDivHeader('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'saveWork', 
                                  'computeRunTimeAndValidateWorkEntry', 'savingWork', 'cancelWorkChanges');
    HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), $databaseState['title'], 64, $disable);
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 4, $disable);
    HTMLGen::addRunTimeWidgetsRow($databaseState['runTime'], $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 4, $disable); 
    HTMLGen::displayOriginalFormatSelector($databaseState['originalFormat'], $disable); 
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Bried Synopsis', $databaseState['synopsisOriginal'], 2048, 3, $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $databaseState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $databaseState['photoCredits'], 256, $disable);
?>
                  <!-- Payment Information -->
                  <div class="entryFormSectionHeading" style="text-align:left;margin-top:20px;">Payment Information:<br><hr class="horizontalSeparatorFull"></div>
                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="paypal" value="paypal"
                    <?php if ($databaseState["howPaid"]=="paypal") echo "checked='checked'"; ?> 
                    onchange='userMadeAChange(1);'>
                    <label for="paypal" class="entryFormRadioButton"> Pay via PayPal</label>
                   </div>
                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="check" value="check"
	  								<?php if ($databaseState["howPaid"]=="check") echo "checked='checked'"; ?> 
  								  onchange='userMadeAChange(1);'>
	  								<label for="check" class="entryFormRadioButton"> Check or money order in US Dollars sent via post with media</label>
                  </div>
                  
                  <!-- Release Information -->
                  <div class="entryFormSectionHeading" style="text-align:left;margin-top:12px;">Release Information:<br><hr class="horizontalSeparatorFull"></div>
                  <div class="medSmallBodyTextLeadedOnBlack" style="text-align:left;">By clicking the Submit Button below, you certify that you hold
                    all necessary rights for the submission of this entry. Clicking Submit on this entry form gives Sans Souci Festival 
										permission for screening this submission at the Festival Event in Boulder Colorado USA on September 20 &amp; 21, 2010 and also:
									</div>
                  <div class="entryFormField">
                    <table width="96%"  border="0" align="left" cellpadding="2" cellspacing="0"> 
                      <tr>
                        <td align="right" valign="top" style="padding-left:20px;"><input type="radio" name="works_permissionsAtSubmission" id="allOK" value="allOK2010" 
                        <?php if ($databaseState["permissionsAtSubmission"]=="allOK2010") echo "checked"; ?> ></td>
                        <td align="left" valign="top" style="padding-top:4px;"><label for="allOK" class="entryFormRadioButton">All tours 
                            associated with the 2010-2011 Season in the
                            US and elsewhere. (Sans Souci has previously toured in Mexico, Germany, and Trinidad.)</label></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" style="padding-left:20px;"><input type="radio" name="works_permissionsAtSubmission" id="askMe" value="askMe2010" 
                        <?php if ($databaseState["permissionsAtSubmission"]=="askMe2010") echo "checked"; ?> ></td>
                        <td align="left" valign="top" style="padding-top:4px;"><label for="allOK" class="entryFormRadioButton">Please
                          invite me to each tour/venue separately so I  can respond to each individually. (Artists will be
                          invited to any additional venues as we make such arrangements.)</label></td>
                      </tr>
                    </table>
                  </div>
<?php
echo '            <div style="clear:both;"></div>';
echo "          </div> <!-- id = End edEditWorkDiv -->\r\n";
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
        echo '<script type="text/javascript">show("edDataDiv");</script>' . "\r\n";
        // echo '<script type="text/javascript">enableSelectors();</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edEditPersonDiv");</script>' . "\r\n";
        // echo '<script type="text/javascript">hide("edCreatePersonDiv");</script> . "\r\n"';
        echo '<script type="text/javascript">hide("edEditWorkDiv");</script>' . "\r\n";
        // echo '<script type="text/javascript">hide("edCreateWorkDiv");</script>' . "\r\n";
        if ($editingWork || $editingPerson || $creatingNewPerson || $creatingNewWork) {
          echo '<script type="text/javascript">hide("edDataDiv");</script>' . "\r\n";
          // echo '<script type="text/javascript">disableSelectors();</script> . "\r\n"';
        }
        //echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
        // Note: using document.getElementById for these widgets is OK because they are all unique.
        if ($editorState['userLoggingIn']) echo '<script type="text/javascript">'
                               . 'show("edLoginSectionDiv");'
                               . 'hide("entryFormSectionsDiv");'
                               . '</script>' . "\r\n";
        if ($editingPerson) echo '<script type="text/javascript">'
                               . 'show("edEditPersonDiv");'
                               . '</script>' . "\r\n";
        if ($creatingNewPerson) echo '<script type="text/javascript">'
//                                   . 'show("edCreatePersonDiv");'
                                   . ' </script>' . "\r\n";
        if ($editingWork) echo '<script type="text/javascript">'
                                   . 'show("edEditWorkDiv");'
                                   . '</script>' . "\r\n";
        if ($creatingNewWork) echo '<script type="text/javascript">'
//                                   . 'show("edCreateWorkDiv");'
                                   . '</script> . "\r\n"';
        
        focus::set();

?>
<!-- End entryFormSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

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
