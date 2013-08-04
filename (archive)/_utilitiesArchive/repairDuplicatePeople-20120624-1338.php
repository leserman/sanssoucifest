<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Merge Duplicate People Entries</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
<style type="text/css">
  a.colTitle:link { color: blue; text-decoration: none; }
  a.colTitle:visited { color: blue; text-decoration: none; } 
  a.colTitle:hover { color: red; text-decoration: none; }

  .topRow, .bottomRow, .headerRow {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
    color: black;
    padding-right:10px;
    padding-left: 6px;
  }
  .topRow { padding-top: 12px; }
  .bottomRow { padding-bottom: 12px; }
  .headerRow { padding-bottom: 6px; padding-top: 6px; }
  .oldValueCell {
    width: 200px;
    color: #F9F9CC;
    text-align: right;
    vertical-align: middle;
    margin-right: 16px;
    padding-right: 16px;
    padding-left: 16px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
  }
  .rightArrowButtonCell {
    width: 60px;
    color: #F9F9CC;
    text-align: center;
    vertical-align: middle;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
  }
  .interactiveWidgetsCell {
    width: 590px;
    min-width: 570px;
    vertical-align: middle;
  }
  .leftArrowButtonCell {
    width: 60px;
    color: #F9F9CC;
    text-align: center;
    vertical-align: middle;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
  }
  .newValueCell {
    width: 200px;
    color: #F9F9CC;
    text-align: left;
    vertical-align: middle;
    margin-left: 16px;
    padding-left: 16px;
    padding-right: 16px;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
  }
</style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<script type="text/javascript">

  function setMergeDup(dupIdsString) {
    var mergeDup = document.getElementById("mergeDup");
    mergeDup.value=dupIdsString;
  }
  
  function setInputValue(inputName, inputValue) {
    var inputWidget = document.getElementById(inputName);
    inputWidget.value=inputValue;
  }
  
  // functions postValidationSubmit, validAdminPersonEntry, userMadeAChange support (and mostly short circuit)
  // the internal machinations of HTMLGen::displayEditDivHeader().
  
  function postValidationSubmit(hiddenInputSavingId) {
    //alert("postValidationSubmit Id = |" + hiddenInputSavingId + "|"); 
    if (document.getElementById(hiddenInputSavingId) != null) {
      document.getElementById(hiddenInputSavingId).value = displayMergeDupFormForIds;
      //alert('about to submit ' + hiddenInputSavingId);
      var form = document.getElementById('MergePersonsForm');  
      form.submit();
    }
    else { alert("postValidationSubmit FAILED for |" + hiddenInputSavingId + "|. Please write this down and tell David."); }
  }

  function validAdminPersonEntry() { return true; }
  
  function userMadeAChange() {} // do nothing

