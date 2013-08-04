<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Gen File Names</title>
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

// TODO: Rewrite this to use the filenames from the database.

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
	  	<td align="center" valign="top" width="530" class="bodyTextOriginalGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div style="background-color:#333333;text-align:left;float:none;">
<?php
  //$showPromised = (isset($_POST['showPromisedCache'])) ? $_POST['showPromisedCache'] : 1;
  //SSFDebug::globalDebugger()->belch('sortBy 0', $sortBy, -1);

  $query = "SELECT `workId`, `title`, `titleForSort`, `designatedId`, `submitter`, `name`, `filename`"
         . " FROM `works` join `people` on `personId`=`submitter`"
         . " WHERE `callForEntries`= " . SSFRunTimeValues::getInitialCallForEntriesId()
//         . " AND accepted=1"
         . " ORDER BY designatedId";
  
  //SSFDB::getDB()->debugNextQuery();
  $workArray = SSFDB::getDB()->getArrayFromQuery($query);

  // TODO Populate form to allow the user to choose the CallForEntries and to select Accepted vs Rejected vs Undecided vs All.
  echo "<div>\r\n";
  echo "  <form action='genFileNames.php' method='post' style='margin-bottom:0;'>\r\n";
  echo '    <div class="programPageTitleText" style="padding-top:12px;padding-bottom:8px;">Generate Work File Names';
  echo ' ' . HTMLGen::getTestBedDisplayString();
  echo "    </div>\r\n";
  echo "  </form>\r\n";
  echo '</div>' . "\r\n";
  
  echo "<div class='bodyTextLeadedOnBlack' style='padding:40px 10px;margin-left:20px;'><br>\r\n";
  foreach ($workArray as $work) {
    $fileName = HTMLGen::computedFileNameForWork($work['designatedId'], $work['titleForSort'], $work['name']);
    echo $fileName . "<br>\r\n";
  }
  echo "</div>\r\n";
  
//  echo "<div class='bodyTextLeadedOnBlack' style='padding:10px 10px;margin-left:20px;'>File names for accepted works for Call For Entries Id " . SSFRunTimeValues::getCallForEntriesId() . ".</div>";
  echo "<div class='bodyTextLeadedOnBlack' style='padding:10px 10px;margin-left:20px;'>File names for works for Call For Entries Id " . SSFRunTimeValues::getCallForEntriesId() . ".</div>";
  echo "<div class='bodyTextLeadedOnBlack' style='padding:10px 10px;margin-left:20px;'><br>\r\n";
  echo "To create folders with these names,<br>copy the following text to a Terminal window and press Return."
       . " A new folder named SSF_Folders will be created on your desktop with these folders inside.<br><br>\r\n";
  echo "/bin/mkdir -p ~/Desktop/SSF_Folders/{";

  $iteration = 0;
  foreach ($workArray as $work) {
    // TODO: Change this to use works.fileName, the cached generated filename in the DB.
    $fileName = HTMLGen::computedFileNameForWork($work['designatedId'], $work['titleForSort'], $work['name']);
    echo (($iteration++ > 0) ? "," : "") . "\\<br>\r\n" . $fileName;
  }
  echo "}<br><br>\r\n";
  echo "</div>\r\n";
  
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