  var missingValueString = 'aljf5732kln8adfru';
  var usingAlertsForDebugging = false;
  
// Begin functions moved here from EntryForm 4/6/15 ------------------------------------------------------------------------------------------

  function okToCreateNewWork() { return (document.getElementById('okToCreateNewWork').value == 1); }

  function disableSelectors() { 
    disable("workSelector"); 
    disable("createNewWork");
    disable("editPerson");
    disable("editWork");
  }

  function enableSelectors() { 
    enable("workSelector"); 
    if (okToCreateNewWork()) { enable("createNewWork"); } 
    enable("editPerson");
    enable("editWork");
  }

  function setHiddenBoolCacheWidget(checkboxId, hiddenCacheId) {
    isChecked = document.getElementById(checkboxId).checked;
    hiddenCacheWidget = document.getElementById(hiddenCacheId);
    //alert('isChecked=|' + isChecked + '|  hiddenCacheWidget=|' + hiddenCacheWidget +
    //      '|  hiddenCacheWidget.value=|' + hiddenCacheWidget.value + '|  hiddenCacheWidget.checked=|' + hiddenCacheWidget.checked + '|');
    if (isChecked) { hiddenCacheWidget.value = '1'; }
    else { hiddenCacheWidget.value ='0'; }
  }

  function submitItsMe() {
//    alert('submitItsMe() value 1: ' + document.getElementById("itsMeSubmit").value);
    document.getElementById("itsMeSubmit").value="ItsMe";
//    alert('submitItsMe() value 2: ' + document.getElementById("itsMeSubmit").value);
    var element = document.getElementById("ssfEntryForm");
    element.submit();
  }
  
  function resumeLogin() {
    document.getElementById('userLoginUnderway').value = 1;
  }

  // NOTE: For each hidden input is a corresponding value for hiddenInputSavingKey
  //  hidden input      hiddenInputSavingKey
  //  ++++++++++++      ++++++++++++++++++++
  //  saveNewPerson     savingNewPerson
  //  savePerson        savingPerson
  //  saveNewWork       savingNewWork
  //  saveWork          savingWork
  //  n/a               signingOff

  function cancelSubmit() { // TODO Desk check this function
//    alert('cancelSubmit');
    document.getElementById('hiddenInputSavingKey').value = 'Cancel';
    if (document.getElementById('saveNewPerson') !== null) { document.getElementById('saveNewPerson').value = ''; resumeLogin(); }
    if (document.getElementById('savePerson') !== null) { document.getElementById('savePerson').value = ''; }
    if (document.getElementById('saveNewWork') !== null) { document.getElementById('saveNewWork').value = ''; }
    if (document.getElementById('saveWork') !== null) { document.getElementById('saveWork').value = ''; }
    document.ssfEntryForm.submit();
  }

  function preSubmitValidation() {
    var usingAlertsForDebugging = false;
    var hiddenInputSavingKey = document.getElementById('hiddenInputSavingKey').value;
    if (document.getElementById(hiddenInputSavingKey) !== null) { document.getElementById(hiddenInputSavingKey).value = hiddenInputSavingKey; }
    if (usingAlertsForDebugging) { alert('hiddenInputSavingKey=' + hiddenInputSavingKey); }
    switch (hiddenInputSavingKey)
    {
      case '': valid = true; break;
      case 'signingOff': valid = true; break;
      case 'Cancel': valid = true; break;
      case 'savingNewPerson': valid = (personNameIsUnique()) ? validPersonCreation() : false; break;
      case 'savingPerson': valid = validPersonEntry(); break;
      case 'savingNewWork': valid = computeRunTimeAndValidateWorkEntry(); break;
      case 'savingWork': valid = computeRunTimeAndValidateWorkEntry();  break;
    }
    if (usingAlertsForDebugging) { alert('hiddenInputSavingKey is' + ((valid) ? '' : ' not') + ' valid'); } 
    return valid; 
  }
  
