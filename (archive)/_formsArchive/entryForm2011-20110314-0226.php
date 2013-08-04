<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - 2011 Entry Form</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  // Sign Off if the user has so requested. The hidden 'signOff' was set by javascript in HTMLGen::displayEditSectionFooter(). TERRIBLE DECOMPOSITION
  if (isset($_POST['signOff']) && ($_POST['signOff'] == 'Sign Off')) echo header("location: http://sanssoucifest.org/"); 
?>
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr><td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
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

  function itsMe() {
    document.getElementById("itsMeSubmit").value="ItsMe";
    document.getElementById("entryForm").submit();
  }
  
  function resumeLogin() {
    document.getElementById('userLoginUnderway').value = 1;
  }
  
  function cancelSubmit() {
//    alert('cancelSubmit');
    document.getElementById('hiddenInputSavingKey').value = 'Cancel';
    // TODO Why do I have pairs of inputs? saveXXX is the name & id on the Save/Submit button. 
    //      savingXXX is the hiddenInputSavingKey AND and additional hidden input created in HTMLGen::displayEditDivHeader_2.
    if (document.getElementById('saveNewPerson') !== null) { document.getElementById('saveNewPerson').value = ''; resumeLogin(); }
//    if (document.getElementById('savingNewPerson') !== null) { document.getElementById('savingNewPerson').value = ''; resumeLogin(); }
    if (document.getElementById('savePerson') !== null) { document.getElementById('savePerson').value = ''; }
//    if (document.getElementById('savingPerson') !== null) { document.getElementById('savingPerson').value = ''; }
    if (document.getElementById('saveNewWork') !== null) { document.getElementById('saveNewWork').value = ''; }
    if (document.getElementById('saveWork') !== null) { document.getElementById('saveWork').value = ''; }
//    if (document.getElementById('savingNewWork') !== null) { document.getElementById('savingNewWork').value = ''; }
//    if (document.getElementById('savingWork') !== null) { document.getElementById('savingWork').value = ''; }
//    if (document.getElementById('signingOff') !== null) { document.getElementById('signingOff').value = ''; }
    document.entryForm.submit();
  }

  function preSubmitValidation() {
    var usingAlertsForDebugging = false;
    var hiddenInputSavingKey = document.getElementById('hiddenInputSavingKey').value;
    if (document.getElementById(hiddenInputSavingKey) !== null) { document.getElementById(hiddenInputSavingKey).value = hiddenInputSavingKey; }
    if (usingAlertsForDebugging) { alert('hiddenInputSavingKey=' + hiddenInputSavingKey); }
    if (hiddenInputSavingKey=='signingOff') {
      //alert('Signing Off');
      return true; 
    }
    if (hiddenInputSavingKey=='Cancel') { return true; }
    if (hiddenInputSavingKey=='savingNewPerson') { return validPersonCreation(); }
    if (hiddenInputSavingKey=='savingPerson') { return validPersonEntry(); }
    if (hiddenInputSavingKey=='savingNewWork') { return computeRunTimeAndValidateWorkEntry(); }
    if (hiddenInputSavingKey=='savingWork') { 
      $valid = computeRunTimeAndValidateWorkEntry(); 
      if (usingAlertsForDebugging) { alert('savingWork is' + (($valid) ? '' : ' not') + ' valid'); } 
      return $valid; 
    }
    return true; 
  }

</script>

