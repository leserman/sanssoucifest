<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
  <title>SSF Acknowledgement-Receipt Email List</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <script src="../bin/scripts/login.js" type="text/javascript"></script>
  <script src="../bin/scripts/validateEmailAddress.js" type="text/javascript"></script>
  <style type="text/css">padded{padding:0.25em 0pt;}</style>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
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
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
              <div style="background-color:#333333;align:center;">
                <div class="programPageTitleText" style="padding-top:30px;">Acknowledgement-Receipt Email List</div>
                <div style="height:10px;align:center;valign:middle;"><hr align="center" size="1" noshade class="horizontalSeparator1"></div>
                <br>
                  <table width='98%' align="center" cellpadding="0" cellspacing="0" border="0">
                  <?php
                    $priorName = '';
                    $rows = SSFDB::getDB()->getArrayFromQuery('select name, email, title, dateMediaReceived, photoLocation from people join works on submitter=personId where callForEntries=7 order by lastName');
                    foreach ($rows as $row) {
                      echo '<tr><td class="datumValue" style="padding:2px 6px;margin:1px 2px 1px 2px;vertical-align:top;border-top:black 1px solid;border-left:black 1px solid;">'
                           . (($priorName == $row['name']) ? '' : $row['name']) 
                           . '</td><td class="datumValue" style="padding:2px 6px;margin:1px 2px 1px 2px;vertical-align:top;border-top:black 1px solid;border-left:black 1px solid;">' 
                           . (($priorName == $row['name']) ? '' : ($row['name'] . ' &lt;' . $row['email'] . '&gt;')) 
                           . '</td><td class="datumValue" style="padding:2px 6px;margin:1px 2px 1px 2px;vertical-align:top;border-top:black 1px solid;border-left:black 1px solid;">' 
                           . $row['title'] . '</td></tr>';
                      $priorName = $row['name'];
                    }
                  ?>
                  </table>
                <br><br>
              </div>
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