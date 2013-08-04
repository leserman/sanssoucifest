<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Pragma" content="no-cache">
  <META http-equiv="Expires" content="-1"> 
  <META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>SSF - Curation Data Entry Detail</title>
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
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" style="border:0px solid blue;" >
  <tr><td align="left" valign="top">
    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" style="border:0px solid pink;">
      <tr>
        <td width="10" align="center" valign="top">&nbsp;</td>
        <td width="125" align="center" valign="top">&nbsp;<!-- SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__));  --></td>
        <td align="center" valign="top">
          <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000" class="programTablePageBackground" style="border:0px solid red;">
            <tr>
              <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
              <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
              <td align="center" valign="top" class="bodyTextGrayLight">
                <table width="98%" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333" border="0" style="border:0px solid green;">
<!-- BEGIN emptyEntryDetail rows -->
                  <tr>
                    <td>
                      <div id='entryDetail'>
<?php
  SSFDebug::globalDebugger()->becho('GET[callContext]', $_GET['callContext'], -1);
  include_once 'curationEntryDetail.php';
?>
                      </div>
                    </td>
                  </tr>
<!-- END emptyEntryDetail rows -->
                  <tr align="center" valign="top">
                    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"
                          style="padding-top:0px;padding-bottom:8px;"><?php SSFWebPageAssets::displayCopyrightLine();?></td>
                  </tr>
                </table>
              </td>
              <td width="10" align="left" valign="top" style="border:0px solid orange;" class="programTablePageBackground">&nbsp;</td>
              <td width="25" align="left" valign="top" style="border:0px solid orange;" class="sprocketHoles">&nbsp;</td>
            </tr>
          </table>
        </td>
        <td width="10" align="center" valign="top">&nbsp;</td>
      </tr>
    </table>
  </td></tr>
</table>
</body>
</html>
