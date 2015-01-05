<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Permissions</title>
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
<!-- TODO: Set global variables: jsEchoAnalysis, $phpEchoAnalysis, $debugInit -->
<script type="text/javascript">

  String.prototype.getEmailAddressFromAngleBrackets = function() {
    var pattern=new RegExp("<.*(?=>)"); // Get everything from < through >
    var searchResults = pattern.exec(this);
    var returnValue = "";
    if (searchResults !== null) { returnValue = searchResults[0].replace(/^<+|\>$/g,""); } // Strip < and >
    return returnValue;
  };

  String.prototype.getEmailAddressFromLine = function() { 
    var pattern=new RegExp(/From:.*$/i); // Get everything from From: through EOL
    var searchResults = pattern.exec(this);
    var returnValue = "";
    if (searchResults !== null) { returnValue = searchResults[0].replace(/From:/ig,"").trim(); } 
    return returnValue;
  };

  String.prototype.getEmailAddress = function() {
    var addr = this.getEmailAddressFromAngleBrackets();
    if (addr === "") { addr = this.getEmailAddressFromLine(); }
    return addr;
  };

  String.prototype.getFromName = function() {
    var pattern=new RegExp(".*(?=<)"); // Get everything from BOL through <
    var searchResults = pattern.exec(this);
    //alert ("getFromName searchResults 1: " + searchResults);
    if (searchResults !== null) { return searchResults[0].replace(/From:/i, "").trim(); } 
    else {
      pattern=new RegExp(/From:.*/i);
      searchResults = pattern.exec(this);
      if (searchResults !== null) { return ""; } 
      else { return this.trim(); }
    }
  };

  String.prototype.getDateSent = function() {
    var dateAsDate;
    var pattern=new RegExp(/Date:.*/i); // Get everything from Date: through EOD
    var searchResults = pattern.exec(this);
    if (searchResults !== null) {
      dateAsDate = new Date(searchResults[0].replace(/Date:/i, "").trim());
    } else {
      pattern=new RegExp(/Sent:.*/i);
      searchResults = pattern.exec(this);
      if (searchResults !== null) {
        dateAsDate = new Date(searchResults[0].replace(/Sent:/i, "").trim());
      } else {
        pattern=new RegExp(">.*"); // for gmail basic view
        searchResults = pattern.exec(this);
        if (searchResults !== null) {
          dateAsDate = new Date(searchResults[0].replace(">", "").trim());
        } else {
          return null;
        }
      }
    }
    responseDateStr = dateAsDate.format("Y-m-d G:i:s");
    return responseDateStr;
  };
  
  function getEmailFromAddrBlurText(widget) {
    var fromNameTemp = eval((widget.value).getFromName); 
    document.getElementById("fromName").value = fromNameTemp;
    var fromAddrTemp = eval((widget.value).getEmailAddress(this.value)); 
    document.getElementById("fromEmailAddr").value = fromAddrTemp;
    return fromAddrTemp;
  }
  
  function getEmailDateBlurText(widgetId) {
    var widget = document.getElementById(widgetId);
    var dateSentTemp = eval(("Date: " + widget.value).getDateSent); 
    document.getElementById("responseDateSentStr").value = dateSentTemp;
    return dateSentTemp;
  }
  
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  
  $phpEchoAnalysis = false; // used 7/13/12
  $debugInit = -1;

  date_default_timezone_set('America/Denver');

  function addTextWidgetRow($desc, $idName, $initValue, $onBlurText, $disable=false) {
    $maxLength = 200;
    echo "<!-- TextWidgetRow: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
//    $genId = HTMLGen::genId($idName);
    $genId = $idName;
    $titleMarkupClass = 'rowTitleText'; // rowTitleTextNarrow, rowTitleTextWide, rowTitleText
    $descAnteChar = ($desc == '') ? "" : ":";
    $isPassword = (strpos ($idName, 'password') !== false) || (strpos ($idName, 'pw') !== false)
                || (strpos ($desc, 'password') !== false) || (strpos ($desc, 'pw') !== false);
    $isYearProduced = ($idName == DatumProperties::getItemKeyFor('works', 'yearProduced'));
    $isLastName = ($idName == DatumProperties::getItemKeyFor('people', 'lastName'));
    $isFirstName = ($idName == DatumProperties::getItemKeyFor('people', 'nickName'));
    $inputType = ($isPassword) ? 'password' : 'text'; 
    echo "      <div class='formRowContainer' style='margin-top:4px;'>\r\n";
    echo "        <div class='" . $titleMarkupClass . "'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer'>\r\n";
    echo "          <div>\r\n";
    echo "            <input type='" . $inputType . "' id='" . $genId . "' name='" . $idName . "'";
    $fieldLengthLimit = 1024;
    if ($maxLength <= 10) $cssFieldDescriptor = "entryFormInputFieldShort";
    else $cssFieldDescriptor = (($maxLength > $fieldLengthLimit) ? "entryFormInputFieldWide" : "entryFormInputField");
    if ($isYearProduced) $cssFieldDescriptor = "entryFormInputFieldVeryShort";
    echo " class='" . $cssFieldDescriptor . "'";
    $singleQuoteSensitiveLine = ' value="' . str_replace('"', "", $initValue) . '" maxlength=' . $maxLength . (($disable) ? " disabled" : "");
    echo $singleQuoteSensitiveLine;
    echo " onchange='javascript:userMadeAChange(0);'";
    if (isset($onBlurText) && ($onBlurText != '')) { echo " onblur='" . $onBlurText . "'"; }
    echo ">\r\n";
    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    return $genId;
    echo "<!-- END TextWidgetRow -->\r\n";
  }

  function dispDate($timeStr) {
    echo '<div class="smallTitleTextOnBlack">' . $timeStr . ' >> ' . getDbDateString($timeStr) . "</div>\r\n";
  }

  function getDbDateString($timeStr) {
    //echo $timeStr . ' >> ' . strtotime($timeStr)  . ' >> ' . date('Y-m-d H:i:s', strtotime($timeStr)) . "<br>\r\n";
    if ($timeStr == "") return "";
    else {
      $timeStamp = strtotime($timeStr);
      if ($timeStamp === false) $dateDisp = "Error in date format above.";
      else $dateDisp = date('Y-m-d H:i:s', $timeStamp);
      return $dateDisp;
    }
  }
  
  function getPermissionRequestFromDB($personId) {
    global $phpEchoAnalysis;
    if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
    // TODO: Eliminate permissionRequest.dateGenerated (a redundant column) and instead get communications.dateSent
    // TODO: Eventually, add the permission response communication to the communications table. Then, permissionRequest.responseFrom 
    //       will be replaced by communications.sender from the record where communications.inResponseTo = communicationId of the request,
    //       and likewise, dateResponseReceived will be replaced by communications.dateSent for the response record.
    // Also see PERMISSIONS MANAGEMENT notes in _SansSouciTODOs.
    $query = 'SELECT workId, title, designatedId, '
           . 'permissionRequestId, permissionType, grantedOrDenied, event, season, '
           . 'requestComm, dateSent, responseFrom, dateResponseReceived, responseQuote, permissionRequest.notes '
           . 'FROM works JOIN communicationWork ON workId = work '
           . 'JOIN communications ON communicationId = communication '
           . 'JOIN permissionRequest on requestComm = communication AND permissionRequest.work = workId '
           . 'WHERE withdrawn=0 AND submitter = ' . $personId . ' and permissionType = "DemoReelClip" ' // TODO generalize this beyond DemoReelClip
           . 'and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
    SSFDebug::globalDebugger()->becho("getPermissionRequestFromDB query", $query, -1);
    $worksOfPossibleInterest = SSFDB::getDB()->getArrayFromQuery($query);
    SSFDebug::globalDebugger()->belch("worksOfPossibleInterest", $worksOfPossibleInterest, -1); // used 7/13/12
    SSFDebug::globalDebugger()->belch("count(worksOfPossibleInterest)", count($worksOfPossibleInterest), -1);
    return $worksOfPossibleInterest;
  }

  $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('050. editorState', $editorState, 1); // 7/13/12

  $editorState['orientationSelector'] = 'works'; // preserved for compatibility with HTMLGen

  $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  
  SSFQuery::useAdministratorAsCreatorModifier();
  
  if (!isset($editorState['personSelector'])) $editorState['personSelector'] = 0; // 7/31/13
  if (!isset($editorState['workSelector'])) $editorState['workSelector'] = 0; // 7/31/13

  // Save the date if appropriate
  if (isset($editorState['submitChanges']) && $editorState['submitChanges'] == 'Submit Changes') {
    $permissionRequestOfInterestId = $editorState['permissionRequestOfInterestId'];
    SSFDebug::globalDebugger()->becho('permissionRequestOfInterestId PPP', $permissionRequestOfInterestId, -1);
    if ($permissionRequestOfInterestId != 0) {
//      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'permissionRequestId')] = $editorState['permissionRequestId'];
//      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'permissionType')] = 'DemoReelClip';
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'work')] = $editorState['workSelector'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'grantedOrDenied')] = $editorState['permissionRequest_grantedOrDenied'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'responseFrom')] = $editorState['personSelector'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'dateResponseReceived')] = $editorState['responseDateSentStr']; // responseDateSentStrWidget 7/13/12
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'responseQuote')] = $editorState['responseQuote'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'notes')] = $editorState['notes'];
//    SSFDB::debugNextQuery();
      $query = 'SELECT permissionRequestId, work, permissionType, grantedOrDenied, event, season, '
             . 'requestComm, dateSent, responseFrom, dateResponseReceived, responseQuote, permissionRequest.notes '
             . 'FROM permissionRequest JOIN communications on communicationId = requestComm '
             . 'WHERE permissionRequestId = "' . $permissionRequestOfInterestId . '"';
      $currentValuesArray = SSFDB::getDB()->getArrayFromQuery($query);
      if (count($currentValuesArray) == 1) {
        SSFDebug::globalDebugger()->belch('adminPermissions currentValuesArray CCC', $currentValuesArray, -1); // used 7/13/12
        SSFDebug::globalDebugger()->belch('adminPermissions $newValuesArray CCC', $newValuesArray, -1); // used 7/13/12
//      SSFQuery::debugOn();
        $changeCount = SSFQuery::updateDBFor('permissionRequest', $currentValuesArray[0], $newValuesArray, 'permissionRequestId', $permissionRequestOfInterestId);
//      SSFQuery::debugOff();
        SSFDebug::globalDebugger()->becho('permissionRequest changeCount', $changeCount, -1);  // used 7/13/12
      } else {
        SSFDebug::globalDebugger()->becho('INTERNAL ERROR. Tell David. permissionRequestId', $permissionRequestId . ' is either not in DB or there are more than one.', 1);
      }
    }
  }
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
                    <div style="background-color:#333333;text-align:center;">
                      <div class="programPageTitleText" style="padding-top:8px; padding-left:8px;text-align:left;">Permissions
                        <div class="smallTitleTextOnBlack" style='font-size:18px;padding-top:4px;'>Check in Demo Clip Permission Request Responses</div>
                      </div>
                      <div style="clear:both;"></div>

