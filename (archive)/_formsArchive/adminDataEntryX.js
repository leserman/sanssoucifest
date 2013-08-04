/**
 * DHTML date validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
// Declaring valid date character, minimum year and maximum year
var dtCh= "-";
var tmCh= ":";
var minYear=1900;
var maxYear=2100;

function empty(field) {
//alert('field=' + field + '  field.id=' + field.id + '  field.value=' + field.value + '  field.value===null ' + (field.value===null) + '  field.value==="" ' + (field.value===""));
  if (field.value===null || field.value==="") { return true; }
  return false;
}

// validateEmailAddress.js
/**
 * DHTML email validation script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
 */
function badEmailAlert() { alert("Please enter a valid email address."); }

function validEmailAddressNakedX(str) { // original
		var at="@";
		var dot=".";
		var atIndex=str.indexOf(at);
		var stringLength=str.length;
		var dotIndex=str.indexOf(dot);
		if (str.indexOf(at)==-1) { badEmailAlert(); return false; }
		if (str.indexOf(at)==-1 || str.indexOf(at)===0 || str.indexOf(at)==stringLength) { badEmailAlert(); return false; }
		if (str.indexOf(dot)==-1 || str.indexOf(dot)===0 || str.indexOf(dot)==stringLength) { badEmailAlert(); return false; }
    if (str.indexOf(at,(atIndex+1))!=-1) { badEmailAlert(); return false; }
		if (str.substring(atIndex-1,atIndex)==dot || str.substring(atIndex+1,atIndex+2)==dot) { badEmailAlert(); return false; }
		if (str.indexOf(dot,(atIndex+2))==-1) { badEmailAlert(); return false; }
		if (str.indexOf(" ")!=-1) { badEmailAlert(); return false; }
	  return true;
}	

function validEmailAddressNaked(str) {
		var at="@";
		var dot=".";
		var atIndex=str.indexOf(at);
		var stringLength=str.length;
		var dotIndex=str.indexOf(dot);
		if (atIndex==-1 || atIndex===0 || atIndex>=(stringLength-4)) { badEmailAlert(); return false; }
		if (dotIndex==-1 || dotIndex===0 || dotIndex>=(stringLength-2)) { badEmailAlert(); return false; }
    if (str.indexOf(at,(atIndex+1))!=-1) { badEmailAlert(); return false; }
		if (str.substring(atIndex-1,atIndex)==dot || str.substring(atIndex+1,atIndex+2)==dot) { badEmailAlert(); return false; }
		if (str.indexOf(dot,(atIndex+2))==-1) { badEmailAlert(); return false; }
		if (str.indexOf(" ")!=-1) { badEmailAlert(); return false; }
	  return true;
}	

function isInteger(s) { 
	var i;
    for (i = 0; i < s.length; i++) {    
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) { return false; }
     }
    // All characters are numbers.
    return true;
 }

function stripCharsInBag(s, bag) { 
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++) {    
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) { returnString += c; }
     }
    return returnString;
 }

function daysInFebruary(year) { 
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 === 0) && ((!(year % 100 === 0)) || (year % 400 === 0))) ? 29 : 28 );
 }

function DaysArray(n) { 
	for (var i = 1; i <= n; i++) { 
		this[i] = 31;
		if (i==4 || i==6 || i==9 || i==11) { this[i] = 30; }
		if (i==2) { this[i] = 29; }
    } 
   return this;
 }

function isDate(dtStr){ 
  if (dtStr == '0000-00-00') return true;
	var daysInMonth = DaysArray(12);
	var pos1 = dtStr.indexOf(dtCh);
	var pos2 = dtStr.indexOf(dtCh, pos1+1);
	//var strMonth = dtStr.substring(0, pos1);
	//var strDay = dtStr.substring(pos1+1 ,pos2);
	//var strYear = dtStr.substring(pos2+1);
	var strYear = dtStr.substring(0, pos1);
	var strMonth = dtStr.substring(pos1+1 ,pos2);
	var strDay = dtStr.substring(pos2+1);
	var strYr = strYear;
	if (strDay.charAt(0) == "0" && strDay.length > 1) { strDay = strDay.substring(1); }
	if (strMonth.charAt(0) == "0" && strMonth.length > 1) { strMonth = strMonth.substring(1); }
	for (var i=1; i<=3; i++) { 
		if (strYr.charAt(0) == "0" && strYr.length > 1) { strYr = strYr.substring(1); }
	}
	var month=parseInt(strMonth, 10);
	var day=parseInt(strDay, 10);
	var year=parseInt(strYr, 10);
	if ((pos1 == -1) || (pos2 == -1)) { 
		alert("The date format must be : yyyy-mm-dd");
		return false;
	}
	if ((strMonth.length < 1) || (month < 1) || (month > 12)) { 
		alert("Please enter a valid month");
		return false;
	}
	if ((strDay.length < 1) || (day < 1) || (day > 31) || ((month == 2) && (day > daysInFebruary(year))) || (day > daysInMonth[month])) { 
		alert("Please enter a valid day");
		return false;
	}
	if ((strYear.length != 4) || (year === 0) || (year < minYear) || (year > maxYear)) { 
		alert("Please enter a valid 4 digit year between " + minYear + " and " + maxYear);
		return false;
	}
	if ((dtStr.indexOf(dtCh, pos2+1) != -1) || (isInteger(stripCharsInBag(dtStr, dtCh)) === false)) { 
		alert("Please enter a valid date");
		return false;
	}
return true;
}

