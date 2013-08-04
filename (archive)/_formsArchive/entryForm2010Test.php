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
<?php // Sign Off if the user has so requests.


// Modified so that all divs will appear for testing at http://browsershots.org.



  if (isset($_POST['signOff']) && ($_POST['signOff'] == 'Sign Off')) echo header("location: http://sanssoucifest.org/"); 
//  if (isset($_POST['signOffNow']) && ($_POST['signOffNow'] == 'signOffNow')) echo header("location: http://sanssoucifest.org/"); 
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
  $debugPeopleLoginName = -1;
  $debugSignIn = -1;
  $debugValidLogin = -1;
  $anamorphicDebug = -1;
  $debugChangeCount = -1;
  $debugLoginName = -1;

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
    if (document.getElementById('savingNewPerson') !== null) { document.getElementById('savingNewPerson').value = ''; resumeLogin(); }
    if (document.getElementById('savePerson') !== null) { document.getElementById('savePerson').value = ''; }
    if (document.getElementById('savingPerson') !== null) { document.getElementById('savingPerson').value = ''; }
    if (document.getElementById('saveNewWork') !== null) { document.getElementById('saveNewWork').value = ''; }
    if (document.getElementById('saveWork') !== null) { document.getElementById('saveWork').value = ''; }
    if (document.getElementById('savingNewWork') !== null) { document.getElementById('savingNewWork').value = ''; }
    if (document.getElementById('savingWork') !== null) { document.getElementById('savingWork').value = ''; }
    if (document.getElementById('signingOff') !== null) { document.getElementById('signingOff').value = ''; }
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
// -- PHP functions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

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
  }

  function getTitleForSort($title) {
    $bit7Title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", trim($title));
    $titleSansLeadingA = (stripos($bit7Title, 'A ') === 0) ? substr($bit7Title, 2) : $bit7Title;
    $titleSansLeadingThe = (stripos($titleSansLeadingA, 'The ') === 0) ? substr($titleSansLeadingA, 4) : $titleSansLeadingA;
    $titleInStrictMixedCase = ucwords(strtolower($titleSansLeadingThe));
    $stripChars = array(' ', "'", '"', '-', '/', '\\');
    $titleInCamelCase = str_replace($stripChars, "", $titleInStrictMixedCase);
    $truncatedCamelCase = (strlen($titleInCamelCase) > 20) ? substr($titleInCamelCase, 0, 20) : $titleInCamelCase;
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
/*
  function isValidLogin($editorState, $submitterDBState) {
    // Requiring a password for a new user is handled once they get to the Create Person form.
    global $openErrorMessage; // TODO Bad boy - using a global here is bad style.
    global $editorDEBUGGER, $debugValidLogin;
    $validLogin = 0;
    $editorDEBUGGER->belch('isValidLogin submitterDBState', $submitterDBState, $debugValidLogin);
    if ($debugValidLogin == 1) var_dump(debug_backtrace());
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
      $openErrorMessage = "NOTICE:<br><br>You did not enter your password. ";
      if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $loginName . "."
                                             . "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
    } else if (($submitterDBState['password'] != '') && ($submitterDBState['password'] != $editorState['pwFromLogin'])) { 
      // User entered incorrect non-blank password. Make them login again.
      $editorDEBUGGER->belch('User entered incorrect non-blank password', '', 0);
      $openErrorMessage = "ERROR:<br><br>The password you entered does not match your Sign In Email Address."
                        . "<br>If you simply forgot your password, leave it blank and Sign In again."
                        . "<br>You'll receive more help after that.";
      $editorDEBUGGER->becho('isValidLogin submitterDBState[password]', $submitterDBState['password'], $debugValidLogin);
      $editorDEBUGGER->becho('isValidLogin editorState[pwFromLogin]', $editorState['pwFromLogin'], $debugValidLogin);
    } else if ($editorState['passwordEntryRequired'] && ($editorState['pwFromLogin'] == '')) {
      // User entered blank password when a password is required.
      $editorDEBUGGER->belch('User entered blank password when a password is required.', '', 0);
      $openErrorMessage = "NOTICE:<br><br>Please enter a password.";
    } else {
      // Username and password is OK.
      $validLogin = 1;
//      echo '<input type="hidden" id="createNewPerson" name="createNewPerson" value="Create New Person">' . "\r\n";
      $editorDEBUGGER->becho('isValidLogin validLogin', $validLogin, $debugValidLogin);
    }
    return $validLogin;
  }
*/
  function isValidLogin($newLoginName, $dbLoginName, $newPW, $dbPW, $requirePassword) {
    // Requiring a password for a new user is handled once they get to the Create Person form.
    global $openErrorMessage; // TODO Bad boy - using a global here is bad style.
    global $editorDEBUGGER, $debugValidLogin;
    $validLogin = 0;
    if ($debugValidLogin == 1) var_dump(debug_backtrace());
    if (($newPW == '') && ($dbPW != '')) { 
      // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
      $editorDEBUGGER->belch('User entered blank password that does not match the DB', '', $debugValidLogin);
      // Mail the user their password.
      $to      =  $newLoginName;
      $subject = "To sign in";
      $message = "Dear " . $dbLoginName . ",\r\n\r\n"
               . "To sign in at http://sanssoucifest.org/onlineEntryForm/entryForm2010.php use " . $dbPW . "\r\n\r\n"
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
      $openErrorMessage = "NOTICE:<br><br>You did not enter your password. ";
      if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $newLoginName . "."
                                             . "<br>Please return here and sign in again later<br>once you have the password.<br><br>";
    } else if (($dbPW != '') && ($newPW != $dbPW)) { 
      // User entered incorrect non-blank password. Make them login again.
      $editorDEBUGGER->belch('User entered incorrect non-blank password', $newPW, $debugValidLogin);
      $openErrorMessage = "ERROR:<br><br>The password you entered does not match your Sign In Email Address."
                        . "<br>If you simply forgot your password, leave it blank and Sign In again."
                        . "<br>You'll receive more help after that.";
      $editorDEBUGGER->becho('isValidLogin $dbPW', $dbPW, $debugValidLogin);
      $editorDEBUGGER->becho('isValidLogin editorState[pwFromLogin]', $newPW, $debugValidLogin);
    } else if ($requirePassword && ($newPW == '')) {
      // User entered blank password when a password is required.
      $editorDEBUGGER->belch('User entered blank password when a password is required.', '', $debugValidLogin);
      $openErrorMessage = "NOTICE:<br><br>Please enter a password.";
    } else {
      // Username and password is OK.
      $validLogin = 1;
//      echo '<input type="hidden" id="createNewPerson" name="createNewPerson" value="Create New Person">' . "\r\n";
      $editorDEBUGGER->becho('isValidLogin validLogin', $validLogin, $debugValidLogin);
    }
    return $validLogin;
  }

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

<?php 
// ---- Initialization ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ----

  HTMLGen::setCaller('user');
  phoneHome::turnOn();  // turnOn() or turnOff()

  // Initialize $editorState from POST and other sources.
  $editorState = array();
  foreach ($_POST as $postKey => $postValue) {
    $editorState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";
  }
  if (!isset($editorState['userLoginUnderway'])) { $editorState['userLoginUnderway'] = 1; }
  if (!isset($editorState['theItsMePersonId'])) { $editorState['theItsMePersonId'] = 0; }
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
  if (!isset($editorState['workSelector']) || $editorState['workSelector'] == 0) { 
    $editorState['workSelector'] = ((isset($editorState['priorWorkSelection'])) ? $editorState['priorWorkSelection'] : 0); 
  }
  if ((!isset($editorState['loginNameSaved']) || $editorState['loginNameSaved'] == '') && isset($editorState['loginName']))
    $editorState['loginNameSaved'] = $editorState['loginName']; 
//  $editorDEBUGGER->belch('01 editorState[loginNameSaved]', $editorState['loginNameSaved'], $debugLoginName);
//  if ((!isset($editorState['pwFromLoginSaved']) || $editorState['pwFromLoginSaved'] == '') && isset($editorState['pwFromLogin']))
//    $editorState['pwFromLoginSaved'] = $editorState['pwFromLogin']; 
  if (!isset($editorState['signOffNow'])) { $editorState['signOffNow'] = ''; }

  // Set $callForEntriesId to the current default value returned by SSFRunTimeValues.
  $callForEntriesId = $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
  $editorDEBUGGER->belch('editorState before Sign In', $editorState, $displayDataStructures);
  $editorDEBUGGER->belch('_POST', $_POST, $displayDataStructures);

//-- Process User Actions ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

  echo '<input type="hidden" id="people_loginName" name="people_loginName" value="">' . "\r\n";
  function setPeopleLoginName($newValue, $debugId=-1) {
    global $editorState, $editorDEBUGGER, $debugPeopleLoginName;
    $editorState['people_loginName'] = $newValue;
    echo "<script type='text/javascript'>document.getElementById('people_loginName').value='" . $newValue . "';</script>\r\n";
    $editorDEBUGGER->becho($debugId . ' editorState[people_loginName]', $editorState['people_loginName'], $debugPeopleLoginName);
    if ($debugPeopleLoginName == 1) var_dump(debug_backtrace());
    return $newValue;
  }

  echo '<input type="hidden" id="loginPasswordCache" name="loginPasswordCache" value="">' . "\r\n";
  function setPeopleLoginPassword($newValue, $debugId=-1) {
    global $editorState, $editorDEBUGGER, $debugPeopleLoginName;
    $editorState['loginPasswordCache'] = $newValue;
    echo "<script type='text/javascript'>document.getElementById('loginPasswordCache').value='" . $newValue . "';</script>\r\n";
    $editorDEBUGGER->becho($debugId . ' editorState[loginPasswordCache]', $editorState['loginPasswordCache'], $debugPeopleLoginName);
    if ($debugPeopleLoginName == 1) var_dump(debug_backtrace());
    return $newValue;
  }

  echo '<input type="hidden" id="theItsMePersonId" name="theItsMePersonId" value="">' . "\r\n";
  echo '<input type="hidden" id="theItsMePersonPassword" name="theItsMePersonPassword" value="">' . "\r\n";
  echo '<input type="hidden" id="theItsMePersonName" name="theItsMePersonName" value="">' . "\r\n";
  function setTheItsMePersonId($newValue) { setTheItsMeWhatever('theItsMePersonId', $newValue); }
  function setTheItsMePersonPassword($newValue) { setTheItsMeWhatever('theItsMePersonPassword', $newValue); }
  function setTheItsMePersonName($newValue) { setTheItsMeWhatever('theItsMePersonName', $newValue); }
  function setTheItsMeWhatever($keyName, $keyValue) {
    global $editorState, $debugPeopleLoginName;
    $editorState['theItsMePersonId'] = $keyValue;
    echo "<script type='text/javascript'>document.getElementById('" . $keyName . "').value='" . $keyValue . "';</script>\r\n";
    if ($debugPeopleLoginName == 1) var_dump(debug_backtrace());
  }

  // TODO - remove side-effects to $editorState
  function setUpSubmitter($loginName, $loginPassword, $submitterDBState) {
    global $editorState;
    $editorState['submitterInPeopleTable'] = 1;
    $editorState['userLoginUnderway'] = !isValidLogin($loginName, $submitterDBState["loginName"], 
                                                      $loginPassword, $submitterDBState['password'], 
                                                      $editorState['passwordEntryRequired']);
    if (!$editorState['userLoginUnderway']) {
      $editorState['loginUserId'] = $submitterDBState['personId'];
      setPeopleLoginName($loginName, 'PE1');
      setPeopleLoginPassword($loginPassword, 'PE1');
      return true;
    } else { // since the login name is not valid
      $editorState['loginUserId'] = 0;
      setPeopleLoginName('', 'PE2');
      setPeopleLoginPassword('', 'PE2');
      return false;
    }
  }

  // Sign In
  echo '<input type="hidden" id="itsMeSubmit" name="itsMeSubmit">' . "\r\n";
  $openErrorMessage = "";
  $creatingNewPerson = false;
  $signingIn = (isset($editorState['signInSubmit']) && ($editorState['signInSubmit'] == 'Sign In')); 
  $itsMe = (isset($editorState['itsMeSubmit']) && ($editorState['itsMeSubmit'] == 'ItsMe'));
  $editorDEBUGGER->becho('07', 'signingIn = ' . $signingIn, $debugSignIn);
  $editorDEBUGGER->becho('07', '$editorState["itsMeSubmit"] = ' . ((isset($editorState['itsMeSubmit'])) ? $editorState['itsMeSubmit'] : ''), $debugSignIn);
  $editorDEBUGGER->becho('07', 'itsMe = ' . $itsMe, $debugSignIn);
  if ($editorState['userLoginUnderway'] && ($signingIn || $itsMe)) {
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

// -- compute global state variables ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- 

  $editorDEBUGGER->becho('creatingNewPerson 0', $creatingNewPerson, $debugStateVariablesAtTop);

  $creatingNewPerson = $creatingNewPerson || (isset($editorState['createNewPerson']) && $editorState['createNewPerson'] == 'Create New Person');
  $creatingNewWork = (isset($editorState['createNewWork']) && $editorState['createNewWork'] == 'Create New Entry');
  $editingPerson = (isset($editorState['editPerson']) && $editorState['editPerson'] == 'Edit');
  $editingWork = (isset($editorState['editWork']) && $editorState['editWork'] == 'Edit');
  $displayingData = !($editorState['userLoginUnderway'] || $creatingNewPerson || $creatingNewWork || $editingPerson || $editingWork);
  $signingOff = (isset($editorState['signOff']) && ($editorState['signOff'] == 'Sign Off'));
  $personCreationRedo = false;
  $personEditBadEmail = false;

  $editorDEBUGGER->becho('editorState[userLoginUnderway]', (isset($editorState['userLoginUnderway'])) ? $editorState['userLoginUnderway'] : '', $debugStateVariablesAtTop);
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
  echo '<input type="hidden" id="signOffNow" name="signOffNow" value="' . $editorState['signOffNow'] . '">' . "\r\n";
  if ($signingOff) {
    $editorState['userLoginUnderway'] = 1;
    $editorState['people_personId'] = 0;
    $editorState['loginUserId'] = 0;
    $editorState['loginPasswordCache'] = '';
    $editorState['submitterInPeopleTable'] = 0;
    $editorState['signOffNow'] = 'signOffNow';
//    echo "<script type='text/javascript'>document.getElementById('signOffNow').value='signOffNow';</script>\r\n";
    $editorDEBUGGER->becho('10 signingOff', $signingOff, -1);
  }

  // Insert a newly created person if appropriate
//  if (isset($editorState['savingNewPerson']) && ($editorState['savingNewPerson'] == 'savingNewPerson')) {
  if (isset($editorState['hiddenInputSavingKey']) && ($editorState['hiddenInputSavingKey'] == 'savingNewPerson')) {
    $personInDatabase = SSFQuery::personExistsInDatabase($editorState['people_email']);
    $editorDEBUGGER->becho('10 personInDatabase', $personInDatabase, -1);
    $editorDEBUGGER->becho('10 editorState[loginNameSaved]', $editorState['loginNameSaved'], $debugLoginName);
    $editorDEBUGGER->becho('10 editorState[people_email]', $editorState['people_email'], $debugLoginName);
    if ($personInDatabase !== false) { // Person's email is in DB so, either (this was a browser refresh so do nothing) 
                                       // or this submitter should not be using this email address since it's already in use.
      if ($editorState['loginNameSaved'] != $editorState['people_email']) {
        // This person started with one email address at the login page and then changed 
        // that email address on the Create Person form. So, now we need to reject the
        // email on the Create Person form.
        // Set state so that we'll redisplay the Create New Person page.
        $editorState['hiddenInputSavingKey'] = '';
        $editorState['createNewPerson'] = 'Create New Person';
        $editorState['people_email'] = $editorState['loginNameSaved'];
        $personCreationRedo = true;
        $creatingNewPerson = true;
        $displayingData = false;
      } else { // this was a browser refresh so do nothing
        $editorState['people_personId'] = $personInDatabase;
        $editorState['loginUserId'] = $personInDatabase;
        $editorState['submitterInPeopleTable'] = 1;
      }
    } else { // OK, do the DB update
      $editorDEBUGGER->becho('10', 'Insert a newly created person', -1);
      $editorState['people_loginName'] = setPeopleLoginName($editorState['people_email']);
      $result = SSFQuery::insertData('people', $editorState);
      if ($result !== false) {
        $editorState['people_personId'] = $result;
        $editorState['loginUserId'] = $result;
        $editorState['submitterInPeopleTable'] = 1;
        phoneHome::sendPersonInfo($editorState, 0);
      }
    }
  }

  // Save an updated person if appropriate
//  if (isset($editorState['savingPerson']) && $editorState['savingPerson'] == 'savingPerson') {
  if (isset($editorState['hiddenInputSavingKey']) && ($editorState['hiddenInputSavingKey'] == 'savingPerson')) {
    $editorDEBUGGER->becho('20', 'Save an updated person', -1);
    $personId = (isset($editorState['editingPersonId'])) ? $editorState['editingPersonId'] : 0;
    if ($personId != 0) {
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      $multiplePeopleExistInDatabase = SSFQuery::multiplePeopleExistInDatabase($editorState['people_email']);
      $editorDEBUGGER->becho('20 editorState[people_email]', $editorState['people_email'], $debugLoginName);
      $editorDEBUGGER->becho('20 currentValueArray[email]', $currentValueArray['email'], $debugLoginName);
      $editorDEBUGGER->becho('20 multiplePeopleExistInDatabase', $multiplePeopleExistInDatabase, $debugLoginName);
      if (($editorState['people_email'] == $currentValueArray['email']) || !$multiplePeopleExistInDatabase) {
        // The user did not change their email address in a harmful way  
        $editorState['people_loginName'] = setPeopleLoginName($editorState['people_email']);
        $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $personId);
        $editorDEBUGGER->becho('people changeCount', $changeCount, $debugChangeCount);
        $editorState['people_personId'] = $personId;
        if ($changeCount > 0) phoneHome::sendPersonInfo($editorState, 1, $changeCount);
      } else { // The user changed their email to an email address belonging to another user.
        // So, now we need to reject the email address on the Edit Person form.
        // Set state so that we'll redisplay the Edit New Person page.
        $editorState['hiddenInputSavingKey'] = '';
        $editorState['editPerson'] = 'Edit';
        $editorState['people_email'] = $currentValueArray['email'];
        $personEditBadEmail = true;
        $editingPerson = true;
        $displayingData = false;
      }
    }
  }

  // Insert a newly created work if appropriate
//  if (isset($editorState['savingNewWork']) && ($editorState['savingNewWork'] == 'savingNewWork')) {
  if (isset($editorState['hiddenInputSavingKey']) && ($editorState['hiddenInputSavingKey'] == 'savingNewWork')) {
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
        $editorState['works_workId_forInfoOnly'] = $workId;
        phoneHome::sendEntryInfo($editorState, 0);
      }
    }
  }

  // Save an updated work if appropriate
