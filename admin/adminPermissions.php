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

  <!-- jquery datepicker stuff -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!--    <link rel="stylesheet" href="/resources/demos/style.css" /> -->

  	<style>
      /* from 	<link rel="stylesheet" href="../demos.css"> */
      body { font-size: 100%; font-family: "Times", "Trebuchet MS", "Arial", "Helvetica", "Verdana", "sans-serif"; }
      .ui-widget { font-size: 62.5%; }
      .ui-draggable, .ui-droppable { background-position: top; }
    </style>
    
    <script>
      $(function() {
        $( "#responseDateSent" ).datepicker({
          altField: "#responseDateSentForDB",
          altFormat: "yy-mm-dd",
          dateFormat: "mm/dd/yy"
        });
      });    
      
      // Make datepicker respond to a click event
      // http://forum.jquery.com/topic/datepicker-keep-tab-order-after-a-datepicker-field & http://jsfiddle.net/nickadeemus2002/SxsxS/
      $(document).ready(function(){
        $('#responseDateSent').datepicker({
          onSelect: function(dateText, inst) {
            $(this).focus();
          }    
        });    
      });
    </script>

  <script type="text/javascript">
    String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); };
  
    String.prototype.getEmailAddressFromAngleBrackets = function() {
      var pattern=new RegExp("<.*(?=>)"); // Get everything from < through >
      var searchResults = pattern.exec(this);
      var returnValue = "";
      if (searchResults !== null) { returnValue = searchResults[0].replace(/^<+|\>$/g,""); } // Strip < and >
      return returnValue;
    };
  
    String.prototype.getEmailAddressFromLine = function() { 
      var pattern=new RegExp(/^.*$/i); // Get everything from From: through EOL
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
  
    function submitForm() {
      document.getElementById("adminPermissionsForm").submit()
    }

    function getEmailFromAddr(widget) {
      var fromEmailAddr = '';
      fromEmailAddr = widget.value.getEmailAddress();
      document.getElementById("fromEmailAddr").value = fromEmailAddr;
      document.getElementById('justBlurredEmailFromWidget').value = 1;
      submitForm();
      return fromEmailAddr;
    }
    
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">

<!-- TODO: Still needs work:
           - tab order
             - http://forum.jquery.com/topic/datepicker-keep-tab-order-after-a-datepicker-field 
          - make the datepicker widget appear when it is the default focus item on page load or reset
          - make the appropriate permission request selection when the Respoondent or Work dropdowns are used to make a new selection.
-->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  
  // PHP constants
  
  $phpEchoAnalysis = false; // used 7/13/12
  $debugInit = -1;
  date_default_timezone_set('America/Denver');

  // PHP functions
  
  function addDateWidgetRow($desc, $idName, $initValue, $initValueForDB, $onBlurText, $disable) {
    $maxLength = 200;
    echo "<!-- addDateWidgetRow: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    $genId = $idName;
    $titleMarkupClass = 'rowTitleText'; // rowTitleTextNarrow, rowTitleTextWide, rowTitleText
    $descAnteChar = ($desc == '') ? "" : ":";
    echo "      <div class='formRowContainer' style='margin-top:4px;'>\r\n";
    echo "        <div class='" . $titleMarkupClass . "'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer'>\r\n";
    echo "          <div>\r\n";
    echo "            <input type='text' tabindex='1' id='" . $genId . "' name='" . $idName . "'";
    $fieldLengthLimit = 1024;
    if ($maxLength <= 10) $cssFieldDescriptor = "entryFormInputFieldShort";
    else $cssFieldDescriptor = (($maxLength > $fieldLengthLimit) ? "entryFormInputFieldWide" : "entryFormInputField");
    echo " class='" . $cssFieldDescriptor . "'";
    $singleQuoteSensitiveLine1 = ' value="' . str_replace('"', "", $initValue) . '" maxlength=' . $maxLength . (($disable) ? " disabled" : "");
    echo $singleQuoteSensitiveLine1;
    echo " onchange='javascript:userMadeAChange(0);'";
    if (isset($onBlurText) && ($onBlurText != '')) { echo " onblur='" . $onBlurText . "'"; }
    echo ">&nbsp;\r\n";
    $singleQuoteSensitiveLine2 = ' value="' . str_replace('"', "", $initValueForDB) . '" (($disable) ? " disabled" : "")';
    echo "            <input type='hidden' id='responseDateSentForDB' name='responseDateSentForDB' " . $singleQuoteSensitiveLine2 . ">\r\n";
    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    return $genId;
    echo "<!-- END addDateWidgetRow -->\r\n";
  }

  function addTextWidgetRow($desc, $idName, $initValue, $onBlurText, $disable=false) {
    $maxLength = 200;
    echo "<!-- addTextWidgetRow: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
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
    echo "            <input type='" . $inputType . "tabindex='2' ' id='" . $genId . "' name='" . $idName . "'";
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
    echo "<!-- END addTextWidgetRow -->\r\n";
  }

  function displayDate($timeStr) {
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
/* Replaced this with the clauses below on 11/14/14.
           . 'FROM works JOIN communicationWork ON workId = work '
           . 'JOIN communications ON communicationId = communication '
           . 'JOIN permissionRequest on requestComm = communication AND permissionRequest.work = workId '
           . 'WHERE withdrawn=0 AND submitter = ' . $personId . ' and permissionType = "DemoReelClip" ' // TODO generalize this beyond DemoReelClip
           . 'and callForEntries="' . SSFRunTimeValues::getCallForEntriesId() . '"';
*/
           . 'FROM works '
           . 'JOIN permissionRequest ON workId = work '
           . 'LEFT JOIN communications on requestComm = communicationId '
           . 'WHERE withdrawn=0 AND submitter = ' . $personId;

    SSFDebug::globalDebugger()->becho("getPermissionRequestFromDB query", $query, -1);
//    SSFDB::DebugNextQuery();
    $worksOfPossibleInterest = SSFDB::getDB()->getArrayFromQuery($query);
    SSFDebug::globalDebugger()->belch("worksOfPossibleInterest", $worksOfPossibleInterest, -1); // used 7/13/12
    SSFDebug::globalDebugger()->belch("count(worksOfPossibleInterest)", count($worksOfPossibleInterest), -1);
    return $worksOfPossibleInterest;
  }

?>

<!-- BEGIN BODY TABLE ---- BEGIN BODY TABLE ---- BEGIN BODY TABLE ---- BEGIN BODY TABLE ---- BEGIN BODY TABLE ---- BEGIN BODY TABLE ---- BEGIN BODY TABLE -->
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

<!-- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM -->
<div id="formEnclosingDiv" style="margin-top:10px;">
<?php
  $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('050. editorState', $editorState, -1); // 7/13/12 Major debug message

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
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'work')] = $editorState['workSelector'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'grantedOrDenied')] = $editorState['permissionRequest_grantedOrDenied'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'responseFrom')] = $editorState['personSelector'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'dateResponseReceived')] = $editorState['responseDateSentForDB'] . ' 12:00:00'; // responseDateSentStrWidget 7/13/12
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'responseQuote')] = $editorState['responseQuote'];
      $newValuesArray[DatumProperties::getItemKeyFor('permissionRequest', 'notes')] = $editorState['notes'];
      SSFDebug::globalDebugger()->belch('adminPermissions $newValuesArray CCC', $newValuesArray, -1); // used 7/13/12 - Secondary debug message
      $query = 'SELECT permissionRequestId, work, permissionType, grantedOrDenied, event, season, '
             . 'requestComm, dateSent, responseFrom, dateResponseReceived, responseQuote, permissionRequest.notes '
             . 'FROM permissionRequest JOIN communications on communicationId = requestComm '
             . 'WHERE permissionRequestId = "' . $permissionRequestOfInterestId . '"';
      $currentValuesArray = SSFDB::getDB()->getArrayFromQuery($query);
