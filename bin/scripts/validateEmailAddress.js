// validateEmailAddress.js
/**
 * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */

function badEmailAlert() { alert("Please enter a valid email address."); }

function validEmailAddress(str) {
		var at="@";
		var dot=".";
		var atIndex=str.indexOf(at);
		var stringLength=str.length;
		var dotIndex=str.indexOf(dot);
		if (str.indexOf(at)==-1) { badEmailAlert(); return false; }
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==stringLength) { badEmailAlert(); return false; }
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==stringLength) { badEmailAlert(); return false; }
    if (str.indexOf(at,(atIndex+1))!=-1) { badEmailAlert(); return false; }
		if (str.substring(atIndex-1,atIndex)==dot || str.substring(atIndex+1,atIndex+2)==dot) { badEmailAlert(); return false; }
		if (str.indexOf(dot,(atIndex+2))==-1) { badEmailAlert(); return false; }
		if (str.indexOf(" ")!=-1) { badEmailAlert(); return false; }
	  return true;
}	