<?php

?>

<!-- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM -->
<div id="formEnclosingDiv" style="margin-top:10px;">
<form name='adminPermissionsForm' id='adminPermissionsForm' action='adminPermissions.php' method='post'>
<?php
//  echo '<input type="hidden" id="headerString" name="headerString" value="' . ((isset($_POST["headerString"])) ? $_POST["headerString"] : "") . '">';
//  echo '<input type="hidden" id="fromLine" name="fromLine" value="' . ((isset($_POST["fromLine"])) ? $_POST["fromLine"] : "") . '">';
  echo '<input type="hidden" id="fromName" name="fromName" value="' . ((isset($_POST["fromName"])) ? $_POST["fromName"] : "") . '">';
  echo '<input type="hidden" id="fromEmailAddr" name="fromEmailAddr" value="' . ((isset($_POST["fromEmailAddr"])) ? $_POST["fromEmailAddr"] : "") . '">';
  echo '<input type="hidden" id="responseDateSentStr" name="responseDateSentStr" value="' . ((isset($_POST["responseDateSentStr"])) ? $_POST["responseDateSentStr"] : "") . '">';
//  echo '<input type="hidden" id="subject" name="subject" value="' . ((isset($_POST["subject"])) ? $_POST["subject"] : "") . '">';
?>

  <div style="margin:20px 20px 40px 20px;border:yellow dashed 0;">

