<?php
  
  // class SSFEntryForm saves entry form state.
  
  // NOTE: For each hidden input is a corresponding value for hiddenInputSavingKey
  //  hidden input      hiddenInputSavingKey
  //  ++++++++++++      ++++++++++++++++++++
  //  saveNewPerson     savingNewPerson
  //  savePerson        savingPerson
  //  saveNewWork       savingNewWork
  //  saveWork          savingWork
  //  n/a               signingOff

  class SSFEntryForm {
    // strings, tools, & metadata
    public $openErrorMessage = '';
    public $DEBUGGER;
    public $validLogin = false;
    public $personCreationRedo = false;
    public $userEnteredEmailAddressAlreadyInUse = false;
    public $possibleDuplicatesString = '';
    private $creatingNewPerson = false;
    private $editingPerson = false;
    
    // Section titles and other statics
    private static $basicsLeader = 'The Basics';
    private static $creditsLeader = 'Credits';
    private static $eSubmissionLeader = 'Electronic Media Submission Information';
    private static $formatsLeader = 'Format Information';
    private static $otherLeader = 'Other Stuff';
    private static $notificationQuestion = 'Would you like to be notified of future Calls for Entries? Screening Events?';

  
    // State
    // $state could be split into multiple arrays, e.g., metaData, workFields, submitterFields, paFields, ...
    public $state = array(); 
    public $atLeastOneWorkExistsForThisCallAndPerson = false;
    public $callForEntriesId = 0;

    // ++++ Debugger setup ++++ ++++ ++++ ++++ 
    static public $anamorphicDebug = -1;
    static public $displayDataStructures = -1;
    static public $debugChangeCount = -1; // 5/30/14 changed and changed back
    static public $debugLoginName = -1;
    static public $debugPeopleLoginName = -1;
    static public $debugPhpValidEmailAddress = -1;
    static public $debugRefreshIssues = -1;
    static public $debugSignIn = -1;
    static public $debugStateVariablesAtBottom = -1;
    static public $debugStateVariablesAtTop = -1;
    static public $debugValidLogin = -1;
    private static $showFunctionMarkers = true;

    public static function displayEditDivHeader_2($divIdString, $title, $saveButtonName, $saveButtonNameId, 
                                                  $hiddenInputSavingId, $cancelButtonNameId) {
  //    $saveButtonGenId = HTMLGen::genId($saveButtonNameId); TODO Maybe it was a mistake to gen these ids? 3/19/10
      $saveButtonGenId = $saveButtonNameId;
      $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
  //    $onClickScript = "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'";
      $onClickScript = 'document.getElementById("hiddenInputSavingKey").value="' . $hiddenInputSavingId . '";';
      echo "          <div id='" . $divIdString . "' class='entryFormSection'>\r\n";
      echo "            <div class='entryFormSectionHeading'>\r\n";
      echo "              <div style='float:left;padding-top:4px;padding-bottom:2px;'>" . $title . "</div>\r\n";
      echo "              <div style='float:right;padding-right:4px;padding-bottom:2px;'>\r\n";
      echo "                <input type='submit' id='" . $saveButtonGenId . "' name='" 
                                                       . $saveButtonNameId . "' value='" . $saveButtonName . "'"
  //                                                   . " onclick='document.pressed=this.name;'"
                                                       . " onclick=" . HTMLGen::simpleQuote($onClickScript)
                                                       . ">\r\n";
      echo "                <input type='button' id='" . $cancelButtonGenId . "' name='" 
                                                       . $cancelButtonNameId . "' value='Cancel'"
                                                       . " onclick='document.pressed=this.value;cancelSubmit()'>\r\n";
  //    echo "                <script type='text/javascript'>document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . "';</script>\r\n";
      echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";
      echo "              </div>\r\n";
      echo "              <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
      echo "            </div>\r\n";
    }
  
    public static function displayEditSectionFooter($title, $saveButtonName, $saveButtonNameId, 
                                                  $hiddenInputSavingId, $cancelButtonNameId='') {
      $saveButtonGenId = HTMLGen::genId($saveButtonNameId);
      $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
  //    $onClickScript = "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'";
      $onClickScript = 'document.getElementById("hiddenInputSavingKey").value="' . $hiddenInputSavingId . '";';
      echo "            <div class='entryFormSectionHeading'>\r\n";
      echo "              <div style='float:left;padding-top:4px;padding-bottom:4px;'>" . $title . "</div>\r\n";
      echo "              <div style='float:right;padding-right:4px;padding-bottom:2px;'>\r\n";
      echo "                <input type='submit' id='" . $saveButtonGenId . "' name='" 
                                                       . $saveButtonNameId . "' value='" . $saveButtonName . "'"
  //                                                     . " onclick='document.pressed=this.name;'"
  //                                                     . "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'"
                                                       . " onclick=" . HTMLGen::simpleQuote($onClickScript)
                                                       . ">\r\n";
      if ($cancelButtonNameId != '')
        echo "                <input type='button' id='" . $cancelButtonGenId . "' name='" 
                                                         . $cancelButtonNameId . "' value='Cancel'"
                                                         . " onclick='document.pressed=this.value;cancelSubmit()'>\r\n";
  //    echo "                <script type='text/javascript'>document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . "';</script>\r\n";
  //    echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";
      echo "              </div>\r\n";
      echo "              <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
      echo "            </div>\r\n";
    }
  
    public static function addReleaseInfoWidgetsSection($dataArray, $saveButtonName, $disable=false) {
      $allOKId = HTMLGen::genId('allOK');
      $askMeId = HTMLGen::genId('askMe');
      $allOKString = SSFRunTimeValues::getPermissionAllOKString();
      $askMeString = SSFRunTimeValues::getPermissionAskMeString();
      if (self::$showFunctionMarkers) echo "<!-- addReleaseInfoWidgetsSection -->\r\n";
      $releaseInfoWidgetIntroString = str_replace('<saveButtonName>', $saveButtonName, SSFRunTimeValues::getReleaseInfoWidgetIntroString());
      echo '                 <div class="entryFormSubheading" style="padding-top:15px;padding-bottom:4px;">Release Information' . self::asterisk() . '</div>';
      echo'                  <div class="widgetText1">' . $releaseInfoWidgetIntroString;
      echo'                  </div>' . PHP_EOL;
      echo'                  <div class="entryFormField">' . PHP_EOL;
      echo'                    <table style="width:98%;border:none;text-align:left;padding:2px;margin:0;"> ' . PHP_EOL;
      echo'                      <tr>' . PHP_EOL;
      echo'                        <td class="entryFormRadioButton" style="text-align:right;vertical-align:top;padding-left:38px;padding-right:7px;"><input type="radio" name="works_permissionsAtSubmission" id="' . $allOKId . '" value="' . $allOKString . '" ';
            if (isset($dataArray["permissionsAtSubmission"]) && ($dataArray["permissionsAtSubmission"]==$allOKString)) echo ' checked="checked"';
            if ($disable) echo " disabled='disabled'"; // added 5/5/14
      echo' onchange="userMadeAChange(1);"></td>' . PHP_EOL;
      echo'                        <td style="text-align:left;vertical-align:top;padding-top:4px;"><label for="' . $allOKId . '" class="entryFormRadioButtonLabel">';
      echo                                                                         SSFRunTimeValues::getReleaseInfoWidgetAllOKString() . "</label></td>\r\n";
      echo'                      </tr>' . PHP_EOL;
      echo'                      <tr>' . PHP_EOL;
      echo'                        <td class="entryFormRadioButton" style="text-align:right;vertical-align:top;padding-left:38px;padding-right:7px;"><input type="radio" name="works_permissionsAtSubmission" id="' . $askMeId . '" value="' . $askMeString . '"';
            if (isset($dataArray["permissionsAtSubmission"]) && ($dataArray["permissionsAtSubmission"]==$askMeString)) echo ' checked="checked"';
            if ($disable) echo " disabled='disabled'"; // added 5/5/14
      echo' onchange="userMadeAChange(1);"></td>' . PHP_EOL;
      echo'                        <td style="text-align:left;vertical-align:top;padding-top:4px;"><label for="' . $askMeId . '" class="entryFormRadioButtonLabel">';
      echo                                                                         SSFRunTimeValues::getReleaseInfoWidgetAskMeString() . "</label></td>\r\n";
      echo'                      </tr>' . PHP_EOL;
      echo'                    </table>' . PHP_EOL;
      echo'                  </div>' . PHP_EOL;
      echo '                 <div style="clear:both;"></div>' . PHP_EOL;
      if (self::$showFunctionMarkers) echo "<!-- END addReleaseInfoWidgetsSection -->\r\n";
    }
    
    public static function addPaymentWidgetsSection($dataArray, $disable=false) {
      $paypalId = HTMLGen::genId('paypal');
      $checkId = HTMLGen::genId('check');
      SSFDebug::globalDebugger()->becho('addPaymentWidgetsSection() dataArray[howPaid]', (isset($dataArray["howPaid"])) ? $dataArray["howPaid"] : 'not set', -1);
      SSFDebug::globalDebugger()->belch('addPaymentWidgetsSection() dataArray', $dataArray, -1);
      if (self::$showFunctionMarkers) echo "<!-- addPaymentWidgetsSection -->\r\n";
      $decoration = ($disable)  ? '' : self::asterisk();
      echo '                 <div class="entryFormSubheading" style="padding-top:15px;padding-bottom:4px;">Payment Information' . $decoration . '</div>';
      if ($dataArray["howPaid"]=="waived") {
      echo'                  <div class="widgetText1">Entry Fee Waived</div>' . PHP_EOL;
      } else {
        echo'                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="' . $paypalId . '" value="paypal"';
              if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="paypal")) echo " checked='checked'";
              if ($disable || (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="waived"))) echo " disabled='disabled'"; // added 7/24/10
        echo' onchange="userMadeAChange(1);">' . PHP_EOL;
        // Aborted appempt to add paypal payment capability on the Work Edit screen. 
        // This is not practical, because if the user changed the film title, I don't know what it is.
        $payPalPmtString = '';
        echo'                    <label for="' . $paypalId . '" class="entryFormRadioButton"> Pay via PayPal ' . $payPalPmtString . '</label>' . PHP_EOL;
        echo'                  </div>' . PHP_EOL;
        echo'                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="' . $checkId . '" value="check"' . PHP_EOL;
              if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="check")) echo " checked='checked'";
              if ($disable || (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="waived"))) echo " disabled='disabled'"; // added 7/24/10; modified 5/5/14
        echo' onchange="userMadeAChange(1);">' . PHP_EOL;
        echo'                     <label for="' . $checkId . '" class="entryFormRadioButton"> Check or money order in US$, drawn on a US bank, sent via post</label>' . PHP_EOL;
        echo'                  </div>' . PHP_EOL;
      }
      if (self::$showFunctionMarkers) echo "<!-- END addPaymentWidgetsSection -->\r\n";
    }

    public function __construct() {
      $this->DEBUGGER = new SSFDebug();
      $this->DEBUGGER->enableBelch(false);
      $this->DEBUGGER->enableBecho(false);
      $this->initState($_POST);
      $this->makeHiddenInputField('itsMeSubmit');
      $this->makeHiddenInputField('theItsMePersonId');
      $this->makeHiddenInputField('theItsMePersonPassword');
      $this->makeHiddenInputField('theItsMePersonName');
      $this->makeHiddenInputField('people_loginName');
      $this->makeHiddenInputField('loginPasswordCache');
    }
    
    private function initState($fromArray) {
      $this->DEBUGGER->belch('initState() fromArray', $fromArray, self::$displayDataStructures);
      HTMLGen::setCaller('user');
      SSFPhoneHome::turnOn();  // turnOn() or turnOff()
    
      // Initialize $this->state from POST and other sources.
      $this->state = array();
      foreach ($fromArray as $fromKey => $fromValue) {
        $this->state[$fromKey] = (isset($fromValue)) ? $fromValue : "";
      }
      if (!isset($this->state['userLoginUnderway'])) { $this->state['userLoginUnderway'] = 1; }
      if (!isset($this->state['theItsMePersonId'])) { $this->state['theItsMePersonId'] = 0; }
      if (!isset($this->state['submitterInPeopleTable'])) { $this->state['submitterInPeopleTable'] = 0; }
      if (!isset($this->state['subscriberInPeopleTable'])) { $this->state['subscriberInPeopleTable'] = 0; }
      if (!isset($this->state['loginName'])) { $this->state['loginName'] = ''; }
      if (!isset($this->state['pwFromLogin'])) { $this->state['pwFromLogin'] = ''; }
      if (!isset($this->state['workSelector'])) { $this->state['workSelector'] = 0; }
      if (!isset($this->state['loginUserId'])) { $this->state['loginUserId'] = 0; }
      if (!isset($this->state['entryId'])) { $this->state['entryId'] = 0; }
      if (!isset($this->state['passwordEntryRequired'])) { $this->state['passwordEntryRequired'] = 0; }
      if (!isset($this->state['contributorArray'])) { $this->state['contributorArray'] = array(); }
      if (!isset($this->state['maxContributorOrder'])) { $this->state['maxContributorOrder'] = 0; }
      if (!isset($this->state['personLoggedInLastModified'])) { $this->state['personLoggedInLastModified'] = ''; }
      if (!isset($this->state['workLastModified'])) { $this->state['workLastModified'] = ''; }
      if (!isset($this->state['workSelector']) || $this->state['workSelector'] == 0) { 
        $this->state['workSelector'] = ((isset($this->state['priorWorkSelection'])) ? $this->state['priorWorkSelection'] : 0); 
      }
      if ((!isset($this->state['loginNameSaved']) || $this->state['loginNameSaved'] == '') && isset($this->state['loginName']))
        $this->state['loginNameSaved'] = $this->state['loginName']; 
      $this->callForEntriesId = $this->state['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
      $this->creatingNewPerson = (isset($this->state['createNewPerson']) && $this->state['createNewPerson'] == 'Create New Person'); 
      $this->editingPerson = (isset($this->state['editPerson']) && $this->state['editPerson'] == 'Edit'); 
      $this->DEBUGGER->belch('this->state before Sign In', $this->state, self::$displayDataStructures);
      $this->DEBUGGER->belch('_POST', $_POST, self::$displayDataStructures);
    }
  
    private static function badEmailAlert($n) { if (self::$debugPhpValidEmailAddress == 1) echo 'badEmailAlert ' . $n; }
    
    private function validEmailAddress($str) {
      $at = "@";
      $dot = ".";
      $stringLength = strlen($str);
      $atIndex = strpos($str, $at);
      $dotIndex= strpos($str, $dot);
      $this->DEBUGGER->becho('atIndex', $atIndex, self::$debugPhpValidEmailAddress);
      $this->DEBUGGER->becho('stringLength', $stringLength, self::$debugPhpValidEmailAddress);
      $this->DEBUGGER->becho('dotIndex', $dotIndex, self::$debugPhpValidEmailAddress);
      if ($atIndex === false || $atIndex === 0 || $atIndex >= ($stringLength-4)) { self::badEmailAlert(1); return false; }
      if ($dotIndex === false || $dotIndex === 0 || $dotIndex >= ($stringLength-2)) { self::badEmailAlert(2); return false; }
      if (strpos($str, $at, ($atIndex+1)) !== false) { self::badEmailAlert(3); return false; }
      if (strpos($str, $atIndex-1, $atIndex) == $dot || substr($str, $atIndex+1, $atIndex+2) == $dot) { self::badEmailAlert(4); return false; }
      if (strpos($str, $dot, ($atIndex+2)) == -1) { self::badEmailAlert(5); return false; }
      if (strpos($str, " ") !== false) { self::badEmailAlert(6); return false; }
      return true;
    }	

    private function isValidLogin($newLoginName, $dbLoginName, $newPW, $dbPW, $requirePassword) {
      $currentYearString = SSFRunTimeValues::getCurrentYearString();
      // Requiring a password for a new user is handled once they get to the Create Person form.
      $this->validLogin = false;
      if (self::$debugValidLogin == 1) var_dump(debug_backtrace());
      if (($newPW == '') && ($dbPW != '')) { 
        // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
        $this->DEBUGGER->belch('User entered blank password that does not match the DB', '', self::$debugValidLogin);
        // Mail the user their password.
        $to      =  $newLoginName;
        $subject = "To sign in";
        $message = "Dear " . $dbLoginName . ",\r\n\r\n"
                 . "To sign in at http://sanssoucifest.org/onlineEntryForm/entryForm" . $currentYearString . ".php use " . $dbPW . "\r\n\r\n" 
                 . "Best Regards, \r\nYour Friendly Helper at SansSouciFest.org\r\n\r\nDo not reply to this message.\r\n";
        $headers = "From: YourFriendlyHelper@sanssoucifest.org" . PHP_EOL
                 . "Bcc: entryForm@sanssoucifest.org" . PHP_EOL
                 . "Reply-To: no-reply@sanssoucifest.org" . PHP_EOL
                 . "X-Mailer: PHP/" . phpversion();
        $this->DEBUGGER->becho('to', $to, -1);
        $this->DEBUGGER->becho('subject', $subject, -1);
        $this->DEBUGGER->becho('message', $message, -1);
        $this->DEBUGGER->becho('headers', $headers, -1);
        $mailedPassword = mail($to, $subject, $message, $headers);
        $this->openErrorMessage = "NOTICE:<br><br>You did not enter your password. ";
        if ($mailedPassword) $this->openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $newLoginName . "."
                                               . "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
      } else if (($dbPW != '') && ($newPW != $dbPW)) { 
        // User entered incorrect non-blank password. Make them login again.
        $this->DEBUGGER->belch('User entered incorrect non-blank password', $newPW, self::$debugValidLogin);
        $this->openErrorMessage = "ERROR:<br><br>The password you entered does not match your Sign In Email Address."
                                . "<br>If you simply forgot your password, leave it blank and Sign In again."
                                . "<br>You'll receive more help after that.";
        $this->DEBUGGER->becho('isValidLogin() dbPW', $dbPW, self::$debugValidLogin);
        $this->DEBUGGER->becho('isValidLogin() newPW', $newPW, self::$debugValidLogin);
      } else if ($requirePassword && ($newPW == '')) {
        // User entered blank password when a password is required.
        $this->DEBUGGER->belch('User entered blank password when a password is required.', '', self::$debugValidLogin);
        $this->openErrorMessage = "NOTICE:<br><br>Please enter a password.";
      } else {
        // Username and password is OK.
        $this->validLogin = true;
        $this->DEBUGGER->becho('isValidLogin() validLogin', $this->validLogin, self::$debugValidLogin);
      }
      return $this->validLogin;
    }

    private function makeHiddenInputField($IdName) {
      $debugMake = -1;
      $this->DEBUGGER->becho('makeHiddenInputField(IdName) CREATING', $IdName, $debugMake);
      $value = '';
      if (isset($this->state[$IdName])) $value = $this->state[$IdName];
      else $this->state[$IdName] = $value;
      echo '<input type="hidden" id="' . $IdName . '" name="' . $IdName . '" value="' . $value . '">' . PHP_EOL;
    }
    
    private function setState($keyName, $keyValue, $debug=-1, $debugId='') {
      $this->makeHiddenInputField($keyName);
      $this->state[$keyName] = $keyValue;
      echo "<script type='text/javascript'>document.getElementById('" . $keyName . "').value='" . $keyValue . "';</script><!-- from setState() -->\r\n";
      $this->DEBUGGER->becho((($debugId=='') ? '' : $debugId . ' ') .'this->state[' . $keyName . ']', $this->state[$keyName], $debug);
      //if ($debug == 1) var_dump(debug_backtrace());
      return $keyValue;
    }

    // Also see setUpSubscriber() below
    public function setUpSubmitter($loginName, $loginPassword, $submitterDBState) {
      $this->DEBUGGER->bechoTrace('setUpSubmitter()', $loginName, -1);
      $this->state['submitterInPeopleTable'] = 1;
      $this->state['userLoginUnderway'] = isset($submitterDBState["loginName"]) && isset($submitterDBState["password"])
                                           &&  !$this->isValidLogin($loginName, $submitterDBState["loginName"], 
                                                        $loginPassword, $submitterDBState['password'], 
                                                        $this->state['passwordEntryRequired']);
      if (!$this->state['userLoginUnderway']) {
        $this->state['loginUserId'] = $submitterDBState['personId'];
        $this->setState('people_loginName', $loginName);
        $this->setState('loginPasswordCache', $loginPassword, -1, 'PE1');
        return true;
      } else { // since the login name is not valid
        $this->state['loginUserId'] = 0;
        $this->setState('people_loginName', '');
        $this->setState('loginPasswordCache', '', self::$debugPeopleLoginName, 'PE2');
        return false;
      }
    }

   // TODO Clean this up. 4/1/12
   // setUpSubscriber() is a copy of setUpSubmitter() except that it manipulates $this->state['subscriberInPeopleTable'] instead of $this->state['submitterInPeopleTable'].
    public function setUpSubscriber($loginName, $loginPassword, $subscriberDBState) {
      $this->DEBUGGER->bechoTrace('setUpSubscriber()', $loginName, -1);
      $this->state['subscriberInPeopleTable'] = 1;
      $this->state['userLoginUnderway'] = isset($subscriberDBState["loginName"]) && isset($subscriberDBState["password"])
                                           &&  !$this->isValidLogin($loginName, $subscriberDBState["loginName"], 
                                                        $loginPassword, $subscriberDBState['password'], 
                                                        $this->state['passwordEntryRequired']);
      if (!$this->state['userLoginUnderway']) {
        $this->state['loginUserId'] = $subscriberDBState['personId'];
        $this->setState('people_loginName', $loginName);
        $this->setState('loginPasswordCache', $loginPassword, -1, 'PE1');
        return true;
      } else { // since the login name is not valid
        $this->state['loginUserId'] = 0;
        $this->setState('people_loginName', '');
        $this->setState('loginPasswordCache', '', self::$debugPeopleLoginName, 'PE2');
        return false;
      }
    }

    public function bechoStateVarialbes($doIt) {
      $this->DEBUGGER->becho('theForm->state[userLoginUnderway]', $this->state['userLoginUnderway'], $doIt);
      $this->DEBUGGER->becho('theForm->userIsSigningOff', $this->userIsSigningOff(), $doIt);
      $this->DEBUGGER->becho('theForm->isCreatingNewPerson', $this->isCreatingANewPerson(), $doIt);
      $this->DEBUGGER->becho('theForm->isCreatingANewWork', $this->isCreatingANewWork(), $doIt);
      $this->DEBUGGER->becho('theForm->isEditingAPerson', $this->isEditingAPerson(), $doIt);
      $this->DEBUGGER->becho('theForm->isEditingAWork', $this->isEditingAWork(), $doIt);
      $this->DEBUGGER->becho('theForm->isDisplayingData', $this->isDisplayingData(), $doIt);
    }    
    
// ++++++++--- boolean functions
    public function itsMe() { return (isset($this->state['itsMeSubmit']) && ($this->state['itsMeSubmit'] == 'ItsMe')); }
    public function isCreatingANewPerson() { return $this->creatingNewPerson; }
    public function isCreatingANewWork() { return (isset($this->state['createNewWork']) && $this->state['createNewWork'] == 'Create New Entry'); }
    public function workIsSpecified() { 
      return (!$this->isCreatingANewWork() && isset($this->state['workSelector']) && $this->state['workSelector'] != '' && ($this->state['workSelector'] != 0)); }
    public function isEditingAPerson() { return $this->editingPerson; }
    public function isEditingAWork() { return (isset($this->state['editWork']) && $this->state['editWork'] == 'Edit'); }
    public function isDisplayingData() { 
      return !($this->state['userLoginUnderway'] || $this->isCreatingANewPerson() || $this->isCreatingANewWork() || $this->isEditingAPerson() || $this->isEditingAWork()); }
    public function userLoginUnderway() { return (isset($this->state['userLoginUnderway']) && ($this->state['userLoginUnderway'] == 1)); }
    public function userIsSigningOff() { return (isset($this->state['signOff']) && ($this->state['signOff'] == 'Sign Off')); }

    // Is someone signing in now?
    public function signingIn() {
      $this->creatingNewPerson = false;
      $maybeSigningIn = (isset($this->state['signInSubmit']) && ($this->state['signInSubmit'] == 'Sign In')); 
      $reallySigningIn = ($this->userLoginUnderway() == 1) && ($maybeSigningIn || $this->itsMe());
      $this->DEBUGGER->becho('07 theForm->userLoginUnderway()', $this->userLoginUnderway(), self::$debugSignIn);
      $this->DEBUGGER->becho('07 maybeSigningIn', $maybeSigningIn, self::$debugSignIn);
      $this->DEBUGGER->becho('07 reallySigningIn', $reallySigningIn, self::$debugSignIn);
      $this->DEBUGGER->becho('07 theForm->state["itsMeSubmit"]', ((isset($this->state['itsMeSubmit'])) ? $this->state['itsMeSubmit'] : ''), self::$debugSignIn);
      $this->DEBUGGER->becho('07 theForm->itsMe()', $this->itsMe(), self::$debugSignIn);
      return $reallySigningIn;
    }
  
    // Sign In
    public function signIn() {
      $this->DEBUGGER->becho('08', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
      $itsMeDBState = array();
      if ($this->itsMe()) {
        $this->DEBUGGER->becho('09', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
        $itsMeDBState['personId'] = $this->state['theItsMePersonId'];
        $itsMeDBState['password'] = $this->state['theItsMePersonPassword'];
        $itsMeDBState['name'] = $this->state['theItsMePersonName'];
        $this->setUpSubscriber($this->state['loginName'], $this->state['pwFromLogin'], $itsMeDBState);
      } else { // since signingIn
        $this->DEBUGGER->becho('10', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
        $this->state['userLoginUnderway'] = 1;
        $validUserName = $this->validEmailAddress($this->state['loginName']);
        if ($validUserName) {
          // On Success
          $this->DEBUGGER->becho('11', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
          // Check to see if the Submitter has no loginName in the DB
          $submitterDBState = SSFQuery::selectPersonByAlternateKey('loginName', $this->state['loginName']);
          if ($submitterDBState !== false) { // The Submitter loginName is in the DB.
            $this->DEBUGGER->becho('12', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
            $this->setUpSubscriber($this->state['loginName'], $this->state['pwFromLogin'], $submitterDBState);
          } else { // since the submitter is not in the DB as a loginName
            $this->DEBUGGER->becho('13', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
            $submitterDBState2 = SSFQuery::selectPersonByAlternateKey('email', $this->state['loginName'], $debugThis = false);
            if ($submitterDBState2 === false) { 
              // The Submitter has no email address in the DB either so this must be a New Person.
              $this->DEBUGGER->becho('14', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
              $this->state['createNewPerson'] = 'Create New Person';
              $this->creatingNewPerson = true;
              $this->state['submitterInPeopleTable'] = 0;
              $this->state['subscriberInPeopleTable'] = 0;
              $this->state['passwordEntryRequired'] = true;
              $this->state['userLoginUnderway'] = 0;
            } else { 
              // since the Submitter has an email address but no loginName in the db
              $this->DEBUGGER->becho('15', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
              $this->DEBUGGER->belch('15 submitterDBState2', $submitterDBState2, self::$debugSignIn);
              //$this->state['itsMeSubmit'] = 'ItsMe';
              $this->setTheItsMeWhatever('itsMeSubmit', 'ItsMe');
              $this->setTheItsMePersonId($submitterDBState2['personId']);
              $this->setTheItsMePersonPassword($submitterDBState2['password']);
              $this->setTheItsMePersonName($submitterDBState2['name']);
              $this->openErrorMessage = "Although you have never logged in before,<br>we find we have your email address.<br>"
                                . 'If you are ' . $submitterDBState2['nickName'] . ' ' . $submitterDBState2['lastName'] . ',<br>'
                                . "click <a href='#' onclick='javascript:submitItsMe();'>YES, It's Me</a>."
                                . "<br><br>If not, please login with a different login name / email address.<br><br>";
              $this->state['userLoginUnderway'] = 1;
            }
          }
        } else { // since this is not a valid user name
          $this->DEBUGGER->becho('17', 'Signing In with ' . $this->state['loginName'], self::$debugSignIn);
          $this->openErrorMessage = "ERROR:<br>Please enter a valid email address.";
          $this->state['userLoginUnderway'] = 1;
        }
      }
    }
    
    // It's Me functions
    private function setTheItsMePersonId($newValue) { $this->setTheItsMeWhatever('theItsMePersonId', $newValue); }
    private function setTheItsMePersonPassword($newValue) { $this->setTheItsMeWhatever('theItsMePersonPassword', $newValue); }
    private function setTheItsMePersonName($newValue) { $this->setTheItsMeWhatever('theItsMePersonName', $newValue); }
    private function setTheItsMeWhatever($keyName, $keyValue) {
      $this->state[$keyName] = $keyValue;
      echo "<script type='text/javascript'>document.getElementById('" . $keyName . "').value='" . $keyValue . "';</script>\r\n";
      $this->DEBUGGER->becho('setTheItsMeWhatever', $keyName . ' to ' . $keyValue, self::$debugPeopleLoginName);
    }
    
    // Returns true if this is a unique person name vis-a-vis the DB. Else, defines $this->possibleDuplicatesString.
    private function isUniqueName() {
      // Select people records where the last name is the same and the nickName is a'like'.
      $personQuery = 'SELECT personId, name, lastName, nickName, email, loginName, password FROM people'
                   . ' where lastName like "' . $this->state['people_lastName'] . '"'
                   . ' and (nickName like  "%' . $this->state['people_nickName'] . '%"'
                   . ' or "' . $this->state['people_nickName'] . '" like concat("%", nickName, "%")'
                   . ' or nickName = "" or nickName is null)';
      //SSFDB::debugNextQuery();
      $debugIsUniqueName = -1;
      $peopleArray = SSFDB::getDB()->getArrayFromQuery($personQuery); 
      $maxCountForUniqueness = 0;
      $isUnique = (count($peopleArray) <= $maxCountForUniqueness);
      $this->DEBUGGER->becho('count(peopleArray)', count($peopleArray), $debugIsUniqueName);
      $this->DEBUGGER->belch('possible duplicate people are', $peopleArray, (!$isUnique) ? $debugIsUniqueName : 0);
      if (!$isUnique) { 
        $varDump = var_export($peopleArray, true);
        $tmpDump = preg_replace('/([\d]){1,2}[\s]+=>[\s\r\n]*array \(/', '=> Possible Duplicate #$1: (', $varDump);
        $this->possibleDuplicatesString = preg_replace('/,[\s\r\n]*\),/', "\r\n    )", $tmpDump);
        $this->DEBUGGER->belch('varDump', $varDump, $debugIsUniqueName);
        $this->DEBUGGER->belch('possibleDuplicatesString', $this->possibleDuplicatesString, $debugIsUniqueName);
        // Assume that this is a newly created person with a same lastName, a very similar
        // nickName and a different loginName and email address from a DB people record.
        // If the password is the same it's probably the same person.
        // If the nickName is the same it's probably the same person.
        // What are the other cases?
      } else { $this->possibleDuplicatesString = ''; }
      return $isUnique;
    }
    
    public function insertPerson() {
      $debugIP = -1;
      $personInDatabase = SSFQuery::personExistsInDatabase($this->state['people_email']);
      $this->DEBUGGER->becho('10 personInDatabase', $personInDatabase, $debugIP);
      $this->DEBUGGER->becho('10 this->state[loginNameSaved]', $this->state['loginNameSaved'], SSFEntryForm::$debugLoginName);
      $this->DEBUGGER->becho('10 this->state[people_email]', $this->state['people_email'], SSFEntryForm::$debugLoginName);
      if ($personInDatabase !== false) { // Person's email is in DB so, either (this was a browser refresh so do nothing) 
                                         // or this submitter should not be using this email address since it's already in use.
        if ($this->state['loginNameSaved'] != $this->state['people_email']) {
          // This person started with one email address at the login page and then changed 
          // that email address on the Create Person form. So, now we need to reject the
          // email on the Create Person form.
          // Set state so that we'll redisplay the Create New Person page.
          $this->DEBUGGER->becho('10', 'personCreationRedo', $debugIP);
          $this->state['hiddenInputSavingKey'] = '';
          $this->state['createNewPerson'] = 'Create New Person';
          $this->state['people_email'] = $this->state['loginNameSaved'];
          $this->personCreationRedo = true;
          $this->creatingNewPerson = true;
          $this->displayingData = false;
        } else { // this was a browser refresh so do nothing
          $this->DEBUGGER->becho('10', 'browser refresh', $debugIP);
          $this->state['people_personId'] = $personInDatabase;
          $this->state['loginUserId'] = $personInDatabase;
          $this->state['submitterInPeopleTable'] = 0;
          $this->state['subscriberInPeopleTable'] = 1;
        }
      } else { // OK, do the DB update
        $this->DEBUGGER->becho('10', 'Insert a newly created person', $debugIP);
        $this->DEBUGGER->belch('10 editor state', $this->state, $debugIP);
        $this->setState('people_loginName', $this->state['people_email']);
        $this->DEBUGGER->belch('10.5 editor state', $this->state, $debugIP);
        $possibleDup = !$this->isUniqueName();
        $this->DEBUGGER->belch('11 possibleDup', ($possibleDup) ? 'possible dup' : 'unique', $debugIP);
        if ($possibleDup) {
          $dupInfo = "Possible Duplicates: " . $this->possibleDuplicatesString . "\r\n\r\n";
          SSFPhoneHome::sendPossibleDuplicatePersonInfo($this->state, $dupInfo);
        }
        $this->DEBUGGER->belch('11 editor state', $this->state, $debugIP);
        // HACK Force relationship to be Subscriber only
        // TODO: Somewhere, relationship is being set to Submitter,Subscriber. It shouldn't be. If it weren't, this force would be unnecessary. 
        //       Find where it's being set and undo it there.
        // TODO: Figure out how $this->state['submitterInPeopleTable'] and $this->state['subscriberInPeopleTable'] are being used and modify as appropriate.
        $this->state['people_relationship'] = array('Subscriber');
        //SSFDB::debugNextQuery();
        $result = SSFQuery::insertData('people', $this->state);
        if ($result !== false) {
          $this->state['people_personId'] = $result;
          $this->state['loginUserId'] = $this->state['people_personId'];
          $this->state['submitterInPeopleTable'] = 0;
          $this->state['subscriberInPeopleTable'] = 1;
          // Plug in the createdBy and lastModifiedBy values.
          $modByQueryString = 'UPDATE people SET lastModifiedBy = ' . $this->state['people_personId'] . ', createdBy = ' . $this->state['people_personId']
                            . ' WHERE personId = ' . $this->state['people_personId'];
          $querySuccess = SSFDB::getDB()->saveData($modByQueryString);
          SSFPhoneHome::sendPersonInfo($this->state, 0);
        }
      }
    }

    public function updatePerson() {
      $this->DEBUGGER->becho('20', 'Save an updated person', -1);
      $personId = (isset($this->state['editingPersonId'])) ? $this->state['editingPersonId'] : 0;
      if ($personId != 0) {
        $currentValueArray = SSFQuery::selectPersonFor($personId);
        $multiplePeopleExistInDatabase = SSFQuery::multiplePeopleExistInDatabase($this->state['people_email']);
        $this->DEBUGGER->becho('20 this->state[people_email]', $this->state['people_email'], SSFEntryForm::$debugLoginName);
        $this->DEBUGGER->becho('20 currentValueArray[email]', $currentValueArray['email'], SSFEntryForm::$debugLoginName);
        $this->DEBUGGER->becho('20 multiplePeopleExistInDatabase', $multiplePeopleExistInDatabase, SSFEntryForm::$debugLoginName);
        if (($this->state['people_email'] == $currentValueArray['email']) || !$multiplePeopleExistInDatabase) {
          // The user did not change their email address in a harmful way  
          $this->setState('people_loginName', $this->state['people_email']);
          $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $this->state, 'personId', $personId);
          $this->DEBUGGER->becho('people changeCount', $changeCount, SSFEntryForm::$debugChangeCount);
          $this->state['people_personId'] = $personId;
          if ($changeCount > 0) SSFPhoneHome::sendPersonInfo($this->state, 1, $changeCount);
        } else { // The user changed their email to an email address belonging to another user.
          // So, now we need to reject the email address on the Edit Person form.
          // Set state so that we'll redisplay the Edit New Person page.
          $this->state['hiddenInputSavingKey'] = '';
          $this->state['editPerson'] = 'Edit';
          $this->state['people_email'] = $currentValueArray['email'];
          $this->userEnteredEmailAddressAlreadyInUse = true;
          $this->editingPerson = true;
          $this->displayingData = false;
        }
      }
    }

    public function insertWork() {
      $debugMarkPersonAsSubmitter = -1;
      $this->state['works_titleForSort'] = HTMLGen::getTitleForSort($this->state['works_title']);
      $workInDatabase = SSFQuery::workExistsInDatabase($this->state['works_submitter'], $this->callForEntriesId, $this->state['works_title']);
      if ($workInDatabase !== false) { // This was a browser refresh
          $this->state['workSelector'] = $workInDatabase;
      } else { // OK, do the DB update
        $this->DEBUGGER->becho('30', 'Insert a newly created work', -1);
        $this->state['works_callForEntries'] = $this->callForEntriesId;
        SSFQuery::clearLastUpdateFields();
        $workId = SSFQuery::insertData('works', $this->state);
        if ($workId !== false) {
          $this->state['workSelector'] = $workId;
          $this->DEBUGGER->becho('500 this->state["workSelector"]', $this->state['workSelector'], SSFEntryForm::$debugRefreshIssues);
          SSFQuery::updateDBForWorkContributors($this->state, $workId);
          $this->state['works_workId_forInfoOnly'] = $workId;
          SSFPhoneHome::sendEntryInfo($this->state, 0);
          SSFQuery::addCurationRowsForNewWork($workId);
          // Make sure the submitter has a Submitter relationship in the people table.
          $this->DEBUGGER->belch('500q insertWork() this->state', $this->state, $debugMarkPersonAsSubmitter);
          $relationshipQueryString = 'SELECT relationship FROM people WHERE personId = ' . $this->state['works_submitter'];
          $relationshipsRow = SSFDB::getDB()->getArrayFromQuery($relationshipQueryString);
          $relationshipsString = (isset($relationshipsRow) && (count($relationshipsRow) > 0)) ? $relationshipsRow[0]['relationship'] : '';
          $this->DEBUGGER->belch('500t insertWork() releationshpsRow', $relationshipsRow, $debugMarkPersonAsSubmitter);
          $relationships = explode(',', $relationshipsString);
          $this->DEBUGGER->becho('500u insertWork() relationships', $relationships, $debugMarkPersonAsSubmitter);
          $relationshipString = '';
          $isSubmitter = false;
          $separator = '';
          foreach ($relationships as $relationship) { 
            $relationshipString .= $separator . $relationship;
            $separator = ',';
            if ($relationship == 'Submitter') { $isSubmitter = true; break; }
          }
          if (!$isSubmitter) {
            $relationshipString .= ',Submitter';
            $personUpdateString = "UPDATE people SET relationship = '" . $relationshipString . "'," 
                                . " lastModificationDate='" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy=" . $this->state['works_submitter']
                                . " WHERE personId = " . $this->state['works_submitter'];
            //SSFDB::debugNextQuery();
            $success = SSFDB::getDB()->saveData($personUpdateString);
            $this->DEBUGGER->becho('500z insertWork() successfully added Submitter to relationship', $success, $debugMarkPersonAsSubmitter);
          }
        }
      }
    }
    
    public function updateWork() {
      $this->state['works_titleForSort'] = HTMLGen::getTitleForSort($this->state['works_title']);
      $workId = (isset($this->state['editingWorkId'])) ? $this->state['editingWorkId'] : 0;
      if ($workId != 0) {
        $this->DEBUGGER->becho('40', 'Save an updated work', 0);
        $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
        //SSFDB::debugOn(); 
        SSFQuery::clearLastUpdateFields();
        $changeCount = SSFQuery::updateDBFor('works', $currentWorkValueArray, $this->state, 'workId', $workId);
        $this->DEBUGGER->becho('work changeCount 1', $changeCount, self::$debugChangeCount);
        $changeCount += SSFQuery::updateDBForWorkContributors($this->state, $workId);
        $this->DEBUGGER->becho('work changeCount 2', $changeCount, self::$debugChangeCount);
        SSFDB::debugOff(); 
        $this->state['works_workId_forInfoOnly'] = $workId;
        if ($changeCount > 0) SSFPhoneHome::sendEntryInfo($this->state, 1, $changeCount);
      }
    }

    public static function entryRequirementsDisplayString($section = '') {
      $currentYearString = SSFRunTimeValues::getCurrentYearString();
      $entryFormFilename = 'entryForm' . $currentYearString . '.php'; 
      if ($section == '') {
        $displayText = 'Entry Requirements';
        $trailerText = '';
      } else {
        $displayText = ucwords(strtolower(substr($section,1))) . ' Section';
        $trailerText = ' of the Entry Requirements';
      }
      $entryRequirementsDisplayString
      = '<a class="dodeco" href="javascript:void(0)" onClick="entryRequirementsWindow=window.open(\'onlineEntryForm/' . $entryFormFilename . $section . '\','  
      . '\'EntryRequirementsWindow\',\'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=850,height=640\',false);'
      . 'entryRequirementsWindow.focus();">' . $displayText . '</a>' . $trailerText;
      return $entryRequirementsDisplayString;
    }
    
    private static function asterisk() {
      $asterisk = HTMLGen::requiredFieldString();
      return $asterisk;
    }

    public static function displayPersonInformation($personIsSpecified, $dbPersonWorkState) {
      echo "<!-- display Person Information -->\r\n";
      echo '          <div class="entryFormSectionHeading">' . PHP_EOL;
      $personOrSubmitterText = 'Submitter: ';   // <!-- TODO FIX $personOrSubmitterText -->
      echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;"><span class="withEmphasis">' . $personOrSubmitterText . '</span>' . PHP_EOL;
      if ($personIsSpecified) echo $dbPersonWorkState['name'];
      echo '            </div>' . PHP_EOL;
      echo '            <div style="float:right;padding-right:4px;padding-bottom:0;">' . PHP_EOL;
      if ($personIsSpecified)  echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">' . PHP_EOL;
      echo '            </div>' . PHP_EOL;
      echo '            <div style="clear:both;padding:0;margin:0;"><hr class="horizontalSeparatorFull"></div>' . PHP_EOL;
      echo '          </div>' . PHP_EOL;
      echo '          <div id = "edPersonDiv" style="text-align:left;">' . PHP_EOL;
      if ($personIsSpecified) HTMLGen::displayPersonDetail($dbPersonWorkState, $forAdmin=false); 
      echo '          </div> <!-- id = "edPersonDiv" -->' . PHP_EOL;
    }
    
    public static function displayWorkSelector($theForm, $entryFeeAmount, $finalDeadlineHasPassed) {
      echo "<!-- display Work Selector -->\r\n";
      echo '          <div class="entryFormSectionHeading">' . PHP_EOL;
      echo '            <div style="float:left;text-align:left;padding-top:4px;padding-bottom:4px;"><span class="withEmphasis">Select an entry or create a new one. </span>' . PHP_EOL;
      echo '                                   <span class="quaternaryTextColor" style="font-size:13px;">(A $' 
                                                                . $entryFeeAmount . ' entry fee applies to each work entered.)</span></div>' . PHP_EOL;
      echo '            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>' . PHP_EOL;
      echo '          </div>' . PHP_EOL;
      echo '          <div class="formRowContainer">' . PHP_EOL;
      echo '            <div class="entryFormFieldContainer">' . PHP_EOL;
      echo '              <div style="float:left;">' . PHP_EOL;
      $workIdSelected = HTMLGen::displayWorkSelector('ssfEntryForm', $theForm->state['loginUserId'], $theForm->state, '-- select an entry to view and edit --'); 
      if ($workIdSelected !=  $theForm->state['workSelector']) {
        // This is an ugly repeat of code executed above for $dbPersonWorkState and $dbContributorsState initialization
        $theForm->state['workSelector'] = $workIdSelected;
        initializeWorkDatabaseState($theForm);
      }
      $theForm->DEBUGGER->becho('502 theForm->state[workSelector]', $theForm->state['workSelector'], -1);
      echo '              </div>' . PHP_EOL;
      echo '              <div style="float:left;padding-left:20px;">' . PHP_EOL;
      echo '                <input type="submit" id="createNewWork" name="createNewWork" value="Create New Entry"' 
                                                                 . (($finalDeadlineHasPassed) ? 'disabled="disabled"' : "") . '>' . PHP_EOL;
      echo '              </div>' . PHP_EOL;
      echo '              <div style="clear:both;"></div>' . PHP_EOL;
      echo '            </div>' . PHP_EOL;
      echo '          <div style="clear:both;"></div>' . PHP_EOL;
      echo '          </div>' . PHP_EOL;
      return $workIdSelected;
    }

    public static function displayWorkInformation($theForm, $dbPersonWorkState, $dbContributorsState) {
      echo "<!-- display Work Information -->\r\n";
      if ($theForm->workIsSpecified()) {
        echo "          <div class='entryFormSectionHeading'>\r\n";
        echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;"><span class="withEmphasis">Entry:</span> "' . $dbPersonWorkState['title'] . '"';
        echo "            </div>\r\n";
        echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
        echo '              <input type="submit" id="editWork" name="editWork" value="Edit">' . PHP_EOL;
        echo "            </div>\r\n";
        echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
        echo "          </div>\r\n";
        echo "          <div id='edEntriesDiv' style='text-align:left;'>\r\n";
        $theForm->DEBUGGER->becho('504 databaseState["workId"]', $dbPersonWorkState['workId'], SSFEntryForm::$debugRefreshIssues);
        HTMLGen::displayWorkDetail($dbPersonWorkState, $dbContributorsState);
        echo "          </div> <!-- id=edEntriesDiv -->\r\n";
      }
    }

    private static function displayProductionYearAndCountry($prodYearInitValue, $prodCountryInitValue ='') {
      echo "<!-- BEGIN displayProductionYearAndCountry(" . $prodYearInitValue . ", " . $prodCountryInitValue . ") -->\r\n";
      $prodYearDesc = self::asterisk() . 'Production Year:';
      $prodYearIdName = DatumProperties::getItemKeyFor('works', 'yearProduced');
      $prodYearGenId = HTMLGen::genId($prodYearIdName);
      $prodYearMaxLength = 4;
      $prodCountryDesc = self::asterisk() . 'Country of Production:';
      $prodCountryIdName = DatumProperties::getItemKeyFor('works', 'countryOfProduction');
      $prodCountryGenId = HTMLGen::genId($prodCountryIdName);
  
      // public static function addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $width="w", $disable=false) {
      // NOTE: Setting $inputType to 'password' causes Firefox to repeatedly ask the user if she wants the password to be saved.
      echo "      <div class='formRowContainer'>\r\n";
      echo "        <div class='rowTitleTextWide'>" . $prodYearDesc . "</div>\r\n"; 
      echo "        <div class='entryFormFieldContainer'>\r\n";
      echo "          <div style='float:left;margin-right:10px;'>\r\n";
                        // production year text widget goes here
      echo "            <input type='text' id=" . $prodYearGenId . " name=" . $prodYearIdName;
      echo " onKeyPress='return digitsOnly2(event);'";
      echo " class=entryFormInputFieldVeryShort";
      echo ' value="' . str_replace('"', "", $prodYearInitValue) . '"';
      echo ' maxLength="' . $prodYearMaxLength . '"';
      echo " onchange='javascript:userMadeAChange(0);'>\r\n";
      echo "          </div>\r\n"; 
      echo '          <div style="float:left;margin-top:-1;">';
      echo '            <span class="rowTitleTextWide" style="width:150px;">' . $prodCountryDesc . '</span>';
      echo '            <input class="entryFormInputFieldShort" style="width:110px;" type="text" id="' . $prodCountryGenId . '" name="' . $prodCountryIdName . '" ' .
                          'value="' . $prodCountryInitValue . '" maxlength="64"' . ' onchange="javascript:userMadeAChange(0);">';
      echo '          </div>';
  
      // public static function addTextWidgetRowHelper2() {
      echo "        <div style='clear:both;'></div>\r\n"; // rowTitleTextWide
      echo "        </div>\r\n";                          // entryFormFieldContainer
      echo "      </div>\r\n";                            // formRowContainer
    
      echo "<!-- END displayProductionYearAndCountry -->\r\n";
    }

    public static function displayPersonCreationForm($theForm) {
      $disable = $theForm->state['userLoginUnderway'];
      self::displayEditDivHeader_2('edCreatePersonDiv', "Creating New Account", 'Submit', 'saveNewPerson', 
                                      'savingNewPerson', 'cancelPersonChanges');
      if ($theForm->personCreationRedo) {
        HTMLGen::addTextWidgetRow(self::asterisk() . 'First Name', 'people_nickName',  $theForm->state['people_nickName'], 64, $disable);
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Last Name', 'people_lastName',  $theForm->state['people_lastName'], 64, $disable);
        HTMLGen::addTextWidgetRow('Organization', 'people_organization',  $theForm->state['people_organization'], 128, $disable);
        HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1',  $theForm->state['people_streetAddr1'], 64, $disable);
        HTMLGen::addTextWidgetRow('', 'people_streetAddr2',  $theForm->state['people_streetAddr2'], 64, $disable);
        HTMLGen::addTextWidgetRow('City', 'people_city',  $theForm->state['people_city'], 32, $disable);
        $szcArray["stateProvRegion"] = $theForm->state['people_stateProvRegion'];
        $szcArray["zipPostalCode"] = $theForm->state['people_zipPostalCode'];
        $szcArray["country"] = $theForm->state['people_country']; 
        HTMLGen::addStateZipCountryRow($szcArray, $disable);
        $phoneArray["phoneVoice"] = $theForm->state['people_phoneVoice'];
        $phoneArray["phoneMobile"] = $theForm->state['people_phoneMobile'];
        $phoneArray["phoneFax"] = $theForm->state['people_phoneFax']; 
        HTMLGen::addTextWidgetTelephonesRow($phoneArray, $disable);
        // email  
        echo '<div class="entryFormNotation" style="padding-top:20px;"><span class="quaternaryTextColor">ERROR.</span> You '
          . 'changed your email address to one that is already in our system. '
          . 'Please use a  different email address. The one displayed below is the one you originally entered on the Sign In page.</div>';
        echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Email Address', 'people_email', $theForm->state['people_email'], 128, $disable);
        //if ($theForm->state['subscriberInPeopleTable'])
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Reenter Email', 'people_email_2',  '', 128, $disable); 
        // password
        echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Password', 'people_password', $theForm->state['people_password'], 32, $disable);
        //if ($theForm->state['subscriberInPeopleTable'])
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
        // notifyOf
        echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . self::$notificationQuestion . '</div>';
        HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf',  $theForm->state['people_notifyOf'], 4, $disable); 
        // howHeard
        echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
        HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $theForm->state['people_howHeardAboutUs'], 128, $disable);
      } else { // this is truely a brand new person
        HTMLGen::addTextWidgetRow(self::asterisk() . 'First Name', 'people_nickName', '', 64, $disable);
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Last Name', 'people_lastName', '', 64, $disable);
        HTMLGen::addTextWidgetRow('Organization', 'people_organization', '', 128, $disable);
        HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', '', 64, $disable);
        HTMLGen::addTextWidgetRow('', 'people_streetAddr2', '', 64, $disable);
        HTMLGen::addTextWidgetRow('City', 'people_city', '', 32, $disable);
        $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
        HTMLGen::addStateZipCountryRow($szcArray, $disable);
        $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
        HTMLGen::addTextWidgetTelephonesRow($phoneArray, $disable);
        // email  
        echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Email Address', 'people_email', $theForm->state['loginName'], 128, $disable);
        //if ($theForm->state['subscriberInPeopleTable'])
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Reenter Email', 'people_email_2', '', 128, $disable); 
        // password
        echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Password', 'people_password', $theForm->state['pwFromLogin'], 32, $disable);
        //if ($theForm->state['subscriberInPeopleTable'])
        HTMLGen::addTextWidgetRow(self::asterisk() . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
        // notifyOf
        echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . self::$notificationQuestion . '</div>';
        HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf', 'calls,events', 4, $disable); 
        // howHeard
        echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
        HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', '', 128, $disable);
      }
      self::displayEditSectionFooter('<span class="withEmphasis">Finish Creating New Account</span>', 'Submit', 'saveNewPerson', 'savingNewPerson', 'cancelPersonChanges');
      echo "          </div> <!-- End edCreatePersonDiv -->";
      echo '<script type="text/javascript">getUniqueElement("people_nickName").focus();</script>' . PHP_EOL;
    }

    public static function displayPersonEditForm($theForm, $dbPersonWorkState) {
      $disable = $theForm->state['userLoginUnderway'];
      self::displayEditDivHeader_2('edEditPersonDiv', "Editing " . $dbPersonWorkState['name'], 'Save', 'savePerson', 
                                      'savingPerson', 'cancelPersonChanges');
      HTMLGen::addTextWidgetRow(self::asterisk() . 'First Name', 'people_nickName', $dbPersonWorkState['nickName'], 64, $disable);
      HTMLGen::addTextWidgetRow(self::asterisk() . 'Last Name', 'people_lastName', $dbPersonWorkState['lastName'], 64, $disable);
      HTMLGen::addTextWidgetRow('Organization', 'people_organization', $dbPersonWorkState['organization'], 128, $disable);
      HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $dbPersonWorkState['streetAddr1'], 64, $disable);
      HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $dbPersonWorkState['streetAddr2'], 64, $disable);
      HTMLGen::addTextWidgetRow('City', 'people_city', $dbPersonWorkState['city'], 32, $disable);
      $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
      HTMLGen::addStateZipCountryRow($dbPersonWorkState, $disable);
      $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
      HTMLGen::addTextWidgetTelephonesRow($dbPersonWorkState, $disable);
      // email
      if ($theForm->userEnteredEmailAddressAlreadyInUse) 
        echo '<div class="entryFormNotation" style="padding-top:20px;"><span class="quaternaryTextColor">ERROR.</span> You '
        . 'changed your email address to one that is already in our system. '
        . 'Please use a  different email address. The one displayed below is the prior one - before you just changed it.</div>';
      if ($theForm->state['subscriberInPeopleTable']) echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
      HTMLGen::addTextWidgetRow(self::asterisk() . 'Email Address', 'people_email', $dbPersonWorkState['email'], 128, $disable);
      HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); //
      // password
      if ($theForm->state['subscriberInPeopleTable']) echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      $initialPassword = ((!isset($dbPersonWorkState['password']) || $dbPersonWorkState['password'] == '')) ? $theForm->state['loginPasswordCache'] : $dbPersonWorkState['password'];
      HTMLGen::addTextWidgetRow(self::asterisk() . 'Password', 'people_password', $initialPassword, 32, $disable);
      HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable);
      // notifyOf
      echo '<div class="entryFormNotation" style="padding-top:9px;padding-bottom:0px;">' . self::$notificationQuestion . '</div>';
      HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf', $dbPersonWorkState['notifyOf'], 4, $disable); 
      // howHeard
      echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
      HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $dbPersonWorkState['howHeardAboutUs'], 128, $disable);
  
      self::displayEditSectionFooter("<span class='withEmphasis'>Finish Editing</span> " . $dbPersonWorkState['name'], 'Save', 'savePerson', 'savingPerson', 'cancelPersonChanges');
      echo "          </div> <!-- End edEditPersonDiv -->";
      echo '<script type="text/javascript">getUniqueElement("people_nickName").focus();</script>' . PHP_EOL;
    }

    public static function displayWorkCreationForm($theForm, $dbPersonWorkState, $dbContributorsState) {
      $disable = $theForm->state['userLoginUnderway'];
      self::displayEditDivHeader_2('edCreateWorkDiv', 'Creating Entry', 'Submit', 'saveNewWork', 
                                      'savingNewWork', 'cancelWorkChanges');
      echo '<div class="entryFormSubheading" style="padding-top:0px;">' . self::$basicsLeader . '</div>';
      HTMLGen::addTextWidgetRow(self::asterisk() . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 128, $disable);
  //    HTMLGen::addTextWidgetRow(self::asterisk() . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 4, $disable);
      SSFEntryForm::displayProductionYearAndCountry("", "");
      HTMLGen::addRunTimeWidgetsRow('00:00:00', $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), self::asterisk() . 'Brief Synopsis', '', 2048, 3, $disable);
      HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), '', 1024, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), '', 128, $disable);
      echo '<div class="entryFormSubheading">' . self::$formatsLeader . '</div>';
      HTMLGen::addRadioButtonWidgetRow(self::asterisk() . 'Submission Format', 'works', 'submissionFormat', 'SD-Vimeo', 4, "w", $disable); 
  //    HTMLGen::displayOriginalFormatSelector2013('', $disable); 
  //    HTMLGen::addAspectRatioAnamorphicRow(0, 0, $disable);
  //    HTMLGen::addPixelDimensionsWidgetsRow(0, 0, $disable);
      echo '<div class="entryFormSubheading">' . self::$creditsLeader . '</div>';
      HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
      self::addPaymentWidgetsSection($dbPersonWorkState, $disable);
      self::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Submit', $disable);
      echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . self::$otherLeader . '</div>';
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', '', 2048, 2, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('webSite') . 'Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoURL') . 'Screen Snpshots', DatumProperties::getItemKeyFor('works', 'photoURL'), '', 256, $disable);
  //    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable); // removed 3/22/14
      self::displayEditSectionFooter('<span class="withEmphasis">Finish Creating Entry</span>', 'Submit', 'saveNewWork', 'savingNewWork', 'cancelWorkChanges');
      echo '            <div style="clear:both;"></div>';
      echo "          </div> <!-- End edCreateWorkDiv -->\r\n";
      echo '<script type="text/javascript">getUniqueElement("' . DatumProperties::getItemKeyFor('works', 'title') . '").focus();</script>' . PHP_EOL;
    }

    public static function displayWorkEditForm($theForm, $dbPersonWorkState, $dbContributorsState) {
      $disable = $theForm->state['userLoginUnderway'];
      $title = (isset($dbPersonWorkState['title'])) ? $dbPersonWorkState['title'] : 'No Title'; 
      $theForm->DEBUGGER->becho('504a databaseState["countryOfProduction"]', $dbPersonWorkState['countryOfProduction'], SSFEntryForm::$debugRefreshIssues);
      self::displayEditDivHeader_2('edEditWorkDiv', '<span class="withEmphasis">Editing Entry </span>"' . $title . '"', 'Save', 'saveWork', 
                                      'savingWork', 'cancelWorkChanges');
      echo '<div class="entryFormSubheading" style="padding-top:0px;">' . self::$basicsLeader . '</div>';
      HTMLGen::addTextWidgetRow(self::asterisk() . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), $dbPersonWorkState['title'], 128, $disable);
  //    HTMLGen::addTextWidgetRow(self::asterisk() . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $dbPersonWorkState['yearProduced'], 4, $disable);
      SSFEntryForm::displayProductionYearAndCountry($dbPersonWorkState['yearProduced'], $dbPersonWorkState['countryOfProduction']);
      HTMLGen::addRunTimeWidgetsRow($dbPersonWorkState['runTime'], $disable);
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), self::asterisk() . 'Brief Synopsis', $dbPersonWorkState['synopsisOriginal'], 2048, 3, $disable);
      echo '<div class="entryFormSubheading" style="padding-top:12px;padding-bottom:2px">' . self::$eSubmissionLeader . '</div>';
      HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), $dbPersonWorkState['vimeoWebAddress'], 1024, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), $dbPersonWorkState['vimeoPassword'], 128, $disable);
  //    echo '<div class="entryFormSubheading">' . self::$formatsLeader . '</div>';
      HTMLGen::addRadioButtonWidgetRow(self::asterisk() . 'Submission Format', 'works', 'submissionFormat', $dbPersonWorkState['submissionFormat'], 4, "w", $disable); 
  //    $theForm->DEBUGGER->becho('Work Edit databaseState[anamorphic]', $dbPersonWorkState['anamorphic'], SSFEntryForm::$anamorphicDebug);
  //    HTMLGen::addAspectRatioAnamorphicRow($dbPersonWorkState['aspectRatio'], $dbPersonWorkState['anamorphic'], $disable);
  //    HTMLGen::addPixelDimensionsWidgetsRow($dbPersonWorkState['frameWidthInPixels'], $dbPersonWorkState['frameHeightInPixels'], $disable);
      // TODO Edit credits separately from the other stuff.
      echo '<div class="entryFormSubheading">' . self::$creditsLeader . '</div>';
      HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
      // Suppress user update of payment type after the payment has been made (as indicated by the presence of a check or paypal number.
      $alreadyBeenPaidIndicator = 'checkOrPaypalNumber';
      $alreadyBeenPaid = isset($dbPersonWorkState[$alreadyBeenPaidIndicator]) && ($dbPersonWorkState[$alreadyBeenPaidIndicator] != 0) && ($dbPersonWorkState[$alreadyBeenPaidIndicator] != '');
      $theForm->DEBUGGER->becho('alreadyBeenPaid', ($alreadyBeenPaid) ? 'PAID' : 'NOT YET PAID', -1);
      $theForm->DEBUGGER->belch('dbPersonWorkState', $dbPersonWorkState, -1);
      self::addPaymentWidgetsSection($dbPersonWorkState, $disable || $alreadyBeenPaid); // 5/5/14
      self::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Save', $disable);
      echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . self::$otherLeader . '</div>';
  //    HTMLGen::displayOriginalFormatSelector2013($dbPersonWorkState['originalFormat'], $disable); 
      HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $dbPersonWorkState['previouslyShownAt'], 2048, 2, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('webSite') . 'Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $dbPersonWorkState['webSite'], 1024, $disable);
      HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoURL') . 'Screen Snpshots', DatumProperties::getItemKeyFor('works', 'photoURL'), $dbPersonWorkState['photoURL'], 256, $disable);
  //    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $dbPersonWorkState['photoCredits'], 256, $disable);  // removed 3/22/14
      self::displayEditSectionFooter('<span class="withEmphasis">Finish Editing </span>"' . $title . '"', 'Save', 'saveWork', 'savingWork', 'cancelWorkChanges');
      echo '            <div style="clear:both;"></div>';
      echo "          </div> <!--  End edEditWorkDiv -->\r\n";
      echo '<script type="text/javascript">getUniqueElement("' . DatumProperties::getItemKeyFor('works', 'title') . '").focus();</script>' . PHP_EOL;
    }
    
    public static function displayThankYou($theForm, $dbPersonWorkState) {
      $aWorkIsDisplayed = isset($dbPersonWorkState['workId']);
      $theForm->DEBUGGER->belch('800 dbPersonWorkState', $dbPersonWorkState, -1);
      $payYourEntryFeeString = '<span class="highlightedTextColor">Don\'t forget to pay your entry fee</span>'; 
      $submitYourVideoString = '<span class="highlightedTextColor";>Remember to submit your video at <a href="http://vimeo.com">Vimeo</a></span> '
                             . 'and enter the Vimeo web address and password (if you choose to use one) by editing the entry above. '
                             . '(The free membership option should be adequate. <span class="highlightedTextColor";>Be sure to '
                             . 'check the Vimeo box to &quot;Allow other people to download the source video.&quot;</span> '
                             . 'Details for this selection are described in the '
                             . SSFEntryForm::entryRequirementsDisplayString('#media') . '.)';
      $workDisplayedPmtReceived = false;
      $workDisplayedMediaReceived = false;
      $workDisplayedHowPaid = '';
      $workDisplayedPayUpString = '';
      $thanksString = 'You may edit the information above, add another entry, or simply sign off. ' 
                    . 'You can sign in again later (until ' . date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()))
                    . ') to make modifications. ';
      $payUpViaPaypalString = $payYourEntryFeeString . ' via Paypal (above). Please pay for each entry separately. '
                            . '(You may opt to pay by check or money order instead. Just edit the entry above to indicate that intention.)';
