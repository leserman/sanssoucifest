<?php 

class HTMLGen {

  private static $debugger;
  
  private function debugger() {
    if (!isset($debugger)) $debugger = new SSFDebug($initBelchEnabled=false, $initBechoEnabled=false);
    return $debugger;
  }

  private static $showFunctionMarkers = true;
  
  // This function does not work becuase when $string is null, a PHP error is generated on the function call.
  //public static function isSetAndNonNull($string) { return (isset($string) && ($string != '')); }
    
  private static $widgetIdsCnt = array();

	public static function genShowIdTag($showId) {
	  return 'show' . $showId;
	}
	
  public static function genId($fromId) {
    //return $fromId; // shortcircuit this function because it screws up all the getElementById calls w hardcoded ids
    $lowerCaseFromId = strtolower($fromId);
    HTMLGen::$widgetIdsCnt[$lowerCaseFromId] =
      (!array_key_exists($lowerCaseFromId, HTMLGen::$widgetIdsCnt)) ? 1 : ++HTMLGen::$widgetIdsCnt[$lowerCaseFromId];
    self::debugger()->belch('widgetIdsCnt', HTMLGen::$widgetIdsCnt, -1);
    return $fromId . '-' . sprintf("%d", HTMLGen::$widgetIdsCnt[$lowerCaseFromId]);
  }
  
	public static function htmlEncode($string) {
	  $encodedString = '';
	  if (isset($string) && $string != '') {
      // Don't use htmlspecialchars() because it translates < and > which I'm using in markup in the database.
      // else $encodedString = htmlspecialchars($string, ENT_QUOTES, 'ISO-8859-1', $doubleEncode=true);
      $encodedString = str_replace('&', '&amp;', $string);
      $encodedString = str_replace('&amp;#', '&#', $encodedString);
      $encodedString = str_replace('"', '&quot;', $encodedString);
      $encodedString = str_replace('\'', '&#039;', $encodedString);
    }
    return $encodedString;
	}
	
  // strip < and > replacing with &lt; and &gt; for browser display
  public static function encodeEmailAddress($address) {
    $newString = str_replace("<", "&lt;", $address);
    return str_replace(">", "&gt;", $newString);
  }

  // strip&lt; and &gt; replacing with < and > for email
  public static function decodeEmailAddress($encodedAddress) {
    $newString = str_replace("&lt;", "<", $encodedAddress);
    return str_replace("&gt;", ">", $newString);
  }

  public static function displayEditDivHeader($divIdString, $title, $saveButtonNameId, 
                                              $validationFunctionName, $hiddenInputSavingId, $cancelButtonNameId) {
    $saveButtonGenId = HTMLGen::genId($saveButtonNameId);
    $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
    echo "          <div id='" . $divIdString . "' class='entryFormSection'>\r\n";
    echo "            <div class='entryFormSectionHeading'>\r\n";
    echo "              <div style='float:left;padding-top:4px;'>" . $title . "</div>\r\n";
    echo "              <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
    echo "                <input type='button' id='" . $saveButtonGenId . "' name='" 
                                                     . $saveButtonNameId . "' value='Save'\r\n";
    echo "                       onclick='var valid = (" . $validationFunctionName . "());\r\n";
    echo "                                if (valid) { postValidationSubmit(\"" . $hiddenInputSavingId . "\"); }'>\r\n";
    echo "                <input type='submit' id='" . $cancelButtonGenId . "' name='" 
                                                     . $cancelButtonNameId . "' value='Cancel'>\r\n";
    echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";

    echo "              </div>\r\n";
    echo "              <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
    echo "            </div>\r\n";
//    echo "            <div>\r\n";
  }

  public static function getDatumDisplayWDesc($description, $value) {
    $string = "<div class='datumDescription' style='padding-bottom:0'>" . $description . ":&nbsp;";
    $string .= "<span class='datumValue' style='padding-bottom:0'>" . $value . "</span></div>";
    return $string;
  }

  public static function getSimpleDataWithDescriptionLine($descriptionString, $valueString) {
    $displayElement = self::getSimpleDataWithDescriptionElement($descriptionString, $valueString);
    $displayLine = '<div>' . $displayElement . '<div style="clear:both;"></div></div>' . "\r\n";
    return $displayLine;
  }
  
  // Coerces float-left divs into a single line by wrapping in another div.
  // $floatLeftDivs may be a string or an array of strings. Presumably, each 
  // string in $floatLeftDivs is a float left div. 
  public static function getDisplayLineFromElements($floatLeftDivs) {
    $displayLine = '<div>';
    if (is_array($floatLeftDivs)) 
      foreach ($floatLeftDivs as $floatLeftDiv) { $displayLine .= $floatLeftDiv; }
    else $displayLine .= $floatLeftDivs;
    $displayLine .= '<div style="clear:both;"></div></div>';
    return $displayLine;
  }
  
  public static function getSimpleDataWithDescriptionElement($descriptionString, $valueString, $paddingLeft='0') {
    $finalDescString = ((isset($descriptionString) && ($descriptionString != '')) ? $descriptionString . ":&nbsp;" : "");
    $displayElement = '<div class="datumValue floatLeft" style="padding-top:2px;padding-left:' . $paddingLeft . ';">';
    $displayElement .= "<span class='datumDescription'>" . $finalDescString . "</span>";
    $displayElement .= $valueString . "</div>\r\n";
    return $displayElement;
  }
  
  public static function getTestBedDisplayString() {
    $isTestbed = (stripos(SSFDB::getSchemaName(), 'testbed') !== false);
    $schemaDisplay = (($isTestbed) ? '(testbed)' : '(live data)');
    return '<span class="datumDescription">' . $schemaDisplay . '</span>';
  }

  public static function getMediaFormatsDisplayLine($submissionFormat, $originalFormat) {
    $displayElement = self::getMediaFormatsDisplayElement($submissionFormat, $originalFormat);
    $displayLine = "<div>\r\n" . $displayElement . "<div style='clear:both;'></div>\r\n</div>\r\n";
    return $displayLine;
  }

  public static function getMediaFormatsDisplayElement($submissionFormat, $originalFormat) {
    $displayElement = '<div class="datumValue floatLeft" style="padding-top:2px;">'
                     . '<span class="datumDescription">Submitted as </span>' 
                     . '<span class="orangishHighlightDisplayColor">' . $submissionFormat . '</span>'
                     . '<span class="datumDescription">. Originally recorded as </span>' 
                     . $originalFormat . '.</div>' . "\r\n";
    return $displayElement;
  }

  // The table.column is assumed to be a SET.
  public static function addCheckBoxWidgetRow($title, $tableName, $colName, $currentValue, $cols, $disable=false) {
    echo "<!-- CheckBoxWidgetRow: " . $tableName . "." . $colName . ", " . $title . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer' style='padding-bottom:2px;'>\r\n";
    echo "        <div class='rowTitleTextWide' style='padding-top:2px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn'>\r\n";
    $dpArray = DatumProperties::getArray();
    $dataItemName = DatumProperties::getItemKeyFor($tableName, $colName);
    $possibleValues = $dpArray[$dataItemName]->possibleValues;
    $itemCount = count($possibleValues);
    $itemsPerCol = (int) ceil($itemCount/$cols);
    $rowIndex = 0;
    $itemsDisplayed = 0;
    // begin a column div
    echo "        <div style='float:left;'>\r\n";
    //echo '<br>\r\n possibleValues '; print_r($possibleValues); echo '<br>\r\n';
    foreach ($possibleValues as $possVal) {      
      $rowIndex++;
      $itemsDisplayed++;
      $inSet = (strstr($currentValue, $possVal) !== false);  // $possVal is a substring of the set
      $genId = HTMLGen::genId($possVal);
      //echo 'addCheckBoxWidgetRow '; print_r($currentValue); echo ' -> '; print_r($possVal); echo "\r\n";
      echo "          <div>\r\n";
      echo "            <div style='float:left;'>\r\n";
      echo "              <input type='checkbox' name='" . $dataItemName . "[]" . "' id='" . $genId;
      echo "' value='" . $possVal . "' onchange='userMadeAChange(1);'" . (($disable) ? ' disabled' : '');
      if ($inSet) echo "checked='checked'";
      echo ">\r\n";
      echo "            </div>\r\n";
      echo "            <div class='entryFormRadioButtonLabel' style='float:left;padding-right:16px;padding-top:0px;'>\r\n";
      echo "              <label for='" . $genId . "'>" . $possVal . "</label>\r\n";
      echo "            </div>\r\n";
      echo "            <div style='clear:both;'></div>\r\n";
      echo "          </div>\r\n";
      // End a column div and start another if it's time.
      if (($rowIndex >= $itemsPerCol) && ($itemsDisplayed < $itemCount)) { 
        $rowIndex = 0;
        echo "        </div>\r\n";
        echo "        <div style='float:left;'>\r\n";
      }
    }    
    echo "        </div>\r\n";
    echo "          <div style='clear:both;'></div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear: both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END CheckBoxWidgetRow -->\r\n";
  }

  // The table.column is assumed to be a BOOLEAN.
  public static function addBooleanCheckBoxWidgetRow($title, $tableName, $colName, $isChecked, $cols=1, $disable=false) {
    echo "<!-- BooleanCheckBoxWidgetRow: " . $tableName . "." . $colName . ", " . $title . (($disable) ? " disabled" : "") . " -->\r\n";
    // Open up the nested divs.
    echo "      <div class='formRowContainer' style='padding-bottom:2px;'>\r\n";
    echo "        <div class='rowTitleTextWide' style='padding-top:2px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn'>\r\n";
    echo "          <div>\r\n";
    echo "            <div style='float:left;'>\r\n";
    // Compute widget names and ids.
    $dataItemName = DatumProperties::getItemKeyFor($tableName, $colName);
    $genCheckboxId = HTMLGen::genId($dataItemName . 'BoolCheckbox');
    $genHiddenCacheId = HTMLGen::genId($dataItemName);
    // Generate the checkbox itself.
    echo "              <input type='checkbox' name='" . $dataItemName . 'BoolCheckbox' . "' id='" . $genCheckboxId;
    echo "' value='" . 'live?' . "' onchange='userMadeAChange(1);"
                     . "setHiddenBoolCacheWidget(\"" . $genCheckboxId . "\", \"" . $genHiddenCacheId . "\");'"
                     . (($disable) ? ' disabled' : '');
    if ($isChecked) echo "checked='checked'";
    echo ">\r\n";
    // Generate the associated hidden cache widget for caching the value. This is the trick. Checkboxes typically
    // map to ENUMs in the database. These checkboxes map to a boolean. So, the boolean value is cached in a hidden
    // input field which is updated by the change method of the checkbox.
    echo "            <input type='hidden' id='" . $genHiddenCacheId . "' name='" . $dataItemName . "' "
                                                 . "value=" . (($isChecked) ? '1' : '0') . ">\r\n";
    // Close up the nested divs.
    echo "            </div>\r\n";
    echo "            <div style='clear:both;'></div>\r\n";
    echo "          </div>\r\n";
    echo "          <div style='clear:both;'></div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear: both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END BooleanCheckBoxWidgetRow -->\r\n";
    return $dataItemName;
  }

