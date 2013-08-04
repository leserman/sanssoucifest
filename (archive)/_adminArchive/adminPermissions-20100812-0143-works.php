<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Admin Permissions</title>
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>

<!-- TODO: Set global variables: jsEchoAnalysis, $phpEchoAnalysis, $debugInit -->

<script type="text/javascript">

  var jsEchoAnalysis = false;

  function justBlurredHeaderIn($textArea) {
    if (jsEchoAnalysis) { echoIt($textArea.value); }
    else { parseHeader($textArea.value); }
    document.getElementById('justBlurredHeader').value = 1;
    document.emailAnalysisForm.submit();
  }

  function echoIt(string) {
    alert('echoIt');
    //var len=string.length;
    //var string2 = '';
    //for (var i = 0; i < len; i++) { string2 += string.charCodeAt(i) + "<br>"; }
    document.getElementById("echoArea").innerHTML = parseHeader(string);
  }

  String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); }
  String.prototype.ltrim = function() { return this.replace(/^\s+/,""); }
  String.prototype.rtrim = function() { return this.replace(/\s+$/,""); }

  function getEmailAddressFromAngleBrackets(stringWithEmailAddressInAngleBrackets) {
    var pattern=new RegExp("<.*(?=>)"); // Get everything between < and >
    var fromEmail1 = pattern.exec(stringWithEmailAddressInAngleBrackets);
    return fromEmail1[0].replace(/^<+|\>$/g,"");
  }

  String.prototype.getEmailAddressFromAngleBrackets = function() {
    var pattern=new RegExp("<.*(?=>)"); // Get everything between < and >
    var fromEmail1 = pattern.exec(this);
    return fromEmail1[0].replace(/^<+|\>$/g,"");
  }

  String.prototype.getEmailAddressFromAngleBrackets = function() {
    var pattern=new RegExp("<.*(?=>)"); // Get everything from < through >
    var searchResults = pattern.exec(this);
    if (searchResults !== null) return searchResults[0].replace(/^<+|\>$/g,""); // Strip < and >
    else return "";
  }

  String.prototype.getFromLine = function() {
    var pattern=new RegExp("From:.*>"); // Get everything from From: through EOL
    var searchResults = pattern.exec(this);
    if (searchResults !== null) return searchResults[0];
    else return "";
  }
  
  String.prototype.getFromName = function() {
//    var pattern=new RegExp("From:.*(?=<)"); // Get everything from From: through <
    var pattern=new RegExp(".*(?=<)"); // Get everything from BOL through <
    var searchResults = pattern.exec(this);
    if (searchResults !== null) { return searchResults[0].replace("From:", "").trim(); }
    else { return this.trim(); }
  }

  String.prototype.getDateSent = function() {
    var pattern=new RegExp("Date:.*"); // Get everything from From: through EOD
    var searchResults = pattern.exec(this);
    if (searchResults !== null) {
      return searchResults[0].replace("Date:", "").trim();
    } else {
      pattern=new RegExp("Sent:.*");
      searchResults = pattern.exec(this);
      if (searchResults !== null) {
        return searchResults[0].replace("Sent:", "").trim();
      } else {
        pattern=new RegExp(">.*"); // for gmail basic view
        searchResults = pattern.exec(this);
        if (searchResults !== null) {
          return searchResults[0].replace(">", "").trim();
        } else {
          return null;
        }
      }
    }
  }

  String.prototype.getSubject = function() {
    var pattern=new RegExp("Subject:.*"); // Get everything from From: through EOD
    var searchResults = pattern.exec(this);
    if (searchResults !== null) {
      return searchResults[0].replace("Subject:", "").trim();
    } else {
      pattern=new RegExp("Sent:.*");
      searchResults = pattern.exec(this);
      if (searchResults !== null) {
        return searchResults[0].replace("Sent:", "").trim();
      } else {
        return null;
      }
    }
  }

  function parseHeader(headerString) { 
    var headerString = headerString.replace("Paste mail header here.", "").trim();
    var resultString = '';
    resultString = resultString + ("headerString=|" + headerString + "|<br>");
    var fromLine = "";
    var fromName = "";
    var fromEmailAddr = "";
    var dateSentStr = "";
    var subject = "";
    var gMailPattern = RegExp("^.*Inbox.*\\n");
    var gMailSubjectLine = gMailPattern.exec(headerString);
    if (gMailSubjectLine !== null) {
      resultString = resultString + ("Gmail line 1 = |" + gMailSubjectLine[0] + "|<br>");
      subject = gMailSubjectLine[0].replace("Inbox", "").trim();
      var gmailBasicLineIdPattern = RegExp("Show original\\n");
      var gMailBasicLineId = gmailBasicLineIdPattern.exec(headerString);
      var isGMailBasicView = (gMailBasicLineId !== null);
      if (isGMailBasicView) {
        resultString = resultString + ("GmailBasicLineId = |" + gMailBasicLineId[0] + "|<br>");
        var gMailBasicLinePattern = RegExp("\\n{1}.*\\n");
        var gMailBasicLine =  gMailBasicLinePattern.exec(headerString);
        resultString = resultString + ("gMailBasicLine = |" + gMailBasicLine[0] + "|<br>");
        fromLine = gMailBasicLine[0];
        fromName = gMailBasicLine[0].getFromName();
        fromEmailAddr = gMailBasicLine[0].getEmailAddressFromAngleBrackets();
        dateSentStr = gMailBasicLine[0].getDateSent();
      } else { //since this is gmail standard view
        dateSentStr = headerString.getDateSent();
        var gmailStandardLinesPattern = RegExp("Hide details\\n.*\\n<.*>");
        var gmailStandardLines = gmailStandardLinesPattern.exec(headerString);
        if (gmailStandardLines !== null) {
          fromLine = gmailStandardLines[0].replace("<", "&lt;").replace(">", "&gt;");
          fromEmailAddr = gmailStandardLines[0].getEmailAddressFromAngleBrackets();
          var gmailfromNamePattern = RegExp("Hide details\\n.*\\n");
          fromName0 = gmailfromNamePattern.exec(fromLine);
          if (fromName0 !== null) { fromName = fromName0[0].replace("Hide details", "").replace("<", "").trim(); }
        }
      }
    } else {
      fromLine = headerString.getFromLine();
      fromName = fromLine.getFromName();
      fromEmailAddr = fromLine.getEmailAddressFromAngleBrackets();
      dateSentStr = headerString.getDateSent();
      subject = headerString.getSubject();
    }

    document.getElementById("headerString").value = headerString;
    document.getElementById("fromLine").value = fromLine;
    document.getElementById("fromName").value = fromName;
    document.getElementById("fromEmailAddr").value = fromEmailAddr;
    document.getElementById("dateSentStr").value = dateSentStr;
    document.getElementById("subject").value = subject;
    alert("hidden inputs set.");

    verticalBar = "|";
    resultString = resultString + ("from line = " + verticalBar + fromLine + verticalBar + "<br>");
    resultString = resultString + ("<br>");
    verticalBar = "";
    resultString = resultString + ("from name = " + verticalBar + fromName + verticalBar +  "<br>");
    resultString = resultString + ("email address = " + verticalBar + fromEmailAddr + verticalBar + "<br>");
    resultString = resultString + ("date sent = " + verticalBar + dateSentStr + verticalBar + "<br>");
    resultString = resultString + ("subject = " + verticalBar + subject + verticalBar + "<br>");
    return resultString;
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
                    <div style="background-color:#333333;text-align:center;float:none;">

<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $phpEchoAnalysis = true;
  $debugInit = -1;

  date_default_timezone_set('America/Denver');

  function dispDate($timeStr) {
    echo $timeStr . ' >> ' . getDbDateString($timeStr) . "<br>\r\n";
  }

  function getDbDateString($timeStr) {
    //echo $timeStr . ' >> ' . strtotime($timeStr)  . ' >> ' . date('Y-m-d H:i:s', strtotime($timeStr)) . "<br>\r\n";
    $timeStamp = strtotime($timeStr);
    if ($timeStamp === false) $dateDisp = "Error in date format.";
    else $dateDisp = date('Y-m-d H:i:s', $timeStamp);
    return $dateDisp;
  }
  
//  echo phpinfo();

  $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('050. editorState', $editorState, $debugInit);

  $editorState['orientationSelector'] = 'works';

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


?>

<!-- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM -->
<form name='emailAnalysisForm' id='emailAnalysisForm' action='adminPermissions.php' method='post'>
<?php
  echo '<input type="hidden" id="headerString" name="headerString" value="' . ((isset($_POST["headerString"])) ? $_POST["headerString"] : "") . '">';
  echo '<input type="hidden" id="fromLine" name="fromLine" value="' . ((isset($_POST["fromLine"])) ? $_POST["fromLine"] : "") . '">';
  echo '<input type="hidden" id="fromName" name="fromName" value="' . ((isset($_POST["fromName"])) ? $_POST["fromName"] : "") . '">';
  echo '<input type="hidden" id="fromEmailAddr" name="fromEmailAddr" value="' . ((isset($_POST["fromEmailAddr"])) ? $_POST["fromEmailAddr"] : "") . '">';
  echo '<input type="hidden" id="dateSentStr" name="dateSentStr" value="' . ((isset($_POST["dateSentStr"])) ? $_POST["dateSentStr"] : "") . '">';
  echo '<input type="hidden" id="subject" name="subject" value="' . ((isset($_POST["subject"])) ? $_POST["subject"] : "") . '">';
?>

  <div style="margin:20px 20px 40px 20px;border:yellow dashed 0;">
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
      <div class="smallTitleTextOnBlack" style="margin:18px 0 4px 0;font-size:18px;">Paste an email header into the text box below and press tab.</div>
      <textarea id="emailHeaderArea" name="emailHeaderArea" rows="8" cols="80" onblur="javascript:justBlurredHeaderIn(this);"><?php
         echo ((isset($_POST["emailHeaderArea"])) ? $_POST["emailHeaderArea"] : "Paste mail header here.") . "</textarea>\r\n"; ?>
      <div style="padding-top:10px;border:green solid 0;">
        <div class="smallTitleTextOnBlack" style="margin:12px 0 8px 0;font-size:18px;">After you press tab, results will appear here and you can edit them.</div>
        <div id="echoArea" style="border:purple solid 0;"></div>
    </div>
    
<?php
// Email Header ANALYSIS
    $justBlurred = (isset($_POST['justBlurredHeader']) && $_POST['justBlurredHeader'] == 1);
    if ($justBlurred) {
      if (isset($_POST['headerString']) && $_POST['headerString'] != '') {
        $editorState['parsedPersonId'] = 0;
        $editorState['parsedPersonName'] = '';
        $eidtorState['parsedEmailAddr'] = '';
        $editorState['workSelector'] = 0;
        $editorState['personSelector'] = 0;
        $worksOfPossibleInterest = array();
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
  //          $query = 'SELECT workId, title FROM works WHERE submitter = ' . $editorState['parsedPersonId'] . ' and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
            if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
            SSFQuery::debugNextQuery();
            $query = 'SELECT workId, title, '
                   . 'permissionRequestId, permissionType, grantedOrDenied, event, season, '
                   . 'requestComm, dateGenerated, responseFrom, dateResponseReceived, responseQuote, notes '
                   . 'FROM works JOIN permissionRequest on workId = work '
                   . 'WHERE submitter = ' . $editorState['parsedPersonId'] . ' and permissionType = "DemoReelClip" ' // TODO generalize this beyond DemoReelClip
                   . 'and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
            $worksOfPossibleInterest = SSFDB::getDB()->getArrayFromQuery($query);
            SSFDebug::globalDebugger()->belch("worksOfPossibleInterest", $worksOfPossibleInterest, 1);
            SSFDebug::globalDebugger()->belch("count(worksOfPossibleInterest)", count($worksOfPossibleInterest), 1);
            $editorState['workSelector'] = (count($worksOfPossibleInterest == 1)) ? $worksOfPossibleInterest[0]['workId'] : 0;
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
          SSFDebug::globalDebugger()->belch("Works of possible interest", $worksOfPossibleInterest, 1);
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
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'>Call for:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
                <?php HTMLGen::displayCallForEntriesSelector('emailAnalysisForm',
                         'getUniqueElement("personSelector").value=0;'
                       . 'getUniqueElement("workSelector").value=0;'); 
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
<!-- Person Selector -->
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'>Respondent: </div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php //SSFDB::debugNextQuery(); 
                      $personToBe = HTMLGen::displayPersonSelector('emailAnalysisForm', $editorState);
                      $editorState['personSelector'] = $personToBe;
                ?>
              </div>
            </div>
          </div>
          <div style="clear:both;"></div>
<!-- Work Selector -->
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'>Work:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
                <?php if ($justBlurred) $editorState['workSelector'] = 0; // Compute this over again, regardless of it's previous value.
                      $editorState['workSelector'] = HTMLGen::displayWorkSelector('emailAnalysisForm', $editorState['personSelector'], $editorState, '-- select a work --'); 
                      //if ($unique) echo "<script type='text/javascript'>document.emailAnalysisForm.submit();></script>";
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
<!-- End Filters ------------------------------------------------------------- -->

<!-- TODO
  Informational Outputs: date request sent, commId of request
  Inputs: Date, Granted/Denied/Unknown, Quote, Notes
  
  Submit
-->
      </div>
    </div>

  <!-- This junk is copied from adminDataEntry.php. Some of it is actually needed here. -->
  <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<?php echo $editorState['adminSelector']?>">
  <input type="hidden" id="orientationSelector" name="orientationSelector" value="<?php echo $editorState['orientationSelector']?>"> 
  <input type="hidden" id="priorCallForEntriesSelection" name="priorCallForEntriesSelection" value="<?php echo $editorState['callForEntriesId']?>">
  <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $editorState['personSelector']?>">
  <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $editorState['workSelector']?>">
  <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo $editorState['personSelector']; ?>"> 
  <input type="hidden" id="parsedPersonId" name="parsedPersonId" value="<?php echo (isset($editorState['parsedPersonId']) ? $editorState['parsedPersonId'] : 0); ?>">
  <input type="hidden" id="parsedPersonName" name="parsedPersonName" value="<?php echo (isset($editorState['parsedPersonName']) ? $editorState['parsedPersonName'] : ''); ?>">
  <input type="hidden" id="parsedEmailAddr" name="parsedEmailAddr" value="<?php echo (isset($editorState['parsedEmailAddr']) ? $editorState['parsedEmailAddr'] : ''); ?>">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
  <input type="hidden" id="justBlurredHeader" name="justBlurredHeader" value=0>
  <!-- orientationSelector maintained for compatibility with HTMLGen::displayPersonSelector() -->
  <!-- editingPerson maintained for compatibility with HTMLGen::displayPersonSelector(). Sync with personSelector input. -->
  <!-- selectorSubmitter is support for HTMLGen passing the name of the selector that initiated a Submit onchange. TODO See note in _SansSouciTODOs.txt -->
  <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> 

<!--
  <input type="hidden" id="people_personId" name="people_personId" value="<?php echo (isset($editorState['people_personId']) ? $editorState['people_personId'] : 0);?>">
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value="">  support for HTMLGen passing the name of the selector that initiated a Submit onchange. 
  <input type="hidden" id="editingPerson" name="editingPersonId" value="<?php echo (isset($databaseState['personId']) ? $databaseState['personId'] : 0); ?>">
  <input type="hidden" id="editingWork" name="editingWorkId" value="<?php echo (isset($databaseState['workId']) ? $databaseState['workId'] : 0);?>">
-->

</form>

<?php SSFDebug::globalDebugger()->belch('999. editorState', $editorState, $debugInit); ?>


<!-- date analysis exercise -->
<!--
<div style="margin:20px 20px 40px 20px;">
<h2>Date analysis exercise:</h2>
<php
  dispDate('August 4, 2010 9:34:52 AM MDT');
  dispDate('Mon 8/02/10 3:11 PM');
  dispDate('Mon 8/02/10 9:16 AM');
  dispDate('August 2, 2010 4:06:26 PM MDT');
  dispDate('Aug 2, 2010 4:06:26 PM PDT');
  dispDate('Friday, Aug. 13');
  dispDate('August 2, 2010');
  dispDate('6/12/80');
  dispDate('2008-08-01');
  dispDate('6/12/80');
  dispDate('12:20:53');
  dispDate('28 jul 10 21:13');
  dispDate('August 3, 2010 7:32:09 PM UTC-6');
  dispDate('August 3, 2010 7:32:09 PM UTC-6Test messageReplyForward');
>
</div>
-->

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