<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Pragma" content="no-cache">
  <META http-equiv="Expires" content="-1"> 
  <META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>SSF - Curate</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<div id='currentEntryIdCache' style='display:none;'>511</div> <!-- This div has been replaced by a cookie of the same name. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
    <td align="center" valign="top">
      <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
      <tr>
        <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
        <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
        <td align="center" valign="top" class="bodyTextGrayLight">
          <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
            <tr>
              <td align="center" valign="top" style="background-color:#333;padding-bottom:4px;">
                <div>
                  <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;
                                                                          float:left;margin:0 4px 6px 4px;background-color:black;'>
                  </div>
                  <div style="clear:both;"></div>
                  <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Curate
<?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?>
                  </div>
                  <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
                    <a href="../admin">Admin Home</a> </div>
                  <div style="clear:both"></div>
                </div>
              </td>
            </tr>
            <tr>
             <td class="bodyTextLeadedOnBlack" align="left"></td>
           </tr>
<?php

  SSFDebug::globaldebugger()->belch('_POST', $_POST, -1); 
  SSFDebug::globaldebugger()->becho('_COOKIE[ssf_locallyActiveCurators]', (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : 'Not set', -1); 
  SSFDebug::globaldebugger()->belch('_COOKIE', $_COOKIE, -1); 

  // Initialization
  
  $sortCookieName1 = HTMLGen::cookieName("CurationFilterSortForm", "sort1");
  $sortCookie1Exists = ((isset($_COOKIE[$sortCookieName1])) && $_COOKIE[$sortCookieName1] != '');
  $sortIndexValue1 = (isset($_POST['Sort1'])) ? $_POST['Sort1'] 
                                              : ($sortCookie1Exists ? $_COOKIE[$sortCookieName1] : 'idSort');
  $sortCookieName2 = HTMLGen::cookieName("CurationFilterSortForm", "sort2");
  $sortCookie2Exists = ((isset($_COOKIE[$sortCookieName2])) && $_COOKIE[$sortCookieName2] != '');
  $sortIndexValue2 = (isset($_POST['Sort2'])) ? $_POST['Sort2'] 
                                              : ($sortCookie2Exists ? $_COOKIE[$sortCookieName2] : 'idSort');

  $displayQuickNotesCookieName = HTMLGen::cookieName("CurationFilterSortForm", "showQuickNotes");
  $displayQuickNotesCookieExists = ((isset($_COOKIE[$displayQuickNotesCookieName])) && $_COOKIE[$displayQuickNotesCookieName] != '');
//  $displayQuickNotes = ((isset($_POST['showQuickNotes'])) ? $_POST['showQuickNotes'] == 'on' : false);
  $displayQuickNotes = (isset($_POST['showQuickNotes'])) ? ($_POST['showQuickNotes'] == 'on')
                                                          : ($displayQuickNotesCookieExists ? $_COOKIE[$displayQuickNotesCookieName] == 'true' : false);
//  $displayQuickNotes = ($displayQuickNotesCookieExists ? $_COOKIE[$displayQuickNotesCookieName] == 'true' : false);

  $curationStateHavingClauseForScore = '';
  
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && ($_POST['callForEntriesId'] != '')) 
                                                   SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']);
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();

  $curationStateQueryFilterString = ($callForEntriesId == 0) 
                                  ? 'TRUE' 
                                  : 'works.callForEntries=' . $callForEntriesId . ' AND curators.callForEntries = ' . $callForEntriesId;
  $entryStatusSubsetText = '';

  // Compute SQL Acceptance filter
  $acceptanceFilterCookieName =  HTMLGen::cookieName("CurationFilterSortForm", "acceptanceFilter");
  $acceptanceFilterExists = ((isset($_COOKIE[$acceptanceFilterCookieName])) && $_COOKIE[$acceptanceFilterCookieName] != '');
  $curationStateAcceptanceFilter = (isset($_POST['AcceptanceFilter'])) ? $_POST['AcceptanceFilter'] 
                                 : ($acceptanceFilterExists ? $_COOKIE[$acceptanceFilterCookieName] : 'inclAll');
  switch ($curationStateAcceptanceFilter) {
    case "inclAll":
      $entryStatusSubsetText = " for all Entries";
      break;
    case "inclAccepted":
      $curationStateQueryFilterString .= " and accepted=1";
      $entryStatusSubsetText = " for all Accepted Entries";
      break;
    case "inclRejected":
      $curationStateQueryFilterString .= " and rejected=1";
      $entryStatusSubsetText = " for all Rejected Entries";
      break;
    case "inclUndecided":
      $curationStateQueryFilterString .= " and accepted=0 and rejected=0";
      $entryStatusSubsetText = " for all Undecided Entries";
      break;
    case "inclAccUnd":
      $curationStateQueryFilterString .= " and (accepted=1 or accepted=rejected)";
      $entryStatusSubsetText = " for all Accepted & Undecided Entries";
      break;
    case "inclRejUnd":
      $curationStateQueryFilterString .= " and (rejected=1 or accepted=rejected)";
      $entryStatusSubsetText = " for all Rejected & Undecided Entries";
      break;
    case "inclAccRej":
      $curationStateQueryFilterString .= " and (accepted=1 or rejected=1)";
      $entryStatusSubsetText = " for all Accepted & Rejected Entries";
      break;
    case "inclNoScore":
      $curationStateHavingClauseForScore .= " avg(score) is null ";
      $entryStatusSubsetText = " for all Entries without a Score";
      break;
  }

