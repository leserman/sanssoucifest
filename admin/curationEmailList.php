<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Pragma" content="no-cache">
  <META http-equiv="Expires" content="-1"> 
  <META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>SSF - Curation Email</title>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<!-- NOTE: This file, curationEmailList.php is derived from curationAccRejEmail.php -->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  
  // This function handles an anomoly in a query where one null row might be returned in the case that the ORDER BY clause contains a computed variable. 
  // E.g., SELECT * FROM ((SELECT personId, name, score, titleForSort, workId, workId as work, title, designatedId, runTime, avg(score) as avgScore FROM works LEFT JOIN people on people.personId=works.submitter LEFT JOIN curation on curation.entry=works.workId LEFT JOIN curators on curators.curator=curation.curator WHERE works.callForEntries=11 AND curators.isActive = 1 AND (curators.curator = 832 or curators.curator = 5 or curators.curator = 1) GROUP BY works.workId ORDER BY avg(score) ASC, designatedId ASC) AS worksSelected) JOIN ((SELECT communicationId, `type`, dateSent, `work` FROM communicationWork LEFT JOIN communications on communications.communicationId=communicationWork.communication AND communications.type='AcceptReject' WHERE (dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00') ) AS commsSelected) ON commsSelected.work=worksSelected.workId ORDER BY avg(score) ASC
  function willTheRealWorksPleaseStandUp($theWorks) {
    if ((count($theWorks) == 1) && (!isset($theWorks[0]['workId']) || ($theWorks[0]['workId'] == ''))) $theRealWorks = array();
    else $theRealWorks = $theWorks;
    return $theRealWorks;
  }
  
?>
<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>
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
              <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
                <div>
                  <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Curation Acceptance/Rejection Email
<?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?>
                  </div>
                  <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
                    <a href="../admin" target="curationEmail">Admin Home</a> </div>
                  <div style="clear:both"></div>
                </div>
              </td>
						</tr>
						<tr>
             <td class="bodyTextLeadedOnBlack" align="left"></td>
						</tr>
<?php
                        
  $curationStateAcceptanceFilter = '';
  $curationStateHavingClauseForScore = '';
  $curationStateAREmailFilter = '';
//  $curationStateSort1 = ((isset($_POST['Sort1'])) ? $_POST['Sort1'] : '');
//  $curationStateSort2 = ((isset($_POST['Sort2'])) ? $_POST['Sort2'] : '');
////  $displayQuickNotes = ((isset($_POST['showQuickNotes'])) ? $_POST['showQuickNotes'] == 'on' : false);
//  $displayQuickNotesCookieName = HTMLGen::cookieName("CurationEmailFilterSortForm", "showQuickNotes");
//  $displayQuickNotesCookieExists = ((isset($_COOKIE[$displayQuickNotesCookieName])) && $_COOKIE[$displayQuickNotesCookieName] != '');
//  $displayQuickNotes = (isset($_POST['showQuickNotes'])) ? ($_POST['showQuickNotes'] == 'on')
//                                                          : ($displayQuickNotesCookieExists ? $_COOKIE[$displayQuickNotesCookieName] == 'true' : false);

  // Initialization
  
  $sortCookieName1 = HTMLGen::cookieName("CurationEmailFilterSortForm", "sort1");
  $sortCookie1Exists = ((isset($_COOKIE[$sortCookieName1])) && $_COOKIE[$sortCookieName1] != '');
  $curationStateSort1 = (isset($_POST['Sort1'])) ? $_POST['Sort1'] 
                                              : ($sortCookie1Exists ? $_COOKIE[$sortCookieName1] : 'idSort');
  $sortCookieName2 = HTMLGen::cookieName("CurationEmailFilterSortForm", "sort2");
  $sortCookie2Exists = ((isset($_COOKIE[$sortCookieName2])) && $_COOKIE[$sortCookieName2] != '');
  $curationStateSort2 = (isset($_POST['Sort2'])) ? $_POST['Sort2'] 
                                              : ($sortCookie2Exists ? $_COOKIE[$sortCookieName2] : 'idSort');

  $displayQuickNotesCookieName = HTMLGen::cookieName("CurationEmailFilterSortForm", "showQuickNotes");
  $displayQuickNotesCookieExists = ((isset($_COOKIE[$displayQuickNotesCookieName])) && $_COOKIE[$displayQuickNotesCookieName] != '');
