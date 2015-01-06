<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Email Writer</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">

<style>
td {vertical-align:top;border:0px pink solid;padding:2px 4px;font-family:Helvetica;font-size:12px;}
textarea {font-family:Helvetica;font-size:12px;margin-top:-3px;}
.textAreaDiv {margin:4px 0;vertical-align:top;}
</style>
  
<!--  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css"> -->
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">

<?php
    
    function htmlify($rawText) {
      $cookedText = $rawText;
      $cookedText = str_replace('<', '&lt;', $cookedText);
      $cookedText = str_replace('>', '&gt;', $cookedText);
      $cookedText = str_replace("\r\n", '<br>', $cookedText);
      $cookedText = str_replace("  ", '&nbsp;', $cookedText);
      return $cookedText;
    }
    
    function mailify($rawText) {
      $cookedText = $rawText;
      $cookedText = str_replace(' ', '%20', $cookedText); 
      $cookedText = str_replace('"', '%22', $cookedText); 
      $cookedText = str_replace("'", "\'", $cookedText); 
      return $cookedText;     
    }
    
    echo "<table align='center'>\r\n";
    
    $showId = 61;
    $date = 'December 4, 2013';
    $from = 'Hamel Bloom <hamelb@sanssoucifest.org>';
    $bcc = 'curators@sanssoucifest.org';
    
    $query = 'select name, email, title from runOfShow'
           . ' join works on work = workId '
           . ' join people on submitter=personId '
           . ' where `show`=' . $showId;
    $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
    $i = 0;
    foreach($resultRows as $resultRow) {
      $i++;
      $name = $resultRow['name'];
      $title = $resultRow['title'];
      $email = $resultRow['email'];
      $to = '"' . $name . '" <' . $email . '>';
//      $subject = '"' . $title . '" to screen at the Boe on ' . $date;
      $subject = '"' . $title . '" to screen at the Canyon Theater on ' . $date;
//      $subject = $title . ' to screen at the Boe on ' . $date;
//               . 'Sans Souci Festival of Dance Cinema is pleased to inform you that "' . $title . '" will be screened at the Boedecker Theater in Boulder, Colorado, USA '
//               . 'on ' . $date . '. The Boedecker is an art theater at the Dairy Center for the Arts in Boulder.' . "\r\n\r\n"
      $message = 'Dear ' . $name . ',' . "\r\n\r\n"
               . 'Sans Souci Festival of Dance Cinema is pleased to inform you that "' . $title . '" will be screened at the Canyon Theater in Boulder, Colorado, USA '
               . 'on Wednesday, ' . $date . ' at 6:30 PM. Canyon Theater is at the Boulder Public Library.' . "\r\n\r\n"
               . 'Best wishes,'  . "\r\n\r\n"
               . "Hamel Bloom\r\nExecutive Director\r\nSans Souci Festival of Dance Cinema\r\nhttp://sanssoucifest.org\r\n\r\n"
               . "Links of Interest:\r\n"
               . " - Program Details: http://sanssoucifest.org/programPages/program2013FallDates.php#show61\r\n"
               . " - Boulder Public Library: http://boulderlibrary.org/\r\n";
      $headers = "From: " . $from . "\r\n"
               . "Reply-To: " . $from . "\r\n"
               . "Bcc: " . $bcc . "\r\n"
               . "X-Mailer: PHP" . phpversion() . "\r\n"
               . "X-Apparently-To: " . $to;
      echo "<tr>\r\n";
/*
      echo '<td style="text-align:right;"><a href="mailto:' . $email . '?bcc=Curators@sanssoucifest.org&subject=' . mailify($subject) . '&body=' . $message . '" target="_top"><span style=font-size:15px;">GenMail</span></a><br>' . "\r\n";
      echo '<br>To: <textarea rows="4" cols="40">' . htmlify($to) . "</textarea><br>\r\n";
      echo '<br>Subject: <textarea rows="4" cols="40">' . $subject . "</textarea></td>\r\n";
      echo '<td>Message: <textarea rows="20" cols="80">' . $message . '</textarea></td>' . "\r\n";
*/
      echo '  <td style="text-align:right;">' . "\r\n";
      echo '    <div class="textAreaDiv"><div style=font-size:15px;margin-bottom:6px;margin-right:3px;">' . $i . ') <a href="mailto:' . $email . '?bcc=Curators@sanssoucifest.org&subject=' . mailify($subject) . '&body=' . $message . '" target="_top"> GenMail</div></a></div>' . "\r\n";
      echo '    <div class="textAreaDiv">To: <textarea rows="1" cols="80">' . htmlify($to) . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">BCC: <textarea rows="1" cols="80">' . htmlify($bcc) . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">Subject: <textarea rows="1" cols="80">' . $subject . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">Message: <textarea rows="17" cols="80">' . $message . "</textarea></div>\r\n";
      echo '  </td>' . "\r\n";

      echo "</tr>\r\n";

//      echo "<td>" . htmlify($headers) . "</td>\r\n";
//      echo "<td>" . $name . "</td>\r\n";
//      echo "<td>" . $title . "</td>\r\n";
    }

    
    echo "</table>\r\n";

?>

</body>
</html>

