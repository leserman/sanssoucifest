<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>Sans Souci Festival of Dance Cinema - Curation Data Form</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="databaseSupportFunctions.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><!-- #BeginLibraryItem "/Library/navBar.lbi" --><?php
  include_once "../bin/utilities/autoloadClasses.php";
  SSFWebPageAssets::displayNavBar();
?>
<!-- #EndLibraryItem --></td>
    <td align="center" valign="top">
      <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
      <tr>
        <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
        <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
        <td align="center" valign="top" class="bodyTextGrayLight">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
            <tr>
              <td align="left" valign="top" class="programPageTitleText" style="padding-top:8px;padding-left:8px;">Curation Data</td>
            </tr>
            <tr>
             <td class="bodyTextLeadedOnBlack" align="left"></td>
           </tr>
<?php
                        
  include '../bin/forms/entryFormFunctions.php';
  include 'dataEntryFunctions.php';
  include 'databaseSupportFunctions.php';
                        
  debugLogLine("submit = " . $_POST['Submit']);
                        
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
                        
  // TODO to do: get CallForEntriesName from a drop-down.
  $callForEntriesId = getCallForEntriesIdFromName('BMoCA200804');
  
//??  $_SESSION['CurationDocument'] = document;
  $_SESSION['AcceptanceFilter'] = '';
  $_SESSION['MediaFilter'] = '';
  $_SESSION['Sort1'] = '';
  $_SESSION['Sort2'] = '';
  $_SESSION['Sort3'] = '';
  
  $queryFilterString = 'callForEntries=' . $callForEntriesId;
  $querySortString = 'designatedId';
  $havingClauseForScore = '';
  $entryStatusSubsetText = '';
  $mediaSubsetText = '';
  $sortText = '';

  if (isset($_POST['AcceptanceFilter'])) {
    $_SESSION['AcceptanceFilter'] = $_POST['AcceptanceFilter'];
    switch ($_POST['AcceptanceFilter']) {
      case "inclAll":
        $entryStatusSubsetText = " for all Entries";
        break;
      case "inclAccepted":
        $queryFilterString .= " and accepted=1";
        $entryStatusSubsetText = " for all Accepted Entries";
        break;
      case "inclRejected":
        $queryFilterString .= " and rejected=1";
        $entryStatusSubsetText = " for all Rejected Entries";
        break;
      case "inclUndecided":
        $queryFilterString .= " and accepted=0 and rejected=0";
        $entryStatusSubsetText = " for all Undecided Entries";
        break;
      case "inclAccUnd":
        $queryFilterString .= " and (accepted=1 or accepted=rejected)";
        $entryStatusSubsetText = " for all Accepted & Undecided Entries";
        break;
      case "inclRejUnd":
        $queryFilterString .= " and (rejected=1 or accepted=rejected)";
        $entryStatusSubsetText = " for all Rejected & Undecided Entries";
        break;
      case "inclAccRej":
        $queryFilterString .= " and (accepted=1 or rejected=1)";
        $entryStatusSubsetText = " for all Accepted & Rejected Entries";
        break;
      case "inclNoScore":
        $havingClauseForScore .= " having avg(score) is null ";
        $entryStatusSubsetText = " for all Entries without a Score";
        break;
    }
  }

  if (isset($_POST['MediaFilter'])) {
    $_SESSION['MediaFilter'] = $_POST['MediaFilter'];
    switch ($_POST['MediaFilter']) {
      case "inclAll":
        $mediaSubsetText = " on DVD or miniDV";
        break;
      case "inclDVD":
        $queryFilterString .= " and submissionFormat='DVD'";
        $mediaSubsetText = " on DVD";
        break;
      case "inclMiniDV":
        $queryFilterString .= " and submissionFormat='miniDV'";
        $mediaSubsetText = " on miniDV";
        break;
    }
  }
  
  
  if (isset($_POST['Sort1'])) {
    $_SESSION['Sort1'] = $_POST['Sort1'];
    switch ($_POST['Sort1']) {
      case "idSort":
        $querySortString = " designatedId ASC";
        $sortText = " sorted by Id";
        break;
      case "formatSort":
        $querySortString = " submissionFormat ASC";
        $sortText = " sorted by Submission Format";
        break;
      case "durationSort":
        $querySortString = " runTime ASC";
        $sortText = " sorted by Duration";
        break;
      case "scoreSortUp":
        $querySortString = " avg(score) ASC";
        $sortText = " sorted by Average Score";
        break;
      case "scoreSortDn":
        $querySortString = " avg(score) DESC";
        $sortText = " sorted by Average Score";
        break;
      case "titleSort":
        $querySortString = " title ASC";
        $sortText = " sorted by Title";
        break;
      case "submitterSort":
        $querySortString = " lastname ASC, name ASC";
        $sortText = " sorted by Submitter Name";
        break;
      case "countrySort":
        $querySortString = " country ASC";
        $sortText = " sorted by Country of Origin";
        break;
      case "acceptedSort":
        $querySortString = "accepted DESC, rejected DESC";
        $sortText = " sorted by Acceptance Status";
        break;
    }
  }

  if (isset($_POST['Sort2'])) {
    $_SESSION['Sort2'] = $_POST['Sort2'];
    switch ($_POST['Sort2']) {
      case "idSort":
        $querySortString .= ", designatedId ASC";
        $sortText .= " and then by Id";
        break;
      case "formatSort":
        $querySortString .= ", submissionFormat ASC";
        $sortText .= " and then by Submission Format";
        break;
      case "durationSort":
        $querySortString .= ", runTime ASC";
        $sortText .= " and then by Duration";
        break;
      case "scoreSortUp":
        $querySortString .= ", avg(score) ASC";
        $sortText .= " and then by Average Score";
        break;
      case "scoreSortDn":
        $querySortString .= ", avg(score) DESC";
        $sortText .= " and then by Average Score";
        break;
      case "titleSort":
        $querySortString .= ", title ASC";
        $sortText .= " and then by Title";
        break;
      case "submitterSort":
        $querySortString = " lastname ASC, name ASC";
        $sortText = " sorted by Submitter Name";
        break;
      case "countrySort":
        $querySortString .= ", country ASC";
        $sortText .= " and then by Country of Origin";
        break;
      case "acceptedSort":
        $querySortString .= ", accepted DESC, rejected DESC";
        $sortText .= " and then by Acceptance Status";
        break;
    }
  }
  
  $_SESSION['FilterString'] = $queryFilterString;
  $_SESSION['SortString'] = $querySortString;
  $_SESSION['HavingClauseForScore'] = $havingClauseForScore;

