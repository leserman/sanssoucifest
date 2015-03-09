<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 
  
  SSFWebPageParts::allowRobotIndexing(false);   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('Snippets 3/4/15');  // This is the official HTML head title. It appears in the tab.
  SSFWebPageParts::setContentTitleText('<div style="color:#FFFF99; text-align:center;margin-top:16px;">Snippets from index.php as of 3/4/15</div>');  // The is the title of the page in the Content Area.
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
	SSFWebPageParts::addCssInlineStyleDefinition('body { background-color:black; background-image:none; }');  
//	SSFWebPageParts::addCssInlineStyleDefinition('.page { background-color:#333333; background-image:none; }');  
//	SSFWebPageParts::addCssInlineStyleDefinition('.pageArea { background-color:#333333; background-image:none; }');  
//	SSFWebPageParts::addCssInlineStyleDefinition('.contentArea { background-color:#333333; background-image:none; }');  
	SSFWebPageParts::addCssInlineStyleDefinition('.before2015 { background-color:#333333; background-image:none; margin:0 auto; text-align:center; border: red 1px solid; width:550px; }');  
	SSFWebPageParts::addCssInlineStyleDefinition('table { margin:0 auto; text-align:center; border: blue 1px solid; }');  
	SSFWebPageParts::addCssInlineStyleDefinition('header { background-color:#333333; background-image:none; }');  

  echo SSFWebPageParts::getHtmlLine();
  echo SSFWebPageParts::getHeader();
  echo SSFWebPageParts::beginPageBody();
  echo SSFWebPageParts::beginContentHeader();
  echo SSFWebPageParts::endContentHeader();

?>

<!-- 2014 -->
<!-- Boulder, 2014 -->
                      <tr>
                        <td align="center" valign="middle" class="programInfoText" style="padding-top:0px;">
                          <div class="hideLinkUnderline">
                            <div class="homeHeading1" style="margin-top:44px;margin-bottom:6px;">Recent Programs</div>
                            <!-- event list Recent Programs  -->

                          <!-- 2014 Festivities Section -->
                          <div style="margin-top:22px;text-align:center;">
                                                    
                            <!-- 2014 Festivities Headline -->
<!--                            <div class="homeHeading1" style="margin:0;font-size:18;">Coming soon</div> -->
                            <div class="homeHeading1" style="margin-top:7px;font-size:20px;line-height:normal;">11th Annual Festivities</div>
                            <div class="homeHeading1" style="margin-top:3px;font-size:18px;line-height:normal;">September &amp; October, 2014</div>                            
                            <div class="homeHeading1" style="margin-top:4px;font-size:16px;line-height:normal;">Boulder, Colorado, USA</div>
