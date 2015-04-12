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
  $eventDescriptionShort = SSFRunTimeValues::getEventDescriptionStringShort(SSFRunTimeValues::getAssociatedEventId()); // 3/29/14 & 4/6/15
//  $eventDescriptionLong = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($associatedEventId));   // 3/29/14
  $eventDatesDescriptionStringShort = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $eventDatesDescriptionStringLong = SSFRunTimeValues::getEventDatesDescriptionStringLong($associatedEventId);

  SSFEntryForm::$entryRequirementsInWindowFilename = 'onlineEntryForm/entryRequirementsInWindow' . $currentYearString . '.php';
  SSFEntryForm::$formActionFileName = "onlineEntryForm/entryForm" . $currentYearString . ".php";
  SSFEntryForm::$danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
 
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
    - handle carriage returns in user input
    - fix the way control is exchanged between the entry form and the requirements window.
-->

<!-- Special DIVs for JavaScript ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
          <div id="dek"><script type="text/javascript">  initFlyoverPopup(); </script></div>

<!-- Javascript Functions moved to dataEntry.js 4/6/15 ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

          <div id="encloseEntireFormAreaDiv" class="entryFormSection" style="border:dashed 1px green;border:none;"> <!-- Optional debug border border:none; -->
            <script type="text/javascript"> window.name='SSFEntryFormWindow'; </script>

            <!-- From bolier plate -->
            <article id="<?php echo $articleId; ?>">
          
              <style type="text/css" scoped>
                .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
                .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; }
                .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
                .page { background-image: none; }
                .page .highlightedWordColor { color: <?php echo $programHighlightColor; ?>; }
                .page .highlightedTextColor { color: <?php echo $programHighlightColor; ?>; }
                .page .entryFormSection .programPageTitleText { color: <?php echo $secondaryTextColor; ?>; }
                .page .entryFormSubheading { color: <?php echo $quaternaryTextColor; ?>; }
                .page .bodyText { font-size: 14px; line-height: 130%; }
                .page .rowTitleTextWide { width:160px; }
              </style>
          
              <h1><?php echo $contentTitle; ?></h1>

<!-- begin FORM ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
              <!-- TODO Generalize action filename. -->
              <form class="ssfEntryForm" name="ssfEntryForm" id="ssfEntryForm" onSubmit="return preSubmitValidation();" action="<?php echo SSFEntryForm::$formActionFileName; ?>" method="post" style="border:2px dashed red;border:none;">  <!-- Optional debug border border:none; -->
<?php

// ++++ Initialization ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++
  $theForm = new SSFEntryForm();

  // Sign In?
  if ($theForm->signingIn()) $theForm->signIn(); 
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

  $theForm->DEBUGGER->belch('100 theForm->state', $theForm->state, -1); // SSFEntryForm::$displayDataStructures 4/5/15
  $theForm->DEBUGGER->belch('101 _POST', $_POST, 0);

// -- Initialize $dbPersonWorkState & $dbContributorsState  ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++

      $personIsSpecified = (isset($theForm->state['loginUserId']) && $theForm->state['loginUserId'] != 0);
      $workIdSelected = 0;
