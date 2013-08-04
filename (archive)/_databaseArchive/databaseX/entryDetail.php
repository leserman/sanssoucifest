<?php

  include '../bin/forms/entryFormFunctions.php';
  include 'dataEntryFunctions.php';
  include 'databaseSupportFunctions.php';
  
  debugLogLine("GET[workId] = |" . $_GET['workId'] . "|");
  foreach ($_GET as $postedValue) debugLogLine("GET[] = |" . $postedValue . "|");  
                        
  $connectionSuccess = connectToDB();
                        
debugLogLine("connectionSuccess = |" . $connectionSuccess . "|");
	$fixedRoles[1] = 'Director';
	$fixedRoles[2] = 'Producer';
	$fixedRoles[3] = 'Choreographer';
	$fixedRoles[4] = 'DanceCompany';
	$fixedRoles[5] = 'PrincipalDancers';
	$fixedRoles[6] = 'MusicComposition';
	$fixedRoles[7] = 'MusicPerformance';
	$nRoles = $nFixedRoles = 7;

  // PERFORM ANY STATUS UPDATES INDICATED
  //echo "isset(GET[accepted])=" . isset($_GET['accepted']) . "   |" . $_GET['accepted'] . "|<br>";
  $entryStatusChanged = false;
  debugLogLine("GET[accepted] = |" . $_GET['accepted'] . "|    " . "GET[rejected] = |" . $_GET['rejected'] 
                             . "|    " . "GET[workId] = |" . $_GET['workId'] . "|    " . "GET[EntryId] = |" . $_GET['EntryId'] . "|"); 
  if (isset($_GET['accepted']) && ($_GET['accepted'] !='') 
        && isset($_GET['rejected']) && ($_GET['rejected'] != '')
        && isset($_GET['workId']) && ($_GET['workId'] != '') && ($_GET['workId'] != 0)) {
    $_SESSION['workId'] = $_GET['workId'];
    $entryUpdateString = "UPDATE works set accepted = " .  $_GET['accepted'] . ", rejected = " . $_GET['rejected']
                       . " where workId=" . $_SESSION['workId'];
    debugLogLineQuery($entryUpdateString);
    $entryResult = mysql_query($entryUpdateString); 
    debugLogLine("Update Query Finished -- result = " . $entryResult); 
    debugLogQuery($entryResult, $entryUpdateString);
    $entryStatusChanged = true;
  }

  // PERFORM CURATION DATA UPDATES
  //echo "isset(GET[UpdateCurationData])=" . isset($_GET['UpdateCurationData']) . "   |" . $_GET['UpdateCurationData'] . "|<br>";
  if (isset($_GET['UpdateCurationData']) && ($_GET['UpdateCurationData'] == 'YES')) {
    saveCuratorData($_GET['workId']);
  }
  else if (($_POST['CuratorChangeCount'] > 0) && ($_POST['SaveCuratorChangesFirst'] == 'yes')) saveCuratorData($_SESSION['workId']);

   
  // READ the VALUES FROM the DATABASE FOR DISPLAY
	$workSelectString = "select personId, name, organization, city, stateProvRegion, country, workId, title, yearProduced, "
									 . "designatedId, runTime, webSite, accepted, rejected, country, submissionFormat, originalFormat, "
									 . "synopsisOriginal, previouslyShownAt, permissionsAtSubmission, people.notes, works.submissionNotes "
									 . "from works join people on (people.personId=works.submitter) "
									 . "where workId=" . $_GET['workId'];
  debugLogLineQuery($workSelectString);
	$workQueryResult = mysql_query($workSelectString); 
  debugLogQuery($workQueryResult, $workSelectString);
  debugLogLine("Select Query Finished -- result = " . $workQueryResult); 

  if ($workQueryResult) $workRow = mysql_fetch_array($workQueryResult);

	$revenueSelectString = "select sum(amtPaid) from works where callForEntries=1"; 

	// and into contributorsArray
	$contributorSelectAllResult = selectContributors2($_GET['workId'], 'all');
	
  // and into the Curation Data Scores and Notes
	$curationDataSelectString = "select entry, curator, score, notes from curation where entry = " . $_GET['workId'];
  debugLogLineQuery($curationDataSelectString);
	$curationDataQueryResult = mysql_query($curationDataSelectString); 
  debugLogQuery($curationDataQueryResult, $curationDataSelectString);
  debugLogLine("Select Query Finished -- result = " . $curationDataQueryResult); 

	while ($curationDataQueryResult && ($curationRow = mysql_fetch_array($curationDataQueryResult))) {
	  switch ($curationRow['curator']) {
	    case 1: { 
	      $_SESSION['notesDL'] = $curationRow['notes']; 
	      if (($curationRow['score'] >= 1) && ($curationRow['score'] <= 10)) $_SESSION['scoreDL'] = $curationRow['score']; else $_SESSION['scoreDL'] = '--'; 
	      break;
	    }
	    case 5: { 
	      $_SESSION['notesAB'] = $curationRow['notes']; 
	      if (($curationRow['score'] >= 1) && ($curationRow['score'] <= 10)) $_SESSION['scoreAB'] = $curationRow['score']; else $_SESSION['scoreAB'] = '--'; 
	      break;
	    }
	    case 38: { 
	      $_SESSION['notesME'] = $curationRow['notes']; 
	      if (($curationRow['score'] >= 1) && ($curationRow['score'] <= 10)) $_SESSION['scoreME'] = $curationRow['score']; else $_SESSION['scoreME'] = '--'; 
	      break;
	    }
	  }
	  /*
	  echo "setting curation data. curator=" . $curationRow['curator'] . "  score=" . $curationRow['score'] 
	                                         . "   SESSION[scoreAB]=" . $_SESSION['scoreAB'] 
	                                         . "   SESSION[scoreME]=" . $_SESSION['scoreME'] 
	                                         . "   SESSION[scoreDL]=" . $_SESSION['scoreDL'] 
	                                         . "<br>";
	  */
	}

	// TODO: update the corresponding Summary Information row. This plan didn't work.
	// The echo is a trial balloon for the following conditional echo.
  /*
	echo "<script type='text/javascript'>" . $_SESSION['CurationDocument'] . ".getElementById('entryId-49').innerHTML='xyz';</script>";
	if ($entryStatusChanged) {
	  $jsFunction = "document.getElementById('entryId-" . $_GET['workId'] . "').innerHTML = " . entrySummaryDisplay($workRow) . ";" ;
	  echo "<script type='text/javascript'><!-- onload='$jsFunction' --></script>";
  }
  */

