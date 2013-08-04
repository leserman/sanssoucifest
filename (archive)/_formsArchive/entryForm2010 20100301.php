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
<script src="../scripts/entryForm.js" type="text/javascript"></script>
<script src="../scripts/validateEmailAddress.js" type="text/javascript"></script>
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
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
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
<!-- Javascript Functions -->
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
    alert("postValidationSubmit Id = |" + hiddenInputSavingId + "|"); 
    if (document.getElementById(hiddenInputSavingId) != null) {
      document.getElementById(hiddenInputSavingId).value = hiddenInputSavingId;
      alert('about to submit ' + hiddenInputSavingId);
      document.getElementById('adeSelectorsForm').submit();  
    }
    else { alert("postValidationSubmit FAILED for |" + hiddenInputSavingId + "|. Please write this down and tell David."); }
  }

</script>


<!-- BEGIN SWITCH FROM TABLE TO DIV ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php 

  function checkForValidLogin($editorState, $submitterDBState) {
    // TODO to do: FIX ERROR where user cannot return to submission form after bad password.
    global $openErrorMessage; // TODO Bad boy - using a global here is bad style.
    global $editorDEBUGGER;
    $validLogin = 0;
    if (($editorState['pwFromLogin']=='') && ($submitterDBState['password'] != '')) { 
      // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
      $editorDEBUGGER->belch('User entered blank password that does not match the DB', '', 1);
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
      $mailedPassword = mail($to, $subject, $message, $headers);
      $openErrorMessage = "You did not enter your password. ";
      if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $loginName . ".";
      $openErrorMessage .= "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
    } else if (($submitterDBState['password'] != '') && ($submitterDBState['password'] != $editorState['pwFromLogin'])) { 
      // User entered incorrect non-blank password. Make them login again.
      $editorDEBUGGER->belch('User entered incorrect non-blank password', '', 1);
      $openErrorMessage = "The password you entered does not match your Sign In Email Address."
                        . "<br>If you simply forgot your password, leave it blank and Sign In again."
                        . "<br>You'll receive more help after that.";
    } else if ($editorState['passwordEntryRequired'] && ($editorState['pwFromLogin'] == '')) {
      // User entered blank password when a password is required.
      $editorDEBUGGER->belch('User entered blank password when a password is required.', '', 1);
      $openErrorMessage = "Please enter a password.";
    } else {
      // Username and password is OK.
      $validLogin = 1;
      $editorDEBUGGER->belch('validLogin', $validLogin, 1);
    }
    return $validLogin;
  }

  
  $openErrorMessage = "";

  $editorDEBUGGER = new SSFDebug();
  $editorDEBUGGER->enableBelch(false);
  $editorDEBUGGER->enableBecho(false);

  // Initialize $editorState from POST and other sources.
  $editorState = array();
  foreach ($_POST as $postKey => $postValue) {
    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
  }
  if (!isset($editorState['validLogin'])) { $editorState['validLogin'] = (isset($editorState['validLogin'])) ? $editorState['validLogin'] : false; }
  if (!isset($editorState['submitterInPeopleTable'])) { $editorState['submitterInPeopleTable'] = 0; }
  if (!isset($editorState['loginName'])) { $editorState['loginName'] = ''; }
  if (!isset($editorState['pwFromLogin'])) { $editorState['pwFromLogin'] = ''; }
  if (!isset($editorState['workSelector'])) { $editorState['workSelector'] = 0; }
  if (!isset($editorState['loginPersonId'])) { $editorState['loginPersonId'] = 0; }
  if (!isset($editorState['entryId'])) { $editorState['entryId'] = 0; }
  if (!isset($editorState['passwordEntryRequired'])) { $editorState['passwordEntryRequired'] = false; }
  if (!isset($editorState['contributorArray'])) { $editorState['contributorArray'] = array(); }
  if (!isset($editorState['maxContributorOrder'])) { $editorState['maxContributorOrder'] = 0; }
  if (!isset($editorState['personLoggedInLastModified'])) { $editorState['personLoggedInLastModified'] = ''; }
  if (!isset($editorState['workLastModified'])) { $editorState['workLastModified'] = ''; }
  // Set $callForEntriesId to the current default value returned by SSFRunTimeValues.
  $callForEntriesId = $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
