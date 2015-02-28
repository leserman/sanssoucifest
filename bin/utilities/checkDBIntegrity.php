<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - DB Integrity Check</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
<style type="text/css">
  a.colTitle:link { color: blue; text-decoration: none; }
  a.colTitle:visited { color: blue; text-decoration: none; } 
  a.colTitle:hover { color: red; text-decoration: none; }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td class="bodyTextOriginalGrayLight" style="mmax-width:750px;text-align:left;vertical-align:top;">
        <div style="background-color:#333333;text-align:left;float:none;padding-bottom:20px;">
<?php

  // This utility detects foreign keys (FKs) in the database that point to records that do not exist. 
  // FKs with value 0 will not be reported.
  //
  // BEWARE - The analysis is based on a strict convention for comments for foreign keys in the database.
  // All columns that contain foreign keys to be included in this analysis must be commented to include a string as follows
  //
  //          FK into <tableName> table
  //
  // where <tableName> is the name of a table that is returned by the $tablesToConsiderQuery below.
  // <tableName> must be spelled correctly in the comment.
  

  // TODO
  //
  // Find people labeled as submitter but not.
  // select personId, lastName, nickName, relationship, notes from people 
  // where relationship like '%submitter%' and personId not in (select personId from people join `works` on submitter = personId) ORDER BY lastName
  //
  // Find people who are a submitter but not labeled as such.
  // select personId, name, relationship, notes from people join `works` on submitter = personId 
  // where personId not in (select personId from people where relationship like '%submitter%') group by personId
  //
  // From _SSFQueries.txt, 2/19/15
  //
  // TODO other (besides duplicate) integrity checks for people [other integrity checks for people]
  // - select * from workContributors where work not in (select workId from works)  
  //   FIXED (2012): delete from workContributors where work not in (select workId from works)  
  // - select personId, name, workId, title, relationship, notes from people left join `works` on submitter = personId 
  //   where relationship like '%submitter%' order by personId, workId
   // Check for Submitters whose recordType should be individual
  // - select distinct personId, name, email, organization, recordType, relationship, notes from people  
  //   where relationship like '%submitter%' and (recordType is null or recordType='') and 
  //   (organization is null or organization = '') order by organization, personId
   // Repair for Submitters whose recordType should be individual
  // - update people set recordType = 'individual' 
  //   where relationship like '%submitter%' and (recordType is null or recordType='') and 
  //   (organization is null or organization = '') order by organization, personId
   // Check for people with relationship like submitter who have not submitted works
  // - select personId, name, recordType, organization, relationship, notes from people 
  //   where relationship like '%submitter%' and personId not in (select submitter from works)
   // Check for people who have submitted works but with relationship not like submitter
  // - select personId, name, workId, title, relationship, notes from people join `works` on submitter = personId
  //   where relationship not like '%submitter%' order by personId, workId
  //
  // TODO phone number integrity - remove non-numbers - as of 7/3/13 the only non-numbers are -, ---, none, n/a, etc
  

  $includeReportsOfZeroIds = false;
  
  $tablesToExclude = "'dates', 'COLUMNS_SCHEMA_INFO', 'Template'";

//  SSFQuery::debugOn();
  
  $primaryKeysQuery = "SELECT TABLE_NAME, COLUMN_NAME FROM COLUMNS_SCHEMA_INFO WHERE COLUMN_KEY = 'PRI' AND TABLE_NAME NOT IN (" . $tablesToExclude . ") ORDER BY TABLE_NAME"; 
  $primaryKeysResult = SSFDB::getDB()->getArrayFromQuery($primaryKeysQuery);
  $primaryKeys = array();
  foreach($primaryKeysResult as $primaryKeyResult) {
    $primaryKeys[$primaryKeyResult['TABLE_NAME']] = $primaryKeyResult['COLUMN_NAME'];
  }
  // This array is incorrect because it includes only the last column found for each table. That is, it fails to handle compound keys.
  SSFDebug::globalDebugger()->belch('$primaryKeys', $primaryKeys, -1);

