<?php
// start session to save output
session_start();

// From http://www.webdeveloper.com/forum/showthread.php?t=77891
// Also see connectionSpeedTestResultsVerification.txt

// set variables
$test_file_path = '../../images/'; //fill in
//echo $test_file_path . "<br>\r\n";
$file_name = $_GET['test_file'];
//echo $file_name . "<br>\r\n";
$test_file = $test_file_path . $file_name;

//check file exists
if(!is_file($test_file)) exit('Image file doesn\'t exist');

//check mime type
if(!($test_file_info = getimagesize($test_file) and eregi('image/', $test_file_info['mime']))) exit('File is not an image.');

//check byte size
if(!($file_byte_size = filesize($test_file))) exit('Cannot read byte size.');

//echo "$file_byte_size = " . $file_byte_size . "<br>\r\n";

// read image file
if(!($test_file_contents = file_get_contents($test_file))) exit('Cannot open file to read.');

// force script to continue after output
ignore_user_abort(true);

// kill any buffering
ini_set('output_buffering', '0');
ini_set('implicit_flush', '1');

// send mime headers
$_SESSION['Content-Type'] = $test_file_info['mime'];
header('Content-Type: '.$test_file_info['mime']);
$_SESSION['file_byte_size'] = $file_byte_size;
header('Content_Length: '.$file_byte_size);

// start timer
$start = microtime(TRUE);

// send image data string to UA
print $test_file_contents;

// flush the data block
flush();

// stop timer
$end = microtime(TRUE);

$_SESSION['start'] = $start;
$_SESSION['end'] = $end;

// get elapsed time
//echo "\r\nCalling elapsed_time_in_milliseconds\r\n";
//print "\r\nCalling elapsed_time_in_milliseconds\r\n";
//$elapsed_time = elapsed_time_in_milliseconds($start, $end);
$elapsed_time = ($end - $start) * 1000;

// get kilobits/second speed and store it in the session array (bytes to bits = * 8)
$_SESSION['kbs'] = round(($file_byte_size / $elapsed_time) * 8);

//echo "</body></html>";

// maths for elapsed time
function elapsed_time_in_milliseconds($start, $end){
//echo "\r\nelapsed_time_in_milliseconds\r\n";
//print "\r\nelapsed_time_in_milliseconds\r\n";
    $start = explode(' ', $start);
    $start = $start[0] + $start[1];
    $end = explode(' ', $end);
    $end = $end[0] + $end[1];
//    return (round(($end - $start) * 1000));
    return (($end - $start) * 1024); 
}

?> 
