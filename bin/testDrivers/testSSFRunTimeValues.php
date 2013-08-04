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
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td align="center" valign="top" width="620" class="bodyTextOriginalGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div class='bodyTextOnBlack' style="background-color:#333333;color:#CCCCCC;text-align:left;float:none;">
<?php

  function formattedTime($time) {
    $rFormatTime = date('r', $time);
    $eFormatTime = date('e', $time);
    $iFormatTime = date('I', $time);
    $formattedTime = $rFormatTime . ' ' . (($iFormatTime == 1) ? 'DST ' : ' ') . $eFormatTime;
    return $formattedTime;
  }
  
    echo "<br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'getCallForEntriesId(): ', SSFRunTimeValues::getCallForEntriesId() . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . 'getCurrentCallImagesDirectory(): ', SSFRunTimeValues::getCurrentCallImagesDirectory() . "<br>\r\n";
    echo "<br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;getDefaultAdministratorId: ' . SSFRunTimeValues::getDefaultAdministratorId() . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;getAdministratorId: ' . SSFRunTimeValues::getAdministratorId() . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;getDefaultWorkId: ' . SSFRunTimeValues::getDefaultWorkId() . "<br>\r\n";
    echo "<br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'date NOW format "r e": ', date('r  e') . "<br>\r\n";    
    echo '&nbsp;&nbsp;&nbsp;' . 'date NOW format "c": ', date('c') . "<br>\r\n";    
    echo "<br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'getEarlyDeadlineDateString(): ', SSFRunTimeValues::getEarlyDeadlineDateString() . "<br>\r\n";
    $earlyDeadlineTime = SSFRunTimeValues::midnightEndingTimeFor(SSFRunTimeValues::getEarlyDeadlineDateString());
    echo '&nbsp;&nbsp;&nbsp;' . 'Early Deadline: ', formattedTime($earlyDeadlineTime) . "<br>\r\n";    
    echo '&nbsp;&nbsp;&nbsp;' . 'Early Deadline w 1 hr gratis: ', formattedTime($earlyDeadlineTime + (60 * 60)) . "<br>\r\n";    
    echo '&nbsp;&nbsp;&nbsp;' . 'earlyDeadlineHasPassed(): ', (SSFRunTimeValues::earlyDeadlineHasPassed() ? 'YES' : 'NO') . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . 'getEarlyDeadlineFeeString(): ', '$' . SSFRunTimeValues::getEarlyDeadlineFeeString() . "<br>\r\n";
    echo "<br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'getFinalDeadlineDateString(): ', SSFRunTimeValues::getFinalDeadlineDateString() . "<br>\r\n";
    $finalDeadlineTime = SSFRunTimeValues::midnightEndingTimeFor(SSFRunTimeValues::getFinalDeadlineDateString());
    echo '&nbsp;&nbsp;&nbsp;' . 'Final Deadline: ', formattedTime($finalDeadlineTime) . "<br>\r\n";    
    echo '&nbsp;&nbsp;&nbsp;' . 'Final Deadline w 1 hr gratis: ', formattedTime($finalDeadlineTime + (60 * 60)) . "<br>\r\n";    
    echo '&nbsp;&nbsp;&nbsp;' . 'finalDeadlineHasPassed(): ', (SSFRunTimeValues::finalDeadlineHasPassed() ? 'YES' : 'NO') . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . 'getFinalDeadlineFeeString(): ', '$' . SSFRunTimeValues::getFinalDeadlineFeeString() . "<br>\r\n";
    echo "<br>\r\n";
    
    $testDateArrayDesc = array('Yesterday', 'Today', 'Tomorrow');
    $yesterday = time() - (24 * 60 * 60);
    $day = $yesterday;
    echo '<span style="color:purple;">&nbsp;&nbsp;&nbsp;Gratis deadline is midnightEndingTimeFor($deadlineDateString) + $oneHour</span>' . "<br>\r\n";
    for ($i = 0; $i < 3; $i++) {
      $dayFormattedForOutput = date('l, Y-M-d', $day);
      $dayFormattedForDateHasPassed = date('Y-m-d', $day);
      SSFDebug::globalDebugger()->becho('dayFormattedForDateHasPassed', $dayFormattedForDateHasPassed, -1);
      echo '&nbsp;&nbsp;&nbsp;Gratis deadline for ' . $testDateArrayDesc[$i] . ', ' . $dayFormattedForOutput . ', ' 
                                                    . (SSFRunTimeValues::dateHasPassed($dayFormattedForDateHasPassed) ? 'has passed' : 'is in the future') . "<br>\r\n";
      $day += (24 * 60 * 60);
    }
    echo "<br><br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;<span style="color:#99CCFF;">|</span>Note: Blue vertical bars designate the beginnings and endings of long strings like this one that has a blank line at the end.<br><span style="color:#99CCFF;">|</span>' . "<br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:#99CCFF;">|</span>Note: When you enter this information, use "&lt;br&gt;" where you want a Carriage Return.<span style="color:#99CCFF;">|</span>' . "<br><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:purple;">Permissions/Release Info</span>' . "<br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoStatementIntro: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoStatementIntroString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoWidgetIntro: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoWidgetIntroString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'getPermissionAllOKString(): ', SSFRunTimeValues::getPermissionAllOKString() . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . 'getPermissionAllOKDiosplay(): <span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getPermissionAllOKDisplay() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoWidgetAllOK: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoWidgetAllOKString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoStatementAllOK: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoStatementAllOKString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;' . 'getPermissionAskMeString(): ', SSFRunTimeValues::getPermissionAskMeString() . "<br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . 'getPermissionAskMeDisplay(): <span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getPermissionAskMeDisplay() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoWidgetAskMe: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoWidgetAskMeString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;' . '<span style="color:orange;">releaseInfoStatementAskMe: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">', SSFRunTimeValues::getReleaseInfoStatementAskMeString() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo "<br><br>\r\n";

    echo '&nbsp;&nbsp;&nbsp;<span style="color:purple;">Acceptance/Rejection Message Parts</span>' . "<br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgAcceptanceMessagePart2: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getAcceptanceMessagePart2() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgImageDetailPart: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getImageDetailPart() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgInstallationExplanationPart: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getInstallationExplanationPart() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgInviteFeedbackRequestPart: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getInviteFeedbackRequestPart() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgPlugTheShowPart: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getPlugTheShowPart() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgRejectionMessagePart2: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getRejectionMessagePart2() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgRejectionWithinAcceptanceMessage: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getRejectionWithinAcceptanceMessage() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgVenueDirectionsPart: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getVenueDirectionsPart() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";
    echo '&nbsp;&nbsp;&nbsp;<span style="color:orange;">arMsgVenueTitle: </span><span style="color:#99CCFF;">|</span><span style="text-decoration:underline;">' . SSFRunTimeValues::getVenueTitle() . "</span><span style='color:#99CCFF;'>|</span><br><br>\r\n";

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
