<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Sans Souci Festival of Dance Cinema</title>
  <script src="../bin/database/databaseSupportFunctions.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php
                        
  include '../bin/forms/entryFormFunctions.php';
	include 'dataEntryFunctions.php';
	include 'databaseSupportFunctions.php';

  $connectionSuccess = connectToDB();

  // READ the VALUES FROM the works table
	$worksSelectString = "select personId, name, organization, city, stateProvRegion, country, workId, title, yearProduced, "
										 . "designatedId, runTime, webSite, accepted, rejected, country, submissionFormat, originalFormat, "
										 . "synopsisOriginal, previouslyShownAt from works join people on (people.personId=works.submitter) "
										 . "where callForEntries=1 order by designatedId ASC;";
  debugLogLineQuery($worksSelectString);
	$worksQueryResult = mysql_query($worksSelectString); 
  debugLogQuery($worksQueryResult, $worksSelectString);
  debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 

		// TODO: Get this from interactive input (show all Sans Souci people in a drip-down and choose from there).
		$curator[1] = 1; // David's personId
		$curator[2] = 5; // Ana's personId
		$curator[3] = 38; // Michelles's personId
    
		echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
		while ($worksQueryResult && ($workRow = mysql_fetch_array($worksQueryResult))) {
		  foreach ($curator as $person) {  
        $insertString = "INSERT INTO curation (entry, curator) VALUES (" . $workRow['workId'] . ", " . $person . ")";
				debugLogLineQueryUn($insertString);
				$insertResult = mysql_query($insertString); 
				debugLogQuery($insertResult, $insertString);
				debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 
      }
		}
		echo "</table>";
?>
</body>
</html>
