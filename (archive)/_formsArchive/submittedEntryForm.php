<?php session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Pay Entry Fee</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top">
            <?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar();
            ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" --><table 
			width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#333333">
		  <tr>
        <td align="left" valign="top" class="programPageTitleText"><img src="../paypal/images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br>
        Entry Submitted</td>
		  </tr>
<tr><td class="bodyTextLeadedOnBlack" align="left">
<?php

  include '../bin/forms/entryFormFunctions.php';

debugLogLine("submit = " . $_POST['Submit']);

/* NOTES:
  - In this code, the term/word/prefix "entry" refers to an entry to Sans Souci in response to a Call for Entries, NOT TO a database entry.
*/

  // Connect to the DB when the Submit button was clicked.
  $connectionSuccess = connectToDB();

debugLogLine("connectionSuccess = |" . $connectionSuccess . "|");
  $runTime = formattedRunTimeString($_POST[RunTimeMinutes], $_POST[RunTimeSeconds]);
  $fixedRoles[1] = 'Director';
  $fixedRoles[2] = 'Producer';
  $fixedRoles[3] = 'Choreographer';
  $fixedRoles[4] = 'DanceCompany';
  $fixedRoles[5] = 'PrincipalDancers';
  $fixedRoles[6] = 'MusicComposition';
  $fixedRoles[7] = 'MusicPerformance';
  $nRoles = $nFixedRoles = 7;

debugLogLine("session_name = " . session_name());     
debugLogLine("SESSION[submitterId] = " . $_SESSION['submitterId']);     

debugLogLine("filmTitle = " . $_POST['FilmTitle']);
debugLogLine("runTime = " . $runTime);

  // SET $callForEntriesId
  // TODO to do: FIX THIS  ???
  $callForEntriesId = getCallForEntriesIdFromName($_POST['CallForEntriesName']);
  //$callForEntriesId = getCallForEntriesIdFromName('BMoCA200804');

// TODO todo: prevent reinsertion of data into tables in entryFormSubmitted by using the hidden submitterId in the form.
// Write function submitterId() to return the $_SESSION['submitterId'] or the $_POST['submitterId'] 
// Change the uses of $_SESSION['submitterId'] to be calls to submitterId()
// Also, rework the function submitterInPeopleTable() to do the right thing.

  $submitterInPeopleTable = submitterInPeopleTable();