<!--                      	    <div style="font-size:18px;margin-top:4px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                      	      <span class="bodyTextOnBlack" style="font-size:15px;font-weight:normal;line-height:19px;">Five unique programs at three venues:<br><a href="#atlas">CU Atlas Black Box</a>,  <a href="#boe">The Boe</a>, <a href="#bpl">Canyon Theater</a></span>
                      	   </div> -->
                      	    <div class="bodyTextOnBlack" style="font-size:15px;margin:4px 0;line-height:19px;">Five unique programs at three venues:<br><a href="#atlas">CU Atlas Black Box</a>,  <a href="#boe">The Boe</a>, <a href="#bpl">Canyon Theater</a>
                      	   </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                              <a href="./programPages/programAtlas2014.php"><img src="images/Stills2014/SSF2014PostcardFront403x312.jpg" alt="Click here to view program." title="Click here to view program." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;"></a>
                            </div>
                            <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                              <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;"><span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>&quot;<a href="./programPages/programBoe2014.php#work_14-076">The Bridge</a>&quot; (2010), Caren McCaleb &amp; Ana Baer
                            </div>
                              <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">Download the postcard PDF: 
                                <a href="./PDF/Postcards/SSF2014PostcardFront.pdf">front</a>, <a href="./PDF/Postcards/SSF2014PostcardBack.pdf">back</a>
                              </div>

                    		    <!-- Poster download -->
                            <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:8px 0 0 0;padding:0;"><a href="./PDF/Posters/SSF2014AtlasPromoPoster.pdf">Download the 11x17" Promo Poster PDF</a></div>
                            <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:0;padding:0;"><a href="./PDF/PressReleases/SansSouciPressRelease_2014.pdf">Download the Press Release PDF</a></div>



                            <!-- Atlas -->
                            <div class="atVenue" id="atlas">
                              <div class="homeHeading1" style="margin:0;font-weight:bold;font-size:15px;">Friday &amp; Saturday, September 5 &amp; 6
                              </div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;"><a href="http://atlas.colorado.edu/wordpress/?page_id=102">Atlas Building</a>,
                        	      <span class="programInfoTextSmall">University of Colorado at Boulder</span>
                        	    </div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;">Different <a href="./programPages/programAtlas2014.php">programs</a> each evening
                        	    </div>
                              <div class="bodyTextLeadedOnBlack" style="margin-top:2px;">View the Program <a href=". /programPages/programAtlas2014.php">online</a>
                               or in <a href="./PDF/ProgramSpreads/SSF2014ProgramSpreadsAtlas.pdf">print</a> format (PDF)
                            </div>

                            <!-- Boe -->
                            <div class="atVenue" id="boe">
                              <div class="homeHeading1" style="margin:0;font-weight:bold;font-size:15px;">Sundays, September 21 &amp; October 19</div>
                              <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Different <a href="./programPages/programBoe2014.php">programs</a> on each date</div>
                        	    <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Boedecker Theater, Dairy Center for the Arts</div>
                            </div>

                            <!-- BPL / Canyon Theater -->
                            <div class="atVenue" id="bpl">
                              <div class="homeHeading1" style="margin:0;font-weight:bold;font-size:15px;">Monday, October 6</div>
                              <div style="font-size:15px;margin-top:2px;margin-bottom:0px;font-weight:normal;">Canyon Theater, <a href="http://boulderlibrary.org/">Boulder Public Library</a></div>
                            </div>

                            </div>
                          
                            <!-- Funded by -->
                      		  <div class="atVenue" style="width:90%;font-size:14px;margin:20px auto 2px auto;line-height:120%;color:#E49548;font-weight:normal;text-align:center;">
                      		    <div style="margin:0 auto 8px auto;text-align:center;border:0px red solid;">All above partially funded by</div>
                      		    <div style="margin:0 auto 0 auto;text-align:center;border:0px yellow solid;">
                        		    <div style="margin:0 auto 0 auto;text-align:center;width:345px;border:0px green dashed;">
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://www.artsresource.org/bac/"><img src="../images/logos/BAC_High_Horizontal1_logo_156x35.jpg" alt="Boulder Arts Commission" style="width:156px;height:35px;margin:5px 0 5px 0;"></a>
                          		    </div>
                          		    <div style="float:left;padding-top:15px;border:0px pink dashed;">&nbsp;&nbsp;and&nbsp;&nbsp;</div>
                          		    <div style="float:left;font-size:13px;border:0px pink dashed;"><a href="http://bouldercountyarts.org"><img src="../images/logos/BCAA-color-logo-6_11.jpg" style="width:145px;height:45px;margin-top:0px;" alt="Boulder County Arts Alliance"></a>
                          		    </div>
                          		    <div style="clear:both;"></div>
                        		    </div>
                      		    </div>
                      		  </div>
                      		                        		    
                          </div> <!-- END 2014 Festivities Section -->
                    		
                    		</div> <!-- END div class hideLinkUnderline -->
                    		
                    		                            <div class="homeHeading1" style="margin-top:26px;font-size:18px;line-height:normal;">Other Recent Programs</div>                            

                            <!-- Roxy 2014-12 -->
                            <div class="homeHeading1" style="margin-top:8px;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, December 5 &amp; 6, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="/programPages/programRoxy2014-12.php">Kinetoscope at the Roxy, Dec., 2014</a><br><span style="font-size:14px;">Co-sponsored by <a href=" http://barebaitdance.org/">Bare Bait Dance</a> in Missoula, MT, USA</span>
                            </div>

                          </div>
                        </td>
                      </tr>


<!-- Upcoming Programs -->
<div class='before2015'>
                    <table>
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:40px;margin-bottom:8px;">Upcoming Events</div>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">
                            Roxy 
                            <div class="bodyTextLeadedOnBlack">
                        	    <div style="font-size:16px;margin-top:8px;margin-bottom:0px;font-weight:normal;"><span style="font-size:20px;color:#E49548;">The Roxy,</span> Missoula MT</div>
                              <div class="homeHeading1" style="margin:7px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:17px;">Friday &amp; Saturday, December 5 &amp; 6</div>
                              <div style="font-size:15px;margin-top:4px;margin-bottom:0px;font-weight:normal;">Two <a href="./programPages/programRoxy2014-12.php">programs</a> on each date</div>
                            </div>
                        </td>
                      </tr>
                    </table>

