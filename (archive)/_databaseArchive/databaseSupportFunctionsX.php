<!-- // databaseSupportFunctions.php -->

<?php

  // $duration is an array of durations in the form hh:mm:ss
  // returns the total of durations in the form  hh:mm:ss
  function totalRunTime($duration) { 
    $hoursTotal = 0;
    $minutesTotal = 0;
    $secondsTotal = 0;
    foreach ($duration as $runTimeString) {
      list($hours, $minutes, $seconds) = explode(":", $runTimeString);
      $hoursTotal += $hours;
      $minutesTotal += $minutes;
      $secondsTotal += $seconds;
    }
    $secondsModMinutes = $secondsTotal % 60;
    $minutesTotal += floor($secondsTotal / 60);
    $minutesModHours = $minutesTotal % 60;
    $hoursTotal += floor($minutesTotal / 60);
    $string = vsprintf("%.2u:%.2u:%.2s",array($hoursTotal,$minutesModHours,$secondsModMinutes));
    $string = str_replace("'", "", $string); // strip embedded single quotes
    return $string;
  }

  // Returns a mysql_fetch_array() of contributors (as designated by 'all', 'fixed', or 'optional').
  function selectContributors2($workId, $allFixedOptional) {
    $optionalString = '';
    if (($allFixedOptional) == 'all') $optionalString = '';
    else if (($allFixedOptional) == 'fixed') $optionalString = ' AND optionalContributor = 0';
    else if (($allFixedOptional) == 'optional') $optionalString = ' AND optionalContributor = 1';
    $selectContributorString = "SELECT work, contributorOrder, listingOrder, name, role FROM workContributors"
                             . " WHERE work = " . $workId . $optionalString 
                             . " ORDER BY listingOrder, contributorOrder";
    debugLogLine("selectContributorString = " . $selectContributorString);
    $contributorSelectResult = mysql_query($selectContributorString);
    debugLogLine("Select Query Finished -- result = " . $contributorSelectResult); 
    return $contributorSelectResult;
  }

  // TODO: this function does not belong in this file
  function acceptanceDisplayX($array) {
    $accepted = $array['accepted'];
    $rejected = $array['rejected'];
    if ($accepted && $rejected) $display = "ERROR Accepted and Rejected";
    else if (!$accepted && !$rejected) $display = "Undecided";
    else if ($accepted) $display = "ACCEPTED";
    else $display = "ReJeCtEd";
    return "<span style='color:#FFFF66;'>" . $display . "</span>";
  }
  
  function acceptanceDisplay($accepted, $rejected) {
    if ($accepted==1) $a = "<span style='color:#07EB01;'>&#8657;</span>"; else $a = "&#8657;";
    if ($rejected==1) $r = "<span style='color:#CE181F;'>&#8659;</span>"; else $r = "&#8659;";
    return "<span style='font-weight:bold;'>" . $a . "&nbsp;" . $r . "</span>";
  }
  
  function originalFormatDisplay($originalFormatString) {
    if ($originalFormatString == 'selectSomething') return '---'; else return $originalFormatString;
  }
  
  function clickableForDetailDisplay($workIdToDisplay, $clickableString) {
    return "<a href='#detail' onclick='selectEntry(" . $workIdToDisplay . ");'>" . $clickableString . "</a>";
  }

  function getDbScoreFor($workRow) {
    $avgScoreQueryString = "SELECT avg(score) from curation where entry=" . $workRow['workId'];
    debugLogLineQuery($avgScoreQueryString);
    $avgScoreQueryResult = mysql_query($avgScoreQueryString); 
    debugLogQuery($avgScoreQueryResult, $avgScoreQueryString);
    debugLogLine("Select Query Finished -- result = " . $avgScoreQueryResult); 
    if ($avgScoreQueryResult) {
      $avgScoreRow = mysql_fetch_array($avgScoreQueryResult);
      $avgScore = $avgScoreRow['avg(score)'];
      if ($avgScore == '') $avgScore = '---';
    } else {
      $avgScore = '---';
    }
    //    echo "avgScore=|" . $avgScore . "|<br>";
    //    "<a href='#detail' onclick='selectEntry(" .  . ");'><i>" 
    return $avgScore;
  }
  
  function entrySummaryDisplay($workRow) {
    $avgScore = getDbScoreFor($workRow);
    return "<i>" . clickableForDetailDisplay($workRow['workId'], $workRow['title']) . ",</i> \r\n      " 
          . $workRow['name'] . " (" . $workRow['city'] . ", " . $workRow['stateProvRegion'] . ", " . $workRow['country'] . ") [" 
          . "<span style='color:#b8ede0'>" . $workRow['submissionFormat'] . "</span> / " . originalFormatDisplay($workRow['originalFormat']) 
          . "] <span style='color:#FFFF66'>" . substr($workRow['runTime'], 1, 7) . "</span> \r\n      " . acceptanceDisplay($workRow['accepted'],$workRow['rejected'])
          . "  <span style='color:#DF7416'>" . substr($avgScore, 0, 3) . "</span>";
  }
  
  function emailWasSaved($workRow) {
    $commId = $workRow['communicationId'];
    $wasSaved = (isset($commId) && ($commId != '')) ? 1 : 0;
    debugLogLine("commId=" . $commId  . "  emailWasSaved=" . $wasSaved); 
    return $wasSaved;
  }
  
  function emailWasSent($workRow) {
    $commId = $workRow['communicationId'];
    $sent = $workRow['sent'];
    $wasSent = (emailWasSaved($workRow) && ($sent==1)) ? 1 : 0;
    debugLogLine("commId=" . $commId  . "  sent=" . $sent . "  emailWasSent=" . $wasSent); 
    return $wasSent;
  }
  
  function emailSentMarkupId($workId) {
    $emailSentMarkupId = 'emailSentMarkup-' . $workId;
    return $emailSentMarkupId;
  }
  
  function sendKind($rejected) {
    $kindOf = ($rejected==1) ? ' rejection ' : ' acceptance ';
    $sendKind = 'alt="Send' . $kindOf . 'email." title="Send' . $kindOf . 'email." ';
    return $sendKind;
  }
  
  // coordinate changes with the javascript function emailSentIconMarkupJS(workId)
  function emailSentIconMarkup($workId) {
    return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $workId . ')"><img '
         . 'src="../images/emailSentIcon3.gif" alt="View email sent." title="View email sent." width="34" height="18" align="top" border="0"></a>';
  }
  
  function sendEmailIconMarkup($workId, $accepted, $rejected) {
    return '<a href="javascript:void(0)" onClick="curationEmailTextWindow=openCurationEmailTextWindow(' . $workId . ')"><img '
         . 'src="../images/emailSendIcon3.gif" ' . sendKind($rejected) . ' width="34" height="18" align="top" border="0" ></a>';
  }
  
  function emailSentMarkup($workRow, $workId, $accepted, $rejected) {
    $emailSentMarkup = '';
    if ((($accepted==1) && ($rejected!=1)) || (($accepted!=1) && ($rejected==1)))
      $emailSentMarkup = (emailWasSent($workRow)) ? emailSentIconMarkup($workId) : sendEmailIconMarkup($workId, $accepted, $rejected);
    return $emailSentMarkup;
  }
  
  function entryEmailSummaryDisplay($workRow) {
    $avgScore = getDbScoreFor($workRow);
    $workId = $workRow['workId'];
    $accepted = $workRow['accepted'];
    $rejected = $workRow['rejected'];
    return "<i>" . clickableForDetailDisplay($workRow['workId'], $workRow['title']) . ",</i> " 
          . $workRow['name'] . " (" . $workRow['city'] . ", " . $workRow['stateProvRegion'] . ", " . $workRow['country'] . ") "
          . "<span style='color:#FFFF66'>" . substr($workRow['runTime'], 1, 7) . "</span> " 
          . acceptanceDisplay($accepted, $rejected)
          . "  <span style='color:#DF7416'>" . substr($avgScore, 0, 3) . "</span> "
          . "<span id='" . emailSentMarkupId($workId) . "'>" . emailSentMarkup($workRow, $workId, $accepted, $rejected) . "</span>";
  }
  
  function saveCuratorData($entryId) {
  //echo "GET[scoreDL]=|" .  quote($_GET['scoreDL']) . "| GET[scoreAB]=|" .  quote($_GET['scoreAB']) . "|  GET[scoreME]=|" .   quote($_GET['scoreME']) . "|<br>";
  // example of proper syntax: update curation set score=NULL, notes='maybe' where entry=41 and curator=5
    if ($_GET['scoreDL'] != '--')
      $curatorUpdateString = "UPDATE curation set score=" . $_GET['scoreDL'] . ", notes=" . quote($_GET['notesDL']) . " where curator = 1 and entry=" . $entryId;
    else 
      $curatorUpdateString = "UPDATE curation set score=NULL, notes=" . quote($_GET['notesDL']) . " where curator=1 and entry=" . $entryId;
    $curatorResult = mysql_query($curatorUpdateString); 
    debugLogQuery($curatorResult, $curatorUpdateString);

    if ($_GET['scoreAB'] != '--')
      $curatorUpdateString = "UPDATE curation set score=" . $_GET['scoreAB'] . ", notes=" . quote($_GET['notesAB']) . " where curator = 5 and entry=" . $entryId;
    else 
      $curatorUpdateString = "UPDATE curation set score=NULL, notes=" . quote($_GET['notesAB']) . " where curator=5 and entry=" . $entryId;
    $curatorResult = mysql_query($curatorUpdateString); 
    debugLogQuery($curatorResult, $curatorUpdateString);

    if ($_GET['scoreME'] != '--')
      $curatorUpdateString = "UPDATE curation set score=" . $_GET['scoreME'] . ", notes=" . quote($_GET['notesME']) . " where curator = 38 and entry=" . $entryId;
    else 
      $curatorUpdateString = "UPDATE curation set score=NULL, notes=" . quote($_GET['notesME']) . " where curator=38 and entry=" . $entryId;
    $curatorResult = mysql_query($curatorUpdateString); 
    debugLogQuery($curatorResult, $curatorUpdateString);
  }
  

  function displayEntryList($queryFilterString, $querySortString, $havingClauseForScore) {
    // READ the VALUES FROM the DATABASE FOR DISPLAY
    $worksSelectString = "select personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score) "
                       . "from (works left join people on people.personId=works.submitter) "
                       . "left join curation on curation.entry=works.workId "
                       . "where " . $queryFilterString . " "
                       . "group by works.workId " . $havingClauseForScore
                       . "order by " . $querySortString . ";";
    debugLogLineQuery($worksSelectString);
    $worksQueryResult = mysql_query($worksSelectString); 
    debugLogQuery($worksQueryResult, $worksSelectString);
    debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 
    
    /* working example for including avg(score):
    select designatedId, workId, title, personId, name, avg(score) 
    from works left join (people, curation) 
    on (people.personId=works.submitter and curation.entry=works.workId) 
    where callForEntries=1 group by works.workId 
    order by avg(score)
    */
  
    $revenueSelectString = "select sum(amtPaid) from works where callForEntries=" . getCallForEntriesId(); 
    debugLogLineQuery($revenueSelectString);
    $revenueQueryResult = mysql_query($revenueSelectString); 
    debugLogQuery($revenueQueryResult, $revenueSelectString);
    debugLogLine("Select Query Finished -- result = " . $revenueQueryResult); 
    $revenue = mysql_fetch_array($revenueQueryResult);
  
    // and into contributorsArray
    $contributorSelectAllResult = selectContributors('all');
    
    $durations = array();
    echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\r\n";
    echo "<tr><td align='right' class='bodyTextOnDarkGray' style='width:4em'>\r\n      <span style='color:#B7E5F7'>Id</span>&nbsp;&nbsp;</td>\r\n    " 
         . "<td align='left' class='bodyTextOnDarkGray'><i><span style='color:#99CCFF'>Title</span>,</i>&nbsp; \r\n      "
         . "Submitter (Locale) [<span style='color:#b8ede0'>Submssn Format</span> / Orignl Format] \r\n      <span style='color:#FFFF66'>Run Time</span>"
         . "  <span style='color:#07EB01;'><b>&#8657;</b> Accepted</span> \r\n      <span style='color:#CE181F;'><b>&#8659;</b> Rejected</span>"
         . "  <span style='color:#DF7416'>Avg Score</span></td></tr>\r\n";
    while ($worksQueryResult && ($workRow = mysql_fetch_array($worksQueryResult))) {
      echo "<tr><td align='right' valign='top' class='bodyTextOnDarkGray'>" 
          . clickableForDetailDisplay($workRow['workId'], "\r\n      <span style='color:#B7E5F7;overflow:visible'>" . $workRow['designatedId'] . "</span>") 
          . "&nbsp;&nbsp;</td>\r\n    <td id='entryId-" . $workRow['workId'] . "' align='left' valign='top' class='bodyTextOnDarkGray'>"
          . entrySummaryDisplay($workRow) . "</td></tr>\r\n";
      array_push($durations, $workRow['runTime']);
    }
    echo "</table>\r\n";
    $totalsDisplay = count($durations) . " films<br>with a total run time of " . totalRunTime($durations)
                   . "<br>generating $" . $revenue[0] . " in revenue.";
    echo '<script type="text/javascript">document.getElementById("totalsDisplay").innerHTML="' . $totalsDisplay . '";</script>';
    //echo "<br>Total Films: " . count($durations) . "<br>";
    //echo "Total Run Time: " . totalRunTime($durations) . "<br>\r\n";
    //echo "Total Revenue from Submissions: $" . $revenue[0] . "<br><br>";
  }

  function displayEmailEntryList($queryFilterString, $querySortString, $havingClause) {
    // READ the VALUES FROM the DATABASE FOR DISPLAY
    $whereClause = "";
    if (isset($queryFilterString) && ($queryFilterString != "")) $whereClause = "where " . $queryFilterString . " ";
/*    $worksSelectString = "select personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "communications.communicationId, communications.type, communications.sent "
                       . "from works left join (people, curation) "
                       . "on (people.personId=works.submitter and curation.entry=works.workId) "
                       . "left join (communications) on (communications.referencedWork=works.workId) "
                       . $whereClause
                       . "group by works.workId " . $havingClause
                       . " order by " . $querySortString . ";";
*/                       
    $worksSelectString = "select personId, name, lastName, organization, city, stateProvRegion, country, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "communications.communicationId, communications.type, communications.sent "
                       . "from ((works left join people on people.personId=works.submitter) "
                       . "left join curation on curation.entry=works.workId) "
                       . "left join communications on communications.referencedWork=works.workId "
                       . $whereClause
                       . "group by works.workId " . $havingClause
                       . " order by " . $querySortString . ";";
    debugLogLineQuery($worksSelectString);
    $worksQueryResult = mysql_query($worksSelectString); 
    debugLogQuery($worksQueryResult, $worksSelectString);
    debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 
    
    // and into contributorsArray
    $contributorSelectAllResult = selectContributors('all');
    
    $durations = array();
    echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
    echo "<tr><td align='right' class='bodyTextOnDarkGray'><!--Key: --><span style='color:#B7E5F7'>Id</span>&nbsp;&nbsp;</td>\r\n    " 
         . "<td align='left' class='bodyTextOnDarkGray'><i><span style='color:#99CCFF'>Title</span>,</i>&nbsp; "
         . "Submitter (Locale) <span style='color:#FFFF66'>Run Time</span>"
         . "  <span style='color:#07EB01;'><b>&#8657;</b> Accepted</span> <span style='color:#CE181F;'><b>&#8659;</b> Rejected</span>"
         . "  <span style='color:#DF7416'>Avg Score</span></td>";
    while ($worksQueryResult && ($workRow = mysql_fetch_array($worksQueryResult))) {
      echo "<tr><td align='right' valign='top' class='bodyTextOnDarkGray'>" 
          . clickableForDetailDisplay($workRow['workId'], "<span style='color:#B7E5F7'>" . $workRow['designatedId'] . "</span>") 
          . "&nbsp;&nbsp;</td>" . "\r\n" . "    <td id='entryId-" . $workRow['workId'] . "' align='left' valign='top' class='bodyTextOnDarkGray'>"
          . entryEmailSummaryDisplay($workRow) . "</td></tr>\r\n";
      array_push($durations, $workRow['runTime']);
    }
    echo "</table>\r\n";
    echo "<br>Total Films: " . count($durations) . "<br>";
    echo "Total Run Time: " . totalRunTime($durations) . "<br>\r\n";
  }

  function stillImagesNeeded($photoLocation) {
    $stillImagesNeeded = ($photoLocation=="");
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|");
    if (!$stillImagesNeeded) $stillImagesNeeded == (strpos($photoLocation, 'CD')===false);
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|    strpos($photoLocation, 'CD')=|" . strpos($photoLocation, 'CD') . "|");
    if (!$stillImagesNeeded) $stillImagesNeeded == (strpos($photoLocation, 'print')===false);
    //debugLogLineUn("photoLocation=|" . $photoLocation . "|    stillImagesNeeded=|" . $stillImagesNeeded . "|    strpos($photoLocation, 'print')=|" . strpos($photoLocation, 'print') . "|");
    return $stillImagesNeeded;
  }
  
  // strip < and > replacing with &lt; and &gt; for browser display
  function encodeEmailAddress($address) {
    $newString = str_replace("<", "&lt;", $address);
    return str_replace(">", "&gt;", $newString);
  }

  // strip&lt; and &gt; replacing with < and > for email
  function decodeEmailAddress($encodedAddress) {
    $newString = str_replace("&lt;", "<", $encodedAddress);
    return str_replace("&gt;", ">", $newString);
  }

  function selectAccRejWorkRow($entryId) {
    $worksSelectString = "select personId, name, lastName, organization, city, stateProvRegion, country, email, "
                       . "workId, title, yearProduced, designatedId, runTime, webSite, accepted, rejected, "
                       . "submissionFormat, originalFormat, synopsisOriginal, previouslyShownAt, avg(score), "
                       . "photoLocation, communications.communicationId, communications.type, communications.sent, "
                       . "communications.dateSent, communications.sender, communications.contentText, "
                       . "communications.emailTo, communications.emailFrom, communications.emailSubject, "
                       . "contentLastModDate "
                       . "from works left join (people, curation) "
                       . "on (people.personId=works.submitter and curation.entry=works.workId) "
                       . "left join (communications) on (communications.referencedWork=works.workId) "
                       . "where workId=" . $entryId . " group by works.workId;";
    debugLogLineQuery($worksSelectString);
    $worksQueryResult = mysql_query($worksSelectString); 
    debugLogQuery($worksQueryResult, $worksSelectString);
    debugLogLine("Select Query Finished -- result = " . $worksQueryResult); 
    if ($worksQueryResult) $workRow = mysql_fetch_array($worksQueryResult);
    return $workRow;
  }

?>
