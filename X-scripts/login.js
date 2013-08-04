// login.js

// I need to add onLoad="initLoginArea();"
function initLoginArea() {
  document.getElementById("loginArea").innerHTML="";
}

// Changed 8/18/08: Added formal parameter, callForEntriesNameText, and changed from
//    +             '<input type="hidden" id="callForEntries" name="CallForEntries" value="BMoCA200804"></td>'
// to
//    +             '<input type="hidden" id="callForEntriesName" name="CallForEntriesName" value="' + callForEntriesNameText + '"></td>'
function revealLoginArea(callForEntriesNameText) {
  var inner = document.getElementById('loginArea').innerHTML;
  var fullContent ='<img src="../images/dotClear.gif" height="8" width="1" alt=""><br clear="all">'
    +  '<form onSubmit="return validateLogin()" action="onlineEntryForm/entryForm2008.php" method="post" name="ProcessLogin">'
    +    '<table align="center" width="100%" border="0" cellpadding="0" cellspacing="0">'
    +      '<tr><td colspan="2" class="loginPrompt" style="padding:0 0 6px 0;font-size:14px;">Please sign in.</td></tr>'
    +      '<tr>'
    +        '<td height="28" align="right" class="entryFormDescription">My email address is: </td>'
    +        '<td height="28" align="left" class="entryFormField"><input type="text" name="EmailAddressUID" id="emailAddressUID" '
    +             'value="" class="entryFormInputFieldShort" onblur="processLoginUID(this.value)" maxlength="100">'
    +             '<input type="hidden" id="callForEntriesName" name="CallForEntriesName" value="' + callForEntriesNameText + '"></td>'
    +      '</tr>'
    +      '<tr><td colspan="2" class="loginPrompt" style="padding:6px 0 4px 0">If you have a password and you know what it is, enter it below.</td></tr>'
    +      '<tr>'
    +        '<td height="28" align="right" class="entryFormDescription">Password: </td>'
    +        '<td height="28" align="left" class="entryFormField"><input type="password" name="Password" id="password" '
    +          'value="" class="entryFormInputFieldShorter" onblur="submitLogin(document.getElementById(\'emailAddressUID\'),this.value)" maxlength="100"><span '
    +           'class="entryFormDescription"> (leave blank if unknown)</span></td>'
    +      '</tr>'
    +      '<tr>'
    +        '<td colspan="2" height="28" align="center" style="padding-top:10px"><input type="submit" id="submit" name="Submit" value="Sign In"></td>'
    +      '</tr>'
    +    '</table>'
    +   '</form>';
  if (!inner || inner=='') { document.getElementById('loginArea').innerHTML=fullContent; }
  else { document.getElementById('loginArea').innerHTML=''; }
}

function validateLogin() {
	var emailAddr = document.getElementById("emailAddressUID");
	if ((emailAddr.value==null) || (emailAddr.value=="")) { badEmailAlert(); emailAddr.focus(); return false; }
	if (!validEmailAddress(emailAddr.value)) { emailAddr.select(); return false; }
	return true;
}

function processLoginUID(loginUID) {
}

function submitLogin(loginUID, password) {
}