debugLogLine("Global SESSION[submitterId] = " . $_SESSION['submitterId'] . " and " 
             . (($submitterInPeopleTable) ? "submitter In People Table" : "submitter NOT In People Table" ));
  // INSERT or UPDATE SUBMITTER in DB
  if (!$submitterInPeopleTable) {
    // insert submitter into people table
    $peopleInsertString = f00("INSERT INTO people (name, loginName, password, phoneVoice, phoneMobile, phoneFax, email, organization, streetAddr1, "
                                       . "streetAddr2, city, stateProvRegion, zipPostalCode, country, howHeardAboutUs, lastModificationDate, lastModifiedBy) "
              . "VALUES (" . quote($_POST['SubmitterName']) . ", " . quote($_POST['SubmitterEmail']) . ", " . quote($_POST['SubmitterPassword']) . ", "
              . quote($_POST['SubmitterPhoneVoice']) . ", " . quote($_POST['SubmitterPhoneMobile']) . ", " . quote($_POST['SubmitterPhoneFax']) . ", " 
              . quote($_POST['SubmitterEmail']) . ", " . quote($_POST['SubmitterOrganization']) . ", " . quote($_POST['SubmitterAddress1']) . ", " 
              . quote($_POST['SubmitterAddress2']) . ", " . quote($_POST['SubmitterCity']) . ", " . quote($_POST['SubmitterState']) . ", " 
              . quote($_POST['SubmitterPostalCode']) . ", " . quote($_POST['SubmitterCountry']) . ", " . quote($_POST['SubmitterHowHeard']) . ", NOW(), 0)");
debugLogLineQuery($peopleInsertString);
    $result = mysql_query($peopleInsertString); 
    $_SESSION['submitterId'] = ($result) ? mysql_insert_id() : 0;  // This is the RIGHT way to get an AUTO-INCREMENT Id from a table
debugLogLine("Insert Query Finished -- result = " . $result); 
debugLogQuery($result, $peopleInsertString);
debugLogLine("SubmitterId from DB = " . $_SESSION['submitterId']);
    } else { // since this submitter is already in table
      // update the submitter record
      $submitterUpdates = submitterUpdates();
      // update submitter in people table
      if ($submitterUpdates != '') { // there are updates to perform
        $submitterUpdateString = f00("UPDATE people set " . $submitterUpdates . " where personId = " . $_SESSION['submitterId']);
debugLogLineQuery($submitterUpdateString);
      $result = mysql_query($submitterUpdateString); 
debugLogLine("Update Query Finished -- result = " . $result); 
debugLogQuery($result, $submitterUpdateString);
    } // there are updates to perform
  }  // else submitter is already in table so update the record

  // INSERT OR UPDATE ENTRY in DB
  $submitterId = $_SESSION['submitterId']; // using $submitterId instead of $_SESSION['submitterId'] in SQL statements for convenience
  $originalFormat = ($_POST['OriginalFormat'] == "other") ? $_POST['OtherFormat'] : $_POST['OriginalFormat'];
  $workIdFromDB = $_SESSION['entryId'];
  if ($_SESSION['entryId'] == 0)  { // since this entry is not in the works table

    // INSERT ENTRY into WORKS TABLE
    $entryInsertString = f00("INSERT INTO works (title, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, webSite, "
       . "previouslyShownAt, photoCredits, submitter, callForEntries, howPaid, permissionsAtSubmission, lastModificationDate, lastModifiedBy) "
       . "VALUES (" . quote($_POST['FilmTitle']) . ", " . quote($_POST['ProductionYear']) . ", " . quote($runTime) . ", " . quote($_POST['SubmissionFormat']) . ", "
       . quote($originalFormat) . ", " . quote($_POST['Synopsis']) . ", " . quote($_POST['WebSite']) . ", " . quote($_POST['OtherFestivals']) . ", " 
       . quote($_POST['PhotoCredits']) . ", " . "'$submitterId', $callForEntriesId, '$_POST[Payment]', '$_POST[Permission]', NOW(), '$submitterId')");
debugLogLineQuery($entryInsertString);
    $result = mysql_query($entryInsertString); 
    $workIdFromDB = $_SESSION['entryId'] = ($result) ? mysql_insert_id() : 0; // This is the RIGHT way to get an AUTO-INCREMENT Id from a table
debugLogLine("Insert Query Finished -- result = " . $result); 
debugLogQuery($result, $entryInsertString);
debugLogLine("workIdFromDB = " . $_SESSION['entryId']);

    // and insert contributors into workContributors table
    for ($i = 1; $i <= 7; $i++) { insertContributor($workIdFromDB, $fixedRoles[$i], $_POST[$fixedRoles[$i]], 0); }
    if (($_POST['ContributorRole1'] != '') && ($_POST['ContributorName1'] != '')) 
      insertContributor($workIdFromDB, $_POST['ContributorRole1'], $_POST['ContributorName1'], 1);
    if (($_POST['ContributorRole2'] != '') && ($_POST['ContributorName2'] != ''))
      insertContributor($workIdFromDB, $_POST['ContributorRole2'], $_POST['ContributorName2'], 1);
  } else { // since this entry is already in the works table

    // UPDATE ENTRY in WORKS TABLE
    $entryUpdates = entryUpdates();
    if ($entryUpdates != '') { // there are updates to perform
      $entryUpdateString = f00("UPDATE works set " . $entryUpdates . " where workId = " . $_SESSION['entryId']);
debugLogLineQuery($entryUpdateString);
      $result = mysql_query($entryUpdateString); 
debugLogLine("Update Query Finished -- result = " . $result); 
debugLogQuery($result, $entryUpdateString);
    } // there are updates to perform

    // INSERT, UPDATE & DELETE CONTRIBUTORS IN DB

    // update all of the fixed contributors
    for ($i = 1; $i <= 7; $i++) { 
      $role = $fixedRoles[$i];
      $name = nameFromEntryFormFor($role);
debugLogLine("Updating Contributor for " . $role . " with |" . $name . "|"); 
      updateContributor($workIdFromDB, $role, $name); 
    }

    // find the optional contributors in the database
    $contributorSelectOptionalResult = selectContributors('optional');

    // if the name has changed for the role, update the record
    // if the name has been deleted for the role, delete the record
    // in any case, delete any db records where a contributorRole from the entry form does not match the contributorRole from the DB
    $roleProcessed = array();
    while ($row = mysql_fetch_array($contributorSelectOptionalResult)) { // entry in db
      $dbRole = $row['role'];
      $dbName = $row['name'];
      $workId = $row['work'];
      $roleProcessed[$dbRole] = false;
      if (($dbRole == '') || ($dbName == '')) $roleProcessed[$dbRole] = deleteContributor($row); // purge null contributors loitering in the DB
      if (!$roleProcessed[$dbRole]) 
        $roleProcessed[$dbRole] = 
                  contributorRoleProcessed($dbRole, $dbName, $_POST['ContributorRole1'], $_POST['ContributorName1'], $row);
      if (!$roleProcessed[$dbRole]) 
        $roleProcessed[$dbRole] = 
                  contributorRoleProcessed($dbRole, $dbName, $_POST['ContributorRole2'], $_POST['ContributorName2'], $row);
      if (!$roleProcessed[$dbRole]) 
        $roleProcessed[$dbRole] = deleteContributor($row); // This row in the DB did not match any contributor on the form.
    } // while

    // Now, are there any optional contributors on the form that were not in the DB. If so, insert them.
    if (($_POST['ContributorRole1'] != '') 
            && (!isset($roleProcessed[$_POST['ContributorRole1']]) || !$roleProcessed[$_POST['ContributorRole1']]))
      insertContributor($workIdFromDB, $_POST['ContributorRole1'], $_POST['ContributorName1'], 1);
    if (($_POST['ContributorRole2'] != '') 
            && (!isset($roleProcessed[$_POST['ContributorRole2']]) || !$roleProcessed[$_POST['ContributorRole2']]))
      insertContributor($workIdFromDB, $_POST['ContributorRole2'], $_POST['ContributorName2'], 1);
  } // else since this entry is already in the works table

  // Although unnecessary, READ the VALUES BACK FROM the DATABASE FOR DISPLAY
  
  // into $submitterRow
  $submitterSelectString = f00("SELECT name, phoneVoice, phoneFax, phoneMobile, email, organization, streetAddr1, streetAddr2, "
                         . "city, stateProvRegion, zipPostalCode, country, howHeardAboutUs FROM people WHERE personId = " . $submitterId);
