<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $currentYearString = SSFRunTimeValues::getCurrentYearString();
  $callForEntriesId = SSFRunTimeValues::getCallForEntriesId();
  $associatedEventId = SSFRunTimeValues::getAssociatedEventId();
                      // date('l, M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $finalDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getFinalDeadlineDateString()));
  $earlyDeadlineString = date('M j, Y', strtotime(SSFRunTimeValues::getEarlyDeadlineDateString()));
//  $eventDatesDescriptionString = SSFRunTimeValues::getEventDatesDescriptionStringShort($associatedEventId);
  $eventDescriptionLong = SSFRunTimeValues::getEventDescriptionStringLong(SSFRunTimeValues::getAssociatedEventId($callForEntriesId)); // 3/19/14
//  $venueDescriptionString = SSFRunTimeValues::getVenueDescriptionString($associatedEventId);
  $entryRequirementsInWindowFilename = 'entryRequirementsInWindow' . $currentYearString . '.php';
  $entryRequirementsInWindowPath = 'onlineEntryForm/' . $entryRequirementsInWindowFilename;
  $onlineEntryFormFilename = 'entryForm' . $currentYearString . '.php';
  $onlineEntryFormPath = 'onlineEntryForm/' . $onlineEntryFormFilename;
  
  // As of 4/11/13, this is completely generalized except for possibly changing the image (See "CHANGE IMAGE HERE" below) or the descriptive text.

  // Initialize the image display.
  // 2011
  $linkToURLFromImage = 'programPages/programAtlas2011.php';
  $imagePath = 'images/Stills2011/11-110-Melt-NoemieLafrance356x200.jpg';
  $imageAltTitle = 'Frame from "MELT" (2010), directed by Noémie Lafrance, produced by Natalie Galazka';
  $imageHeight = '200px';
  $imageWidth = '356px';
  $imageCaption = '<span style="font-size:12px;">a frame from MELT (2010),</span><br>directed &amp; choreographed by Noémie Lafrance, produced by Natalie Galazka';
  // 2013
  $linkToURLFromImage = 'programPages/programAtlas2012.php';
  $imagePath = 'images/Stills2012/12-048-BeyondTheSurface-HelenCrocker356x204.jpg';
  $imageAltTitle = 'photo by Kevin Clifford from "Beyond The Surface," 2011, directed by Marie-Louise Flexen and Kevin Clifford, produced by Gloucestershire Dance, choreography by Marie-Louise Flexen';
  $imageHeight = '204px';
  $imageWidth = '356px';
  $imageCaption = '<div style="font-size:12px;margin-bottom:1px;">photo by Kevin Clifford from "Beyond The Surface," 2011</div>directed by Marie-Louise Flexen and Kevin Clifford,<br>produced by Gloucestershire Dance, choreography by Marie-Louise Flexen</div>';
  // 2014
  $linkToURLFromImage = 'programPages/programAtlas2012.php';
  $imagePath = 'images/AnaBaerTheBridge2010-450x167.jpg';
  $imageAltTitle = 'frame from The Bridge, 2010, created by Ana Baer &amp; Caren McCaleb';
  $imageHeight = '167px';
  $imageWidth = '450px';
  $imageCaption = '<span style="font-size:12px;margin-bottom:1px;">frame from "The Bridge," 2010, created by Ana Baer &amp; Caren McCaleb</span>';
  // 2015
  $linkToURLFromImage = 'programPages/programAtlas2014.php';
  $imagePath = 'images/Stills2014/14-070-More-Daniel+ErikaBeahmBig.jpg';
  $imageAltTitle = 'frame from More, 2013, produced by Teahm Beahm';
  $imageHeight = '211px';
  $imageWidth = '375px';
  $imageCaption = '<span style="font-size:12px;margin-bottom:1px;">frame from "<a href=\'http://teahmbeahm.com/more/\'>More</a>," 2013, produced by Teahm Beahm</span>';
  
  // Final Image
  $imageWithAnchor = "<a href='" . $linkToURLFromImage . "'><img src='" . $imagePath . "' alt='" . $imageAltTitle . "' title='" . $imageAltTitle . "' style='width:" . $imageWidth . ";height:" . $imageHeight . ";margin:20px 0 4px 35px;border:none;vertical-align:top;'></a>";

  // Initialize useful PHP display variables.
  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();
?>
          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              .contentArea article section h2 { color:<?php echo $tertiaryTextColor; ?>; }
              .contentArea article h1 { color:<?php echo $primaryTextColor; ?>; }
              .contentArea article:not(.screeningProgram) section { margin-right:70px;padding-top:0; }
              ul { margin:0 0 0 48px; }
              ul li { font-size:13px; line-height:1.3;  }
              .contentArea article section p:first-of-type { margin-top:0px; padding-top:0px; }
              .bodyText, .bodyTextUnleaded { padding:2px 40px 0px 0px; text-align:left; }
              .page { background-image: none; }

            </style>

            <h1><?php echo $contentTitle; ?></h1>
  
