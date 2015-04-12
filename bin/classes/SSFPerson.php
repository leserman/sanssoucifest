<?php
class SSFPerson {
  public $valueArray = array();

  public function __construct($personArray) {
    foreach ($personArray as $personArrayKey => $personArrayElement) {
      $this->valueArray[$personArrayKey] = $personArrayElement;
    }
  } 

  public function id() { return $this->valueArray['personId']; }
  public function organizationExists() { return isset($this->valueArray['organization']) && ($this->valueArray['organization'] != ''); }
  public function addressLine1Exists() { return isset($this->valueArray['streetAddr1']) && ($this->valueArray['streetAddr1'] != ''); }
  public function addressLine2Exists() { return isset($this->valueArray['streetAddr2']) && ($this->valueArray['streetAddr2'] != ''); }
  public function addressLineExists() { return $this->addressLine1Exists() || $this->addressLine2Exists(); }
  public function cityExists() { return isset($this->valueArray['city']) && ($this->valueArray['city'] != ''); }
  public function stateProvRegionExists() { return isset($this->valueArray['stateProvRegion']) && ($this->valueArray['stateProvRegion'] != ''); }
  public function zipPostalCodeExists() { return isset($this->valueArray['zipPostalCode']) && ($this->valueArray['zipPostalCode'] != ''); }
  public function cityLineOutputExists() { return $this->cityExists() || $this->stateProvRegionExists() || $this->zipPostalCodeExists(); }
  public function addressExists() { return $this->addressLineExists() || $this->cityLineOutputExists(); }
  public function countryExists() { return isset($this->valueArray['country']) && ($this->valueArray['country'] != ''); }
  public function phoneVoiceExists() { return isset($this->valueArray['phoneVoice']) && ($this->valueArray['phoneVoice'] != ''); }
  public function phoneMobileExists() { return isset($this->valueArray['phoneMobile']) && ($this->valueArray['phoneMobile'] != ''); }
  public function phoneFaxExists() { return isset($this->valueArray['phoneFax']) && ($this->valueArray['phoneFax'] != ''); }
  public function telephonesExist() { return $this->phoneVoiceExists() || $this->phoneMobileExists() || $this->phoneFaxExists(); }
  public function notifyOfString() { return str_replace(',', ", ", $this->valueArray['notifyOf']); }

  public function notifyDisplayForUser() {
//self::debugger()->becho('notifyOfString', $notifyOfString, 1);
    $notifyOfCalls = substr_count($this->valueArray['notifyOf'], 'calls') != 0;
    $notifyOfEvents = substr_count($this->valueArray['notifyOf'], 'events') != 0;
    $notifyString = '<span class="highlightedTextColor">Nothing.</span> Please don\'t send me any email announcements.';
    if ($notifyOfCalls && $notifyOfEvents) $notifyString = '<span class="highlightedTextColor">Both</span> Calls for Entries and Festival Events.';
    else if ($notifyOfCalls && !$notifyOfEvents) $notifyString = 'Calls for Entries <span class="highlightedTextColor">but not</span> Festival Events.';
    else if (!$notifyOfCalls && $notifyOfEvents) $notifyString = 'Festival Events <span class="highlightedTextColor">but not</span> Calls for Entries.';
    return $notifyString;
  }

  public function addressDisplay() {
    $addressSegmentSeparator = " &bull; ";
    $addressDisplay = '';
    if (!$this->addressExists() && !$this->countryExists()) $addressDisplay .= "No address provided.<br>" . PHP_EOL;
    if ($this->addressLine1Exists()) $addressDisplay .= $this->valueArray['streetAddr1'] . $addressSegmentSeparator;
    if ($this->addressLine2Exists()) $addressDisplay .= $this->valueArray['streetAddr2'] . $addressSegmentSeparator;
    if ($this->cityExists()) $addressDisplay .= $this->valueArray['city'];
    if ($this->cityExists() && ($this->stateProvRegionExists() || $this->zipPostalCodeExists())) $addressDisplay .= ", "; 
    if ($this->stateProvRegionExists()) $addressDisplay .= $this->valueArray['stateProvRegion'] . " "; 
    if ($this->zipPostalCodeExists()) $addressDisplay .= $this->valueArray['zipPostalCode']; 
    if ($this->cityLineOutputExists() && $this->countryExists()) $addressDisplay .= $addressSegmentSeparator;
    if ($this->countryExists()) $addressDisplay .= $this->valueArray['country'];
    return $addressDisplay;
  }
}
?>
