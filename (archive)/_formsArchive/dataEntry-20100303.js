  function userMadeAChange(entity) { 
    document.getElementById('changeCount').value++; 
    if (entity == 0)  document.getElementById('personChangeCount').value++; 
    if (entity == 1)  document.getElementById('entryChangeCount').value++; 
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
    else if (entity == 0) document.getElementById('submitterChangeCount').value = 0;
    else if (entity == 1) document.getElementById('entryChangeCount').value = 0;
  }

  function validateDataEntry(form, emailFromDB, pwFromDB) { // TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO TODO 
//alert("validateEntryForm called");

alert("emailFromDB=|"+emailFromDB+"|\r\nform.submitterEmail.value=|"+form.submitterEmail.value+"|");
	// Only require SubmitterEmailReentered if SubmitterEmail.value != SubmitterEmailFromDB
	if (((emailFromDB == '') || (form.submitterEmail.value != emailFromDB))
    && (!matchedAndNotEmpty(form.submitterEmail, form.submitterEmailReentered, "Email Address"))) { form.submitterEmailReentered.select(); return false; }
	// TODO to do: Require SubmitterPassword and SubmitterPasswordReentered if this is a new user, i.e., (emailFromDB != '')
    // if (empty(form.submitterPassword,"Please enter a valid Password that you can remember.")) { form.submitterPassword.select(); return false; }
  // Require SubmitterPasswordReentered if SubmitterPassword is entered and SubmitterPasswordReentered != SubmitterPasswordFromDB
//	if (((pwFromDB == '') || (form.submitterPassword.value != pwFromDB))
	if ((form.submitterPassword.value != pwFromDB)
    && !matchedAndNotEmpty(form.submitterPassword, form.submitterPasswordReentered, "Password")) { form.submitterPasswordReentered.select(); return false; }
  return true; 

  // TODO make this function do something more
  if (empty(form.submitterName,"Please enter your name.")) { form.submitterName.select(); return false; }
  if (empty(form.submitterEmail,"Please enter a valid Email Address.")) { form.submitterEmail.select(); return false; }
  return true;
}

  function abilifyButton($value, $button) {
    //alert("abilifyButton $value = |" + $value + "|   button = |" + $button.name + "|");
    if ($value == 'selectSomething') $button.disabled = true;
    else $button.disabled=false;
  }

function empty(field) {
//alert('field=' + field + '  field.id=' + field.id + '  field.value=' + field.value + '  field.value===null ' + (field.value===null) + '  field.value==="" ' + (field.value===""));
  if (field === null || field.value === null || field.value == "") { return true; }
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

// Based on DHTML date validation script from smartwebby.com.
function isDate(dtStr){ 
  var dtCh= "-";
  var minYear=1900;
  var maxYear=2100;
  if (dtStr == '0000-00-00') return true;
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
		return false;
  }
  return true;
}