// TODO: With the 11/14/14 change in the query, multiple rows may be returned.
//       The intention is to enumerate each row with a checkbox to allow the user to apply updates to that item.
      if (true || count($currentValuesArray) == 1) { // 11/14/14 So this condition is shortcutted by adding true ||
        SSFDebug::globalDebugger()->belch('adminPermissions currentValuesArray CCC', $currentValuesArray, -1); // used 7/13/12
        SSFQuery::debugNextQuery();
        $changeCount = SSFQuery::updateDBFor('permissionRequest', $currentValuesArray[0], $newValuesArray, 'permissionRequestId', $permissionRequestOfInterestId);
        SSFDebug::globalDebugger()->becho('permissionRequest changeCount', $changeCount, -1);  // used 7/13/12
      } else {
        SSFDebug::globalDebugger()->becho('INTERNAL ERROR. Tell David. permissionRequestId', $permissionRequestId . ' is either not in DB or there are more than one.', 1);
      }
    }
  }
?>
<form name='adminPermissionsForm' id='adminPermissionsForm' action='adminPermissions.php' method='post'>
  <div style="margin:20px 20px 40px 20px;border:yellow dashed 0;">

<!-- Begin Filters -------------------------------------------------------- -->
<?php 
  HTMLGen::displayAdministratorSelector("padding-left:30px;padding-bottom04px;border:red solid 0;", "rowTitleTextNarrow", 
                                            "document.adminPermissionsForm.submit();", "adminPermissions"); 
  echo "<script type='text/javascript'>document.getElementById('adminSelector').tabIndex=1;</script>\r\n";
