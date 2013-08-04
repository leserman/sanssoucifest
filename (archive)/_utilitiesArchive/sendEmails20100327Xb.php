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
</head>
<body bgcolor="#CCCCCC" text="#333333" link="#0033FF" vlink="#0033FF" alink="#990000">
<div style="font-family:Arial;margin:0px;padding:20px;font-size:15px;line-height:21px;background-color:#333333;color:#FFFFFF">

<?php

// Class mailer
  class mailer {
    private static $to;
    private static $subject;
    private static $message;
    private static $messageTemplate;
    private static $headers;
    private static $debugger;
    
    public static function sendItNow($person, $index, $printEmailAddresses) {
      $messageWrapped = wordwrap(self::$message, 70);
      $mailedData = mail(self::$to, self::$subject, $messageWrapped, self::$headers);
      $statusString = ($mailedData) ? 'SUCCESS' : ' FAILURE';
      self::$debugger->becho('', sprintf("%03d", $index) . ' ' . date("Y-M-D H:i:s") . ' &quot;' 
                              . $person["name"] . '&quot;' . $printEmailAddresses . ' ' . $statusString, 1);

    }
  
    private static function initInfo() {
      self::$subject  = "Calls for Entries - Sans Souci Festival of Dance Cinema, 2010";
      self::$headers  = 'MIME-Version: 1.0' . "\r\n";
      self::$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      self::$headers .= "From: call@sanssoucifest.org\r\n"
                     . "Bcc: call@sanssoucifest.org\r\n"
                     . "Reply-To: questions@sanssoucifest.org\r\n"
                     . "X-Mailer: PHP/" . phpversion();
      self::$messageTemplate = "This is a test.\n\n"
                             . "Calls for Entries - Sans Souci Festival of Dance Cinema, 2010\n\n"
                             . "<html><body><div style='font-family:Arial;font-size:12pt;color:red;'>Now "
                             . "is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "Now is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "Now is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "</div></body></html>\n\n"
                             . "Now is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "Now is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "Now is the time for all good men to come to the aid of their party. Jack Sprat could eat no fat; his wife could eat no lean - and so, toghther, they licked the platter clean. "
                             . "\n\n";
      self::$debugger = new SSFDebug();
    }

    private static function sendEmail($person, $index) {
      self::initInfo();
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
      $thisMessage = "Dear " . $person['name'] . ",\n\n";
      self::$to = '"' . $person["name"] . '" ' .  $formattedEmailAddresses;
      self::$message = $thisMessage . self::$messageTemplate;
      self::sendItNow($person, $index, $printEmailAddresses);
    }

    public static function sendEmails() {
      $selectString = "select name, lastName, nickName, email, notifyOf from people "
                    . "where notifyOf like '%calls%' and email is not null and email != '' "
                    . "and relationship like '%tester%' "
                    . "order by lastName";
      $people = SSFDB::getDB()->getArrayFromQuery($selectString);
      $peopleCount = count($people);
      echo "for " . $peopleCount . " people.<br><br>\r\n";
      $index = 0;
      set_time_limit(0);
      foreach ($people as $person) {
        self::sendEmail($person, ++$index);
        if ($index >= 1) break;
//        if ($index <= $peopleCount) usleep(1000000 * 60);
        if ($index <= $peopleCount) sleep(1 * 60);
      }
    }
  }

// Include stuff
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
  echo "<h1>Sending emails</h1>\r\n";
  mailer::sendEmails();  
?>

</div>
</body>
</html>

  
  