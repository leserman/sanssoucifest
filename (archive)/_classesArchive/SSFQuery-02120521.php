<?php

  class SendLog {
    private static $to          = "hamelb@sanssoucifest.org";
    private static $subject     = "SSF Log";
    private static $headers     = "From: hamelb@sanssoucifest.org\r\nReply-To: no-reply@sanssoucifest.org\r\nX-Mailer: PHP/";// . phpversion();
    public static $message      = '';

    public static function sendItNow() {
      SSFDebug::globalDebugger()->becho('sendItNow', self::$message, -1);
      $mailedData = mail(self::$to, self::$subject, self::$message, self::$headers);
    }
  
    public static function initInfo($subject, $to="hamelb@sanssoucifest.org", $from="hamelb@sanssoucifest.org") {
      self::$subject     = $subject;
      self::$to          = $to;
      self::$message     = "";
      self::$headers     = "From: " . $from . "\r\n"
                         . "Reply-To: no-reply@sanssoucifest.org\r\n"
                         . "X-Mailer: PHP/" . phpversion();
    }
  }

class SSFQuery {

  private static $curatorsAreInitialized = false;
  private static $callForEntriesForWhichCuratorsAreInitialized = 0;
  private static $curatorRows = array();
  private static $locallyActiveCuratorsArray = array();
  private static $useAdministratorAsCreatorModifier = false;
  
  public static function useAdministratorAsCreatorModifier($yes=true) { self::$useAdministratorAsCreatorModifier = $yes; }
 
  private static function checkInit($callForEntries) { 
    if (!self::$curatorsAreInitialized || (self::$callForEntriesForWhichCuratorsAreInitialized != $callForEntries)) { self::initializeCuratorRowsFromDB($callForEntries); } 
  }

