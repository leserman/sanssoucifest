<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Enter Paypal Payment Receipt</title>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>

<!-- TODO: Set global variables: jsEchoAnalysis, $phpEchoAnalysis, $debugInit -->

<script type="text/javascript">

  var jsEchoAnalysis = false;

  String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); };

  function composedResultString(pmtDate, transId, pmtAmt1, pmtAmt2, buyerName1, buyerName2, buyerEmail1, buyerEmail2, filmTitle, submitterEmail) {
    var verticalBar = "|";
    verticalBar = "";
    var resultString = '';
    resultString = resultString + ("pmtDate = " + verticalBar + pmtDate + verticalBar + "<br>");
    resultString = resultString + ("transId = " + verticalBar + transId + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt1 = " + verticalBar + pmtAmt1 + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt2 = " + verticalBar + pmtAmt2 + verticalBar + "<br>");
    resultString = resultString + ("buyerName1 = " + verticalBar + buyerName1 + verticalBar + "<br>");
    resultString = resultString + ("buyerName2 = " + verticalBar + buyerName2 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail1 = " + verticalBar + buyerEmail1 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail2 = " + verticalBar + buyerEmail2 + verticalBar + "<br>");
    resultString = resultString + ("filmTitle = " + verticalBar + filmTitle + verticalBar + "<br>");
    resultString = resultString + ("submitterEmail = " + verticalBar + submitterEmail + verticalBar + "<br>");
    if (jsEchoAnalysis) { alert("hidden inputs set." + resultString); }
    return resultString;
  }

  function parsePasteAreaString(pasteAreaString) { 
    var resultString = '';
    var pattern;
    var searchResults;
    var pmtDate = ''; 
    var transId = ''; 
    var pmtAmt1 = ''; 
    var buyerName1 = ''; 
    var buyerEmail1 = ''; 
    var buyerName2 = ''; 
    var buyerEmail2 = ''; 
    var pmtAmt2 = '';
    var filmTitle = ''; 
    var submitterEmail = ''; 

    // pmtDate, transId, pmtAmt1, buyerName1, buyerEmail1 
    // (See http://www.regular-expressions.info/javascript.html)
    // \1 is the date
    // \2 is transactionId
    // \3 is payment amount #1
    // \4 is buyer name #1
    // \5 is buyer email #1
    pattern = new RegExp(/\t(.*?)[\r\n]+Transaction ID: ([\w]*?)[\r\n]+Hello.*?,[\r\n]+.*?payment of \$([\d]+[.]{1}[\d]+) USD from (.*?)\((.*?)\)/i); 
    searchResults = pattern.exec(pasteAreaString);
    if (searchResults !== null) { 
      pmtDate = searchResults[1].trim(); 
      transId = searchResults[2].trim(); 
      pmtAmt1 = searchResults[3].trim(); 
      buyerName1 = searchResults[4].trim(); // buyerName2 is more reliable
      buyerEmail1 = searchResults[5].trim(); 
    } 

    // buyerName2 & buyerEmail2
    // \1 is buyer name #2
    // \2 is buyer email #2
    pattern = new RegExp(/Buyer( information)*?[\r\n]+?(.*?)[\r\n]+?(.*?)[\r\n]+?/i); 
    searchResults = pattern.exec(pasteAreaString);
    if (searchResults !== null) { 
      // searchResults[1] is the optional string " information"
      buyerName2 = searchResults[2].trim(); // buyerName1 is less reliable 
      buyerEmail2 = searchResults[3].trim(); 
    } 

    // filmTitle & submitterEmail
    // \1 is film title
    // \2 is submitter email address as in DB hopefully
    pattern = new RegExp(/Film Title: (.+?)[ ]*?, Submitter Email Address: (.+?)[\r\n\t ]{1}/i); 
    searchResults = pattern.exec(pasteAreaString);
    if (searchResults !== null) { 
      filmTitle = searchResults[1].trim(); 
      submitterEmail = searchResults[2].trim(); 
    } 

    // pmtAmt2
    // \1 is paymment amount #2
    pattern = new RegExp(/Total[\s:]*?\$([\d]+[.]{1}[\d]+) USD/i); 
    searchResults = pattern.exec(pasteAreaString);
    if (searchResults !== null) { pmtAmt2 = searchResults[1].trim(); }

    document.getElementById("pasteAreaString").value = pasteAreaString;
    document.getElementById("pmtDate").value = pmtDate;
    document.getElementById("transId").value = transId;
    document.getElementById("pmtAmt1").value = pmtAmt1;
    document.getElementById("pmtAmt2").value = pmtAmt2;
    document.getElementById("buyerName1").value = buyerName1;
    document.getElementById("buyerName2").value = buyerName2;
    document.getElementById("buyerEmail1").value = buyerEmail1;
    document.getElementById("buyerEmail2").value = buyerEmail2;
    document.getElementById("filmTitle").value = filmTitle;
    document.getElementById("submitterEmail").value = submitterEmail;
/*
    var verticalBar = "|";
    verticalBar = "";
    var resultString = '';
    resultString = resultString + ("pmtDate = " + verticalBar + pmtDate + verticalBar + "<br>");
    resultString = resultString + ("transId = " + verticalBar + transId + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt1 = " + verticalBar + pmtAmt1 + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt2 = " + verticalBar + pmtAmt2 + verticalBar + "<br>");
    resultString = resultString + ("buyerName1 = " + verticalBar + buyerName1 + verticalBar + "<br>");
    resultString = resultString + ("buyerName2 = " + verticalBar + buyerName2 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail1 = " + verticalBar + buyerEmail1 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail2 = " + verticalBar + buyerEmail2 + verticalBar + "<br>");
    resultString = resultString + ("filmTitle = " + verticalBar + filmTitle + verticalBar + "<br>");
    resultString = resultString + ("submitterEmail = " + verticalBar + submitterEmail + verticalBar + "<br>");
    if (jsEchoAnalysis) { alert("hidden inputs set." + resultString); }
*/
    resultString = composedResultString(pmtDate, transId, pmtAmt1, pmtAmt2, buyerName1, buyerName2, buyerEmail1, buyerEmail2, filmTitle, submitterEmail);
    return resultString;
  }

  function echoIt(string) {
    document.getElementById("echoArea").innerHTML = '<div class="datumDescription" style="margin-left:10px;color:#FFFFCC;line-height:134%">' + parsePasteAreaString(string) + '<\/div><br>';
//    document.getElementById("echoArea").innerHTML = parsePasteAreaString(string);
    if (jsEchoAnalysis) { alert('echoIt'); }
  }

  function justBlurredPasteArea($textArea) {
//    if (jsEchoAnalysis) { echoIt($textArea.value); }
//    else { parsePasteAreaString($textArea.value); }
    echoIt($textArea.value);
    document.getElementById('justBlurredPasteAreaFlag').value = 1;
//    document.getElementById('emailAnalysisForm').submit();
    return 1;
  }