$editorDEBUGGER->belch('editorState', $editorState, 1);

  // set state variables
  $userLoggingIn = !$editorState['validLogin'];
  $creatingNewPerson = (isset($editorState['createNewPerson']) && $editorState['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($editorState['createNewWork']) && $editorState['createNewWork'] == 'Create New Work');
  $editingPerson = (isset($editorState['editPerson']) && $editorState['editPerson'] == 'Edit');
  $editingWork = (isset($editorState['editWork']) && $editorState['editWork'] == 'Edit');
  $rawState1 = !($userLoggingIn || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);
  $creatingNewPerson = ($rawState1 && !$editorState['submitterInPeopleTable']);
  $displayingData = !($userLoggingIn || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);

  $debugStateVariables = 1;
  $editorDEBUGGER->becho('userLoggingIn', $userLoggingIn, $debugStateVariables);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariables);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariables);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariables);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariables);
  $editorDEBUGGER->becho('rawState1', $rawState1, $debugStateVariables);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariables);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariables);

  // Respond to a user Save or SignIn button click: New Person | Updated Person | New Work | Updated Work
  
  // Sign In
  if (isset($editorState['signInSubmit']) && $editorState['signInSubmit'] == 'Sign In') {
    $editorDEBUGGER->becho('10', 'Insert a newly created person');
    $result = SSFQuery::insertData('people', $editorState);
    if ($result !== false) {
      $editorState['personSelector'] = $result;
      $editorState['people_personId'] = $result;
    }
  }

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
      $editorDEBUGGER->becho('40', 'Save an updated work');
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
      //SSFDB::debugOn(); 
      SSFQuery::updateDBFor('works', $currentWorkValueArray, $editorState, 'workId', $workId);
      SSFQuery::updateDBForWorkContributors($editorState, $workId);
      //SSFDB::debugOff(); 
    }
  }

  $editorDEBUGGER->belch('100 editorState', $editorState, 0);
  $editorDEBUGGER->belch('101 _POST', $_POST, 0);
?>

<!-- State Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php 
//  if ($editorState['submitterInPeopleTable'] && $editorState['validLogin']) { //TODO

          // Initialize session varables if not already set. $editorState['validLogin'] is the discriminator.
          if (!$editorState['validLogin']) { 
            // Check to see if the Submitter is in the DB
            $submitterDBState = SSFQuery::selectPersonByLoginName($editorState['loginName']);
            if ($submitterDBState !== false) { // The Submitter is in the DB.
              $editorState['submitterInPeopleTable'] = 1;
              $editorState['validLogin'] = checkForValidLogin($editorState, $submitterDBState);
              echo "<script type='text/javascript'>doocument.getElementById('validLogin').value = '" . $editorState['validLogin'] . "';</script>\r\n";
              $loggedInPersonId = $submitterDBState['personId']; 
            } else { // since the submitter is not in the DB
              $editorState['submitterInPeopleTable'] = 0;
              $editorState['passwordEntryRequired'] = true;
            }
          }
          $databaseState = $dbContributorsState = array();
          $loggedInPersonDefined = $workIsSpecified = false;
          $loggedInPersonDefined = (isset($loggedInPersonId)); 
          $personIsZero = ($loggedInPersonDefined && ($loggedInPersonId == 0)); 
          $personIsSpecified = ($loggedInPersonDefined && !$personIsZero);

          if ($personIsSpecified) { // TODO - Fix this to incorporate a works selector
            $works = SSFQuery::selectWorksFor($loggedInPersonId);
            $workIdToBe = $works[0]['workId'];
SSFDebug::globalDebugger()->belch('SSFQuery::selectWorksFor(' . $loggedInPersonId . ')', $works, -1);
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
            $databaseState = SSFQuery::selectPersonFor($loggedInPersonId);  
          }
          $editorDEBUGGER->belch('102. $databaseState', $databaseState, 0);
?>
                                     
    <div id="encloseEntireFormDiv" style="background-color:#333;border:dashed 1px green;"> 
                                     
<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

      <form name="entryForm" id="entryForm" 
            onSubmit="return validateEntryForm(this, '<?php echo $editorState["loginName"] ?>', '<?php echo $editorState["pwFromLogin"] ?>')" 
            action="entryForm2010.php" method="post" style="border:dashed 1px green;">

<!-- Begin loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id="edLoginSectionDiv" class="entryFormSection" style="border: dashed 1px yellow;">
          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
            <tr>
              <td align="center" valign="bottom" class="programPageTitleText" style="padding-top:24px;">Entry Form Sign In</td>
            </tr>
            <tr>
              <td height="30" align="center" valign="middle"><hr align="center" size="1" noshade class="horizontalSeparator1"></td>
            </tr>
            <tr>
              <td align="center"> 
