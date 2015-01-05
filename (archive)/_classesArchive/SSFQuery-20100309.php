<?php

class SSFQuery {

  public static function success() { return SSFDB::getDB()->querySuccess(); }
  
  public static function computeSortClauseAndText($sortValue1, $sortValue2) {
    self::$querySortString = '';
    self::$querySortDisplayText = ''; 
    self::computeSortClause(1, $sortValue1);
    self::computeSortClause(2, $sortValue2);
  }
  
  public static function getQuerySortString() { return self::$querySortString; }
  public static function getQuerySortDisplayText() { return self::$querySortDisplayText; }
  
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
        case "titleSort":
          self::$querySortString .= $querySortStringPrefix . " title ASC";
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
      $whereClause = " where " . $callForEntriesWhereClause . " and " . $submitterWhereClause;
    else if ($callForEntriesWhereClause != "") 
      $whereClause = " where " . $callForEntriesWhereClause;
    else if ($submitterWhereClause != "") 
      $whereClause = " where " . $submitterWhereClause;
    $selectString = "SELECT workId, title, titleForSort, name from works join people on submitter=personId " 
                  . $whereClause . " order by titleForSort asc, title asc";
    //echo $selectString . "<br><br>\r\n"; debug_print_backtrace(); // var_dump(debug_backtrace());
    if ($debug) SSFDB::debugNextQuery();
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
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
    $submitterAndWorkArrayOuter = SSFDB::getDB()->getArrayFromQuery($submitterWorkSelectString); 
    if ($debug) { print_r($submitterAndWorkArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $submitterAndWorkArray = $submitterAndWorkArrayOuter[0];
    } else {
      echo 'ERROR: Person or work not in database (or some other DB error) in ' 
           . selectSubmitterAndWorkFor . '.  workId=' . $workId . '<br>' . "\r\n";
      debug_print_backtrace();
    }
    return $submitterAndWorkArray;
  }

  public static function selectSubmitterAndWorkNoCommsFor($workId, $debug=false) {
    $submitterWorkSelectString = 'SELECT * from people join works on submitter=personId where workId=' . $workId;
    return self::selectSubmitterAndWorkFor($workId, $submitterWorkSelectString, $debug);
  }
  
  // TODO Merge with selectAccRejWorkRow()
  public static function selectSubmitterAndWorkWithARCommsFor($workId, $debug=false) {
    $submitterWorkSelectString = 'SELECT ' 
       . 'personId, name, lastName, organization, email, city, stateProvRegion, country, workId, title, titleForSort, '
       . 'yearProduced, designatedId, runTime, webSite, accepted, rejected, submissionFormat, originalFormat, '
       . 'synopsisOriginal, previouslyShownAt, includesLivePerformance, dateMediaReceived, amtPaid, avg(score), '
       . 'workNotes, submissionNotes, mediaNotes, callForEntries, synopsisEdit1, synopsisEdit2, webSitePertainsTo, ' 
       . 'photoLocation, invited, amtPaid, howPaid, checkOrPaypalNumber, permissionsAtSubmission, '
       . 'communications.communicationId, communications.type, communications.sent, '
       . "communications.dateSent, communications.sender, communications.contentText, "
       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
       . "contentLastModDate "
       . 'from ((works left join people on people.personId=works.submitter) '
       . 'left join curation on curation.entry=works.workId) '
       . 'left join communications on communications.referencedWork=works.workId '
       . 'where works.workId=' . $workId;
    return self::selectSubmitterAndWorkFor($workId, $submitterWorkSelectString, $debug);
  }
  
  public static function selectPersonFor($personId, $debug=false) {
    $personSelectString = 'SELECT * from people where personId=' . $personId;
    if ($debug) SSFDB::debugNextQuery();
    $personArrayOuter = SSFDB::getDB()->getArrayFromQuery($personSelectString); 
    if ($debug) { print_r($personArrayOuter); echo "<br><br>\r\n"; }
    if (SSFDB::getDB()->querySuccess() && (SSFDB::getDB()->rowsSelected() == 1)) {
      $personArray = $personArrayOuter[0];
    } else {
      $personArray = array();
      echo 'ERROR: Person not in database (or some other DB error) in selectPersonFor where personId=' . $personId . '.<br>' . "\r\n";
      debug_print_backtrace();
    }
    return $personArray;
  }