//  if (isset($editorState['savingWork']) && $editorState['savingWork'] == 'savingWork') {
  if (isset($editorState['hiddenInputSavingKey']) && ($editorState['hiddenInputSavingKey'] == 'savingWork')) {
    $editorState['works_titleForSort'] = getTitleForSort($editorState['works_title']);
    $workId = (isset($editorState['editingWorkId'])) ? $editorState['editingWorkId'] : 0;
    if ($workId != 0) {
      $editorDEBUGGER->becho('40', 'Save an updated work', 0);
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
      //SSFDB::debugOn(); 
      $changeCount = SSFQuery::updateDBFor('works', $currentWorkValueArray, $editorState, 'workId', $workId);
      $changeCount += SSFQuery::updateDBForWorkContributors($editorState, $workId);
      $editorDEBUGGER->becho('work changeCount', $changeCount, $debugChangeCount);
      SSFDB::debugOff(); 
      $editorState['works_workId_forInfoOnly'] = $workId;
      if ($changeCount > 0) phoneHome::sendEntryInfo($editorState, 1, $changeCount);
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
      $atLeastOneWorkExistsForThisCallAndPerson = false;

      // Value for workExists is set immediately below.
      echo '<input type="hidden" id="workExists" name="workExists" value="">' . "\r\n"; 

      // This function uses and side-effects global variables
      function initializeWorkDatabaseState($creatingNewWork) {
        global $editorDEBUGGER; // in
        global $editorState; // in and out
        global $databaseState, $dbContributorsState, $atLeastOneWorkExistsForThisCallAndPerson; // out
        $workIsSpecified = (!$creatingNewWork && isset($editorState['workSelector']) && $editorState['workSelector'] != '' && ($editorState['workSelector'] != 0));
        $editorDEBUGGER->becho('600 editorState[workSelector]', $editorState['workSelector'], -1);
        if ($workIsSpecified) {
          $databaseState = SSFQuery::selectSubmitterAndWorkNoCommsFor($editorState['workSelector']); 
          $dbContributorsState = SSFQuery::selectContributorsFor($editorState['workSelector']);  
          $atLeastOneWorkExistsForThisCallAndPerson = true;
          $editorDEBUGGER->becho('600 atLeastOneWorkExistsForThisCallAndPerson', $atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
        echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $atLeastOneWorkExistsForThisCallAndPerson . '";</script>';
        return $workIsSpecified;
      }

// FAKE INIT for Testing
$personIsSpecified = true;
$editorState['workSelector'] = 516;

      if ($personIsSpecified) {
        $workIsSpecified = initializeWorkDatabaseState($creatingNewWork);
        if (!$workIsSpecified) { // That is, only the person is specified.
          $databaseState = SSFQuery::selectPersonFor($editorState['loginUserId']);
          $atLeastOneWorkExistsForThisCallAndPerson = SSFQuery::submitterHasWorksForThisCall($editorState['loginUserId']);
          echo '<script type="text/javascript">document.getElementById("workExists").value = "' . $atLeastOneWorkExistsForThisCallAndPerson . '";</script>';
          $editorDEBUGGER->becho('201 atLeastOneWorkExistsForThisCallAndPerson', $atLeastOneWorkExistsForThisCallAndPerson, -1);
        }
      }

      // support for passing $databaseState['email'] && $databaseState['password'] to preSubmitValidation() - What a hack!
      echo '<input type="hidden" id="dbEmail" name="dbEmail" value="' . (isset($databaseState['email']) ? $databaseState['email'] : '') . '">' . "\r\n"; 
      echo '<input type="hidden" id="dbPassword" name="dbPassword" value="' . (isset($databaseState['password']) ? $databaseState['password'] : '') . '">' . "\r\n"; 
      // support for computed full name
      echo '<input type="hidden" id="dbName" name="dbName" value="' . (isset($databaseState['name']) ? $databaseState['name'] : '') . '">' . "\r\n"; 

$editorDEBUGGER->becho('501 editorState["workSelector"]', $editorState['workSelector'], $debugRefreshIssues);
$editorDEBUGGER->belch('102. $databaseState', $databaseState, $displayDataStructures);
$editorDEBUGGER->becho('personIsSpecified', $personIsSpecified, $displayDataStructures);
$editorDEBUGGER->becho('workIsSpecified', $workIsSpecified, $displayDataStructures);

     $require = HTMLGen::requiredFieldString();
     
// FAKE INIT for Testing
$editorState['userLoginUnderway'] = true;
$displayingData = true;
$personIsSpecified = true;
$workIsSpecified = true;
$creatingNewPerson = true;
//$editingPerson = true;
//$databaseState['personId'] = 1;
$creatingNewWork = true;
//$editingWork = true;
//$databaseState['workId'] = 516;

?>
                                     

<!-- Begin loginSectionDiv ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php if ($editorState['userLoginUnderway']) {
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
        if ($editorState['userLoginUnderway']) { 
          echo '<div class="bodyTextOnBlack" '
             . 'style="text-align:center;font-size:14;font-weight:normal;padding:6px 4px 6px 4px;color: #FFFF66;">'
             . $openErrorMessage . '</div>';
        }
//        $showBlurb = $editorState['userLoginUnderway'] && !$editorState['validLogin'] && (!isset($openErrorMessage) || $openErrorMessage == '');
        $showBlurb = $editorState['userLoginUnderway'] && (!isset($openErrorMessage) || $openErrorMessage == '');
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
echo '                      <a href="javascript:window.void(0)" onMouseOver="flyoverPopup(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')"' . "\r\n";
echo '                        onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote('Your login name is your email address.') . ')">Email Address / Login Name</a>: </td>' . "\r\n";
echo '                    <td height="28" align="left" class="entryFormField"><input type="text" name="loginName" id="loginName" ' . "\r\n";
echo '                         value="' . $editorState['loginName'] . '" ' . "onKeyPress='return submitEnter(this, event)'" . "\r\n";
echo '                         onchange="document.getElementById(' . HTMLGen::simpleQuote('people_loginName') . ').value=this.value"' . "\r\n";
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
          <div id = "entryFormInstructionsDiv" class="bodyTextOnBlack" style="font-size:13.75px;text-align:left;padding:6px 8px 0px 8px;">To
            make a submission, complete this form and adhere
            to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.php',
            'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
            entryRequirementsWindow.focus();">Entry Requirements</a>. You may return later to print or edit this form by signing in again. 
            <?php if (!$displayingData) echo "Save your changes by clicking the " 
                   . (($creatingNewPerson || $creatingNewWork) ? 'Submit' : 'Save') . " button."; 
                  echo (($editingWork) ? ' Note that payment and release information is at the very bottom of the form.' : '');
            ?>
          </div>
          <div id='editSectionsContainer' style='margin:0 auto 10px auto;padding:0 8px;border:none cyan 1px;'>

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
            <div style="float:left;text-align:left;padding-bottom:4px;">Select an entry or create a new one. 
                                   <span style="font-size:12px;color:#F9F9CC;">(A $25 entry fee applies to each work entered.)</span></div>
            <div style='clear:both;'><hr class="horizontalSeparatorFull"></div>
          </div>
          <div class='formRowContainer'>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
<?php $workIdSelected = HTMLGen::displayWorkSelector('entryForm', $editorState['loginUserId'], $editorState, '-- select an entry --'); 
    if ($workIdSelected !=  $editorState['workSelector']) {
      // This is an ugly repeat of code executed above for $databaseState and $dbContributorsState initialization
      $editorState['workSelector'] = $workIdSelected;
      $workIsSpecified = initializeWorkDatabaseState($creatingNewWork);
    }
    $editorDEBUGGER->becho('502 editorState["workSelector"]', $editorState['workSelector'], -1);
?>
              </div>
              <div style='float:left;padding-left:20px;'>
                <input type='submit' id='createNewWork' name='createNewWork' disabled value='Create New Entry'>
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

        <input type="hidden" id="loginNameSaved" name="loginNameSaved" value="<?php echo isset($editorState['loginNameSaved']) ? $editorState['loginNameSaved'] : ''; ?>" > 
<!--        <input type="hidden" id="pwFromLoginSaved" name="pwFromLoginSaved" value="<?php echo isset($editorState['pwFromLoginSaved']) ? $editorState['pwFromLoginSaved'] : ''; ?>" >  -->
        <input type="hidden" id="loginUserId" name="loginUserId" value="<?php echo $editorState['loginUserId']; ?>" > 
        <input type="hidden" id="works_submitter" name="works_submitter" value="<?php echo isset($editorState['loginUserId']) ? $editorState['loginUserId'] : ''; ?>">
        <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>">
        <input type="hidden" id="entryId" name="entryId" value="<?php echo $editorState['entryId']; ?>" > 
        <input type="hidden" id="passwordEntryRequired" name="passwordEntryRequired" value="<?php echo $editorState['passwordEntryRequired']; ?>" > 
        <input type="hidden" id="userLoginUnderway" name="userLoginUnderway" value="<?php echo $editorState['userLoginUnderway']; ?>" > 
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
<?php if ($creatingNewPerson) {
        echo "<input type='hidden' name='people_relationship[]' id='Submitter' value='Submitter'>\r\n";
        echo "<input type='hidden' name='people_relationship[]' id='Subscriber' value='Subscriber'>\r\n";
      }
?>

<!-- Begin Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $notificationQuestion = 'Would you like to be notified of future Calls for Entries? Screening Events?';

  if ($creatingNewPerson) {
    $disable = $editorState['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edCreatePersonDiv', "Creating New Account", 'Submit', 'saveNewPerson', 
                                    'savingNewPerson', 'cancelPersonChanges');
    if ($personCreationRedo) {
      HTMLGen::addTextWidgetRow($require . 'First Name', 'people_nickName',  $editorState['people_nickName'], 64, $disable);
      HTMLGen::addTextWidgetRow($require . 'Last Name', 'people_lastName',  $editorState['people_lastName'], 64, $disable);
      HTMLGen::addTextWidgetRow('Organization', 'people_organization',  $editorState['people_organization'], 128, $disable);
      HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1',  $editorState['people_streetAddr1'], 64, $disable);
      HTMLGen::addTextWidgetRow('', 'people_streetAddr2',  $editorState['people_streetAddr2'], 64, $disable);
      HTMLGen::addTextWidgetRow('City', 'people_city',  $editorState['people_city'], 32, $disable);
      $szcArray["stateProvRegion"] = $editorState['people_stateProvRegion'];
      $szcArray["zipPostalCode"] = $editorState['people_zipPostalCode'];
      $szcArray["country"] = $editorState['people_country']; 
      HTMLGen::addStateZipCountryRow($szcArray, $disable);
      $phoneArray["phoneVoice"] = $editorState['people_phoneVoice'];
      $phoneArray["phoneMobile"] = $editorState['people_phoneMobile'];
      $phoneArray["phoneFax"] = $editorState['people_phoneFax']; 
      HTMLGen::addTextWidgetTelephonesRow($phoneArray, $disable);
      // email  
      echo '<div class="entryFormNotation" style="padding-top:20px;"><span style="color: rgb(204, 51, 51);">ERROR.</span> You '
        . 'changed your email address to one that is already in our system. '
        . 'Please use a  different email address. The one displayed below is the one you originally entered on the Sign In page.</div>';
      echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
      HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $editorState['people_email'], 128, $disable);
      //if ($editorState['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Email', 'people_email_2',  '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $editorState['people_password'], 32, $disable);
      //if ($editorState['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Psswrd', 'people_password_2', '', 32, $disable);
      // notifyOf
      echo '<div class="entryFormNotation"  style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
      HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf',  $editorState['people_notifyOf'], 4, $disable); 
      // howHeard
      echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
      HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $editorState['people_howHeardAboutUs'], 128, $disable);
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
      HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $editorState['loginName'], 128, $disable);
      //if ($editorState['submitterInPeopleTable'])
      HTMLGen::addTextWidgetRow($require . 'Reenter Email', 'people_email_2', '', 128, $disable); 
      // password
      echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
      HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $editorState['pwFromLogin'], 32, $disable);
      //if ($editorState['submitterInPeopleTable'])
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
  }
