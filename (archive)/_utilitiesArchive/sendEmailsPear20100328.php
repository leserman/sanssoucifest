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

/* 
ini_set( 
  'include_path', 
  ini_get( 'include_path' ) . PATH_SEPARATOR . "/home/(youruser)/pear/php"
);  
*/

set_include_path(
	get_include_path() . 
	PATH_SEPARATOR . '/usr/local/lib/php'
);

/*
Failed opening 'Mail/mime.php' for inclusion 
(include_path='.:/usr/local/php5/lib/php:/usr/local/lib/php:/usr/local/lib/php')
*/

include('Mail.php');
include('Mail/mime.php');

$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$file = '/home/richard/example.php';
$crlf = "\n";
$hdrs = array(
              'From'    => 'hamel@sanssoucifest.org',
              'Subject' => 'Test mime message'
              );

$mime = new Mail_mime($crlf);

$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$mime->addAttachment($file, 'text/plain');

//do not ever try to call these lines in reverse order
$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$mail->send('postmaster@localhost', $hdrs, $body);
?> 



</div>
</body>
</html>

  
  