  // The table.column is assumed to be an ENUM.
  public static function addRadioButtonWidgetRow($title, $tableName, $colName, $currentValue, $cols, $disable=false) {
    echo "<!-- RadioButtonWidgetRow: " . $tableName . "." . $colName . ", " . $title . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer' style='padding-top:2px;'>\r\n";
    echo "        <div class='rowTitleTextWide' style='padding-top:3px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn' style='padding-bottom:3px;'>\r\n";
    $dpArray = DatumProperties::getArray();
//  print_r($dpArray['people.notifyOf']->possibleValues);
    $dataItemName = DatumProperties::getItemKeyFor($tableName, $colName);
    $possibleValues = $dpArray[$dataItemName]->possibleValues;
    $itemCount = count($possibleValues);
    $itemsPerCol = (int) ceil($itemCount/$cols);
    $itemsDisplayed = 0;
    $rowIndex = 0;
    // begin a column div
    echo "        <div style='float:left;'>\r\n";
    //echo '<br>\r\n possibleValues '; print_r($possibleValues); echo '<br>\r\n';
    foreach ($possibleValues as $possVal) {      
      $rowIndex++;
      $itemsDisplayed++;
      $isValue = ($currentValue == $possVal);  // $possVal is a substring of the enum
      $genId = HTMLGen::genId($possVal);
      //echo 'addRadioButtonWidgetRow '; print_r($currentValue); echo ' -> '; print_r($possVal); echo "\r\n";
      echo "          <div>\r\n";
      echo "            <div style='float:left;'>\r\n";
      echo "              <input type='radio' name='" . $dataItemName . "' id='" . $genId;
      echo "' value='" . $possVal . "' onchange='userMadeAChange(1);'" . (($disable) ? ' disabled' : '');
      if ($isValue) echo "checked='checked'";
      echo ">\r\n";
      echo "            </div>\r\n";
      echo "            <div class='entryFormRadioButtonLabel' style='float:left;padding-right:16px;'>\r\n";
      echo "              <label for='" . $genId . "'>" . ucfirst($possVal) . "</label>\r\n";
      echo "            </div>\r\n";
      echo "            <div style='clear:both;'></div>\r\n";
      echo "          </div>\r\n";
      // End a column div and start another if it's time.
      if (($rowIndex >= $itemsPerCol) && ($itemsDisplayed < $itemCount)) { 
        $rowIndex = 0;
        echo "        </div>\r\n";
        echo "        <div style='float:left;'>\r\n";
      }
    }    
    echo "        </div>\r\n";
    echo "          <div style='clear:both;'></div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear: both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END RadioButtonWidgetRow -->\r\n";
  }
  
  // NOTE TODO: This is the only such function with the $disable arg. Fix?
  public static function addPermissionsWidgetRow($dataArray) {
    // TODO Generalize for Admin & Submitter
    echo "<!-- PermissionsWidgetRow:  -->\r\n";
    if (isset($dataArray['callForEntries']) && $dataArray['callForEntries'] != null) {
      $callId = $dataArray['callForEntries'];
      $permissionAskMeString = SSFRunTimeValues::getPermissionAskMeString($callId);
      $permissionAskMeDisplay = SSFRunTimeValues::getPermissionAskMeDisplay($callId);
      $permissionAllOKString = SSFRunTimeValues::getPermissionAllOKString($callId);
      $permissionAllOKDisplay = SSFRunTimeValues::getPermissionAllOKDisplay($callId);
      $permissionsAtSubmission = isset($dataArray['permissionsAtSubmission']) ? $dataArray['permissionsAtSubmission'] : 'X';
      $permissionAllOKStringId = HTMLGen::genId($permissionAllOKString);
      $permissionAskMeStringId = HTMLGen::genId($permissionAskMeString);
      // $d = new SSFDebug; $d->becho('$permissionsAtSubmission',$permissionsAtSubmission);
      echo "<div class='formRowContainer' style='padding-top:0px;'>\r\n";
      echo "  <div class='rowTitleTextWide' style='padding-top:1px;'>Permissions:</div>\r\n";
      $name = DatumProperties::getItemKeyFor('works', 'permissionsAtSubmission');
      echo "  <div class='floatLeft etchedIn' style='padding-top:0px;padding-bottom:3px;'>\r\n";
      echo "    <div style='float:left;padding-top:0px;'>\r\n";
      echo "      <input type='radio' name='" . $name . "' id='" . $permissionAllOKStringId . "' value='" . $permissionAllOKString . "' ";
      echo ($permissionsAtSubmission == $permissionAllOKString) ? 'checked' : '';
      echo ($permissionAllOKString == '') ? " disabled" : "";
      echo " onchange='javascript:userMadeAChange(1);'>\r\n";
      echo "    </div>\r\n";
      echo "    <div class='entryFormRadioButtonLabel' style='float:left;margin-right:20px;'>\r\n";
      echo "      <label for='" . $permissionAllOKStringId . "'>$permissionAllOKDisplay</label>\r\n";
      echo "    </div>\r\n";
      echo "    <div style='float:left;padding-top:0px;'>\r\n";
      echo "      <input type='radio' name='" . $name . "' id='" . $permissionAskMeStringId . "' value='" . $permissionAskMeString . "' ";
      echo ($permissionsAtSubmission == $permissionAskMeString) ? 'checked' : '';
      echo ($permissionAskMeString == '') ? " disabled" : "";
      echo " onchange='javascript:userMadeAChange(1);'>\r\n";
      echo "    </div>\r\n";
      echo "    <div class='entryFormRadioButtonLabel' style='float:left;margin-right:20px;'>\r\n";
      echo "      <label for='" . $permissionAskMeStringId . "'>" . $permissionAskMeDisplay . "</label>\r\n";
      echo "    </div>\r\n";
      echo "    <div style='clear:both;'></div>\r\n";
      echo "  </div>\r\n";
      echo "</div>\r\n";
    }
    if (self::$showFunctionMarkers) echo "<!-- END PermissionsWidgetRow -->\r\n";
  }

  public static function addTextAreaRow($idName, $desc, $initValue, $maxLength, $height, $disable=false) {
    $genId = HTMLGen::genId($idName);
    $descAnteChar = ($desc == '') ? "" : ":";
    echo "<!-- TextAreaRow : " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer' style='margin-top:0px;margin-bottom:0px;'>\r\n";
    // description 
    echo "        <div class='rowTitleTextWide' style='margin-top:0px;'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer'>\r\n";
    echo "          <div style='float:left;'>\r\n";
    echo "            <textarea id=" . $genId . " name=" . $idName . (($disable) ? ' disabled' : '');
    echo " rows='" . $height . "' cols='20' class='entryFormTextAreaField'";  // Was class entryFormTextAreaFieldWide until 2/26/10
    echo " onchange='javascript:userMadeAChange(0);'>" . $initValue . "</textarea>\r\n";
    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END TextAreaRow row -->\r\n";
  }

  public static function addStateZipCountryRow($dataArray, $disable=false) {
    echo "<!-- addStateZipCountryRow: " . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer'>\r\n";
    // State/Province/Region title
    echo "        <div class='rowTitleTextWide'>State/Province/Region:</div>\r\n";
    echo "        <div class='entryFormFieldContainer'>\r\n";
    // State/Province/Region widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . HTMLGen::genId("people_stateProvRegion") . " name=" . "people_stateProvRegion" . " class='entryFormInputFieldShort' style='width:120px;'";
    echo " value='" . $dataArray["stateProvRegion"] . "' maxlength=32" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    // Zip/Postal Code title
    echo "        <div class='rowTitleTextNarrow' style='float:left;min-width:10px;margin-left:14px;margin-top:1px;'>Postal Code:</div>\r\n";
    // Zip/Postal Code widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . HTMLGen::genId("people_zipPostalCode") . " name=" . "people_zipPostalCode" . " class='entryFormInputFieldShorter' style='width:100px;'";
    echo " value='" . $dataArray["zipPostalCode"] . "' maxlength=16" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
/*
    // Country title
    echo "        <div class='rowTitleTextNarrow' style='float:left;width:60px;;margin-left:10px;margin-top:1px;'>&nbsp;&nbsp;&nbsp;Country:</div>\r\n";
    // Country widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . HTMLGen::genId("people_country") . " name=" . "people_country" . " class='entryFormInputFieldShorterYet'";
    echo " value='" . $dataArray["country"] . "' maxlength=32" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
*/
    // postfix    
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    // Country widget
    HTMLGen::addTextWidgetRow('Country', HTMLGen::genId("people_country"), $dataArray["country"], 32, $disable);
    if (self::$showFunctionMarkers) echo "<!-- END StateZipCoRow -->\r\n";
  }

  public static function addOtherContributorRow($title, $roleString, $contributors, $disable=false) {
    echo "<!-- OtherContributorRow " . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer'>\r\n";
    // title
    $titleCooked = ($title == '') ? '' : $title . ':';
    echo "        <div class='rowTitleTextWide'>" . $titleCooked . "</div>\r\n";
    echo "        <div class='entryFormFieldContainer'>\r\n";
    // role title
    echo "        <div class='rowTitleTextNarrow' style='float:left;width:2em;margin-left:4px;margin-top:1px;'>Role:</div>\r\n";
    // role widget
    $roleWidgetName = DatumProperties::getItemKeyFor('workContributors_role', $roleString);
    $roleWidgitId = HTMLGen::genId($roleWidgetName);
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . $roleWidgitId . " name=" . $roleWidgetName 
                            . " class='entryFormInputFieldShorter' style='width:108px'";
    echo " value='" . self::contributorRoleDesc($contributors, $roleString) . "' maxlength=32" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    // contributor title
    echo "        <div class='rowTitleTextNarrow' style='float:left;width:3em;margin-left:14px;margin-top:1px;'>Credit:</div>\r\n";
    // name widget
    $contributorNameWidgetName = DatumProperties::getItemKeyFor('workContributors', $roleString);
    $contributorNameWidgitId = HTMLGen::genId($contributorNameWidgetName);
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . $contributorNameWidgitId . " name=" . $contributorNameWidgetName 
                            . " class='entryFormInputFieldShorter' style='width:116px'";
    echo " value='" . self::contributorWidgetValue($contributors, $roleString) . "' maxlength=32" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    // postfix
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END OtherContributorRow -->\r\n";
  }

  public static function addTextWidgetRowDisabled($desc, $idName, $initValue, $maxLength, $disable=false) {
    echo "<!-- TextWidgetRowDisabled: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    $genId = self::addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, true);
    $controlName = "toggle_" . $idName . "_ability";
    $onClick = 'javascript:enable("' . $genId . '");disable("' . $controlName . '");';
    echo "            <div style='float:left;padding-left:10px;padding-top:0px;'>\r\n";
    echo "              <input type='button' id='" . $controlName . "' name='" . $controlName . "' value='Allow Edit' onClick='" . $onClick . "'>\r\n";
    echo "            </div>\r\n";
//    echo "            <div style='clear:both;'></div>\r\n";
    self::addTextWidgetRowHelper2();
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetRowDisabled -->\r\n";
  }

  public static function addTextWidgetRow($desc, $idName, $initValue, $maxLength, $disable=false) {
    echo "<!-- TextWidgetRow: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    self::addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $disable);
//  echo "            <div style='float:right;padding-left:20px;'>\r\n";
//                 additional widgets go here, one per div             
//  echo "            </div>\r\n";
    self::addTextWidgetRowHelper2();
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetRow -->\r\n";
  }