//      $payUpViaCheckString = '<div style="margin-bottom:8px;">' 
      $payUpViaCheckString = '' 
                           . $payYourEntryFeeString . ' with a check or money order drawn on a US bank. '
                           . 'Make your check or money order out to Sans Souci Festival of Dance Cinema and mail it to' 
                           . '<div style="margin-left:30px;margin-top:8px;margin-bottom:10px;">' 
                           . SSFRunTimeValues::getMailEntryToAddress() . '</div>' . PHP_EOL
                           . 'Please print this page and include it with your payment. '
                           . '(You may opt to pay by Paypal instead. Just edit the entry above to indicate that intention.)';
      $lastWordString = 'If you have <span class="highlightedWordColor">questions</span> after reading the ' . SSFEntryForm::entryRequirementsDisplayString()
                      . ', feel free to send us an <a class="dodeco" href=\'mailto:questions@sanssoucifest.org\'>email</a>.';
    //  $theForm->DEBUGGER->becho('entryRequirementsDisplayString', $entryRequirementsDisplayString, -1);
      $theForm->DEBUGGER->becho('lastWordString', $lastWordString, -1);
      if ($aWorkIsDisplayed) {
        $workDisplayedPmtReceived = (isset($dbPersonWorkState['datePaid']) && ($dbPersonWorkState['datePaid'] != '') 
                                                                           && ($dbPersonWorkState['datePaid'] != '0000-00-00'));
        $workDisplayedHowPaid = (isset($dbPersonWorkState['howPaid'])) ? $dbPersonWorkState['howPaid'] : '';
        $workDisplayedMediaReceived = (isset($dbPersonWorkState['dateMediaReceived']) && ($dbPersonWorkState['dateMediaReceived'] != '') 
                                                                                      && ($dbPersonWorkState['dateMediaReceived'] != '0000-00-00'));
      }
      if (($workDisplayedHowPaid == 'check') || ($workDisplayedHowPaid == 'moneyOrder')) $workDisplayedPayUpString = $payUpViaCheckString;
      else if ($workDisplayedHowPaid == 'paypal') $workDisplayedPayUpString = $payUpViaPaypalString;
      $theForm->DEBUGGER->becho('workDisplayedPmtReceived', $workDisplayedPmtReceived, -1);
      $theForm->DEBUGGER->becho('workDisplayedHowPaid', $workDisplayedHowPaid, -1);
      echo '                <div id="edThankYouDiv" style="padding:0 8px 2px 8px;">' . PHP_EOL;
      self::displayEditSectionFooter('<span class="withEmphasis">Thanks for submitting your entry.</span>', 'Sign Off', 'signOff', 'signingOff', '');
      echo '                  <div class="bodyText" style="text-align:left;">' . PHP_EOL;
      echo '                    <div style="margin-bottom:10px;">' . $thanksString . '</div>' . PHP_EOL;
      if ($aWorkIsDisplayed && !$workDisplayedMediaReceived)
        echo '                    <div style="margin-bottom:8px;">' . $submitYourVideoString . '</div>' . PHP_EOL;
      if ($aWorkIsDisplayed && !$workDisplayedPmtReceived && ($workDisplayedPayUpString != ''))
        echo '                    <div style="margin-bottom:8px;">' . $workDisplayedPayUpString . '</div>' . PHP_EOL;
      echo '                    <div style="margin-bottom:10px;">' . $lastWordString . '</div>' . PHP_EOL;
      echo '                  </div>' . PHP_EOL;
      echo '                </div> <!-- End edThankYouDiv -->' . PHP_EOL;
    }

  } // end class SSFEntryForm ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--

?>
