<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Payments Report</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
                    <div style="background-color:#333333;text-align:center;float:none;">
<?php
  function tdTag($bgnd, $align, $padLeft="4px") {
    return "          <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";text-align:" . $align 
                                                                 . ";padding-left:" . $padLeft . ";padding-right:4px;'>";
  }

//  $unpaidOnlyWhereClause = " and (`datePaid` is null or `datePaid`='000-00-00' or `checkOrPaypalNumber` is null)";
  $unpaidOnlyWhereClause = " and ((`datePaid` is null or `datePaid` = '000-00-00')  and `howPaid` != 'waived' and `howPaid` != 'notPaid')";
//  $paidOnlyWhereClause =  " and (`datePaid` is not null and `datePaid`!='000-00-00' and `checkOrPaypalNumber` is not null and `checkOrPaypalNumber`!='')";
  $paidOnlyWhereClause =  " and ((`datePaid` is not null and `datePaid` != '000-00-00') or `howPaid` = 'waived' or `howPaid` = 'notPaid')";

  $showPromised = (isset($_POST['showPromisedCache'])) ? $_POST['showPromisedCache'] : 1;
  $showReceived = (isset($_POST['showReceivedCache'])) ? $_POST['showReceivedCache'] : 1;
  if ($showPromised && $showReceived) { $whichOnes = 'Received and Promised '; $paymentWhereClause = ''; }
  else if (!$showPromised && !$showReceived) { $whichOnes = ''; $paymentWhereClause = " and (`datePaid` is null and `datePaid` = '000-00-00')"; }
  else if (!$showPromised && $showReceived) { $whichOnes = 'Received '; $paymentWhereClause = $paidOnlyWhereClause; }
  else if ($showPromised && !$showReceived) { $whichOnes = 'Promised '; $paymentWhereClause = $unpaidOnlyWhereClause; }

  if (isset($_POST['sortBy0'])) { $sortBy[] = $_POST['sortBy0']; $sortBy[] = $_POST['sortBy1']; $sortBy[] = $_POST['sortBy2']; }
  else $sortBy = array('`howPaid`', '`datePaid`', '`lastName`, `name`');
  SSFDebug::globalDebugger()->belch('sortBy 0', $sortBy, -1);

  if (isset($_POST['sortOnMe'])) { 
    $sortOnMe = (($_POST['sortOnMe'] == 'name') ? "lastName, `name`" : (($_POST['sortOnMe'] == 'des-Id') ? "designatedId" : $_POST['sortOnMe']));
    $sortBy[2] = $sortBy[1];
    $sortBy[1] = $sortBy[0];
    $sortBy[0] = $sortOnMe; 
  }
  SSFDebug::globalDebugger()->belch('sortBy 1', $sortBy, -1);
  
  $query = "SELECT `workId`, `title`, `designatedId`, `submitter`, `name`, `amtPaid`, `howPaid`, `datePaid`, `checkOrPaypalNumber`"
         . " FROM `works` join `people` on `personId`=`submitter`"
         . " WHERE `callForEntries`= " . SSFRunTimeValues::getCallForEntriesId() . " " . $paymentWhereClause . ''  
         . " ORDER BY ";
  $orderByString = '';
  $separator = '';
  $iter = 0;
  foreach ($sortBy as $sortByItem) { 
    $iter++; 
    if ($iter > 3) break; 
    else { $orderByString .= ($separator . $sortByItem); $separator = ', '; }
  }
  $query .= $orderByString;
  
  //SSFDB::getDB()->debugNextQuery();
  $paymentRows = SSFDB::getDB()->getArrayFromQuery($query);

