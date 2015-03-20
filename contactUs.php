<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS */
//  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
//  SSFWebPageParts::setHeaderTitleText('Contact Us');  // This is the official HTML head title. It appears in the tab.

	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
//	SSFWebPageParts::addCssInlineStyleDefinition('');

  $listManagementEmailAddress = SSFRunTimeValues::getListManagementEmailAddress();
  $emailAddr = SSFRunTimeValues::getContactEmailAddress();
  $both   = '?subject='  . str_replace(' ', '%20', 'Add me to your email list') 
          . '&amp;body=' . str_replace(' ', '%20', 'Add me to your email lists for both Calls for Entries and Festival Events.%0A%0AFirst name: %0ALast name: %0ACity, State, Country: %0AAnything else you\'d like us to know: %0A');
  $calls  = '?subject='  . str_replace(' ', '%20', 'Add me to your Call for Entries list')
          . '&amp;body=' . str_replace(' ', '%20', 'Add me to your email list for Calls for Entries.%0A%0AFirst name: %0ALast name: %0ACountry of residence: %0AAnything else you\'d like us to know: %0A'); 
  $event  = '?subject='  . str_replace(' ', '%20', 'Add me to your email list for Events.')
          . '&amp;body=' . str_replace(' ', '%20', 'Add me to your email list for Festival Events.%0A%0AFirst name: %0ALast name: %0ACity, State, Country: %0AAnything else you\'d like us to know: %0A');
  $remove = '?subject='  . str_replace(' ', '%20', 'Remove me from your email list(s)')
          . '&amp;body=' . str_replace(' ', '%20', 'Remove me from your email list(s).%0A%0AFirst name: %0ALast name:  %0AAnything else you\'d like us to know: %0A');
	 
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
  
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();

?>
          <article id="contactUs">
            <style type="text/css" scoped>
              .contentArea #contactUs h2 { font-size: 18px; font-weight: normal; font-style: italic;  line-height: 20px; }
              article p { margin-top:20px;font-size:16px;line-height:130%;color:<?php echo $secondaryTextColor; ?>; }
              article b { font-weight:bold; }
              div.transbox { background-color:white; border:none; opacity:0.75; filter:alpha(opacity=75); }
              div.transbox p { margin: 5%; color:black; }
            </style>
            <h1 class="primaryTextColor"><?php echo $contentTitle; ?></h1>
            <div class="centered centeredText" style="margin-top:30px;width:550px;border:0px dashed purple;">
    			    <img src="./images/TubBabe450x298.jpg" alt="Tub Babe" style="width:450px;height:298px;"><br><br>
<?php 
  echo '<p style="padding-top:10px;">Write to us at <a href="mailto:' . $emailAddr . '">' . $emailAddr . '</a>.</p><br>' . PHP_EOL; 
?>
              <section id="joinEmail">
                <h2 style="color:<?php echo $secondaryTextColor; ?>;text-align:left;font-size:22px;margin-top:20px;margin-bottom:12px;">Join an email list</h2>
                <div class="centered leftJustifiedText" style="width:460px;"> <!-- 3/9/15 Experimented with class transbox and abandoned it. -->
                  <p>Click one of the links below to manage a subscription to our email lists.</p>
                  <p style="margin-top:0px;margin-left:20px;line-height:150%;">
                    <a href="mailto:<?php echo $listManagementEmailAddress . $both; ?>">Add me to <b>both</b> your email lists.</a><br>                    
                    <a href="mailto:<?php echo $listManagementEmailAddress . $calls; ?>">Add me to your email list for <b>Calls for Entries</b> only.</a><br>
                    <a href="mailto:<?php echo $listManagementEmailAddress . $event; ?>">Add me to your email list for <b>Event Notifications</b> only.</a><br>
                    <a href="mailto:<?php echo $listManagementEmailAddress . $remove; ?>"><b>Remove me</b> from your email lists.</a></p>
                </div>
              </section>
            </div>
          </article>
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>
