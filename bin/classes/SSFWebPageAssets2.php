<?php

class SSFWebPageAssets2 {

  private static $indent = '                ';

  public static function displayNavBar($moveUpString = '../') {
    echo getNavBar($moveUpString);
  }

  public static function getNavBar($moveUpString = '../') {
    $navBarString = '';
    $navBarString .= self::$indent . '<div class="narBarMainSection">' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a class="navBarLink" target="_top" href="' . $moveUpString . 'index.php">Home</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'demoreel/">Demo Reel</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'aboutUs.php">About Us</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'memorabilia/">Memorabilia</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'press/">Press Reports</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'links.php">Links</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'contactUs.php">Contact Us</a><br><a target="_top" href="' . $moveUpString . 'contactUs.php">Join Email List</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar" style="margin:4px 6px 0 0;"><a target="_top" title="find us on Facebook" href="http://www.facebook.com/sanssoucifest/"><img alt="follow me on facebook" src="//login.create.net/images/icons/user/facebook_30x30.png" style="border:0;"></a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar" style="margin:4px 6px 0 0;"><a href="https://www.fracturedatlas.org/site/fiscal/profile?id=8028" target="_top"><img src="' . $moveUpString . '/images/donateNowAtFracturedAtlas3.png" style="width:88px;height:70px;border:0;" alt="Donate now!"></a></div>' . PHP_EOL;

    $navBarString .=  self::$indent . '</div>' . PHP_EOL;
    
    $navBarString .= self::$indent . '<div class="narBarArchiveSection">' . PHP_EOL;

    $navBarString .= self::$indent . '  <div><div class="navBarTitle1" style="color:#e49548;">Current Events</div> <!--  style="color:#FFACAC;" -->' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programCU_DAM2014.php">CU D.A.M.</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBoe2014.php">The Boe</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;

    $navBarString .= self::$indent . '  <div><div class="navBarTitle2" style="color:#e49548;">Recent Events</div> <!--  style="color:#FFACAC;" -->' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="bodyTextOnBlack navBarTight" style="font-size:13px;padding-bottom:1px;">Boulder 2014</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div style="border-bottom:gray 1px solid;line-height:2px;width:75%;margin-bottom:4px;"></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBPL2014.php">Canyon Theater</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2014.php">Atlas Black Box</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programUrsinus2014.php">Ursinus College</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div style="border-bottom:gray 1px solid;line-height:2px;width:75%;margin-bottom:4px;"></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;

    $navBarString .= self::$indent . '  <div><div class="navBarTitle2" style="color:#e49548;">Festival Archive</div>' . PHP_EOL;

/*
    $navBarString .= self::$indent . '  <div><div class="navBarTitle1" style="color:#e49548;">Current Events</div> <!--  style="color:#FFACAC;" -->' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2012.php">Boulder<br>8/31 &amp; 9/1/2012</a></div>' . PHP_EOL;
    $navBarString .=  self::$indent . '  </div>' . PHP_EOL;
*/
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programOverview2013.php">Boulder 2013</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/program2013FallDates.php">Boulder Fall \'13</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2013.php">Atlas 2013</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2012.php">Boulder 2012</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2011.php">Boulder 2011</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2010.php">Boulder 2010</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programDairy2009.php">Boulder 2009</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2008.php">Boulder 2008</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2007.php">Boulder 2007</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2006.php">Boulder 2006</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/priorEventsSummary.php">2004/2005</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2" style="color:#e49548;">Tour Archive</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programGuatemala2014.php">Guatemala \'14</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtticRep2014.php">San Antonio \'14</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programRoxy2014.php">Missoula 2014</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . '' . 'http://atticrep.org/site/sans-souci/">San Antonio \'13</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programMorelia2012.php">Mexico 2012</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/SanAntonio2012.php">San Antonio \'12</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programACC2011.php">Austin 2011</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programSanAntonio2011.php">San Antonio \'11</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/barcelona2010.php">Barcelona 2010</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programHighways2010.php">LA 2010</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programGiessen2009.php">Giessen 2009</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programTXState2008.php">TX State 2008</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programHighways2008.php">LA 2008</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/GiessenServer2007.php">Germany 2007</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/MichoacanPress2006.php">Mexico 2006</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
/*
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2" style="color:#e49548;">Event Summary</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/priorEventsSummary.php">2004/2005</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
*/
    $navBarString .= self::$indent . '</div>' . PHP_EOL;
    return $navBarString;
  }

