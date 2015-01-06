<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>SSF - Mail Test</title> 
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body bgcolor="#CCCCCC" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<h1 style="color:red;">Mail Test</h1>
<?php
    function sendItNow() {
      date_default_timezone_set('America/Denver');
//      $message = "\r\n" . "\r\n" . "Hello " . date("F j, Y, g:i a") . "\r\n" . "Goodbye" . "\r\n";
      $message = "The current date and time is " . date("F j, Y, g:i a");
      $headers     = "From: entryform@sanssoucifest.org\r\n"
                   . "Reply-To: no-reply@sanssoucifest.org\r\n"
                   . "X-Mailer: PHP/" . phpversion();
      $to = "entryform@sanssoucifest.org";
//      $to = "hamelb@sanssoucifest.org";
      $subject = 'Wrk Edit: "2014 Fake Seed Entry" (1)';
//      $mailedData = mail($to, $subject, $message, $headers);
      $mailedData = mail($to, $subject, $message);

      echo "<div style='color:green;margin-left:20px;'>"; 
      echo "to: " . $to . "<br>";
      echo "subject: " . $subject . "<br>";
      echo "message: " . $message . "<br>";
      echo "headers: " . $headers . "<br>";
      echo "mailedData: " . $mailedData . "<br>";
      echo "</div>"; 

    }
  sendItNow();
?>
</body>
</html>
