<?php 

class HTMLGen {

  private static $debugger;
  private static $caller = '';
  
  public static function setCaller($caller) { self::$caller = $caller; } // values 'user' and 'admin' are recognized
  
  private function debugger() {
    if (!isset($debugger)) $debugger = new SSFDebug($initBelchEnabled=false, $initBechoEnabled=false);
    return $debugger;
  }

  public static function requiredFieldString() { return '<span style="color:#CC3333;">&nbsp;*&nbsp;</span>'; }
  
  private static $showFunctionMarkers = true;
  public static function showFunctionMarkers() { return self::$showFunctionMarkers; }
  
  // This function does not work becuase when $string is null, a PHP error is generated on the function call.
  //public static function isSetAndNonNull($string) { return (isset($string) && ($string != '')); }
    
  private static $widgetIdsCnt = array();

  public static function simpleQuote($string) { 
    return "'" . str_replace("'", "\'", trim($string)) . "'";
  }
  
  public static function simpleDoubleQuote($string) { 
    return '"' . str_replace('"', '\"', trim($string)) . '"';
  }
  
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

/*  
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
*/
  public static function displayEditDivHeader($divIdString, $title, $saveButtonNameId, 
                                              $validationFunctionName, $hiddenInputSavingId, $cancelButtonNameId) {
    $saveButtonGenId = HTMLGen::genId($saveButtonNameId);
    $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
    $saveButtonName = 'Save';
    echo "          <div id='" . $divIdString . "' class='entryFormSection'>\r\n";
    echo "            <div class='entryFormSectionHeading'>\r\n";
    echo "              <div style='float:left;padding-top:4px;'>" . $title . "</div>\r\n";
    echo "              <div style='float:right;padding-right:4px;padding-bottom:0;'>\r\n";
    echo "                <input type='button' id='" . $saveButtonGenId . "' name='" 
                                                     . $saveButtonNameId . "' value='" . $saveButtonName . "'\r\n";
    echo "                       onclick='var valid = (" . $validationFunctionName . "());\r\n";
    echo "                                if (valid) { postValidationSubmit(\"" . $hiddenInputSavingId . "\"); }'>\r\n";
    echo "                <input type='submit' id='" . $cancelButtonGenId . "' name='" 
                                                     . $cancelButtonNameId . "' value='Cancel'>\r\n";
    echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";

    echo "              </div>\r\n";
    echo "              <div style='clear:both;padding-top:2px;'><hr class='horizontalSeparatorFull'></div>\r\n";
    echo "            </div>\r\n";
//    echo "            <div>\r\n";
  }

  public static function displayEditDivHeader_2($divIdString, $title, $saveButtonName, $saveButtonNameId, 
                                                $hiddenInputSavingId, $cancelButtonNameId) {
//    $saveButtonGenId = HTMLGen::genId($saveButtonNameId); TODO Maybe it was a mistake to gen these ids? 3/19/10
    $saveButtonGenId = $saveButtonNameId;
    $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
//    $onClickScript = "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'";
    $onClickScript = 'document.getElementById("hiddenInputSavingKey").value="' . $hiddenInputSavingId . '";';
    echo "          <div id='" . $divIdString . "' class='entryFormSection'>\r\n";
    echo "            <div class='entryFormSectionHeading'>\r\n";
    echo "              <div style='float:left;padding-top:4px;padding-bottom:2px;'>" . $title . "</div>\r\n";
    echo "              <div style='float:right;padding-right:4px;padding-bottom:2px;'>\r\n";
    echo "                <input type='submit' id='" . $saveButtonGenId . "' name='" 
                                                     . $saveButtonNameId . "' value='" . $saveButtonName . "'"
//                                                   . " onclick='document.pressed=this.name;'"
                                                     . " onclick=" . self::simpleQuote($onClickScript)
                                                     . ">\r\n";
    echo "                <input type='button' id='" . $cancelButtonGenId . "' name='" 
                                                     . $cancelButtonNameId . "' value='Cancel'"
                                                     . " onclick='document.pressed=this.value;cancelSubmit()'>\r\n";
//    echo "                <script type='text/javascript'>document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . "';</script>\r\n";
    echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";
    echo "              </div>\r\n";
    echo "              <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
    echo "            </div>\r\n";
  }

  public static function displayEditSectionFooter($title, $saveButtonName, $saveButtonNameId, 
                                                $hiddenInputSavingId, $cancelButtonNameId='') {
    $saveButtonGenId = HTMLGen::genId($saveButtonNameId);
    $cancelButtonGenId = HTMLGen::genId($cancelButtonNameId);
//    $onClickScript = "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'";
    $onClickScript = 'document.getElementById("hiddenInputSavingKey").value="' . $hiddenInputSavingId . '";';
    echo "            <div class='entryFormSectionHeading'>\r\n";
    echo "              <div style='float:left;padding-top:4px;padding-bottom:2px;'>" . $title . "</div>\r\n";
    echo "              <div style='float:right;padding-right:4px;padding-bottom:2px;'>\r\n";
    echo "                <input type='submit' id='" . $saveButtonGenId . "' name='" 
                                                     . $saveButtonNameId . "' value='" . $saveButtonName . "'"
//                                                     . " onclick='document.pressed=this.name;'"
//                                                     . "document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . ";'"
                                                     . " onclick=" . self::simpleQuote($onClickScript)
                                                     . ">\r\n";
    if ($cancelButtonNameId != '')
      echo "                <input type='button' id='" . $cancelButtonGenId . "' name='" 
                                                       . $cancelButtonNameId . "' value='Cancel'"
                                                       . " onclick='document.pressed=this.value;cancelSubmit()'>\r\n";
//    echo "                <script type='text/javascript'>document.getElementById('hiddenInputSavingKey').value='" . $hiddenInputSavingId . "';</script>\r\n";
//    echo "                <input type='hidden' id='" . $hiddenInputSavingId . "' name='" . $hiddenInputSavingId . "'>\r\n";
    echo "              </div>\r\n";
    echo "              <div style='clear:both;'><hr class='horizontalSeparatorFull'></div>\r\n";
    echo "            </div>\r\n";
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

  // The table.column is assumed to be a SET. $currentValue may be a comma separated string or an array.
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
//      self::debugger()->belch($tableName . '_' . $colName . '=', $currentValue, 1);
      $inSet = false;
      if (is_array($currentValue)) 
        foreach ($currentValue as $currKey => $currVal) { if ($currVal == $possVal) { $inSet = true; break; } }
      else
        $inSet = (strstr($currentValue, $possVal) !== false);  // $possVal is a substring of the set
      $genId = HTMLGen::genId($possVal);
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
    if ($isChecked) echo " checked='checked'";
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
  // $width = "n" means use markup with class rowTitleTextNarrow, $width = "w" use markup with rowTitleTextWide, $width = "" use markup with rowTitleText, 
  public static function addRadioButtonWidgetRow($title, $tableName, $colName, $currentValue, $cols, $width="", $disable=false) {
    echo "<!-- RadioButtonWidgetRow: " . $tableName . "." . $colName . ", " . $title . (($disable) ? " disabled" : "") . " -->\r\n";
    $titleMarkupClass = self::getTitleMarkupClass($width);
    echo "      <div class='formRowContainer' style='padding-top:2px;'>\r\n";
    echo "        <div class='" . $titleMarkupClass . "' style='padding-top:3px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn' style='padding-bottom:3px;'>\r\n";
    $dpArray = DatumProperties::getArray();
    $dataItemName = DatumProperties::getItemKeyFor($tableName, $colName);
    $possibleValues = $dpArray[$dataItemName]->possibleValues;
    $itemCount = count($possibleValues);
    $itemsPerCol = (int) ceil($itemCount/$cols);
    $itemsDisplayed = 0;
    $rowIndex = 0;
    // begin a column div
    echo "        <div style='float:left;'>\r\n";
    foreach ($possibleValues as $possVal) {
      // HACK ALERT Skip a couple of the possible values for submissionFormat for the Entry Form. TODO eliminate this hack
      if (($colName == 'submissionFormat') && (self::$caller == 'user') && (($possVal == 'unknown') || ($possVal == 'other'))) break;
      // END HACK ALERT
      $rowIndex++;
      $itemsDisplayed++;
      $isValue = ($currentValue == $possVal);  // $possVal is a substring of the enum
      $genId = HTMLGen::genId($possVal);
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
      echo "  <div style='clear:both;'></div>\r\n";
      echo "</div>\r\n";
    }
    if (self::$showFunctionMarkers) echo "<!-- END PermissionsWidgetRow -->\r\n";
  }

  public static function addTextAreaRowWithWidth($idName, $desc, $initValue, $maxLength, $height, $width, $disable=false) {
    $genId = HTMLGen::genId($idName);
    $descAnteChar = ($desc == '') ? "" : ":";
    echo "<!-- TextAreaRowWithWidth : " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer' style='margin-top:0px;margin-bottom:0px;'>\r\n"; // style='margin-top:0px;margin-bottom:0px;' prior to 3/4/10
    // description 
    $titleMarkupClass = self::getTitleMarkupClass($width);
    echo "        <div class='" . $titleMarkupClass . "' style='margin-top:0px;padding-top:0;'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer' style='padding-top:0px;padding-bottom:1px;'>\r\n";
//    echo "          <div style='float:left;'>\r\n";
    echo "            <textarea id=" . $genId . " name=" . $idName . (($disable) ? ' disabled' : '');
    $entryFormFieldString = (self::$caller == 'user') ? 'entryFormTextAreaField' : 'entryFormTextAreaFieldWide';
    echo " rows='" . $height . "' cols='20' class='" . $entryFormFieldString . "'"; 
    echo " onchange='javascript:userMadeAChange(0);'>" . $initValue . "</textarea>\r\n";
//    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END TextAreaRowWithWidth row -->\r\n";
  }

  public static function addTextAreaRow($idName, $desc, $initValue, $maxLength, $height, $disable=false) {
    echo "<!-- TextAreaRow : " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    self::addTextAreaRowWithWidth($idName, $desc, $initValue, $maxLength, $height, "w", $disable=false);
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
    HTMLGen::addTextWidgetRow(self::requiredFieldString() . 'Country', "people_country", $dataArray["country"], 32, $disable);
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
    echo " value='" . self::contributorOtherRoleDesc($contributors, $roleString) . "' maxlength=32" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return submitEnter(this, event);'" . ">\r\n";
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
    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return submitEnter(this, event);'" . ">\r\n"; 

    echo "          </div>\r\n";
    // postfix
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END OtherContributorRow -->\r\n";
  }

  // Adds a disabled text box widget with a title on its left and an enable button on its right to a form.
  // $desc is the item title; $idName the text for the widget id and name; $initValue is the initialValue; $maxLength pertains the html text input box; 
  // $width = "n" means use markup with class rowTitleTextNarrow, $width = "w" use markup with rowTitleTextWide, $width = "" use markup with rowTitleText, 
  public static function addTextWidgetRowDisabled($desc, $idName, $initValue, $maxLength, $width="w") {
    echo "<!-- TextWidgetRowDisabled: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . " -->\r\n";
    $genId = self::addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $width, true); // added 5th param $width 8/11/10
    $controlName = "toggle_" . $idName . "_ability";
    // TODO: Change this from disable/enable to readonly/readwrite.
    $onClick = 'javascript:enable("' . $genId . '");disable("' . $controlName . '");';
    echo "            <div style='float:left;padding-left:10px;padding-top:0px;'>\r\n";
    echo "              <input type='button' id='" . $controlName . "' name='" . $controlName . "' value='Allow Edit' onClick='" . $onClick . "'>\r\n";
    echo "            </div>\r\n";
//    echo "            <div style='clear:both;'></div>\r\n";
    self::addTextWidgetRowHelper2();
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetRowDisabled -->\r\n";
  }

