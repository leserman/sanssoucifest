<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<html>
<head>
<title>ipnTestHarness</title>
</head>
<body>

<?php
/**
 *  PHP-PayPal-IPN Example
 *
 *  This shows a basic example of how to use the IpnListener() PHP class to 
 *  implement a PayPal Instant Payment Notification (IPN) listener script.
 *
 *  For a more in depth tutorial, see my blog post:
 *  http://www.micahcarrick.com/paypal-ipn-with-php.html
 *
 *  This code is available at github:
 *  https://github.com/Quixotix/PHP-PayPal-IPN
 *
 *  @package    PHP-PayPal-IPN
 *  @author     Micah Carrick
 *  @copyright  (c) 2011 - Micah Carrick
 *  @license    http://opensource.org/licenses/gpl-3.0.html
 */
 
  SSFQuery::debugOn();
  
  const YOUR_EMAIL_ADDRESS = 'hiddenhamel@sanssoucifest.org';
  const YOUR_PRIMARY_PAYPAL_EMAIL = 'hamelb-facilitator@sanssoucifest.org';

/*
Since this script is executed on the back end between the PayPal server and this
script, you will want to log errors to a file or email. Do not try to use echo
or print--it will not work! 

Here I am turning on PHP error logging to a file called "ipn_errors.log". Make
sure your web server has permissions to write to that file. In a production 
environment it is better to have that log file outside of the web root.
*/
  ini_set('log_errors', true);
  ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

 function prettyBelch($idString, $dataStructure) { 
    $prettyBelchString = "";
    $prettyBelchString = "** " . $idString . " ** " . print_r($dataStructure, true);
    return $prettyBelchString;
  }

  $initReport = prettyBelch('SSF IPN Listener invoked', (isset($_POST) && (count($_POST) > 0)) ? $_POST : 'NO POST');
  echo $initReport . PHP_EOL;

  mail(YOUR_EMAIL_ADDRESS, 'SSF IPN Listener invoked', $initReport);


  // instantiate the IpnListener class
  //include('../ipnlistener.php');
  $listener = new PayPalIPNListener();
  $analyzer = new PayPalIPNAnalyzer();
  
  $errorString = '';
  $warningString = '';
  $matchingWorkMessage = '';


/*
When you are testing your IPN script you should be using a PayPal "Sandbox"
account: https://developer.paypal.com
When you are ready to go live change use_sandbox to false.
*/
//  $listener->use_sandbox = true;

/*
By default the IpnListener object is going  going to post the data back to PayPal
using cURL over a secure SSL connection. This is the recommended way to post
the data back, however, some people may have connections problems using this
method. 

To post over standard HTTP connection, use:
  $listener->use_ssl = false;

To post using the fsockopen() function rather than cURL, use:
  $listener->use_curl = false;
*/

/*
The processIpn() method will encode the POST variables sent by PayPal and then
POST them back to the PayPal server. An exception will be thrown if there is 
a fatal error (cannot connect, your server is not configured properly, etc.).
Use a try/catch block to catch these fatal errors and log to the ipn_errors.log
file we setup at the top of this file.

The processIpn() method will send the raw data on 'php://input' to PayPal. You
can optionally pass the data to processIpn() yourself:
$verified = $listener->processIpn($my_post_data);
*/

//  $verified = true;