//      $atLeastOneWorkExistsForThisCallAndPerson = false;
      $earlyDeadlineHasPassed = SSFRunTimeValues::earlyDeadlineHasPassed();
      $finalDeadlineHasPassed = SSFRunTimeValues::finalDeadlineHasPassed();
      $theForm->DEBUGGER->becho('finalDeadlineHasPassed', (($finalDeadlineHasPassed) ? 'Final deadline passed' : 'Final deadline NOT passed.'), -1);
      $entryFeeAmount = (!$earlyDeadlineHasPassed) ? SSFRunTimeValues::getEarlyDeadlineFeeString() : SSFRunTimeValues::getFinalDeadlineFeeString();

      $indent = '                ';
      // Value for workExists is set immediately below.
      echo $indent . '<input type="hidden" id="workExists" name="workExists" value="">' . PHP_EOL; 

      if ($personIsSpecified) {
        $theForm->DEBUGGER->belch('611x $theForm->state', $theForm->state, -1);
        $theForm->initializeWorkDatabaseState();
        if (!$theForm->workIsSpecified()) { // That is, only the person is specified.
          $theForm->dbPersonWorkState = SSFQuery::selectPersonFor($theForm->state['loginUserId']);
          $theForm->DEBUGGER->belch('611 dbPersonWorkState', $theForm->dbPersonWorkState, -1);
          $theForm->atLeastOneWorkExistsForThisCallAndPerson = SSFQuery::submitterHasWorksForThisCall($theForm->state['loginUserId']);
          echo $indent . '<script type="text/javascript">document.getElementById("workExists").value = "' . $theForm->atLeastOneWorkExistsForThisCallAndPerson . '";</script>' . PHP_EOL;
          $theForm->DEBUGGER->becho('201 theForm->atLeastOneWorkExistsForThisCallAndPerson', $theForm->atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
      }
      // support for passing $dbPersonWorkState['email'] && $dbPersonWorkState['password'] & others to preSubmitValidation() - What a hack!
      echo $indent . '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($theForm->dbPersonWorkState['email']) ? $theForm->dbPersonWorkState['email'] : '') . '">' . PHP_EOL; 
      echo $indent . '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($theForm->dbPersonWorkState['password']) ? $theForm->dbPersonWorkState['password'] : '') . '">' . PHP_EOL; 
      // support for nickName & lastName & loginName
      echo $indent . '<input type="hidden" id="dbFirstName" name="dbFirstName" value="' . (isset($theForm->dbPersonWorkState['nickName']) ? $theForm->dbPersonWorkState['nickName'] : '') . '">' . PHP_EOL; 
      echo $indent . '<input type="hidden" id="dbLastName" name="dbLastName" value="' . (isset($theForm->dbPersonWorkState['lastName']) ? $theForm->dbPersonWorkState['lastName'] : '') . '">' . PHP_EOL; 
      echo $indent . '<input type="hidden" id="dbLoginName" name="dbLoginName" value="' . (isset($theForm->dbPersonWorkState['loginName']) ? $theForm->dbPersonWorkState['loginName'] : '') . '">' . PHP_EOL; 
      // support for computed full name
      echo $indent . '<input type="hidden" id="dbName" name="dbName" value="' . (isset($theForm->dbPersonWorkState['name']) ? $theForm->dbPersonWorkState['name'] : '') . '">' . PHP_EOL; 

$theForm->DEBUGGER->belch('503. theForm->state', $theForm->state, -1);
$theForm->DEBUGGER->becho('503. theForm->state["workSelector"]', $theForm->state['workSelector'], SSFEntryForm::$debugRefreshIssues);
$theForm->DEBUGGER->belch('503. $dbPersonWorkState', $theForm->dbPersonWorkState, -1); // SSFEntryForm::$displayDataStructures 4/5/15
$theForm->DEBUGGER->becho('503. personIsSpecified', $personIsSpecified, SSFEntryForm::$displayDataStructures);
$theForm->DEBUGGER->becho('503. theForm->workIsSpecified()', $theForm->workIsSpecified(), SSFEntryForm::$displayDataStructures);
?>

<!-- Begin loginSectionDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php 
  if ($theForm->state['userLoginUnderway']) {
    //$theForm->makeHiddenInputField('people_loginName'); Why is this here? 4/6/15
    $theForm->displayLoginSection();
    echo '        <script type="text/javascript">getUniqueElement("loginName").focus()</script>' . PHP_EOL;
  }
?>
<!-- End loginSectionDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin entryFormSectionsDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
                <div id = "entryFormSectionsDiv" class="entryFormSection" style="padding-bottom:10px;border:hotpink dashed 1px;border:none;"> <!-- Optional debug border border:none; -->
<?php
  $theForm->DEBUGGER->becho('502x theForm->state[userLoginUnderway]', $theForm->state['userLoginUnderway'], -1);
  if (!$theForm->state['userLoginUnderway']) {
//    echo '          <div class="programPageTitleText" style="float:none;">Entry Form, ' . $currentYearString . '</div>' . PHP_EOL; 
    echo '                  <div id = "entryFormInstructionsDiv" class="bodyText" style="text-align:left;padding:6px 8px 0px 8px;">To make a submission, complete this form adhering';
    // TODO Generalize Reqs Window
    echo ' to the ' . SSFEntryForm::getEntryRequirementsDisplayStringWithLink('Entry Requirements') . '. You may return later to print or edit this form by signing in again. ' ;
    echo (!$theForm->isDisplayingData()) ? ('Save your changes by clicking the ' 
                                            . (($theForm->isCreatingANewPerson() || $theForm->isCreatingANewWork()) ? "Submit" : "Save") . ' button.') : ''; 
    echo (($theForm->isEditingAWork()) ? ' Note that payment and release information is at the very bottom of the form.' : '');
    if ($theForm->isCreatingANewWork() || $theForm->isEditingAWork()) {
      echo ' Hover over or click any' . SSFHelp::getHTMLIconFor('help') . 'to get more information.';
    }
    echo '</div>' . PHP_EOL;
  }
?>
                  <div id='editSectionsContainer' style='margin:0 auto 0px auto;padding:0 8px;border:dashed cyan 1px;border:none;'> <!-- Optional debug border border:none; -->

<!-- Begin Data Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
                    <div id="edDataDiv">
<?php        
  if ($theForm->isDisplayingData()) { 
    $theForm->displayPersonInformation($personIsSpecified);
    $theForm->displayWorkSelector($entryFeeAmount, $finalDeadlineHasPassed);
    $theForm->displayWorkInformation();
  }
?>
                    </div> <!-- End edDataDiv -->
<!-- End Data Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->



<?php if ($theForm->isCreatingANewPerson()) {
      // TODO 
        echo "        <input type='hidden' name='people_relationship[]' id='Submitter' value='Submitter'>\r\n";
        echo "        <input type='hidden' name='people_relationship[]' id='Subscriber' value='Subscriber'>\r\n";
      }
?>

<!-- Begin Person Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php if ($theForm->isCreatingANewPerson()) { $theForm->displayPersonCreationForm(); }  ?> 
<!-- End Person Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Person Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if (($theForm->isEditingAPerson()) && isset($theForm->dbPersonWorkState['personId']) && $theForm->dbPersonWorkState['personId'] != null) {
//    echo '<div style="border:1px red dashed;border:none;">' . PHP_EOL; // <!-- Optional debug border -->
    $theForm->displayPersonEditForm();
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Person Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Work Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php 
  if ($theForm->isCreatingANewWork()) { 
    // Initialize parameters for the new work.
//    echo '<div style="border:1px red dashed;border:none;">' . PHP_EOL; // <!-- Optional debug border -->
    $theForm->dbPersonWorkState["howPaid"] = 'paypal'; 
    $theForm->dbPersonWorkState["permissionsAtSubmission"] = SSFRunTimeValues::getPermissionAllOKString();
    $theForm->displayWorkCreationForm(); 
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Work Creation ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

<!-- Begin Work Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if ($theForm->isEditingAWork() && isset($theForm->dbPersonWorkState['workId']) && $theForm->dbPersonWorkState['workId'] != null) { 
//    echo '<div id="debug" style="border:1px red dashed;">' . PHP_EOL; 
    $theForm->displayWorkEditForm(); 
//    echo '</div>' . PHP_EOL; 
  }
?>
<!-- End Work Edit ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

                  </div> <!-- editSectionsContainer -->

<!-- Thank You Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->
<?php
  if (($theForm->isDisplayingData() && $theForm->atLeastOneWorkExistsForThisCallAndPerson)) {
    echo '<div id="debug" style="border:1px red dashed;border:none;">' . PHP_EOL; 
    $theForm->displayThankYou();  
    echo '</div>' . PHP_EOL; 
  }
?> 
<!-- End Thank You Display ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

                </div> <!-- End entryFormSectionsDiv -->
        
<!-- Hidden Inputs to cache state ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

                <input type="hidden" id="people_name" name="people_name" value="<?php echo isset($theForm->dbPersonWorkState['name']) ? $theForm->dbPersonWorkState['name'] : ''; ?>">
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
        <!--        <?php // $theForm->DEBUGGER->belch("888 dbPersonWorkState", $theForm->dbPersonWorkState, -1); ?> -->
                <input type="hidden" id="editingPersonId" name="editingPersonId" value="<?php echo (isset($theForm->dbPersonWorkState['personId']) ? $theForm->dbPersonWorkState['personId'] : 0); ?>">
                <input type="hidden" id="editingWorkId" name="editingWorkId" value="<?php echo (isset($theForm->dbPersonWorkState['workId']) ? $theForm->dbPersonWorkState['workId'] : 0);?>">
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

              </form>  <!-- End FORM -->
            </article>
          </div> <!-- END encloseEntireFormAreaDiv -->
   
<!-- End encloseEntireFormAreaDiv ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ ++++ -->

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
  
  
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
