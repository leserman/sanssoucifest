<?php session_start() ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - 2010 Entry Form</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../scripts/entryForm.js" type="text/javascript"></script>
<script src="../scripts/validateEmailAddress.js" type="text/javascript"></script>
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
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>
<SCRIPT type="text/javascript">
//<!-- 
  window.name='EntryFormWindow';
//-->
</SCRIPT>

	  	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="programTablePageBackground">
<tr><td align="left" colspan="3" valign="top"  class="bodyTextOnBlack">
<?php 

include '../bin/forms/entryFormFunctions.php';
  
  $openError = false; 
  $openErrorMessage = "No error was detected.<br>";

  // Connect to the DB when the Submit button was clicked.
  if ($connectionSuccess = checkSubmitButtonAndCnnectToDB()) {

    if(!isset($_SESSION['count'])) { $_SESSION['count']=1; debugLogLine("1st TIME HERE"); }
    else { $count = ++$_SESSION['count']; debugLogLine("Count = " . $count); } 

    // Initialize session varables if not already set. The existence of $_SESSION['emailFromLogin'] is the discriminator.
debugLogLine("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SessionId = " . session_id() . "<br>"
              . "Prior SessionId = " . $_SESSION['priorSessionId'] . "<br>"
              . "SESSION[submitterId] = " . $_SESSION['submitterId'] . "<br>"
              . "SESSION[SubmitterName] = " . $_SESSION['SubmitterName'] . "<br>"
              . "SESSION[SubmitterEmail] = " . $_SESSION['SubmitterEmail'] . "<br>"
              . "SESSION[emailFromLogin] = " . $_SESSION['emailFromLogin'] . "<br>"
              . "&nbsp;&nbsp;&nbsp;&nbsp;POST[EmailAddressUID] = " . $_POST['EmailAddressUID']);    
    $_SESSION['priorSessionId'] = session_id();
debugLogLine("Email address from Login = " . $_POST['EmailAddressUID']); // from Login
debugLogLine("Password from Login = " . $_POST['Password']); // from Login

//	  if(!isset($_SESSION['emailFromLogin']) || ($_SESSION['emailFromLogin'] != $_POST['EmailAddressUID'])) {
    if (true) {

      // login info
      $_SESSION['SubmitterEmail'] = $_SESSION['emailFromLogin'] = $_POST['EmailAddressUID'];
      $_SESSION['SubmitterPassword'] = $_SESSION['pwFromLogin'] = $_POST['Password']; 

      // special variables
      $_SESSION['submitterId'] = 0;
      $_SESSION['entryId'] = 0;
      $_SESSION['emailFromDB'] = '';
      $_SESSION['pwFromDB'] = '';
      $_SESSION['passwordEntryRequired'] = true;
      $_SESSION['contributorArray'] = array();
      $_SESSION['maxContributorOrder'] = 0;
      $_SESSION['SubmitterLastModified'] = 0;

      // submitter attributes
      $_SESSION['SubmitterName'] = '';
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
    
      // entry attributes
      $_SESSION['FilmTitle'] = '';
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
      $_SESSION['Permission'] = 'allOK2010';
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
      
  		// Check to see if the Submitter is in the DB
      $row = getSubmitterRowFromDB($_POST[EmailAddressUID]);
  		if ($row) { // submitter in db
        // The Submitter is in the DB so initialize session variables from database
        $_SESSION['submitterRecord'] = $row;
		  	$_SESSION['submitterId'] = $row['personId']; 
        $_SESSION['emailFromDB'] = $row['email']; 
        $_SESSION['pwFromDB'] = $row['password']; 
debugLogLine("Submitter Id = " .  $_SESSION['submitterId'] . ";  email from db = " . $_SESSION['emailFromDB']);
    
        if (($_SESSION['pwFromLogin'] != '') && ($_SESSION['pwFromDB'] != $_SESSION['pwFromLogin'])) { 
          // User entered incorrect non-blank password. Make them login again.
          $openError = true;
          $openErrorMessage = "The password you entered does not match your Sign In Email Address."
                            . "<br>Please go to the <a href='entryFormSignIn.html'>sign-in page</a> and try again."
                            . "<br>If you simply forgot your password, leave it blank on the <a href='entryFormSignIn.html'>sign-in page</a> and try again.<br>";
        } else if (($_SESSION['pwFromLogin']=='') && ($_SESSION['pwFromDB'] != '')) { 
          // User entered blank password that does not match the DB. We presume that the user forgot the PW. Email them the password.
          $openError = true;
          // Mail the user their password.
          $to      = $_POST['EmailAddressUID'];
          $subject = "To sign in";
          $message = "Dear " . $row["name"] . ",\r\n\r\n"
                   . "To sign in at http://sanssoucifest.org/ use " . $_SESSION["pwFromDB"] . "\r\n\r\n"
                   . "Best Regards, \r\nYour Friendly Helper at SansSouciFest.org\r\n\r\nDo not reply to this message.\r\n";
          $headers = "From: YourFriendlyHelper@sanssoucifest.org" . "\r\n"
                   . "Bcc: entryForm@sanssoucifest.org" . "\r\n"
                   . "Reply-To: no-reply@sanssoucifest.org" . "\r\n"
                   . "X-Mailer: PHP/" . phpversion();
          $mailedPassword = mail($to, $subject, $message, $headers);
debugLogLine('<br> $mailedPassword = ' . $mailedPassword . '<br>' . $to . '<br>' . $subject . '<br>' . $headers . '<br>' . $message . '<br><br>');
          $openErrorMessage = "You did not enter your password. ";
          if ($mailedPassword) $openErrorMessage .= "Presuming that you forgot it,<br>it has been emailed to you at " . $_SESSION['emailFromDB'] . ".";
          $openErrorMessage .= "<br>Please go to the <a href='entryFormSignIn.html'>sign-in page</a> and sign in again later<br>once you have the password.<br>";

          // TODO to do: FIX ERROR where user cannot return to submission form after bad password.
        }
        
        if ($openError) { 
          killSession();
        } else {
          // The Submitter is in the DB and there was no openError, 
          // so initialize session submitter attributes from the database
          $_SESSION['SubmitterName'] = $row['name']; 
          $_SESSION['SubmitterOrganization'] = $row['organization']; 
          $_SESSION['SubmitterAddress1'] = $row['streetAddr1']; 
          $_SESSION['SubmitterAddress2'] = $row['streetAddr2']; 
          $_SESSION['SubmitterCity'] = $row['city']; 
          $_SESSION['SubmitterState'] = $row['stateProvRegion']; 
          $_SESSION['SubmitterPostalCode'] = $row['zipPostalCode']; 
          $_SESSION['SubmitterCountry'] = $row['country']; 
          $_SESSION['SubmitterPhoneVoice'] = $row['phoneVoice']; 
          $_SESSION['SubmitterPhoneMobile'] = $row['phoneMobile']; 
          $_SESSION['SubmitterPhoneFax'] = $row['phoneFax']; 
          $_SESSION['SubmitterHowHeard'] = $row['howHeardAboutUs']; 
          $_SESSION['SubmitterPassword'] = $row['password']; 
          $_SESSION['SubmitterLastModified'] = $row['lastModificationDate']; 
        }
        
      } // submitter in db
      else { // since the submitter is not in the DB
        $_SESSION['passwordEntryRequired'] = true;
        $_SESSION['SubmitterPassword'] = "";
      }

debugLogLine("Submitter Id = " .  $_SESSION['submitterId']);
      if (submitterInPeopleTable() && !$openError) {

      // SET SESSION CallForEntriesId and CallForEntriesName which is needed to access the works DB
      $callForEntriesId = getCallForEntriesIdFromName($_POST['CallForEntriesName']); // Changed 8/18/08: CallForEntries to CallForEntriesName
      $_SESSION['callForEntriesId'] = $callForEntriesId;
      $_SESSION['callForEntriesName'] = $_POST['CallForEntriesName'];  // Changed 8/18/08: CallForEntries to CallForEntriesName
      
		  	// Check to see if the Submitter has an Entry in the DB for this Call for Entries
        $selectWorkString = "SELECT workId, title, yearProduced, runTime, submissionFormat, originalFormat, synopsisOriginal, "
                      . "webSite, previouslyShownAt, photoCredits, submitter, callForEntries, howPaid, permissionsAtSubmission, lastModificationDate "
                      . "FROM works WHERE submitter = " . $_SESSION[submitterId] . " AND callForEntries = $callForEntriesId";
debugLogLineQuery($selectWorkString);
        $result = mysql_query($selectWorkString);
debugLogLine("Select Query Finished -- result = " . $result); 
debugLogQuery($result, $selectWorkString);
  	  	if ($result && ($row = mysql_fetch_array($result))) { // entry in db
	  		  $_SESSION['entryRecord'] = $row;
  		  	$_SESSION['entryId'] = $row['workId']; 
          $_SESSION['FilmTitle'] = $row['title']; 
          $_SESSION['ProductionYear'] = $row['yearProduced']; 
debugLogLine("row[runTime] = " . $row['runTime']);
          list($hours, $minutes, $seconds) = explode(":", $row['runTime']);
          $_SESSION['RunTimeMinutes'] = (60 * $hours) + $minutes; 
//debugLogLine("SESSION[RunTimeMinutes] = " . $_SESSION['RunTimeMinutes']);
          $_SESSION['RunTimeSeconds'] = $seconds;
          $_SESSION['SubmissionFormat'] = $row['submissionFormat']; 
          $_SESSION['OriginalFormat'] = $row['originalFormat']; 
          $_SESSION["OtherFormat"] = getTextForOtherOriginalFormatField();
          $_SESSION['OtherFestivals'] = $row['previouslyShownAt']; 
          $_SESSION['PhotoCredits'] = $row['photoCredits']; 
          $_SESSION['WebSite'] = $row['webSite']; 
          $_SESSION['Synopsis'] = $row['synopsisOriginal']; 
          $_SESSION['Payment'] = $row['howPaid']; 
          $_SESSION['Permission'] = $row['permissionsAtSubmission'];
          $_SESSION['WorkLastModified'] = $row['lastModificationDate']; 

	  	    // Get the work contributors from the workContributors table and set SESSION variables
          $contributorSelectResult = selectContributors('all');
          $maxContributorOrder = 0;
  	    	while ($contributorSelectResult && ($row = mysql_fetch_array($contributorSelectResult))) { // entry in db
  	    	  $maxContributorOrder = ($row['contributorOrder'] > $maxContributorOrder) ? $row['contributorOrder'] : $maxContributorOrder;
            if ($row['role'] == 'Director') $_SESSION['Director'] = $row['name'];
            else if ($row['role'] == 'Producer') $_SESSION['Producer'] = $row['name'];
            else if ($row['role'] == 'Choreographer') $_SESSION['Choreographer'] = $row['name'];
            else if ($row['role'] == 'DanceCompany') $_SESSION['DanceCompany'] = $row['name'];
            else if ($row['role'] == 'PrincipalDancers') $_SESSION['PrincipalDancers'] = $row['name'];
            else if ($row['role'] == 'MusicComposition') $_SESSION['MusicComposition'] = $row['name'];
            else if ($row['role'] == 'MusicPerformance') $_SESSION['MusicPerformance'] = $row['name'];
            else if ($_SESSION['ContributorRole1'] == "") {
              $_SESSION['ContributorRole1'] = $row['role'];
              $_SESSION['ContributorName1'] = $row['name'];
            } else if ($_SESSION['ContributorRole2'] == "") {
              $_SESSION['ContributorRole2'] = $row['role'];
              $_SESSION['ContributorName2'] = $row['name'];
            } // else if
          } // while
          if ($contributorSelectResult) $_SESSION['contributorArray'] = $contributorSelectResult;
          $_SESSION['maxContributorOrder'] = $maxContributorOrder;
  	  	} // entry in db

      } // submitter in db
debugLogLine("SESSION[emailFromLogin] = " . $_SESSION['emailFromLogin']);
    } // this is a new session
  } // connection success
