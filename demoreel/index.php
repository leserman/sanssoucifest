<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  /* UPDATE THESE ITEMS */
/*
  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('Sample Reel');  // This is the official HTML head title. It appears in the tab.
*/
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
	SSFWebPageParts::addCssInlineStyleDefinition('.pageArea .contentArea { background-color:#000000; margin-left:10px; padding-left:80px;padding-right:80px;}');
  SSFWebPageParts::addCssInlineStyleDefinition('.contentArea article { width: 580px; }');
	 
  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
  
  $primaryTextColor = SSFWebPageParts::getPrimaryTextColor();
  $secondaryTextColor = SSFWebPageParts::getSecondaryTextColor();
  $tertiaryTextColor = SSFWebPageParts::getTertiaryTextColor();
  $quaternaryTextColor = SSFWebPageParts::getQuaternaryTextColor();
  $articleId = SSFWebPageParts::getArticleId();
  $contentTitle = SSFWebPageParts::getContentTitleText();

?>
          <article id="<?php echo $articleId; ?>">
            
            <style type="text/css" scoped>
              /* .pageArea .contentArea { background-color:#000000; margin-left:10px; padding-left:80px;padding-right:80px;} */
            </style>

            <h1 style="color:<?php echo SSFWebPageParts::getPrimaryTextColor(); ?>;margin-top:18px;margin-left:-10px;"><?php echo $contentTitle; ?></h1>

            <div style="width:500px;margin:70px auto 420px auto;padding-left:40px;padding-right:40px;">
              <div style="margin:30px auto 80px auto;padding:0 0 0 0px;">
                <iframe src="https://player.vimeo.com/video/115611799?title=1&amp;byline=0&amp;portrait=0" style="width:500px;height:281px;border:none;margin:0 auto;" allowfullscreen></iframe>
<!--
                <p class="centeredText" style="color:#666666;">2014</p>
      Vimeo
                <iframe src="https://player.vimeo.com/video/89757884?title=1&amp;byline=0&amp;portrait=0" style="width:500px;height:281px;border:none;margin:0 auto;" allowfullscreen></iframe>
                <p class="centeredText" style="color:#666666;">2013</p>
                <iframe src="https://player.vimeo.com/video/39229862?title=1&amp;byline=0&amp;portrait=0" style="width:500px;height:369px;border:none;margin:0 auto;" allowfullscreen></iframe>
                <p class="centeredText" style="color:#666666;">2011</p>
                <iframe src="https://player.vimeo.com/video/115833356?title=0&amp;byline=0&amp;portrait=0" style="width:500px;height:375px;border:none;margin:0 auto;" allowfullscreen></iframe>
                <p class="centeredText" style="color:#666666;">2009</p>
      YouTube
                <iframe width="420" height="284" src="http://www.youtube.com/embed/RNh8YZpQDI0?hl=en&amp;fs=1&amp;autohide=1" frameborder="0" allowfullscreen></iframe>
                <p class="centeredText" style="color:#666666;">2011</p>
                <iframe width="420" height="315" src="http://www.youtube.com/embed/WWSliiylOss" frameborder="0" allowfullscreen></iframe>
                <p class="centeredText" style="color:#666666;">2009</p>
-->
               </div>
            </div>

          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

