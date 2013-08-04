<?php
session_start();

// From http://www.webdeveloper.com/forum/showthread.php?t=77891
// Also see connectionSpeedTestResultsVerification.txt

print "Content-Type: " . $_SESSION['Content-Type'] . "<br>";
print $_SESSION['file_byte_size'].' bytes' . "<br>";
print "<b>" . $_SESSION['kbs'].' kbs' . "</b><br>";

print "Start Time: " . $_SESSION['start'] . "<br>";
print "End Time: " . $_SESSION['end'] . "<br>";

?> 