debugLogLineQuery($submitterSelectString);
  $result = mysql_query($submitterSelectString); 
debugLogQuery($result, $submitterSelectString);
debugLogLine("Select Query Finished -- result = " . $result); 
  if ($result) $submitterRow = mysql_fetch_array($result);

  // and into $workRow
  $workSelectString = f00("SELECT title, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, "
       . " webSite, previouslyShownAt, photoCredits, howPaid, permissionsAtSubmission from works WHERE workId = " . $workIdFromDB);
debugLogLineQuery($workSelectString);
  $result = mysql_query($workSelectString); 
  if ($result) $workRow = mysql_fetch_array($result);
debugLogLine("Select Query Finished -- result = " . $result); 
debugLogQuery($result, $workSelectString);

  // and into contributorsArray
  $contributorSelectAllResult = selectContributors('all');

  // TODO to do: COPY VALUES INTO  SESSION VARIABLES ???
  
  // TODO to do: javascript phone number reformatter: http://www.propeller.com/viewstory/2007/03/31/javascript-phone-number-formatter/?url=http%3A%2F%2Fwww.foodry.com%2Fblog%2F2007%2F03%2F31%2Fjavascript-phone-number-formatter%2F&frame=true
  
/*
  TODO to do: Connie's bug reports 1/1/08
  
  The fields in which I used the dropdown leave a residual cursor at the end of the text.
  By residual cursor I mean a solid (not blinking and not active) vertical line.

  any time i use the Return key i get a popup box with this message:
  The page at http://sansoucifest.org says: Please re-enter email address
  After I re-enter email address and hit Return, the new message is:
  Please enter length of your film in minutes.

  since Password is not required, the Password field shoud say so: Password (optional)

  i Run Time, i entered 85 seconds to see what happens. the Confirmation Screen shows Run TIme 00:00:00
  Num should be restrticted to <60.
  
  TODO to do: Adam Griff's comments 1/2/08
  
  - overall, very impressed; liked separate windows for requirements information; liked minimal validation of entry form
  - when click on paypal, fill in the blanks in the paypal window
  - when a user signs on blank form, have message: if you're a returning user, go login again
  - When emailing forgotten pw to user (or when pw is incorrect), don't show the rest of the form


*/