  public static function addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $disable=false) {
    $genId = HTMLGen::genId($idName);
    $descAnteChar = ($desc == '') ? "" : ":";
    echo "      <div class='formRowContainer'>\r\n";
    echo "        <div class='rowTitleTextWide'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer'>\r\n";
    echo "          <div style='float:left;'>\r\n";
                      // widget goes here
    echo "            <input type='text' id=" . $genId . " name=" . $idName;
    echo " class='" . (($maxLength > 128) ? "entryFormInputFieldWide" : "entryFormInputField") . "'";
    $singleQuoteSensitiveLine = ' value="' . str_replace('"', "", $initValue) . '" maxlength=' . $maxLength . (($disable) ? " disabled" : "");
    echo $singleQuoteSensitiveLine;
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    return $genId;
}

  public static function addTextWidgetRowHelper2() {
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
}

  public static function addTextWidgetTelephonesRow($dataArray, $disable=false) {
    echo "<!-- TextWidgetTelephonesRow " . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer'>\r\n";
    echo "        <div class='rowTitleTextWide' style='float:left;vertical-align:top'>Telephones:</div>\r\n";
    echo "        <div class='entryFormFieldContainer' style='float:left;vertical-align:top'>\r\n";
    $maxLength = 32;
    $phoneTypes = array('phoneVoice' => 'Voice', 'phoneMobile' => 'Mobile', 'phoneFax' => 'Fax' );
    foreach ($phoneTypes as $phoneType => $phoneDesc) {
      echo "      <div>\r\n";
      echo "        <div class='rowTitleTextNarrow' style='float:left;width:60px;'>" . $phoneDesc . ":</div>\r\n";
      echo "        <div class='entryFormFieldContainer' style='float:left'>\r\n";
      echo "          <input type='text' id=" . HTMLGen::genId("people_" . $phoneType) . " name=people_" . $phoneType . " class='entryFormInputFieldShort'";
      echo " style='width:120px;float:left'";
      echo " value='" . $dataArray[$phoneType] . "' maxlength=" . $maxLength . (($disable) ? ' disabled' : '');
      echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
      echo "        </div>\r\n";
      echo "        <div style='clear:both;'></div>\r\n";
      echo "      </div>\r\n";
    }
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetTelephonesRow -->\r\n";
  }

  public static function addRunTimeWidgetsRow($runTime, $disable=false) {
    echo "<!-- RunTimeWidgetsRow " . (($disable) ? " disabled" : "") . " -->\r\n";
    list($hours, $minutes, $runTimeSeconds) = explode(":", $runTime);
    $runTimeMinutes = (60 * $hours) + $minutes; 
    echo "      <div class='formRowContainer'>\r\n";
    // Overall title
    echo "        <div class='rowTitleTextWide'>Run Time:</div>\r\n";
    echo "        <div class='entryFormFieldContainer'>\r\n";
    // Minutes title
    echo "          <div class='rowTitleTextNarrow' style='width:60px;'>Minutes:</div>\r\n";
    // Minutes widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . HTMLGen::genId("works_minutes") . " name=" . "works_minutes" . " class='entryFormInputFieldShort' style='width:40px;'";
    echo " value='" . $runTimeMinutes . "' maxlength=4" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    // Seconds title
    echo "        <div class='rowTitleTextNarrow' style='width:60px;'>Seconds:</div>\r\n";
    // Seconds widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id=" . HTMLGen::genId("works_seconds") . " name=" . "works_seconds" . " class='entryFormInputFieldShorter' style='width:40px;'";
    echo " value='" . $runTimeSeconds . "' maxlength=2" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END RunTimeWidgetsRow -->\r\n";
  }

  private static function getContributorArray($editorSateArray) {
    $contributors = array();
    foreach ($editorSateArray as $contributor) {
      $role = $contributor['role'];
      if (isset($role) && ($role != '')) $contributors[$role] = $contributor;
    }
    return $contributors;
  }

  private static function contributorWidgetValue($contributors, $roleString) {
    $value = '';
    if (isset($contributors[$roleString]['name']) && $contributors[$roleString]['name'] != null) $value = $contributors[$roleString]['name'];
    return $value;
  }

  private static function contributorRoleDesc($contributors, $roleString) {
    $value = '';
    if (isset($contributors[$roleString]['roleDescription']) && $contributors[$roleString]['roleDescription'] != null)
      $value = $contributors[$roleString]['roleDescription'];
    else if (isset($contributors[$roleString]['role']) && $contributors[$roleString]['role'] != null)
      $value = $contributors[$roleString]['role'];
    return $value;
  }

  public static function addContributorWidgetRow($title, $roleString, $contributors, $disable) {
    HTMLGen::addTextWidgetRow($title, DatumProperties::getItemKeyFor('workContributors', $roleString), 
                               self::contributorWidgetValue($contributors, $roleString), 64, $disable);
  }
  
  public static function addContributorWidgetsSection($contributorsArray, $disable=false) {
    echo "<!-- addContributorWidgetsSection " . (($disable) ? " disabled" : "") . " -->\r\n";
//    echo "        <div class='floatLeft etchedIn'>\r\n";
    $contributors = self::getContributorArray($contributorsArray);
    self::debugger()->belch('contributors', $contributors, -1);
//    HTMLGen::addTextWidgetRow('Director', DatumProperties::getItemKeyFor('workContributors', 'Director'), 
//                               self::contributorWidgetValue($contributors, 'Director'), $cols, $disabled);
    HTMLGen::addContributorWidgetRow('CREDITS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Director', 'Director', $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Producer', 'Producer', $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Choreographer', 'Choreographer',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Dance Company', 'DanceCompany',  $contributors, $disable); 
    //HTMLGen::addContributorWidgetRow('Principal Dancers', 'PrincipalDancers',  $contributors, $disable); 
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('workContributors', 'PrincipalDancers'), 'Principal Dancers', 
                               self::contributorWidgetValue($contributors, 'PrincipalDancers'), 256, 1, $disable);
    HTMLGen::addContributorWidgetRow('Music Composition', 'MusicComposition',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Music Performance', 'MusicPerformance',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Camera/Cnmtographer', 'Camera',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Editor', 'Editor',  $contributors, $disable); 
    HTMLGen::addOtherContributorRow('Others', 'Other_1', $contributors, $disable);
    HTMLGen::addOtherContributorRow('', 'Other_2', $contributors, $disable);
    if (self::$showFunctionMarkers) echo "<!-- END addContributorWidgetsSection -->\r\n";
  }

  public static function displayOriginalFormatSelector($originalFormat, $disable) {
    if (self::$showFunctionMarkers) echo "<!-- displayOriginalFormatSelector -->\r\n";
    echo "          <div class='formRowContainer' style='padding-left:0px;padding-top:2px;'>\r\n";
    echo "            <div class='rowTitleTextWide'>Original Format:</div>\r\n";
    echo "            <div class='entryFormFieldContainer'>\r\n";
    echo "              <div>\r\n";
    $stringWithEmbeddedQuotes = 'textField=document.getElementById("originalFormat"); textField.value = "";';
    echo "                <select id='originalFormatSelector' name='originalFormatSelector' style='width:220px' \r\n";
    echo "                         onchange='" . $stringWithEmbeddedQuotes . "'>\r\n";
    $formatOptions = array('selectSomething' => '-- Select --',
                           'miniDV' => 'mini-DV',
                           '16mm' => '16 mm',
                           '8mm' => '8 mm',
                           'super8' => 'Super 8',
                           'hi8' => 'Hi-8',
                           'DVCAM' => 'DVCAM',
                           'HD' => 'High Definition Digital',
                           'HDV' => 'High Definition Video (HDV)',
                           'videoTape3-4' => '3/4&quot; videotape',
                           'motionCapture' => 'Digital Motion Capture',
                           'digitalAnimation' => 'Digital Post Animation',
                           'stopActionAnimation' => 'Stop Action Animation',
                           'other' => 'Other');
    self::displaySelectionOptions($formatOptions, $originalFormat); 
    echo "                </select>\r\n";
    echo "              </div>\r\n";
    echo "            </div>\r\n";
    echo "            <div style='clear:both;'></div>";
    echo "           </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayOriginalFormatSelector -->\r\n";
  }

  public static function displayOrientationSelector($formName, $currentValue) {
    if (self::$showFunctionMarkers) echo "<!-- displayOrientationSelector -->\r\n";
    echo '<select id="orientationSelector" name="orientationSelector" style="width:80px" '; // disabled
    echo 'onchange="' . 'document.' . $formName . '.submit();">' . "\r\n";
    self::displaySelectionOption('people', $currentValue, 'People');
    self::displaySelectionOption('works', $currentValue, 'Works');
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayOrientationSelector -->\r\n";
  }

  private static $callForEntriesSelectionOptions = array();
  
  public static function callForEntriesDescription($callForEntriesId) { 
    if (isset(self::$callForEntriesSelectionOptions[$callForEntriesId])) 
      return self::$callForEntriesSelectionOptions[$callForEntriesId];
    else return '';
  }
  
  public static function displayCallForEntriesSelector($formName, $changeFunction='') {
    if (self::$showFunctionMarkers) echo "<!-- displayCallForEntriesSelector -->\r\n";
    echo '<select id="callForEntriesId" name="callForEntriesId" style="width:170px"' . "\r\n";
//    echo 'onchange="' . str_replace('"', "'", $changeFunction) . ';document.' . $formName . '.submit();">' . "\r\n";
    echo 'onchange="' . 'document.' . $formName . '.submit();">' . "\r\n";
    $selectString = "SELECT callId, name, description from callsForEntries order by dateOfCall desc";
//    SSFDB::debugNextQuery();
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
    self::$callForEntriesSelectionOptions = array();
    self::$callForEntriesSelectionOptions[0] = 'All Events';
    foreach ($rows as $row) self::$callForEntriesSelectionOptions[$row['callId']] = $row['description'];
    self::displaySelectionOptions(self::$callForEntriesSelectionOptions, SSFRunTimeValues::getCallForEntriesId());
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayCallForEntriesSelector -->\r\n";
  }

  private static $personSelectionOptions = array();
  
  public static function personIsInOptionList($personId) { 
    return isset(self::$personSelectionOptions[$personId]);
  }
  
  // returns the id for the unique 
  public static function displayPersonSelector($formName, $stateArray, $changeFunction='') {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayPersonSelector -->\r\n";
    $workOrientation = ($stateArray['orientationSelector'] == 'works');
    if ($workOrientation) {
      $option0 = 'All Submitters';
      $call = SSFRunTimeValues::getCallForEntriesId();
      $callForEntriesWhereClause = (($call != 0) ? "and callForEntries= " . $call . " " : "");
      $selectString = "SELECT personId, lastName, name, loginName from people join works on personId=submitter "
//                    . "where relationship like '%Submitter%' " . $callForEntriesWhereClause
                    . $callForEntriesWhereClause
                    . "group by submitter order by lastName, name";
    } else {
      $option0 = 'All People';
      $selectString = "SELECT personId, lastName, name, loginName from people order by lastName, name";
    }
    //SSFDB::debugNextQuery();
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    echo '<select id="personSelector" name="personSelector" style="width:250px" ';
//    echo 'value="getElementById(\'priorPersonSelection\').value"' . "\r\n";    // commented out 1/3/08
//    echo 'onchange="' . (($changeFunction == "") ? "" : str_replace('"', "'", $changeFunction)) . ";"
    if ($stateArray['orientationSelector'] == 'works') {
      $workRows = SSFQuery::selectWorksFor($stateArray['personSelector']);
      //print_r($workRows);
      // BROKEN because we do not yet know the next person nor the workIdValue until after the selection is made 
      $workRowCount = ((isset($workRows) && ($workRows != '')) ? count($workRows) : 0);
      $workIdValue = ($workRowCount == 1) ? $workRows[0]['workId'] : 0;
      echo 'onchange="' . 'document.getElementById(\'workSelector\').value=' . $workIdValue . ';'
                        . 'document.' . $formName . '.submit();">' . "\r\n";
    } else echo 'onchange="document.' . $formName . '.submit();">' . "\r\n";
    self::$personSelectionOptions = array();
    self::$personSelectionOptions[0] = $option0;
    foreach ($personRows as $personRow) 
      self::$personSelectionOptions[$personRow['personId']] = 
        ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " 
                                                                           : "") 
                                                                           . $personRow['name'];
    self::displaySelectionOptions(self::$personSelectionOptions, $stateArray['personSelector']);
    $personToBe = $stateArray['personSelector'];
    echo '</select>' . "\r\n";
    //$reSubmit = ($workRowCount == 1);
    // What's need here is to resubmit the form. 
    // When I try that, it gets into an infinite reload loop as does the next line of code.
    // The manual apply button achieves this effect.
    //if ($reSubmit) echo '<script type="text/javascript">document.' . $formName . '.submit();</script>' . "\r\n";
    //return $reSubmit;
    if (self::$showFunctionMarkers) echo "<!-- END displayPersonSelector -->\r\n";
    return $personToBe;
  }

  // returns the id for the unique 
  public static function getSubmitterSelector($formName, $selectorName, $initialValue) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN getSubmitterSelector -->\r\n";
    $selectString = "SELECT personId, lastName, name, loginName from people order by lastName, name";
    $personRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $selectorText = '<select id="' . $selectorName . '" name="' . $selectorName . '" style="width:250px">';
    $selectionOptions[0] = '--- SELECT A SUBMITTER ---';
    foreach ($personRows as $personRow) 
      $selectionOptions[$personRow['personId']] = 
        ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " 
                                                                           : "") 
                                                                           . $personRow['name'];
    $selectorText .= self::getSelectionOptionsText($selectionOptions, $initialValue);
    $selectorText .= '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END getSubmitterSelector -->\r\n";
    return $selectorText;
  }

  public static function submitterSelected($stateArray) {
    $submitterSelected = isset($stateArray['personSelector']) 
                         && ($stateArray['personSelector'] != '') 
                         && ($stateArray['personSelector'] != 0);
    return $submitterSelected;
  }

  // TODO When this selector is displayed, if the selection is unique, set state appropriately and submit().
  public static function displayWorkSelector($formName, $stateArray, $workHeader='All Works') {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkSelector -->\r\n";
    //SSFDB::debugNextQuery();
    $rows = SSFQuery::selectWorksFor($stateArray['personSelector']);
    //echo "<br>\r\n rows "; print_r($rows); echo " count(rows)=" . count($rows) . "<br>\r\n";
    $selectionOptions = array();
    $workIdToBe = 0;  // added 1/5/08
    $submitterSelected = self::submitterSelected($stateArray);
    echo '<select id="workSelector" name="workSelector" style="width:250px" ';
    if (count($rows) == 0) {
      echo ' disabled>' . "\r\n";
      $selectionOptions[0] = '-- no works --';
      self::displaySelectionOptions($selectionOptions, 0); // 2/14/10 changed to 0 from $stateArray['workSelector']
      $workIdToBe = 0;  // added 1/5/08
      HTMLGen::debugger()->becho('HHAA', 'workIdToBe:' . $workIdToBe, 0);
    } else if (count($rows) != 1) {
      echo 'onchange="document.' . $formName . '.submit();">' . "\r\n";
      $selectionOptions[0] = $workHeader;
      foreach ($rows as $row) {
        $workSuffix = ($submitterSelected) ? "" : ",&nbsp;BY " . $row['name'];
        //print_r($row['title']); //print_r($workSuffix); 
        $selectionOptions[$row['workId']] = $row['title'] . $workSuffix;
      }
      self::displaySelectionOptions($selectionOptions, $stateArray['workSelector']);
      $workIdToBe = $stateArray['workSelector']; // added 1/5/08 
      HTMLGen::debugger()->becho('HHBB', 'workIdToBe:' . $workIdToBe, 0);
    } else { // since (count($rows) == 1)
      echo '>' . "\r\n";
      $workIdToBe = $rows[0]['workId'];
      HTMLGen::debugger()->becho('HHCC', 'workIdToBe:' . $workIdToBe, 0);
      $workSuffix = ($submitterSelected) ? "" : ",&nbsp;BY " . $rows[0]['name'];
      $selectionOptions[$rows[0]['workId']] = $rows[0]['title'] . $workSuffix;
      self::displaySelectionOptions($selectionOptions, $rows[0]['workId']); 
      // TODO $stateArray['workSelector'] is now INCORRECT, so fix it:
      //$stateArray['workSelector'] = $rows[0]['workId']; This didn't work.
      $script = "document.getElementById('workSelector').value = " . $rows[0]['workId'] . ";";
      //if ($unique) $script .= "document." . $formName . ".submit();";
//      echo "<script type='text/javascript'>" . $script . ";</script>";   commented out 1/3/08
    }
    echo '</select>' . "\r\n";
    HTMLGen::debugger()->becho('HHDD', 'workIdToBe:' . $workIdToBe, 0);
    if (self::$showFunctionMarkers) echo "<!-- END displayWorkSelector -->\r\n";
    return $workIdToBe;  // added 1/5/08
  }

  public static function displayEmailEntryList($queryFilterString, $querySortString, $havingClause) {
    $workRows = SSFQuery::selectCuratedWorksArray($queryFilterString, $querySortString, $havingClause);

    echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
    echo "<tr><td align='right' class='bodyTextOnDarkGray'><!--Key: --><span style='color:#B7E5F7'>Id</span>&nbsp;&nbsp;</td>\r\n    " 
         . "<td align='left' class='bodyTextOnDarkGray'><i><span style='color:#99CCFF'>Title</span>,</i>&nbsp; "
         . "Submitter (Locale) <span style='color:#FFFF66'>Run Time</span>"
         . "  <span style='color:#07EB01;'><b>&#8657;</b> Accepted</span> <span style='color:#CE181F;'><b>&#8659;</b> Rejected</span>"
         . "  <span style='color:#DF7416'>Avg Score</span></td>";
    foreach ($workRows as $workRow) {
      echo "<tr><td align='right' valign='top' class='bodyTextOnDarkGray'>" 
          . HTMLGen::clickableForDetailDisplay($workRow['workId'], "<span style='color:#B7E5F7'>" . $workRow['designatedId'] . "</span>") 
          . "&nbsp;&nbsp;</td>" . "\r\n" . "    <td id='entryId-" . $workRow['workId'] . "' align='left' valign='top' class='bodyTextOnDarkGray'>"
          . self::entryEmailSummaryDisplay($workRow) . "</td></tr>\r\n";
    }
  }

