<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  $currentYearString = "2013"; // SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = 13; // SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = 22; // ??  SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())); 'l' is weekday, e.g.,, Friday
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1"> 
<META name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
<META name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<title>Sans Souci Festival of Dance Cinema - <?php echo $currentYearString; ?> Entry Information</title>
<!-- <link rel="script" href="flyoverPopup.js" type="text/javascript"> -->
<!-- <base href="http://www.sansoucifest.org/"> -->
<link rel="stylesheet" href="../sanssouci.css" type="text/css">
<link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
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
              <div  class="programPageTitleText" style="margin:8px 0 6px 0;"><?php echo $currentYearString;?> Entry Information</div>
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
				    <td align="left" valign="top"><p class="entryRequirementsParagraph"><span style="color:#FFFF66">We're interested in work </span> that integrates dance and cinematography. Works may include live dance performance in a mixed-media context with dance cinema (details below).</p>
				        <p class="entryRequirementsParagraph">This year we'll be screening short works of 21 minutes or less. That might exclude your documentary - but, there's always next year.<br><br></p>
				    </tr>
			    <tr style="margin-top:8px;margin-bottom:12px;">
				    <td align="left" valign="top" class="entryRequirementsText"><a name="whatToSubmit"></a>2.&nbsp;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">With each entry you will submit:</span>
					    <ul>
						    <li>your video via Vimeo.com (see <a href="#media">Media</a> below),</li>
							  <li>the appropriate entry fee (see <a href="#deadlines">Deadlines & Payment</a> below),</li>
							  <li>screen-capture images (see <a href="#stillImages">Still Images</a> below).</li>
					    </ul>
            </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="media"></a>3.&nbsp;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Media. </span>Submit your video by publishing it at <a href="http://vimeo.com" target="vimeo">Vimeo</a>. It's free and easy to join Vimeo and it's easy to create and upload an MP4 video.<br><br>
				        You can choose to make your video password-protected on Vimeo if you don't want to share it with others besides us. Be sure to complete the Vimeo Web Address field on our online entry form. If the video is password-protected, be sure to complete the Vimeo Password field on the form as well.<br><br>
<?php $highlightTextColor = '#e4afe4'; //FAFF66 E495E4 ?>
  Read the Vimeo <a href="http://vimeo.com/help/compression" target="vimeo">compression guidelines</a> to ensure that you submit a high quality rendition. Aside from specifying codec, frame rate, data rate, resolution, and audio, the page has links to brief informative tutorials for over three dozen editing and compression applications including, for example, iMovie, Final Cut Pro, Adobe Premier, Avid Media Composer, and Sorenson Squeeze.<br><br>
      There are a variety of Vimeo &quot;Settings&quot; that you can manage. <span style="color: <?php echo $highlightTextColor; ?> ">Be sure to check the box to &quot;Allow other people to download the source video&quot; (<a href="./vimeoDownloadabilityInfo.php" target="vimeo">detailed instructions</a>).</span>  Choose password-protected if you like - just make sure you tell us the password on your Sans Souci online entry form.
				    <br><br>
				    Last year Vimeo proved to be an effective way for us to receive your media. Our hope is that this approach relieves you from making a reliable DVD, paying postage, and having your package get lost or delayed in transit. It also allows us to accept HD submissions on a regular basis for the first time. We do welcome your <a href="mailto:feedback@sanssoucifest.org">feedback</a>.
            </td>
          </tr>
			    <tr style="margin-top:8px;margin-bottom:12px;">
				    <td align="left" valign="top" class="entryRequirementsText"><a name="deadlines"></a><a name="payment"></a><a name="deadlinesAndPayment"></a>4.&nbsp;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Deadlines &amp; Payment.</span> Uploads to Vimeo must be initiated before midnight on the deadline date; payment must be submitted via paypal or postmarked by the deadline date.  The entry fee applies to each video submitted.
				    </td>
				  </tr>
				  <tr>
				    <td></td>
				    <td>
              <?php echo HTMLGen::getFormattedDeadlineTable(); ?>
				    </td>
				  </tr>
				  <tr>
				    <td></td>
					  <td align="left" valign="top" class="entryRequirementsText">Make your check or money order (in US Dollars drawn on a US bank) payable to Sans Souci Festival of Dance Cinema OR, preferably, pay via PayPal from the <a onClick="javascript:goBackToEntryForm();">entry form</a>.
	  				  <span style="color:#FFFF66">If paying by check or money order, mail it to:</span>
		  			  <blockquote style="margin:10 0 6 40"><?php echo SSFRunTimeValues::getMailEntryToAddress();?></blockquote>
	  				  Please include your email address and your film title so that the payment gets credited for your entry.
            </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="stillImages"></a>5.&nbsp;</td>
            <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Still Images.</span> We publish a program for each of our shows on our website. For example, see <a href="http://sanssoucifest.org/programPages/programAtlas2012.php" target="vimeo">our 2012 event</a>. For this we need a small selection of representative still images with your submission. Screen captures are preferred but publicity photos may be accepted. Please include photo credit information on the entry form for production or publicity photos only; we will assume that the images are screen captures unless you specify a photo credit.<br><br>
              <span style="color:#FFFF66">About Digital Images:</span> Production and publicity photos should be submitted at 300 dpi. Screen captures should have the same pixel dimensions as your movie frame. Please provide all images in square pixels such that the image appears in the same aspect ratio as your frame. They may be submitted via email to <a href='mailto:images@sanssoucifest.org'>images@sanssoucifest.org</a> or via a web address which links directly to the image(s) and which you specify on the online entry form.
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
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Acceptance Criteria. </span>When choosing works, we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece
				      will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others;
				      excellence in any one or two areas may be sufficient for acceptance. Art-oriented shorts are strongly preferred. Short documentaries may be considered.  
				      <!-- Documentaries and animations will be considered. -->
				      Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="exhibition"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Exhibition. </span>
				      <!-- TODO Create a column venues.eventDatesDescription2 for the text 'in the Black Box ... USA' -->
					    Accepted submissions will be screened on <?php echo $eventDatesDescriptionString; ?> in the Black Box Theater in the Atlas Building at the University of Colorado at Boulder, Boulder CO, USA and (with your permission) may tour to other venues around the U.S. and elsewhere.
				    </td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText"><a name="livePerformance"></a>&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Submissions for multimedia works that incorporate a live performance</span> along with cinema must also include video of the live 
					    performance for evaluation. Email us for <a href='mailto:liveperformance@sanssoucifest.org'>questions about live performance submissions</a>.
					    Unfortunately, we have no funds to support artist travel. If your work includes live performance
					    and you would need to travel to get to Boulder, be prepared to cover your expenses.</td>
			    </tr>
			    <tr>
				    <td align="left" valign="top" class="entryRequirementsText">&nbsp;&nbsp;&#8226;</td>
				    <td align="left" valign="top" class="entryRequirementsText"><span style="color:#FFFF66">Questions. </span>Direct questions or feedback to <a href="mailto:questions@sanssoucifest.org">questions@sanssoucifest.org</a>.<br>
				      <br>
				      <br></td>
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
