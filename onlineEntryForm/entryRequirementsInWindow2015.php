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
  $thisPage = $_SERVER['REQUEST_URI'];
  $recentProgramPage = "programAtlas2014.php";
  $samplePrintProgram = 'PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf';

  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
?>
          <script type="text/javascript">
            // TODO: Fix this stuff.
            function focusAndGo(url) { window.blur(); window.location.href = url; window.focus(); } // Reference: https://developer.mozilla.org/En/Document.location
            function goBackToEntryForm() {
              if (window.opener && (window.opener.name == 'SSFEntryFormWindow')) 
                window.opener.focusAndGo(<?php echo SSFWebPageParts::getHostName() . 'onlineEntryForm/entryForm' . $currentYearString . '.php'; ?>);
              else history.back();
            }
          </script>

          <article class="dodeco" id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
              .contentArea article section h2 { color:<?php echo $secondaryTextColor; ?>; font-weight:bold; }
/*              p { font-size: 14px; line-height: 1.3; margin: 10px 20px 6px 0px; padding: 0; } based on .entryRequirementsParagraph */
              .listItemTitle { font-weight:bold; color:<?php echo $tertiaryTextColor; ?>; }
/*              ul { font-size: 14px; line-height: 1.3; margin-right: 24px; } */
              ul, ol { font-size: 14px; line-height: 1.3; margin-right: 24px; margin-left:25px; }
              ol { list-style-type:decimal; }
              ul li, ol li { line-height:1.3; padding-top:10px; }
              ol ul li { padding-top:0px; }
              ol ul li:first-of-type { padding-top:0px; }
              ol li { type="1"; }
              ul li:first-of-type  { padding-top:2px; }
              ol li:first-of-type { padding-top:6px; }
 					    ul .venueList { margin-top:6px; margin-bottom:6px; margin-left:15px; font-size:13px; }
    				  ul .venueList li { margin-top:3px; margin-bottom:3px; padding:0; }
    				  ul .venueList li:first-of-type { margin-top:2px; }
              .contentArea article section { margin-right:70px; }
              .contentArea article section p { padding:0; margin-top:12px; }
              .contentArea article section p:first-of-type { margin-top:4px; }
              .contentArea article section p:last-of-type { margin-bottom:4px; }
              .bodyText, bodyTextUnleaded { padding:2px 20px 0px 20px; }
              .page { background-image: none; }
            </style>

            <h1><?php echo $contentTitle; ?></h1>

<!--  	        <div style="text-align:right;font-size:12px;margin:0;"><a class="dodeco" href="" onClick="javascript:goBackToEntryForm();">back | go to Online Entry Form</a></div> -->

<?php 
//  echo 'DIR: ' . __DIR__ . '<br>' . 'FILE: ' . __FILE__ . '<br>' . '_SERVER[REQUEST_URI]: ' . $_SERVER['REQUEST_URI'] . '<br>'; 
?>

            <section>
              <h2 id="requirements">Requirements</h2>
              <ol start="1">
                <li id="interests">
                  <p><span class="listItemTitle">We're interested in work </span> that integrates dance and cinematography. Works may include live dance performance in a mixed-media context with dance cinema (<a href="<?php echo $thisPage; ?>#livePerformance">details below</a>).</p>
    				      <p>This year we'll primarily be screening short works of 16 minutes or less.</p>
                </li>
                <li id="whatToSubmit"><span class="listItemTitle">With each entry you will submit:</span>
    					    <ul style="margin-top:-2px;margin-bottom:4px;margin-left:15px;">
 
