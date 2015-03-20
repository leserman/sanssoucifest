<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Define values that may be used below.
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString())); 'l' is weekday, e.g.,, Friday
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $danceCinemaCallFilename = 'danceCinemaCall' . $currentYearString . '.php';
  $entryFormFilename = 'entryForm' . $currentYearString . '.php'; 
  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
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
              #homePage div { margin-left: 31px; margin-right: 130px; margin-top: 20px; border: 1px dashed orange; border: none; }`
            </style>
            
            <div style="margin-top:0px;">
            <h1><?php echo $contentTitle; ?></h1>
              <p class="centeredText" style="font-style:italic;margin-top:0px">is a niche film festival specializing in dance cinema<br>and incorporating live performance.</p>
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
            <section>
              <h2>Call for Entries</h2>
<!--
                <p class="centeredText">If you'd like to receive notice of our 2015 Call for Entries in April,<br>please <a href="mailto:<?php echo $listManagementEmailAddress ?>?<?php echo $emailSubjectAndBody; ?>">click here</a> to be added to our email mailing list.</p>
-->
              <p class="centeredText">If you'd like to receive notice of our 2015 Call for Entries in April,<br>please <a href="./contactUs.php">click here</a> to be added to our email mailing list.</p>
            </section>

<!-- Curatorial Criteria -->
            <section>
              <h2>Curatorial Criteria</h2>
              <p class="leftJustifiedText">
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
