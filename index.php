<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Define values that may be used below.
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
  $emailAddr = SSFRunTimeValues::getContactEmailAddress();
  $emailSubjectAndBody = urlencode("Add me to your email list&amp;body=Edit below as appropriate.%0A%0AAdd me to your email list for Events.%0AAdd me to your email list for Calls for Entries.%0ARemove me from your email list.%0A%0AFirst name: %0ALast name: %0ACountry of residence: %0AAnything else you'd like us to know: %0A");

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
?>

          <article id="homePage">
             
            <style type="text/css" scoped>
              .contentArea article h1 { margin-left:auto; margin-right:auto; text-align:center; }
              .contentArea #homePage h2 { font-size: 24px; line-height: 24px; font-weight: bold; margin:15px auto 0px auto; padding-top:3px; padding-bottom:0px; text-align:center; }
              .contentArea #homePage section p { padding-top: 0px; }
              .contentArea article section.call p { font-size:16px; text-align:center; padding-top: 8px; }
              #homePage div { margin-left: 31px; margin-right: 130px; margin-top: 20px; border: 1px dashed orange; border: none; }`
            </style>

<?php SSFHTMLError::displayHTMLErrorIfAny(SSFWebPageParts::getHostName(), $tertiaryTextColor); ?>

            <div class="centeredText" style="margin-top:0px;border:1px dashed purple;border:none;">
            <h1 style="text-align:center;"><?php echo $contentTitle; ?></h1>
              <p style="font-style:italic;margin-top:0px">is a niche film festival specializing in dance cinema<br>and incorporating live performance.</p>
            </div>

<!-- Demo Reel Link! -->
            <section>
              <h2 style="margin-top:24px;margin-bottom:7px;">Sample Reel</h2>
              <div class="centeredText" style="margin:0;">
                <a href="./demoreel/"><img src="images/Stills2014/14-083-Gaia-NickGraalman_DemoReelStill.jpg" width="240" height="135" alt="" style="text-align:center;border:8px black solid;"></a>
                <p style="padding:0;margin:4px 0 2px 0;">Frame from "Gaia" (2014)</p>
                <p style="padding:0;font-size:11px;">Nick Graalman & Erin Fowler</p>
                <p style="padding-top:0;margin-top:8px;"><a href="./demoreel/">View our 5-minute reel.</a></p>
              </div>
            </section>

<!-- 2015 Call for Entries -->
            <section class="call">
              <h2>Call for Entries</h2>
              <p class="call tertiaryTextColor" style="margin-top:6px;"><b>Sans Souci Festival of Dance Cinema<br>invites submissions of<br>works that integrate dance and cinematography</b></p>
              <p class="call" style="font-size:15px;margin-top:-2px;">for exhibition in Boulder, Colorado, USA <br><!--<?php echo $eventDatesDescriptionStringLong;?>-->in September, October, and November, 2015.</p>
              <p class="call"><span style="font-size:15px;"><i>We encourage submissions from all artists<br>regardless of credentials and affiliations.</i></span></p>
<!--              <p class="call tertiaryTextColor"><b>Deadlines: <?php echo $earlyDeadlineString . ' and ' . $finalDeadlineString; ?></b></p> -->
              <p class="call tertiaryTextColor"><b>Submission Deadline: <?php echo $finalDeadlineString; ?></b></p>
              <p class="call dodeco" style="font-size:15px;"><a href="<?php echo $danceCinemaCallFilename;?>">Read more</a> and <a href="onlineEntryForm/<?php echo $entryFormFilename;?>">submit an entry</a>.</p>
<!--              <div class="callForEntriesText"style="text-align:center;margin-top:0;padding-top:5;"><a href="danceCinemaCall2015.php">Read more</a></div> -->
<!--              <div class="homeHeading1" style="margin-top:8px;margin-bottom:-4px;font-size:18px;">Call for Entries Closed on May XX, 2015</div> -->
<!--              <div class="callForEntriesText topCenter" style="font-size:16px;"><i>Deadline this week: <?php echo $finalDeadlineString; ?></i></span></div> -->
<!--              <div class="callForEntriesText topCenter" style="font-size:20x;"><i><b>Closed</b></i><br><span class="bodyTextLeadedOnBlack">(The deadline was May XX.)</div> -->
            </section>

<!-- Screendance Journal  -->
            <section id='journal'>
              <h2><span style="font-style: normal">Being a Video-Choreographer</span><br>International Journal of Screendance</h2>
              <p class="centeredText">Ana Baer, our Artistic Co-Director, is published in current issue of The International Journal of Screendance, Vol. 5 (2015).</p>
              <p class="centeredText">Ana shares her views on creating and curating Dance Video in this article entitled <a class="dodeco" href="http://screendancejournal.org/article/view/4446/3841#.VVPT9NpVhBf"><i>Being a Video-Choreographer: Describing the Multifaceted Role of a Choreographer Creating Screendance</i></a>, coauthored with Heike Salzer of Tees Dance Film Fest.</p>
              <p class="centeredText"><img src="images/logos/TeesDanceFilmFestLogoPink.png" style="width:50px;height:50px;float:right;padding-top:3px;padding-left:8px;">The article is published in tandem with the <a class="dodeco" href="http://tdff.co.uk/">Tees Dance Film Fest</a> (UK, May 14, 2015) where many of the films cited in the article are screened. <a class="dodeco" href="programPages/programTeesUK2015.php">See the Sans Souci program.</a></p>
            </section>

<!-- Welcome to our new look  -->
            <section>
              <h2>Welcome to our new look</h2>
              <p class="centeredText">
                <img src="images/SSF-LoieFuller-Logo.png" class="bottomRight" style="width:98px;height:50px;margin:2px 6px 6px 6px;float:right;" alt="Sans Souci logo featuring Loie Fuller in 'La danse blanche'">We've just revamped the look of our website. The new site features a wider display with a brighter theme and will continue to evolve. If you have difficulties or comments, feel free to contact the webmaster at <a href="mailto:webdude@sanssoucifest.org">webdude@sanssoucifest.org</a>. View our <a class="dodeco" href="colophon.php">colophon</a> to read more about the new theme and logo. 
              </p>
            </section>

<!-- Curatorial Criteria -->
            <section>
              <h2>Curatorial Criteria</h2>
              <p class="centeredText">
                <span style="font-style:italic;">Curatorial Criteria:</span> We're interested in film and video works that integrate dance and cinematography. When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Shorts are preferred. Documentaries and animations will be considered. Note that we are not interested in simple recordings of dance on a proscenium stage &mdash; cinematic elements must be an integral part of the entry.
              </p>
            </section>

<!-- Film, Video, Camera, Cinema? -->
            <section>
              <h2>Film, Video, Camera, Cinema?</h2>
              <p class="leftJustifiedText">
                We thought about calling ourselves a <i>Dance Film Festival,</i> a <i>Video Dance Festival,</i> a <i>Dance Video Festival,</i> a <i>ScreenDance Festival</i>, or a <i>Dance for Camera Festival</i> but we settled on <i>Festival of Dance Cinema</i> because that seems to cover the bases best.
              </p>
            </section>
                        
          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>
