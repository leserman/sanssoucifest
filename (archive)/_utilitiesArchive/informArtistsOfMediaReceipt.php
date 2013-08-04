<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>SSF - Inform Artists of Media Receipt</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr><td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php
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
            ?>
            </td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
<?php
  echo "CONTENT<br>\r\n";
  $query = "select name, personId, title, workId, designatedId, dateMediaReceived, artistInformedOfMediaReceipt, artistInformedOfMediaReceiptDate"
         . " from people join works on submitter=personId"
         . " where callForEntries = " . SSFRunTimeValues::getCallForEntriesId();
         . " and (dateMediaReceived != '0000-00-00' and dateMediaReceived is not null and dateMediaReceived != '')"
         . " and (artistInformedOfMediaReceipt = 0 or artistInformedOfMediaReceipt is null)";
  $resultRows = SSFDB::getDB()->getArrayFromQuery($query);

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
  echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . ";'>&nbsp;dateMediaReceived&nbsp;</td>\r\n";
  echo "</tr>\r\n";

  foreach ($resultRows as $resultRow) {
    if ($bgnd == '#CCCCCC') $bgnd = '#FFFFCC'; else $bgnd = '#CCCCCC';
    echo "<tr>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>$resultRow[workId]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='right'>$resultRow[designatedId]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='left'>&nbsp;$resultRow[title]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>$resultRow[submitter]&nbsp;</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='left'>&nbsp;$resultRow[name]</td>\r\n";
    echo "  <td class='bodyTextOriginal' style='color:#000;background-color:" . $bgnd . "' align='center'>&nbsp;$resultRow[dateMediaReceived]&nbsp;</td>\r\n";
  }
  
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
<!-- InstanceEnd -->
</html>
