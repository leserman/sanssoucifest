<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<title>Sans Souci Festival of Dance Cinema - 2008 Entry Form TEST</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../database/dataEntry.js" type="text/javascript"></script>
<script src="../scripts/entryForm.js" type="text/javascript"></script>
<script src="../scripts/validateEmailAddress.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">

<?php 

include '../database/dataEntryFunctions.php';
include '../forms/entryFormFunctions.php';

  // Connect to the DB when the Submit button was clicked.
  $connectionSuccess = connectToDB();

?>

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td align="left" valign="top"></td>
    <td width="600" align="center" valign="top">
      <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr>
      	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight">
    	  	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="programTablePageBackground">
              <tr>
                <td colspan="3" align="left" valign="middle" class="programPageTitleText">Data Entry Form for Submitter and Works</td>
              </tr>

  <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->   <!-- begin FORM -->
							<tr align="left" valign="middle">
								<td colspan="3" align="center" valign="top">
									<form name="WorkDataEntryForm" id="workDataEntryForm" onSubmit="return validateDataEntry(this, 'a@b.c', 'abc')" action="../../admin/worksDataEntry.php" method="post"> 
										<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr align="left" valign="middle">
												<td colspan="2" class="entryFormSectionHeading"><a name="submission"></a>Call for Entries:<br>
													<hr class="horizontalSeparatorFull">
                        </td>
											</tr>
											<tr align="left" valign="middle">
												<td width="160" height="28" align="right" class="entryFormDescription">Choose Call for:</td>
												<td height="28" align="left" class="entryFormField">
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
										</table>
									</form>
								</td>
							</tr>
							<!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  <!-- end FORM -->  
						</table>
					</td>
    			<td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
  				<td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
        </tr>
      </table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"></td>
		<td width="10">&nbsp;</td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
</body>
</html>
