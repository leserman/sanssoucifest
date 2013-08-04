<?php 
  session_start(); 
  if(!isset($_SESSION['views'])) $_SESSION['views'] = 1;
  else $_SESSION['views'] += 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - 2008 Entry Form</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../dataEntry.js" type="text/javascript"></script>
<script src="../../scripts/entryForm.js" type="text/javascript"></script>
<script src="../../scripts/validateEmailAddress.js" type="text/javascript"></script>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../../index.php"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
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
	  	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="programTablePageBackground">
<tr><td align="left" colspan="3" valign="top"  class="bodyTextOnBlack">

<?php 

include '../dataEntryFunctions.php';
include '../../forms/entryFormFunctions.php';
  
  $openError = false; 
  $openErrorMessage = "No error was detected.<br>";

  debugLogLineDE("POST[Submit] = |" . $_POST['Submit'] . "|"); 
  debugLogLineDE("SESSION['views'] = " . $_SESSION['views']);
  
  // Connect to the DB when the Submit button was clicked.
  if ($connectionSuccess = connectToDB()) {

    if(!isset($_SESSION['count'])) { 
      $_SESSION['count']=1; 
      debugLogLine("1st TIME HERE"); 
			$selectString = "SELECT * from runTime";
			$result = mysql_query($selectString);
			debugLogQuery($result, $selectString);
			while ($result && ($row = mysql_fetch_array($result))) { // item in db
				switch ($row['parameterName']) {
					case 'defaultCallId':   $_SESSION['CallForEntriesId'] = $row['parameterValue']; break;
					case 'permissionAskMe': $_SESSION['PermissionAskMeString'] = $row['parameterValueString']; break;
					case 'permissionAllOK': $_SESSION['PermissionAllOKString'] = $row['parameterValueString']; break;
				}
			}
    }
    else { 
      $count = ++$_SESSION['count']; debugLogLine("Count = " . $count); 
      $_SESSION['CallForEntriesId'] = $_POST['CallForEntriesId'];
    } 

    $priorSessionState = $_SESSION['state'];
    debugLogLineDE("Previous SESSION State = |" . $_SESSION['state'] . "|"); 

    if ($_POST['Submit'] == 'Sign In') {                            // POSTED SIGN IN
      if (true) {  // was if $_SESSION['count'] == 1*
      // The user has just logged in 
  		// Check to see if the User is in the DB
      $row = getPersonRowFromDBWithEmail($_POST[EmailAddressUID]);
      $validUser = validateUser($row, $_POST['Password']);
      $openError = !$validUser;
      }
      if ($openError) killSession(); // and leave $_SESSION['state'] undefined
      else {
        $_SESSION['state'] = 'justSignedIn';
        // initialize $_SESSION variables for User
        $_SESSION['userRecord'] = $row;
		  	$_SESSION['userId'] = $row['personId']; 
      }
      // In any case, present a blank form
      resetSessionVariables();
      // TODO entry selection dropdown is locked on NEW
    } 
    else if ($_POST['CallForEntriesId'] != $_SESSION['CallForEntriesId']) { // POSTED NEW CALL FOR ENTRIES ID
      $_SESSION['CallForEntriesId'] = $_POST['CallForEntriesId'];
    }
    
    else if ($_POST['Submit'] == 'Select Submitter') {              // POSTED SELECT SUBMITTER
      debugLogLineDE("POST[SubmitterSelection] = |" . $_POST['SubmitterSelection'] . "|"); 
      debugLogLineDE("POST[ChangeCount] = |" . $_POST['ChangeCount'] . "|"); 
      $_SESSION['state'] = 'selectSubmitter';
      if ($_POST['SubmitterSelection'] == 'selectSomething') { } // do nothing
      else if ($priorSessionState == 'selectSubmitter') {
        if ($_POST['SubmitterSelection'] != $_SESSION['submitterId']) {
          // the last state was selectSubmitter and this is a different submitter, 
          if (($_POST['ChangeCount'] > 0) && ($_POST['SaveSubmitterChangesFirst'] == 'yes')) saveSubmission();
          if ($_POST['SubmitterSelection'] == 'createNewSubmitter') {
            resetSessionVariables();
            $_SESSION['state'] = 'newSubmitter';
          }
          initializeSessionVariablesFromDB();
        }
      } else if (($priorSessionState == 'justSignedIn') || 
               ($priorSessionState == 'saveAllChanges') || 
               ($priorSessionState == 'newEntry') ||
               ($priorSessionState == 'selectEntry')) {
          initializeSessionVariablesFromDB();
      }
    } 
    else if ($_POST['Submit'] == 'Save Changes') {                      // POSTED SAVE [ALL] CHANGES
      debugLogLineDE("POST[ChangeCount] = |" . $_POST['ChangeCount'] . "|"); 
      //if (there are any changes, save them and clear the changes flag)
      if ($_POST['ChangeCount'] > 0) saveSubmission();
      initializeSessionVariablesFromPost();
      // <SCRIPT type="text/javascript">resetChanged();</SCRIPT>
      $_SESSION['state'] = 'saveAllChanges';
    } 
    else if ($_POST['Submit'] == 'Select Entry') {                  // POSTED SELECT ENTRY
      if ($_POST['EntrySelection'] != 'selectSomething') { 
        if (($_POST['EntryChangeCount'] > 0) && ($_POST['SaveEntryChangesFirst'] == 'yes')) saveSubmission();
        if ($_POST['EntrySelection'] == 'createNewEntry') {
          resetSessionEntryVariables();
          $_SESSION['state'] = 'newEntry';
        } else { 
          initializeSessionEntryVariablesFromDB($_POST['EntrySelection']);
          $_SESSION['state'] = 'selectEntry';
        }
      } 
    }
    debugLogLineDE("New SESSION State = |" . $_SESSION['state'] . "|"); 
  } // connection success
