<?php

class SSFBoilerPlate {

  public static function head($title) {
    $indent .= '  ';
    $headString .= '';
//    $headString .= $indent . "<meta charset='utf-8'>" . PHP_EOL; // for HTML5
    $headString .= $indent . "<meta http-equiv='content-type' content='text/html; charset=iso-8859-1'>" . PHP_EOL; // for HTML4
    $headString .= $indent . "<base href='http://sanssoucifest.org/'>" . PHP_EOL;
    $headString .= $indent . "<title>Sans Souci Festival - " . $title . "</title>" . PHP_EOL;
    $headString .= $indent . "<meta name='robots' content='noarchive, noindex, nofollow'>" . PHP_EOL;
    $headString .= $indent . "<meta http-equiv='Pragma' content='no-cache'>" . PHP_EOL;
    $headString .= $indent . "<meta http-equiv='Expires' content='-1'>" . PHP_EOL;
    $headString .= $indent . "<meta name='description' content='A niche film festival specializing in dance cinema, incorporating live performance, and including museum installations.'>" . PHP_EOL;
    $headString .= $indent . "<meta name='keywords' content='dance film festival, dance video festival, video dance festival, dance cinema festival, screen dance, screendance, live performance, dance performance, live dance performance, dance festival, video dance, dance video, dance film, dance cinema, dance, film, video, cinema, festival, art, arts, artists, projection, projected, tour, touring'>" . PHP_EOL;
    $headString .= $indent . "<link rel='stylesheet' href='sanssouci.css' type='text/css'>" . PHP_EOL;
    $headString .= $indent . "<link rel='stylesheet' href='sanssouciBlackBackground.css' type='text/css'>" . PHP_EOL;
    return $headString;
  }
 
  public static function preContentBody($headline, $file) {
    $filePathArray = explode('/', $file);
    $loopIndex = 0;
    foreach ($filePathArray as $element) { 
      $loopIndex++;
      if ($element == 'sanssoucifest.org') { break; } 
    }
    $codeBase .= "";
    for ($i .= ($loopIndex+1); $i <= (sizeof($filePathArray)-1); $i++) { $codeBase .= '../'; }
    include_once $codeBase . "bin/utilities/autoloadClasses.php";

    $indent .= '';
    $preContentString .= '';
    $preContentString .= $indent . '<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">' .PHP_EOL;
    $preContentString .= $indent . '  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000"> <!-- body bgcolor=#FFFFFF makes the edges of this table appear white. -->' . PHP_EOL;
    $preContentString .= $indent . '    <tr>' . PHP_EOL;
    $preContentString .= $indent . '      <td align="left" valign="top">' . PHP_EOL;
    $preContentString .= $indent . '        <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">' . PHP_EOL;
    $preContentString .= $indent . '          <tr>' . PHP_EOL;
    $preContentString .= $indent . '            <td colspan="3" align="left" valign="top"><a href="index.php"><img src="images/titleBarGrayLight.gif" alt="SansSouciFest.org" width="600" height="63" hspace="0" vspace="8" border="0" align="top"></a></td>' . PHP_EOL;
    $preContentString .= $indent . '            <td width="10" align="center" valign="top">&nbsp;</td>' . PHP_EOL;
    $preContentString .= $indent . '          </tr>' . PHP_EOL;
    $preContentString .= $indent . '          <tr>' . PHP_EOL;
    $preContentString .= $indent . '            <td width="10" align="center" valign="top">&nbsp;</td>' . PHP_EOL;
    $preContentString .= $indent . '            <td width="125" align="center" valign="top">' . PHP_EOL;
    $preContentString .= $indent . SSFWebPageAssets::getNavBar();
    $preContentString .= $indent . '            </td>' . PHP_EOL;
    $preContentString .= $indent . '            <td width="600" align="center" valign="top">' . PHP_EOL;
    $preContentString .= $indent . '              <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">' . PHP_EOL;
    $preContentString .= $indent . '                <tr>' . PHP_EOL;
    $preContentString .= $indent . '                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>' . PHP_EOL;
    $preContentString .= $indent . '                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>' . PHP_EOL;
    $preContentString .= $indent . '                  <td width="530" align="center" valign="top" class="bodyTextGrayLight">' . PHP_EOL;
    $preContentString .= $indent . '                    <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">' . PHP_EOL;
    $preContentString .= $indent . '                      <tr>' . PHP_EOL;
    $preContentString .= $indent . '                        <td align="left" valign="top" class="programPageTitleText" style="padding-top:12px;">About Us</td>' . PHP_EOL;
    $preContentString .= $indent . '                      </tr>' . PHP_EOL;
    $preContentString .= $indent . '                      <tr>' . PHP_EOL;
    $preContentString .= $indent . '                        <td align="left" valign="top" class="bodyTextLeadedOnBlack" style="margin-bottom:24px;padding:0 20px 0 20px;">' . PHP_EOL;
    return $preContentString;
  }

  public static function postContentBody() {
    $indent .= '';
    $postContentString .= '';
    $postContentString .= $indent . '                        </td>' . PHP_EOL;
//    $postContentString .= $indent . '            					<img src="images/dotClear.gif" alt="" width="1" height="24" hspace="0" vspace="0" border="0" align="middle"></td>' . PHP_EOL;
    $postContentString .= $indent . '                      </tr>' . PHP_EOL;
    $postContentString .= $indent . '                    </table>' . PHP_EOL;
    $postContentString .= $indent . '                  </td>' . PHP_EOL;
    $postContentString .= $indent . '                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '                </tr>' . PHP_EOL;
    $postContentString .= $indent . '              </table>' . PHP_EOL;
    $postContentString .= $indent . '            </td>' . PHP_EOL;
    $postContentString .= $indent . '            <td width="10" align="center" valign="top">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '          </tr>' . PHP_EOL;
    $postContentString .= $indent . '          <tr align="center" valign="top">' . PHP_EOL;
    $postContentString .= $indent . '            <td colspan="2">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '            <td align="center" valign="bottom" class="smallBodyTextLeadedGrayLight"><br>' . PHP_EOL;
    $postContentString .= $indent . SSFWebPageAssets::getCopyrightLine();
    $postContentString .= $indent . '            </td>' . PHP_EOL;
    $postContentString .= $indent . '            <td width="10">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '          </tr>' . PHP_EOL;
    $postContentString .= $indent . '          <tr align="center" valign="top">' . PHP_EOL;
    $postContentString .= $indent . '            <td colspan="4">&nbsp;</td>' . PHP_EOL;
    $postContentString .= $indent . '          </tr>' . PHP_EOL;
    $postContentString .= $indent . '        </table>' . PHP_EOL;
    $postContentString .= $indent . '      </td>' . PHP_EOL;
    $postContentString .= $indent . '    </tr>' . PHP_EOL;
    $postContentString .= $indent . '  </table>' . PHP_EOL;
    $postContentString .= $indent . '</body>' . PHP_EOL;
    return $postContentString;
  }

}

?>
