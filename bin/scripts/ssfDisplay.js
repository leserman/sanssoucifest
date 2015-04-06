// ssfDisplay.js
  
  $displayShowHideAlerts = false;
  
  function submitFormVia(form, selectorName) {
    document.getElementById('selectorSubmitter').value = selectorName;
//    document.getElementById('selectorSubmitterOption0Text').value = document.getElementById('selectorName').options[0];
    eval('document.' + form.name + '.submit();');
  }

  function getUniqueElement(name) {
    var elements = document.getElementsByName(name);
    if (elements.length != 1) { 
      alert('BUG: There are ' + elements.length + ' elements named ' + name + '. Please copy this error message and email it to webdude@sanssoucifest.org.'); 
      return null;
    }
    else { return elements[0]; }
  }

  function showHide(blockName) {
    var state, newState;
    if ($displayShowHideAlerts) { alert(blockName + ' style.display was ' + document.getElementById(blockName).style.display); }
    state=document.getElementById(blockName).style.display;
    if (state=='none') newState='block'; 
    else newState = 'none'; 
    document.getElementById(blockName).style.display = newState;
    if ($displayShowHideAlerts) { alert('Changed ' + blockName + ' style.display to ' + document.getElementById(blockName).style.display); }
  }

  function show(blockName) { 
    if ($displayShowHideAlerts) { alert(blockName + ' style.display was ' + document.getElementById(blockName).style.display); }
    if (document.getElementById(blockName) != null) {
      document.getElementById(blockName).style.display = 'block'; 
      if ($displayShowHideAlerts) { alert('Changed ' + blockName + ' style.display to ' + document.getElementById(blockName).style.display); }
    }
  }

  function hide(blockName) { 
    if ($displayShowHideAlerts) { alert(blockName + ' style.display was ' + document.getElementById(blockName).style.display); }
    if (document.getElementById(blockName) != null) {
      document.getElementById(blockName).style.display = 'none'; 
      if ($displayShowHideAlerts) { alert('Changed ' + blockName + ' style.display to ' + document.getElementById(blockName).style.display); }
    }
  }

  function disable(control) { 
    if (document.getElementById(control) !== null) {
      document.getElementById(control).disabled=true;
    } 
  }

  function enable(control) { 
    if (document.getElementById(control) !== null) {
      document.getElementById(control).disabled=false;
    } 
  }

  function toggle(control) {
    if (document.getElementById(control) !== null) {
      if (document.getElementById(control).disabled == true)
        document.getElementById(control).disabled = false;
      else
        document.getElementById(control).disabled = true;
    }
  }
    
  function enableByName(control) {
    if (getUniqueElement(control) !== null) {
      getUniqueElement(control).disabled=false;
      // alert(control + " - " + control.disabled);
    } 
  } 
  
  function getEntryRequirementsDisplayStringWithLink(filename, displayText, section) {
    "use strict";
    section = (section !== 'undefined') ? section : '';
    var displayString = '<a class="dodeco" href="javascript:void(0)" onClick="entryRequirementsWindow=window.open(\'onlineEntryForm/' + filename + section + '\',' + '\'EntryRequirementsWindow\',\'directories=no,status=no,menubar=no,resizable=yes,scrollbars=yes,toolbar=no,top=50,width=850,height=640\',false);' + 'entryRequirementsWindow.focus();">' + displayText + '</a>';
    return displayString;
  }