<?php HTMLGen::displayAdministratorSelector("padding-left:4px;padding-bottom:4px;border:red solid 0;", "rowTitleTextNarrow", 
                                            "document.adminPermissionsForm.submit();", "adminPermissions"); ?>

    <div style="text-align:left;">
      <div class="bodyTextOnBlack" style="margin:18px 0 8px 0;font-size:18px;">Paste email Sender and Date into the text boxes below and press tab.</div>
<?php
echo "<!-- Email From text field -->";
$emailFromBlurText = 'javascript:'
                   . 'var fromNameTemp = eval((this.value).getFromName); document.getElementById("fromName").value = fromNameTemp;'
                   . 'var fromAddrTemp = eval((this.value).getEmailAddress(this.value)); document.getElementById("fromEmailAddr").value = fromAddrTemp;';
addTextWidgetRow('Email Sender', 'fromEmailAddr', ((isset($_POST["fromEmailAddr"])) ? $_POST["fromEmailAddr"] : ""), 'javascript:getEmailFromAddrBlurText(this);', $disable=false);
echo "<!-- Email Date text field -->";
$emailDateBlurText = 'javascript:var dateSentTemp = eval(("Date: " + this.value).getDateSent); document.getElementById("responseDateSentStr").value = dateSentTemp;';
addTextWidgetRow('Email Date', 'responseDateSentStr', ((isset($_POST["responseDateSentStr"])) ? $_POST["responseDateSentStr"] : ""), 'javascript:getEmailDateBlurText("responseDateSentStr");', $disable=false); 
?>
      <div style="padding-top:10px;border:green solid 0;">
        <div class="bodyTextOnBlack" style="margin:12px 0 8px 0;font-size:18px;">After you press tab, results will appear here and you can edit them.</div>
        <div id="echoArea" style="border:purple solid 0;"></div>
    </div>

