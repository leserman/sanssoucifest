<?php session_start() ?>

<!-- // dataEntryFunctions.php -->

<?php

  // Use to insert string values that may contain a single quote into the database.
  // Returns the string input surrounded by single quotes and escaping (,i.e., \') embedded quotes
  function stripEsc($string) {
    $stringSansEscapeCharacters = str_replace("\\", "", $string); // strip out the backslashes
    return trim($stringSansEscapeCharacters);
  }


  // Returns the db row for the person designated by $emailAddress or false
  // TODO: merge getSubmitterRowFromDB with this
  function getPersonRowFromDBWithEmailLoginId($emailAddress) {
    // Check to see if the Submitter is in the DB
    $selectString = "SELECT personId, name, lastName, nickName, loginName, password, phoneVoice, phoneFax, phoneMobile, email, "
                   . "organization, streetAddr1, streetAddr2, city, stateProvRegion, zipPostalCode, country, webSites, "
                   . "recordType, relationship, role, notifyOf, "
  		             . "howHeardAboutUs, notes, lastModificationDate FROM people WHERE loginName = '" . $emailAddress . "'";
    debugLogLineQuery($selectString);
    $result = mysql_query($selectString);
    debugLogLine("Select Query Finished -- result = " . $result); 
    debugLogQuery($result, $selectString);
  	if ($result && ($row = mysql_fetch_array($result))) return $row;
  	else return FALSE;
  }
  
  // Returns the db row for the person designated by $emailAddress or false
  // TODO: merge getSubmitterRowFromDB with this
  function getPersonRowFromDBWithEmail($emailAddress) {
    // Check to see if the Submitter is in the DB
    $selectString = "SELECT personId, name, lastName, nickName, loginName, password, phoneVoice, phoneFax, phoneMobile, email, "
                   . "organization, streetAddr1, streetAddr2, city, stateProvRegion, zipPostalCode, country, webSites, "
                   . "recordType, relationship, role, notifyOf, "
  		             . "howHeardAboutUs, notes, lastModificationDate FROM people WHERE email = '" . $emailAddress . "'";
    debugLogLineQuery($selectString);
    $result = mysql_query($selectString);
    debugLogLine("Select Query Finished -- result = " . $result); 
    debugLogQuery($result, $selectString);
  	if ($result && ($row = mysql_fetch_array($result))) return $row;
  	else return FALSE;
  }
  
  function userIsStaff($row) {
    if ((stripos($row['relationship'], 'SansSouciDirector') === FALSE)
      && (stripos($row['relationship'], 'SansSouciStaff') === FALSE)) return FALSE;
    else return TRUE;
  }

