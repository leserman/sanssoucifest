<!DOCTYPE html>
<?php 
   include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
  //SSFProgramPageParts::addCssInlineStyleDefinition('table { padding:0;margin:0;border-collapse:collapse; }');  
  
  /* Local PHP variables for use on this page. Example: $phpVar1 = 'Hi there.'; Within HTML use: <?php echo $phpVar1; ?> // Remember to pre-process URLs. */
//  $onlineTicketsURL = 'https://tickets.thedairy.org/online/default.asp?doWork::WScontent::loadArticle=Load&amp;BOparam::WScontent::loadArticle::article_id=7F250C59-ABB3-4821-A4C2-859087D9BDBD';

/*
  $emptyImageDefaultHeightInPixels = '131';
  $emptyImageDefaultWidthInPixels = '180';
*/
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();

  // Initialize useful PHP variables.
  $programHighlightColor = SSFWebPageParts::getProgramHighlightColor();
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();
  $eventId = SSFWebPageParts::getProgramPageEventId();
  $filename = SSFWebPageParts::getFilename();
?>
            <article id="<?php echo $filename; ?>" class="eventHeader"> <!-- <div id="outerDiv" style="text-align:left;margin:10px 30px 10px 0px;"> -->
              <style type="text/css" scoped>
                .paperTitle, .paperAuthor { color:<?php echo $secondaryTextColor; ?>; font-size:15px; line-height:95%; font-weight:bold; font-style:normal; }
                .paperTitle { font-style:italic; }
                .titleAuthor { color:<?php echo $primaryTextColor; ?>; font-weight:normal; padding:20px 0 0 0; }
                .container { color:<?php echo $quaternaryTextColor; ?>; font-size:15px; font-weight:normal; font-style:normal; margin:0px 16px 24px 20px; }
                .bodyCopy { color:black; font-size:14px; font-weight:normal; font-style:normal; line-height:130%; padding:8px 50px 4px 2px; }
                li.bodyCopy { color:<?php echo $primaryTextColor; ?>; padding:0px 5px 4px 0px; margin-left:40px; list-style-type:disc; line-height:140%; }
                .subTitle { color:<?php echo $secondaryTextColor; ?>; font-size:20px; margin:20px 0 0px 0; font-weight:bold; font-style:italic; }
                .headerLine2 { font-size:14px; }
                #indent { padding-left:31px; padding-right:100px; }
                .freeAdmissionSpan { font-size:16px; color:<?php echo $quaternaryTextColor; ?>}
              </style>

              <h1 style="color:<?php echo $primaryTextColor; ?>"><?php echo $contentTitle; ?></h1>
              <h2 class="secondaryTextColor">Atlas
                <span class="nodeco"><a style="font-size:18px;font-weight:bold;color:<?php echo $secondaryTextColor; ?>" href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a></span>
                <span class="programInfoText tiny dodeco"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">directions</a></span><br>
                <span class="headerLine2">University of Colorado at Boulder, Boulder, CO, USA</span>
              </h2>
              <!-- ATLAS Institute, Black Box Studio, lower level B2<br>University of Colorado at Boulder, 1125 18th St.<br>Boulder, CO 80309-0320 -->
        		  <div class="bodyText" style="padding:16px 0pt 0px;text-align:left;">
          		  <a href="programPages/programAtlas2010.php">Detailed Program</a>&nbsp;&nbsp;&nbsp;&nbsp;
        		    <a href="./scheduleAtlas2010.php">Full Schedule</a>
        		  </div>
        		  <div class="programInfoText small" style="font-size:13pt;margin-top:14px;margin-bottom:0px;line-height:24px;">Saturday, 
        		    Sept. 11, 11:00 a.m. to 12:30 p.m.<br>Black Box Studio</div>
              <div class="programInfoText small freeAdmissionSpan" style="font-size:11pt;color:<?php echo $quaternaryTextColor; ?>;padding-top:1px;font-weight:normal;">Free admission.</div>

              <div id="indent">
                <div class="subTitle">Overview</div>
                <div class="bodyCopy" style="padding:4px 20px 4px 6px;">Each of four panelists will discuss research on dance, cinema and media for 20 minutes followed by an open question and answer session.</div>
                <ul>
                  <li class="bodyCopy"><em><a href="programPages/scholarlyPanelAtlas2010.php/#laban">A look through the Laban Lens at Nine Variations on A Dance Theme</a></em>, <a href="programPages/scholarlyPanelAtlas2010.php/#cowart">Corrie Franz Cowart</a>, Muhlenberg College</li>
                  <li class="bodyCopy"><em><a href="programPages/scholarlyPanelAtlas2010.php/#hills">The Hills are Alive (with Dancing Bodies): Dance for Camera as Environmetal Activism</a></em>, <a href="programPages/scholarlyPanelAtlas2010.php/#mcgauhey">Lyndia McGauhey</a>, University of Colorado at Boulder</li>
                  <li class="bodyCopy"><em><a href="programPages/scholarlyPanelAtlas2010.php/#myth">Re-embodying Myth: Looking for Her-storical accuracy in the Neo-Western</a></em>, <a href="programPages/scholarlyPanelAtlas2010.php/#french">Joy French</a>, University of Montana</li>
                  <li class="bodyCopy"><em><a href="programPages/scholarlyPanelAtlas2010.php/#forgetting">Seeing is Forgetting the Name of the Thing one Sees*, or Connoisseurship in Screendance.</a></em>, <a href="programPages/scholarlyPanelAtlas2010.php/#rosenberg">Douglas Rosenberg</a>, University of Wisconsin at Madison</li>
                </ul>
                <div class="subTitle">Abstracts</div>
            
                <div id="laban" class="container">
                  <div class="titleAuthor" style="padding-top:12px;">
                    <span class="paperTitle">A look through the Laban Lens at Nine Variations on A Dance Theme,</span> 
                    <a href="programPages/scholarlyPanelAtlas2010.php/#cowart">Corrie Franz Cowart</a>, Muhlenberg College
                  </div>
                  <div class="bodyCopy">In filmdance multiple moving components are at play: the moving body, the moving camera and the edit. Laban Movement Analysis (LMA) provides a valuable tool through which to examine these distinct moving components. LMA helps to address the paradigm shifts these elements can facilitate within the overall movement experience.</div>
                  <div class="bodyCopy">The classic short filmdance, "Nine Variations on a Dance Theme," by Hillary Harris is an ideal vehicle for this inquiry because Harris begins with a relatively straightforward documentation of a single movement sequence performed by Paul Taylor Dancer, Bette de Jong. This dance sequence remains constant and what changes is the camera and editing approach to the movement event. The opportunity to contrast the overall experience of these variations, while being able to identify the changing cinemagraphic tools in relation to the Laban Movement Analysis Lens of B.E.S.S. (Body, Effort, Shape and Space), provides valuable insight into how the camera and the edit contribute to the creation of "Energy" within a filmdance. In this film there is an observable shift away from the actions of the body as the primary focus, to the life and actions created by the camera and the edit. The issue of the dancers agency can therefore be addressed, and the transformation of the dancer into a 'site,' a terrain for the moving camera to explore, can also be observed.</div>
                  <div class="bodyCopy">Addressing the question of what is dancing in filmdance may change the rules of debate surrounding the definition of filmdance.</div>
                  <div id="hills" class="titleAuthor">
                    <span class="paperTitle">The Hills are Alive (with Dancing Bodies): Dance for Camera as Environmetal Activism,</span> 
                    <a href="programPages/scholarlyPanelAtlas2010.php/#mcgauhey">Lyndia McGauhey</a>, University of Colorado at Boulder
                  </div>
                  <div class="bodyCopy">Dance cinema introduces landscapes impossible to capture on the concert stage, introducing the site as an essential character.</div>
                  <div class="bodyCopy">In Queens for a Day, six dancers tumble down the remote hillsides of the Swiss Alps, engaging in an intimate and athletic exchange with a stunning landscape, dancing perfectly in tune with the contour of the mountainside. Directed by Pascal Magnin, Queens for a Day is a collaborative dance for camera, involving the choreographic talents of the dancers and the participation of the local villagers. Magnin sets up a democracy among all active players: the individual dancers, the hillside, the villagers, the backdrop, and even the cows are essential to the piece's meaning. Queens for a Day is an egalitarian piece, celebrating the holistic values of the modern environmental movement.</div>
                  <div class="bodyCopy">By introducing landscape and natural beauty as an essential part of the human experience, Magnin's work reflects environmentalism present in our culture, with scientific, political, and mystic significance.</div>
                  <div id="myth" class="titleAuthor">
                    <span class="paperTitle">Re-embodying Myth: Looking for Her-storical accuracy in the Neo-Western</span>, 
                    <a href="programPages/scholarlyPanelAtlas2010.php/#french">Joy French</a>, University of Montana
                  </div>
                  <div class="bodyCopy">The birth of the cinema pulled onto the screen two iconic images: the dancing body and the moving train.</div>
                  <div class="bodyCopy">The Lumi&eacute;re Brothers' specifically defined themselves with movies such as "L'Arrivee d'un train en gare de La Ciotat" and "The Serpentine Dance". After the success of these short, early films, the train and the dancing girl did not fade. Instead they found a longer enduring presence in American Western filmography. As Westerns wax and wain in popular cinema trends, the strength of American mythical West (and the thus the train and dancing girl imagery) never fully disappears.</div>
                  <div class="bodyCopy">In this paper I will discuss how the imagery of early cinema directly fed into the vernacular of Western films and how dance is uniquely featured as a cultural centerpiece of these works. I will then attempt to enlighten how the arena of contemporary dance-cinema might continue to directly relate to the Western mythography and the embodiment of her-story in American cinema. I will particularly focus on contemporary dance piece, "Improvement Club" by Dayna Hanson.</div>
                  <div id="forgetting" class="titleAuthor">
                    <span class="paperTitle">Seeing is Forgetting the Name of the Thing one Sees*, or Connoisseurship in Screendance.</span> 
                    <a href="programPages/scholarlyPanelAtlas2010.php/#rosenberg">Douglas Rosenberg</a>, University of Wisconsin at Madison
                  </div>
                  <div class="bodyCopy">Screen dance suffers from a lack of identity and by extension, the audience that attends festival screenings and the like, do so with a multiplicity of competing desires. The screen itself is a space upon which is projected the often competing desires of the audience. Complicating this is the way in which art-works at the intersection of dance and media are described: screendance, dance film, video dance, all terms that imply a unique relationship between distinct practices, which if correctly applied, have particulairity and specificity.</div>
                  <div class="bodyCopy">The festival screening model dominates the way in which screendance circulates and is received by audiences. However festivals are not transparent, neutral disseminators of content. They are formed with the desires of funding agencies, managers, directors and others engaged with the process of creating a venue for the audience to view screendance.</div>
                  <div class="bodyCopy">Behavior is learned, spectatorship is learned and the behavior of spectators is largely a phenomena of the behavior of the host institution. In other words, one performs one's role as audience based on the set of circumstances set forth by the institution. If the institution (for instance) promotes screendance as an extension of dance practice ie, dance on film, then the audience will self-select and patrons seeking dance as they historically understand it will attend, expecting the dance they desire on the screen at which they are looking. Furthermore, as festivals do not generally differentiate between genres of dance or genres of screendance, the possibilities of connoisseurship in audiences is greatly diminished.</div>
                  <div class="bodyCopy">Connoisseurship then, the phenomena in which literacy grows through the collaborative efforts of curators, makers and finally audience members and patrons is the desired outcome of any art form. Screendance audiences as any audiences can only react to what is offered for their consumption.</div>
                  <div class="bodyCopy">This paper will address how connoisseurship may be achieved through the collaborative efforts of audience, curator and institution.</div>
                  <div class="bodyCopy">*Lawrence Weschler's 1982 book, Seeing is Forgetting the Name of the Thing one Sees, explores the work of West Coast conceptual artist Robert Irwin.</div>
                </div><!-- container -->
            
                <div class="subTitle">Panelists</div>
                <div class="container">
                  <div id="cowart" class="titleAuthor" style="padding-top:12px;"><span class="paperAuthor">Corrie Franz Cowart,</span> Muhlenberg College</div>
                  <div class="bodyCopy">
                    <img src="images/Stills2010/CorrieCowart.jpg" style="width:120px;height:150px;padding:0 16px 10px 0;float:left;vertical-align:top;" alt="Corrie Cowart">
                    Corrie Franz Cowart is an Assistant Professor of Dance at Muhlenberg College and holds a BFA from Cornish College of the Arts, an MFA from the University of Oregon, and a CMA in Laban Movement Analysis. She has taught at the University of Oregon, Lane Community College, and Western Oregon University. Ms. Cowart has performed with the Mary Miller Dance Company, LABCO Dance Company, Minh Tran and Dancers, Dance Theatre of Oregon, the Pittsburgh Opera, and both nationally and internationally with Impact Production's Dayuma and the Masterpiece. Cowart continues to dance, choreograph and make video dance for Co-Art Dance which she co-directs with husband Tim Cowart.
                  </div>
                  <div id="french" class="titleAuthor"><span class="paperAuthor">Joy French,</span> University of Montana</div>
                  <div class="bodyCopy">
                    <img src="images/Stills2010/JoyFrench.jpg" style="width:120px;height:150px;padding:0 16px 10px 0;float:left;vertical-align:top;" alt="Joy French">
                    Joy French is an Adjunct Professor at the University of Montana in Missoula. She received her MFA at The University of Colorado-Boulder where she discovered a passion in screen-dance and multimedia performance. She has also been seduced by the western landscape and has been working creatively across the West for a number of years. The convergence of these interests first aligned as she focused her 2009 thesis on the white-european, female documentarians of American West history, from the mid-19th century to present day.
                  </div>
                  <div id="mcgauhey" class="titleAuthor"><span class="paperAuthor">Lyndia McGauhey,</span> University of Colorado at Boulder</div>
                  <div class="bodyCopy">
                    <img src="images/Stills2010/LyndiaMcGauhey.jpg" style="width:120px;height:150px;padding:0 16px 10px 0;float:left;vertical-align:top;" alt="Lyndia McGauhey">
                    Lyndia McGauhey is an art and outdoor enthusiast, practicing and studying dance in its endless shapes and sizes. Currently pursuing her BFA in Dance, McGauhey is also completing a degree Environmental Studies, International Policy. At the University of Colorado at Boulder, McGauhey trains in modern, hip-hop, African, ballet, and jazz. She has performed for several graduate and undergraduate students, as well as CU Faculty and professionals such as Rennie Harris, Heidi Henderson, and Erika Randall. A Colorado native, an ardent recycler, an improviser and a choreographer, McGauhey is exploring an innovative, movement-based approach to saving the world.
                  </div>
                  <div id="rosenberg" class="titleAuthor"><span class="paperAuthor">Douglas Rosenberg,</span> University of Wisconsin at Madison</div>
                  <div class="bodyCopy">
                    <img src="images/Stills2010/DouglasRosenberg.jpg" style="width:120px;height:150px;padding:0 16px 10px 0;float:left;vertical-align:top;" alt="Douglas Rosenberg">
                    Douglas Rosenberg is the recipient of the prestigious 2002 Phelan Art Award in Video. He is well-known for his collaborations with Molissa Fenley, Sean Curran, Joe Goode, Li Chiao-Ping and others. Recent honors include fellowships from, the Project on Death in America, funded by the Soros Foundation, the Wisconsin Arts Board (Fellwship in Performance), Isadora Duncan Dance Award (IZZIE), Bay Area Dance Coalition for his work with Ellen Bromberg on Singing Myself A Lullaby. His work has been funded by the NEA, the Zellerbach Foundation and the Rockefeller Foundation. His numerous residencies include: The Institute for Studies in The Arts, and the International Festival of Video Dance in Buenos Aires, Argentina and recently STARLAB Institute, Brussels and the Video Danza Mostra, Barcelona. Recent shows include, Video Festival Riccionne Teatro Televisione, Riccione, Italy, The Contemporary Art Museum in Buenos Aires, Dance on Camera Festival, NY, Mostra de V&iacute;deo Dansa de Barcelona, Spain, The Video Place, London, Brooklyn Museum of Art, New York and Moving Pictures Festival of Video Dance, Toronto. He also coordinated the Dance for the Camera Symposium in February, 2000, at the University of Wisconsin-Madison. <a href="http://www.dvpg.net/">Web site</a>, <a href="http://www.dvpg.net/mov/DouglasRosenbergWEB.mov">Autobiographical video</a>
                  </div> 
                </div> <!-- container -->
              </div> <!-- indent -->
            </article>
              
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
</html>