<?php   if (!$editorState['validLogin']) echo '<div class="bodyTextOnBlack" 
                                style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 16px 4px;color: #FFFF66;">'
                              . $openErrorMessage . '</div>' 
?>
              </td>
            </tr>
            <tr>
              <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">
                  <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in.</td></tr>
                    <tr>
                      <td height="28" align="right" class="entryFormDescription" style="width:242px;"> 
                        <a href="javascript:window.void(0)" onMouseOver="flyoverPopup('Your login name is your email address.')"
                          onMouseOut="killFlyoverPopup()" onClick="window.alert('Your login name is your email address.')">Email Aaddress / Login Name</a>: </td>
                      <td height="28" align="left" class="entryFormField"><input type="text" name="loginName" id="loginName" 
                           value="<?php echo $editorState['loginName']; ?>" class="entryFormInputFieldShort" maxlength="100">
                      </td>
                    </tr>
                    <tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0">If you have a password and you know what it is, enter it below.</td></tr>
                    <tr>
                      <td height="28" align="right" class="entryFormDescription">Password: </td>
                      <td height="28" align="left" class="entryFormField"><input type="password" name="pwFromLogin" id="pwFromLogin" 
                         value="<?php echo $editorState['pwFromLogin']; ?>" class="entryFormInputFieldShorter" maxlength="100"><span 
                         class="entryFormDescription"> (leave blank if unknown)</span></td>
                    </tr>
                    <tr>
                      <td colspan="2" height="28" align="center" style="padding:10px 0 40px 0"><input type="submit" id="signInSubmit" name="signInSubmit" value="Sign In"></td>
                    </tr>
                  </table>
              </td>
            </tr>
          </table>
        </div> <!-- End edLoginSectionDiv -->
<!--                         value="" class="entryFormInputFieldShort" onBlur="processLoginUID(this.value)" maxlength="100"> -->
<!--                         value="" class="entryFormInputFieldShorter" onBlur="submitLogin(document.getElementById('loginName'),this.value)" maxlength="100"><span -->
<!-- End loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin entryFormSectionsDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id = "entryFormSectionsDiv" class="entryFormSection">
          <div class="programPageTitleText" style="float:none;">Entry Form, 2010</div>
          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="text-align:left;padding:6px 8px 0px 8px;">Sans Souci,
            an international festival of dance cinema, invites and encourages submissions from all artists regardless of
            credentials and affiliations. Accepted works will be screened Friday &amp; Saturday, September 10th &amp; 11th, 2010
            in Boulder, Colorado, USA.<br><br>
            To make a submission, complete this form and adhere
            to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.html',
            'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
            entryRequirementsWindow.focus();">Entry Requirements</a>. You may return later to print or edit this form
            by logging in again.	Be sure to save your changes by clicking the <a href="#submit">Submit</a> button
            at the bottom of the form. 
<!--            <br clear="all"> -->
          </div>
          <div id='editSectionsContainer' style='margin:0 auto 0 auto;padding:0 8px;background-color:#333;border:solid cyan 1px;'>
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
<!-- Hidden Inputs -->
            <input type="hidden" id="loginPersonId" name="loginPersonId" value="<?php echo $editorState['loginPersonId']; ?>" > 
            <input type="hidden" id="entryId" name="entryId" value="<?php echo $editorState['entryId']; ?>" > 
            <input type="hidden" id="passwordEntryRequired" name="passwordEntryRequired" value="<?php echo $editorState['passwordEntryRequired']; ?>" > 
            <input type="hidden" id="validLogin" name="validLogin" value="<?php echo $editorState['validLogin']; ?>" > 
            <input type="hidden" id="submitterInPeopleTable" name="submitterInPeopleTable" value="<?php echo $editorState['submitterInPeopleTable']; ?>" > 
            <input type="hidden" id="maxContributorOrder" name="maxContributorOrder" value="<?php echo $editorState['maxContributorOrder']; ?>" > 
            <input type="hidden" id="workLastModified" name="workLastModified" value="<?php echo $editorState['workLastModified']; ?>" >
            <input type="hidden" id="personLoggedInLastModified" name="personLoggedInLastModified" value="<?php echo $editorState['personLoggedInLastModified']; ?>" >

<!-- 
  function addTextWidgetRow($desc, $idName, $initValue, $maxLength, $disabled=false)
  function displayEditDivHeader($divIdString, $title, $saveButtonNameId, 
                                $validationFunctionName, $hiddenInputSavingId, $cancelButtonNameId)
