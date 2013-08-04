<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META http-equiv="Pragma" content="no-cache">
  <META http-equiv="Expires" content="-1"> 
  <META NAME="description" CONTENT="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <META NAME="keywords" CONTENT="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring">
  <title>SSF - Active Curators</title>
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <script src="../bin/scripts/ssf.js" type="text/javascript"></script>
  <script src="../bin/scripts/ssfDisplay.js" type="text/javascript"></script>
  <script type="text/javascript">
    Array.prototype.inArray = function(v) { var i; for (i=0; i < this.length; i++) { if (this[i] == v) { return true; } } return false; };
    
    // Input actionBool as true to add the curatorBeingConsidered or as false to remove the curatorBeingConsidered.
    function setLocallyActiveCurators(globalCuratorsList, curatorBeingConsidered, actionBool) {
      var locallyActiveCuratorsList = getCookie('ssf_locallyActiveCurators');
      alert('locallyActiveCuratorsList = |' + locallyActiveCuratorsList + '|');
      //alert('setLocallyActiveCurators(' + curatorBeingConsidered + ', ' + actionBool + ')');
      //var currLocallActive = getCookie('ssf_locallyActiveCurators');
      var locallyActiveCuratorArray = locallyActiveCuratorsList.split('+');
      var locallyActiveSetIsEmpty = (locallyActiveCuratorsList == '');
      var globalCuratorsArray = globalCuratorsList.split('+');
      alert('locallyActiveCuratorArray = ' + locallyActiveCuratorArray);
      alert('globalCuratorsList = |' + globalCuratorsList + '|  globalCuratorsArray = ' + globalCuratorsArray);
      var curatorIsInLocallyActiveSet = locallyActiveCuratorArray.inArray(curatorBeingConsidered);
      if (actionBool && (!curatorIsInLocallyActiveSet)) { 
        alert('Add the curatorBeingConsidered to the cookie cache.'); 
        var curatorBeingAdded = curatorBeingConsidered;
        var cookieText = locallyActiveCuratorsList;
        if (cookieText.length != 0) cookieText = cookieText + '+';
        cookieText = cookieText + curatorBeingAdded;
        setCookie('ssf_locallyActiveCurators', cookieText);
      }
      else if (!actionBool) { 
        var curatorBeingDeleted = curatorBeingConsidered;
        var newLocallyActiveCuratorsList = '';
        if (curatorIsInLocallyActiveSet) {
          alert('Remove the curatorBeingDeleted from the cookie cache.'); 
          for (i=0; i<locallyActiveCuratorArray.length; i++) {
            if (locallyActiveCuratorArray[i] != curatorBeingDeleted) { 
              if (newLocallyActiveCuratorsList.length != 0) { newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + '+'; }
              newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + locallyActiveCuratorArray[i];
            }
          }
        } else if (locallyActiveSetIsEmpty && globalCuratorsArray.length > 0) {
          alert('Create the cookie from scratch, adding all global curators except the curatorBeingDeleted. globalCuratorsArray=|' 
                            + globalCuratorsArray + '| curatorBeingDeleted=|' + curatorBeingDeleted + '|');
          for (i=0; i<globalCuratorsArray.length; i++) {
            alert('curator=|' + globalCuratorsArray[i] + '|'); 
            if (globalCuratorsArray[i] != curatorBeingDeleted) { 
              if (newLocallyActiveCuratorsList.length != 0) { newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + '+'; }
              newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + globalCuratorsArray[i];
            }
          }
        }
        setCookie('ssf_locallyActiveCurators', newLocallyActiveCuratorsList);
      }
    }
    
  </script>
</head>
	<body>
//< setCookie('ssf_locallyActiveCurators', '1 832', time()+3600*24*365*2, '/admin/'); ?>

