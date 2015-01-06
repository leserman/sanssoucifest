<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
  include_once '../../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  function entryRequirementsDisplayString($section = '') {
    global $entryRequirementsInWindowFilename;
    if ($section == '') {
      $diaplayText = 'Entry Requirements';
      $trailerText = '';
    } else {
      $diaplayText = ucwords(strtolower(substr($section,1))) . ' Section';
      $trailerText = ' of the Entry Requirements';
    }
    $entryRequirementsDisplayString
    = '<a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open(\'' . $entryRequirementsInWindowFilename . $section . '\','  
    . '\'EntryRequirementsWindow\',\'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640\',false);'
    . 'entryRequirementsWindow.focus();">' . $diaplayText . '</a>' . $trailerText;
    return $entryRequirementsDisplayString;
  }
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>SSF - Fix Work Contributors</title> 
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
</head>
<body bgcolor="#999999">

<h1>SSF - Fix Work Contributors</h1>
May 16, 1014<br>
<br>
The code was written to gather workContributors from original email and insert them in the database.<br>
See &quot;fix EntryWorkContributors Notes.txt&quot; and related files.<br>
<br>
There is a deliberate exit to keep this file from being executed.<br>
This file can be used as a model for DB updates, but it should never be executed again.<br>
It has a bug that all diacritical characters in the input are corrupted when inserted into the database.<br>
<br>


<?php

