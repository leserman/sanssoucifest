<!DOCTYPE html>
<?php 
  include_once $_SERVER['DOCUMENT_ROOT'] . '/bin/classes/SSFWebPageParts.php'; 

  SSFWebPageParts::allowRobotIndexing();   // so google et al can find the page
  SSFWebPageParts::setHeaderTitleText('Filename Test');  // This is the official HTML head title. It appears in the tab.

  $url = $_SERVER['PHP_SELF'];
  $pathname = pathinfo($url);


  // Produce Top-of-Page boiler plate.
  SSFWebPageParts::beginPage();
?>

          <article id="fileAccessTest" style="width:650px;">
             
            <style type="text/css" scoped>
              .contentArea article h1 { margin-left:auto; margin-right:auto; text-align:center; }
              .contentArea #homePage h2 { margin:15px auto 6px auto; text-align:center; }
            </style>
            
            <div style="margin-top:0px;">
              <h1>Filename Access Test</h1>
            </div>

            <section>
              <h2 style="margin-top:28px;margin-bottom:15px;">Tests</h2>
<?php
        	SSFDebug::globalDebugger()->becho('$_SERVER["SCRIPT_FILENAME"]', $_SERVER['SCRIPT_FILENAME'], 1);
        	SSFDebug::globalDebugger()->becho('$_SERVER["PHP_SELF"]', $_SERVER['PHP_SELF'], 1);
        	SSFDebug::globalDebugger()->belch('pathinfo(_SERVER["PHP_SELF"])', pathinfo($_SERVER['PHP_SELF']), 1);
//        	SSFDebug::globalDebugger()->belch('pathinfo(_SERVER["PHP_SELF"])', pathinfo($_SERVER['PHP_SELF'], 1);
?>
            </section>

                        
          </article>
                      
<?php
  // Produce Bottom-of-Page boiler plate.
  SSFWebPageParts::endPage();
?>

</html>
