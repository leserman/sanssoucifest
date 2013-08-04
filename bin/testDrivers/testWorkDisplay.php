<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="../../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
<title>Test Work Display</title>
</head>
<body>

<!--
<form name="input" action="html_form_submit.asp" method="get">
<input type="text" name="workId">
<input type="submit" value="Submit">
</form>
-->

<?php 

  error_reporting(E_ALL);
  ini_set('display_errors', True);

  include_once "../utilities/autoloadClasses.php";

  $workId = 140;  // 140=Mark Crawford;  // 215=snoopy
  $personAndWorkArray = SSFQuery::selectSubmitterAndWorkNoCommsFor($workId);
  $contributorsArray = SSFQuery::selectContributorsFor($workId);

  $forAdmin = false; 
?>

  <div class="bodyTextLeadedOnBlack">
    <?php 
      echo '<div style="margin-left:2em;max-width:' . (($forAdmin) ? '40' : '30') . 'em;">';
      HTMLGen::displayPersonDetail($personAndWorkArray, $forAdmin); 
    ?>
    </div>
  
    <div style="margin-left:2em;max-width:30em;">
  <?php HTMLGen::displayWorkDetail($personAndWorkArray, $contributorsArray); ?>
    </div>
  </div>
  
</body>
</html>
