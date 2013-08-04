// ssf.js

  var xmlHttpObject;

  // KEEP in sync with HTMLGen.php
  var quickNoteCuratorId = 832; // TODO Get this from the database or something.
  function listLineId(id) { return 'listLineId-' + id; }
  function listARId(id) { return 'listARId-' + id; }
  function listScoreId(id) { return 'listScoreId-' + id; }
  function listQuickNoteId(id) { return 'listQNId-' + id; }
 
  String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g,""); }

  Array.prototype.inArray = function(v) { var i; for (i=0; i < this.length; i++) { if (this[i] == v) { return true; } } return false; };
  
  function simpleQuote(string) { return "'" + string.trim().replace(/'/g, "\\'"); }

  function doNothingBreakpointOpportunity(textString) {
    var a = textString; // breakpoint opportunity
//    alert("doNothingBreakpointOpportunity(" + textString + ")");
  }
  
  function nextDesId(currentDesId) { // This does the same thing as nextDesignatedId() in submissionsOverviewReport.php
    var parts = currentDesId.split('-');
    var suffixValue = parseInt(parts[1], 10);
    newSuffixValue = get3DigitString(++suffixValue);
    var newWhole = parts[0] + '-' + newSuffixValue;
    return newWhole;
  }

  function reloadCurationEntryWindow() {
    // breakpoint opportunity
    var a = 0;
    var curationFrames = window.parent.frames;
    var curationEntryDoc = curationFrames['curationEntry'].document;
    curationEntryDoc.location.reload();
    a = 1;
  }

  // based on http://www.w3schools.com/js/tryit.asp?filename=tryjs_cookie_username 
  // and http://www.dustindiaz.com/top-ten-javascript/ 
  function setCookie(c_name, value) { 
    var expiredays = 1000;
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" + escape(value) + ((expiredays==null) ? "" : "; expires=" 
//                             + exdate.toUTCString() + ";path=/admin/; domain=sanssoucifest.org"); // using this form, the useragent sents to domain to "6.sanssoucifest.org"
                             + exdate.toUTCString() + ";path=/admin/"); // using this form, the absolute URL is used
  }
  
  function getCookie(c_name) {
  if (document.cookie.length > 0) {
    c_start = document.cookie.indexOf(c_name + "=");
    if (c_start != -1) {
      c_start = c_start + c_name.length + 1;
      c_end = document.cookie.indexOf(";", c_start);
      if (c_end == -1) c_end = document.cookie.length;
      return unescape(document.cookie.substring(c_start, c_end));
      }
    }
    return "";
  }
  
  // Get the saved workId from the currationList currentEntry div.
  function getCachedEntryId() {
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    var cachedEntryId = listDoc.getElementById('currentEntryIdCache').innerHTML;
    return cachedEntryId;
  }
    
  function openCurationEmailTextWindow(commId, personId) {
    var curationEmailTextWindow = window.open('curationEmailText.php?commId=' + commId + '&personId=' + personId, 'curationEmailText');
    curationEmailTextWindow.focus();
    return curationEmailTextWindow;
  }
 
  function openMediaReceiptTextWindow(commId, personId, widgetId) {
    var mediaReceiptEmailTextWindow = 
        window.open('informArtistsOfMediaReceiptText.php?commId=' + commId + '&personId=' + personId + '&widgetId="' + widgetId + '"',
                    'InformArtistsOfMediaReceiptText', 
                    'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,left=50,width=650,height=930',
                    false);
    mediaReceiptEmailTextWindow.focus();
    return mediaReceiptEmailTextWindow;
  }
 
  function selectEntry(workIdValue) {
    //alert(workIdValue);
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    xmlHttpObject.open("GET", "../admin/curationEntryDetail.php?workId=" + workIdValue);
    xmlHttpObject.send(null);
  }
  
  function changeEntryState(valuePairsString) {
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    //alert("GET " + "../admin/curationEntryDetail.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationEntryDetail.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function updateWorksList(queryFilterString, querySortString, havingClauseString) {
    valuePairsString = 'queryFilterString=' + queryFilterString;
    valuePairsString += '&querySortString=' + querySortString;
    valuePairsString += '&havingClauseString=' + havingClauseString;
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayWorksList;
    xmlHttpObject.open("GET", "../bin/database/worksList.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  // TODO Delete acceptFor paramater which was made obsolete by the acceptForCache
  function updateARStatus(workIdValue, accepted, rejected, acceptFor, encodedAcceptanceString) {
    //alert('updateARStatus: ' + workIdValue + ', ' + accepted + ', ' + rejected + ', ' + acceptFor + ', ' + encodedAcceptanceString);
    // Update the AR status for the entry in the list.
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    var arElement = listARId(workIdValue);
    var acceptForCache = document.getElementById('acceptForCache').value;
    var acceptForText = acceptForTextFor(acceptForCache);
    var acceptanceString = (encodedAcceptanceString.replace(/\|/g, "'")).replace('***', acceptForText);
    if (listDoc.getElementById(arElement) != null) { listDoc.getElementById(arElement).innerHTML = acceptanceString; }
    // Update the status of the acceptFor selector.
    document.getElementById('works_acceptFor').disabled = !accepted;
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayARStatus; // displayARStatus will update the entry detail display
    var valuePairsString = "updating=arStatus&workId=" + workIdValue + "&accepted=" + accepted + "&rejected=" + rejected + "&acceptFor=" + acceptForCache;
    //alert("GET ../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }
  
  function acceptForTextFor(acceptFor) { // See php counterpart, HTMLGen::potentialAcceptForDisplayString()
    var acceptForText = '';
    if (acceptFor == 'screening' || acceptFor == 'S') acceptForText = 'S';
    else if (acceptFor == 'installationOnly' || acceptFor == 'I') acceptForText = 'I';
    else if (acceptFor == 'installationMaybe' || acceptFor == 'I?') acceptForText = 'I?';
    else if (acceptFor == 'documentary' || acceptFor == 'D') acceptForText = 'D';
    else if (acceptFor == 'alternateVenue' || acceptFor == 'V') acceptForText = 'V'; // added 7/18/13
    return acceptForText;   
  }

  function updateAcceptForStatus(workIdValue) { 
    //alert('updateAcceptForStatus: ' + workIdValue + ', ' + acceptFor);
    var acceptFor = document.getElementById('works_acceptFor').value;
    if (acceptFor != null && acceptFor != '') document.getElementById('acceptForCache').value = acceptFor;
    // Update the AR status for the entry in the list.
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    var arElement = listARId(workIdValue);
    var acceptanceString = "<span class='acceptedDisplayColor'>&#8657;" + acceptForTextFor(acceptFor) + "</span>";
    listDoc.getElementById(arElement).innerHTML = acceptanceString;
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = confirmItemUpdate;
    var valuePairsString = "updating=acceptForStatus&workId=" + workIdValue + "&acceptFor=" + acceptFor;
    //alert("GET ../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  // Performs part of the function of php urlEncode() by encoding '&', "'", '"', ">", "<".
  function urlEncode(s) {
    // In php $_GET is supposed to go through urldecode() before exploded on '&'. That is, '&amp;' in a URL should
    //   end up as a '&' string, not as a separator. But, as of 6/11/11, this is not working in curationDbUpdate.php 
    // So, we encode '&' as '%26', the corresponding hex character "code points."
    //   See http://www.blooberry.com/indexdot/html/topics/urlencoding.htm and file urlencoding.htm locally. On
    //   the web page, see the embedded javascript for the URL encoding converter.
    // From http://css-tricks.com/snippets/javascript/htmlentities-for-javascript/:
    //   return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    // From http://www.php.net/manual/en/function.urlencode.php
    //  $query_string = 'foo=' . urlencode($foo) . '&bar=' . urlencode($bar);
    //  echo '<a href="mycgi?' . htmlentities($query_string) . '">';          Why does this guy make the call to htmlEntities after the urlEncode?
    // TODO: Replace all the suspicious characters.
//    s1 = s.replace(/'/g, "\'").replace(/&/g, "&amp;"); // Why did this fail to be decoded in curationDbUpdate.php? " instead of '?
//    s1 = s.replace(/'/g, "\'").replace(/&/g, "^^^"); // This worked but it's the wrong approach.
    s1 = s.replace(/'/g, "\'").replace(/&/g, "%26").replace(/</g, '%3C').replace(/>/g, '%3E').replace(/"/g, '%22'); // An alternative correct approach.
//    s1 = s.replace(/'/g, "\'").replace(/&/g, "%26").replace(/</g, '%3C').replace(/>/g, '%3E').replace(/"/g, '\"'); // An alternative correct approach.
    //if (s != s1) { alert('htmlEntities(s) = |' + s1 + '|'); }
    return s1;
  }

  function updateItem(id, table, indexColumn, column, newValue) {
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = confirmItemUpdate;
    var newValueForWire = urlEncode(newValue);
    var valuePairsString = "updating=item&itemId=" + id + "&itemTable=" + table + "&indexColumn=" + indexColumn + "&itemColumn=" + column + "&itemValue=" + newValueForWire;
    //alert("GET ../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function updateScore(workIdValue, curatorId, newScore) {
    // Update the score for the entry in the list.
    curatorMadeAChange(curatorId);
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    var scoreElement = listScoreId(workIdValue);
    listDoc.getElementById(scoreElement).innerHTML = '*' + newScore + '*';
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayScore; // displayScore will update the entry detail display
    var valuePairsString = "updating=score&entry=" + workIdValue + "&curator=" + curatorId + "&score=" + newScore;
    //alert("GET ../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }
  
  function updateCurationNote(workIdValue, designatedId, curatorId, newNote) {
    // Update the note for the entry in the list.
    curatorMadeAChange(curatorId);
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    if (curatorId == quickNoteCuratorId) {
      var noteElementText = listQuickNoteId(workIdValue) + '-text';
      var designatedIdText = designatedId;
      if (designatedId == 0 || designatedId == '00-00' || designatedId == '00-000' || designatedId == '') designatedIdText = 'NO-ID';
      var newNoteText = designatedIdText + '. ' + urlEncode(newNote);
      listDoc.getElementById(noteElementText).innerHTML = newNoteText;
      var noteElementIcon = listQuickNoteId(workIdValue) + '-icon';
      if (newNote == '') { listDoc.getElementById(noteElementIcon).innerHTML = ''; }
      else { listDoc.getElementById(noteElementIcon).innerHTML = 
             '<a href="javascript:void(0)" ' + // TODO This HTML is duplicated in HTMLGen.php
             'onMouseOver="flyoverPopup(\'' + newNoteText + '\', \'#FFFF99\')"' +
             'onMouseOut="killFlyoverPopup()" onClick="window.alert(\'' + newNoteText + '\')">' +
             '<span style="font-weight:bold;color:#D25EC0;">Q</span>' + '</a>';
      }
    }
    // Update the database.
    var newNoteForWire = urlEncode(newNote);
    //alert('ucnC. updateCurationNote(workIdValue=' + workIdValue + '  curatorId=' + curatorId + '  newNote=' + newNoteForWire + ')');
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = setCurationNote;
    var valuePairsString = "updating=curationNote&entry=" + workIdValue + "&curator=" + curatorId + "&note=" + newNoteForWire;
    //alert("ucnD. GET " + "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function acceptEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=1&rejected=0"); }
  function rejectEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=1"); }
  function clearEntryStatus(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=0"); }
  
  function curatorMadeAChange(curator) { 
    document.getElementById('curatorChangeCount').value++; 
  }
  
  function curatorMadeChanges() { 
    //alert("document.getElementById('changeCount').value = |" + document.getElementById('changeCount').value + "|");
    return document.getElementById('curatorChangeCount').value; 
  }

    // Input actionBool as true to add the curatorBeingConsidered or as false to remove the curatorBeingConsidered.
    function setLocallyActiveCurators(globalCuratorsList, curatorBeingConsidered, actionBool) {
      var locallyActiveCuratorsList = getCookie('ssf_locallyActiveCurators');
      //alert('locallyActiveCuratorsList = |' + locallyActiveCuratorsList + '|');
      //alert('setLocallyActiveCurators(' + curatorBeingConsidered + ', ' + actionBool + ')');
      var locallyActiveCuratorArray = locallyActiveCuratorsList.split('+');
      var locallyActiveSetIsEmpty = (locallyActiveCuratorsList == '');
      var globalCuratorsArray = globalCuratorsList.split('+');
      //alert('locallyActiveCuratorArray = ' + locallyActiveCuratorArray);
      //alert('globalCuratorsList = |' + globalCuratorsList + '|  globalCuratorsArray = ' + globalCuratorsArray);
      var curatorIsInLocallyActiveSet = (!locallyActiveSetIsEmpty) && locallyActiveCuratorArray.inArray(curatorBeingConsidered);
      if (actionBool && (!curatorIsInLocallyActiveSet)) { 
        //alert('Add the curatorBeingConsidered to the cookie cache.'); 
        var curatorBeingAdded = curatorBeingConsidered;
        var cookieText = locallyActiveCuratorsList;
        if (cookieText.length != 0) cookieText = cookieText + '+';
        cookieText = cookieText + curatorBeingAdded;
//        alert('Setting cookie ssf_locallyActiveCurators to |' + cookieText + '|');
        setCookie('ssf_locallyActiveCurators', cookieText);
      } else if (!actionBool) { 
        var curatorBeingDeleted = curatorBeingConsidered;
        var newLocallyActiveCuratorsList = '';
        if (curatorIsInLocallyActiveSet) {
//          alert('Remove the curatorBeingDeleted from the cookie cache.'); 
          for (i=0; i<locallyActiveCuratorArray.length; i++) {
            if (locallyActiveCuratorArray[i] != curatorBeingDeleted) { 
              if (newLocallyActiveCuratorsList.length != 0) { newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + '+'; }
              newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + locallyActiveCuratorArray[i];
            }
          }
        } else if (locallyActiveSetIsEmpty && globalCuratorsArray.length > 0) {
//          alert('Create the cookie from scratch, adding all global curators except the curatorBeingDeleted. globalCuratorsArray=|' 
//                            + globalCuratorsArray + '| curatorBeingDeleted=|' + curatorBeingDeleted + '|');
          for (i=0; i<globalCuratorsArray.length; i++) {
//            alert('curator=|' + globalCuratorsArray[i] + '|'); 
            if (globalCuratorsArray[i] != curatorBeingDeleted) { 
              if (newLocallyActiveCuratorsList.length != 0) { newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + '+'; }
              newLocallyActiveCuratorsList = newLocallyActiveCuratorsList + globalCuratorsArray[i];
            }
          }
        }
//        alert('Setting cookie ssf_locallyActiveCurators to |' + newLocallyActiveCuratorsList + '|');
        setCookie('ssf_locallyActiveCurators', newLocallyActiveCuratorsList);
      } // end else if (!actionBool)
    }

  
	// HttpRequest administration
	
	function getXmlHttpObject() {
		var xmlHttp = null;
		try { xmlHttp = new XMLHttpRequest(); } // Firefox, Opera 8.0+, Safari
		catch(e) { try { xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); } // Internet Explorer
		catch (e) { xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); } // Oh, shit: Axtive X
		}
		//console.log(xmlHttp);
		return xmlHttp;
	}
	
	function displayWorksList() {
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
		  //alert(xmlHttpObject.responseText);
			document.getElementById("theWorksList").innerHTML = xmlHttpObject.responseText; } 
	}
	
	// TODO This function does nothing now.
	function displayARStatus() {
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
      // Update the AR status for the entry in the entry detail.
      document.getElementById('entryARSpan').innerHTML = xmlHttpObject.responseText;
    }
	}
	
	function displayScore() {
    if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
      //alert('displayScore() called with result = |' + xmlHttpObject.responseText + '|');
      // Update the AR status for the entry in the entry detail.
      var parts = xmlHttpObject.responseText.split('|');
      //alert(parts);
      document.getElementById('entryScoreSpan').innerHTML = parts[1];
      // Update the AR status for the entry in the list.
      var curationFrames = window.parent.frames;
      var listDoc = curationFrames['curationList'].document;
      var scoreElement = listScoreId(parts[0]);
      listDoc.getElementById(scoreElement).innerHTML = parts[1];
    }
  }
	
	function setCurationNote() {
    // Nothing to do. It was already done in updateCurationNote() above.
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
      //alert('ucnE. setCurationNote() called with result = |' + xmlHttpObject.responseText + '|');
	  } 
	}
	
	function displayEntryDetailData() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
		  //alert(xmlHttpObject.responseText);
			document.getElementById("entryDetail").innerHTML = xmlHttpObject.responseText; 
//		  hide('emptyEntryDetail');
//			show("entryDetail");
	  } 
	}

  function confirmItemUpdate() {
		//alert('A ' + xmlHttpObject.responseText);
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
		  //alert('B ' + xmlHttpObject.responseText);
		}
  }

	// TODO What is this for? Finish it.
	function displayCurationSummary() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
			document.getElementById("xxx").innerHTML = xmlHttpObject.responseText; 
	  } 
	}
  