?>
<!-- End Person Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

<!-- Begin Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  if ($editingPerson && isset($databaseState['personId']) && $databaseState['personId'] != null) {
    $disable = $editorState['userLoginUnderway'];
    HTMLGen::displayEditDivHeader_2('edEditPersonDiv', "Editing " . $databaseState['name'], 'Save', 'savePerson', 
                                    'savingPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRow($require . 'First Name', 'people_nickName', $databaseState['nickName'], 64, $disable);
    HTMLGen::addTextWidgetRow($require . 'Last Name', 'people_lastName', $databaseState['lastName'], 64, $disable);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $databaseState['organization'], 128, $disable);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $databaseState['streetAddr1'], 64, $disable);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $databaseState['streetAddr2'], 64, $disable);
    HTMLGen::addTextWidgetRow('City', 'people_city', $databaseState['city'], 32, $disable);
    $szcArray["stateProvRegion"] = $szcArray["zipPostalCode"] = $szcArray["country"] = ''; 
    HTMLGen::addStateZipCountryRow($databaseState, $disable);
    $phoneArray["phoneVoice"] = $phoneArray["phoneMobile"] = $phoneArray["phoneFax"] = ''; 
    HTMLGen::addTextWidgetTelephonesRow($databaseState, $disable);
    // email
    if ($personEditBadEmail) 
      echo '<div class="entryFormNotation" style="padding-top:20px;"><span style="color: rgb(204, 51, 51);">ERROR.</span> You '
      . 'changed your email address to one that is already in our system. '
      . 'Please use a  different email address. The one displayed below is the prior one - before you just changed it.</div>';
    if ($editorState['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Email Address below will change your Login Id.</div>';
    HTMLGen::addTextWidgetRow($require . 'Email Address', 'people_email', $databaseState['email'], 128, $disable);
    HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', '', 128, $disable); //
    // password
    if ($editorState['submitterInPeopleTable']) echo '<div class="entryFormNotation">Changing your Password below will change your Login Password.</div>';
    $initialPassword = ((!isset($databaseState['password']) || $databaseState['password'] == '')) ? $editorState['loginPasswordCache'] : $databaseState['password'];
    HTMLGen::addTextWidgetRow($require . 'Password', 'people_password', $initialPassword, 32, $disable);
    HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', '', 32, $disable);
    // notifyOf
    echo '<div class="entryFormNotation" style="padding-top:9px;padding-bottom:0px;">' . $notificationQuestion . '</div>';
    HTMLGen::addCheckBoxWidgetRow('Notify me of', 'people', 'notifyOf', $databaseState['notifyOf'], 4, $disable); 
    // howHeard
    echo '<div class="entryFormNotation">How did you hear about Sans Souci Festival?</div>';
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $databaseState['howHeardAboutUs'], 128, $disable);

    HTMLGen::displayEditSectionFooter("Finish Editing " . $databaseState['name'], 'Save', 'savePerson', 'savingPerson', 'cancelPersonChanges');
    echo "          </div> <!-- End edEditPersonDiv -->";
  }
