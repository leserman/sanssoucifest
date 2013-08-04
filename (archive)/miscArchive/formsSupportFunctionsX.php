<?php 

class HTMLGen {
  function displayCallForEntriesSelector($formName) {
    echo '<select id="callForEntriesId" name="CallForEntriesId" style="width:170px"' . "\r\n";
    echo 'onchange="document.' . $formName . '.submit();">' . "\r\n";
    $selectString = "SELECT callId, name, description from callsForEntries order by dateOfCall desc";
    $rows = SSFDB::getDB()->getArrayFromQuery($selectString);
    $selectionOptions = array();
    $selectionOptions[0] = 'All Events';
    foreach ($rows as $row) $selectionOptions[$row['callId']] = $row['description'];
    displaySelectionOptions($selectionOptions, getCallForEntriesId());
    echo '</select>' . "\r\n";
  }

  function displayEntryStatusFilterSelector($formName, $currentValue) {
    echo '<select id="acceptanceFilter" name="AcceptanceFilter" onchange="document.' . $formName . '.submit();">' . "\r\n";
    $selectionOptions = array("inclAll" => "All",
                              "inclAccepted" => "Accepted Only",
                              "inclRejected" => "Rejected Only",
                              "inclUndecided" => "Undecided Only",
                              "inclAccUnd" => "Accepted &amp; Undecided",
                              "inclRejUnd" => "Rejected &amp; Undecided",
                              "inclAccRej" => "Accepted &amp; Rejected",
                              "inclNoScore" => "Unscored Only");
    displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
  }
  
  function displayEntryPropertySortSelector($formName, $selectorId, $selectorName, $currentValue) {
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
    displaySelectionOptions($selectionOptions, $currentValue);
    echo '</select>' . "\r\n";
  }  

  // Generates the HTML lines for the options of a form selector. Inputs are
  // $selectionOptions, an array where the array key is the option value and 
  // array value is the option display string; and $currentValue is the option 
  // value of the current selection. 
  function displaySelectionOptions($selectionOptions, $currentValue) {
    foreach($selectionOptions as $optionKey => $optionValue) {
      displaySelectionOption($optionKey, $currentValue, $optionValue);
    }
  }

  // Generates an HTML line for an option of a form selector. Inputs are
  // $stringValue, the option value; $currentValue, the option 
  // value of the current selection; and $displayString, the display string
  // associated with the option value. 
  function displaySelectionOption($stringValue, $currentValue, $displayString) {
    echo '  <option value ="' . $stringValue . '"';
    echo (($stringValue == $currentValue) ? " selected='selected'" : "");
    echo '>' . $displayString . '</option>' . "\r\n";
  }

  // Generates HTML for the work detail. Parameter $workArray must contain workId.
  function displayWorkDetail($workArray, $contributorsArray) {
    $workId = $workArray['workId'];
    echo '<!-- display Entry Information -->' . "\r\n";
    echo '<div class="entryFormSectionHeading">Entry Information<hr class="horizontalSeparatorFull"></div>' . "\r\n";
    echo '<div class="bodyTextOnBlackRowPadded">' . $workArray['title'] . ' (' . $workArray['yearProduced'] 
         . ')<span class="filmInfoSubtitleText" style="margin-left:2em;">run time: </span>' 
         . $workArray['runTime'] . '<br></div>' . "\r\n";
    echo '<div class="bodyTextOnBlackRowPadded"><span class="filmInfoSubtitleText">Submitted as </span>' 
         . $workArray['submissionFormat'] . '<span class="filmInfoSubtitleText">. Originally recorded as </span>' 
         . $workArray['originalFormat'] . '<br></div>' . "\r\n";
    echo "\r\n";
    echo '<!-- display Contributor Information -->' . "\r\n";
    echo '<div class="bodyTextOnBlackRowPadded"><span class="filmInfoSubtitleText">Contributors:<br></span>' . "\r\n";
    $rowsDisplayed = 0;
    foreach ($contributorsArray as $contributor) { 
      if ($contributor['name'] != '') {
        $rowsDisplayed++;
        echo "<span class='filmInfoSubtitleText' style='margin-left:2em;'>" . $contributor['role'] .": </span>" . $contributor['name'] . "<br>";
      }
    }
    if ($rowsDisplayed == 0) echo "No contributors are listed.";
  }

}

?>