?>
<!-- display Entry Details enclosed in a table -->

<table width="100%" cellspacing="0" cellpadding="0" border="0" align="left">

<!-- display Film Title & Year Produced Information -->
<!-- <tr><td class="entryFormSectionHeading">Entry Details<hr class="horizontalSeparatorFull"></td></tr> -->
<tr><td class="bodyTextOnDarkGrayRowPadded"><?php echo "<span style='font-size: 15px'>" . $workRow['designatedId'] 
                                         . ". </span><span class='curationTitle'>" . $workRow['title'] . "</span> (" 
                                         . $workRow['yearProduced'] . ")&nbsp; &nbsp; &nbsp;" 
                                         . "<span class='filmInfoSubtitleText'>run time: </span><span style='font-size: 15px'>" 
                                         . $workRow['runTime'] . "</span>&nbsp; &nbsp; &nbsp;" 
                                         . acceptanceDisplay($workRow['accepted'], $workRow['rejected']) . "&nbsp; &nbsp; &nbsp;" 
                                         . "  <span style='color:#DF7416'>" . substr(getDbScoreFor($workRow), 0, 3) 
                                         . "</span>"; ?></td></tr>

<!-- display Submitter Information -->
<?php
  $cityLineExists = false; 
  $countryExists = (isset($workRow['country']) && ($workRow['country'] != ''));
