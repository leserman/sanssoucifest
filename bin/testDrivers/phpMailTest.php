<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>phpMailTest.php</title>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">

<?php
$to      = 'david@leserman.com';
$subject = 'email from phpMailTest.php';
$message = 'hello from phpMailTest.php';
$headers = 'From: hamelb@sanssoucifest.org' . "<br>\r\n" .  'X-Mailer: PHP/' . phpversion();
//$headers = 'From: webmaster@example.com' . "\r\n" . 
//    'Reply-To: webmaster@example.com' . "\r\n" .
//    'X-Mailer: PHP/' . phpversion();

echo $to . "<br>\r\n";
echo $subject . "<br>\r\n";
echo $message . "<br>\r\n";
echo $headers . "<br>\r\n";

//$result = mail($to, $subject, $message, $headers);
$result = mail($to, $subject, $message);
echo (($result) ? 'success' : 'failure')  . "<br>\r\n" ;

// Time test.
//echo time() . "<br>\r\n" ;
//echo microtime() . "<br>\r\n" ;
echo "<br><br><br>" . date('l jS \of F Y h:i:s A');
?>

</body>
</html>

