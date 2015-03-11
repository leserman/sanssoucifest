<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS */
  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('Memorabilia');  // This is the official HTML head title. It appears in the tab.

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
	SSFWebPageParts::addCssInlineStyleDefinition('.pageArea .contentArea { background-color:#333333; margin-left:10px; padding-left:31px; }');
	 
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
?>

<!-- Mappings from file system names to web site document names (where different):

  Programs
  sanssouci_program2006.pdf     ->   SSF2006Program.pdf
  SansSouciProgramApril2005.pdf ->   SSF2005Program.pdf
  
  Posters
  SansSouci 8-27-11_1fini.pdf        -> SSF2011AtlasPromoPoster.pdf
  SansSouciFest2010PosterCmprssd.pdf -> SSF2010PRPoster.pdf
  SansSouci_CallForScholarlyProposals_Poster2010.pdf -> SSF2010CallForScholarlyProposalsPoster.pdf
  SansSouci_CallForScreenDanceEntries_Poster2010.pdf -> SSF2010CallForScreenDanceEntries.pdf
  SSF-PosterDairy2009.pdf            -> SSF2009PromotionalPoster.pdf
  SSFCallForEntriesPoster2008-2.pdf  -> SSF2008CallForEntriesPoster.pdf
  SSFCallForEntriesPoster2007-1.pdf  -> SSF2007CallForEntriesPoster.pdf
  2012InstallationsPosterLandscape-2.pdf -> SSF2012InstallationsPoster.pdf

  Postcards  
  SansSouciFest2010PostcardFront.pdf -> SSF2010PostcardFront.pdf
  SansSouciFest2010PostcardBack.pdf  -> SSF2010PostcardBack.pdf
  SSF-postcard-4x5-front-2009.pdf    -> SSF2009PostcardFront.pdf
  SSF-postcard-4x5-back-2009.pdf     -> SSF2009PostcardBack.pdf
  SSF-Postcard-B-2008-forPrint.pdf   -> SSF2008PostcardFront.pdf
  SansSouciPostcard-2007.pdf         -> SSF2007PostcardFront.pdf
  SanSouciPostcardFront-2004.pdf     -> SSF2004PostcardFront.pdf
  SanSouciPostcardBack-2004.pdf      -> SSF2004PostcardBack.pdf
  