  public static function selectPersonByLoginName($loginName, $debug=false) {
    $personSelectString = 'SELECT * from people where loginName=' . self::quote($loginName);
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
    $workSelectString = 'SELECT * from works where workId=' . $workId;
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
        //echo "\r\n itemValues " . $dataItemKey . " "; print_r($itemValues); echo "\r\n";
        //echo '<br>\r\n isset(itemValues) '; echo ((isset($itemValues)) ? 'TRUE' : 'false'); echo '<br>\r\n';
        // Note that an empty set will fail isset($itemValues) so we must handle this as a special case.
        if (isset($itemValues) || ($dpObject->swDataType == 'set')) {
          //echo "<br>\r\n dpObject "; print_r($dpObject); echo "<br><br>\r\n";
          if ($dpObject->swDataType == 'set') { // the data item is a set
            $setString = '';
            if (isset($itemValues)) foreach ($itemValues as $setMember) {
              $separator = ($setString == '') ? '' : ',';
              $setString .= $separator . $setMember;
            }
            $newValue = $setString;
          } else { // since this data item is not a set
            $newValue = $stateArray[$dataItemKey];
          }
        $insertArray[$colName] = $newValue;
        }
      }
    }
    foreach ($insertArray as $insertCol => $insertValue) {
      $separator = ($insertColString == '') ? '' : ', ';
      $insertColString .= $separator . $insertCol;
      $insertValueString .= $separator . SSFQuery::quote($insertValue);
    }
    //echo "<br>\r\nnewValueArray: "; print_r($newValueArray); echo "<br>\r\n"; 
    $insertString = "INSERT INTO " . SSFDB::getSchemaName() . "." . $tableName . " (" . $insertColString;
    $insertString .= ", lastModificationDate, lastModifiedBy"  . ") VALUES (";
    $insertString .= $insertValueString . ", NOW(), " . 1 . ")";
    //echo "<br>\r\ninsertString: " . $insertString . "<br>\r\n"; 
    //SSFDB::debugNextQuery();
    SSFDB::getDB()->saveData($insertString);
    return SSFDB::getDB()->insertedId();
  }
  
  private static function contributorDbName($contributors, $roleString) {
    if (!isset($contributors[$roleString]['name'])) return false;
//    if (strpos($roleString, 'Other_') === false) return $contributors[$roleString]['name'];
//    if ($contributors[$roleString]['roleDescription'] == '') return false;
//    if ($contributors[$roleString]['roleDescription'] == null) return false;
    return $contributors[$roleString]['name'];
  }

  private static function contributorDbRoleDescription($contributors, $roleString) {
    if (!isset($contributors[$roleString]['roleDescription'])) return false;
//    if (strpos($roleString, 'Other_') === false) return $contributors[$roleString]['roleDescription'];
//    if ($contributors[$roleString]['roleDescription'] == '') return false;
//    if ($contributors[$roleString]['roleDescription'] == null) return false;
    return $contributors[$roleString]['roleDescription'];
  }

  private static function contributorNewName($newValueArray, $roleString) {
    if (!isset($newValueArray[$roleString]['name'])) return false;
    return $contributors[$roleString]['name'];;
  }

  public static function updateDBForWorkContributors($newValueArray, $workId) {
    $belchAlot = -1;
    SSFDebug::globalDebugger()->belch('$newValueArray in SSFQuery::updateDBForWorkContributors', $newValueArray, $belchAlot);
    $dbValueArrayRaw = SSFQuery::selectContributorsFor($workId);
    SSFDebug::globalDebugger()->belch('$dbValueArrayRaw in SSFQuery::updateDBForWorkContributors', $dbValueArrayRaw, $belchAlot);
    foreach ($dbValueArrayRaw as $contributor) {
      $role = $contributor['role'];
      if (isset($role) && ($role != '')) $dbValueArray[$role] = $contributor;
    }
    SSFDebug::globalDebugger()->belch('$dbValueArray in SSFQuery::updateDBForWorkContributors', $dbValueArray, $belchAlot);
    $roleKeys = DatumProperties::workContributorRoleKeys();
    
    // Possibilities:
    
    // The values exist in both $newValueArray and $dbValueArray.
    // - If $newValue != $currentValue && $newValue != '' UPDATE the row in the database.
    // A value exists in $newValueArray but not $dbValueArray.
    // - If $newValueArray != '', INSERT the row into the database.
    // A value exists in $dbValueArray but not $newValueArray or $newValue = ''
    // - REMOVE the row from the database or set it to ''

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
          $insertString = "INSERT INTO workContributors (work, optionalContributor, role, roleDescription, `name`, lastModificationDate, lastModifiedBy) "
                                     . "VALUES (" . $workId . ", " . $optionalContributor . ", " . SSFQuery::quote($roleKey) . ", " 
                                     .  SSFQuery::quote($newRoleDescription) . ", " . SSFQuery::quote($newName) . ", NOW(), " . $updatingUserId . ")";
          //SSFDB::debugNextQuery();
          $querySuccess = SSFDB::getDB()->saveData($insertString);
        } else { 
          // The values exist in both $newValueArray and $dbValueArray and they are different so update the row.
          $updateString = "UPDATE workContributors set name = " . self::quote($newName) . ", roleDescription=" . self::quote($newRoleDescription)
                        . ", optionalContributor=" . (($optionalContributor) ? 1 : 0) . ", lastModificationDate=NOW(), lastModifiedBy=" . $updatingUserId
                        . " where work=" . $workId . " and role=" . self::quote($roleKey);
          SSFDebug::globalDebugger()->becho('contributors[' . $roleKey . '][name] in SSFQuery::updateDBForWorkContributors()', $dbValueArray[$roleKey]['name'], 0);
          //SSFDB::debugNextQuery();
          SSFDB::getDB()->saveData($updateString);
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
  }
  
  public static function updateDBFor($tableName, $currentValueArray, $newValueArray, $keyName, $keyValue) {
    $updateArray = array();
    //echo '<br>\r\n DatumProperties::getColsForTable(table) '; print_r(DatumProperties::getColsForTable($tableName)); echo '<br>\r\n';
    foreach (DatumProperties::getColsForTable($tableName) as $colName) {
      $dataItemKey = DatumProperties::getItemKeyFor($tableName, $colName);
      $dpArray = DatumProperties::getArray();
      $dpObject = DatumProperties::forKey($dataItemKey);
      if (isset($newValueArray[$dataItemKey]) && $dpObject->dbColKey != 'PRI') { // never update the value of a primary key.
        $itemValues = $newValueArray[$dataItemKey];
        //echo "\r\n itemValues " . $dataItemKey . " "; print_r($itemValues); echo "\r\n";
        //echo '<br>\r\n isset(itemValues) '; echo ((isset($itemValues)) ? 'TRUE' : 'false'); echo '<br>\r\n';
        // Note that an empty set will fail isset($itemValues) so we must handle this as a special case.
        if (isset($itemValues) || ($dpObject->swDataType == 'set')) {
          //echo "<br>\r\n dpObject "; print_r($dpObject); echo "<br><br>\r\n";
          if ($dpObject->swDataType == 'set') { // the data item is a set
            $setString = '';
            if (isset($itemValues)) foreach ($itemValues as $setMember) {
              $separator = ($setString == '') ? '' : ',';
              $setString .= $separator . $setMember;
            }
            $newValue = $setString;
          } else { // since this data item is not a set
            $newValue = $newValueArray[$dataItemKey];
          }
                // TODO What is this? vvv Why would want the current value to be not set before adding this column to the updateArray list? Removed 2/7/09
          //if (!isset($currentValueArray[$colName]) || $newValue != $currentValueArray[$colName]) { // add this to the update list.
          if ($newValue != $currentValueArray[$colName]) { // add this to the update list.
            $updateArray[$colName] = $newValue;
          }
        }
      }
    }
    //return $updateArray;
    if (count($updateArray) > 0) { // there are updates
      $updatesString = '';
      $updatingUserId = isset($newValueArray['adminSelector']) ? $newValueArray['adminSelector'] 
                      : isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId'] : 0;
      foreach ($updateArray as $updateCol => $updateValue) {
        $separator = ($updatesString == '') ? '' : ', ';
        $updatesString .= $separator . $updateCol . '='. SSFQuery::quote($updateValue);
      }
      $updateString = "UPDATE " . $tableName . " set " . $updatesString 
                    . ", lastModificationDate=NOW(), lastModifiedBy=" . $updatingUserId
                    . " where " . $keyName . " = " . $keyValue;
      //SSFDB::debugNextQuery();
      SSFDB::getDB()->saveData($updateString);
    }
  }

  public static function saveCuratorData($curatorId, $workId, $score, $notes, $adminId=0) {
    $scoreString = (($score == '--') ? 'NULL' : $score);
    $curationSelectString = "SELECT * FROM curation WHERE entry=" . $workId . " and curator=" . $curatorId;
    $curationRows = SSFDB::getDB()->getArrayFromQuery($curationSelectString);
    $curationRecordExists = (count($curationRows) == 1);
    if ($curationRecordExists) {
      $curatorInsertOrUpdateString = "UPDATE curation set score=" . $scoreString . ", notes=" . SSFQuery::quote($notes)
                                   . ", lastModificationDate=NOW(), lastModifiedBy=" . $adminId
                                   . " where curator=" . $curatorId . " and entry=" . $workId;
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
	  $curationDataSelectString = "SELECT entry, curator, score, notes from curation where entry = " . $workId;
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
    $selectString = 'SELECT callForEntries, curator from curators where callForEntries=' . $callForEntriesId;
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
    $selectString = 'SELECT callForEntries, curator, nickName from curators join people '
                  . 'on personId=curator where callForEntries=' . $callForEntriesId;
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $curatorRows;
  }

  public static function getAdministrators() {
    $selectString = "SELECT personId, lastName, name, loginName from people"
                  . " where relationship like '%SansSouciStaff%'"
                  . " or relationship like '%SansSouciDirector%'"
                  . " order by lastName, name";
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    return $personRows;
  }
  
  public static function selectShowsFor($event) {
    $showsSelectString = "SELECT showId, shortDescription "
                       . "from shows where shows.event=" . $event . " order by showId";
    $showRows = SSFDB::getDB()->getArrayFromQuery($showsSelectString);
    return $showRows;
  }

  public static function getStillImageDirectories() {
    $getImageDirectoriesString = 'SELECT directory FROM `images` WHERE 1 group by directory order by directory';
    $imagesDirectoryRows = SSFDB::getDB()->getArrayFromQuery($getImageDirectoriesString);
    $imagesDirectories = array();
    foreach ($imagesDirectoryRows as $imagesDirectoryRow) { $imagesDirectories[] =  $imagesDirectoryRow['directory']; }
    SSFDebug::globalDebugger()->belch('imagesDirectories', $imagesDirectories, -1);
    return $imagesDirectories;
  }

  public static function quote($string) {
//    mysql_real_escape_string()
    $stringSansEscapeCharacters = str_replace("\\", "", $string); // strip out the backslashes
    return "'" . str_replace("'", "\'", trim($stringSansEscapeCharacters)) . "'";
  }

  public static function fixQuotes($string) {
//    mysql_real_escape_string()
    $stringSansEscapeCharacters = str_replace("\\", "", $string); // strip out the backslashes
    return "'" . str_replace("'", "\'", trim($stringSansEscapeCharacters)) . "'";
  }

  public static function selectCuratedWorksArray($queryFilterString, $querySortString, $havingClause, $withAcceptRejectEmailInfo=false) {
    /* working example for including avg(score):
      SELECT designatedId, workId, title, personId, name, avg(score) from works left join (people, curation) 
      on (people.personId=works.submitter and curation.entry=works.workId) 
      where callForEntries=1 group by works.workId order by avg(score)
    */
    
    $validatedQueryFilterString = ((isset($queryFilterString)) ? $queryFilterString : '');
    $joinCommunicationsTableText = $communicationsFieldsText = '';
    if ($withAcceptRejectEmailInfo) {
      $joinCommunicationsTableText = "left join communications on communications.referencedWork=works.workId ";
      $communicationsFieldsText = ", communications.communicationId, communications.type, communications.sent ";
    }    

    $whereClause = ((($validatedQueryFilterString != "")) ? "where " . $validatedQueryFilterString . " " : " ");

    $worksSelectString = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, "
                       . "includesLivePerformance, dateMediaReceived, amtPaid, avg(score) "
                       . $communicationsFieldsText
                       . "from ((works left join people on people.personId=works.submitter) "
                       . "left join curation on curation.entry=works.workId) "
                       . $joinCommunicationsTableText
                       . $whereClause
                       . "group by works.workId " . $havingClause
                       . " order by " . $querySortString . ";";
    //SSFDB::debugNextQuery();
    $works = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    return $works;
  }
  
  // TODO Merge with selectSubmitterAndWorkWithARCommsFor()
  public static function selectAccRejWorkRow($workId) {
    $worksSelectString = "SELECT personId, name, lastName, organization, city, stateProvRegion, country, email, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "photoLocation, communications.communicationId, communications.type, communications.sent, "
                       . "communications.dateSent, communications.sender, communications.contentText, "
                       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
                       . "contentLastModDate "
                       . "from works left join (people, curation) "
                       . "on (people.personId=works.submitter and curation.entry=works.workId) "
                       . "left join (communications) on (communications.referencedWork=works.workId) "
                       . "where workId=" . $workId . " group by works.workId;";
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
                       . "from works "
                       . "left join (people) on (people.personId=works.submitter) "
                       . "left join (workImages) on (workImages.work=works.workId) "
                       . "left join (images) on (workImages.image=images.imageId) "
                       . "left join (runOfShow) on (runOfShow.work=works.workId) "
                       . "left join (shows) on (shows.showId=runOfShow.`show`) "
                       . "where accepted=1 and shows.event=" . $event . " "
  //										 . "order by showId, titleForSort";
                       . "order by showId, showOrder";
    $workRows = SSFDB::getDB()->getArrayFromQuery($worksSelectString);
    return $workRows;
  }

  public static function personAlreadyInDatabase($emailString) {
    $selectString = "SELECT personId, `name`, lastName, nickName, email from people where email = '" . $emailString . "'";
    $workRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $repeats = count($workRows);
SSFDebug::globalDebugger()->becho('workRows repeats', $repeats, -1);
    $personAlreadyInDB = ($repeats > 0);
    return $personAlreadyInDB;
  }

}


?>