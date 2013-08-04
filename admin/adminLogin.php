<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Administrator Data Entry Login</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src="../bin/scripts/login.js" type="text/javascript"></script>
<script src="../bin/scripts/validateEmailAddress.js" type="text/javascript"></script>
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
                  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
                    <tr>
                      <td align="center" valign="bottom" class="programPageTitleText"><img src="../images/dotClear.gif" alt="" width="1" height="12" hspace="0" vspace="0" border="0" align="middle"><br clear="all">
                        <?php echo "PHP"; ?> SSF Administrator Data Entry </td>
                    </tr>
                    <tr>
                      <td height="30" align="center" valign="middle"><hr align="center" size="1" noshade class="horizontalSeparator1"></td>
                    </tr>
                    <tr>
                      <td align="center" valign="middle" class="bodyTextWithEmphasisOnBlack">
                      <form onSubmit="return validateLogin()" action="worksDataEntry.php" method="post" name="Login" id="login">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                          <tbody>
                            <tr>
                              <td style="padding: 8px 0 0 0;" height="28" align="center" valign="top" class="bodyTextOnBlack">Login Id: 
                                <input type="text" maxlength="100" onBlur="processLoginUID(this.value)" class="entryFormInputFieldShort" value="" id="emailAddressUID" name="EmailAddressUID"/>
                                <script language=Javascript>document.Login.emailAddressUID.focus();</script>
                                <!-- TODO: Allow user to choose the CallForEntriesName from a drop-down list.
                                <input type="hidden" value="Highways2008" name="CallForEntriesName" id="callForEntriesName"/> --> </td>
                            </tr>
                            <tr>
                              <td style="padding: 12px 0pt 18px;" class="loginPrompt">If you have a password and you know what it is,<br>
                                enter it below; otherwise, leave it blank.</td>
                            </tr>
                            <tr>
                              <td height="28" align="center" valign="top" class="bodyTextOnBlack">Password: 
                                <input type="password" maxlength="100" onBlur="submitLogin(document.getElementById('emailAddressUID'),this.value)" class="entryFormInputFieldShorter" value="" id="password" name="Password"/></td>
                            </tr>
                            <tr>
                              <td height="28" align="center" style="padding-top: 20px;"><input type="submit" value="Sign In" name="Submit" id="submit"/>
                              <br>
                              <br>
                              <br></td>
                            </tr>
                          </tbody>
                        </table>
                      </form>
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