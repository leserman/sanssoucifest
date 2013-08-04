<?php session_start(); 
  if(!isset($_SESSION['count'])) $_SESSION['count'] = 1;
  else $_SESSION['count'] += 1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<!-- InstanceBeginEditable name="doctitle" -->
<title>SSF - Administrative Data Entry</title>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="800"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <!-- was 745 -->
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.html"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><!-- #BeginLibraryItem "/Library/navBar.lbi" --><?php
  include_once "../utilities/autoloadClasses.php";
  SSFWebPageAssets::displayNavBar();
?>
<!-- #EndLibraryItem --></td>
    <td align="center" valign="top">
      <table width="665" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr><!-- InstanceBeginEditable name="Content" -->
<?php
  
  include_once "../../bin/utilities/autoloadClasses.php";
  
  // Set $callForEntriesId.
  if (isset($_POST['callForEntriesId']) && ($_POST['callForEntriesId'] != '')) SSFDefaults::setCurrentCallForEntriesId($_POST['callForEntriesId']);
  else if (isset($_POST['priorEntrySelection']) && ($_POST['priorEntrySelection'] != '')) SSFDefaults::setCurrentCallForEntriesId($_POST['priorEntrySelection']);

  $ADEState = array();
  
  //echo "_SESSION['count'] = " . $_SESSION['count'];
  if ($_SESSION['count'] == 1) $ADEState['adminSelector'] = 22; // TODO Get this from the runTime table and SSFDefaults.
  
  foreach ($_POST as $postKey => $postValue)
    $ADEState[$postKey] = (isset($postValue) && ($postValue != '')) ? $postValue : "";

  // Save an updated person
  if (isset($ADEState['savePerson']) && ($ADEState['savePerson'] != '')) {
    $personId = (isset($ADEState['editingPerson']) && ($ADEState['editingPerson'] != '')) ? $ADEState['editingPerson'] : 0;
    if ($personId != 0) {
      $currentValueArray = SSFQuery::selectPersonFor($personId);
      SSFQuery::updateDBFor('people', $currentValueArray, $ADEState, 'personId', $personId) ;
      //$updateArray = getUpdateArrayFor('people', SSFQuery::selectPersonFor($personId), $ADEState);
      //echo '<br>\r\n updateArray '; print_r($updateArray); echo '<br>\r\n';
      //SSFQuery::DBUpdate($updateArray, 'people', 'personId', $personId);
    }
  }

  // Save an updated work
  if (isset($ADEState['saveWork']) && ($ADEState['saveWork'] != '')) {
    $workId = (isset($ADEState['editingWork']) && ($ADEState['editingWork'] != '')) ? $ADEState['editingWork'] : 0;
    if ($workId != 0) {
      $currentWorkValueArray = SSFQuery::selectWorkFor($workId);
      SSFQuery::updateDBFor('works', $currentWorkValueArray, $ADEState, 'workId', $workId) ;
      $currentContribValueArray = SSFQuery::selectContributorsFor($workId);
      //SSFDB::debugOn(); 
      SSFQuery::updateDBFor('workContributors', $currentContribValueArray, $ADEState, 'workId', $workId) ;
      //SSFDB::debugOff(); 
    }
  }

  if (! (isset($ADEState['adminSelector']) && ($ADEState['adminSelector'] != ''))) $ADEState['adminSelector'] = $ADEState['priorAdminSelector'];
  if (! (isset($ADEState['orientationSelector']) && ($ADEState['orientationSelector'] != ''))) $ADEState['orientationSelector'] = $ADEState['priorOrientationSelector'];
  if (! (isset($ADEState['orientationSelector']) && ($ADEState['orientationSelector'] != ''))) $ADEState['orientationSelector'] = 'works'; // default value
  //if (! (isset($ADEState['callForEntriesId']) && ($ADEState['callForEntriesId'] != ''))) $ADEState['callForEntriesId'] = $ADEState['priorEntrySelection'];
  if (! (isset($ADEState['personSelector']) && ($ADEState['personSelector'] != ''))) $ADEState['personSelector'] = $ADEState['priorPersonSelection'];
  if (! (isset($ADEState['workSelector']) && ($ADEState['workSelector'] != ''))) $ADEState['workSelector'] = $ADEState['priorWorkSelection'];
  
  //savePerson  saveWork
  //editingPerson  editingWork

