<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Check Email Address</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
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
                  <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
                    <div style="background-color:#333333;text-align:center;float:none;width:530px;">
                      <div class="programPageTitleText" style="float:none;padding-top:12px;padding-left:8px;text-align:left;">Check Database for Email Address</div>
                        <form name='abcForm' id='abcForm' action='adminEmailCheck.php' method='post'>
                          <div style="margin:30px 0 20px -40px;">
<?php 

  // TODO 1/26/14: This functionality should really be integrated into adminDataEntry Create New Person people_email
  
  function checkMessage($email) {
    $message = "";
    $notifyOfString = "";
    $query = "SELECT personId, lastName, name, country, recordType, notifyOf, email from people where email like '" . $email . "'";
    //SSFDB::debugNextQuery();
    $personRows = SSFDB::getDB()->getArrayFromQuery($query);
    if (count($personRows) > 0) {
      $personRow = $personRows[0];
      $personString = ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " : "") . $personRow['name'];
      if (isset($personRow['notifyOf'])) {
        $notifyOf = explode(",", $personRow['notifyOf']);
        switch (count($notifyOf)) {
          case 0: $notifyOfString = "nothing";                                       break;
          case 1: $notifyOfString = ($notifyOf[0] != "") ? $notifyOf[0] : "nothing"; break;
          case 2: $notifyOfString = $notifyOf[0] . " and " . $notifyOf[1];           break;
          default: $notifyOfString = "ERROR";
        }
      }
      $message = "The email address, " . $personRow['email'] . ", is already in the database for " 
               . $personString . ", an " . $personRow['recordType'] . " from " . $personRow['country'] . "  to be notified of " . $notifyOfString . ".";
    } else $message = "The email address is not in the database.";
    return $message;
  }

  $adeDEBUGGER = new SSFDebug();
  $adeDEBUGGER->enableBelch(false);
  $adeDEBUGGER->enableBecho(false);
  $adeDEBUGGER->belch('_POST', $_POST, 0);

  $email = ''; 
  $message = "";
    if (isset($_POST['people_email'])) {
      $email = $_POST['people_email'];
      if ($email != '') $message = checkMessage($email);
    }
  HTMLGen::addTextWidgetRow('Email Address', 'people_email', $email, 64);
?>
                            <input type="submit" value="Submit">
                          </div>
                        </form>
                        <div class="bodyTextOnBlack" style="text-align:left;margin:12px;height:70px;"><?php echo $message ?></div>
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