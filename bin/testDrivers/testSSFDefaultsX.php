<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Test SSFDefaults.php</title>
</head>
<?php

  include_once "../utilities/autoloadClasses.php";

  echo SSFDefaults::getDefaultCallForEntriesId() . '<br>' . "\r\n";
  echo SSFDefaults::getCurrentCallForEntriesId() . '<br>' . "\r\n";
  echo SSFDefaults::setCurrentCallForEntriesId(12) . '<br>' . "\r\n";
  echo SSFDefaults::getCurrentCallForEntriesId() . '<br>' . "\r\n";
  echo SSFDefaults::getPermissionAskMeString() . '<br>' . "\r\n";
  echo SSFDefaults::getPermissionAllOKString() . '<br>' . "\r\n";

  print_r(SSFDefaults::getFixedRoleConstants());
  echo '<br>' . "\r\n";
  
?>
<body>
</body>
</html>
