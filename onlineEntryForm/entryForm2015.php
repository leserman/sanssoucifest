<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $finalDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDescriptionShort = SSFRunTimeValues::getEventDescriptionStringShort(SSFRunTimeValues::getAssociatedEventId($associatedEventId)); // 3/29/14
//  $eventDescriptionLong = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($associatedEventId));   // 3/29/14
  $eventDatesDescriptionStringShort = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $eventDatesDescriptionStringLong = SSFRunTimeValues::getEventDatesDescriptionStringLong($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $formActionFileName = "onlineEntryForm/entryForm" . $currentYearString . ".php";
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
  $forceDisplayAllForW3CValidation = true;
 
  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
?>

<!--
  TODO
    - Add Name title
    - Add Title title
    - FIX title run time to Running time
    - make the text describe the input label better in
      ERROR:
      The password you entered does not match your Sign In Email Address.
      If you simply forgot your password, leave it blank and Sign In again.
      You'll receive more help after that.
    - 2015 Entry Form: Bad link for Payment Information http://dev.sanssoucifest.org/onlineEntryForm/entryForm2015.php
    - Add Subscribed to field to person display
    - Stop collecting phoneFax
    - Fix 3 occurances of <span style="color:#FFFF99;"> in callsForEntries.releaseInfoWidgetIntro
    - handle carriage returns in user input
-->


<!-- Special DIVs for JavaScript ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<div id="dek"><script type="text/javascript">  initFlyoverPopup(); </script></div>
<script type="text/javascript"> window.name='EntryFormWindow'; </script>

<!-- Javascript Functions ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<script type="text/javascript">

  function okToCreateNewWork() { return (document.getElementById('okToCreateNewWork').value == 1); }

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
    //alert('isChecked=|' + isChecked + '|  hiddenCacheWidget=|' + hiddenCacheWidget +
    //      '|  hiddenCacheWidget.value=|' + hiddenCacheWidget.value + '|  hiddenCacheWidget.checked=|' + hiddenCacheWidget.checked + '|');
    if (isChecked) { hiddenCacheWidget.value = '1'; }
    else { hiddenCacheWidget.value ='0'; }
  }

  function submitItsMe() {
//    alert('submitItsMe() value 1: ' + document.getElementById("itsMeSubmit").value);
    document.getElementById("itsMeSubmit").value="ItsMe";
//    alert('submitItsMe() value 2: ' + document.getElementById("itsMeSubmit").value);
    document.getElementById("ssfEntryForm").submit();
  }
  
  function resumeLogin() {
    document.getElementById('userLoginUnderway').value = 1;
  }

  // NOTE: For each hidden input is a corresponding value for hiddenInputSavingKey
  //  hidden input      hiddenInputSavingKey
  //  ++++++++++++      ++++++++++++++++++++
  //  saveNewPerson     savingNewPerson
  //  savePerson        savingPerson
  //  saveNewWork       savingNewWork
  //  saveWork          savingWork
  //  n/a               signingOff

  function cancelSubmit() { // TODO Desk check this function
//    alert('cancelSubmit');
    document.getElementById('hiddenInputSavingKey').value = 'Cancel';
    if (document.getElementById('saveNewPerson') !== null) { document.getElementById('saveNewPerson').value = ''; resumeLogin(); }
    if (document.getElementById('savePerson') !== null) { document.getElementById('savePerson').value = ''; }
    if (document.getElementById('saveNewWork') !== null) { document.getElementById('saveNewWork').value = ''; }
    if (document.getElementById('saveWork') !== null) { document.getElementById('saveWork').value = ''; }
    document.ssfEntryForm.submit();
  }

  function preSubmitValidation() {
    var usingAlertsForDebugging = false;
    var hiddenInputSavingKey = document.getElementById('hiddenInputSavingKey').value;
    if (document.getElementById(hiddenInputSavingKey) !== null) { document.getElementById(hiddenInputSavingKey).value = hiddenInputSavingKey; }
    if (usingAlertsForDebugging) { alert('hiddenInputSavingKey=' + hiddenInputSavingKey); }
    switch (hiddenInputSavingKey)
    {
      case '': valid = true; break;
      case 'signingOff': valid = true; break;
      case 'Cancel': valid = true; break;
      case 'savingNewPerson': valid = (personNameIsUnique()) ? validPersonCreation() : false; break;
      case 'savingPerson': valid = validPersonEntry(); break;
      case 'savingNewWork': valid = computeRunTimeAndValidateWorkEntry(); break;
      case 'savingWork': valid = computeRunTimeAndValidateWorkEntry();  break;
    }
    if (usingAlertsForDebugging) { alert('hiddenInputSavingKey is' + ((valid) ? '' : ' not') + ' valid'); } 
    return valid; 
  }
  
