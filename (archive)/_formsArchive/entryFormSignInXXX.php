<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Data Entry Sign In</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../scripts/login.js" type="text/javascript"></script>
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../scripts/validateEmailAddress.js" type="text/javascript"></script>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
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
<DIV id="dek">
<SCRIPT type="text/javascript">
//<!--
  initFlyoverPopup();
//-->
</SCRIPT>
</DIV>
          <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
            <tr>
              <td align="center" valign="bottom" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br clear="all">
                Entry Form Sign In</td>
            </tr>
            <tr>
              <td height="30" align="center" valign="middle"><hr align="center" size="1" noshade class="horizontalSeparator1"></td>
            </tr>
            <tr>
              <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">
                <form onSubmit="return validateLogin()" action="entryForm2010.php" method="post" name="ProcessLogin">
                  <table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in.</td></tr>
                    <tr>
                      <td height="28" align="right" class="entryFormDescription" style="width:242px;"> 
                        <a href="javascript:window.void(0)" onMouseOver="flyoverPopup('Your login name is your email address.')"
                          onMouseOut="killFlyoverPopup()" onClick="window.alert('Your login name is your email address.')">Email Aaddress / Login Name</a>: </td>
                      <!-- Changed 8/18/08: value="BMoCA200804" to value="Highways2008". -->
                      <td height="28" align="left" class="entryFormField"><input type="text" name="EmailAddressUID" id="emailAddressUID" 
                           value="" class="entryFormInputFieldShort" onBlur="processLoginUID(this.value)" maxlength="100">
                           <input type="hidden" id="callForEntriesName" name="CallForEntriesName" value="Boulder2010"></td>
                    </tr>
                    <tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0">If you have a password and you know what it is, enter it below.</td></tr>
                    <tr>
                      <td height="28" align="right" class="entryFormDescription">Password: </td>
                      <td height="28" align="left" class="entryFormField"><input type="password" name="Password" id="password" 
                         value="" class="entryFormInputFieldShorter" onBlur="submitLogin(document.getElementById(\'emailAddressUID\'),this.value)" maxlength="100"><span 
                         class="entryFormDescription"> (leave blank if unknown)</span></td>
                    </tr>
                    <tr>
                      <td colspan="2" height="28" align="center" style="padding-top:10px"><input type="submit" id="submit" name="Submit" value="Sign In"></td>
                    </tr>
                  </table>
                </form>
              </td>
            </tr>
          </table>
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