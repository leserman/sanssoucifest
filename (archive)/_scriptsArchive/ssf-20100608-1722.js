// ssf.js

  var xmlHttpObject;

  function openCurationEmailTextWindow(entryId) {
    var curationAccRejEmailText = 
        window.open('curationAccRejEmailText.php?entryId=' + entryId, 'CurationAccRejEmailText', 
                    'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,left=50,width=650,height=930',
                    false);
    curationAccRejEmailText.focus();
    return curationAccRejEmailText;
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

  function updateARStatus(workIdValue, accepted, rejected, encodedAcceptanceString) {
    // Update the AR status for the entry in the list.
    listDoc = window.frames['curationList'].document;
    var arElement = 'listLineId-' + workIdValue + '.ar'; // TODO this should call <?php self::listLineId($workId) ?>
    var acceptanceString = encodedAcceptanceString.replace("^", "'")
    var acceptanceString = listDoc.getElementById(arElement).innerHTML = acceptanceString;
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayARStatus; // displayARStatus will update the entry detail display
    var valuePairsString = "workId=" + workIdValue + "&accepted=" + accepted + "&rejected=" + rejected;
    alert("GET " + "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);

  }

  function updateARStatus(workIdValue, accepted, rejected, encodedAcceptanceString) {
    // Update the AR status for the entry in the list.
    var curationFrames = window.parent.frames;
    var listDoc = curationFrames['curationList'].document;
    var arElement = 'listLineId-' + workIdValue; // + '.ar'; // TODO this should call <?php self::listLineId($workId) ?>
    alert('encodedAcceptanceString: ' + encodedAcceptanceString);
    var acceptanceString = encodedAcceptanceString.replace('"', "'");
    alert("acceptanceString: " + acceptanceString);
    listDoc.getElementById(arElement).innerHTML = acceptanceString;
    // Update the database.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayARStatus; // displayARStatus will update the entry detail display
    var valuePairsString = "workId=" + workIdValue + "&accepted=" + accepted + "&rejected=" + rejected;
    alert("GET " + "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.open("GET", "../admin/curationDbUpdate.php?" + valuePairsString);
    xmlHttpObject.send(null);

  }

  function acceptEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=1&rejected=0"); }
  function rejectEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=1"); }
  function clearEntryStatus(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=0"); }
  
  function saveCuratorDataJS(workIdValue) { // TODO Remove this hard-coded hack.
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    valuePairsString = "updateCurationData=YES";
    valuePairsString += "&workId=" + workIdValue;
    valuePairsString += "&score1=" + document.getElementById('score1').value;
    valuePairsString += "&notes1=" + document.getElementById('notes1').value;
    valuePairsString += "&score5=" + document.getElementById('score5').value;
    valuePairsString += "&notes5=" + document.getElementById('notes5').value;
    valuePairsString += "&score38=" + document.getElementById('score38').value;
    valuePairsString += "&notes38=" + document.getElementById('notes38').value;
    alert("valuePairsString=|" + valuePairsString + "|");
    xmlHttpObject.open("GET", "../admin/curationEntryDetail.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function curatorMadeAChange(curator) { 
    document.getElementById('curatorChangeCount').value++; 
  }
  
  function curatorMadeChanges() { 
    //alert("document.getElementById('changeCount').value = |" + document.getElementById('changeCount').value + "|");
    return document.getElementById('curatorChangeCount').value; 
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
    // Update the AR status for the entry in the entry detail.
    document.getElementById('entryARSpan').innerHTML = xmlHttpObject.responseText;
	}
	
	function displayEntryDetailData() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
		  //alert(xmlHttpObject.responseText);
			document.getElementById("entryDetail").innerHTML = xmlHttpObject.responseText; 
		  hide('emptyEntryDetail');
			show("entryDetail");
	  } 
	}

	function displayCurationSummary() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
			document.getElementById("xxx").innerHTML = xmlHttpObject.responseText; } 
	}

//	function displayCurationSummary() { 
//		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
//			document.getElementById("xxx").innerHTML = xmlHttpObject.responseText; } 
//	}
  