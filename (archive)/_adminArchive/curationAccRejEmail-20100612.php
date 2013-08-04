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
  <script src="../bin/scripts/flyoverPopup-1.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<SCRIPT type="text/javascript">
//<!-- 
window.name='CurationAccRejEmailWindow';
//-->
</SCRIPT>
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
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="<?php echo SSFCodeBase::relPathFor(__FILE__, 'images/titleBarGrayLight.gif'); ?>" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
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
                  <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;
                                                                          float:left;margin:0 4px 6px 4px;background-color:black;'>
      <?php //print_r($ADEState); echo "<br>\r\n\r\n"; //print_r($_POST); 
      ?> 
                  </div>
                  <div style="clear:both;"></div>
                  <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Curation Acceptance/Rejection Email
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
                        
  $curationStateAcceptanceFilter = '';
  $curationStateMediaFilter = '';
  $curationStateSort1 = ((isset($_POST['Sort1'])) ? $_POST['Sort1'] : '');
  $curationStateSort2 = ((isset($_POST['Sort2'])) ? $_POST['Sort2'] : '');
  
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && ($_POST['callForEntriesId'] != '')) 
                             SSFRunTimeValues::setCallForEntriesId($_POST['callForEntriesId']); // changed 2/16/10 & 2/18/10
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId($_POST['callForEntriesId']); // changed 2/16/10

  $curationStateQueryFilterString = ($callForEntriesId == 0) ? 'TRUE' : 'callForEntries=' . $callForEntriesId;
  $entryStatusSubsetText = '';

  // Compute SQL Acceptance filter
  if (isset($_POST['AcceptanceFilter'])) {
    $curationStateAcceptanceFilter = $_POST['AcceptanceFilter'];
    switch ($_POST['AcceptanceFilter']) {
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
        $curationStateHavingClauseForScore .= " having avg(score) is null ";
				$entryStatusSubsetText = " for all Entries without a Score";
				break;
		}
  }

  // Compute SQL Email filter
  if (isset($_POST['AREmailFilter'])) {
    $curationStateAREmailFilter = $_POST['AREmailFilter'];
    switch ($_POST['AREmailFilter']) {
			case "inclAll":
				$arEmailSubsetText = " without regard to having sent acceptance/rejection email";
				break;
			case "inclSent":
				$curationStateHavingClauseForEmail = "communications.type='AcceptReject' and communications.sent=1";
				$arEmailSubsetText = " having sent acceptance/rejection email";
				break;
			case "inclNotSent":
				$curationStateHavingClauseForEmail .= "(isnull(communications.type) or communications.type!='AcceptReject' or communications.sent!=1)";
				$arEmailSubsetText = " not having sent acceptance/rejection email";
				break;
		}
  }
  
  // compute SQL Sort By clause
  SSFQuery::computeSortClauseAndText($_POST['Sort1'], $_POST['Sort2']);
  $curationStateQuerySortString = SSFQuery::getQuerySortString();
  //echo 'curationStateQuerySortString = |' . $curationStateQuerySortString . "|<br>\r\n";
  $curationStateSortText = SSFQuery::getQuerySortDisplayText();
  if ($curationStateQuerySortString == '') {
    $curationStateQuerySortString = ' designatedId ASC';
    $curationStateSortText = ' sorted by Id';  
  }

  if (($curationStateHavingClauseForScore!="") && ($curationStateHavingClauseForEmail!="")) $curationStateHavingClause = " having " . $curationStateHavingClauseForScore . " and " . $curationStateHavingClauseForEmail . " ";
  else if ($curationStateHavingClauseForScore!="") $curationStateHavingClause = " having " . $curationStateHavingClauseForScore . " ";
  else if ($curationStateHavingClauseForEmail!="") $curationStateHavingClause = " having " . $curationStateHavingClauseForEmail . " ";
  else $curationStateHavingClause = "";  

?>
                      <tr>
                        <td>
                          <table width="96%" align="center" cellspacing="0" cellpadding="0" border="0">
														<tr>
															<td align="center">
																<form name="CurationFilterSortForm" id="curationFilterSortForm" action="curationAccRejEmail.php" method="post"> 
																	<table width="100%" align="center" cellspacing="0" cellpadding="0" border="0">
																		<tr>
																			<td align="left" height="28" class="entryFormField" style="padding:12px 12px 0 12px;">
																				<table border="0" cellspacing="0" cellpadding="2" style="padding-right:12px;border-right:1px solid white;">
                                          <tr>
                                            <td rowspan="3" align="right" valign="middle" style="border-right:1px solid white"><span class="entryFormField" style="padding:12px 0 6px 0;"><span style="color:#FFFF66;font-size:16px">Filters:&nbsp;&nbsp;</span></span></td>
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
                                            <td align="right" valign="middle" style="padding-left:6px;"><span class="bodyTextOnDarkGray">&nbsp;Acc/Rej&nbsp;Email:</span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:12px 0 6px 0">
                                              <select id="ARemailFilter" name="AREmailFilter" onChange="document.CurationFilterSortForm.submit();">
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
<?php HTMLGen::displayEntryPropertySortSelector('CurationFilterSortForm', 'sort1', 'Sort1', $curationStateSort1) ?>
                                            </span></td>
                                          </tr>
                                          <tr>
                                            <td align="right" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0"><span class="bodyTextOnDarkGray">&nbsp;Secondary:</span></span></td>
                                            <td align="left" valign="middle"><span class="entryFormField" style="padding:6px 0 0 0">
<?php HTMLGen::displayEntryPropertySortSelector('CurationFilterSortForm', 'sort2', 'Sort2', $curationStateSort2) ?>
                                            </span></td>
                                          </tr>
                                        </table>
																			</td>
                                      <td rowspan="2" align="left" valign="middle" width="100%" class="entryFormField" style="padding:12px 6px 6px 12px;">
                                          <input type="submit" id="doIt" name="DoIt" value="Apply Filters & Sort"><br><br>
                                          <div id="totalsDisplay" class="bodyTextOnDarkGray" style='color:#FFFF66'>Totals: </div>
                                        </td>
																		</tr>
																	</table>
																</form>
															</td>
														</tr>
                            <tr>
                              <td class="sectionHeading" style="padding-top:4px"><?php echo "Summary Information" . $entryStatusSubsetText . $arEmailSubsetText . $sortText; ?>  
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
                                                $curationStateQuerySortString, $curationStateHavingClause, $showAcceptRejectEmailInfo);
  //print_r($theWorks); echo "<br>\r\n";
  //HTMLGen::displayAREmailEntryList($curationStateQueryFilterString, $curationStateQuerySortString, $curationStateHavingClause);
  echo HTMLGen::getTheWorkRows($theWorks, $displayQuickNotes=false, $showAcceptRejectEmailInfo);
  $totalsDisplay = HTMLGen::getTotalsDisplay($theWorks);
  echo '<script type="text/javascript">document.getElementById("totalsDisplay").innerHTML="' . $totalsDisplay . '";</script>';
?>
                                </div>
                              </td>
                            </tr>
                            <tr><td>
                              <div id='emptyEntryDetail'>
                                <div class="entryFormSectionHeading">
                                  <div style="padding-top:4px;">Entry Detail</div>
                                  <div><hr class="horizontalSeparatorFull"></div>
                                  <div style="padding-bottom:24px;">Pick an entry above. The curation data will appear here.</div>
                                  <a name='bottom'></a>
                                </div>
                              </div>
                              <div id='entryDetail'>
                              </div>
                            </td></tr>
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
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
    <?php SSFWebPageAssets::displayCopyrightLine();?></td>
		<td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
</html>
