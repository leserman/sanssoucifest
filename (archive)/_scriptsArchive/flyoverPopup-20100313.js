	// flyoverPopup.js
	
	// Original version from http://www.dynamicdrive.com/dynamicindex5/popinfo2.htm
	// Pop up information box II (Mike McGrath (mike_mcgrath@lineone.net, http://website.lineone.net/~mike_mcgrath))
	// Permission granted to Dynamicdrive.com to include script in archive
	// For this and 100's more DHTML scripts, visit http://dynamicdrive.com
	
	var xPopupOffset = -180;    // modify these values to ...
	var yPopupOffset = 20;     // change the popup position.
	var yMousePosition = 0;
	var offScreen = -1000;
	var popupBox, yPopupOrigin=offScreen;
	var ns4 = document.layers;
	var ns6 = document.getElementById&&!document.all;
	var ie4 = document.all;
	
	function flyoverPopup(msg, bak) {
		var content="<div style='border:2px solid black'><div class='medSmallBodyTextLeaded' " +
		             "style='color:#FFFF99;background-color:#333333;max-width:320;border:4px #990000 ridge;" +
		             "margin:0px 0px;padding:8px 8px;text-align:left;'>" + msg + "</div></div>";
		yMousePosition = yPopupOffset;
		if (ns4) { popupBox.document.write(content); popupBox.document.close(); popupBox.visibility="visible"; }
		if (ns6) { document.getElementById("dek").innerHTML=content; popupBox.display=''; }
		if (ie4) { document.all("dek").innerHTML=content; popupBox.display=''; }
	}
	
	function getMouse(e) {
		var x = (ns4 || ns6) ? e.pageX : event.x + document.body.scrollLeft;
		popupBox.left = x + xPopupOffset;
		var y = (ns4 || ns6) ?e.pageY : event.y + document.body.scrollTop;
		popupBox.top = y + yMousePosition;
	}
	
	function killFlyoverPopup(){
		yMousePosition = offScreen;
		if (ns4) { popupBox.visibility="hidden"; }
		else if (ns6 || ie4) { popupBox.display="none"; }
	}
	
	function initFlyoverPopup() {
		if (ns4) { popupBox = document.dek; }
		else if (ns6) { popupBox = document.getElementById("dek").style; }
		else if (ie4) { popupBox = document.all.dek.style; xPopupOffset = 20; }
		if (ns4) { document.captureEvents(Event.MOUSEMOVE); }
		else {
			popupBox.visibility = "visible";
			popupBox.display = "none";
		}
		document.onmousemove = getMouse;
	}
