<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
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
<script type="text/javascript">
  function setCache(id, priorValue) {
    newValue = 1;
    if (priorValue == 1) { newValue = 0; }
    //alert('setCache(' + id + ') called with prior value = ' + priorValue + '.');
    if (id == 'showPromised') { document.getElementById('showPromisedCache').value = newValue; } 
    else if (id == 'showReceived') { document.getElementById('showReceivedCache').value = newValue; } 
    else { alert('ERROR: setCache(' + id + ')'); }
  }
</script>
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
	  	<td align="center" valign="top" max-width="830" class="bodyTextOriginalGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div style="background-color:#333333;text-align:left;float:none;">
<?php

  // TODO
  
  // Find people labeled as submitter but not.
  // select personId, lastName, nickName, relationship, notes from people 
  // where relationship like '%submitter%' and personId not in (select personId from people join `works` on submitter = personId) ORDER BY lastName

  // Find people who are a submitter but not labeled as such.
  // select personId, name, relationship, notes from people join `works` on submitter = personId 
  // where personId not in (select personId from people where relationship like '%submitter%') group by personId
  

  // Check invalid Foreign Keys to people.personId

  $includeReportsOfZeroIds = false;

  echo '<div class="programPageTitleText" style="float:none;padding-top:8px;text-align:left;">Checking for invalid Foreign Keys to people.personId ' 
    . '<span class="bodyTextOnDarkGray"> (' . (($includeReportsOfZeroIds) ? 'including when the FK is 0' : 'except when the FK is 0') . ')</span></div>' . "\r\n";
  echo '<div style="padding:8px;">' . "\r\n";
  
  $primmaryKeysQuery = 'SELECT TABLE_NAME, COLUMN_NAME FROM COLUMNS_SCHEMA_INFO WHERE COLUMN_KEY = "PRI"'; 
  $primmaryKeysResult = SSFDB::getDB()->getArrayFromQuery($primmaryKeysQuery);
  SSFDebug::globalDebugger()->belch('$primmaryKeysResult', $primmaryKeysResult, 1);
  
  // $peopleColumnsToCheck is the comprehensive list of Foreign Keys to people.personId (all 33 references excluding 'people.personId').
  
  // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA 
  // from information_schema.COLUMNS 
  // where TABLE_SCHEMA='sanssouci' and TABLE_NAME != 'COLUMNS_SCHEMA_INFO' and DATA_TYPE='int' and COLUMN_COMMENT like '%people%' 
  // order by TABLE_NAME, COLUMN_COMMENT
  
  // COLUMN_KEY values: PRI -> primary key; UNI -> indexed with a unique constraint; and MUL -> a regular index.
  
  $peopleColumnsToCheck = array(
    'administrators.adminId', 
    'callsForEntries.lastModifiedBy', 
    'communications.recipient', 'communications.sender', 'communications.createdBy', 'communications.lastModifiedBy', 'communications.contentLastModifiedBy', 
    'curation.curator', 'curation.lastModifiedBy',
    'curators.curator',
    'emailHeadersLog.lastModifiedBy',
    'events.contactPerson', 'events.lastModifiedBy',
    'images.lastModifiedBy',
    'media.lastModifiedBy',
    'moreEmails.id',
    'people.createdBy', 'people.lastModifiedBy', // 'people.personId', 
    'permissionRequest.lastModifiedBy', 'permissionRequest.responseFrom', 
    'runOfShow.lastModifiedBy',
    'seasons.lastModifiedBy',
    'shows.contactPerson', 'shows.lastModifiedBy',
    'venues.contactPerson1', 'venues.contactPerson2', 'venues.lastModifiedBy',
    'workContributors.personId', 'workContributors.lastModifiedBy',
    'workImages.lastModifiedBy',
    'works.submitter', 'works.principalArtist', ' works.createdBy', 'works.lastModifiedBy'
  );

  foreach ($peopleColumnsToCheck as $tableColumn) {
    $primaryKeyColumns = array();
    list($table, $colName) = explode(".", $tableColumn);
    SSFDebug::globalDebugger()->becho('$tableColumn', $tableColumn, -1);
    SSFDebug::globalDebugger()->becho('$table', $table, -1);
    SSFDebug::globalDebugger()->becho('$colName', $colName, -1);
    $selectClause = 'SELECT `' . $colName . '`';
    $fromClause = ' FROM ' . $table;
    $displaySelectClause = 'SELECT <span class="scoreDisplayText">' . $colName . '</span>';
    $displayFromClause =  ' FROM <span class="scoreDisplayText">' . $table . '</span>';
    foreach ($primmaryKeysResult as $primaryKey) {
      if ($primaryKey['TABLE_NAME'] == $table) { $primaryKeyColumns[] = $primaryKey['COLUMN_NAME']; }
    }
    SSFDebug::globalDebugger()->belch('$primaryKeyColumns', $primaryKeyColumns, -1);
    foreach ($primaryKeyColumns as $primaryKeyColumn) { 
      $selectClause .= ', `' . $primaryKeyColumn . '`';
      $displaySelectClause .= ', <span class="scoreDisplayText">' . $primaryKeyColumn . '</span>';
    }
    $query = $selectClause . $fromClause . ' WHERE ' . $table . '.' . $colName . ' NOT IN (SELECT personId FROM people)';
    $displayQuery = $displaySelectClause . $displayFromClause 
                  . ' WHERE <span class="scoreDisplayText">' . $table . '.' . $colName 
                  . '</span>  NOT IN (SELECT personId FROM people)';
    if (!$includeReportsOfZeroIds) {
      $query .= ' AND ' . $table . '.' . $colName . ' != 0';
      $displayQuery .= ' AND ' . $table . '.' . $colName . ' != 0';
    }
    echo '<div class="bodyTextOnDarkGray" style="color:#FF9">' . $table . '.' . $colName;
//    SSFQuery::debugNextQuery();
    $result = SSFDB::getDB()->getArrayFromQuery($query);
    if (count($result) > 0) {
      echo '</div>' . "\r\n";
      echo '<div class="bodyTextOnDarkGray">' . $displayQuery . '</div>' . "\r\n";
      foreach ($result as $row) {
        SSFDebug::globalDebugger()->belch('$row', $row, 1);
//        echo '<div class="bodyTextOnDarkGray">' . $selectClause . '</div>';
      }
    } else { 
      echo '<span class="datumDescription">&nbsp;OK</span></div>' . "\r\n";
    }
    SSFDebug::globalDebugger()->belch('result', $result, -1);
  }

  echo '</div>' . "\r\n";


?>
        </div>
        <!-- InstanceEndEditable --></td>
        
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