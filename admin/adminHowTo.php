<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <title>SSF - Admin How To</title>
  <!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> Not using base becauce it's not portable to hosting on home computer. -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <style type="text/css">
    .zero {
      margin:0px 20px 10px 16px;
      padding: 0;
      line-height: 19px;
    }
    .howToTitle {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 16px;
      line-height: 20px;
      text-align: left;
      padding: 0 0 0 1em;
/*      text-indent: -1.4em; */
      font-weight: 500;
      font-style: normal;
      margin:30px 10px 0px 0px;
      color: Khaki;
    }
    ol.howTo {
      /* margin:3px 20px 12px -6px; */
    }
    ol.howToSub {
      list-style-type:lower-alpha;
    }
    li.howTo {
      margin:0px 20px 10px -4px;
      padding: 0;
      line-height: 19px;
    }
    li.howToIndex {
      font-size: 14px;
      margin:0px 0px 0px -4px;
      padding: 0;
      line-height: 17px;
    }
    li.howToSub {
      margin:0px 20px 6px -4px;
      padding: 0;
      line-height: 19px;
    }
  </style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
<script type="text/javascript">
  function setCache(id, priorValue) {
    newValue = 1;
    if (priorValue == 1) { newValue = 0; }
    //alert('setCache(' + id + ') called with prior value = ' + priorValue + '.');
    if (id == 'showPromised') { document.getElementById('showPromisedCache').value = newValue; } 
    else if (id == 'showReceived') { document.getElementById('showReceivedCache').value = newValue; } 
    else { alert('ERROR: setCache(' + id + ')'); }
  }
</script>
<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img 
              src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayAdminNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td align="center" valign="top" width="530" style="background-color:#333;padding-bottom:12px;">
                    <div style="background-color:#333333;text-align:left;float:none;">
                      <div class="programPageTitleText" style="float:none;padding-top:12px;padding-left:8px;text-align:left;">Administrator How-To's</div>
                      <div class="bodyTextLeadedOnBlack" style="margin:10px;align:left;">
                      
<!-- index -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="index"></a>How-to Index
                        <ul class="howTo">
<li class="howToIndex"><a href="#createPrintedProgram">Create the Printed Program</a></li>
<li class="howToIndex"><a href="#editShowOrder">Create/Edit Show Order</a></li>
<li class="howToIndex"><a href="#addAnEvent">Create/Add an Event</a></li>
<li class="howToIndex"><a href="#addAVenue">Create/Add a Venue</a></li>
<li class="howToIndex"><a href="#addAShow">Create/Add a Show</a></li>
<li class="howToIndex"><a href="#addACall">Create/Add a Call For Entries</a></li>
<li class="howToIndex"><a href="#usePhyMyAdmin">Use phpMyAdmin</a></li>
                        </ul>
                        </div>

                      
<!-- createPrintedProgram -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="createPrintedProgram"></a>How to create the Printed Program. (How to generate and use the XML input for InDesign program.)</div>
                        <ol class="howTo">
<li class="howTo">Create a folder (directory) for the print program. For example, for 2012, the newly created folder is named &quot;_printProgram 2012&quot; and is located inside of the folder &quot;SansSouciDataFiles/_Sans Souci 2012&quot;.
<li class="howTo"><a href="http://sanssoucifest.org/admin/generateProgramText/generateProgramText2012.php" target=_blank>Generate</a> the program text,
  copy the text generated, paste it into a plain text file (possibly using TextEdit), and save the file in the folder you just created. For example, in 2012, the file is saved in the folder &quot;_printProgram 2012&quot; as &quot;2012programText.xml&quot;.
<li class="howTo">In this same folder, create another folder named &quot;images&quot;. In the images folder include each image
that will be in the printed program scaled to 1.25" wide at 300 DPI. The image names must be the designated file / image name for the associated film
with .jpg suffix, e.g., "12-067-Desatada-MartaRenzi.jpg".
<li class="howTo">In InDesign.
                        <ol class="howToSub">
