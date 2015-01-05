<!DOCTYPE html>
<?php 
  include_once './bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
  SSFWebPageParts::initializePage(__FILE__); 

  /* UPDATE THESE ITEMS */
    SSFWebPageParts::setContentColumnCount(1);
    SSFWebPageParts::disallowRobotIndexing(); // default is to allow robot indexing
    SSFWebPageParts::setPageHeaderTitleText('About Us');
    SSFWebPageParts::setPageHeaderTitleTextAlignment('topLeft'); // default is topLeft
    
  echo SSFWebPageParts::beginHTML();
  echo SSFWebPageParts::htmlHeadContent(); 
?>
    <style type="text/css"> /* CSS inline style definitions intended for this page only go here. */
      p { width:430px; } 
      p:first-of-type { margin-top:4px; }
      div.content { margin:10px 0 36px 0;}
/*      div { color:#FFFF99;margin:20px 0 -4px 0;font-size:16px;font-weight:bold; } */
      li { margin-bottom: 3px; margin-left: 20px; padding-left: 6px; }
      ul { margin-left: 0; }
    </style>
<?php 
  echo SSFWebPageParts::cssMediaQueries(); 
  echo SSFWebPageParts::endHead();
  echo SSFWebPageParts::beginPageBody();
  echo SSFWebPageParts::beginContentHeader();