</script>

<!-- Switch from table-based formatting to primarily DIV-based formatting ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

   <div id="encloseEntireFormDiv" class="entryFormSection" style="border:dashed 1px green;">
<!-- From bolier plate -->
          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
              .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; }
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
              .page { background-image: none; }
              .page .highlightedWordColor { color: <?php echo $programHighlightColor; ?>; }
              .page .highlightedTextColor { color: <?php echo $programHighlightColor; ?>; }
              .page .entryFormSubheading { color: <?php echo $quaternaryTextColor; ?>; }
              .page .bodyText { font-size: 14px; line-height: 130%; }
              .page .rowTitleTextWide { width:160px; }
            </style>

            <h1><?php echo $contentTitle; ?></h1>

                                     
<!-- begin FORM ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
      <!-- TODO Generalize action filename. -->
      <form class="ssfEntryForm" name="ssfEntryForm" id="ssfEntryForm" onSubmit="return preSubmitValidation();" action="<?php echo $formActionFileName; ?>" method="post"> 

<?php
// ++++ Initialization ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++
  $theForm = new SSFEntryForm();

  // Sign In?
  if ($theForm->signingIn()) $theForm->signIn(); //  || $forceDisplayAllForW3CValidation
  $theForm->DEBUGGER->becho('theForm->isCreatingANewPerson 0', $theForm->isCreatingANewPerson(), SSFEntryForm::$debugStateVariablesAtTop);
  $theForm->bechoStateVarialbes(SSFEntryForm::$debugStateVariablesAtTop);

//-- Process User Actions ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
//-- Process User Actions ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
//-- Process User Actions ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

// Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ 

/* TODO: Before saving, use __TABLE__lastModificationDate to verify that data has not changed since read.
         works_, people_, workContributors_LastModified need to be set from DB at read-time & used to check 
         that update from this form is still valid. That is, OK if LastModified value == DB value; otherwise, 
         tell user they cannot submit from this form and must login again. */

  // Allow the user to Sign Off 
  // We never get here because the page is loaded by the 1st PHP statement above.
  // 4/1/12 We do get here if the user actually is signing off.
  if ($theForm->userIsSigningOff()) {
    $theForm->DEBUGGER->becho('*** NOTICE/ERROR 10 theForm->userIsSigningOff', $theForm->userIsSigningOff(), -1);
    $theForm->state['userLoginUnderway'] = 1;
    $theForm->state['people_personId'] = 0;
    $theForm->state['loginUserId'] = 0;
    $theForm->state['loginPasswordCache'] = '';
    $theForm->state['submitterInPeopleTable'] = 0;
    $theForm->state['subscriberInPeopleTable'] = 0;
    $theForm->state['userAction'] = ''; // 4/1/12
  }

  // Primary switch for user action.
  if (isset($theForm->state['hiddenInputSavingKey'])) {        // Ah, what to do? What to do?
    switch ($theForm->state['hiddenInputSavingKey']) {
      case 'savingNewPerson': $theForm->insertPerson(); break; // Insert a newly created person
      case 'savingPerson':    $theForm->updatePerson(); break; // Save an updated person
      case 'savingNewWork':   $theForm->insertWork(); break;   // Insert a newly created work
      case 'savingWork':      $theForm->updateWork(); break;   // Save an updated work
    }
  }

  $theForm->DEBUGGER->belch('100 theForm->state', $theForm->state, SSFEntryForm::$displayDataStructures);
  $theForm->DEBUGGER->belch('101 _POST', $_POST, 0);