?>
<!-- End Person Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Begin Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = $editorState['userLoginUnderway'];
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
    HTMLGen::addRadioButtonWidgetRow($require . 'Submission Format', 'works', 'submissionFormat', 'DVD', 4, $disable); 
    HTMLGen::displayOriginalFormatSelector('', $disable); 
    HTMLGen::addAspectRatioAnamorphicRow(0, 0, $disable);
    HTMLGen::addPixelDimensionsWidgetsRow(0, 0, $disable);
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    $databaseState["howPaid"] = 'paypal';
    HTMLGen::addPaymentWidgetsSection($databaseState, $disable);
    $databaseState["permissionsAtSubmission"] = 'allOK2010';
    HTMLGen::addReleaseInfoWidgetsSection($databaseState, 'Submit', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', '', 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), '', 256, $disable);
    HTMLGen::displayEditSectionFooter('Finish Creating Entry', 'Submit', 'saveNewWork', 'savingNewWork', 'cancelWorkChanges');
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!-- End edCreateWorkDiv -->\r\n";
  }
?>
<!-- End Work Creation ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->


<!-- Begin Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<?php
  $disable = $editorState['userLoginUnderway'];
  $disable = false;
  $title = (isset($databaseState['title'])) ? $databaseState['title'] : 'No Title'; 
  if ($editingWork && isset($databaseState['workId']) && $databaseState['workId'] != null) {
    HTMLGen::displayEditDivHeader_2('edEditWorkDiv', 'Editing Entry "' . $title . '"', 'Save', 'saveWork', 
                                    'savingWork', 'cancelWorkChanges');
    echo '<div class="entryFormSubheading" style="padding-top:0px;">' . $basicsLeader . '</div>';
    HTMLGen::addTextWidgetRow($require . 'Film Title', DatumProperties::getItemKeyFor('works', 'title'), $databaseState['title'], 128, $disable);
    HTMLGen::addTextWidgetRow($require . 'Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $databaseState['yearProduced'], 4, $disable);
    HTMLGen::addRunTimeWidgetsRow($databaseState['runTime'], $disable);
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), $require . 'Brief Synopsis', $databaseState['synopsisOriginal'], 2048, 3, $disable);
    // TODO Refine presentation of Submission Format radio buttons.
    echo '<div class="entryFormSubheading">' . $formatsLeader . '</div>';
    HTMLGen::addRadioButtonWidgetRow($require . 'Submission Format', 'works', 'submissionFormat', $databaseState['submissionFormat'], 4, $disable); 
    HTMLGen::displayOriginalFormatSelector($databaseState['originalFormat'], $disable); 
    $editorDEBUGGER->becho('Work Edit databaseState[anamorphic]', $databaseState['anamorphic'], $anamorphicDebug);
    HTMLGen::addAspectRatioAnamorphicRow($databaseState['aspectRatio'], $databaseState['anamorphic'], $disable);
    HTMLGen::addPixelDimensionsWidgetsRow($databaseState['frameWidthInPixels'], $databaseState['frameHeightInPixels'], $disable);
    // TODO Edit credits separately from the other stuff.
    echo '<div class="entryFormSubheading">' . $creditsLeader . '</div>';
    HTMLGen::addContributorWidgetsSection($dbContributorsState, $disable); 
    HTMLGen::addPaymentWidgetsSection($databaseState, $disable);
    HTMLGen::addReleaseInfoWidgetsSection($databaseState, 'Save', $disable);
    echo '<div class="entryFormSubheading" style="padding-top:16px;padding-bottom:2px">' . $otherLeader . '</div>';
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously screened at', $databaseState['previouslyShownAt'], 2048, 2, $disable);
    HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), '', 1024, $disable);
    HTMLGen::addTextWidgetRow(SSFHelp::getHTMLIconFor('photoCredits') . 'Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $databaseState['photoCredits'], 256, $disable);
    HTMLGen::displayEditSectionFooter('Finish Editing "' . $title . '"', 'Save', 'saveWork', 'savingWork', 'cancelWorkChanges');
    echo '            <div style="clear:both;"></div>';
    echo "          </div> <!--  End edEditWorkDiv -->\r\n";
  }
