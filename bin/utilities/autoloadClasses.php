<?php
  function __autoload($className) {
    $debug = false;
    $file = $className . '.php';

    $roots = array('bin', '../bin', '../../bin');
    $dirs = array('classes', 'database', 'forms', 'utilities');
    
    foreach ($dirs as $dir) {
      foreach ($roots as $root) {
        $path = $root . '/' . $dir . '/';
        $filename = $path . $file;
        if ($debug) echo '__autoload testing for ' . $filename . "<br>\r\n";
        if(file_exists($filename)) {
            require_once $filename;
            if ($debug) echo '__autoload loading ' . $filename . "<br>\r\n";
            return;
        }
      }
    }
  }
?>
