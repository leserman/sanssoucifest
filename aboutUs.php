<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS */
/*
  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('About Us');  // This is the official HTML head title. It appears in the tab.
*/
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
/*
	SSFWebPageParts::addCssInlineStyleDefinition('p { width:500px; font-style:italic; }');
	SSFWebPageParts::addCssInlineStyleDefinition('p:first-of-type { margin-top:4px; }');
	SSFWebPageParts::addCssInlineStyleDefinition('.contentArea article section h2 { color:#973961;font-weight:bold; }');
	SSFWebPageParts::addCssInlineStyleDefinition('li { margin-bottom:3px; margin-left:20px; }');
	SSFWebPageParts::addCssInlineStyleDefinition('ul, ol { list-style-position:outside; font-style:italic; border:0px maroon dashed; }');
	SSFWebPageParts::addCssInlineStyleDefinition('ul { list-style-type: disc; padding-left:50px;  }');
	SSFWebPageParts::addCssInlineStyleDefinition('ol { list-style-type: decimal; padding-left:30px; }');
*/ 
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
?>
          <article id="<?php echo SSFWebPageParts::getArticleId(); ?>">

            <style type="text/css" scoped>
            	p { width:500px; font-style:italic; }
            	p:first-of-type { margin-top:4px; }
            	.contentArea article section h2 { color:<?php echo SSFWebPageParts::getPrimaryTextColor(); ?>; font-weight:bold; }
            	.contentArea article h1 { color:<?php echo SSFWebPageParts::getPrimaryTextColor(); ?> }
            	li { margin-bottom:3px; margin-left:20px; }
            	ul, ol { list-style-position:outside; font-style:italic; border:0px maroon dashed; }
            	ul { list-style-type: disc; padding-left:50px;  }
            	ol { list-style-type: decimal; padding-left:30px; }
            </style>

            <h1><?php echo SSFWebPageParts::getContentTitleText(); ?></h1> 
            <p style="margin:16px 0 16px 20px;font-style:normal;"><a href="./aboutUs.php/#beginnings">Beginnings</a>&nbsp;&nbsp;<a href="./aboutUs.php/#vision">Vision</a>&nbsp;&nbsp;<a href="./aboutUs.php/#mission">Mission</a>&nbsp;&nbsp;<a href="./aboutUs.php/#history">History</a>&nbsp;&nbsp;<a href="./aboutUs.php/#directors">Directors</a>&nbsp;&nbsp;<a href="./aboutUs.php/#founders">Founders</a></p>
            <p style="margin:16px 12px 0 20px;font-style:normal;width:550px;">With an expansive definition of <i>dance</i> and an appreciation for highly experimental and interdisciplinary forms, this unique festival exposes diverse audiences to a variety of film, video, and performance possibilities.</p>

            <section id="beginnings" class="primaryTextColor">
              <h2>Beginnings</h2>
              <p>Sans Souci (meaning &quot;without concern&quot;) was conceived one fine spring day in 2003 when Michelle Ellsworth and Brandi Mathis sat  on the porch of a 1967 Marlette Mobile home in the Sans Souci Trailer Park in  Boulder Colorado musing about the pleasures of viewing and creating dances for the screen. Quickly Boulder Museum of Contemporary Art (BMoCA) and the <img src="images/daisycrunchgraphic.jpg" alt="Our daisy-eating icon" style="width:75px;height:74px;float:right;margin:13px;">University of Colorado at Boulder <a href="http://www.colorado.edu/TheatreDance/">Department of Theatre and Dance</a>, as well as artists Ana Baer and Hamel Bloom, added their support to transform mere musing into an Festival of Dance Cinema.</p>
              <p>What was first envisioned as an informal gathering of local dance video artists screening their works on a white wall in a trailer is now an international festival with submissions from all over the world.</p>
            </section>

            <section id="vision">
              <h2>Vision</h2>
              <p>We envision a world where many people are aware of dance cinema and many of them appreciate and enjoy the form. And a world where artists everywhere can get paid for their work, especially the dancers.</p>
            </section>

            <section id="mission">
              <h2>Mission</h2>
              <p>Our mission is two-fold.</p>
              <ol>
                <li class="bodyText">Attract, educate, and entertain an audience for this form.</li>
                <li class="bodyText">Support the artists creating works in this form by providing audiences for their work.</li>
              </ol>
              <p style="padding-top:14px;padding-bottom:0px;">We seek to fulfill our mission in these ways:</p>
              <ul>                                
                <li class="bodyText">Support new work that integrates dance with cinematic elements, both experimental and traditional.</li>
                <li class="bodyText">Encourage an expansive definition of dance and encourage an appreciation for highly experimental and interdisciplinary forms, including mixed-media works that incorporate live performance.</li>
                <li class="bodyText">Strive to slowly grow the festival each year with higher quality films and a larger, more satisfied audience.</li>
                <li class="bodyText">Provide a forum for the evolving conversation between dance and cinema - celebrating both and their potential to cross-pollinate.</li>
                <li class="bodyText">Show work in a professional and stress-free environment.</li>
                <li class="bodyText">Bring the work of international artists to Boulder, Colorado.</li>
                <li class="bodyText">Take the work of local artists to an international audience via the Sans Souci Tour.</li>
                <li class="bodyText">Develop an appreciation and appetite in our audiences for dance-for-camera.</li>
                <li class="bodyText">Provide support and feedback to our applicants.</li>
                <li class="bodyText">Snacks &ndash; always free snacks at all of our screenings.</li>
              </ul>
            </section>

            <section id="history">
              <h2>History in a Nutshell</h2>
              <p>With ten years of annual festivals behind us, Sans Souci has exhibited 317 works submitted by about 200 artists from countries all over the world, including: Armenia, Australia, Belgium, Canada, Denmark, Finland, France, Germany, Hungary, Mexico, Netherlands, Norway, Portugal, Scotland, South Korea, Spain, Sweden, Switzerland, Turkey, UK, and USA. Our international tours have brought works to Mexico (2004, 2006 &amp; 2012), Germany (2007 &amp; 2009), Spain (2010), and Trinidad &amp; Tobago (2004).</p>
              <p style="padding-top:12px;padding-bottom:0px;">Highlights &amp; Milestones:
              <ul>
                <li class="bodyText">2004 - 1st annual festival at BMoCA. Tour in Mexico.</li>
                <li class="bodyText">2005 - 2nd annual festival at BMoCA.</li>
                <li class="bodyText">2006 - Fleshed out web site. Tour in Mexico.</li>
                <li class="bodyText">2007 - Added online entry & automated assistance for curation. Tour in Germany.</li>
                <li class="bodyText">2008 - Tour events in Los Angeles and Texas.</li>
                <li class="bodyText">2009 - Brought multimedia performance-artist/dancer from Finland.</li>
                <li class="bodyText">2010 - Presented a Scholarly Panel of dance-film artists. Tour in Spain.</li>
                <li class="bodyText">2011 - Held multiple screenings at two distinct venues.</li>
                <li class="bodyText">2012 - Survived without financial support.</li>
                <li class="bodyText">2013 - Screened 5 distinct programs at 3 venues.</li>
                <li class="bodyText">2014 - Tour at the Roxy in Missoula MT.
              </ul>
              <img src="images/chartOfWorksSubmittedAndAccepted433x305.jpg" alt="Chart showing number of works submitted and accepted by year" style="border:0;width:433px;height:305px;margin-left:40px;margin-top:20px;margin-bottom:7px;">
            </section>

            <section id="directors">
              <h2>Directors</h2>
              <p style="margin-bottom:4px;margin-top:4px;margin-left:16px;"><a href="http://anabaer.com/">Ana Baer</a>, Artistic Co-Director<br>
              <a href="www.tararynders.com">Tara Rynders</a>, Artistic Co-Director<br>
              Hamel Bloom, Executive Director</p>
            </section>

            <section id="founders">
              <h2>Founders</h2>
              <p style="margin-bottom:4px;margin-top:4px;margin-left:16px;">
                <a href="http://michelleellsworth.com">Michelle Ellsworth</a>, performer extraordinaire, Professor of Dance<br>
                Brandi Mathis, curator extraordinaire</p>
            </section>
            <br>

          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