-->

          <article id="memorabilia" style="width:650px;">

            <style type="text/css" scoped>
              .page article a:link, a:visited { color: #CCBD99; text-decoration: underline; }
              .page article a:hover { color: #bd0425; text-decoration: none; }
              th { text-align: center; vertical-align: middle; font-size:16px; color: #EEEECC; }
            </style>

            <h1 style="color:#0593d6;margin-top:12px;margin-bottom:12px;">Memorabilia</h1>

            <table style="border:none;margin:0;margin-top:15px;padding:0;width:100%;">
              <tr style="padding:15px 0 0 0;">
                <td class="topLeft">
                  <table style="border:none;margin:2;padding:2;width:98%;text-align:center;">
                    <tr>
                      <th scope="col">Festival</th>
                      <th scope="col">Posters</th>
                      <th scope="col">Postcards</th>
                      <th scope="col">Programs</th>
                    </tr>
    
                    <tr> <!-- 2013 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:0px;margin-top:10px;margin-bottom:10px;vertical-align:middle;border-right:solid #666 1px;height:80%;"><div style="padding:130% 0;">2013</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;">
                        <!-- Promo Poster -->
                        <a href="../PDF/Posters/SSF2013AtlasPromoPoster.pdf"><img src="./memorabilia/thumbnails/2013AtlasPromoPoster.jpg" height="101" width="155" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2013AtlasPromoPoster.pdf">Atlas Promo</a> <span style="color:#999;padding-top:1px;">Poster (3 MB)</span><br>
                       </div>
                      </td>
                      <!-- Postcard -->
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2013PostcardFront.pdf"><img src="./memorabilia/thumbnails/2013PostcardFront.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2013PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(3.4 MB)</span><br><a href="../PDF/Postcards/SSF2013PostcardBack.pdf"><img src="./memorabilia/thumbnails/2013PostcardBack.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2013PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(3.4 MB)</span></div></td>
                      <!-- Program -->
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2013ProgramSpreads.pdf"><img src="./memorabilia/thumbnails/2013ProgramThumb.jpg" height="126" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2013ProgramSpreads.pdf">12 pp</a> <span style="color:#999;padding-top:1px;">(3 MB)</span></div></td> 
                    </tr>
    
                    <tr> <!-- 2012 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:180% 0;">2012</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;">
                        <!-- Promo Poster -->
                        <a href="../PDF/Posters/SSF2012AtlasPromoPoster.pdf"><img src="./memorabilia/thumbnails/2012AtlasPromoPoster.jpg" height="100" width="155" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2012AtlasPromoPoster.pdf">Atlas Promo</a> <span style="color:#999;padding-top:1px;">Poster (3.4 MB)</span><br>
                        <!-- Installations Poster -->
                        <a href="../PDF/Posters/SSF2012InstallationsPoster.pdf"><img src="./memorabilia/thumbnails/2012InstallationsPoster.jpg" height="93" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2012InstallationsPoster.pdf">Installations Program</a><br><span style="color:#999;padding-top:1px;">Poster (1 MB)</span><br>
                       </div>
                      </td>
                      <!-- Postcard -->
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2012PostcardFront.pdf"><img src="./memorabilia/thumbnails/2012PostcardFront.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2012PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(0.9 MB)</span><br><a href="../PDF/Postcards/SSF2012PostcardBack.pdf"><img src="./memorabilia/thumbnails/2012PostcardBack.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2012PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(0.4 MB)</span></div></td>
                      <!-- Program -->
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2012ProgramSpreads.pdf"><img src="./memorabilia/thumbnails/2012ProgramThumb.jpg" height="127" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2012ProgramSpreads.pdf">12 pp</a> <span style="color:#999;padding-top:1px;">(1.8 MB)</span></div></td> 
                    </tr>
    
                    <tr> <!-- 2011 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:350% 0;">2011</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;">
                        <a href="../PDF/Posters/SSF2011AtlasPromoPoster.pdf"><img src="./memorabilia/thumbnails/2011AtlasPromoPoster.jpg" height="97" width="155" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2011AtlasPromoPoster.pdf">Atlas Promo</a> <span style="color:#999;padding-top:1px;">(1.2 MB)</span><br>
                        <a href="../PDF/Posters/SSF2011AtlasWallProgramPosters.pdf"><img src="./memorabilia/thumbnails/2011AtlasWallProgramPosters.jpg" height="156" width="97" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2011AtlasWallProgramPosters.pdf">Video Wall Program<br>Poster</a> <span style="color:#999;padding-top:1px;">(.3 MB)</span><br>
                        <a href="../PDF/Posters/SSF2011BoulderPublicLibraryPoster.pdf"><img src="./memorabilia/thumbnails/2011BoulderPublicLibraryPoster.jpg" height="150" width="97" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2011AtlasWallProgramPosters.pdf">Boulder Public Library<br>Poster</a> <span style="color:#999;padding-top:1px;">(2.2 MB)</span>
                        </div>
                      </td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2011PostcardFront.pdf"><img src="./memorabilia/thumbnails/2011PostcardFront.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2011PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(0.9 MB)</span><br><a href="../PDF/Postcards/SSF2011PostcardBack.pdf"><img src="./memorabilia/thumbnails/2011PostcardBack.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2011PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(0.4 MB)</span></div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2011ProgramSpreads.pdf"><img src="./memorabilia/thumbnails/2011Program.jpg" height="127" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2011ProgramSpreads.pdf">16 pp</a> <span style="color:#999;padding-top:1px;">(2.6 MB)</span></div></td> 
                    </tr>
                    <tr> <!-- 2010 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:320% 0;">2010</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;">
                        <a href="../PDF/Posters/SSF2010CallForScreenDanceEntries.pdf"><img src="./memorabilia/thumbnails/2010CallForFilmsPoster.jpg" height="155" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2010CallForScreenDanceEntries.pdf">Call for Films</a> <span style="color:#999;padding-top:1px;">(2.7 MB)</span><br>
                        <a href="../PDF/Posters/SSF2010CallForScholarlyProposalsPoster.pdf"><img src="./memorabilia/thumbnails/2010CallForPapersPoster.jpg" height="155" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2010CallForScholarlyProposalsPoster.pdf">Call for Papers</a> <span style="color:#999;padding-top:1px;">(2.2 MB)</span><br>
                        <a href="../PDF/Posters/SSF2010PRPoster.pdf"><img src="./memorabilia/thumbnails/2010PromoPoster.jpg" height="79" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2010PRPoster.pdf">Promotional</a> <span style="color:#999;padding-top:1px;">(5.0 MB)</span>
                        </div>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2010PostcardFront.pdf"><img src="./memorabilia/thumbnails/2010PostcardFront.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2010PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(1.3 MB)</span><br><a href="../PDF/Postcards/SSF2010PostcardBack.pdf"><img src="./memorabilia/thumbnails/2010PostcardBack.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2010PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(1.0 MB)</span></div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2010ProgramSpreads.pdf"><img src="./memorabilia/thumbnails/2010Program.png" height="127" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2010ProgramSpreads.pdf">24 pp</a> <span style="color:#999;padding-top:1px;">(2.6 MB)</span></div></td>
                    </tr>
                    <tr> <!-- 2009 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:90% 0;">2009</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Posters/SSF2009PromotionalPoster.pdf"><img src="./memorabilia/thumbnails/2009PromotionalPosterThumb.jpg" height="155" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2009PromotionalPoster.pdf">Promotional</a> <span style="color:#999;padding-top:1px;">(0.4 MB)</span><br></div></td> 
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2009PostcardFront.pdf"><img src="./memorabilia/thumbnails/2009PostcardFront.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2009PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(1.5 MB)</span><br><a href="../PDF/Postcards/SSF2009PostcardBack.pdf"><img src="./memorabilia/thumbnails/2009PostcardBack.jpg" height="57" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2009PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(0.2 MB)</span></div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2009ProgramSpreads.pdf"><img src="./memorabilia/thumbnails/2009Program.png" height="124" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2009ProgramSpreads.pdf">16 pp</a> <span style="color:#999;padding-top:1px;">(4.8 MB)</span></div></td>
                    </tr>
                    <tr> <!-- 2008 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:90% 0;">2008</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Posters/SSF2008CallForEntriesPoster.pdf"><img src="./memorabilia/thumbnails/2008CallForEntriesPoster.jpg" height="155" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2008CallForEntriesPoster.pdf">Call for Entries</a> <span style="color:#999;padding-top:1px;">(4.2 MB)</span></div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2008PostcardFront.pdf"><img src="./memorabilia/thumbnails/2008PostcardFront.jpg" height="78" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2008PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(3.2 MB)</span></div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2008ProgramSpreadsColor.pdf"><img src="./memorabilia/thumbnails/2008Program.png" height="126" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2008ProgramSpreadsColor.pdf">8 pages</a> <span style="color:#999;padding-top:1px;">(0.3 MB)</span></div></td>
                    </tr>
                    <tr> <!-- 2006 & 2007 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:90% 0;">2006<br>2007</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Posters/SSF2007CallForEntriesPoster.pdf"><img src="./memorabilia/thumbnails/2007CallForEntriesPoster.jpg" height="155" width="120" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Posters/SSF2007CallForEntriesPoster.pdf">Call for Entries</a> <span style="color:#999;padding-top:1px;">(4.8 MB)</span><br>2007</div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/Postcards/SSF2007PostcardFront.pdf"><img src="./memorabilia/thumbnails/2007PostcardFront.jpg" height="65" width="84" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2007PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(8.7 MB)</span><br>2007</div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding:0px;margin:8px 0;"><a href="../PDF/ProgramSpreads/SSF2006Program.pdf"><img src="./memorabilia/thumbnails/2006Program.png" height="124" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/ProgramSpreads/SSF2006Program.pdf">4 pages</a> <span style="color:#999;padding-top:1px;">(0.4 MB)</span><br>2006</div></td>
                    </tr>
                    <tr> <!-- 2004 & 2005 -->
                      <th class="middleCenter bodyTextOnDarkGray" scope="row" style="margin:6px 0;padding-top:0px;"><div style="padding-top:-20px;margin-top:10px;margin-bottom:20px;vertical-align:middle;border-right:solid #666 1px;height:100%;"><div style="padding:90% 0;">2004<br>2005</div></div></th>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding-top:0px;margin:2px 0 8px 0;">&nbsp;</div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding-top:0px;margin:2px 0 8px 0;"><a href="../PDF/Postcards/SSF2004PostcardFront.pdf"><img src="./memorabilia/thumbnails/2004PostcardFront.jpg" height="50" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2004PostcardFront.pdf">Front</a> <span style="color:#999;padding-top:1px;">(9.2 MB)</span><br><a href="../PDF/Postcards/SSF2004PostcardBack.pdf"><img src="./memorabilia/thumbnails/2004PostcardBack.gif" height="50" width="74" alt="" style="padding:10px 0 6px;border:0"></a><br><a href="../PDF/Postcards/SSF2004PostcardBack.pdf">Back</a> <span style="color:#999;padding-top:1px;">(9.1 MB)</span><br>2004</div></td>
                      <td class="middleCenter"><div class="smallBodyTextOnBlack" style="padding-top:0px;margin:2px 0 8px 0;"><a href="../PDF/ProgramSpreads/SSF2005Program.pdf"><img src="./memorabilia/thumbnails/2005Program.png" height="128" width="82" alt="" style="padding:10px 0 6px;border:0"></a><br> <span style="color:#999;padding-top:1px;"><a href="../PDF/ProgramSpreads/SSF2005Program.pdf">4 pages</a> (0.2 MB)</span><br>2005</div></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
    

          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
