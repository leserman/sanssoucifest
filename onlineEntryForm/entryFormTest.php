<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  function entryRequirementsDisplayString($section = '') {
    global $entryRequirementsInWindowFilename;
    if ($section == '') {
      $diaplayText = 'Entry Requirements';
      $trailerText = '';
    } else {
      $diaplayText = ucwords(strtolower(substr($section,1))) . ' Section';
      $trailerText = ' of the Entry Requirements';
    }
    $entryRequirementsDisplayString
    = '<a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open(\'' . $entryRequirementsInWindowFilename . $section . '\','  
    . '\'EntryRequirementsWindow\',\'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640\',false);'
    . 'entryRequirementsWindow.focus();">' . $diaplayText . '</a>' . $trailerText;
    return $entryRequirementsDisplayString;
  }
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - <?php echo $currentYearString;?> Entry Form</title> 
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">
<!--
  function focusAndGo(url) {
     window.blur();
     window.focus();
     // EDIT: changed document.location.href= to window.location.href=
     // Reference:
     // https://developer.mozilla.org/En/Document.location
     // document.location was originally a read-only property,
     // although Gecko browsers allow you to assign to it as well.
     // For cross-browser safety, use window.location instead.
//     window.location.href = url;
//     window.location.href = window.location.href;
     }
-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
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

/*
  function makeHiddenInputFieldJS(idName) {
    if (typeof document.getElementById(idName) === 'undefined') {
      document.writeln('<input type="hidden" id="' + idName + '" name="' + idName + '" value="">');
      return true;
    }
    return false;
  }
*/

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
    document.getElementById("entryForm").submit();
  }
  
  function resumeLogin() {
    document.getElementById('userLoginUnderway').value = 1;
  }

  // NOTE: For each hidden input is a corresponding value for hiddenInputSavingKey
  //  hidden input      hiddenInputSavingKey
  //  ------------      --------------------
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
    document.entryForm.submit();
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

    public static function personInfoHelper($stateArray, $leaderString) {
      $dataItemNames = array(
        'loginUserId', 'people_personId', 'people_nickName', 'people_lastName', 'people_name', 'people_organization',
        'people_streetAddr1', 'people_streetAddr2', 'people_city', 'people_stateProvRegion', 'people_zipPostalCode', 'people_country',
        'people_phoneVoice', 'people_phoneMobile', 'people_phoneFax', 'people_email', 'people_password', 
        'people_notifyOf', 'people_howHeardAboutUs');
      $lastUpdateFields = SSFQuery::lastUpdateFields();
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() lastUpdateFields", $lastUpdateFields, -1);
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() stateArray", $stateArray, -1);
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
        $text = self::addDataItem($dataItemName, trim(str_replace("  ", " ", $dataValue))); 
        $dataItemWasUpdated = in_array($dataItemName, $lastUpdateFields);
        SSFDebug::globalDebugger()->becho('phoneHome personInfoHelper dataItemName dataItemWasUpdated', '|' . $dataItemName . '| ' . (($dataItemWasUpdated !== false) ? 'TRUE' : 'FALSE'), -1);
        $textLeader = ($dataItemWasUpdated) ? '* ' : '   ';
        if (is_array($dataValue)) {
          $valueString = ''; $separator = '';
          foreach($dataValue as $cellValue) { $valueString .= $separator . $cellValue; $separator = ', '; }
        } else { $valueString = $dataValue; }  
        self::$message .= $textLeader . self::addDataItem($dataItemName, $valueString); 
      }
    }
    
    public static function sendPersonInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Prsn Edit:' : 'New Prsn:';
      self::initInfo($leaderString . ' ' . $stateArray['people_name'] . (($editing) ? ' (' . $changeCount . ')' : ''));
      self::$message = '';
      self::personInfoHelper($stateArray, $leaderString);
      self::sendItNow();
    }
    
    public static function sendPossibleDuplicatePersonInfo($stateArray, $possibleDups='') {
      $leaderString = '** DUPLICATE Prsn? **';
      self::initInfo($leaderString . ' ' . $stateArray['people_name']);
      self::$message = 'This may be a duplicate person entry for ' . $stateArray['people_name'] . ".\r\n\r\n";
      self::$message .= $possibleDups;
      self::personInfoHelper($stateArray, $leaderString);
      self::sendItNow();
    }
    
    public static function sendEntryInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Wrk Edit:' : 'New Work:';
      self::initInfo($leaderString . ' "' . $stateArray['works_title'] . '"' . (($editing) ? ' (' . $changeCount . ')' : ''));
      $dataItemNames = array(
        'works_workId_forInfoOnly', 'works_title', 'works_titleForSort', 'works_designatedId', 'works_submitter', 'people_name', 
        'works_yearProduced', 'works_countryOfProduction', 'works_runTime', 'works_submissionFormat', 'works_originalFormat', 
        'works_vimeoWebAddress', 'works_vimeoPassword', 'works_synopsisOriginal', 
        'works_webSite', 'works_previouslyShownAt', 'works_photoCredits', 'works_photoURL', 'works_howPaid', 'works_permissionsAtSubmission', 
//        'works_aspectRatio', 'works_anamorphic', 'works_frameWidthInPixels', 'works_frameHeightInPixels', 
        'workContributors_Director', 'workContributors_Producer', 'workContributors_Choreographer', 'workContributors_DanceCompany', 
        'workContributors_PrincipalDancers', 'workContributors_MusicComposition', 'workContributors_MusicPerformance', 
        'workContributors_Camera', 'workContributors_Editor', 
        'workContributors_role_Other_1', 'workContributors_Other_1', 
        'workContributors_role_Other_2', 'workContributors_Other_2', 
        );
      $lastUpdateFields = SSFQuery::lastUpdateFields();
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() lastUpdateFields-2", $lastUpdateFields, -1);
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
        $text = self::addDataItem($dataItemName, trim(str_replace("  ", " ", $dataValue))); 
        $dataItemWasUpdated = in_array($dataItemName, $lastUpdateFields);
        SSFDebug::globalDebugger()->becho('phoneHome sendEntryInfo dataItemName dataItemWasUpdated', '|' . $dataItemName . '| ' . (($dataItemWasUpdated !== false) ? 'TRUE' : 'FALSE'), -1);
        $textLeader = ($dataItemWasUpdated) ? '* ' : '   ';
        SSFDebug::globalDebugger()->becho('phoneHome sendEntryInfo text', '|' . $textLeader . '| ' . $text, -1);
        self::$message .= $textLeader . $text;
      }
      self::sendItNow();
    }
  } // end class phoneHome --------------------------------------------------------------
  
  
  // class SSFEntryForm saves entry form state. -----------------------------------------
  
  // NOTE: For each hidden input is a corresponding value for hiddenInputSavingKey
  //  hidden input      hiddenInputSavingKey
  //  ------------      --------------------
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
  
    // State
    // $state could be split into multiple arrays, e.g., metaData, workFields, submitterFields, paFields, ...
    public $state = array(); 
    public $atLeastOneWorkExistsForThisCallAndPerson = false;
    public $callForEntriesId = 0;

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
      phoneHome::turnOn();  // turnOn() or turnOff()
    
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
        $headers = "From: YourFriendlyHelper@sanssoucifest.org" . "\r\n"
                 . "Bcc: entryForm@sanssoucifest.org" . "\r\n"
                 . "Reply-To: no-reply@sanssoucifest.org" . "\r\n"
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
      echo '<input type="hidden" id="' . $IdName . '" name="' . $IdName . '" value="' . $value . '">' . "\r\n";
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
    
