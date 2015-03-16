<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

//  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
//  SSFWebPageParts::setHeaderTitleText('SSF :: Resources');  // This is the official HTML head title. It appears in the tab.
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
//	SSFWebPageParts::addCssInlineStyleDefinition('p { margin-top:14px; }');  

  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
  
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();

?>
          <article id="<?php echo $articleId; ?>">

            <style type="text/css" scoped>
              p { margin-top:14px; }
            </style>

            <h1><?php echo $contentTitle; ?></h1>

            <section>
              <h2 style="font-size:16px;padding-bottom:9px;">We hope these resources are helpful to you if you'd like to learn more about dance film/video/cinema and screendance activities.</h2>

            <!-- Resources -->
  					  <p><a href="http://www.dancefilms.org/">Dance Films Association, DFA</a>, is dedicated to furthering the art of dance film. Of interest is their <a href="http://www.dancefilms.org/resources/other-dance-film-festivals/">listing of dance film festivals around the world</a> and their <a href="http://www.dancefilms.org/resources/dance-and-media-timeline/">Dance and Media Timeline</a>.</p>
    				  <p><a href="https://www.jiscmail.ac.uk/cgi-bin/webadmin?A0=MEDIA-ARTS-AND-DANCE">MEDIA-ARTS-AND-DANCE </a> is an email list and archive used by its members to announce and discuss theory, research, critical discourse, publications, conferences, networking and curatorial approaches in the field of screen based dance, including single screen cinema or television works, installation, and net based work. <!-- The list is maintained by Simon Fildes. --></p>
              <p><a href="http://journals.library.wisc.edu/index.php/screendance">The International Journal of Screendance</a> is a new (2010), international, artist-led journal exploring the field of Screendance. It is the first-ever scholarly journal wholly dedicated to this growing area of worldwide interdisciplinary practice.</p>
  					  <p>Katrina McPherson's <a href="http://www.makingvideodance.com/">Making Video Dance</a>, describes her book, a step by step guide to creating dance for the screen.</p>
    				  <p><a href="http://www.dance-tech.net/">DANCE-TECH.<i>NET,</i> Interdisciplinary explorations on the performance of motion</a>,
                is an international community of artists, scientists, theorists, and organizations exploring the intersection of performance, media, and culture.</p>
                
            </section>
          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>

