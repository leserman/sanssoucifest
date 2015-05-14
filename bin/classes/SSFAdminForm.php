<?php

  class SSFAdminForm {
    
    private static $showFunctionMarkers = true;

    // Generates HTML for person detail.
    // TODO: Make this non-static and clean it up. 4/28/15
    public static function displayPersonDetail($personArray) {
      $alwaysDisplay = false;
      $indent = '                      ';
      if (self::$showFunctionMarkers) echo "<!-- BEGIN displayPersonDetail in adminDataEntry.php -->" . PHP_EOL;
      if (!is_null($personArray)) {
        $personId = $personArray['personId'];
        $organizationExists = isset($personArray['organization']) && ($personArray['organization'] != '');
        $addressLine1Exists = isset($personArray['streetAddr1']) && ($personArray['streetAddr1'] != '');
        $addressLine2Exists = isset($personArray['streetAddr2']) && ($personArray['streetAddr2'] != '');
        $addressLineExists = $addressLine1Exists || $addressLine2Exists;
        $cityExists = isset($personArray['city']) && ($personArray['city'] != '');
        $stateProvRegionExists = isset($personArray['stateProvRegion']) && ($personArray['stateProvRegion'] != '');
        $zipPostalCodeExists = isset($personArray['zipPostalCode']) && ($personArray['zipPostalCode'] != '');
        $cityLineOutputExists =  $cityExists || $stateProvRegionExists || $zipPostalCodeExists; 
        $addressExists = $addressLineExists || $cityLineOutputExists;
        $countryExists = isset($personArray['country']) && ($personArray['country'] != '');
        $phoneVoiceExists = isset($personArray['phoneVoice']) && ($personArray['phoneVoice'] != '');
        $phoneMobileExists = isset($personArray['phoneMobile']) && ($personArray['phoneMobile'] != '');
        $phoneFaxExists = isset($personArray['phoneFax']) && ($personArray['phoneFax'] != '');
        $telephonesExist = $phoneVoiceExists || $phoneMobileExists || $phoneFaxExists;
        $notifyOfString = str_replace(',', ", ", $personArray['notifyOf']);
        
        // name
        echo $indent . '<div class="datumValue floatLeft">';
        echo $personArray["name"]; // TODO 11/17/14 USE self::htmlEncode() HERE?
        
        // recordType
        echo ' <span style="padding-left:2em;color:rgb(223,116,22);">' . ucfirst($personArray["recordType"]) . '</span>';
        
        // notifyOf
        echo ' <span class="datumDescription" style="padding-left:2em">Notify of: </span>' . $notifyOfString;
        echo '</div>' . PHP_EOL;
        
        // last name & nickname
        $lastName = ((isset($personArray['lastName']) && ($personArray['lastName'] != '')) ? $personArray['lastName'] : "-----");
        $nickName = ((isset($personArray['nickName']) && ($personArray['nickName'] != '')) ? $personArray['nickName'] : "-----");
        echo $indent . ' <div class="datumValue floatRight" style="padding-right:4px">[' . $lastName . ', ' . $nickName . ']</div>'; // TODO 11/17/14 USE self::htmlEncode() HERE?
        echo $indent . ' <div style="clear:both;"></div>'  . PHP_EOL;
        
        // organization
        if ($alwaysDisplay || $organizationExists) {
          echo $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Organization', $personArray['organization']) . '</div>' . PHP_EOL; // // TODO 11/17/14 USE self::htmlEncode() HERE?
        }
        
        // address
        $addressSegmentSeparator = " &bull; ". PHP_EOL;
        $addressDescription = "Address";
        $valueString = '';
        //echo $indent . '<div class="datumValue">' . PHP_EOL;
        if (!$addressExists && !$countryExists) $valueString .= "No address provided.<br>" . PHP_EOL;
        if ($addressLine1Exists) $valueString .= $personArray['streetAddr1'] . $addressSegmentSeparator;
        if ($addressLine2Exists) $valueString .= $personArray['streetAddr2'] . $addressSegmentSeparator;
        if ($cityExists) $valueString .= $personArray['city'];
        if ($cityExists && ($stateProvRegionExists || $zipPostalCodeExists)) $valueString .= ", "; 
        if ($stateProvRegionExists) $valueString .= $personArray['stateProvRegion'] . " "; 
        if ($zipPostalCodeExists) $valueString .= $personArray['zipPostalCode']; 
        if ($cityLineOutputExists && $countryExists) $valueString .= $addressSegmentSeparator;
        if ($countryExists) $valueString .= $personArray['country'];
        //echo $indent . "</div>" . PHP_EOL;
        echo $indent . '<div>' . self::getSimpleDataWithDescriptionLine($addressDescription, $valueString) . '</div>' . PHP_EOL; 

        // telephones
  //      $valueString = "<div class='datumDescription floatLeft' style='padding-bottom:0;padding-top:3px;'>Telephones:" . PHP_EOL; // 4/2/15 added padding-top; 4/6/15 removed </div>
        $valueString = "<div class='datumValue floatLeft' style='padding-top:3px;padding-left:0;'>"; // 4/2/15 added padding-top; 4/6/15 removed </div>
        $valueString .= "<span class='datumDescription'>Telephones:&nbsp;</span></div>" . PHP_EOL; // 4/2/15 added padding-top; 4/6/15 removed </div>
  //      $valueString .= $indent . "  <div style='float:left;'>" . PHP_EOL;
  //      $phoneSpanMarkup = $indent . "    <div style='float:left;margin-left:.5em;padding-bottom:0px;'>";
        $valueString .= $indent . "<div style='float:left;margin-left:.5em;padding-bottom:0px;'>" . PHP_EOL;
        $phoneSpanMarkup = $indent . "  ";
        if ($phoneVoiceExists) $valueString .= $phoneSpanMarkup . HTMLGen::getDatumDisplayWDesc("Landline", $personArray['phoneVoice']) . PHP_EOL;
        if ($phoneMobileExists) $valueString .=  $phoneSpanMarkup . HTMLGen::getDatumDisplayWDesc("Mobile", $personArray['phoneMobile']) . PHP_EOL;
        if ($phoneFaxExists) $valueString .=  $phoneSpanMarkup . HTMLGen::getDatumDisplayWDesc("Fax", $personArray['phoneFax']) . PHP_EOL;
        if (!$telephonesExist) $valueString .=  $indent . "<div class='datumValue floatLeft' style='margin-bottom:0;margin-top:2px;padding-bottom:0;'>&nbsp;No telephone numbers provided.</div>"; 
  //      $valueString .=  $indent . "    <div style='clear:both;'></div>" . PHP_EOL;
  //      $valueString .=  $indent . "  </div>" . PHP_EOL;
        $valueString .=  $indent . "  <div style='clear:both;'></div>" . PHP_EOL;
        $valueString .=  $indent . "</div>" . PHP_EOL;
  //      echo $indent . '    ' . self::getSimpleDataWithDescriptionLine('', $valueString); 
        echo $indent . '' . $valueString; 
        echo $indent . "<div style='clear:both;'></div>" . PHP_EOL;
  //      echo $indent . '<br>' . PHP_EOL;
  
        // email
        $emailString = str_replace(array('<', '>'), '', $personArray['email']);
        $valueString = (($personArray['email'] == '') ? '<span style="color:rgb(223,116,22);">No email address provided.</span>' 
                                                      : HTMLGen::getHTMLAnchoredEmailStringFor($personArray['name'], $emailString));
        echo $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Email', $valueString) . '</div>' . PHP_EOL; 

        // how heard about us
        if ($alwaysDisplay || (isset($personArray['howHeardAboutUs']) && ($personArray['howHeardAboutUs'] != ''))) {
          echo $indent . '<div>' . self::getSimpleDataWithDescriptionLine('How you heard about us', $personArray['howHeardAboutUs']) . '</div>' . PHP_EOL; 
        }

        // relationship(s)
        if ($alwaysDisplay || (isset($personArray['relationship']) && ($personArray['relationship'] != ''))) { 
          $valueString = str_replace(',', ", ", $personArray['relationship']);
          echo  $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Relationship(s)', $valueString) . '</div>' . PHP_EOL; 
        }

        // role(s)
        if ($alwaysDisplay || (isset($personArray['role']) && ($personArray['role'] != ''))) {
          $valueString = str_replace(',', ", ", $personArray['role']);
          echo  $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Role(s)', $valueString) . '<div>' . PHP_EOL; 
        }

        // administrative notes
        if ($alwaysDisplay || (isset($personArray['notes']) && ($personArray['notes'] != ''))) {
          $valueString = str_replace(',', ", ", $personArray['notes']);
          echo  $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Administrative Note(s)', $valueString) . '<div>' . PHP_EOL; 
        }
        
        // web sites
        if ($alwaysDisplay || (isset($personArray['webSites']) && ($personArray['webSites'] != ''))) {
          $valueString = HTMLGen::getHTMLAnchorTaggedStringFor($personArray['webSites']);
          echo  $indent . '<div>' . self::getSimpleDataWithDescriptionLine('Web Site(s)', $valueString) . '<div>' . PHP_EOL; 
        }
      }
      if (self::$showFunctionMarkers) echo "<!-- END displayPersonDetail in adminDataEntry.php -->" . PHP_EOL;
    }

    // Same as SSFEntryForm
    public static function getSimpleDataWithDescriptionLineX($descriptionString, $valueString) {
      $displayElement = HTMLGen::getSimpleDataWithDescriptionElement($descriptionString, $valueString);
      $displayLine = '<div>' . $displayElement . '<div style="clear:both;"></div></div>' . "\r\n";
      return $displayLine;
    }

    // Same as HTMLGen old and SSFEntryForm
    public static function getSimpleDataWithDescriptionLine($descriptionString, $valueString) {
      $finalDescString = ((isset($descriptionString) && ($descriptionString != '')) ? $descriptionString . ":&nbsp;" : "");
      $displayElement = '<div class="datumValue" style="padding-top:2px;"><span class="datumDescription">' 
                      . $finalDescString . "</span>" . $valueString . "</div>";
      return $displayElement;
    }

    // Generates HTML for the work detail. Parameter $workArray must contain workId.
    public static function displayWorkDetail($workArray, $contributorsArray) {
      if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkDetailForAdmin -->\r\n";
      $indent = '            ';
      if (!is_null($workArray)) {
        $workId = $workArray['workId'];

        // title, year, runtime, accepted/rejected, titleForSort
        $acceptRejectString = '';
        if ($workArray['callForEntries'] <= 13) // Has Been Curated // TODO get the callForEntries threshold from the DB. Last modified 7/18/13.
          $acceptRejectString = " <span class='datumValue' style='font-size:14px;'>" . HTMLGen::acceptanceDisplay($workId, $workArray['accepted'], $workArray['rejected'], $workArray['acceptFor']) . "</span>"; 
        $titleForSortString = ((isset($workArray['titleForSort']) && ($workArray['titleForSort'] != ''))
                            ? '[' . $workArray['titleForSort'] . ']' : '[no title for sort]');
        $countryOfProductionDisplay = ((!is_null($workArray['countryOfProduction']) && ($workArray['countryOfProduction'] !== '')))
                                    ? (', ' . $workArray['countryOfProduction']) : '';
        echo "<div>\r\n" 
             . '<div class="datumValue floatLeft">' . $workArray['title'] . ' (' . $workArray['yearProduced'] . $countryOfProductionDisplay
             . ') ' . $acceptRejectString . '<span class="datumDescription" style="margin-left:2em;">Running Time: </span>' 
             . HTMLGen::timeAsMinutesAndSeconds($workArray['runTime'])
             . (($workArray['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'>  LIVE</span>" : "")
             . (($workArray['invited'] == 1) ? "<span class='liveDisplayText'>  INVITED</span>" : "") . '</div>' . PHP_EOL
             . '<div class="datumValue floatRight" style="padding-right:4px;">' . $titleForSortString . '</div>' . PHP_EOL
             . '<div style="clear:both;"></div>' . "\r\n</div>\r\n";

        // media received & computed filename
        $computedFileName = (isset($workArray['filename']) && ($workArray['filename'] != '') && (strripos($workArray['filename'], 'YY-XXX') === false)) 
                          ? $workArray['filename']
                          : HTMLGen::computedFileNameForWork($workArray['designatedId'], $workArray['titleForSort'], $workArray['name']);
        echo "<div>\r\n<div class='floatLeft'>\r\n" . HTMLGen::getMediaReceivedDisplayElement($workArray['dateMediaReceived'], $workArray['dateMediaPostmarked']) . "</div>\r\n" .
             "<div class='datumValue floatRight' style='padding-right:4px;'>\r\n[" . $computedFileName . "]</div>" 
                         . "\r\n<div style='clear:both;'></div>\r\n</div>\r\n";

        // submission & original formats
        echo HTMLGen::getMediaFormatsDisplayLine($workArray['submissionFormat'], $workArray['originalFormat']);

        // vimeo publication info
        $downloadAvailabilityStatusText = '';
        $vimeoWebAddress = (isset($workArray['vimeoWebAddress'])) ? $workArray['vimeoWebAddress'] : '';
        $vimeoPassword = (isset($workArray['vimeoPassword'])) ? $workArray['vimeoPassword'] : '';
        $vimeoInfo_0 = new SSFVimeoVideoInfo($vimeoWebAddress, $vimeoPassword, $showBasicDiagnostics=-1);
        HTMLGen::setVimeoInfo($vimeoInfo_0);
        $vimeoInfoDisplayString = HTMLGen::vimeoInfo()->getInfoString($includeDiagnostics=false);
        $downloadUnavailable = (HTMLGen::vimeoInfo()->webAddressIsForVimeo() && !HTMLGen::mediaHasBeenReceived($workArray));
        if ($downloadUnavailable) {
          $downloadPermissionRequested = (isset($workArray['dateSent']) && ($workArray['dateSent'] !== ''));
          if (!$downloadPermissionRequested) {
            $downloadAvailabilityStatusText = HTMLGen::getVimeoDownloadUnavailableEmailLink($workArray);
          } else {
            $dateSentString = date('n/j/y', strtotime($workArray['dateSent']));
            $downloadAvailabilityStatusText = "<span class='orangishHighlightDisplayColor'> Download-permission request sent " . $dateSentString . ".</span>";
          }
        } 
        echo self::getSimpleDataWithDescriptionLine('Vimeo Info', $vimeoInfoDisplayString . $downloadAvailabilityStatusText);
        // Aspect ratio & frame size
        echo self::getSimpleDataWithDescriptionLine('Frame', HTMLGen::getFrameParametersDisplayElement2($workArray));

        // work contributors
        $displayContributorsOnSeparateLines = true;
        SSFDebug::globalDebugger()->belch('contributorsArray in HTMLGen::displayWorkDetailForAdmin()', '$contributorsArray', -1);
        echo HTMLGen::getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);

        // synopsis
        echo self::getSimpleDataWithDescriptionLine('Synopsis', HTMLGen::getSynopsisFrom($workArray));

        // web site
        echo $indent . '<div class="dodeco">' . HTMLGen::getWebSiteDisplayLine($workArray['webSite'], $workArray['webSitePertainsTo']) . '<div style="clear:both;"></div></div>' . PHP_EOL;

        // previously shown at
        echo self::getSimpleDataWithDescriptionLine('Also shown at', $workArray['previouslyShownAt']);
  
        // photo location
        $photoLocationString = (isset($workArray['photoLocation']) && $workArray['photoLocation'] != '') 
                             ? $workArray['photoLocation']
                             : '<span class="orangishHighlightDisplayColor">unknown</span>';
        echo self::getSimpleDataWithDescriptionLine('Photo&nbsp;location', $photoLocationString);
    
        // photo credits
        if (isset($workArray['photoCredits']) && $workArray['photoCredits'] != '') {
          echo self::getSimpleDataWithDescriptionLine('Photos by', $workArray['photoCredits']);
        }
  
/*
        // photo location
        $photoLocationString = ($workArray['photoURL'] != '') ? HTMLGen::getWebAddressDisplayString($workArray['photoURL'])
                                                              : (($workArray['photoLocation'] != '') ? $workArray['photoLocation']
                                                                                                     : '<span class="orangishHighlightDisplayColor">unknown</span>');
        echo self::getSimpleDataWithDescriptionLine('Still&nbsp;Image&nbsp;Location', $photoLocationString);
*/

        // photo URL
        if (isset($workArray['photoURL']) && $workArray['photoURL'] != '') {
          $photoURLString = (true) ? HTMLGen::getWebAddressDisplayString($workArray['photoURL'])
                                                           : '<span class="orangishHighlightDisplayColor">unknown</span>';
          echo self::getSimpleDataWithDescriptionLine('Photo&nbsp;URL', $photoURLString); 
        }
  
        // payment info
        $pmtString = HTMLGen::getPaymentInfoDisplayString($workArray);
        echo self::getSimpleDataWithDescriptionLine('Payment&nbsp;Information', $pmtString);

        // release info
        echo self::getSimpleDataWithDescriptionLine('Release&nbsp;Information', $workArray['permissionsAtSubmission']);

        // notes
        if (isset($workArray['submissionNotes']) && $workArray['submissionNotes'] !== '')
          echo self::getSimpleDataWithDescriptionLine('Submission Notes', $workArray['submissionNotes']);
        if (isset($workArray['workNotes']) && $workArray['workNotes'] !== '')
          echo self::getSimpleDataWithDescriptionLine('Work Notes', $workArray['workNotes']);
        if (isset($workArray['mediaNotes']) && $workArray['mediaNotes'] !== '')
          echo self::getSimpleDataWithDescriptionLine('Media Notes', $workArray['mediaNotes']);
        if (isset($workArray['projectionistNotes']) && $workArray['projectionistNotes'] !== '')
          echo self::getSimpleDataWithDescriptionLine('Projectionist Notes', $workArray['projectionistNotes']);
      }
      if (self::$showFunctionMarkers) echo "<!-- END displayWorkDetailForAdmin -->\r\n";
    }
    

  }
?>