?>
</td></tr>

<tr><td><table width="88%" align="center" cellspacing="0" cellpadding="0" border="0">
<tr><td class="entryFormSectionHeading">Thank you<hr class="horizontalSeparatorFull"></td></tr>
<tr>
  <td align="left" valign="top" class="bodyTextOnBlackRowPadded">Thanks for submitting your entry. We look forward to viewing it.<br>
    <ol><li class="noIndent">Please review the information below.</li>
      <li class="noIndent">To make any changes, click <a href="entryFormSignIn.php">here</a> and sign in again.</li>
      <li class="noIndent">Please print this page and enclose it with your media submission.</li>
      <li class="noIndent">Mail media to<blockquote><!-- #BeginLibraryItem "/Library/submissionAddress.lbi" -->
Sans Souci Festival of Dance Cinema<br>
Box 133<br>
1630-A 30th Street<br>
Boulder, CO 80301<br>
USA<!-- #EndLibraryItem --></blockquote>
      <?php if ($workRow['howPaid'] == "check") {echo "Don't forget to enclose your check or money order in US Dollars.<br>"; } ?></li>
      <li class="noIndent">For more information see our <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2009.html',
                          'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
                          entryRequirementsWindow.focus();">Entry Requirements</a>.</li>
</ol></td>
</tr>
<tr><td class="entryFormSectionHeading">Submitter Information<hr class="horizontalSeparatorFull"></td></tr>

<!-- initialize email report to home base -->
<?php 
// TODO to do: Emailing the data should be done as part of onSubmit in entryForm2008.php
          $to          = "entryform@sanssoucifest.org";
          $subject     = "Entry Form Submitted for " . $submitterRow['name'];
          $fieldNames  = "";
          $fieldValues = "";
          $message     = "";
          $headers     = "From: entryform@sanssoucifest.org" . "\r\n"
                       . "Reply-To: no-reply@sanssoucifest.org" . "\r\n"
                       . "X-Mailer: PHP/" . phpversion();
                       
                      
$message .= addDataItem('name', $submitterRow['name']); 
$message .= addDataItem('organization', $submitterRow['organization']); 
$message .= addDataItem('streetAddr1', $submitterRow['streetAddr1']); 
$message .= addDataItem('streetAddr2', $submitterRow['streetAddr2']); 
$message .= addDataItem('city', $submitterRow['city']); 
$message .= addDataItem('stateProvRegion', $submitterRow['stateProvRegion']); 
$message .= addDataItem('zipPostalCode', $submitterRow['zipPostalCode']); 
$message .= addDataItem('country', $submitterRow['country']); 
$message .= addDataItem('phoneVoice', $submitterRow['phoneVoice']); 
$message .= addDataItem('phoneMobile', $submitterRow['phoneMobile']); 
$message .= addDataItem('phoneFax', $submitterRow['phoneFax']); 
$message .= addDataItem('email', $submitterRow['email']); 
$message .= addDataItem('howHeardAboutUs', $submitterRow['howHeardAboutUs']); 
$message .= addDataItem('title', $workRow['title']); 
$message .= addDataItem('yearProduced', $workRow['yearProduced']); 
$message .= addDataItem('runTime', $workRow['runTime']); 
$message .= addDataItem('submissionFormat', $workRow['submissionFormat']); 
$message .= addDataItem('originalFormat', $workRow['originalFormat']); 
$message .= addDataItem('synopsisOriginal', $workRow['synopsisOriginal']); 
$message .= addDataItem('webSite', $workRow['webSite']); 
$message .= addDataItem('previouslyShownAt', $workRow['previouslyShownAt']); 
$message .= addDataItem('photoCredits', $workRow['photoCredits']); 
$message .= addDataItem('howPaid', $workRow['howPaid']); 
$message .= addDataItem('permissionsAtSubmission', $workRow['permissionsAtSubmission']); 
?>
<!-- initialize Submitter Information -->
<?php 
  $cityLineExists = false; 
  $telephonesExist = false; 
  $addressExists = (isset($submitterRow['streetAddr1']) && ($submitterRow['streetAddr1'] != '')
                 || (isset($submitterRow['streetAddr2']) && ($submitterRow['streetAddr2'] != ''))
                 || (isset($submitterRow['city']) && ($submitterRow['city'] != ''))
                 || (isset($submitterRow['stateProvRegion']) && ($submitterRow['stateProvRegion'] != ''))
                 || (isset($submitterRow['zipPostalCode']) && ($submitterRow['zipPostalCode'] != '')));
  $countryExists = (isset($submitterRow['country']) && ($submitterRow['country'] != ''));
