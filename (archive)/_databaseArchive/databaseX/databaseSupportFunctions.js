// databaseSupportFunctions.js

  var xmlHttpObject;

  function openCurationEmailTextWindow(entryId) {
    var curationAccRejEmailText = 
        window.open('curationAccRejEmailText.php?entryId=' + entryId, 'CurationAccRejEmailText', 
                    'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,left=50,width=650,height=930',
                    false);
    curationAccRejEmailText.focus();
    return curationAccRejEmailText;
  }
 
  function selectEntry(workIdValue) {
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject2();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
//    xmlHttpObject.open("POST", "entryDetail.php");
//    xmlHttpObject.send("workId=" + workIdValue);
    xmlHttpObject.open("GET", "entryDetail.php?workId=" + workIdValue);
    xmlHttpObject.send(null);
  }
  
  function changeEntryState(valuePairsString) {
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject2();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    xmlHttpObject.open("GET", "entryDetail.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function acceptEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=1&rejected=0"); }
  function rejectEntry(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=1"); }
  function clearEntryStatus(workIdValue) { changeEntryState("workId=" + workIdValue + "&accepted=0&rejected=0"); }
  
  function saveCuratorDataJS(workIdValue) {
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject2();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    valuePairsString = "UpdateCurationData=YES";
    valuePairsString += "&workId=" + workIdValue;
    valuePairsString += "&scoreDL=" + document.getElementById('scoreDL').value;
    valuePairsString += "&notesDL=" + document.getElementById('notesDL').value;
    valuePairsString += "&scoreAB=" + document.getElementById('scoreAB').value;
    valuePairsString += "&notesAB=" + document.getElementById('notesAB').value;
    valuePairsString += "&scoreME=" + document.getElementById('scoreME').value;
    valuePairsString += "&notesME=" + document.getElementById('notesME').value;
    alert("valuePairsString=|" + valuePairsString + "|");
    xmlHttpObject.open("GET", "entryDetail.php?" + valuePairsString);
    xmlHttpObject.send(null);
  }

  function curatorMadeAChange(curator) { 
    document.getElementById('CuratorChangeCount').value++; 
  }
  
  function curatorMadeChanges() { 
    //alert("document.getElementById('changeCount').value = |" + document.getElementById('changeCount').value + "|");
    return document.getElementById('CuratorChangeCount').value; 
  }


  
	// HttpRequest administration
	
	function getXmlHttpObject2() {
		var xmlHttp = null;
		try { xmlHttp = new XMLHttpRequest(); } // Firefox, Opera 8.0+, Safari
		catch(e) { try { xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); } // Internet Explorer
		catch (e) { xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); } // Oh, shit: Axtive X
		}
		//console.log(xmlHttp);
		return xmlHttp;
	}
	
	function displayEntryDetailData() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
			document.getElementById("entryDetail").innerHTML = xmlHttpObject.responseText; } 
	}

	function displayCurationSummary() { 
		if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
			document.getElementById("entryDetail").innerHTML = xmlHttpObject.responseText; } 
	}

  