</script>
<?php 
  include_once '../../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  $aaa = 'background-color:#CCC;';
  $bbb = 'background-color:#FFC;';
  $bgndStyle = $aaa;
  
  date_default_timezone_set('America/Denver');
  
  function getEditString($isEditable) { 
    $noSymbol = '&#x20e0;'; // Combining Enclosing Circle Backslash
//    $editSymbol = '&#x270E;'; // Dingbats Lower Right Pencil
    $editSymbol = '&#x270D;'; // Dingbats Writing Hand
    $editOKString = '<span style="color:yellow;font-size:14px;">' . $editSymbol . '</span>&nbsp;&nbsp;';
    $noEditString = '<span style="color:red;">' . $noSymbol . '</span>&nbsp;&nbsp;';
    $editString = ($isEditable) ? $editOKString : $noEditString; 
    return $editString;
  }
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
    
    public function setReplacementAs($array) {
      foreach ($array as $key => $value) {
        $keyParts = explode('_', $key);
        if ($keyParts[0] == ' people') $replacementPersonRecord[$keyParts[1]] = $value;
      }
      SSFDebug::globalDebugger()->belch('setReplacementAs() $replacementPersonRecord', $replacementPersonRecord, 1);
    }
    
    public function idsString() { return sprintf('%d_%d', $this->olderPersonId, $this->newerPersonId); }
    
    public function updateData() {
      $updatingPersonId = $this->olderPersonRecord['personId'];
//      SSFQuery::useAdministratorAsCreatorModifier();
      
      //SSFQuery::updateDBFor($tableName, $currentValueArray, $newValueArray, $whereKeyName, $whereKeyValue)
      $updateCount = SSFQuery::updateDBFor('people', $this->olderPersonRecord, $this->replacementPersonRecord, 'personId', $updatingPersonId);

      // Use a 2nd (lower level) query to update creationDate, createdBy, lastModificationDate, lastModifiedBy
      if ($updateCount > 0) {
        $insertQueryString = 'UPDATE people SET creationDate = ' . $this->replacementPersonRecord['creationDate'] . ', '
                                             . 'createdBy = ' . $this->replacementPersonRecord['createdBy'] . ', '
                                             . 'lastModificationDate = ' . $this->replacementPersonRecord['lastModificationDate'] . ', '
                                             . 'lastModifiedBy = ' . $this->replacementPersonRecord['lastModifiedBy'] . ' '
                                             . 'WHERE personId = ' . $updatingPersonId;
        SSFDB::getDB()->saveData($insertQueryString);
      }
    }

    // To get the $personColumns listed:
    // select TABLE_NAME, COLUMN_NAME, DATA_TYPE, COLUMN_TYPE, COLUMN_KEY, COLUMN_COMMENT, COLUMN_DEFAULT, IS_NULLABLE, EXTRA 
    // from information_schema.COLUMNS where TABLE_SCHEMA='sanssouci' and TABLE_NAME = 'people' 
    
    // COLUMN_KEY values: PRI -> primary key; UNI -> indexed with a unique constraint; and MUL -> a regular index.
    
    private static $personColumns = array (  // How to default and handle each field in people when a duplicate is found:
                                             // -----------------------------------------------------------------------------------------------------
      'personId' => 'older',                 // Use the one created first. NON-EDITABLE
      'name' => 'newer',                     // interactive choice/entry after defaulting to the one created last
      'lastName' => 'newer',                 // interactive choice/entry after defaulting to the one created last
      'nickName' => 'newer',                 // interactive choice/entry after defaulting to the one created last
      'loginName' => 'newer',                // Use the one created last. NON-EDITABLE
      'password' => 'newer',                 // Use the one created last. NON-EDITABLE
      'phoneVoice' => 'newer',               // interactive choice/entry after defaulting to the one created last
      'phoneFax' => 'newer',                 // interactive choice/entry after defaulting to the one created last
      'phoneMobile' => 'newer',              // interactive choice/entry after defaulting to the one created last
      'email' => 'special',                  // Use the one that is the same as loginName. NON-EDITABLE
      'organization' => 'newer',             // interactive choice/entry after defaulting to the one created last
      'sortKey' => 'newer',                  // interactive choice/entry after defaulting to the one created last  UNUSED as of 6/20/12
      'streetAddr1' => 'newer',              // interactive choice/entry after defaulting to the one created last
      'streetAddr2' => 'newer',              // interactive choice/entry after defaulting to the one created last
      'city' => 'newer',                     // interactive choice/entry after defaulting to the one created last
      'stateProvRegion' => 'newer',          // interactive choice/entry after defaulting to the one created last
      'zipPostalCode' => 'newer',            // interactive choice/entry after defaulting to the one created last
      'country' => 'newer',                  // interactive choice/entry after defaulting to the one created last
      'webSites' => 'newer',                 // interactive choice/entry after defaulting to the one created last
      'howHeardAboutUs' => 'older',          // interactive choice/entry after defaulting to the one created first
      'recordType' => 'older',               // interactive choice/entry after defaulting to the one created first
      'relationship' => 'older',             // interactive choice/entry after defaulting to the one created first
      'role' => 'older',                     // interactive choice/entry after defaulting to the one created first
      'notifyOf' => 'older',                 // interactive choice/entry after defaulting to the one created first
      'notes' => 'special',                  // interactive choice/entry after defaulting to the one created first
      'lastModificationDate' => 'special',   // NOW. NON-EDITABLE
      'lastModifiedBy' => 'special',         // administrator making the changes NON-EDITABLE
      'creationDate' => 'special',           // Notes below. NON-EDITABLE
      'createdBy' => 'special');             // Notes belos. NON-EDITABLE

    private function initReplacementToDefaultValues() {
      $currentAdminId = SSFAdmin::userIndex(); // TODO: Verify that this is working without a admin selector on this form.
      $now = date('Y-m-d H:i:s');
      foreach (self::$personColumns as $personColumn => $defaultFrom) {
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
                $this->replacementPersonRecord['email'] = $this->newerPersonRecord['loginName'];
                break;
              case 'notes':
                // EDITABLE
                $prefixNote ='[This person record was merged with the now extinct person record for personId ' 
                            . $this->newerPersonRecord['personId'] . ' on ' . date('Y-m-d') . ' at ' . date('H:i:s') . ' by AdministratorId ' . $currentAdminId . '.] ';
                $this->replacementPersonRecord['notes'] = $prefixNote;
                if (isset($this->olderPersonRecord['notes'])) $this->replacementPersonRecord['notes'] .= $this->olderPersonRecord['notes'];
                break;
              case 'lastModificationDate':
                // NOW. NON-EDITABLE 
                $this->replacementPersonRecord['lastModificationDate'] = $now;
                break;
              case 'lastModifiedBy':
                // administrator making the changes NON-EDITABLE
                $this->replacementPersonRecord['lastModifiedBy'] = $currentAdminId; 
                break;
              case 'creationDate':
                SSFDebug::globalDebugger()->becho('$this->olderPersonRecord[creationDate]', $this->olderPersonRecord['creationDate'], -1);
                SSFDebug::globalDebugger()->becho('$this->newerPersonRecord[creationDate]', $this->newerPersonRecord['creationDate'], -1);
                // Default to the one created first if it exists; otherwisee to the one created later if it exists, otherwise NOW. NON-EDITABLE
                if (isset($this->olderPersonRecord['creationDate']) && ($this->olderPersonRecord['creationDate'] !== '')) 
                                     $this->replacementPersonRecord['creationDate'] = $this->olderPersonRecord['creationDate'];
                else if (isset($this->newerPersonRecord['creationDate']) && ($this->newerPersonRecord['creationDate'] !== '')) 
                                     $this->replacementPersonRecord['creationDate'] = $this->newerPersonRecord['creationDate'];
                else $this->replacementPersonRecord['creationDate'] = $now;
                break;
              case 'createdBy':
                SSFDebug::globalDebugger()->becho('$this->olderPersonRecord[createdBy]', $this->olderPersonRecord['createdBy'], -1);
                SSFDebug::globalDebugger()->becho('$this->newerPersonRecord[createdBy]', $this->newerPersonRecord['createdBy'], -1);
                // NON-EDITABLE
                $this->replacementPersonRecord['createdBy'] = (isset($this->olderPersonRecord['createdBy']) && ($this->olderPersonRecord['createdBy'] !== '')) 
                                                            ? $this->olderPersonRecord['createdBy'] 
                                                            : (((isset($this->newerPersonRecord['createdBy'])) && ($this->newerPersonRecord['createdBy'] !== '') 
                                                                               && ($this->newerPersonRecord['createdBy'] == $this->newerPersonRecord['personId'])) 
                                                              ? $this->olderPersonRecord['personId'] // The newer person id will disappear, being replaced by the older person id.
                                                              : $currentAdminId);
                break;
              case '':
                break;
              default:
                break;
              }
            break;
          }
        }
      }

    private function displayPersonCompareAndEditForm() {
    
      $disabled = false;
      $enabled = true;
      $rightArrowButton = '>>>';
      $leftArrowButton = '<<<';

      SSFDebug::globalDebugger()->becho('getEditString($disabled)', getEditString($disabled), -1);
      SSFDebug::globalDebugger()->becho('getEditString($enabled)', getEditString($enabled), -1);
      
      echo '<form name="MergePersonsForm" id="MergePersonsForm" action="repairDuplicatePeople.php" method="post">';
       
      echo '<input type="hidden" name="saveMergedDupIds" id="saveMergedDupIds" value="' . sprintf('%d_%d', $this->olderPersonId, $this->newerPersonId) . '">' . "\r\n";
//      echo '<script type="text/javascript">setInputValue("' . saveMergedDupIds . '", "' . sprintf('%d_%d', $this->olderPersonId, $this->newerPersonId) . '");</script>' . "\r\n";

      $title = "Editing Person: " . $this->olderPersonRecord['name'] . " <span class='idDisplayText'>" . $this->olderPersonRecord['personId'] . "</span>";
      echo '<div class="programPageTitleText" style="float:none;padding-top:8px;margin-bottom:-18px;text-align:left;margin-left:12px">Merging duplicate persons </div>' . "\r\n";
      echo '<div style="padding:8px;">' . "\r\n";

      // Display the interactive form: <OLD Value>   -->   <defaulted editable field>   <--   <NEW value>
      //                                 col 1      col 2             col 3            col 4     col 5
      
      echo '  <table cellspacing="0" cellpadding="0" border="1" style="table-layout:fixed;border:1px #666 solid;margin-bottom:30px;padding-bottom:8px;">' . "\r\n";

      echo '    <tr>' . "\r\n";
      echo '      <td class="oldValueCell" colspan="5" style="padding-top:-20px;padding-left:16px;">'; 
      HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'saveMerge', 'validAdminPersonEntry', $this->idsString(), 'cancelMerge'); 
      echo '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Person Id
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['personId'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Person Id', 'people_personId', $this->replacementPersonRecord['personId'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['personId'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Full Name
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['name'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Full Name', 'people_name', $this->replacementPersonRecord['name'], 128, !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . $this->newerPersonRecord['name'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Last Name
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['lastName'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Last Name', 'people_lastName', $this->replacementPersonRecord['lastName'], 64, !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . $this->newerPersonRecord['lastName'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Nickname
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['nickName'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Nickname', 'people_nickName', $this->replacementPersonRecord['nickName'], 64, !$isEditable);; 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['nickName'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Organization
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['organization'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Organization', 'people_organization', $this->replacementPersonRecord['organization'], 128, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['organization'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Email Address
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['email'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Email Address', 'people_email', $this->replacementPersonRecord['loginName'], 128, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['email'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Login Name
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['loginName'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Login Name', 'people_loginName', $this->replacementPersonRecord['loginName'], 128, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['loginName'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Password
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['password'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Password', 'people_password', $this->replacementPersonRecord['password'], 128, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['password'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Record Type
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['recordType'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addRadioButtonWidgetRow(getEditString($isEditable) . 'Record Type', 'people', 'recordType', $this->replacementPersonRecord['recordType'], 4, "w", !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['recordType'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
  
      // Notify of
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['notifyOf'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addCheckBoxWidgetRow(getEditString($isEditable) . 'Notify of', 'people', 'notifyOf', $this->replacementPersonRecord['notifyOf'], 4, !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['notifyOf'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Relationship         str_replace(find,replace,string,count)
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . str_replace(',', ', ', $this->olderPersonRecord['relationship']) . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addCheckBoxWidgetRow(getEditString($isEditable) . 'Relationship', 'people', 'relationship', $this->replacementPersonRecord['relationship'], 2, !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  str_replace(',', ', ',$this->newerPersonRecord['relationship']) . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Role
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . str_replace(',', ', ',$this->olderPersonRecord['role']) . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addCheckBoxWidgetRow(getEditString($isEditable) . 'Role', 'people', 'role', $this->replacementPersonRecord['role'], 2, !$isEditable);  
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  str_replace(',', ', ',$this->newerPersonRecord['role']) . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Admin Notes
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['notes'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">';  
      HTMLGen::addTextAreaRow('people_notes', getEditString($isEditable) . 'Admin Notes', $this->replacementPersonRecord['notes'], 512, 2, !$isEditable); 
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['notes'] . '</td>' . "\r\n";


      // Web Sites
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['webSites'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Web Sites', 'people_webSites', $this->replacementPersonRecord['webSites'], 512, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['webSites'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // How heard
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['howHeardAboutUs'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'How heard', 'people_howHeardAboutUs', $this->replacementPersonRecord['howHeardAboutUs'], 128, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['howHeardAboutUs'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Street Address 1
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['streetAddr1'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Street Address', 'people_streetAddr1', $this->replacementPersonRecord['streetAddr1'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['streetAddr1'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Street Address 2
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['streetAddr2'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $this->replacementPersonRecord['streetAddr2'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['streetAddr2'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // City
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['city'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'City', 'people_city', $this->replacementPersonRecord['city'], 32, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['city'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // State, Zip, Country
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . getEditString($isEditable) . '<span class="datumDescription">State/Prov/Region:</span> ' . $this->olderPersonRecord['stateProvRegion'] . ', ' 
                                             . '<span class="datumDescription">Postal Code:</span> ' . $this->olderPersonRecord['zipPostalCode'] . ', ' 
                                             . '<span class="datumDescription">Country:</span> ' . $this->olderPersonRecord['country'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addStateZipCountryRow($this->replacementPersonRecord, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . getEditString($isEditable) . '<span class="datumDescription">State/Prov/Region:</span> ' . $this->newerPersonRecord['stateProvRegion'] . ', ' 
                                             . '<span class="datumDescription">Postal Code:</span> ' . $this->newerPersonRecord['zipPostalCode'] . ', ' 
                                             . '<span class="datumDescription">Country:</span> ' . $this->newerPersonRecord['country'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Telephones
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . getEditString($isEditable) . '<span class="datumDescription">Voice:</span> ' . $this->olderPersonRecord['phoneVoice'] . ', ' 
                                             . '<span class="datumDescription">Mobile:</span> ' . $this->olderPersonRecord['phoneMobile'] . ', ' 
                                             . '<span class="datumDescription">Fax:</span> ' . $this->olderPersonRecord['phoneFax'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetTelephonesRow($this->replacementPersonRecord, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' . getEditString($isEditable) . '<span class="datumDescription">Voice:</span> ' . $this->newerPersonRecord['phoneVoice'] . ', ' 
                                             . '<span class="datumDescription">Mobile:</span> ' . $this->newerPersonRecord['phoneMobile'] . ', ' 
                                             . '<span class="datumDescription">Fax:</span> ' . $this->newerPersonRecord['phoneFax'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

// ------------

      // Last Modification Date
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['lastModificationDate'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Last Mod Date', 'people_lastModificationDate', $this->replacementPersonRecord['lastModificationDate'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['lastModificationDate'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Last Modified By
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['lastModifiedBy'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Lst Mod By (prsnId)', 'people_lastModifiedBy', $this->replacementPersonRecord['lastModifiedBy'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['lastModifiedBy'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Creation Date
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['creationDate'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Creation Date', 'people_creationDate', $this->replacementPersonRecord['creationDate'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['creationDate'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

      // Created By
      $isEditable = $disabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['createdBy'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::addTextWidgetRow(getEditString($isEditable) . 'Created By (prsnId)', 'people_createdBy', $this->replacementPersonRecord['createdBy'], 64, !$isEditable);
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['createdBy'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";

// ------------

      echo '  </table>' . "\r\n";
      echo '</div>' . "\r\n";
      echo '</form>' . "\r\n";
    }
   
/*
      // Template
      $isEditable = $enabled;
      echo '    <tr>' . "\r\n"; 
      echo '      <td class="oldValueCell">' . $this->olderPersonRecord['XXXXXXX'] . '</td>' . "\r\n";
      echo '      <td class="rightArrowButtonCell">' . $rightArrowButton . '</td>' . "\r\n";
      echo '      <td class="interactiveWidgetsCell">'; 
      HTMLGen::XXXXXXX
      echo '</td>' . "\r\n";
      echo '      <td class="leftArrowButtonCell">' . $leftArrowButton . '</td>' . "\r\n";
      echo '      <td class="newValueCell">' .  $this->newerPersonRecord['XXXXXXX'] . '</td>' . "\r\n";
      echo '    </tr>' . "\r\n";
*/
/* <!-- Begin Person Edit from Admin Data Entry and Entry Form Online ------------------------------------------------------------- -->
/    HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'savePerson', 'validAdminPersonEntry', 'savingPerson', 'cancelPersonChanges');
/    HTMLGen::addTextWidgetRowDisabled('Person Id', 'people_personId', $this->replacementPersonRecord['personId'], 64);
/    HTMLGen::addTextWidgetRowDisabled('Last Mod Date', 'people_lastModificationDate', $this->replacementPersonRecord['lastModificationDate'], 64);
/    HTMLGen::addTextWidgetRowDisabled('Last Mod By (personId)', 'people_lastModifiedBy', $this->replacementPersonRecord['lastModifiedBy'], 64);
/    HTMLGen::addTextWidgetRowDisabled('Creation Date', 'people_creationDate', $this->replacementPersonRecord['creationDate'], 64);
/    HTMLGen::addTextWidgetRowDisabled('Created By (personId)', 'people_createdBy', $this->replacementPersonRecord['createdBy'], 64);
/    HTMLGen::addTextWidgetRowDisabled('Full Name', 'people_name', $this->replacementPersonRecord['name'], 128);
/    HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $this->replacementPersonRecord['lastName'], 64, $disabled);
/    HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', $this->replacementPersonRecord['nickName'], 64, $disabled);
/    HTMLGen::addTextWidgetRow('Organization', 'people_organization', $this->replacementPersonRecord['organization'], 128, $disabled);
/    HTMLGen::addTextWidgetRowDisabled('Email Address', 'people_email', $this->replacementPersonRecord['email'], 128);
/    HTMLGen::addTextWidgetRowDisabled('Login Name', 'people_loginName', $this->replacementPersonRecord['loginName'], 128);
/    HTMLGen::addTextWidgetRowDisabled('Password', 'people_password', $this->replacementPersonRecord['password'], 128);
/    HTMLGen::addRadioButtonWidgetRow('Record Type', 'people', 'recordType', $this->replacementPersonRecord['recordType'], 4, "w", $disabled); 
/    HTMLGen::addCheckBoxWidgetRow('Notify of', 'people', 'notifyOf', $this->replacementPersonRecord['notifyOf'], 4, $disabled); 
/    HTMLGen::addCheckBoxWidgetRow('Relationship', 'people', 'relationship', $this->replacementPersonRecord['relationship'], 2, $disabled); 
/    HTMLGen::addCheckBoxWidgetRow('Role', 'people', 'role', $this->replacementPersonRecord['role'], 2, $disabled); 
/    HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', $this->replacementPersonRecord['notes'], 2048, 2, $disabled);
/    HTMLGen::addTextWidgetRow('Web Sites', 'people_webSites', $this->replacementPersonRecord['webSites'], 512, $disabled);
/    HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $this->replacementPersonRecord['howHeardAboutUs'], 128, $disabled);
/    HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $this->replacementPersonRecord['streetAddr1'], 64, $disabled);
/    HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $this->replacementPersonRecord['streetAddr2'], 64, $disabled);
/    HTMLGen::addTextWidgetRow('City', 'people_city', $this->replacementPersonRecord['city'], 32, $disabled);
/    HTMLGen::addStateZipCountryRow($this->replacementPersonRecord, $disabled);
/    HTMLGen::addTextWidgetTelephonesRow($this->replacementPersonRecord, $disabled);
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
      SSFDebug::globalDebugger()->belch('$dupPeople', $dupPeople, -1);   // BELCH $dupPeople
  
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
      
      $this->initReplacementToDefaultValues();
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

  // BEGIN Initialization and Action Branching ------------- ------------- ------------- ------------- ------------- ------------- ------------- 
  
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
  SSFDebug::globalDebugger()->belch('$_POST', $_POST, 1);  // BELCH $_POST
  $ids = array();
  $separator = '';
  foreach ($_POST as $postedKey => $postedValue) {
    SSFDebug::globalDebugger()->becho('DupCheckbox $postedKey ' . $postedKey, $postedValue, -1);
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
  
  // Display the form for initiating a merge of a duplicate pair.
  // Example: [displayMergeDupFormForIds] => 4_1323
  reset($_POST);
  foreach ($_POST as $postedKey => $postedValue) {
    SSFDebug::globalDebugger()->becho('reset POST $postedKey ' . $postedKey, $postedValue, 1);
    
    // Display the Merge Dups form
    if (($postedKey == 'displayMergeDupFormForIds') && ($postedValue != '')) {
      if (strpos($postedValue, '_') === false) {
        $ids[0] = '';
        $ids[1] = '';
      } else $ids = explode('_', $postedValue);
      SSFDebug::globalDebugger()->becho('displayMergeDupFormForIds $postedKey ' . $postedKey, $postedValue, 1);
      SSFDebug::globalDebugger()->belch('displayMergeDupFormForIds $ids ', $ids, -1);
      $personDup = new PersonDup($ids[0], $ids[1]);
      SSFDebug::globalDebugger()->belch('displayMergeDupFormForIds $personDup ', $personDup, 1);
      $personDup->displayAndEdit();
    }
    
    // Process Save of the prior mergeDup
    // public static function displayEditDivHeader($divIdString,       $title, $saveButtonNameId, $validationFunctionName, $hiddenInputSavingId, $cancelButtonNameId)
    // Button setup: HTMLGen::displayEditDivHeader('ADEPersonEditDiv', $title, 'saveMerge',       'validAdminPersonEntry', 'mergingPeople',       'cancelMerge'); 
    else if ($postedKey == 'saveMerge' && $postedValue == 'Save') {
      // Reinstate the PersonDup
      $idString = $_POST['saveMergedDupIds'];
      $ids = explode('_', $postedValue);
      $personDup = new PersonDup($ids[0], $ids[1]);
      $personDup->setReplacementAs($_POST);
      // Update the person record
      $personDup->updateData();
      // Update references to the person id being eliminated
      $personDup->updateReferencesToThePersonBeingEliminated($this->olderPersonId, $this->newerPersonId);
      // Delete the database record for $newerPersonId
      $deletePersonRecordQuery = 'DELETE FROM people WHERE personId = ' . $this->newerPersonId;
      SSFDebug::globalDebugger()->becho('$deletePersonRecordQuery', $deletePersonRecordQuery, 1);
//    SSFDB::saveData($deletePersonRecordQuery);
    }
    
    // Process Cancel of the prior mergeDup
    else if ($postedKey == 'cancelMerge' && $postedValue == 'Cancel') {
      // Do nothing on a cancel; just drop through.
    }

  } 

  // END Initialization and Action Branching ------------- ------------- ------------- ------------- ------------- ------------- ------------- 


  // Check for duplicate people
  
  // Undifferentiated (probably vs maybe) duplicate person. This catches cases the other queriess missed.
  $dupPersonCandidatesQuery = 'SELECT personId, name, lastName, nickName, email, loginName FROM people '
                            . 'WHERE lastName IN (SELECT lastName FROM (SELECT lastName, COUNT(*) AS cnt FROM `people` GROUP BY lastName HAVING cnt > 1) AS manyPeople) '
                            . 'ORDER BY lastName, nickName';
  $dupPersonCandidates = SSFDB::getDB()->getArrayFromQuery($dupPersonCandidatesQuery);
  SSFDebug::globalDebugger()->belch('$dupPersonCandidates', $dupPersonCandidates, -1);
  
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
      SSFDebug::globalDebugger()->belch('$dupCandidateGroup', $dupCandidateGroup, -1);
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

  echo '<div style="border:1px #666 solid;width:850px;margin:30px 20px 0px 10px;padding:0 16px 0px 16px;">'  . "\r\n";
  echo '<form name="DuplicatePersonCandidateGroupPairs" action="repairDuplicatePeople.php" method="post">';
  echo '<div class="programPageTitleText" style="float:none;padding-top:8px;padding-bottom:8px;text-align:left;margin-top:-22px;">Duplicate Person Candidate Pairs: </div>' . "\r\n";
  echo '<div class="bodyTextOnDarkGray" style="font-size:16px;color:#FFC;margin-left:10px;">First, select and '
         . '<input type="submit" value="Clear items marked as &quot;Not Dup.&quot;" ' 
         . 'style="font-size:14px;margin:2px 10px 10px 2px;font-weight:bold;padding:4px 12px;background:#FFC;'
         . 'border:0;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;">' 
         . 'Then <span style="font-style:normal;color:#FCFC7E;">Merge</span> the remaining pairs one at a time.</div>' . "\r\n";
//  echo '<div style="padding:0 8px 20px 8px;">' . "\r\n";
  echo '<div style="padding:0;margin:0 10px;text-align:center;">' . "\r\n";
  echo '<input type="hidden" name="displayMergeDupFormForIds" id="displayMergeDupFormForIds" value="">' . "\r\n";
  echo '<input type="hidden" id="hiddenInputSavingId" name="hiddenInputSavingId" value="">' . "\r\n";
  echo '<table cellspacing="0" style="border:0px solid red;background-color:#CCC;">' . "\r\n";
    echo '<tr>' . "\r\n";
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . 'text-align:center;">&nbsp;<b>SELECT</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . 'text-align:right;">&nbsp;<b>personId</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . '">&nbsp;<b>lastName</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . '">&nbsp;<b>nickName</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . '">&nbsp;<b>name</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . '">&nbsp;<b>email</b>&nbsp;</td>';
    echo '<td class="bodyTextOnDarkGray, headerRow" style="' . $bgndStyle . '">&nbsp;<b>loginName</b>&nbsp;</td>';
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
          $fixDupButton = "<input type='button' id='" . $fixDupButtonNameId . "' name='" . $fixDupButtonNameId . "' value='Merge'" 
                        . " onClick='javascript:setInputValue(\"displayMergeDupFormForIds\", \"" . $possibleDupIdsAsString . "\");submit();'>";
          if ($bgndStyle == $aaa) $bgndStyle = $bbb; else $bgndStyle = $aaa;
          echo '<tr>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $fixDupButton . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $candidate1['personId'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . '">&nbsp;' . $candidate1['lastName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . '">&nbsp;' . $candidate1['nickName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . '">&nbsp;' . $candidate1['name'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . '">&nbsp;' . $candidate1['email'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, topRow" style="' . $bgndStyle . '">&nbsp;' . $candidate1['loginName'] . '&nbsp;</td>' . "\r\n";
          echo '</tr>' . "\r\n";
          echo '<tr>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $notDupCheckbox . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . 'text-align:center;">&nbsp;' . $dupCandidate['personId'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['lastName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['nickName'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['name'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['email'] . '&nbsp;</td>' . "\r\n";
          echo '  <td class="bodyTextOnDarkGray, bottomRow" style="' . $bgndStyle . '">&nbsp;' . $dupCandidate['loginName'] . '&nbsp;</td>' . "\r\n";
          echo '</tr>' . "\r\n";
        }
      }
      $pairIndex++;
    }
  }
  echo '</table>' . "\r\n";
  echo '</div>' . "\r\n";
  echo '</form>' . "\r\n";
  echo '</div>' . "\r\n";
  echo '<div style="margin:0;padding:0;line-height=28px;">&nbsp;</div>'  . "\r\n";

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