//  $displayQuickNotes = ((isset($_POST['showQuickNotes'])) ? $_POST['showQuickNotes'] == 'on' : false);
  $displayQuickNotes = (isset($_POST['showQuickNotes'])) ? ($_POST['showQuickNotes'] == 'on')
                                                          : ($displayQuickNotesCookieExists ? $_COOKIE[$displayQuickNotesCookieName] == 'true' : false);
//  $displayQuickNotes = ($displayQuickNotesCookieExists ? $_COOKIE[$displayQuickNotesCookieName] == 'true' : false);


  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && ($_POST['callForEntriesId'] != '')) 
                             SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']); 
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId(); 

  $curationStateQueryFilterString = ($callForEntriesId == 0) ? 'TRUE' : 'works.callForEntries=' . $callForEntriesId;
  $entryStatusSubsetText = '';

  // Compute SQL Acceptance filter
//  $curationStateAcceptanceFilter = (isset($_POST['AcceptanceFilter'])) ? $_POST['AcceptanceFilter'] : 'inclAll';
  $acceptanceFilterCookieName =  HTMLGen::cookieName("CurationEmailFilterSortForm", "acceptanceFilter");
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

  // Compute SQL Email filter
//  $curationStateAREmailFilter = (isset($_POST['AREmailFilter'])) ? $_POST['AREmailFilter'] : 'inclAll';
  $curationStateAREmailFilterCookieName =  HTMLGen::cookieName("CurationEmailFilterSortForm", "arEmailFilter");
  $curationStateAREmailFilterExists = ((isset($_COOKIE[$curationStateAREmailFilterCookieName])) && $_COOKIE[$curationStateAREmailFilterCookieName] != '');
  $curationStateAREmailFilter = (isset($_POST['AREmailFilter'])) ? $_POST['AREmailFilter'] 
                                 : ($curationStateAREmailFilterExists ? $_COOKIE[$curationStateAREmailFilterCookieName] : 'inclAll');

// TODO: 7/8/12: It appears that $curationStateHavingClauseForEmail is set here, but then never used, having been replaced by $curationStateHavingClauseForScore.
//               So, referenced to $curationStateHavingClauseForEmail should be removed from the code.
  switch ($curationStateAREmailFilter) {
    case "inclAll":
      $curationStateHavingClauseForEmail = "true";
      $arEmailSubsetText = " without regard to having sent acceptance/rejection email";
      break;
    case "inclSent":
      // Note that the column "sent" is computed in SSFQuery::selectAccRejWorkRow() where this clause is ultimately used.
      $curationStateHavingClauseForEmail = "communications.type='AcceptReject' and sent=1";
      $arEmailSubsetText = " having sent acceptance/rejection email";
      break;
    case "inclNotSent":
//      $curationStateHavingClauseForEmail .= "(isnull(communications.type) or communications.type!='AcceptReject' or sent!=1)";
      $curationStateHavingClauseForEmail = "(isnull(communications.type) or communications.type!='AcceptReject' or sent!=1)";
      $arEmailSubsetText = " not having sent acceptance/rejection email";
      break;
  }
  
  // compute SQL Sort By clause
  SSFQuery::computeSortClauseAndText($curationStateSort1, $curationStateSort2);
  $curationStateQuerySortString = SSFQuery::getQuerySortString();
  //echo 'curationStateQuerySortString = |' . $curationStateQuerySortString . "|<br>\r\n";
  $curationStateSortText = SSFQuery::getQuerySortDisplayText();
  if ($curationStateQuerySortString == '') {
    $curationStateQuerySortString = ' designatedId ASC';
    $curationStateSortText = ' sorted by Id';  
  }