?>
&nbsp;</td></tr>
          <tr>
            <td colspan="3" align="left" valign="middle" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="6" 
                                                                                              hspace="0" vspace="0" border="0" align="middle"><br clear="all">
              Official Entry Form, 2010 (CLOSED)<br>
              <img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"></td>
          </tr>
          <?php if ($openError) echo '<tr><td colspan="3" align="center" class="bodyTextOnBlack" style="font-size:14;font-weight:bold;padding:6px 4px 6px 4px;color:#FFFF33">' . $openErrorMessage . '</td></tr>' ?>
          <tr align="left">
            <td height="10" colspan="3" valign="top"  class="bodyTextOnBlack" style="padding:6px 4px 6px 4px;">Sans Souci,
              an international festival of dance cinema, invites and encourages submissions from all artists regardless of
              credentials and affiliations. Accepted works will be screened Friday &amp; Saturday, SEPT 20th &amp; 21st, 2010
							in Boulder, Colorado, USA.<br>
							<br>
							To make a submission, complete this form and adhere
<!--              to the <a href="entryRequirements2010.html">requirements</a>. You may return later to print or edit this form -->
<!--              to the <a href="javascript:void(0)" onClick="if (!entryRequirementsWindow) { entryRequirementsWindow=window.open('entryRequirementsInWindow2010.html', -->
              to the <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('entryRequirementsInWindow2010.html',
              'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
              entryRequirementsWindow.focus();">Entry Requirements</a>. 
<!--if (window.opener && window.opener.name=='EntryRequirementsWindow') window.opener.focus();">requirements</a>. -->
                You may return later to print or edit this form
               by logging in again.	Be sure to save your changes by clicking the <a href="#submit">Submit</a> button
              at the bottom of the form. 
<!--
                  (If you simply cannot stand filling out an online form, you may download and use 
                  the <a href="../PDF-EntryForms/SansSouci2010EntryForm01.pdf">PDF paper one</a>.)
-->                  
              <br clear="all">
                  <img src="../images/dotClear.gif" width="1" height="10" alt="" hspace="0" vspace="0" border="0" align="middle"></td>
          </tr>
          <?php if ($openError) echo '<tr><td colspan="3" align="center" class="bodyTextOnBlack" style="font-size:14;font-weight:bold;padding:6px 4px 6px 4px;color:#FFFF33">' . $openErrorMessage . '</td></tr>' ?>
          <tr>
  <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->
            <td colspan="3" align="center" valign="top"><form name="EntryForm" id="entryForm"
						  onSubmit="return validateEntryForm(this, '<?php echo $_SESSION["emailFromDB"] ?>', '<?php echo $_SESSION["pwFromDB"] ?>')" action="submittedEntryForm.php" method="post">
<!--						  onSubmit="return validateEntryForm(this)" action="./submitEntryForm.php" method="post"> -->
              <table width="96%"  border="0" align="center" cellpadding="0" cellspacing="0">
							<!-- TODO to do
							  If there are existing entries for this call, then give this choice
								  I am entering an additional entry for this call - if selected, then enable the Film Title entry field
									I am editing an existing entry for this call - if selected, then enable the Film Title dropdown list
								Otherwise, just show the Film Title entry field
								See MORE ON ENTRY CHOICE comment below.
							-->
                <tr align="left" valign="middle">
                  <td width="100" align="right" class="entryFormDescription">Film Title:</td>
                  <td align="left" class="entryFormField"><input type="text" id="filmTitle" name="FilmTitle" class="entryFormInputField" maxlength="200" 
									  value="<?php echo $_SESSION['FilmTitle']; ?>" onBlur='document.getElementById("filmTitleSlave").value=this.value;' 
									  <?php if ($openError) echo 'disabled'; ?> ><script language=Javascript>document.EntryForm.filmTitle.focus();</script>
										<!-- LastModified is set from DB at init & used to check (on server side before db update) that update from this form is still valid.
										     That is, OK if LastModified value == DB value; otherwise, tell user they cannot submit from this form and must login again -->
										<input type="hidden" id="emailAddressUID" name="EmailAddressUID" value=document.getElementById('submitterEmail').value; > 
										<input type="hidden" id="submitterId" name="SubmitterId" value="<?php echo $_SESSION['submitterId']; ?>"; > 
										<input type="hidden" id="entryId" name="EntryId" value="<?php echo $_SESSION['entryId']; ?>" > 
										<!-- TODO: use workLastModified and submitterlastModified to verify that data has not changed since read -->
										<input type="hidden" id="workLastModified" name="WorkLastModified" value="<?php echo $_SESSION['WorkLastModified']; ?>" > 
										<input type="hidden" id="submitterlastModified" name="SubmitterLastModified" value="<?php echo $_SESSION['SubmitterLastModified']; ?>" > 
										<!-- Changed 8/18/08: $_POST['CallForEntries'] to $_POST['CallForEntriesName'] -->
										<input type="hidden" id="callForEntriesName" name="CallForEntriesName" value="<?php echo $_POST['CallForEntriesName']; ?>"></td>
										<input type="hidden" id="callForEntriesId" name="CallForEntriesId" value="<?php echo $_SESSION['callForEntriesId']; ?>"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading">Submitter Contact Information:<br><hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Name:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterName" name="SubmitterName" 
                     class="entryFormInputField" value="<?php echo $_SESSION['SubmitterName']; ?>" maxlength="200"
                     <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Organization:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterOrganization" name="SubmitterOrganization" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterOrganization']; ?>" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Street Address:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterAddress1" name="SubmitterAddress1" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterAddress1']; ?>" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">&nbsp;</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterAddress2" name="SubmitterAddress2" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterAddress2']; ?>" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">City:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterCity" name="SubmitterCity" 
                    class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterCity']; ?>" maxlength="80"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">State/Province:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterState" name="SubmitterState" 
                  class="entryFormInputFieldShorter" value="<?php echo $_SESSION['SubmitterState']; ?>" maxlength="80"
                  <?php if ($openError) echo 'disabled'; ?> >
									<span  class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;Postal Code:</span>
									<input type="text" id="submitterPostalCode" name="SubmitterPostalCode" class="entryFormInputFieldShorter" 
								  	value="<?php echo $_SESSION['SubmitterPostalCode']; ?>" maxlength="40"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Country:</td>
									<td height="28" align="left" class="entryFormField"><input type="text" id="submitterCountry" name="SubmitterCountry" 
								  	class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterCountry']; ?>" maxlength="20"
								  	<?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" valign="top" class="entryFormDescription"><img src="../images/dotClear.gif" alt="" width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all">Telephones:</td>
                  <td align="left">
									  <table width="96%"  border="0" align="left" cellpadding="0" cellspacing="0">
											<tr>
												<td width="15%" height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">Voice:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneVoice" 
												  name="SubmitterPhoneVoice" class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneVoice']; ?>" maxlength="20"
												  <?php if ($openError) echo 'disabled'; ?> ></td>
											</tr>
											<tr>
												<td height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">&nbsp;Mobile:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneMobile" 
												  name="SubmitterPhoneMobile" class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneMobile']; ?>" maxlength="20"
												  <?php if ($openError) echo 'disabled'; ?> ></td>
											</tr>
											<tr>
												<td height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">Fax:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneFax" name="SubmitterPhoneFax" 
												  class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneFax']; ?>" maxlength="20"
												  <?php if ($openError) echo 'disabled'; ?> ></td>
											</tr>
										</table>
									</td>
                </tr>
								<?php if (submitterInPeopleTable()) echo '<tr><td colspan="2" class="entryFormNotation">Changing your Email Address below will change your Login Id.</td></tr>' ?>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Email Address:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterEmail" name="SubmitterEmail" class="entryFormInputField" 
                                                                             value="<?php echo $_SESSION['SubmitterEmail']; ?>" maxlength="200"
                                                                             <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" height="28" align="right" class="entryFormDescription">Reenter Email:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterEmailReentered" name="SubmitterEmailReentered" 
                    class="entryFormInputField" maxlength="200" <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
								<?php if (submitterInPeopleTable()) echo '<tr><td colspan="2" class="entryFormNotation">Changing your Password below will change your Login Password.</td></tr>' ?>
                <tr align="left" valign="middle">
                  <td width="100" align="right" class="entryFormDescription">Password:</td>
                  <td height="28" align="left" class="entryFormField"><input type="password" id="submitterPassword" name="SubmitterPassword" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterPassword']; ?>" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" align="right" class="entryFormDescription">Reenter Psswrd:</td>
                  <td height="28" align="left" class="entryFormField"><input type="password" id="submitterPasswordReentered" 
                    name="SubmitterPasswordReentered" class="entryFormInputField" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
								<tr>
								<td colspan="2" class="entryFormNotation">How did you hear about Sans Souci Festival?</td>
								</tr>
                <tr align="left" valign="middle">
                  <td width="100" align="right" class="entryFormDescription">How heard:</td>
                  <td align="left" class="entryFormField"><input type="text" id="submitterHowHeard" name="SubmitterHowHeard" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterHowHeard']; ?>" maxlength="200"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr> 
								<!-- TODO to do: MORE ON ENTRY CHOICE: For now, just allow editing of one entry associated with the current Call. Eventually, ask user if 
								     they want to create a new entry, view an existing entry, or edit an existing entry. Only OK to edit for current Call for Entries. 
								     Use a radio button to make the initial (new, view, edit) choice. Use drop-down menus plus select button for view/edit selection. 
								-->
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submission"></a>Entry Information:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Film Title (from above):</td>
											<td height="28" align="left" class="entryFormField"><input type="text" disabled id="filmTitleSlave" name="FilmTitleSlave" 
											  class="entryFormInputField" value="<?php echo $_SESSION['FilmTitle']; ?>" maxlength="200"
											  <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Prduction Year:</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormField"><input type="text" id="productionYear" name="ProductionYear" class="entryFormInputFieldVeryShort" 
												value="<?php echo $_SESSION['ProductionYear']; ?>" maxlength="4" <?php if ($openError) echo 'disabled'; ?> ></span><span 
												class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;&nbsp;Run Time:&nbsp;</span><span 
												class="entryFormField"><input type="text" id="runTimeMinutes" name="RunTimeMinutes" class="entryFormInputFieldVeryShort" 
												value="<?php echo $_SESSION['RunTimeMinutes']; ?>" maxlength="3" <?php if ($openError) echo 'disabled'; ?> >
											</span><span 
												class="entryFormDescriptionSub">&nbsp;min,</span><span 
												class="entryFormField">
											<input type="text" id="runTimeSeconds" name="RunTimeSeconds" class="entryFormInputFieldVeryShort" 
											  value="<?php echo $_SESSION['RunTimeSeconds']; ?>" maxlength="2" <?php if ($openError) echo 'disabled'; ?> >
											</span><span 
												class="entryFormDescriptionSub">&nbsp;sec</span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Submission Format</td>
											<td height="28" align="left" class="entryFormField"><!-- TO DO TODO: FIX RE_INITIALIZATION OF RADIO BUTTONS --><input  
												  type="radio" name="SubmissionFormat" id="miniDV" value="miniDV" 
												  <?php if ($_SESSION["SubmissionFormat"]!="DVD") echo "checked"; ?> ><label for="miniDV" class="entryFormRadioButton"> Mini-DV 
												  (preferred)</label>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="SubmissionFormat" id="DVD" value="DVD"
												  <?php if ($_SESSION["SubmissionFormat"]=="DVD") echo "checked"; ?>><label for="DVD" class="entryFormRadioButton"> DVD</label></td>
										</tr>
										<tr align="left" valign="middle"><!-- FIX RE-INITIALIZATION OF Original Format DROP_DOWN -->
											<td width="140" height="28" align="right" class="entryFormDescription">Original Format:</td>
											<td height="28" align="left" class="entryFormField"><select id="originalFormat" 
											  name="OriginalFormat" onChange="textField=document.getElementById('OtherFormat'); textField.value = '';">
												<option value ="selectSomething" <?php if ($_SESSION["OriginalFormat"]=="selectSomething") echo "selected='selected'" ?> >-- Select --</option>
												<option value ="miniDV" <?php if ($_SESSION["OriginalFormat"]=="miniDV") echo "selected='selected'" ?> >mini-DV</option>
												<option value ="16mm" <?php if ($_SESSION["OriginalFormat"]=="16mm") echo "selected='selected'" ?> >16 mm</option>
												<option value ="8mm" <?php if ($_SESSION["OriginalFormat"]=="8mm") echo "selected='selected'" ?> >8 mm</option>
												<option value ="super8" <?php if ($_SESSION["OriginalFormat"]=="super8") echo "selected='selected'" ?> >Super 8</option>
												<option value ="hi8" <?php if ($_SESSION["OriginalFormat"]=="hi8") echo "selected='selected'" ?> >Hi-8</option>
												<option value ="DVCAM" <?php if ($_SESSION["OriginalFormat"]=="DVCAM") echo "selected='selected'" ?> >DVCAM</option>
												<option value ="HD" <?php if ($_SESSION["OriginalFormat"]=="HD") echo "selected='selected'" ?> >High Definition Digital</option>
												<option value ="HDV" <?php if ($_SESSION["OriginalFormat"]=="HDV") echo "selected='selected'" ?> >HDV</option>
												<option value ="videoTape3-4" <?php if ($_SESSION["OriginalFormat"]=="videoTape3-4") echo "selected='selected'" ?> >3/4&quot; videotape</option>
												<option value ="motionCapture" <?php if ($_SESSION["OriginalFormat"]=="motionCapture") echo "selected='selected'" ?> >Digital Motion Capture</option>
												<option value ="digitalAnimation" <?php if ($_SESSION["OriginalFormat"]=="digitalAnimation") echo "selected='selected'" ?> >Digital Post Animation</option>
												<option value ="stopActionAnimation" <?php if ($_SESSION["OriginalFormat"]=="stopActionAnimation") echo "selected='selected'" ?> >Stop Action Animation</option>
												<option value ="other" <?php if ($_SESSION["OtherFormat"]!="") echo "selected='selected'" ?> >Other</option>
											</select><span class="entryFormDescription">&nbsp;&nbsp;&nbsp;&nbsp;Other:</span><span 
												class="entryFormField"><input type="text" id="otherFormat" name="OtherFormat" class="entryFormInputFieldShorter"
												value="<?php echo $_SESSION['OtherFormat']; ?>" maxlength="20"></span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Director:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="director" name="Director" 
											class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['Director']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Producer:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="producer" name="Producer" 
											class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['Producer']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Choreographer:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="choreographer" name="Choreographer" 
											class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['Choreographer']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Dance Company:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="danceCompany" name="DanceCompany" 
											class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['DanceCompany']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Principal Dancers:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="principalDancers" 
											name="PrincipalDancers" class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['PrincipalDancers']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Music Composition:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="musicComposition" 
											name="MusicComposition" class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['MusicComposition']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Music Performance:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="musicPerformance" 
											name="MusicPerformance" class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['MusicPerformance']; ?>" <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription"><a name="other"></a>Other Credits:</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole1" name="ContributorRole1" class="entryFormInputFieldShorter" maxlength="100"
											  value="<?php echo $_SESSION['ContributorRole1']; ?>" <?php if ($openError) echo 'disabled'; ?> ></span><span class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName1" name="ContributorName1" class="entryFormInputFieldShorter" 
												maxlength="100" value="<?php echo $_SESSION['ContributorName1']; ?>" <?php if ($openError) echo 'disabled'; ?> >
											</span><span class="smallBodyTextOnBlack">&nbsp;&nbsp;&nbsp;<a href="javascript:window.void(0)" onMouseOver="flyoverPopup('What are Other Roles? Examples of other roles are: Additional Editing, Camera, Camera & Editing, Cinematography, Dance Improvisation, Artistic Associate, Funding Source, Improvisational Dance, Videography, and Visual Creations.','#FFFF99')" 
												onMouseOut="killFlyoverPopup()" onClick="window.alert('Examples of other roles are: Additional Editing, Camera, Camera & Editing, Cinematography, Dance Improvisation, Artistic Associate, Funding Source, Improvisational Dance, Videography, and Visual Creations.')">What's 
												this?</a></span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">&nbsp;</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole2" name="ContributorRole2" class="entryFormInputFieldShorter" 
											  maxlength="100" value="<?php echo $_SESSION['ContributorRole2']; ?>" <?php if ($openError) echo 'disabled'; ?> ></span><span 
												class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName2" name="ContributorName2" class="entryFormInputFieldShorter" 
												maxlength="100" value="<?php echo $_SESSION['ContributorName2']; ?>" <?php if ($openError) echo 'disabled'; ?> >
											</span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Other Festivals Shown:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="otherFestivals" name="OtherFestivals" 
											  class="entryFormInputField" value="<?php echo $_SESSION['OtherFestivals']; ?>" maxlength="200"
											  <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Photo Credits:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="photoCredits" name="PhotoCredits" 
											  class="entryFormInputField" value="<?php echo $_SESSION['PhotoCredits']; ?>" maxlength="200"
											  <?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="140" height="28" align="right" class="entryFormDescription">Web Site:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="webSite" name="WebSite" 
											class="entryFormInputField" value="<?php echo $_SESSION['WebSite']; ?>" maxlength="200"
											<?php if ($openError) echo 'disabled'; ?> ></td>
										</tr>
										<tr align="left" valign="top">
											<td width="100" align="right" class="entryFormDescriptionTA">Brief Synopsis:</td>
											<td align="left" class="entryFormFieldTA"><textarea id="synopsis" name="Synopsis" rows="4" cols="20" 
											  class="entryFormTextAreaField" <?php if ($openError) echo 'disabled'; ?> ><?php echo $_SESSION['Synopsis']; ?></textarea></td>
										</tr>
									</table></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading">Payment Information:<br><hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle"><!-- FIX RE-INITIALIZATION OF Payment RADIO BUTTONS -->
                  <td align="left" class="entryFormField" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
  									type="radio" name="Payment" id="paypal" value="paypal" 
  	  								<?php if ($_SESSION["Payment"]!="check") echo "checked"; ?> ><label for="paypal" class="entryFormRadioButton"> Pay 
  	  								via PayPal</label>
                  <br>
									  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Payment" id="check" value="check"
									  <?php if ($_SESSION["Payment"]=="check") echo "checked"; ?> >
									  <label for="check" class="entryFormRadioButton"> Check or money order in US Dollars sent via post 
			  						  with media</label></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading">Release Information:<br><hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="medSmallBodyTextLeadedOnBlack">By clicking the Submit Button below, you certify that you hold
                    all necessary rights for the submission of this entry. Clicking Submit on this entry form gives Sans Souci Festival 
										permission for screening this submission at the Dairy Center for the Arts in Boulder Colorado USA on SEPT 20 &amp; 21, 2010 and also:
									</td>
                </tr>
                <tr align="left" valign="middle">
                  <td align="left" colspan="2" class="entryFormField"><table width="96%"  border="0" align="center" cellpadding="2" cellspacing="0">
                    <tr><!-- FIX RE-INITIALIZATION OF Permission RADIO BUTTONS -->
                      <td align="right" valign="top"><input type="radio" name="Permission" id="allOK" value="allOK2010" 
                      <?php if ($_SESSION["Permission"]!="askMe2010") echo "checked"; ?> ></td>
                      <td align="left" valign="top" style="padding-top:4px;"><label for="allOK" class="entryFormRadioButton">All tours 
                          associated with the 2010 Season in the
                          US and elsewhere. (Sans Souci has previously toured in Mexico, Germany, and Trinidad.)</label></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><input type="radio" name="Permission" id="askMe" value="askMe2010"
                        <?php if ($_SESSION["Permission"]=="askMe2010") echo "checked"; ?>></td>
                      <td align="left" valign="top" style="padding-top:4px;"><label for="askMe" class="entryFormRadioButton">Please
                          invite me to each tour/venue separately so I  can respond to each individually. (Artists will be
                          invited to any additional venues as we make such arrangements.)</label></td>
                    </tr>
                  </table></td>
                </tr>
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submit"></a>Submit this Form:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100" align="center" colspan="2"><input disabled type="submit" id="submit" name="Submit" value="        Submit        "></td>
                </tr>
              </table>
            </form></td>
          </tr>
          <tr>
            <td width="192" height="30" align="center" valign="top" class="bodyText">&nbsp;</td>
            <td width="2" height="30"  align="center" valign="top" class="bodyText">&nbsp;</td>
            <td width="336" height="30"  align="left" valign="top" class="bodyText">&nbsp;</td>
          </tr>
          <!-- end FORM -->
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
