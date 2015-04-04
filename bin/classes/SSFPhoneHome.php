<?php

  // Class phoneHome generates the email to send to SSF admins when a person or work is created or edited.

  class SSFPhoneHome {
    private static $to          = "entryform@sanssoucifest.org";
    private static $subject     = "Entry Form Submitted for ";
    private static $fieldNames  = "";
    private static $fieldValues = "";
    private static $message     = "";
    private static $headers     = "From: entryform@sanssoucifest.org\r\nReply-To: no-reply@sanssoucifest.org\r\nX-Mailer: PHP/";// . phpversion();
    private static $on = false;
    
    public static function turnOn() { $on = true; }
    public static function turnOff() { $on = false; }

    // returns $stringToAddTo . ',' . $stringToAdd but only uses the comma if $stringToAddTo != ''
    private static function addCommaDelimitedTextNoSpaces($stringToAddTo, $stringToAdd) { 
      if ($stringToAddTo != '') $stringToAddTo .= ",";
      $stringToAddTo .= $stringToAdd;
      return $stringToAddTo;
    }
  
    // Returns a name/value pair in the form 'Name: Value' and side-effects the globals
    // $fieldNames & $fieldValues by appending $name and $value respectively with appropriate commas and no spaces
    private static function addDataItem($name, $value) {
/*
      SSFDebug::globalDebugger()->belch("addDataItem() self::fieldNames", self::$fieldNames, 1);
      SSFDebug::globalDebugger()->belch("addDataItem() self::fieldValues", self::$fieldValues, 1);
      SSFDebug::globalDebugger()->becho("addDataItem name", $name, 1);
      SSFDebug::globalDebugger()->bechoTrace("addDataItem value", $value, 1);
*/
      self::$fieldNames = self::addCommaDelimitedTextNoSpaces(self::$fieldNames, $name);
      self::$fieldValues = self::addCommaDelimitedTextNoSpaces(self::$fieldValues, '"' . $value . '"');
      $nameValuePair = ($name . ": \"" . $value . "\"\r\n");
/*
      SSFDebug::globalDebugger()->becho("addDataItem nameValuePair", $nameValuePair, 1);
      SSFDebug::globalDebugger()->belchTrace("addDataItem nameValuePair", $nameValuePair, 1);
*/
      return $nameValuePair;
    }
    
    public static function sendItNow() {
      self::$message .= PHP_EOL . PHP_EOL . self::$fieldNames . PHP_EOL . self::$fieldValues;
/*
      SSFDebug::globalDebugger()->becho("to", self::$to, 1); // 5/30/14
      SSFDebug::globalDebugger()->becho("subject", self::$subject, 1);
      SSFDebug::globalDebugger()->becho("message", self::$message, -1);
      SSFDebug::globalDebugger()->becho("headers", self::$headers, 1);
*/
      $mailedData = mail(self::$to, self::$subject, self::$message, self::$headers);
/*       SSFDebug::globalDebugger()->becho("mailedData", $mailedData, 1); */
    }
  
    private static function initInfo($subject) {
      self::$subject = $subject;
      self::$fieldNames  = "";
      self::$fieldValues = "";
      self::$message     = "";
      self::$headers     = "From: entryform@sanssoucifest.org\r\n"
                         . "Reply-To: no-reply@sanssoucifest.org\r\n"
                         . "X-Mailer: PHP/" . phpversion();
      }

    public static function personInfoHelper($stateArray, $leaderString) {
      $dataItemNames = array(
        'loginUserId', 'people_personId', 'people_nickName', 'people_lastName', 'people_name', 'people_organization',
        'people_streetAddr1', 'people_streetAddr2', 'people_city', 'people_stateProvRegion', 'people_zipPostalCode', 'people_country',
        'people_phoneVoice', 'people_phoneMobile', 'people_phoneFax', 'people_email', 'people_password', 
        'people_notifyOf', 'people_howHeardAboutUs');
      $lastUpdateFields = SSFQuery::lastUpdateFields();
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() lastUpdateFields", $lastUpdateFields, -1);
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() stateArray", $stateArray, -1);
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
//        $text = self::addDataItem($dataItemName, trim(str_replace("  ", " ", $dataValue))); 
// ^^ 5/16/14 - Warning: trim() expects parameter 1 to be string, array given in /home/hamelbloom/sanssoucifest.org/onlineEntryForm/entryForm2014.php on line 238
        if (is_array($dataValue)) {
          $dataValueAsString = "";
          foreach($dataValue as $dataElement) {
            if ($dataValueAsString !== '') $dataValueAsString .= ",";
            $dataValueAsString .= trim($dataElement);
          }
//          SSFDebug::globalDebugger()->belchTrace("personInfoHelper dataValueAsString", $dataValueAsString, 1); // 4/3/15
          $text = self::addDataItem($dataItemName, $dataValueAsString); 
          SSFDebug::globalDebugger()->belch('phoneHome::personInfoHelper - The value for ' . $dataItemName . ' is an array', $dataValue, -1);
        } else { // since the $dataValue is not an array.
          $text = self::addDataItem($dataItemName, trim(str_replace("  ", " ", $dataValue))); 
        }
        $dataItemWasUpdated = in_array($dataItemName, $lastUpdateFields);
        SSFDebug::globalDebugger()->becho('phoneHome personInfoHelper dataItemName dataItemWasUpdated', '|' . $dataItemName . '| ' . (($dataItemWasUpdated !== false) ? 'TRUE' : 'FALSE'), -1);
        $textLeader = ($dataItemWasUpdated) ? '* ' : '   ';
        if (is_array($dataValue)) {
          $valueString = ''; $separator = '';
          foreach($dataValue as $cellValue) { $valueString .= $separator . $cellValue; $separator = ', '; }
        } else { $valueString = $dataValue; }  
        self::$message .= $textLeader . self::addDataItem($dataItemName, $valueString); 
      }
    }
    
    public static function sendPersonInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Prsn Edit:' : 'New Prsn:';
      self::initInfo($leaderString . ' ' . $stateArray['people_name'] . (($editing) ? ' (' . $changeCount . ')' : ''));
      self::$message = '';
      self::personInfoHelper($stateArray, $leaderString);
      self::sendItNow();
    }
    
    public static function sendPossibleDuplicatePersonInfo($stateArray, $possibleDups='') {
      $leaderString = '** DUPLICATE Prsn? **';
      self::initInfo($leaderString . ' ' . $stateArray['people_name']);
      self::$message = 'This may be a duplicate person entry for ' . $stateArray['people_name'] . ".\r\n\r\n";
      self::$message .= $possibleDups;
      self::personInfoHelper($stateArray, $leaderString);
      self::sendItNow();
    }
    
    public static function sendEntryInfo($stateArray, $editing, $changeCount=0) {
      $leaderString = ($editing) ? 'Wrk Edit:' : 'New Work:';
      self::initInfo($leaderString . ' "' . $stateArray['works_title'] . '"' . (($editing) ? ' (' . $changeCount . ')' : ''));
      $dataItemNames = array(
        'works_workId_forInfoOnly', 'works_title', 'works_titleForSort', 'works_designatedId', 'works_submitter', 'people_name', 
        'works_yearProduced', 'works_countryOfProduction', 'works_runTime', 'works_submissionFormat', 'works_originalFormat', 
        'works_vimeoWebAddress', 'works_vimeoPassword', 'works_synopsisOriginal', 
        'works_webSite', 'works_previouslyShownAt', 'works_photoCredits', 'works_photoURL', 'works_howPaid', 'works_permissionsAtSubmission', 
//        'works_aspectRatio', 'works_anamorphic', 'works_frameWidthInPixels', 'works_frameHeightInPixels', 
        'workContributors_Director', 'workContributors_Producer', 'workContributors_Choreographer', 'workContributors_DanceCompany', 
        'workContributors_PrincipalDancers', 'workContributors_MusicComposition', 'workContributors_MusicPerformance', 
        'workContributors_Camera', 'workContributors_Editor', 
        'workContributors_role_Other_1', 'workContributors_Other_1', 
        'workContributors_role_Other_2', 'workContributors_Other_2', 
        );
      $lastUpdateFields = SSFQuery::lastUpdateFields();
      SSFDebug::globalDebugger()->belch("phoneHome::sendEntryInfo() lastUpdateFields-2", $lastUpdateFields, -1); // 5/30/14
// DEBUG      echo '<script type="text/javascript">alert("phoneHome::sendEntryInfo() lastUpdateFields-2: ' . $lastUpdateFields . '");</script>' . PHP_EOL;
      foreach ($dataItemNames as $dataItemName) {
        $dataValue = (isset($stateArray[$dataItemName])) ? $stateArray[$dataItemName] : 'n/a';
        $text = self::addDataItem($dataItemName, trim(str_replace("  ", " ", $dataValue))); 
        $dataItemWasUpdated = in_array($dataItemName, $lastUpdateFields);
        SSFDebug::globalDebugger()->becho('phoneHome sendEntryInfo dataItemName dataItemWasUpdated', '|' . $dataItemName . '| ' . (($dataItemWasUpdated !== false) ? 'TRUE' : 'FALSE'), -1);
        $textLeader = ($editing && $dataItemWasUpdated) ? '* ' : '   '; // added $editing to the condition 5/16/14
//        SSFDebug::globalDebugger()->becho('phoneHome sendEntryInfo text', '|' . $textLeader . '| ' . $text, (($editing && $dataItemWasUpdated) ? 1 : -1));  // 5/30/14
        self::$message .= $textLeader . $text;
      }
      self::sendItNow();
    }
  } // end class phoneHome ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++--
  
?>
