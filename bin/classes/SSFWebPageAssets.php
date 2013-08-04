<?php

class SSFWebPageAssets {

  public static function displayNavBar($moveUpString = '../') {
    echo '<div class="narBarMainSection">' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'index.php">Home</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'demoreel">Demo Reel</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'press">Press Reports</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'memorabilia">Memorabilia</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'links.php">Links</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'aboutUs.php">About Us</a></div>' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'contactUs.php">Contact Us</a><br><a target="_top" href="' . $moveUpString . 'contactUs.php">Join Email List</a></div>' . "\r\n";
    echo '</div>' . "\r\n";

    echo '<div class="narBarArchiveSection">' . "\r\n";
/*
    echo '  <div><div class="navBarTitle1" style="color:#e49548;">Current Events</div> <!--  style="color:#FFACAC;" -->' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2012.php">Boulder<br>8/31 &amp; 9/1/2012</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
*/
    echo '  <div><div class="navBarTitle2" style="color:#e49548;">Festival Archive</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2012.php">Boulder 2012</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2011.php">Boulder 2011</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programAtlas2010.php">Boulder 2010</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programDairy2009.php">Boulder 2009</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2008.php">Boulder 2008</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2007.php">Boulder 2007</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programBMoCA2006.php">Boulder 2006</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/priorEventsSummary.php">2004/2005</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2" style="color:#e49548;">Tour Archive</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . '' . 'http://atticrep.org/site/sans-souci/">San Antonio \'13</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programMorelia2012.php">Mexico 2012</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/SanAntonio2012.php">San Antonio \'12</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programACC2011.php">Austin 2011</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programSanAntonio2011.php">San Antonio \'11</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/barcelona2010.php">Barcelona 2010</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programHighways2010.php">LA 2010</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programGiessen2009.php">Giessen 2009</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programTXState2008.php">TX State 2008</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/programHighways2008.php">LA 2008</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/GiessenServer2007.php">Germany 2007</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'press/MichoacanPress2006.php">Mexico 2006</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
/*
    echo '  <div><div class="navBarTitle2" style="color:#e49548;">Event Summary</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'programPages/priorEventsSummary.php">2004/2005</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
*/
    echo '</div>' . "\r\n";
  }

  public static function displayAdminNavBar($moveUpString = '../') {
    echo '<div class="narBarMainSection">' . "\r\n";
    echo '  <div class="navBar"><a target="_top" href="' . $moveUpString . 'index.php">SSF Home</a></div>' . "\r\n";
    echo '</div>' . "\r\n";
    echo '<div class="narBarArchiveSection">' . "\r\n";
    echo '  <div><div class="navBarTitle1">Administration</div>' . "\r\n";
    echo '    <div class="navBar"><a target="_top" href="' . $moveUpString . 'admin/index.php">Admin Home</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">Admin Activities</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminDataEntry.php">Manage<br>People &amp; Works</a></div>' . "\r\n";
    echo '    <div style="line-height:1px;margin:3px auto;border-top:#666 thin solid;width:50%;"></div>';
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/submissionsOverviewReport.php">Track Submissions</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/informArtistsOfMediaReceipt.php">Acknowledge Media Rceipt</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminPaypalParse.php">Paypal Payments</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/paymentsReport.php">Track Payments</a></div>' . "\r\n";
    echo '    <div style="line-height:1px;margin:3px auto;border-top:#666 thin solid;width:50%;"></div>';
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/curationData.php">Curate</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/viewCurationProgress.php">Curation History</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/curationEmail.php">Send Curation Results Email</a></div>' . "\r\n"; // was curationAccRejEmail
    echo '    <div style="line-height:1px;margin:3px auto 2px auto;border-top:#666 thin solid;width:50%;"></div>';
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminPermissions.php">Manage Permissions</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminShowOrder.php">Program Shows</a></div>' . "\r\n";
//    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/showShowOrder.php">Show Shows</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/projectionistReport.php">Projectionist</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/manageMedia.php">Manage Media</a></div>' . "\r\n";
/*
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">Admin Reports</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/paymentsReport.php">Track Payments</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">Admin Utilities</div>' . "\r\n"; 
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/permissionReponses.php">Manage Permissions</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
*/
    echo '  <div><div class="navBarTitle2">Admin Help</div>' . "\r\n"; 
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminFAQs.php">FAQs</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'admin/adminHowTo.php">How To</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">Interactive Utilities</div>' . "\r\n"; 
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/checkDBIntegrity.php">Chk DB Integrity</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/repairDuplicatePeople.php">Repair Dup Pple</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">1-Click Utilities</div>' . "\r\n"; 
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/populateColumnsSchemaInfoCache.php">Gen Meta Table</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/genFileNames.php">Gen File Names</a></div>' . "\r\n";
//    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/createEmptyCurationRows.php">Init Curation</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/populateImageTable.php">Updt Image Tbls</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/utilities/updateMetadataFromVimeo.php">Vimeo Metadata</a></div>' . "\r\n";
//    echo '    <div class="navBarTight"><a target="_top" href="#">Set RT Values</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '  <div><div class="navBarTitle2">Developer Info</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testSSFRunTimeValues.php">Run Time Values</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/dataPropertiesTestDriver.php">Sets &amp; Enums</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
    echo '</div>' . "\r\n";
/*
    echo '  <div><div class="navBarTitle2">Developer<br>Test Drivers</div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testWorkDisplay.php">Work Display</a></div>' . "\r\n";
    echo '    <div class="navBarTight"><a target="_top" href="' . $moveUpString . 'bin/testDrivers/testText.php">Test Text</a></div>' . "\r\n";
    echo '  </div>' . "\r\n";
*/
    echo '</div>' . "\r\n";
    //self::displayNavBar($moveUpString);
  }

  public static function displayCopyrightLine($onWhite = false) {
    $spanClass = "smallBodyTextLeadedGrayLight";
    if ($onWhite) $spanClass = "smallBodyTextLeaded";
    echo '<span class="' . $spanClass . '">Copyright ' . self::copyrightYears() 
        . ' Sans Souci Festival of Dance Cinema </span>'
        . '<span class="smallBodyTextLeaded">&#8226; <a href="mailto:' . self::contactEmailAddress() . '">email us</a></span>'
        .  "\r\n";
  }

  private static function copyrightYears() { 
    return SSFRunTimeValues::getCopyrightYearsString(); /* e.g., "2004-2011" */ 
  }
  
  private static function contactEmailAddress() { 
    return SSFRunTimeValues::getContactEmailAddress(); /* e.g., "contact@sanssoucifest.org" */
  }
  
}
?>
