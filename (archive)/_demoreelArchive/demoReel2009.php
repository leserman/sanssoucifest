<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/program.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta name="description" content="A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.">
  <meta name="keywords" content="dance film festival, dance video festival, video dance festival, dance cinema festival, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring"><!-- InstanceBeginEditable name="doctitle" -->
<title>Sans Souci Festival of Dance Cinema - Demo Reel (2009)</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script language="JavaScript" type="text/JavaScript" src="../scripts/plugins.js"></script>
<!-- InstanceEndEditable --><!-- <base href="http://www.sansoucifest.org/"> -->
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
  <!-- Set bgcolor="#FFFFFF" in the following 100% table to make the edges appear white. -->
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
    <tr>
      <td align="left" valign="top">
        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
          <tr>
            <td colspan="3" align="left" valign="top"><a href="../index.php"><img src="../images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td width="10" align="center" valign="top">&nbsp;</td>
            <td width="125" align="center" valign="top">
            <?php
              $filePathArray = explode('/', __FILE__);
              $loopIndex = 0;
              foreach ($filePathArray as $element) { 
                $loopIndex++;
                if ($element == 'sanssoucifest.org') { break; } 
              }
              $codeBase = "";
              for ($i = ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
              include_once $codeBase . "bin/utilities/autoloadClasses.php";
              SSFWebPageAssets::displayNavBar();
            ?></td>
            <td width="600" align="center" valign="top">
              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  	<td width="530" align="center" valign="top" class="bodyTextGrayLight"><!-- InstanceBeginEditable name="ProgramRegion" -->
      
   <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
      <tr>
        <td align="left" valign="top" class="programPageTitleText" style="padding-top:12px;color:#999999">Demo Reel <span style="font-size:15px;">(2009)</span></td>
      </tr>
      <tr>
        <td align="center" valign="top">
          <div style="width:480px;background-color:#000000;margin:45px auto 40px auto;padding-right:10px;border:solid #333333 1px;">
            <div style="margin:30px auto 30px auto;padding:0 0 0 0;">
<!--                
              <script type='text/javascript'>
                document.write("ABC");
              </script>
-->
              <script type='text/javascript'>

                function embedQT(width, height, path) {
                  var QTStr;
                  QTStr = "<OBJECT classid='clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B'" +
                          " codebase='http://www.apple.com/qtactivex/qtplugin.cab'" +
                          " height='" + height + "' width='" + width + "'>\n";
                  QTStr += "<PARAM NAME='src' VALUE='" + path + "'>\n";
                  QTStr += "<PARAM NAME='autoplay' VALUE='true'>\n";
                  QTStr += "<PARAM NAME='type' VALUE='video/quicktime'>\n";
                  QTStr += "<EMBED src='" + path + "' height='" + height + "' width='"  + width + "'" +
                          " target='myself' controller='false' autoplay='true' kioskmode='true' bgcolor='black' cache='true'" +
                          " type='video/quicktime' pluginspage='http://www.apple.com/quicktime/download/'>" +
                          "<\/EMBED>\n";
                  QTStr += "<\/OBJECT>";
                  return QTStr;
                }
                
                function embedWM(width, height, path) {
                  var WMStr;
                  WMStr = "<OBJECT id='VIDEO' width='" + width + "' height='" + (height + 45) +
                          "'  CLASSID='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6' type='application/x-oleobject'>";  
                  WMStr += "<PARAM NAME='URL' VALUE='" + path + "'>";
                  WMStr += "<PARAM NAME='SendPlayStateChangeEvents' VALUE='True'>";
                  WMStr += "<PARAM NAME='AutoStart' VALUE='True'>";
                  WMStr += "<PARAM name='uiMode' value='full'>";
                  WMStr += "<PARAM name='PlayCount' value='9999'>";
                  WMStr += "<EMBED TYPE='application/x-mplayer2' SRC='" + path + "' NAME='MediaPlayer' WIDTH='" + width +
                          "' HEIGHT='" + (height + 45) + "' ShowControls='1' ShowStatusBar='1' ShowDisplay='1' autostart='1'>" +
                          "<\/EMBED>\n";
                  WMStr += "<\/OBJECT>";
                  return WMStr;
                }
                
                var width, height, qtPath, wmPath, formatAdvisory, movieStr;
                formatAdvisory = "";
                movieStr = 'Dude!';
                // width = <?php echo $vWidth; ?>;
                // height = <?php echo $vHeight; ?>;
                // qtPath = "<?php echo $qtPath; ?>";
                // wmPath = "<?php echo $wmPath; ?>";
                
                //select the right movie file
                // pluginlist.indexOf() returns a valid index or -1 if not found
                if (pluginlist.indexOf('QuickTime') !=- 1) { // Found Quicktime Plugin.
//                  movieStr = embedQT(320, 240, "SSF-QuickReel200908-04-DL-MP4-300K.mp4");
                  movieStr = embedQT(320, 240, "SSF-QuickReel200908-04-DL-H264-300K.mov");
                } 
                else if (pluginlist.indexOf('Windows Media Player') !=-1 ) { // Found Windows Media Plugin.
                  // TODO: Replace SSF-QuickReel200908-04-DL-H264-300K.mov with  a file that works.
                  movieStr = embedWM(320, 240, "SSF-QuickReel200908-04-DL-H264-300K.mov");
                  formatAdvisory = "For superior image quality, we recommend installing <a href='http://www.apple.com/quicktime/download/'>Quicktime Player<\/a>";
                } 
                else { // Found no media plugins.
                  // TODO: Replace SSF-QuickReel200908-04-DL-H264-300K.mov with  a file that works.
                  movieStr = embedQT(320, 240, "SSF-QuickReel200908-04-DL-H264-300K.mov");
                  formatAdvisory = "To play the demo, please download and install <a href='http://www.apple.com/quicktime/download/'>Quicktime Player<\/a>";
                }
                
                document.write(movieStr);
              </script>
            </div>
          </div>
          <div style="margin:0px 22px 20px 0;text-align:right;font-size:smaller;"><a href="index.php">play again</a></div>
        </td>
      </tr>
    </table>      
      
<!-- InstanceEndEditable --></td>
    <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
	  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
    
                </tr>
              </table>
            </td>
            <td width="10" align="center" valign="top">&nbsp;</td>
          </tr>
          <tr align="center" valign="top">
            <td colspan="2">&nbsp;</td>
            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>
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