<?php
// Email Header ANALYSIS
    $worksOfPossibleInterest = array();
    $justBlurred = (isset($_POST['justBlurredHeader']) && $_POST['justBlurredHeader'] == 1);
/*
    if ($justBlurred) {
      if (isset($_POST['headerString']) && $_POST['headerString'] != '') {
        $editorState['parsedPersonId'] = 0;
        $editorState['parsedPersonName'] = '';
        $eidtorState['parsedEmailAddr'] = '';
        $editorState['workSelector'] = 0;
        $editorState['personSelector'] = 0;
        $permissionsOfPossibleInterest = array();
        if (isset($_POST['fromEmailAddr']) && $_POST['fromEmailAddr'] != '') {
          $eidtorState['parsedEmailAddr'] = $_POST['fromEmailAddr'];
          if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
          $query = 'SELECT personId, name, email FROM people WHERE email="' . $eidtorState['parsedEmailAddr'] . '"';
          $result = SSFDB::getDB()->getArrayFromQuery($query);
          if (isset($result) && count($result) > 1) { // Try again if the first query got more than one hit.
            if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
            $query = 'SELECT personId, name, email FROM people WHERE email="' . $eidtorState['parsedEmailAddr'] . '" '
                   . 'AND name="' . $_POST['fromName'] . '"';
            $result = SSFDB::getDB()->getArrayFromQuery($query);
          }
          SSFDebug::globalDebugger()->belch("result", $result, ($phpEchoAnalysis) ? 1 : -1);
          if (isset($result) && count($result) == 0) { // Try again if the second query got no hits.
             if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
            $query = 'SELECT personId, name, email FROM people WHERE name="' . $_POST['fromName'] . '"';
            $result = SSFDB::getDB()->getArrayFromQuery($query);
          }
          if (!isset($result) || count($result) != 1) {
            SSFDebug::globalDebugger()->becho("Neither email address nor name are uniquely identified in DB", 
                                              $eidtorState['parsedEmailAddr'] . ', ' . $_POST['fromName'], 1);
          } else {
            $editorState['personSelector'] = $editorState['parsedPersonId'] = $result[0]['personId'];
            $editorState['parsedPersonName'] = $result[0]['name'];
            $worksOfPossibleInterest = getPermissionRequestFromDB($editorState['parsedPersonId']);
            SSFDebug::globalDebugger()->belch("Works of possible interest", $worksOfPossibleInterest, -1);
            $editorState['workSelector'] = (count($worksOfPossibleInterest) == 1) ? $worksOfPossibleInterest[0]['workId'] : 0;
          }
        }
        if ($phpEchoAnalysis) { 
          echo '      <h3 style="margin:2px 0 4px 0;">Email header analysis:</h3>' . "\r\n";
          echo '      <div style="border:pink dashed 0;">' . "\r\n";
          $verticalBar = "|";
          echo "headerString = " . $verticalBar . $_POST['headerString'] . $verticalBar . "<br>";
          echo "from line = " . $verticalBar . $_POST['fromLine'] . $verticalBar . "<br>";
          echo "<br>";
          $verticalBar = "";
          echo "from name = " . $verticalBar . $_POST['fromName'] . $verticalBar .  "<br>";
          echo "email address = " . $verticalBar . $_POST['fromEmailAddr'] . $verticalBar . "<br>";
          echo "DB person = " . $verticalBar . $editorState['parsedPersonId'] . ', ' . $editorState['parsedPersonName'] . $verticalBar . "<br>";
          echo "date sent = " . $verticalBar . $_POST['responseDateSentStr'] . $verticalBar . "<br>";
          echo "DB date = " . $verticalBar . getDbDateString($_POST['responseDateSentStr']) . $verticalBar . "<br>";
          echo "subject = " . $verticalBar . $_POST['subject'] . $verticalBar . "<br>";
          echo '      </div>' . "\r\n";
        }
      } 
    }
*/
?>

