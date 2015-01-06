<!DOCTYPE html>
<?php 
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  SSFWebPageParts::initializePage(__FILE__); 
  SSFWebPageParts::setContentColumnCount(1);
  SSFWebPageParts::disallowRobotIndexing(); // default is to allow robot indexing
  SSFWebPageParts::setPageHeaderTitleTextAlignment('topLeft'); // default is topLeft

// Stuff to be modified for each new email to be generated:

//    See RoxyPremissionRequestNotes.txt to see how to update the permissionRequest table

      SSFWebPageParts::setPageHeaderTitleText('Screening Notification for Roxy, 12/2014');   

      $queryWhereClause = 'event=37';
  
      $longestDate = 'Friday and Saturday, December 5 and 6, 2014';
      $longDate = 'December 5 and 6, 2014';
      $shortDate = '12/5 and 12/6 2014';
      $date = $shortDate;
      $venue = 'the Roxy (http://theroxytheater.org/) in Missoula, MT, USA';
      $from = 'Hamel Bloom <hamelb@sanssoucifest.org>';
      $bcc = 'curators@sanssoucifest.org';
      
      $subjectTemplate = '"<title>" to screen at the Roxy on ' . $date;

      $emailTemplate = 'Dear <name>,' . "<br><br>"
               . 'Sans Souci Festival of Dance Cinema is pleased to inform you that "<title>" will be screened at '
               . $venue . ' on ' . $longestDate . '.' . "<br><br>"
               . '<permissionThankYou>'
               . 'Best wishes,<br><br>'
               . "Hamel Bloom<br>Executive Director<br>Sans Souci Festival of Dance Cinema<br>http://sanssoucifest.org<br><br>";

// END Stuff to be modified for each new email to be generated:
    
  echo SSFWebPageParts::beginHTML();
  echo SSFWebPageParts::htmlHeadContent(); 
?>

    <style>
    td {vertical-align:top;border:0px pink solid;padding:2px 4px;font-family:Helvetica;font-size:12px;}
    textarea {font-family:Helvetica;font-size:12px;margin-top:-3px;}
    .textAreaDiv {margin:4px 0;vertical-align:top;}
    </style>

<?php
  echo SSFWebPageParts::endHead();
  echo SSFWebPageParts::beginPageBody();
  echo SSFWebPageParts::beginContentHeader();

    function htmlify($rawText) {
      $cookedText = $rawText;
      $cookedText = str_replace('<', '&lt;', $cookedText);
      $cookedText = str_replace('>', '&gt;', $cookedText);
      $cookedText = str_replace('"', '&quot;', $cookedText);
      return $cookedText;
    }
    
    function mailify($rawText) {
      $cookedText = $rawText;
      $cookedText = str_ireplace('<br>', '%0A', $cookedText);
      $cookedText = str_replace(' ', '%20', $cookedText); 
      $cookedText = str_replace('"', '%22', $cookedText); 
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
    
    function getSubjectText($title) {
      global $subjectTemplate, $date, $longDate, $shortDate, $venue;
      $subject = str_ireplace('<title>', $title, $subjectTemplate);
      $subject = str_ireplace('<date>', $date, $subject);
      $subject = str_ireplace('<longDate>', $longDate, $subject);
      $subject = str_ireplace('<shortDate>', $shortDate, $subject);
      $subject = str_ireplace('<venue>', $shortDate, $subject);
      return $subject;
    }
    
    function getEmailBodyText($title, $submitterName) {
      global $emailTemplate, $date, $longDate, $shortDate, $venue, $requestedPermission;
      $permissionThankYou = ($requestedPermission) ? 'Thanks for your permission to screen "<title>" at this venue.<br><br>' : '';
      $bodyText = $emailTemplate;
      $bodyText = str_ireplace('<permissionThankYou>', $permissionThankYou, $bodyText);
      $bodyText = str_ireplace('<title>', $title, $bodyText);
      $bodyText = str_ireplace('<date>', $date, $bodyText);
      $bodyText = str_ireplace('<longDate>', $longDate, $bodyText);
      $bodyText = str_ireplace('<shortDate>', $shortDate, $bodyText);
      $bodyText = str_ireplace('<venue>', $venue, $bodyText);
      $bodyText = str_ireplace('<name>', $submitterName, $bodyText);
//      $bodyText = str_ireplace('<br>', PHP_EOL, $bodyText);
      return $bodyText;
    }
    
    function brToEOL($rawText) {
      $cookedText = str_ireplace('<br>', PHP_EOL, $rawText);
      return $cookedText;
    }
    
    echo "<table style='text-align:center;'>\r\n";
    
    $query = 'SELECT title, name, email, IF(SUBSTR(permissionsAtSubmission,1,5)="askMe", 1, 0) AS requestedPermission '
           . 'FROM works JOIN runOfShow ON work=workId JOIN shows ON `show`=showId JOIN people ON submitter=personId '
           . 'AND ' . $queryWhereClause;
    $resultRows = SSFDB::getDB()->getArrayFromQuery($query);
    $i = 0;
    foreach($resultRows as $resultRow) {
      $i++;
      $name = $resultRow['name'];
      $title = $resultRow['title'];
      $email = $resultRow['email'];
      $requestedPermission = $resultRow['requestedPermission'] == 1;
      $to = '"' . $name . '" <' . $email . '>';
      $subject = getSubjectText($title);
      $message = getEmailBodyText($title, $name);
      $headers = "From: " . $from . "\r\n"
               . "Reply-To: " . $from . "\r\n"
               . "Bcc: " . $bcc . "\r\n"
               . "X-Apparently-To: " . $to;
      $emailSubject = mailify($subject);
      $emailBody = mailify($message);
      $mailToString = $email . '?bcc=Curators@sanssoucifest.org&amp;subject=' . $emailSubject . '&amp;body=' . $emailBody;
      
/*
echo '<tr><td style="text-align:left;">' . "DEBUG subject: "; print_r($subject); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG mailify(subject): "; print_r(mailify($subject)); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG emailSubject: "; print_r($emailSubject); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG message: "; print_r($message); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG mailify(message): "; print_r(mailify($message)); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG emailBody: "; print_r($emailBody); echo '</td></tr>' . PHP_EOL;
echo '<tr><td style="text-align:left;">' . "DEBUG mailToString: "; print_r($mailToString); echo '</td></tr>' . PHP_EOL;
*/

      echo "<tr>\r\n";
      echo '  <td style="text-align:right;">' . "\r\n";
      echo '    <div class="textAreaDiv" style="font-size:15px;margin-bottom:6px;margin-right:3px;">' . $i . ') <a href="mailto:' . $mailToString . '" target="_top"> GenMail</a></div>' . "\r\n";
      echo '    <div class="textAreaDiv">To: <textarea rows="1" cols="60">' . htmlify($to) . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">BCC: <textarea rows="1" cols="60">' . htmlify($bcc) . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">Subject: <textarea rows="1" cols="60">' . $subject . "</textarea></div>\r\n";
      echo '    <div class="textAreaDiv">Message: <textarea rows="17" cols="60">' . brToEOL($message) . "</textarea></div>\r\n";
      echo '  </td>' . "\r\n";

      echo "</tr>\r\n";
    }
    
    echo "</table>\r\n";

    echo SSFWebPageParts::endContentHeader();
    echo SSFWebPageParts::endPageBody();
    echo SSFWebPageParts::endHTML();
?>