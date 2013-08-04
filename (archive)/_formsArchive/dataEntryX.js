// JavaScript Document

  // entity = 0 for submitter & 1 for entry
  function userMadeAChange(entity) { 
    document.getElementById('changeCount').value++; 
    if (entity == 0)  document.getElementById('submitterChangeCount').value++; 
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

  function validateDataEntry(form, emailFromDB, pwFromDB) {
//alert("validateEntryForm called");
return true;

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
  if (empty(form.filmTitle,"Please enter the title of your film.")) { form.filmTitle.select(); return false; }
  if (empty(form.submitterName,"Please enter your name.")) { form.submitterName.select(); return false; }
  if (empty(form.submitterEmail,"Please enter a valid Email Address.")) { form.submitterEmail.select(); return false; }
  if (empty(form.runTimeMinutes,"Please enter the length of your film in minutes.")) { form.runTimeMinutes.select(); return false; }
  if (empty(form.originalFormat,"Please enter Original Format of your film.")) { form.originalFormat.select(); return false; }
	if (form.originalFormat.value=="selectSomething") { alert("Please select an Original Format for your film."); form.originalFormat.focus(); return false; }
	if (form.originalFormat.value=="other" && empty(form.otherFormat, 
	  "Please enter the Other Original Format of your film or else select an Original Format other than Other.")) { form.otherFormat.focus(); return false; }
  if (empty(form.synopsis,"Please enter a brief synopsis of your film.")) { form.synopsis.select(); return false; }
  return true;
}

  function saveSubmitterChangesQuery(newSubmitterId, currentSubmitterId) {
    if ((userMadeChanges() != 0) && (newSubmitterId != currentSubmitterId)) {
      if (confirm("Do you want to save your changes first?")) document.getElementById('saveSubmitterChangesFirst').value='yes';
    }
  }
  
  function saveEntryChangesQuery(newEntryId, currentEntryId) {
    if ((userMadeEntryChanges() != 0) && (newEntryId != currentEntryId)) {
      if (confirm("Do you want to save your changes to this entry first?")) 
        document.getElementById('saveEntryChangesFirst').value='yes';
    }
  }  
  
  function abilifyButton($value, $button) {
    //alert("abilifyButton $value = |" + $value + "|   button = |" + $button.name + "|");
    if ($value == 'selectSomething') $button.disabled = true;
    else $button.disabled=false;
  }
  