/* // No longer in use.
  // Compute SQL Media filter 
  $curationStateMediaFilter = '';
  $mediaSubsetText = '';
  if (isset($_POST['MediaFilter'])) {
    $curationStateMediaFilter = $_POST['MediaFilter'];
    switch ($_POST['MediaFilter']) {
      case "inclAll":
        $mediaSubsetText = " on DVD or miniDV";
        break;
      case "inclDVD":
        $curationStateQueryFilterString .= " and submissionFormat='DVD'";
        $mediaSubsetText = " on DVD";
        break;
      case "inclMiniDV":
        $curationStateQueryFilterString .= " and submissionFormat='miniDV'";
        $mediaSubsetText = " on miniDV";
        break;
    }
  }
*/
  
  // compute SQL Sort By clause
  SSFQuery::computeSortClauseAndText($sortIndexValue1, $sortIndexValue2);
  $curationStateQuerySortString = SSFQuery::getQuerySortString();
  //echo 'curationStateQuerySortString = |' . $curationStateQuerySortString . "|<br>\r\n";
  $curationStateSortText = SSFQuery::getQuerySortDisplayText();
  if ($curationStateQuerySortString == '') {
    $curationStateQuerySortString = ' designatedId ASC';
    $curationStateSortText = ' sorted by Id';  
  }  
  
?>
                      <tr>
                        <td>
                          <table width="98%" align="center" cellspacing="0" cellpadding="0" border="0">
                            <tr>
                              <td align="center">
                                <form name="CurationFilterSortForm" id="curationFilterSortForm" action="curationList.php" method="post" style="margin-bottom:0;"> 
                                  <table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                      <td align="left" height="28" class="entryFormField" style="padding:0px 12px 0 12px;">
                                        <table border="0" cellspacing="0" cellpadding="2" style="padding-right:12px;border-right:1px solid white;">
                                          <tr>
                                            <td rowspan="2" align="right" valign="middle" style="border-right:1px solid white"><span class="entryFormField" style="padding:12px 0 6px 0;"><span style="color:#FFFF66;font-size:16px">Filters:&nbsp;&nbsp;</span></span></td>
                                            <td align="right" valign="middle"><span class="bodyTextOnDarkGray">&nbsp;Call&nbsp;for:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