// END functions moved here from EntryForm 4/6/15 ---------------------------------------------------------------------------------------------------------

  // from http://stackoverflow.com/questions/469357/html-text-input-allow-only-numeric-input
  function digitsOnly1(evt) { // UNUSED as of 3/17/2011
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]/;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      theEvent.preventDefault();
    }
  }
  
  // adapted from http://www.w3schools.com/jsref/event_onkeypress.asp
  function digitsOnly2(e) {
    var keynum, keychar, numcheck;
    if(window.event) { keynum = e.keyCode; } // IE
    else if(e.which) { keynum = e.which; }   // Netscape/Firefox/Opera
    keychar = String.fromCharCode(keynum)
    numcheck = /[a-zA-Z\-+/\*=\(\)@#$%\^&,\.<>/?]/;
    OK = !numcheck.test(keychar);
    return OK;
  }

  // submitEnter is called when the user presses the Return or Enter key as set up in HTMLGen.
  // Based on http://www.htmlcodetutorial.com/forms/index_famsupp_157.html
  function submitEnter(thisField, e) {
    if ((thisField.form.name != "ssfEntryForm") && (thisField.form.name != "adeSelectorsForm")) { return true; } // escape if this in not the user Entry Form
    var keycode = '';
    if (window.event) { keycode = window.event.keyCode; }
    else if (e) { keycode = e.which; }
    if (keycode == 13) {
      return false; // ****** Shortcut this so that nothing happens when the user presses Return or Enter
//      if (preSubmitValidation()) { thisField.form.submit(); }                                       // 2/10/14 - It appears that this line is unreachable.
      if (thisField.form.name == "ssfEntryForm" && preSubmitValidation()) { thisField.form.submit(); } // 2/10/14 - It appears that this line is unreachable. Add test on form name.
      return false;
    } else { return true; }
  }

  function userMadeAChange(entity) { 
    document.getElementById('changeCount').value++; 
    if (entity === 0)  { document.getElementById('personChangeCount').value++; } 
    if (entity == 1)  { document.getElementById('entryChangeCount').value++; }
  }

  function userMadeChanges() { 
    //alert("document.getElementById('changeCount').value = |" + document.getElementById('changeCount').value + "|");
    return document.getElementById('changeCount').value; 
  }
  function userMadeSubmitterChanges() { return document.getElementById('submitterChangeCount').value; }
  function userMadeEntryChanges() { return document.getElementById('entryChangeCount').value; }

  // entity = -1 for all, 0 for submitter, & 1 for entry
  function resetChanges(entity) { 
    if (entity == -1) {
      document.getElementById('changeCount').value = 0;
      document.getElementById('submitterChangeCount').value = 0;
      document.getElementById('entryChangeCount').value = 0;
    } 
    else if (entity === 0) { document.getElementById('submitterChangeCount').value = 0; }
    else if (entity == 1) { document.getElementById('entryChangeCount').value = 0; }
  }

function empty(field) {
//alert('field=' + field + '  field.id=' + field.id + '  field.value=' + field.value + '  field.value===null ' + (field.value===null) + '  field.value==="" ' + (field.value===""));
  if (field === null || field === false || field.value === null || field.value == "") { return true; }
  return false;
}

function badEmailAlert() { alert("Please enter a valid email address."); }

// Based on DHTML email validation script, validateEmailAddress.js. Courtesy of http://www.smartwebby.com/dhtml/
function validEmailAddressNaked(str) {
  //alert('validEmailAddressNaked(' + str + ')');
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

// Simulates PHP's date function. Taken from http://jacwright.com/projects/javascript/date_format.
Date.prototype.format = function(format) {
	var returnStr = '';
	var replace = Date.replaceChars;
	for (var i = 0; i < format.length; i++) {
		var curChar = format.charAt(i);
		if (i - 1 >= 0 && format.charAt(i - 1) == "\\") { 
			returnStr += curChar;
		}
		else if (replace[curChar]) {
			returnStr += replace[curChar].call(this);
		} else if (curChar != "\\"){
			returnStr += curChar;
		}
	}
	return returnStr;
};
 
Date.replaceChars = {
	shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
	longMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
	shortDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
	longDays: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

	// Day
	d: function() { return (this.getDate() < 10 ? '0' : '') + this.getDate(); },
	D: function() { return Date.replaceChars.shortDays[this.getDay()]; },
	j: function() { return this.getDate(); },
	l: function() { return Date.replaceChars.longDays[this.getDay()]; },
	N: function() { return this.getDay() + 1; },
	S: function() { return (this.getDate() % 10 == 1 && this.getDate() != 11 ? 'st' : (this.getDate() % 10 == 2 && this.getDate() != 12 ? 'nd' : (this.getDate() % 10 == 3 && this.getDate() != 13 ? 'rd' : 'th'))); },
	w: function() { return this.getDay(); },
	z: function() { var d = new Date(this.getFullYear(),0,1); return Math.ceil((this - d) / 86400000); }, // Fixed now
	// Week
	W: function() { var d = new Date(this.getFullYear(), 0, 1); return Math.ceil((((this - d) / 86400000) + d.getDay() + 1) / 7); }, // Fixed now
	// Month
	F: function() { return Date.replaceChars.longMonths[this.getMonth()]; },
	m: function() { return (this.getMonth() < 9 ? '0' : '') + (this.getMonth() + 1); },
	M: function() { return Date.replaceChars.shortMonths[this.getMonth()]; },
	n: function() { return this.getMonth() + 1; },
	t: function() { var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), 0).getDate() }, // Fixed now, gets #days of date
	// Year
	L: function() { var year = this.getFullYear(); return (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)); },	// Fixed now
	o: function() { var d  = new Date(this.valueOf());  d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3); return d.getFullYear();}, //Fixed now
	Y: function() { return this.getFullYear(); },
	y: function() { return ('' + this.getFullYear()).substr(2); },
	// Time
	a: function() { return this.getHours() < 12 ? 'am' : 'pm'; },
	A: function() { return this.getHours() < 12 ? 'AM' : 'PM'; },
	B: function() { return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24); }, // Fixed now
	g: function() { return this.getHours() % 12 || 12; },
	G: function() { return this.getHours(); },
	h: function() { return ((this.getHours() % 12 || 12) < 10 ? '0' : '') + (this.getHours() % 12 || 12); },
	H: function() { return (this.getHours() < 10 ? '0' : '') + this.getHours(); },
	i: function() { return (this.getMinutes() < 10 ? '0' : '') + this.getMinutes(); },
	s: function() { return (this.getSeconds() < 10 ? '0' : '') + this.getSeconds(); },
	u: function() { var m = this.getMilliseconds(); return (m < 10 ? '00' : (m < 100 ? '0' : '')) + m; },
	// Timezone
	e: function() { return "Not Yet Supported"; },
	I: function() { return "Not Yet Supported"; },
	O: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + '00'; },
	P: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + ':00'; }, // Fixed now
	T: function() { var m = this.getMonth(); this.setMonth(0); var result = this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/, '$1'); this.setMonth(m); return result; },
	Z: function() { return -this.getTimezoneOffset() * 60; },
	// Full Date/Time
	c: function() { return this.format("Y-m-d\\TH:i:sP"); }, // Fixed now
	r: function() { return this.toString(); },
	U: function() { return this.getTime() / 1000; }
};