function ValidEmail(emailInQuestionControl) { 
//alert('emailInQuestionControl = ' + emailInQuestionControl.value);
	if (validEmailAddress(emailInQuestionControl) === false) { 
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
      if (validEmailAddressNaked(tokens[i].replace(' ','')) === false) { 
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

function validAdminWorkCreation(personId) {
  return validAdminWorkEntry();
}

function validAdminPersonEntry() { 
//alert('beginning validAdminPersonEntry');
//alert(document.getElementsByName('people_email').length);
  if (empty(getUniqueElement('people_name'))) { 
    getUniqueElement('people_name').focus(); 
    alert("Please enter the persons name."); 
    return false; 
  }
  if (empty(getUniqueElement('people_email'))) { 
    alert("Please enter your email address."); 
    getUniqueElement('people_email').focus(); 
    return false; 
  }
  if (!validEmailAddress(getUniqueElement('people_email'))) {
    getUniqueElement('people_email').focus(); 
    return false; 
  }
  return true;
}

function validAdminWorkEntry() { 
alert('beginning validAdminWorkEntry');
  //if (empty(getUniqueElement('works_designatedId'))) { alert('Please enter a valid Designated Id.'); return false; }
  if (!ValidTime(getUniqueElement('works_runTime'))) { alert('Enter a valid runtime.'); return false; }
  if (!ValidDate(getUniqueElement('works_dateMediaReceived'))) { alert('Enter a valid date that the media was received in the format yyyy-mm-dd.'); return false; }
  if (!ValidDate(getUniqueElement('works_datePaid'))) { alert('Enter a valid date that the payment was received in the format yyyy-mm-dd.'); return false; }
  if (!validIntegerValue(getUniqueElement('works_amtPaid'))) { alert('Enter a valid payment amount. Dollars only; no decimal point; no cents.'); return false; }
  if (!validSingleEntry(document.getElementsByName('works_howPaid[]'), 'How Paid')) { return false; }
  if (!validSingleEntry(document.getElementsByName('works_webSitePertainsTo[]'), 'Web site pertains to')) { return false; }
//  alert('validAdminWorkEntry SUCCESS');
  return true;
}

function validWorkCreation(personId) {
  return validWorkEntry();
}

function validPersonCreation(personId) {
  return validPersonEntry();
}

function matchedAndNotEmpty(field1, field2, fieldMoniker) {
  if (empty(field1, "Please enter " + fieldMoniker + ".")) { return false; }
  if (empty(field2, "Please re-enter " + fieldMoniker + ".")) { return false; }
	if (field1.value != field2.value) { alert(fieldMoniker + " does not match it's re-entered value. Please re-enter."); return false; }
  else {return true;}
}

function validPersonEntry() { 
alert('beginning validPersonEntry');
    if (empty(getUniqueElement('people_email'))) { 
    alert("Please enter your email address."); 
    getUniqueElement('people_email').focus(); 
    return false; 
  }
/*
people_email_2
// Only require SubmitterEmailReentered if SubmitterEmail.value != SubmitterEmailFromDB
	if (((emailFromDB == '') || (form.submitterEmail.value != emailFromDB))
    && (!matchedAndNotEmpty(form.submitterEmail, form.submitterEmailReentered, "Email Address"))) { form.submitterEmailReentered.select(); return false; }
	// TODO to do: Require SubmitterPassword and SubmitterPasswordReentered if this is a new user, i.e., (emailFromDB != '')
    // if (empty(form.submitterPassword,"Please enter a valid Password that you can remember.")) { form.submitterPassword.select(); return false; }
  // Require SubmitterPasswordReentered if SubmitterPassword is entered and SubmitterPasswordReentered != SubmitterPasswordFromDB
//	if (((pwFromDB == '') || (form.submitterPassword.value != pwFromDB))
	if ((form.submitterPassword.value != pwFromDB)
    && !matchedAndNotEmpty(form.submitterPassword, form.submitterPasswordReentered, "Password")) { form.submitterPasswordReentered.select(); return false; }
*/

  if (empty(getUniqueElement('people_lastName')) && empty(getUniqueElement('people_nickName'))) { 
    getUniqueElement('people_nickName').focus(); 
    alert("Please enter your first name and your last name."); 
    return false; 
  }
  // TODO Improve the computation of people_name.
  if (getUniqueElement('people_name').value == '') {
    //alert('Setting people_name. people_nickName=|' + getUniqueElement('people_nickName').value + '|people_lastName=|' + getUniqueElement('people_lastName').value + '|');
    getUniqueElement('people_name').value = getUniqueElement('people_nickName').value 
      + ' ' + getUniqueElement('people_lastName').value;
  } else { 
    //alert('people_name = |' + getUniqueElement('people_name').value + '|') 
  }
  return true;
}

function validWorkEntry() { 
alert('beginning validWorkEntry');
  if (empty(getUniqueElement('works_title'))) { 
    alert("Please enter the title of your film."); 
    getUniqueElement('works_title').focus(); 
    return false; 
  }
  if (empty(getUniqueElement('works_yearProduced'))) { 
    getUniqueElement('works_yearProduced').focus(); 
    alert("Please enter the production year of your film."); 
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
  if (empty(getUniqueElement('works_originalFormat'))) { 
    alert("Please enter Original Format of your film.");
    getUniqueElement('works_originalFormat').focus(); 
    return false;
  }
	if (getUniqueElement('works_originalFormat').value=="selectSomething") { 
	  alert("Please select an Original Format for your film."); 
	  getUniqueElement('works_originalFormat').focus(); 
	  return false; 
	}
	if (getUniqueElement('works_originalFormat').value=="other" && empty(getUniqueElement('works_originalFormatOtherText'))) { 
	  alert('Please enter the Other Original Format of your film or else select an Original Format other than Other.');
	  getUniqueElement('works_originalFormatOtherText').focus(); 
	  return false; 
	}
  if (empty(getUniqueElement('works_synopsisOriginal'))) { 
    alert('Please enter a brief synopsis of your film.');
    getUniqueElement('works_synopsisOriginal').focus(); 
    return false; 
  }
//  alert('validAdminWorkEntry SUCCESS');
  return true;
}

function get2DigitString(numericElement) {
  var stringElement;
  if (numericElement < 1) { stringElement = '00'; }
  else if (numericElement < 10) { stringElement = '0' + numericElement.toString(); }
  else { stringElement = numericElement.toString(); }
  return stringElement;
}


function getTimeString(minutes, seconds) {
  var minutesFromSeconds, hours, hoursString, minutesString, secondsString, secondsInt, minutesInt, timeString;
  secondsInt = parseInt(seconds);
  minutesInt = parseInt(minutes);
  minutesFromSeconds = parseInt(Math.floor(secondsInt/60));
  secondsInt = secondsInt % 60;
  minutesInt += minutesFromSeconds;
  hours = parseInt(Math.floor(minutesInt/60));
  minutesInt = minutesInt % 60;
  hoursString = get2DigitString(hours);
  minutesString = get2DigitString(minutes);
  secondsString = get2DigitString(seconds);
  timeString = hoursString + ':' + minutesString + ':' + secondsString;
  return timeString;
}

function computeRunTimeAndValidateWorkEntry() {
  getUniqueElement('works_runTime').value = 
    getTimeString(getUniqueElement('works_minutes').value, getUniqueElement('works_seconds').value);
  return validWorkEntry();
}