<li class="howToSub">Open the InDesign template.</li>
<li class="howToSub">If a structure already exists, delete it (except for one initial Work item from which to clone).</li>
<li class="howToSub">File &gt; Import XML (with Merge, not Append) and select the file 2010programText.xml (or whatever) being careful 
to place it AFTER the initial Work item. When prompted for the Image Options, enter them as in the image below.<br><img src="../images/InDesignImportOptions.png"><br>
When you do this, the text should appear in the pages. If it doesn't, drag the program
from the Structure pane to the beginning location in the page layout.</li>
<li class="howToSub">You can affect the overall layout by modifying the paragraph style options for the styles with tag definitions 
Caption, FilmContent, FilmHeadline, Intermission, PageTitle, SectionTitle, Synopsis, and SpaceAfterWork and the character style options
for the styles with tag definitions FilmTitle and FilmTitleInSynopsis.</li>
<li class="howToSub">Add captions by hand.</li>
<li class="howToSub">Apply the styles Caption, FilmTitleInSynopsis, and Intermission to appropriate elements by hand.</li>
<li class="howToSub">Insert Pauses, Intermissions, and Section Titles and paginate by hand.</li>
                        </ol>   
                        </ol>   

<!-- editShowOrder -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="editShowOrder"></a>How to edit Show Order.</div>
                        <ol class="howTo">
<li class="howTo">Click Manage Shows in the Admin NavBar.</li>
<li class="howTo">Select the event of interest. For instance, for the Atlas 2010 event, select Event 11.</li>
<li class="howTo">Select the Show of interest to edit. For the Atlas 2010 event, shows are sorted by start time, installations last.</li>
<li class="howTo">Copy the list of Work Ids from the Setup text box into a text editor - TextEdit or Word or whatever.</li>
<li class="howTo">Reorder them as you see fit in that text editor. You may also add or delete. (If you delete, with the intention of moving that work to a different show, be sure to make a note of that id. If you do lose an id, you can find it again on the Admin Curate page.) Do not include the same work twice in a show! Once you're satisfied with the order then copy the list back into the text box.</li>
<li class="howTo">Click Submit Works to institute the new show order.</li>
                        </ol>   

<!-- addAShow -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="addAShow"></a>How to add a Show.</div>
                        <div class="zero">There is no custom user interface for this, so it needs to be done via SQL or the <a href="#usePhyMyAdmin">phpMyAdmin interface</a>.</div>
                        <ol class="howTo">
<li class="howTo">Verify that the appropriate Event exists or create a new Event. Note the eventId.</li>
<li class="howTo">Verify that the appropriate Contact Person exists or create such a person in the people table. Note the personId.</li>
<li class="howTo">Add a row to the shows table.</li>
                        <ol class="howToSub">
<li class="howToSub">Do NOT specify a showId - leave the field blank.</li>
<li class="howToSub">Use the noted eventId in the event column.</li>
<li class="howToSub">Use the noted personId in the contactPerson column.</li>
<li class="howToSub">Use a very short description for the shortDescription column, e.g., &quot;Saturday documentary&quot;. This will appear in the index line(s) for the event described on the associated program page of the web site.</li>
<li class="howToSub">Use a description that includes time and location information in the description column, e.g., &quot;Documentary screening, Saturday, April 5, 2008, 5 pm&quot;. This will appear in the heading for the show for the event described on the associated program page of the web site.</li>
<li class="howToSub">Use a very short description for location and year, like the event table note, for the notes field, e.g,. &quot;Dairy 2009&quot;.</li>
                        </ol>   
                        </ol>   

<!-- addACall -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="addACall"></a>How to add a Call for Entries.</div>
                        <div class="zero">There is no custom user interface for this, so it needs to be done via SQL or the <a href="#usePhyMyAdmin">phpMyAdmin interface</a>.
                          You will work with the callsForEntries table in the sanssouci database. Open two phpMyAdmin windows: one for viewing a template and one for entering new data.</div>
                        <ol class="howTo">
<li class="howTo">Note the eventId of the event for which this Call is soliciting entries. If you are creating this Call, you probably just created that row in the events table.</li>
<li class="howTo">Pick a template row to work from:</li>
                        <ol class="howToSub">