function isTime(timeStr){ 
	var pos1 = timeStr.indexOf(tmCh);
	var pos2 = timeStr.indexOf(tmCh, pos1+1);
	var strHours = timeStr.substring(0, pos1);
	var strMinutes = timeStr.substring(pos1+1 ,pos2);
	var strSeconds = timeStr.substring(pos2+1);
	var strHr = strHours;
	if (strSeconds.charAt(0) == "0" && strSeconds.length > 1) { strSeconds = strSeconds.substring(1); }
	if (strMinutes.charAt(0) == "0" && strMinutes.length > 1) { strMinutes = strMinutes.substring(1); }
	for (var i=1; i<=3; i++) { 
		if (strHr.charAt(0) == "0" && strHr.length > 1) { strHr = strHr.substring(1); }
	}
	var minutes=parseInt(strMinutes, 10);
	var seconds=parseInt(strSeconds, 10);
	var hours=parseInt(strHr, 10);
	if ((pos1 == -1) || (pos2 == -1)) { 
		alert("The time format must be : hh:mm:ss");
		return false;
	}
	if ((strHours.length < 1) || (hours < 0) || (hours > 23)) { 
		alert("Please enter a valid number of hours");
		return false;
	}
	if ((strMinutes.length < 1) || (minutes < 0) || (minutes > 59)) { 
		alert("Please enter a valid number of minutes");
		return false;
	}
	if ((strSeconds.length < 1) || (seconds < 0) || (seconds > 59)) { 
		alert("Please enter a valid number of seconds");
		return false;
	}
	if ((timeStr.indexOf(tmCh, pos2+1) != -1) || (isInteger(stripCharsInBag(timeStr, tmCh)) === false)) { 
		alert("Please enter a valid date");
		return false;
	}
return true;
}

function ValidDate(dateInQuestionControl) { 
//alert('dateInQuestionControl = ' + dateInQuestionControl.value);
	if ((!empty(dateInQuestionControl)) && (isDate(dateInQuestionControl.value) === false)) { 
		dateInQuestionControl.focus();
		return false;
  }
  return true;
}

function ValidTime(timeInQuestionControl) { 
//alert('dateInQuestionControl = ' + dateInQuestionControl.value);
	if (isTime(timeInQuestionControl.value) === false) { 
		timeInQuestionControl.focus();
		return false;
  }
  return true;
}

function ValidEmail(emailInQuestionControl) { 
//alert('dateInQuestionControl = ' + dateInQuestionControl.value);
	if (validEmailAddress(emailInQuestionControl.value) === false) { 
		emailInQuestionControl.focus();
		return false;
  }
  return true;
}

function validIntegerValue(integerInQuestionControl) {
  var strValue = integerInQuestionControl.value;
	if (!empty(integerInQuestionControl) && !isInteger(strValue)) { 
		integerInQuestionControl.focus();
		alert('Please enter a valid whole number.');
		return false;
  }
  return true;
}

function validSingleEntry(setControlInQuestion, controlName) {
  var count = 0;
  var iteration = 0;
  //alert('length = ' + setControlInQuestion.length + '  <br>  length-1 = ' + (setControlInQuestion.length-1));
  for (var i = 0; i < setControlInQuestion.length; i++) {
    //alert(i + '.  ' + setControlInQuestion[i] + ': ' + setControlInQuestion[i].value + '  ' + setControlInQuestion[i].checked);
    if (setControlInQuestion[i].checked) { count++; }
  }
  //alert('setControlInQuestion checked count = ' + count);
  if (count > 1) {
		setControlInQuestion[0].focus();
    alert('Please select no more that one checkbox for ' + controlName + '.');
  }
  return (count <= 1);
}

// Allows comma separated email addresses
function validEmailAddress(emailInQuestionControl) {
  var strValue = emailInQuestionControl.value;  // TODO FIX BUG HERE
  if (!empty(strValue)) {                       // empty should operate on emailInQuestionControl
    var tokens = strValue.split(',');
    for (var i in tokens) {
      //alert(tokens[i]);
      if (!validEmailAddressNaked(tokens[i].replace(' ',''))) { 
        emailInQuestionControl.focus();
        return false;
      }
    }
  }
  return true;
}

function validAdminPersonCreation(personId) {
  return validAdminPersonEntry();
}

function validAdminPersonEntry() { 
//alert('validAdminPersonEntry');
//alert(document.getElementsByName('people_email').length);
//  if (!validEmailAddress(document.getElementById('people_email'))) { return false; }
  if (!validEmailAddress(getUniqueElement('people_email'))) { return false; }
  //if (ValidDate(document.getElementById('works_datePaid'))) { return false; }
  return true;
}

function validAdminWorkEntry() { 
//alert('validAdminWorkEntry');
  //if (empty(document.getElementById('works_designatedId'))) { alert('Please enter a valid Designated Id.'); return false; }
/*
  if (!ValidTime(document.getElementById('works_runTime'))) { return false; }
  if (!ValidDate(document.getElementById('works_dateMediaReceived'))) { return false; }
  if (!ValidDate(document.getElementById('works_datePaid'))) { return false; }
  if (!validIntegerValue(document.getElementById('works_amtPaid'))) { return false; }
*/
  if (!ValidTime(getUniqueElement('works_runTime'))) { return false; }
  if (!ValidDate(getUniqueElement('works_dateMediaReceived'))) { return false; }
  if (!ValidDate(getUniqueElement('works_datePaid'))) { return false; }
  if (!validIntegerValue(getUniqueElement('works_amtPaid'))) { return false; }
  if (!validSingleEntry(document.getElementsByName('works_howPaid[]'), 'How Paid')) { return false; }
  if (!validSingleEntry(document.getElementsByName('works_webSitePertainsTo[]'), 'Web site pertains to')) { return false; }
//  alert('validAdminWorkEntry SUCCESS');
  return true;
}
