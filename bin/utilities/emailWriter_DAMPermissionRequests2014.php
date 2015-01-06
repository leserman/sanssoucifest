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
    
    function getSetTextFromArray($array) {
      $setText = '(';
      foreach($array as $element) {
        if ($setText != '(') $setText .= ', ';
        $setText .= $element;
      }
      $setText .= ') ';
      return $setText;      
    }
    
    function getSubjectText($template, $title, $date) {
      $subject = str_replace('<title>', $title, $template);
      $subject = str_replace('<date>', $date, $subject);
      return $subject;
    }
    
    function getEmailBodyText($template, $submitterName, $title, $date) {
      $bodyText = str_replace('<title>', $title, $template);
      $bodyText = str_replace('<date>', $date, $bodyText);
      $bodyText = str_replace('<name>', $submitterName, $bodyText);
      $bodyText = str_replace('<br>', PHP_EOL, $bodyText);
      return $bodyText;
    }
    
    echo "<table align='center'>\r\n";
    
    // Stuff to be modified for each new email to be generated:

        //$showId = 61;
        //$queryWhereClause = ' where `show`=' . $showId;
  
        $worksForRequest = array(1073, 1131, 1118);
        $queryWhereClause = ' where `workId` in ' . getSetTextFromArray($worksForRequest);
    
        $date = 'Oct 17, 18, and 19, 2014';
        $from = 'Hamel Bloom <hamelb@sanssoucifest.org>';
        $bcc = 'curators@sanssoucifest.org, michelle@sanssoucifest.org';
        
        $subjectTemplate = 'Requesting permission to screen "<title>" at the University of Colorado on <date>';
        $emailTemplate = 'Dear <name>,<br><br>'
                   . 'Sans Souci Festival of Dance Cinema requests your permission to screen "<title>" on <date> '
                   . 'in Irey Theater in Boulder, Colorado, USA. <br><br>'
                   . 'This screening is to be a part of "The D.A.M. Show: Dance Art Media" (link below), '
                   . 'an MFA qualifying dance concert by Jessica Page, '
                   . 'a student of our founder, Dance Professor Michelle Ellsworth. '
                   . 'The Irey Theater is located in the Theatre and Dance Building on the campus of the University of Colorado at Boulder.<br><br>'
                   . 'Best wishes,<br><br>'
                   . "Hamel Bloom\r\nExecutive Director<br>Sans Souci Festival of Dance Cinema<br>http://sanssoucifest.org<br><br>"
                   . 'http://www.colorado.edu/theatredance/eventstickets/dam-show-dance-art-media<br>';

    // END Stuff to be modified for each new email to be generated:


    $query = 'SELECT DISTINCT name, email, title FROM runOfShow JOIN works ON work = workId JOIN people ON submitter=personId ' . $queryWhereClause;
    $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
    $i = 0;
    foreach($resultRows as $resultRow) {
      $i++;
      $name = $resultRow['name'];
      $title = $resultRow['title'];
      $email = $resultRow['email'];
      $to = '"' . $name . '" <' . $email . '>';
      $subject = getSubjectText($subjectTemplate, $title, $date);
      $message = getEmailBodyText($emailTemplate, $name, $title, $date);
      $headers = "From: " . $from . "\r\n"
               . "Reply-To: " . $from . "\r\n"
               . "Bcc: " . $bcc . "\r\n"
//               . "X-Mailer: PHP" . phpversion() . "\r\n"
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