// -- Initialize $dbPersonWorkState & $dbContributorsState  ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++

      $personIsSpecified = (isset($theForm->state['loginUserId']) && $theForm->state['loginUserId'] != 0);
      $workIdSelected = 0;
      $dbPersonWorkState = array();
      $dbContributorsState = array();
//      $atLeastOneWorkExistsForThisCallAndPerson = false;
      $earlyDeadlineHasPassed = SSFRunTimeValues::earlyDeadlineHasPassed();
      $finalDeadlineHasPassed = SSFRunTimeValues::finalDeadlineHasPassed();
      $theForm->DEBUGGER->becho('finalDeadlineHasPassed', (($finalDeadlineHasPassed) ? 'Final deadline passed' : 'Final deadline NOT passed.'), -1);
      $entryFeeAmount = (!$earlyDeadlineHasPassed) ? SSFRunTimeValues::getEarlyDeadlineFeeString() : SSFRunTimeValues::getFinalDeadlineFeeString();

      // Value for workExists is set immediately below.
      echo '<input type="hidden" id="workExists" name="workExists" value="">' . PHP_EOL; 

      // This function uses and side-effects global variables
      function initializeWorkDatabaseState($theForm) {
        global $dbPersonWorkState, $dbContributorsState; // out     // $atLeastOneWorkExistsForThisCallAndPerson
        $theForm->DEBUGGER->becho('600 theForm->state[workSelector]', $theForm->state['workSelector'], -1);
        if ($theForm->workIsSpecified()) {
          $dbPersonWorkState = SSFQuery::selectSubmitterAndWorkNoCommsFor($theForm->state['workSelector']); 
          $theForm->DEBUGGER->belch('600 dbPersonWorkState', $dbPersonWorkState, -1);
          $dbContributorsState = SSFQuery::selectContributorsFor($theForm->state['workSelector']);  
          $theForm->atLeastOneWorkExistsForThisCallAndPerson = true;
          $theForm->DEBUGGER->becho('600 theForm->atLeastOneWorkExistsForThisCallAndPerson', $theForm->atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
        echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $theForm->atLeastOneWorkExistsForThisCallAndPerson . '";</script>' . PHP_EOL;
      }

      if ($personIsSpecified) {
        $theForm->DEBUGGER->belch('611x $theForm->state', $theForm->state, -1);
        initializeWorkDatabaseState($theForm);
        if (!$theForm->workIsSpecified()) { // That is, only the person is specified.
          $dbPersonWorkState = SSFQuery::selectPersonFor($theForm->state['loginUserId']);
          $theForm->DEBUGGER->belch('611 dbPersonWorkState', $dbPersonWorkState, -1);
          $theForm->atLeastOneWorkExistsForThisCallAndPerson = SSFQuery::submitterHasWorksForThisCall($theForm->state['loginUserId']);
          echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $theForm->atLeastOneWorkExistsForThisCallAndPerson . '";</script>' . PHP_EOL;
          $theForm->DEBUGGER->becho('201 theForm->atLeastOneWorkExistsForThisCallAndPerson', $theForm->atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
      }

      // support for passing $dbPersonWorkState['email'] && $dbPersonWorkState['password'] & others to preSubmitValidation() - What a hack!
      echo '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($dbPersonWorkState['email']) ? $dbPersonWorkState['email'] : '') . '">' . PHP_EOL; 
      echo '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($dbPersonWorkState['password']) ? $dbPersonWorkState['password'] : '') . '">' . PHP_EOL; 
      // support for nickName & lastName & loginName
      echo '<input type="hidden" id="dbFirstName" name="dbFirstName" value="' . (isset($dbPersonWorkState['nickName']) ? $dbPersonWorkState['nickName'] : '') . '">' . PHP_EOL; 
      echo '<input type="hidden" id="dbLastName" name="dbLastName" value="' . (isset($dbPersonWorkState['lastName']) ? $dbPersonWorkState['lastName'] : '') . '">' . PHP_EOL; 
      echo '<input type="hidden" id="dbLoginName" name="dbLoginName" value="' . (isset($dbPersonWorkState['loginName']) ? $dbPersonWorkState['loginName'] : '') . '">' . PHP_EOL; 
      // support for computed full name
      echo '<input type="hidden" id="dbName" name="dbName" value="' . (isset($dbPersonWorkState['name']) ? $dbPersonWorkState['name'] : '') . '">' . PHP_EOL; 

$theForm->DEBUGGER->belch('503. theForm->state', $theForm->state, -1);
$theForm->DEBUGGER->becho('503. theForm->state["workSelector"]', $theForm->state['workSelector'], SSFEntryForm::$debugRefreshIssues);
$theForm->DEBUGGER->belch('503. $dbPersonWorkState', $dbPersonWorkState, SSFEntryForm::$displayDataStructures);
$theForm->DEBUGGER->becho('503. personIsSpecified', $personIsSpecified, SSFEntryForm::$displayDataStructures);
$theForm->DEBUGGER->becho('503. theForm->workIsSpecified()', $theForm->workIsSpecified(), SSFEntryForm::$displayDataStructures);

?>
                                     
<!-- begin FORM ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php // $asterisk = HTMLGen::requiredFieldString(); commented out 4/3/15 ?>


<!-- Begin loginSectionDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php if ($theForm->state['userLoginUnderway']) { // || $forceDisplayAllForW3CValidation
//$theForm->makeHiddenInputField('people_loginName');
echo '        <div id="edLoginSectionDiv">' . PHP_EOL;
echo '          <table style="width:100%;border:none;text-align:center;margin:0;padding:0;">' . PHP_EOL;
echo '            <tr>' . PHP_EOL;
echo '              <td class="programPageTitleText bottomCenter" style="padding-top:24px;">Sign In / Register</td>' . PHP_EOL;
echo '            </tr>' . PHP_EOL;
echo '            <tr>' . PHP_EOL;
echo '              <td class="middleCenter" style="height:30px;"><hr class="horizontalSeparator1" style="vertical-align:middle;height:1px;border-width:0;"></td>' . PHP_EOL;
echo '            </tr>' . PHP_EOL;
echo '            <tr>' . PHP_EOL;
echo '              <td style="text-align:center;"> ' . PHP_EOL;
        if ($theForm->state['userLoginUnderway']) { 
            echo '<div class="bodyText" '
             . 'style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 6px 4px;color:' . $programHighlightColor . ';">'
             . $theForm->openErrorMessage . '</div>';
        }
        $showLoginBlurb = $theForm->state['userLoginUnderway'] && (!isset($theForm->openErrorMessage) || $theForm->openErrorMessage == '');
        $loginBlurb = 'Sans Souci, an international festival of dance cinema, invites and encourages submissions from all artists regardless of' 
                    . ' credentials and affiliations. Accepted works will be screened ' . $eventDescriptionShort
/*                  . 'Additionally, with your permission, your work may tour to other venues around the U.S. and elsewhere.' */
                    . 'For more information see our <a class="dodeco" href="' . $danceCinemaCallFilename . '">'
                    . 'Call for Entries</a> and our ' . SSFEntryForm::entryRequirementsDisplayString();
echo '              </td>' . PHP_EOL;
echo '            </tr>' . PHP_EOL;
echo '            <tr>' . PHP_EOL;
echo '              <td class="middleCenter bodyTextWithEmphasis">' . PHP_EOL;
        if ($showLoginBlurb) echo '<div class="bodyText" style="text-align:left;padding:0px 54px 24px 64px;">' . $loginBlurb . '.</div>' . PHP_EOL;
echo '                <table style="text-align:center;width:100%;border:none;margin:0;padding:0;">' . PHP_EOL;
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in or register here.</td></tr>' . PHP_EOL;
echo '                  <tr>' . PHP_EOL;
echo '                    <td class="entryFormDescription" style="width:242px;height:28px;text-align:right;"> ' . PHP_EOL;
echo '                      <a class="dodeco" href="javascript:window.void(0)" onMouseOver="flyoverPopup(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')"' . PHP_EOL;
echo '                        onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')">Email / Login Name</a>: </td>' . PHP_EOL;
echo '                    <td class="entryFormField" style="height:28px;text-align:left;"><input type="text" name="loginName" id="loginName" ' . PHP_EOL;
echo '                         value="' . $theForm->state['loginName'] . '" ' . "onKeyPress='return submitEnter(this, event)'" . PHP_EOL;
echo '                         onchange="document.getElementById(' . HTMLGen::simpleQuote('people_loginName') . ').value=this.value"' . PHP_EOL;
echo '                         class="entryFormInputFieldShort" maxlength="100">' . PHP_EOL;
echo '                         <!-- onBlur="ValidEmail(this);" -->' . PHP_EOL;
echo '                    </td>' . PHP_EOL;
echo '                  </tr>' . PHP_EOL;
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0;">If you have a password and you know what it is, enter it below.</td></tr>' . PHP_EOL;
echo '                  <tr>' . PHP_EOL;
echo '                    <td class="entryFormDescription" style="height:28px;text-align:right;">Password: </td>' . PHP_EOL;
echo '                    <td class="entryFormField" style="height:28px;text-align:left;"><input type="password" name="pwFromLogin" id="pwFromLogin" ' . PHP_EOL;
echo '                       value="' . $theForm->state['pwFromLogin'] . '" class="entryFormInputFieldShorter" maxlength="100"><span ' . PHP_EOL;
echo '                       class="entryFormDescription"> (leave blank if unknown)</span></td>' . PHP_EOL;
echo '                  </tr>' . PHP_EOL;
echo '                  <tr>' . PHP_EOL;
echo '                    <td colspan="2" style="padding:10px 0 16px 0;height:28px;text-align:center;"><input type="submit" id="signInSubmit" name="signInSubmit" value="Sign In"></td>' . PHP_EOL;
echo '                  </tr>' . PHP_EOL;
echo '                </table>' . PHP_EOL;
echo '              </td>' . PHP_EOL;
echo '            </tr>' . PHP_EOL;
echo '          </table>' . PHP_EOL;
echo '        </div> <!-- End edLoginSectionDiv -->' . PHP_EOL;
echo '        <script type="text/javascript">getUniqueElement("loginName").focus()</script>' . PHP_EOL;
} 
?>
<!-- End loginSectionDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin entryFormSectionsDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
        <div id = "entryFormSectionsDiv" class="entryFormSection" style="padding-bottom:10px;border:hotpink dashed 1px;">
<?php
  $theForm->DEBUGGER->becho('502x theForm->state[userLoginUnderway]', $theForm->state['userLoginUnderway'], -1);
  if (!$theForm->state['userLoginUnderway']) { // || $forceDisplayAllForW3CValidation
//    echo '          <div class="programPageTitleText" style="float:none;">Entry Form, ' . $currentYearString . '</div>' . PHP_EOL; 
    echo '          <div id = "entryFormInstructionsDiv" class="bodyText" style="text-align:left;padding:6px 8px 0px 8px;">To';
    echo ' make a submission, complete this form adhering';
    // TODO Generalize Reqs Window
    echo ' to the ' . SSFEntryForm::entryRequirementsDisplayString() . '. You may return later to print or edit this form by signing in again. ' ;
    echo (!$theForm->isDisplayingData()) ? ('Save your changes by clicking the ' 
                                            . (($theForm->isCreatingANewPerson() || $theForm->isCreatingANewWork()) ? "Submit" : "Save") . ' button.') : ''; 
    echo (($theForm->isEditingAWork()) ? ' Note that payment and release information is at the very bottom of the form.' : '') . PHP_EOL;
    if ($theForm->isCreatingANewWork() || $theForm->isEditingAWork()) {
      echo ' Hover over or click any' . SSFHelp::getHTMLIconFor('help') . 'to get more information.' . PHP_EOL;
    }
    echo '          </div>' . PHP_EOL;
  }
?>
          <div id='editSectionsContainer' style='margin:0 auto 10px auto;padding:0 8px;border:dashed cyan 1px;'>

<!-- Begin Data Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
        <div id="edDataDiv">
<?php        
  if ($theForm->isDisplayingData()) { //  || $forceDisplayAllForW3CValidation
    SSFEntryForm::displayPersonInformation($personIsSpecified, $dbPersonWorkState);
    SSFEntryForm::displayWorkSelector($theForm, $entryFeeAmount, $finalDeadlineHasPassed);
    SSFEntryForm::displayWorkInformation($theForm, $dbPersonWorkState, $dbContributorsState);
  }
?>
        </div> <!-- End edDataDiv -->
<!-- End Data Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->


<!-- Hidden Inputs to cache state ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

        <input type="hidden" id="people_name" name="people_name" value="<?php echo isset($dbPersonWorkState['name']) ? $dbPersonWorkState['name'] : ''; ?>">
        <input type="hidden" id="works_submitter" name="works_submitter" value="<?php echo isset($theForm->state['loginUserId']) ? $theForm->state['loginUserId'] : ''; ?>">
        <input type="hidden" id="works_runTime" name="works_runTime" value="<?php echo isset($theForm->state['works_runTime']) ? $theForm->state['works_runTime'] : '00:00:00'; ?>">
        <input type="hidden" id="works_titleForSort" name="works_titleForSort" value="<?php echo isset($theForm->state['works_titleForSort']) ? $theForm->state['works_titleForSort'] : ''; ?>">
        <input type="hidden" id="works_amtPaid" name="works_amtPaid" value="<?php echo $entryFeeAmount;?>">
        <input type="hidden" id="loginNameSaved" name="loginNameSaved" value="<?php echo isset($theForm->state['loginNameSaved']) ? $theForm->state['loginNameSaved'] : ''; ?>" > 
        <input type="hidden" id="loginUserId" name="loginUserId" value="<?php echo $theForm->state['loginUserId']; ?>" > 
        <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $theForm->state['workSelector']?>">
        <input type="hidden" id="entryId" name="entryId" value="<?php echo $theForm->state['entryId']; ?>" > 
        <input type="hidden" id="passwordEntryRequired" name="passwordEntryRequired" value="<?php echo $theForm->state['passwordEntryRequired']; ?>" > 
        <input type="hidden" id="userLoginUnderway" name="userLoginUnderway" value="<?php echo $theForm->state['userLoginUnderway']; ?>" > 
        <input type="hidden" id="submitterInPeopleTable" name="submitterInPeopleTable" value="<?php echo $theForm->state['submitterInPeopleTable']; ?>" > 
        <input type="hidden" id="subscriberInPeopleTable" name="subscriberInPeopleTable" value="<?php echo $theForm->state['subscriberInPeopleTable']; ?>" > 
        <?php $theForm->DEBUGGER->belch("888 dbPersonWorkState", $dbPersonWorkState, -1); ?>
        <input type="hidden" id="editingPersonId" name="editingPersonId" value="<?php echo (isset($dbPersonWorkState['personId']) ? $dbPersonWorkState['personId'] : 0); ?>">
        <input type="hidden" id="editingWorkId" name="editingWorkId" value="<?php echo (isset($dbPersonWorkState['workId']) ? $dbPersonWorkState['workId'] : 0);?>">
        <input type="hidden" id="maxContributorOrder" name="maxContributorOrder" value="<?php echo $theForm->state['maxContributorOrder']; ?>" > 
        <input type="hidden" id="workLastModified" name="workLastModified" value="<?php echo $theForm->state['workLastModified']; ?>" >
        <input type="hidden" id="personLoggedInLastModified" name="personLoggedInLastModified" value="<?php echo $theForm->state['personLoggedInLastModified']; ?>" >
        <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($theForm->state['changeCount']) ? $theForm->state['changeCount'] : 0; ?>">
        <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($theForm->state['personChangeCount']) ? $theForm->state['personChangeCount'] : 0; ?>">
        <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($theForm->state['entryChangeCount']) ? $theForm->state['entryChangeCount'] : 0; ?>">
        <input type="hidden" id="hiddenInputSavingKey" name="hiddenInputSavingKey" value="">
        <input type="hidden" id="okToCreateNewWork" name="okToCreateNewWork" value="<?php echo (($finalDeadlineHasPassed == 1) ? 0 : 1); ?>">
        <!-- TODO: See selectorSubmitter notes in _SansSouciTODOs.txt. -->
        <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> 

<?php if ($theForm->isCreatingANewPerson()) { // || $forceDisplayAllForW3CValidation
      // TODO 
        echo "        <input type='hidden' name='people_relationship[]' id='Submitter' value='Submitter'>\r\n";
        echo "        <input type='hidden' name='people_relationship[]' id='Subscriber' value='Subscriber'>\r\n";
      }
?>

<!-- Begin Person Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php if ($theForm->isCreatingANewPerson()) { SSFEntryForm::displayPersonCreationForm($theForm); } //  || $forceDisplayAllForW3CValidation ?> 
<!-- End Person Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Person Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if (($theForm->isEditingAPerson()) && isset($dbPersonWorkState['personId']) && $dbPersonWorkState['personId'] != null) { //   || $forceDisplayAllForW3CValidation
//    echo '<div style="border:1px red dashed;border:none;">' . PHP_EOL; 
    SSFEntryForm::displayPersonEditForm($theForm, $dbPersonWorkState);
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Person Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Work Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php 
  if ($theForm->isCreatingANewWork()) { //  || $forceDisplayAllForW3CValidation
    // Initialize parameters for the new work.
//    echo '<div style="border:1px red dashed;border:none;">' . PHP_EOL; 
    $dbPersonWorkState["howPaid"] = 'paypal'; 
    $dbPersonWorkState["permissionsAtSubmission"] = SSFRunTimeValues::getPermissionAllOKString();
    SSFEntryForm::displayWorkCreationForm($theForm, $dbPersonWorkState, $dbContributorsState); 
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Work Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Work Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if ($theForm->isEditingAWork() && isset($dbPersonWorkState['workId']) && $dbPersonWorkState['workId'] != null) {  // || $forceDisplayAllForW3CValidation
//    echo '<div id="debug" style="border:1px red dashed;">' . PHP_EOL; 
    SSFEntryForm::displayWorkEditForm($theForm, $dbPersonWorkState, $dbContributorsState); 
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Work Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

                </div>  <!-- editSectionsContainer -->

<!-- Thank You Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if (($theForm->isDisplayingData() && $theForm->atLeastOneWorkExistsForThisCallAndPerson)) { // || $forceDisplayAllForW3CValidation
//    echo '<div id="debug" style="border:1px red dashed;">' . PHP_EOL; 
    SSFEntryForm::displayThankYou($theForm, $dbPersonWorkState);  
//    echo '</div>' . PHP_EOL; 
  }
?> 
<!-- End Thank You Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

              </div> <!-- End entryFormSectionsDiv -->
            </form> <!-- End FORM -->
          </article>
   </div>
<!-- End encloseEntireFormDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<?php

  $theForm->bechoStateVarialbes(SSFEntryForm::$debugStateVariablesAtBottom);

  // <!-- Div Control ++++++++++++++++++++++++++++++++++++++++++++ >
  if ($theForm->isDisplayingData()) {
    echo '<script type="text/javascript">show("edDataDiv");</script>' . PHP_EOL;
    echo '<script type="text/javascript">enableSelectors();</script>' . PHP_EOL;
  } else {
    echo '<script type="text/javascript">hide("edDataDiv");</script>' . PHP_EOL;
    echo '<script type="text/javascript">disableSelectors();</script>' . PHP_EOL;
  }
  echo '<script type="text/javascript">if (!okToCreateNewWork()) { disable("createNewWork"); }</script>' . PHP_EOL;
  // <!-- End Div Control ++++++++++++++++++++++++++++++++++++++++++++ >
  
?>


<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