/*  
  $tablesToConsider1 = array();
  $tablesToConsiderQuery1 = "SELECT DISTINCT TABLE_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='sanssouci' AND TABLE_NAME NOT IN (" . $tablesToExclude . ") ORDER BY TABLE_NAME";
  $tablesToConsiderResult1 = SSFDB::getDB()->getArrayFromQuery($tablesToConsiderQuery1);
  foreach($tablesToConsiderResult1 as $tableToConsider) { $tablesToConsider1[] = $tableToConsider['TABLE_NAME']; }
  SSFDebug::globalDebugger()->belch('$tablesToConsider1', $tablesToConsider1, -1);  
*/

  $tablesToConsider2 = array();
  $tablesToConsiderQuery2 = "SELECT DISTINCT "
                          . "(SUBSTRING(COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT)+8) , (LOCATE (' ', COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT))+8)) "
                          . "- (LOCATE ('FK into ', COLUMN_COMMENT)+8))) as FK_intoTable "
                          . "FROM information_schema.COLUMNS "
                          . "WHERE TABLE_SCHEMA='sanssouci' AND TABLE_NAME NOT IN (" . $tablesToExclude . ") AND COLUMN_COMMENT LIKE '%FK%' "
                          . "ORDER BY FK_intoTable";
  $tablesToConsiderResult2 = SSFDB::getDB()->getArrayFromQuery($tablesToConsiderQuery2);
  foreach($tablesToConsiderResult2 as $tableToConsider) { $tablesToConsider2[] = $tableToConsider['FK_intoTable']; }
  SSFDebug::globalDebugger()->belch('$tablesToConsider2', $tablesToConsider2, -1);
  
  // $peopleColumnsToCheck is the comprehensive list of Foreign Keys to people.personId (all 33 references excluding 'people.personId').
  
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA 
  // from information_schema.COLUMNS 
  // where TABLE_SCHEMA='sanssouci' and TABLE_NAME != 'COLUMNS_SCHEMA_INFO' and DATA_TYPE='int' and COLUMN_COMMENT like '%people%' 
  // order by TABLE_NAME, COLUMN_COMMENT
  
  // COLUMN_KEY values: PRI -> primary key; UNI -> indexed with a unique constraint; and MUL -> a regular index.
  
  // Select all the foreign keys (those columns that have 'FK' in the comment) to process. See the BEWARE note above.
  // Each result row contains FK_intoTable, TABLE_NAME, and COLUMN_NAME for use in this code - 
  // and, additionally (commented out), DATA_TYPE (all shouold be int) COLUMN_TYPE (all shoud be int(16) unsigned), COLUMN_KEY (PRI, MUL, or NULL), 
  // the structured COLUMN_COMMENT, COLUMN_DEFULLT, IS_NULLABLE, EXTRA, and FK_intoStart and FK_intoStart (to parse out FK_intoTable within the query).
  $fksToCheckQuery = "SELECT "
                   . "(SUBSTRING(COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT)+8) , (LOCATE (' ', COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT))+8)) - (LOCATE ('FK into ', COLUMN_COMMENT)+8))) as FK_intoTable, "
                   . "TABLE_NAME, COLUMN_NAME "
//                   . "DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA, "
//                   . "(LOCATE ('FK into ', COLUMN_COMMENT)+8) as FK_intoStart, "
//                   . "(LOCATE (' ', COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT))+8)) as FK_intoEnd "
                   . "FROM information_schema.COLUMNS "
                   . "WHERE TABLE_SCHEMA='sanssouci' AND TABLE_NAME NOT IN (" . $tablesToExclude . ") AND DATA_TYPE='int' AND COLUMN_TYPE LIKE '%int(16)%' AND COLUMN_COMMENT LIKE '%FK%' "
                   . "ORDER BY FK_intoTable, TABLE_NAME, COLUMN_NAME";
                   
