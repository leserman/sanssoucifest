<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Paypal Payment Receipt</title>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>

<!-- TODO: Set global variables: jsEchoAnalysis, $phpEchoAnalysis, $debugInit -->

<script type="text/javascript">

  var jsEchoAnalysis = false;
  
  // Note that echoAreaDivString and echoAreaCloseDivString are equivalently defined in the php section below.
  var echoAreaDivString = '<div class="datumDescription" style="margin:10px 20px;color:#FFFFCC;line-height:134%">';
  var echoAreaCloseDivString = '<\/div>'; 

//  String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); };

  // What a hack! Titles were given in "s and/or 's which need to be trimmed.
  String.prototype.trim = function() { trimQuotes = this.replace(/^"{1}|"{1}$|^'{1}|'{1}$/g,""); return trimQuotes.replace(/^\s+|\s+$/g,""); }; 

  function composedResultString(pmtDate, transId, pmtAmt1, pmtAmt2, buyerName1, buyerName2, buyerEmail1, buyerEmail2, filmTitle, submitterEmail) {
    var verticalBar = "|";
    verticalBar = "";
    var resultString = '';
    resultString = resultString + ("filmTitle = " + verticalBar + filmTitle + verticalBar + "<br>");
    resultString = resultString + ("pmtDate = " + verticalBar + pmtDate + verticalBar + "<br>");
    resultString = resultString + ("transId = " + verticalBar + transId + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt1 = " + verticalBar + pmtAmt1 + verticalBar + "<br>");
    resultString = resultString + ("pmtAmt2 = " + verticalBar + pmtAmt2 + verticalBar + "<br>");
    resultString = resultString + ("buyerName1 = " + verticalBar + buyerName1 + verticalBar + "<br>");
    resultString = resultString + ("buyerName2 = " + verticalBar + buyerName2 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail1 = " + verticalBar + buyerEmail1 + verticalBar + "<br>");
    resultString = resultString + ("buyerEmail2 = " + verticalBar + buyerEmail2 + verticalBar + "<br>");
    resultString = resultString + ("submitterEmail = " + verticalBar + submitterEmail + verticalBar);
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

//    document.getElementById("pasteAreaString").value = pasteAreaString;
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
    resultString = composedResultString(pmtDate, transId, pmtAmt1, pmtAmt2, buyerName1, buyerName2, buyerEmail1, buyerEmail2, filmTitle, submitterEmail);
    return resultString;
  }

  function justBlurredPasteArea(textArea) {
    document.getElementById("echoArea").innerHTML = echoAreaDivString 
                                                  + parsePasteAreaString(textArea.value) + echoAreaCloseDivString;
    document.getElementById('justBlurredPasteAreaFlag').value = 1;
    document.getElementById('emailAnalysisForm').submit();
    return 1;
  }

</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  // Note that $echoAreaDivString and $echoAreaCloseDivString are equivalently defined in javascript above.
  $echoAreaDivString = '<div class="datumDescription" style="margin:10px 20px;color:#FFFFCC;line-height:134%">';
  $echoAreaCloseDivString = '<\/div>'; 
  
  function errorBelch($title, $array) {
    global $echoAreaDivString, $echoAreaCloseDivString;
    $innerHTMLaddOn = $echoAreaDivString;
    $innerHTMLaddOn .= SSFDebug::globalDebugger()->prettyBelch($title, $array, 1);
    $innerHTMLaddOn .= $echoAreaCloseDivString;
    echo '<script type="text/javascript">' . "\r\n";
    echo 'document.getElementById("echoArea").innerHTML = document.getElementById("echoArea").innerHTML + \'' . $innerHTMLaddOn . '\';' . "\r\n";
    echo '</script>' . "\r\n";

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
                      <div><div class="programPageTitleText" style="padding-top:8px; padding-left:8px;text-align:left;">Enter 
                        Paypal Payment Receipt</div><div style="clear:both;"></div>

<?php
  $userPasteInstruction = "Paste email body here.";

  $phpEchoAnalysis = false;
  $debugInit = -1;
 
  $editorState = $_POST;
  SSFDebug::globalDebugger()->belch('050. editorState', $editorState, $debugInit);

  // We no longer use $editorState['adminSelector'], but in it's place, we call SSFQuery::useAdministratorAsCreatorModifier(). 6/11/11
  SSFQuery::useAdministratorAsCreatorModifier();

  // Find a DB record
  $paypalDebug = -1;
  $currentCallForEntries = SSFRunTimeValues::getInitialCallForEntriesId();
  $paypalValuesArray = array();
  $uniqueWorkFound = false;
  $userSelectedAWork = false;
  $multipleWorksMatch = false;
  $paymentAlreadyApplied = false;
  $justApplied = false;
  $updateCount = 0;
  $warningsString = '';
  if (isset($editorState["filmTitle"]) && $editorState["filmTitle"] != "") {
//    $editorStateFilmTitle = str_replace(array('\'', '"', ',', ';'), '', $editorState["filmTitle"]); // strip some special characters
    $editorStateFilmTitle = $editorState["filmTitle"];                                                // NO, never mind.
    // Hack Alert: The query uses 'like' rather than '=' for title so that it will work when a title has an embedded "'" (single quote) or other special char.
    $query = 'SELECT workId, title, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, '
           .        'submitter, email, loginName, nickName, lastName, name '
           . 'FROM works JOIN people on submitter = personId '
           . 'WHERE withdrawn=0 AND title like "%' . addslashes(trim($editorStateFilmTitle,'"')) . '%" '
           . 'AND (email = "' . $editorState["buyerEmail1"] . '" '
           .   'OR email = "' . $editorState["buyerEmail2"] . '" '
           .   'OR email = "' . $editorState["submitterEmail"] . '" '
           .   'OR loginName = "' . $editorState["buyerEmail1"] . '" '
           .   'OR loginName = "' . $editorState["buyerEmail2"] . '" '
           .   'OR loginName = "' . $editorState["submitterEmail"] . '")';
    SSFDebug::globalDebugger()->becho('108 editorState["filmTitle"]', $editorState["filmTitle"], $paypalDebug);
    SSFDebug::globalDebugger()->becho('109 trim(editorState["filmTitle"],\'"\'', trim($editorState["filmTitle"],'"'), $paypalDebug);
    SSFDebug::globalDebugger()->becho('110 editorState["buyerEmail1"]', $editorState["buyerEmail1"], $paypalDebug);
//    SSFDB::debugNextQuery();
    $paypalValuesArray = SSFDB::getDB()->getArrayFromQuery($query);
    SSFDebug::globalDebugger()->belch('111. paypalValuesArray', $paypalValuesArray, $paypalDebug);
    if (isset($editorState['applyPayment']) && ($editorState['applyPayment'] == 'Apply payment to the selected work.')
                                            && (isset($editorState['workSelector']) && $editorState['workSelector'] != 0)) {
      $userSelectedAWork = true;
      SSFDebug::globalDebugger()->becho('$userSelectedAWork', $userSelectedAWork, $paypalDebug);
      $workId = $editorState['workSelector'];
      $query2 = 'SELECT workId, title, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, '
           .        'submitter, email, loginName, nickName, lastName, name '
           . 'FROM works JOIN people on submitter = personId '
           . 'WHERE workId = ' . $workId . ' ';
      $currentValuesArray = SSFDB::getDB()->getArrayFromQuery($query2);
      $paypalAmtPaid =  $currentValuesArray[0]['amtPaid'];
      $paypalHowPaid =  $currentValuesArray[0]['howPaid'];
      $paypalDatePaid = $currentValuesArray[0]['datePaid'];
      $paypalNumber =   $currentValuesArray[0]['checkOrPaypalNumber'];
    } else {
      $uniqueWorkFound = (count($paypalValuesArray) == 1);
      $multipleWorksMatch = (count($paypalValuesArray) > 1);
      if ($uniqueWorkFound) {
        $workId = $paypalValuesArray[0]['workId'];
        $paypalAmtPaid = $paypalValuesArray[0]['amtPaid'];
        $paypalHowPaid = $paypalValuesArray[0]['howPaid']; 
        $paypalDatePaid = $paypalValuesArray[0]['datePaid']; 
        $paypalNumber = $paypalValuesArray[0]['checkOrPaypalNumber'];
      }
    }
    $tmpPmtDate = new DateTime($editorState['pmtDate']);
    $fmtPmtDate = date_format($tmpPmtDate, 'Y-m-d');
    SSFDebug::globalDebugger()->becho('112. fmtPmtDate', $fmtPmtDate, $paypalDebug);
    $editorState['pmtDate'] = $fmtPmtDate;
  }
    
  if ($uniqueWorkFound || $userSelectedAWork) { // Generate & display warnings.
    $paymentAlreadyApplied = (($editorState['pmtAmt1'] == $paypalAmtPaid) && ($editorState['pmtAmt2'] == $paypalAmtPaid) 
                           && ($paypalHowPaid == 'paypal') && ($editorState['pmtDate'] == $paypalDatePaid)
                           && ($editorState['transId'] == $paypalNumber));
    
    SSFDebug::globalDebugger()->becho('114. paypalAmtPaid', $paypalAmtPaid, -1);
    SSFDebug::globalDebugger()->becho('114. $paymentAlreadyApplied', $paymentAlreadyApplied, -1);

    if (!$paymentAlreadyApplied) {
      if (($editorState['pmtAmt1'] != $paypalAmtPaid) || ($editorState['pmtAmt2'] != $paypalAmtPaid)) {
        if ($editorState['pmtAmt1'] != $editorState['pmtAmt2']) { $warningsString .= '* Parsed amounts from Paypal email do not match. '; }
        else { $warningsString .= "* Amount Paid does not match. "; }
        $warningsString .= 'If you apply this payment, the pmtAmt1 above will replace the existing payment amount of $' . $paypalAmtPaid . '.<br>';
      }
      if ($paypalHowPaid != 'paypal') {
        $warningsString .= '* Payment method does not match. If you apply this payment, "paypal" will replace the current payment method, "' . $paypalHowPaid . '."<br>';
      }
      if ((($paypalDatePaid != '') && ($paypalDatePaid != '0000-00-00')) && ($editorState['pmtDate'] != $paypalDatePaid)) {
        $warningsString .= '* Date paid does not match. If you apply this payment, the pmtDate above will replace the existing payment date, ' . $paypalDatePaid . '.<br>';
      }
      if (($paypalNumber != '') && ($editorState['transId'] != $paypalNumber)) {
        $warningsString .= '* If you apply this payment, the transId above will replace the existing transaction id number, ' . $paypalNumber . '.<br>';
      }

      SSFDebug::globalDebugger()->belch('aaa. warningsString', $warningsString, -1);

      // Apply the payment to the work if appropriate
      if (isset($editorState['applyPayment']) && (($editorState['applyPayment'] == 'Apply Payment to Work') || ($editorState['applyPayment'] == 'Apply payment to the selected work.'))) {
        $editorState[DatumProperties::getItemKeyFor('works', 'datePaid')] = $editorState['pmtDate'];
        $editorState[DatumProperties::getItemKeyFor('works', 'amtPaid')] = $editorState['pmtAmt1'];
        $editorState[DatumProperties::getItemKeyFor('works', 'howPaid')] = 'paypal';
        $editorState[DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber')] = $editorState['transId'];
        SSFDebug::globalDebugger()->belch('115. $editorState', $editorState, $paypalDebug);
        if (isset($paypalValuesArray[0])) SSFDebug::globalDebugger()->belch('115. $paypalValuesArray[0]', $paypalValuesArray[0], $paypalDebug);
        if (isset($currentValuesArray[0])) SSFDebug::globalDebugger()->belch('115. $currentValuesArray[0]', $currentValuesArray[0], $paypalDebug);
//        SSFDB::debugOn();
        if ($uniqueWorkFound) {
          $updateCount = SSFQuery::updateDBFor('works', $paypalValuesArray[0], $editorState, 'workId', $workId);
          // TODO: Also update or insert into paypalReceipts table
        } else if ($userSelectedAWork) {
          $updateCount = SSFQuery::updateDBFor('works', $currentValuesArray[0], $editorState, 'workId', $workId);
          // TODO: Also update or insert into paypalReceipts table
        }
      }
      SSFDB::debugOff();
      if ($updateCount >= 1) {
        $justApplied = true;
        $warningsString = '';
      }
      SSFDebug::globalDebugger()->becho('115. updateCount', $updateCount, $paypalDebug);
    }
  }
?>

<!-- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM ---- BEGIN FORM -->
<div id="formEnclosingDiv" style="margin-top:10px;">
<form name='emailAnalysisForm' id='emailAnalysisForm' action='adminPaypalParse.php' method='post'>
  <div style="margin:16px 20px;border:yellow dashed 0px;">

<?php HTMLGen::displayAdministratorSelector("padding-left:4px;padding-top:4px;border:red solid 0px;", "rowTitleTextNarrow", 
                                            "document.emailAnalysisForm.submit();", "adminPaypalParse"); ?>

<!-- Paste Area -->
    <div style="text-align:left;border:orange dashed 0px;">
      <div class="smallTitleTextOnBlack" style="margin:18px 0 4px 0;font-size:16px;font-weight:normal;">Paste Paypal Payment Received email body into the text box below and press tab.</div>
      <textarea id="pasteArea" name="pasteArea" rows="30" cols="80" onblur="javascript:justBlurredPasteArea(this);"><?php
         echo ((isset($editorState["pasteArea"])) ? $editorState["pasteArea"] : $userPasteInstruction) . "</textarea>\r\n"; ?>
      <div style="padding-top:10px;border:green solid 0px;">
        <div class="smallTitleTextOnBlack" style="margin:8px 0 8px 0;font-size:16px;font-weight:normal;">After you press tab, results will appear here.</div>
        <div id="echoArea" style="border:purple solid 1px;"></div>
    </div>
    
<?php
    function displayUnpaidWorksSelector($formName, $worksArray, $editorState) {
      $markup = '';
      $rowCount = (isset($worksArray)) ? count($worksArray) : 0;
      $selectionOptions = array();
      $workIdMayBe = 0; 
      $markup .= '<select id="workSelector" name="workSelector" style="width:250px;" ';
      if ($rowCount != 1) {
//        $markup .= 'onchange="document.getElementById(\'workSelector\').value=this.value;submitFormVia(' . $formName . ', ' . HTMLGen::simpleQuote('workSelector') . ')">' . "\r\n";
//        $markup .= 'onchange="submitFormVia(' . $formName . ', ' . HTMLGen::simpleQuote('workSelector') . ')">' . "\r\n";
        $markup .= 'onchange="submit()">' . "\r\n";
        $selectionOptions[0] = '-- select a work --';
        foreach ($worksArray as $row) {
          $workSuffix = ",&nbsp;BY " . $row['name'];
          $selectionOptions[$row['workId']] = $row['title'] . $workSuffix;
        }
        $currentSelection = 0;
        if (isset($editorState['workSelector'])) $currentSelection = $editorState['workSelector'];
        SSFDebug::globalDebugger()->becho('displayUnpaidWorksSelector $currentSelection', $currentSelection, -1);
        $markup .= HTMLGen::getSelectionOptions($selectionOptions, $currentSelection);
        $workIdMayBe = $currentSelection;
      } else { // since ($rowCount == 1)
        $markup .= '>' . "\r\n";
        $workIdMayBe = $editorState[0]['workId'];
        $workSuffix = ",&nbsp;BY " . $rows[0]['name'];
        $selectionOptions[$rows[0]['workId']] = $rows[0]['title'] . $workSuffix;
        $markup .= HTMLGen::getSelectionOptions($selectionOptions, $rows[0]['workId']); 
      }
      $markup .= '</select>' . "\r\n";
      $workIdSelected = HTMLGen::getSelectedOptionValue($selectionOptions, $workIdMayBe);
      echo $markup;
      return $workIdSelected;
    }

    // Paypal Email ANALYSIS
    $justBlurred = (isset($editorState['justBlurredPasteAreaFlag']) && $editorState['justBlurredPasteAreaFlag'] == 1);
    if ($justBlurred) {
      if (isset($editorState['pasteArea']) && ($editorState['pasteArea'] != '') && ($editorState['pasteArea'] != $userPasteInstruction)) {
        echo '<script type="text/javascript">' . "\r\n";
        echo 'document.getElementById("echoArea").innerHTML = document.getElementById("echoArea").innerHTML + \'' . $echoAreaDivString . '\''
                                            . ' + composedResultString("' . $editorState["pmtDate"] . '", "' . $editorState["transId"] . '", "' . $editorState["pmtAmt1"] . '", "' . $editorState["pmtAmt2"] . '", "'
                                            .                              $editorState["buyerName1"] . '", "' . $editorState["buyerName2"] . '", "' . $editorState["buyerEmail1"] . '", "'
                                            .                              $editorState["buyerEmail2"] . '", "' . $editorState["filmTitle"] . '", "' . $editorState["submitterEmail"] . '")'
                                            . ' + \'' . $echoAreaCloseDivString . "';\r\n";
        echo '</script>' . "\r\n";
        SSFDebug::globalDebugger()->belch("055. editorState", $editorState, -1);
//        $editorState['workSelector'] = 0;
//        $editorState['personSelector'] = 0;
      }
    } else { // since not justBlurred
      echo '<script type="text/javascript">' . "\r\n";
      echo 'document.getElementById("echoArea").innerHTML = document.getElementById("echoArea").innerHTML + \'' . $echoAreaDivString . '\''
                                            . ' + composedResultString("", "", "", "", "", "", "", "", "", "") '
                                            . ' + \'' . $echoAreaCloseDivString . "';\r\n";
      echo '</script>' . "\r\n";
      SSFDebug::globalDebugger()->becho("66 editorState", $editorState, -1);
    }

  if ($uniqueWorkFound || $userSelectedAWork) {
    if (!$paymentAlreadyApplied) {
      if (!$justApplied) {
        echo '          <div style="padding-top:6px;padding-left:116px;">' . "\r\n";
        echo '            <input type="submit" id="applyPayment" name="applyPayment" value="Apply Payment to Work">' . "\r\n";
        echo '          </div>' . "\r\n";
      }
    } else { // since $uniqueWorkFound && $paymentAlreadyApplied
      echo '<div class="smallTitleTextOnBlack" style="margin:8px 0 8px 0;font-size:16px;font-weight:normal;">The indicated payment has already been applied to this work.</div>' . "\r\n";
    }
  } else if ($multipleWorksMatch) {
      errorBelch('Multiple Works Match', $paypalValuesArray); 
  } else { // since there is no unique work found, let the user select from all the currentely unpaid works.
    echo '<div class="smallTitleTextOnBlack" style="margin:8px 0 8px 0;font-size:16px;font-weight:normal;">No work perfectly matched the title and email addresses indicated.</div>' . "\r\n";
    $unpaidWorks = "SELECT workId, title, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, "
                 .        "(datePaid is not null and datePaid != '0000-00-00' and datePaid != '') AS isPaid, "
                 .        "submitter, email, loginName, nickName, lastName, name, callForEntries "
                 . "FROM works JOIN people on submitter = personId "
                 . "WHERE withdrawn=0 AND callForEntries = " . $currentCallForEntries . " "
                 . "AND (datePaid IS NULL OR datePaid = '0000-00-00' OR datePaid = '') "
                 . "ORDER BY titleForSort";
    //SSFDB::debugNextQuery();
    $unpaidWorksArray = SSFDB::getDB()->getArrayFromQuery($unpaidWorks);
    $unpaidWorksRowCount = (isset($unpaidWorksArray)) ? count($unpaidWorksArray) : 0;
    SSFDebug::globalDebugger()->belch('211. $unpaidWorksArray', $unpaidWorksArray, -1);
    if ($unpaidWorksRowCount> 0) {
      // Would you like to select one of these: <selector> <applyButton>
      echo "          <div class='formRowContainer' style='margin-bottom:24px;'>\r\n";
//      echo "            <div class='rowTitleTextNarrow'>Work:</div>\r\n";
      echo "            <div class='entryFormFieldContainer'>\r\n";
      echo "              <div style='float:left;'>\r\n";
                            $editorState['workSelector'] = displayUnpaidWorksSelector('emailAnalysisForm', $unpaidWorksArray, $editorState); 
      echo "              </div>\r\n";
      echo "              <div style='float:right;padding-left:20px;'>\r\n";
      echo "                <input type='submit' id='applyPayment' name='applyPayment' value='Apply payment to the selected work.'>\r\n"; // disabled
      echo "              </div>\r\n";
      echo "              <div style='clear:both;'></div>\r\n";
      echo "            </div>\r\n";
      echo "          <div style='clear:both;'></div>\r\n";
      echo "          </div>\r\n";
    SSFDebug::globalDebugger()->becho('$editorState[workSelector]', $editorState['workSelector'], 1);
    }
  }
  if ($justApplied) {
    $justAppliedString = 'The indicated payment has been applied to this work.';
    $justAppliedDivString = $echoAreaDivString . 'APPLIED: ' . $justAppliedString . $echoAreaCloseDivString;
    SSFDebug::globalDebugger()->becho('bba. justAppliedDivString', $justAppliedDivString, -1);
    echo '<script type="text/javascript">' . "\r\n";
    echo 'document.getElementById("echoArea").innerHTML = document.getElementById("echoArea").innerHTML + \'' . $justAppliedDivString . '\';' . "\r\n";
    echo '</script>' . "\r\n";
  } else   if ($warningsString != '') {
    $warningsString .= '** Heed any warnings. Apply Payment to Work only if you see fit; otherwise, manually input the Paypal notification via Manage People and Works.';
    $warningsDivString = $echoAreaDivString . 'WARNING(S):<br>' . $warningsString . $echoAreaCloseDivString;
    SSFDebug::globalDebugger()->becho('bbb. warningsDivString', $warningsDivString, -1);
    echo '<script type="text/javascript">' . "\r\n";
    echo 'document.getElementById("echoArea").innerHTML = document.getElementById("echoArea").innerHTML + \'' . $warningsDivString . '\';' . "\r\n";
    echo '</script>' . "\r\n";
  }

?>
        <div style="clear:both;"></div>
       </div>
    </div>

<!--  <input type="hidden" id="workSelector" name="workSelector" value="<?php if (isset($editorState['workSelector'])) echo $editorState['workSelector']?>"> -->
  <input type="hidden" id="justBlurredPasteAreaFlag" name="justBlurredPasteAreaFlag" value="<?php if (isset($editorState['justBlurredPasteAreaFlag'])) echo $editorState['justBlurredPasteAreaFlag']?>">
  <input type="hidden" id="pmtDate" name="pmtDate" value="<?php if (isset($editorState['pmtDate'])) echo $editorState['pmtDate']?>">
  <input type="hidden" id="transId" name="transId" value="<?php if (isset($editorState['transId'])) echo $editorState['transId']?>">
  <input type="hidden" id="pmtAmt1" name="pmtAmt1" value="<?php if (isset($editorState['pmtAmt1'])) echo $editorState['pmtAmt1']?>">
  <input type="hidden" id="pmtAmt2" name="pmtAmt2" value="<?php if (isset($editorState['pmtAmt2'])) echo $editorState['pmtAmt2']?>">
  <input type="hidden" id="buyerName1" name="buyerName1" value="<?php if (isset($editorState['buyerName1'])) echo $editorState['buyerName1']?>">
  <input type="hidden" id="buyerName2" name="buyerName2" value="<?php if (isset($editorState['buyerName2'])) echo $editorState['buyerName2']?>">
  <input type="hidden" id="buyerEmail1" name="buyerEmail1" value="<?php if (isset($editorState['buyerEmail1'])) echo $editorState['buyerEmail1']?>">
  <input type="hidden" id="buyerEmail2" name="buyerEmail2" value="<?php if (isset($editorState['buyerEmail2'])) echo $editorState['buyerEmail2']?>">
  <input type="hidden" id="filmTitle" name="filmTitle" value="<?php if (isset($editorState['filmTitle'])) echo $editorState['filmTitle']?>">
  <input type="hidden" id="submitterEmail" name="submitterEmail" value="<?php if (isset($editorState['submitterEmail'])) echo $editorState['submitterEmail']?>">

</form>

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