?>

          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
          <div>
            <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;
                                                                    float:left;margin:0 4px 6px 4px;background-color:black;'>
<?php //print_r($ADEState); echo "<br>\r\n\r\n"; //print_r($_POST); 
?> 
            </div>
            <div style="clear:both;"></div>
            <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Administrative Data Entry</div>

            <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
              <a href="http://test.sanssoucifest.org/admin">Admin Home</a> </div>
            <div style="clear:both"></div>
          </div>


<!-- Javascript Functions -->
<script type="text/javascript">

  function preProcessSubmit() {
    //alert('preProcessSubmit()');
  }

  function showHide(block) {
    var state, newState;
    //alert(document.getElementById(block).style.display);
    state=document.getElementById(block).style.display;
    if (state=='none') newState='inline'; 
    else newState = 'none'; 
    document.getElementById(block).style.display = newState;
  }

  function show(block) { document.getElementById(block).style.display = 'inline'; }

  function hide(block) { document.getElementById(block).style.display = 'none'; }

  function disable(control) { document.getElementById(control).disabled=true; }

  function enable(control) { document.getElementById(control).disabled=false; } // alert(control + " - " + control.disabled);

  function userMadeAChange(entity) { 
    document.getElementById('changeCount').value++; 
    //if (entity == 0)  document.getElementById('personChangeCount').value++; 
    //if (entity == 1)  document.getElementById('entryChangeCount').value++; 
  }

</script>


<!-- BEGIN FORM ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- BEGIN ---- -->

    <form name='adeSelectorsForm' id='adeSelectorsForm' action='adminDataEntry.php' onSubmit="preProcessSubmit()" method='post'>
    
            
      <div id='ADEContainer' style='float:left;margin-top:12px;padding-left:4px;padding-right:4px;'>

<?php //echo "<script type='text/javascript'>alert(" . $_SESSION['count'] . ");</script>"; 
?>

<!-- Begin Filters -------------------------------------------------------- -->
        <div id = "ADESelectionDiv">
          <!-- By Person or By Works Selector -->
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'>Orientation:</div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php HTMLGen::displayOrientationSelector('adeSelectorsForm', $ADEState['orientationSelector']); 
                ?>
              </div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <!-- Call for Entries Selector - Display only if $ADEState['orientationSelector'] == 'works' -->
<?php if ($ADEState['orientationSelector'] == 'works') {
echo "          <div class='formRowContainer'>";
echo "            <div class='rowTitleTextNarrow'>Call for:</div>";
echo "            <div class='entryFormFieldContainer'>";
echo "              <div style='float:left;'>";
                      if ($ADEState['orientationSelector'] == 'works')
                         HTMLGen::displayCallForEntriesSelector('adeSelectorsForm',
                             'document.getElementById("personSelector").value=0;'
                           . 'document.getElementById("workSelector").value=0;'); 
echo "              </div>";
echo "            </div>";
echo "          </div>";
echo "          <div style='clear:both;'></div>";
}
?>
          <!-- Person Selector -->
          <?php $title = (($ADEState['orientationSelector'] == 'works') ? 'Submitter:' : 'Person:'); ?>
          <div class='formRowContainer'>
            <div class='rowTitleTextNarrow'><?php echo $title ?></div>
            <div class="entryFormFieldContainer">
              <div style="float:left;">
                <?php //SSFDB::debugNextQuery(); 
                      $personToBe = HTMLGen::displayPersonSelector('adeSelectorsForm', $ADEState);
                      $ADEState['personSelector'] = $personToBe;
                ?>
              </div>
              <div style="float:right;padding-left:20px;">
                <input type="submit" id="newPerson" name="newPerson" disabled value="Create New Person">
              </div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <!-- Work Selector -->
          <div class='formRowContainer'>
            <div class="entryFormFieldContainer">
              <div style="float:right;padding-left:20px;">
                <input type="submit" id="newWork" name="newWork" disabled value="Create New Work">
              </div>
            </div>
          </div>
        </div> <!-- id = "ADESelectionDiv" -->
      </div>
