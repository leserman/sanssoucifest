// ssf.js

  var xmlHttpObject;
  var curationEntryDetailFile = '../admin/curationEntryDetail.php';

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
    openString = curationEntryDetailFile + "?workId=" + workIdValue; // ../admin/curationEntry.php?workId=641
    alert(openString);
    xmlHttpObject.open("GET", openString);
    xmlHttpObject.send(null);
  }
  
  function changeEntryState(valuePairsString) {
    if (xmlHttpObject == null) xmlHttpObject = getXmlHttpObject();
    xmlHttpObject.onreadystatechange = displayEntryDetailData;
    //alert("GET " + curationEntryDetailFile + "?" + valuePairsString);
    xmlHttpObject.open("GET", curationEntryDetailFile + "?workId=" + valuePairsString);
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
    xmlHttpObject.open("GET", curationEntry + "?" + valuePairsString);
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
  
  function displayEntryDetailData() { 
    if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
      newText = xmlHttpObject.responseText; // text of curationEntry.php
      alert(newText);
      alert(document.URL); // url of curationList.php
      alert(document.getElementById("entryDetail"));
      document.getElementById("entryDetail").innerHTML = newText; 
      hide('emptyEntryDetail');
      show("entryDetail");
    } 
  }

  function displayCurationSummary() { 
    if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
      document.getElementById("xxx").innerHTML = xmlHttpObject.responseText; } 
  }

//  function displayCurationSummary() { 
//    if (xmlHttpObject.readyState==4 || xmlHttpObject.readyState=="complete") { 
//      document.getElementById("xxx").innerHTML = xmlHttpObject.responseText; } 
//  }
  