?>
<!-- End Work Edit ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

                </div>  <!-- editSectionsContainer -->

<!-- Thank You Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->
<!--                <div id='edThankYouDiv' class="entryFormSectionHeading" style="text-align:left;padding:0px 8px 20px 8px;">
                  <div style='padding-bottom:2px;margin-bottom:0;'>Thanks for your entry.</div>
                  <div style='padding-top:0px;margin-top:-4px;'><hr class="horizontalSeparatorFull"></div>
-->
                <div id='edThankYouDiv' style="padding:0 8px;">
                  <?php HTMLGen::displayEditSectionFooter('Thanks for your entry.', 'Sign Off', 'signOff', 'signingOff', ''); ?> 
                    <div class="bodyTextOnBlack" style="font-size:13.75px;line-height:18px;text-align:left;">You may edit the
                    information above, add another entry, or simply sign off. You can sign in again later (until May 28, 2010) 
                    to make modifications. Don't forget to pay your entry fee and send in your materials.<br><br>
                    If you have questions after reading the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.php',
            'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
            entryRequirementsWindow.focus();">Entry Requirements</a> feel free to send us an <a href='mailto:questions@sanssoucifest.org'>email</a>.</div>
                </div> <!-- End edThankYouDiv -->
<!-- End Thank You Display ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- -->

              </div> <!-- End entryFormSectionsDiv -->