?>
&nbsp;</td></tr>
          <tr>
            <td colspan="3" align="left" valign="middle" class="programPageTitleText">Data Entry Form for Submitter and Works</td>
          </tr>
          <?php if ($openError) echo '<tr><td colspan="3" align="center" class="bodyTextOnBlack" style="font-size:14;font-weight:bold;padding:6px 4px 20px 4px;color:#FFFF33">' . $openErrorMessage . '</td></tr>' ?>

  <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->
          <tr align="left" valign="middle">
            <td colspan="3" align="center" valign="top">
            <form name="WorkDataEntryForm" id="workDataEntryForm"
						  onSubmit="return validateDataEntry(this, '<?php echo $_SESSION["emailFromDB"] ?>', '<?php echo $_SESSION["pwFromDB"] ?>')" 
						      action="../../../admin/worksDataEntry.php" method="post"> 
              <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
							<!-- TODO to do
							  If there are existing entries for this call, then give this choice
								  I am entering an additional entry for this call - if selected, then enable the Film Title entry field
									I am editing an existing entry for this call - if selected, then enable the Film Title dropdown list
								Otherwise, just show the Film Title entry field
								See MORE ON ENTRY CHOICE comment below.
							-->

                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submission"></a>Call for Entries:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                    <!-- Changed 8/17/08: added this row to allow the user to initialize the Call associated with this Entry. -->
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Choose Call for:</td>
                      <td height="28" align="left" class="entryFormField">