<?php 
// -- PHP classes ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  // Class phoneHome generates the email to send to SSF admins when a person or work is created or edited.

  class phoneHome {
    private static $to          = "entryform@sanssoucifest.org";
    private static $subject     = "Entry Form Submitted for ";
    private static $fieldNames  = "";
    private static $fieldValues = "";
    private static $message     = "";
    private static $headers     = "From: entryform@sanssoucifest.org\r\nReply-To: no-reply@sanssoucifest.org\r\nX-Mailer: PHP/";// . phpversion();
    private static $on = false;
    
    public static function turnOn() { $on = true; }
    public static function turnOff() { $on = false; }

    // returns $stringToAddTo . ',' . $stringToAdd but only uses the comma if $stringToAddTo != ''
    private static function addCommaDelimitedTextNoSpaces($stringToAddTo, $stringToAdd) { 
      if ($stringToAddTo != '') $stringToAddTo .= ",";
      $stringToAddTo .= $stringToAdd;
      return $stringToAddTo;
    }
  
    // Returns a name/value pair in the form 'Name: Value' and side-effects the globals
    // $fieldNames & $fieldValues by appending $name and $value respectively with appropriate commas and no spaces
    private static function addDataItem($name, $value) {
      self::$fieldNames = self::addCommaDelimitedTextNoSpaces(self::$fieldNames, $name);
      self::$fieldValues = self::addCommaDelimitedTextNoSpaces(self::$fieldValues, '"' . $value . '"');
      $nameValuePair = ($name . ": \"" . $value . "\"\r\n");
      return $nameValuePair;
    }
    
    public static function sendItNow() {
      self::$message .= "\r\n" . "\r\n" . self::$fieldNames . "\r\n" . self::$fieldValues;
      $mailedData = mail(self::$to, self::$subject, self::$message, self::$headers);
    }
  
    private static function initInfo($subject) {
      self::$subject = $subject;
      self::$fieldNames  = "";
      self::$fieldValues = "";
      self::$message     = "";
      self::$headers     = "From: entryform@sanssoucifest.org\r\n"
                         . "Reply-To: no-reply@sanssoucifest.org\r\n"
                         . "X-Mailer: PHP/" . phpversion();
      }
    
    public static function sendPersonInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Edited (' . $changeCount . ')' : 'Created';
      self::initInfo($leaderString . ' ' . $stateArray['people_name']);
      $dataItemNames = array(
        'people_personId', 'people_nickName', 'people_lastName', 'people_name', 'people_organization',
        'people_streetAddr1', 'people_streetAddr2', 'people_city', 'people_stateProvRegion', 'people_zipPostalCode', 'people_country',
        'people_phoneVoice', 'people_phoneMobile', 'people_phoneFax', 'people_email', 'people_password', 
        'people_notifyOf', 'people_howHeardAboutUs');
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
        if (is_array($dataValue)) {
          $valueString = ''; $separator = '';
          foreach($dataValue as $cellValue) { $valueString .= $separator . $cellValue; $separator = ', '; }
        } else $valueString = $dataValue;
        self::$message .= self::addDataItem($dataItemName, $valueString); 
      }
      self::sendItNow();
    }
    
    public static function sendEntryInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Edited (' . $changeCount . ')' : 'Created';
      self::initInfo($leaderString . ' "' . $stateArray['works_title'] . '"');
      $dataItemNames = array(
        'works_workId_forInfoOnly', 'works_title', 'works_titleForSort', 'works_designatedId', 'works_submitter', 'people_name', 
        'works_yearProduced', 'works_runTime', 'works_submissionFormat', 'works_originalFormat', 'works_synopsisOriginal', 
        'works_webSite', 'works_previouslyShownAt', 'works_photoCredits', 'works_howPaid', 'works_permissionsAtSubmission', 
        'works_aspectRatio', 'works_anamorphic', 'works_frameWidthInPixels', 'works_frameHeightInPixels', 
        'workContributors_Director', 'workContributors_Producer', 'workContributors_Choreographer', 'workContributors_DanceCompany', 
        'workContributors_PrincipalDancers', 'workContributors_MusicComposition', 'workContributors_MusicPerformance', 
        'workContributors_Camera', 'workContributors_Editor', 
        'workContributors_role_Other_1', 'workContributors_Other_1', 
        'workContributors_role_Other_2', 'workContributors_Other_2', 
        );
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
        self::$message .= self::addDataItem($dataItemName, $dataValue); 
      }
      self::sendItNow();
    }
  } // end class phoneHome
  
  
  // class entryForm
  
  class entryForm {
    // strings, tools, & metadata
    public $openErrorMessage = '';
    public $DEBUGGER;
    public $validLogin = false;

    // State
    // $state could be split into multiple arrays, e.g., metaData, workFields, submitterFields, paFields, ...
    public $state = array(); 
    public $priorEmail = '';
    public $priorPassword = '';

    // ---- Debugger setup ---- ---- ---- ---- 
    static public $anamorphicDebug = -1;
    static public $displayDataStructures = -1;
    static public $debugChangeCount = -1;
    static public $debugLoginName = -1;
    static public $debugPeopleLoginName = -1;
    static public $debugPhpValidEmailAddress = -1;
    static public $debugRefreshIssues = -1;
    static public $debugSignIn = -1;
    static public $debugStateVariablesAtBottom = -1;
    static public $debugStateVariablesAtTop = -1;
    static public $debugValidLogin = -1;
  
    public function __construct() {
      $DEBUGGER = new SSFDebug();
      $DEBUGGER->enableBelch(false);
      $DEBUGGER->enableBecho(false);
      $init();
    }
    
    private function $init() {
      HTMLGen::setCaller('user');
      phoneHome::turnOn();  // turnOn() or turnOff()
    
      // Initialize $editorState from POST and other sources.
      $editorState = array();
      foreach ($_POST as $postKey => $postValue) {
        $this->state[$postKey] = (isset($postValue)) ? $postValue : "";
      }
      if (!isset($this->state['userLoginUnderway'])) { $this->state['userLoginUnderway'] = 1; }
      if (!isset($this->state['theItsMePersonId'])) { $this->state['theItsMePersonId'] = 0; }
      if (!isset($this->state['submitterInPeopleTable'])) { $this->state['submitterInPeopleTable'] = 0; }
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
    
      // Set $callForEntriesId to the current default value returned by SSFRunTimeValues.
      $callForEntriesId = $this->state['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
      
      $editorDEBUGGER->belch('editorState before Sign In', $this->state, $displayDataStructures);
      $editorDEBUGGER->belch('_POST', $_POST, $displayDataStructures);
    }
  
    public function setPriorEmail($string) { this->priorEmail = (isset($string) ? $string : ''; }
    public function setPriorPassword($string) { this->priorPassword = (isset($string) ? $string : ''; }
    
    private static function badEmailAlert($n) { if (self::$debugPhpValidEmailAddress == 1) echo 'badEmailAlert ' . $n; }
    
    private static function validEmailAddress($str) {
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
      // Requiring a password for a new user is handled once they get to the Create Person form.
      this->validLogin = 0;
      if (self::$debugValidLogin == 1) var_dump(debug_backtrace());
      if (($newPW == '') && ($dbPW != '')) { 
        // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
        $this->DEBUGGER->belch('User entered blank password that does not match the DB', '', self::$debugValidLogin);
        // Mail the user their password.
        $to      =  $newLoginName;
        $subject = "To sign in";
        $message = "Dear " . $dbLoginName . ",\r\n\r\n"
                 . "To sign in at http://sanssoucifest.org/onlineEntryForm/entryForm2011.php use " . $dbPW . "\r\n\r\n"
                 . "Best Regards, \r\nYour Friendly Helper at SansSouciFest.org\r\n\r\nDo not reply to this message.\r\n";
        $headers = "From: YourFriendlyHelper@sanssoucifest.org" . "\r\n"
                 . "Bcc: entryForm@sanssoucifest.org" . "\r\n"
                 . "Reply-To: no-reply@sanssoucifest.org" . "\r\n"
                 . "X-Mailer: PHP/" . phpversion();
        $this->DEBUGGER->becho('to', $to, -1);
        $this->DEBUGGER->becho('subject', $subject, -1);
        $this->DEBUGGER->becho('message', $message, -1);
        $this->DEBUGGER->becho('headers', $headers, -1);
        $mailedPassword = mail($to, $subject, $message, $headers);
        $openErrorMessage = "NOTICE:<br><br>You did not enter your password. ";
        if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $newLoginName . "."
                                               . "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
      } else if (($dbPW != '') && ($newPW != $dbPW)) { 
        // User entered incorrect non-blank password. Make them login again.
        $this->DEBUGGER->belch('User entered incorrect non-blank password', $newPW, self::$debugValidLogin);
        $this->openErrorMessage = "ERROR:<br><br>The password you entered does not match your Sign In Email Address."
                                . "<br>If you simply forgot your password, leave it blank and Sign In again."
                                . "<br>You'll receive more help after that.";
        $this->DEBUGGER->becho('isValidLogin $dbPW', $dbPW, self::$debugValidLogin);
        $this->DEBUGGER->becho('isValidLogin editorState[pwFromLogin]', $newPW, self::$debugValidLogin);
      } else if ($requirePassword && ($newPW == '')) {
        // User entered blank password when a password is required.
        $this->DEBUGGER->belch('User entered blank password when a password is required.', '', self::$debugValidLogin);
        $this->openErrorMessage = "NOTICE:<br><br>Please enter a password.";
      } else {
        // Username and password is OK.
        $this->validLogin = 1;
  //      echo '<input type="hidden" id="createNewPerson" name="createNewPerson" value="Create New Person">' . "\r\n";
        $this->DEBUGGER->becho('isValidLogin validLogin', $this->validLogin, self::$debugValidLogin);
      }
      return self::$validLogin;
    }

  private function setState($keyName, $keyValue, $debug=0 $debugId='') {
    if (DOMDocument::getElementById($keyName) == null) 
        echo '<input type="hidden" id="' . $keyName . '" name="' . $keyName . '" value="">' . "\r\n";
    $this->state['theItsMePersonId'] = $keyValue;
    echo "<script type='text/javascript'>document.getElementById('" . $keyName . "').value='" . $keyValue . "';</script>\r\n";
    $this->DEBUGGER->becho((($debugId=='') ? '' : $debugId . ' ') .'editorState[keyName]', $this->state[$keyName], $debug);
    if ($debug == 1) var_dump(debug_backtrace());
    return $newValue;
  }

/*
  // These setter functions assume that there is already a hidden input for <whatever> is being set.
  public function setPeopleLoginName($newValue) { setState('people_loginName', $newValue, self::$debugPeopleLoginName); }
  public function setPeopleLoginPassword($newValue) { setState('loginPasswordCache', $newValue, self::$debugPeopleLoginName); }
  public function setTheItsMePersonId($newValue) { setState('theItsMePersonId', $newValue, self::$debugPeopleLoginName); }
  public function setTheItsMePersonPassword($newValue) { setState('theItsMePersonPassword', self::$newValue, $debugPeopleLoginName); }
  public function setTheItsMePersonName($newValue) { setState('theItsMePersonName', $newValue, self::$debugPeopleLoginName); }
*/

    public function setUpSubmitter($loginName, $loginPassword, $submitterDBState) {
      $this->state['submitterInPeopleTable'] = 1;
      $this->state['userLoginUnderway'] = isset($submitterDBState["loginName"]) && isset($submitterDBState["password"])
                                           &&  !isValidLogin($loginName, $submitterDBState["loginName"], 
                                                        $loginPassword, $submitterDBState['password'], 
                                                        $this->state['passwordEntryRequired']);
      if (!$this->state['userLoginUnderway']) {
        $this->state['loginUserId'] = $submitterDBState['personId'];
        //setPeopleLoginName($loginName, 'PE1');
        $this->setState('people_loginName', $loginName, self::$debugPeopleLoginName, 'PE1');
        //setPeopleLoginPassword($loginPassword, 'PE1');
        $this->setState('loginPasswordCache', $loginPassword, self::$debugPeopleLoginName, 'PE1');
        return true;
      } else { // since the login name is not valid
        $this->state['loginUserId'] = 0;
        //setPeopleLoginName('', 'PE2');
        $this->setState('people_loginName', '', self::$debugPeopleLoginName, 'PE2');
        //setPeopleLoginPassword('', 'PE2');
        $this->setState('loginPasswordCache', '', self::$debugPeopleLoginName, 'PE2');
        return false;
      }
    }
  
    // Sign In
    public function signIn() {
      $editorDEBUGGER->becho('08', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
      if ($itsMe) {
        $editorDEBUGGER->becho('09', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
        $itsMeDBState['personId'] = $editorState['theItsMePersonId'];
        $itsMeDBState['password'] = $editorState['theItsMePersonPassword'];
        $itsMeDBState['name'] = $editorState['theItsMePersonName'];
        setUpSubmitter($editorState['loginName'], $editorState['pwFromLogin'], $itsMeDBState);
      } else { // since signingIn
        $editorDEBUGGER->becho('10', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
        $editorState['userLoginUnderway'] = 1;
        $validUserName = validEmailAddress($editorState['loginName']);
        if ($validUserName) {
          // On Success
          $editorDEBUGGER->becho('11', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
          // Check to see if the Submitter has no loginName in the DB
          $submitterDBState = SSFQuery::selectPersonByAlternateKey('loginName', $editorState['loginName']);
          if ($submitterDBState !== false) { // The Submitter loginName is in the DB.
            $editorDEBUGGER->becho('12', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
            setUpSubmitter($editorState['loginName'], $editorState['pwFromLogin'], $submitterDBState);
          } else { // since the submitter is not in the DB as a loginName
            $editorDEBUGGER->becho('13', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
            $submitterDBState2 = SSFQuery::selectPersonByAlternateKey('email', $editorState['loginName']);
            if ($submitterDBState2 === false) { 
              // The Submitter has no email address in the DB either so this must be a New Person.
              $editorDEBUGGER->becho('14', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
              $editorState['createNewPerson'] = 'Create New Person';
              $creatingNewPerson = true;
              $editorState['submitterInPeopleTable'] = 0;
              $editorState['passwordEntryRequired'] = true;
              $editorState['userLoginUnderway'] = 0;
            } else { 
              // since the Submitter has an email address but no loginName in the db
              $editorDEBUGGER->becho('15', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
              $editorState['itsMeSubmit'] = 'Its Me';
              setTheItsMePersonId($submitterDBState2['personId']);
              setTheItsMePersonPassword($submitterDBState2['password']);
              setTheItsMePersonName($submitterDBState2['name']);
              $openErrorMessage = "Although you have never logged in before,<br>we find we have your email address.<br>"
                                . 'If you are ' . $submitterDBState2['nickName'] . ' ' . $submitterDBState2['lastName'] . ',<br>'
                                . "click <a href='#' onclick='javascript:itsMe()'>YES, It's Me</a>."
                                . "<br><br>If not, please login with a different login name / email address.<br><br>";
              $editorState['userLoginUnderway'] = 1;
            }
          }
        } else { // since this is not a valid user name
          $editorDEBUGGER->becho('17', 'Signing In with ' . $editorState['loginName'], $debugSignIn);
          $openErrorMessage = "ERROR:<br>Please enter a valid email address. ";
          $editorState['userLoginUnderway'] = 1;
        }
      }
    }
  
    public function insertPerson() {
      $personInDatabase = SSFQuery::personExistsInDatabase($this->state['people_email']);
      $this->DEBUGGER->becho('10 personInDatabase', $personInDatabase, -1);
      $this->DEBUGGER->becho('10 editorState[loginNameSaved]', $this->state['loginNameSaved'], $debugLoginName);
      $this->DEBUGGER->becho('10 editorState[people_email]', $this->state['people_email'], $debugLoginName);
      if ($personInDatabase !== false) { // Person's email is in DB so, either (this was a browser refresh so do nothing) 
                                         // or this submitter should not be using this email address since it's already in use.
        if ($this->state['loginNameSaved'] != $this->state['people_email']) {
          // This person started with one email address at the login page and then changed 
          // that email address on the Create Person form. So, now we need to reject the
          // email on the Create Person form.
          // Set state so that we'll redisplay the Create New Person page.
          $this->state['hiddenInputSavingKey'] = '';
          $this->state['createNewPerson'] = 'Create New Person';
          $this->state['people_email'] = $this->state['loginNameSaved'];
          $personCreationRedo = true;
          $creatingNewPerson = true;
          $displayingData = false;
        } else { // this was a browser refresh so do nothing
          $this->state['people_personId'] = $personInDatabase;
          $this->state['loginUserId'] = $personInDatabase;
          $this->state['submitterInPeopleTable'] = 1;
        }
      } else { // OK, do the DB update
        $editorDEBUGGER->becho('10', 'Insert a newly created person', -1);
        $this->state['people_loginName'] = setPeopleLoginName($this->state['people_email']);
        $result = SSFQuery::insertData('people', $this->state);
        if ($result !== false) {
          $this->state['people_personId'] = $result;
          $this->state['loginUserId'] = $result;
          $this->state['submitterInPeopleTable'] = 1;
          phoneHome::sendPersonInfo($this->state, 0);
        }
      }
    }

    public function updatePerson() {
      $this->DEBUGGER->becho('20', 'Save an updated person', -1);
      $personId = (isset($this->state['editingPersonId'])) ? $this->state['editingPersonId'] : 0;
      if ($personId != 0) {
        $currentValueArray = SSFQuery::selectPersonFor($personId);
        $multiplePeopleExistInDatabase = SSFQuery::multiplePeopleExistInDatabase($this->state['people_email']);
        $this->DEBUGGER->becho('20 editorState[people_email]', $this->state['people_email'], $debugLoginName);
        $this->DEBUGGER->becho('20 currentValueArray[email]', $currentValueArray['email'], $debugLoginName);
        $this->DEBUGGER->becho('20 multiplePeopleExistInDatabase', $multiplePeopleExistInDatabase, $debugLoginName);
        if (($this->state['people_email'] == $currentValueArray['email']) || !$multiplePeopleExistInDatabase) {
          // The user did not change their email address in a harmful way  
          $this->state['people_loginName'] = setPeopleLoginName($this->state['people_email']);
          $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $this->state, 'personId', $personId);
          $this->DEBUGGER->becho('people changeCount', $changeCount, $debugChangeCount);
          $this->state['people_personId'] = $personId;
          if ($changeCount > 0) phoneHome::sendPersonInfo($this->state, 1, $changeCount);
        } else { // The user changed their email to an email address belonging to another user.
          // So, now we need to reject the email address on the Edit Person form.
          // Set state so that we'll redisplay the Edit New Person page.
          $this->state['hiddenInputSavingKey'] = '';
          $this->state['editPerson'] = 'Edit';
          $this->state['people_email'] = $currentValueArray['email'];
          $personEditBadEmail = true;
          $editingPerson = true;
          $displayingData = false;
        }
      }
    }

    public function insertWork() {
      $this->state['works_titleForSort'] = HTMLGen::getTitleForSort($this->state['works_title']);
      $workInDatabase = SSFQuery::workExistsInDatabase($this->state['works_submitter'], $callForEntriesId, $this->state['works_title']);
      if ($workInDatabase !== false) { // This was a browser refresh
          $this->state['workSelector'] = $workInDatabase;
      } else { // OK, do the DB update
        $this->DEBUGGER->becho('30', 'Insert a newly created work', -1);
        $this->state['works_callForEntries'] = $callForEntriesId;
        $workId = SSFQuery::insertData('works', $this->state);
        if ($workId !== false) {
          $this->state['workSelector'] = $workId;
          $this->DEBUGGER->becho('500 editorState["workSelector"]', $this->state['workSelector'], $debugRefreshIssues);
          SSFQuery::updateDBForWorkContributors($this->state, $workId);
          $this->state['works_workId_forInfoOnly'] = $workId;
          phoneHome::sendEntryInfo($this->state, 0);
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
        $changeCount = SSFQuery::updateDBFor('works', $currentWorkValueArray, $this->state, 'workId', $workId);
        $changeCount += SSFQuery::updateDBForWorkContributors($this->state, $workId);
        $this->DEBUGGER->becho('work changeCount', $changeCount, $debugChangeCount);
        SSFDB::debugOff(); 
        $this->state['works_workId_forInfoOnly'] = $workId;
        if ($changeCount > 0) phoneHome::sendEntryInfo($this->state, 1, $changeCount);
      }
    }



  } // end class entryForm

// -- compute global state variables ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  $editorDEBUGGER->becho('creatingNewPerson 0', $creatingNewPerson, $debugStateVariablesAtTop);

  $creatingNewPerson = $creatingNewPerson || (isset($theForm->state['createNewPerson']) && $theForm->state['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($theForm->state['createNewWork']) && $theForm->state['createNewWork'] == 'Create New Entry');
  $editingPerson = (isset($theForm->state['editPerson']) && $theForm->state['editPerson'] == 'Edit');
  $editingWork = (isset($theForm->state['editWork']) && $theForm->state['editWork'] == 'Edit');
  $displayingData = !($theForm->state['userLoginUnderway'] || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);
  $signingOff = (isset($theForm->state['signOff']) && ($theForm->state['signOff'] == 'Sign Off'));
  $personCreationRedo = false;
  $personEditBadEmail = false;

  $editorDEBUGGER->becho('editorState[userLoginUnderway]', (isset($theForm->state['userLoginUnderway'])) ? $theForm->state['userLoginUnderway'] : '', $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('signingOff', $signingOff, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtTop);
  

// Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ---- ---- ---- ---- ---- ---- 

/* TODO: Before saving, use __TABLE__lastModificationDate to verify that data has not changed since read.
         works_, people_, workContributors_LastModified need to be set from DB at read-time & used to check 
         that update from this form is still valid. That is, OK if LastModified value == DB value; otherwise, 
         tell user they cannot submit from this form and must login again. */

  // Allow the user to Sign Off - We never get here because the page is loaded by the 1st PHP statement above.
//  echo '<input type="hidden" id="signOffNow" name="signOffNow" value="' . $theForm->state['signOffNow'] . '">' . "\r\n";
  if ($signingOff) {
    $editorDEBUGGER->becho('*** ERROR 10 signingOff', $signingOff, 1);
    $theForm->state['userLoginUnderway'] = 1;
    $theForm->state['people_personId'] = 0;
    $theForm->state['loginUserId'] = 0;
    $theForm->state['loginPasswordCache'] = '';
    $theForm->state['submitterInPeopleTable'] = 0;
//    $theForm->state['signOffNow'] = 'signOffNow';
//    echo "<script type='text/javascript'>document.getElementById('signOffNow').value='signOffNow';</script>\r\n";
  }



// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----
  $theForm = new entryForm();
  $theForm->setPriorEmail($dbPersonWorkState['email']);
  $theForm->setPriorPassword($dbPersonWorkState['password']); 
  $preSubmitValidationParamString = "'" . $theform->priorEmail . "', '" . $theform->priorPassword . "'";

?>

<!-- Switch from table-based formatting to primarily DIV-based formatting ---- ---- ---- ---- ---- ---- ---- ---- -->

   <div id="encloseEntireFormDiv" class="entryFormSection"> <!-- style="background-color:#333;" border:dashed 1px green; -->
                                     

<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

      <form name="entryForm" id="entryForm" style="border:none 1px pink;" 
            onSubmit="return preSubmitValidation(<?php echo $preSubmitValidationParamString; ?>);"
            action="entryForm2011.php" method="post">

<?php 

//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

/*
  echo '<input type="hidden" id="people_loginName" name="people_loginName" value="">' . "\r\n";
  echo '<input type="hidden" id="loginPasswordCache" name="loginPasswordCache" value="">' . "\r\n";
  echo '<input type="hidden" id="theItsMePersonId" name="theItsMePersonId" value="">' . "\r\n";
  echo '<input type="hidden" id="theItsMePersonPassword" name="theItsMePersonPassword" value="">' . "\r\n";
  echo '<input type="hidden" id="theItsMePersonName" name="theItsMePersonName" value="">' . "\r\n";
*/

  // Sign In
  echo '<input type="hidden" id="itsMeSubmit" name="itsMeSubmit">' . "\r\n";
  $creatingNewPerson = false;
  $signingIn = (isset($theForm->state['signInSubmit']) && ($theForm->state['signInSubmit'] == 'Sign In')); 
  $itsMe = (isset($theForm->state['itsMeSubmit']) && ($theForm->state['itsMeSubmit'] == 'ItsMe'));
  $editorDEBUGGER->becho('07', 'signingIn = ' . $signingIn, $debugSignIn);
  $editorDEBUGGER->becho('07', '$theForm->state["itsMeSubmit"] = ' . ((isset($theForm->state['itsMeSubmit'])) ? $theForm->state['itsMeSubmit'] : ''), $debugSignIn);
  $editorDEBUGGER->becho('07', 'itsMe = ' . $itsMe, $debugSignIn);
  if ($theForm->state['userLoginUnderway'] && ($signingIn || $itsMe)) $theForm->signIn();

// -- compute global state variables ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  $editorDEBUGGER->becho('creatingNewPerson 0', $creatingNewPerson, $debugStateVariablesAtTop);

  $creatingNewPerson = $creatingNewPerson || (isset($theForm->state['createNewPerson']) && $theForm->state['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($theForm->state['createNewWork']) && $theForm->state['createNewWork'] == 'Create New Entry');
  $editingPerson = (isset($theForm->state['editPerson']) && $theForm->state['editPerson'] == 'Edit');
  $editingWork = (isset($theForm->state['editWork']) && $theForm->state['editWork'] == 'Edit');
  $displayingData = !($theForm->state['userLoginUnderway'] || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);
  $signingOff = (isset($theForm->state['signOff']) && ($theForm->state['signOff'] == 'Sign Off'));
  $personCreationRedo = false;
  $personEditBadEmail = false;

  $theForm->DEBUGGER->becho('editorState[userLoginUnderway]', (isset($theForm->state['userLoginUnderway'])) ? $theForm->state['userLoginUnderway'] : '', $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('signingOff', $signingOff, $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtTop);
  $theForm->DEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtTop);
  

// Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ---- ---- ---- ---- ---- ---- 

/* TODO: Before saving, use __TABLE__lastModificationDate to verify that data has not changed since read.
         works_, people_, workContributors_LastModified need to be set from DB at read-time & used to check 
         that update from this form is still valid. That is, OK if LastModified value == DB value; otherwise, 
         tell user they cannot submit from this form and must login again. */

  // Allow the user to Sign Off - We never get here because the page is loaded by the 1st PHP statement above.
//  echo '<input type="hidden" id="signOffNow" name="signOffNow" value="' . $theForm->state['signOffNow'] . '">' . "\r\n";
  if ($signingOff) {
    $editorDEBUGGER->becho('*** ERROR 10 signingOff', $signingOff, 1);
    $theForm->state['userLoginUnderway'] = 1;
    $theForm->state['people_personId'] = 0;
    $theForm->state['loginUserId'] = 0;
    $theForm->state['loginPasswordCache'] = '';
    $theForm->state['submitterInPeopleTable'] = 0;
//    $theForm->state['signOffNow'] = 'signOffNow';
//    echo "<script type='text/javascript'>document.getElementById('signOffNow').value='signOffNow';</script>\r\n";
  }

  // Insert a newly created person if appropriate
  if (isset($theForm->state['hiddenInputSavingKey']) && ($theForm->state['hiddenInputSavingKey'] == 'savingNewPerson')) 
    $theForm->insertPerson();
  
  // Save an updated person if appropriate
  if (isset($theForm->state['hiddenInputSavingKey']) && ($theForm->state['hiddenInputSavingKey'] == 'savingPerson')) 
    $theForm->updatePerson() 
    

  // Insert a newly created work if appropriate
  if (isset($theForm->state['hiddenInputSavingKey']) && ($theForm->state['hiddenInputSavingKey'] == 'savingNewWork')) 
    insertWork();
  
  // Save an updated work if appropriate
  if (isset($theForm->state['hiddenInputSavingKey']) && ($theForm->state['hiddenInputSavingKey'] == 'savingWork')) 
    updateWork();

  $theForm->DEBUGGER->belch('100 editorState', $theForm->state, $displayDataStructures);
  $theForm->DEBUGGER->belch('101 _POST', $_POST, 0);

// -- Initialize $dbPersonWorkState & $dbContributorsState  ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

      $loggedInPersonDefined = (isset($theForm->state['loginUserId'])); 
      $personIsZero = ($loggedInPersonDefined && ($theForm->state['loginUserId'] == 0)); 
      $personIsSpecified = ($loggedInPersonDefined && !$personIsZero);
      $workIdSelected = 0;
      $workIsSpecified = false;
      $dbPersonWorkState = array();
      $dbContributorsState = array();
      $atLeastOneWorkExistsForThisCallAndPerson = false;
      $earlyDeadlineHasPassed = SSFRunTimeValues::earlyDeadlineHasPassed();
      $finalDeadlineHasPassed = SSFRunTimeValues::finalDeadlineHasPassed();
      $theForm->DEBUGGER->becho('finalDeadlineHasPassed', (($finalDeadlineHasPassed) ? 'Final deadline passed' : 'Final deadline NOT passed.'), -1);
      $entryFeeAmount = (!$earlyDeadlineHasPassed) ? SSFRunTimeValues::getEarlyDeadlineFeeString() : SSFRunTimeValues::getFinalDeadlineFeeString();

      // Value for workExists is set immediately below.
      echo '<input type="hidden" id="workExists" name="workExists" value="">' . "\r\n"; 

      // This function uses and side-effects global variables
      public function initializeWorkDatabaseState($creatingNewWork) {
        global $dbPersonWorkState, $dbContributorsState, $atLeastOneWorkExistsForThisCallAndPerson; // out
        $workIsSpecified = (!$creatingNewWork && isset($theForm->state['workSelector']) && $theForm->state['workSelector'] != '' && ($theForm->state['workSelector'] != 0));
        $theForm->DEBUGGER->becho('600 editorState[workSelector]', $theForm->state['workSelector'], -1);
        if ($workIsSpecified) {
          $dbPersonWorkState = SSFQuery::selectSubmitterAndWorkNoCommsFor($theForm->state['workSelector']); 
          $dbContributorsState = SSFQuery::selectContributorsFor($theForm->state['workSelector']);  
          $atLeastOneWorkExistsForThisCallAndPerson = true;
          $theForm->DEBUGGER->becho('600 atLeastOneWorkExistsForThisCallAndPerson', $atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
        echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $atLeastOneWorkExistsForThisCallAndPerson . '";</script>';
        return $workIsSpecified;
      }

      if ($personIsSpecified) {
        $workIsSpecified = initializeWorkDatabaseState($creatingNewWork);
        if (!$workIsSpecified) { // That is, only the person is specified.
          $dbPersonWorkState = SSFQuery::selectPersonFor($theForm->state['loginUserId']);
          $atLeastOneWorkExistsForThisCallAndPerson = SSFQuery::submitterHasWorksForThisCall($theForm->state['loginUserId']);
          echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $atLeastOneWorkExistsForThisCallAndPerson . '";</script>';
          $this->DEBUGGER->becho('201 atLeastOneWorkExistsForThisCallAndPerson', $atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
      }

      // support for passing $dbPersonWorkState['email'] && $dbPersonWorkState['password'] to preSubmitValidation() - What a hack!
      echo '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($dbPersonWorkState['email']) ? $dbPersonWorkState['email'] : '') . '">' . "\r\n"; 
      echo '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($dbPersonWorkState['password']) ? $dbPersonWorkState['password'] : '') . '">' . "\r\n"; 
      // support for computed full name
      echo '<input type="hidden" id="dbName" name="dbName" value="' . (isset($dbPersonWorkState['name']) ? $dbPersonWorkState['name'] : '') . '">' . "\r\n"; 

$editorDEBUGGER->becho('501 editorState["workSelector"]', $theForm->state['workSelector'], $debugRefreshIssues);
$editorDEBUGGER->belch('102. $dbPersonWorkState', $dbPersonWorkState, $displayDataStructures);
$editorDEBUGGER->becho('personIsSpecified', $personIsSpecified, $displayDataStructures);
$editorDEBUGGER->becho('workIsSpecified', $workIsSpecified, $displayDataStructures);

     $require = HTMLGen::requiredFieldString();

?>
                                     

<!-- Begin loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php if ($theForm->state['userLoginUnderway']) {
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
        if ($theForm->state['userLoginUnderway']) { 
          echo '<div class="bodyTextOnBlack" '
             . 'style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 6px 4px;color: #FFFF66;">'
             . $openErrorMessage . '</div>';
        }
//        $showBlurb = $theForm->state['userLoginUnderway'] && !$theForm->state['validLogin'] && (!isset($openErrorMessage) || $openErrorMessage == '');
        $showBlurb = $theForm->state['userLoginUnderway'] && (!isset($openErrorMessage) || $openErrorMessage == '');
echo '              </td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">' . "\r\n";
  if ($showBlurb) echo '<div class="bodyTextOnBlack" style="text-align:left;padding:0px 54px 24px 54px;">Sans '
                 . ' Souci, an international festival of dance cinema, invites and encourages submissions from all artists regardless of' 
                 . ' credentials and affiliations. Accepted works will be screened Friday &amp; Saturday, September 16th &amp; 17th, 2011'
                 . ' in Boulder, Colorado, USA.</div>' . "\r\n";
echo '                <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">' . "\r\n";
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in.</td></tr>' . "\r\n";
echo '                  <tr>' . "\r\n";
echo '                    <td height="28" align="right" class="entryFormDescription" style="width:242px;"> ' . "\r\n";
echo '                      <a href="javascript:window.void(0)" onMouseOver="flyoverPopup(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')"' . "\r\n";
echo '                        onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')">Email Address / Login Name</a>: </td>' . "\r\n";
echo '                    <td height="28" align="left" class="entryFormField"><input type="text" name="loginName" id="loginName" ' . "\r\n";
echo '                         value="' . $theForm->state['loginName'] . '" ' . "onKeyPress='return submitEnter(this, event)'" . "\r\n";
echo '                         onchange="document.getElementById(' . HTMLGen::simpleQuote('people_loginName') . ').value=this.value"' . "\r\n";
echo '                         class="entryFormInputFieldShort" maxlength="100">' . "\r\n";
echo '                         <!-- onBlur="ValidEmail(this);" -->' . "\r\n";
echo '                    </td>' . "\r\n";
echo '                  </tr>' . "\r\n";
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0">If you have a password and you know what it is, enter it below.</td></tr>' . "\r\n";
echo '                  <tr>' . "\r\n";
echo '                    <td height="28" align="right" class="entryFormDescription">Password: </td>' . "\r\n";
echo '                    <td height="28" align="left" class="entryFormField"><input type="password" name="pwFromLogin" id="pwFromLogin" ' . "\r\n";
echo '                       value="' . $theForm->state['pwFromLogin'] . '" class="entryFormInputFieldShorter" maxlength="100"><span ' . "\r\n";
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
echo '        <script type="text/javascript">getUniqueElement("loginName").focus()</script>' . "\r\n";
} ?>
<!-- End loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin entryFormSectionsDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id = "entryFormSectionsDiv" class="entryFormSection">
<?php
  if (!$theForm->state['userLoginUnderway']) {
    echo '          <div class="programPageTitleText" style="float:none;">Entry Form, 2011</div>' . "\r\n"; // TODO Get the year string from the DB
    echo '          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="font-size:13.75px;text-align:left;padding:6px 8px 0px 8px;">To' . "\r\n";
    echo '            make a submission, complete this form and adhere' . "\r\n";
    echo '            to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open(\'entryRequirementsInWindow2011.php\',' . "\r\n";
    echo '            "EntryRequirementsWindow","directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640",false);' . "\r\n";
    echo '            entryRequirementsWindow.focus();">Entry Requirements</a>. You may return later to print or edit this form by signing in again. ' . "\r\n";
    if (!$displayingData) echo "Save your changes by clicking the " . (($creatingNewPerson || $creatingNewWork) ? 'Submit' : 'Save') . " button."; 
    echo (($editingWork) ? ' Note that payment and release information is at the very bottom of the form.' : '');
    echo '          </div>' . "\r\n";
  }
?>
          <div id='editSectionsContainer' style='margin:0 auto 10px auto;padding:0 8px;border:none cyan 1px;'>

<!-- Begin Data Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id="edDataDiv">
        
<!-- display Person Information -->
          <div class="entryFormSectionHeading">
            <div style="float:left;padding-top:4px;padding-bottom:4px;"><?php $personOrSubmitterText = 'Submitter:'; echo $personOrSubmitterText ?> <!-- TODO FIX $personOrSubmitterText -->
                <?php if ($personIsSpecified) echo $dbPersonWorkState['name'] /* . " <span class='idDisplayText'>" . $dbPersonWorkState['personId'] . "</span>" */; ?>
            </div>
            <div style="float:right;padding-right:4px;padding-bottom:0;">
<?php if ($personIsSpecified) { echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">' . "\r\n"; }                
?>                       
            </div>
            <div style="clear:both;padding:0;margin:0;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id = "edPersonDiv" style="text-align:left;">
            <?php if ($personIsSpecified) { HTMLGen::displayPersonDetail($dbPersonWorkState, $forAdmin=false); } ?>
          </div> <!-- id = "edPersonDiv" -->

<!-- display Work Selector -->
          <div class="entryFormSectionHeading">
            <div style="float:left;text-align:left;padding-bottom:4px;">Select an entry or create a new one. 
                                   <span style="font-size:12px;color:#F9F9CC;">(A $<?php echo $entryFeeAmount;?> entry fee applies to each work entered.)</span></div>
            <div style='clear:both;'><hr class="horizontalSeparatorFull"></div>
          </div>
          <div class='formRowContainer'>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
<?php $workIdSelected = HTMLGen::displayWorkSelector('entryForm', $theForm->state['loginUserId'], $theForm->state, '-- select an entry --'); 
    if ($workIdSelected !=  $theForm->state['workSelector']) {
      // This is an ugly repeat of code executed above for $dbPersonWorkState and $dbContributorsState initialization
      $theForm->state['workSelector'] = $workIdSelected;
      $workIsSpecified = initializeWorkDatabaseState($creatingNewWork);
    }
    $editorDEBUGGER->becho('502 editorState["workSelector"]', $theForm->state['workSelector'], -1);
?>
              </div>
              <div style='float:left;padding-left:20px;'>
                <input type='submit' id='createNewWork' name='createNewWork' value='Create New Entry'
                       <?php if ($finalDeadlineHasPassed) echo "disabled='disabled'"; ?> >
              </div>
              <div style='clear:both;'></div>
            </div>
          <div style='clear:both;'></div>
          </div>

<!-- display Work Information -->
<?php 
  if ($workIsSpecified) {
    echo "          <div class='entryFormSectionHeading'>\r\n";
    echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;">Entry: "' . $dbPersonWorkState['title'] . '"';
    echo "            </div>\r\n";
    echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
    echo '              <input type="submit" id="editWork" name="editWork" value="Edit">' . "\r\n";
    echo "            </div>\r\n";
    echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
    echo "          </div>\r\n";
    echo "          <div id='edEntriesDiv' style='text-align:left;'>\r\n";
                    $editorDEBUGGER->becho('504 databaseState["workId"]', $dbPersonWorkState['workId'], $debugRefreshIssues);
                    HTMLGen::displayWorkDetail($dbPersonWorkState, $dbContributorsState);
    echo "          </div> <!-- id=edEntriesDiv -->\r\n";
  }
?>

        </div> <!-- End edDataDiv -->
<!-- End Data Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Hidden Inputs to cache state ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

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
        <input type="hidden" id="editingPersonId" name="editingPersonId" value="<?php echo (isset($dbPersonWorkState['personId']) ? $dbPersonWorkState['personId'] : 0); ?>">
        <input type="hidden" id="editingWorkId" name="editingWorkId" value="<?php echo (isset($dbPersonWorkState['workId']) ? $dbPersonWorkState['workId'] : 0);?>">
        <input type="hidden" id="maxContributorOrder" name="maxContributorOrder" value="<?php echo $theForm->state['maxContributorOrder']; ?>" > 
        <input type="hidden" id="workLastModified" name="workLastModified" value="<?php echo $theForm->state['workLastModified']; ?>" >
        <input type="hidden" id="personLoggedInLastModified" name="personLoggedInLastModified" value="<?php echo $theForm->state['personLoggedInLastModified']; ?>" >
        <input type="hidden" id="hiddenInputSavingKey" name="hiddenInputSavingKey" value="">
        <input type="hidden" id="okToCreateNewWork" name="okToCreateNewWork" value="<?php echo (($finalDeadlineHasPassed == 1) ? 0 : 1); ?>">
        <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> <!-- support for HTMLGen passing the name of the selector that initiated a Submit onchange. -->
<?php if ($creatingNewPerson) {
        echo "<input type='hidden' name='people_relationship[]' id='Submitter' value='Submitter'>\r\n";
        echo "<input type='hidden' name='people_relationship[]' id='Subscriber' value='Subscriber'>\r\n";
      }
?>

<!-- Begin Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $notificationQuestion = 'Would you like to be notified of future Calls for Entries? Screening Events?';

  if ($creatingNewPerson) {
    $disable = $theForm->state['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edCreatePersonDiv', "Creating New Account", 'Submit', 'saveNewPerson', 
                                    'savingNewPerson', 'cancelPersonChanges');
    if ($personCreationRedo) {
      HTMLGen::addTextWidgetRow($require . 'First Name', 'people_nickName',  $theForm->state['people_nickName'], 64, $disable);
      HTMLGen::addTextWidgetRow($require . 'Last Name', 'people_lastName',  $theForm->state['people_lastName'], 64, $disable);
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
      echo '<div class="entryFormNotation" style="padding-top:20px;"><span style="color: rgb(204, 51, 51);">ERROR.</span> You '
        . 'changed your email address to one that is already in our system. '
        . 'Please use a  different email address. The one displayed below is the one you originally entered on the Sign In page.</div>';
      echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
      HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $theForm->state['people_email'], 128, $disable);
      //if ($theForm->state['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Email', 'people_email_2',  '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $theForm->state['people_password'], 32, $disable);
      //if ($theForm->state['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
      // notifyOf
      echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
      HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf',  $theForm->state['people_notifyOf'], 4, $disable); 
      // howHeard
      echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
      HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $theForm->state['people_howHeardAboutUs'], 128, $disable);
    } else { // this is truely a brand new person
      HTMLGen::addTextWidgetRow($require . 'First Name', 'people_nickName', '', 64, $disable);
      HTMLGen::addTextWidgetRow($require . 'Last Name', 'people_lastName', '', 64, $disable);
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
      HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $theForm->state['loginName'], 128, $disable);
      //if ($theForm->state['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Email', 'people_email_2', '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $theForm->state['pwFromLogin'], 32, $disable);
      //if ($theForm->state['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
      // notifyOf
      echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
      HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf', 'calls,events', 4, $disable); 
      // howHeard
      echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
      HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', '', 128, $disable);
    }
    HTMLGen::displayEditSectionFooter('Finish Creating New Account', 'Submit', 'saveNewPerson', 'savingNewPerson', 'cancelPersonChanges');
    echo "          </div> <!-- End edCreatePersonDiv -->";
    echo '<script type="text/javascript">getUniqueElement("people_nickName").focus();</script>' . "\r\n";
  }
?>
<!-- End Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  if ($editingPerson && isset($dbPersonWorkState['personId']) && $dbPersonWorkState['personId'] != null) {
    $disable = $theForm->state['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edEditPersonDiv', "Editing " . $dbPersonWorkState['name'], 'Save', 'savePerson', 
                                    'savingPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRow($require . 'First Name', 'people_nickName', $dbPersonWorkState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow($require . 'Last Name', 'people_lastName', $dbPersonWorkState['lastName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $dbPersonWorkState['organization'], 128, $disable);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $dbPersonWorkState['streetAddr1'], 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $dbPersonWorkState['streetAddr2'], 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', $dbPersonWorkState['city'], 32, $disable);
    $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
    HTMLGen::addStateZipCountryRow($dbPersonWorkState, $disable);
    $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
    HTMLGen::addTextWidgetTelephonesRow($dbPersonWorkState, $disable);
    // email
    if ($personEditBadEmail) 
      echo '<div class="entryFormNotation" style="padding-top:20px;"><span style="color: rgb(204, 51, 51);">ERROR.</span> You '
      . 'changed your email address to one that is already in our system. '
      . 'Please use a  different email address. The one displayed below is the prior one - before you just changed it.</div>';
    if ($theForm->state['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $dbPersonWorkState['email'], 128, $disable);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); //
    // password
    if ($theForm->state['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    $initialPassword = ((!isset($dbPersonWorkState['password']) || $dbPersonWorkState['password'] == '')) ? $theForm->state['loginPasswordCache'] : $dbPersonWorkState['password'];
    HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $initialPassword, 32, $disable);
    HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable);
    // notifyOf
    echo '<div class="entryFormNotation" style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
    HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf', $dbPersonWorkState['notifyOf'], 4, $disable); 
    // howHeard
    echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $dbPersonWorkState['howHeardAboutUs'], 128, $disable);

    HTMLGen::displayEditSectionFooter("Finish Editing " . $dbPersonWorkState['name'], 'Save', 'savePerson', 'savingPerson', 'cancelPersonChanges');
    echo "          </div> <!-- End edEditPersonDiv -->";
    echo '<script type="text/javascript">getUniqueElement("people_nickName").focus();</script>' . "\r\n";
  }
?>
<!-- End Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Begin Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = $theForm->state['userLoginUnderway'];
  $basicsLeader = 'The Basics';
  $creditsLeader = 'Credits';
  $formatsLeader = 'Format Information';
  $otherLeader = 'Other Stuff';
  if ($creatingNewWork) {
    HTMLGen::displayEditDivHeader_2('edCreateWorkDiv', 'Creating Entry', 'Submit', 'saveNewWork', 
                                    'savingNewWork', 'cancelWorkChanges');
    echo '<div class="entryFormSubheading" style="padding-top:0px;">' . $basicsLeader . '</div>';
    HTMLGen::addTextWidgetRow($require . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 128, $disable);
    HTMLGen::addTextWidgetRow($require . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 4, $disable);
    HTMLGen::addRunTimeWidgetsRow('00:00:00', $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), $require . 'Brief Synopsis', '', 2048, 3, $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    echo '<div class="entryFormSubheading">' . $formatsLeader . '</div>';
    HTMLGen::addRadioButtonWidgetRow($require . 'Submission Format', 'works', 'submissionFormat', 'DVD', 4, "w", $disable); 
    HTMLGen::displayOriginalFormatSelector('', $disable); 
    HTMLGen::addAspectRatioAnamorphicRow(0, 0, $disable);
    HTMLGen::addPixelDimensionsWidgetsRow(0, 0, $disable);
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    $dbPersonWorkState["howPaid"] = 'paypal';
    HTMLGen::addPaymentWidgetsSection($dbPersonWorkState, $disable);
    $dbPersonWorkState["permissionsAtSubmission"] = SSFRunTimeValues::getPermissionAllOKString();
    HTMLGen::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Submit', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', '', 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable);
    HTMLGen::displayEditSectionFooter('Finish Creating Entry', 'Submit', 'saveNewWork', 'savingNewWork', 'cancelWorkChanges');
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!-- End edCreateWorkDiv -->\r\n";
    echo '<script type="text/javascript">getUniqueElement("' . DatumProperties::getItemKeyFor('works', 'title') . '").focus();</script>' . "\r\n";
  }
?>
<!-- End Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Begin Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = $theForm->state['userLoginUnderway'];
  $title = (isset($dbPersonWorkState['title'])) ? $dbPersonWorkState['title'] : 'No Title'; 
  if ($editingWork && isset($dbPersonWorkState['workId']) && $dbPersonWorkState['workId'] != null) {
    HTMLGen::displayEditDivHeader_2('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'Save', 'saveWork', 
                                    'savingWork', 'cancelWorkChanges');
    echo '<div class="entryFormSubheading" style="padding-top:0px;">' . $basicsLeader . '</div>';
    HTMLGen::addTextWidgetRow($require . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), $dbPersonWorkState['title'], 128, $disable);
    HTMLGen::addTextWidgetRow($require . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $dbPersonWorkState['yearProduced'], 4, $disable);
    HTMLGen::addRunTimeWidgetsRow($dbPersonWorkState['runTime'], $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), $require . 'Brief Synopsis', $dbPersonWorkState['synopsisOriginal'], 2048, 3, $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    echo '<div class="entryFormSubheading">' . $formatsLeader . '</div>';
    HTMLGen::addRadioButtonWidgetRow($require . 'Submission Format', 'works', 'submissionFormat', $dbPersonWorkState['submissionFormat'], 4, "w", $disable); 
    HTMLGen::displayOriginalFormatSelector($dbPersonWorkState['originalFormat'], $disable); 
    $editorDEBUGGER->becho('Work Edit databaseState[anamorphic]', $dbPersonWorkState['anamorphic'], $anamorphicDebug);
    HTMLGen::addAspectRatioAnamorphicRow($dbPersonWorkState['aspectRatio'], $dbPersonWorkState['anamorphic'], $disable);
    HTMLGen::addPixelDimensionsWidgetsRow($dbPersonWorkState['frameWidthInPixels'], $dbPersonWorkState['frameHeightInPixels'], $disable);
    // TODO Edit credits separately from the other stuff.
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    HTMLGen::addPaymentWidgetsSection($dbPersonWorkState, $disable);
    HTMLGen::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Save', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $dbPersonWorkState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $dbPersonWorkState['webSite'], 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $dbPersonWorkState['photoCredits'], 256, $disable);
    HTMLGen::displayEditSectionFooter('Finish Editing "' . $title . '"', 'Save', 'saveWork', 'savingWork', 'cancelWorkChanges');
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!--  End edEditWorkDiv -->\r\n";
    echo '<script type="text/javascript">getUniqueElement("' . DatumProperties::getItemKeyFor('works', 'title') . '").focus();</script>' . "\r\n";
  }
?>
<!-- End Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

                </div>  <!-- editSectionsContainer -->

<!-- Thank You Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
if ($displayingData && $atLeastOneWorkExistsForThisCallAndPerson) {
  echo '                <div id="edThankYouDiv" style="padding:0 8px 2px 8px;">' . "\r\n";
  HTMLGen::displayEditSectionFooter('Thanks for your entry.', 'Sign Off', 'signOff', 'signingOff', '');
  echo '                    <div class="bodyTextOnBlack" style="font-size:13.75px;line-height:18px;text-align:left;">' . "\r\n";
  echo '                      <div style="margin-bottom:10px;">You may edit the information above, add another entry, or simply sign off. ' . "\r\n";
  echo '                           You can sign in again later (until ' . date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())) . ') to make modifications. ' . "\r\n";
  echo '                      </div>' . "\r\n";
  echo '                      <div style="margin-bottom:8px;">Please print this page and include it when you send in your materials. Send your materials to</div>' . "\r\n";
  echo '                      <div style="margin-left:30px;margin-bottom:10px;">' . SSFRunTimeValues::getMailEntryToAddress() . '</div>' . "\r\n";
  echo '                      <div style="margin-bottom:10px;">Don\'t forget to pay your entry fee.</div>' . "\r\n";
  echo '                      <div style="margin-bottom:10px;">If you have questions after reading the <a href="javascript:void(0)" '
                                . 'onClick="entryRequirementsWindow=window.open(\'entryRequirementsInWindow2011.php\',' . "\r\n";
  echo '            "EntryRequirementsWindow","directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640",false);' . "\r\n";
  echo '            entryRequirementsWindow.focus();">Entry Requirements</a>, feel free to send us an <a href=\'mailto:questions@sanssoucifest.org\'>email</a>.</div>' . "\r\n";
  echo '                  </div>' . "\r\n";
  echo '                </div> <!-- End edThankYouDiv -->' . "\r\n";
}
?>
<!-- End Thank You Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

              </div> <!-- End entryFormSectionsDiv -->
            </form> <!-- End FORM -->
        </div> <!-- End encloseEntireFormDiv -->

<?php

  $editorDEBUGGER->becho('editorState[userLoginUnderway]', $this->state['userLoginUnderway'], $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('signingOff', $signingOff, $debugStateVariablesAtTop);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtBottom);

  // <!-- Div Control -------------------------------------------- >
  if ($displayingData) {
    echo '<script type="text/javascript">show("edDataDiv");</script>' . "\r\n";
    echo '<script type="text/javascript">enableSelectors();</script>' . "\r\n";
  } else {
    echo '<script type="text/javascript">hide("edDataDiv");</script>' . "\r\n";
    echo '<script type="text/javascript">disableSelectors();</script>' . "\r\n";
  }
  echo '<script type="text/javascript">if (!okToCreateNewWork()) {disable("createNewWork");}</script>';
  
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