<!-- Fin Filters ------------------------------------------------------------- -->

<!-- Computation ------------------------------------------------------------- -->
<?php 
          $dataArray = $contributorsArray = null;
          $personDefined = $workIsSpecified = false;
          $personDefined = (isset($personToBe) && ($personToBe != '')); // arg should really be document.getElementById('personSelector') -  // param was $ADEState['personSelector'] until 1/5/08 
          $personIsZero = ($personDefined && ($personToBe == 0));  // param was $ADEState['personSelector'] until 1/5/08 
          $personIsSpecified = ($personDefined && !$personIsZero);
          $workIsSpecified = (isset($workIdToBe) && ($workIdToBe != '') // param was $ADEState['workSelector'] until 1/5/08 
                                               && ($workIdToBe != 0));  // param was $ADEState['workSelector'] until 1/5/08
          if ($workIsSpecified && $personDefined && ($ADEState['orientationSelector'] == 'works')) {
            $dataArray = SSFQuery::selectSubmitterAndWorkFor($workIdToBe);  // param was $ADEState['workSelector'] until 1/5/08 
            $contributorsArray = SSFQuery::selectContributorsFor($workIdToBe);  // param was $ADEState['workSelector'] until 1/5/08 
          } else if ($workIsSpecified && !$personIsSpecified && ($ADEState['orientationSelector'] == 'works')) {
            //SSFDB::debugNextQuery();
            $dataArray = SSFQuery::selectSubmitterAndWorkFor($workIdToBe);  // param was $ADEState['workSelector'] until 1/5/08 
            if (SSFQuery::success()) {
              //echo "dataArray[submitter];" . $dataArray['submitter'] . "<br><br>\r\n";
              echo "<script type='text/javascript'>document.getElementById('personSelector').value = "
                   . $dataArray['submitter'] . ";document.adeSelectorsForm.submit();</script>";
              $contributorsArray = SSFQuery::selectContributorsFor($workIdToBe);  // param was $ADEState['workSelector'] until 1/5/08 
            }
          } else if ($personIsSpecified) {
            $dataArray = SSFQuery::selectPersonFor($personToBe);  // param was $ADEState['personSelector'] until 1/5/08 
          }
          //$_SESSION['dataArray'] = $dataArray;
          //print_r($dataArray); echo "<br><br>\r\n";
?>

<!-- Begin Data Display ------------------------------------------------------------- -->
        <div id = "ADEDataDiv" style="text-align:left;">
<!-- display Person Information -->
          <div class="entryFormSectionHeading" style="padding-top:24px;">
            <div style="float:left;padding-top:4px;">Submitter: 
                <?php if ($personIsSpecified) echo $dataArray['name'] . " (" . $dataArray['personId'] . ")"; ?>
            </div>
            <div style="float:right;padding-right:10px;padding-bottom:0;">
<?php if ($personIsSpecified) {      
echo '                <input type="submit" id="editPerson" name="editPerson" value="Edit">';
echo '                <input type="button" value="Show / Hide" onclick="showHide(\'ADEPersonDiv\')">';
}                
?>                       
            </div>
            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id = "ADEPersonDiv">
            <?php if ($personIsSpecified) { HTMLGen::displayPersonDetailForAdmin($dataArray); } ?>
          </div> <!-- id = "ADEPersonDiv" -->