function rewriteDate(textWidget, dispValue) {
//  alert('rewriteDate() 1 ' + textWidget + ' |' + dispValue + '|'); 
//  alert('rewriteDate() 2 ' + '|' + textWidget.value + '|');
  if (false && textWidget.value != '') {
    var d = new Date(textWidget.value);
    alert('rewriteDate() 3 |' + d + '|  ' + textWidget.value + ' yields ' + d.format('Y-m-d'));
    textWidget.value = d.format('Y-m-d');
  }
}

function daysInFebruary(year) { 
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 === 0) && ((year % 100 !== 0) || (year % 400 === 0))) ? 29 : 28 );
 }

function DaysArray(n) { 
	for (var i = 1; i <= n; i++) { 
		this[i] = 31;
		if (i==4 || i==6 || i==9 || i==11) { this[i] = 30; }
		if (i==2) { this[i] = 29; }
    } 
   return this;
 }

// Based on DHTML date validation script from smartwebby.com.
function isDate(dtStr){ 
  var dtCh= "-";
  var minYear=1900;
  var maxYear=2100;
  if (dtStr == '0000-00-00') { return true; }
	var daysInMonth = DaysArray(12);
	var pos1 = dtStr.indexOf(dtCh);
	var pos2 = dtStr.indexOf(dtCh, pos1+1);
	var strYear = dtStr.substring(0, pos1);       // originally dtStr.substring(pos2+1)
	var strMonth = dtStr.substring(pos1+1 ,pos2); // originally dtStr.substring(0, pos1)
	var strDay = dtStr.substring(pos2+1);         // originally dtStr.substring(pos1+1 ,pos2)
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
  var tmCh= ":";
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
// End code based on DHTML from smartwebby.com


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
		timeInQuestionControl.select();
		return false;
  }
  return true;
}