?>
<!-- Call for Entries Selector -->
          <!-- TODO: CallFor always snaps back to the default. Fix this. -->
          <div class='formRowContainer'>
            <div class='rowTitleText'>Call for:</div>
            <div class='entryFormFieldContainer'>
              <div style='float:left;'>
                <?php HTMLGen::displayCallForEntriesSelector('adminPermissionsForm',
                         'getUniqueElement("personSelector").value=0; getUniqueElement("workSelector").value=0;'); 
                      echo "<script type='text/javascript'>document.getElementById('callForEntriesId').tabIndex=2;</script>\r\n";
                ?>
              </div>
            </div>
          <div style='clear:both;'></div>
          </div>
    <div style="text-align:left;">
      <div class="bodyTextOnBlack" style="margin:18px 0 8px 0;font-size:18px;">Paste email Date and Sender into the text boxes below and press tab.</div>
<?php
  echo "<!-- Email Date text field -->\r\n";
  $id = addDateWidgetRow('Email Date', 'responseDateSent', (isset($editorState["responseDateSent"]) ? $editorState["responseDateSent"] : ""), 
                                                           (isset($_POST["responseDateSentForDB"]) ? $_POST["responseDateSentForDB"] : ""), '' , '');
  echo "<script type='text/javascript'>document.getElementById('" . $id . "').tabIndex=3;</script>\r\n";
  echo "<!-- Email From text field -->\r\n";
  $id = addTextWidgetRow('Email Sender', 'emailSender', ((isset($_POST["emailSender"])) ? $_POST["emailSender"] : ""), 'javascript:getEmailFromAddr(this);', $disable=false);
  echo "<script type='text/javascript'>document.getElementById('" . $id . "').tabIndex=4;</script>\r\n";
  $justBlurred = (isset($_POST['justBlurredEmailFromWidget']) && $_POST['justBlurredEmailFromWidget'] == 1);
  $refocusWidget = ($justBlurred) ? 'personSelector' : 'responseDateSent';
?>
      <div style="padding-top:10px;border:green solid 0;">
        <div class="bodyTextOnBlack" style="margin:12px 0 8px 0;font-size:18px;">After you press tab, results will appear here and you can edit them.</div>
        <div id="echoArea" style="border:purple solid 0;"></div>
    </div>

<?php
    // Map fromEmailAddr => $editorState data
    $worksOfPossibleInterest = array();
    if (!isset($editorState['personId'])) $editorState['personId'] = 0;
    if (!isset($editorState['personSelector'])) $editorState['personSelector'] = 0;
    if (!isset($editorState['workSelector'])) $editorState['workSelector'] = 0;
    if ($justBlurred) {
      if (isset($editorState['fromEmailAddr']) && $editorState['fromEmailAddr'] != '') {
        if ($phpEchoAnalysis) SSFQuery::debugNextQuery();
        $query = 'SELECT personId, name, email FROM people WHERE email="' . $editorState['fromEmailAddr'] . '"';
        $result = SSFDB::getDB()->getArrayFromQuery($query);
        if (!isset($result) || count($result) != 1) { 
          SSFDebug::globalDebugger()->becho("Sender email address is not uniquely identified in DB", $editorState['fromEmailAddr'], 1);
          SSFDebug::globalDebugger()->belch("result", $result, -1);
        } else {
          $personId = $result[0]['personId'];
          $editorState['personId'] = $personId;
          $editorState['personSelector'] = $personId;
          $worksOfPossibleInterest = getPermissionRequestFromDB($editorState['personId']);
          SSFDebug::globalDebugger()->belch("Works of possible interest", $worksOfPossibleInterest, -1);
          $editorState['workSelector'] = (count($worksOfPossibleInterest) == 1) ? $worksOfPossibleInterest[0]['workId'] : 0;
        }
      }
    }
?>

<!-- Continue Filters -------------------------------------------------------- -->
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
  // TODO: Selection of a work (even indirectly via selection of a person, should trigger a reload and DBQuery to find any permission request for the
  //       selected work and report it (instead of reporting: Prmssn Request: NONE)
  SSFDebug::globalDebugger()->belch('editorState', $editorState, -1);
  $editorState['workSelector'] = HTMLGen::displayWorkSelector('adminPermissionsForm', $editorState['personSelector'], $editorState, '-- select a work --'); 