<!-- display Work Information -->
          <div class="entryFormSectionHeading">
            <div style="float:left;padding-top:4px;">Work: 
              <?php if ($personIsSpecified) {
                echo $dataArray['title'] . " (";
                echo ((isset($dataArray['designatedId']) && ($dataArray['designatedId'] != '') && ($dataArray['designatedId'] != '')) ? $dataArray['designatedId'] : '-----');
                echo ", " . $dataArray['workId'] . ")"; 
              }
                ?>
            </div>
            <div style="float:right;padding-right:10px;padding-bottom:0;">
              <?php if ($workIsSpecified) echo '<input type="submit" id="editWork" name="editWork" value="Edit">'; ?>
            </div>
            <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
          </div>
          <div id="ADEEntriesDiv">
            <?php if ($workIsSpecified) HTMLGen::displayWorkDetailForAdmin($dataArray, $contributorsArray); ?>
          </div> <!-- id = "ADEEntriesDiv" -->
        </div> <!-- id = "ADEDataDiv" -->
<!-- End Data Display ------------------------------------------------------------- -->

<!-- Begin Person Edit ------------------------------------------------------------- -->
          <div id="ADEPersonEditDiv">
            <div class="entryFormSectionHeading">
              <div style="float:left;padding-top:4px;">Editing Person: <?php echo $dataArray['name'] . " (" . $dataArray['personId'] . ")"; ?></div>
              <div style="float:right;padding-right:10px;padding-bottom:0;">
                <input type="submit" id="savePerson" name="savePerson" value="Save">
                <input type="submit" id="cancelPersonChanges" name="cancelPersonChanges" value="Cancel">
              </div>
              <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
              <div>
<?php
  $disable = false;
  HTMLGen::addTextWidgetRowDisabled('Name', 'people_name', $dataArray['name'], 128);
  HTMLGen::addTextWidgetRow('Last Name', 'people_lastName', $dataArray['lastName'], 64, $disable);
  HTMLGen::addTextWidgetRow('Nickname', 'people_nickName', $dataArray['nickName'], 64, $disable);
  HTMLGen::addTextWidgetRow('Organization', 'people_organization', $dataArray['organization'], 128, $disable);
  HTMLGen::addTextWidgetRowDisabled('Email Address', 'people_email', $dataArray['email'], 128);
  //HTMLGen::addTextWidgetRow('Reenter Email', 'people_email_2', $dataArray['email'], 128, $disable);
  //HTMLGen::addTextWidgetRow('Password', 'people_password', $dataArray['password'], 32, $disable);
  //HTMLGen::addTextWidgetRow('Reenter Psswrd', 'people_password_2', $dataArray['password'], 32, $disable);
?>

<!-- RecordType radio buttons -->
<div class='formRowContainer' style="padding-top:2px;">
  <div class='rowTitleTextWide' style="padding-top:1px;">Record Type:</div> 
  <div class='entryFormFieldContainer etchedIn' style="padding-top:0px;padding-bottom:3px;">
    <div style="float:left;padding-top:0px;">
               <input type="radio" name="people_recordType" id="individual" value="individual"
                 <?php echo (($dataArray['recordType']) == 'individual') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="individual">Individual</label> 
    </div>
    <div style="float:left;padding-top:0px;">
               <input type="radio" name="people_recordType" id="several" value="several" 
                 <?php echo (($dataArray['recordType']) == 'several') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="several">Several</label>
    </div>
    <div style="float:left;padding-top:0px;">
               <input type="radio" name="people_recordType" id="organization" value="organization" 
                 <?php echo (($dataArray['recordType']) == 'organization') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="organization">Organization</label>
    </div>
    <div style="clear:both;"></div>
  </div>
</div>