// Allows comma separated email addresses
function validEmailAddress(emailInQuestionControl) {
  var strValue = emailInQuestionControl.value;  // TODO FIX BUG HERE
  if (!empty(strValue)) {                       // empty should operate on emailInQuestionControl
    var tokens = strValue.split(',');
    //alert('|' + strValue + ' ' + tokens + '|');
    for (i = 0; i < tokens.length; i++) {
      var eAddress = tokens[i];
      //alert(eAddress);
      var eAddressSansSpaces = eAddress.replace(' ','');
      if (validEmailAddressNaked(eAddressSansSpaces) === false) { 
        emailInQuestionControl.focus();
        emailInQuestionControl.select();
        return false;
      }
    }
  }
  return true;
}

function ValidEmail(emailInQuestionControl) { 
//alert('emailInQuestionControl = ' + emailInQuestionControl.value);
	if (validEmailAddress(emailInQuestionControl) === false) { 
		emailInQuestionControl.focus();
		emailInQuestionControl.select();
		return false;
  }
  return true;
}

function validIntegerValue(integerInQuestionControl) {
  var strValue = integerInQuestionControl.value;
	if (!empty(integerInQuestionControl) && !isInteger(strValue)) { 
		integerInQuestionControl.focus();
		integerInQuestionControl.select();
		alert('Please enter a valid whole number.');
		return false;
  }
  return true;
}

function validNonMultipleEntry(setControlInQuestion, controlName) {
  var count = 0;
  for (var i = 0; i < setControlInQuestion.length; i++) {
    if (setControlInQuestion[i].checked) { count++; }
  }
  if (count > 1) {
		setControlInQuestion[0].focus();
    alert('Please select no more that one checkbox for ' + controlName + '.');
  }
  return (count <= 1);
}

function validSingleEntry(setControlInQuestion, controlName) {
  var count = 0;
  for (var i = 0; i < setControlInQuestion.length; i++) {
    if (setControlInQuestion[i].checked) { count++; }
  }
  if (count != 1) {
    alert('Please select a single option for ' + controlName + '.');
		setControlInQuestion[0].focus();
  }
  return (count == 1);
}

function validAdminPersonEntry() { 
//alert('beginning validAdminPersonEntry');
//alert(document.getElementsByName('people_email').length);
  if (empty(getUniqueElement('people_name'))) { 
    getUniqueElement('people_name').focus(); 
    alert("Please enter the persons name."); 
    return false; 
  }
  var emptyEmailAddr = empty(getUniqueElement('people_email'));
  // The next block of code is commented out to allow the Administrator to create a person with no email address.
//  if (emptyEmailAddr) { 
//    alert("Please enter your email address."); 
//    getUniqueElement('people_email').focus(); 
//    return false; 
//  }
  if (!emptyEmailAddr && !validEmailAddress(getUniqueElement('people_email'))) {
    getUniqueElement('people_email').focus(); 
    getUniqueElement('people_email').select(); 
    return false; 
  }
  return true;
}

function validAdminPersonCreation(personId) {
  return validAdminPersonEntry();
}