<?php 
  // if ($editorState['signOffNow']) echo '<script type="text/javascript"> document.getElementById("entryForm").submit(); </script>'; 
?>
            </form> <!-- End FORM -->
        </div> <!-- End encloseEntireFormDiv -->

<?php
// <!-- Div Control -------------------------------------------- >

  $editorDEBUGGER->becho('editorState[userLoginUnderway]', $editorState['userLoginUnderway'], $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewWork', $creatingNewWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingPerson', $editingPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('editingWork', $editingWork, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('creatingNewPerson', $creatingNewPerson, $debugStateVariablesAtBottom);
  $editorDEBUGGER->becho('displayingData', $displayingData, $debugStateVariablesAtBottom);
/*
        echo '<script type="text/javascript">show("entryFormSectionsDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edLoginSectionDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edEditPersonDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edCreatePersonDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edEditWorkDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edCreateWorkDiv");</script>' . "\r\n";
        echo '<script type="text/javascript">hide("edThankYouDiv");</script>' . "\r\n";
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
        if ($editorState['userLoginUnderway']) echo '<script type="text/javascript">'
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
        if ($displayingData && $atLeastOneWorkExistsForThisCallAndPerson) echo '<script type="text/javascript">'
                                   . 'show("edThankYouDiv");'
                                   . '</script>' . "\r\n";
//        SSFFocus::set();
*/
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