<?php 
  HTMLGen::addCheckBoxWidgetRow('Notify of', 'people', 'notifyOf', $dataArray, 4); 
  HTMLGen::addCheckBoxWidgetRow('Relationship', 'people', 'relationship', $dataArray, 2); 
  HTMLGen::addCheckBoxWidgetRow('Role', 'people', 'role', $dataArray, 2); 
  HTMLGen::addTextAreaRow('people_notes', 'Administrative Notes', $dataArray['notes'], 2048, $disable);

  HTMLGen::addTextWidgetRow('Web Sites', 'people_webSites', $dataArray['webSites'], 512, $disable);
  HTMLGen::addTextWidgetRow('How heard', 'people_howHeardAboutUs', $dataArray['howHeardAboutUs'], 128, $disable);
  HTMLGen::addTextWidgetRow('Street Address', 'people_streetAddr1', $dataArray['streetAddr1'], 64, $disable);
  HTMLGen::addTextWidgetRow('', 'people_streetAddr2', $dataArray['streetAddr2'], 64, $disable);
  HTMLGen::addTextWidgetRow('City', 'people_city', $dataArray['city'], 32, $disable);
  HTMLGen::addStateZipCoRow($dataArray, $disable);
  //HTMLGen::addTextWidgetRow('State/Province', 'people_stateProvRegion', $dataArray['stateProvRegion'], 32, $disable);
  //HTMLGen::addTextWidgetRow('Postal Code', 'people_zipPostalCode', $dataArray['zipPostalCode'], 16, $disable);
  //HTMLGen::addTextWidgetRow('Country', 'people_country', $dataArray['country'], 32, $disable);
  HTMLGen::addTextWidgetTelephonesRow($dataArray, $disable);
?>
              </div> 
            </div>
          </div> <!-- id = "ADEPersonEditDiv" -->
<!-- End Person Edit ------------------------------------------------------------- -->
        
<!-- Begin Work Edit ------------------------------------------------------------- -->
          <div id="ADEWorkEditDiv">
            <div class="entryFormSectionHeading">
              <div style="float:left;padding-top:4px;">Editing Work: </div>
              <div style="float:right;padding-right:10px;padding-bottom:0;">
                <input type="submit" id="saveWork" name="saveWork" value="Save">
                <input type="submit" id="cancelWorkChanges" name="cancelWorkChanges" value="Cancel">
              </div>
              <div style="clear:both;"><hr class="horizontalSeparatorFull"></div>
              <div style="float:left;padding-bottom:4px;">
                <?php echo $dataArray['title'] . " (" . $dataArray['workId'] . ") submitted by " . $dataArray['name'] . " (" . $dataArray['personId'] . ")"; ?>
                <!-- <div class='datumValue' style="height:10em;text-align:left;">Editing Work</div> -->
              </div>
              <div>
<?php // stuff goes here
   $disable = false;
   HTMLGen::addTextWidgetRow('Designated Id', DatumProperties::getItemKeyFor('works', 'designatedId'), $dataArray['designatedId'], 16, $disable);
   HTMLGen::addTextWidgetRow('Film Title', DatumProperties::getItemKeyFor('works', 'title'), $dataArray['title'], 256, $disable);
   HTMLGen::addTextWidgetRow('Title for Sort', DatumProperties::getItemKeyFor('works', 'titleForSort'), $dataArray['titleForSort'], 256, $disable);
   HTMLGen::addTextWidgetRow('Production Year', DatumProperties::getItemKeyFor('works', 'yearProduced'), $dataArray['yearProduced'], 32, $disable);
   HTMLGen::addTextWidgetRow('Run Time', DatumProperties::getItemKeyFor('works', 'runTime'), $dataArray['runTime'], 16, $disable);
   //HTMLGen::addTextWidgetRow('Submission Format', DatumProperties::getItemKeyFor('works', 'submissionFormat'), $dataArray['submissionFormat'], 64, $disable);