function validAdminWorkEntry(typeString) { 
  if (usingAlertsForDebugging) { alert('beginning validAdminWorkEntry with type ' +  typeString); }
  var creatingWork = false;
  var worksSubmitter;
  if (typeString=='create') { creatingWork = true; worksSubmitter = getUniqueElement('works_submitter'); }
  if (creatingWork && (empty(worksSubmitter) || (worksSubmitter.value == 0))) { 
    alert("Please select a Submitter for the film.");
    getUniqueElement('works_submitter').focus(); 
    return false;
  }
  if (empty(getUniqueElement('works_title'))) { 
    alert("Please enter the title of the film."); 
    getUniqueElement('works_title').focus(); 
    return false; 
  }
  if (empty(getUniqueElement('works_yearProduced'))) { 
    getUniqueElement('works_yearProduced').focus(); 
    alert("Please enter the production year of the film."); 
    return false; 
  }
  if (empty(getUniqueElement('works_countryOfProduction'))) { 
    getUniqueElement('works_countryOfProduction').focus(); 
    alert("Please enter the name of the country where the film was produced."); 
    return false; 
  }
  var works_runTimeElement = getUniqueElement('works_runTime');

  /* TODO: Change the internal representation of and the UI for works_runTime
  if (empty(works_runTimeElement) || works_runTimeElement.value == '00:00:00') { 
    var works_minutesElement = getUniqueElement('works_minutes');
    //alert('works_minutesElement: ' + works_minutesElement);
    alert("Please enter the length of the film in minutes and seconds."); 
    works_minutesElement.focus(); 
    return false;
  } */

  if ((works_runTimeElement.value == '') || !ValidTime(works_runTimeElement)) { alert('Enter a valid runtime.'); getUniqueElement('works_runTime').focus(); return false; }
  if (!ValidDate(getUniqueElement('works_dateMediaReceived'))) { alert('Enter a valid date that the media was received in the format yyyy-mm-dd.'); return false; }
  if (!ValidDate(getUniqueElement('works_datePaid'))) { alert('Enter a valid date that the payment was received in the format yyyy-mm-dd.'); return false; }
  if (!validIntegerValue(getUniqueElement('works_amtPaid'))) { alert('Enter a valid payment amount. Dollars only; no decimal point; no cents.'); return false; }
  if (!validSingleEntry(document.getElementsByName('works_howPaid'), 'How Paid')) { return false; }
  if (!validNonMultipleEntry(document.getElementsByName('works_webSitePertainsTo[]'), 'Web site pertains to')) { return false; }

  if (empty(getUniqueElement('works_synopsisOriginal'))) { 
    alert('Please enter a brief synopsis of your film.');
    getUniqueElement('works_synopsisOriginal').focus(); 
    return false; 
  }
  // An other credit must have an associated other role.
  if (empty(getUniqueElement('workContributors_role_Other_1')) && !empty(getUniqueElement('workContributors_Other_1'))) {
    alert('Please enter a role for ' + getUniqueElement('workContributors_Other_1').value + ' or delete ' + getUniqueElement('workContributors_Other_1').value + '.'); 
    getUniqueElement('workContributors_role_Other_1').focus();
    return false;
  }
  if (empty(getUniqueElement('workContributors_role_Other_2')) && !empty(getUniqueElement('workContributors_Other_2'))) {
    alert('Please enter a role for ' + getUniqueElement('workContributors_Other_2').value + ' or delete ' + getUniqueElement('workContributors_Other_2').value + '.'); 
    getUniqueElement('workContributors_role_Other_2').focus();
    return false;
  }
  // An other role must have an associated other credit.
  if (empty(getUniqueElement('workContributors_Other_1')) && !empty(getUniqueElement('workContributors_role_Other_1'))) {
    alert('Please enter a name for ' + getUniqueElement('workContributors_role_Other_1').value + ' or delete ' + getUniqueElement('workContributors_role_Other_1').value + '.'); 
    getUniqueElement('workContributors_Other_1').focus();
    return false;
  }
  if (empty(getUniqueElement('workContributors_Other_2')) && !empty(getUniqueElement('workContributors_role_Other_2'))) {
    alert('Please enter a name for ' + getUniqueElement('workContributors_role_Other_2').value + ' or delete ' + getUniqueElement('workContributors_role_Other_2').value + '.'); 
    getUniqueElement('workContributors_Other_2').focus();
    return false;
  }
  // An other role must have an associated other credit.
  if (usingAlertsForDebugging) { alert('validWorkEntry SUCCESS'); }
  return true;
}

function validAdminWorkCreation(personId) { // It seems that this is not called anywhere. 4/15/13
  return validAdminWorkEntry('create');
}

function validAdminNewWork() {
  return validAdminWorkEntry('create');
}