<?php HTMLGen::displayCallForEntriesSelector('CurationFilterSortForm') ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle"><span class="bodyTextOnDarkGray">&nbsp;&nbsp;Entry&nbsp;Status:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
<?php HTMLGen::displayEntryStatusFilterSelector('CurationFilterSortForm', $curationStateAcceptanceFilter) ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td colspan="3" align="right" valign="middle" style="font-size:6px">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td rowspan="2" align="right" valign="middle" style="border-right:1px solid white;"><span class="entryFormField" style="padding:6px 0 0 0;"><span 
                                              class="bodyTextOnDarkGray"><span style="color:#FFFF66;font-size:16px">Sort:&nbsp;&nbsp;</span></span></span></td>
                                            <td align="right" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0"><span class="bodyTextOnDarkGray">&nbsp;Primary:</span></span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0">
<?php HTMLGen::displayEntryPropertySortSelector('CurationFilterSortForm', 'sort1', 'Sort1', $sortIndexValue1) ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0"><span class="bodyTextOnDarkGray">&nbsp;Secondary:</span></span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0">
<?php HTMLGen::displayEntryPropertySortSelector('CurationFilterSortForm', 'sort2', 'Sort2', $sortIndexValue2) ?>
                                            </span></td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td rowspan="2" align="left" valign="middle" width="100%" class="entryFormField" style="padding:0px 6px 0px 12px;">
<!--                                          <div style="margin-top:2px;"><input type="submit" id="doIt" name="DoIt" value="Apply Filters & Sort"></div> -->
                                          <div style="margin-top:2px;">
<?php HTMLGen::displayAdministratorSelector("padding-left:0px;padding-top:0px;", "rowTitleTextNarrow", "document.curationFilterSortForm.submit();", "curationList"); ?>
<?php HTMLGen::addCuratorCheckBoxWidgetRow('CurationFilterSortForm', $callForEntriesId, 'Curators', 4); ?>
                                          </div>
                                          <div style="margin-top:2px;font-weight:bold;color:#D25EC0;">
                                            <input type="checkbox" id="showQuickNotes" name="showQuickNotes" 
                                              onchange="<?php echo HTMLGen::checkboxCookieSetterAction('CurationFilterSortForm','showQuickNotes');?>submit();"
                                              <?php echo ($displayQuickNotes) ? 'checked=checked' : '';  ?>> Q</div>
                                          <div id="totalsDisplay" class="bodyTextOnDarkGray" style='color:#FFFF66;margin-top:2px;'>Totals: </div>
                                        </td>
                                    </tr>
                                  </table>
                                </form>
                              </td>
                            </tr>
<!-- BEGIN theWorksList rows -->
                            <tr>
                              <td class="sectionHeading" style="padding-top:0px;margin-top:0px;"><?php // echo "Summary Information" . $entryStatusSubsetText . $mediaSubsetText . $curationStateSortText; ?>
                                <hr class="horizontalSeparatorFull">
                              </td>
                            </tr>
                            <tr>
                              <td class="bodyTextOnDarkGray" id='entryListCell'>
                                <div id='theWorksList' style="display:block;">
<?php 
//  SSFQuery::debugNextQuery();
//  SSFQuery::debugOn();
  $theWorks = SSFQuery::selectCuratedWorksArray($curationStateQueryFilterString, $curationStateQuerySortString, $curationStateHavingClauseForScore);
//  SSFQuery::debugOff();
  //print_r($theWorks); echo "<br>\r\n";
  echo HTMLGen::getTheWorkRows($theWorks, $displayQuickNotes);
  $totalsDisplay = HTMLGen::getTotalsDisplay($theWorks);
  echo '<script type="text/javascript">document.getElementById("totalsDisplay").innerHTML="' . $totalsDisplay . '";</script>';
?>
                                </div>
                              </td>
                            </tr>
<!-- END theWorksList rows -->
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
</table>
</td></tr></table>
</body>
</html>
