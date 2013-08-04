// JavaScript Document

function empty(field, alertText) {
  if (field.value==null || field.value=="") { alert(alertText); return true; }
  return false;
}

function matchedAndNotEmpty(field1, field2, fieldMoniker) {
  if (empty(field1, "Please enter " + fieldMoniker + ".")) { return false; }
  if (empty(field2, "Please re-enter " + fieldMoniker + ".")) { return false; }
	if (field1.value != field2.value) { alert(fieldMoniker + " does not match it's re-entered value. Please re-enter."); return false; }
  else {return true;}
}

function validateEntryForm(form, emailFromDB, pwFromDB) {
//alert("validateEntryForm called");
  if (empty(form.filmTitle,"Please enter the title of your film.")) { form.filmTitle.select(); return false; }
  if (empty(form.submitterName,"Please enter your name.")) { form.submitterName.select(); return false; }
  if (empty(form.submitterEmail,"Please enter a valid Email Address.")) { form.submitterEmail.select(); return false; }
	// Only require SubmitterEmailReentered if SubmitterEmail.value != SubmitterEmailFromDB
	if (((emailFromDB == '') || (form.submitterEmail.value != emailFromDB))
    && (!matchedAndNotEmpty(form.submitterEmail, form.submitterEmailReentered, "Email Address"))) { form.submitterEmailReentered.select(); return false; }
	// TODO to do: Require SubmitterPassword and SubmitterPasswordReentered if this is a new user, i.e., (emailFromDB != '')
    // if (empty(form.submitterPassword,"Please enter a valid Password that you can remember.")) { form.submitterPassword.select(); return false; }
  // Require SubmitterPasswordReentered if SubmitterPassword is entered and SubmitterPasswordReentered != SubmitterPasswordFromDB
//	if (((pwFromDB == '') || (form.submitterPassword.value != pwFromDB))
	if ((form.submitterPassword.value != pwFromDB)
    && !matchedAndNotEmpty(form.submitterPassword, form.submitterPasswordReentered, "Password")) { form.submitterPasswordReentered.select(); return false; }
  if (empty(form.runTimeMinutes,"Please enter the length of your film in minutes.")) { form.runTimeMinutes.select(); return false; }
  if (empty(form.originalFormat,"Please enter Original Format of your film.")) { form.originalFormat.select(); return false; }
	if (form.originalFormat.value=="selectSomething") { alert("Please select an Original Format for your film."); form.originalFormat.focus(); return false; }
	if (form.originalFormat.value=="other" && empty(form.otherFormat, 
	  "Please enter the Other Original Format of your film or else select an Original Format other than Other.")) { form.otherFormat.focus(); return false; }
  if (empty(form.synopsis,"Please enter a brief synopsis of your film.")) { form.synopsis.select(); return false; }
  return true;
}

/*

When populating the form from the DB
- never populate SubmitterPassword or SubmitterPasswordReentered
- never populate SubmitterEmailReentered

FilmTitle *
SubmitterName *
SubmitterEmail *
SubmitterEmailReentered - match
SubmitterPassword *
SubmitterPasswordReentered - match
RunTimeMinutes *
OriginalFormat *
OtherFormat - if originalFormat.value=="other"
Synopsis *
Payment *
Permission *

FilmTitle *
CallForEntries (hidden)
SubmitterName *
SubmitterOrganization
SubmitterAddress1
SubmitterAddress2
SubmitterCity
SubmitterState
SubmitterPostalCode
SubmitterCountry
SubmitterPhoneVoice
SubmitterPhoneVoice
SubmitterPhoneFax
SubmitterEmail *
SubmitterEmailReentered - match
SubmitterPassword *
SubmitterPasswordReentered - match
SubmitterHowHeard
FilmTitleSlave
ProductionYear
RunTimeMinutes *
RunTimeSeconds
SubmissionFormat
OriginalFormat *
OtherFormat - if originalFormat.value=="other"
Director
Producer
Choreographer
DanceCompany
PrincipalDancers
MusicComposition
MusicPerformance
ContributorRole1
ContributorName1
ContributorRole2
ContributorName2
OtherFestivals
PhotoCredits
WebSite
Synopsis *
Payment *
Permission *
*/


// XMLHttpRequest functions
//   readyState property: 0 = uninitialized, 1 = loading, 2 = loaded, 3 = interactive, 4 = complete 

var xmlHttp;
var entryFormData = null;

// Get the fields from the server DB row as an associative array

function setFormFieldValuesFromDB(entryFormId, fieldId) {
  if (!entryFormData) { entryFormData = new array(loadData()); }
	
}


function getFieldValue(entryFormId, fieldId) {
  if (!entryFormData) { entryFormData = new array(loadData()); }
	
}

// HttpRequest administration

function GetXmlHttpObject() {
  var xmlHttp = null;
  try { xmlHttp = new XMLHttpRequest(); } // Firefox, Opera 8.0+, Safari
  catch(e) { try { xmlHttp = new ActiveXObject("Msxml2.XMLHTTP"); } // Internet Explorer
  catch (e) { xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); } // Oh, shit: Axtive X
  }
  console.log(xmlHttp);
  return xmlHttp;
}

function stateChanged() { 
  if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
	  document.getElementById("txtHint").innerHTML = xmlHttp.responseText; } 
}

// Set Event Functions

function setValueInFormFromDB(entryForm, fieldId) {
  if (str.length==0) { document.getElementById("txtHint").innerHTML=""; return; }
  xmlHttp=GetXmlHttpObject()
  if (xmlHttp==null) { alert ("Your browser does not support this Online Entry Form. Download the PDF version."); return; }
  var url = "PHPprogramToExecute.php";
  url += "?q=" + str;
  url += "&sid=" + Math.random();
  xmlHttp.onreadystatechange = stateChanged();
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
} 

function XXX(str) {
  if (str.length==0) { document.getElementById("txtHint").innerHTML=""; return; }
  xmlHttp=GetXmlHttpObject();
  if (xmlHttp==null) { alert ("Your browser does not support this Online Entry Form. Download the PDF version."); return; }
  var url = "PHPprogramToExecute.php";
  url += "?q=" + str;
  url += "&sid=" + Math.random();
  xmlHttp.onreadystatechange = stateChanged();
  xmlHttp.open("GET", url, true);
  xmlHttp.send(null);
} 