function properlyReentered(field1, field2, fieldMoniker, matchCase) {
  var field1Empty = (empty(field1) || (field1.value == missingValueString));
  if (field1Empty || empty(field2) || (field2.value == missingValueString)) { 
    var actionVerb = "reenter";
    if (field1Empty) { actionVerb = "enter"; }
    alert("Please " + actionVerb + " " + fieldMoniker + "."); 
    if (field1Empty) { field1.focus(); field1.select(); } 
    else { field2.focus(); field2.select(); }
    return false; 
  }
	if ((matchCase && (field1.value != field2.value)) || 
	    (!matchCase && (field1.value.toLowerCase() != field2.value.toLowerCase()))) { 
	  alert(fieldMoniker + " does not match it's re-entered value. Please re-enter."); 
	  field2.focus();
	  field2.select();
	  return false; 
	}
  else {return true;}
}

function setFullNameToFirstLast(firstNameElement, lastNameElement, fullNameElement) {
    var separator=''; 
    if (!empty(firstNameElement) && !empty(lastNameElement)) { separator=' '; }
    fullNameElement.value = firstNameElement.value + separator + lastNameElement.value;
}

function personNameIsUnique() { // This function is called from entryForm2013, but it does nothing except return true. 4/26/13
//alert('beginning uniquePersonEntry');
  return true;
//alert('ending uniquePersonEntry');
}

function validPersonEntry() { 
//alert('beginning validPersonEntry');
  // Initialization (Some of these vars are unused.)
  var firstNameElement = getUniqueElement('people_nickName');
  var lastNameElement = getUniqueElement('people_lastName');
  var organizationElement = getUniqueElement('people_organization');
  var fullNameElement = getUniqueElement('people_name');
  var loginNameElement = getUniqueElement('people_loginName');
  var emailElement = getUniqueElement('people_email');
  var passwordElement = getUniqueElement('people_password');
  var priorEmail, priorPassword, priorFullName, priorFirstName, priorLoginName;
  if (document.getElementById('dbEmail') !== null) { priorEmail = document.getElementById('dbEmail').value; } else { priorEmail = ''; }
  if (document.getElementById('dbPassword') !== null) { priorPassword = document.getElementById('dbPassword').value; } else { priorPassword = ''; }
  if (document.getElementById('dbName') !== null) { priorFullName = document.getElementById('dbName').value; } else { priorFullName = ''; }
  if (document.getElementById('dbFirstName') !== null) { priorFirstName = document.getElementById('dbFirstName').value; } else { priorFirstName = ''; }
  if (document.getElementById('dbLastName') !== null) { priorLastName = document.getElementById('dbLastName').value; } else { priorLastName = ''; }
//  if (document.getElementById('dbLastName') !== null) { priorLastName = document.getElementById('dbLastName').value; } else { priorLastName = ''; }
//  if (document.getElementById('dbLoginName') !== null) { priorLastName = document.getElementById('dbLoginName').value; } else { priorLastName = ''; }
  // Require at least a first name or a last name or organization and compute the full name.
  var nameFieldsIncomplete = (empty(firstNameElement) || empty(lastNameElement));
  if (nameFieldsIncomplete && empty(organizationElement)) {
    alert("Please provide First and Last Names or an Organization.");
    if (empty(firstNameElement)) {
      firstNameElement.focus();
      firstNameElement.select();
    } else {
      lastNameElement.focus();
      lastNameElement.select();
    }
    return false;
  }
  // Compute the full name.
  if (priorFullName == '') {
    if (empty(firstNameElement) && empty(lastNameElement)) { 
      fullNameElement.value = organizationElement.value; 
    } // drop through to next if
    if (fullNameElement.value == '') { 
      setFullNameToFirstLast(firstNameElement, lastNameElement, fullNameElement);
    }
  } else { // Since the priorFullName is non blank,
    if ((!empty(lastNameElement) && (priorFullName.indexOf(lastNameElement.value) == -1))
      || (!empty(firstNameElement) && (priorFullName.indexOf(firstNameElement.value) == -1))) {
      // Presumably the last or first name has changed.
      setFullNameToFirstLast(firstNameElement, lastNameElement, fullNameElement);
    } else if ((priorFirstName != firstNameElement.value )
            || (priorLastName != lastNameElement.value )) { 
      setFullNameToFirstLast(firstNameElement, lastNameElement, fullNameElement);
    } else { // TODO Fancy recomputation of full name
    }
  }
  // Require a country.
  if (empty(getUniqueElement('people_country'))) { 
    alert("Please enter the country where you live."); 
    getUniqueElement('people_country').focus(); 
    return false; 
  }
  if (usingAlertsForDebugging) { alert('finished with name computation in validPersonEntry'); }
  // Require an email address.
  if (empty(getUniqueElement('people_email'))) { 
    alert("Please enter your Email Address."); 
    getUniqueElement('people_email').focus(); 
    return false; 
  }
  // Require a valid email address.
  var emailEnteredElement = getUniqueElement('people_email');
  if (!validEmailAddress(emailEnteredElement)) {
    getUniqueElement('people_email').focus(); 
    getUniqueElement('people_email').select(); 
    return false; 
  }
  // Require a matching emailReentered iff priorEmail != null and emailEntered.value != priorEmail
  var emailReenteredElement = getUniqueElement('people_email_2');
  if (!empty(priorEmail) && ((priorEmail == missingValueString) || (emailEnteredElement.value != priorEmail)) &&
                         !properlyReentered(emailEnteredElement, emailReenteredElement, "Email Address")) { 
    emailReenteredElement.focus();
    emailReenteredElement.select();
    return false; 
  }
	// Require passwordEntered and passwordReentered if this is a new user, i.e., (priorEmail != '')
  var passwordEnteredElement = getUniqueElement('people_password');
  var passwordReenteredElement = getUniqueElement('people_password_2');
  if (empty(passwordEnteredElement)) { 
    alert("Please enter a Password that you can remember.");
    passwordEnteredElement.focus(); 
    passwordEnteredElement.select(); 
    return false; 
  }
  // Require a matching passwordReentered iff passwordEntered != null and passwordEntered != priorPassword
	if (!empty(passwordEnteredElement) && (passwordEnteredElement.value != priorPassword) && 
	          !properlyReentered(passwordEnteredElement, passwordReenteredElement, "Password")) { 
    passwordReenteredElement.focus(); 
    passwordReenteredElement.select(); 
    return false; 
  }
//  alert('validPersonEntry SUCCESS');
  return true;
}

