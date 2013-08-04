<html>
<body>
<?php
  include_once '../bin/classes/SSFCodeBase.php'; 
  include_once SSFCodeBase::autoloadClasses(__FILE__);

  require_once('../bin/classes/MadMimi.class.php');

  //helper method to print out the lists
  function print_lists($lists) {
    echo '<ul>' . "\n";
    foreach($lists->list as $list) {
      echo '  <li>' . $list['name'] . ' [#' . $list['id'] . '] (' . $list['subscriber_count'] . ')</li>' . "\n";
    }
    echo '</ul>' . "\n";
  }

  echo "Hello<br><br>";

  $madMimiAPI_KEY = 'fefc637b9cd69ab3423c8c156b9198ac';
  $madMimiEmailAddress = 'hamelb@sanssoucifest.org';
  $madMimi = new MadMimi($madMimiEmailAddress, $madMimiAPI_KEY); 

  $peopleEmail = array('connie@leserman.com', 'lee@leserman.com', 'david@leserman.com');

  foreach ($peopleEmail as $personEmail) {
    echo "Memberships: <br>";
    $response = $madMimi->Memberships($personEmail);
    $memberships = new SimpleXMLElement($response);
    print_lists($memberships);
    echo "<br><br>\r\n";
    SSFDebug::globaldebugger()->belch('$memberships', $memberships, -1);
    echo "<br><br>\r\n";
    
    $response = $madMimi->AddMembership('notifyOfCalls', $personEmail);
//    $memberAdded = new SimpleXMLElement($response);
    SSFDebug::globaldebugger()->belch('$response', ($response === false) ? 'FALSE' : '|' . $response . '|' , 1);
  }

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