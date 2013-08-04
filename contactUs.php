<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Contact Us</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="sanssouci.css" type="text/css">
  <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top">
            <?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar();
            ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
   <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
		  <tr><td align="left" valign="top" class="programPageTitleText"><img src="images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br>
					&nbsp;&nbsp;Contact Us<br>
					<img src="images/dotClear.gif" alt="" width="1" height="24" hspace="0" vspace="0" border="0" align="middle"></td>
			</tr>
      <tr><td align="center" valign="top">
			  <img src="images/TubBabe.jpg" alt="Tub Babe" width="300" height="199"><br><img src="images/dotClear.gif" alt="" width="1" height="24" hspace="0" vspace="0" border="0" align="middle"><br>
<?php 
  $emailAddr = SSFRunTimeValues::getContactEmailAddress();
  echo '        <a href="mailto:' . $emailAddr . '">' . $emailAddr . '</a><br>' . "\r\n"; 
?>
        <br>
        <span class="bodyTextLeadedOnBlack">Please <a href="mailto:mailme@sanssoucifest.org?subject=Add me to your email list&body=Edit below as appropriate.%0A%0AAdd me to your email list for Events.%0A%0AAdd me to your email list for Calls for Entries.%0A%0ARemove me from your email list.%0A%0A">click here</a> to be
        added to<br>
        or removed from our email mailing list.</span><br>
        <img src="images/dotClear.gif" alt="" width="1" height="24" hspace="0" vspace="0" border="0" align="middle">
        <br></td></tr></table>
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