<!-- Overview -->
            <section class="dodeco" id="overview" style="margin-top:0;">
              <h2 style="margin-top:10px;margin-bottom:7px;">Overview</h2>
              <div class="bodyText"><p>The Sans Souci Festival of Dance Cinema invites submissions of 1) film and video works that integrate dance and cinematography and 2) mixed-media works that include both cinema and live performance. We encourage submissions from all artists regardless of credentials and affiliations. When choosing works we consider thoughtful forms and themes,  innovative approaches, and other <a href="#criteria">curatorial criteria</a>.</p></div>
              <div id="imageAndCaption">
                <div><?php echo $imageWithAnchor; ?></div>
                <div class="bodyText" style="font-size:11px;margin:0px 0 30px 38px;padding-bottom:0;text-align:left;line-height:120%"><?php echo $imageCaption; ?></div>
              </div>
            </section>

<!-- What & When -->
            <section class="dodeco" id="when">
              <h2 style="margin-top:10px;margin-bottom:7px;">What &amp; When</h2>
              <div class="bodyTextUnleaded">
                <p>Deadlines for submission are <?php echo $earlyDeadlineString . ' and ' . $finalDeadlineString ?>.</p>
                <p>Accepted works will be exhibited <?php echo $eventDescriptionLong; ?> <!-- There should be a '</p>' here, but the validator doesn't like it. -->
              </div>
            </section>
            
<!-- How To -->
            <section class="dodeco" id="how">
              <h2 style="margin-top:10px;margin-bottom:7px;">How to Submit</h2>
              <div class="bodyTextUnleaded">
                <p class="dodeco primaryTextColor">Please read the
                   <a href="javascript:void(0)" onClick="entryRequirementsWindow=window.open('<?php echo $entryRequirementsInWindowPath; ?>',
                     'EntryRequirementsWindow','directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=850,height=640',false);
                     entryRequirementsWindow.focus();">Entry Information &amp; Requirements</a> <span style="color:ffff99;font-size:15px;">for details regarding submission</span>.
                </p>
                <p class="dodeco">Sign in to submit an <a href="./<?php echo $onlineEntryFormPath; ?>">entry form</a>.</p>
                <p class="dodeco"><a href="<?php echo $onlineEntryFormPath; ?> ">Sign in</a> to modify your entry or pay the entry fee via Paypal&nbsp;<img src="images/logos/PayPal_mark_37x23.gif" alt="PayPal logo" style="border:none;margin:0;padding:0;vertical-align:-30%;">.</p>
              </div>
            </section>

<!-- Curatorial Criteria -->
            <section class="dodeco" id="criteria">
              <h2 style="margin-top:24px;margin-bottom:7px;">Curatorial Criteria</h2>
              <div class="bodyText"><p>When choosing works for exhibition and installation we consider thoughtful forms and themes, investigative / innovative / experimental approaches, production values, audience appeal, and how the piece will fit with or complement others we are considering. None of these criteria is a must; none are more important than the others; excellence in any one or two areas may be sufficient for acceptance. Art-oriented shorts under 16 minutes are strongly preferred. Short documentaries may be considered.<br><br>Note that we are not interested in simple recordings of dance on a proscenium stage &#8212; cinematic elements must be an integral part of the entry.</p>
              </div>
            </section>

<!-- Support -->
            <section class="nodeco" id="support">
              <h2 style="margin-top:24px;margin-bottom:7px;">Support</h2>
              <div class="bodyTextUnleaded" style="margin:0 auto;padding:2px 40px 0px 5px;text-align:center;">This year Sans Souci is supported<br><span>by and in partnership with</span><br></div>
              <div class="bodyTextUnleaded" style="margin:0 auto;padding:12px 40px 20px 5px;text-align:center;">
                the <a href="http://www.colorado.edu/atlas/">ATLAS Institute</a> <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a>,<br>
                the <a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a>, and<br>
                the <a href="http://www.colorado.edu/TheatreDance/">Department of Theater &amp; Dance</a>,<br>
                all at the <a href="http://www.colorado.edu">University of Colorado at Boulder</a>;<br><br>
                and also <span>by and in partnership with</span><br>
                <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>;<br>
                and <a href="http://www.thedairy.org/">Dairy Center for the Arts</a>.
              </div>
<!--
              <div class="bodyText" style="margin:12px auto 0 auto;padding:0;text-align:center;">with funding from<br><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission logo" style="width:156px;height:35px;margin:3px 0;"></a><br>an agency of the Boulder City Council;</div>
              <div class="bodyText" style="margin:12px auto 0 auto;padding:0;text-align:center;">by and in partnership with<br>
                <a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>;
              </div>
              <div class="bodyText" style="margin:12px auto 0 auto;padding:0;text-align:center;">and by and in partnership with <a href="http://www.thedairy.org/">Dairy Center for the Arts</a>.</div>
-->
            </section>
          </article>
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