exit(0);

  // Returns the number of records in $tableName WHERE $colName = $colValue
  function getRecordCount($tableName, $colName, $colValue) {
    $queryString = 'SELECT count(*) AS cnt FROM `' . $tableName . '` WHERE ' . $colName . '=' . $colValue;
    $result = SSFDB::getDB()->getArrayFromQuery($queryString);
    SSFDebug::globalDebugger()->belch('result in SSFQuery::getRecordCount', $result, -1);
    $count = ($result !== null) ? $result[0]['cnt'] : 0;
    return $count;
  }

  function contributorDbName($contributors, $roleString) {
    if (!isset($contributors[$roleString]['name'])) return false;
    else return $contributors[$roleString]['name'];
  }

  function contributorDbRoleDescription($contributors, $roleString) {
    if (!isset($contributors[$roleString]['roleDescription'])) return false;
    else return $contributors[$roleString]['roleDescription'];
  }

  function updateDBForWorkContributors($newValueArray, $workId) {
    $belchAlot = -1;
    $debugContribChanges = 1;
    $debugContribChanges2 = -1; // added 3/19/14
    SSFDebug::globalDebugger()->belch('$newValueArray in SSFQuery::updateDBForWorkContributors', $newValueArray, $belchAlot);
    $dbValueArrayRaw = SSFQuery::selectContributorsFor($workId);
    SSFDebug::globalDebugger()->belch('$dbValueArrayRaw in SSFQuery::updateDBForWorkContributors', $dbValueArrayRaw, $belchAlot);
    $lastUpdateFields = array();
    $dbValueArray = array();
    foreach ($dbValueArrayRaw as $contributor) {
      $role = $contributor['role'];
      if (isset($role) && ($role != '')) $dbValueArray[$role] = $contributor;
    }
    SSFDebug::globalDebugger()->belch('$dbValueArray in SSFQuery::updateDBForWorkContributors', $dbValueArray, $belchAlot);
    $roleKeys = DatumProperties::workContributorRoleKeys();
    // Compute the starting listingOrder for any new records.    
    $creditsCount = getRecordCount('workContributors', 'work', $workId);
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
      $dbName = contributorDbName($dbValueArray, $roleKey);
      $dbRoleDescription = contributorDbRoleDescription($dbValueArray, $roleKey);
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
//      $updatingUserId = (SSFQuery::$useAdministratorAsCreatorModifier) ? SSFAdmin::userIndex()
//                      : (isset($newValueArray['loginUserId']) ? $newValueArray['loginUserId']
//                      : (isset($newValueArray['works_submitter']) ? $newValueArray['works_submitter'] : 0));
      $updatingUserId = 1;
      if ($valueChanged) {
        SSFDebug::globalDebugger()->becho('roleKey in updateDBForWorkContributors()', $roleKey, $debugContribChanges2);
        SSFDebug::globalDebugger()->becho('valueChanged in updateDBForWorkContributors()', ($valueChanged) ? 'TRUE' : 'FALSE', $debugContribChanges2);
        SSFDebug::globalDebugger()->becho('otherRole in updateDBForWorkContributors()', ($otherRole) ? 'TRUE' : 'FALSE', $debugContribChanges2);
        SSFDebug::globalDebugger()->becho('dbValueExists in updateDBForWorkContributors()', ($dbValueExists) ? 'TRUE' : 'FALSE', $debugContribChanges2);
        SSFDebug::globalDebugger()->becho('dbNameExists in updateDBForWorkContributors()', ($dbNameExists) ? 'TRUE' : 'FALSE', $debugContribChanges2);
        SSFDebug::globalDebugger()->becho('dbRoleDescriptionExists in updateDBForWorkContributors()', ($dbRoleDescriptionExists) ? 'TRUE' : 'FALSE', $debugContribChanges2);
        $notes ='';
        $dataItemKey = DatumProperties::getItemKeyFor('workContributors', $roleKey);
        $lastUpdateFields[] = $dataItemKey;
        if ($otherRole) {
          $dataItemKey2 = DatumProperties::getItemKeyFor('workContributors', $newRoleDescription);
          $lastUpdateFields[] = 'workContributors_role_' . $roleKey;
        }
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
                                     . SSFQuery::quote(trim(str_replace("  ", " ", $newName))) . ", '" . SSFRunTimeValues::nowForDB() . "', " . $updatingUserId . ")";
          //SSFDB::debugNextQuery();
          $querySuccess = SSFDB::getDB()->saveData($insertString);
          if ($querySuccess) { $rowsChangedCount += 1; }
        } else { 
          // The values exist in both $newValueArray and $dbValueArray and they are different so update the row.
          // TODO To improve efficiency, build a single update statement to include all the rows to be updated at once.
          $updateString = "UPDATE workContributors SET name = " . SSFQuery::quote(trim(str_replace("  ", " ", $newName))) 
                        . ", roleDescription=" . SSFQuery::quote(trim(str_replace("  ", " ", $newRoleDescription)))
                        . ", optionalContributor=" . (($optionalContributor) ? 1 : 0) . ", lastModificationDate='" . SSFRunTimeValues::nowForDB() . "', lastModifiedBy=" . $updatingUserId
                        . " WHERE work=" . $workId . " and role=" . SSFQuery::quote($roleKey);
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

?>


<?php
    $contributorsArray = array();
//    $contributorsString = file_get_contents('http://sanssoucifest.org/bin/utilities/SSF-entryEmailsAltered.txt');
    $contributorsString = file_get_contents('http://sanssoucifest.org/bin/utilities/XXX.txt');
    $workStrings = explode(PHP_EOL . PHP_EOL, $contributorsString);
    foreach($workStrings as $workString) {
      $lines = explode(PHP_EOL, $workString);
      foreach($lines as $line) {
        list($key, $value) = explode(":", $line); // In the final run, this line generated a Undefined offset Notice once.
        $key = trim($key, " \t\n\r\0\x0B\"*");
        $value = trim($value, " \t\n\r\0\x0B\"");
        if ($key == 'works_workId_forInfoOnly') $workId = $value;
        else $contributorsArray[$key] = $value;
      }
//      SSFDebug::globalDebugger()->belch('' . $workId . ' ', $contributorsArray, 1);
      updateDBForWorkContributors($contributorsArray, $workId);
    }
/*
    $workId
    $contributorsArray['workContributors_Director'] = 
    $contributorsArray['workContributors_Producer'] = 
    $contributorsArray['workContributors_Choreographer'] = 
    $contributorsArray['workContributors_DanceCompany'] = 
    $contributorsArray['workContributors_PrincipalDancers'] = 
    $contributorsArray['workContributors_MusicComposition'] = 
    $contributorsArray['workContributors_MusicPerformance'] = 
    $contributorsArray['workContributors_Camera'] = 
    $contributorsArray['workContributors_Editor'] = 
    $contributorsArray['workContributors_role_Other_1'] = 
    $contributorsArray['workContributors_Other_1'] = 
    $contributorsArray['workContributors_role_Other_2'] = 
    $contributorsArray['workContributors_Other_2'] = 
*/
?>

</body>
</html>