// BEGIN This group of functions supports displayEmailEntryList BEGIN

  public static function emailWasSaved($workRow) {
    $commId = ((isset($workRow['communicationId'])) ? $workRow['communicationId'] : 0);
    $wasSaved = (($commId != 0) && ($commId != ''));
    //echo "commId=" . $commId  . "  wasSaved=" . (($wasSaved) ? 'T' : 'F');
    return $wasSaved;
  }
  
  public static function acceptRejectEmailWasSent($workRow) {
    //$commId = ((isset($workRow['communicationId'])) ? $workRow['communicationId'] : 0);
    //$wasSaved = (($commId != 0) && ($commId != ''));
    $wasSaved = self::emailWasSaved($workRow);
    $wasSent = ((isset($workRow['sent'])) && ($workRow['sent'] == 1));
    $acceptRejectEmailWasSent = ($wasSaved && $wasSent);
    //echo " wasSent=" . (($wasSent) ? 'T' : 'F') . "  acceptRejectEmailWasSent=" . (($acceptRejectEmailWasSent) ? 'T' : 'F') . "<br>\r\n"; 
    return $acceptRejectEmailWasSent;
  }
  
  public static function emailSentMarkupId($workId) { return 'emailSentMarkup-' . $workId; }
  
  // coordinate changes with the javascript function emailSentIconMarkupJS(workId)
  private static function emailSentIconMarkup($workId) {
    return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $workId . ')"><img '
         . 'src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>';
  }
  
  private static function sendEmailIconMarkup($workId, $accepted, $rejected) {
    $kindOf = ($rejected==1) ? ' rejection ' : ' acceptance ';
    $sendKind = 'alt="Send' . $kindOf . 'email." title="Send' . $kindOf . 'email." ';
    return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $workId . ')"><img '
         . 'src="../images/emailSendIcon3.gif" ' . $sendKind . ' width="34" height="18" align="top" border="0" ></a>';
  }
  
  private static function emailSentMarkup($workRow, $workId, $accepted, $rejected) {
    $emailSentMarkup = '';
    if ((($accepted==1) && ($rejected!=1)) || (($accepted!=1) && ($rejected==1)))
      $emailSentMarkup = (self::acceptRejectEmailWasSent($workRow)) 
                       ? self::emailSentIconMarkup($workId) 
                       : self::sendEmailIconMarkup($workId, $accepted, $rejected);
    return $emailSentMarkup;
  }
  
  private static function entryEmailSummaryDisplayXXX($workRow) {
    $avgScore = self::getDbScoreFor($workRow['workId']);
    $workId = $workRow['workId'];
    $accepted = $workRow['accepted'];
    $rejected = $workRow['rejected'];
    return "<i>" . self::clickableForDetailDisplay($workRow['workId'], $workRow['title']) . ",</i> " 
          . $workRow['name'] . " (" . $workRow['city'] . ", " . $workRow['stateProvRegion'] . ", " . $workRow['country'] . ") "
          . "<span style='color:#FFFF66'>" . substr($workRow['runTime'], 1, 7) . "</span> " 
          . self::acceptanceDisplay($accepted, $rejected)
          . "  <span style='color:#DF7416'>" . substr($avgScore, 0, 3) . "</span> "
          . "<span id='" . self::emailSentMarkupId($workId) . "'>" . self::emailSentMarkup($workRow, $workId, $accepted, $rejected) . "</span>";
  }

  private static function entrySummaryLineDisplayWithEmail($workRow) {
    $workId = $workRow['workId'];
    $accepted = $workRow['accepted'];
    $rejected = $workRow['rejected'];
    return self::entrySummaryLineDisplay($workRow) 
           . " <span id='" . self::emailSentMarkupId($workId) . "'>" 
           . self::emailSentMarkup($workRow, $workId, $accepted, $rejected) . "</span>";
  }