<!-- Begin Filters -------------------------------------------------------- -->
<!-- Call for Entries Selector -->
          <!-- TODO: CallFor always snaps back to the default. Fix this. -->
          <div class='formRowContainer'>
            <div class='rowTitleText'>Call for:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
                <?php HTMLGen::displayCallForEntriesSelector('adminPermissionsForm',
                         'getUniqueElement("personSelector").value=0;'
                       . 'getUniqueElement("workSelector").value=0;'); 
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
<!-- Person Selector -->
          <!-- TODO: make it work when the $personToBe == 0 -->
          <div class='formRowContainer'>
            <div class='rowTitleText'>Respondent: </div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php //SSFDB::debugNextQuery(); 
                      $personToBe = HTMLGen::displayPersonSelector('adminPermissionsForm', $editorState);
                      $editorState['personSelector'] = $personToBe;
  SSFDebug::globalDebugger()->belch('editorState["personSelector"]', $editorState["personSelector"], -1);
                ?>
              </div>
            </div>
            <div style="clear:both;"></div>
          </div>
<!-- Work Selector -->
          <div class='formRowContainer'>
            <div class='rowTitleText'>Work:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
<?php 
//                  if ($justBlurred || $editorState['personSelector'] == 0) $editorState['workSelector'] = 0; // Compute this over again, regardless of it's previous value.
  SSFDebug::globalDebugger()->belch('editorState', $editorState, -1);
                      $editorState['workSelector'] = HTMLGen::displayWorkSelector('adminPermissionsForm', $editorState['personSelector'], $editorState, '-- select a work --'); 
                      //if ($unique) echo "<script type='text/javascript'>document.adminPermissionsForm.submit();></script>";
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
<!-- End Filters ------------------------------------------------------------- -->

<?php
  if (!$justBlurred) $worksOfPossibleInterest = getPermissionRequestFromDB($editorState['personSelector']);
  $workOfInterest = null;
  $thereIsAWorkOfInterest = false;
  $permissionRequestOfInterestId = 0;
  foreach ($worksOfPossibleInterest as $workOfPossibleInterest) {
    if ($workOfPossibleInterest['workId'] == $editorState['workSelector']) {
      $workOfInterest = $workOfPossibleInterest;
      $permissionRequestOfInterestId = $workOfInterest['permissionRequestId'];
      $thereIsAWorkOfInterest = true;
    }
  }
?>
          <div class='formRowContainer'>
            <div class='rowTitleText'>Prmssn Request:</div>
            <div class='entryFormFieldContainer'>
              <div class='datumValue' style="width:456px;"><?php 
                  echo (($thereIsAWorkOfInterest) 
                    ? ' #' . $permissionRequestOfInterestId
                      . ', sent ' . ($workOfInterest['dateSent']
                      . ', for a ' . $workOfInterest['permissionType'] 
                      . ' from "' . $workOfInterest['title'] . '"'
                      . ' (#' . $workOfInterest['workId']
                      . ' , ' . $workOfInterest['designatedId'] . ')'
                      . ' via Communication #' . $workOfInterest['requestComm']) 
                    : "NONE."); 
                ?></div>
            </div>
            <div style='clear:both;'></div>
          </div>