</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<script type="text/javascript">
  function setCache(id, priorValue) {
    newValue = 1;
    if (priorValue == 1) { newValue = 0; }
    //alert('setCache(' + id + ') called with prior value = ' + priorValue + '.');
    if (id == 'showPromised') { document.getElementById('showPromisedCache').value = newValue; } 
    else if (id == 'showReceived') { document.getElementById('showReceivedCache').value = newValue; } 
    else { alert('ERROR: setCache(' + id + ')'); }
  }
</script>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
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
                      <div class="programPageTitleText" style="padding-top:8px; padding-left:8px;text-align:left;">Enter 
                        Paypal Payment Receipt</div><br> <!-- TODO: Why is this <br> needed here? -->

<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $phpEchoAnalysis = false;
  $debugInit = -1;

  date_default_timezone_set('America/Denver');

  function dispDate($timeStr) {
    echo '<div class="smallTitleTextOnBlack">' . $timeStr . ' >> ' . getDbDateString($timeStr) . "</div>\r\n";
  }

  function getDbDateString($timeStr) {
    //echo $timeStr . ' >> ' . strtotime($timeStr)  . ' >> ' . date('Y-m-d H:i:s', strtotime($timeStr)) . "<br>\r\n";
    if ($timeStr == "") return "";
    else {
      $timeStamp = strtotime($timeStr);
      if ($timeStamp === false) $dateDisp = "Error in date format.";
      else $dateDisp = date('Y-m-d H:i:s', $timeStamp);
      return $dateDisp;
    }
  }
  
  function getPermissionRequestFromDB($personId) {
    global $phpEchoAnalysis;
    if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
/*  This is the original query
    $query = 'SELECT workId, title, '
           . 'permissionRequestId, permissionType, grantedOrDenied, event, season, '
           . 'requestComm, dateGenerated, responseFrom, dateResponseReceived, responseQuote, notes '
           . 'FROM works JOIN permissionRequest on workId = work '
           . 'WHERE submitter = ' . $personId . ' and permissionType = "DemoReelClip" ' // TODO generalize this beyond DemoReelClip
           . 'and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
*/
    // DONE: The original query above makes use of permissionRequest.work which is redundant with the communications table. Use of 
    //       this column has been eliminated in the revised query below.
    // TODO: Eliminate permissionRequest.dateGenerated (a redundant column) and instead get communications.dateSent
    // TODO: Eventually, add the permission response communication to the communications table. Then, permissionRequest.responseFrom 
    //       will be replaced by communications.sender from the record where communications.inResponseTo = communicationId of the request,
    //       and likewise, dateResponseReceived will be replaced by communications.dateSent for the response record.
    // Also see PERMISSIONS MANAGEMENT notes in _SansSouciTODOs.
    $query = 'SELECT workId, title, '
           . 'permissionRequestId, permissionType, grantedOrDenied, event, season, '
           . 'requestComm, dateSent, responseFrom, dateResponseReceived, responseQuote, permissionRequest.notes '
           . 'FROM works JOIN communicationWork ON workId = work '
           . 'JOIN communications ON communicationId = communication '
           . 'JOIN permissionRequest on requestComm = communication '
           . 'WHERE submitter = ' . $personId . ' and permissionType = "DemoReelClip" ' // TODO generalize this beyond DemoReelClip
           . 'and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
    $worksOfPossibleInterest = SSFDB::getDB()->getArrayFromQuery($query);
    SSFDebug::globalDebugger()->belch("worksOfPossibleInterest", $worksOfPossibleInterest, -1);
    SSFDebug::globalDebugger()->belch("count(worksOfPossibleInterest)", count($worksOfPossibleInterest), -1);
    return $worksOfPossibleInterest;
  }

  $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('050. editorState', $editorState, $debugInit);

  $editorState['orientationSelector'] = 'works'; // preserved for compatibility with HTMLGen

  $editorState['callForEntriesId'] = SSFRunTimeValues::getCallForEntriesId();
  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) { // was === before 2/16/10
    $editorState['adminSelector'] = (isset($editorState['priorAdminSelector'])) ? $editorState['priorAdminSelector'] : 0;
  }
  if (!isset($editorState['adminSelector']) || $editorState['adminSelector'] == 0) 
    $editorState['adminSelector'] = SSFRunTimeValues::getDefaultAdministratorId();
  if (!isset($editorState['personSelector'])) { 
    $editorState['personSelector'] = ((isset($editorState['priorPersonSelection'])) ? $editorState['priorPersonSelection'] : 0);
  }
  if (!isset($editorState['workSelector']) || $editorState['workSelector'] == 0) { // was === before 2/16/10
    $editorState['workSelector'] = ((isset($editorState['priorWorkSelection'])) ? $editorState['priorWorkSelection'] : 0); 
  }

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
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'dateResponseReceived')] = $editorState['dateSentStrWidget'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'responseQuote')] = $editorState['responseQuote'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'notes')] = $editorState['notes'];
      //SSFDB::debugNextQuery();
      $query = 'SELECT permissionRequestId, work, permissionType, grantedOrDenied, event, season, '
             . 'requestComm, dateSent, responseFrom, dateResponseReceived, responseQuote, permissionRequest.notes '
             . 'FROM permissionRequest JOIN communications on communicationId = requestComm '
             . 'WHERE permissionRequestId = "' . $permissionRequestOfInterestId . '"';
      $currentValuesArray = SSFDB::getDB()->getArrayFromQuery($query);
      if (count($currentValuesArray) == 1) {
        SSFDebug::globalDebugger()->belch('adminPermissions currentValuesArray CCC', $currentValuesArray, -1);
        $changeCount = SSFQuery::updateDBFor('permissionRequest', $currentValuesArray[0], $newValuesArray, 'permissionRequestId', $permissionRequestOfInterestId);
        SSFDebug::globalDebugger()->becho('permissionRequest changeCount', $changeCount, -1);
      } else {
        SSFDebug::globalDebugger()->becho('INTERNAL ERROR. Tell David. permissionRequestId', $permissionRequestId . ' is either not in DB or there are more than one.', 1);
      }
    }
  }