//  echo "<div>\r\n";
  echo "  <form action='paymentsReport.php' method='post' style='margin-bottom:0;'>\r\n";
  echo '    <div class="programPageTitleText" style="padding-top:12px;padding-bottom:8px;">Payments ' . HTMLGen::getTestBedDisplayString() . "\r\n";
  echo "      <div class='datumDescription' style='padding-top:10px;'>Show:&nbsp;&nbsp; \r\n";
  echo "        <label for='showReceived'>Received</label>\r\n";
  echo "        <input type='checkbox' name='showReceived' id='showReceived'" . (($showReceived) ? " checked='checked' " : " ") 
                 . "onclick='javascript:setCache(\"showReceived\"," . $showReceived . ");submit();'>&nbsp;&nbsp; \r\n";
  echo "        <label for='showPromised'>Promised/Owed</label>\r\n";
  echo "        <input type='checkbox' name='showPromised' id='showPromised'" . (($showPromised) ? " checked='checked' " : " ")
                 . "onclick='javascript:setCache(\"showPromised\"," . $showPromised . ");submit();'>\r\n";
  echo "      </div>\r\n";
  echo "      <input type='hidden' id='showPromisedCache' name='showPromisedCache' value='" . $showPromised . "'>\r\n";
  echo "      <input type='hidden' id='showReceivedCache' name='showReceivedCache' value='" . $showReceived . "'>\r\n";
  echo '    </div>'  . '<br clear="all">' . "\r\n";
  
  $pmtCount = array();
  $pmtSum = array();
  $initialValues = array('received' => 0, 'owed' => 0, 'total' => 0);
  $howPaidValues = array('check', 'paypal', 'moneyOrder', 'cash', 'waived', 'notPaid', 'other', 'undefined', 'total');
  foreach ($howPaidValues as $possibleValue) {
    $pmtCount[$possibleValue] = $initialValues;
    $pmtSum[$possibleValue] = $initialValues;
  }
  SSFDebug::globalDebugger()->belch('pmtCount 0', $pmtCount, -1);
  SSFDebug::globalDebugger()->belch('pmtSum 0', $pmtSum, -1);

  foreach ($paymentRows as $paymentRow) {
    $howPaidIsDefined = isset($paymentRow['howPaid']) && ($paymentRow['howPaid'] != '');
    $howPaid = ($howPaidIsDefined) ? $paymentRow['howPaid'] : 'undefined';
    $pmtReceived = (isset($paymentRow['datePaid']) && ($paymentRow['datePaid'] != '') && ($paymentRow['datePaid'] != '0000-00-00'));
    $pmtCount[$howPaid]['total']++;
    $subArrayKey = (($pmtReceived)?'received':'owed');
    $pmtCount[$howPaid][$subArrayKey]++;
    $amtPaid = (int) $paymentRow['amtPaid'];
    $pmtSum[$howPaid]['total'] += $amtPaid;
    $pmtSum[$howPaid][$subArrayKey] += $amtPaid;
    $pmtCount['total'][$subArrayKey]++;
    $pmtSum['total'][$subArrayKey] += $amtPaid;
    $pmtCount['total']['total']++;
    $pmtSum['total']['total'] += $amtPaid;
//    SSFDebug::globalDebugger()->belch('pmtSum[paymentRow[' . $pmtSum[$howPaid] . ']]', $pmtSum[$howPaid], -1);
  }