<li class="howToSub">For a full Call For Entries, choose, for instance, callId 11 named Boulder2011.</li>
<li class="howToSub">For a minor Call for Invited Works only, choose, for instance, callId 10 named AtticRep2011.</li>
                        </ol>   
<li class="howTo">In side-by-side windows, open the template for editing (but you will NOT change it) in window 1 and Insert a new row in window 2.</li>
<li class="howTo">Working from the template as an example, insert a new row into the callForEntries table. For each column in the row, enter appropriate text - usually a modified or unmodified version of that same row in your template of choice.</li>
<li class="howTo" style="list-style-type:none;">Notes:</li>
                        <ol class="howTo">
<li class="howToSub" style="list-style-type:lower-alpha;">Do NOT specify a callId - leave the field blank! It will be automatically generated when you save the new row.</li>
<li class="howToSub" style="list-style-type:lower-alpha;">The associatedEvent is the eventId of the event that you noted in a prior step above.</li>
<li class="howToSub" style="list-style-type:lower-alpha;">Some text contains words in angle brackets like this: &lt;title&gt;. Sans Souci software will replace such strings with more meaningful contextual information, in this case, the title of a work being processed.</li>
<li class="howToSub" style="list-style-type:lower-alpha;">Text contents may also contain primitive HTML.</li>
                        </ol>   
                        </ol>   

<!-- addAnEvent -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="addAnEvent"></a>How to add an Event.</div>
                        <div class="zero">There is no custom user interface for this, so it needs to be done via SQL or the <a href="#usePhyMyAdmin">phpMyAdmin interface</a>.</div>
                        <ol class="howTo">
<li class="howTo">Verify that the appropriate Venue exists or create a new Venue. Note the venueId.</li>
<li class="howTo">Verify that the appropriate Contact Person exists or create a person in the people table. Note the personId.</li>
<li class="howTo">Add a row to the events table.</li>
                        <ol class="howToSub">
<li class="howToSub">Do NOT specify an eventId - leave the field blank.</li>
<li class="howToSub">Use the noted venueId in the venue column.</li>
<li class="howToSub">Set didOccur to 1 if the event already happened; otherwise, 0.</li>
<li class="howToSub">Set cancelled to 1 if the event was cancelled; otherwise, 0.</li>
<li class="howToSub">Use the noted personId in the contactPerson column.</li>
<li class="howToSub">Use a very short description for location and year for the notes field, e.g,. &quot;Dairy 2009&quot;.</li>
                        </ol>   
                        </ol>   

<!-- addAVenue -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="addAVenue"></a>How to add a Venue.</div>
                        <div class="zero">There is no custom user interface for this, so it needs to be done via SQL or the <a href="#usePhyMyAdmin">phpMyAdmin interface</a>.</div>
                        <ol class="howTo">
<li class="howTo">Verify that the appropriate contact people exist in the people table or create such new entries. Note the personIds.</li>
<li class="howTo">Add a row to the venues table.</li>
                        <ol class="howToSub">
<li class="howToSub">Do NOT specify a venueId - leave the field blank.</li>
<li class="howToSub">Use the noted personIds for contactPerson1 and contactPerson2.</li>
                        </ol>   
                        </ol>   

<!-- usePhyMyAdmin -->
                        <div class="howToTitle" sytle="margin:0;padding:0;"><a name="usePhyMyAdmin"></a>How to use the phpMyAdmin interface.</div>
<!--                        <div class="zero">To be written.</div> -->
                        <ol class="howTo">
<li class="howTo">Get a loginName and loginPassword from the webmaster/administrator.</li>
<li class="howTo">Login at <a href="http://www.sanssoucifest.org/dh_phpmyadmin/mysql.sanssoucifest.org/index.php?db=sanssouci">http://www.sanssoucifest.org/dh_phpmyadmin/mysql.sanssoucifest.org/index.php?db=sanssouci</a></li>
                        </ol>   

                        <div class="howToTitle">Much more to come...</div>
                      </div>
                    </div>
                  </td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom"><br>
            <?php SSFWebPageAssets::displayCopyrightLine();?></td>
            <td width="10">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="4">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
<!-- InstanceEnd --></html>