  // Adds a text box widget with title on its left to a form.
  // $desc is the item title; $idName the text for the widget id and name; $initValue is the initialValue; $maxLength pertains the html text input box; 
  // $disable is true if this control should be disabled upon creation.
  public static function addTextWidgetRow($desc, $idName, $initValue, $maxLength, $disable=false) { // added 5th param $width 8/11/10
    echo "<!-- TextWidgetRow: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    self::addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, "w", $disable); // added 5th param 8/11/10
//  echo "            <div style='float:right;padding-left:20px;'>\r\n";
//                 additional widgets go here, one per div             
//  echo "            </div>\r\n";
    self::addTextWidgetRowHelper2();
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetRow -->\r\n";
  }

  // Adds a text box widget with title on its left to a form.
  // $desc is the item title; $idName the text for the widget id and name;
  // $initValue is the initialValue; $maxLength pertains the html text input box; 
  // $disable is true if this control should be disabled upon creation.
  // $width = "n" means use markup with class rowTitleTextNarrow, $width = "w" use markup with rowTitleTextWide, $width = "" use markup with rowTitleText, 
  public static function addTextWidgetRowWithTitleWidth($desc, $idName, $initValue, $maxLength, $width="w", $disable=false) { // added 5th param $width 8/11/10
    echo "<!-- TextWidgetRowWithTitleWidth: " . $idName . ", " . $desc . ". initially:" . $initValue . ", length:" . $maxLength . (($disable) ? " disabled" : "") . " -->\r\n";
    self::addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $width, $disable); // added 5th param 8/11/10
    self::addTextWidgetRowHelper2();
    if (self::$showFunctionMarkers) echo "<!-- END TextWidgetRowWithTitleWidth -->\r\n";
  }

  private static function getTitleMarkupClass($width) {
    $titleMarkupClass = ($width == 'n') ? 'rowTitleTextNarrow' : (($width == 'w') ? 'rowTitleTextWide' : 'rowTitleText');
    return $titleMarkupClass;
  }

  public static function addTextWidgetRowHelper1($desc, $idName, $initValue, $maxLength, $width="w", $disable=false) {
    $genId = HTMLGen::genId($idName);
    $titleMarkupClass = self::getTitleMarkupClass($width);
    $descAnteChar = ($desc == '') ? "" : ":";
    $isPassword = (strpos ($idName, 'password') !== false) || (strpos ($idName, 'pw') !== false)
                || (strpos ($desc, 'password') !== false) || (strpos ($desc, 'pw') !== false);
    $isYearProduced = ($idName == DatumProperties::getItemKeyFor('works', 'yearProduced'));
    // NOTE: Setting $inputType to 'password' cause Firefox to repeatedly as the user if she wants the password to be saved.
    $inputType = ($isPassword) ? 'password' : 'text'; 
    echo "      <div class='formRowContainer'>\r\n";
    echo "        <div class='" . $titleMarkupClass . "'>" . $desc . $descAnteChar . "</div>\r\n"; 
    echo "        <div class='entryFormFieldContainer'>\r\n";
    echo "          <div style='float:left;'>\r\n";
                      // widget goes here
    echo "            <input type='" . $inputType . "' id=" . $genId . " name=" . $idName;
    // Hack Alert - TODO find a better way
    if ($isYearProduced) echo " onKeyPress='return digitsOnly2(event);'";
    else echo " onKeyPress='return submitEnter(this, event)'";
    $fieldLengthLimit = (self::$caller == 'user') ? 4096 : 128;
    if ($maxLength <= 10) $cssFieldDescriptor = "entryFormInputFieldShort";
    else $cssFieldDescriptor = (($maxLength > $fieldLengthLimit) ? "entryFormInputFieldWide" : "entryFormInputField");
    if ($isYearProduced) $cssFieldDescriptor = "entryFormInputFieldVeryShort";
    echo " class='" . $cssFieldDescriptor . "'";
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
    echo "        <div class='rowTitleTextWide'>" . self::requiredFieldString() . "Run Time:</div>\r\n";
    echo "        <div class='entryFormFieldContainer'>\r\n";
    // Minutes title
    echo "          <div class='rowTitleTextNarrow' style='width:50px;'>Minutes:</div>\r\n";
    // Minutes widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id='" . HTMLGen::genId("works_minutes") . "' name='" . "works_minutes" . "' class='entryFormInputFieldShort' style='width:40px;'";
    echo " value='" . $runTimeMinutes . "' maxlength=4 onKeyPress='return digitsOnly2(event);'" . (($disable) ? ' disabled' : '');
// onKeyPress='var do=digitsOnly2(event); if (!do) window.print(\"\x07\"); return do;'
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    // Seconds title
    echo "        <div class='rowTitleTextNarrow' style='width:70px;'>Seconds:</div>\r\n";
    // Seconds widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id='" . HTMLGen::genId("works_seconds") . "' name='" . "works_seconds" . "' class='entryFormInputFieldShorter' style='width:40px;'";
    echo " value='" . $runTimeSeconds . "' maxlength=2 onKeyPress='return digitsOnly2(event);'" . (($disable) ? ' disabled' : '');
    echo " onchange='javascript:userMadeAChange(0);'" . ">\r\n";
    echo "          </div>\r\n";
    echo "        </div>\r\n";
    echo "        <div style='clear:both;'></div>\r\n";
    echo "      </div>\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END RunTimeWidgetsRow -->\r\n";
  }

  public static function addPixelDimensionsWidgetsRow($frameWidthInPixels, $frameHeightInPixels, $disable=false) {
    echo "<!-- RunTimeWidgetsRow " . (($disable) ? " disabled" : "") . " -->\r\n";
    echo "      <div class='formRowContainer' style='margin-top:0px;'>\r\n";
    // Overall title
    echo "        <div class='rowTitleTextWide'>Frame Dimensions:</div>\r\n";
    echo "        <div class='entryFormFieldContainer'>\r\n";
    // Width title
    echo "          <div class='rowTitleTextNarrow' style='width:40px;'>Width:</div>\r\n";
    // Width widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id='" . HTMLGen::genId("works_frameWidthInPixels") . "' name='" . "works_frameWidthInPixels";
    echo "' class='entryFormInputFieldShort' style='width:40px;'" . " value='" . $frameWidthInPixels . "' maxlength=5" . (($disable) ? ' disabled' : '');
//    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return submitEnter(this, event);'" . ">\r\n";
    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return digitsOnly2(event);'" . ">\r\n";
    echo "          </div>\r\n";
    // Height title
    echo "        <div class='rowTitleTextNarrow' style='width:55px;'>Height:</div>\r\n";
    // Height widget
    echo "          <div style='float:left;'>\r\n";
    echo "            <input type='text' id='" . HTMLGen::genId("works_frameHeightInPixels") . "' name='" . "works_frameHeightInPixels";
    echo "' class='entryFormInputFieldShorter' style='width:40px;'" . " value='" . $frameHeightInPixels . "' maxlength=5" . (($disable) ? ' disabled' : '');
//    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return submitEnter(this, event);'" . ">\r\n";
    echo " onchange='javascript:userMadeAChange(0);' onKeyPress='return digitsOnly2(event);'" . ">\r\n";
    echo SSFHelp::getHTMLIconFor('frameDimensions');
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

  private static function contributorOtherRoleDesc($contributors, $roleString) {
    $value = '';
    if (isset($contributors[$roleString]['roleDescription']) && $contributors[$roleString]['roleDescription'] != null)
      $value = $contributors[$roleString]['roleDescription'];
    return $value;
  }

  public static function addContributorWidgetRow($title, $roleString, $contributors, $disable) {
    HTMLGen::addTextWidgetRow($title, DatumProperties::getItemKeyFor('workContributors', $roleString), 
                               self::contributorWidgetValue($contributors, $roleString), 64, $disable);
  }
  
  public static function addContributorWidgetsSection($contributorsArray, $disable=false) {
    echo "<!-- addContributorWidgetsSection " . (($disable) ? " disabled" : "") . " -->\r\n";
    $contributors = self::getContributorArray($contributorsArray);
    self::debugger()->belch('contributors', $contributors, -1);
    HTMLGen::addContributorWidgetRow('Director', 'Director', $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Producer', 'Producer', $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Choreographer', 'Choreographer',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Dance Company', 'DanceCompany',  $contributors, $disable); 
    HTMLGen::addTextAreaRow(DatumProperties::getItemKeyFor('workContributors', 'PrincipalDancers'), 'Principal Dancers', 
                               self::contributorWidgetValue($contributors, 'PrincipalDancers'), 256, 2, $disable);
    HTMLGen::addContributorWidgetRow('Music Composition', 'MusicComposition',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Music Performance', 'MusicPerformance',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Camera/Cnmtographer', 'Camera',  $contributors, $disable); 
    HTMLGen::addContributorWidgetRow('Editor', 'Editor',  $contributors, $disable); 
//    $otherCreditsHelpString = 'Examples of other roles are: '
//                            . 'Filmmaker, Dance Improvisation, Artistic Associate, Funding Source, '
//                            . 'Improvisational Dance, Videography, and Visual Creations.';
    HTMLGen::addOtherContributorRow(SSFHelp::getHTMLIconFor('otherCredits') . 'Other Roles', 'Other_1', $contributors, $disable);
    HTMLGen::addOtherContributorRow('', 'Other_2', $contributors, $disable);
    if (self::$showFunctionMarkers) echo "<!-- END addContributorWidgetsSection -->\r\n";
  }

  public static function addPaymentWidgetsSection($dataArray, $disable) {
    $paypalId = self::genId('paypal');
    $checkId = self::genId('check');
    self::debugger()->becho('addPaymentWidgetsSection() dataArray[howPaid]', (isset($dataArray["howPaid"])) ? $dataArray["howPaid"] : 'not set', -1);
    self::debugger()->belch('addPaymentWidgetsSection() dataArray', $dataArray, -1);
    if (self::$showFunctionMarkers) echo "<!-- addPaymentWidgetsSection -->\r\n";
    echo '                 <div class="entryFormSubheading" style="padding-top:15px;padding-bottom:4px;">Payment Information' . self::requiredFieldString() . '</div>';
//    echo'                  <div style="text-align:left;margin-top:20px;padding-top:0px;font-size:14px;line-height:13px;color:#FFFF66;">Payment Information:<br><hr class="horizontalSeparatorFull"></div>' . "\r\n";
    echo'                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="' . $paypalId . '" value="paypal"';
          if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="paypal")) echo "checked='checked'";
          if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="waived")) echo "disabled='disabled'"; // added 7/24/10
    echo' onchange="userMadeAChange(1);">' . "\r\n";
    echo'                    <label for="' . $paypalId . '" class="entryFormRadioButton"> Pay via PayPal</label>' . "\r\n";
    echo'                  </div>' . "\r\n";
    echo'                  <div class="entryFormField" style="text-align:left;margin-left:50px;"><input type="radio" name="works_howPaid" id="' . $checkId . '" value="check"' . "\r\n";
          if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="check")) echo "checked='checked'";
          if (isset($dataArray["howPaid"]) && ($dataArray["howPaid"]=="waived")) echo "disabled='disabled'"; // added 7/24/10
    echo' onchange="userMadeAChange(1);">' . "\r\n";
    echo'                     <label for="' . $checkId . '" class="entryFormRadioButton"> Check or money order in US Dollars sent via post with media</label>' . "\r\n";
    echo'                  </div>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END addPaymentWidgetsSection -->\r\n";
  }

  public static function addReleaseInfoWidgetsSection($dataArray, $saveButtonName, $disable) {
    $allOKId = self::genId('allOK');
    $askMeId = self::genId('askMe');
    $allOKString = SSFRunTimeValues::getPermissionAllOKString();
    $askMeString = SSFRunTimeValues::getPermissionAskMeString();
    if (self::$showFunctionMarkers) echo "<!-- addReleaseInfoWidgetsSection -->\r\n";
    $releaseInfoWidgetIntroString = str_replace('<saveButtonName>', $saveButtonName, SSFRunTimeValues::getReleaseInfoWidgetIntroString());
//    $releaseInfoWidgetIntroString = str_replace('<br>', $releaseInfoWidgetIntroString, "\r\n");
    echo '                 <div class="entryFormSubheading" style="padding-top:15px;padding-bottom:4px;">Release Information' . self::requiredFieldString() . '</div>';
//    echo'                  <div style="text-align:left;margin-top:12px;padding-top:0px;font-size:14px;line-height:13px;color: #FFFF66;">'
//                              . 'Release Information:<br><hr class="horizontalSeparatorFull"></div>' . "\r\n";
/*
    echo'                  <div class="medSmallBodyTextLeadedOnBlack" style="text-align:left;padding-left:4px;padding-right:4px;">'
                              . 'By clicking the ' . $saveButtonName . ' button, you <span style="color:#FFFF99;">1)</span> certify that you hold' . "\r\n";
    echo'                    all necessary rights for the submission of this entry, <span style="color:#FFFF99;">2</span>) grant permission to Sans Souci Festival ' . "\r\n";
    echo'                    to screen this entry at the Festival Event in Boulder, Colorado USA on September 10 &amp; 11, 2010 and, <span style="color:#FFFF99;">3)</span>' . "\r\n";
    echo'                  </div>' . "\r\n";
*/
    echo'                  <div class="medSmallBodyTextLeadedOnBlack" style="text-align:left;padding-left:4px;padding-right:4px;">' . $releaseInfoWidgetIntroString;
    echo'                  </div>' . "\r\n";
    echo'                  <div class="entryFormField">' . "\r\n";
    echo'                    <table width="96%"  border="0" align="left" cellpadding="2" cellspacing="0"> ' . "\r\n";
    echo'                      <tr>' . "\r\n";
    echo'                        <td align="right" valign="top" style="padding-left:20px;"><input type="radio" name="works_permissionsAtSubmission" id="' . $allOKId . '" value="' . $allOKString . '" ';
          if (isset($dataArray["permissionsAtSubmission"]) && ($dataArray["permissionsAtSubmission"]==$allOKString)) echo 'checked="checked"';
    echo' onchange="userMadeAChange(1);"></td>' . "\r\n";
//    echo'                        <td align="left" valign="top" style="padding-top:4px;"><label for="' . $allOKId . '" class="entryFormRadioButton">All tours ' . "\r\n";
//    echo'                            associated with the 2010-2011 Season in the' . "\r\n";
//    echo'                            US and elsewhere. (Sans Souci has previously toured in Mexico, Germany, and Trinidad.)</label></td>' . "\r\n";
    echo'                        <td align="left" valign="top" style="padding-top:4px;"><label for="' . $allOKId . '" class="entryFormRadioButton">';
    echo                                                                         SSFRunTimeValues::getReleaseInfoWidgetAllOKString() . "</label></td>\r\n";
    echo'                      </tr>' . "\r\n";
    echo'                      <tr>' . "\r\n";
    echo'                        <td align="right" valign="top" style="padding-left:20px;"><input type="radio" name="works_permissionsAtSubmission" id="' . $askMeId . '" value="' . $askMeString . '"';
          if (isset($dataArray["permissionsAtSubmission"]) && ($dataArray["permissionsAtSubmission"]==$askMeString)) echo 'checked="checked"';
    echo' onchange="userMadeAChange(1);"></td>' . "\r\n";
//    echo'                        <td align="left" valign="top" style="padding-top:4px;"><label for="' . $askMeId . '" class="entryFormRadioButton">Please' . "\r\n";
//    echo'                          invite my work to each tour/venue separately so I  can respond to each individually. (We may contact you to invite ' . "\r\n";
//    echo'                          your work to any additional venues as we make such arrangements.)</label></td>' . "\r\n";
    echo'                        <td align="left" valign="top" style="padding-top:4px;"><label for="' . $allOKId . '" class="entryFormRadioButton">';
    echo                                                                         SSFRunTimeValues::getReleaseInfoWidgetAskMeString() . "</label></td>\r\n";
    echo'                      </tr>' . "\r\n";
    echo'                    </table>' . "\r\n";
    echo'                  </div>' . "\r\n";
    echo '                 <div style="clear:both;"></div>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END addReleaseInfoWidgetsSection -->\r\n";
  }
  
  public static function addAspectRatioAnamorphicRow($currentAspectRatio, $currentlyAnamorphic, $disable=false) {
    if (self::$showFunctionMarkers) echo "<!-- addAspectRatioAnamorphicRow -->\r\n";
    $debugAnamorphicRow = -1;
    $selectString = "SELECT aspectRatioId, ratio, description from aspectRatios where useInUI = 1 order by ratio";
//    SSFDB::debugNextQuery();
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $options[0] = '- select an aspect ratio -';
    foreach ($rows as $row) $options[$row['aspectRatioId']] = $row['ratio'] . ' - ' . $row['description'];
    echo '          <div class="formRowContainer"  style="padding-left:0px;padding-top:0px;">' . "\r\n";
    echo "            <div class='rowTitleTextWide' style='margin-top:3px;'>Aspect Ratio:</div>\r\n";
    echo '            <div class="entryFormFieldContainer">' . "\r\n";
    echo '              <div style="float:left;padding-top:1px;">' . "\r\n";
    echo '                <select id="'  . self::genId('works_aspectRatio') . '" name="works_aspectRatio" style="width:170px">' . "\r\n";
              self::displaySelectionOptions($options, $currentAspectRatio);
    echo '                </select>' . "\r\n";
    echo '              </div>' . "\r\n";
    $dataItemName = DatumProperties::getItemKeyFor('works', 'anamorphic');
    $genCheckboxId = HTMLGen::genId($dataItemName . 'BoolCheckbox');
    $genHiddenCacheId = HTMLGen::genId($dataItemName);
    echo "              <div class='floatLeft rowTitleTextNarrow' style='width:120px;margin-top:2px;padding-left:0px;padding-right:0px;margin-left:0px;margin-right:0px;'>" 
                                                   . SSFHelp::getHTMLIconFor('anamorphic') . "Anamorphic:</div>\r\n";
    echo "              <div class='floatLeft etchedIn' style='padding-bottom:0px;margin-bottom:0px;'>\r\n";
    // Generate the Anamorphic checkbox.
    $chkbxInputString = "                <input type='checkbox' name='" . $dataItemName . 'BoolCheckbox' . "' id='" . $genCheckboxId;
    $chkbxInputString .=  "' value='" . 'anamorphic?' . "' onchange='userMadeAChange(1);"
                      . "setHiddenBoolCacheWidget(" . self::simpleDoubleQuote($genCheckboxId) . ", " . self::simpleDoubleQuote($genHiddenCacheId) . ");'"
                      . (($disable) ? ' disabled' : '');
    $chkbxInputString .= ($currentlyAnamorphic) ? " checked='checked'" : "";
    $chkbxInputString .=  ">\r\n";
    echo $chkbxInputString;
    HTMLGen::debugger()->becho('addAspectRatioAnamorphicRow chkbxInputString', '<!-- ' . $chkbxInputString . ' -->', $debugAnamorphicRow);
    // Generate the associated hidden cache widget for caching the value. This is the trick. Checkboxes typically
    // map to ENUMs in the database. These checkboxes map to a boolean. So, the boolean value is cached in a hidden
    // input field which is updated by the change method of the checkbox.
    echo "                <input type='hidden' id='" . $genHiddenCacheId . "' name='" . $dataItemName . "'"
                             . (($disable) ? ' disabled ' : ' ') . "value=" . (($currentlyAnamorphic) ? '1' : '0') . ">\r\n";
    echo '              </div>' . "\r\n";
    echo '              <div style="clear:both;"></div>' . "\r\n";
    echo '            </div>' . "\r\n";
    echo '            <div style="clear:both;"></div>' . "\r\n";
    echo '          </div>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END addAspectRatioAnamorphicRow -->\r\n";
}

  public static function displayOriginalFormatSelector($originalFormat, $disable) {
    if (self::$showFunctionMarkers) echo "<!-- displayOriginalFormatSelector -->\r\n";
    // prefix
    echo "          <div class='formRowContainer' style='padding-left:0px;padding-top:2px;'>\r\n";
    echo "            <div class='rowTitleTextWide'>Original Format:</div>\r\n";
    echo "            <div class='entryFormFieldContainer'>\r\n";
    // the hidden cache
    echo "            <input type='hidden' name='works_originalFormat' value='" . $originalFormat . "'>";
    // selector
    $diagnosticAlerts = 'alert("this.value=" + this.value); alert("worksOther.disabled=" + worksOther.disabled);alert("worksOther.value=" + worksOther.value);';
    $onChangeString = 'var worksOriginalFormat=getUniqueElement("works_originalFormat");'
                    . 'var worksOther=getUniqueElement("works_originalFormatOtherText");'
                    . 'if(this.value!="other"){worksOriginalFormat.value=this.value;worksOther.disabled=true;worksOther.value="";}else{worksOther.disabled=false;}';
    echo "                <select id='" . self::genId('works_originalFormatSelector') . "' name='works_originalFormatSelector' \r\n";
    echo "                         style='width:180px' onchange='" . $onChangeString . "'>\r\n"; 
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
    $selectedOptionKey = '';
    foreach($formatOptions as $optionKey => $optionValue) {
      if ($optionKey == $originalFormat) { $selectedOptionKey = $optionKey; break; }
    }
    if ($selectedOptionKey == '') $selectedOptionKey = ($originalFormat == '') ? '-- Select --' : 'other';
    self::displaySelectionOptions($formatOptions, $selectedOptionKey); 
    // "other" text field
    $initTextValue = ($selectedOptionKey == 'other') ? $originalFormat : '';
    $disableOther = ($disable || ($selectedOptionKey != 'other'));
    echo "                </select>\r\n";
    echo "            <span class='rowTitleTextNarrow' style='float:none;margin-right:2px;margin-left:10px;'>Other:</span>\r\n";
                      // widget goes here
    echo "            <input type='text' id=" . HTMLGen::genId('works_originalFormatOtherText') . " name='works_originalFormatOtherText'";
    echo " class='entryFormInputFieldShorter'";
    echo ' value="' . str_replace('"', "", $initTextValue) . '" maxlength=64' . (($disableOther) ? " disabled='disabled'" : "");
    $onChangeString = 'javascript:userMadeAChange(0);getUniqueElement("works_originalFormat").value=this.value;';
    echo " onchange='" . $onChangeString . "'>\r\n";
    // postfix
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
    $debugInit = -1;
    $workOrientation = ($stateArray['orientationSelector'] == 'works');
//    $currentPersonId = (isset($stateArray['editingPersonId']) && $stateArray['editingPersonId'] != 0) ? $stateArray['editingPersonId'] : $stateArray['personSelector'];
    $currentPersonId = $stateArray['personSelector'];
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
    if ($stateArray['orientationSelector'] == 'works') {
      $workRows = SSFQuery::selectWorksFor($currentPersonId);
      //print_r($workRows);
      // BROKEN because we do not yet know the next person nor the workIdValue until after the selection is made 
      $workRowCount = ((isset($workRows) && ($workRows != '')) ? count($workRows) : 0);
      $workIdValue = ($workRowCount == 1) ? $workRows[0]['workId'] : 0;
      $onChangeString = 'document.getElementById("editingPerson").value=0;'
                      . 'document.getElementById("workSelector").value=' . $workIdValue . ';'
                      . 'submitFormVia(' . $formName . ', "personSelector");';
    } else { // since the orientation is people
      $onChangeString = 'document.getElementById("editingPerson").value=0;'
                      . 'submitFormVia(' . $formName . ', "personSelector");';
    }
    echo "onchange='" . $onChangeString . "'>\r\n";
    self::$personSelectionOptions = array();
    self::$personSelectionOptions[0] = $option0;
    foreach ($personRows as $personRow) 
      self::$personSelectionOptions[$personRow['personId']] = 
        ((isset($personRow['lastName']) && ($personRow['lastName'] != '')) ? strtoupper($personRow['lastName']) . " - " 
                                                                           : "") 
                                                                           . $personRow['name'];
    self::displaySelectionOptions(self::$personSelectionOptions, $currentPersonId);
    echo '</select>' . "\r\n";
    //$reSubmit = ($workRowCount == 1);
    // What's need here is to resubmit the form. 
    // When I try that, it gets into an infinite reload loop as does the next line of code.
    // The manual apply button achieves this effect.
    //if ($reSubmit) echo '<script type="text/javascript">document.' . $formName . '.submit();</script>' . "\r\n";
    //return $reSubmit;
    if (self::$showFunctionMarkers) echo "<!-- END displayPersonSelector -->\r\n";
    $personIdSelected = self::getSelectedOptionValue(self::$personSelectionOptions, $currentPersonId);
    HTMLGen::debugger()->becho("\r\n<br>" . 'HHEE', 'currentPersonId:' . $currentPersonId, $debugInit);
    HTMLGen::debugger()->becho('HHEE', 'personIdSelected:' . $personIdSelected, $debugInit);
    return $personIdSelected;
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

/*
public static function submitterIsSelected($selectedPersonId) {
    $submitterIsSelected = isset($selectedPersonId) 
                         && ($selectedPersonId != '') 
                         && ($selectedPersonId != 0);
    return $submitterIsSelected;
  }
*/

  // TODO When this selector is displayed, if the selection is unique, set state appropriately and submit().
  public static function displayWorkSelector($formName, $selectedPersonId, $stateArray, $workHeader='All Works') {
    // 8/11/2010: Changed calls to displaySelectionOptions() to getSelectionOptions() becuase an echo statement
    // was trashing the value of $rowCount. So, now the markup text is concatenated into $markup instead of being echoed 
    // one segment at a time. TODO: I should make this change eveerywhere and delete a bunch of the displayXXX() functions.
    $debugDisplayWorkSelector = -1;
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkSelector -->\r\n";
    //HTMLGen::debugger()->becho('HHFF', 'stateArray["personSelector"]:' . $selectedPersonId, $debugDisplayWorkSelector);
    //SSFDB::debugNextQuery();
//    if ($selectedPersonId != '' && $selectedPersonId != 0) 
    $markup = '';
    $rows = SSFQuery::selectWorksFor($selectedPersonId);
    $rowCount = (isset($rows)) ? count($rows) : 0;
    HTMLGen::debugger()->belch('displayWorkSelector rows', $rows, $debugDisplayWorkSelector); 
    HTMLGen::debugger()->belch('displayWorkSelector rowCount AAA 0', $rowCount, $debugDisplayWorkSelector); 
//    else $rows = array();
    $selectionOptions = array();
    HTMLGen::debugger()->belch('displayWorkSelector rowCount AAA 1', $rowCount, $debugDisplayWorkSelector); 
    $workIdMayBe = 0; 
    HTMLGen::debugger()->belch('displayWorkSelector rowCount AAA 2', $rowCount, $debugDisplayWorkSelector); 
    $submitterIsSelected = (($selectedPersonId != '') && ($selectedPersonId != 0));
    HTMLGen::debugger()->belch('displayWorkSelector rowCount AAA 3', $rowCount, $debugDisplayWorkSelector); 
    $markup .= '<select id="workSelector" name="workSelector" style="width:250px;" ';
    HTMLGen::debugger()->belch('displayWorkSelector rowCount AAA 4', $rowCount, $debugDisplayWorkSelector); 
    if ($rowCount == 0) {
      HTMLGen::debugger()->belch('displayWorkSelector rowCount BBB', $rowCount, $debugDisplayWorkSelector); 
      $markup .= ' disabled>' . "\r\n";
      $selectionOptions[0] = (self::$caller == 'user') ? '-- no entries --' : '-- no works --';
      $markup .= self::getSelectionOptions($selectionOptions, 0); // 2/14/10 changed to 0 from $stateArray['workSelector']
      HTMLGen::debugger()->becho('HHAA', 'workIdMayBe:' . $workIdMayBe, $debugDisplayWorkSelector);
    } else if ($rowCount != 1) {
      HTMLGen::debugger()->belch('displayWorkSelector rowCount CCC', $rowCount, $debugDisplayWorkSelector); 
      HTMLGen::debugger()->becho('HHAB', 'workIdMayBe:' . $workIdMayBe, $debugDisplayWorkSelector);
      $markup .= 'onchange="submitFormVia(' . $formName . ', ' . self::simpleQuote('workSelector') . ')">' . "\r\n";
      $selectionOptions[0] = $workHeader;
      foreach ($rows as $row) {
        $workSuffix = ($submitterIsSelected) ? "" : ",&nbsp;BY " . $row['name'];
        $selectionOptions[$row['workId']] = $row['title'] . $workSuffix;
      }
      $markup .= self::getSelectionOptions($selectionOptions, $stateArray['workSelector']);
      $workIdMayBe = $stateArray['workSelector'];
      HTMLGen::debugger()->becho('HHBB', 'workIdMayBe:' . $workIdMayBe, $debugDisplayWorkSelector); // HHBB
    } else { // since ($rowCount == 1)
      HTMLGen::debugger()->belch('displayWorkSelector rowCount DDD', $rowCount, $debugDisplayWorkSelector); 
      $markup .= '>' . "\r\n";
      $workIdMayBe = $rows[0]['workId'];
      HTMLGen::debugger()->becho('HHCC', 'workIdMayBe:' . $workIdMayBe, $debugDisplayWorkSelector);
      $workSuffix = ($submitterIsSelected) ? "" : ",&nbsp;BY " . $rows[0]['name'];
      $selectionOptions[$rows[0]['workId']] = $rows[0]['title'] . $workSuffix;
      $markup .= self::getSelectionOptions($selectionOptions, $rows[0]['workId']); 
    }
    $markup .= '</select>' . "\r\n";
    HTMLGen::debugger()->belch('displayWorkSelector markup', $markup, $debugDisplayWorkSelector); 
    HTMLGen::debugger()->belch('displayWorkSelector rowCount EEE', $rowCount, $debugDisplayWorkSelector); 
    HTMLGen::debugger()->becho('HHDD', 'workIdMayBe:' . $workIdMayBe, $debugDisplayWorkSelector);
    $workIdSelected = self::getSelectedOptionValue($selectionOptions, $workIdMayBe);
    echo $markup;
    if (self::$showFunctionMarkers) echo "<!-- END displayWorkSelector -->\r\n";
    return $workIdSelected;
  }

  // This function supports entrySummaryLineDisplay $withEmail.
  public static function emailWidgetId($id) { return 'emailWidget-' . $id; }

  public static function stillImagesNeeded($photoLocation) {
    $stillImagesNeeded = (!isset($photoLocation) || $photoLocation=="" || (stristr($photoLocation, "NONE") !== false));
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
                              'acceptedSort' => 'Entry Status', 
                              'scoreSortUp' => 'Average Score &#8593;', 
                              'scoreSortDn' => 'Average Score &#8595;', 
                              'titleSort' => 'Film Title', 
                              'submitterSort' => 'Submitter Name', 
                              'formatSort' => 'Media Format', 
                              'durationSort' => 'Film Duration', 
                              'liveSort' => 'Live Performance', 
                              'receivedSort' => 'Media NOT Received', 
                              'acceptForSort' => 'Accepted For ...', 
                              'countrySort' => 'Country');
    self::displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
    if (self::$showFunctionMarkers) echo "<!-- END displayEntryPropertySortSelector -->\r\n";
  }  

  public static function displayCurationScoreSelector($workId, $selectorId, $selectorName, $currentValue, $curatorId) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayCurationScoreSelector -->\r\n";
    echo '<select id="' . $selectorId . '" name="' . $selectorName 
            . '" onchange="javascript:updateScore(' . $workId . ', ' . $curatorId . ', this.value);">' . "\r\n";
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

  // Generates the HTML lines for the options of a form selector. Inputs are
  // $selectionOptions, an array where the array key is the option value and 
  // array value is the option display string; and $currentValue is the option 
  // value of the current selection. Function created 8/11/2010
  public static function getSelectionOptions($selectionOptions, $currentValue) {
    $optionsMarkup = '';
    foreach($selectionOptions as $optionKey => $optionValue) {
      $optionsMarkup .= self::getSelectionOptionText($optionKey, $currentValue, $optionValue);
    }
    return $optionsMarkup;
  }

  public static function getSelectedOptionValue($selectionOptions, $currentValue) {
HTMLGen::debugger()->becho('HTMLGen::getSelectedOptionValue', 'currentValue:' . $currentValue, 0);
    foreach($selectionOptions as $optionKey => $optionValue) {
HTMLGen::debugger()->becho('HTMLGen::getSelectedOptionValue', 'optionKey:' . $optionKey, 0);
      if ($optionKey == $currentValue) return $optionKey;
    }
    return '';
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
      if ($forAdmin) echo $personArray["name"];
      else echo $personArray["nickName"] . ' ' . $personArray["lastName"];
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
      if (!$telephonesExist) $valueString .=  "<div class='datumValue floatLeft' style='margin-bottom:0;padding-bottom:0;'>&nbsp;No telephone numbers provided.</div>"; 
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
  
  public static function getTitleForSort($title) {
    $bit7Title = iconv("UTF-8", "ISO-8859-1//TRANSLIT", trim($title));
    $titleSansLeadingA = (stripos($bit7Title, 'A ') === 0) ? substr($bit7Title, 2) : $bit7Title;
    $titleSansLeadingThe = (stripos($titleSansLeadingA, 'The ') === 0) ? substr($titleSansLeadingA, 4) : $titleSansLeadingA;
    $titleInStrictMixedCase = ucwords(strtolower($titleSansLeadingThe));
    $stripChars = array(' ', "'", '"', '-', '/', '\\');
    $titleInCamelCase = str_replace($stripChars, "", $titleInStrictMixedCase);
    $truncatedCamelCase = (strlen($titleInCamelCase) > 20) ? substr($titleInCamelCase, 0, 20) : $titleInCamelCase;
    global $editorDEBUGGER;
    self::debugger()->becho('truncatedCamelCase', $truncatedCamelCase, -1);
    return $truncatedCamelCase;
  }
  
  // Returns a filename like "10-22-BinaryForm-ChirstinnWhyte" eliminating diacrticcals and special characters.
  // These filenames are to be used for videos, e.g., 10-22-BinaryForm-ChirstinnWhyte.vob or 10-22-BinaryForm-ChirstinnWhyte.mov,
  // image files, e.g., 10-22-BinaryForm-ChirstinnWhyte.jpg, and folder names.
  public static function computedFileNameForWork($designatedId, $titleForSort, $submitterName) {
    $remove = array(' ', '-');
    $idPart = (isset($designatedId) && $designatedId != '') ? $designatedId : 'XX-XX';
    $titlePart = str_replace($remove, '', $titleForSort);
    $namePart = str_replace($remove, '', $submitterName);
    $baseString = $idPart . '-' . $titlePart . '-' . $namePart; 
    $alsoRemove = array('\\', '/', '&', '.', ',', '*', '?', '(', ')', ':', chr(8230)); // chr(8230) is the elipsis
    $string = $filenameString = str_replace($alsoRemove, '', $baseString);
    $phpInputEncoding = iconv_get_encoding('input_encoding');
//    $filenameStringSansDiacrits = iconv($phpInputEncoding, 'US-ASCII//TRANSLIT', $filenameString); FAILS in various ways
    // preg_replace() with htmlentities() trick from http://stackoverflow.com/questions/1284535/php-transliteration
    $filenameStringSansDiacrits = preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', 
                                               '$1', htmlentities($filenameString, ENT_COMPAT, $phpInputEncoding));
    return $filenameStringSansDiacrits;
  }
  
  // Generates HTML for the work detail. Parameter $workArray must contain workId.
  public static function displayWorkDetailForAdmin($workArray, $contributorsArray, $forAdmin=true) {
    $alwaysDisplay = (($forAdmin) ? false : true);
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkDetailForAdmin -->\r\n";
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // title, year, runtime, accepted/rejected, titleForSort
      $acceptRejectString = '';
      if ($workArray['callForEntries'] <= 8) // Has Been Curated // TODO get the callForEntries threshold from the DB.
        $acceptRejectString = " <span class='datumValue' style='font-size:14px;'>" . HTMLGen::acceptanceDisplay($workId, $workArray['accepted'], $workArray['rejected'], $workArray['acceptFor']) . "</span>"; 
      $titleForSortString = ((isset($workArray['titleForSort']) && ($workArray['titleForSort'] != ''))
                          ? '[' . $workArray['titleForSort'] . ']' : '[no title for sort]');
      echo "<div>\r\n" 
           . '<div class="datumValue floatLeft">' . $workArray['title'] . ' (' . $workArray['yearProduced'] 
           . ') ' . $acceptRejectString . '<span class="datumDescription" style="margin-left:2em;">run time: </span>' 
           . $workArray['runTime']
           . (($workArray['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'>  LIVE</span>" : "")
           . (($workArray['invited'] == 1) ? "<span class='liveDisplayText'>  INVITED</span>" : "") . '</div>' . "\r\n"
           . '<div class="datumValue floatRight" style="padding-right:4px;">' . $titleForSortString . '</div>' . "\r\n"
           . '<div style="clear:both;"></div>' . "\r\n</div>\r\n";
      // media received
//      echo "<div>\r\n" . self::getMediaReceivedDisplayElement($workArray['dateMediaReceived']) . "\r\n<div style='clear:both;'></div>\r\n</div>\r\n";
      // media received & computed filename
      $computedFileName = self::computedFileNameForWork($workArray['designatedId'], $workArray['titleForSort'], $workArray['name']);
      echo "<div>\r\n<div class='floatLeft'>\r\n" . self::getMediaReceivedDisplayElement($workArray['dateMediaReceived']) . "</div>\r\n" .
           "<div class='datumValue floatRight' style='padding-right:4px;'>\r\n[" . $computedFileName . "]</div>" 
                       . "\r\n<div style='clear:both;'></div>\r\n</div>\r\n";
      // submission & original formats
      echo self::getMediaFormatsDisplayLine($workArray['submissionFormat'], $workArray['originalFormat']);
      self::displayFrameParameters($workArray);
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
      $pmtReceived = (isset($workArray['datePaid']) && ($workArray['datePaid'] != '') && ($workArray['datePaid'] != '0000-00-00'));
      if (isset($workArray['amtPaid']) && ($workArray['amtPaid'] != '')) $pmtString .= '$' . $workArray['amtPaid'];
      if (!$pmtReceived) $pmtString .= ' to be';
      $pmtString .= ' paid via ';
      $pmtTypeSpecified = isset($workArray['howPaid']) && ($workArray['howPaid'] != '');
      $pmtShouldHaveNumber = in_array($workArray['howPaid'], array('check', 'paypal', 'moneyOrder'));
      $pmtHasNumber = isset($workArray['checkOrPaypalNumber']) && ($workArray['checkOrPaypalNumber'] != '');
      $noPayment = in_array($workArray['howPaid'], array('notPaid', 'waived'));
      if (!$pmtTypeSpecified) $pmtString .= '<span class="orangishHighlightDisplayColor">only god knows!</span>';
      else {
        if ($noPayment) $pmtString = $workArray['howPaid'];
        else $pmtString .= $workArray['howPaid'];
        if ($pmtShouldHaveNumber && $pmtHasNumber) $pmtString .= ' #' . $workArray['checkOrPaypalNumber'];
        if ($workArray['howPaid'] != 'notPaid' && $pmtReceived) $pmtString .= ' on ' . $workArray['datePaid'];
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
                      . 'NOT</span> received/checked-in.</div>';
    else $displayString .= self::getSimpleDataWithDescriptionElement('Media received', $dateMediaReceived);
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
    $displayString .= '<div class="datumValue" style="width:98%;padding-top:1px;padding-bottom:4px;">' . "\r\n"
                   . '  <div class="datumDescription floatLeft">Credits: '
                   . $separator1 . '</div>' . "\r\n";
    $contributorsDisplayed = 0;
    self::debugger()->belch('contributorsArray in HTMLGen::getContributorDisplayLines()', $contributorsArray, -1);
    if (!is_null($contributorsArray)) {
      $contributorsArraySize = 0;
      foreach ($contributorsArray as $contributor) { if ($contributor['name'] != '') $contributorsArraySize++; }
      if ($contributorsArraySize > 0) {
        $displayString .= '  <div class="datumValue floatLeft" style="margin-left:1em;width:82%;padding-bottom:0;">' . "\r\n";
        foreach ($contributorsArray as $contributor) { 
          if ($contributor['name'] != '') { 
            $role = ($contributor['optionalContributor']) ? $contributor['roleDescription'] : $contributor['role'];
            $contributorsDisplayed++;
            if ($displayContributorsOnSeparateLines) {
              $displayString .= "    <div style='max-width:98%;'><span class='datumDescription'>" . $role .": </span>" . $contributor['name'] . "</div>\r\n";
            } else {
              $separator2 = (($contributorsDisplayed == $contributorsArraySize) ? "" : ", ");
              $displayString .= "<span class='datumDescription'>" . $contributor['role'] .":&nbsp;</span>" 
                             . $contributor['name'] . $separator2 . "\r\n";
            }
          }
        }
//        $displayString .= '</div>';
      }
    }
    if ($contributorsDisplayed == 0) 
      $displayString .= "<div class='datumValue floatLeft' style='padding-bottom:0;'>&nbsp;No contributors are listed.</div>"; // 2/1/09
    $displayString .= "  </div>\r\n  <div style='clear:both;'></div>\r\n</div>\r\n";
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
      if (!$optionalContributor || ($optionalContributor && ($roleString != '')) || (($nameString != '') && ($nameString != '---'))) {
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

  public static function getFrameParametersDisplayElement($workArray) {
    $resultString = '';
    // aspect ratio
    $aspectRatioId = (isset($workArray['aspectRatio']) && ($workArray['aspectRatio'] != '') && ($workArray['aspectRatio'] !== null)) ? $workArray['aspectRatio'] : 0;
    $selectString = "SELECT ratio, description from aspectRatios where aspectRatioId = " . $aspectRatioId;
    $aspectRatioRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $separator = '';
    if (($aspectRatioRows !== null) && (count($aspectRatioRows) > 0)) {
      $resultString .= '<div class="datumValue floatLeft" style="padding-top:2px;padding-left:10px;">';
      $resultString .= '<span class="datumDescription">Aspect Ratio </span>' 
           . $aspectRatioRows[0]['ratio'] . " - " . $aspectRatioRows[0]['description'];
      $separator = ', ';
    } 
    // anamorphic
    if ($workArray['anamorphic']) {
      $resultString .= ($separator == '') ? '<div floatLeft class="datumValue">Anamorphic' : ', anamorphic';
      $separator = ', ';
    }
    // frame width & height
    if ($workArray['frameWidthInPixels'] != '' && $workArray['frameHeightInPixels'] != '' 
          && $workArray['frameWidthInPixels'] != 0 && $workArray['frameHeightInPixels'] != 0) {
      if  ($separator == '') $resultString .= '<div floatLeft class="datumValue">';
      $resultString .= $separator . $workArray['frameWidthInPixels'] . 'x' . $workArray['frameHeightInPixels'];
      $separator = ', ';
    }
    if ($separator != '') $resultString .= '</div>' . "\r\n";
    return $resultString;
  }

  public static function displayFrameParameters($workArray) {
    // aspect ratio
    $aspectRatioId = (isset($workArray['aspectRatio']) && ($workArray['aspectRatio'] != '') && ($workArray['aspectRatio'] !== null)) ? $workArray['aspectRatio'] : 0;
    $selectString = "SELECT ratio, description from aspectRatios where aspectRatioId = " . $aspectRatioId;
    $aspectRatioRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $separator = '';
    if (($aspectRatioRows !== null) && (count($aspectRatioRows) > 0)) {
      echo '<div style="margin-top:1px;"><div class="datumValue">';
      echo '<span class="datumDescription">Aspect Ratio </span>' 
           . $aspectRatioRows[0]['ratio'] . " - " . $aspectRatioRows[0]['description'];
      $separator = ', ';
    } 
    // anamorphic
    if ($workArray['anamorphic']) {
      echo ($separator == '') ? '<div class="datumValue">Anamorphic' : ', anamorphic';
      $separator = ', ';
    }
    // frame width & height
    if ($workArray['frameWidthInPixels'] != '' && $workArray['frameHeightInPixels'] != '' 
          && $workArray['frameWidthInPixels'] != 0 && $workArray['frameHeightInPixels'] != 0) {
      if  ($separator == '') echo '<div class="datumValue">';
      echo $separator . $workArray['frameWidthInPixels'] . 'x' . $workArray['frameHeightInPixels'];
      $separator = ', ';
    }
    if ($separator != '') echo '</div></div>' . "\r\n";
  }

  // Generates HTML for the work detail. Parameter $workArray must contain workId.
  public static function displayWorkDetail($workArray, $contributorsArray) {
    if (self::$showFunctionMarkers) echo "<!-- BEGIN displayWorkDetail -->\r\n";
    if (!is_null($workArray)) {
      $workId = $workArray['workId'];
      // title, year, runtime
      echo '<div class="datumValue">' . $workArray['title'] . ' (' . $workArray['yearProduced'] 
           . ')<span class="datumDescription" style="margin-left:2em;">run time: </span>' 
           . $workArray['runTime'] . '</div>' . "\r\n";
      // submission & original formats & frame parameters: aspect ratio, anamorphic, & width & height0
      echo '<div class="datumValue"><span class="datumDescription">Submitted as </span>' 
           . $workArray['submissionFormat'] . '<span class="datumDescription">. Originally recorded as </span>' 
           . $workArray['originalFormat'] . '</div>' . "\r\n";
//      echo "\r\n";
      // display frame parameters: aspect ratio, anamorphic, & width & height (ABOVE)
//      self::displayFrameParameters($workArray);
      // work contributors
      echo '<!-- display Contributor Information -->' . "\r\n";
      $displayContributorsOnSeparateLines = true;
//      echo self::getAllContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);
      echo self::getContributorDisplayLines($contributorsArray, $displayContributorsOnSeparateLines);
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
      echo '<div class="datumValue"><span class="datumDescription">Payment Information: </span>';
      $works_title = (isset($workArray['title'])) ? $workArray['title'] : '';
      $people_email = (isset($workArray['email'])) ? $workArray['email'] : '';
      $people_firstName = (isset($workArray['nickName'])) ? $workArray['nickName'] : '';
      $people_lastName = (isset($workArray['lastName'])) ? $workArray['lastName'] : '';
      $getVars = "works_title='" . $works_title . "'&amp;people_email='" . $people_email
               . "'&amp;people_firstName='" . $people_firstName . "'&amp;people_lastName='" . $people_lastName . "'";
//      if ($workArray['howPaid'] == "paypal") echo 'Paypal. (<a href="../paypal/index.php?' . $getVars . '">pay now</a>)<br>';
      if ($workArray['howPaid'] == "paypal") 
        echo '<a href="../paypal/index.php?' . $getVars . '"><img src="../images/logos/PayPal_mark_37x23.gif" 
              alt="Pay now via PayPal" title="Pay now via PayPal" style="border:none;margin:0;padding:0;vertical-align:middle;"></a> ' .
             '(<a href="../paypal/index.php?' . $getVars . '">pay now</a>)<br>';
      else if ($workArray['howPaid'] == "check") echo "Pay via check or money order in US Dollars sent via post with media..<br>";
      else echo ucfirst($workArray['howPaid']);
      echo "</div>\r\n";
      // release info
      echo '<div class="datumValue"><span class="datumDescription">Release Information: </span>';
      if (!isset($workArray['permissionsAtSubmission']) || ($workArray['permissionsAtSubmission'] == '')) $releaseInfo = 'None given.';
      else {
//        $releaseInfo = "You have certified that you hold all necessary rights for the submission of this entry and that you give Sans Souci "
//                     . "Festival permission for screening this submission at the Festival Event in Boulder, Colorado USA on September 10 &amp; 11, 2010";
        $releaseInfo = SSFRunTimeValues::getReleaseInfoStatementIntroString();
//        if ($workArray['permissionsAtSubmission'] == "allOK2010")                                   // << TODO This should not be hard-coded ^^
        if ($workArray['permissionsAtSubmission'] == SSFRunTimeValues::getPermissionAllOKString($workArray['callForEntries']))
//          $releaseInfo .= " and also at all tours associated with the 2010-2011 Season in the US and elsewhere."; 
          $releaseInfo .= SSFRunTimeValues::getReleaseInfoStatementAllOKString(); 
//        else $releaseInfo .= ". As we make such arrangements, we may invite your work to each subsequent tour/venue separately so that you can respond to each individually.";
        else $releaseInfo .= SSFRunTimeValues::getReleaseInfoStatementAskMeString();
      }
      echo $releaseInfo . "</div>\r\n";
      // items for administrative completion
        // titleForSort, designatedId, dateMediaReceived, datePaid, amtPaid, howPaid, checkOrPaypalNumber, webSitePertainsTo, photoLocation
    }
    if (self::$showFunctionMarkers) echo "<!-- END displayWorkDetail -->\r\n";
  }
  
  public static function getTheWorkRows($works, $displayQuickNotes, $withEmailInfo=false) {
    // Display the list of works.
    $titleStyleString = "line-height:14px;padding-bottom:2px;border-bottom:1px #999 solid;background-color:#5a2940;vertical-align:top;";
    $theRowsHTML = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\r\n";
    // Display the legend line/title.
    $theRowsHTML .= "<tr><td align='right' class='bodyTextOnDarkGray' "
         . "style='width:4em;" . $titleStyleString . "'>\r\n"
         . "<span class='designatedIdDisplayText'>Id</span>&nbsp;&nbsp;</td>\r\n" 
         . "<td align='left' class='bodyTextOnDarkGray' style='" . $titleStyleString . "'>"
         . "  <i><span style='color:#99CCFF'>Title</span>,</i>&nbsp; \r\n"
         . "Submitter (Locale) "
         . (($withEmailInfo) ? "" : "<span class='submissionFormatDisplayText'>SubmssnFrmt</span> / <span class='originalFormatDisplayText'>OrgnlFrmt</span> \r\n")
         . "<span class='runTimeDisplayText'>Run Time</span>"
         . "  <span class='acceptedDisplayColor'><b>&#8657;</b> Accepted</span> \r\n"
         . "<span class='rejectedDisplayColor'><b>&#8659;</b> Rejected</span>"
         . "  <span class='scoreDisplayText'>Avg Score</span></td></tr>"
         . "<tr><td><div style='margin-bottom:.25em;'></div></td></tr>\r\n";

    // Display each work.
    $rowStyleString = 'line-height:17px;padding-bottom:4px;';
    foreach ($works as $work) {
      $theRowsHTML .= "<tr><td align='right' valign='top' class='bodyTextOnDarkGray' style='" . $rowStyleString . "'>" 
          . self::clickableForDetailDisplay($work, 
                                            "\r\n      <span style='color:#B7E5F7;overflow:visible'>" . $work['designatedId'] . "</span>",
                                            $withEmailInfo, $forReferencedWork=false) 
          . "&nbsp;&nbsp;</td>\r\n    <td id='" . self::listLineId($work['workId']) . "'" 
          . "' align='left' valign='top' class='bodyTextOnDarkGray' style=" . $rowStyleString . ">"
          . self::entrySummaryLineDisplay($work, $displayQuickNotes, $withEmailInfo)
          . "</td></tr>\r\n";
    }
    $theRowsHTML .=  "</table>\r\n";
    return $theRowsHTML;
  }  

  public static function clickableForDetailDisplay($workRow, $clickableString, $withEmailInfo=false, $forReferencedWork=false) {
    $workIdToDisplay = $workRow['workId'];
    $cacheName = self::currentEntryIdCacheName($withEmailInfo);
    $decided = $workRow['accepted'] != $workRow['rejected'];
    if ($withEmailInfo && !$forReferencedWork) {
      $clickableMarkup = SSFCommunique::anchorMarkupForDetailEntryDisplayWithEmail($workRow) . $clickableString . '</a>';
    } else {
      $clickableMarkup = '<a href="curationEntry.php?callContext=' . (($withEmailInfo) ? 'curationEmail' : 'curation') 
                       . '&workId=' . $workIdToDisplay . '" target="curationEntry" '
                       . 'onclick="setCookie(\'' . $cacheName . '\', ' . $workIdToDisplay . ');">' 
                       . $clickableString . '</a>';
    }
    if ($workIdToDisplay == 591 || $workIdToDisplay == 592) {
      self::debugger()->bechoTrace('clickableForDetailDisplay() cacheName', $cacheName, -1);
      self::debugger()->bechoTrace('clickableForDetailDisplay() clickableMarkup', $clickableMarkup, -1);
    }
    return $clickableMarkup;
  }

  private static function entrySummaryLineDisplay($workRow, $displayQuickNotes, $withEmailInfo=false) {
    $displayQuickNotesString = ($displayQuickNotes) ? 'inline' : 'none';
    $workId = $workRow['workId'];
    $avgScore = self::getDbScoreFor($workId);
    $quickNoteId = self::listQuickNoteId($workId);
    $quickNote = str_replace("'", "\'", self::getQuickNoteFor($workId));
    $designatedId = (($workRow['designatedId'] == '' || $workRow['designatedId'] == 0) ? 'NO-ID' : $workRow['designatedId']) . '. ';
//    $designatedId = $workRow['designatedId'] . '. php ';
    $quickNoteIcon = ($quickNote == '') ? '' : // TODO This HTML is duplicated in ssf.js
      '<a href="javascript:void(0)" ' . 
           'onMouseOver="flyoverPopup(\'' . $designatedId . $quickNote . '\', \'#FFFF99\')"' .
           'onMouseOut="killFlyoverPopup()" onClick="window.alert(\'' . $designatedId . $quickNote . '\')">' .
           '<span style="font-weight:bold;color:#D25EC0;">Q</span>' . '</a>';
    $displayLine = "<i>" 
          . self::clickableForDetailDisplay($workRow, $workRow['title'], $withEmailInfo, $forReferencedWork=false) 
          . " <span class='idDisplayText'>" . $workId . "</span>,</i> \r\n" 
          . ((!self::mediaReceived($workRow['dateMediaReceived'])) ? "<span class='noMediaDisplayColor'>&#8855;</span> \r\n" : "")
          . "      " . $workRow['name'] 
          . " (" . self::cityStateCountryString($workRow['city'], $workRow['stateProvRegion'], $workRow['country']) . ") " 
          . (($withEmailInfo) ? "" : "<span class='submissionFormatDisplayText'>" . $workRow['submissionFormat'] . "</span>/" 
            . "<span class='originalFormatDisplayText'>" . self::originalFormatDisplay($workRow['originalFormat']) . "</span> ")
          . "<span class='runTimeDisplayText'>" . substr($workRow['runTime'], 1, 7) . "</span> \r\n" 
          . (($workRow['includesLivePerformance'] == 1) ? "<span class='liveDisplayText'> Live</span> \r\n" : "")
          . "  <span id='" . $quickNoteId . '-icon' . "' class='scoreDisplayText' style='font-weight:bold;'>" . $quickNoteIcon . "</span>"
          . "      " . self::acceptanceDisplay($workId, $workRow['accepted'], $workRow['rejected'], $workRow['acceptFor'])
          . "  <span id='" . self::listScoreId($workId) . "' class='scoreDisplayText'>" . self::scoreString($avgScore) . "</span>"
          . "  <span id='" . $quickNoteId . '-text' . "' style='color:#dd89d1;display:" . $displayQuickNotesString . ";'>" . $quickNote . "</span>";
    if ($withEmailInfo) {
      $widgetId = SSFCommunique::computeEmailWidgetId($workId);
      $widgetMarkup = SSFCommunique::selectEntryForDetailDisplayWithEmailWidgetMarkup($workRow);
      self::debugger()->belch('entrySummaryLineDisplay() widgetMarkup', $widgetMarkup, -1);
      if ($withEmailInfo && $widgetMarkup != "") $displayLine .= "\r\n<span id='" . $widgetId . "'>" . $widgetMarkup . "</span>";
    }
    return $displayLine;
  }

  public static function curationEntryHREFText($workId) { return "curationEntry.php?callContext=curationEmail&workId=" . $workId; }
//  public static function curationEntryHREFJSText($workId) { return "curationEntry.php?callContext=\'curationEmail&workId=" . $workId . "\'"; }
  public static function curationEntryHREFJSText() { return "'curationEntry.php?callContext=curationEmail&workId=' + workId "; }
  public static function curationEntryAnchorTargetText() { return "curationEntry"; }
  public static function curationEntryAnchorOnClickText($workId) { 
      $cacheName = HTMLGen::currentEntryIdCacheName($withEmailInfo = true);
      return "setCookie('" . $cacheName . "', " . $workId . ")";
     }
  public static function curationEntryAnchorOnClickJSText() { 
      $cacheName = HTMLGen::currentEntryIdCacheName($withEmailInfo = true);
      return "setCookie(\'" . $cacheName . "\', workId)";
     }

// Global constants
//  public static $currentEntryIdCacheNameForCuration = 'currentEntryIdCache_Curation';
//  public static $currentEntryIdCacheNameForCurationEmail = 'currentEntryIdCache_CurationEmail';

  public static function currentEntryIdCacheName($withEmailInfo) {
    self::debugger()->belch('currentEntryIdCacheName() withEmailInfo', $withEmailInfo, -1);
    $cacheName = ($withEmailInfo) ? 'currentEntryIdCache_CurationEmail' : 'currentEntryIdCache_Curation';
    return $cacheName;
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
  
  public static function getQuickNoteFor($workId) {
    // SFDB::debugNextQuery();
    $quickNote = '';
    $qnQueryString = "SELECT notes from curation where entry=" . $workId . ' and curator = ' . self::$quickNoteCuratorId;
    $qnArray = SSFDB::getDB()->getArrayFromQuery($qnQueryString);
    if (SSFDB::getDB()->querySuccess() && count($qnArray) == 1) $quickNote = $qnArray[0]['notes'];
    return $quickNote;
  }

  public static function scoreString($avgScore) {
    return substr($avgScore, 0, 3);
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

  // KEEP in sync with ssf.js
  private static $quickNoteCuratorId = 832; // TODO Get this from the database or something.
  private static function listLineId($id) { return 'listLineId-' . $id; }
  private static function listARId($id) { return 'listARId-' . $id; }
  private static function listScoreId($id) { return 'listScoreId-' . $id; }
  private static function listQuickNoteId($id) { return 'listQNId-' . $id; }
  
  public static function acceptanceString($accepted, $rejected) {
    if ($accepted==1) $a = '<span class="acceptedDisplayColor">&#8657;</span>'; else $a = '&#8657;';
    if ($rejected==1) $r = '<span class="rejectedDisplayColor">&#8659;</span>'; else $r = '&#8659;';
    $displayString = $a . $r; // alternately $a . "&nbsp;" . $r 
    if ($accepted == 1 && $rejected == 0) $displayString = $a;
    else if ($accepted == 0 && $rejected == 1) $displayString = $r;
    return $displayString;
  }
  
  public static function acceptanceString2($accepted, $rejected) {
    if ($accepted==1) $a = '<span class=|acceptedDisplayColor|>&#8657;</span>'; else $a = '&#8657;';
    if ($rejected==1) $r = '<span class=|rejectedDisplayColor|>&#8659;</span>'; else $r = '&#8659;';
    $displayString = $a . $r; // alternately $a . "&nbsp;" . $r 
    if ($accepted == 1 && $rejected == 0) $displayString = $a;
    else if ($accepted == 0 && $rejected == 1) $displayString = $r;
    return $displayString;
  }
  
  public static function acceptanceDisplay($workId, $accepted, $rejected, $acceptFor) { 
    $acceptForText = (($accepted) ? (($acceptFor == 'screening') ? 'S' 
                                 : ((($acceptFor == 'installationOnly') ? 'I' 
                                 : (($acceptFor == 'installationMaybe') ? 'I?' 
                                 : (($acceptFor == 'documentary') ? 'D' : ''))))) 
                                 : '');
//    $acceptForText = 'Y';
    return "<span id='" . self::listARId($workId) . "' style='font-weight:bold;'>" 
             . self::acceptanceString($accepted, $rejected) . "<span class='acceptedDisplayColor' style='font-family:Times;'>" . $acceptForText . "</span></span>";
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
  
  public static function arWidgetDisplay($workId, $accepted, $rejected) {
    if ($accepted==1) $a = "<span id='arwdA' style='color:#07EB01;'>&#8657;</span>"; else $a = "&#8657;";
    if ($rejected==1) $r = "<span id='arwdR' style='color:#CE181F;'>&#8659;</span>"; else $r = "&#8659;";
    if (($accepted===0) && ($rejected===0)) $c = "<span id='arwdC' style='color:yellowish;'>&#8855;</span>"; else $c = "&#8855;"; // "&#8226;";
    self::debugger()->becho('self::acceptanceString(1,0)', self::acceptanceString2(1,0), -1);
    self::debugger()->becho('the string', 
      "onclick='updateARStatus($workId, 1, 0, \"" . str_replace("'", "\'", str_replace("\'", "\\'", self::acceptanceString2(1,0))) . "\")'><span style='font-size:1.25em;'>$a</span></a> ", -1);
    return "<span id='innerARSpan' style='font-weight:bold;'>" 
           . "<a class='acceptEntryOperator' href='#' "
           .   "onclick='updateARStatus($workId, 1, 0, \"" . self::acceptanceString2(1,0) . "\")'><span style='font-size:1.25em;'>$a</span></a> "
           . "<a class='clearEntryStatusOperator' href='#' "
           .   "onclick='updateARStatus($workId, 0, 0, \"" . self::acceptanceString2(0,0) . "\")'><span style=''>$c</span></a> " 
           . "<a class='rejectEntryOperator' href='#' "
           .   "onclick='updateARStatus($workId, 0, 1, \"" . self::acceptanceString2(0,1) . "\")'><span style='font-size:1.25em;'>$r</span></a>"
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
    echo '<td align="' . $align . '" colspan="3" class="bodyTextOnBlack" style="font-size:6px;padding:20px 0 24px 0;">';
    if (sizeOf($showArray) > 0) { echo '|'; }
    foreach ($showArray as $show) {
      echo '&nbsp;<a href="#' . self::genShowIdTag($show['showId']) . '">' . $show['shortDescription'] . '</a>&nbsp;|';
    }
    if (sizeOf($showArray) > 0) echo '&nbsp;&nbsp;'; 
    else echo '<div class="programHighlightColor" style="font-size:20px;margin:100px 0 270px 0;text-align:center;">Coming Soon...</div>';
    echo '</td></tr>' . "\r\n";
  }

  // Insert the name anchor for the show for on-page navigation from the index of shows.
  public static function progPageDisplayShowDescription($showId, $text) {
    echo '<tr align="left">' . "\r\n";
    echo '  <td height="10" colspan="3" valign="top"  class="programInfoText"><a name="' . self::genShowIdTag($showId) 
              . '"></a>' . $text . '<br clear="all">' . "\r\n";
    echo '    <img src="../images/dotClear.gif" alt="" width="1" height="10"></td>' . "\r\n";
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

    // define $yearProduced
    $yearProduced = $workRow['yearProduced'];
    if ($yearProduced == '0000' || $yearProduced = '9999') $yearProduced = '';

    // compute $runTimeMinutes
    list($hours, $minutes, $seconds) = sscanf($workRow['runTime'], "%d:%d:%d");
    $runTimeMinutes = $minutes + (60 * $hours);
    if ($seconds >= 31) $runTimeMinutes++; 
    // while ($runTime[0] == '0' || $runTime[0] == ':') $runTime = substr($runTime, 1);
    
    // define $originalFormat
    $originalFormat = (!isset($workRow['originalFormat']) || $workRow['originalFormat'] == '' 
                           || $workRow['originalFormat'] == 'selectSomething') ? '' : $workRow['originalFormat'];

    // define existential vaviables to be used for inserting commas
    $yearProducedExists = isset($yearProduced) && $yearProduced != '';
    $liveTextExists = ($workRow['includesLivePerformance'] == 1);
    $runTimeMinutesExists = isset($runTimeMinutes) && $runTimeMinutes != 0;
    $originalFormatExists = ($originalFormat != '');
    
    // define $liveText depending on whether it includes live performance
    $liveText = (($liveTextExists) ? '<span class="filmLiveText">includes live performance' . (($runTimeMinutesExists || $originalFormatExists) ? ', ' : '') . '</span>' : '');
    
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
    $camera = '';
    $editor = '';
    $contributorRole1 = '';
    $contributorName1 = '';
    $contributorRole2 = '';
    $contributorName2 = '';
    foreach ($contributorSelectAllRows as $contributorRow) { 
      self::debugger()->belch('Contributor', $contributorRow['role'] . ': ' . $contributorRow['name'], -1);
      if ($contributorRow['role'] == 'Director') $director = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Producer') $producer = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Choreographer') $choreographer = $contributorRow['name'];
      else if ($contributorRow['role'] == 'DanceCompany') $danceCompany = $contributorRow['name'];
      else if ($contributorRow['role'] == 'PrincipalDancers') $principalDancers = $contributorRow['name'];
      else if ($contributorRow['role'] == 'MusicComposition') $musicComposer = $contributorRow['name']; 
      else if ($contributorRow['role'] == 'MusicPerformance')  $musicPerformer = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Camera')  $camera = $contributorRow['name'];
      else if ($contributorRow['role'] == 'Editor')  $editor = $contributorRow['name'];
      else if ($contributorRole1 == "") {
        $contributorRole1 = $contributorRow['roleDescription'];
        $contributorName1 =  $contributorRow['name'];
      } else {
        $contributorRole2 = $contributorRow['roleDescription'];
        $contributorName2 =  $contributorRow['name'];
      }
    }
    self::debugger()->belch('editor', $editor, -1);
    $prodEqDir = ($director == $producer);
    $chorEqDancer = ($choreographer == $principalDancers);
    $performerEqComposer = ($musicComposer == $musicPerformer);
    $cameraEqEditor = ($camera == $editor);

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
    $cameraTitle = ($cameraEqEditor) ? 'Filmmaker ' : 'Cinematography by ';
    $cameraDisplay = ($camera ==  '') ? '<!-- No camera given. -->'
                                                : $filmInfoDivSpanText . $cameraTitle . ' </span>' . HTMLGen::htmlEncode($camera) . '</div>';
    $editorDisplay = ($editor ==  '') ? '<!-- No editor given. -->'
                                                 : ($cameraEqEditor) ? '<!-- Camera same as editor. -->'
                                                                          : $filmInfoDivSpanText . 'Edited by </span>' 
                                                                                                 . HTMLGen::htmlEncode($editor) . '</div>';
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
              . '" title="' . HTMLGen::htmlEncode($imageTitleText) . '" height="' . $imageHeightInPixels . '"' 
              . '" "width="' . $imageWidthInPixels . '" hspace="2" vspace="0" border="' . $programPicBorderWidth 
              . '" align="left" style="margin-left:1px;">';
    if ($imageCaption != '') echo '<br clear="all"><div class="filmFigureCaption">' . HTMLGen::htmlEncode($imageCaption) . '</div>';
    echo      '</td>' . "\r\n";
    echo '    <td width="12" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" align="left" valign="top" class="bodyText">' . '<div class="filmTitleText">' 
              . $title . (($yearProducedExists || $liveTextExists || $runTimeMinutesExists || $originalFormatExists) ? ', ' : '')
              . (($yearProducedExists) ? '<span class="filmYearText">' . $yearProduced . (($liveTextExists || $runTimeMinutesExists || $originalFormatExists) ? ', ' : '') . '</span>' : '')
              . $liveText
              . (($runTimeMinutesExists) ? '<span class="filmRunTimeText">' . $runTimeMinutes . ' min' . (($originalFormatExists) ? ', ' : '') . '</span>' : '')
              . '<span class="filmFormatText">' . $originalFormat . '</span></div>' . "\r\n";
    echo '      ' . $directorDisplay . "\r\n";
    echo '      ' . $producerDisplay . "\r\n";
    echo '      ' . $choreoDisplay . "\r\n";
    echo '      ' . $companyDisplay . "\r\n";
    echo '      ' . $dancersDisplay . "\r\n";
    echo '      ' . $musicCompDisplay . "\r\n";
    echo '      ' . $musicPerfDisplay . "\r\n";
    echo '      ' . $cameraDisplay . "\r\n";
    echo '      ' . $editorDisplay . "\r\n";
    echo '      ' . $otherContributor1Display . "\r\n";
    echo '      ' . $otherContributor2Display . "\r\n";
    echo '      ' . $filmInfoDivSpanText . 'Synopsis: </span>' . HTMLGen::htmlEncode($synopsis) 
                  . (($cityStateCountry != '') ? '<span class="filmCityStateCountryText"> (' . HTMLGen::htmlEncode($cityStateCountry) . ')</span>' : '')
                  . '</div></td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '  <tr>' . "\r\n";
    echo '    <td width="188" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="2" height="36" align="center" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '    <td width="336" height="36"  align="left" valign="top" class="bodyText">&nbsp;</td>' . "\r\n";
    echo '  </tr>' . "\r\n";
    echo '<!-- Web #' . $index . ', Film ' . $workRow['designatedId'] . ', "' . $workRow['title'] . '" -->' . "\r\n\r\n";
  }

}


class SSFHelp {

  private static $valuesAreInitialized = false;
  private static $helpString = array();
  private static $debugger;
  private static $doBelchAndBecho = false; // true false
  private static $float = '';

  public static function setFloat($string) { self::$float = $string; }
  public static function clearFloat($string) { self::$float = ''; }
  
  private function debugger() { 
    if (!isset($debugger)) $debugger = new SSFDebug($initBelchEnabled=self::$doBelchAndBecho, $initBechoEnabled=self::$doBelchAndBecho);
    return $debugger;
  }

  private static function initializeRunTimeValuesFromDB() {
    if (!self::$valuesAreInitialized) {
      $helpRows = SSFDB::getDB()->getArrayFromQuery("SELECT * from editorHelp");
      foreach ($helpRows as $helpRow) {
        self::$helpString[$helpRow['helpKey']] = $helpRow['helpString'];
      }
    }
    self::$valuesAreInitialized = true;
    self::debugger()->belch('self::$helpString', self::$helpString, 0);
  }

  public static function helpStringFor($helpStringKey) {
    if (!self::$valuesAreInitialized) self::initializeRunTimeValuesFromDB();
    $helpStringValue = ((isset(self::$helpString[$helpStringKey])) ? self::$helpString[$helpStringKey] : '');
    return $helpStringValue;
  }
  
  public static function getHTMLIconFor($popupHelpStringKey, $alertHelpStringKey='') {
    if (!self::$valuesAreInitialized) self::initializeRunTimeValuesFromDB();
    if ($alertHelpStringKey == '') $alertHelpStringKey = $popupHelpStringKey;
    self::debugger()->becho('getHTMLIconFor popupHelpStringKey', $popupHelpStringKey, 0);
    self::debugger()->becho('getHTMLIconFor alertHelpStringKey', $alertHelpStringKey, 0);
    $popupHelpString = self::helpStringFor($popupHelpStringKey);
    $alertHelpString = self::helpStringFor($alertHelpStringKey);
    self::debugger()->becho('getHTMLIconFor popupHelpString', $popupHelpString, 0);
    self::debugger()->becho('getHTMLIconFor alertHelpString', $alertHelpString, 0);
    if ($popupHelpString == '') $htmlEmbed = '';
    else {
      $floatString = (self::$float == 'left') ? 'float:left;' 
                   : (self::$float == 'right') ? 'float:right;' 
                   : (self::$float == 'none') ? 'float:none;' : '';
      $htmlEmbed = '<a href="javascript:void(0)" onMouseOver="flyoverPopup(' . 
                    HTMLGen::simpleQuote($popupHelpString) . ', ' . HTMLGen::simpleQuote('#FFFF99') . ')"' .
                    ' onMouseOut="killFlyoverPopup()" onClick="window.alert(' . HTMLGen::simpleQuote($alertHelpString) . ')">' .
                    '<img src="../images/helpIcon16.png" alt="HELP" ' .
                    'style="' . $floatString . 'padding:0px 8px;margin:0px 0px;border:none;text-align:center;position:relative;top:-1;' .
                    'vertical-align:middle;"></a>';
    }
    self::debugger()->becho('getHTMLIconFor htmlEmbed', $htmlEmbed, 0);
    return $htmlEmbed;
  }
}


class SSFQuickNote {

  private static $valuesAreInitialized = false;
  private static $helpString = array();
  private static $debugger;
  private static $doBelchAndBecho = false; // true false
  private static $float = '';

  public static function setFloat($string) { self::$float = $string; }
  public static function clearFloat($string) { self::$float = ''; }
  
  private function debugger() { 
    if (!isset($debugger)) $debugger = new SSFDebug($initBelchEnabled=self::$doBelchAndBecho, $initBechoEnabled=self::$doBelchAndBecho);
    return $debugger;
  }

  private static function initializeRunTimeValuesFromDB() {
    if (!self::$valuesAreInitialized) {
      $helpRows = SSFDB::getDB()->getArrayFromQuery("SELECT * from editorHelp");
      foreach ($helpRows as $helpRow) {
        self::$helpString[$helpRow['helpKey']] = $helpRow['helpString'];
      }
    }
    self::$valuesAreInitialized = true;
    self::debugger()->belch('self::$helpString', self::$helpString, 0);
  }

  public static function helpStringFor($helpStringKey) {
    if (!self::$valuesAreInitialized) self::initializeRunTimeValuesFromDB();
    $helpStringValue = ((isset(self::$helpString[$helpStringKey])) ? self::$helpString[$helpStringKey] : '');
    return $helpStringValue;
  }
  
  // example use: getHTML(HTMLGen::listQuickNoteId($workId))
  public static function getHTMLIcon() {
    $htmlEmbed = '<div >';
    $text = 'QuickNote';
    if ($popupHelpString == '') $htmlEmbed = '';
    else {
      $floatString = (self::$float == 'left') ? 'float:left;' 
                   : (self::$float == 'right') ? 'float:right;' 
                   : (self::$float == 'none') ? 'float:none;' : '';
      $htmlEmbed = '<a href="javascript:void(0)" onMouseOver="flyoverPopup(' . 
                    $text . ', ' . HTMLGen::simpleQuote('#FFFF99') . ')"' .
                    ' onMouseOut="killFlyoverPopup()" onClick="window.alert(' . $text . ')">' .
                    '<img src="../images/helpIcon16.png" alt="HELP" ' .
                    'style="' . $floatString . 'padding:0px 8px;margin:0px 0px;border:none;text-align:center;position:relative;top:-1;' .
                    'vertical-align:middle;"></a>';
    }
    self::debugger()->becho('getHTMLIconFor htmlEmbed', $htmlEmbed, 0);
    return $htmlEmbed;
  }
}


class SSFFocus {

  private static $setFocusTo = '';
  
  public static function prep($widgetId) { self::$setFocusTo = $widgetId; }
  
  public static function set() {
   if (isset(self::$setFocusTo) && self::$setFocusTo != '') 
     echo "<script type='text/javascript'>document.getElementById('" . self::$setFocusTo . "').focus();</script>\r\n";
  }
  
  public static function select() {
   if (isset(self::$setFocusTo) && self::$setFocusTo != '') 
     echo "<script type='text/javascript'>var element=document.getElementById('" . self::$setFocusTo . "');element.focus();element.select();</script>\r\n";
  }
}

?>