?>

<!-- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM -->
<div id="formEnclosingDiv" style="margin-top:10px;">
<form name='emailAnalysisForm' id='emailAnalysisForm' action='adminPermissions.php' method='post'>
<?php
  echo '<input type="hidden" id="pasteAreaString" name="pasteAreaString" value="' . ((isset($_POST["pasteAreaString"])) ? $_POST["pasteAreaString"] : "") . '">';
  echo '<input type="hidden" id="fromLine" name="fromLine" value="' . ((isset($_POST["fromLine"])) ? $_POST["fromLine"] : "") . '">';
  echo '<input type="hidden" id="fromName" name="fromName" value="' . ((isset($_POST["fromName"])) ? $_POST["fromName"] : "") . '">';
  echo '<input type="hidden" id="fromEmailAddr" name="fromEmailAddr" value="' . ((isset($_POST["fromEmailAddr"])) ? $_POST["fromEmailAddr"] : "") . '">';
  echo '<input type="hidden" id="dateSentStr" name="dateSentStr" value="' . ((isset($_POST["dateSentStr"])) ? $_POST["dateSentStr"] : "") . '">';
  echo '<input type="hidden" id="subject" name="subject" value="' . ((isset($_POST["subject"])) ? $_POST["subject"] : "") . '">';
?>

  <div style="margin:20px 20px 40px 20px;border:yellow dashed 1;">