// END This group of functions supports displayEmailEntryList END 

   public static function stillImagesNeeded($photoLocation) {
    $stillImagesNeeded = (!isset($photoLocation) || $photoLocation=="");
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|");
    if (!$stillImagesNeeded) $stillImagesNeeded == (stripos($photoLocation, 'CD')===false);
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|    strpos($photoLocation, 'CD')=|" . strpos($photoLocation, 'CD') . "|");
    if (!$stillImagesNeeded) $stillImagesNeeded == (stripos($photoLocation, 'print')===false);
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|    strpos($photoLocation, 'print')=|" . strpos($photoLocation, 'print') . "|");
    return $stillImagesNeeded;
  }
  
  public static function displayEntryStatusFilterSelector($formName, $currentValue) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayEntryStatusFilterSelector -->\r\n";
    echo '<select id="acceptanceFilter" name="AcceptanceFilter" onchange="document.' . $formName . '.submit();">' . "\r\n";
    $selectionOptions = array("inclAll" => "All",
                              "inclAccepted" => "Accepted Only",
                              "inclRejected" => "Rejected Only",
                              "inclUndecided" => "Undecided Only",
                              "inclAccUnd" => "Accepted &amp; Undecided",
                              "inclRejUnd" => "Rejected &amp; Undecided",
                              "inclAccRej" => "Accepted &amp; Rejected",
                              "inclNoScore" => "Unscored Only");
    self::displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayEntryStatusFilterSelector -->\r\n";
  }
  
  public static function displayEntryPropertySortSelector($formName, $selectorId, $selectorName, $currentValue) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayEntryPropertySortSelector -->\r\n";
    echo '<select id="' . $selectorId . '" name="' . $selectorName . '" onchange="document.' . $formName . '.submit()">' . "\r\n";
    $selectionOptions = array('idSort' => 'Id', 
                              'formatSort' => 'Media Format', 
                              'durationSort' => 'Film Duration', 
                              'acceptedSort' => 'Entry Status', 
                              'scoreSortUp' => 'Average Score &#8593;', 
                              'scoreSortDn' => 'Average Score &#8595;', 
                              'titleSort' => 'Film Title', 
                              'submitterSort' => 'Submitter Name', 
                              'countrySort' => 'Country');
    self::displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayEntryPropertySortSelector -->\r\n";
  }  

  public static function displayCurationScoreSelector($selectorId, $selectorName, $currentValue, $curatorId) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayCurationScoreSelector -->\r\n";
    echo '<select id="' . $selectorId . '" name="' . $selectorName . '" onchange="javascript:curatorMadeAChange(' . $curatorId . ');">' . "\r\n";
    $selectionOptions = array('--' => '--', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', 
                                            '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10');
    self::displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayCurationScoreSelector -->\r\n";
  }  

  // Generates the HTML lines for the options of a form selector. Inputs are
  // $selectionOptions, an array where the array key is the option value and 
  // array value is the option display string; and $currentValue is the option 
  // value of the current selection. 
  public static function displaySelectionOptions($selectionOptions, $currentValue) {
    foreach($selectionOptions as $optionKey => $optionValue) {
      self::displaySelectionOption($optionKey, $currentValue, $optionValue);
    }
  }

  public static function getSelectionOptionsText($selectionOptions, $currentValue) {
    $selectionOptionsText = '';
    foreach($selectionOptions as $optionKey => $optionValue) {
       $selectionOptionsText .= self::getSelectionOptionText($optionKey, $currentValue, $optionValue);
    }
    return  $selectionOptionsText;
  }

  // Generates an HTML line for an option of a form selector. Inputs are
  // $stringValue, the option value; $currentValue, the option 
  // value of the current selection; and $displayString, the display string
  // associated with the option value. 
  public static function displaySelectionOption($stringValue, $currentValue, $displayString) {
    //echo "--- public static function displaySelectionOption ---";
    echo self::getSelectionOptionText($stringValue, $currentValue, $displayString);
  }
  
  public static function getSelectionOptionText($stringValue, $currentValue, $displayString) {
    $optionText = '  <option value ="' . $stringValue . '"';
    $optionText .= (($stringValue == $currentValue) ? " selected='selected'" : "");
    $optionText .= '>' . $displayString . '</option>' . "\r\n";
    //echo "optionText=|" . $optionText . "|<br>\r\n";
    return $optionText;
  }
  
  // Generates HTML for person detail.
  public static function displayPersonDetail($personArray, $forAdmin=true) {
    $alwaysDisplay = false;
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayPersonDetail " . (($forAdmin) ? "ForAdmin" : "") . " -->\r\n";
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
      // name
      echo '<div class="datumValue' . (($forAdmin) ? " floatLeft" : "") . '">';
      echo $personArray["name"];
      if ($forAdmin) {
        // recordType
        echo ' <span style="padding-left:2em;color:rgb(223,116,22);">' . ucfirst($personArray["recordType"]) . '</span>';
        // notifyOf
        $notifyOfString = str_replace(',', ", ", $personArray['notifyOf']);
        echo ' <span class="datumDescription" style="padding-left:2em">Notify of: </span>' . $notifyOfString; // 2/1/09
        echo '</div>' . "\r\n";
        // last name & nickname
        $lastName = ((isset($personArray['lastName']) && ($personArray['lastName'] != '')) ? $personArray['lastName'] : "-----");
        $nickName = ((isset($personArray['nickName']) && ($personArray['nickName'] != '')) ? $personArray['nickName'] : "-----");
        echo ' <div class="datumValue floatRight" style="padding-right:4px">[' . $lastName . ', ' . $nickName . ']</div>'  . "\r\n";
        echo ' <div style="clear:both;"></div>'  . "\r\n";
      } else echo '</div>' . "\r\n";
      // organization
      if ($alwaysDisplay || $organizationExists) {
        echo self::getSimpleDataWithDescriptionLine('Organization', $personArray['organization']); 
      }
      // address
      $addressSegmentSeparator = (($forAdmin || !$forAdmin) ? " &bull; " : "<br>\r\n");
      $addressDescription = (($forAdmin || !$forAdmin) ? "Address" : "");
      $valueString = '';
      //echo '<div class="datumValue">' . "\r\n";
      if (!$addressExists && !$countryExists) $valueString .= "No address provided.<br>\r\n";
      if ($addressLine1Exists) $valueString .= $personArray['streetAddr1'] . $addressSegmentSeparator;
      if ($addressLine2Exists) $valueString .= $personArray['streetAddr2'] . $addressSegmentSeparator;
      if ($cityExists) $valueString .= $personArray['city'];
      if ($cityExists && ($stateProvRegionExists || $zipPostalCodeExists)) $valueString .= ", "; 
      if ($stateProvRegionExists) $valueString .= $personArray['stateProvRegion'] . " "; 
      if ($zipPostalCodeExists) $valueString .= $personArray['zipPostalCode']; 
      if ($cityLineOutputExists && $countryExists) $valueString .= $addressSegmentSeparator;
      if ($countryExists) $valueString .= $personArray['country'];
      //echo "</div>\r\n";
      echo self::getSimpleDataWithDescriptionLine($addressDescription, $valueString); 
      // telephones
      $valueString = "<div class='datumDescription floatLeft' style='padding-bottom:0;'>Telephones:</div>\r\n"; // 2/1/09
      $valueString .= "<div style='float:left;'>";
      $phoneSpanMarkup = "<div style='float:left;margin-left:.5em;padding-bottom:0px;'>";
      if ($phoneVoiceExists) $valueString .=  $phoneSpanMarkup . self::getDatumDisplayWDesc("Voice", $personArray['phoneVoice']) . "</div>\r\n";
      if ($phoneMobileExists) $valueString .=  $phoneSpanMarkup . self::getDatumDisplayWDesc("Mobile", $personArray['phoneMobile']) . "</div>\r\n";
      if ($phoneFaxExists) $valueString .=  $phoneSpanMarkup . self::getDatumDisplayWDesc("Fax", $personArray['phoneFax']) . "</div>\r\n";
      if (!$telephonesExist) $valueString .=  "<div class='datumValue floatLeft'>&nbsp;No telephone numbers provided.</div>"; 
      $valueString .=  "</div><div style='clear:both;'></div>\r\n";
      echo self::getSimpleDataWithDescriptionLine('', $valueString); 
      // email
      $emailString = str_replace(array('<', '>'), '', $personArray['email']);
      $valueString = self::getHTMLAnchoredEmailStringFor($personArray['name'], $emailString);
      echo self::getSimpleDataWithDescriptionLine('Email', $valueString); 
      // how heard about us
      if ($alwaysDisplay || (isset($personArray['howHeardAboutUs']) && ($personArray['howHeardAboutUs'] != ''))) {
        echo self::getSimpleDataWithDescriptionLine('How you heard about us', $personArray['howHeardAboutUs']); 
      }
      if ($forAdmin) {
        // relationship(s)
        if ($alwaysDisplay || (isset($personArray['relationship']) && ($personArray['relationship'] != ''))) { 
          $valueString = str_replace(',', ", ", $personArray['relationship']);
          echo self::getSimpleDataWithDescriptionLine('Relationship(s)', $valueString); 
        }
        // role(s)
        if ($alwaysDisplay || (isset($personArray['role']) && ($personArray['role'] != ''))) {
          $valueString = str_replace(',', ", ", $personArray['role']);
          echo self::getSimpleDataWithDescriptionLine('Role(s)', $valueString); 
        }
        // administrative notes
        if ($alwaysDisplay || (isset($personArray['notes']) && ($personArray['notes'] != ''))) {
          $valueString = str_replace(',', ", ", $personArray['notes']);
          echo self::getSimpleDataWithDescriptionLine('Administrative Note(s)', $valueString); 
        }
        // web sites
        if ($alwaysDisplay || (isset($personArray['webSites']) && ($personArray['webSites'] != ''))) {
          $valueString = self::getHTMLAnchorTaggedStringFor($personArray['webSites']);
          echo self::getSimpleDataWithDescriptionLine('Web Site(s)', $valueString); 
        }
      }
    }
    if (self::$showFunctionMarkers) echo "<!-- END displayPersonDetail " . (($forAdmin) ? "ForAdmin" : "") . " -->\r\n";
  }
  
  // Returns a comma-separated string of HTML anchor tagged email addresses
  public static function getHTMLAnchorTaggedStringFor($commaSeparatedListOfURLs) {
    $string = '';
    $tokens = explode(',', $commaSeparatedListOfURLs);
    $tokenCount = count($tokens);
    $iteration = 0;
    foreach ($tokens as $token) {
      $iteration++;
      if (($iteration <= $tokenCount) && ($iteration > 1)) $string .= ', ';
      $token = trim($token);
      $token = trim($token, '<>');
      $HTTPposition = (stripos($token,"http://"));
      //echo 'Token: ' . $token . ' |' . $HTTPposition . "|<br>\r\n";
      $URL = (($HTTPposition !== FALSE) && ($HTTPposition === 0)) ? $token : "http://" . $token;
      $string .= '<a href="' . $URL . '">' . $token . '</a>';
    }
    return $string;
  }
  
  // Returns a comma-separated string of HTML anchor tagged URLs. Strip < and > from 
  // $commaSeparatedListOfAddresses before calling this function.
  public static function getHTMLAnchoredEmailStringFor($recipientName, $commaSeparatedListOfAddresses) {
    //echo 'commaSeparatedListOfAddresses=|' . $commaSeparatedListOfAddresses . "|<br>\r\n";
    $string = '';
    $tokens = explode(',', $commaSeparatedListOfAddresses);
    $tokenCount = count($tokens);
    $iteration = 0;
    foreach ($tokens as $token) {
      $iteration++;
      if (($iteration <= $tokenCount) && ($iteration > 1)) $string .= ', ';
      $token = trim($token);
      $string .= '<a href="mailto:' . $recipientName . ' &lt;' . $token . '&gt;">' . $token . '</a>';
    }
    return $string;
  }
  
  // Generates HTML for the work detail. Parameter $workArray must contain workId.
  public static function displayWorkDetailForAdmin($workArray, $contributorsArray, $forAdmin=true) {
    $alwaysDisplay = (($forAdmin) ? false : true);
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkDetailForAdmin -->\r\n";
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // title, year, runtime, titleForSort
      $titleForSortString = ((isset($workArray['titleForSort']) && ($workArray['titleForSort'] != ''))
                          ? '[' . $workArray['titleForSort'] . ']' : '[no title for sort]');
      echo "<div>\r\n" 
           . '<div class="datumValue floatLeft">' . $workArray['title'] . ' (' . $workArray['yearProduced'] 
           . ')<span class="datumDescription" style="margin-left:2em;">run time: </span>' 
           . $workArray['runTime']
           . (($workArray['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'>  LIVE</span>" : "")
           . (($workArray['invited'] == 1) ? "<span class='liveDisplayText'>  INVITED</span>" : "") . '</div>' . "\r\n"
           . '<div class="datumValue floatRight" style="padding-right:4px;">' . $titleForSortString . '</div>' . "\r\n"
           . '<div style="clear:both;"></div>' . "\r\n</div>\r\n";
      // media received
      echo "<div>\r\n" . self::getMediaReceivedDisplayElement($workArray['dateMediaReceived']) . "\r\n<div style='clear:both;'></div>\r\n</div>\r\n";
      // submission & original formats
      echo self::getMediaFormatsDisplayLine($workArray['submissionFormat'], $workArray['originalFormat']);
      // work contributors
      $displayContributorsOnSeparateLines = true;
      self::debugger()->belch('contributorsArray in HTMLGen::displayWorkDetailForAdmin()', '$contributorsArray', -1);
      echo self::getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);
      // synopsis
      echo self::getSimpleDataWithDescriptionLine('Synopsis', self::getSynopsisFrom($workArray));
      // web site
      if ($alwaysDisplay || $workArray['webSite'] != '') echo self::getWebSiteDisplayLine($workArray['webSite'], $workArray['webSitePertainsTo']);
      // previously shown at
      if ($alwaysDisplay || $workArray['previouslyShownAt'] != '') 
        echo self::getSimpleDataWithDescriptionLine('Also shown at', $workArray['previouslyShownAt']);
      // photo credits
      if ($alwaysDisplay || $workArray['photoCredits'] != '')
        echo self::getSimpleDataWithDescriptionLine('Photos by', $workArray['photoCredits']);
      // photo location
      if ($alwaysDisplay || $workArray['photoLocation'] != '')
        echo self::getSimpleDataWithDescriptionLine('Photo location', $workArray['photoLocation']);
      // payment info
      $pmtString = '';
      if (isset($workArray['amtPaid']) && ($workArray['amtPaid'] != '')) $pmtString .= '$' . $workArray['amtPaid'] . ' paid via ';
      $paid = isset($workArray['howPaid']) && ($workArray['howPaid'] != '');
      if (!$paid) $pmtString .= '<span class="orangishHighlightDisplayColor">only god knows!</span>';
      else {
        if ($workArray['howPaid'] == 'notPaid' || $workArray['howPaid'] == 'waived') {
          $pmtString = $workArray['howPaid'];
        } else { 
          $pmtString .= $workArray['howPaid'];
        }
        if ($workArray['howPaid'] != 'notPaid' && $workArray['howPaid'] != 'waived' 
                                               && $workArray['howPaid'] != 'cash' && $workArray['howPaid'] != 'other'
                                               && isset($workArray['checkOrPaypalNumber']) && ($workArray['checkOrPaypalNumber'] != ''))
          $pmtString .= ' #' . $workArray['checkOrPaypalNumber'];
        if ($workArray['howPaid'] != 'notPaid' && (isset($workArray['datePaid']) && ($workArray['datePaid'] != '')) 
                                 && $workArray['datePaid'] != '0000-00-00')
          $pmtString .= ' on ' . $workArray['datePaid'];
      }
      echo self::getSimpleDataWithDescriptionLine('Payment Information', $pmtString);
      // release info
      echo self::getSimpleDataWithDescriptionLine('Release Information', $workArray['permissionsAtSubmission']);
      // notes
      if (isset($workArray['submissionNotes']) && $workArray['submissionNotes'] !== '')
        echo self::getSimpleDataWithDescriptionLine('Submission Notes', $workArray['submissionNotes']);
      if (isset($workArray['workNotes']) && $workArray['workNotes'] !== '')
        echo self::getSimpleDataWithDescriptionLine('Work Notes', $workArray['workNotes']);
      if (isset($workArray['mediaNotes']) && $workArray['mediaNotes'] !== '')
        echo self::getSimpleDataWithDescriptionLine('Media Notes', $workArray['mediaNotes']);
    }
    if (self::$showFunctionMarkers) echo "<!-- END displayWorkDetailForAdmin -->\r\n";
  }
  
  public static function mediaReceived($dateMediaReceived) {
    $mediaReceived = isset($dateMediaReceived) && ($dateMediaReceived != '') && $dateMediaReceived != '0000-00-00';
    return $mediaReceived;
  }

  public static function getMediaReceivedDisplayElement($dateMediaReceived) {
    $displayString = '';
    if (!self::mediaReceived($dateMediaReceived)) 
      $displayString .= '<div class="datumDescription">Media <span class="orangishHighlightDisplayColor">'
                      . 'NOT received</span> or at least <span class="orangishHighlightDisplayColor">NOT checked in</span>.</div>';
    else $displayString .= self::getSimpleDataWithDescriptionLine('Media received', $dateMediaReceived);
    return $displayString;
  }

  public static function getWebSiteDisplayLine($webSiteString, $webSitePertainsTo=null) {
    if ( $webSiteString != '') {
      $valueString = '';
      $HTTPposition = (stripos($webSiteString,"http://"));
      $URL = (($HTTPposition !== FALSE) && ($HTTPposition == 0)) ? $webSiteString : "http://" . $webSiteString;
      $valueString .= "<a href='" . $URL . "'>" . $webSiteString . "</a>";
      if (isset($webSitePertainsTo) && ($webSitePertainsTo != '')) 
        $valueString .= " pertains to <span class='orangishHighlightDisplayColor'>" . $webSitePertainsTo . '</span>.';
      return HTMLGen::getSimpleDataWithDescriptionLine('Website', $valueString);
    }
  }

  public static function getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines=false) {
    $displayString = '';
    $displayString .= '<!-- display Contributor Information -->' . "\r\n";
    $separator1 = (($displayContributorsOnSeparateLines) ? '<br>' : ' ');
    $displayString .= '<div class="datumValue floatLeft" style="width:98%;padding-top:1px;"><div class="datumDescription floatLeft">Credits: '
                   . $separator1 . '</div>' . "\r\n";
    $contributorsDisplayed = 0;
    self::debugger()->belch('contributorsArray in HTMLGen::getContributorDisplayLines()', $contributorsArray, -1);
    if (!is_null($contributorsArray)) {
      $contributorsArraySize = 0;
      foreach ($contributorsArray as $contributor) { if ($contributor['name'] != '') $contributorsArraySize++; }
      if ($contributorsArraySize > 0) {
        $displayString .= '<div class="datumValue floatLeft" style="margin-left:1em;width:82%;padding-bottom:0;">';
        foreach ($contributorsArray as $contributor) { 
          if ($contributor['name'] != '') { 
            $role = ($contributor['optionalContributor']) ? $contributor['roleDescription'] : $contributor['role'];
            $contributorsDisplayed++;
            if ($displayContributorsOnSeparateLines) {
              $displayString .= "<div style='max-width:98%;'><span class='datumDescription'>" . $role .": </span>" . $contributor['name'] . "</div>\r\n";
            } else {
              $separator2 = (($contributorsDisplayed == $contributorsArraySize) ? "" : ", ");
              $displayString .= "<span class='datumDescription'>" . $contributor['role'] .":&nbsp;</span>" 
                             . $contributor['name'] . $separator2 . "\r\n";
            }
          }
        }
        $displayString .= '</div>';
      }
    }
    if ($contributorsDisplayed == 0) 
      $displayString .= "<div class='datumValue floatLeft' style='padding-bottom:0;'>&nbsp;No contributors are listed.</div>"; // 2/1/09
    $displayString .= "</div>\r\n<div style='clear:both;'></div>\r\n";
    return $displayString;
  }

  public static function getAllContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines=false) {
    $displayString = '';
    $displayString .= '<!-- display All Contributor Information -->' . "\r\n";
    //$separator1 = (($displayContributorsOnSeparateLines) ? '<br>' : ' ');
    $separator1 =' ';
    $displayString .= '<div class="datumValue floatLeft" style="width:98%;padding-top:1px;"><div class="datumDescription floatLeft">Credits: '
                   . $separator1 . '</div>' . "\r\n";
    $displayString .= '<div class="datumValue floatLeft" style="margin-left:1em;width:82%;padding-bottom:3px;">';
    $roleKeys = DatumProperties::workContributorRoleKeys();
    $contributors = self::getContributorArray($contributorsArray);
    foreach ($roleKeys as $roleKey) { 
      $optionalContributor = (stripos($roleKey, 'Other_') !== false);
      $rawNameString = self::contributorWidgetValue($contributors, $roleKey);
      $nameString = ($rawNameString != '') ? $rawNameString : '---';
      $roleString = ($optionalContributor) ? self::contributorRoleDesc($contributors, $roleKey) : $roleKey;
      if (!$optionalContributor || ($roleString != '') || ($nameString != '')) {
        $displayString .= '<div class="datumValue floatLeft" style="margin-left:1em;width:82%;padding-bottom:0;">';
        if ($displayContributorsOnSeparateLines) {
          $displayString .= "<span class='datumDescription'>" . $roleString .": </span>" . $nameString;
        } else {
          $separator2 = (($contributorsDisplayed == $contributorsArraySize) ? "" : ", ");
          $displayString .= "<span class='datumDescription'>" . $roleString .":&nbsp;</span>" 
                         . $nameString . $separator2 . "\r\n";
        }
        $displayString .= "</div>\r\n";
      }
    }
    $displayString .= "<div style='clear:both;'></div>\r\n</div>\r\n<div style='clear:both;'></div></div>\r\n";
//    $displayString .= "<div style='clear:both;'></div>\r\n</div>\r\n";
    return $displayString;
  }

  // Generates HTML for the work detail. Parameter $workArray must contain workId.
  public static function displayWorkDetail($workArray, $contributorsArray) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkDetail -->\r\n";
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // title, year, runtime
      echo '<div class="datumValue">' . $workArray['title'] . ' (' . $workArray['yearProduced'] 
           . ')<span class="datumDescription" style="margin-left:2em;">run time: </span>' 
           . $workArray['runTime'] . '<br></div>' . "\r\n";
      // submission & original formats
      echo '<div class="datumValue"><span class="datumDescription">Submitted as </span>' 
           . $workArray['submissionFormat'] . '<span class="datumDescription">. Originally recorded as </span>' 
           . $workArray['originalFormat'] . '<br></div>' . "\r\n";
      echo "\r\n";
      // work contributors
      echo '<!-- display Contributor Information -->' . "\r\n";
      $displayContributorsOnSeparateLines = true;
      echo self::getAllContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);
      // synopsis
      echo '<div class="datumValue"><span class="datumDescription">Synopsis: </span>' . $workArray['synopsisOriginal'] . "</div>\r\n";
      // web site
      if ($workArray['webSite'] != '') echo self::getWebSiteDisplayLine($workArray['webSite'], $workArray['webSitePertainsTo']);
      // previously shown at
      if ($workArray['previouslyShownAt'] != '') 
        echo '<div class="datumValue"><span class="datumDescription">Also shown at: </span>' . $workArray['previouslyShownAt'] . "</div>\r\n";
      // photo credits
      if ($workArray['photoCredits'] != '')
      echo '<div class="datumValue"><span class="datumDescription">Photos by: </span>' . $workArray['photoCredits'] . "</div>\r\n";
      // payment info
      echo '<div class="datumValue"><span class="datumDescription">Payment Information: </span>Paid via ';
      if ($workArray['howPaid'] == "paypal") echo "Paypal. (<a href='../paypal/index.html'>pay now</a>)<br>";
      else echo "check or money order in US Dollars sent via post with media.<br>";
      echo "</div>\r\n";
      // release info
      echo '<div class="datumValue"><span class="datumDescription">Release Information: </span>';
      $releaseInfo = "You have certified that you hold all necessary rights for the submission of this entry and that you give Sans Souci "
                   . "Festival permission for screening this submission at the Dairy Center for the Arts in Boulder Colorado USA on March 20 &amp; 21, 2009";
      if ($workArray['permissionsAtSubmission'] == "allOK2009")                                   // << TODO This should not be hard-coded
        $releaseInfo .= " and also at all tours associated with the 2009 Season in the US and elsewhere."; 
      else $releaseInfo .= ". As we make such arrangements, we may invite you to each subsequent tour/venue separately so that you can respond to each individually.";
      echo $releaseInfo . "</div>\r\n";
      // items for administrative completion
        // titleForSort, designatedId, dateMediaReceived, datePaid, amtPaid, howPaid, checkOrPaypalNumber, webSitePertainsTo, photoLocation
    }
    if (self::$showFunctionMarkers) echo "<!-- END displayWorkDetail -->\r\n";
  }
  
  public static function getTheWorkRows($works, $withEmailInfo=false) {
    // Display the list of works.
    $titleStyleString = "line-height:14px;padding-bottom:2px;border-bottom:1px #999 solid;background-color:#5a2940;vertical-align:top;";
    $theRowsHTML = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\r\n";
    // Display the legend line/title.
    $theRowsHTML .= "<tr><td align='right' class='bodyTextOnDarkGray' "
         . "style='width:4em;" . $titleStyleString . "'>\r\n"
         . "<span class='designatedIdDisplayText'>Id</span>&nbsp;&nbsp;</td>\r\n" 
         . "<td align='left' class='bodyTextOnDarkGray' style='" . $titleStyleString . "'>"
         . "  <i><span style='color:#99CCFF'>Title</span>,</i>&nbsp; \r\n"
         . "Submitter (Locale) <span class='submissionFormatDisplayText'>Submssn Format</span> / <span class='originalFormatDisplayText'>Orignl Format</span> \r\n"
         . "<span class='runTimeDisplayText'>Run Time</span>"
         . "  <span class='acceptedDisplayColor'><b>&#8657;</b> Accepted</span> \r\n"
         . "<span class='rejectedDisplayColor'><b>&#8659;</b> Rejected</span>"
         . "  <span class='scoreDisplayText'>Avg Score</span></td></tr>"
         . "<tr><td><div style='margin-bottom:.25em;'></div></td></tr>\r\n";

    // Display each work.
    $rowStyleString = 'line-height:17px;padding-bottom:4px;';
    foreach ($works as $work) {
      $theRowsHTML .= "<tr><td align='right' valign='top' class='bodyTextOnDarkGray' style='" . $rowStyleString . "'>" 
          . self::clickableForDetailDisplay($work['workId'], 
                                            "\r\n      <span style='color:#B7E5F7;overflow:visible'>" . $work['designatedId'] . "</span>") 
          . "&nbsp;&nbsp;</td>\r\n    <td id='entryId-" . $work['workId'] 
          . "' align='left' valign='top' class='bodyTextOnDarkGray' style=" . $rowStyleString . ">"
          . (($withEmailInfo) ? self::entrySummaryLineDisplayWithEmail($work) : self::entrySummaryLineDisplay($work))
          . "</td></tr>\r\n";
    }
    $theRowsHTML .=  "</table>\r\n";
    return $theRowsHTML;
  }  

  private static function clickableForDetailDisplay($workIdToDisplay, $clickableString) {
    return "<a href='#bottom' onclick='selectEntry(" . $workIdToDisplay . ");'>" . $clickableString . "</a>";
  }

  public static function originalFormatDisplay($originalFormatString) {
    if ($originalFormatString == 'selectSomething') return '---'; else return $originalFormatString;
  }
  
  // Generate the totals information
  public static function getTotalsDisplay($works) {
    //$revenueSelectString = "select sum(amtPaid) as revenue from works where callForEntries=" . SSFRunTimeValues::getCallForEntriesId();
    //$revenueArray = SSFDB::getDB()->getArrayFromQuery($revenueSelectString);
    $totalRevenue = 0;
    $durations = array();
    foreach ($works as $work) {
      $totalRevenue += $work['amtPaid'];
      array_push($durations, $work['runTime']);
    }
    $totalsDisplay = count($durations) . " films<br>with a total run time of " . self::totalRunTime($durations)
                   . "<br>generating $" . $totalRevenue . " in revenue.";
    return $totalsDisplay;
  }

  public static function cityStateCountryString($city, $stateProvRegion, $country) {
    $cityExists = isset($city) && ($city != '');
    $stateProvRegionExists = isset($stateProvRegion) && ($stateProvRegion != '');
    $countryExists = isset($country) && ($country != '');
    $resultString = "";
    if ($cityExists && ($stateProvRegionExists || $countryExists)) $resultString .= $city . ", ";
    if ($stateProvRegionExists && $countryExists) $resultString .= $stateProvRegion . ", ";
    $resultString .= $country;
    return  $resultString;
  }
  
  private static function entrySummaryLineDisplay($workRow) {
    $avgScore = self::getDbScoreFor($workRow['workId']);
    return "<i>" . self::clickableForDetailDisplay($workRow['workId'], $workRow['title']) 
          . " <span class='idDisplayText'>" . $workRow['workId'] . "</span>,</i> \r\n" 
          . ((!self::mediaReceived($workRow['dateMediaReceived'])) ? "<span class='noMediaDisplayColor'>&#8855;</span> \r\n" : "")
          . "      " . $workRow['name'] 
          . " (" . self::cityStateCountryString($workRow['city'], $workRow['stateProvRegion'], $workRow['country']) . ") " 
          . "<span class='submissionFormatDisplayText'>" . $workRow['submissionFormat'] . "</span>/" 
          . "<span class='originalFormatDisplayText'>" . self::originalFormatDisplay($workRow['originalFormat']) . "</span> "
          . "<span class='runTimeDisplayText'>" . substr($workRow['runTime'], 1, 7) . "</span> \r\n" 
          . (($workRow['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'> Live</span> \r\n" : "")
          . "      " . self::acceptanceDisplay($workRow['accepted'],$workRow['rejected'])
          . "  <span class='scoreDisplayText'>" . substr($avgScore, 0, 3) . "</span>";
  }
  
  public static function getDbScoreFor($workId) {
    // SFDB::debugNextQuery();
    $avgScore = '---';
    $avgScoreQueryString = "SELECT avg(score) as avgscore from curation where entry=" . $workId;
    $avgScoreArray = SSFDB::getDB()->getArrayFromQuery($avgScoreQueryString);
    if (SSFDB::getDB()->querySuccess() && count($avgScoreArray) == 1) $avgScore = $avgScoreArray[0]['avgscore'];
    if ($avgScore == '') $avgScore = '---';
    return $avgScore;
  }

  public static function acceptanceDisplay($accepted, $rejected) {
    if ($accepted==1) $a = "<span class='acceptedDisplayColor'>&#8657;</span>"; else $a = "&#8657;";
    if ($rejected==1) $r = "<span class='rejectedDisplayColor'>&#8659;</span>"; else $r = "&#8659;";
    return "<span style='font-weight:bold;'>" . $a . "&nbsp;" . $r . "</span>";
  }
  
  public static function acceptanceOperatorDisplay($workId, $accepted, $rejected) {
    if ($accepted==1) $a = "<span style='color:#07EB01;'>&#8657;</span>"; else $a = "&#8657;";
    if ($rejected==1) $r = "<span style='color:#CE181F;'>&#8659;</span>"; else $r = "&#8659;";
    if (($accepted===0) && ($rejected===0)) $c = "<span style='color:yellowish;'>&#8855;</span>"; else $c = "&#8855;"; // "&#8226;";
    return "<span style='font-weight:bold;'>" 
           . "<a class='acceptEntryOperator' href=# onclick='acceptEntry($workId)'><span style='font-size:1.25em;'>$a</span></a> "
           . "<a class='clearEntryStatusOperator' href=# onclick='clearEntryStatus($workId)'><span style=''>$c</span></a> " 
           . "<a class='rejectEntryOperator' href=# onclick='rejectEntry($workId)'><span style='font-size:1.25em;'>$r</span></a>"
           . "</span>";
  }
  
  // $duration is an array of durations in the form hh:mm:ss
  // returns the total of durations in the form  hh:mm:ss
  private static function totalRunTime($duration) { 
    $hoursTotal = 0;
    $minutesTotal = 0;
    $secondsTotal = 0;
    foreach ($duration as $runTimeString) {
      list($hours, $minutes, $seconds) = explode(":", $runTimeString);
      //echo ' hours=' . $hours . ' minutes=' . $minutes . ' seconds=' . $seconds . "<br>\r\n";
      $hoursTotal += $hours;
      $minutesTotal += $minutes;
      $secondsTotal += $seconds;
    }
    //echo ' hoursTotal=' . $hoursTotal . ' minutesTotal=' . $minutesTotal . ' secondsTotal=' . $secondsTotal . "<br>\r\n";
    $secondsModMinutes = $secondsTotal % 60;
    $minutesTotal += floor($secondsTotal / 60);
    $minutesModHours = $minutesTotal % 60;
    $hoursTotal += floor($minutesTotal / 60);
    //echo ' secondsModMinutes=' . $secondsModMinutes . ' minutesTotal=' . $minutesTotal .
    //     ' minutesModHours=' . $minutesModHours . ' hoursTotal=' . $hoursTotal . "<br>\r\n";
    $string = sprintf("%u:%'02u:%'02u",$hoursTotal,$minutesModHours,$secondsModMinutes);
    //echo ' time string=' . $string . "<br>\r\n";
    $string = str_replace("'", "", $string); // strip embedded single quotes
    return $string;
  }
  
  public static function getSynopsisFrom($workArray) {
 		$synopsis = '';
 		if (isset($workArray['synopsisEdit2']) && ($workArray['synopsisEdit2'] != '')) $synopsis = $workArray['synopsisEdit2'];
		if (($synopsis == '') && isset($workArray['synopsisEdit1']) && ($workArray['synopsisEdit1'] != '')) $synopsis = $workArray['synopsisEdit1'];
		if (($synopsis == '') && isset($workArray['synopsisOriginal']) && ($workArray['synopsisOriginal'] != '')) $synopsis = $workArray['synopsisOriginal'];
    return $synopsis;
  }
  
  public static function progPageDisplayShowIndex($showArray, $center=false) {
    self::debugger()->belch('displayShowIndex($showArray)', $showArray, -1);
	  $align = ($center) ? 'center' : 'left';
		echo '<tr>';
		echo '<td align="' . $align . '" colspan="3" class="bodyTextOnBlack" style="text-size=6px;padding:20px 0 24px 0;">|';
		foreach ($showArray as $show) {
		  echo '&nbsp;<a href="#' . self::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>&nbsp;|';
		}
		echo '&nbsp;&nbsp;</td></tr>' . "\r\n";
  }

	// Insert the name anchor for the show for on-page navigation from the index of shows.
	public static function progPageDisplayShowDescription($showId, $text) {
		echo '<tr align="left">' . "\r\n";
		echo '	<td height="10" colspan="3" valign="top"  class="programInfoText"><a name="' . self::genShowIdTag($showId) 
		          . '"></a>' . $text . '<br clear="all">' . "\r\n";
		echo '		<img src="../images/dotClear.gif" alt="" width="1" height="10"></td>' . "\r\n";
		echo '</tr>' . "\r\n";
		//echo '<tr><td colspan="3" height="36" align="center" valign="top" class="bodyText">&nbsp;</td></tr>' . "\r\n";
	}
	
	public static function progPageDisplayWork($index, $workRow, $imageDirectoryFiles, $programPicBorderWidth, 
	                     $emptyImageDefaultHeightInPixels, $emptyImageDefaultWidthInPixels) {
	  $filmInfoDivSpanText = '<div class="filmInfoText"><span class="filmInfoSubtitleText">';
	  $title = $workRow['title'];
	  
	  // define image parameters
    // NOTE: do not use $workRow['tablename.whatever'], just use $workRow['whatever']
    if ($workRow['fileName'] != '') {
      $imageFileName = $workRow['fileName'];
			$imageDirectory  = '../' . $workRow['directory'];
      $imageHeightInPixels = $workRow['heightInPixels'];
      $imageWidthInPixels = $workRow['widthInPixels'];
      if (stripos($imageDirectoryFiles, $imageDirectory . $imageFileName) === false) {
        $imageAltText = '';
        $imageTitleText = 'File ' . $imageDirectory . $imageFileName . ' is missing.';
        $imageCaption = '';
      } else {
        $imageTitleText = $imageAltText = $workRow['altText'];
        $imageCaption = $workRow['caption'];
      }
	  } else {
   	  $imageFileName = 'emptyImage.gif';
   	  $imageDirectory = '../images/';
	    $imageHeightInPixels = $emptyImageDefaultHeightInPixels;
	    $imageWidthInPixels = $emptyImageDefaultWidthInPixels;
	    $imageTitleText = $imageAltText = '';
      $imageCaption = '';
	  }
	  
	  // , includes live performance,
	  $liveText = '';
	  if ($workRow['includesLivePerformance'] == 1) $liveText = '<span class="filmLiveText">includes live performance, </span>';
	  
    // compute $runTimeMinutes
	  list($hours, $minutes, $seconds) = sscanf($workRow['runTime'], "%d:%d:%d");
	  $runTimeMinutes = $minutes + (60 * $hours);
	  if ($seconds >= 31) $runTimeMinutes++; 
	  // while ($runTime[0] == '0' || $runTime[0] == ':') $runTime = substr($runTime, 1);
	  
	  // define $originalFormat
    $originalFormat = ($workRow['originalFormat'] == 'selectSomething') ? '' : ', ' . $workRow['originalFormat'];

    // define $synopsis
		$synopsis = self::getSynopsisFrom($workRow);

    // define $cityStateCountry
    $cityStateCountry = '';
	  $separator = '';
	  $city = $workRow['city'];
	  if ($city != '' ) { 
	    $cityStateCountry = $city; 
	    $separator = ', '; 
	  }
	  $stateProvRegion = $workRow['stateProvRegion'];
	  if ($stateProvRegion == $city) $stateProvRegion = '';
	  if ($stateProvRegion != '') {
	    $cityStateCountry .= $separator . $stateProvRegion;
	    $separator = ', '; 
	  }
	  if ($workRow['country'] != '') $cityStateCountry .= $separator . $workRow['country'];

		// define Contributor Displays
		$contributorSelectAllRows = SSFQuery::selectContributorsFor($workRow['workId'], $useListingOrder = true);
		$contributorRowsDisplayed = 0;
		$director = '';
		$producer = '';
		$choreographer = '';
		$danceCompany = '';
		$principalDancers = '';
		$musicComposer = ''; 
		$musicPerformer = '';
		$contributorRole1 = '';
		$contributorName1 = '';
		$contributorRole2 = '';
		$contributorName2 = '';
		foreach ($contributorSelectAllRows as $contributorRow) { 
			if ($contributorRow['role'] == 'Director') $director = $contributorRow['name'];
			else if ($contributorRow['role'] == 'Producer') $producer = $contributorRow['name'];
			else if ($contributorRow['role'] == 'Choreographer') $choreographer = $contributorRow['name'];
			else if ($contributorRow['role'] == 'DanceCompany') $danceCompany = $contributorRow['name'];
			else if ($contributorRow['role'] == 'PrincipalDancers') $principalDancers = $contributorRow['name'];
			else if ($contributorRow['role'] == 'MusicComposition') $musicComposer = $contributorRow['name']; 
			else if ($contributorRow['role'] == 'MusicPerformance')  $musicPerformer = $contributorRow['name'];
			else if ($contributorRole1 == "") {
				$contributorRole1 = $contributorRow['role'];
				$contributorName1 =  $contributorRow['name'];
			} else {
				$contributorRole2 = $contributorRow['role'];
				$contributorName2 =  $contributorRow['name'];
			}
		}
		$prodEqDir = ($director == $producer);
		$chorEqDancer = ($choreographer == $principalDancers);
		$performerEqComposer = ($musicComposer == $musicPerformer);
		
		$webSite = ((isset($workRow['webSite'])) ? $workRow['webSite'] : '');
		if ($webSite  != '' && strripos($webSite, 'http') === false) $webSite = 'http://' . $webSite;
		if ($webSite != '') switch ($workRow['webSitePertainsTo']) {
			case "director":      $director = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($director) . "</a>"; break;
			case "producer":      $producer = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($producer) . "</a>"; break;
			case "choreographer": $choreographer = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($choreographer) . "</a>"; break;
			case "company":       $danceCompany = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($danceCompany) . "</a>"; break;
			case "movie":         $title = "<a href='" . $webSite . "'>" . HTMLGen::htmlEncode($title) . "</a>"; break;
		}

		$directorTitle = ($prodEqDir) ? 'Produced and Directed by ' : 'Directed by ';
		$directorDisplay = ($director == '') ? '<!-- No director given. -->' 
																				 : $filmInfoDivSpanText . $directorTitle . ' </span>' . $director . '</div>';
		$producerDisplay = ($producer == '') ? '<!-- No producer given. -->' 
																					: ($prodEqDir) ? '<!-- Producer same as director. -->'
																												 : $filmInfoDivSpanText . 'Produced by </span>' . $producer . '</div>'; 
		$choreoTitle = ($chorEqDancer) ? 'Choreography and dancing by ' : 'Choreography by ' ;    
		$choreoDisplay = ($choreographer == '') ? '<!-- No choreographer given. -->'
																						: $filmInfoDivSpanText . $choreoTitle . '</span>' . $choreographer . '</div>';
		$companyDisplay = ($danceCompany == '') ? '<!-- No company given. -->'
																						: $filmInfoDivSpanText . 'Featuring </span>' . $danceCompany . '</div>';
		$dancersDisplay = ($principalDancers == '') ? '<!-- No dancers given. -->'
																								: ($chorEqDancer) ? '<!-- Dancer is choreographer. -->'
																																	: $filmInfoDivSpanText . 'Dancing by </span>' 
																																	                       . HTMLGen::htmlEncode($principalDancers) . '</div>';
		$musicTitle = ($performerEqComposer) ? 'Music by ' : 'Music composed by ';
		$musicCompDisplay = ($musicComposer ==  '') ? '<!-- No composer given. -->'
																								: $filmInfoDivSpanText . $musicTitle . ' </span>' . HTMLGen::htmlEncode($musicComposer) . '</div>';
		$musicPerfDisplay = ($musicPerformer ==  '') ? '<!-- No music performer given. -->'
																								 : ($performerEqComposer) ? '<!-- Music composer same as performer. -->'
																																					: $filmInfoDivSpanText . 'Music performed by </span>' 
																																					                       . HTMLGen::htmlEncode($musicPerformer) . '</div>';
		$otherContributor1Display = ($contributorRole1 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . HTMLGen::htmlEncode($contributorRole1) . ' by </span>' 
																													                       . HTMLGen::htmlEncode($contributorName1) . '</div>';
		$otherContributor2Display = ($contributorRole2 == '') ? '<!-- No other given. -->'
																													: $filmInfoDivSpanText . HTMLGen::htmlEncode($contributorRole2) . ' by </span>' 
																													                       . HTMLGen::htmlEncode( $contributorName2) . '</div>';

    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" ' . $workRow['shortDescription'] 
                      . ' #' . $workRow['showOrder'] . ' -->' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td align="center" valign="top" class="programPic"><img class="programHighlightColor" src="' 
              . $imageDirectory . $imageFileName . '" alt="' . HTMLGen::htmlEncode($imageAltText) 
              . '" title="' . HTMLGen::htmlEncode($imageTitleText) . '" height="' . $imageHeightInPixels 
              . ' "width="' . $imageWidthInPixels . '" hspace="2" vspace="0" border="' . $programPicBorderWidth 
              . '" align="left" style="margin-left:1px;">';
    if ($imageCaption != '') echo '<br clear="all"><div class="filmFigureCaption">' . HTMLGen::htmlEncode($imageCaption) . '</div>';
    echo      '</td>' . "\r\n";
    echo '    <td width="12" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" align="left" valign="top" class="bodyText"><div class="filmTitleText">' 
              . $title . ', <span class="filmYearText">' . $workRow['yearProduced'] 
              . ', </span>' . $liveText . '<span class="filmRunTimeText">' 
              . $runTimeMinutes . ' min</span><span class="filmFormatText">' . $originalFormat . '</span></div>' . "\r\n";
    echo '      ' . $directorDisplay . "\r\n";
    echo '      ' . $producerDisplay . "\r\n";
    echo '      ' . $choreoDisplay . "\r\n";
    echo '      ' . $companyDisplay . "\r\n";
    echo '      ' . $dancersDisplay . "\r\n";
    echo '      ' . $musicCompDisplay . "\r\n";
    echo '      ' . $musicPerfDisplay . "\r\n";
    echo '      ' . $otherContributor1Display . "\r\n";
    echo '      ' . $otherContributor2Display . "\r\n";
    echo '      ' . $filmInfoDivSpanText . 'Synopsis: </span>' . HTMLGen::htmlEncode($synopsis) 
                  . '<span class="filmCityStateCountryText"> (' . HTMLGen::htmlEncode($cityStateCountry) . ')</span></div></td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td width="188" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="2" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" height="36"  align="left" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
  }
  
}

?>