//  try {
//    $listener->requirePostMethod();
//    $verified = $listener->processIpn(); // This does the handshake with paypal and gets the data into $_POST.
//    if (!$verified) $skimmedText = 'but NOT verified';
//    else {
      $analyzer->paypalIPNDataValue['payment_date'] = '09:32:50 Apr 30, 2014 PDT'; // $_POST['payment_date'];
      $analyzer->paypalIPNDataValue['payment_status'] = 'Completed'; // $_POST['payment_status'];
      $analyzer->paypalIPNDataValue['option_selection1_filmTitle'] = 'Another Test'; // 'Fake Film Title'; // $_POST['option_selection1'];
      $analyzer->paypalIPNDataValue['option_selection2_submitterEmail'] = 'duvidl@leserman.com'; // $_POST['option_selection2'];
      $analyzer->paypalIPNDataValue['payer_email'] = 'duvidl@leserman.com'; // $_POST['payer_email'];
      $analyzer->paypalIPNDataValue['payment_gross'] = '1'; // $_POST['mc_gross'];
      $analyzer->paypalIPNDataValue['first_name'] = 'Duvidl'; // $_POST['first_name'];
      $analyzer->paypalIPNDataValue['last_name'] = 'Leserman'; // $_POST['last_name'];
      $analyzer->paypalIPNDataValue['txn_id'] = '5L382349S8897282B'; // '5L382349S8897282A'; // $_POST['txn_id'];
      $analyzer->paypalIPNDataValue['receiver_email'] = 'hamelb-facilitator@sanssoucifest.org'; // $_POST['txn_id'];
      $analyzer->paypalIPNDataValue['mc_currency'] = 'USD'; // $_POST['txn_id'];
      $skimmedText = $analyzer->paypalIPNDataValue['payment_date'] . ', ' 
                   . $analyzer->paypalIPNDataValue['payment_status'] . ', "' 
                   . $analyzer->paypalIPNDataValue['option_selection1_filmTitle'] . '", ' 
                   . $analyzer->paypalIPNDataValue['option_selection2_submitterEmail'] . ', '
                   . $analyzer->paypalIPNDataValue['payer_email'] . ', $' 
                   . $analyzer->paypalIPNDataValue['payment_gross'] . ', '
                   . $analyzer->paypalIPNDataValue['first_name'] . ' ' . $analyzer->paypalIPNDataValue['last_name'] . ', '
                   . $analyzer->paypalIPNDataValue['txn_id'];
echo prettyBelch('Analyzer initialized.', $analyzer) . PHP_EOL;
//    }
    error_log('Analyzer initialized: ' . $skimmedText . '.'); 
//  } catch (Exception $e) {
//    error_log($e->getMessage());
//    exit(0);
//  }

/*
The processIpn() method returned true if the IPN was "VERIFIED" and false if it
was "INVALID".
*/