//  SSFQuery::debugNextQuery();
  $fksToCheckArray = SSFDB::getDB()->getArrayFromQuery($fksToCheckQuery);
  SSFDebug::globalDebugger()->belch('$fksToCheckArray', $fksToCheckArray, -1);
  
  SSFQuery::debugOff();

  $currentTable = '';
  $tableColumnsToCheck = array();

  foreach($fksToCheckArray as $fksToCheck) {
    if ($fksToCheck['FK_intoTable'] != $currentTable) {
      $currentTable = $fksToCheck['FK_intoTable'];
    }
    $tablesPointedToByFKs[$currentTable][] = $fksToCheck['TABLE_NAME'] . '.' . $fksToCheck['COLUMN_NAME'];
  }

  SSFDebug::globalDebugger()->belch('$tablesPointedToByFKs', $tablesPointedToByFKs, -1);
  
  echo '<div class="programPageTitleText" style="float:none;padding-top:14px;padding-left:0;text-align:left;">Checking for Invalid Foreign Keys'
     . '<span class="bodyTextOnDarkGray"> (' . (($includeReportsOfZeroIds) ? 'including when the FK is 0' : 'except when the FK is 0') . ')</span></div>';
  echo '<div style="margin:-8px 8px 0px 8px;">'  . PHP_EOL;
      
  foreach ($tablesPointedToByFKs as $tablePointedToByFKs => $tableColumnPairs) {
    $currentTableName = $tablePointedToByFKs;
    if (isset($primaryKeys[$currentTableName])) {
      echo '<div class="sectionTitle" style="padding-left:0;font-weight:bold;font-style:normal;color:#e49548;">FKs into ' . $currentTableName . '.' . $primaryKeys[$currentTableName] . '<!-- 1 --></div>' . PHP_EOL;
      foreach ($tableColumnPairs as $tableColumnPair) {
        $primaryKeyColumns = array();
        list($table, $colName) = explode(".", $tableColumnPair);
        $selectClause = 'SELECT `' . $colName . '`';
        $fromClause = ' FROM ' . $table;
        $displaySelectClause = 'SELECT <span class="scoreDisplayText">' . $colName . '</span>';
        $displayFromClause =  ' FROM <span class="scoreDisplayText">' . $table . '</span>';
        foreach ($primaryKeysResult as $primaryKey) {
          if ($primaryKey['TABLE_NAME'] == $table) { $primaryKeyColumns[] = $primaryKey['COLUMN_NAME']; }
        }
        SSFDebug::globalDebugger()->belch('$primaryKeyColumns', $primaryKeyColumns, -1);
        foreach ($primaryKeyColumns as $primaryKeyColumn) { 
          if ($primaryKeyColumn != $colName) {
            $selectClause .= ', `' . $primaryKeyColumn . '`';
            $displaySelectClause .= ', <span class="scoreDisplayText">' . $primaryKeyColumn . '</span>';
          }
        }
        $query = $selectClause . $fromClause . ' WHERE `' . $table . '`.`' . $colName . '` NOT IN (SELECT `' . $primaryKeys[$currentTableName] . '` FROM ' . $currentTableName . ')';
        $displayQuery = $displaySelectClause . $displayFromClause 
                      . '<br>WHERE <span class="scoreDisplayText">' . $table . '.' . $colName 
                      . '</span>  NOT IN (SELECT `<span class="scoreDisplayText">' . $primaryKeys[$currentTableName] . '</span>` FROM <span class="scoreDisplayText">' . $currentTableName . '</span>)';
        if (!$includeReportsOfZeroIds) {
          $query .= ' AND ' . $table . '.' . $colName . ' != 0';
          $displayQuery .= '<br>AND <span class="scoreDisplayText">' . $table . '.' . $colName . '</span> != 0';
        }
//        SSFQuery::debugNextQuery();
        $result = SSFDB::getDB()->getArrayFromQuery($query);
        echo '<div class="bodyTextOnDarkGray" style="color:#FF9;margin-left:0px;">' . $table . '.' . $colName;
        if (count($result) > 0) {
          echo '<!-- 2 --></div>' . PHP_EOL;
          echo '<div class="bodyTextOnDarkGray">' . $displayQuery . '<!-- 3 --></div>' . PHP_EOL;
          foreach ($result as $row) {
            SSFDebug::globalDebugger()->belch('$row', $row, 1);
          }
        } else { 
          echo '<span class="datumDescription">&nbsp;OK</span><!-- 4 --></div>' . PHP_EOL;
        }
        SSFDebug::globalDebugger()->belch('result', $result, -1);
      }
    }
//    echo '<!-- 5 --></div>' . PHP_EOL;
  }
  echo '<!-- 6 --><div>'  . PHP_EOL;
  
/*
SELECT TABLE_NAME, COLUMN_NAME, COLUMN_KEY,
IF(LOCATE ('FK into ', COLUMN_COMMENT), (SUBSTRING(COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT)+8) , (LOCATE (' ', COLUMN_COMMENT, (LOCATE ('FK into ', COLUMN_COMMENT))+8)) - (LOCATE ('FK into ', COLUMN_COMMENT)+8))), "") as FK_intoTable
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA='sanssouci' AND TABLE_NAME NOT IN ('COLUMNS_SCHEMA_INFO', 'dates') AND (COLUMN_KEY = 'PRI')
ORDER BY TABLE_NAME, COLUMN_NAME
*/

// How do I deetermine which primary key in a table with multiple promary keys? At the moment, 5/14/14, there are none.

?>
                        </div>
                      </div>
                    </div>
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
            <td align="center" valign="bottom"><br>
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
<!-- InstanceEnd --></html>