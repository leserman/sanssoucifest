<?php

class PayPalIPNAnalyzer {

/* Public Interface

  $paypalIPNDataValue - array
  
  // Returns matchingWorkId (which is 0 if there is no matching work).
  public function matchingWork() 
  
  // Returns true if multiple works might match the IPN transaction Id; else false.
  public function multipleWorksMatch() 

  // Returns true if the analyzer found a single matching work; else false. When true, $analyzer->matchingWorkId, 
  // $analyzer->dbWorkDataValue, $analyzer->uniqueWorkFound, & $analyzer->multipleWorksMatch will be set upon return.
  public function foundMatchingWork()

  // Returns true if the analyzer found a matching PayPal receipt in the table. Exits on query failure.
  public function foundMatchingReceiptInDB()

  // Returns a non-empty error string if multiple works matched or no works matched. Otherwise, returns empty string.
  public function getAnyErrors() 
  
  // Returns a non-empty warning string if values in the works table will be overwritten. Otherwise, returns empty string.
  public function getAnyWarnings() 

  // Returns SSFDB::getDB()->saveData($query).
  public function insertReceiptData()

  // Returns count of fields updated.
  public function updateWorksDB() 

*/

  public $paypalIPNDataValue = array();
  private $dbWorkDataValue = array();
  private $dbReceiptDataValue  = array();
  
  private $uniqueWorkFound = false;
  private $multipleWorksMatch = false;
  private $matchingWorkId = 0;
  private $receiptFound = false;
  private $priorQuery = '';

  private $updateCount = 0;

  private $paypalDebug = -1;

  public function matchingWork() { return $this->matchingWorkId; }
  public function multipleWorksMatch() { return $this->multipleWorksMatch; }
  public function getPriorQuery() { return $this->priorQuery; }
 
  // Returns true if the analyzer found a single matching work; else false. When true, $analyzer->matchingWorkId, 
  // $analyzer->dbWorkDataValue, $analyzer->uniqueWorkFound, & $analyzer->multipleWorksMatch will be set upon return.
  public function foundMatchingWork() {
    $currentCallForEntries = SSFRunTimeValues::getInitialCallForEntriesId();
    $this->uniqueWorkFound = false;
    $this->priorQuery = '';
    if ($this->paypalIPNDataValue['option_selection1_filmTitle'] != "") {
      // Hack Alert: The query uses 'like' rather than '=' for title so that it will work when a title has an embedded "'" (single quote) or other special char.
      $query = 'SELECT workId, title, callForEntries, datePaid, amtPaid, howPaid, checkOrPaypalNumber, '
             .        'submitter, email, loginName, nickName, lastName, name, works.lastModifiedBy '
             . 'FROM works JOIN people on submitter = personId '
             . 'WHERE withdrawn=0 AND callForEntries = ' . $currentCallForEntries . ' '
             .   'AND title like "%' . trim($this->paypalIPNDataValue['option_selection1_filmTitle'],'"') . '%" '
             .   'AND (email = "' . $this->paypalIPNDataValue['payer_email'] . '" '
             .     'OR email = "' . $this->paypalIPNDataValue['option_selection2_submitterEmail'] . '" '
             .     'OR loginName = "' . $this->paypalIPNDataValue['payer_email'] . '" '
             .     'OR loginName = "' . $this->paypalIPNDataValue['option_selection2_submitterEmail'] . '")';
      $this->priorQuery = $query; // cache the query for possible error reporting later.
//      SSFDB::debugNextQuery();
      $matchingWorksArray = SSFDB::getDB()->getArrayFromQuery($query);
      $this->uniqueWorkFound = (count($matchingWorksArray) == 1);
      $this->multipleWorksMatch = (count($matchingWorksArray) > 1);
      if ($this->uniqueWorkFound) {
        $this->matchingWorkId = $matchingWorksArray[0]['workId'];
        foreach($matchingWorksArray[0] as $key => $element) { $this->dbWorkDataValue[$key] = $element; }
        // where the keys are expected to be workId, amtPaid, howPaid, datePaid, and paypalNumber.
      }
    }
    return $this->uniqueWorkFound;
  }

  // Returns true if the analyzer found a matching PayPal receipt in the table. Exits on query failure.
  public function foundMatchingReceiptInDB() {
//    $txnId = mysql_real_escape_string($this->paypalIPNDataValue['txn_id']); // TODO: Add proper escaping of quotes & special chars!
//    $txnId = SSFQuery::foo($this->paypalIPNDataValue['txn_id']);
    $txnId = $this->paypalIPNDataValue['txn_id'];
    $this->receiptFound = false;
    $query = 'SELECT * FROM paypalReceipts where txnId = "' . $txnId . '"';
    $queryResultRows = SSFDB::getDB()->getArrayFromQuery($query);
   if (!SSFDB::getDB()->querySuccess()) {
      error_log(SSFDB::getDB()->lastErrorNo() . ' ' . SSFDB::getDB()->lastErrorText());
      exit(0); // Bail out if the query failed
    }
    if (count($queryResultRows) == 1) {
      foreach($queryResultRows[0] as $key => $element) { $this->dbReceiptDataValue[$key] = $element; }
      $this->receiptFound = true;
    }
    return $this->receiptFound;
  }