-->

<!-- Begin Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  if (isset($submitterDBState['personId']) && $submitterDBState['personId'] != null) {
    $disable = !$editorState['validLogin'];
SSFDebug::globalDebugger()->belch('100e. databaseState', $databaseState, -1);
    HTMLGen::displayEditDivHeader('edEditPersonDiv', "Editing " . $submitterDBState['name'], 'savePerson', 
                                  'validPersonEntry', 'savingPerson', 'cancelPersonChanges');
    // function addTextWidgetRow($desc, $idName, $initValue, $maxLength, $disabled=false)
//  HTMLGen::addTextWidgetRow('Name', 'people_name', '', 128, $disable);
    HTMLGen::addTextWidgetRow('First Name', 'people_nickName', $submitterDBState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $submitterDBState['lastName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $submitterDBState['organization'], 128, $disable);
  
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $submitterDBState['streetAddr1'], 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $submitterDBState['streetAddr2'], 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', $submitterDBState['city'], 32, $disable);
    $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
    HTMLGen::addStateZipCountryRow($databaseState, $disable);
    $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
    HTMLGen::addTextWidgetTelephonesRow($databaseState, $disable);
  
    if ($editorState['submitterInPeopleTable']) echo '<br clear="all"><div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow('Email Address', 'people_email', $submitterDBState['email'], 128);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); // TODO FIX this
  
    if ($editorState['submitterInPeopleTable']) echo '<br clear="all"><div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    HTMLGen::addTextWidgetRow('Password', 'people_password', $submitterDBState['password'], 32, $disable);
    HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable); // TODO FIX this
  
    echo '<br clear="all"><div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $submitterDBState['howHeardAboutUs'], 128, $disable);
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
  $sectionTitle = "Editing Entry"; // . $databaseState['name'];  TODO FIX this
  $title = (isset($databaseState['title'])) ? $databaseState['title'] : 'No Title'; 
  if (isset($databaseState['workId']) && $databaseState['workId'] != null) {
    HTMLGen::displayEditDivHeader('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'saveWork', 
                                  'validWorkEntry', 'savingWork', 'cancelWorkChanges');
    // function addTextWidgetRow($desc, $idName, $initValue, $maxLength, $disabled=false)
    HTMLGen::addTextWidgetRow('Film Title', 'works_title', $databaseState['title'], 64, $disable);
    HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 4, $disable);
  // TODO Fix this time stuff
    list($hours, $minutes, $seconds) = explode(":", $databaseState['runTime']);
    $editorState['runTimeMinutes'] = (60 * $hours) + $minutes; 
    $editorState['runTimeSeconds'] = $seconds;
    HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTimeMinutes'), $editorState['runTimeMinutes'], 3, $disable); 
    echo '<span class="entryFormDescriptionSub">&nbsp;min,</span>';
    HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTimeSeconds'), $editorState['runTimeSeconds'], 3, $disable); 
    echo '<span class="entryFormDescriptionSub">&nbsp;sec</span>';
  // TO DO TODO: FIX RE_INITIALIZATION OF RADIO BUTTONS. This is an old note. Is it still relevant?
    HTMLGen::addRadioButtonWidgetRow('Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 5, $disable); 
/*
<!-- <div><table> -->
<!-- TODO Refine presentation of Submission Format radio buttons.
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Submission Format</td>
											<td height="28" align="left" class="entryFormField"> TO DO TODO: FIX RE_INITIALIZATION OF RADIO BUTTONS <input  
												  type="radio" name="SubmissionFormat" id="miniDV" value="miniDV" 
												  <Xphp if ($_SESSION["SubmissionFormat"]!="DVD") echo "checked"; ?> ><label for="miniDV" class="entryFormRadioButton"> Mini-DV 
												  (preferred)</label>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="SubmissionFormat" id="DVD" value="DVD"
												  <Xphp if ($_SESSION["SubmissionFormat"]=="DVD") echo "checked"; ?>><label for="DVD" class="entryFormRadioButton"> DVD</label></td>
										</tr>
-->
<!-- <tr><td> -->

<!-- Original Format -->
<!-- TODO FIX RE-INITIALIZATION OF Original Format DROP_DOWN. This is an old note. Relevant? -->
*/
echo "          <div class='formRowContainer' style='padding-left:4px;padding-top:4px;'>\r\n";
echo "            <div class='rowTitleTextNarrow'>Original Format:</div>\r\n";
echo "            <div class='entryFormFieldContainer'>\r\n";
echo "              <div>\r\n";
        $stringWithEmbeddedQuotes = 'textField=document.getElementById("originalFormat"); textField.value = "";';
echo "                <select id='originalFormatSelector' name='originalFormatSelector' style='width:220px' \r\n";
echo "                         onchange='" . $stringWithEmbeddedQuotes . "'>\r\n";
        $formatOptions = array('selectSomething' => '-- Select --',
                               'miniDV' => 'mini-DV',
                               '16mm' => '16 mm',
                               '8mm' => '8 mm',
                               'super8' => 'Super 8',
                               'hi8' => 'Hi-8',
                               'DVCAM' => 'DVCAM',
                               'HD' => 'High Definition Digital',
                               'HDV' => 'High Definition Video (HDV)',
                               'videoTape3-4' => '3/4&quot; videotape',
                               'motionCapture' => 'Digital Motion Capture',
                               'digitalAnimation' => 'Digital Post Animation',
                               'stopActionAnimation' => 'Stop Action Animation',
                               'other' => 'Other');
        // TODO need new fn in HTMLGen that calls displaySelectionOptions
          HTMLGen::displaySelectionOptions($formatOptions, $databaseState['originalFormat']); 
echo "                 </select>\r\n";
echo "               </div>\r\n";
echo "             </div>\r\n";
//<!--          <div style="float:left;"></div> -->
echo "           </div>\r\n";
    HTMLGen::addContributorWidgetsSection($dbContributorsState, 64, $disable); 
echo "          </div> <!-- id = End edEditWorkDiv -->\r\n";
  }
?>
<!-- </div> PURPLE -->
<!-- Other Credits TODO implement this.
                    <tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription"><a name="other"></a>Other Credits:</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole1" name="ContributorRole1" class="entryFormInputFieldShorter" maxlength="100"
											  value="<Xphp echo $_SESSION['ContributorRole1']; ?>" <Xphp if (!$validLogin) echo 'disabled'; ?> ></span><span class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName1" name="ContributorName1" class="entryFormInputFieldShorter" 
												maxlength="100" value="<Xphp echo $_SESSION['ContributorName1']; ?>" <Xphp if (!$validLogin) echo 'disabled'; ?> >
											</span><span class="smallBodyTextOnBlack">&nbsp;&nbsp;&nbsp;<a href="javascript:window.void(0)" onMouseOver="flyoverPopup('What are Other Roles? Examples of other roles are: Additional Editing, Camera, Camera & Editing, Cinematography, Dance Improvisation, Artistic Associate, Funding Source, Improvisational Dance, Videography, and Visual Creations.','#FFFF99')" 
												onMouseOut="killFlyoverPopup()" onClick="window.alert('Examples of other roles are: Additional Editing, Camera, Camera & Editing, Cinematography, Dance Improvisation, Artistic Associate, Funding Source, Improvisational Dance, Videography, and Visual Creations.')">What's 
												this?</a></span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">&nbsp;</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole2" name="ContributorRole2" class="entryFormInputFieldShorter" 
											  maxlength="100" value="<Xphp echo $_SESSION['ContributorRole2']; ?>" <Xphp if (!$validLogin) echo 'disabled'; ?> ></span><span 
												class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName2" name="ContributorName2" class="entryFormInputFieldShorter" 
												maxlength="100" value="<Xphp echo $_SESSION['ContributorName2']; ?>" <Xphp if (!$validLogin) echo 'disabled'; ?> >
											</span></td>
										</tr>
-->
<!-- End Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!--										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Other Festivals Shown:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="otherFestivals" name="OtherFestivals" 
											  class="entryFormInputField" value="<Xphp echo $_SESSION['OtherFestivals']; ?>" maxlength="200"
											  <Xphp if (!$validLogin) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Photo Credits:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="photoCredits" name="PhotoCredits" 
											  class="entryFormInputField" value="<Xphp echo $_SESSION['PhotoCredits']; ?>" maxlength="200"
											  <Xphp if (!$validLogin) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Web Site:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="webSite" name="WebSite" 
											class="entryFormInputField" value="<Xphp echo $_SESSION['WebSite']; ?>" maxlength="200"
											<Xphp if (!$validLogin) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="top">
											<td width="100" align="right" class="entryFormDescriptionTA">Brief Synopsis:</td>
											<td align="left" class="entryFormFieldTA"><textarea id="synopsis" name="Synopsis" rows="4" cols="20" 
											  class="entryFormTextAreaField" <Xphp if (!$validLogin) echo 'disabled'; ?> ><Xphp echo $_SESSION['Synopsis']; ?></textarea></td>
										</tr>
									</table></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading">Payment Information:<br><hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle"> TODO FIX RE-INITIALIZATION OF Payment RADIO BUTTONS 
                  <td align="left" class="entryFormField" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
  									type="radio" name="Payment" id="paypal" value="paypal" 
  	  								<Xphp if ($_SESSION["Payment"]!="check") echo "checked"; ?> ><label for="paypal" class="entryFormRadioButton"> Pay 
  	  								via PayPal</label>
                  <br>
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Payment" id="check" value="check"
									  <Xphp if ($_SESSION["Payment"]=="check") echo "checked"; ?> >
									  <label for="check" class="entryFormRadioButton"> Check or money order in US Dollars sent via post 
			  						  with media</label></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading">Release Information:<br><hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="medSmallBodyTextLeadedOnBlack">By clicking the Submit Button below, you certify that you hold
                    all necessary rights for the submission of this entry. Clicking Submit on this entry form gives Sans Souci Festival 
										permission for screening this submission at the Dairy Center for the Arts in Boulder Colorado USA on SEPT 20 &amp; 21, 2010 and also:
									</td>
                </tr>
                <tr align="left" valign="middle">
                  <td align="left" colspan="2" class="entryFormField"><table width="96%"  border="0" align="center" cellpadding="2" cellspacing="0"> 
                    <tr> TODO FIX RE-INITIALIZATION OF Permission RADIO BUTTONS 
                      <td align="right" valign="top"><input type="radio" name="Permission" id="allOK" value="allOK2010" 
                      <Xphp if ($_SESSION["Permission"]!="askMe2010") echo "checked"; ?> ></td>
                      <td align="left" valign="top" style="padding-top:4px;"><label for="allOK" class="entryFormRadioButton">All tours 
                          associated with the 2010 Season in the
                          US and elsewhere. (Sans Souci has previously toured in Mexico, Germany, and Trinidad.)</label></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><input type="radio" name="Permission" id="askMe" value="askMe2010"
                        <Xphp if ($_SESSION["Permission"]=="askMe2010") echo "checked"; ?>></td>
                      <td align="left" valign="top" style="padding-top:4px;"><label for="askMe" class="entryFormRadioButton">Please
                          invite me to each tour/venue separately so I  can respond to each individually. (Artists will be
                          invited to any additional venues as we make such arrangements.)</label></td>
                    </tr>
                  </table></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submit"></a>Submit this Form:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" align="center" colspan="2"><input type="submit" id="submit" name="Submit" value="        Submit        "></td>
                </tr>
              </table>
-->
                </div>  <!-- id = End ??????? -->
              </div> <!-- End entryFormSectionsDiv -->
            </form> <!-- End FORM -->
        </div> <!-- End encloseEntireFormDiv -->

<?php
// <!-- Div Control -------------------------------------------- >

        echo '<script type="text/javascript">hide("edLoginSectionDiv");</script>';
        // echo '<script type="text/javascript">show("edDataDiv");</script>';
        // echo '<script type="text/javascript">enableSelectors();</script>';
        echo '<script type="text/javascript">hide("edEditPersonDiv");</script>';
        // echo '<script type="text/javascript">hide("edCreatePersonDiv");</script>';
        echo '<script type="text/javascript">hide("edEditWorkDiv");</script>';
        // echo '<script type="text/javascript">hide("edCreateWorkDiv");</script>';
        if ($editingWork || $editingPerson || $creatingNewPerson || $creatingNewWork) {
          // echo '<script type="text/javascript">hide("edDataDiv");</script>';
          // echo '<script type="text/javascript">disableSelectors();</script>';
        }
        //echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
        // Note: using document.getElementById for these widgets is OK because they are all unique.
        if ($userLoggingIn) echo '<script type="text/javascript">'
                               . 'show("edLoginSectionDiv");'
                               . '</script>';
        if ($editingPerson) echo '<script type="text/javascript">'
                               . 'show("edEditPersonDiv");'
                               . '</script>';
        if ($creatingNewPerson) echo '<script type="text/javascript">'
//                                   . 'show("edCreatePersonDiv");'
                                   . ' </script>';
        if ($editingWork) echo '<script type="text/javascript">'
                                   . 'show("edEditWorkDiv");'
                                   . '</script>';
        if ($creatingNewWork) echo '<script type="text/javascript">'
//                                   . 'show("edCreateWorkDiv");'
                                   . '</script>';
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
<!-- InstanceEnd --></html>
