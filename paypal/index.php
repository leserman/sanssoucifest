<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $finalDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineStringWithDayOfWeek = date('l, M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDescriptionShort = SSFRunTimeValues::getEventDescriptionStringShort(SSFRunTimeValues::getAssociatedEventId($associatedEventId)); // 3/29/14
  $eventDescriptionLong = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($associatedEventId));   // 3/29/14
  $eventDatesDescriptionStringShort = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $eventDatesDescriptionStringLong = SSFRunTimeValues::getEventDatesDescriptionStringLong($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $entryFormFilename = 'entryForm' . $currentYearString . '.php'; 
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();

  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
?>
<?php 
  $eventDescription = SSFRunTimeValues::getDeadlineEventDescription();

  $workTitle = '';
  $personEmail = '';
  $personFirstName = '';
  $personLastName = '';  

  if (isset($_GET['works_title'])) $workTitle = $_GET['works_title'];
  if (isset($_GET['people_email'])) $personEmail = $_GET['people_email'];
  if (isset($_GET['people_firstName'])) $personFirstName = $_GET['people_firstName'];
  if (isset($_GET['people_lastName'])) $personLastName = $_GET['people_lastName'];

  $suppressNameChange = (isset($workTitle) && ($workTitle != ''));
  if ($suppressNameChange) { 
    $disableNameChange = ' disabled'; 
    $nameEntryFieldStyle = 'style="color:black;background-color:#DDDDDD;"';
    } else {
      $disableNameChange = ''; 
      $nameEntryFieldStyle = '';
    }
  $suppressTitleChange = (isset($personEmail) && ($personEmail != ''));
  if ($suppressTitleChange) { 
    $disableTitleChange = ' disabled'; 
    $titleEntryFieldStyle = 'style="color:black;background-color:#DDDDDD;"';
    } else {
      $disableTitleChange = ''; 
      $titleEntryFieldStyle = '';
    }
?>

          <div id="dek"><script type="text/javascript">  initFlyoverPopup(); </script></div>

          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
              .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; }
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
              .paypalEntryField { width:300px;height:16px;font-size:13px;padding-left:4px; }
            </style>

            <div style="margin:0;padding:20px 86px 0 0;text-align:center;">
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <!-- See documentation at https://www.x.com/docs/DOC-1331#id08A6HH00W2J -->
<?php
  if (!SSFRunTimeValues::earlyDeadlineHasPassed()) {
    $entryFeeString = SSFRunTimeValues::getEarlyDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getEarlyDeadlineDateString();
    echo '                <input  type="hidden" name="amount" value="' . $entryFeeString . '.00">' . PHP_EOL;
    echo '                <input  type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">' . PHP_EOL;
  } else {
    $entryFeeString = SSFRunTimeValues::getFinalDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getFinalDeadlineDateString();
    echo '                <input  type="hidden" name="amount" value="' . $entryFeeString . '.00">' . PHP_EOL;
    echo '                <input  type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">' . PHP_EOL;
  }