  private static function initializeCuratorRowsFromDB($callForEntries) {
    $debugInit = -1;
    SSFDebug::globalDebugger()->becho('initializeCuratorRowsFromDB _COOKIE[ssf_locallyActiveCurators]', (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : 'Not set', -1);
    // READ the curators table to initialize $curatorRows
    SSFDebug::globalDebugger()->becho('callForEntries', $callForEntries, $debugInit);
    //SSFDB::debugNextQuery();
    $locallyActiveCuratorsText = (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : ''; 
    $temp = explode(' ', $locallyActiveCuratorsText); // Why is this a space instead of a +?
    self::$locallyActiveCuratorsArray = explode(' ', $locallyActiveCuratorsText);  // Why is this a space instead of a +?
    SSFDebug::globalDebugger()->becho('initializeCuratorRowsFromDB locallyActiveCuratorsText', $locallyActiveCuratorsText, -1);
    SSFDebug::globalDebugger()->belch('initializeCuratorRowsFromDB self::locallyActiveCuratorsArray', self::$locallyActiveCuratorsArray, -1);
    $curatorsSelectString = "SELECT curator, isActive, name, nickName from curators join people on curator=personId where callForEntries=" . $callForEntries . " order by curator ASC;";
    self::$curatorRows = SSFDB::getDB()->getArrayFromQuery($curatorsSelectString);
    SSFDebug::globalDebugger()->belch('curatorRows', self::$curatorRows, $debugInit);
    // Create the curationIndices array and set the curator/work element to 1 those pairs that exist in the curation table.
//    $curationSelectString = "SELECT entry, curation.curator FROM curation JOIN works ON curation.entry = workId "
//                          . "JOIN curators ON curation.curator=curators.curator "
//                          . "WHERE works.callForEntries=" . $callForEntries . " AND " . self::locallyActiveCuratorWhereClause() 
//                          . " AND curators.isActive=1 order by workId ASC;";
    $curationSelectString = "select entry, curator from curation join works on curation.entry = workId "
                          . "where callForEntries=" . $callForEntries . " order by workId ASC;";
    //SSFDB::debugNextQuery();
    $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
    $curationIndices = array(); 
    foreach ($curationRows as $curationRow) {
      $curationIndices[$curationRow['entry']][$curationRow['curator']] = 1;
    }
    SSFDebug::globalDebugger()->belch('curationIndices', $curationIndices, -1);
    
    // READ the VALUES FROM the works table
    $worksSelectString = "SELECT workId, designatedId, title FROM works "
                       . "WHERE withdrawn=0 AND callForEntries=" . $callForEntries . " ORDER BY designatedId ASC;";
    //SSFDB::debugNextQuery();
    $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    SSFDebug::globalDebugger()->belch('workRows', $workRows, -1);
  
    // Add any missing rows to the curation table such that there is one row per curator/work pair.
    $rowsAdded = 0;
    SendLog::initInfo("Curation Log", "curationlog@sanssoucifest.org", "curationlog@sanssoucifest.org");
    $administrator = SSFRunTimeValues::getAdministratorId();
    foreach ($workRows as $workRow) {
      $workId = $workRow['workId'];
      SSFDebug::globalDebugger()->becho('initializeCuratorRowsFromDB workId', $workId, -1);
      foreach (self::$curatorRows as $curatorRow) {   
        $curator = $curatorRow['curator'];
        if (!isset($curationIndices[$workId][$curator])) {
          $insertString = "INSERT INTO curation (entry, curator, lastModificationDate, lastModifiedBy) VALUES (" 
                        . $workId . ", " . $curator . ", NOW(), " . $administrator . ")";
          //SSFDB::debugNextQuery();
          $success = SSFDB::getDB()->saveData($insertString);
          if ($success) {
            $rowsAdded++;
            SendLog::$message .= '** Added curator ' . $curator . ' for work ' . $workId . ', "' . $workRow['title'] . '."' . "\r\n";
          } else {
            SendLog::$message .= "<br>\r\n" . '** Failed to add curator ' . $curator . ' for work ' . $workId . ', "' . $workRow['title'] 
                              . '," MySQL Error#' . SSFDB::getDB()->lastErrorNo() . ' ' . SSFDB::getDB()->lastErrorText() . ".\r\n\r\n";
          }
        }
      }
    }
    if (SendLog::$message != '') {
      SendLog::$message .= "\r\n" . 'Rows added: ' . $rowsAdded . "\r\n\r\n";
      SendLog::sendItNow();
    }
    SSFDebug::globalDebugger()->becho('initializeCuratorRowsFromDB SendLog::message', SendLog::$message, -1);
    self::$curatorsAreInitialized = true;
    self::$callForEntriesForWhichCuratorsAreInitialized = $callForEntries;
  }

  public static function success() { return SSFDB::getDB()->querySuccess(); }

  // Returns the number of records in $tableName WHERE $colName = $colValue
  public static function getRecordCount($tableName, $colName, $colValue) {
    $queryString = 'SELECT count(*) AS cnt FROM `' . $tableName . '` WHERE ' . $colName . '=' . $colValue;
    $result = SSFDB::getDB()->getArrayFromQuery($queryString);
    SSFDebug::globalDebugger()->belch('result in SSFQuery::getRecordCount', $result, -1);
    $count = ($result !== null) ? $result[0]['cnt'] : 0;
    return $count;
  }

  public static function computeSortClauseAndText($sortValue1, $sortValue2) {
    self::$querySortString = '';
    self::$querySortDisplayText = ''; 
    self::computeSortClause(1, $sortValue1);
    self::computeSortClause(2, $sortValue2);
  }
  
  public static function getQuerySortString() { return self::$querySortString; }
  public static function getQuerySortDisplayText() { return self::$querySortDisplayText; }

  public static function debugNextQuery() { return SSFDB::debugNextQuery(); }
  public static function debugOn() { return SSFDB::debugOn(); }
  public static function debugOff() { return SSFDB::debugOff(); }
  
  private static $querySortString = '';
  private static $querySortDisplayText = ''; 

  public static function locallyActiveCuratorWhereClause() {
    SSFDebug::globalDebugger()->becho('_COOKIE[ssf_localhostAdminId]', (isset($_COOKIE['ssf_localhostAdminId'])) ? $_COOKIE['ssf_localhostAdminId'] : 'Not set', -1);
    SSFDebug::globalDebugger()->becho('_COOKIE[ssf_locallyActiveCurators]', (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : 'Not set', -1);
    $locallyActiveCuratorWhereClause = '';
    if (isset($_COOKIE['ssf_locallyActiveCurators']) && ($_COOKIE['ssf_locallyActiveCurators'] != '')) {
      $selectedCurators = explode(' ', $_COOKIE['ssf_locallyActiveCurators']); // Why ' ' instead of '+' which is the character in the cookie.
      foreach ($selectedCurators as $activeCurator) {
        $locallyActiveCuratorWhereClause .= ($locallyActiveCuratorWhereClause == '') ? '(' : ' or ';
        $locallyActiveCuratorWhereClause .= 'curators.curator = ' . $activeCurator;
      }
    }
    $locallyActiveCuratorWhereClause .= ($locallyActiveCuratorWhereClause == '') ? '1' : ')';
    SSFDebug::globalDebugger()->becho('locallyActiveCuratorWhereClause', $locallyActiveCuratorWhereClause, -1);
    return $locallyActiveCuratorWhereClause;
  }

  private static function computeSortClause($sortIter, $sortIndexValue) {
    if ($sortIter == 1) {
      $sortTextPrefix = ' sorted by ';
      $querySortStringPrefix = '';
    } else if ($sortIter == 2) {
      $sortTextPrefix = ' and then by ';
      $querySortStringPrefix = ', ';
    } 
    if (isset($sortIndexValue) && ($sortIndexValue != '')) {
      switch ($sortIndexValue) {
        case "idSort":
          self::$querySortString .= $querySortStringPrefix . " designatedId ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Id";
          break;
        case "formatSort":
          self::$querySortString .= $querySortStringPrefix . " submissionFormat ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Submission Format";
          break;
        case "durationSort":
          self::$querySortString .= $querySortStringPrefix . " runTime ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Duration";
          break;
        case "scoreSortUp":
          self::$querySortString .= $querySortStringPrefix . " avg(score) ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Average Score";
          break;
        case "scoreSortDn":
          self::$querySortString .= $querySortStringPrefix . " avg(score) DESC";
          self::$querySortDisplayText .= $sortTextPrefix . "Average Score";
          break;
        case "titleSort": // 6/12/10 Now sorted by titleForSort rather than title.
          self::$querySortString .= $querySortStringPrefix . " titleForSort ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Title";
          break;
        case "submitterSort":
          self::$querySortString .= $querySortStringPrefix . " lastname ASC, name ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Submitter Name";
          break;
        case "countrySort":
          self::$querySortString .= $querySortStringPrefix . " country ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Country of Origin";
          break;
        case "acceptedSort":
          self::$querySortString .= $querySortStringPrefix . "accepted DESC, rejected DESC";
          self::$querySortDisplayText .= $sortTextPrefix . "Acceptance Status";
          break;
        case "liveSort":
          self::$querySortString .= $querySortStringPrefix . "includesLivePerformance DESC";
          self::$querySortDisplayText .= $sortTextPrefix . "Live Performance";
          break;
        case "receivedSort":
          self::$querySortString .= $querySortStringPrefix . "mediaReceived";
          self::$querySortDisplayText .= $sortTextPrefix . "Media NOT Received";
          break;
        case "acceptForSort":
          self::$querySortString .= $querySortStringPrefix . "accepted DESC, rejected DESC, acceptFor ASC";
          self::$querySortDisplayText .= $sortTextPrefix . "Accepted For...";
          break;
      }
    }
  }  

  // Select works for $personId for the current Call for Entries
  public static function selectWorksFor($personId, $debug=false) {
    $call = SSFRunTimeValues::getCallForEntriesId();
    $callForEntriesWhereClause = (($call != 0) ? "callForEntries=" . $call . " " : "");
    $submitter = $personId;
    //$submitter = $stateArray['personSelector'];
    $submitterWhereClause = ((($submitter != "") && ($submitter != 0)) ? "submitter=" . $submitter . " " : "");
    $whereClause = " WHERE withdrawn=0 ";
    if ($callForEntriesWhereClause != "" and $submitterWhereClause != "") 
      $whereClause .= "AND " . $callForEntriesWhereClause . " AND " . $submitterWhereClause;
    else if ($callForEntriesWhereClause != "") 
      $whereClause .= "AND " . $callForEntriesWhereClause;
    else if ($submitterWhereClause != "") 
      $whereClause .= "AND " . $submitterWhereClause;
    $selectString = "SELECT workId, title, titleForSort, name FROM works JOIN people on submitter=personId " 
                  . $whereClause . " ORDER BY titleForSort asc, title asc";
    //echo $selectString . "<br><br>\r\n"; debug_print_backtrace(); // var_dump(debug_backtrace());
    if ($debug) SSFDB::debugNextQuery();
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
    SSFDebug::globalDebugger()->belch('work rows in SSFQuery::selectWorksFor', $rows, -1);
    return $rows;
  }

/* PRIOR TO 2/17/10
  // Returns an array of contributor records for $workId - each with values for the keys 'work', 
  // 'contributorOrder', 'listingOrder', 'name', and 'role' - (as designated by 'all', 'fixed',
  // or 'optional'). Call as SSFQuery::selectContributorsFor($workId, $allFixedOptional)
  public static function selectContributorsFor($workId, $allFixedOptional) {
    $optionalString = '';
    if (($allFixedOptional) == 'all') $optionalString = '';
    else if (($allFixedOptional) == 'fixed') $optionalString = ' AND optionalContributor = 0';
    else if (($allFixedOptional) == 'optional') $optionalString = ' AND optionalContributor = 1';
    $selectContributorString = "SELECT work, contributorOrder, listingOrder, name, role,"
                             . " personId, isPrincipalArtist, roleDescription, optionalContributor"
                             . " FROM workContributors WHERE work = " . $workId . $optionalString 
                             . " ORDER BY contributorOrder";
    $contributorRows = SSFDB::getDB()->getArrayFromQuery($selectContributorString);
    return $contributorRows;
  }
*/

  // Returns an array of contributor records for $workId - each with values for the keys 'work', 
  // 'contributorOrder', 'listingOrder', 'name', 'role', 'personId', 'isPrincipalArtist', 
  // 'roleDescription', 'optionalContributor'. The array returned will be ordered by contributorOrder
  // unless the optional parameter $useListingOrder = true.
  // Call as SSFQuery::selectContributorsFor($workId, $useListingOrder)
  public static function selectContributorsFor($workId, $useListingOrder = false) {
    $sortOrder = ($useListingOrder) ? 'listingOrder' : 'contributorOrder';
    $selectContributorString = "SELECT work, contributorOrder, listingOrder, name, role,"
                             . " personId, isPrincipalArtist, roleDescription, optionalContributor"
                             . " FROM workContributors WHERE work = " . $workId
                             . " ORDER BY " . $sortOrder;
    //SSFDB::debugNextQuery();
    $contributorRows = SSFDB::getDB()->getArrayFromQuery($selectContributorString);
    SSFDebug::globalDebugger()->belch('$contributorRows in SSFQuery::selectContributorsFor', $contributorRows, -1);
    return $contributorRows;
  }

  private static function selectSubmitterAndWorkFor($workId, $submitterWorkSelectString, $debug=false) {
    if ($debug) SSFDB::debugNextQuery();
    $submitterAndWorkArray = array();
    $submitterAndWorkArrayOuter = SSFDB::getDB()->getArrayFromQuery($submitterWorkSelectString); 
    if ($debug) { print_r($submitterAndWorkArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $submitterAndWorkArray = $submitterAndWorkArrayOuter[0];
    } else {
      echo 'ERROR: Person or work not in database (or some other DB error) in ' 
           . 'selectSubmitterAndWorkFor' . '.  workId=' . $workId . '<br>' . "\r\n";
      debug_print_backtrace();
    }
    SSFDebug::globalDebugger()->belch('submitterAndWorkArray', $submitterAndWorkArray, -1);   // DEBUG TEXT diacritical display
    return $submitterAndWorkArray;
  }

  public static function selectSubmitterAndWorkNoCommsFor($workId, $debug=false) {
    $submitterWorkSelectString = 'SELECT * FROM people JOIN works on submitter=personId WHERE workId=' . $workId;
    return self::selectSubmitterAndWorkFor($workId, $submitterWorkSelectString, $debug);
  }
  
  // TODO Merge with selectAccRejWorkRow()
  public static function selectSubmitterAndWorkWithARCommsFor($workId, $debug=false) {
    $submitterWorkSelectString = 'SELECT ' 
       . 'personId, name, lastName, organization, email, city, stateProvRegion, country, workId, title, titleForSort, '
       . 'yearProduced, countryOfProduction, designatedId, runTime, webSite, accepted, rejected, acceptFor, submissionFormat, originalFormat, '
       . 'synopsisOriginal, previouslyShownAt, includesLivePerformance, dateMediaReceived, dateMediaPostmarked, vimeoWebAddress, vimeoPassword, '
       . '(dateMediaReceived is not null and dateMediaReceived != "0000-00-00") AS mediaReceived, amtPaid, avg(score), vimeoWebAddress, vimeoPassword, '
       . 'workNotes, submissionNotes, mediaNotes, projectionistNotes, callForEntries, synopsisEdit1, synopsisEdit2, webSitePertainsTo, ' 
       . 'photoLocation, invited, acceptFor, aspectRatio, anamorphic, frameWidthInPixels, frameHeightInPixels, '
// Note: The fields works.artistInformedOfMediaReceipt and works.artistInformedOfMediaReceiptDate are no longer used.
//       . 'quickNotes, artistInformedOfMediaReceipt, artistInformedOfMediaReceiptDate, '
       . 'quickNotes, '
       . 'amtPaid, howPaid, checkOrPaypalNumber, permissionsAtSubmission, '
       . 'communications.communicationId, communications.type, communications.sent, '
       . "communications.dateSent, communications.sender, communications.contentText, "
       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
       . "contentLastModDate "
       . "FROM ((works LEFT JOIN people on people.personId=works.submitter) "
       . "LEFT JOIN curation on curation.entry=works.workId) "
//       . "LEFT JOIN communications on communications.referencedWork=works.workId "   replaced 4/22/09
       . "LEFT JOIN communicationWork on communicationWork.work=works.workId "
       . "LEFT JOIN communications on communications.communicationId=communicationWork.communication  and communications.type='AcceptReject' "
       . 'WHERE works.workId=' . $workId;
    return self::selectSubmitterAndWorkFor($workId, $submitterWorkSelectString, $debug);
  }
  
  public static function selectPersonFor($personId, $debug=false) {
    $personSelectString = 'SELECT * FROM people WHERE personId=' . $personId;
    if ($debug) SSFDB::debugNextQuery();
    $personArrayOuter = SSFDB::getDB()->getArrayFromQuery($personSelectString); 
    if ($debug) { print_r($personArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $personArray = $personArrayOuter[0];
    } else {
      $personArray = array();
      echo 'ERROR: Person not in database (or some other DB error) in selectPersonFor() WHERE personId=' . $personId . '.<br>' . "\r\n";
      debug_print_backtrace();
    }
    return $personArray;
  }

  public static function selectPersonByAlternateKey($whereKeyName, $whereKeyValue, $debug=false) {
    $personSelectString = 'SELECT * FROM people WHERE ' . $whereKeyName . '=' . self::quote($whereKeyValue);
    if ($debug) SSFDB::debugNextQuery();
    $personArrayOuter = SSFDB::getDB()->getArrayFromQuery($personSelectString); 
    if ($debug) { print_r($personArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $personArray = $personArrayOuter[0];
    } else {
      $personArray = false;
    }
    return $personArray;
  }

  public static function selectWorkFor($workId, $debug=false) {
    $workSelectString = 'SELECT * FROM works WHERE workId=' . $workId;
    if ($debug) SSFDB::debugNextQuery();
    $workArrayOuter = SSFDB::getDB()->getArrayFromQuery($workSelectString); 
    if ($debug) { print_r($workArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $workArray = $workArrayOuter[0];
    } else {
      $workArray = array();
      echo 'ERROR: Work not in database (or some other DB error) in selectWorkFor() where workId=' . $workId . '.<br>' . "\r\n";
      debug_print_backtrace();
    }
    return $workArray;
  }

  // Returns false on failure, the id generated for the auto-incremented column if there is one, or 0 if there is none. 
  public static function insertData($tableName, $stateArray) {
    $insertColString = '';
    $insertValueString = '';
    $separator = '';
    $hasDateCreatedCol = false;
    $hasCreatedByCol = false;
    foreach (DatumProperties::getColsForTable($tableName) as $colName) {
      if ($colName == 'creationDate') $hasDateCreatedCol = true;
      if ($colName == 'createdBy') $hasCreatedByCol = true;
      $dataItemKey = DatumProperties::getItemKeyFor($tableName, $colName);
      $dpArray = DatumProperties::getArray();
      $dpObject = DatumProperties::forKey($dataItemKey);
      if (isset($stateArray[$dataItemKey]) && $dpObject->dbColKey != 'PRI') { // never insert the value of a primary key.
        $itemValues = $stateArray[$dataItemKey];
        // Note that an empty set will fail isset($itemValues) so we must handle this as a special case.
        if (isset($itemValues) || ($dpObject->swDataType == 'set')) {
          //echo "<br>\r\n dpObject "; print_r($dpObject); echo "<br><br>\r\n";
          if ($dpObject->swDataType == 'set') { // the data item is a set
            $setString = '';
            if (isset($itemValues)) foreach ($itemValues as $setMember) {
              $separator = ($setString == '') ? '' : ',';
              $setString .= $separator . $setMember;
            }
            $newValue = "'" . $setString . "'";
          } else { // since this data item is not a set
            $rawNewValue = $stateArray[$dataItemKey];
            $newValue = ($dpObject->swDataType == 'int') ? sprintf('%d', $rawNewValue) : SSFQuery::quote(str_replace("  ", " ", trim($rawNewValue)));
          }
        $insertArray[$colName] = $newValue;
        }
      }
    }
    foreach ($insertArray as $insertCol => $insertValue) {
      $separator = ($insertColString == '') ? '' : ', ';
      $insertColString .= $separator . $insertCol;
      $insertValueString .= $separator . $insertValue;
    }
//    $creatorId = ((isset($stateArray['adminSelector']) && $stateArray['adminSelector'] != 0) ? $stateArray['adminSelector'] 6/11/11
    $creatorId = ((self::$useAdministratorAsCreatorModifier) ? SSFAdmin::userIndex()
               : ((isset($stateArray['people_personId']) && $stateArray['people_personId'] != 0) ? $stateArray['people_personId']
               : ((isset($stateArray['works_submitter']) && $stateArray['works_submitter'] != 0) ? $stateArray['works_submitter']
               : 0)));
    $insertString = "INSERT INTO " . SSFDB::getSchemaName() . "." . $tableName . " (" . $insertColString;
    if ($hasDateCreatedCol && $hasCreatedByCol) {
      $insertString .= ", lastModificationDate, lastModifiedBy, creationDate, createdBy"  . ") VALUES (";
      $insertString .= $insertValueString . ", NOW(), " . $creatorId . ", NOW(), " . $creatorId . ")";
    } else {
      $insertString .= ", lastModificationDate, lastModifiedBy"  . ") VALUES (";
      $insertString .= $insertValueString . ", NOW(), " . $creatorId . ")";
    }
    //SSFDB::debugNextQuery();
    SSFDB::getDB()->saveData($insertString);
    return SSFDB::getDB()->insertedId();
  }
  
  private static function contributorDbName($contributors, $roleString) {
    if (!isset($contributors[$roleString]['name'])) return false;
    else return $contributors[$roleString]['name'];
  }

  private static function contributorDbRoleDescription($contributors, $roleString) {
    if (!isset($contributors[$roleString]['roleDescription'])) return false;
    else return $contributors[$roleString]['roleDescription'];
  }

  private static function contributorNewName($newValueArray, $roleString) {
    if (!isset($newValueArray[$roleString]['name'])) return false;
    return $contributors[$roleString]['name'];;
  }

  public static function updateDBForWorkContributors($newValueArray, $workId) {
    $belchAlot = -1;
    $debugContribChanges = -1;
    SSFDebug::globalDebugger()->belch('$newValueArray in SSFQuery::updateDBForWorkContributors', $newValueArray, $belchAlot);
    $dbValueArrayRaw = SSFQuery::selectContributorsFor($workId);
    SSFDebug::globalDebugger()->belch('$dbValueArrayRaw in SSFQuery::updateDBForWorkContributors', $dbValueArrayRaw, $belchAlot);
    $dbValueArray = array();
    foreach ($dbValueArrayRaw as $contributor) {
      $role = $contributor['role'];
      if (isset($role) && ($role != '')) $dbValueArray[$role] = $contributor;
    }
    SSFDebug::globalDebugger()->belch('$dbValueArray in SSFQuery::updateDBForWorkContributors', $dbValueArray, $belchAlot);
    $roleKeys = DatumProperties::workContributorRoleKeys();
    // Compute the starting listingOrder for any new records.    
    $creditsCount = self::getRecordCount('workContributors', 'work', $workId);
    $listingOrder = $creditsCount * 10;
    
    // Possibilities:
    
    // The values exist in both $newValueArray and $dbValueArray.
    // - If $newValue != $currentValue && $newValue != '' UPDATE the row in the database.
    // A value exists in $newValueArray but not $dbValueArray.
    // - If $newValueArray != '', INSERT the row into the database.
    // A value exists in $dbValueArray but not $newValueArray or $newValue = ''
    // - REMOVE the row from the database or set it to ''

    $rowsChangedCount = 0;
    foreach ($roleKeys as $roleKey) {
      $otherRole = (stripos($roleKey, 'Other_') !== false);
      $dbName = self::contributorDbName($dbValueArray, $roleKey);
      $dbRoleDescription = self::contributorDbRoleDescription($dbValueArray, $roleKey);
      $dbNameExists = ($dbName !== false);
      $dbRoleDescriptionExists = ($dbRoleDescription !== false);
      $dbValueExists = $dbNameExists || $dbRoleDescriptionExists;
      $newName = $newValueArray['workContributors_' . $roleKey];
      $newRoleDescription = ($otherRole) ? $newValueArray['workContributors_role_' . $roleKey] : $roleKey;
      // Determine if the value has changed.
      // If it's a regular role, compare the name.
      $valueChanged = ((!$dbValueExists && ($newName != '')) || ($dbValueExists && ($newName != $dbName)));
      // If it's an otherRole, compare both the name and the roleDescription.
      if ($otherRole && !$valueChanged) {
        $valueChanged = ((!$dbValueExists && ($newRoleDescription != '')) || ($dbValueExists && ($newRoleDescription != $dbRoleDescription)));
      }
//      $updatingUserId = isset($newValueArray['adminSelector']) ? $newValueArray['adminSelector'] 
      $updatingUserId = (self::$useAdministratorAsCreatorModifier) ? SSFAdmin::userIndex()
                      : (isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId']
                      : (isset($newValueArray['works_submitter']) ? $newValueArray['works_submitter'] : 0));
      if ($valueChanged) {
        $notes ='';
        $optionalContributor = ($otherRole) ? 1 : 0;
        if (!$dbValueExists) {
          // The value does not exist in the DB so insert the row.
          // TODO someday: Not yet inserted into the workContributors DB table are values for columns personId, isPrincipalArtist, & notes.
          // TODO To improve efficiency, build a single update statement to include all the rows to be updated at once.
          $listingOrder += 10;
          $insertString = 
            "INSERT INTO workContributors (work, listingOrder, optionalContributor, role, roleDescription, `name`, lastModificationDate, lastModifiedBy) "
                                     . "VALUES (" . $workId . ", " . $listingOrder . ", " . $optionalContributor . ", " . SSFQuery::quote($roleKey) . ", " 
                                     . SSFQuery::quote(trim(str_replace("  ", " ", $newRoleDescription))) . ", " 
                                     . SSFQuery::quote(trim(str_replace("  ", " ", $newName))) . ", NOW(), " . $updatingUserId . ")";
          //SSFDB::debugNextQuery();
          $querySuccess = SSFDB::getDB()->saveData($insertString);
          if ($querySuccess) { $rowsChangedCount += 1; }
        } else { 
          // The values exist in both $newValueArray and $dbValueArray and they are different so update the row.
          // TODO To improve efficiency, build a single update statement to include all the rows to be updated at once.
          $updateString = "UPDATE workContributors SET name = " . self::quote(trim(str_replace("  ", " ", $newName))) 
                        . ", roleDescription=" . self::quote(trim(str_replace("  ", " ", $newRoleDescription)))
                        . ", optionalContributor=" . (($optionalContributor) ? 1 : 0) . ", lastModificationDate=NOW(), lastModifiedBy=" . $updatingUserId
                        . " WHERE work=" . $workId . " and role=" . self::quote($roleKey);
          SSFDebug::globalDebugger()->becho('contributors[' . $roleKey . '][name] in SSFQuery::updateDBForWorkContributors()', 
                                                                                              $dbValueArray[$roleKey]['name'], $debugContribChanges);
          //SSFDB::debugNextQuery();
          $querySuccess = SSFDB::getDB()->saveData($updateString);
          if ($querySuccess) { $rowsChangedCount += 1; }
        }
      } else { // the value has not changed
        if ($dbValueExists
            && (!$dbNameExists || ($dbNameExists && ($dbName == ''))) 
            && ($otherRole && (!$dbRoleDescriptionExists || ($dbRoleDescriptionExists && ($dbRoleDescription == ''))))) {
          // But there is a row in the database where the contributor name and role description are both empty. 
          // By doing nothing, we preserve empty contributor role rows in the database. 
          // Alternatively, we could delete those rows here and prune back the DB.
        }
      }
    }
    SSFDebug::globalDebugger()->becho("SSFQuery::updateDBForWorkContributors() rowsChangedCount", $rowsChangedCount, -1);
    // TODO Compute $rowsChangedCount as is done in updateDBFor() below.
    return $rowsChangedCount;
  }

  public static function updateDBFor($tableName, $currentValueArray, $newValueArray, $whereKeyName, $whereKeyValue) {
    $updateArray = array();
    $debugChanges = -1;
    $success = false;
    SSFDebug::globalDebugger()->belch('SSFQuery::updateDBFor currentValueArray', $currentValueArray, $debugChanges);
    foreach (DatumProperties::getColsForTable($tableName) as $colName) {
      $dataItemKey = DatumProperties::getItemKeyFor($tableName, $colName);
      $dpArray = DatumProperties::getArray();
      $dpObject = DatumProperties::forKey($dataItemKey);
      if (isset($newValueArray[$dataItemKey]) && $dpObject->dbColKey != 'PRI') { // never update the value of a primary key.
        $itemValues = $newValueArray[$dataItemKey];
        // Note that an empty set will fail isset($itemValues) so we must handle this as a special case.
        if (isset($itemValues) || ($dpObject->swDataType == 'set')) {
          if ($dpObject->swDataType == 'set') { // the data item is a set
            $setString = '';
            if (isset($itemValues)) foreach ($itemValues as $setMember) {
              $separator = ($setString == '') ? '' : ',';
              $setString .= $separator . $setMember;
            }
            $comparisonValue = $setString;
            $newValue = "'" . $setString . "'";
          } else { // since this data item is not a set
            $rawNewValue = $newValueArray[$dataItemKey];
            $comparisonValue = ($dpObject->swDataType == 'int') ? sprintf('%d', $rawNewValue) : $rawNewValue;
            $newValue = ($dpObject->swDataType == 'int') ? sprintf('%d', $rawNewValue) : SSFQuery::quote(str_replace("  ", " ", trim($rawNewValue)));
          }
          if (!isset($currentValueArray[$colName]) || $comparisonValue != $currentValueArray[$colName]) { // add this to the update list.
            SSFDebug::globalDebugger()->becho('comparisonValue=|' . $comparisonValue . '| (' . getType($rawNewValue) . ')    currentValueArray[' . $colName. ']=|'
                                                                  . $currentValueArray[$colName] . '| (' . getType($currentValueArray[$colName]) . ')'
                                                                  . '   newValueArray[dataItemKey]=|' . $newValueArray[$dataItemKey] . '|', '', $debugChanges);
            $updateArray[$colName] = $newValue;
          }
        }
      }
    }
    if (count($updateArray) > 0) { // there are updates
      $updatesString = '';
      // 6/11/11: Got rid of $newValueArray['adminSelector'] as a global state variable all over the place.
//      $updatingUserId = isset($newValueArray['adminSelector']) ? $newValueArray['adminSelector'] 
      $updatingUserId = (self::$useAdministratorAsCreatorModifier) ? SSFAdmin::userIndex()
                      : (isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId'] : 1);
      foreach ($updateArray as $updateCol => $updateValue) {
        $separator = ($updatesString == '') ? '' : ', ';
        $updatesString .= $separator . $updateCol . '='. $updateValue;
      }
      $updateString = "UPDATE " . $tableName . " SET " . $updatesString 
                    . ", lastModificationDate=NOW(), lastModifiedBy=" . $updatingUserId
                    . " WHERE " . $whereKeyName . " = " . $whereKeyValue;
      //SSFDB::debugNextQuery();
      $success = SSFDB::getDB()->saveData($updateString);
    }
    SSFDebug::globalDebugger()->becho("SSFQuery::updateDBFor() updateArray count", count($updateArray), -1);
    // Prior to 4/1/12 returned -1 (instead of 0) for failure but that didn't work when adding this count to a workContriburtors count.
    return ($success) ? count($updateArray) : 0; 
  }

  public static function saveCuratorData($curatorId, $workId, $score, $notes) {
    $adminId = SSFAdmin::userIndex();
    $scoreString = (($score == '--') ? 'NULL' : $score);
    $curationSelectString = "SELECT * FROM curation WHERE entry=" . $workId . " and curator=" . $curatorId;
//    $curationSelectString = "SELECT * FROM curation JOIN curators ON curation.curator=curators.curator WHERE entry=" 
//                          . $workId . " AND curator=" . $curatorId . " AND curators.isActive=1";
    $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
    $curationRecordExists = (count($curationRows) == 1);
    $userMadeChanges = false;
    if ($curationRecordExists) {
      if (($curationRows['score'] != $score) || (($curationRows['notes'] != $notes))) { $userMadeChanges = true; }
      $curatorInsertOrUpdateString = "UPDATE curation SET score=" . $scoreString . ", notes=" 
                                   . SSFQuery::quote(str_replace("  ", " ", trim($notes)))
                                   . ", lastModificationDate=NOW(), lastModifiedBy=" . $adminId
                                   . " WHERE curator=" . $curatorId . " and entry=" . $workId;
    } else { // since this is a new curation record
      $userMadeChanges = true;
      $curatorInsertOrUpdateString = "INSERT INTO curation (curator, entry, score, notes, lastModificationDate, lastModifiedBy) "
                                   . "VALUES (" . $curatorId . ", " . $workId . ", " . $scoreString . ", " 
                                   . SSFQuery::quote(str_replace("  ", " ", trim($notes)))
                                   . ", NOW(), " . $adminId . ")";
    }
    //SSFDB::debugNextQuery();
    $querySuccess = true;
    if ($userMadeChanges) { $querySuccess = SSFDB::getDB()->saveData($curatorInsertOrUpdateString); }
    return $querySuccess;
  }

  public static function curatorIsActive($curator, $callForEntries) { 
    self::checkInit($callForEntries); 
    // Beware: There is a return statement in the foreach loop.
    foreach (self::$curatorRows as $curatorRow) {
      if (($curatorRow['curator'] == $curator) && ($curatorRow['isActive'] == 1)) {
        SSFDebug::globaldebugger()->belch('curatorIsActive self::locallyActiveCuratorsArray', self::$locallyActiveCuratorsArray, -1); 
        if (count(self::$locallyActiveCuratorsArray) == 0 || self::$locallyActiveCuratorsArray[0] == '') return true;
        else if (in_array($curatorRow['curator'], self::$locallyActiveCuratorsArray)) return true;
      }
    }      
    return false;
  }

  public static function selectCurationDataFor($workId, $callForEntries, $applyLocallyActiveCuratorFilter=true) {
    self::checkInit($callForEntries);
    SSFDebug::globalDebugger()->bechoTrace('selectCurationDataFor applyLocallyActiveCuratorFilter ', $applyLocallyActiveCuratorFilter, -1);
    $activeCuratorWhereClause = (($applyLocallyActiveCuratorFilter) ? ' AND ' . self::locallyActiveCuratorWhereClause() : "");
	  $curationDataSelectString = "SELECT DISTINCT entry, curation.curator, score, notes"
	                            . " FROM curation JOIN curators on curation.curator=curators.curator"
	                            . " WHERE entry = " . $workId
	                            . ' AND curators.isActive = 1' . $activeCuratorWhereClause;
//    self::debugNextQuery();
    $curationDataArray = SSFDB::getDB()->getArrayFromQuery($curationDataSelectString);
    SSFDebug::globalDebugger()->belch('curationDataArray selectCurationDataFor ' . $workId, $curationDataArray, -1);
    return $curationDataArray;
	}

/*	
  // Returns a simple array of curator personIds
  public static function getCuratorsForWork($workId) {
    $workRow = self::selectWorkFor($workId);
    $callForEntriesId = $workRow['callForEntries'];
    $curators = self::getCuratorsForCallForEntries($callForEntriesId);
    return $curators;
  }
*/

  // Returns a simple array of curator personIds
  public static function getCuratorsForCallForEntries($callForEntriesId) {
    $selectString = 'SELECT callForEntries, curator, nickName FROM curators JOIN people on curator=personId WHERE callForEntries=' . $callForEntriesId . ' ORDER BY nickName';
//    $selectString = 'SELECT callForEntries, curator FROM curators WHERE callForEntries=' . $callForEntriesId;
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $curators = array();
    foreach ($curatorRows as $curatorRow) $curators[] = $curatorRow['curator'];
    return $curators;
  }

  public static function getCuratorRows($callForEntries) { return self::checkInit($callForEntries); self::$curatorRows; }
  
  // Returns rows of curator personIds and nickNames
  public static function getCuratorRowsForWork($workId, $callForEntries) {
    $workRow = self::selectWorkFor($workId);
    $callForEntriesId = $workRow['callForEntries'];
    $curatorRows = self::getCuratorRowsForCallForEntries($callForEntries);
    return $curatorRows;
  }

/*  // Returns rows of curator personIds and nickNames
  public static function getCuratorRowsForWork($workId, $callForEntries) {
    self::checkInit($callForEntries);
    $curatorRowsToReturn = array();
    SSFDebug::globalDebugger()->belch('getCuratorRowsForWork self::curatorRows ' . $workId, self::$curatorRows,  1);

    foreach (self::$curatorRows as $curatorRow) {
      if ($curatorRow['entry'] == $workId) $curatorRowsToReturn[] = $curatorRow;
    }
    return $curatorRowsToReturn;
  }
*/
  
  // Returns rows of curator personIds and nickNames
  public static function getCuratorRowsForCallForEntries($callForEntriesId) {
    $selectString = 'SELECT callForEntries, curator, isActive, nickName'
                  . ' FROM curators JOIN people ON personId=curator'
                  . ' WHERE callForEntries=' . $callForEntriesId . ' ORDER BY nickName';
//    self::debugNextQuery();
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $curatorRows;
  }

  public static function getAdministratorsXPriorTo20110527() {
    $selectString = "SELECT personId, lastName, name, loginName FROM people"
                  . " WHERE relationship like '%SansSouciStaff%'"
                  . " or relationship like '%SansSouciDirector%'"
                  . " ORDER BY lastName, name";
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $personRows;
  }
  
  public static function getAdministrators() {
    $selectString = "SELECT adminId, adminFullName, adminTitle, adminEmail, valediction, personId, lastName, name, loginName"
                  . " FROM administrators join people on adminId = personId"
                  . " WHERE isActive = 1"
                  . " ORDER BY lastName, name";
    //self::debugNextQuery();
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $personRows;
  }
  
  private static function selectShowsForHelper($event, $orderBy) {
    $showsSelectString = "SELECT showId, shortDescription "
                       . "FROM shows WHERE shows.active=1 and shows.event=" . $event 
                       . " ORDER BY " . $orderBy; // 7/16/11 added shows.active=1
    $showRows = SSFDB::getDB()->getArrayFromQuery($showsSelectString);
    return $showRows;
  }

  public static function selectShowsFor($event) { return self::selectShowsForHelper($event, 'showId'); }

  public static function selectShowsInOrderFor($event, $orderByClause) { return self::selectShowsForHelper($event, $orderByClause); }

  public static function getStillImageDirectories() {
    $getImageDirectoriesString = 'SELECT directory FROM `images` WHERE 1 GROUP BY directory ORDER BY directory';
    $imagesDirectoryRows = SSFDB::getDB()->getArrayFromQuery($getImageDirectoriesString);
    $imagesDirectories = array();
    foreach ($imagesDirectoryRows as $imagesDirectoryRow) { $imagesDirectories[] =  $imagesDirectoryRow['directory']; }
    SSFDebug::globalDebugger()->belch('imagesDirectories', $imagesDirectories, -1);
    return $imagesDirectories;
  }

  public static function quote($string) {
    $string1 = trim($string);
    $string2 = stripslashes($string1);
    $string3 = mysql_real_escape_string($string2);
    return "'" . $string3  . "'";
//    $stringSansEscapeCharacters = str_replace("\\", "", $string); // strip out the backslashes
//    return "'" . str_replace("'", "\'", trim($stringSansEscapeCharacters)) . "'";
  }

  private static function basicWorksQueryHelper($queryFilterString, $querySortString, $havingClauseForScore) {
    $whereClause = "withdrawn=0 ";
    $whereClause .= ((($queryFilterString != "")) ? "AND " . $queryFilterString : "");
    $whereClause .= ' AND curators.isActive = 1 AND ' . self::locallyActiveCuratorWhereClause();
    $havingClauseText = ($havingClauseForScore == "") ? "" : "HAVING " .  $havingClauseForScore . " ";
    $basicWorksQuery = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, score, titleForSort, workId, "
                         . "workId AS work, title, yearProduced, countryOfProduction, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                         . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, includesLivePerformance, filename, "
                         . "dateMediaReceived, (dateMediaReceived is not null and dateMediaReceived != '0000-00-00') AS mediaReceived, "
                         . "amtPaid, datePaid, avg(score) AS avgScore, vimeoWebAddress, vimeoPassword "
                         . "FROM works "
                         . "LEFT JOIN people on people.personId=works.submitter "
                         . "LEFT JOIN curation on curation.entry=works.workId "
                         . "LEFT JOIN curators on curators.curator=curation.curator "
                         . "WHERE " . $whereClause . " "
                         . "GROUP BY works.workId " . $havingClauseText . " "
                         . "ORDER BY " . $querySortString;
    return $basicWorksQuery;
  }

  // When calling from the Admin screen, pass in SSFRunTimeValues::getAdministratorId() as the 2nd parameter.
  public static function addCurationRowsForNewWork($workId, $administratorId=0) {
    $callForEntries = SSFRunTimeValues::getInitialCallForEntriesId();
    $curatorsSelectString = "SELECT curator FROM curators WHERE callForEntries=" . $callForEntries . " ORDER BY curator ASC;";
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($curatorsSelectString);
    $curators = array();
    foreach ($curatorRows as $curationRow) $curators[] = $curationRow['curator']; 
    SSFDebug::globalDebugger()->belch('curators', $curators, -1);
    $curatorCount = count($curators);
    $conjunctiveOperator = '';
    if ($curatorCount > 0) {
      $selectionDisjunction = ' AND (';
      foreach ($curators as $curator) {
        $selectionCriteria = "(curator = " . $curator . ")";
        $selectionDisjunction .= $conjunctiveOperator . $selectionCriteria;
        $conjunctiveOperator = ' || ';
      }
      $selectionDisjunction .= ') ';
      SSFDebug::globalDebugger()->belch('selectionDisjunction', $selectionDisjunction, -1);
      // READ the VALUES FROM the curation table
    	$curationSelectString = "SELECT entry, curator FROM curation "
                            . " WHERE entry = " . $workId . $selectionDisjunction;
      //SSFDB::debugNextQuery();
      $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
      // Insert a row into the curation table for each workId/curator pair that is not there already.
      $curatorsToAdd = array();
      foreach ($curators as $curator) {
        $addARow = true;
        foreach ($curationRows as $curationRow) { if ($curator == $curationRow['curator']) { $addARow = false; break; } }
        if ($addARow) {
          $curatorsToAdd[] = $curator;
        }
      }
      $curationRowsToAddCount = count($curatorsToAdd);
      if ($curationRowsToAddCount > 0) {
        
        // Create the insert statement.
        $curationInsertString = "INSERT INTO curation (entry, curator, lastModificationDate, lastModifiedBy) VALUES ";
        $curatorsYetToAddCount = $curationRowsToAddCount;
        $valuesSeparator = ",\r\n";
        SendLog::initInfo("Curation Log", "curationlog@sanssoucifest.org", "curationlog@sanssoucifest.org");
        foreach ($curatorsToAdd as $curatorToAdd) {
          $curatorsYetToAddCount--;
          if ($curatorsYetToAddCount == 0) $valuesSeparator = ""; // if this is the last row to add
          $curationInsertString .= "(" . $workId . ", " . $curatorToAdd . ", NOW(), " . $administratorId . ")" . $valuesSeparator;
          SendLog::$message .= '** SSFQuery::addCurationRowsForNewWork() Attempting to add curator ' . $curatorToAdd . ' for work ' . $workId . '.' . "\r\n";
        }
        //SSFDB::debugNextQuery();
        $success = SSFDB::getDB()->saveData($curationInsertString);
        SendLog::$message .= "\r\n ** SSFQuery::addCurationRowsForNewWork() Attempted to add " . $curationRowsToAddCount . " curators.\r\n";
        if ($success) {
          SendLog::$message .= '** SSFQuery::addCurationRowsForNewWork() Added ' . $curationRowsToAddCount . ' curators.' . "\r\n";
        } else {
          SendLog::$message .= "\r\n\r\n" . '** SSFQuery::addCurationRowsForNewWork() Failed to add some curator. Check curation table in DB.' . "\r\n"
                            . " MySQL Error#" . SSFDB::getDB()->lastErrorNo() . " " . SSFDB::getDB()->lastErrorText() . "\r\n"
                            . " QUERY: " . $curationInsertString  . "\r\n";
        }
        // Since we just changed the DB, we need to reinitialize from the curation table if that data is needed again later.
        $curatorsAreInitialized = false; 
        if (SendLog::$message != '') SendLog::sendItNow();
      }
    }
  }

  public static function selectCuratedWorksArray($queryFilterString, $querySortString, $havingClauseForScore, $curationEmailFilter="") {
    SSFDebug::globalDebugger()->bechoTrace('selectCuratedWorksArray()', '', -1);
    $basicWorksQuery = self::basicWorksQueryHelper($queryFilterString, $querySortString, $havingClauseForScore);
    if ($curationEmailFilter == "") { 
      // WITHOUT email info
      $finalQuery = $basicWorksQuery;
    } else { 
      // WITH email info
      switch ($curationEmailFilter) {
        case "inclAll":
          $commsQueryWhere = "WHERE communications.type='AcceptReject' ";
          $finalQueryJoin = "LEFT JOIN ";
          $finalQueryWhere = "";
          break;
        case "inclSent":
          $commsQueryWhere = "WHERE (dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00') ";
          $finalQueryJoin = "JOIN ";
          $finalQueryWhere = "";
          break;
        case "inclNotSent": // unused as of 7/26/10
//          $commsQueryWhere = "WHERE !sent or isNull(sent)";
          $commsQueryWhere = "WHERE `work` NOT IN ";
          $finalQueryJoin = "LEFT JOIN ";
          $finalQueryWhere = "WHERE !sent OR isnull(sent) ";
          break;
      }
      if ($curationEmailFilter == "inclAll" || $curationEmailFilter == "inclSent") {
        $worksSelectQuery = "(" . $basicWorksQuery . ") ";
        $commsSelectQuery = "(SELECT communicationId, `type`, dateSent, `work`, "
                           . "(dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00') as sent "
                           . "FROM communicationWork "
                           . "LEFT JOIN communications on communications.communicationId=communicationWork.communication AND communications.type='AcceptReject'  "
                           . $commsQueryWhere
                           . ") ";
        $finalQuery = "SELECT * FROM (" . $worksSelectQuery . " AS worksSelected) "
                    . $finalQueryJoin . "(" . $commsSelectQuery . " AS commsSelected) "
                    . "ON commsSelected.work=worksSelected.workId "
                    . $finalQueryWhere . " "
                    . "ORDER BY " . $querySortString;
      } else { // this must be the case where $curationEmailFilter inclNotSent
        $finalQuery = "SELECT * FROM "
                    . "((" . $basicWorksQuery . ") AS worksSelected)" 
                    . " WHERE `work` NOT IN "
                    . "(SELECT `work` "
                    . "FROM communicationWork "
                    . "LEFT JOIN communications on communications.communicationId=communicationWork.communication AND communications.type='AcceptReject'  "
                    . "WHERE (dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00') "
                    . ")";
      }
    }
    //SSFDB::debugNextQuery();
    $works = SSFDB::getDB()->getArrayFromQuery($finalQuery);
    return $works;
  }
  
  // TODO Merge with selectSubmitterAndWorkWithARCommsFor()
  public static function selectAccRejWorkRow($workId) {
    $worksSelectString = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, email, "
                       . "workId, title, yearProduced, countryOfProduction, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "photoLocation, communications.communicationId, communications.type, communications.sent, "
                       . "communications.dateSent, communications.sender, communications.contentText, "
                       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
                       . "contentLastModDate, vimeoWebAddress, vimeoPassword, filename "
                       . "FROM works LEFT JOIN (people, curation) "
                       . "on (people.personId=works.submitter and curation.entry=works.workId) "
//                       . "LEFT JOIN (communications) on (communications.referencedWork=works.workId) "   replaced 4/22/09
                       . "LEFT JOIN communicationWork on communicationWork.work=works.workId "
                       . "LEFT JOIN communications on communications.communicationId=communicationWork.communication and communications.type='AcceptReject' "
                       . "WHERE workId=" . $workId . " GROUP BY works.workId;";
    $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    $workRow = $workRows[0];
    return $workRow;
  }

  private static function selectWorksForEventHelper($event, $orderByClause) {
    $completeOrderByClause = ($orderByClause != '') ? ($orderByClause . ', showOrder') : 'showOrder';
    $worksSelectString = "SELECT personId, people.name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, countryOfProduction, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, vimeoWebAddress, vimeoPassword, "
                       . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, works.filename, "
                       . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, images.directory, "
                       . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
                       . "shows.showId AS showId, shows.description AS showDescription, shows.shortDescription, showOrder "
                       . "FROM works "
                       . "LEFT JOIN (people) on (people.personId=works.submitter) "
                       . "LEFT JOIN (workImages) on (workImages.work=works.workId) "
                       . "LEFT JOIN (images) on (workImages.image=images.imageId) "
                       . "LEFT JOIN (runOfShow) on (runOfShow.work=works.workId) "
                       . "LEFT JOIN (shows) on (shows.showId=runOfShow.`show`) "
//                       . "WHERE accepted=1 and shows.event=" . $event . " "
                       // NOTE: Do the works need to have accepted status? I think they do. 7/16/11
                       . "WHERE shows.active=1 and accepted=1 and shows.event=" . $event . " " // 7/16/11 added shows.active=1
//  										 . "ORDER BY showId, titleForSort";
                       . "ORDER BY " . $completeOrderByClause;
    $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    return $workRows;
  }
  
  public static function selectWorksForEvent($event) { return self::selectWorksForEventHelper($event, 'showId'); }

  public static function selectWorksInOrderForEvent($event, $orderByClause) { return self::selectWorksForEventHelper($event, $orderByClause); }

  public static function personEmailAlreadyInDatabase($emailString) {
    $debugPersonEmail = -1;
    $selectString = "SELECT personId, `name`, lastName, nickName, email FROM people WHERE email = '" . $emailString . "'";
    //self::debugNextQuery();
    $peopleRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $repeats = count($peopleRows);
    SSFDebug::globalDebugger()->becho('peopleRows repeats', $repeats, $debugPersonEmail);
    $personAlreadyInDB = ($repeats > 0);
    return $personAlreadyInDB;
  }

  public static function workExistsInDatabase($submitter, $callForEntries, $title) {
    $workSelectString = "SELECT workId FROM works WHERE `submitter` = " . $submitter 
                      . " and `callForEntries` = " . $callForEntries . " and `title` = " . self::quote($title);
    //SSFDB::debugNextQuery();
    $workRows = SSFDB::getDB()->getArrayFromQuery($workSelectString);
    if (($workRows == false) || (count($workRows) == 0)) return false;
    else return $workRows[0]['workId'];
  }

  private static function getPersonRowsForEmail($email) {
    $selectString = "SELECT personId FROM people WHERE `email` = " . self::quote($email);
    //self::debugNextQuery();
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $rows;
  }
  
  public static function personExistsInDatabase($email) {
    $rows = self::getPersonRowsForEmail($email);
    SSFDebug::globalDebugger()->belch('SSFQuery::personExistsInDatabase() rows', $rows, -1);
    if (($rows === null) || ($rows === false) || (count($rows) == 0)) return false;
    else return $rows[0]['personId'];
  }

  public static function multiplePeopleExistInDatabase($email) {
    $rows = self::getPersonRowsForEmail($email);
    SSFDebug::globalDebugger()->belch('multiplePeopleExistInDatabase rows', $rows, -1);
    $multiplePeople = (($rows === null) || ($rows === false) || (count($rows) >= 1));
    SSFDebug::globalDebugger()->belch('multiplePeopleExistInDatabase count($rows)', count($rows), -1);
    SSFDebug::globalDebugger()->belch('multiplePeopleExistInDatabase multiplePeople', $multiplePeople, -1);
    return $multiplePeople;
  }

  public static function submitterHasWorksForThisCall($personId) {
    //self::debugNextQuery();
    $debugSubmitterHasWorks = -1;
    $rows = self::selectWorksFor($personId, $debug=false);
    SSFDebug::globalDebugger()->belch('selectWorksFor(personId)', $rows, $debugSubmitterHasWorks);
    SSFDebug::globalDebugger()->becho('count($rows)', count($rows), $debugSubmitterHasWorks);
    return (($rows !== false) && (count($rows) != 0));
  }

}
?>