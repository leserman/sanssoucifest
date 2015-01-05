<script type='text/javascript' src='../../bin/scripts/fg_moveable_popup.js'></script>

<div id='fg_formContainer'>

  <div id="fg_container_header">
    <div id="fg_box_Title">Download Video</div>
    <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close(X)</a></div>
  </div>

  <div id="fg_form_InnerContainer">
    <form id='contactus' action='index.php' method='post' accept-charset='UTF-8'> <!-- *********** -->

      <input type='hidden' name='submitted' id='submitted' value='1'/>

      <div class='container'>
        <label for='email' >Email Address*:</label><br/>
        <input type='text' name='email' id='email' value='' maxlength="50" /><br/>
        <span id='contactus_email_errorloc' class='error'></span>
      </div>
  
      <div class='container'>
          <input type='submit' name='Submit' value='Submit' />
      </div>
      
    </form>

  </div>

</div>

<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

// Perform javascript input validation here.

//    var frmvalidator  = new Validator("contactus");
//    frmvalidator.EnableOnPageErrorDisplay();
//    frmvalidator.EnableMsgsTogether();

//    frmvalidator.addValidation("email","req","Please provide your email address");

    document.forms['contactus'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formContainer');
        var innerdiv = document.getElementById('fg_form_InnerContainer');
        var b = innerdiv.offsetHeight+40+30;

        formpopup.style.height = b+"px";
    }

    document.forms['contactus'].form_val_onsubmit = document.forms['contactus'].onsubmit;


    document.forms['contactus'].onsubmit=function()
    {
        if(!this.form_val_onsubmit())
        {
            this.refresh_container();
            return false;
        }

        return true;
    }

// ]]>
</script>

<div id='fg_backgroundpopup'></div>

<div id='fg_submit_success_message'> <!-- Unused -->
    <h2>Thanks!</h2>
    <p>Thanks for contacting us. We will get in touch with you soon!<p>
    <a href="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');">Close this window</a>
    <p></p>
</div>
