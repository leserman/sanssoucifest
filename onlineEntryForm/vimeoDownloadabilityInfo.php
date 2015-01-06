<?php 
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <!-- <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> -->
  <title>Vimeo Downloadability</title>
  <link rel="stylesheet" href="../sanssouci.css" type="text/css">
  <link rel="stylesheet" href="../sanssouciBlackBackground.css" type="text/css">
  <style type="text/css">
/*      color: Khaki; */
    div.howTo, ol.howTo {
      /* margin:3px 20px 12px -6px; */
      font-family: Arial, Helvetica, sans-serif;
      font-size: 15px;
      font-weight: normal;
      line-height: 19px;
    	color: #FFFFCC;
    	text-align: left;
    }
    li.howTo {
      margin:0px 20px 10px -4px;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 15px;
      font-weight: normal;
      line-height: 19px;
    	color: #FFFFCC;
    	text-align: left;
    }
  </style>
</head>
<body bgcolor="#FFFFFF" text="#000000" link="#0033FF" vlink="#0033FF" alink="#990000">
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
            <td width="125" align="center" valign="top"><?php SSFWebPageAssets::displayNavBar(SSFCodeBase::string(__FILE__)); ?></td>
            <td align="center" valign="top">
              <table align="center" cellpadding="0" cellspacing="0" bgcolor="#000000">
                <tr>
                  <td width="25" align="left" valign="top" class="sprocketHoles">&nbsp;</td>
                  <td width="10" align="left" valign="top" class="programTablePageBackground">&nbsp;</td>
                  <td width="530" align="center" valign="top" class="bodyTextGrayLight">
                    <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#333333">
                      <tr>
                        <td align="left" valign="top" class="programPageTitleText" style="padding-top:12px;">How to make your Vimeo video <i>downloadable</i></td>
                		  </tr>
                      <tr>
                        <td align="left" valign="top" style="padding:20px 20px 30px 20px;">
                          <div class="howTo">Follow these steps to make your video <i>downloadable</i>. <!-- <br>
                            <span style="font-size:12px;">(These instructions presume that you are using the vimeo website that is <b>&quot;new&quot;</b> as of May 2012 in the US.<br>
                              <a href="./vimeoInfo1.php">If you are using the <b>&quot;old&quot;</b> website follow these steps</a> instead.)</span> -->
                            <ol class="howTo">
                              <li class="howTo">Login to <a href="http://vimeo.com">Vimeo</a> and select <span style="color:#9addfd";><b>Videos</b></span> from the menubar.<br>
                                <img src="../images/vimeo/vimeoSpanshot-Videos.png" style="width:507px;height:71px;margin:12px 0 6px 0;">
                              </li>
                              <li class="howTo" style="margin-bottom:18px;">Locate the video of interest and click on the <span style="color:#9addfd";><b>Settings</b></span> gear in the upper right corner of that video's screen image.<br>
                                <img src="../images/vimeo/vimeoSpanshot-VideoSettings.png" style="width:351px;height:222px;margin:12px 0 6px 0;"><br>
                                This will load the Basic Settings page for the video of interest.</li>
                              <li class="howTo" style="margin-bottom:18px;">Click on <span style="color:#9addfd";><b>Privacy</b></span> in the menubar of the Basic Settings page.<br><img src="../images/vimeo/vimeoSpanshot-BasicSettings.png" style="width:569px;height:226px;margin:12px 0 6px 0;"><br>This will take you to the Basic Settings/Privacy page pictured below.</li>
                              <li class="howTo">On the Settings/Privacy page, check the <span style="color:#9addfd";><b>Download the video</b></span> checkbox. This item is at the bottom of the page in the <b>"What other people can do with this video?"</b> section as shown in the image below.
                                <img src="../images/vimeo/vimeoSpanshot-PrivacySettings.png" style="width:598px;height:813px;margin:12px 0 6px 0;"></li>
                              <li class="howTo">Click <span style="color:#9addfd";><b>Save changes</b></span>.</li>
                            </ol>
                            These steps will work whether your video allows <b>Anyone</b> or <b>Only people with a password</b> to watch it.
                          </div>
                        </td>
                      </tr>
                    </table>			
  	             </td>
                  <td align="center" valign="top" style="background-color:#333;padding-bottom:12px;">
                    <div style="background-color:#333333;text-align:center;float:none;">
                    </div>
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
</html>