<!-- Donate  -->
                    <table>
                      <tr>
                        <td align="center" valign="middle">
                          <div class="homeHeading1" style="margin-top:40px;margin-bottom:8px;">Seasonal Plea</div>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">
                            <div class="bodyTextLeadedOnBlack">
                              <div class="bodyTextLeadedOnBlack" style='line-height:145%;float:left;margin:7px 0px 10px 70px;border:0px solid blue;text-align:left;width:240px;'>If you're so inclined, please make a tax-deductible <a href='https://www.fracturedatlas.org/site/fiscal/profile?id=8028'>donation</a> through our fiscal sponsor, Fractured Atlas. Your gift will help sustain us as we move forward into our twelfth year.
                              </div>
                              <div style='float:left;margin-right:0px;border:0px solid blue;'><a href='https://www.fracturedatlas.org/site/fiscal/profile?id=8028'><img src='images/logos/FracturedAtlas-logo.png' alt='Fractured Atlas logo' style='width:174px;height:120px;align-left;'></a>
                              </div>
                              <div style='clear:both;'></div>
                            </div>
                        </td>
                      </tr>
                    </table>
                    
                            <!-- Guatemala 2014 -->
                            <div class="homeHeading1" style="margin:14px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Thursday, June 5, 2014, 11:00 AM
                            </div>
                            <div style="font-size:16px;margin-top:0px;margin-bottom:0px;color:#FFFF99;font-weight:normal;line-height:1.3;"><a href="http://sanssoucifest.org/programPages/programGuatemala2014.php">Universidad de San Carlos de Guatemala</a><br>
                              <span style="font-size:14px;">Departamento de Danza de la Escuela Superior<br>Guatemala City, Guatemala</span>
                            </div>

                            <!-- AtticRep 2014 -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, March 28 &amp; 29, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://www.atticrep.org/">Attic<i>Rep</i></a> - <a href="/programPages/programAtticRep2014.php">Celebrating the past &bull; Investing in the Future</a><br><span style="font-size:14px;">at <a href=" http://bluestarartscomplex.com/">Blue Star Arts Complex</a> in San Antonio, TX, USA</span>
                            </div>

                            <!-- Roxy 2014 -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">
                              Friday &amp; Saturday, March 7 &amp; 8, 2014
                            </div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;"><a href="http://www.theroxytheater.org/">The Roxy</a> - <a href="/programPages/programRoxy2014.php">Kinetoscope at the Roxy</a><br><span style="font-size:14px;">Co-sponsored by <a href=" http://barebaitdance.org/">Bare Bait Dance</a> in Missoula, MT, USA</span>
                            </div>

                            <!-- 10th Annual Festivities -->
                            <div class="homeHeading1" style="margin:16px 0 0px 0;color:#FFFF99;font-weight:bold;font-size:14px;">10th Annual Festivities, Fall 2013</div>
                            <div style="font-size:16px;margin-top:2px;margin-bottom:0px;color:#FFFF99;font-weight:normal;">Boulder, Colorado, USA</div>
                            <!-- Headline detail line -->
                            <div style="font-size:18px;margin-top:4px;margin-bottom:4px;color:#CCC;font-weight:bold;">
                              <span style="font-size:15px;font-weight:normal;line-height:1.4;">Featuring four different programs:<br>
                              &mdash; <a href="./programPages/programOverview2013.php">Overview</a> &mdash;<br>
                              <a href="./programPages/programAtlas2013.php">September</a>,  <a href="./programPages/program2013FallDates.php#show59">October</a>,  <a href="./programPages/program2013FallDates.php#show60">November</a>, <a href="./programPages/program2013FallDates.php#show61">December</a></span>
                            </div>

<!-- Postcard -->
                            <div>
                              <div class="bodyTextLeadedOnBlack" style="margin:0px 0;">
                                <a href="./programPages/programOverview2013.php"><img src="images/Stills2013/SSF2013PostcardFront403x312.jpg" alt="Click here to view program overview." title="Click here to view program overview." width="403" height="312" border="0" style="margin:8px 0 0 -2px;border:solid #000 1px;"></a>
                              </div>
         <!-- postcard caption -->
                              <div class="bodyTextLeadedOnBlack" style="margin:3px 0;">
                                <div class="bodyTextLeadedOnBlack" style="font-size:14px;margin:6px 0 0 0;padding:0;line-height:130%;">
                                  <span style="font-size:13px;color:#CCC;">postcard with a frame from</span><br>
                                  "Outside in" (2011), Tove Skeidsvoll &amp; Petrus Sj&ouml;vik, Sweden
                                </div>

                                <div class="bodyTextLeadedOnBlack" style="font-size:13px;margin:2px 0;padding:0;color:#CCC;">
                                  thi PDF: <a href="./PDF/Postcards/SSF2013PostcardFront.pdf">front</a> 3.5 MB, <a href="./PDF/Postcards/SSF2013PostcardBack.pdf">back</a> 3.4 MB
                                </div>
                              </div>
</div>

<?php
  echo SSFProgramPageParts::endPageBody();
?>

</html>
