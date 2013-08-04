<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 TRANSITIONAL//EN">
<html>
	<head>
		<title>sprintf Format Tests</title>
	</head>
	<body>
<?php

  $stringFormat = "'%s'";
  $intFormat =  "%d";
  $dateStringFormatRaw =  "%4s-%'02s-%'02s";
  $dateStringFormat =  "'$dateStringFormatRaw'";
  $dateIntFormatRaw = "%04d-%02d-%02d";
  $dateIntFormat = "'$dateIntFormatRaw'";
  $datetimeStringFormat =  "'$dateStringFormatRaw %'02s:%'02s:%'02s'";
  $datetimeIntFormat = "'$dateIntFormatRaw %'02d:%'02d:%'02d'";
  $durationStringFormat =  "'%'02s:%'02s:%'02s'";
  $durationIntFormat = "'%02d:%02d:%02d'";
  $enumFormat =  "'%s'";
  //$setFormat =  "'$enumFormat . [, $enumFormat]*'";

  echo 'stringFormat:         ' . sprintf($stringFormat, 'Hi there.') . "<br>\r\n";
  echo 'intFormat:            ' . sprintf($intFormat, 27) . "<br>\r\n";
  echo 'dateStringFormat:     ' . sprintf($dateStringFormat, '2008', '10', '3') . "<br>\r\n";
  echo 'dateIntFormat:        ' . sprintf($dateIntFormat, 2008, 1, 30) . "<br>\r\n";
  echo 'datetimeStringFormat: ' . sprintf($datetimeStringFormat, '2008', '1', '3', '1', '9', '59') . "<br>\r\n";
  echo 'datetimeIntFormat:    ' . sprintf($datetimeIntFormat, '2008', '1', '3', '1', '9', '59') . "<br>\r\n";
  echo 'durationStringFormat: ' . sprintf($durationStringFormat, 1, 9, 59) . "<br>\r\n";
  echo 'durationIntFormat:    ' . sprintf($durationIntFormat, 1, 9, 59) . "<br>\r\n";
  echo 'enumFormat:           ' . sprintf($enumFormat, 'Hi there.') . "<br>\r\n";

?>

	</body>
</html>