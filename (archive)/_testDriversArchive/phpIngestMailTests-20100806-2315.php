<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>phpIngestMailTests.php</title>
<script type="text/javascript">

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
    resultString = resultString + ("from line = |" + fromLine +  "|<br>");
    resultString = resultString + ("from name = |" + fromName +  "|<br>");
    resultString = resultString + ("email address = |" + fromEmailAddr + "|<br>");
    resultString = resultString + ("date sent = |" + dateSentStr + "|<br>");
    resultString = resultString + ("subject = |" + subject + "|<br>");
    return resultString;
  }

</script>

</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">

<?php

  function dispDate($timeStr) {
    //echo $timeStr . ' >> ' . strtotime($timeStr)  . ' >> ' . date('Y-m-d H:i:s', strtotime($timeStr)) . "<br>\r\n";
    $timeStamp = strtotime($timeStr);
    if ($timeStamp === false) $dateDisp = "Error in date format.";
    else $dateDisp = date('Y-m-d H:i:s', $timeStamp);
    echo $timeStr . ' >> ' . $dateDisp . "<br>\r\n";
  }
  
//  echo phpinfo();
?>
<script type="text/javascript">
  function echoIt(string) {
/*
    var len=string.length;
    var string2 = '';
    for (var i = 0; i < len; i++) {
      string2 += string.charCodeAt(i) + "<br>";
    }
*/
    document.getElementById("echoArea").innerHTML = parseHeader(string);
  }
</script>
<p>
Hello.
</p>
Mail Header:
<textarea rows="8" cols="80"  onblur="javascript:echoIt(this.value);">
Paste mail header here.
</textarea>
<div id="echoArea" style="padding-top:20px">Goodbye</div>

<?php
  date_default_timezone_set('America/Denver');
  echo "<br>\r\n";
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
?>

</body>
</html>