?>
<!-- 26 spaces         -->
                          <div class="content">
                            <p style="margin-left:20px;padding-left:0;"><a href="#beginnings">Beginnings</a>&nbsp;&nbsp;<a href="#vision">Vision</a>&nbsp;&nbsp;<a href="#mission">Mission</a>&nbsp;&nbsp;<a href="#history">History</a>&nbsp;&nbsp;<a href="#directors">Directors</a>&nbsp;&nbsp;<a href="#founders">Founders</a></p>
                            <p style="margin:16px 12px 0 20px;">With an expansive definition of <i>dance</i> and an appreciation for highly experimental and interdisciplinary forms, this unique festival exposes diverse audiences to a variety of film, video, and performance possibilities.</p>
                            <div class="sectionTitle" id="beginnings">Beginnings
                              <p>Sans Souci (meaning &quot;without concern&quot;) was conceived one fine spring day in 2003 when Michelle Ellsworth and Brandi Mathis sat  on the porch of a 1967 Marlette Mobile home in the Sans Souci Trailer Park in  Boulder Colorado musing about the pleasures of viewing and creating dances for the screen. Quickly Boulder Museum of Contemporary Art (BMoCA) and the <img src="images/daisycrunchgraphic.jpg" alt="Our daisy-eating icon" style="width:75px;height:74px;float:right;margin:13px;">University of Colorado at Boulder <a href="http://www.colorado.edu/TheatreDance/">Department of Theatre and Dance</a>, as well as artists Ana Baer and Hamel Bloom, added their support to transform mere musing into an Festival of Dance Cinema.</p>
                              <p>What was first envisioned as an informal gathering of local dance video artists screening their works on a white wall in a trailer is now an international festival with submissions from all over the world.</p>
                            </div>
                            <div class="sectionTitle" id="vision">Vision
                              <p>We envision a world where many people are aware of dance cinema and many of them appreciate and enjoy the form. And a world where artists everywhere can get paid for their work, especially the dancers.</p>
                            </div>
                            <div class="sectionTitle" id="mission">Mission
                              <p>Our mission is two-fold.</p>
                              <ol style="margin-top:6px;">
                                <li class="bodyTextLeadedOnBlack">Attract, educate, and entertain an audience for this form.</li>
                                <li class="bodyTextLeadedOnBlack">Support the artists creating works in this form by providing audiences for their work.</li>
                              </ol>
                              <p>We seek to fulfill our mission in these ways:</p>
                              <ul style="margin-bottom:0;">                                
                                <li class="bodyTextLeadedOnBlack">Support new work that integrates dance with cinematic elements, both experimental and traditional.</li>
                                <li class="bodyTextLeadedOnBlack">Encourage an expansive definition of dance and encourage an appreciation for highly experimental and interdisciplinary forms, including mixed-media works that incorporate live performance.</li>
                                <li class="bodyTextLeadedOnBlack">Strive to slowly grow the festival each year with higher quality films and a larger, more satisfied audience.</li>
                                <li class="bodyTextLeadedOnBlack">Provide a forum for the evolving conversation between dance and cinema - celebrating both and their potential to cross-pollinate.</li>
                                <li class="bodyTextLeadedOnBlack">Show work in a professional and stress-free environment.</li>
                                <li class="bodyTextLeadedOnBlack">Bring the work of international artists to Boulder, Colorado.</li>
                                <li class="bodyTextLeadedOnBlack">Take the work of local artists to an international audience via the Sans Souci Tour.</li>
                                <li class="bodyTextLeadedOnBlack">Develop an appreciation and appetite in our audiences for dance-for-camera.</li>
                                <li class="bodyTextLeadedOnBlack">Provide support and feedback to our applicants.</li>
                                <li class="bodyTextLeadedOnBlack">Snacks &ndash; always free snacks at all of our screenings.</li>
                              </ul>
                            </div>
                            <div class="sectionTitle" id="history">History in a Nutshell
                              <p>With ten years of annual festivals behind us, Sans Souci has exhibited 317 works submitted by about 200 artists from countries all over the world, including: Armenia, Australia, Belgium, Canada, Denmark, Finland, France, Germany, Hungary, Mexico, Netherlands, Norway, Portugal, Scotland, South Korea, Spain, Sweden, Switzerland, Turkey, UK, and USA. Our international tours have brought works to Mexico (2004, 2006 &amp; 2012), Germany (2007 &amp; 2009), Spain (2010), and Trinidad &amp; Tobago (2004).</p>
                              <p>Highlights &amp; Milestones:
                              <ul>
                                <li class="bodyTextLeadedOnBlack">2004 - 1st annual festival at BMoCA. Tour in Mexico.</li>
                                <li class="bodyTextLeadedOnBlack">2005 - 2nd annual festival at BMoCA.</li>
                                <li class="bodyTextLeadedOnBlack">2006 - Fleshed out web site. Tour in Mexico.</li>
                                <li class="bodyTextLeadedOnBlack">2007 - Added online entry & automated assistance for curation. Tour in Germany.</li>
                                <li class="bodyTextLeadedOnBlack">2008 - Tour events in Los Angeles and Texas.</li>
                                <li class="bodyTextLeadedOnBlack">2009 - Brought multimedia performance-artist/dancer from Finland.</li>
                                <li class="bodyTextLeadedOnBlack">2010 - Presented a Scholarly Panel of dance-film artists. Tour in Spain.</li>
                                <li class="bodyTextLeadedOnBlack">2011 - Held multiple screenings at two distinct venues.</li>
                                <li class="bodyTextLeadedOnBlack">2012 - Survived without financial support.</li>
                                <li class="bodyTextLeadedOnBlack">2013 - Screened 5 distinct programs at 3 venues.</li>
                                <li class="bodyTextLeadedOnBlack">2014 - Tour at the Roxy in Missoula MT.
                              </ul>
                              <img src="images/chartOfWorksSubmittedAndAccepted433x305.jpg" alt="Chart showing number of works submitted and accepted by year" style="border:0;width:433px;height:305px;margin-left:40px;">
                            </div>
                            <div class="sectionTitle" id="directors">Directors
                              <p style="margin-bottom:4px;margin-top:4px;">&nbsp;&nbsp;&nbsp;<a href="http://anabaer.com/">Ana Baer</a>, Artistic Co-Director<br>
                              &nbsp;&nbsp;&nbsp;<a href="www.tararynders.com">Tara Rynders</a>, Artistic Co-Director<br>
                              &nbsp;&nbsp;&nbsp;Hamel Bloom, Executive Director</p>
                            </div>
                            <div class="sectionTitle" id="founders">Founders
                              <p style="margin-bottom:4px;margin-top:4px;">&nbsp;&nbsp;&nbsp;<a href="http://michelleellsworth.com">Michelle Ellsworth</a>, performer extraordinaire, Professor of Dance</p>
                              <p style="margin-bottom:4px;margin-top:4px;">&nbsp;&nbsp;&nbsp;Brandi Mathis, curator extraordinaire</p>
                            </div>
                          </div>


<?php
  echo SSFWebPageParts::endContentHeader();
  echo SSFWebPageParts::endPageBody();
  echo SSFWebPageParts::endHTML();
?>