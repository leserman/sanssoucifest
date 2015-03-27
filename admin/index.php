<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Admin Index</title>
  <script src="../bin/scripts/login.js" type="text/javascript"></script>
  <script src="../bin/scripts/validateEmailAddress.js" type="text/javascript"></script>
  <style type="text/css">.padded{padding:0 0 0.25em 0;}</style>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<!--  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> -->
  <table style="width:800;border:none;text-align:center;margin:0 auto;padding:0;background-color:black;"
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
<!--            <td width="10" align="center" valign="top">&nbsp;</td> -->
    <td style="width:10px;text-align:center;vertical-align:top;">&nbsp;</td>
<!--            <td width="125" align="center" valign="top"><?php // SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td> -->
    <td  style="width:125px;text-align:center;vertical-align:top;"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div style="background-color:#333333;text-align:center;float:none;">
          <div class="programPageTitleText" style="text-align:center;padding-top:12px;float:none;">SSF Administration
            <?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?><br clear='all'>
          </div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1"></div>

      <!-- Current Forms -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;">Administrator Activities</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="adminDataEntry.php">Manage People &amp; Works</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="informArtistsOfMediaReceipt.php">Inform Artists of Media Receipt</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="paymentsReport.php">Track Submission Fee Payments</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="curationData.php">Manage the Curation Process</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="curationEmail.php">Send Curation Results Emails to Submitters</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="adminPermissions.php">Manage Permission Requests &amp; Responses</a></div>
          <br>

      <!-- Reports -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;">Administrator Reports</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="paymentsReport.php">Payments</a></div>
          <br>
-->
      <!-- Admin Utils -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;">Administrator Utilities</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="permissionReponses.php">Record Permission Request Responses</a></div>
          <br>
-->
      <!-- Admin Utils -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;">Administrator Help</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="adminFAQs.php">Frequently Asked Questions</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="adminHowTo.php">How to do this and that.</a></div>
          <br>

      <!-- Utilities -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;">1-Click Utilities</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          
          <!-- Max Designated Id widget -->
          <div class="bodyTextLeadedOnBlack padded" style="color:#92ffb1">
            <form name='maxIdForm' id='maxIdForm' action='index.php' method='post'>
              Max Designated Id = 
              <?php
                $result = SSFDB::getDB()->getArrayFromQuery('select max(designatedId) as maxId from works');
                echo $result[0]['maxId'];
              ?>
              &nbsp;&nbsp;<input type="submit" id="maxIdButton" name="maxIdButton" value="Update" style="background-color:#92ffb1;">
            </form>
          </div>
          
          <!-- Acknowledgement Receipt Email widget 
          <div class="bodyTextLeadedOnBlack padded" style="color:#92ffb1">
            <form name='ackEmailForm' id='ackEmailForm' action='../bin/utilities/generateAckReceiptEmailList.php' method='post'>
              <input type="submit" id="ackReceiptEmail" name="ackReceiptEmail" value="Generate" style="background-color:#92ffb1;"> Acknowledgement-Receipt Email List 
            </form>
          </div>
          -->
          
          <div style="padding:4px 0; border:solid khaki thin;margin:-4px 20px 30px 20px;padding:6px;">
          <table cellpadding="4" cellspacing="4" width="96%" align="center">
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top" style="font-size:14px;color:#FFFF66;">Action</td>
              <td class="bodyTextLeadedOnBlack" width="40%" style="font-size:14px;line-height:15px;margin-right:10px;color:#FFFF66;" valign="top">Use to</td>
              <td class="bodyTextLeadedOnBlack" style="font-size:14px;line-height:15px;color:#FFFF66;" valign="top">Use</td>
            </tr>
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top" style="font-size:13px;"><a href="../bin/utilities/populateColumnsSchemaInfoCache.php">Gen Meta Table</a></td>
              <td class="bodyTextLeadedOnBlack" width="35%" style="font-size:13px;line-height:15px;margin-right:10px;" valign="top"><?php echo "recreate " . SSFDB::getSchemaName() . "<br>COLUMNS SCHEMA INFO"; ?></td>
              <td class="bodyTextLeadedOnBlack" style="font-size:12px;line-height:15px;" valign="top">whenever there are changes to the database schema, e.g., an ENUM or a SET definition is modified.</td>
            </tr>
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top"style="font-size:13px;"><a href="../bin/utilities/genFileNames.php">Gen File Names</a></td>
              <td class="bodyTextLeadedOnBlack" width="35%" style="font-size:13px;line-height:15px;margin-right:10px;" valign="top">generate standard file/folder names for submitted works and optionally create folders.</td>
              <td class="bodyTextLeadedOnBlack" style="font-size:12px;line-height:15px;" valign="top">whenever a list of such names is needed.</td>
            </tr>
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top"style="font-size:13px;"><a href="../bin/utilities/createEmptyCurationRows.php">Init Curation</a></td>
              <td class="bodyTextLeadedOnBlack" width="35%" style="font-size:13px;line-height:15px;margin-right:10px;" valign="top">add rows to the Curation Table</td>
              <td class="bodyTextLeadedOnBlack" style="font-size:12px;line-height:15px;" valign="top">before curation begins and every time a new work is added after that.</td>
            </tr>
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top"style="font-size:13px;"><a href="../bin/utilities/populateImageTable.php">Updt Image Tbls</a></td>
              <td class="bodyTextLeadedOnBlack" width="35%" style="font-size:13px;line-height:15px;margin-right:10px;" valign="top">update the Image tables from the images themselves &amp; information in the Work table. NOTE: First, make sure that current Year Images Directory is set properly in the runTimeValues table.</td>
              <td class="bodyTextLeadedOnBlack" style="font-size:12px;line-height:15px;" valign="top">after adding or changing the size of an image to appear on a Program page.</td>
            </tr>
            <tr>
              <td class="bodyTextLeadedOnBlack" width="25%" valign="top"style="font-size:13px;">Set Runtime Values (TODO)</td>
              <td class="bodyTextLeadedOnBlack" width="35%" style="font-size:13px;line-height:15px;margin-right:10px;" valign="top">set up the Run Time Values for this Season.</td>
              <td class="bodyTextLeadedOnBlack" style="font-size:12px;line-height:15px;" valign="top">at the beginning of a new season before any other data is entered.</td>
            </tr>
          </table>
          </div>

      <!-- Developer Show -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;">Developer Show &amp; Tell</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/testSSFRunTimeValues.php">Show Selected RunTime Values</a></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/dataPropertiesTestDriver.php">Show Data Properties</a><span style="color:khaki"> retrieves SETS &amp; ENUMS.</span></div>
          <br>

      <!-- Test Drivers -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -->
          <div class="entryFormSectionHeading padded" style="font-size:17px;line-height:19px;margin-top:12px;margin-top:12px;">Developer Test Drivers (for software developers only)</div>
          <div><hr align="center" size="1" noshade class="horizontalSeparator1" style="width:60%;"></div>
          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/testWorkDisplay.php">Test Work Display</a></div>
<!--          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/testText.php">Test Text</a></div> -->
<!--          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/mySqlExample20081225.php">MySQL Example</a> (Uses media2 table.)</div> -->
<!--          <div class="bodyTextLeadedOnBlack padded"><a href="../bin/testDrivers/worksDataEntrySubmitTest.php">Works Data Entry Submit Test</a></div> -->
          <br><br>
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
            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
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