<!--      					    <li>the <a href="onlineEntryForm/<?php echo $entryFormFilename; ?>">entry form</a> that you fill out online,</li> -->
<!--      					    <li>the <?php echo HTMLGen::getWindowLinkDisplayString('onlineEntryForm/' . $entryFormFilename, 'entry form', 'EntryForm'); ?> that you fill out online,</li> -->
    						    <li>your video via Vimeo.com (see <a href="<?php echo $thisPage; ?>#media">Media</a> below),</li>
    							  <li>the appropriate entry fee (see <a href="<?php echo $thisPage; ?>#deadlines">Deadlines & Payment</a> below),</li>
    							  <li>screen-capture images (see <a href="<?php echo $thisPage; ?>#screenSnapshots">Screen Snapshots</a> below).</li>
    					    </ul>
                </li>
                <li id="media">
    				      <p><span class="listItemTitle">Media.</span> Submit your video by publishing it at <a href="http://vimeo.com" target="vimeo">Vimeo</a>. It's free, easy to join, easy to create and upload an MP4 video, and it worked well for us last year.</p>
    				      <p>You can choose to make your video <span style="color:<?php echo $highlightTextColor;?>;">password-protected</span> on Vimeo if you don't want to share it with others besides us. Be sure to complete the Vimeo Web Address field on our online entry form. If the video is password-protected, be sure to complete the Vimeo Password field on the form as well.</p>
                  <p>Read the Vimeo <a href="http://vimeo.com/help/compression" target="vimeo">compression guidelines</a> to ensure that you submit a high quality rendition at an appropriate data rate. Aside from specifying codec, frame rate, data rate, resolution, and audio, the page has links to brief informative tutorials for over three dozen editing and compression applications including, for example, iMovie, Final Cut Pro, Adobe Premier, Avid Media Composer, and Sorenson Squeeze.</p>
                  <p>There are a variety of Vimeo &quot;Settings&quot; that you can manage. <span style="color: <?php echo $highlightTextColor; ?> ">Be sure to check the box to &quot;Allow other people to download the source video&quot; (<a href="onlineEntryForm/vimeoDownloadabilityInfo.php" target="vimeo">detailed instructions</a>).</span>  Choose password-protected if you like - just make sure you tell us the password on your Sans Souci online entry form.</p>
                </li>
                <li id="deadlines"><span id="payment"></span><span id="deadlinesAndPayment"></span>
    				      <p><span class="listItemTitle">Deadlines &amp; Payment.</span> Uploads to Vimeo must be initiated before midnight on the deadline date; payment must be submitted via paypal or postmarked by the deadline date. The entry fee applies to each video submitted.</p>
                  <?php echo HTMLGen::getFormattedDeadlineTable(); ?>
    				      <p>Make your check or money order (in US Dollars drawn on a US bank) payable to Sans Souci Festival of Dance Cinema OR, preferably, pay via PayPal from the <a onClick="javascript:goBackToEntryForm();">entry form</a>.If paying by check or money order, mail it to:</p>
    		  			  <blockquote class="entryRequirementsParagraph" style="margin:10 0 6 40;color:<?php echo $quaternaryTextColor; ?>;"><?php echo SSFRunTimeValues::getMailEntryToAddress();?></blockquote>
    	  				  <p>Please include your email address and your film title so that the payment gets credited for your entry.</p>
                </li>
                <li id="screenSnapshots">
                  <p><span class="listItemTitle">Screen Snapshots.</span> We select one of your screen snapshots to illustrate your work in our programs (e.g. <a href="<?php echo $samplePrintProgram; ?>" target="vimeo">PDF</a> &amp; <a href="<?php echo SSFWebPageParts::getHostName(); ?>/programPages/<?php echo $recentProgramPage; ?>" target="vimeo">www</a>). They should have the same pixel dimensions and aspect ratio as your movie frame and may be submitted via email to images@sanssoucifest.org or via a web address that you specify on the online entry form.</p>
                </li>
              </ol>
            </section>
  
<!--  	        <div style="text-align:right;font-size:12px;margin:0;"><a class="dodeco" href="<?php echo $thisPage; ?>#entryForm" onClick="javascript:goBackToEntryForm();">back | go to Online Entry Form</a></div> -->

            <section>
              <h2 id="further">Further Information</h2>
              <ul>
                <li id ="criteria">
    				      <p><span class="listItemTitle">Acceptance Criteria.</span> When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Art-oriented shorts under 16 minutes are strongly preferred. Short documentaries may be considered.</p>
    				      <!-- Documentaries and animations will be considered. -->
    				      <p>Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</p>
                </li>
                <li id ="exhibition">
    				      <span class="listItemTitle">Exhibition.</span> Accepted works will be screened <?php echo $eventDescriptionLong; ?>
    					    <p>Additionally, with your permission, your work may tour to other venues around the U.S. and elsewhere.</p>
                </li>
                <li id ="livePerformance">
                  <p><span class="listItemTitle">Submissions for multimedia works that incorporate a live performance</span> along with cinema must also include video of the live performance for evaluation. Email us for <a href='mailto:liveperformance@sanssoucifest.org'>questions about live performance submissions</a>.  Unfortunately, we have no funds to support artist travel. If your work includes live performance and you would need to travel to get to Boulder, be prepared to cover your expenses.</p>                
                </li>
                <li id ="communications">
                  <p><span class="listItemTitle">Communications.</span> We use a variety of email addresses that all end in <i>@sanssoucifest.org</i>. To ensure that you receive emails from us, we suggest that you clear our domain name, <i>sanssoucifest.org</i>, in your email spam filters.</p>
                </li>
                <li id ="questions">
                  <p style="margin-bottom:25px;"><span class="listItemTitle">Questions.</span> 
                    Direct questions or feedback to <a class="dodeco" href="mailto:questions@sanssoucifest.org">questions@sanssoucifest.org</a>.</p>
                </li>
              </ul>
            </section>

          </article>

<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
