<!-- // entryFormFunctions.php -->

<?php

  $debugScript = false;
  
  function debugLog($string) { 
    global $debugScript; 
    if ($debugScript) echo $string; 
  }

  function debugLogLine($string) { 
    global $debugScript; 
    if ($debugScript) echo $string . "<br>"; 
  }

  function debugLogLineUn($string) { // unconditional
    echo $string . "<br>"; 
  }

  function debugLogLineQuery($string) { 
    global $debugScript; 
    if ($debugScript) echo "### " . $string . "<br>"; 
  }

  function debugLogLineQueryUn($string) { 
    echo "### " . $string . "<br>"; 
  }

  function debugLogLineDE($string) { if (false) debugLogLineUn(); }

  $debugQuery = true;

  function debugLogQuery($result, $queryString) { 
    global $debugQuery; 
    if ($debugQuery && ($result===false)) {
      echo "*** <span class='filmInfoSubtitleText'>" . substr($queryString, 0, 30) . "...</span> Query failed. Result = |" . $result . "|<br>"; 
      echo "     " . $queryString . "<br>"; 
    }
  }

  function debugLogQueryUn($result, $queryString) { 
		echo "*** <span class='filmInfoSubtitleText'>" . substr($queryString, 0, 30) . "...</span> Query failed. Result = |" . $result . "|<br>"; 
		echo "     " . $queryString . "<br>"; 
  }

  // Here's a real hack. I put in all these calls to mysql_real_escape_string() which does not
  // work properly. So, in the code I changed all occurances of mysql_real_escape_string() to f00
  // which returns the string input. Use f00 for values in UPDATE and INSERT statements.
  function f00($string) { return $string; }
  
  // Use to insert string values that may contain a single quote into the database.
  // Returns the string input surrounded by single quotes and escaping (,i.e., \') embedded quotes
  // Also strip leading and trailing white space.
  function quote($string) {
//    mysql_real_escape_string()
    $stringSansEscapeCharacters = str_replace("\\", "", $string); // strip out the backslashes
    return "'" . str_replace("'", "\'", trim($stringSansEscapeCharacters)) . "'";
  }

  // Connects, verifies, sets globals $openError and $openErrorMessage.
  // Returns true on success. Returns false and kills the session on failure.
  function connectToDB() {
    global $openError;
    global $openErrorMessage;
debugLogLine("Connecting to DB");
    $connection = mysql_connect("mysql.sanssoucifest.org","sanssouci","minniekitty");
debugLogLine("Connection result = " . $connection);
    if ($connection) { 
      $result = mysql_select_db("sanssoucitestbed"); // <<<<<<<<<<<<<<<<<<<<<<
debugLogLine("mysql_select_db result = " . $result);
      return $result;
    } else { // since connection failed
      $openError = true; 
      $openErrorMessage = "Sorry!<br>There has been an internal error."
                        . "<br>Please close this window or go to the <a href='../index.html'>home page</a> and sign in again."
                        . "<br>If you continue to have difficulty, send <a "
                        . "href='mailto:entryForm@sanssoucifest.org?subject=Trouble with entry form&body=The problem is described below:'>email</a> "
                        . "and describe the problem or "
                        . "download and use the <a href='../SansSouci2008EntryForm01.pdf'>PDF form.</a><br>";
debugLogLine('Could not connect to DB: ' . mysql_errno($connection) . ": " . mysql_error($connection)); 
        die('Could not connect to DB: ' . mysql_errno($connection) . ": " . mysql_error($connection) . '<br>'); 
        killSession();
        return false;
      } // !connection
    }
    
  // Calls connectToDB() if 'Submit' button was pressed.
  function checkSubmitButtonAndCnnectToDB() {
    global $openError;
    global $openErrorMessage;
  // TODO to do: more error checking may be needed here.
debugLogLine("POST[Submit] = " . $_POST['Submit']); 
    if ($_POST['Submit']) {
      return connectToDB();
    }
    else { // Submit button was not clicked.
      $openError = true; 
      $openErrorMessage = "Sorry!<br>There has been an error. You may have opened the Entry Form in multiple windows."
                        . "<br>Please close this window or go to the <a href='../index.html'>home page</a> and sign in again.<br>";
//      killSession();
      return false;
debugLogLine("Submit button was NOT clicked"); 
    }
  }

  // returns vsprintf("%.2u:%.2u:%.2s",array($hours,$minutesModHours,$seconds))
  function formattedRunTimeString($minutes, $seconds) {
    $hours = floor($minutes/60);
    $minutesModHours = $minutes%60;
    $string = vsprintf("%.2u:%.2u:%.2s",array($hours,$minutesModHours,$seconds));
    $string = str_replace("'", "", $string); // strip embedded single quotes
    return $string;
  }

  // returns $stringToAddTo . ', ' . $stringToAdd but only uses the comma if $stringToAddTo != ''
  function addCommaDelimitedText($stringToAddTo, $stringToAdd) { 
    if ($stringToAddTo != '') $stringToAddTo .= ", ";
    $stringToAddTo .= $stringToAdd;
    return $stringToAddTo;
  }

  // returns $stringToAddTo . ',' . $stringToAdd but only uses the comma if $stringToAddTo != ''
  function addCommaDelimitedTextNoSpaces($stringToAddTo, $stringToAdd) { 
    if ($stringToAddTo != '') $stringToAddTo .= ",";
    $stringToAddTo .= $stringToAdd;
    return $stringToAddTo;
  }

  // Returns a name/value pair in the form 'Name: Value' and side-effects the globals
  // $fieldNames & $fieldValues by appending $name and $value respectively with appropriate commas and no spaces
  function addDataItem($name, $value) {
    global $fieldNames, $fieldValues;
    $fieldNames = addCommaDelimitedTextNoSpaces($fieldNames, $name);
    $fieldValues = addCommaDelimitedTextNoSpaces($fieldValues, '"'.$value.'"');
    $nameValuePair = ($name . ": \"" . $value . "\"\r\n");
    return $nameValuePair;
  }
  
