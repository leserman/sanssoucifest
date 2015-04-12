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

SSFDebug::globalDebugger()->belch('_POST', $_POST, -1);
/*
Belch _POST: Array (
  [mc_gross] => 0.20
  [protection_eligibility] => Ineligible
  [payer_id] => 2MWWL6GHZPJRJ
  [tax] => 0.00
  [payment_date] => 02:01:17 Mar 07, 2010 PST
  [payment_status] => Completed
  [charset] => windows-1252
  [first_name] => David
  [option_selection1] => Yet Another Dance Video
  [option_selection2] => david@leserman.com
  [mc_fee] => 0.20
  [notify_version] => 2.9
  [custom] =>
  [payer_status] => unverified
  [business] => payment@sanssoucifest.org
  [quantity] => 1
  [payer_email] => david@leserman.com
  [verify_sign] => AZxbwZ9bPVPFFf7hCCNemacLJwlCANCUtBIKWiNPIfLlvOM-ERaBdpeN
  [option_name1] => Film Title
  [option_name2] => Submitter Email Address
  [memo] => Hi there.
  [txn_id] => 5K6527724P6212208
  [payment_type] => instant
  [last_name] => Leserman
  [receiver_email] => hamelb@sanssoucifest.org
  [payment_fee] => 0.20
  [receiver_id] => M96DXLMUDN4TW
  [txn_type] => web_accept
  [item_name] => Entry Fee $25 USD
  [mc_currency] => USD
  [item_number] => 1
  [residence_country] => US
  [transaction_subject] => Entry Fee $25 USD
  [handling_amount] => 0.00
  [payment_gross] => 0.20
  [shipping] => 0.00
  [merchant_return_link] => Return to Sans Souci Festival of Dance Cinema ) 
*/

?>
          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
              .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; }
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
            </style>

            <h1><?php echo $contentTitle; ?></h1>

            <table>
              <tr>
                <td>
<?php
  if (!SSFRunTimeValues::earlyDeadlineHasPassed()) {
    $entryFeeString = SSFRunTimeValues::getEarlyDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getEarlyDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">';
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">';
  } else {
    $entryFeeString = SSFRunTimeValues::getFinalDeadlineFeeString();
    $deadlineDateString = SSFRunTimeValues::getFinalDeadlineDateString();
    echo '                                <input type="hidden" name="amount" value="' . $entryFeeString . '.00">';
    echo '                                <input type="hidden" name="item_name" value="Entry Fee $' . $entryFeeString . ' USD">';
  }
?>
                </td>
              </tr>
              <tr>
                <td>
                  <blockquote style="padding:18px 130px 0 31px;font-size:15px;">Thank you for paying your entry fee to the Sans Souci Festival of Dance Cinema via PayPal. You will receive a detailed receipt via email from PayPal shortly. <br><br>Thanks for your submission. We look forward to viewing your film.
                  </blockquote>
                </td>
              </tr>
            </table>
          </article>
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