// ----------- boolean functions
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
          $this->openErrorMessage = "ERROR:<br>Please enter a valid email address. ";
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
          phoneHome::sendPossibleDuplicatePersonInfo($this->state, $dupInfo);
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
        $this->DEBUGGER->becho('20 this->state[people_email]', $this->state['people_email'], SSFEntryForm::$debugLoginName);
        $this->DEBUGGER->becho('20 currentValueArray[email]', $currentValueArray['email'], SSFEntryForm::$debugLoginName);
        $this->DEBUGGER->becho('20 multiplePeopleExistInDatabase', $multiplePeopleExistInDatabase, SSFEntryForm::$debugLoginName);
        if (($this->state['people_email'] == $currentValueArray['email']) || !$multiplePeopleExistInDatabase) {
          // The user did not change their email address in a harmful way  
          $this->setState('people_loginName', $this->state['people_email']);
          $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $this->state, 'personId', $personId);
          $this->DEBUGGER->becho('people changeCount', $changeCount, SSFEntryForm::$debugChangeCount);
          $this->state['people_personId'] = $personId;
          if ($changeCount > 0) phoneHome::sendPersonInfo($this->state, 1, $changeCount);
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
        
//        $this->DEBUGGER->belch('500A insertWork() this->state', $this->state, 1);
        
        SSFDB::debugOn();
        
        SSFQuery::clearLastUpdateFields(); // LEAVE THIS HERE

        $this->DEBUGGER->belch('500B insertWork() this->state', $this->state, 1);
        
        
        
        $workId = SSFQuery::insertData('works', $this->state);
        
        
        if ($workId !== false) {
          $this->state['workSelector'] = $workId;
          $this->DEBUGGER->becho('500 this->state["workSelector"]', $this->state['workSelector'], SSFEntryForm::$debugRefreshIssues);
          SSFQuery::updateDBForWorkContributors($this->state, $workId);
          $this->state['works_workId_forInfoOnly'] = $workId;
          phoneHome::sendEntryInfo($this->state, 0);
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
        if ($changeCount > 0) phoneHome::sendEntryInfo($this->state, 1, $changeCount);
      }
    }

  } // end class SSFEntryForm --------------------------------------------------------------

