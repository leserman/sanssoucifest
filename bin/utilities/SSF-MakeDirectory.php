<html>
<head>
<title>SSF-MakeDirectory</title>
</head>
<body>
<!-- NOTES:

     To be useful, this file belongs in the /Users/<username>/Sites folder on the Mac. Change to the proper username.
     See http://coolestguyplanettech.com/downtown/install-and-configure-apache-mysql-php-and-phpmyadmin-osx-108-mountain-lion
     and http://stackoverflow.com/questions/5246114/php-mkdir-permission-denied-problem for configuring the Mac.
-->

<?php
  $showDiagnostics = false;
  $rootForMovies = '/Volumes/Drobo/Sans Souci Movie Files/SSF 2012 onward Videos/SSF 2013 Vimeo Download/';
  $rootForStills = '/Users/david/Projects/SansSouciDataFiles/_Sans Souci 2013/_PR Photos + Screen Shots 2013/';

  $tracebackColor = 'pink';
  $echoColor = '#CCFFFF';

  if ($showDiagnostics) belch('1', $_GET);
  $dirName = (isset($_GET['dirName'])) ? $_GET['dirName'] : 'dirNameNotSet';
  if ($showDiagnostics) echo '<h2>New directory name is ' . $dirName . '</h2>';
  makeDirectory($rootForMovies, $dirName);
  makeDirectory($rootForStills, $dirName);

// -----------------------------------------------

  function echoVisible($text) {
    echo '<span style="color:' . $echoColor . ';">' . $text . '</span>' . "<br>\r\n";
  }
  
  function belch($idString, $dataStructure) { 
    echoVisible("** BELCH ** " . $idString . ": " . "<span style='color:" . $tracebackColor . ";'>" . print_r($dataStructure, true) . "</span>"); 
    return $belch;
  }
  
  function makeDirectory($path, $newDirName) {
    global $showDiagnostics;
    $filename = $path . $newDirName;
    ini_set('memory_limit', '-1');
    echo 'Creating directory ' . $newDirName . ' in<br>' . $path . '<br><br>';
    if ($showDiagnostics) echo '<h3>Creating ' . $filename . '</h3>';
    mkdir($filename, 0777);
    if ($showDiagnostics) echo '<h3>Setting permissions for ' . $filename . '</h3>';
    chmod($filename, 0755);
  }
?>
</body>
</html>