?>
<!-- Submission Format radio buttons -->
<div class='formRowContainer' style="padding-top:0px;">
  <div class='rowTitleTextWide' style="padding-top:1px;">Submission Format:</div> 
  <?php $name = DatumProperties::getItemKeyFor('works', 'submissionFormat'); ?>
  <div class='entryFormFieldContainer etchedIn' style="padding-top:0px;padding-bottom:3px;">
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="miniDV" value="miniDV"
                 <?php echo (($dataArray['submissionFormat']) == 'miniDV') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="miniDV">Mini-DV</label> 
    </div>
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="DVD" value="DVD" 
                 <?php echo (($dataArray['submissionFormat']) == 'DVD') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="DVD">DVD</label> 
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
<?php
   HTMLGen::addTextWidgetRow('Original Format', DatumProperties::getItemKeyFor('works', 'originalFormat'), $dataArray['originalFormat'], 64, $disable);
   
   // TODO contributors
   //HTMLGen::addTextWidgetRow('Director', DatumProperties::getItemKeyFor('workContributors', 'Director'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Producer', DatumProperties::getItemKeyFor('workContributors', 'Producer'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Choreographer', DatumProperties::getItemKeyFor('workContributors', 'Choreographer'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Dance Company', DatumProperties::getItemKeyFor('workContributors', 'DanceCompany'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Principal Dancers', DatumProperties::getItemKeyFor('workContributors', 'PrincipalDancers'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Music Composition', DatumProperties::getItemKeyFor('workContributors', 'MusicComposition'), $contributorsArray['originalFormat'], 64, $disable);
   //HTMLGen::addTextWidgetRow('Music Performance', DatumProperties::getItemKeyFor('workContributors', 'MusicPerformance'), $contributorsArray['originalFormat'], 64, $disable);

   HTMLGen::addTextWidgetRow('Photo Credits', DatumProperties::getItemKeyFor('works', 'photoCredits'), $dataArray['photoCredits'], 256, $disable);
   HTMLGen::addTextWidgetRow('Photo Location', DatumProperties::getItemKeyFor('works', 'photoLocation'), $dataArray['photoLocation'], 256, $disable);
   //HTMLGen::addCheckBoxWidgetRow('Live Performance', 'works', 'includesLivePerformance', $dataArray, 1); TODO
   HTMLGen::addTextWidgetRow('Date Media Received', DatumProperties::getItemKeyFor('works', 'dateMediaReceived'), $dataArray['dateMediaReceived'], 16, $disable);
   HTMLGen::addTextWidgetRow('Date Paid', DatumProperties::getItemKeyFor('works', 'datePaid'), $dataArray['datePaid'], 16, $disable);
   HTMLGen::addTextWidgetRow('Amount Paid', DatumProperties::getItemKeyFor('works', 'amtPaid'), $dataArray['amtPaid'], 16, $disable);
   HTMLGen::addCheckBoxWidgetRow('How Paid', 'works', 'howPaid', $dataArray, 4);
?>
<!--How Paid
<div class='formRowContainer' style="padding-top:0px;">
  <div class='rowTitleTextWide' style="padding-top:1px;">How Paid:</div> 
  <?php $name = DatumProperties::getItemKeyFor('works', 'howPaid'); ?>
  <div class='entryFormFieldContainer etchedIn' style="padding-top:0px;padding-bottom:3px;">
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="check" value="check"
                 <?php echo (($dataArray['howPaid']) == 'check') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="miniDV">Check</label> 
    </div>
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="paypal" value="paypal" 
                 <?php echo (($dataArray['howPaid']) == 'paypal') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="askMe2009">Paypal</label> 
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
 -->
<?php
   HTMLGen::addTextWidgetRow('Check or Paypal #', DatumProperties::getItemKeyFor('works', 'checkOrPaypalNumber'), $dataArray['checkOrPaypalNumber'], 32, $disable);
