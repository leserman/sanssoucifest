<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
  include_once './bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
// TODO: In 2013, change this to use the SSFRunTimeValues calls: 
//  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
//  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
  //SSFDB::debugNextQuery();
// instead of
  $venueDescriptionQuery = 'SELECT eventDatesDescription1, venueDescription1 FROM venues join events on venueId = venue WHERE eventId = ' . $associatedEventId;
  $rows = SSFDB::getDB()->getArrayFromQuery($venueDescriptionQuery);
  $eventDatesDescriptionString = (isset($rows[0]['eventDatesDescription1'])) ? $rows[0]['eventDatesDescription1'] : "Internal Error: Date description string is missing.";
  $venueDescriptionString = (isset($rows[0]['venueDescription1'])) ? $rows[0]['venueDescription1'] : "Internal Error: Venue description is string missing.";;
  $debug = new SSFDebug; 
  $debug->belch('rows', $rows, -1);
  $debug->becho('venueDescriptionString', $venueDescriptionString, -1);
// end instead of
?>
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Call For Entries 2012</title>
<!--
<script src="scripts/login.js" type="text/javascript"></script>
<script src="scripts/validateEmailAddress.js" type="text/javascript"></script>
-->
<style type="text/css">
.artistNews {font-size:14px;line-height:18px;text-align:center;color:#F9F9CC;padding:4px 0 4px 0;margin:auto;width:94%;}
</style>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="sanssouci.css" type="text/css">
  <link rel="stylesheet" href="sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
                  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#333333">
                    <tr>
                      <td align="center" valign="middle">
<!-- Calls for Entries, 2012 -->                 
      <div class="homeHeading1" style="margin-top:12px;">Call for Entries &bull; Dance Cinema</div>
      <div class="callForEntriesText">The Sans Souci Festival of Dance Cinema invites submissions of 1) film and video works that integrate dance and cinematography and 2) mixed-media works that include both cinema and live performance. We encourage submissions from all artists regardless of credentials and affiliations. When choosing works we consider thoughtful forms and themes,  innovative approaches, and other <a href="#criteria">curatorial criteria</a>.
      </div>
      <div align="left" class="bodyTextWithEmphasis"> 
  <!-- CHANGE IMAGE HERE -->
        <a href='programPages/programAtlas2011.php'><img src="images/Stills2011/11-110-Melt-NoemieLafrance356x200.jpg"
          alt='Frame from "MELT" (2010), directed by Noémie Lafrance, produced by Natalie Galazka' 
          title='Frame from "MELT" (2010), directed by Noémie Lafrance, produced by Natalie Galazka'
          hspace="0" vspace="4" border="2" align="top" height="200" width="356" style="margin:28px 0 4px 62px;"></a>
        <div class="bodyTextLeadedOnBlack" style="font-size:11px;margin:0px 0 18px 62px;padding-bottom:0;text-align:left;line-height:120%"><span style="font-size:12px;">a frame from MELT (2010),</span><br>directed &amp; choreographed by Noémie Lafrance, produced by Natalie Galazka
        </div>
      </div>
      <div class="callForEntriesText">Deadlines for submission are <?php echo $earlyDeadlineString . ' and ' . $finalDeadlineString ?>.</div>
      <div class="callForEntriesText">Accepted works will be exhibited on <?php echo $eventDatesDescriptionString; ?>
        at <?php echo $venueDescriptionString; ?> and, with permission, considered for  upcoming tours.
      </div>
      <div class="callForEntriesText"><span style="color:ffff99;font-size:16px;">For more information see </span>
         <a href="javascript:void(0)" 
           onClick="entryRequirementsWindow=window.open('onlineEntryForm/entryRequirementsInWindow2012.php',
           'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=650,height=640',false);
           entryRequirementsWindow.focus();">Entry Information &amp; Requirements</a>.
      </div>
      <div class="callForEntriesText">Sign in to submit an <a href="./onlineEntryForm/entryForm2012.php">entry form</a>.</div>
      <div class="callForEntriesText"><a href="./onlineEntryForm/entryForm2012.php">Sign in</a> to modify your entry or pay the entry fee via Paypal&nbsp;
          <img src="./images/logos/PayPal_mark_37x23.gif" alt="PayPal logo" style="border:none;margin:0;padding:0;vertical-align:-30%;">.</div>
<!--
      <div class="callForEntriesText"><a href="./paypal/index.php">Pay</a> the entry fee via Paypal. &nbsp;
         <a href="./paypal/index.php"><img src="./images/logos/PayPal_mark_37x23.gif" alt="Pay now via PayPal" title="Pay now via PayPal" 
          style="border:none;margin:0;padding:0;vertical-align:middle;"></a> 
      </div> 
-->
	                    </td>
                    </tr>
<!-- Curatorial Criteria -->
                    <tr>
                      <td><a name="danceCinemaDefinition"></a>
                      <div class="homeHeading1" style="margin-bottom:8px;"><a name="criteria"></a>Curatorial Criteria</div>
                      <div class="bodyTextLeadedOnBlack" style="padding:2px 40px 30px 40px;text-align:left;">We're interested in film and video works that integrate dance and cinematography. When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Art-oriented shorts are strongly preferred. Short documentaries may be considered. Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</div>
                      </td>
                    </tr>
                  </table>
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