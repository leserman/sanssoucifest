<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>Sans Souci Festival of Dance Cinema - Payments Report</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
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
            <td width="125" align="center" valign="top">
            <?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar($codeBase);
            ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td align="center" valign="top" class="bodyTextOriginalGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
        <div style="background-color:#333333;text-align:center;float:none;">
<?php
/*  
  $query = "SELECT `workId`, `title`, `designatedId`, `submitter`, `name`, `amtPaid`, `howPaid`, `datePaid`, `checkOrPaypalNumber`"
         . " FROM `works` join `people` on `personId`=`submitter`"
         . " WHERE `howPaid`='paypal' and `callForEntries`=8 and (`datePaid` is null or `checkOrPaypalNumber` is null)";
*/  

  $unpaidOnlyWhereClause = " and (`datePaid` is null or `datePaid`='000-00-00' or `checkOrPaypalNumber` is null)";
  $paidOnlyWhereClause =  " and (`datePaid` is not null and `datePaid`!='000-00-00' and `checkOrPaypalNumber` is not null and `checkOrPaypalNumber`!='')";
  $paymentWhereClause = '';
  
//'check', 'moneyOrder', 'paypal', 'cash', 'waived', 'notPaid', 'other'
  
  $query = "SELECT `workId`, `title`, `designatedId`, `submitter`, `name`, `amtPaid`, `howPaid`, `datePaid`, `checkOrPaypalNumber`"
         . " FROM `works` join `people` on `personId`=`submitter`"
         . " WHERE `callForEntries`=8 " . $paymentWhereClause . ''
         . " ORDER BY `howPaid`, `datePaid`, `lastName`, `name`";
  
  $paymentRows = SSFDB::getDB()->getArrayFromQuery($query);

  echo '<div class="programPageTitleText" style="padding-top:12px;padding-bottom:12px;">Payments';
  echo ' ' . HTMLGen::getTestBedDisplayString() . " <span class='datumValue'>(" . count($paymentRows) . " records)</span>";
  echo '</div>'  . '<br clear="all">' . "\r\n";

  $bgnd = '#CCCCCC';
  echo "<table border='0' cellpadding='2' cellSpacing='0'>\r\n";
  echo "<tr>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;workId&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;des-Id&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;title&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;submitter&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;name&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;amtPaid&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;howPaid&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;datePaid&nbsp;</td>\r\n";
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;checkOrPaypalNumber&nbsp;</td>\r\n";
  echo "</tr>\r\n";

  foreach ($paymentRows as $paymentRow) {
//    SSFDebug::globalDebugger()->belch('', $paymentRow);
    if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
    echo "<tr>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>$paymentRow[workId]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='right'>$paymentRow[designatedId]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='left'>&nbsp;$paymentRow[title]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>$paymentRow[submitter]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='left'>&nbsp;$paymentRow[name]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>&nbsp;$paymentRow[amtPaid]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>&nbsp;$paymentRow[howPaid]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>&nbsp;$paymentRow[datePaid]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='left'>&nbsp;$paymentRow[checkOrPaypalNumber]&nbsp;</td>\r\n";
    echo "</tr>\r\n";
  }
  echo "</table><br>\r\n";
  
?>
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
            <td align="center" valign="bottom" class="smallbodyTextOriginalLeadedGrayLight"><br>
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