<!--                             onChange="javascript:changeCallForEntries(<?php echo $_SESSION['submitterId'] ?>, <?php echo $_SESSION['entryId'] ?>)"> -->
                        <select id="callForEntriesId" name="CallForEntriesId" style="width:210px" <?php if ($openError) echo 'disabled'; ?> 
                            onChange="javascript:document.WorkDataEntryForm.submit()">
                          <option value ="All"<?php if ($_SESSION['CallForEntriesId'] == 0) echo "selected='selected'";?>>All Events</option>
                          <?php
                            $selectString = "SELECT callId, name, description from callsForEntries order by dateOfCall desc";
                            $result = mysql_query($selectString);
                            debugLogQuery($result, $selectString);
                            while ($result && ($row = mysql_fetch_array($result))) { // item in db
                              echo '<option value=' . $row['callId'];
                              if ($row['callId'] == $_SESSION['CallForEntriesId']) echo " selected='selected'";
                              echo  '>' . $row['description'] . '</option>' . "\r\n";
                            }
                          ?>
							          </select>
											</td>
										</tr>
										
          <tr>
            <td colspan="2" class="entryFormSectionHeading">Submitter Contact Information:<br><hr class="horizontalSeparatorFull"></td>
           </tr>
										<tr>
                      <td width="160" height="28" align="right" class="entryFormDescription" style="padding-bottom:20px">Choose Submitter:</td>
                      <td height="28" align="left" class="entryFormField" style="padding-bottom:20px">
                        <select id="submitterSelection" name="SubmitterSelection" onChange="abilifyButton(this.value, document.getElementById('selectSubmitter'));" style="width:170px">
                          <option value ="selectSomething" selected='selected'>-- Select --</option>
                          <option value ="createNewSubmitter">Create New Submitter</option>
                          <option value ="selectSomething" disabled>------------</option>
                          <?php
                            if ($_SESSION['CallForEntriesId'] != 0) $callForEntriesWhereClause = "and callForEntries= " . $_SESSION['CallForEntriesId'] . " ";
                            else $callForEntriesWhereClause = "";
                            $selectString = "SELECT personId, lastName, name, loginName from people join works on personId=submitter "
                                          . "where relationship like '%Submitter%' " . $callForEntriesWhereClause
                                          . "group by submitter order by lastName, name";
                            $result = mysql_query($selectString);
                            debugLogQuery($result, $selectString);
                            while ($result && ($row = mysql_fetch_array($result))) { // item in db
                              echo '<option value =' . $row['personId'] . '>' . $row['name'] . '</option>';
                            }
                          ?>
							          </select>
                      <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="selectSubmitter" name="Submit" value="Select Submitter" disabled
                            onClick="javascript:saveSubmitterChangesQuery(document.getElementById('submitterSelection').value, <?php echo $_SESSION['submitterId'] ?>);"></span>
                    </td>
                  </tr>

                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Name:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterName" name="SubmitterName" 
                     class="entryFormInputField" value="<?php echo $_SESSION['SubmitterName']; ?>" maxlength="128"
                     <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);">
										 <script type=Javascript>document.WorkDataEntryForm.submitterName.focus();</script>

										<input type="hidden" id="changeCount" name="ChangeCount" value=0 > 
										<input type="hidden" id="submitterChangeCount" name="SubmitterChangeCount" value=0 > 
										<input type="hidden" id="entryChangeCount" name="EntryChangeCount" value=0 > 
										<input type="hidden" id="saveSubmitterChangesFirst" name="SaveSubmitterChangesFirst" value='no' > 
										<input type="hidden" id="saveEntryChangesFirst" name="SaveEntryChangesFirst" value='no' > 
										<input type="hidden" id="submitterNickName" name="SubmitterNickName" value="<?php echo $_SESSION['SubmitterNickName']; ?>" > 
										<input type="hidden" id="submitterLastName" name="SubmitterLastName" value="<?php echo $_SESSION['SubmitterLastName']; ?>" > 
<!--										<input type="hidden" id="submitterPassword" name="SubmitterPassword" value="<?php echo $_SESSION['SubmitterPassword']; ?>" > -->
<!--										<input type="hidden" id="submitterEmail" name="SubmitterEmail" value="<?php echo $_SESSION['SubmitterEmail']; ?>" > -->
										
										<input type="hidden" id="emailAddressUID" name="EmailAddressUID" value=document.WorkDataEntryForm.SubmitterEmail.value> 
										<input type="hidden" id="submitterId" name="SubmitterId" value="<?php echo $_SESSION['submitterId']; ?>" > 
										<input type="hidden" id="entryId" name="EntryId" value="<?php echo $_SESSION['entryId']; ?>" > 
										<!-- TODO: use workLastModified and submitterlastModified to verify that data has not changed since read -->
										<input type="hidden" id="workLastModified" name="WorkLastModified" value="<?php echo $_SESSION['WorkLastModified']; ?>" > 
										<input type="hidden" id="submitterlastModified" name="SubmitterLastModified" value="<?php echo $_SESSION['SubmitterLastModified']; ?>" > 
