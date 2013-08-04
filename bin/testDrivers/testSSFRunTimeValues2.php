<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
  <title>SSF - Test Run Time Values</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<?php 
  include_once '../../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="630"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="600" align="center" valign="top"><table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
    <tr>
    <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
    <td width="530" align="left" valign="top" class="bodyTextGrayLight">
<?php

  $debugger = new SSFDebug();

  function dateHasPassed($deadlineDateString) {
    global $debugger;
    $deadlineDate = explode('-', $deadlineDateString);
    $debugger->belch('deadlineDate', $deadlineDate, 1);
    $deadline = mktime(23, 59, 59, $deadlineDate[1], $deadlineDate[2], $deadlineDate[0], true) + 61;
    $deadlineString = date('Y-m-d H:i:s', $deadline);
    $debugger->becho('deadlineString', $deadlineString, 1);
    $dateHasPassed = (time() > $deadline);
    $debugger->becho('', time() . ' time', 1);
    $debugger->becho('', $deadline. ' deadline', 1);
    return $dateHasPassed;
  }
  
/*
    $debugger->becho('2010-04-29', (dateHasPassed('2010-04-29') ? 'PAST' : 'FUTURE'), 1);
    $debugger->becho('2010-04-30', (dateHasPassed('2010-04-30') ? 'PAST' : 'FUTURE'), 1);
    $debugger->becho('2010-05-01', (dateHasPassed('2010-05-01') ? 'PAST' : 'FUTURE'), 1);
*/
    $debugger->becho('2010-04-29', (SSFRunTimeValues::dateHasPassed('2010-04-29') ? 'PAST' : 'FUTURE'), 1);
    $debugger->becho('2010-04-30', (SSFRunTimeValues::dateHasPassed('2010-04-30') ? 'PAST' : 'FUTURE'), 1);
    $debugger->becho('2010-05-01', (SSFRunTimeValues::dateHasPassed('2010-05-01') ? 'PAST' : 'FUTURE'), 1);
    
    $debugger->becho('getEarlyDeadlineDateString()', SSFRunTimeValues::getEarlyDeadlineDateString(), 1);
    $debugger->becho('getEarlyDeadlineFeeString()', SSFRunTimeValues::getEarlyDeadlineFeeString(), 1);
    $debugger->becho('getFinalDeadlineDateString()', SSFRunTimeValues::getFinalDeadlineDateString(), 1);
    $debugger->becho('getFinalDeadlineFeeString()', SSFRunTimeValues::getFinalDeadlineFeeString(), 1);
  
    $debugger->becho('earlyDeadlineHasPassed()', SSFRunTimeValues::earlyDeadlineHasPassed(), 1);
    $debugger->becho('finalDeadlineHasPassed()', SSFRunTimeValues::finalDeadlineHasPassed(), 1);

?>
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
<!-- InstanceEnd -->
</html>