?>
<!--Permissions -->
<!-- TODO Use SSFDefaults to generalize from allOK2009 and askMe2009 -->
<div class='formRowContainer' style="padding-top:0px;">
  <div class='rowTitleTextWide' style="padding-top:1px;">Permissions:</div> 
  <?php $name = DatumProperties::getItemKeyFor('works', 'permissionsAtSubmission'); ?>
  <div class='entryFormFieldContainer etchedIn' style="padding-top:0px;padding-bottom:3px;">
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="allOK2009" value="allOK2009"
                 <?php echo (($dataArray['permissionsAtSubmission']) == 'allOK2009') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="miniDV">OK'd all 2009 events</label> 
    </div>
    <div style="float:left;padding-top:0px;">
               <input type="radio" name=<?php echo $name; ?> id="askMe2009" value="askMe2009" 
                 <?php echo (($dataArray['permissionsAtSubmission']) == 'askMe2009') ? 'checked' : ''; ?>
                 onchange="javascript:userMadeAChange(1);"> 
    </div>
    <div class="entryFormRadioButtonLabel" style="float:left;margin-right:20px;">
               <label for="askMe2009">Invite to each event separately</label> 
    </div>
    <div style="clear:both;"></div>
  </div>
</div>
<?php
   HTMLGen::addTextWidgetRow('Web site', DatumProperties::getItemKeyFor('works', 'webSite'), $dataArray['webSite'], 1024, $disable);
//   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'webSite'), 'Web Sites', $dataArray['webSite'], 1024, $disable);
   HTMLGen::addCheckBoxWidgetRow('Web site pertains to', 'works', 'webSitePertainsTo', $dataArray, 2);
   
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'previouslyShownAt'), 'Previously shown at', $dataArray['previouslyShownAt'], 2048, $disable);
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisOriginal'), 'Original Synopsis', $dataArray['synopsisOriginal'], 2048, $disable);
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit1'), 'Synopsis Edit 1', $dataArray['synopsisEdit1'], 2048, $disable);
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'synopsisEdit2'), 'Synopsis Edit 2', $dataArray['synopsisEdit2'], 2048, $disable);
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'submissionNotes'), 'Submission Notes', $dataArray['submissionNotes'], 2048, $disable);
   HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('works', 'workNotes'), 'Work Notes', $dataArray['workNotes'], 2048, $disable);
?>
              </div>
            </div>
          </div> <!-- id = "ADEWorkEditDiv" -->
<!--          
          // Additional fields cf the 2008 form
          // titleForSort
          // synopsisEdit1
          // synopsisEdit2
          // webSitePertainsTo
          // includesLivePerformance
          // invited
          // workNotes (submissionNotes is there already)
-->
          
<!-- End Work Edit ------------------------------------------------------------- -->

<!-- 
<script type="text/javascript">
</script>

selector = document.getElementById("callForEntriesId");
id = selector.id
value = selector.value
selector.disabled=true;

echo <input type="hidden" id=" + id + " name=" id " value=" + value + "> 
-->




<!-- Control Page -->        

      <input type="hidden" id="priorAdminSelector" name="priorAdminSelector" value="<?php echo $ADEState['adminSelector']?>">
      <input type="hidden" id="priorOrientationSelector" name="priorOrientationSelector" value="<?php echo $ADEState['orientationSelector']?>">
      <input type="hidden" id="priorEntrySelection" name="priorEntrySelection" value="<?php echo $ADEState['callForEntriesId']?>">
      <input type="hidden" id="priorPersonSelection" name="priorPersonSelection" value="<?php echo $ADEState['personSelector']?>">
      <input type="hidden" id="priorWorkSelection" name="priorWorkSelection" value="<?php echo $ADEState['workSelector']?>">
      <input type="hidden" id="editingPerson" name="editingPerson" value="<?php echo $dataArray['personId']?>">
      <input type="hidden" id="editingWork" name="editingWork" value="<?php echo $dataArray['workId']?>">

