<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Pay Entry Fee</title>
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
                      <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" bgcolor="#333333">
                        <tr><td align="left" valign="top" class="programPageTitleText" style="padding-top:12px;">Pay Entry Fee</td></tr>
                        <!-- TODO To Do: validate this entry form -->
                        <tr><td align="center" valign="top" class="bodyTextOnBlack">
                          <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                            <!-- See documentation at https://www.x.com/docs/DOC-1331#id08A6HH00W2J -->
                            <table cellspacing="0" cellpadding="0" width="98%" align="center">
                              <tr><td>
                                <input type="hidden" name="amount" value="25.00">
                                <input type="hidden" name="item_name" value="Entry Fee $25 USD">
<!-- 
                                <input type="hidden" name="amount" value="40.00">
                                <input type="hidden" name="item_name" value="Entry Fee $40 USD">
-->
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="payment@sanssoucifest.org">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="page_style" value="Primary">
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="rm" value="2"> <!-- return to SSF Success page with a POST -->
                                <input type="hidden" name="return" value="http://sanssoucifest.org/paypal/successfulEntryFeePayment.php">
                                <input type="hidden" name="cancel_return" value="http://sanssoucifest.org/paypal/cancelEntryFeePayment.php">
                                <!-- <input type="hidden" name="cn" value="Film Title, Submitter Name, Submitter Email"> -->
                                <!-- <input type="hidden" name="lc" value="US"> -->
                                <input type="hidden" name="bn" value="PP-BuyNowBF">
                                <input type="hidden" id="first_name" name="first_name" value="">
                                <input type="hidden" id="last_name" name="last_name" value="">
                                <input type="hidden" name="on0" value="Film Title">
                                <input type="hidden" name="on1" value="Submitter Email Address">
                              </td></tr>
                              <tr><td colspan="2"><table width="90%" align="center" cellpadding="0" cellspacing="0" style="padding:6px 0 24px 0;">  
                                <tr>
                                  <td width="43%" align="right" valign="middle" class="bodyTextOnBlack" style="padding:20px 0 3px 0;">Film Title:&nbsp;</td>
                                  <td width="57%" align="left" valign="middle" style="padding:20px 0 3px 0;""><input type="text" id="os0" name="os0" maxlength="250"></td>
                                </tr>
                                <tr>
                                  <td align="right" valign="middle" class="bodyTextOnBlack" style="padding:3px 0 3px 0;">Submitter Email:&nbsp;</td>
                                  <td align="left" valign="middle" class="bodyTextOnBlack" style="padding:3px 0 3px 0;"><input type="text" id="os1" name="os1" maxlength="127"></td>
                                </tr>
                                <tr>
                                    <!-- EARLY: src="../images/PayEarlyEntryFeeNowButton.gif" alt="Use PayPal to Pay the $25 USD Early Entry Fee Now" -->
                                    <!-- FINAL: src="../images/PayEntryFeeNowButton.gif" alt="Use PayPal to Pay the $40 USD Entry Fee Now" -->
                                  <td colspan="2" align="center" valign="middle"><input name="submit" align="middle" type="image" style="margin:20px 0 20px 0;"
                                    src="../images/PayEarlyEntryFeeNowButton.gif" alt="Use PayPal to Pay the $25 USD Early Entry Fee Now"></td>
                                </tr>
<tr><td>
<?php 
  echo "<script type='text/javascript'>\r\n";
  if (isset($_GET['works_title'])) echo "  document.getElementById('os0').value = " . $_GET['works_title'] . "\r\n";;
  if (isset($_GET['people_email'])) echo "  document.getElementById('os1').value = " . $_GET['people_email'] . "\r\n";
  if (isset($_GET['people_firstName'])) echo "  document.getElementById('first_name').value = " . $_GET['people_firstName'] . "\r\n";
  if (isset($_GET['people_lastName'])) echo "  document.getElementById('last_name').value = " . $_GET['people_lastName'] . "\r\n";
  echo "</script>\r\n";
?>
</td></tr>
                                <tr>
                                  <td colspan="2" align="center"  width="80%" valign="middle">
                                    <blockquote class="bodyTextOnBlack" style="width:70%;margin:0 auto;">Note: 
                                    <!-- TODO Draw this text from the database via RunTimeValues. -->
                                    To qualify for the Early Entry Fee,
                                    <!-- For us to consider your work for our 2010 showings, ... -->
                                    both your payment <em>and</em> your media materials must arrive with us by the deadline, 5 &nbsp;PM on Friday, 
                                    <!-- TODO Draw this text from the database via RunTimeValues. -->
                                    April&nbsp;30,&nbsp;2010.
                                    <!-- May&nbsp;28,&nbsp;2010. -->
                                    </blockquote>
                                  </td>
                                </tr>
                              </table></td></tr>
                            </table>
                          </form>
                        </td></tr>
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
<!-- InstanceEnd -->
</html>
