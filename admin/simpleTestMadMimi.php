<html>
<body bgcolor="#333" text="#CCC"></body>

<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  require_once('../bin/classes/MadMimi.class.php');
  
  $showDiagnostics = -1;

  //helper method to print out the lists
  function print_lists($lists) {
    echo '<ul>' . "\n";
    foreach($lists->list as $list) {
      echo '  <li>' . $list['name'] . ' [#' . $list['id'] . '] (' . $list['subscriber_count'] . ')</li>' . "\n";
    }
    echo '</ul>' . "\n";
  }

  $madMimiCSVKeys = array('personId', 
                          'fullName', 
                          'last_name', 
                          'first_name', 
                          'organization', 
                          'email', 
                          'notifyOf', 
                          'notifyOfEvents',
                          'notifyOfCalls', 
                          'tester', 
                          'role', 
                          'relationship', 
                          'recordType', 
                          'address', 
                          'city', 
                          'state', 
                          'zip', 
                          'country');

  $peopleForMadMimiQuery = "SELECT personId, name AS fullName, lastName AS last_name, nickName AS first_name, organization, email, notifyOf, "
                         . "(find_in_set('events',notifyOf) > 0) AS notifyOfEvents, (find_in_set('calls',notifyOf)> 0) as notifyOfCalls, "
                         . "(find_in_set('tester',relationship)> 0) AS tester, role, relationship, recordType, "
                         . "concat(streetAddr1,' ',streetAddr2) AS address, city, stateProvRegion AS state, zipPostalCode AS zip, country "
                         . "FROM people "
                         . "WHERE email IS NOT NULL AND email != '' AND notifyOf IS NOT NULL AND notifyOf != '' "
                                     . "AND lastName = 'Leserman' "
//                                     . "AND lastName = 'Leserman' AND nickName = 'David' "
                         . "ORDER BY personId";
  $peopleRows = SSFDB::getDB()->getArrayFromQuery($peopleForMadMimiQuery);
  $personCount = 0;

  echo "Hello<br><br>";

  $madMimiAPI_KEY = 'fefc637b9cd69ab3423c8c156b9198ac';
  $madMimiEmailAddress = 'hamelb@sanssoucifest.org';
  $madMimi = new MadMimi($madMimiEmailAddress, $madMimiAPI_KEY); 
  SSFDebug::globaldebugger()->belch('$madMimi', $madMimi, -1);
  
//  http://api.madmimi.com/audience_members/suppressed_since/1334255656.txt?show_suppression_reason=true&api_key=fefc637b9cd69ab3423c8c156b9198ac&username=hamelb@sanssoucifest.org
  
//  $threeYearsAgo = time() - (3 * 365 *24 * 60 * 60);
//  echo "threeYearsAgo = " . $threeYearsAgo . "<br><br>\r\n";

  $oneMonthAgo = time() - (29 * 24 * 60 * 60);
  echo "oneMonthAgo = " . $oneMonthAgo . "<br><br>\r\n";

  foreach ($peopleRows as $person) { 
    SSFDebug::globaldebugger()->belch('$person', $person, $showDiagnostics);
    foreach ($madMimiCSVKeys as $key) {
      $personForMadMimi[$key] = $person[$key];
    }
    $personCount += 1;
    $result = $madMimi->AddUser($person);
    SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);
    echo $personCount . '. (' . $person['personId'] . ') ' . $person['fullName'] . ', ' . $person['email'] . ' added ( ';

    if ($person['notifyOfEvents'] == 1) {
      $result = $madMimi->AddMembership('NotifyOfEvents', $person['email']);
      echo 'events ';
      SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);
    }
    
    if ($person['notifyOfCalls'] == 1) {
      $result = $madMimi->AddMembership('notifyOfCalls', $person['email']);
      echo 'calls ';
      SSFDebug::globaldebugger()->belch('$result', (($result === false) ? 'FALSE' : $result), $showDiagnostics);
    }
    
    echo ")<br>\r\n";
  }

  echo "<br><br>\r\n";
  echo "Lists: <br>";
  $response = $madMimi->Lists();
  $lists = new SimpleXMLElement($response);
  print_lists($lists);
  echo "<br><br>\r\n";
  SSFDebug::globaldebugger()->belch('$lists', $lists, -1);
  echo "<br><br>\r\n";
  
  echo "Goodbye<br><br>";
  
// Both these work in Chrone
// http://api.madmimi.com/audience_members/connie@leserman.com/lists.xml?api_key=fefc637b9cd69ab3423c8c156b9198ac&username=hamelb@sanssoucifest.org
// http://api.madmimi.com/audience_members/connie@leserman.com/lists.xml?username=hamelb%40sanssoucifest.org&api_key=fefc637b9cd69ab3423c8c156b9198ac

?>
</body>
</html>
