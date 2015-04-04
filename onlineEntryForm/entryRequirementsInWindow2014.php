<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())); 'l' is weekday, e.g.,, Friday
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
  $eventDescription = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($callForEntriesId)); // 3/19/14
  $highlightTextColor = '#e4afe4'; //FAFF66 E495E4
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Sans Souci Festival of Dance Cinema - <?php echo $currentYearString; ?> Entry Requirements</title>
<!-- <link rel="script" href="flyoverPopup.js" type="text/javascript"> -->
<!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
<style type="text/css">
ul {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
	line-height: 17px;
  font-weight: normal;
  color: #FFFFCC;
  margin-right: 24px;
/*
  margin: 10px 12px 6px 0px;
	padding: 0;
*/
}
.entryRequirementsText { /* Moved here from sanssouci.css 3/24/14 */
  font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
	line-height: 1.3;
  font-weight: normal;
  color: #FFFFCC;
	padding: 16px 6px 6px 6px;
	margin: 0;
}

p {  /* based on .entryRequirementsParagraph */
  font-family: Arial, Helvetica, sans-serif;
  font-size: 14px;
	line-height: 1.3;
  font-weight: normal;
  color: #FFFFCC;
  margin: 10px 20px 6px 0px;
	padding: 0;
}

p:first-of-type {  /* based on .entryRequirementsParagraph:first-of-type */
  margin-top: 16px;
}


</style>
<SCRIPT type="text/javascript">
<!--
  function goBackToEntryForm() {
    if (window.opener && window.opener.name=='EntryFormWindow') 
      { window.opener.focusAndGo('http://sanssoucifest.org/onlineEntryForm/entryForm2013.php'); } 
    else 
      { history.back(); }
  }
-->
</SCRIPT>
</head>
<body bgcolor="#000000" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td align="left" valign="top">
<table width="630"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td colspan="3" align="left" valign="top"><a href="../"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" align="center" valign="top">&nbsp;</td>
    <td width="10" align="center" valign="top">&nbsp;<!-- SECTION ALTERED - Was width=125 --></td>
    <td width="600" align="center" valign="top"><table width="100%" 
		  align="center" cellpadding="0" cellspacing="0" border="2" bgcolor="#000000" style="border-color:#FFFF66;"><tr>
			  <td><table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight">
	  	  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="programTablePageBackground">
          <tr>
            <td colspan="2" align="left" valign="middle">
              <div  class="programPageTitleText" style="margin:8px 0 6px 0;"><?php echo $currentYearString;?> Entry Requirements &amp; Information</div>
            </td>
          </tr>
			    <tr>
				    <td align="left" valign="top" colspan="2">
				      <div class="smallBodyTextOnBlack" style="text-align:right;padding:0px 10px 4px 6px;">&nbsp;