// TODO todo: prevent reinsertion of data into tables in entryFormSubmitted by using the hidden submitterId in the form.
// Write function submitterId() to return the $_SESSION['submitterId'] or the $_POST['submitterId'] 
// Change the uses of $_SESSION['submitterId'] to be calls to submitterId()
// *** Changes I made here did not solve the problem of losing the SESSION data when the
//     submittedEntryForm is displayed. I finally just removed the killSession() in 
//     submittedEntryForm.php and that did the trick. BUT, now pressing the browser's
//     back button and then hitting submit again can create multiple entries for the same
//     person or work in the DB. PROBLEM STILL NOT SOLVED.
  
  // Returns a valid submitterId or 0  
  function submitterId() {
    global $submitterId;
    if (isValidDbKey($_SESSION['submitterId'])) return $_SESSION['submitterId'];
    else if (isValidDbKey($_POST['submitterId'])) return $_POST['submitterId'];
    else if (isValidDbKey($submitterId)) return $submitterId;
    else return 0;
  }

  function isValidDbKey($key) {
    return (isset($key) && ($key != '') && ($key != '0') && ($key != '\0') && ($key > 0));
  }

// TODO: Rework to do the right thing.
  function submitterInPeopleTable() {
    return submitterId();
  }

/*  
 function submitterInPeopleTable() {
    return (isset($_SESSION['submitterId']) 
        && ($_SESSION['submitterId'] != '') 
        && ($_SESSION['submitterId'] != 0) 
        && ($_SESSION['submitterId'] != '0'));
  }
*/

  function getCallForEntriesIdFromName($callForEntriesName) {
debugLogLine("POST[CallForEntriesName] = " . $_POST['CallForEntriesName']);
    $callIdQuery = "SELECT callId FROM callsForEntries WHERE name = '" . $callForEntriesName . "'";
debugLogLineQuery($callIdQuery);
    $result = mysql_query($callIdQuery);
debugLogLine("Select Query Finished -- result = " . $result); 
debugLogQuery($result, $callIdQuery);
    if ($result && ($row = mysql_fetch_array($result))) { $callForEntriesId = $row['callId']; } 
    else { $callForEntriesId = 0; }
debugLogLine("CallForEntriesId = " . $callForEntriesId);
    return $callForEntriesId;
  }
  
  // Returns the db row for the person designated by $emailAddress or false
  function getSubmitterRowFromDB($emailAddress) {
    // Check to see if the Submitter is in the DB
    $selectString = "SELECT personId, name, loginName, password, phoneVoice, phoneFax, phoneMobile, email, organization, streetAddr1, streetAddr2, "
  		              . "city, stateProvRegion, zipPostalCode, country, howHeardAboutUs, lastModificationDate FROM people WHERE loginName = '" . $emailAddress . "'";
debugLogLineQuery($selectString);
      $result = mysql_query($selectString);
debugLogLine("Select Query Finished -- result = " . $result); 
debugLogQuery($result, $selectString);
  	if ($result && ($row = mysql_fetch_array($result))) { // submitter in db
  	  // *** SIDE-EFFECT $_SESSION['submitterId'] by setting it ***
      $_SESSION['submitterId'] = $row['personId'];
  	  return $row;
  	} else {
      $_SESSION['submitterId'] = 0;
  	  return 0;
  	}
  }
  
  // Returns a mysql_fetch_array() of contributors (as designated by 'all', 'fixed', or 'optional').
  function selectContributors($allFixedOptional) {
    $optionalString = '';
    if (($allFixedOptional) == 'all') $optionalString = '';
    else if (($allFixedOptional) == 'fixed') $optionalString = ' AND optionalContributor = 0';
    else if (($allFixedOptional) == 'optional') $optionalString = ' AND optionalContributor = 1';
    $selectContributorString = f00("SELECT work, contributorOrder, name, role FROM workContributors"
                             . " WHERE work = " . $_SESSION['entryId'] . $optionalString 
                             . " ORDER BY contributorOrder");
debugLogLine("selectContributorString = " . $selectContributorString);
    $contributorSelectResult = mysql_query($selectContributorString);
debugLogLine("Select Query Finished -- result = " . $contributorSelectResult); 
    return $contributorSelectResult;
  }
  
  // Returns a mysql_fetch_array() of contributors (as designated by 'all', 'fixed', or 'optional').
  function selectContributorsFor($entryId, $allFixedOptional) {
    $optionalString = '';
    if (($allFixedOptional) == 'all') $optionalString = '';
    else if (($allFixedOptional) == 'fixed') $optionalString = ' AND optionalContributor = 0';
    else if (($allFixedOptional) == 'optional') $optionalString = ' AND optionalContributor = 1';
    $selectContributorString = f00("SELECT work, contributorOrder, name, role FROM workContributors"
                             . " WHERE work = " . $entryId . $optionalString 
                             . " ORDER BY contributorOrder");
debugLogLine("selectContributorString = " . $selectContributorString);
    $contributorSelectResult = mysql_query($selectContributorString);
debugLogLine("Select Query Finished -- result = " . $contributorSelectResult); 
    return $contributorSelectResult;
  }
  
  // Returns a string in the form 'name1=value1, ... '  for any values of entries modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each entry field).
  function entryUpdates() {
    $updatesString = '';
    if ($_POST['FilmTitle'] != $_SESSION['FilmTitle']) { $updatesString = addCommaDelimitedText($updatesString, 'title = ' . quote($_POST['FilmTitle'])); }
    if ($_POST['ProductionYear'] != $_SESSION['ProductionYear']) { $updatesString = addCommaDelimitedText($updatesString, 'yearProduced = ' . quote($_POST['ProductionYear'])); }
    if (($_POST['RunTimeMinutes'] != $_SESSION['RunTimeMinutes']) ||
        ($_POST['RunTimeSeconds'] != $_SESSION['RunTimeSeconds'])) { 
      $runTime = formattedRunTimeString($_POST[RunTimeMinutes], $_POST[RunTimeSeconds]);
      $updatesString = addCommaDelimitedText($updatesString, 'runTime = ' . quote($runTime)); 
    }
    if ($_POST['SubmissionFormat'] != $_SESSION['SubmissionFormat']) { $updatesString = addCommaDelimitedText($updatesString, 'submissionFormat = ' . quote($_POST['SubmissionFormat'])); }
    if (($_POST['OriginalFormat'] != $_SESSION['OriginalFormat']) ||
        ($_POST['OtherFormat'] != $_SESSION['OtherFormat'])) { 
      $originalFormat = ($_POST['OriginalFormat'] == "other") ? $_POST['OtherFormat'] : $_POST['OriginalFormat'];
      $updatesString = addCommaDelimitedText($updatesString, 'originalFormat = ' . quote($originalFormat)); 
    }
    if ($_POST['OtherFestivals'] != $_SESSION['OtherFestivals']) { $updatesString = addCommaDelimitedText($updatesString, 'previouslyShownAt = ' . quote($_POST['OtherFestivals'])); }
    if ($_POST['PhotoCredits'] != $_SESSION['PhotoCredits']) { $updatesString = addCommaDelimitedText($updatesString, 'photoCredits = ' . quote($_POST['PhotoCredits'])); }
    if ($_POST['WebSite'] != $_SESSION['WebSite']) { $updatesString = addCommaDelimitedText($updatesString, 'webSite = ' . quote($_POST['WebSite'])); }
    if ($_POST['Synopsis'] != $_SESSION['Synopsis']) { $updatesString = addCommaDelimitedText($updatesString, 'synopsisOriginal = ' . quote($_POST['Synopsis'])); }
    if ($_POST['Payment'] != $_SESSION['Payment']) { $updatesString = addCommaDelimitedText($updatesString, 'howPaid = \'' . $_POST['Payment']) . '\''; }
    if ($_POST['Permission'] != $_SESSION['Permission']) { $updatesString = addCommaDelimitedText($updatesString, 'permissionsAtSubmission = \'' . $_POST['Permission']) . '\''; }
    if ($updatesString != '') {
      $updatesString = addCommaDelimitedText($updatesString, 'lastModificationDate = NOW()');
      $updatesString = addCommaDelimitedText($updatesString, 'lastModifiedBy = ' . $_SESSION['submitterId']);
    }
  return $updatesString;
  }

  // $roleProcessed = array() is defined in submittedEntryForm.php

  // Inserts contributor into database and sets if global $roleProcessed[$row['role']] = true if successful
  // TODO return $result;
  function insertContributor($workId, $role, $name, $optionalContributor) {
    global $roleProcessed;
    $insertContributorString = f00("INSERT INTO workContributors (work, optionalContributor, role, name, lastModificationDate, lastModifiedBy) "
                             . "VALUES (" . $workId . ", " . $optionalContributor . ", " . quote($role) . ", " . quote($name) . ", NOW(), " . $_SESSION['submitterId'] . ")");
debugLogLineQuery($insertContributorString);
    $result = mysql_query($insertContributorString); 
debugLogLine("Insert Query Finished -- result = " . $result); 
debugLogQuery($result, $insertContributorString);
    if ($result) $roleProcessed[$row['role']] = true;
  }

  // Updates contributor in database returning the result of mysql_query()
  // and sets if global $roleProcessed[$row['role']] = true if successful
  function updateContributorFromRow($row) {
    global $roleProcessed;
    $contributorUpdateString = f00("UPDATE workContributors set name = " . quote($row['name']) . ", lastModificationDate = NOW() where work = " 
                              . $row['work'] . " and role = " . quote($row['role']));
debugLogLineQuery($contributorUpdateString);
    $result = mysql_query($contributorUpdateString); 
debugLogLine("Contributor Update From Row Query Finished -- result = " . $result); 
debugLogQuery($result, $contributorUpdateString);
    if ($result) $roleProcessed[$row['role']] = true;
  }

  // Updates contributor in database and returns the result of mysql_query()
  // and sets if global $roleProcessed[$row['role']] = true if successful
  function updateContributor($workId, $role, $name) {
    $contributorUpdateString = "UPDATE workContributors set name = " . quote($name) . ", lastModificationDate = NOW() where work = " 
                              . $workId . " and role = " . quote($role);
debugLogLineQuery($contributorUpdateString);
    $result = mysql_query($contributorUpdateString); 
debugLogLine("Contributor Update Query Finished -- result = " . $result); 
debugLogQuery($result, $contributorUpdateString);
    if ($result) $roleProcessed[$role] = true;
    return $result;
  }

  // Deletes contributor from database returning the result of mysql_query()
  function deleteContributor($row) {
    $contributorDeleteString = f00("DELETE FROM workContributors where work = " . $row['work'] . " AND contributorOrder = " . $row['contributorOrder']);
debugLogLineQuery($contributorDeleteString);
    $result = mysql_query($contributorDeleteString); 
debugLogLine("Delete Query Finished -- result = " . $result); 
debugLogQuery($result, $contributorDeleteString);
    return $result;
  }

  // TODO: Figure out what this does
 function contributorRoleProcessed($dbRole, $dbName, $formRole, $formName, $row) {
   $roleProcessed = false;
    if ($dbRole == $formRole) { 
      $roleProcessed = true;
      if ($formName == '') { 
debugLogLine("Deleting Contributor: dbRole:" . $dbRole . "; dbName:" . $dbName . "; formRole:"  . $formRole . "; formName:" . $formName . ";"); 
        deleteContributor($row); 
      }
      else if ($formName != $dbName) {
        updateContributor($row['work'], $dbRole, $formName);
        //updateContributorFromRow($row);
      } // if ($formName != $dbName)
    } // if ($dbRole == $formRole)
    return $roleProcessed;
  }
    
  // Reutrns the contributor name for $role based on $_POST field values
  function nameFromEntryFormFor($role) {
    if ($role == 'Director') return $_POST['Director'];
    else if ($role == 'Producer') return $_POST['Producer'];
    else if ($role == 'Choreographer') return $_POST['Choreographer'];
    else if ($role == 'DanceCompany') return $_POST['DanceCompany'];
    else if ($role == 'PrincipalDancers') return $_POST['PrincipalDancers'];
    else if ($role == 'MusicComposition') return $_POST['MusicComposition'];
    else if ($role == 'MusicPerformance') return $_POST['MusicPerformance'];
  }

  // Returns a string in the form 'name1=value1, ... '  for any values of submitters modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each submitter field).
  function submitterUpdates() {
    $updatesString = '';
    if ($_POST['SubmitterName'] != $_SESSION['SubmitterName']) { $updatesString = addCommaDelimitedText($updatesString, 'name = ' . quote($_POST['SubmitterName'])); }
    if ($_POST['SubmitterEmail'] != $_SESSION['emailFromDB']) { 
      $updatesString = addCommaDelimitedText($updatesString, 'email = ' . quote($_POST['SubmitterEmail'])); 
      $updatesString = addCommaDelimitedText($updatesString, 'loginName = ' . quote($_POST['SubmitterEmail'])); 
      }
    if ($_POST['SubmitterPassword'] != $_SESSION['SubmitterPassword']) { $updatesString = addCommaDelimitedText($updatesString, 'password = ' . quote($_POST['SubmitterPassword'])); }
    if ($_POST['SubmitterPhoneVoice'] != $_SESSION['SubmitterPhoneVoice']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneVoice = ' . quote($_POST['SubmitterPhoneVoice'])); }
    if ($_POST['SubmitterPhoneMobile'] != $_SESSION['SubmitterPhoneMobile']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneMobile = ' . quote($_POST['SubmitterPhoneMobile'])); }
    if ($_POST['SubmitterPhoneFax'] != $_SESSION['SubmitterPhoneFax']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneFax = ' . quote($_POST['SubmitterPhoneFax'])); }
    if ($_POST['SubmitterOrganization'] != $_SESSION['SubmitterOrganization']) { $updatesString = addCommaDelimitedText($updatesString, 'organization = ' . quote($_POST['SubmitterOrganization'])); }
    if ($_POST['SubmitterAddress1'] != $_SESSION['SubmitterAddress1']) { $updatesString = addCommaDelimitedText($updatesString, 'streetAddr1 = ' . quote($_POST['SubmitterAddress1'])); }
    if ($_POST['SubmitterAddress2'] != $_SESSION['SubmitterAddress2']) { $updatesString = addCommaDelimitedText($updatesString, 'streetAddr2 = ' . quote($_POST['SubmitterAddress2'])); }
    if ($_POST['SubmitterCity'] != $_SESSION['SubmitterCity']) { $updatesString = addCommaDelimitedText($updatesString, 'city = ' . quote($_POST['SubmitterCity'])); }
    if ($_POST['SubmitterState'] != $_SESSION['SubmitterState']) { $updatesString = addCommaDelimitedText($updatesString, 'stateProvRegion = ' . quote($_POST['SubmitterState'])); }
    if ($_POST['SubmitterPostalCode'] != $_SESSION['SubmitterPostalCode']) { $updatesString = addCommaDelimitedText($updatesString, 'zipPostalCode = ' . quote($_POST['SubmitterPostalCode'])); }
    if ($_POST['SubmitterCountry'] != $_SESSION['SubmitterCountry']) { $updatesString = addCommaDelimitedText($updatesString, 'country = ' . quote($_POST['SubmitterCountry'])); }
    if ($_POST['SubmitterHowHeard'] != $_SESSION['SubmitterHowHeard']) { $updatesString = addCommaDelimitedText($updatesString, 'howHeardAboutUs = ' . quote($_POST['SubmitterHowHeard'])); }
    if ($updatesString != '') {
      $updatesString = addCommaDelimitedText($updatesString, 'lastModificationDate = NOW()');
      $updatesString = addCommaDelimitedText($updatesString, 'lastModifiedBy = ' . $_SESSION['submitterId']);
    }
  return $updatesString;
  }

  // Returns the text value of the Other original format field based on $_SESSION["OriginalFormat"]
  function getTextForOtherOriginalFormatField() {
    $text = "";
    if ( ($_SESSION["OriginalFormat"]=="selectSomething") 
      || ($_SESSION["OriginalFormat"]=="miniDV")
      || ($_SESSION["OriginalFormat"]=="16mm")
      || ($_SESSION["OriginalFormat"]=="8mm") 
      || ($_SESSION["OriginalFormat"]=="super8") 
      || ($_SESSION["OriginalFormat"]=="hi8") 
      || ($_SESSION["OriginalFormat"]=="DVCAM") 
      || ($_SESSION["OriginalFormat"]=="HD") 
      || ($_SESSION["OriginalFormat"]=="HDV") 
      || ($_SESSION["OriginalFormat"]=="videoTape3-4") 
      || ($_SESSION["OriginalFormat"]=="motionCapture") 
      || ($_SESSION["OriginalFormat"]=="digitalAnimation")
      || ($_SESSION["OriginalFormat"]=="stopActionAnimation")) {
        $text = ""; 
    }
    else { 
      $text = $_SESSION["OriginalFormat"]; 
    }
    return $text;
  }

  // Executes session_destroy() and destroys the $_SESSION array excpet for $_SESSION['submitterId']
  function killSession() {
    // Destroy the session data (except for the sumbitterId)
    session_start();
    $submitterId = $_SESSION['submitterId'];
    $_SESSION = array();
    // If it's desired to kill the session, also delete the session cookie.
debugLogLine("In killSession(): session_name = " . session_name());     
debugLogLine("In killSession(): SESSION[submitterId] = " . $_SESSION['submitterId']);     
    //if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
    // Finally, destroy the session and then restore the submitterId
    session_destroy();
    $_SESSION['submitterId'] = $submitterId;
debugLogLine("In killSession(): DESTROYED " . session_name());     
debugLogLine("In killSession(): session_name = " . session_name());     
debugLogLine("In killSession(): SESSION[submitterId] = " . $_SESSION['submitterId']);     
  }

/* NOTES:

  // This is the WRONG way to get an AUTO-INCREMENT Id from a table
  $result = mysql_query("SELECT personId FROM people WHERE loginName = '$_POST[SubmitterEmail]'");
  $row = mysql_fetch_array($result);
  $submitterId = $row['personId'];

<!-- DISPLAY the RESULTS in submittedEntryForm.php -->
<!--
Submitter Information
  Name
  Organization
  Street Address
  City, State/Province PostalCode, Country
  Telephones: Voice: Mobile: Fax:  	
  Email Address: 
  How you heard about Sans Souci Festival: 
EntryInformation
  Submission Format: 
  Original Format: 
  Director: 
  Producer: 	
  Choreographer:  	
  Dance Company: 
  Principal Dancers: 
  Music Composition: 
  Music Performance: 
  Role:   Name:  
  Role:   Name:
  Other Festivals Shown: 	
  Photo Credits: 	
  Web Site: 	
  Brief Synopsis: 	
  Payment Information: Paypal | Check or money order in US Dollars sent via post with media
  Release Information: You have certified that you hold all necessary rights for the submission of this entry and that you give 
      Sans Souci Festival permission for screening this submission at the Dairy Center for the Arts in Boulder Colorado USA on March 20 &amp; 21, 2009 
      [and also all tours associated with the 2008 Season in the US and elsewhere]. | [As we make such arrangements, we will invite you to 
      each tour/venue separately so that you can respond to each individually.]
-->

// To test:
// select workId, title, callForEntries, submitter, yearProduced, website from works
// select workId, lastModificationDate, title from works where title='20' and yearProduced='1998'
// update works set howPaid='check' where workId=1 

// while($row = mysql_fetch_array($result)) { echo $row['FirstName'] . " " . $row['LastName']; echo "<br />"; }

*/
?>

