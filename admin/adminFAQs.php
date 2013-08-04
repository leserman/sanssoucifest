<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Admin FAQs</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <style type="text/css">
    .aText, .qText {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      line-height: 18px;
      margin:0 8px;
      text-align: left;
      padding: 0 0 0 1em;
      text-indent: -1.4em;
    }
    .qText {
      font-weight: 500;
      font-style: normal;
      margin:30px 10px 8px 20px;
      color: Khaki;
    }
    .aText {
      font-weight: normal;
      color: #F9F9CC;
      margin:6px 40px 14px 20px;
    }
    .aText:before {
      content: "A. "
    }
    .qText:before {
      content: "Q. "
    }
    .qaTitle, .qaValue, .qaButton, qaSelector {
      font-size: 14px;
      font-weight: normal;
      margin: 0;
      padding: 0;
      color: #CCCCCC;
    }
    .qaButton, qaSelector {
      font-weight: bold;
    }
    .qaValue {
      font-style: italic;
    }
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
                      <div class="programPageTitleText" style="float:none;padding-top:12px;padding-left:8px;text-align:left;">Administrator FAQs</div>

<div class="qText">Why is the <span class="qaButton">Create New Work</span> button dimmed on the Administer People & Works page?</div>
<div class="aText">A specific event must be selected to create a new work. Be sure the <span class="qaTitle">Call for</span> selector is set to the correct call.</div>

<div class="qText">Why doesn't the Submitter detail appear on the Administer People & Works page.</div>
<div class="aText">If <span class="qaValue">All Submitters</span> is selected as the <span class="qaTitle">Submitter</span>, then the system assumes that you're jumping 
       from work to work and supresses selecting the Submitter (which would restrict the works that you can then select).
       You can manually select the Submitter if you want. Maybe David will add a <span class="qaButton">Select Submitter</span> button next to the 
       <span class="qaButton">Create New Work</span> button someday.
</div>
<div class="qText">Why does the system respond so slowly?</div>
<div class="aText">The code has not been optimized. David might get around to that after he finishes adding features.</div>

                    
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