?>

<!-- Switch from table-based formatting to primarily DIV-based formatting ---- ---- ---- ---- ---- ---- ---- ---- -->

   <div id="encloseEntireFormDiv" class="entryFormSection"> <!-- style="background-color:#333;" border:dashed 1px green; -->
                                     
<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

      <form name="entryForm" id="entryForm" style="border:none 1px pink;" onSubmit="return preSubmitValidation();" action="entryFormTest.php" method="post">

<?php
// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----
  $theForm = new SSFEntryForm();

  // Sign In?
  if ($theForm->signingIn()) $theForm->signIn();
  $theForm->DEBUGGER->becho('theForm->isCreatingANewPerson 0', $theForm->isCreatingANewPerson(), SSFEntryForm::$debugStateVariablesAtTop);
  $theForm->bechoStateVarialbes(SSFEntryForm::$debugStateVariablesAtTop);

//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

// Respond to a user Save button click: New Person | Updated Person | New Work | Updated Work ---- ---- ---- ---- ---- ---- ---- ---- 

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

// -- Initialize $dbPersonWorkState & $dbContributorsState  ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

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
      echo '<input type="hidden" id="workExists" name="workExists" value="">' . "\r\n"; 

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
        echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $theForm->atLeastOneWorkExistsForThisCallAndPerson . '";</script>' . "\r\n";
      }

      if ($personIsSpecified) {
        $theForm->DEBUGGER->belch('611x $theForm->state', $theForm->state, -1);
        initializeWorkDatabaseState($theForm);
        if (!$theForm->workIsSpecified()) { // That is, only the person is specified.
          $dbPersonWorkState = SSFQuery::selectPersonFor($theForm->state['loginUserId']);
          $theForm->DEBUGGER->belch('611 dbPersonWorkState', $dbPersonWorkState, -1);
          $theForm->atLeastOneWorkExistsForThisCallAndPerson = SSFQuery::submitterHasWorksForThisCall($theForm->state['loginUserId']);
          echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $theForm->atLeastOneWorkExistsForThisCallAndPerson . '";</script>' . "\r\n";
          $theForm->DEBUGGER->becho('201 theForm->atLeastOneWorkExistsForThisCallAndPerson', $theForm->atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
      }

      // support for passing $dbPersonWorkState['email'] && $dbPersonWorkState['password'] & others to preSubmitValidation() - What a hack!
      echo '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($dbPersonWorkState['email']) ? $dbPersonWorkState['email'] : '') . '">' . "\r\n"; 
      echo '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($dbPersonWorkState['password']) ? $dbPersonWorkState['password'] : '') . '">' . "\r\n"; 
      // support for nickName & lastName & loginName
      echo '<input type="hidden" id="dbFirstName" name="dbFirstName" value="' . (isset($dbPersonWorkState['nickName']) ? $dbPersonWorkState['nickName'] : '') . '">' . "\r\n"; 
      echo '<input type="hidden" id="dbLastName" name="dbLastName" value="' . (isset($dbPersonWorkState['lastName']) ? $dbPersonWorkState['lastName'] : '') . '">' . "\r\n"; 
      echo '<input type="hidden" id="dbLoginName" name="dbLoginName" value="' . (isset($dbPersonWorkState['loginName']) ? $dbPersonWorkState['loginName'] : '') . '">' . "\r\n"; 
      // support for computed full name
      echo '<input type="hidden" id="dbName" name="dbName" value="' . (isset($dbPersonWorkState['name']) ? $dbPersonWorkState['name'] : '') . '">' . "\r\n"; 

$theForm->DEBUGGER->belch('503. theForm->state', $theForm->state, -1);
$theForm->DEBUGGER->becho('503. theForm->state["workSelector"]', $theForm->state['workSelector'], SSFEntryForm::$debugRefreshIssues);
$theForm->DEBUGGER->belch('503. $dbPersonWorkState', $dbPersonWorkState, SSFEntryForm::$displayDataStructures);
$theForm->DEBUGGER->becho('503. personIsSpecified', $personIsSpecified, SSFEntryForm::$displayDataStructures);
$theForm->DEBUGGER->becho('503. theForm->workIsSpecified()', $theForm->workIsSpecified(), SSFEntryForm::$displayDataStructures);

?>
                                     
<!-- begin FORM ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php  $asterisk = HTMLGen::requiredFieldString(); ?>


<!-- Begin loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php if ($theForm->state['userLoginUnderway']) {
//$theForm->makeHiddenInputField('people_loginName');
echo '        <div id="edLoginSectionDiv">  <!-- style="border: dashed 1px yellow;" -->' . "\r\n";
echo '          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center" valign="bottom" class="programPageTitleText" style="padding-top:24px;">Entry Form Sign In / Registration</td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td height="30" align="center" valign="middle"><hr align="center" size="1" noshade class="horizontalSeparator1"></td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center"> ' . "\r\n";
        if ($theForm->state['userLoginUnderway']) { 
          echo '<div class="bodyTextOnBlack" '
             . 'style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 6px 4px;color: #FFFF66;">'
             . $theForm->openErrorMessage . '</div>';
        }
        $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
        $showBlurb = $theForm->state['userLoginUnderway'] && (!isset($theForm->openErrorMessage) || $theForm->openErrorMessage == '');
        $eventDescription = SSFRunTimeValues::getEventDescriptionStringShort(SSFRunTimeValues::getAssociatedEventId($theForm->callForEntriesId)); // 3/19/14
echo '              </td>' . "\r\n";
echo '            </tr>' . "\r\n";
echo '            <tr>' . "\r\n";
echo '              <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">' . "\r\n";
        if ($showBlurb) echo '<div class="bodyTextOnBlack" style="text-align:left;padding:0px 54px 24px 54px;">Sans '
                 . ' Souci, an international festival of dance cinema, invites and encourages submissions from all artists regardless of' 
                 . ' credentials and affiliations. Accepted works will be screened ' . $eventDescription
//                 . 'Additionally, with your permission, your work may tour to other venues around the U.S. and elsewhere.'
                 . 'For more information see our <a href="http://sanssoucifest.org/' . $danceCinemaCallFilename . '">'
                 . 'Call for Entries</a> and our ' . entryRequirementsDisplayString() . '.</div>' . "\r\n";
echo '                <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">' . "\r\n";
echo '                  <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in or register here.</td></tr>' . "\r\n";
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
  $theForm->DEBUGGER->becho('502x theForm->state[userLoginUnderway]', $theForm->state['userLoginUnderway'], -1);
  if (!$theForm->state['userLoginUnderway']) {
    echo '          <div class="programPageTitleText" style="float:none;">Entry Form, ' . $currentYearString . '</div>' . "\r\n"; 
    echo '          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="font-size:13.75px;text-align:left;padding:6px 8px 0px 8px;">To';
    echo ' make a submission, complete this form adhering';
    // TODO Generalize Reqs Window
    echo ' to the ' . entryRequirementsDisplayString() . '. You may return later to print or edit this form by signing in again. ' ;
    echo (!$theForm->isDisplayingData()) ? ('Save your changes by clicking the ' 
                                            . (($theForm->isCreatingANewPerson() || $theForm->isCreatingANewWork()) ? "Submit" : "Save") . ' button.') : ''; 
    echo (($theForm->isEditingAWork()) ? ' Note that payment and release information is at the very bottom of the form.' : '') . "\r\n";
    if ($theForm->isCreatingANewWork() || $theForm->isEditingAWork()) {
      echo ' Hover over or click any' . SSFHelp::getHTMLIconFor('help') . 'to get more information.' . "\r\n";
    }
    echo '          </div>' . "\r\n";
  }
?>
          <div id='editSectionsContainer' style='margin:0 auto 10px auto;padding:0 8px;border:none cyan 1px;'>

<!-- Begin Data Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
        <div id="edDataDiv">

<?php        
  if ($theForm->isDisplayingData()) { 
    echo "<!-- display Person Information -->\r\n";
    echo '          <div class="entryFormSectionHeading">' . "\r\n";
    $personOrSubmitterText = 'Submitter: ';   // <!-- TODO FIX $personOrSubmitterText -->
    echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;">' . $personOrSubmitterText . "\r\n";
    if ($personIsSpecified) echo $dbPersonWorkState['name'];
    echo '            </div>' . "\r\n";
    echo '            <div style="float:right;padding-right:4px;padding-bottom:0;">' . "\r\n";
    if ($personIsSpecified)  echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">' . "\r\n";
    echo '            </div>' . "\r\n";
    echo '            <div style="clear:both;padding:0;margin:0;"><hr class="horizontalSeparatorFull"></div>' . "\r\n";
    echo '          </div>' . "\r\n";
    echo '          <div id = "edPersonDiv" style="text-align:left;">' . "\r\n";
    if ($personIsSpecified) HTMLGen::displayPersonDetail($dbPersonWorkState, $forAdmin=false); 
    echo '          </div> <!-- id = "edPersonDiv" -->' . "\r\n";
    
    echo "<!-- display Work Selector -->\r\n";
    echo '          <div class="entryFormSectionHeading">' . "\r\n";
    echo '            <div style="float:left;text-align:left;padding-bottom:4px;">Select an entry or create a new one. ' . "\r\n";
    echo '                                   <span style="font-size:12px;color:#F9F9CC;">(A $' 
                                                              . $entryFeeAmount . ' entry fee applies to each work entered.)</span></div>' . "\r\n";
    echo '            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>' . "\r\n";
    echo '          </div>' . "\r\n";
    echo '          <div class="formRowContainer">' . "\r\n";
    echo '            <div class="entryFormFieldContainer">' . "\r\n";
    echo '              <div style="float:left;">' . "\r\n";
    $workIdSelected = HTMLGen::displayWorkSelector('entryForm', $theForm->state['loginUserId'], $theForm->state, '-- select an entry to view and edit --'); 
    if ($workIdSelected !=  $theForm->state['workSelector']) {
      // This is an ugly repeat of code executed above for $dbPersonWorkState and $dbContributorsState initialization
      $theForm->state['workSelector'] = $workIdSelected;
      initializeWorkDatabaseState($theForm);
    }
    $theForm->DEBUGGER->becho('502 theForm->state[workSelector]', $theForm->state['workSelector'], -1);
    echo '              </div>' . "\r\n";
    echo '              <div style="float:left;padding-left:20px;">' . "\r\n";
    echo '                <input type="submit" id="createNewWork" name="createNewWork" value="Create New Entry"' 
                                                               . (($finalDeadlineHasPassed) ? 'disabled="disabled"' : "") . '>' . "\r\n";
    echo '              </div>' . "\r\n";
    echo '              <div style="clear:both;"></div>' . "\r\n";
    echo '            </div>' . "\r\n";
    echo '          <div style="clear:both;"></div>' . "\r\n";
    echo '          </div>' . "\r\n";

    echo "<!-- display Work Information -->\r\n";
    if ($theForm->workIsSpecified()) {
      echo "          <div class='entryFormSectionHeading'>\r\n";
      echo '            <div style="float:left;padding-top:4px;padding-bottom:4px;">Entry: "' . $dbPersonWorkState['title'] . '"';
      echo "            </div>\r\n";
      echo "            <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
      echo '              <input type="submit" id="editWork" name="editWork" value="Edit">' . "\r\n";
      echo "            </div>\r\n";
      echo "            <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
      echo "          </div>\r\n";
      echo "          <div id='edEntriesDiv' style='text-align:left;'>\r\n";
      $theForm->DEBUGGER->becho('504 databaseState["workId"]', $dbPersonWorkState['workId'], SSFEntryForm::$debugRefreshIssues);
      HTMLGen::displayWorkDetail($dbPersonWorkState, $dbContributorsState);
      echo "          </div> <!-- id=edEntriesDiv -->\r\n";
    }
  } //  if ($theForm->isDisplayingData())
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

<?php if ($theForm->isCreatingANewPerson()) {
      // TODO 
        echo "        <input type='hidden' name='people_relationship[]' id='Submitter' value='Submitter'>\r\n";
        echo "        <input type='hidden' name='people_relationship[]' id='Subscriber' value='Subscriber'>\r\n";
      }
?>

<!-- Begin Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $notificationQuestion = 'Would you like to be notified of future Calls for Entries? Screening Events?';

  if ($theForm->isCreatingANewPerson()) {
    $disable = $theForm->state['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edCreatePersonDiv', "Creating New Account", 'Submit', 'saveNewPerson', 
                                    'savingNewPerson', 'cancelPersonChanges');
    if ($theForm->personCreationRedo) {
      HTMLGen::addTextWidgetRow($asterisk . 'First Name', 'people_nickName',  $theForm->state['people_nickName'], 64, $disable);
      HTMLGen::addTextWidgetRow($asterisk . 'Last Name', 'people_lastName',  $theForm->state['people_lastName'], 64, $disable);
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
      HTMLGen::addTextWidgetRow($asterisk . 'Email Address', 'people_email', $theForm->state['people_email'], 128, $disable);
      //if ($theForm->state['subscriberInPeopleTable'])
      HTMLGen::addTextWidgetRow($asterisk . 'Reenter Email', 'people_email_2',  '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($asterisk . 'Password', 'people_password', $theForm->state['people_password'], 32, $disable);
      //if ($theForm->state['subscriberInPeopleTable'])
      HTMLGen::addTextWidgetRow($asterisk . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
      // notifyOf
      echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
      HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf',  $theForm->state['people_notifyOf'], 4, $disable); 
      // howHeard
      echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
      HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $theForm->state['people_howHeardAboutUs'], 128, $disable);
    } else { // this is truely a brand new person
      HTMLGen::addTextWidgetRow($asterisk . 'First Name', 'people_nickName', '', 64, $disable);
      HTMLGen::addTextWidgetRow($asterisk . 'Last Name', 'people_lastName', '', 64, $disable);
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
      HTMLGen::addTextWidgetRow($asterisk . 'Email Address', 'people_email', $theForm->state['loginName'], 128, $disable);
      //if ($theForm->state['subscriberInPeopleTable'])
      HTMLGen::addTextWidgetRow($asterisk . 'Reenter Email', 'people_email_2', '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($asterisk . 'Password', 'people_password', $theForm->state['pwFromLogin'], 32, $disable);
      //if ($theForm->state['subscriberInPeopleTable'])
      HTMLGen::addTextWidgetRow($asterisk . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
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
  if ($theForm->isEditingAPerson() && isset($dbPersonWorkState['personId']) && $dbPersonWorkState['personId'] != null) {
    $disable = $theForm->state['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edEditPersonDiv', "Editing " . $dbPersonWorkState['name'], 'Save', 'savePerson', 
                                    'savingPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRow($asterisk . 'First Name', 'people_nickName', $dbPersonWorkState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow($asterisk . 'Last Name', 'people_lastName', $dbPersonWorkState['lastName'], 64, $disable);
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
      echo '<div class="entryFormNotation" style="padding-top:20px;"><span style="color: rgb(204, 51, 51);">ERROR.</span> You '
      . 'changed your email address to one that is already in our system. '
      . 'Please use a  different email address. The one displayed below is the prior one - before you just changed it.</div>';
    if ($theForm->state['subscriberInPeopleTable']) echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow($asterisk . 'Email Address', 'people_email', $dbPersonWorkState['email'], 128, $disable);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); //
    // password
    if ($theForm->state['subscriberInPeopleTable']) echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    $initialPassword = ((!isset($dbPersonWorkState['password']) || $dbPersonWorkState['password'] == '')) ? $theForm->state['loginPasswordCache'] : $dbPersonWorkState['password'];
    HTMLGen::addTextWidgetRow($asterisk . 'Password', 'people_password', $initialPassword, 32, $disable);
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

<?php
  function displayProductionYearAndCountry($prodYearInitValue, $prodCountryInitValue ='') {
    echo "<!-- BEGIN displayProductionYearAndCountry(" . $prodYearInitValue . ", " . $prodCountryInitValue . ") -->\r\n";
    $asterisk = HTMLGen::requiredFieldString();
    $prodYearDesc = $asterisk . 'Production Year:';
    $prodYearIdName = DatumProperties::getItemKeyFor('works', 'yearProduced');
    $prodYearGenId = HTMLGen::genId($prodYearIdName);
    $prodYearMaxLength = 4;
    $prodCountryDesc = $asterisk . 'Country of Production:';
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
                        'value="' . $prodCountryInitValue . '" maxlength="64"' . 'onchange="javascript:userMadeAChange(0);">';
    echo '          </div>';

    // public static function addTextWidgetRowHelper2() {
    echo "        <div style='clear:both;'></div>\r\n"; // rowTitleTextWide
    echo "        </div>\r\n";                          // entryFormFieldContainer
    echo "      </div>\r\n";                            // formRowContainer
  
    echo "<!-- END displayProductionYearAndCountry -->\r\n";
  }
?>

<!-- Begin Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = $theForm->state['userLoginUnderway'];
  $basicsLeader = 'The Basics';
  $creditsLeader = 'Credits';
  $eSubmissionLeader = 'Electronic Media Submission Information';
  $formatsLeader = 'Format Information';
  $otherLeader = 'Other Stuff';
  if ($theForm->isCreatingANewWork()) {
    HTMLGen::displayEditDivHeader_2('edCreateWorkDiv', 'Creating Entry', 'Submit', 'saveNewWork', 
                                    'savingNewWork', 'cancelWorkChanges');
    echo '<div class="entryFormSubheading" style="padding-top:0px;">' . $basicsLeader . '</div>';
    HTMLGen::addTextWidgetRow($asterisk . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), '', 128, $disable);
//    HTMLGen::addTextWidgetRow($asterisk . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), '', 4, $disable);
    displayProductionYearAndCountry("", "");
    HTMLGen::addRunTimeWidgetsRow('00:00:00', $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), $asterisk . 'Brief Synopsis', '', 2048, 3, $disable);
    HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), '', 128, $disable);
    echo '<div class="entryFormSubheading">' . $formatsLeader . '</div>';
    HTMLGen::addRadioButtonWidgetRow($asterisk . 'Submission Format', 'works', 'submissionFormat', 'SD-Vimeo', 4, "w", $disable); 
//    HTMLGen::displayOriginalFormatSelector2013('', $disable); 
//    HTMLGen::addAspectRatioAnamorphicRow(0, 0, $disable);
//    HTMLGen::addPixelDimensionsWidgetsRow(0, 0, $disable);
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    $dbPersonWorkState["howPaid"] = 'paypal';
    HTMLGen::addPaymentWidgetsSection($dbPersonWorkState, $disable);
    $dbPersonWorkState["permissionsAtSubmission"] = SSFRunTimeValues::getPermissionAllOKString();
    HTMLGen::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Submit', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', '', 2048, 2, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('webSite') . 'Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoURL') . 'Screen Snpshots', DatumProperties::getItemKeyFor('works', 'photoURL'), '', 256, $disable);
//    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable); // removed 3/22/14
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
  if ($theForm->isEditingAWork() && isset($dbPersonWorkState['workId']) && $dbPersonWorkState['workId'] != null) {
    $theForm->DEBUGGER->becho('504a databaseState["countryOfProduction"]', $dbPersonWorkState['countryOfProduction'], SSFEntryForm::$debugRefreshIssues);
    HTMLGen::displayEditDivHeader_2('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'Save', 'saveWork', 
                                    'savingWork', 'cancelWorkChanges');
    echo '<div class="entryFormSubheading" style="padding-top:0px;">' . $basicsLeader . '</div>';
    HTMLGen::addTextWidgetRow($asterisk . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), $dbPersonWorkState['title'], 128, $disable);
//    HTMLGen::addTextWidgetRow($asterisk . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $dbPersonWorkState['yearProduced'], 4, $disable);
    displayProductionYearAndCountry($dbPersonWorkState['yearProduced'], $dbPersonWorkState['countryOfProduction']);
    HTMLGen::addRunTimeWidgetsRow($dbPersonWorkState['runTime'], $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), $asterisk . 'Brief Synopsis', $dbPersonWorkState['synopsisOriginal'], 2048, 3, $disable);
    echo '<div class="entryFormSubheading" style="padding-top:12px;padding-bottom:2px">' . $eSubmissionLeader . '</div>';
    HTMLGen::addTextWidgetRow('Vimeo Web Address', DatumProperties::getItemKeyFor('works', 'vimeoWebAddress'), $dbPersonWorkState['vimeoWebAddress'], 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('vimeoAddress') . 'Vimeo Password', DatumProperties::getItemKeyFor('works', 'vimeoPassword'), $dbPersonWorkState['vimeoPassword'], 128, $disable);
//    echo '<div class="entryFormSubheading">' . $formatsLeader . '</div>';
    HTMLGen::addRadioButtonWidgetRow($asterisk . 'Submission Format', 'works', 'submissionFormat', $dbPersonWorkState['submissionFormat'], 4, "w", $disable); 
//    $theForm->DEBUGGER->becho('Work Edit databaseState[anamorphic]', $dbPersonWorkState['anamorphic'], SSFEntryForm::$anamorphicDebug);
//    HTMLGen::addAspectRatioAnamorphicRow($dbPersonWorkState['aspectRatio'], $dbPersonWorkState['anamorphic'], $disable);
//    HTMLGen::addPixelDimensionsWidgetsRow($dbPersonWorkState['frameWidthInPixels'], $dbPersonWorkState['frameHeightInPixels'], $disable);
    // TODO Edit credits separately from the other stuff.
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    // Suppress user update of payment type after the payment has been made (as indicated by the presence of a check or paypal number.
    $alreadyBeenPaidIndicator = 'checkOrPaypalNumber';
    $alreadyBeenPaid = isset($dbPersonWorkState[$alreadyBeenPaidIndicator]) && ($dbPersonWorkState[$alreadyBeenPaidIndicator] != 0) && ($dbPersonWorkState[$alreadyBeenPaidIndicator] != '');
    $theForm->DEBUGGER->becho('alreadyBeenPaid', ($alreadyBeenPaid) ? 'PAID' : 'NOT YET PAID', -1);
    $theForm->DEBUGGER->belch('dbPersonWorkState', $dbPersonWorkState, -1);
    HTMLGen::addPaymentWidgetsSection($dbPersonWorkState, $disable || $alreadyBeenPaid); // 5/5/14
    HTMLGen::addReleaseInfoWidgetsSection($dbPersonWorkState, 'Save', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
//    HTMLGen::displayOriginalFormatSelector2013($dbPersonWorkState['originalFormat'], $disable); 
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $dbPersonWorkState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('webSite') . 'Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $dbPersonWorkState['webSite'], 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoURL') . 'Screen Snpshots', DatumProperties::getItemKeyFor('works', 'photoURL'), $dbPersonWorkState['photoURL'], 256, $disable);
//    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $dbPersonWorkState['photoCredits'], 256, $disable);  // removed 3/22/14
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
if ($theForm->isDisplayingData() && $theForm->atLeastOneWorkExistsForThisCallAndPerson) {
  $aWorkIsDisplayed = isset($dbPersonWorkState['workId']);
  $theForm->DEBUGGER->belch('800 dbPersonWorkState', $dbPersonWorkState, -1);
  $highlightTextColor = '#e4afe4'; //FAFF66 E495E4
  $payYourEntryFeeString = '<span style="color:' . $highlightTextColor . '";>Don\'t forget to pay your entry fee</span>'; 
  $submitYourVideoString = '<span style="color:' . $highlightTextColor . '";>Remember to submit your video at <a href="http://vimeo.com">Vimeo</a></span> '
                         . 'and enter the Vimeo web address and password (if you choose to use one) by editing the entry above. '
                         . '(The free membership option should be adequate. <span style="color:' . $highlightTextColor . '";>Be sure to '
                         . 'check the Vimeo box to &quot;Allow other people to download the source video.&quot;</span> '
                         . 'Details for this selection are described in the '
//                         . '<a href="http://sanssoucifest.org/onlineEntryForm/' . $entryRequirementsInWindowFilename . '#media">Media</a> '
                         . entryRequirementsDisplayString('#media') . '.)';
  $workDisplayedPmtReceived = false;
  $workDisplayedMediaReceived = false;
  $workDisplayedHowPaid = '';
  $workDisplayedPayUpString = '';
  $thanksString = 'You may edit the information above, add another entry, or simply sign off. ' 
                . 'You can sign in again later (until ' . date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()))
                . ') to make modifications. ';
  $payUpViaPaypalString = $payYourEntryFeeString . ' via Paypal (above). Please pay for each entry separately. '
                        . '(You may opt to pay by check or money order instead. Just edit the entry above to indicate that intention.)';
  $payUpViaCheckString = '<div style="margin-bottom:8px;">' 
                       . $payYourEntryFeeString . ' with a check or money order drawn on a US bank. '
                       . 'Make your check or money order out to Sans Souci Festival of Dance Cinema and mail it to' 
                       . '<div style="margin-left:30px;margin-top:8px;margin-bottom:10px;">' 
                       . SSFRunTimeValues::getMailEntryToAddress() . '</div>' . "\r\n"
                       . 'Please print this page and include it with your payment. '
                       . '(You may opt to pay by Paypal instead. Just edit the entry above to indicate that intention.)';
  $lastWordString = 'If you have <span style="color:#FFFF66;">questions</span> after reading the ' . entryRequirementsDisplayString()
                  . ', feel free to send us an <a href=\'mailto:questions@sanssoucifest.org\'>email</a>.';
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
  echo '                <div id="edThankYouDiv" style="padding:0 8px 2px 8px;">' . "\r\n";
  HTMLGen::displayEditSectionFooter('Thanks for submitting your entry.', 'Sign Off', 'signOff', 'signingOff', '');
  echo '                    <div class="bodyTextOnBlack" style="font-size:13.75px;line-height:18px;text-align:left;">' . "\r\n";
  echo '                      <div style="margin-bottom:10px;">' . $thanksString . '</div>' . "\r\n";
  if ($aWorkIsDisplayed && !$workDisplayedMediaReceived)
    echo '                      <div style="margin-bottom:8px;">' . $submitYourVideoString . '</div>' . "\r\n";
  if ($aWorkIsDisplayed && !$workDisplayedPmtReceived && ($workDisplayedPayUpString != ''))
    echo '                      <div style="margin-bottom:8px;">' . $workDisplayedPayUpString . '</div>' . "\r\n";
  echo '                      <div style="margin-bottom:10px;">' . $lastWordString . '</div>' . "\r\n";
  echo '                </div> <!-- End edThankYouDiv -->' . "\r\n";
}
?>
<!-- End Thank You Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

              </div> <!-- End entryFormSectionsDiv -->
            </form> <!-- End FORM -->
        </div> <!-- End encloseEntireFormDiv -->
<!-- End encloseEntireFormDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<?php

  $theForm->bechoStateVarialbes(SSFEntryForm::$debugStateVariablesAtBottom);

  // <!-- Div Control -------------------------------------------- >
  if ($theForm->isDisplayingData()) {
    echo '<script type="text/javascript">show("edDataDiv");</script>' . "\r\n";
    echo '<script type="text/javascript">enableSelectors();</script>' . "\r\n";
  } else {
    echo '<script type="text/javascript">hide("edDataDiv");</script>' . "\r\n";
    echo '<script type="text/javascript">disableSelectors();</script>' . "\r\n";
  }
  echo '<script type="text/javascript">if (!okToCreateNewWork()) { disable("createNewWork"); }</script>' . "\r\n";
  // <!-- End Div Control -------------------------------------------- >
  
?>
<!-- End encloseEntireFormDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- END SWITCH FROM TABLE TO DIV ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
	  	           </td>
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
</html>