//  echo "<div style='margin:0 auto 0 auto;width:600px;padding:10px;'>\r\n";
  echo "    <div style='padding:0px 0px 8px 10px;'>\r\n";
  echo "      <div class='datumDescription'>" . $whichOnes . "Payment Counts Summary</div>\r\n";
  echo "        <table border='1' cellpadding='2' cellSpacing='0'>\r\n";
  echo "          <tr>\r\n";
  echo "            <th class='datumDescription' style='text-align:center;padding:2px 10px;'>" . '&nbsp;' . "</th>\r\n";
  foreach ($howPaidValues as $howPaidValue) echo "            <th class='datumDescription' style='text-align:center;padding:2px 10px;'>" . $howPaidValue . "</th>\r\n";
  echo "          </tr>\r\n";
  foreach (array_keys($initialValues) as $key) {
    echo "          <tr>\r\n";
    echo "            <td class='datumDescription' style='text-align:right;padding-right:10px;padding-left:10px;'>" . $key . ":</td>\r\n";
    foreach ($howPaidValues as $howPaidValue) {
      $printValue = ($pmtCount[$howPaidValue][$key] == 0) ? "&nbsp;" : $pmtCount[$howPaidValue][$key];
      echo "            <td class='datumDescription' style='text-align:center;'>" . $printValue . "</td>\r\n";
    }                
    echo "          </tr>\r\n";
  }               
  echo "        </table>\r\n";
  echo "      </div>\r\n";

  echo "      <div style='padding:8px 10px 30px 10px;'>\r\n";
  echo "        <div class='datumDescription'>" . $whichOnes . "Payment Amounts Summary ($)</div>\r\n";
  echo "          <table border='1' cellpadding='2' cellSpacing='0'>\r\n";
  echo "            <tr>\r\n";
  echo "              <th class='datumDescription' style='text-align:center;padding:2px 10px;'>" . '&nbsp;' . "</th>\r\n";
  foreach ($howPaidValues as $howPaidValue) echo "              <th class='datumDescription' style='text-align:center;padding:2px 10px;'>" . $howPaidValue . "</th>\r\n";
  echo "            </tr>\r\n";
  foreach (array_keys($initialValues) as $key) {
    echo "          <tr>\r\n";
    echo "            <td class='datumDescription' style='text-align:right;padding-right:10px;padding-left:10px;'>" . $key . ":</td>\r\n";
    foreach ($howPaidValues as $howPaidValue) {
      $printValue = ($pmtSum[$howPaidValue][$key] == 0) ? "&nbsp;" : number_format($pmtSum[$howPaidValue][$key]);
      echo "            <td class='datumDescription' style='text-align:right;padding-right:10px;padding-left:10px;'>" . $printValue . "</td>\r\n";
    }             
    echo "          </tr>\r\n";
  }
  echo "        </table>\r\n";
  echo "      </div>\r\n";
//  echo "    </div>\r\n";

  echo "    <div class='datumDescription' style='padding-left:10px;'>(" . count($paymentRows) . " records " . "sorted by " . $orderByString . ")</div>\r\n";
  $bgnd = '#CCCCCC';
  echo "      <table border='0' cellpadding='2' cellSpacing='0' style='padding-left:10px;'>\r\n";
  echo "        <tr>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='workId'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='des-Id'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='title'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='submitter'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='name'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='amtPaid'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='howPaid'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left') . "\r\n              <input type='submit' name='sortOnMe' value='datePaid'>\r\n            </td>\r\n";
  echo tdTag($bgnd, 'left', '12px') . "checkOrPaypalNumber</td>\r\n";
  echo "          <td><input type='hidden' name='sortBy0' value='" . $sortBy[0] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy1' value='" . $sortBy[1] . "'></td>\r\n";
  echo "          <td><input type='hidden' name='sortBy2' value='" . $sortBy[2] . "'></td>\r\n";
  echo "        </tr>\r\n";

  foreach ($paymentRows as $paymentRow) {
    SSFDebug::globalDebugger()->belch('', $paymentRow, -1);
    $howPaidIsDefined = isset($paymentRow['howPaid']) && ($paymentRow['howPaid'] != '');
    $howPaid = ($howPaidIsDefined) ? $paymentRow['howPaid'] : 'undefined';
    if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
    echo "        <tr>\r\n";
    echo tdTag($bgnd, 'center') . $paymentRow['workId'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $paymentRow['designatedId'] . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $paymentRow['title'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $paymentRow['submitter'] . "</td>\r\n";
    echo tdTag($bgnd, 'left') . $paymentRow['name'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $paymentRow['amtPaid'] . "</td>\r\n";
    echo tdTag($bgnd, 'center') . $howPaid . "</td>\r\n";
    echo tdTag($bgnd, 'center') . (($paymentRow['datePaid'] == '0000-00-00') ? '' : $paymentRow['datePaid']) . "</td>\r\n";
    echo tdTag($bgnd, 'left', '12px') . $paymentRow['checkOrPaypalNumber'] . "</td>\r\n";
    echo "        </tr>\r\n";
  }
  echo "      </table><br>\r\n";
  echo "  </form>\r\n";
  
  SSFDebug::globalDebugger()->belch('pmtCount', $pmtCount, -1);
  SSFDebug::globalDebugger()->belch('pmtSum', $pmtSum, -1);

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