<!--										<input type="hidden" id="callForEntriesId" name="CallForEntriesId" value="<?php echo $_SESSION['CallForEntriesId']; ?>"> -->
                  </td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Organization:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterOrganization" name="SubmitterOrganization" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterOrganization']; ?>" maxlength="64"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Street Address:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterAddress1" name="SubmitterAddress1" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterAddress1']; ?>" maxlength="64"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">&nbsp;</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterAddress2" name="SubmitterAddress2" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterAddress2']; ?>" maxlength="64"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">City:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterCity" name="SubmitterCity" 
                    class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterCity']; ?>" maxlength="32"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">State/Province:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterState" name="SubmitterState" 
                  class="entryFormInputFieldShorter" value="<?php echo $_SESSION['SubmitterState']; ?>" maxlength="32"
                  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);">
									<span  class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;Postal Code:</span>
									<input type="text" id="submitterPostalCode" name="SubmitterPostalCode" class="entryFormInputFieldShorter" 
								  	value="<?php echo $_SESSION['SubmitterPostalCode']; ?>" maxlength="16" onChange="javascript:userMadeAChange();"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Country:</td>
									<td height="28" align="left" class="entryFormField"><input type="text" id="submitterCountry" name="SubmitterCountry" 
								  	class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterCountry']; ?>" maxlength="32"
								  	<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" valign="top" class="entryFormDescription"><img src="../../../images/dotClear.gif" alt="" 
                    width="1" height="6" hspace="0" vspace="0" border="0" align="middle"><br clear="all">Telephones:</td>
                  <td align="left">
									  <table width="96%"  border="0" align="left" cellpadding="0" cellspacing="0">
											<tr>
												<td width="15%" height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">Voice:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneVoice" 
												  name="SubmitterPhoneVoice" class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneVoice']; ?>" maxlength="32"
												  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
											</tr>
											<tr>
												<td height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">&nbsp;Mobile:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneMobile" 
												  name="SubmitterPhoneMobile" class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneMobile']; ?>" maxlength="32"
												  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
											</tr>
											<tr>
												<td height="28" align="right" valign="middle" class="entryFormDescriptionSub" style="padding-top:1px">Fax:&nbsp;</td>
												<td height="28" align="left" valign="middle" class="entryFormField"><input type="text" id="submitterPhoneFax" name="SubmitterPhoneFax" 
												  class="entryFormInputFieldShort" value="<?php echo $_SESSION['SubmitterPhoneFax']; ?>" maxlength="32"
												  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
											</tr>
										</table>
									</td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Email Address:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterEmail" name="SubmitterEmail" class="entryFormInputField" 
                                                                             value="<?php echo $_SESSION['SubmitterEmail']; ?>" maxlength="128"
                                                                             <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">Reenter Email:</td>
                  <td height="28" align="left" class="entryFormField"><input type="text" id="submitterEmailReentered" name="SubmitterEmailReentered" 
                    class="entryFormInputField" maxlength="128" <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" align="right" class="entryFormDescription">Password:</td>
                  <td height="28" align="left" class="entryFormField"><input type="password" id="submitterPassword" name="SubmitterPassword" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterPassword']; ?>" maxlength="32"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" align="right" class="entryFormDescription">Reenter Psswrd:</td>
                  <td height="28" align="left" class="entryFormField"><input type="password" id="submitterPasswordReentered" 
                    name="SubmitterPasswordReentered" class="entryFormInputField" maxlength="32"
                    <?php if ($openError) echo 'disabled'; ?> ></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="160" height="28" align="right" class="entryFormDescription">How heard:</td>
                  <td align="left" class="entryFormField"><input type="text" id="submitterHowHeard" name="SubmitterHowHeard" 
                    class="entryFormInputField" value="<?php echo $_SESSION['SubmitterHowHeard']; ?>" maxlength="128"
                    <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
                </tr> 
								<tr align="left" valign="middle">
									<td width="160" height="28" align="right" class="entryFormDescription">Notes:</td>
									<td height="28" align="left" class="entryFormField"><input type="text" id="notes" name="Notes" 
  									class="entryFormInputField" value="<?php echo $_SESSION['Notes']; ?>" maxlength="400"
										<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(0);"></td>
								</tr>
								<!-- TODO to do: MORE ON ENTRY CHOICE: For now, just allow editing of one entry associated with the current Call. Eventually, ask user if 
								     they want to create a new entry, view an existing entry, or edit an existing entry. Only OK to edit for current Call for Entries. 
								     Use a radio button to make the initial (new, view, edit) choice. Use drop-down menus plus select button for view/edit selection. 
								-->
                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submission"></a>Entry Information:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>

                   <tr>
                      <td width="160" height="28" align="right" class="entryFormDescription" style="padding-bottom:20px">Choose Entry:</td>
                      <td height="28" align="left" class="entryFormField" style="padding-bottom:20px">
                        <select id="entrySelection" name="EntrySelection" onChange="abilifyButton(this.value, document.getElementById('selectEntry'));" style="width:210px">
                          <option value ="selectSomething" selected='selected'>-- Select --</option>
                          <option value ="createNewEntry">Create New Entry</option>
                          <option value ="selectSomething" disabled>------------</option>
                          <?php
                            $querySubmitterId = isset($_SESSION['submitterId']) ? $_SESSION['submitterId'] : 0;
                            $queryCallForEntriesId = isset($_SESSION['CallForEntriesId']) ? $_SESSION['CallForEntriesId'] : 0;
                            $selectString = "SELECT workId, title from works where submitter = " . $querySubmitterId 
                                          . " AND callForEntries = " . $queryCallForEntriesId
                                          . " ORDER BY title";
                            $result = mysql_query($selectString);
                            debugLogQuery($result, $selectString);
                            while ($result && ($row = mysql_fetch_array($result))) { // item in db
                              echo '<option value =' . $row['workId'] . '>' . $row['title'] . '</option>';
                            }
                          ?>
							          </select>
                      <span>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="selectEntry" name="Submit" value="Select Entry" disabled
                        onClick="javascript:saveEntryChangesQuery(document.getElementById('entrySelection').value, <?php echo $_SESSION['entryId'] ?>);"></span>
                    </td>
                  </tr>
                    <!-- Changed 8/17/08: added this row to allow the user to initialize the Call associated with this Entry. -->
                    <!-- Deleted 11/1/08
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Submitted in response to:</td>
                      <td height="28" align="left" class="entryFormField">
                        <select id="callForEntriesName" name="CallForEntriesName" style="width:210px"
                              <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);">
                           TODO: Must also change the value of $_SESSION['CallForEntriesName']) when this changes. DO THIS IN initialize from POST
                          <?php
                            $selectString = "SELECT callId, name from callsForEntries order by callId";
                            $result = mysql_query($selectString);
                            debugLogQuery($result, $selectString);
                            while ($result && ($row = mysql_fetch_array($result))) { // item in db
                              echo '<option value =' . $row['name'];
                              if ($row['name'] == $_SESSION['CallForEntriesName']) echo " selected='selected'";
                              echo  '>' . $row['name'] . ' call for entries.</option>';
                            }
                          ?>
							          </select>
											</td>
										</tr>
										-->
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Designated Id:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="designatedId" name="DesignatedId" 
											  class="entryFormInputFieldVeryShort" value="<?php echo $_SESSION['DesignatedId']; ?>" maxlength="16"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Film Title:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="filmTitle" name="FilmTitle" 
											  class="entryFormInputField" value="<?php echo $_SESSION['FilmTitle']; ?>" maxlength="255"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Prduction Year:</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormField"><input type="text" id="productionYear" name="ProductionYear" class="entryFormInputFieldVeryShort" 
												value="<?php echo $_SESSION['ProductionYear']; ?>" maxlength="4" <?php if ($openError) echo 'disabled'; ?> 
												onChange="javascript:userMadeAChange(1);"></span><span 
												class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;&nbsp;Run Time:&nbsp;</span><span 
												class="entryFormField"><input type="text" id="runTimeMinutes" name="RunTimeMinutes" class="entryFormInputFieldVeryShort" 
												value="<?php echo $_SESSION['RunTimeMinutes']; ?>" maxlength="3" <?php if ($openError) echo 'disabled'; ?> 
												onChange="javascript:userMadeAChange(1);">
											</span><span 
												class="entryFormDescriptionSub">&nbsp;min,</span><span 
												class="entryFormField">
											<input type="text" id="runTimeSeconds" name="RunTimeSeconds" class="entryFormInputFieldVeryShort" 
											  value="<?php echo $_SESSION['RunTimeSeconds']; ?>" maxlength="2" <?php if ($openError) echo 'disabled'; ?> 
											  onChange="javascript:userMadeAChange(1);">
											</span><span 
												class="entryFormDescriptionSub">&nbsp;sec</span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Submission Format</td>
											<td height="28" align="left" class="entryFormField"><!-- TO DO TODO: FIX RE_INITIALIZATION OF RADIO BUTTONS --><input  
												  type="radio" name="SubmissionFormat" id="miniDV" value="miniDV" 
												  <?php if ($_SESSION["SubmissionFormat"]!="DVD") echo "checked"; ?> onChange="javascript:userMadeAChange(1);"><label 
												  for="miniDV" class="entryFormRadioButton"> Mini-DV (preferred)</label>&nbsp;&nbsp;&nbsp;
												<input type="radio" name="SubmissionFormat" id="DVD" value="DVD"
												  <?php if ($_SESSION["SubmissionFormat"]=="DVD") echo "checked"; ?> onChange="javascript:userMadeAChange(1);"><label 
												  for="DVD" class="entryFormRadioButton"> DVD</label></td>
										</tr>
										<tr align="left" valign="middle"><!-- FIX RE-INITIALIZATION OF Original Format DROP_DOWN -->
											<td width="160" height="28" align="right" class="entryFormDescription">Original Format:</td>
											<td height="28" align="left" class="entryFormField">
											  <select id="originalFormat" 
											  name="OriginalFormat" onChange="javascript:userMadeAChange(1); textField=document.getElementById('OtherFormat'); textField.value = '';">
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
												value="<?php echo $_SESSION['OtherFormat']; ?>" maxlength="64"></span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Director:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="director" name="Director" 
											class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['Director']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Producer:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="producer" name="Producer" 
											class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['Producer']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Choreographer:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="choreographer" name="Choreographer" 
											class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['Choreographer']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Dance Company:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="danceCompany" name="DanceCompany" 
											class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['DanceCompany']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Principal Dancers:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="principalDancers" 
											name="PrincipalDancers" class="entryFormInputField" maxlength="200" value="<?php echo $_SESSION['PrincipalDancers']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Music Composition:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="musicComposition" 
											name="MusicComposition" class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['MusicComposition']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Music Performance:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="musicPerformance" 
											name="MusicPerformance" class="entryFormInputField" maxlength="128" value="<?php echo $_SESSION['MusicPerformance']; ?>" 
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription"><a name="other"></a>Other Credits:</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole1" name="ContributorRole1" class="entryFormInputFieldShorter" maxlength="128"
											  value="<?php echo $_SESSION['ContributorRole1']; ?>" <?php if ($openError) echo 'disabled'; ?> 
											  onChange="javascript:userMadeAChange(1);"></span><span class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName1" name="ContributorName1" class="entryFormInputFieldShorter" 
												maxlength="128" value="<?php echo $_SESSION['ContributorName1']; ?>" <?php if ($openError) echo 'disabled'; ?> 
												onChange="javascript:userMadeAChange(1);"></span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">&nbsp;</td>
											<td height="28" align="left" class="entryFormField"><span 
												class="entryFormDescriptionSub">Role:</span><span 
												class="entryFormField">
											  <input type="text" id="contributorRole2" name="ContributorRole2" class="entryFormInputFieldShorter" 
											  maxlength="128" value="<?php echo $_SESSION['ContributorRole2']; ?>" <?php if ($openError) echo 'disabled'; ?> 
											  onChange="javascript:userMadeAChange(1);"></span><span 
												class="entryFormDescriptionSub">&nbsp;&nbsp;Name:</span><span 
												class="entryFormField"><input type="text" id="contributorName2" name="ContributorName2" 
												class="entryFormInputFieldShorter" maxlength="128" value="<?php echo $_SESSION['ContributorName2']; ?>" 
												<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);">
											</span></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Other Festivals Shown:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="otherFestivals" name="OtherFestivals" 
											  class="entryFormInputField" value="<?php echo $_SESSION['OtherFestivals']; ?>" maxlength="1000"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Photo Credits:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="photoCredits" name="PhotoCredits" 
											  class="entryFormInputField" value="<?php echo $_SESSION['PhotoCredits']; ?>" maxlength="800"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Photo Location:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="photoLocation" name="PhotoLocation" 
											  class="entryFormInputField" value="<?php echo $_SESSION['PhotoLocation']; ?>" maxlength="40"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Web Site:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="webSite" name="WebSite" 
											class="entryFormInputField" value="<?php echo $_SESSION['WebSite']; ?>" maxlength="1024"
											<?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"></td>
										</tr>
										<tr align="left" valign="top">
											<td width="160" align="right" class="entryFormDescriptionTA">Brief Synopsis:</td>
											<td align="left" class="entryFormFieldTA"><textarea id="synopsis" name="Synopsis" rows="4" cols="20" 
											  class="entryFormTextAreaField" <?php if ($openError) echo 'disabled'; ?> 
											  onChange="javascript:userMadeAChange(1);"><?php echo $_SESSION['Synopsis']; ?></textarea></td>
										</tr>

										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Date Media Mailed:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="dateMediaReceived" name="DateMediaReceived" 
											  class="entryFormInputFieldShorter" value="<?php echo $_SESSION['DateMediaReceived']; ?>" maxlength="10"
											  <?php if ($openError) echo 'disabled'; ?> onChange="javascript:userMadeAChange(1);"><span 
											  class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Payment:</span>
												<span class="entryFormField"><input type="text" id="datePaid" name="DatePaid" class="entryFormInputFieldShorter" 
	  											value="<?php echo $_SESSION['DatePaid']; ?>" maxlength="10" <?php if ($openError) echo 'disabled'; ?>  
	  											onChange="javascript:userMadeAChange(1);"></span></td>
										</tr>

										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Payment:</td>
											<td height="28" align="left" class="entryFormField"><input type="radio" name="Payment" id="paypal" value="paypal" 
    	  								<?php if ($_SESSION["Payment"]!="check") echo "checked"; ?> onChange="javascript:userMadeAChange(1);"><label 
    	  								for="paypal" class="entryFormRadioButton"> PayPal</label>&nbsp;
												<input type="radio" name="Payment" id="check" value="check" <?php if ($_SESSION["Payment"]=="check") echo "checked"; ?> 
												onChange="javascript:userMadeAChange(1);">
									      <label for="check" class="entryFormRadioButton">Check</label>
									      
												<span class="entryFormDescriptionSub">&nbsp;&nbsp;&nbsp;#:</span>
									      <span class="entryFormField"><input type="text" id="checkNo" name="CheckNo" class="entryFormInputFieldVeryShort" 
  												value="<?php echo $_SESSION['CheckNo']; ?>" maxlength="32" <?php if ($openError) echo 'disabled'; ?> 
  												onChange="javascript:userMadeAChange(1);"></span>
												<span class="entryFormDescriptionSub">&nbsp;&nbsp;Amt:</span>
												<span class="entryFormField"><input type="text" id="amtPaid" name="AmtPaid" class="entryFormInputFieldVeryShort" 
	  											value="<?php echo $_SESSION['AmtPaid']; ?>" maxlength="10" <?php if ($openError) echo 'disabled'; ?> 
	  											onChange="javascript:userMadeAChange(1);"></span>
									      </td>
										</tr>

										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Release:</td>
											<td height="28" align="left" class="entryFormField"><input type="radio" name="Permission" id="allOK" value="allOK2009" 
                      <?php if ($_SESSION["Permission"]!="askMe2009") echo "checked"; ?> onChange="javascript:userMadeAChange(1);"><label for="allOK" 
                        class="entryFormRadioButton"> All tours</label>&nbsp;<input type="radio" name="Permission" id="askMe" value="askMe2009"
                        <?php if ($_SESSION["Permission"]=="askMe2009") echo "checked"; ?> onChange="javascript:userMadeAChange(1);"><label 
                        for="askMe" class="entryFormRadioButton"> Invite me to each separately</label></td>
										</tr>

										<tr align="left" valign="middle">
											<td width="160" height="28" align="right" class="entryFormDescription">Notes:</td>
											<td height="28" align="left" class="entryFormField"><input type="text" id="submissionNotes" name="SubmissionNotes" 
											class="entryFormInputField" value="<?php echo $_SESSION['SubmissionNotes']; ?>" maxlength="400"
											<?php if ($openError) echo 'disabled'; ?> onChange="userMadeAChange(1);"></td>
										</tr>

                <tr align="left" valign="middle">
                  <td colspan="2" class="entryFormSectionHeading"><a name="submit"></a>Save changes:<br>
                    <hr class="horizontalSeparatorFull"></td>
                </tr>
                <tr align="left" valign="middle">
                  <td width="100%" align="center" colspan="2"><input type="submit" id="submit" name="Submit" value="Save Changes"></td>
                </tr>
              </table>
            </form></td>
          </tr>
          <tr>
            <td width="192" height="30" align="center" valign="top" class="bodyText">&nbsp;</td>
            <td width="2" height="30"  align="center" valign="top" class="bodyText">&nbsp;</td>
            <td width="336" height="30"  align="left" valign="top" class="bodyText">&nbsp;</td>
          </tr>
          <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  
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