?>
  <tr><td class="bodyTextOnDarkGrayRowPadded">
    <?php echo "<span class='filmInfoSubtitleText'>Submitted by: </span>" . $workRow['name'] . ", ";
          if (isset($workRow['organization']) && ($workRow['organization'] != '')) { echo $workRow['organization'] . ", "; }
          if (isset($workRow['city']) && ($workRow['city'] != '')) { $cityLineExists = true; echo $workRow['city'] . ", "; }; 
          if (isset($workRow['stateProvRegion']) && ($workRow['stateProvRegion'] != '')) { $cityLineExists = true; echo $workRow['stateProvRegion']; }
          if ($cityLineExists && $countryExists) { echo ", "; }
          if ($countryExists) { echo $workRow['country']; }
    ?>
  </td></tr>

<!-- display Media Information -->
<tr><td class="bodyTextOnDarkGrayRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Submitted as </span>" . $workRow['submissionFormat'] 
                                        . "<span class='filmInfoSubtitleText'>. Originally recorded as </span>" 
                                        . originalFormatDisplay($workRow['originalFormat']) 
                                        . ".&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span class='filmInfoSubtitleText'>Release: </span>" 
                                        . $workRow['permissionsAtSubmission'] . ".<br>"; ?></td></tr>

<!-- display Contributor Information -->
<tr><td class="bodyTextOnDarkGrayRowPadded"><span class='filmInfoSubtitleText'>Contributors:</span>
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
    echo " &nbsp; <span class='filmInfoSubtitleText'>" . $row['role'] .": </span>" . $row['name'];
//    echo "&nbsp;&nbsp;&nbsp;<span class='filmInfoSubtitleText'>" . $row['role'] .": </span>" . $row['name'] . "<br>";
  }
}

// handle display
if ($rowsDisplayed == 0) echo "No contributors are listed.";

?>
</td></tr>
<!-- display the Rest of the Entry Information -->
<tr><td class="bodyTextOnDarkGrayRowPadded"><?php echo "<span class='filmInfoSubtitleText'>Synopsis: </span>" . $workRow['synopsisOriginal'] ?></td></tr>
<?php if ( $workRow['webSite'] != '') echo "<tr><td class='bodyTextOnDarkGrayRowPadded'><span class='filmInfoSubtitleText'>Website: </span><a href='" . $workRow['webSite'] . "'>" . $workRow['webSite'] . "</a></td></tr>" ?>
<?php if ( $workRow['previouslyShownAt'] != '') echo "<tr><td class='bodyTextOnDarkGrayRowPadded'><span class='filmInfoSubtitleText'>Also shown at: </span>" . $workRow['previouslyShownAt'] . "</td></tr>" ?>
<?php if ( $workRow['notes'] != '') echo "<tr><td class='bodyTextOnDarkGrayRowPadded'><span class='filmInfoSubtitleText'>Submitter notes: </span>" . $workRow['notes'] . "</td></tr>" ?>
<?php if ( $workRow['submissionNotes'] != '') echo "<tr><td class='bodyTextOnDarkGrayRowPadded'><span class='filmInfoSubtitleText'>Entry notes: </span>" . $workRow['submissionNotes'] . "</td></tr>" ?>

