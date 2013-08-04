// plugins.js from http://www.javascriptkit.com/script/script2/plugins.js
// Also see http://www.oreillynet.com/pub/a/javascript/2001/07/20/plugin_detection.html

// This script detects the following:
//   Flash
//   Windows Media Player
//   Java
//   Shockwave
//   RealPlayer
//   QuickTime
//   Acrobat Reader
//   SVG Viewer

var agt = navigator.userAgent.toLowerCase();
var ie  = (agt.indexOf("msie") != -1);
var ns  = (navigator.appName.indexOf("Netscape") != -1);
var win = ((agt.indexOf("win")!=-1) || (agt.indexOf("32bit")!=-1));
var mac = (agt.indexOf("mac")!=-1);
var pluginlist = "";

function detectIE(ClassID,name) { 
  var result = false; 
  // execute the VBScript to compute result
  document.write('<SCRIPT LANGUAGE=VBScript>\n on error resume next \n result = IsObject(CreateObject("' + ClassID + '"))</SCRIPT>\n'); 
  if (result) { return name+','; } else { return ''; }
}

function detectNS(ClassID,name,nse) { 
  var n = ""; 
  if (nse.indexOf(ClassID) != -1) { if (navigator.mimeTypes[ClassID].enabledPlugin !== null) { n = name+","; } }
  return n; 
}

if (ie && win) {
  pluginlist = detectIE("Adobe.SVGCtl","SVG Viewer") + 
               detectIE("SWCtl.SWCtl.1","Shockwave Director") + 
               detectIE("ShockwaveFlash.ShockwaveFlash.1","Shockwave Flash") + 
               detectIE("rmocx.RealPlayer G2 Control.1","RealPlayer") + 
               detectIE("QuickTimeCheckObject.QuickTimeCheck.1","QuickTime") + 
               detectIE("MediaPlayer.MediaPlayer.1","Windows Media Player") + 
               detectIE("PDF.PdfCtrl.5","Acrobat Reader");
}
if (ns || !win) {
    var nse = "";
    for (var i=0;i<navigator.mimeTypes.length;i++) { nse += navigator.mimeTypes[i].type.toLowerCase(); }
    pluginlist = detectNS("image/svg-xml","SVG Viewer",nse) + 
                 detectNS("application/x-director","Shockwave Director",nse) + 
                 detectNS("application/x-shockwave-flash","Shockwave Flash",nse) + 
                 detectNS("audio/x-pn-realaudio-plugin","RealPlayer",nse) + 
                 detectNS("video/quicktime","QuickTime",nse) + 
                 detectNS("application/x-mplayer2","Windows Media Player",nse) + 
                 detectNS("application/pdf","Acrobat Reader",nse);
}

pluginlist += navigator.javaEnabled() ? "Java," : "";
if (pluginlist.length > 0) { pluginlist = pluginlist.substring(0,pluginlist.length-1); }

//SAMPLE USAGE- detect "Flash"
//if (pluginlist.indexOf("Flash")!=-1)
//document.write("You have flash installed")

// To display mimeTypes
   // <html>
   // <body>
   // <script type="text/javascript">
   // var browser=navigator.appName;
   // var b_version=navigator.appVersion;
   // var version=parseFloat(b_version);
   // var bMimeTypes = navigator.mimeTypes;
   // document.write("Browser name: "+ browser + "<br />");
   // document.write("Browser version: "+ version + "<br />");
   // document.write("Browser mimetypes: "+ bMimeTypes + "<br />");
   // for (var i=0;i<bMimeTypes.length;i++) { document.write( navigator.mimeTypes[i].type.toLowerCase() + "<br>"); }
   // </script>
   // </body>
   // </html>