?>
<!-- display Submitter Information -->
  <tr><td class="bodyTextOnBlackRowPadded"><?php echo $submitterRow['name'] . "<br>"; ?></td></tr>
  <?php if (isset($submitterRow['organization']) && ($submitterRow['organization'] != '')) { echo "<tr><td class='bodyTextOnBlack'>" . $submitterRow['organization'] . "</td></tr>"; } ?>
  <tr><td class="bodyTextOnBlackRowPadded">
    <?php if (!$addressExists && !$countryExists) echo "No address provided.<br>"; ?>
    <?php if (isset($submitterRow['streetAddr1']) && ($submitterRow['streetAddr1'] != '')) { echo $submitterRow['streetAddr1'] . "<br>"; } 
          if (isset($submitterRow['streetAddr2']) && ($submitterRow['streetAddr2'] != '')) { echo $submitterRow['streetAddr2'] . "<br>"; } 
          if (isset($submitterRow['city']) && ($submitterRow['city'] != '')) { $cityLineExists = true; echo $submitterRow['city'] . ", "; }; 
          if (isset($submitterRow['stateProvRegion']) && ($submitterRow['stateProvRegion'] != '')) { $cityLineExists = true; echo $submitterRow['stateProvRegion'] . " "; }
          if (isset($submitterRow['zipPostalCode']) && ($submitterRow['zipPostalCode'] != '')) { $cityLineExists = true; echo $submitterRow['zipPostalCode']; } 
          if ($cityLineExists && $countryExists) { echo "<br>"; }
          if ($countryExists) { echo $submitterRow['country']; }
    ?>
  </td></tr>
  <?php  ?>
  <tr><td class="bodyTextOnBlackRowPadded"><span class='filmInfoSubtitleText'>Telephones:</span>
    <?php if (isset($submitterRow['phoneVoice']) && ($submitterRow['phoneVoice'] != '')) { $telephonesExist = true; echo "<span class='filmInfoSubtitleText'> &nbsp;&nbsp;&nbsp;Voice: </span>" . $submitterRow['phoneVoice']; }
          if (isset($submitterRow['phoneMobile']) && ($submitterRow['phoneMobile'] != '')) { $telephonesExist = true; echo "<span class='filmInfoSubtitleText'> &nbsp;&nbsp;&nbsp;Mobile: </span>" . $submitterRow['phoneMobile']; }
          if (isset($submitterRow['phoneFax']) && ($submitterRow['phoneFax'] != '')) { $telephonesExist = true; echo "<span class='filmInfoSubtitleText'> &nbsp;&nbsp;&nbsp;Fax: </span>" . $submitterRow['phoneFax']; }
          if (!$telephonesExist) echo "No telephone numbers provided."; 
  ?>
  </td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Email: </span>" . $submitterRow['email'] . "<br>"; ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php if (isset($submitterRow['howHeardAboutUs']) && ($submitterRow['howHeardAboutUs'] != '')) { echo "<span class='filmInfoSubtitleText'>How you heard about us: </span>" . $submitterRow['howHeardAboutUs'] . "<br>"; } ?></td></tr>
<!-- <tr><td class="bodyTextOnBlackRowPadded">&nbsp;</td></tr> -->

<!-- display Entry Information -->
<tr><td class="entryFormSectionHeading">Entry Information<hr class="horizontalSeparatorFull"></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php echo $workRow['title'] . " (" . $workRow['yearProduced'] . ")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='filmInfoSubtitleText'>run time: </span>" . $workRow['runTime'] . "<br>"; ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Submitted as </span>" . $workRow['submissionFormat'] . "<span class='filmInfoSubtitleText'>. Originally recorded as </span>" . $workRow['originalFormat'] . ".<br>"; ?></td></tr>

