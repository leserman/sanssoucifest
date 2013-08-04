<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Repair Duplicate People Entries</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
<style type="text/css">
  a.colTitle:link { color: blue; text-decoration: none; }
  a.colTitle:visited { color: blue; text-decoration: none; } 
  a.colTitle:hover { color: red; text-decoration: none; }
  .oldValueCell {
    width: 300px;
    color: #F9F9CC;
    text-align: right;
    vertical-align: middle;
    margin-right: 16px;
    padding-right: 16px;
  }
  .rightArrowButtonCell {
    width: 100px;
    color: #F9F9CC;
    text-align: center;
    vertical-align: middle;
  }
  .interactiveWidgetsCell {
    width: 610px;
    vertical-align: middle;
  }
  .leftArrowButtonCell {
    width: 100px;
    color: #F9F9CC;
    text-align: center;
    vertical-align: middle;
  }
  .newValueCell {
    width: 300px;
    color: #F9F9CC;
    text-align: left;
    vertical-align: middle;
    margin-left: 16px;
    padding-left: 16px;
  }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<script type="text/javascript">
  function setRepairDup(dupIdsString) {
    var hiddenInput = document.getElementById("repairDup");
    hiddenInput.value=dupIdsString;
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
<!--	  	<td align="center" valign="top" class="bodyTextOriginalGrayLight" style="max-width:830px;"> -->
	  	<td align="center" valign="top" class="bodyTextOriginalGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div style="background-color:#333333;text-align:left;float:none;">
<?php
  // BEGIN class PersonDup - BEGIN class PersonDup - BEGIN class PersonDup - BEGIN class PersonDup - BEGIN class PersonDup - BEGIN class PersonDup 

  class PersonDup {
    
    private $olderPersonId = 0;
    private $newerPersonId = 0;
    private $olderPersonRecord = array();
    private $newerPersonRecord = array();
    private $replacementPersonRecord = array();

    private function displayDataAsText($data) {
    }

    private function displayPersonCompareAndEditForm() {
  
      // To get the $personColumns listed:
      // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA 
      // from information_schema.COLUMNS where TABLE_SCHEMA='sanssouci' and TABLE_NAME = 'people' 
      
      // COLUMN_KEY values: PRI -> primary key; UNI -> indexed with a unique constraint; and MUL -> a regular index.
      
      $personColumns = array (  // How to default and handle each field in people when a duplicate is found:
                                // -----------------------------------------------------------------------------------------------------
        'personId' => 'older',             // Use the one created first. NON-EDITABLE
        'name' => 'newer',                 // interactive choice/entry after defaulting to the one created last
        'lastName' => 'newer',             // interactive choice/entry after defaulting to the one created last
        'nickName' => 'newer',             // interactive choice/entry after defaulting to the one created last
        'loginName' => 'newer',            // Use the one created last. NON-EDITABLE
        'password' => 'newer',             // Use the one created last. NON-EDITABLE
        'phoneVoice' => 'newer',           // interactive choice/entry after defaulting to the one created last
        'phoneFax' => 'newer',             // interactive choice/entry after defaulting to the one created last
        'phoneMobile' => 'newer',          // interactive choice/entry after defaulting to the one created last
        'email' => 'special',              // Use the one that is the same as loginName. NON-EDITABLE
        'organization' => 'newer',         // interactive choice/entry after defaulting to the one created last
        'sortKey' => 'newer',              // interactive choice/entry after defaulting to the one created last  UNUSED as of 6/20/12
        'streetAddr1' => 'newer',          // interactive choice/entry after defaulting to the one created last
        'streetAddr2' => 'newer',          // interactive choice/entry after defaulting to the one created last
        'city' => 'newer',                 // interactive choice/entry after defaulting to the one created last
        'stateProvRegion' => 'newer',      // interactive choice/entry after defaulting to the one created last
        'zipPostalCode' => 'newer',        // interactive choice/entry after defaulting to the one created last
        'country' => 'newer',              // interactive choice/entry after defaulting to the one created last
        'webSites' => 'newer',             // interactive choice/entry after defaulting to the one created last
        'howHeardAboutUs' => 'older',      // interactive choice/entry after defaulting to the one created first
        'recordType' => 'older',           // interactive choice/entry after defaulting to the one created first
        'relationship' => 'older',         // interactive choice/entry after defaulting to the one created first
        'role' => 'older',                 // interactive choice/entry after defaulting to the one created first
        'notifyOf' => 'older',             // interactive choice/entry after defaulting to the one created first
        'notes' => 'older',                // interactive choice/entry after defaulting to the one created first
        'lastModificationDate' => 'special', // NOW. NON-EDITABLE
        'lastModifiedBy' => 'special',     // administrator making the changes NON-EDITABLE
        'creationDate' => 'older',         // default to the one created first if it exists; otherwise NOW. NON-EDITABLE
        'createdBy' => 'special');         // if this is either of the personId's of interest, use the one created first, otherwise, no change. NON-EDITABLE
        
        foreach ($personColumns as $personColumn => $defaultFrom) {
          switch ($defaultFrom) {
            case 'newer':
              $this->replacementPersonRecord[$personColumn] = $this->newerPersonRecord[$personColumn];
              break;
            case 'older':
              $this->replacementPersonRecord[$personColumn] = $this->olderPersonRecord[$personColumn];
              break;
            case 'special':
              switch ($personColumn) {
                case 'email':
                  $this->replacementPersonRecord[$personColumn] = $this->newerPersonRecord['loginName'];
                  break;
                case 'lastModificationDate':
                  $this->replacementPersonRecord[$personColumn] = $this->olderPersonRecord[$personColumn];
                  break;
                case 'lastModifiedBy':
                  // administrator making the changes NON-EDITABLE
                  // TODO This is the administratorId
                  $this->replacementPersonRecord[$personColumn] = 1; 
                  break;
                case 'lastModificationDate':
                  // NOW. NON-EDITABLE 
                  // TODO: format the new date.
                  $this->replacementPersonRecord['lastModificationDate'] = new Date();
                  break;
                case 'creationDate':
                  // Default to the one created first if it exists; otherwise NOW. NON-EDITABLE
                  // TODO: format the new date.
                  $this->replacementPersonRecord['creationDate'] = (isset($this->olderPersonRecord['creationDate'])) ? $this->olderPersonRecord['creationDate'] : new Date();
                  break;
                case 'createdBy':
                  // TODO:  if this is either of the personId's of interest, use the one created first, otherwise, no change. NON-EDITABLE
                  $this->replacementPersonRecord['createdBy'] = (isset($this->olderPersonRecord['createdBy'])) ? $this->olderPersonRecord['createdBy'] : 0;
                  break;
                case '':
                  break;
                default:
                  break;
                }
              break;
            }
        }
  
    $disabled = true;
    $enabled = false;
    $title = "Editing Person: " . $this->olderPersonRecord['name'] . " <span class='idDisplayText'>" . $this->olderPersonRecord['personId'] . "</span>";
    echo '<div class="programPageTitleText" style="float:none;padding-top:8px;margin-bottom:-16px;text-align:left;">Repairing duplicate person </div>' . "\r\n";
    echo '<div style="padding:8px;">' . "\r\n";

      // Display the interactive form: <OLD Value>   -->   <defaulted editable field>   <--   <NEW value>
      //                                 col 1      col 2             col 3            col 4     col 5
      
      $rightArrowButton = '>>>';
      $leftArrowButton = '<<<';
     
      echo '  <table cellspacing="0" cellpadding="0" border="0" style="table-layout:fixed;border:1px #666 solid;margin-bottom:30px;padding-bottom:8px;">' . "\r\n";

      echo '    <tr>' . "\r\n";
      echo '      <td class="oldValueCell" colspan="5" style="padding-top:-20px;padding-left:16px;">'; 
      HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'savePerson', 'validAdminPersonEntry', 'savingPerson', 'cancelPersonChanges'); 
      echo '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
/*
      // Full Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' .  HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->olderPersonRecord['name'], 128) . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">' . HTMLGen::addTextWidgetRow('Full Name', 'people_name', $this->replacementPersonRecord['name'], 128) . '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->newerPersonRecord['name'], 128) . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Last Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' .  HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->olderPersonRecord['lastName'], 64, $disabled) . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">' .  HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->replacementPersonRecord['lastName'], 64, $enabled) . '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->newerPersonRecord['lastName'], 64, $disabled) . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Full Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">'; HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->olderPersonRecord['name'], 128); echo '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; HTMLGen::addTextWidgetRow('Full Name', 'people_name', $this->replacementPersonRecord['name'], 128); echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">'; HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->newerPersonRecord['name'], 128); echo '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Last Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">'; HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->olderPersonRecord['lastName'], 64, $disabled); echo '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->replacementPersonRecord['lastName'], 64, $enabled); echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">'; HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->newerPersonRecord['lastName'], 64, $disabled); echo '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
*/
      // Full Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['name'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; HTMLGen::addTextWidgetRow('Full Name', 'people_name', $this->replacementPersonRecord['name'], 128); echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . $this->newerPersonRecord['name'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Last Name
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['lastName'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->replacementPersonRecord['lastName'], 64, $enabled); echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . $this->newerPersonRecord['lastName'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

     // Admin Notes
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['notes'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">';  HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', $this->replacementPersonRecord['notes'], 512, 2, $disabled); echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['notes'] . '</td>' . "\r\n";

    

/*    // Template
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['XXXXXXX'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; echo  HTMLGen::XXXXXXX; '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['XXXXXXX'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
*/

/*    // OLD Template XXXXXXXXXXX
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' .  HTMLGen:xxxxxx: . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">' .  HTMLGen::xxxxxx . '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  HTMLGen::xxxxxx . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
*/
      echo '  </table>' . "\r\n";

      echo '</div>' . "\r\n";

      
    }
   
/* <!-- Begin Person Edit ------------------------------------------------------------- -->
    HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'savePerson', 'validAdminPersonEntry', 'savingPerson', 'cancelPersonChanges');
    HTMLGen::addTextWidgetRowDisabled('Person Id', 'people_personId', $this->olderPersonRecord['personId'], 64);
    HTMLGen::addTextWidgetRowDisabled('Last Mod Date', 'people_lastModificationDate', $this->olderPersonRecord['lastModificationDate'], 64);
    HTMLGen::addTextWidgetRowDisabled('Last Mod By (personId)', 'people_lastModifiedBy', $this->olderPersonRecord['lastModifiedBy'], 64);
    HTMLGen::addTextWidgetRowDisabled('Creation Date', 'people_creationDate', $this->olderPersonRecord['creationDate'], 64);
    HTMLGen::addTextWidgetRowDisabled('Created By (personId)', 'people_createdBy', $this->olderPersonRecord['createdBy'], 64);
    HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->olderPersonRecord['name'], 128);
    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->olderPersonRecord['lastName'], 64, $disabled);
    HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', $this->olderPersonRecord['nickName'], 64, $disabled);
    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $this->olderPersonRecord['organization'], 128, $disabled);
    HTMLGen::addTextWidgetRowDisabled('Email Address', 'people_email', $this->olderPersonRecord['email'], 128);
    HTMLGen::addTextWidgetRowDisabled('Login Name', 'people_loginName', $this->olderPersonRecord['loginName'], 128);
    HTMLGen::addTextWidgetRowDisabled('Password', 'people_password', $this->olderPersonRecord['password'], 128);
    HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', $this->olderPersonRecord['recordType'], 4, "w", $disabled); 
    HTMLGen::addCheckBoxWidgetRow('Notify of', 'people', 'notifyOf', $this->olderPersonRecord['notifyOf'], 4, $disabled); 
    HTMLGen::addCheckBoxWidgetRow('Relationship', 'people', 'relationship', $this->olderPersonRecord['relationship'], 2, $disabled); 
    HTMLGen::addCheckBoxWidgetRow('Role', 'people', 'role', $this->olderPersonRecord['role'], 2, $disabled); 
    HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', $this->olderPersonRecord['notes'], 2048, 2, $disabled);
    HTMLGen::addTextWidgetRow('Web Sites', 'people_webSites', $this->olderPersonRecord['webSites'], 512, $disabled);
    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $this->olderPersonRecord['howHeardAboutUs'], 128, $disabled);
    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $this->olderPersonRecord['streetAddr1'], 64, $disabled);
    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $this->olderPersonRecord['streetAddr2'], 64, $disabled);
    HTMLGen::addTextWidgetRow('City', 'people_city', $this->olderPersonRecord['city'], 32, $disabled);
    HTMLGen::addStateZipCountryRow($this->olderPersonRecord, $disabled);
    HTMLGen::addTextWidgetTelephonesRow($this->olderPersonRecord, $disabled);
//    echo "          </div><!-- end ADEPersonEditDiv -->\r\n";
   <!-- End Person Edit ------------------------------------------------------------- -->
*/


    public function updateReferencesToThePersonBeingEliminated($replacementPersonId, $obsoletePersonId) {
      /* To get the $peopleColumnsToCheck list below:
         select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA 
         from information_schema.COLUMNS 
         where TABLE_SCHEMA='sanssouci' and TABLE_NAME != 'COLUMNS_SCHEMA_INFO' and DATA_TYPE='int' and COLUMN_COMMENT like '%people%' 
         order by TABLE_NAME, COLUMN_COMMENT
      */
    
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
        'notDupPeoplePairs.personId1', 'notDupPeoplePairs.personId2', // TODO: BEWARE: This could fail if it might create a duplicate record in notDupPeoplePairs.
    //    'people.createdBy', 'people.lastModifiedBy', // 'people.personId', 
        'permissionRequest.lastModifiedBy', 'permissionRequest.responseFrom', 
        'runOfShow.lastModifiedBy',
        'seasons.lastModifiedBy',
        'shows.contactPerson', 'shows.lastModifiedBy',
        'venues.contactPerson1', 'venues.contactPerson2', 'venues.lastModifiedBy',
        'workContributors.personId', 'workContributors.lastModifiedBy',
        'workImages.lastModifiedBy',
        'works.submitter', 'works.principalArtist', ' works.createdBy', 'works.lastModifiedBy'
      );
    
      // Update references to the personId being eliminated.
      foreach ($peopleColumnsToCheck as $tableColumn) {
        list($table, $colName) = explode(".", $tableColumn);
        $fixItQuery = 'UPDATE ' . $table . ' SET ' . $colName . ' = ' . $replacementPersonId . ' WHERE ' . $tableColumn . ' = ' . $obsoletePersonId;
        SSFDebug::globalDebugger()->becho('$fixItQuery', $fixItQuery, 1);
      }
    }

    public function __construct($person1Id, $person2Id) {
      SSFDebug::globalDebugger()->becho('__construct $person1Id', $person1Id, -1);
      SSFDebug::globalDebugger()->becho('__construct $person2Id', $person2Id, -1);

      // select the 2 people records
      $dupPeople = array();
      if (($person1Id != '') && ($person2Id != '')) {
        $query = 'SELECT * FROM people WHERE personId = ' . $person1Id . ' or personId = ' . $person2Id;
        $dupPeople = SSFDB::getDB()->getArrayFromQuery($query);
      } 
      SSFDebug::globalDebugger()->belch('$dupPeople', $dupPeople, 1);
  
      if ($person1Id > $person2Id) {
        $this->olderPersonId = $person2Id;
        $this->newerPersonId = $person1Id;
      } else {
        $this->olderPersonId = $person1Id;
        $this->newerPersonId = $person2Id;
      }
      if (($person1Id != '') && ($person2Id != '')) {
        $this->olderPersonRecord = SSFQuery::selectPersonFor($this->olderPersonId);
        $this->newerPersonRecord = SSFQuery::selectPersonFor($this->newerPersonId);
      }
    }
  
    // display the form for editing
    public function displayAndEdit() { $this->displayPersonCompareAndEditForm(); }
    
    // write the data to the database
    public function updateDate() {
    }
    
  }  
  // END class PersonDup - END class PersonDup - END class PersonDup - END class PersonDup - END class PersonDup - END class PersonDup 


  /*
  // DHL attempted to use 2 separate queries, one for probable duplicate people and one for maybe duplicate people. But, this approach failed because some cases
  // were caught by neither query.
  
  // 1. Maybe duplicate person compares lastName only.
  //    103 rows as of 6/17/12
    SELECT personId, name, lastName, nickName, email, loginName FROM people WHERE 
    lastName IN (SELECT lastName FROM (SELECT lastName, COUNT(*) AS cnt FROM `people` GROUP BY lastName HAVING cnt > 1) AS manyPeople) AND
    lastName NOT IN (SELECT lastName FROM ((SELECT lastName, COUNT(*) AS cnt2 FROM `people` GROUP BY lastName, nickName HAVING cnt2 > 1) AS manyNames))
    ORDER BY lastName, nickName
  
    $maybeDupPersonQuery =  'SELECT personId, name, lastName, nickName, email, loginName FROM people WHERE '
                          // lastName is in the set of people with non-unique lastNames
                          . 'lastName IN (SELECT lastName FROM (SELECT lastName, COUNT(*) AS cnt FROM `people` GROUP BY lastName HAVING cnt > 1) AS manyPeople) AND '
                          // lastName is not in the set of people with non-unique lastName/nickName pairs
                          . 'lastName NOT IN (SELECT lastName FROM ((SELECT lastName, COUNT(*) AS cnt2 FROM `people` GROUP BY lastName, nickName HAVING cnt2 > 1) AS manyNames)) '
                          . 'ORDER BY lastName, nickName';
  
    $maybeDupPersonResult = SSFDB::getDB()->getArrayFromQuery($maybeDupPersonQuery);
    SSFDebug::globalDebugger()->belch('$maybeDupPersonResult', $maybeDupPersonResult, -1);
    
  // 2. Probably duplicate person compares lastName and nickName.
  //    25 rows as of 6/17/12 (including 11 pair of duplicates and 3 with null nickName and null lastName)
    SELECT * FROM people WHERE concat(lastName,nickName) IN
      (SELECT manyNames.fullName1 FROM (
        (SELECT lastName, nickName, concat(lastName,nickName) as fullName1, COUNT(*) AS cnt 
          FROM `people` GROUP BY fullName1 HAVING cnt > 1) as manyNames)
      )
    ORDER BY lastName, nickName
  
    $probablyDupPersonQuery
    $probablyDupPersonResult 
  
  // 3. Undifferentiated (probably vs maybe) duplicate person. This catches cases the others missed.
  //    130 rows as of 6/17/12
    SELECT personId, name, lastName, nickName, email, loginName FROM people WHERE lastName IN (SELECT lastName FROM (SELECT lastName, COUNT(*) AS cnt 
    FROM `people` GROUP BY lastName HAVING cnt > 1) AS manyPeople) ORDER BY lastName, nickName
  
  // 130 - (103 + 25) = 2 and those are Gil (w no lastName) and Steph Kobes (which is not a match for Stephanie Kobes but is a match for Kobes) 
  */

  // BEGIN Initialization ------------- ------------- ------------- ------------- ------------- ------------- ------------- ------------- ------------- 
  
  $notDupPairsQuery = 'SELECT personId1, personId2 FROM notDupPeoplePairs';
  $notDupPairs = SSFDB::getDB()->getArrayFromQuery($notDupPairsQuery);
  SSFDebug::globalDebugger()->belch('$notDupPairs', $notDupPairs, -1);
  $insertNonDupPairsQuery = 'INSERT into notDupPeoplePairs (personId1, personId2) VALUES ';
  $notDupPairArray = array();
  foreach ($notDupPairs as $notDupPair) {
    $notDupPairArray[sprintf('%d_%d', $notDupPair['personId1'], $notDupPair['personId2'])] = true;
    $notDupPairArray[sprintf('%d_%d', $notDupPair['personId2'], $notDupPair['personId1'])] = true;
  }
  SSFDebug::globalDebugger()->belch('$notDupPairArray', $notDupPairArray, -1);
  
  // Process form submission for clearing duplicate pairs
  // Example: [DupCheckbox_1059_1313] => 1059.1313
  SSFDebug::globalDebugger()->belch('$_POST', $_POST, 1);
  $ids = array();
  $separator = '';
  foreach ($_POST as $postedKey => $postedValue) {
    SSFDebug::globalDebugger()->becho('$postedKey ' . $postedKey, $postedValue, -1);
    list($postedKeyLeader) = explode('_', $postedKey);
    if (($postedKeyLeader == 'DupCheckbox') && (!isset($notDupPairArray[$postedValue]))) {
      $ids = explode('_', $postedValue);
      $insertNonDupPairsQuery .= $separator . '(' . $ids[0] . ', ' . $ids[1] . ')';
      $notDupPairArray[sprintf('%d_%d', $ids[0], $ids[1])] = true;
      $notDupPairArray[sprintf('%d_%d', $ids[1], $ids[0])] = true;
      $separator = ', ';
    }
  }
  SSFDebug::globalDebugger()->becho('$insertNonDupPairsQuery', $insertNonDupPairsQuery, -1);
  if ($separator != '') {
    SSFDB::getDB()->saveData($insertNonDupPairsQuery);
  }
  
  // Process form submission for initiating a repair of a duplicate pair
  // Example: [repairDup] => 4_1323
  reset($_POST);
  foreach ($_POST as $postedKey => $postedValue) {
    SSFDebug::globalDebugger()->becho('$postedKey ' . $postedKey, $postedValue, -1);
    
    // Repair Dup
    if (($postedKey == 'repairDup') && ($postedValue != '')) {
      if (strpos($postedValue, '_') === false) {
        $ids[0] = '';
        $ids[1] = '';
      } else $ids = explode('_', $postedValue);
      SSFDebug::globalDebugger()->becho('repairDup $postedKey ' . $postedKey, $postedValue, -1);
      SSFDebug::globalDebugger()->belch('repairDup $ids ', $ids, -1);
      $personDup = new PersonDup($ids[0], $ids[1]);
      $personDup->displayAndEdit();
    } // if (($postedKey == 'repairDup') && ($postedValue != ''))
    
    else if ($postedKey == 'saveRepair') {
      $personDup->updateData();
    // on Save, write the database and remove the form

    // Update the DB with the values set interactively by the administrator.
    $currentValueArray = SSFQuery::selectPersonFor($this->olderPersonId);
//  $changeCount = SSFQuery::updateDBFor('people', $currentValueArray, $editorState, 'personId', $olderPersonId);
  
    $personDup->updateReferencesToThePersonBeingEliminated($this->olderPersonId, $this->newerPersonId);

    // Delete the database record for $newerPersonId
    $deletePersonRecordQuery = 'DELETE FROM people WHERE personId = ' . $this->newerPersonId;
    SSFDebug::globalDebugger()->becho('$deletePersonRecordQuery', $deletePersonRecordQuery, 1);
  //  SSFDB::saveData($deletePersonRecordQuery);
    } // if ($postedKey == 'saveRepair')
    
  } 
        //       ^^^^^^^^ $personDup->displayAndEdit() ^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^^^ ^^^^^^^^^^^^^^^^^^^^ 

  // END Initialization ------------- ------------- ------------- ------------- ------------- ------------- ------------- ------------- ------------- 


  // Check for duplicate people
  
  // Undifferentiated (probably vs maybe) duplicate person. This catches cases the other queriess missed.
  $dupPersonCandidatesQuery = 'SELECT personId, name, lastName, nickName, email, loginName FROM people '
                            . 'WHERE lastName IN (SELECT lastName FROM (SELECT lastName, COUNT(*) AS cnt FROM `people` GROUP BY lastName HAVING cnt > 1) AS manyPeople) '
                            . 'ORDER BY lastName, nickName';
  $dupPersonCandidates = SSFDB::getDB()->getArrayFromQuery($dupPersonCandidatesQuery);
  SSFDebug::globalDebugger()->belch('$dupPersonCandidates', $dupPersonCandidates, -1);
  
  $aaa = 'color:black;background-color:#CCC;padding-right:10px;padding-left:6px;';
  $bbb = 'color:black;background-color:#FFC;padding-right:10px;padding-left:6px;';
  $bgndStyle = $aaa;

  // Duplicate Person Candidates listing
  $showDuplicatePersonCandidatesListing = false;
  if ($showDuplicatePersonCandidatesListing) {
    echo '<div class="programPageTitleText" style="float:none;padding-top:8px;padding-bottom:8px;text-align:left;">Duplicate Person Candidates: </div>' . "\r\n";
    echo '<div style="padding:0 8px 20px 8px;">' . "\r\n";
    echo '<table cellspacing="0" style="border:0px solid red;background-color:#CCC;">' . "\r\n";
      echo '<tr>' . "\r\n";
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;"">&nbsp;<b>personId</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>lastName</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>nickName</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>name</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>email</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>loginName</b>&nbsp;</td>';
      echo '</tr>' . "\r\n";
    foreach ($dupPersonCandidates as $dupPersonCandidate) {
      SSFDebug::globalDebugger()->belch('$dupPersonCandidate', $dupPersonCandidate, -1);
      if ($bgndStyle == $aaa) $bgndStyle = $bbb; else $bgndStyle = $aaa;
      echo '<tr>' . "\r\n";
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;' . $dupPersonCandidate['personId'] . '&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupPersonCandidate['lastName'] . '&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupPersonCandidate['nickName'] . '&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupPersonCandidate['name'] . '&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupPersonCandidate['email'] . '&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupPersonCandidate['loginName'] . '&nbsp;</td>';
      echo '</tr>' . "\r\n";
    }
    echo '</table>' . "\r\n";
    echo '</div>' . "\r\n";
  }
  
  // Duplicate Person Candidate Groups listing
  $showDuplicatePersonCandidateGroupsListing = false;
  if ($showDuplicatePersonCandidateGroupsListing) {
    $dupCandidateGroups = array();
    foreach ($dupPersonCandidates as $dupPersonCandidate) {
      $dupCandidateGroups[$dupPersonCandidate['lastName']][] = $dupPersonCandidate;
    }
    echo '<div class="programPageTitleText" style="float:none;padding-top:8px;padding-bottom:8px;text-align:left;">Duplicate Person Candidate Groups: </div>' . "\r\n";
    echo '<div style="padding:0 8px 20px 8px;">' . "\r\n";
    $bgndStyle = $aaa;
    echo '<table cellspacing="0" style="border:0px solid red;background-color:#CCC;">' . "\r\n";
      echo '<tr>' . "\r\n";
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;<b>SELECT</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;<b>personId</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>lastName</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>nickName</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>name</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>email</b>&nbsp;</td>';
      echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>loginName</b>&nbsp;</td>';
      echo '</tr>' . "\r\n";
    foreach ($dupCandidateGroups as $dupCandidateGroup) {
      if ($bgndStyle == $aaa) $bgndStyle = $bbb; else $bgndStyle = $aaa;
      SSFDebug::globalDebugger()->belch('$dupCandidateGroup', $dupCandidateGroup, 1);
      foreach ($dupCandidateGroup as $dupCandidate) {
        echo '<tr>' . "\r\n";
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;' . '' . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;' . $dupCandidate['personId'] . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['lastName'] . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['nickName'] . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['name'] . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['email'] . '&nbsp;</td>';
        echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['loginName'] . '&nbsp;</td>';
        echo '</tr>' . "\r\n";
      }
    }
    echo '</table>' . "\r\n";
    echo '</div>' . "\r\n";
  }

  $bgndStyle = $aaa;
  
  // Duplicate Person Candidate Group Pairs listing
  $dupCandidateGroups = array();
  foreach ($dupPersonCandidates as $dupPersonCandidate) {
    $dupCandidateGroups[$dupPersonCandidate['lastName']][] = $dupPersonCandidate;
  }
  echo '<form name="DuplicatePersonCandidateGroupPairs" action="repairDuplicatePeople.php" method="post">';
  echo '<div class="programPageTitleText" style="float:none;padding-top:8px;padding-bottom:8px;text-align:left;">Duplicate Person Candidate Pairs: </div>' . "\r\n";
  echo '<div class="bodyTextOnDarkGray" style="font-size:16px;color:#FFC;margin-left:10px;">First, select and '
         . '<input type="submit" value="Clear items marked as &quot;Not Dup.&quot;" ' 
         . 'style="font-size:14px;margin:2px 10px 10px 2px;font-weight:bold;padding:4px 12px;background:#FFC;'
         . 'border:0;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;">' 
         . 'Then <span style="font-style:normal;color:#FCFC7E;">Repair</span> the remaining items one at a time.</div>' . "\r\n";
  echo '<div style="padding:0 8px 20px 8px;">' . "\r\n";
  echo '<input type="hidden" name="repairDup" id="repairDup" value="">' . "\r\n";
  echo '<table cellspacing="0" style="border:0px solid red;background-color:#CCC;">' . "\r\n";
    echo '<tr>' . "\r\n";
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:center;">&nbsp;<b>SELECT</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:right;">&nbsp;<b>personId</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>lastName</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>nickName</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>name</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>email</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;<b>loginName</b>&nbsp;</td>';
    echo '</tr>' . "\r\n";
  foreach ($dupCandidateGroups as $dupCandidateGroup) {
    SSFDebug::globalDebugger()->belch('$dupCandidateGroup', $dupCandidateGroup, -1);
    $groupCardinality = sizeOf($dupCandidateGroup);
    $pairIndex = 0;
    foreach ($dupCandidateGroup as $dupCandidate) {
      $groupLastName = $dupCandidate['lastName'];
      for ($dupIndex = $pairIndex+1; $dupIndex < $groupCardinality; $dupIndex++) {
        SSFDebug::globalDebugger()->becho('$groupLastName=' . $groupLastName . ' $pairIndex=' . $pairIndex . ' $dupIndex', $dupIndex, -1);
        $candidate1 = $dupCandidateGroup[$pairIndex];
        $dupCandidate = $dupCandidateGroup[$dupIndex];
        $possibleDupIdsAsString = sprintf('%d_%d', $candidate1['personId'], $dupCandidate['personId']);
        if (!isset($notDupPairArray[$possibleDupIdsAsString])) {
          $notDupCheckboxNameId = 'DupCheckbox_' . $possibleDupIdsAsString;
          $fixDupButtonNameId = 'FixDup_' . $possibleDupIdsAsString;
          $notDupByDefault = $candidate1['nickName'] != $dupCandidate['nickName'];
          $notDupCheckbox = "<input type='checkbox' name='" . $notDupCheckboxNameId . "' id='" . $notDupCheckboxNameId . "'"
                                                            . " value='" . $possibleDupIdsAsString . "'" . (($notDupByDefault) ? " checked='checked'" : "") . ">"
//                                                            . "<span style='font-size:12px;'>&nbsp;Not&nbsp;Dup</span>";
                                                            . "<label for='" . $notDupCheckboxNameId . "'>"
                                                            . "<span style='font-size:11px;background:white;border:1px solid #999;border-radius:4px;padding:2px 4px;'>"
                                                            . "Not Dup</span></label>";
          $fixDupButton = "<input type='button' id='" . $fixDupButtonNameId . "' name='" . $fixDupButtonNameId . "' value='Repair'" 
                        . " onClick='javascript:setRepairDup(\"" . $possibleDupIdsAsString . "\");submit();'>";
          if ($bgndStyle == $aaa) $bgndStyle = $bbb; else $bgndStyle = $aaa;
          echo '<tr>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $fixDupButton . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $candidate1['personId'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $candidate1['lastName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $candidate1['nickName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $candidate1['name'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $candidate1['email'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $candidate1['loginName'] . '&nbsp;</td>' . "\r\n";
          echo '</tr>' . "\r\n";
          echo '<tr>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $notDupCheckbox . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $dupCandidate['personId'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['lastName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['nickName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['name'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['email'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['loginName'] . '&nbsp;</td>' . "\r\n";
          echo '</tr>' . "\r\n";
        }
      }
      $pairIndex++;
    }
  }
  echo '</table>' . "\r\n";
  echo '</form>' . "\r\n";
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