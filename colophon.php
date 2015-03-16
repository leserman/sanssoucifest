<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

//  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
//  SSFWebPageParts::setHeaderTitleText('SSF :: Resources');  // This is the official HTML head title. It appears in the tab.
	/* These are the inline style definitions that override all other CCS for this page except for the built-in media queries. */
//	SSFWebPageParts::addCssInlineStyleDefinition('p { margin-top:14px; }');  

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
            </style>

            <h1 style="color:<?php echo $primaryTextColor; ?>"><?php echo $contentTitle; ?></h1>

            <section>
              <h2 style="color:<?php echo $secondaryTextColor; ?>">Our logo</h2>
              <p>Our logo is based on a photo of Loie Fuller in La danse blanche. </p>
              <p style="font-size:11px;margin-left:31px;"><img src="images/LoieFuller-LaDanseBlanche.jpg" style="width:384px;height:500px;" alt="Loie Fuller in La danse blanche"><br>Loie Fuller in La danse blanche. This image was found <a href="http://artsalive.ca/en/dan/meet/bios/artistDetail.asp?artistID=168">here</a> at <a href="http://artsalive.ca/en/">ArtsAlive.ca</a>, the Canadian National Arts Centre's performing arts educational website.</p>
              <p>Fuller became famous in the US for her 1891 <span style="font-style: italic;">serpentine dance</span> which was presented in an <a href="https://www.youtube.com/watch?v=fIrnFrDXjlk">1896 film by the Lumi&eacute;re brothers</a>. (<a href="https://www.youtube.com/watch?v=BZcbntA4bVY">more film here</a>) Although not the dancer in the film, Fuller's choreographic contribution was the foundation of one of the first ever dance films. We honor her here.</p>
              <p>Fuller's work featured not only dance, but elaborate silk costumes and innovative stage lighting of her own design, using gels of her own manufacture. She was a performance pioneer who, although born in the United States, spent most of her life living in Paris, hobnobbing with elite artists and intelligentsia. 
            </section>

            <section>
              <h2 style="color:<?php echo $secondaryTextColor; ?>">The background image</h2>
              <p>The background image of each web page is derived from the same photo.</p>
            </section>

            <section>
              <h2 style="color:<?php echo $secondaryTextColor; ?>">The banner font</h2>
              <p>The banner font is <a href="http://www.identifont.com/similar?1V4">Bradley Hand ITC</a>.</p>
            </section>

          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>