<!-- Administrator Selector -->
          <div class='formRowContainer' style="padding-left:4px;padding-top:4px;border:red solid 0;">
            <div class='rowTitleTextNarrow'>Administrator:</div>
            <div class="entryFormFieldContainer">
              <div>
        <?php //SSFDB::debugNextQuery(); 
                $personRows = SSFQuery::getAdministrators();
                echo '<select id="adminSelector" name="adminSelector" style="width:220px" onchange="document.emailAnalysisForm.submit();">';
                foreach ($personRows as $personRow) 
                  $selectionOptions[$personRow['personId']] = 
                    ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " 
                                                                                       : "") 
                                                                                       . $personRow['name'];
                HTMLGen::displaySelectionOptions($selectionOptions, $editorState['adminSelector']);
                echo '</select>' . "\r\n";
        ?>
              </div>
            </div>
          <div style="clear:both;"></div>
          </div>
<!-- End Administrator Selector -->

    <div style="text-align:left;">
      <div class="smallTitleTextOnBlack" style="margin:18px 0 4px 0;font-size:16px;font-weight:normal;">Paste Paypal Payment Received email body into the text box below and press tab.</div>
      <textarea id="pasteArea" name="pasteArea" rows="8" cols="80" onblur="javascript:justBlurredPasteArea(this);"><?php
         echo ((isset($_POST["pasteArea"])) ? $_POST["pasteArea"] : "Paste email body here.") . "</textarea>\r\n"; ?>
      <div style="padding-top:10px;border:green solid 0;">
        <div class="smallTitleTextOnBlack" style="margin:8px 0 8px 0;font-size:16px;font-weight:normal;">After you press tab, results will appear here.</div>
        <div id="echoArea" style="border:purple solid 0;"></div>
    </div>
    
<?php
// Paypal Email ANALYSIS
    $worksOfPossibleInterest = array();
    $justBlurred = (isset($_POST['justBlurredPasteAreaFlag']) && $_POST['justBlurredPasteAreaFlag'] == 1);
    if ($justBlurred) {
      if (isset($_POST['pasteAreaString']) && $_POST['pasteAreaString'] != '') {
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
          echo '      <h3 style="margin:2px 0 4px 0;">Email analysis:</h3>' . "\r\n";
          echo '      <div style="border:pink dashed 0;">' . "\r\n";
          $verticalBar = "|";
          echo "pasteAreaString = " . $verticalBar . $_POST['pasteAreaString'] . $verticalBar . "<br>";
          echo "from line = " . $verticalBar . $_POST['fromLine'] . $verticalBar . "<br>";
          echo "<br>";
          $verticalBar = "";
          echo "from name = " . $verticalBar . $_POST['fromName'] . $verticalBar .  "<br>";
          echo "email address = " . $verticalBar . $_POST['fromEmailAddr'] . $verticalBar . "<br>";
          echo "DB person = " . $verticalBar . $editorState['parsedPersonId'] . ', ' . $editorState['parsedPersonName'] . $verticalBar . "<br>";
          echo "date sent = " . $verticalBar . $_POST['dateSentStr'] . $verticalBar . "<br>";
          echo "DB date = " . $verticalBar . getDbDateString($_POST['dateSentStr']) . $verticalBar . "<br>";
          echo "subject = " . $verticalBar . $_POST['subject'] . $verticalBar . "<br>";
          echo '      </div>' . "\r\n";
        }
      } 
    }
?>

<!-- Begin Filters -------------------------------------------------------- -->
<!-- Call for Entries Selector -->
          <!-- TODO: CallFor always snaps back to the default. Fix this.
          <div class='formRowContainer'>
            <div class='rowTitleText'>Call for:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'><?php 