?>
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="payment@sanssoucifest.org">
                <input type="hidden" name="item_number" value="1">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="page_style" value="Primary">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="rm" value="2"> <!-- return to SSF Success page with a POST -->
                <input type="hidden" name="return" value="<?php echo SSFWebPageParts::getHostName(); ?>paypal/successfulEntryFeePayment.php">
                <input type="hidden" name="cancel_return" value="<?php echo SSFWebPageParts::getHostName(); ?>paypal/cancelEntryFeePayment.php">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="bn" value="PP-BuyNowBF"> <!-- value="PP-BuyNowBF:btn_paynow_LG.gif:NonHosted" -->
                <input type="hidden" id="first_name" name="first_name" value="">
                <input type="hidden" id="last_name" name="last_name" value="">
                <input type="hidden" name="on0" value="Film Title">
                <input type="hidden" name="on1" value="Submitter Email Address">
                <input type="hidden" name="notify_url" value="<?php echo SSFWebPageParts::getHostName(); ?>paypal/listener.php">
                <!-- <input type="hidden" name="button_subtype" value="services"> TODO: This was used in the sandbox. Is it needed now? -->
                <!-- <input type="hidden" name="cn" value="Film Title, Submitter Name, Submitter Email"> TODO: This was in old code. Is it needed now? -->
                <table style="width:90%;text-align:center;margin:0;padding:6px 0 24px 0;border:0px cyan dashed;">  
                  <tr><td colspan="2"><h1 style="width:100%;text-align:center;margin-left:auto;margin-right:auto;border:0px blue dashed;"><?php echo $contentTitle; ?></h1> </td></tr>
                    <tr>
                      <td class="bodyText" style="width:31%;text-align:right;vertical-align:middle;padding:20px 0 3px 0;">Film Title:&nbsp;</td>
                      <td  style="width:69%;text-align:left;vertical-align:middle;padding:20px 0 3px 0;"><input class="paypalEntryField" <?php echo $titleEntryFieldStyle; ?> type="text" id="os0" name="os0" maxlength="250" value="<?php echo $workTitle . '"' . $disableTitleChange; ?>>
                        <script type="text/javascript">document.getElementById("os0").focus();</script>
                      </td>
                    </tr>
                    <tr>
                      <td class="bodyText" style="text-align:right;vertical-align:middle;padding:3px 0 3px 0;"><?php echo SSFHelp::getHTMLIconFor('paypalEmailNote') . ' '; ?>Login Name:&nbsp;</td>
                      <td class="bodyText" style="text-align:left;vertical-align:middle;padding:3px 0 3px 0;"><input class="paypalEntryField" <?php echo $nameEntryFieldStyle; ?> type="text" id="os1" name="os1" maxlength="127" value="<?php echo $personEmail . '"' . $disableNameChange; ?>>
                      </td>
                    </tr>
<?php
  $submitButtonAdjective = (!SSFRunTimeValues::earlyDeadlineHasPassed()) ? 'Early ' : '';
  $submitButtonString = '&nbsp;Use PayPal to pay the $' . $entryFeeString . ' USD ' . $submitButtonAdjective . 'Entry Fee now.&nbsp;';
  echo '                    <tr>' . PHP_EOL;
  echo '                      <td class="centerMiddle" colspan="2"><input type="submit" id="submit" name="submit" value="' . $submitButtonString . '" style="margin:20px 0 20px 0;font-size:15px;"></td>' . PHP_EOL;
  echo '                    </tr>' . PHP_EOL;
?>
                    <tr><td colspan="2">
<?php 
  echo "                    <script type='text/javascript'>\r\n";
//  if (isset($_GET['works_title'])) echo "  document.getElementById('os0').value = " . $_GET['works_title'] . "\r\n";
//  if (isset($_GET['people_email'])) echo "  document.getElementById('os1').value = " . $_GET['people_email'] . "\r\n";
  if (isset($_GET['people_firstName'])) echo "                      document.getElementById('first_name').value = " . $_GET['people_firstName'] . "\r\n";
  if (isset($_GET['people_lastName'])) echo "                      document.getElementById('last_name').value = " . $_GET['people_lastName'] . "\r\n";
  echo "                    </script>\r\n";
?>
                  </td></tr>
                  <tr>
                    <td colspan="2" style="width:80%;text-align:center;vertical-align:middle;">
                      <blockquote class="bodyText" style="width:70%;margin:0 auto;">
<?php
  $indent = '                          ';
  if (!SSFRunTimeValues::earlyDeadlineHasPassed()) echo $indent . '<b>Note:</b> To qualify for the Early Entry Fee, ';
  else echo $indent . '<b>Note:</b> For us to consider your work for ' . $eventDescription . ', '; 
  echo 'both your payment <em>and</em> your media must arrive with us by<br>';
  $displayDeadlineDateString = HTMLGen::displayDateFromDBDate($deadlineDateString);
  echo $displayDeadlineDateString . '.' . "\r\n";
?>
                      </blockquote>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
          </article>
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