?>
                      <tr>
                        <td>
                          <table width="96%" align="center" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                              <td align="center">
                                <form name="CurationFilterSortForm" id="curationFilterSortForm" action="curationDataForm.php" method="post"> 
                                  <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                      <td align="center" height="28" class="entryFormField" style="padding:12px 0 6px 0">
                                        <span class="bodyTextOnDarkGray"><span style="color:#FFFF66;font-size:16px">Filters:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entry Status: </span>
                                        <select id="acceptanceFilter" name="AcceptanceFilter">
                                          <option value ="inclAll" <?php if ($_SESSION["AcceptanceFilter"]=="inclAll") echo "selected='selected'" ?> >All</option>
                                          <option value ="inclAccepted" <?php if ($_SESSION["AcceptanceFilter"]=="inclAccepted") echo "selected='selected'" ?> >Accepted Only</option>
                                          <option value ="inclRejected" <?php if ($_SESSION["AcceptanceFilter"]=="inclRejected") echo "selected='selected'" ?> >Rejected Only</option>
                                          <option value ="inclUndecided" <?php if ($_SESSION["AcceptanceFilter"]=="inclUndecided") echo "selected='selected'" ?> >Undecided Only</option>
                                          <option value ="inclAccUnd" <?php if ($_SESSION["AcceptanceFilter"]=="inclAccUnd") echo "selected='selected'" ?> >Accepted &amp; Undecided</option>
                                          <option value ="inclRejUnd" <?php if ($_SESSION["AcceptanceFilter"]=="inclRejUnd") echo "selected='selected'" ?> >Rejected &amp; Undecided</option>
                                          <option value ="inclAccRej" <?php if ($_SESSION["AcceptanceFilter"]=="inclAccRej") echo "selected='selected'" ?> >Accepted &amp; Rejected</option>
                                          <option value ="inclNoScore" <?php if ($_SESSION["AcceptanceFilter"]=="inclNoScore") echo "selected='selected'" ?> >Unscored Only</option>
                                        </select>
                                        <span class="bodyTextOnDarkGray">&nbsp; &nbsp; Media: </span>
                                        <select id="mediaFilter" name="MediaFilter">
                                          <option value ="inclAll" <?php if ($_SESSION["MediaFilter"]=="inclAll") echo "selected='selected'" ?> >All</option>
                                          <option value ="inclDVD" <?php if ($_SESSION["MediaFilter"]=="inclDVD") echo "selected='selected'" ?> >DVDs Only</option>
                                          <option value ="inclMiniDV" <?php if ($_SESSION["MediaFilter"]=="inclMiniDV") echo "selected='selected'" ?> >MiniDVs Only</option>
                                        </select>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                      <td rowspan="2" align="center" style="padding:12px 0 6px 0" class="entryFormField"><input type="submit" id="doIt" name="DoIt" value="Do it."></td>
                                    </tr>
                                    <tr>
                                      <td align="center" height="28"class="entryFormField" style="padding:6px 0 0 0">
                                        <span class="bodyTextOnDarkGray"><span style="color:#FFFF66;font-size:16px">Sort:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Primary: </span>
                                        <select id="sort1" name="Sort1">
                                          <option value ="idSort" <?php if ($_SESSION["Sort1"]=="idSort") echo "selected='selected'" ?> >Id</option>
                                          <option value ="formatSort" <?php if ($_SESSION["Sort1"]=="formatSort") echo "selected='selected'" ?> >Media Format</option>
                                          <option value ="durationSort" <?php if ($_SESSION["Sort1"]=="durationSort") echo "selected='selected'" ?> >Film Duration</option>
                                          <option value ="acceptedSort" <?php if ($_SESSION["Sort1"]=="acceptedSort") echo "selected='selected'" ?> >Entry Status</option>
                                          <option value ="scoreSortUp" <?php if ($_SESSION["Sort1"]=="scoreSortUp") echo "selected='selected'" ?> >Average Score &#8593;</option>
                                          <option value ="scoreSortDn" <?php if ($_SESSION["Sort1"]=="scoreSortDn") echo "selected='selected'" ?> >Average Score &#8595;</option>
                                          <option value ="titleSort" <?php if ($_SESSION["Sort1"]=="titleSort") echo "selected='selected'" ?> >Film Title</option>
                                          <option value ="submitterSort" <?php if ($_SESSION["Sort1"]=="submitterSort") echo "selected='selected'" ?> >Submitter Name</option>
                                          <option value ="countrySort" <?php if ($_SESSION["Sort1"]=="countrySort") echo "selected='selected'" ?> >Country</option>
                                        </select>&nbsp;&nbsp;
                                        <span class="bodyTextOnDarkGray">&nbsp; &nbsp; Secondary: </span>
                                        <select id="sort2" name="Sort2">
                                          <option value ="idSort" <?php if ($_SESSION["Sort2"]=="idSort") echo "selected='selected'" ?> >Id</option>
                                          <option value ="formatSort" <?php if ($_SESSION["Sort2"]=="formatSort") echo "selected='selected'" ?> >Media Format</option>
                                          <option value ="durationSort" <?php if ($_SESSION["Sort2"]=="durationSort") echo "selected='selected'" ?> >Film Duration</option>
                                          <option value ="acceptedSort" <?php if ($_SESSION["Sort2"]=="acceptedSort") echo "selected='selected'" ?> >Entry Status</option>
                                          <option value ="scoreSortUp" <?php if ($_SESSION["Sort2"]=="scoreSortUp") echo "selected='selected'" ?> >Average Score &#8593;</option>
                                          <option value ="scoreSortDn" <?php if ($_SESSION["Sort2"]=="scoreSortDn") echo "selected='selected'" ?> >Average Score &#8595;</option>
                                          <option value ="titleSort" <?php if ($_SESSION["Sort2"]=="titleSort") echo "selected='selected'" ?> >Film Title</option>
                                          <option value ="submitterSort" <?php if ($_SESSION["Sort2"]=="submitterSort") echo "selected='selected'" ?> >Submitter Name</option>
                                          <option value ="countrySort" <?php if ($_SESSION["Sort2"]=="countrySort") echo "selected='selected'" ?> >Country</option>
                                        </select>
                                      </td>
                                    </tr>
                                  </table>
                                </form>
                              </td>
                            </tr>
                            <tr>
                              <td class="sectionHeading"><?php echo "Summary Information" . $entryStatusSubsetText . $mediaSubsetText . $sortText; ?>  
                                <hr class="horizontalSeparatorFull">
                              </td>
                            </tr>
                            <tr>
                              <td class="bodyTextOnDarkGray" id='entryListCell'>
<?php 
                                displayEntryList($_SESSION['FilterString'], $_SESSION['SortString'], $_SESSION['HavingClauseForScore']);
?>
                              </td>
                            </tr>
                            <tr><td class="sectionHeading" style="padding-top:18"><a name='detail'></a>Entry Detail<hr class="horizontalSeparatorFull"></td></tr>
                            <tr><td align="left" valign="top" class="bodyTextOnBlack"><div id='entryDetail'>Pick an entry above. The curation data will appear here.</div></td></tr>
                            <tr>
                              <td align="center" valign="top" class="bodyTextOnBlack">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    </tr></table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
<tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br><!-- #BeginLibraryItem "/Library/CopyrightContactBarOnBlack.lbi" --><?php SSFWebPageAssets::displayCopyrightLine();?><!-- #EndLibraryItem --></td>
    <td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
</html>
