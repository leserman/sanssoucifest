<?php

// --- class SSFAdmin -----------------------------------------------------------------------------------

  class SSFAdmin {
    private static $users = array();
    private static $initialized = false;
    private $id = '';
    private $name = '';
    private $title = '';
    private $email = '';
    private $valediction = '';

    public function id() { return $this->id; }
    public function name() { return $this->name; }
    public function title() { return $this->title; }
    public function email() { return $this->email; }
    public function valediction() { return $this->valediction; }

    public static function user() { 
      $users = self::users();
      $userIndex = self::userIndex();
      return $users[$userIndex]; 
    }

    public static function userIndex() { 
      $index = self::userIndexFor();
      return $index; 
    }

    public static function userIndexFor($managementElementId = 'localhostAdminId') { 
      $managementElementCookieName = 'ssf_' . $managementElementId;
      SSFDebug::globalDebugger()->belch('_COOKIE', $_COOKIE, -1);
      $index = (isset($_COOKIE[$managementElementCookieName]) && ($_COOKIE[$managementElementCookieName] != 0)) 
             ? $_COOKIE[$managementElementCookieName] 
             : SSFRunTimeValues::getAdministratorId();  // changed from getDefaultAdministratorId() 6/11/11 (7/20/18)
      return $index; 
    }

    public static function users() {
      if (!self::$initialized) {
        $adminRows = SSFQuery::getAdministrators();
        foreach ($adminRows as $adminRow) {
          //example result: self::$users[5] = new self('Ana Baer', 'Artistic Co-Director', 'ana@sanssoucifest.org', 'Besos,');
          self::$users[$adminRow['adminId']] = new self($adminRow['adminId'], $adminRow['adminFullName'], $adminRow['adminTitle'], $adminRow['adminEmail'], $adminRow['valediction']);
        }
      }
      self::$initialized = true;
      return self::$users;
    }

    // E.g., new SSFAdmin(name, title, email, valediction)
    private function __construct() {
      $args = func_get_args();
      $this->id = $args[0];
      $this->name = $args[1];
      $this->title = $args[2];
      $this->email = $args[3];
      $this->valediction = $args[4];
    }

  }

?>
