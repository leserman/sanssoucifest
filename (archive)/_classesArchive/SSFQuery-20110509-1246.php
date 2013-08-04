<?php

class SSFQuery {

  public static function success() { return SSFDB::getDB()->querySuccess(); }

  // Returns the number of records in $tableName WHERE $colName = $colValue
  public static function getRecordCount($tableName, $colName, $colValue) {
    $queryString = 'SELECT count(*) as cnt FROM `' . $tableName . '` WHERE ' . $colName . '=' . $colValue;
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

  private static function computeSortClause($sortIter, $sortIndexValue) {
    if ($sortIter == 1) {
      $sortTextPrefix = ' sorted by ';
      $querySortStringPrefix = '';
    } else if ($sortIter == 2) {
      $sortTextPrefix = ' and then by ';
      $querySortStringPrefix = ', ';
    } 
    if (isset($sortIndexValue)) {
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
    $whereClause = "";
    if ($callForEntriesWhereClause != "" and $submitterWhereClause != "") 
      $whereClause = " WHERE " . $callForEntriesWhereClause . " and " . $submitterWhereClause;
    else if ($callForEntriesWhereClause != "") 
      $whereClause = " WHERE " . $callForEntriesWhereClause;
    else if ($submitterWhereClause != "") 
      $whereClause = " WHERE " . $submitterWhereClause;
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
       . 'yearProduced, designatedId, runTime, webSite, accepted, rejected, acceptFor, submissionFormat, originalFormat, '
       . 'synopsisOriginal, previouslyShownAt, includesLivePerformance, dateMediaReceived, '
       . '(dateMediaReceived is not null and dateMediaReceived != "0000-00-00") as mediaReceived, amtPaid, avg(score), '
       . 'workNotes, submissionNotes, mediaNotes, callForEntries, synopsisEdit1, synopsisEdit2, webSitePertainsTo, ' 
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
      echo 'ERROR: Person not in database (or some other DB error) in selectPersonFor WHERE personId=' . $personId . '.<br>' . "\r\n";
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
      echo 'ERROR: Person not in database (or some other DB error) in ' . selectPersonFor . '.<br>' . "\r\n";
      debug_print_backtrace();
    }
    return $workArray;
  }

  // Returns false on failure, the id generated for the auto-incremented column if there is one, or 0 if there is none. 
  public static function insertData($tableName, $stateArray) {
    $insertColString = '';
    $insertValueString = '';
    $separator = '';
    foreach (DatumProperties::getColsForTable($tableName) as $colName) {
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
            $newValue = ($dpObject->swDataType == 'int') ? sprintf('%d', $rawNewValue) : SSFQuery::quote($rawNewValue);
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
    $insertString = "INSERT INTO " . SSFDB::getSchemaName() . "." . $tableName . " (" . $insertColString;
    $insertString .= ", lastModificationDate, lastModifiedBy"  . ") VALUES (";
    $insertString .= $insertValueString . ", NOW(), " . 1 . ")";
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
      $updatingUserId = isset($newValueArray['adminSelector']) ? $newValueArray['adminSelector'] 
                      : isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId'] : 0;
      if ($valueChanged) {
        $notes ='';
        $optionalContributor = ($otherRole) ? 1 : 0;
        if (!$dbValueExists) {
          // The value does not exist in the DB so insert the row.
          // TODO someday: Not yet inserted into the workContributors DB table are values for columns personId, isPrincipalArtist, & notes.
          $listingOrder += 10;
          $insertString = 
            "INSERT INTO workContributors (work, listingOrder, optionalContributor, role, roleDescription, `name`, lastModificationDate, lastModifiedBy) "
                                     . "VALUES (" . $workId . ", " . $listingOrder . ", " . $optionalContributor . ", " . SSFQuery::quote($roleKey) . ", " 
                                     .  SSFQuery::quote($newRoleDescription) . ", " . SSFQuery::quote($newName) . ", NOW(), " . $updatingUserId . ")";
          //SSFDB::debugNextQuery();
          $querySuccess = SSFDB::getDB()->saveData($insertString);
          if ($querySuccess) { $rowsChangedCount += 1; }
        } else { 
          // The values exist in both $newValueArray and $dbValueArray and they are different so update the row.
          $updateString = "UPDATE workContributors set name = " . self::quote($newName) . ", roleDescription=" . self::quote($newRoleDescription)
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
            $newValue = ($dpObject->swDataType == 'int') ? sprintf('%d', $rawNewValue) : SSFQuery::quote($rawNewValue);
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
      $updatingUserId = isset($newValueArray['adminSelector']) ? $newValueArray['adminSelector'] 
                      : (isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId'] : 1);
      foreach ($updateArray as $updateCol => $updateValue) {
        $separator = ($updatesString == '') ? '' : ', ';
        $updatesString .= $separator . $updateCol . '='. $updateValue;
      }
      $updateString = "UPDATE " . $tableName . " set " . $updatesString 
                    . ", lastModificationDate=NOW(), lastModifiedBy=" . $updatingUserId
                    . " WHERE " . $whereKeyName . " = " . $whereKeyValue;
      //SSFDB::debugNextQuery();
      $success = SSFDB::getDB()->saveData($updateString);
    }
    return ($success) ? count($updateArray) : -1;
  }

  public static function saveCuratorData($curatorId, $workId, $score, $notes, $adminId=0) {
    $scoreString = (($score == '--') ? 'NULL' : $score);
    $curationSelectString = "SELECT * FROM curation WHERE entry=" . $workId . " and curator=" . $curatorId;
    $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
    $curationRecordExists = (count($curationRows) == 1);
    if ($curationRecordExists) {
      $curatorInsertOrUpdateString = "UPDATE curation set score=" . $scoreString . ", notes=" . SSFQuery::quote($notes)
                                   . ", lastModificationDate=NOW(), lastModifiedBy=" . $adminId
                                   . " WHERE curator=" . $curatorId . " and entry=" . $workId;
    } else { // since this is a new curation record
      $curatorInsertOrUpdateString = "INSERT INTO curation (curator, entry, score, notes, lastModificationDate, lastModifiedBy) "
                                   . "VALUES (" . $curatorId . ", " . $workId . ", " . $scoreString . ", " . SSFQuery::quote($notes)
                                   . ", NOW(), " . $adminId . ")";
    }
    //SSFDB::debugNextQuery();
    $querySuccess = SSFDB::getDB()->saveData($curatorInsertOrUpdateString);
    return $querySuccess;
  }

  public static function selectCurationDataFor($workId) {
	  $curationDataSelectString = "SELECT entry, curator, score, notes FROM curation WHERE entry = " . $workId;
    $curationDataArray = SSFDB::getDB()->getArrayFromQuery($curationDataSelectString);
    return $curationDataArray;
	}
	
  // Returns a simple array of curator personIds
  public static function getCuratorsForWork($workId) {
    $workRow = self::selectWorkFor($workId);
    $callForEntriesId = $workRow['callForEntries'];
    $curators = self::getCuratorsForCallForEntries($callForEntriesId);
    return $curators;
  }
  
  // Returns a simple array of curator personIds
  public static function getCuratorsForCallForEntries($callForEntriesId) {
    $selectString = 'SELECT callForEntries, curator, nickName FROM curators JOIN people on curator=personId WHERE callForEntries=' . $callForEntriesId . ' ORDER BY nickName';
//    $selectString = 'SELECT callForEntries, curator FROM curators WHERE callForEntries=' . $callForEntriesId;
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $curators = array();
    foreach ($curatorRows as $curatorRow) $curators[] = $curatorRow['curator'];
    return $curators;
  }

  // Returns rows of curator personIds and nickNames
  public static function getCuratorRowsForWork($workId) {
    $workRow = self::selectWorkFor($workId);
    $callForEntriesId = $workRow['callForEntries'];
    $curatorRows = self::getCuratorRowsForCallForEntries($callForEntriesId);
    return $curatorRows;
  }
  
  // Returns rows of curator personIds and nickNames
  public static function getCuratorRowsForCallForEntries($callForEntriesId) {
    $selectString = 'SELECT callForEntries, curator, nickName FROM curators JOIN people '
                  . 'on personId=curator WHERE callForEntries=' . $callForEntriesId . ' ORDER BY nickName';
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $curatorRows;
  }

  public static function getAdministrators() {
    $selectString = "SELECT personId, lastName, name, loginName FROM people"
                  . " WHERE relationship like '%SansSouciStaff%'"
                  . " or relationship like '%SansSouciDirector%'"
                  . " ORDER BY lastName, name";
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $personRows;
  }
  
  public static function selectShowsFor($event) {
    $showsSelectString = "SELECT showId, shortDescription "
                       . "FROM shows WHERE shows.event=" . $event . " ORDER BY showId";
    $showRows = SSFDB::getDB()->getArrayFromQuery($showsSelectString);
    return $showRows;
  }

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

/* Version prior to 7/20/10
  public static function selectCuratedWorksArray($queryFilterString, $querySortString, $havingClause, $withAcceptRejectEmailInfo=false) {
    // working example for including avg(score):
    // SELECT designatedId, workId, title, personId, name, avg(score) FROM works LEFT JOIN (people, curation) 
    // on (people.personId=works.submitter and curation.entry=works.workId) 
    // WHERE callForEntries=1 GROUP BY works.workId ORDER BY avg(score)
    $joinCommunicationsTableText = $communicationsFieldsText = $communicationsWhereClause = '';
    if ($withAcceptRejectEmailInfo) {
//      $joinCommunicationsTableText = "LEFT JOIN communications on communications.referencedWork=works.workId ";   replaced 4/22/09
      $joinCommunicationsTableText = "LEFT JOIN communicationWork on communicationWork.work=works.workId "
                                   . "LEFT JOIN communications on communications.communicationId=communicationWork.communication and communications.type='AcceptReject'";
      $communicationsFieldsText = ", communications.communicationId, communications.type, communications.dateSent "; //, communications.sent ";
    }    
    $whereClause = ((($queryFilterString != "")) ? " WHERE " . $queryFilterString . " " : " ");
    $worksSelectString = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, includesLivePerformance, "
                       . "dateMediaReceived, (dateMediaReceived is not null and dateMediaReceived != '0000-00-00') as mediaReceived, "
                       . "amtPaid, avg(score) as avgScore "
                       . $communicationsFieldsText
                       . "FROM works LEFT JOIN people on people.personId=works.submitter "
                       . "LEFT JOIN curation on curation.entry=works.workId "
                       . $joinCommunicationsTableText
                       . $whereClause
                       . "GROUP BY works.workId " . $havingClause
                       . " ORDER BY " . $querySortString . ";";
    //SSFDB::debugNextQuery();
    $works = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    return $works;
  }
*/
/*
SELECT * from 
    
((SELECT people.personId, people.name, works.workId, works.title, works.accepted, works.rejected, works.dateMediaReceived, avg(curation.score) as avgScore
FROM works 
JOIN people on people.personId=works.submitter 
JOIN curation on curation.entry=works.workId
WHERE works.callForEntries=8 and (workId=515 or workId=670 or workId=669 or workId=511) 
GROUP BY works.workId) as pworks)

LEFT JOIN 

((SELECT communicationId, `type`, dateSent, work FROM communicationWork
LEFT JOIN communications on communications.communicationId=communicationWork.communication
WHERE communications.type='AcceptReject') as comms)

ON comms.work=pworks.workId

ORDER BY workId ASC
*/
/*
  public static function selectCuratedWorksArray0($queryFilterString, $querySortString, $havingClause, $havingClauseForEmail="") {
    SSFDebug::globalDebugger()->bechoTrace('selectCuratedWorksArray()', '', -1);
    $whereClause = ((($queryFilterString != "")) ? $queryFilterString : "1");
    $worksSelectQuery = "(SELECT personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, includesLivePerformance, "
                       . "dateMediaReceived, (dateMediaReceived is not null and dateMediaReceived != '0000-00-00') as mediaReceived, "
                       . "amtPaid, avg(score) as avgScore, communicationId, `type`, dateSent, "
                       . "(dateSent is not null AND dateSent != '' AND dateSent != '0000-00-00' AND dateSent != '0000-00-00 00:00:00') as sent "
                       . "FROM works "
                       . "LEFT JOIN people on people.personId=works.submitter "
                       . "LEFT JOIN curation on curation.entry=works.workId "
                       . "LEFT JOIN communicationWork on communicationWork.work=works.workId "
                       . "LEFT JOIN communications on communications.communicationId=communicationWork.communication AND communications.type='AcceptReject' "
                       . "WHERE " . $whereClause . " "
                       . "GROUP BY works.workId " . $havingClause . " "
                       . "ORDER BY " . $querySortString . ") ";
    $commsSelectQuery = "(SELECT communicationId, `type`, dateSent, work FROM communicationWork "
                       . "LEFT JOIN communications on communications.communicationId=communicationWork.communication "
                       . "WHERE communications.type='AcceptReject') ";
    $finalQuery = ($havingClauseForEmail != "") 
                ? "SELECT * FROM (" . $worksSelectQuery . " AS worksSelected) "
                  . "LEFT JOIN (" . $commsSelectQuery . " AS commsSelected) "
                  . "ON commsSelected.work=worksSelected.workId "
                  . "ORDER BY " . $querySortString . ""
                : $worksSelectQuery;
    //SSFDB::debugNextQuery();
    $works = SSFDB::getDB()->getArrayFromQuery($finalQuery);
    return $works;
  }
*/  
  
  private static function basicWorksQueryHelper($queryFilterString, $querySortString, $havingClauseForScore) {
    $whereClause = ((($queryFilterString != "")) ? $queryFilterString : "1");
    $havingClauseText = ($havingClauseForScore == "") ? "" : "HAVING " .  $havingClauseForScore . " ";
    $basicWorksQuery = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, workId, "
                         . "workId as work, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                         . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, includesLivePerformance, "
                         . "dateMediaReceived, (dateMediaReceived is not null and dateMediaReceived != '0000-00-00') as mediaReceived, "
                         . "amtPaid, avg(score) as avgScore "
                         . "FROM works "
                         . "LEFT JOIN people on people.personId=works.submitter "
                         . "LEFT JOIN curation on curation.entry=works.workId "
                         . "WHERE " . $whereClause . " "
                         . "GROUP BY works.workId " . $havingClauseText . " "
                         . "ORDER BY " . $querySortString;
    return $basicWorksQuery;
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
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, acceptFor, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "photoLocation, communications.communicationId, communications.type, communications.sent, "
                       . "communications.dateSent, communications.sender, communications.contentText, "
                       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
                       . "contentLastModDate "
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

  public static function selectWorksForEvent($event) {
    $worksSelectString = "SELECT personId, people.name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, webSitePertainsTo, accepted, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
                       . "synopsisOriginal, synopsisEdit1, synopsisEdit2, includesLivePerformance, "
                       . "images.imageId, images.widthInPixels, images.heightInPixels, images.fileName, images.directory, "
                       . "images.caption, images.caption, images.altText, workImages.work, workImages.image, "
                       . "shows.showId as showId, shows.description as showDescription, shows.shortDescription, showOrder "
                       . "FROM works "
                       . "LEFT JOIN (people) on (people.personId=works.submitter) "
                       . "LEFT JOIN (workImages) on (workImages.work=works.workId) "
                       . "LEFT JOIN (images) on (workImages.image=images.imageId) "
                       . "LEFT JOIN (runOfShow) on (runOfShow.work=works.workId) "
                       . "LEFT JOIN (shows) on (shows.showId=runOfShow.`show`) "
                       . "WHERE accepted=1 and shows.event=" . $event . " "
  //										 . "ORDER BY showId, titleForSort";
                       . "ORDER BY showId, showOrder";
    $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    return $workRows;
  }

  public static function personEmailAlreadyInDatabase($emailString) {
    $debugPersonEmail = -1;
    $selectString = "SELECT personId, `name`, lastName, nickName, email FROM people WHERE email = '" . $emailString . "'";
    //self::debugNextQuery();
    $workRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $repeats = count($workRows);
    SSFDebug::globalDebugger()->becho('workRows repeats', $repeats, $debugPersonEmail);
    $personAlreadyInDB = ($repeats > 0);
    return $personAlreadyInDB;
  }

  public static function workExistsInDatabase($submitter, $callForEntries, $title) {
    $workSelectString = "SELECT workId FROM works WHERE `submitter` = " . $submitter 
                      . " and `callForEntries` = " . $callForEntries . " and `title` = " . self::quote($title);
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