<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  // The table.column is assumed to be a SET. $currentValue may be a comma separated string or an array.
  // Based on HTMLGen::addCheckBoxWidgetRow()
  function addCuratorCheckBoxWidgetRow($callForEntriesId, $title, $cols) {
    $curatorQuery = 'SELECT curator, isActive, nickName from curators join people on curator = personId WHERE callForEntries = ' . $callForEntriesId;
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($curatorQuery);
    $locallyActiveCuratorsText = (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : '';
    $locallyActiveCuratorsArray = array();
    if ($locallyActiveCuratorsText != '') { 
      $locallyActiveCuratorsArray = explode('+', $locallyActiveCuratorsText);
    }
    $possibleValues = array();
    $globalCuratorsList = '';
    foreach ($curatorRows as $curatorRow) { 
      $possibleValues[] = $curatorRow['nickName']; 
      if ($globalCuratorsList != '') { $globalCuratorsList .= '+'; }
      $globalCuratorsList .= $curatorRow['curator'];
    }
    $itemCount = count($possibleValues);
    $itemsPerCol = (int) ceil($itemCount/$cols);
    $rowIndex = 0;
    $itemsDisplayed = 0;
    echo "<!-- addCuratorCheckBoxWidgetRow: " . $title . " call " . $callForEntriesId . ", in " . $cols . " columns. -->\r\n";
    echo "      <div class='formRowContainer' style='padding:12px 0;'>\r\n";
    echo "        <div class='rowTitleText' style='text-align:left;padding-top:2px;width:60px;'>" . $title . ":</div> \r\n";
    echo "        <div class='floatLeft etchedIn'>\r\n";
    // begin a column div
    echo "        <div style='float:left;'>\r\n";
    SSFDebug::globaldebugger()->belch('possibleValues', $possibleValues, -1);
    foreach ($curatorRows as $curatorRow) {  
      $possVal = $curatorRow['nickName'];
      $disable = ($curatorRow['isActive'] != 1);
      $rowIndex++;
      $itemsDisplayed++;
//      $inSet = in_array($curatorRow['curator'], $_COOKIE['ssf_locallyActiveCurators']);
//      $inSet = in_array($curatorRow['curator'], $locallyActiveCuratorsArray);
      $inSet = SSFQuery::curatorIsActive($curatorRow['curator'], $callForEntriesId);
      SSFDebug::globaldebugger()->becho('inSet', ($inSet) ? 'true' : 'false', -1);
//      foreach ($currentValue as $currKey => $currVal) { if ($currVal == $possVal) { $inSet = true; break; } }
      $genId = HTMLGen::genId($possVal);
      echo "          <div>\r\n";
      echo "            <div style='float:left;'>\r\n";
      echo "              <input type='checkbox' name='" . "curatorCheckBox" . "[]" . "' id='" . $genId;
      echo "' value='" . $possVal . "' onchange='javascript:setLocallyActiveCurators(\"" . $globalCuratorsList . '", ' . $curatorRow['curator'] . ", this.checked)'" . (($disable) ? ' disabled' : '');
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
    echo "<!-- END addCuratorCheckBoxWidgetRow -->\r\n";
  }
?>
	<div class="bodyTextOnBlack" style="margin:40px 80px;font-size:16px;line-height:22px;">
<?php 
    $callForEntriesId = SSFRunTimeValues::getInitialCallForEntriesId();
    $callForEntriesName = SSFRuntimeValues::getCallNameFor($callForEntriesId);
    $selectString = 'SELECT curator, nickName, isActive FROM curators JOIN people on curator=personId WHERE callForEntries=' . $callForEntriesId . ' ORDER BY nickName';
    $curatorRows = SSFDB::getDB()->getArrayFromQuery($selectString);
    SSFDebug::globaldebugger()->belch('curatorRows', $curatorRows, 1);
    $curatorNames = '';
    $curatorNameArray = array();
    foreach ($curatorRows as $curatorRow) {
      $curatorNames .= (($curatorNames == '') ? '' : ', ') . $curatorRow['nickName'];
      $curatorNameArray[] = $curatorRow['nickName'];
    }
    $locallyActiveCurators = (isset($_COOKIE['ssf_locallyActiveCurators'])) ? $_COOKIE['ssf_locallyActiveCurators'] : "NOT SET";
    
  SSFDebug::globaldebugger()->becho('ssf_locallyActiveCurators', $locallyActiveCurators . '<br>', 1);

  echo 'Curators for call "' . $callForEntriesName . '" (' . $callForEntriesId . ') are ' . $curatorNames . '.<br>';
//  echo 'Globally Active Curators are ' . '<br>'; 
//  echo 'Globally Active Curators are ' . '<br>'; 
//  echo 'Locally Active Curators (by id) are ' . $locallyActiveCurators . '<br>'; 
//  echo 'Locally Active Curators (by name) are ' . $curatorNames . '<br><br>'; 

  echo '<div>';
  $title = 'Curators for call "' . $callForEntriesName . '" (' . $callForEntriesId . ')'; 
  $title = 'Curators';
//  HTMLGen::addCheckBoxWidgetRow($title, 'curators', 'curator', $curatorNameArray, 4);
  addCuratorCheckBoxWidgetRow($callForEntriesId, $title, 4);
  echo '</div>';
  SSFDebug::globaldebugger()->belch('$_COOKIE', $_COOKIE, 1); 
?>
</div>
<!-- <script type='text/javascript'>document.write(getCookie('ssf_locallyActiveCurators'));</script> -->
	</body>
</html>
