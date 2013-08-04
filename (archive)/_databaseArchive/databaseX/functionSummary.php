<!-- // entryFormFunctions.php -->
<?php

  $debugScript = false;
  function debugLog($string) { 
  function debugLogLine($string) { 
  function debugLogLineUn($string) { // unconditional
  function debugLogLineQuery($string) { 
  function debugLogLineQueryUn($string) { 

  $debugQuery = true;
  function debugLogQuery($result, $queryString) { 

  function f00($string) { return $string; } // does nothing
  
  // Use to insert string values that may contain a single quote into the database.
  // Returns the string input surrounded by single quotes and escaping (,i.e., \') embedded quotes
  function quote($string) {

  // Connects, verifies, sets globals $openError and $openErrorMessage.
  // Returns true on success. Returns false and kills the session on failure.
  function connectToDB() {
    
  // Calls connectToDB() if 'Submit' button was pressed.
  function checkSubmitButtonAndCnnectToDB() {

  // returns vsprintf("%.2u:%.2u:%.2s",array($hours,$minutesModHours,$seconds))
  function formattedRunTimeString($minutes, $seconds) {

  // returns $stringToAddTo . ', ' . $stringToAdd but only uses the comma if $stringToAddTo != ''
  function addCommaDelimitedText($stringToAddTo, $stringToAdd) { 
  function addCommaDelimitedTextNoSpaces($stringToAddTo, $stringToAdd) { 

  // Returns a name/value pair in the form 'Name: Value' and side-effects the globals
  // $fieldNames & $fieldValues by appending $name and $value respectively with appropriate commas and no spaces
  function addDataItem($name, $value) {

  // Returns a valid submitterId or 0  
  function submitterId() {
  function isValidDbKey($key) {

  function getCallForEntriesIdFromName($callForEntriesName) {
  
  // Returns the db row for the person designated by $emailAddress or false
  function getSubmitterRowFromDB($emailAddress) {
  
  // Returns a mysql_fetch_array() of contributors (as designated by 'all', 'fixed', or 'optional').
  function selectContributors($allFixedOptional) {

  // Returns a string in the form 'name1=value1, ... '  for any values of entries modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each entry field).
  function entryUpdates() {

  // $roleProcessed = array() is defined in submittedEntryForm.php

  // Inserts contributor into database and sets if global $roleProcessed[$row['role']] = true if successful
  function insertContributor($workId, $role, $name, $optionalContributor) {

  // Updates contributor in database returning the result of mysql_query()
  function updateContributorFromRow($row) {

  // Updates contributor in database and sets if global $roleProcessed[$row['role']] = true if successful
  function updateContributor($workId, $role, $name) {

  // Deletes contributor from database returning the result of mysql_query()
  function deleteContributor($row) {

  // TODO: Figure out what this does
  function contributorRoleProcessed($dbRole, $dbName, $formRole, $formName, $row) {

  // Reutrns the contributor name for $role based on $_POST field values
  function nameFromEntryFormFor($role) {

  // Returns a string in the form 'name1=value1, ... '  for any values of submitters modified 
  // (based on comparing $_POST['field'] != $_SESSION['field'] for each submitter field).
  function submitterUpdates() {

  // Returns the text value of the Other original format field based on $_SESSION["OriginalFormat"]
  function getTextForOtherOriginalFormatField() {

  // Executes session_destroy() and destroys the $_SESSION array excpet for $_SESSION['submitterId']
  function killSession() {

?>
