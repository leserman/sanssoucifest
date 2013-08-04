<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - PayPal Payment Confirmed</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

SSFDebug::globalDebugger()->belch('_POST', $_POST, -1);
/*
Belch _POST: Array (
  [mc_gross] => 0.20
  [protection_eligibility] => Ineligible
  [payer_id] => 2MWWL6GHZPJRJ
  [tax] => 0.00
  [payment_date] => 02:01:17 Mar 07, 2010 PST
  [payment_status] => Completed
  [charset] => windows-1252
  [first_name] => David
  [option_selection1] => Yet Another Dance Video
  [option_selection2] => david@leserman.com
  [mc_fee] => 0.20
  [notify_version] => 2.9
  [custom] =>
  [payer_status] => unverified
  [business] => payment@sanssoucifest.org
  [quantity] => 1
  [payer_email] => david@leserman.com
  [verify_sign] => AZxbwZ9bPVPFFf7hCCNemacLJwlCANCUtBIKWiNPIfLlvOM-ERaBdpeN
  [option_name1] => Film Title
  [option_name2] => Submitter Email Address
  [memo] => Hi there.
  [txn_id] => 5K6527724P6212208
  [payment_type] => instant
  [last_name] => Leserman
  [receiver_email] => hamelb@sanssoucifest.org
  [payment_fee] => 0.20
  [receiver_id] => M96DXLMUDN4TW
  [txn_type] => web_accept
  [item_name] => Entry Fee $25 USD
  [mc_currency] => USD
  [item_number] => 1
  [residence_country] => US
  [transaction_subject] => Entry Fee $25 USD
  [handling_amount] => 0.00
  [payment_gross] => 0.20
  [shipping] => 0.00
  [merchant_return_link] => Return to Sans Souci Festival of Dance Cinema ) 
*/

  if (!SSFRunTimeValues::earlyDeadlineHasPassed()) {
    $entryFeeString = SSFRunTimeValues::getEarlyDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getEarlyDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">';
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">';
  } else {
    $entryFeeString = SSFRunTimeValues::getFinalDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getFinalDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">';
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">';
  }
?>
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
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight">
                    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="333333">
                      <tr>
                        <td align="left" valign="top" class="programPageTitleText" style="padding:20px 0 40px 0;">Paypal Entry Fee Payment Confirmation</td>
                      </tr>
                      <tr>
<!--
                        <td align="left" valign="top" class="bodyTextOnBlack" style="padding-bottom:50px;"><blockquote style="padding-right:14px;">
                          Thank you for paying your entry fee to the Sans Souci Festival of Dance Cinema via Paypal. You will receive an email
                          receipt from PayPal shortly. Please print the receipt and include a copy with your entry submission. Also, please
                          make sure that your materials arrive with us by the 
<p echo ((!SSFRunTimeValues::earlyDeadlineHasPassed()) ? 'early' : 'final') . ' submission deadline, 5 PM, ' . HTMLGen::displayDateFromDBDate($deadlineDateString) . '.'; ?>
                          <br><br>
                          Please send your media to
                          <div style="padding:8px 0 22px 26px;"><?php echo SSFRunTimeValues::getMailEntryToAddress(); ?></div>
                          Thanks for your submission. We look forward to viewing your film.</blockquote>
                        </td>
-->
                        <td align="left" valign="top" class="bodyTextOnBlack" style="padding-bottom:50px;"><blockquote style="padding-right:14px;">
                          Thank you for paying your entry fee to the Sans Souci Festival of Dance Cinema via Paypal. You will receive an email
                          receipt from PayPal shortly. 
                          <br><br>
                          Thanks for your submission. We look forward to viewing your film.</blockquote>
                        </td>
                      </tr>
                    </table>
                  </td>
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
</html>