<!-- display Contributor Information -->
<tr><td class="bodyTextOnBlackRowPadded"><span class='filmInfoSubtitleText'>Contributors:<br></span>
<?php
$rowsDisplayed = 0;
while ($contributorSelectAllResult && ($row = mysql_fetch_array($contributorSelectAllResult))) { 
  // handle email
  if (($row['role'] == 'Director') 
    || ($row['role'] == 'Producer') 
    || ($row['role'] == 'Choreographer') 
    || ($row['role'] == 'DanceCompany') 
    || ($row['role'] == 'PrincipalDancers') 
    || ($row['role'] == 'MusicComposition') 
    || ($row['role'] == 'MusicPerformance')) {
      $message .= addDataItem($row['role'], $row['name']); 
  } else if ($contributorRole1 == "") {
    $contributorRole1 = $row['role'];
    $message .= addDataItem('ContributorRole1', $contributorRole1);
    $message .= addDataItem('ContributorName1', $row['name']); 
  } else if ($contributorRole2 == "") {
    $contributorRole2 = $row['role'];
    $message .= addDataItem('ContributorRole2', $contributorRole2);
    $message .= addDataItem('ContributorName2', $row['name']); 
  }
  // handle display
  if ($row['name'] != '') {
    $rowsDisplayed++;
    echo "&nbsp;&nbsp;&nbsp;<span class='filmInfoSubtitleText'>" . $row['role'] .": </span>" . $row['name'] . "<br>";
  }
}

// handle email
if ($contributorRole1 == "") 
       $message .= addDataItem('ContributorRole1', $contributorRole1) . addDataItem('ContributorName1', '');
if ($contributorRole2 == "") 
       $message .= addDataItem('ContributorRole2', $contributorRole2) . addDataItem('ContributorName2', '');

// handle display
if ($rowsDisplayed == 0) echo "No contributors are listed.";

// log the mail headers for debugging
$insertString = "INSERT INTO emailHeadersLog (to, subject, headers, lastModificationDate, lastModifiedBy) "
					. "VALUES (" . quote($to) . ", " . quote($subject) . ", " . quote($headers) . ", NOW(), 0)";
debugLogLineQuery($insertString);
$result = mysql_query($insertString); 

// finish up by sending the mail to home base
$message .= "\r\n" . "\r\n" . $fieldNames . "\r\n" . $fieldValues;
$mailedData = mail($to, $subject, $message, $headers);
?>
</td></tr>
<!-- display the Rest of the Entry Information -->
<tr><td class="bodyTextOnBlackRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Synopsis: </span>" . $workRow['synopsisOriginal'] ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php if ( $workRow['webSite'] != '') echo "<span class='filmInfoSubtitleText'>Website: </span>" . $workRow['webSite'] ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php if ( $workRow['previouslyShownAt'] != '') echo "<span class='filmInfoSubtitleText'>Also shown at: </span>" . $workRow['previouslyShownAt'] ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php if ( $workRow['photoCredits'] != '') echo "<span class='filmInfoSubtitleText'>Photos by: </span>" . $workRow['photoCredits'] ?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Payment Information: </span>Paid via ";
if ($workRow['howPaid'] == "paypal") { echo "Paypal. (<a href='../paypal/index.html'>pay now</a>)<br>"; } else {echo "check or money order in US Dollars sent via post with media.<br>"; }
?></td></tr>
<tr><td class="bodyTextOnBlackRowPadded"><?php 
echo "<span class='filmInfoSubtitleText'>Release Information: </span>";
$releaseInfo = "You have certified that you hold all necessary rights for the submission of this entry and that you give Sans Souci "
             . "Festival permission for screening this submission at the Dairy Center for the Arts in Boulder Colorado USA on March 20 &amp; 21, 2009";
if ($workRow['permissionsAtSubmission'] == "allOK2009") { // << This should not be hard-coded
  $releaseInfo .= " and also at all tours associated with the 2009 Season in the US and elsewhere."; 
  }
else {
  $releaseInfo .= ". As we make such arrangements, we may invite you to each subsequent tour/venue separately so that you can respond to "
                . "each individually.";
  }
echo $releaseInfo . "<br><br><br>";
?></td></tr>
</table></td></tr>
<?php 
  // killSession(); See note in entryFormFunctions.php
?>
		  <tr><td align="center" valign="top" class="bodyTextOnBlack">&nbsp;</td></tr>
      </table>
      
<!-- InstanceEndEditable --></td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
            <?php SSFWebPageAssets::displayCopyrightLine();?></td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
<!-- InstanceEnd --></html>
