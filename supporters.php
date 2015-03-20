<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

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
              .yearsAtVenue { font-weight: normal; color:<?php echo $tertiaryTextColor; ?>; }
            </style>

            <h1  style="color:<?php echo $primaryTextColor; ?>;"><?php echo $contentTitle; ?></h1>

            <!-- Supporters -->
            <section>
              <h2 id="supporters">Supporters</h2>
              <p style="border:0px dashed pink;">
                <a href="http://www.bouldercountyarts.org/"><img src="images/logos/BCAA-GRN-logo200.gif" style="width:200px;height:73px;margin:0;border:none;vertical-align:top" alt="Boulder Country Arts Alliance - BCAA" title="Boulder Country Arts Alliance - BCAA"></a>
                <a href="http://www.artsresource.org/"><img src="images/logos/BAC-Low_Horizontal2.gif" style="width:200px;height:45px;margin:15px 0 0 18px;border:none;vertical-align:top" 
                          alt="Boulder Arts Commission" title="Boulder Arts Commission"></a>
              </p>
            </section>
            
              <!-- Partners -->
            <section>
              <h2 id="partners">Production Partners</h2>
					    <p><a href="http://theatredance.colorado.edu/dance/">Dance Division</a> of the <a href="http://www.colorado.edu/TheatreDance/">Theatre &amp; Dance Department</a>, at the <a href="http://www.colorado.edu/">University of Colorado at Boulder</a>
					    </p>
					    <p>Atlas <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a> at the University of Colorado at Boulder
					    </p>
					    <p><a href="http://www.colorado.edu/FilmStudies/">Film Studies Program</a> at the University of Colorado at Boulder
					    </p>
					    <p><a href="http://www.artsresource.org/dance-bridge/">Dance Bridge</a> and <a href="http://bplnow.boulderlibrary.org/event/movies">Boulder Public Library Cinema Program</a>
					    </p>
            </section>

					    <!-- Exhibited Artists & Works -->
            <section>
              <h2 id="artists">Contributing Artists &amp; Works</h2>
              <p>Links to exhibited artists and works can be found on the corresponding Festival and Tour Archive pages in our navigation bar to the left.</p>
            </section>
            					    
              <!-- Venues -->
            <section>
              <h2 id="venues">Venues</h2>
						  <p><span class="yearsAtVenue">2010&ndash;2015: </span>The primary venue for Sans Souci for the years 2010 through 2015 is the Black Box Theatre at the
						    Atlas <a href="http://www.colorado.edu/atlas/newatlas/amp/">Center for Media, Arts and Performance</a> at the University of Colorado at Boulder.
						  </p>
						  <p><span class="yearsAtVenue">2009, 2013-2015: </span><a href="http://thedairy.org//">The Dairy Center for the Arts</a> is a cultural arts complex in Boulder, Colorado, founded in 1992 and housed in the historic Watts-Hardy Dairy building. It features dramatic theater, live music, dance performances, and visual arts. Screenings for the 2013 through 2015 Festival Events are presented in the Dairy's <a href="http://www.thedairy.org/boedecker-theater2/">Boedecker Theater</a>. The Dairy's East Theater was the primary venue for our 2009 Festival. 
              </p>
						  <p><span class="yearsAtVenue">2004&ndash;2008: </span><a href="http://www.bmoca.org/">Boulder Museum of Contemporary Art, BMoCA</a>, originally called the Boulder Arts Center, was founded in 1972 to showcase and promote the visual arts in Boulder, Colorado. The museum is committed to providing local and regional artists, as well as recognized artists, 	with a significant venue. It is housed in an historic warehouse that now includes three galleries and a 100-seat black box theater. BMoCA hosted Sans Souci in the years 2004 through 2008.
              </p>
  					  <p><span class="yearsAtVenue">2011, 2013 &amp; 2014: </span>Canyon Theater at the <a href="https://boulderlibrary.org/">Boulder Public Library</a> is the venue for the City's Film Series.
    				  </p>
  					  <p><span class="yearsAtVenue">2008 &amp; 2010: </span>Founded in 1989, the mission of <a href="http://www.highwaysperformance.org/">Highways</a> is to
    					  cultivate art that expands the frontiers of aesthetic traditions.
    				  </p>
    				  <p><span class="yearsAtVenue">2013: </span>Here is a <a href="http://www.youtube.com/watch?v=nn_uPCZiXoo">video of Ana Baer describing the March 2013 event</a> sponsored by the <a href="http://www.theatreanddance.txstate.edu/dance.html">Dance Division</a> at <a href="http://www.txstate.edu/">Texas State University</a>, San Marcos.
    				  </p>
					    <p><span class="yearsAtVenue">2011-2014: </span><a href="http://atticrep.org/site/sans-souci/">AtticRep</a>, <a href="http://web.trinity.edu/">Trinity University</a>, San Antonio TX, USA.
					    </p>
            </section>

          </article>
          <br>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>
