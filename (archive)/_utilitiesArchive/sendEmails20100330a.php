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
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#333333" text="#FFFFFF" link="#0033FF" vlink="#0033FF" alink="#990000">
<div style="font-family:Arial;margin:0px;padding:20px;font-size:15px;line-height:21px;background-color:#333333;color:#FFFFFF">

<?php

// Class mailer
  class mailer {
    private static $to;
    private static $from;
    private static $subject;
    private static $message;
    private static $messageTemplate; // currently unused
    private static $plainTextPartTemplate;
    private static $htmlPartTemplate;
    private static $headers;
    private static $debugger;
    private static $boundaryString = "supercalifragilisticexpialidocious";
    private static $plainTextPartHeader = "Content-Type: text/plain; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit\n\n";
    private static $htmlPartHeader = "Content-Type: text/html; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit\n\n";
    private static $logFileHandle;
                                   
    private static function plainTextPartHeader() { return "--" . self::$boundaryString . "\n" . self::$plainTextPartHeader; }
    private static function htmlPartHeader() { return "--" . self::$boundaryString . "\n" . self::$htmlPartHeader; }
    private static function partsFooter() { return "--" . self::$boundaryString . "--"; }
    
    public static function sendItNow() {
      $messageWrapped = wordwrap(self::$message, 70);
      $mailedData = mail(self::$to, self::$subject, $messageWrapped, self::$headers);
      return $mailedData;
    }
  
    private static function initInfo() {
      self::$boundaryString .= date("YmdHis");
      self::$from     = "call@sanssoucifest.org";
      self::$subject  = "Calls for Entries - Sans Souci Festival of Dance Cinema, 2010";
      self::$headers .= "From: " . self::$from . "\r\n"
                     . "Bcc: call@sanssoucifest.org\r\n"
                     . "Reply-To: questions@sanssoucifest.org\r\n"
                     . "X-Mailer: PHP/" . phpversion() . "\r\n"
                     . 'MIME-Version: 1.0' . "\r\n"
                     . 'Content-Type: multipart/alternative; boundary="' . self::$boundaryString . '"' . "\r\n";
      self::$plainTextPartTemplate = file_get_contents("../../private/emailTemplates/callText20100330a.txt", "r");
      $fileContents = file_get_contents("../../private/emailTemplates/callHTML20100330a.txt", "r");
      self::$htmlPartTemplate = $fileContents;
      self::$debugger = new SSFDebug();
      self::$logFileHandle = fopen('./sendEmails20100330a.log', 'a');
    }

    private static function saveToDatabase($sent, $personId) {
     $senderId = 1; // TODO use the logged in user's personId
     $insertString = "INSERT INTO communications (recipient, sent, dateSent, type, sender, emailTo, emailFrom, emailSubject, physicalOrEmailOrVoice, "
                                              .  "lastModificationDate, lastModifiedBy, contentLastModDate, contentLastModifiedBy) "
                                       . "VALUES (" 
                                               . "'" . $personId . "', " // recipient Id
                                               . $sent . ", " // sent
                                               . "NOW(), " // dateSent
                                               . "'CallForEntries'" . ", " // type
                                               . $senderId . ", " // sender
                                               . "'" . self::$to . "', " // emailTo
                                               . "'" . self::$from . "', " // emailFrom
                                               . "'" . self::$subject . "', " // emailSubject
                                               . "'Email'" . ", " // physicalOrEmailOrVoice
                                               . "NOW(), " // lastModificationDate
                                               . $senderId . ", " // lastModifiedBy
                                               . "NOW(), " // contentLastModDate
                                               . $senderId // contentLadModifiedBy
                                       . ")";
      //SSFDB::debugNextQuery();
      $querySuccess = SSFDB::getDB()->saveData($insertString);
      return $querySuccess;
    }
    
    private static function sendEmail($person, $index) {
      $separator = '';
      // $person["email"] is actually a comma-separated list of email addresses
      $emailAddresses = explode(',', $person["email"]);
      self::$debugger->belch('emailAddresses', $emailAddresses, -1);
      $formattedEmailAddresses = '';
      $printEmailAddresses = '';
      foreach ($emailAddresses as $emailAddress) {
        $formattedEmailAddresses .= $separator . ' <' . trim($emailAddress) . '>';
        $printEmailAddresses .= $separator . ' &lt;' . trim($emailAddress) . '&gt;';
        self::$debugger->belch('emailAddress', $emailAddress, -1);
        $separator = ', ';
        break; // Use only the first email address encountered
      }
      self::$to = '"' . $person["name"] . '" ' .  $formattedEmailAddresses;
      $more1 = '';
      self::$debugger->belch('person["relationship"]', $person["relationship"], -1);
      self::$debugger->belch('person["role"]', $person["role"], -1);
      if ((stripos($person["relationship"], "PressForCallForEntries") !== false) || (stripos($person["role"], "Journal") !== false)) $more1 = "Please publish this call for entries as appropriate.";
      else if ((stripos($person["role"], "Network") !== false) || (stripos($person["role"], "Center") !== false) || (stripos($person["role"], "Museum") !== false)
             || (stripos($person["role"], "Series") !== false) || (stripos($person["role"], "Company") !== false) || (stripos($person["role"], "Administrator") !== false)) 
        $more1 = "Please post, publish, and distribute this call for entries as appropriate.";
      else if (stripos($person["role"], "Faculty") !== false) $more1 = "Please share this call for entries with your students as appropriate.";
      else if (stripos($person["role"], "Festival") !== false) $more1 = "Please share this call for entries as appropriate.";

      self::$message = self::plainTextPartHeader();
      self::$message .= str_replace("|more1|", $more1, str_replace("|name|", $person["name"], self::$plainTextPartTemplate));
      self::$message .= "\n" . self::htmlPartHeader();
      self::$message .= str_replace("|more1|", $more1, str_replace("|name|", $person["name"], self::$htmlPartTemplate));
      self::$message .= "\n" . self::partsFooter();
      $sent = self::sendItNow();

      // save it
      $saved = self::saveToDatabase($sent, $person["personId"]);
      $savedString = ($sent) ? 'SAVED to DB' : '*** NOT SAVED ***';

      // log it
      $sentString = ($sent) ? 'SENT' : '*** NOT SENT ***';
      $belchString = sprintf("%03d", $index) . ' ' . date("Y-m-d H:i:s") . ' &quot;' . $person["name"] . '&quot;' 
                                             . $printEmailAddresses . ' ' . $sentString . ', ' . $savedString;
      $logString = "\r\n" . sprintf("%03d", $index) . ' ' . date("Y-m-d H:i:s") . ' "' . $person["name"] . '"' 
                          . $formattedEmailAddresses . ' ' . $sentString . ', ' . $savedString;
      self::$debugger->becho('', $belchString, -1);
      $logged = fwrite(self::$logFileHandle, $logString);
      if ($logged === false) self::$debugger->becho('', 'fwrite FAILED', 1);
      return ($logged !== false);
    }

    public static function sendEmails($secondsDelayBetweenEach) {
      self::initInfo();
      $selectString = "select personId, name, lastName, nickName, email, notifyOf, role, relationship from people "
                    . "where notifyOf like '%calls%' and email is not null and email != '' "
//                    . "and relationship like '%tester%' "
                    . "order by lastName";
      $people = SSFDB::getDB()->getArrayFromQuery($selectString);
      $peopleCount = count($people);
      echo "for " . $peopleCount . " people.<br><br>\r\n";
      $index = 0;
      $sending = false;
      foreach ($people as $person) {
//        if ($person["name"] == "David Leserman") {
        $index++;
        if ($sending) {
          if (!self::sendEmail($person, $index)) { $sending = false; break; }
          ob_end_flush(); // Manage the output buffers.
          ob_flush(); // Manage the output buffers.
          flush(); // Manage the output buffers.
          ob_start(); // Manage the output buffers.
  //        if ($index >= $peopleCount) break;
  //        if ($index >= 2) break;
          set_time_limit(0); // Manage the sleep timer.
          if ($index < $peopleCount) sleep($secondsDelayBetweenEach);
  //        if ($index < $peopleCount) usleep(1000000 * $secondsDelayBetweenEach);
        }
        // This foreach does nothing but increment $index until the person after this one in the query result.
        if ($person["name"] == "Silvina Szperling") { $sending = true; }  // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
      }
      fclose(self::$logFileHandle);
    }
  } // end class mailer

// Include php files.
  $filePathArray = explode('/', __FILE__);
  $loopIndex = 0;
  foreach ($filePathArray as $element) { 
    $loopIndex++;
    if ($element == 'sanssoucifest.org') { break; } 
  }
  $codeBase = "";
  for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
  include_once $codeBase . "bin/utilities/autoloadClasses.php";

// Send the emails  
  ob_start(); // Manage the output buffers.
  echo "<h1>Sending emails</h1>\r\n";
  mailer::sendEmails(1);  // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
  echo "<h1>Fini</h1>\r\n";
  ob_end_flush(); // Manage the output buffers.
  ob_flush(); // Manage the output buffers.
  flush(); // Manage the output buffers.
?>

</div>
</body>
</html>

  