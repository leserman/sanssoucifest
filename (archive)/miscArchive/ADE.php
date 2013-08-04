<?php

// <div id = "ADESelectionDiv">
// <div id = "ADEPersonDiv">
// <div id = "ADEEntriesDiv">

// Administrative Data Entry
class ADE {


  public static function displaySelectors() {
    echo "<form name='ADESelectorsForm' id='adeSelectorsForm' action='' >";
    echo "<div style='width:300px;float:left;'>";
    echo "<span class='bodyTextOnDarkGray'>&nbsp;Call&nbsp;for:&nbsp;</span>";
    echo '<span class="entryFormField" style="padding:12px 0 6px 0">';
      HTMLGen::displayCallForEntriesSelector('ADESelectors');
    echo '</span>';
    echo "</div>";
    echo "<form>";
  }
  
  public static function displayPerson() {
  }
  
  public static function displayEntries() {
  }
                
}

?>