  public static function displayAdminNavBar($moveUpString = '../') {
    echo getAdminNavBar($moveUpString);
  }

  public static function getAdminNavBar($moveUpString = '../') {
    $navBarString = '';
    $navBarString .= self::$indent . '<div class="narBarMainSection">' . PHP_EOL;
    $navBarString .= self::$indent . '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'index.php">SSF Home</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '</div>' . PHP_EOL;
    $navBarString .= self::$indent . '<div class="narBarArchiveSection">' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle1">Administration</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBar"><a target="_top" href="' . $moveUpString . 'admin/index.php">Admin Home</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Admin Activities</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminDataEntry.php">Manage<br>People &amp; Works</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div style="line-height:1px;margin:3px auto;border-top:#666 thin solid;width:50%;"></div>';
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/submissionsOverviewReport.php">Track Submissions</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/informArtistsOfMediaReceipt.php">Acknowledge Media Rceipt</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminPaypalParse.php">Paypal Payments</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/paymentsReport.php">Track Payments</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div style="line-height:1px;margin:3px auto;border-top:#666 thin solid;width:50%;"></div>';
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/curationData.php">Curate</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/viewCurationProgress.php">Curation History</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/curationEmail.php">Send Curation Results Email</a></div>' . PHP_EOL; // was curationAccRejEmail
    $navBarString .= self::$indent . '    <div style="line-height:1px;margin:3px auto 2px auto;border-top:#666 thin solid;width:50%;"></div>';
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminPermissions.php">Manage Permissions</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminShowOrder.php">Program Shows</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/showShowOrder.php">Show Shows</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/projectionistReport.php">Projectionist</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/manageMedia.php">Manage Media</a></div>' . PHP_EOL;
/*
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Admin Reports</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/paymentsReport.php">Track Payments</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Admin Utilities</div>' . PHP_EOL; 
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/permissionReponses.php">Manage Permissions</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
*/
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Admin Help</div>' . PHP_EOL; 
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminFAQs.php">FAQs</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminHowTo.php">How To</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminEmailCheck.php">Email addr in DB?</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Interactive Utilities</div>' . PHP_EOL; 
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/checkDBIntegrity.php">Chk DB Integrity</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/repairDuplicatePeople.php">Repair Dup Pple</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">1-Click Utilities</div>' . PHP_EOL; 
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/populateColumnsSchemaInfoCache.php">Gen Meta Table</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/genFileNames.php">Gen File Names</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/createEmptyCurationRows.php">Init Curation</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/populateImageTable.php">Updt Image Tbls</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/updateMetadataFromVimeo.php">Vimeo Metadata</a></div>' . PHP_EOL;
//    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="#">Set RT Values</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Developer Info</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testSSFRunTimeValues.php">Run Time Values</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/dataPropertiesTestDriver.php">Sets &amp; Enums</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
    $navBarString .= self::$indent . '</div>' . PHP_EOL;
/*
    $navBarString .= self::$indent . '  <div><div class="navBarTitle2">Developer<br>Test Drivers</div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testWorkDisplay.php">Work Display</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testText.php">Test Text</a></div>' . PHP_EOL;
    $navBarString .= self::$indent . '  </div>' . PHP_EOL;
*/
    $navBarString .= self::$indent . '</div>' . PHP_EOL;
    //self::displayNavBar($moveUpString);
    return $navBarString;
  }

  public static function getCopyrightLine($onWhite = false) {
    $spanClass = "smallBodyTextLeadedGrayLight";
    if ($onWhite) $spanClass = "smallBodyTextLeaded";
    $indent = '              ';
    $copyrightString = $indent;
    $copyrightString .= '<div><span class="' . $spanClass . '">Copyright ' . self::copyrightYears() 
                     . ' Sans Souci Festival of Dance Cinema </span>'
                     . '<span class="smallBodyTextLeaded">&#8226; <a href="mailto:' . self::contactEmailAddress() . '">email us</a></span></div>'
                     .  PHP_EOL;
    return $copyrightString;
  }

  public static function displayCopyrightLine($onWhite = false) {
    echo self::getCopyrightLine($onWhite);
  }

  private static function copyrightYears() { 
    $copyrightYearString = "2004-" . date('Y'); // 3/19/14
    return $copyrightYearString;
//    return SSFRunTimeValues::getCopyrightYearsString(); /* e.g., "2004-2011" */ 
  }
  
  private static function contactEmailAddress() { 
    return SSFRunTimeValues::getContactEmailAddress();
  }
  
}
?>