<tr><td class="bodyTextOnDarkGray" align="center">
	<form name="CurationDataEntryForm" id="curationDataEntryForm" action="entryDetail.php" method="post"><div style="margin:6px 0 6px 0;padding:12px 0 12px 0;border:1px dashed #FFFFCC">
		<table width="84%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="28">
					<input type="hidden" id="entryId" name="EntryId" value= <?php $workRow['workId'] ?> > 
					<input type="button" id="accept" name="Accept" value="Accept" <?php echo "onClick=acceptEntry(" . $workRow['workId'] . ");" ?> >&nbsp;&nbsp;&nbsp;
					<input type="button" id="reject" name="Reject" value="Reject" <?php echo "onClick=rejectEntry(" . $workRow['workId'] . ");" ?> >&nbsp;&nbsp;&nbsp;
					<input type="button" id="clear" name="Clear" value="Clear" <?php echo "onClick=clearEntryStatus(" . $workRow['workId'] . ");" ?> >
				</td>
			</tr>
		</table>
	</div></form>
</td></tr>

<tr><td class="bodyTextOnDarkGray">
	<form action="curationDataForm.php" method="post" name="CurationData"><div style="padding:12px 0 12px 0;border:1px dashed #FFFFCC"><table align="center" width="96%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" valign="middle" class="bodyTextOnDarkGray" width="15%">&nbsp;Ana&nbsp;
				<input type="hidden" id="curatorChangeCount" name="CuratorChangeCount" value=0 > 
				<input type="hidden" id="saveCuratorChangesFirst" name="SaveCuratorChangesFirst" value='yes' > 
				<input type="hidden" id="workId" name="WorkId" value=<?php echo $workRow['workId'] ?> > 
			</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray" width="15%">&nbsp;
				<select name="ScoreAB" id="scoreAB" style="align:center" onChange="javascript:curatorMadeAChange(5);">
          <option value ="--" <?php if ($_SESSION['scoreAB']=="--") echo "selected='selected'" ?> >--</option>
					<option value ="1" <?php if ($_SESSION['scoreAB']=='1') echo "selected='selected'" ?> >&nbsp;1</option>
					<option value ="2" <?php if ($_SESSION['scoreAB']=='2') echo "selected='selected'" ?> >&nbsp;2</option>
					<option value ="3" <?php if ($_SESSION['scoreAB']=='3') echo "selected='selected'" ?> >&nbsp;3</option>
					<option value ="4" <?php if ($_SESSION['scoreAB']=='4') echo "selected='selected'" ?> >&nbsp;4</option>
					<option value ="5" <?php if ($_SESSION['scoreAB']=='5') echo "selected='selected'" ?> >&nbsp;5</option>
					<option value ="6" <?php if ($_SESSION['scoreAB']=='6') echo "selected='selected'" ?> >&nbsp;6</option>
					<option value ="7" <?php if ($_SESSION['scoreAB']=='7') echo "selected='selected'" ?> >&nbsp;7</option>
					<option value ="8" <?php if ($_SESSION['scoreAB']=='8') echo "selected='selected'" ?> >&nbsp;8</option>
					<option value ="9" <?php if ($_SESSION['scoreAB']=='9') echo "selected='selected'" ?> >&nbsp;9</option>
					<option value ="10" <?php if ($_SESSION['scoreAB']=='10') echo "selected='selected'" ?> >10</option>
			</select>&nbsp;</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:6px 0 6px 0"><textarea rows="2" cols="200" 
			  name="NotesAB" id="notesAB" class="curationFormTextArea" onChange="javascript:curatorMadeAChange(5);"><?php echo $_SESSION['notesAB']; ?></textarea></td>
			<td width="5%">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" valign="middle" class="bodyTextOnDarkGray">&nbsp;Michelle&nbsp;</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray">&nbsp;
				<select name="ScoreME" id="scoreME" style="align:center" onChange="javascript:curatorMadeAChange(38);">
					<option value ="--" <?php if ($_SESSION['scoreME']=="--") echo "selected='selected'" ?> >--</option>
					<option value ="1" <?php if ($_SESSION['scoreME']=='1') echo "selected='selected'" ?> >&nbsp;1</option>
					<option value ="2" <?php if ($_SESSION['scoreME']=='2') echo "selected='selected'" ?> >&nbsp;2</option>
					<option value ="3" <?php if ($_SESSION['scoreME']=='3') echo "selected='selected'" ?> >&nbsp;3</option>
					<option value ="4" <?php if ($_SESSION['scoreME']=='4') echo "selected='selected'" ?> >&nbsp;4</option>
					<option value ="5" <?php if ($_SESSION['scoreME']=='5') echo "selected='selected'" ?> >&nbsp;5</option>
					<option value ="6" <?php if ($_SESSION['scoreME']=='6') echo "selected='selected'" ?> >&nbsp;6</option>
					<option value ="7" <?php if ($_SESSION['scoreME']=='7') echo "selected='selected'" ?> >&nbsp;7</option>
					<option value ="8" <?php if ($_SESSION['scoreME']=='8') echo "selected='selected'" ?> >&nbsp;8</option>
					<option value ="9" <?php if ($_SESSION['scoreME']=='9') echo "selected='selected'" ?> >&nbsp;9</option>
					<option value ="10" <?php if ($_SESSION['scoreME']=='10') echo "selected='selected'" ?> >10</option>
			</select>&nbsp;</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:6px 0 6px 0"><textarea rows="2" cols="200" 
			  name="NotesAB" id="notesME" class="curationFormTextArea" onChange="javascript:curatorMadeAChange(38);"><?php echo $_SESSION['notesME']; ?></textarea></td>
			<td width="5%">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" valign="middle" class="bodyTextOnDarkGray">&nbsp;David&nbsp;</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray">&nbsp;
				<select name="scoreDL" id="scoreDL" style="align:center" onChange="javascript:curatorMadeAChange(1);">
					<option value ="--" <?php if ($_SESSION['scoreDL']=="--") echo "selected='selected'" ?> >--</option>
					<option value ="1" <?php if ($_SESSION['scoreDL']=='1') echo "selected='selected'" ?> >&nbsp;1</option>
					<option value ="2" <?php if ($_SESSION['scoreDL']=='2') echo "selected='selected'" ?> >&nbsp;2</option>
					<option value ="3" <?php if ($_SESSION['scoreDL']=='3') echo "selected='selected'" ?> >&nbsp;3</option>
					<option value ="4" <?php if ($_SESSION['scoreDL']=='4') echo "selected='selected'" ?> >&nbsp;4</option>
					<option value ="5" <?php if ($_SESSION['scoreDL']=='5') echo "selected='selected'" ?> >&nbsp;5</option>
					<option value ="6" <?php if ($_SESSION['scoreDL']=='6') echo "selected='selected'" ?> >&nbsp;6</option>
					<option value ="7" <?php if ($_SESSION['scoreDL']=='7') echo "selected='selected'" ?> >&nbsp;7</option>
					<option value ="8" <?php if ($_SESSION['scoreDL']=='8') echo "selected='selected'" ?> >&nbsp;8</option>
					<option value ="9" <?php if ($_SESSION['scoreDL']=='9') echo "selected='selected'" ?> >&nbsp;9</option>
					<option value ="10" <?php if ($_SESSION['scoreDL']=='10') echo "selected='selected'" ?> >10</option>
			</select>&nbsp;</td>
			<td align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:6px 0 6px 0"><textarea rows="2" cols="200" 
			  name="NotesAB" id="notesDL" class="curationFormTextArea" onChange="javascript:curatorMadeAChange(1);"><?php echo $_SESSION['notesDL']; ?></textarea></td>
			<td width="5%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" align="center" valign="middle" class="bodyTextOnDarkGray" style="padding:12px 0 6px 0">
			  <!-- <input type="submit" id="updateCurationData" name="UpdateCurationData" value="Save Changes"> -->
			  <input type="button" id="updateCurationData" name="UpdateCurationData" value="Save Changes"
			    <?php echo "onClick=saveCuratorDataJS(" . $workRow['workId'] . ");" ?> > 
			</td>
		</tr>
	</table>
	</div>
	</form>
</td></tr>
</table>