<?php
  SSFDebug::globalDebugger()->belch('editorState["responseDateSentStr"] GGGG', isset($editorState["responseDateSentStr"]) ? $editorState["responseDateSentStr"] : "", -1);
  $responseDateSentStr = ($justBlurred) ? getDbDateString($editorState["responseDateSentStr"]) 
                                        : (isset($editorState["responseDateSentStrWidget"]) 
                                        ? $editorState["responseDateSentStrWidget"]
                                        : ""); 
  HTMLGen::addTextWidgetRowWithTitleWidth('Response Sent', 'responseDateSentStrWidget', $responseDateSentStr, 16, '');
  HTMLGen::addRadioButtonWidgetRow('Status', 'permissionRequest', 'grantedOrDenied', $workOfInterest["grantedOrDenied"], 4); 
  HTMLGen::addTextAreaRowWithWidth('responseQuote', 'Relevant quote from response', $workOfInterest["responseQuote"], 80, 2, "", $disable=false);
  echo "<div style='margin-top:2px;'></div>";
  HTMLGen::addTextAreaRowWithWidth('notes', 'Notes', $workOfInterest["notes"], 80, 2, "", $disable=false);
  $submitEnabled = (($editorState['personSelector'] != 0) && ($editorState['workSelector'] != 0) 
                                                          && ($editorState['responseDateSentStrWidget'] != 'Error in date format above.')
                                                          && ($editorState['responseDateSentStrWidget'] != ''));
?>
          <div style="padding-top:6px;padding-left:116px;">
            <input type="submit" id="submitChanges" name="submitChanges" value="Submit Changes" <?php echo (($submitEnabled) ? '' : ' disabled="disabled"'); ?>>
          </div>
          <div style="clear: both;"></div>
        </div>
      
<!-- TODO
  Inputs: Granted/Denied/Unknown, responseQuote, permissionRequest.notes
  
  For permissionType's other than DemoReelClip, add fields for permissionRequest.event and permissionRequest.season as appropriate.
-->
      </div>

  <input type="hidden" id="parsedPersonId" name="parsedPersonId" value="<?php echo (isset($editorState['parsedPersonId']) ? $editorState['parsedPersonId'] : 0); ?>">
  <input type="hidden" id="parsedPersonName" name="parsedPersonName" value="<?php echo (isset($editorState['parsedPersonName']) ? $editorState['parsedPersonName'] : ''); ?>">
  <input type="hidden" id="parsedEmailAddr" name="parsedEmailAddr" value="<?php echo (isset($editorState['parsedEmailAddr']) ? $editorState['parsedEmailAddr'] : ''); ?>">
  <input type="hidden" id="justBlurredHeader" name="justBlurredHeader" value=0>
  <input type="hidden" id="permissionRequestOfInterestId" name="permissionRequestOfInterestId" value=<?php echo $permissionRequestOfInterestId; ?> >
  <!-- The junk below is copied from adminDataEntry.php. Most of it is actually needed here. -->
<!--   <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<? echo $editorState['adminSelector']?>"> -->
<!--  <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<?php echo $editorState['callForEntriesId']?>"> -->
<!--  <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $editorState['personSelector']?>"> -->
<!--  <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>"> -->
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
  <!-- orientationSelector maintained for compatibility with HTMLGen::displayPersonSelector() -->
  <input type="hidden" id="orientationSelector" name="orientationSelector" value="<?php echo $editorState['orientationSelector']?>"> 
  <!-- editingPerson maintained for compatibility with HTMLGen::displayPersonSelector(). Sync with personSelector input. -->
  <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo $editorState['personSelector']; ?>"> 
  <!-- selectorSubmitter is support for HTMLGen passing the name of the selector that initiated a Submit onchange. TODO See note in _SansSouciTODOs.txt -->
  <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> 

</form>

<?php // dispDate("August 13, 2010 9:33:42 PM MDT"); ?>

<?php SSFDebug::globalDebugger()->belch('999. editorState', $editorState, $debugInit); ?>

</div> <!-- id=formEnclosingDiv -->

                    </div>
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
            <td align="center" valign="bottom"><br>
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