?>
              </div>
            </div>
            <div style='clear:both;'></div>
          </div>
          
<!-- End Filters ------------------------------------------------------------- -->
<?php
  if (true || !$justBlurred) $worksOfPossibleInterest = getPermissionRequestFromDB($editorState['personId']);
  SSFDebug::globalDebugger()->belch('worksOfPossibleInterest', $worksOfPossibleInterest, -1);  // turned off this belch 7/30/14
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
//  if ($thereIsAWorkOfInterest && isset($workOfInterest) && (!isset($editorState['workId']) || $editorState['workId'] != $workOfInterest))
//    echo "<script type='text/javascript'>submitForm();</script>\r\n";
?>
          <div class='formRowContainer'>
            <div class='rowTitleText'>Prmssn Request:</div>
            <div class='entryFormFieldContainer'>
              <div class='datumValue' style="width:456px;"><?php 
                  // TODO Make this work when a person or work is explicity selected from a dropdown menu.
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
  HTMLGen::addRadioButtonWidgetRow('Status', 'permissionRequest', 'grantedOrDenied', $workOfInterest["grantedOrDenied"], 4); 
  HTMLGen::addTextAreaRowWithWidth('responseQuote', 'Relevant quote from response', $workOfInterest["responseQuote"], 80, 2, "", $disable=false);
  echo "<div style='margin-top:2px;'></div>";
  HTMLGen::addTextAreaRowWithWidth('notes', 'Notes', $workOfInterest["notes"], 80, 2, "", $disable=false);
  $submitEnabled = (($editorState['personSelector'] != 0) && ($editorState['workSelector'] != 0) 
                                                          && (isset($editorState['responseDateSentForDB']))
                                                          && ($editorState['responseDateSentForDB'] != ''));
?>
          <div style="padding-top:6px;padding-left:116px;">
            <input type="submit" id="submitChanges" name="submitChanges" value="Submit Changes" <?php echo (($submitEnabled) ? '' : ' disabled="disabled"'); ?>>
          </div>
          <div style="clear: both;"></div>
        </div>
      </div>

<!-- Hidden Inputs -------------------------------------------------------- -->
  <input type="hidden" id="personId" name="personId" value="<?php echo (isset($editorState['personId']) ? $editorState['personId'] : 0); ?>">
  <input type="hidden" id="fromEmailAddr" name="fromEmailAddr" value="<?php echo (isset($editorState['fromEmailAddr']) ? $editorState['fromEmailAddr'] : ''); ?>"> 
  <input type="hidden" id="justBlurredEmailFromWidget" name="justBlurredEmailFromWidget" value=0>
  <input type="hidden" id="permissionRequestOfInterestId" name="permissionRequestOfInterestId" value=<?php echo $permissionRequestOfInterestId; ?> >

  <!-- The junk below is copied from adminDataEntry.php. Most of it is actually needed here. -->
  <input type="hidden" id="changeCount" name="changeCount" value="<?php echo isset($editorState['changeCount']) ? $editorState['changeCount'] : 0; ?>">
  <input type="hidden" id="personChangeCount" name="personChangeCount" value="<?php echo isset($editorState['personChangeCount']) ? $editorState['personChangeCount'] : 0; ?>">
  <input type="hidden" id="entryChangeCount" name="entryChangeCount" value="<?php echo isset($editorState['entryChangeCount']) ? $editorState['entryChangeCount'] : 0; ?>">
  <input type="hidden" id="loginUserId" name="loginUserId" value=0>
  
  <!-- orientationSelector and editingPerson are maintained for compatibility with HTMLGen::displayPersonSelector() -->
  <input type="hidden" id="orientationSelector" name="orientationSelector" value="<?php echo $editorState['orientationSelector']?>"> 
  <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo $editorState['personSelector']; ?>"> 
  <!-- selectorSubmitter is support for HTMLGen passing the name of the selector that initiated a Submit onchange. TODO: See note in _SansSouciTODOs.txt -->
  <input type="hidden" id="selectorSubmitter" name="selectorSubmitter" value=""> 
<?php 
  echo "<script type='text/javascript'>document.getElementById('" . $refocusWidget . "').focus();</script>\r\n"; 
  // TODO: The next line does not make the datepicker widget appear. Figure out how to do that.
  if ($refocusWidget == 'responseDateSent') echo "<script type='text/javascript'>document.getElementById('responseDateSent').select();</script>\r\n";
//  echo "<script type='text/javascript'>document.getElementById('justBlurredEmailFromWidget').value=0;</script>\r\n";
 ?>

</form>

<?php // displayDate("August 13, 2010 9:33:42 PM MDT"); ?>

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