function validPersonCreation(priorEmail, priorPassword) {
  return validPersonEntry(priorEmail, priorPassword);
}

function validWorkEntry() { 
  if (usingAlertsForDebugging) { alert('beginning validWorkEntry'); }
  if (empty(getUniqueElement('works_title'))) { 
    alert("Please enter the title of your film. "); 
    getUniqueElement('works_title').focus(); 
    return false; 
  }
  if (empty(getUniqueElement('works_yearProduced'))) { 
    getUniqueElement('works_yearProduced').focus(); 
    alert("Please enter the production year of your film."); 
    return false; 
  }
  if (empty(getUniqueElement('works_countryOfProduction'))) { 
    getUniqueElement('works_countryOfProduction').focus(); 
    alert("Please enter the name of the country where your film was produced."); 
    return false; 
  }
  var works_runTimeElement = getUniqueElement('works_runTime');
  if (empty(works_runTimeElement) || works_runTimeElement.value == '00:00:00') { 
    var works_minutesElement = getUniqueElement('works_minutes');
    //alert('works_minutesElement: ' + works_minutesElement);
    alert("Please enter the length of your film in minutes and seconds."); 
    works_minutesElement.focus(); 
    return false;
  }
/* works_originalFormatSelector nas not been on the entry from since 2014. DHL 4/1/15
  if (empty(getUniqueElement('works_originalFormatSelector'))) { 
    alert("Please enter the Original Format of your film.");
    getUniqueElement('works_originalFormatSelector').focus(); 
    return false;
  }
	if (getUniqueElement('works_originalFormatSelector').value=="-- Select --") { 
	  alert("Please select an Original Format for your film."); 
	  getUniqueElement('works_originalFormat').focus(); 
	  return false; 
	}
	if (getUniqueElement('works_originalFormatSelector').value=="other" && empty(getUniqueElement('works_originalFormatOtherText'))) { 
	  alert('Please enter the Other Original Format of your film or else select an Original Format other than Other.');
	  getUniqueElement('works_originalFormatOtherText').focus(); 
	  return false; 
	}
	*/
  if (empty(getUniqueElement('works_synopsisOriginal'))) { 
    alert('Please enter a brief synopsis of your film.');
    getUniqueElement('works_synopsisOriginal').focus(); 
    return false; 
  }
  // An other credit must have an associated other role.
  if (empty(getUniqueElement('workContributors_role_Other_1')) && !empty(getUniqueElement('workContributors_Other_1'))) {
    alert('Please enter a role for ' + getUniqueElement('workContributors_Other_1').value + ' or delete ' + getUniqueElement('workContributors_Other_1').value + '.'); 
    getUniqueElement('workContributors_role_Other_1').focus();
    return false;
  }
  if (empty(getUniqueElement('workContributors_role_Other_2')) && !empty(getUniqueElement('workContributors_Other_2'))) {
    alert('Please enter a role for ' + getUniqueElement('workContributors_Other_2').value + ' or delete ' + getUniqueElement('workContributors_Other_2').value + '.'); 
    getUniqueElement('workContributors_role_Other_2').focus();
    return false;
  }
  // An other role must have an associated other credit.
  if (empty(getUniqueElement('workContributors_Other_1')) && !empty(getUniqueElement('workContributors_role_Other_1'))) {
    alert('Please enter a name for ' + getUniqueElement('workContributors_role_Other_1').value + ' or delete ' + getUniqueElement('workContributors_role_Other_1').value + '.'); 
    getUniqueElement('workContributors_Other_1').focus();
    return false;
  }
  if (empty(getUniqueElement('workContributors_Other_2')) && !empty(getUniqueElement('workContributors_role_Other_2'))) {
    alert('Please enter a name for ' + getUniqueElement('workContributors_role_Other_2').value + ' or delete ' + getUniqueElement('workContributors_role_Other_2').value + '.'); 
    getUniqueElement('workContributors_Other_2').focus();
    return false;
  }
  var permissionWidgets = new Array();
  permissionWidgets = document.getElementsByName('works_permissionsAtSubmission');
  if (permissionWidgets.length != 2) {
    alert('INTERNAL ERROR. There are ' + permissionWidgets.length + ' permission widgets. There should be exacly 2. Tell David.'); 
    return false;
  }
  var permissionWidgetChecked = 0;
  for (i = 0; i < permissionWidgets.length; i++) { 
    permissionWidgetChecked = permissionWidgetChecked || permissionWidgets[i].checked; 
  }
  if (!permissionWidgetChecked) {
    alert('Please select a choice for Release Information.'); 
    document.getElementById(permissionWidgets[0].id).focus();
    return false;
  }
  // An other role must have an associated other credit.
  if (usingAlertsForDebugging) { alert('validWorkEntry SUCCESS'); }
  return true;
}