  // Returns a non-empty error string if multiple works matched or no works matched. Otherwise, returns empty string.
  public function getAnyErrors() { 
    $errorsString = '';
    $adviceString = '** Enter it by hand from the PayPal notification email.'; // . PHP_EOL;
    if ($this->multipleWorksMatch) {
      $errorsString = '** Multiple works in the DB might match this PayPal payment. ' . $adviceString;
    } else if (!$this->uniqueWorkFound) {
      $errorsString = '** No works in the DB match this PayPal payment. ' . $adviceString;
    } else if (isset($this->dbWorkDataValue['checkOrPaypalNumber']) && ($this->dbWorkDataValue['checkOrPaypalNumber'] != 0) 
                 && ($this->dbWorkDataValue['checkOrPaypalNumber'] != '') && ($this->paypalIPNDataValue['txn_id'] != $this->dbWorkDataValue['checkOrPaypalNumber'])) {
      $errorsString = '** The unique work found already has a different checkOrPaypalNumber (' . $this->dbWorkDataValue['checkOrPaypalNumber'] . '). ' . $adviceString;
    }
//    SSFDebug::globalDebugger()->belch('aaa. errorsString', $errorsString, 1);
    return $errorsString;
  }

  // Returns a non-empty warning string if values in the works table will be overwritten. Otherwise, returns empty string.
  public function getAnyWarnings() { 
    $warningsString = '';
    $txnId = $this->paypalIPNDataValue['txn_id'];
    $paypalReceiptsRecords = SSFDB::getDB()->getArrayFromQuery('SELECT txnId from paypalReceipts where txnId = "' . $txnId . '"');
    $paymentInPaypalReceiptsTable = (count($paypalReceiptsRecords) == 1);
    $payPalWorksRecords = SSFDB::getDB()->getArrayFromQuery('SELECT checkOrPaypalNumber from works where checkOrPaypalNumber = "' . $txnId . '"');
    $paymentAlreadyAppliedInWorksTable = (count($payPalWorksRecords) == 1);
    $paymentAlreadyApplied = $paymentInPaypalReceiptsTable || $paymentAlreadyAppliedInWorksTable;
    if ($paymentAlreadyAppliedInWorksTable) {
      $paypalAmtPaid = $this->paypalIPNDataValue['payment_gross'];
      $dbAmtPaid = $this->dbWorkDataValue['amtPaid'];
      if ($dbAmtPaid != $paypalAmtPaid) {
        $warningsString .= "** Amount Paid does not match. " . $paypalAmtPaid . " from IPN replaced " . $dbAmtPaid . " from the works table. "; // . PHP_EOL;
      }
      $paypalHowPaid = $this->dbWorkDataValue['howPaid'];
      if ($paypalHowPaid != 'paypal') {
        $warningsString .= '** Payment method does not match: "paypal" replaced the current payment method, "' . $paypalHowPaid . '." '; // . PHP_EOL;
      }
      $dbDatePaid = $this->dbWorkDataValue['datePaid'];
      $dp = new DateTime($this->paypalIPNDataValue['payment_date']);
      $paypalDatePaid = $dp->format('Y-m-d');
      if ($dbDatePaid != $paypalDatePaid) {
        $warningsString .= '** Date paid does not match: the IPN payment date, ' . $paypalDatePaid . ', replaced the existing payment date, ' . $dbDatePaid . '. '; // . PHP_EOL;
      }
    }
//    SSFDebug::globalDebugger()->belch('bbb. warningsString', $warningsString, 1);
    return $warningsString;
  }
  
  // Returns SSFDB::getDB()->saveData($query).
  public function insertReceiptData() {
    $d = new DateTime($this->paypalIPNDataValue['payment_date']);
    $formatted_date = $d->format('Y-m-d H:i:s');
    $query = "INSERT INTO paypalReceipts (txnId, pmtDate, pmtAmt, workId, filmTitle, submitterEmail, payerEmail, payerFirstName, payerLastName, creationDate) "
                                   . "VALUES (" . "'" . $this->paypalIPNDataValue['txn_id'] . "', "  
                                                . "'" . $formatted_date . "', " 
                                                . "'" . $this->paypalIPNDataValue['payment_gross'] . "', " 
                                                . $this->matchingWorkId . ", " 
                                                . "'" . $this->paypalIPNDataValue['option_selection1_filmTitle'] . "', " 
                                                . "'" . $this->paypalIPNDataValue['option_selection2_submitterEmail'] . "', " 
                                                . "'" . $this->paypalIPNDataValue['payer_email'] . "', " 
                                                . "'" . $this->paypalIPNDataValue['first_name'] . "', " 
                                                . "'" . $this->paypalIPNDataValue['last_name'] . "', " 
                                                . "'" . SSFRunTimeValues::nowForDB() . "')";
//    error_log($query);
    SSFDB::getDB()->saveData($query);
  }

  // Returns count of fields updated in the works table.
  public function updateWorksDB() { 
    $newValues = array();
    $d = new DateTime($this->paypalIPNDataValue['payment_date']);
    $formatted_date = $d->format('Y-m-d');
    $newValues[DatumProperties::getItemKeyFor('works', 'howPaid')] = 'paypal';
    $newValues[DatumProperties::getItemKeyFor('works', 'datePaid')] = $formatted_date; 
    $newValues[DatumProperties::getItemKeyFor('works', 'amtPaid')] = $this->paypalIPNDataValue['payment_gross'];
    $newValues[DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber')] = $this->paypalIPNDataValue['txn_id'];
    $newValues[DatumProperties::getItemKeyFor('works', 'lastModifiedBy')] = 1807; // The automated PayPal IPN Listener 
                                // updateDBFor($tableName, $currentValueArray, $newValueArray, $whereKeyName, $whereKeyValue, $handleSetsAsStrings=false)
//    SSFQuery::debugNextQuery();
    $this->updateCount = SSFQuery::updateDBFor('works', $this->dbWorkDataValue, $newValues, 'workId', $this->matchingWorkId);
    return $this->updateCount;
  }
  
}
?>