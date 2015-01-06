<?php
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<title>SSF - PayPal Listener Driver</title>
</head>
<body bgcolor="#CCCCCC" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<h1 style="text-align:center;margin-top:40px;">SSF - PayPal Listener Test Driver</h1>

<!-- <form style="text-align:center;margin-top:10px;" target="_new" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr"> -->
<form style="text-align:center;margin-top:10px;" target="_new" method="post" action="https://www.paypal.com/cgi-bin/webscr">
<?php
  if (false) {
    $entryFeeString = '35'; //SSFRunTimeValues::getEarlyDeadlineFeeString();
    $deadlineDateString = '4/24/2014'; //SSFRunTimeValues::getEarlyDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">' . PHP_EOL;
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">' . PHP_EOL;
  } else {
    $entryFeeString = '1'; // SSFRunTimeValues::getFinalDeadlineFeeString();
    $deadlineDateString = '5/23/2014'; // SSFRunTimeValues::getFinalDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">' . PHP_EOL;
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">' . PHP_EOL;
  }
  $workTitle = 'Another Test';
  $personEmail = 'david@leserman.com';
  $personFirstName = 'David';
  $personLastName = 'Leserman';  
  if (isset($_GET['works_title'])) $workTitle = $_GET['works_title'];
  if (isset($_GET['people_email'])) $personEmail = $_GET['people_email'];
  if (isset($_GET['people_firstName'])) $personFirstName = $_GET['people_firstName'];
  if (isset($_GET['people_lastName'])) $personLastName = $_GET['people_lastName'];
  echo '                                  <input type="text" name="os0" value="' . $workTitle . '">' . PHP_EOL;
  echo '                                  <input type="text" name="os1" value="' . $personEmail . '">' . PHP_EOL;
  echo '                                  <input type="hidden" name="FirstName" value="' . $personFirstName . '">' . PHP_EOL;
  echo '                                  <input type="hidden" name="LastName" value="' . $personLastName . '">' . PHP_EOL;

?>
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="business" value="payment@sanssoucifest.org"> <!-- hamelb-facilitator@sanssoucifest.org -->
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="hidden" name="page_style" value="Primary">
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="rm" value="2"> <!-- return to SSF Success page with a POST -->
                                <input type="hidden" name="return" value="http://sanssoucifest.org/paypal/successfulEntryFeePayment.php">
                                <input type="hidden" name="cancel_return" value="http://sanssoucifest.org/paypal/cancelEntryFeePayment.php">
                                <!-- <input type="hidden" name="cn" value="Film Title, Submitter Name, Submitter Email"> -->
                                <!-- <input type="hidden" name="lc" value="US"> -->
<!--                                <input type="hidden" name="bn" value="PP-BuyNowBF"> -->
                                <input type="hidden" id="first_name" name="first_name" value="">
                                <input type="hidden" id="last_name" name="last_name" value="">
                                <input type="hidden" name="on0" value="Film Title">
                                <input type="hidden" name="on1" value="Submitter Email Address">
<input type="hidden" name="notify_url" value="http://sanssoucifest.org/paypal/listener.php">
<input type="hidden" name="cmd" value="_xclick">
<!-- <input type="hidden" name="business" value="FY34D3BUM993S"> -->
<input type="hidden" name="lc" value="US">
<!-- <input type="hidden" name="item_name" value="Entry Fee"> -->
<!-- <input type="hidden" name="amount" value="1.00"> -->
<!-- <input type="hidden" name="currency_code" value="USD"> -->
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynow_LG.gif:NonHosted">
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<!-- <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"> -->
<br><br>
<!--
                                <input type="text" name="on1" value="Submitter Email Address">
                                <input type="text" name="on1" value="Submitter Email Address">
-->
<!-- code for other variables to be tested ... -->

<?php
/*
  $submitButtonAdjective = (false) ? 'Early ' : '';
  $submitButtonString = '&nbsp;Use PayPal to pay the $' . $entryFeeString . ' USD ' . $submitButtonAdjective . 'Entry Fee now.&nbsp;';
  echo '                                  <input type="submit" id="submit"' . "\r\n";
  echo '                                    name="submit" value="' . $submitButtonString . '" style="margin:20px 0 20px 0;font-size:12px;">' . "\r\n";
*/
?>


</form>
</body>