// Returns the db row for the person designated by $personId or false
  function getPersonRowFromDBWithId($personId) {
    // Check to see if the Submitter is in the DB
    $selectString = "SELECT personId, name, lastName, nickName, loginName, password, phoneVoice, phoneFax, phoneMobile, email, "
                   . "organization, streetAddr1, streetAddr2, city, stateProvRegion, zipPostalCode, country, webSites, "
  		             . "howHeardAboutUs, notes, lastModificationDate FROM people WHERE personId = '" . $personId . "'";
    debugLogLineQuery($selectString);
    $result = mysql_query($selectString);
    debugLogLine("Select Query Finished -- result = " . $result); 
    debugLogQuery($result, $selectString);
  	if ($result && ($row = mysql_fetch_array($result))) return $row;
  	else return 0;
  }
  
  // Returns the db row for the entry designated by $entryId or false
  // TODO BUG this function returns only the first row found
  function getEntryRowsFromDBWithSubmitterId($submitterId) {
    if ($submitterId == 0) return 0;
    $callForEntriesId = getCallForEntriesIdFromName($_POST['CallForEntriesName']); // Changed 8/17/08: Was $_SESSION['CallForEntriesName'] 
    $callForEntriesWhereClause = ($callForEntriesId > 0) ? (" AND callForEntries = " . $callForEntriesId) : "" ;
    $selectWorkString = "SELECT workId, title, designatedId, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, "
                      . "webSite, previouslyShownAt, photoCredits, submitter, callForEntries, howPaid, permissionsAtSubmission, "
                      . "lastModificationDate, checkOrPaypalNumber, datePaid, dateMediaReceived, amtPaid, photoLocation, submissionNotes "
                      . "FROM works WHERE submitter = $submitterId " . $callForEntriesWhereClause;
    debugLogLineQuery($selectWorkString);
    $result = mysql_query($selectWorkString);
    debugLogLine("Select Query Finished -- result = " . $result); 
    debugLogQuery($result, $selectWorkString);
  	if ($result && ($entryRow = mysql_fetch_array($result))) return $entryRow;
  	else return 0;
  }
  
  // Returns the db row for the entry designated by $entryId or false
  function getEntryRowFromDBWithEntryId($entryId) {
    if ($entryId == 0) return 0;
    $selectWorkString = "SELECT workId, title, designatedId, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, "
                      . "webSite, previouslyShownAt, photoCredits, submitter, callForEntries, howPaid, permissionsAtSubmission, "
                      . "lastModificationDate, checkOrPaypalNumber, datePaid, dateMediaReceived, amtPaid, photoLocation, submissionNotes "
                      . "FROM works WHERE workId = $entryId";
    debugLogLineQuery($selectWorkString);
    $result = mysql_query($selectWorkString);
    debugLogLine("Select Query Finished -- result = " . $result); 
//    debugLogQuery($result, $selectWorkString);
  	if ($result && ($entryRow = mysql_fetch_array($result))) return $entryRow;
  	else return 0;
  }
  
  function resetSessionEntryVariables() {
    // entry attributes
    $_SESSION['entryId'] = 0; // Special
    $_SESSION['FilmTitle'] = '';
    $_SESSION['DesignatedId'] = ''; 
    $_SESSION['ProductionYear'] = '';
    $_SESSION['RunTimeMinutes'] = '';
    $_SESSION['RunTimeSeconds'] = '';
    $_SESSION['SubmissionFormat'] = '';
    $_SESSION['OriginalFormat'] = '';
    $_SESSION['OtherFormat'] = '';
    $_SESSION['OtherFestivals'] = '';
    $_SESSION['PhotoCredits'] = '';
    $_SESSION['WebSite'] = '';
    $_SESSION['Synopsis'] = '';
    $_SESSION['Payment'] = 'paypal';
    $_SESSION['Permission'] = 'allOK2009';
    $_SESSION['CheckNo'] = '';
    $_SESSION['DatePaid'] = '';
    $_SESSION['AmtPaid'] = '';
    $_SESSION['DateMediaReceived'] = '';
    $_SESSION['PhotoLocation'] = '';
    $_SESSION['SubmissionNotes'] = '';
    // TODO: Does this work here?
    $_SESSION['CallForEntriesName'] = $_POST['CallForEntriesName']; // Changed 8/17/08 
    // Changed 8/17/08: Was $_SESSION['CallForEntriesName'] = 'BMoCA200804'; 
    $_SESSION['WorkLastModified'] = 0;
    
      // entry contributors
    $_SESSION['Director'] = '';
    $_SESSION['Producer'] = '';
    $_SESSION['Choreographer'] = '';
    $_SESSION['DanceCompany'] = '';
    $_SESSION['PrincipalDancers'] = '';
    $_SESSION['MusicComposition'] = '';
    $_SESSION['MusicPerformance'] = '';
    $_SESSION['ContributorRole1'] = '';
    $_SESSION['ContributorName1'] = '';
    $_SESSION['ContributorRole2'] = '';
    $_SESSION['ContributorName2'] = '';
    $_SESSION['contributorArray'] = array(); // Special
    $_SESSION['maxContributorOrder'] = 0; // Special
  }
  
  function postedSubmitterIsNonNull() {
    $postedSubmitterIsNonNull = (
      (isset($_POST['SubmitterName']) && ($_POST['SubmitterName'] != '')) ||
      (isset($_POST['SubmitterNickName']) && ($_POST['SubmitterNickName'] != '')) ||
      (isset($_POST['SubmitterLastName']) && ($_POST['SubmitterLastName'] != '')) ||
      (isset($_POST['SubmitterPassword']) && ($_POST['SubmitterPassword'] != '')) ||
      (isset($_POST['SubmitterEmail']) && ($_POST['SubmitterEmail'] != '')) ||
      (isset($_POST['SubmitterOrganization']) && ($_POST['SubmitterOrganization'] != '')) ||
      (isset($_POST['SubmitterAddress1']) && ($_POST['SubmitterAddress1'] != '')) ||
      (isset($_POST['SubmitterAddress2']) && ($_POST['SubmitterAddress2'] != '')) ||
      (isset($_POST['SubmitterCity']) && ($_POST['SubmitterCity'] != '')) ||
      (isset($_POST['SubmitterState']) && ($_POST['SubmitterState'] != '')) ||
      (isset($_POST['SubmitterPostalCode']) && ($_POST['SubmitterPostalCode'] != '')) ||
      (isset($_POST['SubmitterCountry']) && ($_POST['SubmitterCountry'] != '')) ||
      (isset($_POST['SubmitterPhoneVoice']) && ($_POST['SubmitterPhoneVoice'] != '')) ||
      (isset($_POST['SubmitterPhoneMobile']) && ($_POST['SubmitterPhoneMobile'] != '')) ||
      (isset($_POST['SubmitterPhoneFax']) && ($_POST['SubmitterPhoneFax'] != '')) ||
      (isset($_POST['SubmitterHowHeard']) && ($_POST['SubmitterHowHeard'] != '')) ||
      (isset($_POST['Notes']) && ($_POST['Notes'] != '')) ||
      (isset($_POST['WebSites']) && ($_POST['WebSites'] != ''))
      );
    return $postedSubmitterIsNonNull;
  }
  
  function resetSessionSubmitterVariables() {
      // submitter attributes
    $_SESSION['submitterId'] = 0; // Special
    $_SESSION['SubmitterName'] = '';
    $_SESSION['SubmitterNickName'] = '';
    $_SESSION['SubmitterLastName'] = '';
    $_SESSION['SubmitterPassword'] = '';
    $_SESSION['SubmitterEmail'] = '';
    $_SESSION['SubmitterOrganization'] = '';
    $_SESSION['SubmitterAddress1'] = '';
    $_SESSION['SubmitterAddress2'] = '';
    $_SESSION['SubmitterCity'] = '';
    $_SESSION['SubmitterState'] = '';
    $_SESSION['SubmitterPostalCode'] = '';
    $_SESSION['SubmitterCountry'] = '';
    $_SESSION['SubmitterPhoneVoice'] = '';
    $_SESSION['SubmitterPhoneMobile'] = '';
    $_SESSION['SubmitterPhoneFax'] = '';
    $_SESSION['SubmitterHowHeard'] = '';
    $_SESSION['Notes'] = '';
    $_SESSION['WebSites'] = '';
    $_SESSION['SubmitterLastModified'] = 0; // Special
    $_SESSION['emailFromDB'] = ''; // Special
    $_SESSION['pwFromDB'] = ''; // Special
  }
  
  function resetSessionVariables() {
    resetSessionSubmitterVariables();
    resetSessionEntryVariables();
    // special (not data entry) variables initialized elsewhere
      // State
        // $_SESSION['state'] = 'justSignedIn';
      // User
        // $_SESSION['userRecord'] = $row;
        // $_SESSION['userId'] = $row['personId']; 
      // Submittter
        // $_SESSION['submitterId'] = 0;
        // $_SESSION['SubmitterLastModified'] = 0;
        // $_SESSION['emailFromDB'] = ''; // Special
        // $_SESSION['pwFromDB'] = ''; // Special
      // Entry  
        // $_SESSION['entryId'] = 0;
        // $_SESSION['contributorArray'] = array();
        // $_SESSION['maxContributorOrder'] = 0;
        }
  
  function initializeSessionVariablesFromPost() {
      // special variables
      //$_SESSION['submitterId'] = 0;
      //$_SESSION['entryId'] = 0;
      $_SESSION['contributorArray'] = array();
      $_SESSION['maxContributorOrder'] = 0;

      // submitter attributes
      $_SESSION['SubmitterName'] = stripEsc($_POST['SubmitterName']);
      $_SESSION['SubmitterNickName'] = stripEsc($_POST['SubmitterNickName']);
      $_SESSION['SubmitterLastName'] = stripEsc($_POST['SubmitterLastName']);
      $_SESSION['SubmitterPassword'] = stripEsc($_POST['SubmitterPassword']);
      $_SESSION['SubmitterEmail'] = stripEsc($_POST['SubmitterEmail']);
      $_SESSION['SubmitterOrganization'] = stripEsc($_POST['SubmitterOrganization']);
      $_SESSION['SubmitterAddress1'] = stripEsc($_POST['SubmitterAddress1']);
      $_SESSION['SubmitterAddress2'] = stripEsc($_POST['SubmitterAddress2']);
      $_SESSION['SubmitterCity'] = stripEsc($_POST['SubmitterCity']);
      $_SESSION['SubmitterState'] = stripEsc($_POST['SubmitterState']);
      $_SESSION['SubmitterPostalCode'] = stripEsc($_POST['SubmitterPostalCode']);
      $_SESSION['SubmitterCountry'] = stripEsc($_POST['SubmitterCountry']);
      $_SESSION['SubmitterPhoneVoice'] = stripEsc($_POST['SubmitterPhoneVoice']);
      $_SESSION['SubmitterPhoneMobile'] = stripEsc($_POST['SubmitterPhoneMobile']);
      $_SESSION['SubmitterPhoneFax'] = stripEsc($_POST['SubmitterPhoneFax']);
      $_SESSION['SubmitterHowHeard'] = stripEsc($_POST['SubmitterHowHeard']);
      $_SESSION['Notes'] = stripEsc($_POST['Notes']);
      $_SESSION['WebSites'] = stripEsc($_POST['WebSites']);
      $_SESSION['SubmitterLastModified'] = stripEsc($_POST['SubmitterLastModified']);

      // entry attributes
      $_SESSION['FilmTitle'] = stripEsc($_POST['FilmTitle']);
      $_SESSION['DesignatedId'] = stripEsc($_POST['DesignatedId']); 
      $_SESSION['ProductionYear'] = stripEsc($_POST['ProductionYear']);
      $_SESSION['RunTimeMinutes'] = stripEsc($_POST['RunTimeMinutes']);
      $_SESSION['RunTimeSeconds'] = stripEsc($_POST['RunTimeSeconds']);
      $_SESSION['SubmissionFormat'] = stripEsc($_POST['SubmissionFormat']);
      $_SESSION['OriginalFormat'] = stripEsc($_POST['OriginalFormat']);
      $_SESSION['OtherFormat'] = stripEsc($_POST['OtherFormat']);
      $_SESSION['OtherFestivals'] = stripEsc($_POST['OtherFestivals']);
      $_SESSION['PhotoCredits'] = stripEsc($_POST['PhotoCredits']);
      $_SESSION['WebSite'] = stripEsc($_POST['WebSite']);
      $_SESSION['Synopsis'] = stripEsc($_POST['Synopsis']);
      $_SESSION['Payment'] = stripEsc($_POST['Payment']);
      $_SESSION['Permission'] = stripEsc($_POST['Permission']);
      $_SESSION['CheckNo'] = stripEsc($_POST['CheckNo']);
      $_SESSION['DatePaid'] = stripEsc($_POST['DatePaid']);
      $_SESSION['AmtPaid'] = stripEsc($_POST['AmtPaid']);
      $_SESSION['DateMediaReceived'] = stripEsc($_POST['DateMediaReceived']);
      $_SESSION['PhotoLocation'] = stripEsc($_POST['PhotoLocation']);
      $_SESSION['SubmissionNotes'] = stripEsc($_POST['SubmissionNotes']);
      $_SESSION['CallForEntriesName'] = $_POST['CallForEntriesName']; // Changed 8/17/08
      // Changed 8/17/08: Was $_SESSION['CallForEntriesName'] = 'BMoCA200804';
      $_SESSION['WorkLastModified'] = $_POST['WorkLastModified'];
    
      // entry contributors
      $_SESSION['Director'] = stripEsc($_POST['Director']);
      $_SESSION['Producer'] = stripEsc($_POST['Producer']);
      $_SESSION['Choreographer'] = stripEsc($_POST['Choreographer']);
      $_SESSION['DanceCompany'] = stripEsc($_POST['DanceCompany']);
      $_SESSION['PrincipalDancers'] = stripEsc($_POST['PrincipalDancers']);
      $_SESSION['MusicComposition'] = stripEsc($_POST['MusicComposition']);
      $_SESSION['MusicPerformance'] = stripEsc($_POST['MusicPerformance']);
      $_SESSION['ContributorRole1'] = stripEsc($_POST['ContributorRole1']);
      $_SESSION['ContributorName1'] = stripEsc($_POST['ContributorName1']);
      $_SESSION['ContributorRole2'] = stripEsc($_POST['ContributorRole2']);
      $_SESSION['ContributorName2'] = stripEsc($_POST['ContributorName2']);
  }
  
  function initializeSessionSubmitterVariablesFromDB($submitterId) {
    $_SESSION['priorSessionId'] = session_id();
    resetSessionVariables();
    $personRow = getPersonRowFromDBWithId($submitterId);
    if ($personRow) {
      // The Submitter is in the DB and there was no openError, 
      // so initialize session submitter attributes from the database
      $_SESSION['submitterId'] = $personRow['personId']; 
      $_SESSION['emailFromDB'] = $personRow['email']; 
      $_SESSION['pwFromDB'] = $personRow['password']; 
      $_SESSION['SubmitterName'] = $personRow['name']; 
      $_SESSION['SubmitterOrganization'] = $personRow['organization']; 
      $_SESSION['SubmitterAddress1'] = $personRow['streetAddr1']; 
      $_SESSION['SubmitterAddress2'] = $personRow['streetAddr2']; 
      $_SESSION['SubmitterCity'] = $personRow['city']; 
      $_SESSION['SubmitterState'] = $personRow['stateProvRegion']; 
      $_SESSION['SubmitterPostalCode'] = $personRow['zipPostalCode']; 
      $_SESSION['SubmitterCountry'] = $personRow['country']; 
      $_SESSION['SubmitterPhoneVoice'] = $personRow['phoneVoice']; 
      $_SESSION['SubmitterPhoneMobile'] = $personRow['phoneMobile']; 
      $_SESSION['SubmitterPhoneFax'] = $personRow['phoneFax']; 
      $_SESSION['SubmitterHowHeard'] = $personRow['howHeardAboutUs']; 
      $_SESSION['Notes'] = $personRow['notes']; 
      $_SESSION['SubmitterPassword'] = $personRow['password']; 
      $_SESSION['SubmitterLastModified'] = $personRow['lastModificationDate']; 
      $_SESSION['SubmitterNickName']  = $personRow['nickName']; 
      $_SESSION['SubmitterLastName'] = $personRow['lastName']; 
      $_SESSION['SubmitterPassword'] = $personRow['password']; 
      $_SESSION['SubmitterEmail'] = $personRow['email']; 
      $_SESSION['WebSites'] = $personRow['webSites']; 
    }
  }

  function initializeSessionEntryVariablesFromDB($entryId) {
    // SET SESSION CallForEntriesId and CallForEntriesName which is needed to access the works DB
    debugLogLineDE("initializeSessionEntryVariablesFromDB entryId = |" . $entryId . "|");
    $_SESSION['callForEntriesName'] = $_POST['CallForEntriesName']; // changed 8/17/08: this line added; 
    $_SESSION['CallForEntriesId'] = getCallForEntriesId();
  	if ($entryRow = getEntryRowFromDBWithEntryId($entryId)) {
	    $_SESSION['entryRecord'] = $entryRow;
  		$_SESSION['entryId'] = $entryRow['workId']; 
      $_SESSION['FilmTitle'] = $entryRow['title']; 
      $_SESSION['DesignatedId'] = $entryRow['designatedId']; 
      $_SESSION['ProductionYear'] = $entryRow['yearProduced']; 
      debugLogLine("row[runTime] = " . $entryRow['runTime']);
      list($hours, $minutes, $seconds) = explode(":", $entryRow['runTime']);
      $_SESSION['RunTimeMinutes'] = (60 * $hours) + $minutes; 
      //debugLogLine("SESSION[RunTimeMinutes] = " . $_SESSION['RunTimeMinutes']);
      $_SESSION['RunTimeSeconds'] = $seconds;
      $_SESSION['SubmissionFormat'] = $entryRow['submissionFormat']; 
      $_SESSION['OriginalFormat'] = $entryRow['originalFormat']; 
      $_SESSION["OtherFormat"] = getTextForOtherOriginalFormatField();
      $_SESSION['OtherFestivals'] = $entryRow['previouslyShownAt']; 
      $_SESSION['PhotoCredits'] = $entryRow['photoCredits']; 
      $_SESSION['WebSite'] = $entryRow['webSite']; 
      $_SESSION['Synopsis'] = $entryRow['synopsisOriginal']; 
      $_SESSION['Payment'] = $entryRow['howPaid']; 
      $_SESSION['Permission'] = $entryRow['permissionsAtSubmission'];
      $_SESSION['CheckNo'] = $entryRow['checkOrPaypalNumber'];
      $_SESSION['AmtPaid']  = $entryRow['amtPaid'];
      $_SESSION['DatePaid']  = $entryRow['datePaid'];
      $_SESSION['DateMediaReceived'] = $entryRow['dateMediaReceived'];
      $_SESSION['PhotoLocation'] = $entryRow['photoLocation'];
      $_SESSION['SubmissionNotes'] = $entryRow['submissionNotes'];
      // $_SESSION['CallForEntriesId'] = $entryRow['callForEntries']; changed 8/17/08: commented out; 
      $_SESSION['WorkLastModified'] = $entryRow['lastModificationDate']; 

      // Get the work contributors from the workContributors table and set SESSION variables
      $contributorSelectResult = selectContributors('all');
      $maxContributorOrder = 0;
      while ($contributorSelectResult && ($contributorRow = mysql_fetch_array($contributorSelectResult))) { // entry in db
  	    $maxContributorOrder = ($contributorRow['contributorOrder'] > $maxContributorOrder) ? $contributorRow['contributorOrder'] : $maxContributorOrder;
        if ($contributorRow['role'] == 'Director') $_SESSION['Director'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'Producer') $_SESSION['Producer'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'Choreographer') $_SESSION['Choreographer'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'DanceCompany') $_SESSION['DanceCompany'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'PrincipalDancers') $_SESSION['PrincipalDancers'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'MusicComposition') $_SESSION['MusicComposition'] = $contributorRow['name'];
        else if ($contributorRow['role'] == 'MusicPerformance') $_SESSION['MusicPerformance'] = $contributorRow['name'];
        else if ($_SESSION['ContributorRole1'] == "") {
          $_SESSION['ContributorRole1'] = $contributorRow['role'];
          $_SESSION['ContributorName1'] = $contributorRow['name'];
        } else if ($_SESSION['ContributorRole2'] == "") {
          $_SESSION['ContributorRole2'] = $contributorRow['role'];
          $_SESSION['ContributorName2'] = $contributorRow['name'];
        } // else if
      } // while
      if ($contributorSelectResult) $_SESSION['contributorArray'] = $contributorSelectResult;
      $_SESSION['maxContributorOrder'] = $maxContributorOrder;
  	} // entry in db
  }

  function validateUser($userRow, $userPwFromLogin) {
    global $openErrorMessage;
    $validUser = true;
  		if (!$userRow) {
        // User is not in the DB. Make them login again.
        $validUser = false;
        $openErrorMessage = "You are not authorized to edit or view the data. Maybe you entered your Login Id incorrectly."
                          . "<br>Please go to the <a href='index.html'>data entry page</a> and try again.<br>";
  		}
  		else { // user in db
        debugLogLine("User Id = " .  $userRow['personId'] . ";  email from db = " . $userRow['email']);
        // TODO - later check to see if this User in the DB is actually authorized for editing.
        // Check that the password matches the database
        if (($userRow['password'] != '') && ($userRow['password'] != $userPwFromLogin)) { 
          // User entered incorrect non-blank password. Make them login again.
          $validUser = false;
          $openErrorMessage = "The password you entered does not match your Sign In Email Address."
                            . "<br>Please go to the <a href='index.html'>data entry page</a> and try again.<br>";
        } else if (($_SESSION['pwFromLogin']=='') && ($_SESSION['pwFromDB'] != '')) { 
          // User entered blank password that does not match the DB.
          $validUser = false;
          debugLogLine('<br> $mailedPassword = ' . $mailedPassword . '<br>' . $to . '<br>' . $subject . '<br>' . $headers . '<br>' . $message . '<br><br>');
          $openErrorMessage = "You did not enter your password. ";
          $openErrorMessage .= "<br>Please go to the <a href='index.html'>data entry page</a> and try again.<br>";
          // TODO to do: FIX ERROR where user cannot return to submission form after bad password.
        }
    return $validUser;
    }  
  }
  
  // Returns a string in the form 'name1=value1, ... '  for any values of entries modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each entry field).
  function entryUpdates2() {
    $updatesString = '';
    if ($_POST['FilmTitle'] != $_SESSION['FilmTitle']) { $updatesString = addCommaDelimitedText($updatesString, 'title = ' . quote($_POST['FilmTitle'])); }
    if ($_POST['DesignatedId'] != $_SESSION['DesignatedId']) { $updatesString = addCommaDelimitedText($updatesString, 'designatedId = ' . quote($_POST['DesignatedId'])); }
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
    if ($_POST['PhotoLocation'] != $_SESSION['PhotoLocation']) { $updatesString = addCommaDelimitedText($updatesString, 'photoLocation = ' . quote($_POST['PhotoLocation'])); }
    if ($_POST['WebSite'] != $_SESSION['WebSite']) { $updatesString = addCommaDelimitedText($updatesString, 'webSite = ' . quote($_POST['WebSite'])); }
    if ($_POST['Synopsis'] != $_SESSION['Synopsis']) { $updatesString = addCommaDelimitedText($updatesString, 'synopsisOriginal = ' . quote($_POST['Synopsis'])); }
    if ($_POST['Payment'] != $_SESSION['Payment']) { $updatesString = addCommaDelimitedText($updatesString, 'howPaid = \'' . $_POST['Payment']) . '\''; }
    if ($_POST['Permission'] != $_SESSION['Permission']) { $updatesString = addCommaDelimitedText($updatesString, 'permissionsAtSubmission = \'' . $_POST['Permission']) . '\''; }
    if ($_POST['CheckNo'] != $_SESSION['CheckNo']) { $updatesString = addCommaDelimitedText($updatesString, 'checkOrPaypalNumber = \'' . $_POST['CheckNo']) . '\''; }
    if ($_POST['DatePaid'] != $_SESSION['DatePaid']) { $updatesString = addCommaDelimitedText($updatesString, 'datePaid = \'' . $_POST['DatePaid']) . '\''; }
    if ($_POST['AmtPaid'] != $_SESSION['AmtPaid']) { $updatesString = addCommaDelimitedText($updatesString, 'amtPaid = \'' . $_POST['AmtPaid']) . '\''; }
    if ($_POST['DateMediaReceived'] != $_SESSION['DateMediaReceived']) { $updatesString = addCommaDelimitedText($updatesString, 'dateMediaReceived = \'' . $_POST['DateMediaReceived']) . '\''; }
    if ($_POST['SubmissionNotes'] != $_SESSION['SubmissionNotes']) { $updatesString = addCommaDelimitedText($updatesString, 'submissionNotes = \'' . $_POST['SubmissionNotes']) . '\''; }
    if ($updatesString != '') {
      $updatesString = addCommaDelimitedText($updatesString, 'lastModificationDate = NOW()');
      $updatesString = addCommaDelimitedText($updatesString, 'lastModifiedBy = ' . $_SESSION['userId']);
    }
  return $updatesString;
  }

  // Inserts an new person in the database from the $_POST array and returns $workIdFromDB
  function insertPerson() {
      $lastName = quote(lastNameFromName($_POST['SubmitterName']));
      $peopleInsertString = "INSERT INTO people (name, loginName, lastName, password, phoneVoice, phoneMobile, phoneFax, email, organization, streetAddr1, "
                                       . "streetAddr2, city, stateProvRegion, zipPostalCode, country, howHeardAboutUs, notes, lastModificationDate, "
                                       . "lastModifiedBy) "
              . "VALUES (" . quote($_POST['SubmitterName']) . ", " . quote($_POST['SubmitterEmail']) . ", $lastName, " . quote($_POST['SubmitterPassword']) 
              . ", " . quote($_POST['SubmitterPhoneVoice']) . ", " . quote($_POST['SubmitterPhoneMobile']) . ", " . quote($_POST['SubmitterPhoneFax']) . ", " 
              . quote($_POST['SubmitterEmail']) . ", " . quote($_POST['SubmitterOrganization']) . ", " . quote($_POST['SubmitterAddress1']) . ", " 
              . quote($_POST['SubmitterAddress2']) . ", " . quote($_POST['SubmitterCity']) . ", " . quote($_POST['SubmitterState']) . ", " 
              . quote($_POST['SubmitterPostalCode']) . ", " . quote($_POST['SubmitterCountry']) . ", " . quote($_POST['SubmitterHowHeard']) . ", "
              . quote($_POST['Notes']) . ", NOW(), " . $_SESSION['userId'] . ")";
      debugLogLineQuery($peopleInsertString);
      $result = mysql_query($peopleInsertString); 
      $personId = ($result) ? mysql_insert_id() : 0;  // This is the RIGHT way to get an AUTO-INCREMENT Id from a table
      debugLogLine("Insert Query Finished -- result = " . $result); 
      debugLogQuery($result, $peopleInsertString);
      debugLogLine("SubmitterId from DB = " . $_SESSION['submitterId']);
      return $personId;
  }
  
  // Inserts an new entry in the database from the $_POST array and returns $workIdFromDB
  function insertEntry() {
    // initialize convenience variables
    $submitterId = $_SESSION['submitterId']; 
    $originalFormat = ($_POST['OriginalFormat'] == "other") ? stripEsc($_POST['OtherFormat']) : $_POST['OriginalFormat'];
    $workIdFromDB = $_SESSION['entryId'];
    $userId = $_SESSION['userId'];
    // Assuming that, by now, $_SESSION['CallForEntriesName']) has been initialized from $_POST['CallForEntriesName'] - changed 8/17/08: comment added
    $callForEntriesId = getCallForEntriesIdFromName($_SESSION['CallForEntriesName']);
    
    // compute run time
    $runTime = formattedRunTimeString(stripEsc($_POST[RunTimeMinutes]), stripEsc($_POST[RunTimeSeconds]));
    
    // INSERT ENTRY into WORKS TABLE
     $entryInsertString = "INSERT INTO works (title, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, webSite, "
       . "previouslyShownAt, photoCredits, photoLocation, submitter, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, "
       . "permissionsAtSubmission, designatedId, dateMediaReceived, submissionNotes, lastModificationDate, lastModifiedBy) "
       . "VALUES (" . quote($_POST['FilmTitle']) . ", " . quote($_POST['ProductionYear']) . ", " . quote($runTime) . ", " . quote($_POST['SubmissionFormat'])
        . ", " . quote($originalFormat) . ", " . quote($_POST['Synopsis']) . ", " . quote($_POST['WebSite']) . ", " . quote($_POST['OtherFestivals']) . ", " 
       . quote($_POST['PhotoCredits']) . ", " . quote($_POST['PhotoLocation']) . ", '$submitterId', $callForEntriesId, " . quote($_POST['DatePaid']) . ", " 
       . quote($_POST['AmtPaid']) . ", " . "'$_POST[Payment]', " . quote($_POST['CheckNo']) . ", '$_POST[Permission]', " . quote($_POST['DesignatedId']) 
       . ", " . quote($_POST['DateMediaReceived']) . ", " . quote($_POST['SubmissionNotes']) . ", NOW(), '$userId')";
    debugLogLineQuery($entryInsertString);
    $entryResult = mysql_query($entryInsertString); 
    $workIdFromDB = $_SESSION['entryId'] = ($entryResult) ? mysql_insert_id() : 0; // This is the RIGHT way to get an AUTO-INCREMENT Id from a table
    debugLogLine("Insert Query Finished -- result = " . $entryResult); 
    debugLogQuery($entryResult, $entryInsertString);
    debugLogLine("workIdFromDB = " . $_SESSION['entryId']);

    // initialize fixed role titles
    $fixedRoles[1] = 'Director';
    $fixedRoles[2] = 'Producer';
    $fixedRoles[3] = 'Choreographer';
    $fixedRoles[4] = 'DanceCompany';
    $fixedRoles[5] = 'PrincipalDancers';
    $fixedRoles[6] = 'MusicComposition';
    $fixedRoles[7] = 'MusicPerformance';
    $nRoles = $nFixedRoles = 7;

    // and insert contributors into workContributors table
    // TODO set $contributorResult = $contributorResult || insertContributor($...
    $contributorResult = false;
    for ($i = 1; $i <= 7; $i++) { insertContributor($workIdFromDB, $fixedRoles[$i], $_POST[$fixedRoles[$i]], 0); }
    if ((stripEsc($_POST['ContributorRole1']) != '') && (stripEsc($_POST['ContributorName1']) != '')) 
      insertContributor($workIdFromDB, stripEsc($_POST['ContributorRole1']), stripEsc($_POST['ContributorName1']), 1);
    if ((stripEsc($_POST['ContributorRole2']) != '') && (stripEsc($_POST['ContributorName2']) != ''))
      insertContributor($workIdFromDB, stripEsc($_POST['ContributorRole2']), stripEsc($_POST['ContributorName2']), 1);
      
   return $workIdFromDB;
  }
  
  function updatePerson() {
    // submitter is not in the db so do inserts
    $updatePerformed = false;
    $submitterUpdates = submitterUpdates2();
    // update submitter in people table
    if ($submitterUpdates != '') { // there are updates to perform
      $submitterUpdateString = "UPDATE people set " . $submitterUpdates . " where personId = " . $_SESSION['submitterId'];
      debugLogLineQuery($submitterUpdateString);
      $result = mysql_query($submitterUpdateString); 
      debugLogLine("Update Query Finished -- result = " . $result); 
      debugLogQuery($result, $submitterUpdateString);
      if ($result) $updatePerformed = true;
    }
    return $updatePerformed;
  }
  
  function updateEntry() {
    $workResult = false;
    $entryUpdates = entryUpdates2();
    if ($entryUpdates != '') { // there are updates to perform
      $entryUpdateString = "UPDATE works set " . $entryUpdates . " where workId = " . $_SESSION['entryId'];
      debugLogLineQuery($entryUpdateString);
      $workResult = mysql_query($entryUpdateString); 
      debugLogLine("Update Query Finished -- result = " . $workResult); 
      debugLogQuery($workResult, $entryUpdateString);
    } // there are updates to perform

    // INSERT, UPDATE & DELETE CONTRIBUTORS IN DB

    // initialize fixed role titles
    $fixedRoles[1] = 'Director';
    $fixedRoles[2] = 'Producer';
    $fixedRoles[3] = 'Choreographer';
    $fixedRoles[4] = 'DanceCompany';
    $fixedRoles[5] = 'PrincipalDancers';
    $fixedRoles[6] = 'MusicComposition';
    $fixedRoles[7] = 'MusicPerformance';
    $nRoles = $nFixedRoles = 7;

    // update all of the fixed contributors
    $contributorFixedResult = false;
    for ($i = 1; $i <= 7; $i++) { 
      $role = $fixedRoles[$i];
      $name = nameFromEntryFormFor($role);
      debugLogLine("Updating Contributor for " . $role . " with |" . $name . "|"); 
      $theResult = updateContributor($_SESSION['entryId'], $role, $name);
      $contributorFixedResult = $contributorFixedResult ||  $theResult;
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
                  contributorRoleProcessed($dbRole, $dbName, stripEsc($_POST['ContributorRole1']), stripEsc($_POST['ContributorName1']), $row);
      if (!$roleProcessed[$dbRole]) 
        $roleProcessed[$dbRole] = 
                  contributorRoleProcessed($dbRole, $dbName, stripEsc($_POST['ContributorRole2']), stripEsc($_POST['ContributorName2']), $row);
      if (!$roleProcessed[$dbRole]) 
        $roleProcessed[$dbRole] = deleteContributor($row); // This row in the DB did not match any contributor on the form.
    } // while

    // Now, are there any optional contributors on the form that were not in the DB. If so, insert them.
    if ((stripEsc($_POST['ContributorRole1']) != '') 
            && (!isset($roleProcessed[stripEsc($_POST['ContributorRole1'])]) || !$roleProcessed[stripEsc($_POST['ContributorRole1'])]))
      insertContributor($_SESSION['entryId'], stripEsc($_POST['ContributorRole1']), stripEsc($_POST['ContributorName1']), 1);
    if ((stripEsc($_POST['ContributorRole2']) != '') 
            && (!isset($roleProcessed[stripEsc($_POST['ContributorRole2'])]) || !$roleProcessed[stripEsc($_POST['ContributorRole2'])]))
      insertContributor($_SESSION['entryId'], stripEsc($_POST['ContributorRole2']), stripEsc($_POST['ContributorName2']), 1);
      
    return ($workResult || $contributorFixedResult || $contributorSelectOptionalResult);
  }
  
  function saveSubmission() {
    $savedSubmission = false;
    $savedEntry = false;
    if (postedSubmitterIsNonNull()) { // avoid saving a null submission
			if ($_SESSION['submitterId'] == 0) { // submitter is not in DB
				$insertedPersonId = insertPerson();
				$_SESSION['submitterId'] = $insertedPersonId;
				if (stripEsc($_POST['FilmTitle']) != '') {
					$insertedEntryId = insertEntry();
					$_SESSION['entryId'] = $insertedEntryId;
					$savedSubmission = true; // TODO set $savedSubmission to insertEntry when that works
				}
			}
			else { // since submitter is in DB
				if (updatePerson()) $savedSubmission = true;
				if (($_SESSION['entryId'] == 0) && (stripEsc($_POST['FilmTitle']) != '')) {  // entry is not in DB
					insertEntry();
					$savedEntry = true; // TODO set $savedEntry to insertEntry when that works
				}
				else if (stripEsc($_POST['FilmTitle']) != '') {  // since entry is in DB
					debugLogLineDE("trim(POST[FilmTitle]) = |" . stripEsc($_POST['FilmTitle']) . "|");
					updateEntry();
					$savedEntry = true; // TODO set $savedEntry to updateEntry when that works
				}
			}
			// send email if anything was saved
			if ($savedSubmission || $savedEntry) sendDbUpdateEmail();
    }
  }
  
  function sendDbUpdateEmail() {
    global $fieldNames;
    global $fieldValues;
    
    // Although unnecessary, READ the VALUES BACK FROM the DATABASE FOR THIS EMAIL
    $submitterRow = getPersonRowFromDBWithId($_SESSION['submitterId']);

    // and into $workRow
    $workIdFromDB = $_SESSION['entryId'];
    $workRow = getEntryRowFromDBWithEntryId($workIdFromDB);

    // and into contributorsArray
    $contributorSelectAllResult = selectContributors('all');

    $messageSubject = "Entry Form submitted for " . $submitterRow['name'] . ", " . $workRow['title'];
    
    $to          = "entryform@sanssoucifest.org";
    $subject     = $messageSubject;
    $fieldNames  = "";
    $fieldValues = "";
    $message     = $messageSubject . "\r\n\r\n";
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
    $message .= addDataItem('notes', $submitterRow['notes']); 
    $message .= addDataItem('title', $workRow['title']); 
    $message .= addDataItem('designatedId', $workRow['designatedId']); 
    $message .= addDataItem('yearProduced', $workRow['yearProduced']); 
    $message .= addDataItem('runTime', $workRow['runTime']); 
    $message .= addDataItem('submissionFormat', $workRow['submissionFormat']); 
    $message .= addDataItem('originalFormat', $workRow['originalFormat']); 
    $message .= addDataItem('synopsisOriginal', $workRow['synopsisOriginal']); 
    $message .= addDataItem('webSite', $workRow['webSite']); 
    $message .= addDataItem('previouslyShownAt', $workRow['previouslyShownAt']); 
    $message .= addDataItem('photoCredits', $workRow['photoCredits']); 
    $message .= addDataItem('photoLocation', $workRow['photoLocation']); 
    $message .= addDataItem('amtPaid', $workRow['amtPaid']); 
    $message .= addDataItem('datePaid', $workRow['datePaid']); 
    $message .= addDataItem('checkOrPaypalNumber', $workRow['checkOrPaypalNumber']); 
    $message .= addDataItem('dateMediaReceived', $workRow['dateMediaReceived']); 
    $message .= addDataItem('submissionNotes', $workRow['submissionNotes']); 
    $message .= addDataItem('howPaid', $workRow['howPaid']); 
    $message .= addDataItem('permissionsAtSubmission', $workRow['permissionsAtSubmission']); 
    
    $contributorSelectAllResult = selectContributors('all');
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
    }
  if ($contributorRole1 == "") 
       $message .= addDataItem('ContributorRole1', $contributorRole1) . addDataItem('ContributorName1', '');
  if ($contributorRole2 == "") 
       $message .= addDataItem('ContributorRole2', $contributorRole2) . addDataItem('ContributorName2', '');

  // finish up by sending the mail to home base
  $message .= "\r\n" . "\r\n" . $fieldNames . "\r\n" . $fieldValues;
  $mailedData = mail($to, $subject, $message, $headers);
  }

  function lastNameFromName($name) {
    //$charCount = strlen($name);
    //$spaceIndex = strpos($name, ' ');
    //return substr(stripEsc($_POST['SubmitterName']), $spaceIndex);
    return trim(strrchr(stripEsc($_POST['SubmitterName']), ' '));
  }

  // Returns a string in the form 'name1=value1, ... '  for any values of submitters modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each submitter field).
  function submitterUpdates2() {
    $updatesString = '';
    if (stripEsc($_POST['SubmitterName']) != $_SESSION['SubmitterName']) { 
      $updatesString = addCommaDelimitedText($updatesString, 'name = ' . quote($_POST['SubmitterName'])); 
      $updatesString = addCommaDelimitedText($updatesString, 'lastName = ' . quote(lastNameFromName($_POST['SubmitterName']))); 
      }
    if (stripEsc($_POST['SubmitterEmail']) != $_SESSION['SubmitterEmail']) { 
      $updatesString = addCommaDelimitedText($updatesString, 'email = ' . quote($_POST['SubmitterEmail'])); 
      $updatesString = addCommaDelimitedText($updatesString, 'loginName = ' . quote($_POST['SubmitterEmail'])); 
      }
    if (stripEsc($_POST['SubmitterPassword']) != $_SESSION['SubmitterPassword']) { $updatesString = addCommaDelimitedText($updatesString, 'password = ' . quote($_POST['SubmitterPassword'])); }
    if (stripEsc($_POST['SubmitterPhoneVoice']) != $_SESSION['SubmitterPhoneVoice']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneVoice = ' . quote($_POST['SubmitterPhoneVoice'])); }
    if (stripEsc($_POST['SubmitterPhoneMobile']) != $_SESSION['SubmitterPhoneMobile']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneMobile = ' . quote($_POST['SubmitterPhoneMobile'])); }
    if (stripEsc($_POST['SubmitterPhoneFax']) != $_SESSION['SubmitterPhoneFax']) { $updatesString = addCommaDelimitedText($updatesString, 'phoneFax = ' . quote($_POST['SubmitterPhoneFax'])); }
    if (stripEsc($_POST['SubmitterOrganization']) != $_SESSION['SubmitterOrganization']) { $updatesString = addCommaDelimitedText($updatesString, 'organization = ' . quote($_POST['SubmitterOrganization'])); }
    if (stripEsc($_POST['SubmitterAddress1']) != $_SESSION['SubmitterAddress1']) { $updatesString = addCommaDelimitedText($updatesString, 'streetAddr1 = ' . quote($_POST['SubmitterAddress1'])); }
    if (stripEsc($_POST['SubmitterAddress2']) != $_SESSION['SubmitterAddress2']) { $updatesString = addCommaDelimitedText($updatesString, 'streetAddr2 = ' . quote($_POST['SubmitterAddress2'])); }
    if (stripEsc($_POST['SubmitterCity']) != $_SESSION['SubmitterCity']) { $updatesString = addCommaDelimitedText($updatesString, 'city = ' . quote($_POST['SubmitterCity'])); }
    if (stripEsc($_POST['SubmitterState']) != $_SESSION['SubmitterState']) { $updatesString = addCommaDelimitedText($updatesString, 'stateProvRegion = ' . quote($_POST['SubmitterState'])); }
    if (stripEsc($_POST['SubmitterPostalCode']) != $_SESSION['SubmitterPostalCode']) { $updatesString = addCommaDelimitedText($updatesString, 'zipPostalCode = ' . quote($_POST['SubmitterPostalCode'])); }
    if (stripEsc($_POST['SubmitterCountry']) != $_SESSION['SubmitterCountry']) { $updatesString = addCommaDelimitedText($updatesString, 'country = ' . quote($_POST['SubmitterCountry'])); }
    if (stripEsc($_POST['SubmitterHowHeard']) != $_SESSION['SubmitterHowHeard']) { $updatesString = addCommaDelimitedText($updatesString, 'howHeardAboutUs = ' . quote($_POST['SubmitterHowHeard'])); }
    if (stripEsc($_POST['Notes']) != $_SESSION['Notes']) { $updatesString = addCommaDelimitedText($updatesString, 'notes = ' . quote($_POST['Notes'])); }
    if ($updatesString != '') {
      $updatesString = addCommaDelimitedText($updatesString, 'lastModificationDate = NOW()');
      $updatesString = addCommaDelimitedText($updatesString, 'lastModifiedBy = ' . $_SESSION['userId']);
    }
  return $updatesString;
  }

  // initialize from database for $_POST['SubmitterSelection']
  function initializeSessionVariablesFromDB() {
    initializeSessionSubmitterVariablesFromDB(stripEsc($_POST['SubmitterSelection']));
    $entryRow = getEntryRowsFromDBWithSubmitterId(stripEsc($_POST['SubmitterSelection']));
    $workId = $entryRow['workId'];
    debugLogLineDE("entryRow['workId'] = |" . $workId . "|"); 
    if ($workId) initializeSessionEntryVariablesFromDB($workId);
  }  
?>