function get2DigitString(numericElement) {
  var stringElement;
  if (numericElement < 1) { stringElement = '00'; }
  else if (numericElement < 10) { stringElement = '0' + numericElement.toString(); }
  else { stringElement = numericElement.toString(); }
  return stringElement;
}

function get3DigitString(numericElement) {
  var stringElement;
  if (numericElement < 1) { stringElement = '000'; }
  else if (numericElement < 10) { stringElement = '00' + numericElement.toString(); }
  else if (numericElement < 100) { stringElement = '0' + numericElement.toString(); }
  else { stringElement = numericElement.toString(); }
  return stringElement;
}

function validWorkCreation() {
  return validWorkEntry();
}

function getTimeString(minutes, seconds) {
  var minutesFromSeconds, hours, hoursString, minutesString, secondsString, secondsInt, minutesInt, timeString;
  secondsInt = parseInt(seconds, 10);
  minutesInt = parseInt(minutes, 10);
  minutesFromSeconds = parseInt(Math.floor(secondsInt/60), 10);
  secondsInt = secondsInt % 60;
  minutesInt += minutesFromSeconds;
  hours = parseInt(Math.floor(minutesInt/60), 10);
  minutesInt = minutesInt % 60;
  hoursString = get2DigitString(hours);
  minutesString = get2DigitString(minutesInt);
  secondsString = get2DigitString(secondsInt);
  timeString = hoursString + ':' + minutesString + ':' + secondsString;
  return timeString;
}

function computeRunTimeAndValidateWorkEntry() {
  getUniqueElement('works_runTime').value = 
    getTimeString(getUniqueElement('works_minutes').value, getUniqueElement('works_seconds').value);
  return validWorkEntry();
}

function unconditionallyValidate() {
  return true;
}