/*
if (($curationStateHavingClauseForScore!="") && ($curationStateHavingClauseForEmail!="")) 
    $curationStateHavingClause = " having " . $curationStateHavingClauseForScore . " and " . $curationStateHavingClauseForEmail . " ";
  else if ($curationStateHavingClauseForScore!="") $curationStateHavingClause = " having " . $curationStateHavingClauseForScore . " ";
  else if ($curationStateHavingClauseForEmail!="") $curationStateHavingClause = " having " . $curationStateHavingClauseForEmail . " ";
  else $curationStateHavingClause = "";  
*/
?>
                      <tr>
                        <td>
                          <table width="98%" align="center" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td align="center">
																<form name="CurationEmailFilterSortForm" id="curationEmailFilterSortForm" action="curationEmailList.php" method="post"> 
																	<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
																		<tr>
                                      <td align="left" height="28" class="entryFormField" style="padding:0px 12px 0 12px;">
																				<table border="0" cellspacing="0" cellpadding="2" style="padding-right:12px;border-right:1px solid white;">
                                          <tr>
                                            <td rowspan="3" align="right" valign="middle" style="border-right:1px solid white"><span class="entryFormField" style="padding:12px 0 6px 0;"><span style="color:#FFFF66;font-size:16px">Filters:&nbsp;&nbsp;</span></span></td>
                                            <td align="right" valign="middle"><span class="bodyTextOnDarkGray">&nbsp;Call&nbsp;for:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
<?php HTMLGen::displayCallForEntriesSelector('CurationEmailFilterSortForm') ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle"><span class="bodyTextOnDarkGray">&nbsp;&nbsp;Entry&nbsp;Status:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
<?php HTMLGen::displayEntryStatusFilterSelector('CurationEmailFilterSortForm', $curationStateAcceptanceFilter) ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle" style="padding-left:6px;"><span class="bodyTextOnDarkGray">&nbsp;Acc/Rej&nbsp;Email:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
<?php $setARemailFilterCookieText = HTMLGen::cookieSetterAction("CurationEmailFilterSortForm", "arEmailFilter"); ?>
                                              <select id="ARemailFilter" name="AREmailFilter" 
                                                      onChange=<?php echo '"' . $setARemailFilterCookieText . 'document.CurationEmailFilterSortForm.submit();"'; ?> >
                                                <option value ="inclAll" 
                                                        <?php if ($curationStateAREmailFilter=="inclAll") echo "selected='selected'" ?> >All</option>
                                                <option value ="inclNotSent" 
                                                       <?php if ($curationStateAREmailFilter=="inclNotSent") echo "selected='selected'" ?> >Not Sent</option>
                                                <option value ="inclSent" 
                                                       <?php if ($curationStateAREmailFilter=="inclSent") echo "selected='selected'" ?> >Sent</option>
                                              </select>
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
<?php HTMLGen::displayEntryPropertySortSelector('CurationEmailFilterSortForm', 'sort1', 'Sort1', $curationStateSort1) ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0"><span class="bodyTextOnDarkGray">&nbsp;Secondary:</span></span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0">
<?php HTMLGen::displayEntryPropertySortSelector('CurationEmailFilterSortForm', 'sort2', 'Sort2', $curationStateSort2) ?>
                                            </span></td>
                                          </tr>
                                        </table>
																			</td>
                                      <td rowspan="2" align="left" valign="middle" width="100%" class="entryFormField" style="padding:0px 6px 0px 12px;">
<?php HTMLGen::displayAdministratorSelector("padding-left:0px;padding-top:4px;", "rowTitleTextNarrow", "document.curationEmailFilterSortForm.submit();", "curationList"); ?>
<!--                                        <div style="margin-top:2px;"><input type="submit" id="doIt" name="DoIt" value="Apply Filters & Sort"></div> -->
                                        <div style="margin-top:6px;font-weight:bold;color:#D25EC0;">
                                          <input type="checkbox" id="showQuickNotes" name="showQuickNotes"
                                              onchange="<?php echo HTMLGen::checkboxCookieSetterAction('CurationEmailFilterSortForm','showQuickNotes');?>submit();"
                                            <?php echo ($displayQuickNotes) ? 'checked=checked' : '';  ?>> Q</div>
                                        <div id="totalsDisplay" class="bodyTextOnDarkGray" style='color:#FFFF66;margin-top:8px;'>Totals: </div>
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
  $showAcceptRejectEmailInfo = true;
//  SSFQuery::debugNextQuery();
  $theWorks = SSFQuery::selectCuratedWorksArray($curationStateQueryFilterString, 
//                                                $curationStateQuerySortString, $curationStateHavingClause, $curationStateHavingClauseForEmail);
                                                $curationStateQuerySortString, $curationStateHavingClauseForScore, $curationStateAREmailFilter);
  $theWorks = willTheRealWorksPleaseStandUp($theWorks);
  echo HTMLGen::getTheWorkRows($theWorks, $displayQuickNotes, $showAcceptRejectEmailInfo);
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
