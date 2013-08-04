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
<body bgcolor="#333333" text="#FFFFFF" link="#0033FF" vlink="#0033FF" alink="#990000">
<div style="font-family:Arial;margin:0px;padding:20px;font-size:15px;line-height:21px;background-color:#333333;color:#FFFFFF">

<?php

// From http://sb2.info/php-script-html-plain-text-convert/
  function html2text($html) {
    $tags = array (
      0 => '~<h[123][^>]+>~si',
      1 => '~<h[456][^>]+>~si',
      2 => '~<table[^>]+>~si',
      3 => '~<tr[^>]+>~si',
      4 => '~<li[^>]+>~si',
      5 => '~<br[^>]+>~si',
      6 => '~<p[^>]+>~si',
//      7 => '~</div>~si',
      7 => '~<div[^>]+>~si',
      );
    $html = preg_replace($tags,"\n",$html);
    $html = preg_replace('~</t(d|h)>\s*<t(d|h)[^>]+>~si',' - ',$html);
    $html = preg_replace('~<[^>]+>~s','',$html);
    // reducing spaces
    $html = preg_replace('~ +~s',' ',$html);
    $html = preg_replace('~^\s+~m',"",$html);
    $html = preg_replace('~\s+$~m','',$html);
    // reducing newlines
//    $html = preg_replace('~\n+~s',"\n",$html);
    return $html;
  }

// Convert the text
  $text = html2text(file_get_contents("../../private/emailTemplates/callHTML20100330a.txt"));
  echo $text;
?>

</div>
</body>
</html>
