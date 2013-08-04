<?php 
  require_once('../bin/classes/SSFVimeo.php');
  require_once('../bin/classes/SSFMadMimi.php');
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<title>SSF - Mad Mimi</title>
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<script src="../bin/scripts/flyoverPopup.js" type="text/javascript"></script>
<script src="../bin/scripts/dataEntry.js" type="text/javascript"></script>
<script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
<script src="../bin/scripts/ssf.js" type="text/javascript"></script>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000" onload="doNothingBreakpointOpportunity('adminDataEntry.php called from onload');">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
<tr><td align="left" valign="top">
<table width="800"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <!-- was 745 -->
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
    <td align="center" valign="top">
      <table width="665" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
        <tr>
          <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
          <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
          <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
            <div>
              <div style='font-family: Arial, Helvetica, sans-serif;font-size:12px;text-align:left;color:white;
                                                                      float:left;margin:0 4px 6px 4px;background-color:black;'>
              </div>
              <div style="clear:both;"></div>
              <div class="programPageTitleText" style="float:left;padding-top:8px;padding-left:8px;text-align:left;">Mad Mimi
                <?php echo ' ' . HTMLGen::getTestBedDisplayString(); ?>
              </div>
              <div class='navBar' style="vertical-align:bottom;float:right;padding-top:1.4em;padding-bottom:0;padding-right:16px;text-align:right;">
                <a href="../admin">Admin Home</a> </div>
              <div style="clear:both"></div>
            </div>
            <div id='stats' class='bodyTextOnDarkGray' style="text-align:left;margin-top:40px;">Hello<br>
<?php
              $showDiagnostics = -1;

// URL text: api_key=fefc637b9cd69ab3423c8c156b9198ac&username=hamelb@sanssoucifest.org 

              $madMimiCSVKeys = array('personId', 
                                      'fullName', 
                                      'last_name', 
                                      'first_name', 
                                      'organization', 
                                      'email', 
                                      'notifyOf', 
                                      'notifyOfEvents',
                                      'notifyOfCalls', 
                                      'tester', 
                                      'role', 
                                      'relationship', 
                                      'recordType', 
                                      'address', 
                                      'city', 
                                      'state', 
                                      'zip', 
                                      'country');
              $madMimiAPI_KEY = 'fefc637b9cd69ab3423c8c156b9198ac';
              $madMimiEmailAddress = 'hamelb@sanssoucifest.org';
    SSFDebug::globaldebugger()->becho('$madMimiEmailAddress', $madMimiEmailAddress, 1);
              $madMimi = new SSFMadMimi($madMimiEmailAddress, $madMimiAPI_KEY, false); 
    SSFDebug::globaldebugger()->belch('$madMimi', $madMimi, 1);
              $peopleForMadMimiQuery = "SELECT personId, name AS fullName, lastName AS last_name, nickName AS first_name, organization, email, notifyOf, "
                                     . "(find_in_set('events',notifyOf) > 0) AS notifyOfEvents, (find_in_set('calls',notifyOf)> 0) as notifyOfCalls, "
                                     . "(find_in_set('tester',relationship)> 0) AS tester, role, relationship, recordType, "
                                     . "concat(streetAddr1,' ',streetAddr2) AS address, city, stateProvRegion AS state, zipPostalCode AS zip, country "
                                     . "FROM people "
                                     . "WHERE email IS NOT NULL AND email != '' AND notifyOf IS NOT NULL AND notifyOf != '' "
//                                     . "AND lastName = 'Leserman' AND nickName = 'David' "
                                     . "ORDER BY personId";
              $peopleRows = SSFDB::getDB()->getArrayFromQuery($peopleForMadMimiQuery);
              $personCount = 0;

// Use Audience Import instead of AddUser()
// /audience_members?csv_file={file} [POST] 
// Import audience members using CSV formatted data.
// This has no prebuilt API in MadMimi.class.php.

              foreach ($peopleRows as $person) { 
                SSFDebug::globaldebugger()->belch('$person', $person, $showDiagnostics);
                foreach ($madMimiCSVKeys as $key) {
                  $personForMadMimi[$key] = $person[$key];
                }
                $personCount += 1;
                if ($personCount >= 422) break;
//                if ($personCount >= 426) break;
//                $result = $madMimi->AddUser($person);
                echo $personCount . '. (' . $person['personId'] . ') ' . $person['fullName'] . ', ' . $person['email'] . ' added ( ';
                SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);

                if ($person['notifyOfEvents'] == 1) {
                  $result = $madMimi->AddMembership('NotifyOfEvents', $person['email']);
                  echo 'events ';
                  SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);
                }
                
                if ($person['notifyOfCalls'] == 1) {
                  $result = $madMimi->AddMembership('notifyOfCalls', $person['email']);
                  echo 'calls ';
                  SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);
                }
                
                echo ")<br>\r\n";
/*
                $result = $madMimi->Memberships($person['email']);
                $resultDisplay = ($result === false) ? 'FALSE' : $result;
                echo '    MEMBERSHIPS: ' . $resultDisplay . "<br><br>\r\n";
*/
                if (FALSE && ($personCount >= 2)) break;
                
                sleep(8);
              }

              echo '<br>Count = ' . $personCount . "<br><br>\r\n";
/*
              $result = $madMimi->Lists();
              $resultDisplay = ($result === false) ? 'FALSE' : $result;
              echo 'LISTS: ' . $resultDisplay . "<br><br>\r\n";

              
//              echo 'SEARCH: ' . $madMimi->Search('notifyOfEvents:1', $raw = false, $return = false);
              echo 'SEARCH: ' . "<br>\r\n" . $madMimi->Search('notifyOfEvents:1');
*/

/*
// There are a total of four arguments that can be used on the next line. The first two are shown here, the second two
// are optional. The first of them is a debugger, which defaults to false, and the second, allows you to print
// the transaction ID when sending a message. It also defaults to false.
$mailer = new MadMimi($madMimiEmailAddress, $madMimiAPI_KEY); 

// Let's create a new user array, and add that user to a list.
// Note, in this user's array, we have a bunch of custom fields, and an add_list key - that lets us
// add this user to a specific list! If the user is already a member of your audience, just give it the
// email and add_list keys, and you're good to go.
$user = array('email' => 'emailaddress@example.com', 'firstName' => 'nicholas', 'lastName' => 'young', 'Music' => 'Rock and roll', 'add_list' => 'Test List 2');

$mailer->AddUser($user);
*/
            ?>
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
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
    <?php SSFWebPageAssets::displayCopyrightLine();?></td>
		<td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
<!-- InstanceEnd --></html>