//  if ($verified) {
  if (true) {
    /*
    Once you have a verified IPN you need to do a few more checks on the POST
    fields--typically against data you stored in your database during when the
    end user made a purchase (such as in the "success" page on a web payments
    standard button). The fields PayPal recommends checking are:
    
      1. Check the $_POST['payment_status'] is "Completed"
	    2. Check that $_POST['txn_id'] has not been previously processed 
	    3. Check that $_POST['receiver_email'] is your Primary PayPal email 
	    4. Check that $_POST['payment_amount'] and $_POST['payment_currency'] 
	       are correct
    
    Since implementations on this varies, I will leave these checks out of this
    example and just send an email using the getTextReport() method to get all
    of the details about the IPN.  
    */
    
    $errmsg = '';   // stores errors from fraud checks
    
// echo prettyBelch('Checking for \'Completed\'.', $analyzer) . PHP_EOL;

    // 1. Make sure the payment status is "Completed" 
    if ($analyzer->paypalIPNDataValue['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        error_log('IPN status is not Completed.');
        exit(0); 
    }

// echo prettyBelch('Checking for matching \'receiver_email\'.', $analyzer) . PHP_EOL;

    // 2. Make sure seller email matches your primary account email.
    if ($analyzer->paypalIPNDataValue['receiver_email'] != YOUR_PRIMARY_PAYPAL_EMAIL) {
        $errmsg .= "  'receiver_email'" . $analyzer->paypalIPNDataValue['receiver_email'] . "does not match YOUR_PRIMARY_PAYPAL_EMAIL: " . YOUR_PRIMARY_PAYPAL_EMAIL . "\n";
    }

// echo prettyBelch('Checking for matching \'mc_gross\'.', $analyzer) . PHP_EOL;
    
    // 3. Make sure the amount(s) paid match
    $expectedPmtAmt = '1.00';                                                     // TODO: get expected amt pd from DB
    if ($analyzer->paypalIPNDataValue['payment_gross'] != $expectedPmtAmt) {  
        $errmsg .= "  'mc_gross' (" . $analyzer->paypalIPNDataValue['payment_gross'] . ") does not match expected amount (" . $expectedPmtAmt . ")." . "\n";
    }

// echo prettyBelch('Checking for \'mc_currency\' = USD.', $analyzer) . PHP_EOL;
    
    // 4. Make sure the currency code matches
    if ($analyzer->paypalIPNDataValue['mc_currency'] != 'USD') {
        $errmsg .= "  'mc_currency' (" . $analyzer->paypalIPNDataValue['mc_currency'] . ") is not USD." . "\n";
    }

//    error_log('CURRENCY OK: ' . $skimmedText . '.'); // OK

    // 5. TODO: Check for duplicate txn_id              // TODO Why is this last?
    if ($analyzer->foundMatchingReceiptInDB($analyzer->paypalIPNDataValue['txn_id'])) {
        $errmsg .= "  'txn_id' (" . $analyzer->paypalIPNDataValue['txn_id'] . ") is already in the paypalReceipts table." . "\n";
    }
    
    if (!empty($errmsg)) {
        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n" . $errmsg . "\n\n";  // TODO This is generating extra blank lines in the error log.
//        $body .= $listener->getTextReport();
        error_log('IPN Fraud Warning: ' . $body); 
        mail(YOUR_EMAIL_ADDRESS, 'IPN Fraud Warning', $body); // 6/1/14 Removed single quotes around YOUR_EMAIL_ADDRESS
        
    } else {
      // update the database
//      error_log('INSERTING RECEIPT DATA for: ' . $skimmedText . '.'); 
      error_log('INSERTING RECEIPT DATA.'); 
      $query1Result = $analyzer->insertReceiptData();
      $foundMatchingWork = $analyzer->foundMatchingWork();
      $errorString = $analyzer->getAnyErrors();
      if ($errorString != '') $matchingWorkMessage .= $errorString; // . PHP_EOL;
      else if ($foundMatchingWork) {
        $warningString = $analyzer->getAnyWarnings();
        if ($warningString != '') $matchingWorkMessage .= $warningString; // . PHP_EOL;
        $workUpdateCount = $analyzer->updateWorksDB();
        $matchingWorkMessage .= 'Works table updated (' . $workUpdateCount . ' fields). ';
      } else {
        $workUpdateCount = -999;
        $matchingWorkMessage = 'NO matching works found. ';
      }
//      error_log('Verified IPN. ' . $matchingWorkMessage . $skimmedText . '.'); 
      error_log('Verified IPN. ' . $matchingWorkMessage); 
      mail(YOUR_EMAIL_ADDRESS, 'Verified IPN. ',  $matchingWorkMessage . $listener->getTextReport());
    }

  } else {
    /*
    An Invalid IPN *may* be caused by a fraudulent transaction attempt. It's
    a good idea to have a developer or sys admin manually investigate any 
    invalid IPN.
    */
    error_log('Invalid IPN. See email for details. ' .  $skimmedText . '.'); 
    mail(YOUR_EMAIL_ADDRESS, 'Invalid IPN', $listener->getTextReport());
  }
  
  // Put a blank line in the error_log.
  error_log('IPN Done Processing.' . PHP_EOL);
  echo prettyBelch('IPN Done Processing.', $analyzer) . PHP_EOL;

?>

<?php
/* Notes
INSERT INTO paypalReceipts (txnId, pmtDate, pmtAmt, workId, filmTitle, submitterEmail, payerEmail, payerFirstName, payerLastName, creationDate) VALUES ('5L382349S8897282A', '2014-04-30 09:32:50', '1', 0, 'Fake Film Title', 'duvidl@leserman.com', 'duvidl@leserman.com', 'Duvidl', 'Leserman', '2014-05-04 11:29:06')

SELECT workId, title, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, submitter, email, loginName, nickName, lastName, name FROM works JOIN people on submitter = personId WHERE withdrawn=0 AND callForEntries = 14  AND title like "%Fake Film Title%"   AND (email = "duvidl@leserman.com"     OR email = "duvidl@leserman.com"     OR loginName = "duvidl@leserman.com"     OR loginName = "duvidl@leserman.com")
*/
?>

<?php
/* This is an alternate reference from 

  - How to Process IPN (w sample code) - https://developer.paypal.com/docs/classic/ipn/ht_ipn/
  - Complete code - https://gist.github.com/xcommerce-gists/3440401#file-completelistener-php

// STEP 1: read POST data
 
// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}
 
 
// STEP 2: POST IPN data back to PayPal to validate
          // https://www.sandbox.paypal.com/cgi-bin/webscr
          // https://www.paypal.com/cgi-bin/webscr
$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
 
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if( !($res = curl_exec($ch)) ) {
    // error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);
 
 
// STEP 3: Inspect IPN validation result and act accordingly
 
if (strcmp ($res, "VERIFIED") == 0) {
    // The IPN is verified, process it:
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process the notification
 
    // assign posted variables to local variables
    $item_name'] = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
 
    // IPN message values depend upon the type of notification sent.
    // To loop through the &_POST array and print the NV pairs to the screen:
    foreach($_POST as $key => $value) {
      echo $key." = ". $value."<br>";
    }
} else if (strcmp ($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation
    echo "The response from IPN was: <b>" .$res ."</b>";
}

*/
?>

</body>
</html>