<?php
        echo '<script type="text/javascript">show("ADEDataDiv");</script>';
        echo '<script type="text/javascript">enable("orientationSelector");'
                                          . (($ADEState['orientationSelector'] == 'works') ? 'enable("callForEntriesId");' : '')
                                          . 'enable("personSelector");'
                                          . 'enable("adminSelector");'
                                          . 'enable("workSelector");'
                                          . 'enable("applyFilter");'
                                          . '</script>';
        echo '<script type="text/javascript">hide("ADEPersonEditDiv");</script>';
        echo '<script type="text/javascript">hide("ADEWorkEditDiv");</script>';
        if (($ADEState['editWork'] == 'Edit') || ($ADEState['editPerson'] == 'Edit')) {
          echo '<script type="text/javascript">hide("ADEDataDiv");</script>';
          echo '<script type="text/javascript">disable("orientationSelector");'
                                            . (($ADEState['orientationSelector'] == 'works') ? 'disable("callForEntriesId");' : '')
                                            . 'disable("personSelector");'
                                            . 'disable("adminSelector");'
                                            . 'disable("workSelector");'
                                            . 'disable("applyFilter");</script>';
        }
        if ($ADEState['editPerson'] == 'Edit') echo '<script type="text/javascript">show("ADEPersonEditDiv");</script>';
        if ($ADEState['editWork'] == 'Edit')  echo '<script type="text/javascript">show("ADEWorkEditDiv");</script>';
?>

<!-- More hidden inputs -->
      <input type="hidden" id="changeCount" name="ChangeCount" value="0"> 
      <!--
      <input type="hidden" id="personChangeCount" name="PersonChangeCount" value="0">
      <input type="hidden" id="entryChangeCount" name="EntryChangeCount" value="0"> 
      <input type="hidden" id="savePersonChangesFirst" name="SavePersonChangesFirst" value='no'> 
      <input type="hidden" id="saveEntryChangesFirst" name="SaveEntryChangesFirst" value='no'> 
      <input type="hidden" id="personNickName" name="PersonNickName" value="<?php echo $_SESSION['PersonNickName']; ?>">
      <input type="hidden" id="personLastName" name="PersonLastName" value="<?php echo $_SESSION['PersonLastName']; ?>"> 
      -->
      <!-- <input type="hidden" id="personPassword" name="PersonPassword" value="<?php echo $_SESSION['PersonPassword']; ?>" > -->
      <!-- <input type="hidden" id="personEmail" name="PersonEmail" value="<?php echo $_SESSION['PersonEmail']; ?>" > -->
      <input type="hidden" id="emailAddressUID" name="EmailAddressUID" value="document.WorkDataEntryForm.PersonEmail.value"> 
      <!-- 
      <input type="hidden" id="personId" name="PersonId" value="<?php echo $_SESSION['personId']; ?>"> 
      <input type="hidden" id="entryId" name="EntryId" value="<?php echo $_SESSION['entryId']; ?>"> 
      -->
      <!-- TODO: use workLastModified and personlastModified to verify that data has not changed since read 
      <input type="hidden" id="workLastModified" name="WorkLastModified" value="<?php echo $_SESSION['WorkLastModified']; ?>"> 
      <input type="hidden" id="personlastModified" name="PersonLastModified" value="<?php echo $_SESSION['PersonLastModified']; ?>"> 
      -->
      <!-- <input type="hidden" id="callForEntriesId" name="CallForEntriesId" value="<?php echo $_SESSION['CallForEntriesId']; ?>"> -->


      </div>  <!-- id = "ADEContainer" -->
    </form>
<!-- END FORM --------------------------------------------------------------------------------------------------------- -->

          </td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
        <!-- InstanceEndEditable --></tr>
      </table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
<tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br><!-- #BeginLibraryItem "/Library/CopyrightContactBarOnBlack.lbi" --><?php SSFWebPageAssets::displayCopyrightLine();?><!-- #EndLibraryItem --></td>
		<td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>