/*
                HTMLGen::displayCallForEntriesSelector('emailAnalysisForm',
                         'getUniqueElement("personSelector").value=0;'
                       . 'getUniqueElement("workSelector").value=0;'); 
*/
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
 -->

<!-- End Filters ------------------------------------------------------------- -->

<?php /*
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
  } */
?>
<!--
          <div class='formRowContainer'>
            <div class='rowTitleText'>Prmssn Request:</div>
            <div class='entryFormFieldContainer'>
              <div class='datumValue'><?php 
/*
                  echo (($thereIsAWorkOfInterest) 
                    ? ' #' . $permissionRequestOfInterestId
                      . ', sent ' . ($workOfInterest['dateSent']
                      . ', for a ' . $workOfInterest['permissionType'] 
                      . ' via Communication #' . $workOfInterest['requestComm']) 
                    : "NONE."); 
*/
                ?></div>
            </div>
            <div style='clear:both;'></div>
          </div>
-->
<?php
/*
  SSFDebug::globalDebugger()->belch('editorState["dateSentStr"] GGGG', isset($editorState["dateSentStr"]) ? $editorState["dateSentStr"] : "", -1);

  $dateSentStr = ($justBlurred) ? getDbDateString($_POST["dateSentStr"]) : $workOfInterest['dateSent'];
  HTMLGen::addTextWidgetRowWithTitleWidth('Response Sent', 'dateSentStrWidget', $dateSentStr, 16, "w");

  HTMLGen::addRadioButtonWidgetRow('Status', 'permissionRequest', 'grantedOrDenied', $workOfInterest["grantedOrDenied"], 4); 
  HTMLGen::addTextAreaRowWithWidth('responseQuote', 'Relevant quote from response', $workOfInterest["responseQuote"], 80, 2, "", $disable=false);
  echo "<div style='margin-top:2px;'></div>";
  HTMLGen::addTextAreaRowWithWidth('notes', 'Notes', $workOfInterest["notes"], 80, 2, "", $disable=false);
*/
?>
          <div style="padding-top:6px;padding-left:116px;">
            <input type="submit" id="submitChanges" name="submitChanges" value="Submit Changes">
          </div>
        <div style="clear:both;"></div>
       </div>
    </div>

  <input type="hidden" id="pasteAreaString" name="pasteAreaString" value="">
  <input type="hidden" id="justBlurredPasteAreaFlag" name="justBlurredPasteAreaFlag" value="0">
  <input type="hidden" id="pmtDate" name="pmtDate" value="">
  <input type="hidden" id="transId" name="transId" value="">
  <input type="hidden" id="pmtAmt1" name="pmtAmt1" value="">
  <input type="hidden" id="pmtAmt2" name="pmtAmt2" value="">
  <input type="hidden" id="buyerName1" name="buyerName1" value="">
  <input type="hidden" id="buyerName2" name="buyerName2" value="">
  <input type="hidden" id="buyerEmail1" name="buyerEmail1" value="">
  <input type="hidden" id="buyerEmail2" name="buyerEmail2" value="">
  <input type="hidden" id="filmTitle" name="filmTitle" value="">
  <input type="hidden" id="pasteAreaString" name="pasteAreaString" value="">
  <input type="hidden" id="submitterEmail" name="submitterEmail" value=0>
  <!-- The junk below is copied from adminDataEntry.php. Most of it is actually needed here.
  <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<? echo $editorState['adminSelector']?>">
  <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<? echo $editorState['callForEntriesId']?>">
  <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<? echo $editorState['personSelector']?>">
  <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<? echo $editorState['workSelector']?>">
  <input type="hidden" id="changeCount" name="changeCount" value="<? echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<? echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<? echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
 -->
  <!-- orientationSelector maintained for compatibility with HTMLGen::displayPersonSelector() -->
  <input type="hidden" id="orientationSelector" name="orientationSelector" value="<?php echo $editorState['orientationSelector']?>"> 
  <!-- editingPerson maintained for compatibility with HTMLGen::displayPersonSelector(). Sync with personSelector input. -->
  <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo $editorState['personSelector']; ?>"> 
  <!-- selectorSubmitter is support for HTMLGen passing the name of the selector that initiated a Submit onchange. TODO See note in _SansSouciTODOs.txt -->
  <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> 

</form>

<script type="text/javascript">
  document.getElementById('pasteArea').select();
  document.getElementById("echoArea").innerHTML = '<div class="datumDescription" style="margin-left:10px;color:#FFFFCC;line-height:134%">'
                                                + composedResultString("", "", "", "", "", "", "", "", "", ""); + '<\/div><br>';
</script>

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