<!--				        <a href="#entryForm" onClick="javascript:goBackToEntryForm();">back | go to Online Entry Form</a> -->
				        <div style="color:#FFFF66;font-size:16px;font-weight:normal;text-align:left">Requirements</div>
				      </div>
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText">1.&nbsp;</td>
				    <td align="left" valign="top">
				      <p><span style="color:#FFFF66">We're interested in work </span> that integrates dance and cinematography. Works may include live dance performance in a mixed-media context with dance cinema (<a href="#livePerformance">details below</a>).</p>
				      <p>This year we'll primarily be screening short works of 16 minutes or less.</p>
				    </td>
			    </tr>
			    <tr style="margin-top:8px;margin-bottom:12px;">
				    <td align="left" valign="top" class="entryRequirementsText"><a name="whatToSubmit"></a>2.&nbsp;</td>
				    <td align="left" valign="top"><p><span style="color:#FFFF66">With each entry you will submit:</span></p>
					    <ul style="margin-bottom:10px;">
						    <li>your video via Vimeo.com (see <a href="#media">Media</a> below),</li>
							  <li>the appropriate entry fee (see <a href="#deadlines">Deadlines & Payment</a> below),</li>
							  <li>screen-capture images (see <a href="#screenSnapshots">Screen Snapshots</a> below).</li>
					    </ul>
            </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="media"></a>3.&nbsp;</td>
				    <td align="left">
				      <p><span style="color:#FFFF66">Media. </span>Submit your video by publishing it at <a href="http://vimeo.com" target="vimeo">Vimeo</a>. It's free, easy to join, easy to create and upload an MP4 video, and it worked well for us last year.</p>
				      <p>You can choose to make your video <span style="color:<?php echo $highlightTextColor;?>;">password-protected</span> on Vimeo if you don't want to share it with others besides us. Be sure to complete the Vimeo Web Address field on our online entry form. If the video is password-protected, be sure to complete the Vimeo Password field on the form as well.</p>
              <p>Read the Vimeo <a href="http://vimeo.com/help/compression" target="vimeo">compression guidelines</a> to ensure that you submit a high quality rendition at an appropriate data rate. Aside from specifying codec, frame rate, data rate, resolution, and audio, the page has links to brief informative tutorials for over three dozen editing and compression applications including, for example, iMovie, Final Cut Pro, Adobe Premier, Avid Media Composer, and Sorenson Squeeze.</p>
              <p>There are a variety of Vimeo &quot;Settings&quot; that you can manage. <span style="color: <?php echo $highlightTextColor; ?> ">Be sure to check the box to &quot;Allow other people to download the source video&quot; (<a href="./vimeoDownloadabilityInfo.php" target="vimeo">detailed instructions</a>).</span>  Choose password-protected if you like - just make sure you tell us the password on your Sans Souci online entry form.</p>
            </td>
          </tr>
			    <tr style="margin-top:8px;margin-bottom:12px;">
				    <td align="left" valign="top" class="entryRequirementsText"><a name="deadlines"></a><a name="payment"></a><a name="deadlinesAndPayment"></a>4.&nbsp;</td>
				    <td align="left" valign="top">
				      <p><span style="color:#FFFF66">Deadlines &amp; Payment.</span> Uploads to Vimeo must be initiated before midnight on the deadline date; payment must be submitted via paypal or postmarked by the deadline date.  The entry fee applies to each video submitted.</p>
              <?php echo HTMLGen::getFormattedDeadlineTable(); ?><br clear=all>
				      <p>Make your check or money order (in US Dollars drawn on a US bank) payable to Sans Souci Festival of Dance Cinema OR, preferably, pay via PayPal from the <a onClick="javascript:goBackToEntryForm();">entry form</a>.
	  				  <span style="color:#FFFF66">If paying by check or money order, mail it to:</span></p>
		  			  <blockquote class="entryRequirementsParagraph" style="margin:10 0 6 40;color:#FFFFCC;"><?php echo SSFRunTimeValues::getMailEntryToAddress();?></blockquote>
	  				  <p>Please include your email address and your film title so that the payment gets credited for your entry.</p>
				    </td>
				  </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="screenSnapshots"></a>5.&nbsp;</td>
            <td align="left" valign="top">
              <p><span style="color:#FFFF66">Screen Snapshots.</span> We select one of your screen snapshots to illustrate your work in our programs (e.g. <a href="../PDF/ProgramSpreads/SSF2013ProgramSpreads.pdf" target="vimeo">PDF</a> &amp; <a href="http://sanssoucifest.org/programPages/programAtlas2013.php" target="vimeo">www</a>). They should have the same pixel dimensions and aspect ratio as your movie frame and may be submitted via email to images@sanssoucifest.org or via a web address that you specify on the online entry form.</p>
            </td>
          </tr>
			    <tr>
				    <td align="left" valign="top" colspan="2">
				      <div class="smallBodyTextOnBlack" style="text-align:right;padding:8px 10px 4px 6px;">&nbsp;
<!--				        <a href="javascript:void(0)" onClick="javascript:goBackToEntryForm();">back | go to Online Entry Form</a> -->
				        <div style="color:#FFFF66;font-size:16px;font-weight:normal;text-align:left">Further Information</div>
				      </div>
				    </td>
			    </tr>
				  <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="criteria"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top">
				      <p><span style="color:#FFFF66">Acceptance Criteria. </span>When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Art-oriented shorts under 16 minutes are strongly preferred. Short documentaries may be considered.</p>
				      <!-- Documentaries and animations will be considered. -->
				      <p>Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</p>
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="exhibition"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top">
				      <p><span style="color:#FFFF66">Exhibition. </span><?php echo $eventDescription; ?>
					    <p>Additionally, with your permission, your work may tour to other venues around the U.S. and elsewhere.</p>
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="livePerformance"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top"><p><span style="color:#FFFF66">Submissions for multimedia works that incorporate a live performance</span> along with cinema must also include video of the live performance for evaluation. Email us for <a href='mailto:liveperformance@sanssoucifest.org'>questions about live performance submissions</a>.  Unfortunately, we have no funds to support artist travel. If your work includes live performance and you would need to travel to get to Boulder, be prepared to cover your expenses.</p>
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="communications"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top"><p><span style="color:#FFFF66">Communications.</span> We use a variety of email addresses that all end in 
				      <i>@sanssoucifest.org</i>. To ensure that you receive emails from us, we suggest that you clear our domain name, <i>sanssoucifest.org</i>, in your email spam filters.</p>
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText">&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top"><p class="entryRequirementsParagraph" style="margin-bottom:25px;"><span style="color:#FFFF66">Questions. </span>Direct questions or feedback to <a href="mailto:questions@sanssoucifest.org">questions@sanssoucifest.org</a>.</p>
				    </td>
  </tr>
			  </table><!-- #EndLibraryItem --></td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    </tr></table></td></tr></table>
    </td>
    <td width="10" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="2">&nbsp;</td>
    <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
      <?php echo SSFWebPageAssets::displayCopyrightLine(); ?>
    </td>
		<td width="10">&nbsp;</td>
  </tr>
<tr align="center" valign="top"><td colspan="4">&nbsp;</td></tr></table>
</td></tr></table>
</body>
</html>
