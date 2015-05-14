<?php
class SSFVimeo
{
    const API_REST_URL = 'http://vimeo.com/api/rest/v2';
    const API_AUTH_URL = 'http://vimeo.com/oauth/authorize';
    const API_ACCESS_TOKEN_URL = 'http://vimeo.com/oauth/access_token';
    const API_REQUEST_TOKEN_URL = 'http://vimeo.com/oauth/request_token';

    const CACHE_FILE = 'file';
    
    const VIMEO_CONSUMER_KEY = '54567d028248068bc74b4e124fed601d';
    const VIMEO_CONSUMER_SECRET = 'd8f03d9a623c902f';

    private static $reportReadErrors = -1;
    
    private $_consumer_key = false;
    private $_consumer_secret = false;
    private $_cache_enabled = false;
    private $_cache_dir = false;
    private $_token = false;
    private $_token_secret = false;
    private $_upload_md5s = array();
    
    public static $vimeoConnection; // Added by DHL 4/60/12

    public function __construct($consumer_key, $consumer_secret, $token = null, $token_secret = null)
    {
        $this->_consumer_key = $consumer_key;
        $this->_consumer_secret = $consumer_secret;

        if ($token && $token_secret) {
            $this->setToken($token, $token_secret);
        }
    }

    /**
     * Cache a response.
     *
     * @param array $params The parameters for the response.
     * @param string $response The serialized response data.
     */
    private function _cache($params, $response)
    {
        // Remove some unique things
        unset($params['oauth_nonce']);
        unset($params['oauth_signature']);
        unset($params['oauth_timestamp']);

        $hash = md5(serialize($params));

        if ($this->_cache_enabled == self::CACHE_FILE) {
            $file = $this->_cache_dir.'/'.$hash.'.cache';
            if (file_exists($file)) {
                unlink($file);
            }
            return file_put_contents($file, $response);
        }
    }

    /**
     * Create the authorization header for a set of params.
     *
     * @param array $oauth_params The OAuth parameters for the call.
     * @return string The OAuth Authorization header.
     */
    private function _generateAuthHeader($oauth_params)
    {
        $auth_header = 'Authorization: OAuth realm=""';

        foreach ($oauth_params as $k => $v) {
            $auth_header .= ','.self::url_encode_rfc3986($k).'="'.self::url_encode_rfc3986($v).'"';
        }

        return $auth_header;
    }

    /**
     * Generate a nonce for the call.
     *
     * @return string The nonce
     */
    private function _generateNonce()
    {
        return md5(uniqid(microtime()));
    }

    /**
     * Generate the OAuth signature.
     *
     * @param array $args The full list of args to generate the signature for.
     * @param string $request_method The request method, either POST or GET.
     * @param string $url The base URL to use.
     * @return string The OAuth signature.
     */
    private function _generateSignature($params, $request_method = 'GET', $url = self::API_REST_URL)
    {
        uksort($params, 'strcmp');
        $params = self::url_encode_rfc3986($params);

        // Make the base string
        $base_parts = array(
            strtoupper($request_method),
            $url,
            urldecode(http_build_query($params, '', '&'))
        );
        $base_parts = self::url_encode_rfc3986($base_parts);
        $base_string = implode('&', $base_parts);

        // Make the key
        $key_parts = array(
            $this->_consumer_secret,
            ($this->_token_secret) ? $this->_token_secret : ''
        );
        $key_parts = self::url_encode_rfc3986($key_parts);
        $key = implode('&', $key_parts);

        // Generate signature
        return base64_encode(hash_hmac('sha1', $base_string, $key, true));
    }

    /**
     * Get the unserialized contents of the cached request.
     *
     * @param array $params The full list of api parameters for the request.
     */
    private function _getCached($params)
    {
        // Remove some unique things
        unset($params['oauth_nonce']);
        unset($params['oauth_signature']);
        unset($params['oauth_timestamp']);

        $hash = md5(serialize($params));

        if ($this->_cache_enabled == self::CACHE_FILE) {
            $file = $this->_cache_dir.'/'.$hash.'.cache';
            if (file_exists($file)) {
                return unserialize(file_get_contents($file));
            }
        }
    }

    /**
     * Call an API method.
     *
     * @param string $method The method to call.
     * @param array $call_params The parameters to pass to the method.
     * @param string $request_method The HTTP request method to use.
     * @param string $url The base URL to use.
     * @param boolean $cache Whether or not to cache the response.
     * @param boolean $use_auth_header Use the OAuth Authorization header to pass the OAuth params.
     * @return string The response from the method call.
     */
    private function _request($method, $call_params = array(), $request_method = 'GET', $url = self::API_REST_URL, $cache = true, $use_auth_header = true)
    {
        // Prepare oauth arguments
        $oauth_params = array(
            'oauth_consumer_key' => $this->_consumer_key,
            'oauth_version' => '1.0',
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => time(),
            'oauth_nonce' => $this->_generateNonce()
        );

        // If we have a token, include it
        if ($this->_token) {
            $oauth_params['oauth_token'] = $this->_token;
        }

        // Regular args
        $api_params = array('format' => 'php');
        if (!empty($method)) {
            $api_params['method'] = $method;
        }

        // Merge args
        foreach ($call_params as $k => $v) {
            if (strpos($k, 'oauth_') === 0) {
                $oauth_params[$k] = $v;
            }
            else if ($call_params[$k] !== null) {
                $api_params[$k] = $v;
            }
        }

        // Generate the signature
        $oauth_params['oauth_signature'] = $this->_generateSignature(array_merge($oauth_params, $api_params), $request_method, $url);

        // Merge all args
        $all_params = array_merge($oauth_params, $api_params);

        // Returned cached value
        if ($this->_cache_enabled && ($cache && $response = $this->_getCached($all_params))) {
            return $response;
        }

        // Curl options
        if ($use_auth_header) {
            $params = $api_params;
        }
        else {
            $params = $all_params;
        }

        if (strtoupper($request_method) == 'GET') {
            $curl_url = $url.'?'.http_build_query($params, '', '&');
            $curl_opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30
            );
        }
        else if (strtoupper($request_method) == 'POST') {
            $curl_url = $url;
            $curl_opts = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => http_build_query($params, '', '&')
            );
        }

        // Authorization header
        if ($use_auth_header) {
            $curl_opts[CURLOPT_HTTPHEADER] = array($this->_generateAuthHeader($oauth_params));
        }

        // Call the API
        $curl = curl_init($curl_url);
        curl_setopt_array($curl, $curl_opts);
        $response = curl_exec($curl);
        $curl_info = curl_getinfo($curl);
        curl_close($curl);

        // Cache the response
        if ($this->_cache_enabled && $cache) {
            $this->_cache($all_params, $response);
        }

        // Return
        if (!empty($method)) {
            $response = unserialize($response);
            if ($response->stat == 'ok') { // TODO: Notice: Trying to get property of non-object, 5/7/13 - After switching from Orientation Works for a particular work to 
                return $response;          // orientation People for a different person, and then switching back.
            }
            else if ($response->err) { // TODO: Notice: Trying to get property of non-object, 5/7/13 - Same as above.
                // block rewritten by DHL 4/30/12
                SSFDebug::globalDebugger()->becho('Vimeo read error in SSFVimeo::_request(): ', '(' . $response->err->code . ') ' . $response->err->msg, self::$reportReadErrors);
//                throw new VimeoAPIException($response->err->msg, $response->err->code);
                return false; 
            }
            return false;
        }

        return $response;
    }

    /**
     * Send the user to Vimeo to authorize your app.
     * http://www.vimeo.com/api/docs/oauth
     *
     * @param string $perms The level of permissions to request: read, write, or delete.
     */
    public function auth($permission = 'read', $callback_url = 'oob')
    {
        $t = $this->getRequestToken($callback_url);
        $this->setToken($t['oauth_token'], $t['oauth_token_secret'], 'request', true);
        $url = $this->getAuthorizeUrl($this->_token, $permission);
        header("Location: {$url}");
    }

    /**
     * Call a method.
     *
     * @param string $method The name of the method to call.
     * @param array $params The parameters to pass to the method.
     * @param string $request_method The HTTP request method to use.
     * @param string $url The base URL to use.
     * @param boolean $cache Whether or not to cache the response.
     * @return array The response from the API method
     */
    public function call($method, $params = array(), $request_method = 'GET', $url = self::API_REST_URL, $cache = true)
    {
        $method = (substr($method, 0, 6) != 'vimeo.') ? "vimeo.{$method}" : $method;
        // Try twice. Sometimes the first one fails and the second one succeeds.
        $response = $this->_request($method, $params, $request_method, $url, $cache);
        if ($response === false) {
          SSFDebug::globalDebugger()->becho('VIMEO REQUEST in SSFVimeo::call() FAILED. Trying again.', '', self::$reportReadErrors);
          return $this->_request($method, $params, $request_method, $url, $cache);
        };
        return $response;
    }

    /**
     * Enable the cache.
     *
     * @param string $type The type of cache to use (SSFVimeo::CACHE_FILE is built in)
     * @param string $path The path to the cache (the directory for CACHE_FILE)
     * @param int $expire The amount of time to cache responses (default 10 minutes)
     */
    public function enableCache($type, $path, $expire = 600)
    {
        $this->_cache_enabled = $type;
        if ($this->_cache_enabled == self::CACHE_FILE) {
            $this->_cache_dir = $path;
SSFDebug::globalDebugger()->becho('SSFVimeo::enableCache() this->_cache_dir', $this->_cache_dir, -1);
            $files = scandir($this->_cache_dir);
            if (is_array($files)) {             // line added about 4/23/15
                foreach ($files as $file) {
                    $last_modified = filemtime($this->_cache_dir.'/'.$file);
                    if (substr($file, -6) == '.cache' && ($last_modified + $expire) < time()) {
                        unlink($this->_cache_dir.'/'.$file);
                    }
                }
            }
            else $this->_cache_enabled = false; // line added about 4/23/15
        }
        return false;
    }

    /**
     * Get an access token. Make sure to call setToken() with the
     * request token before calling this function.
     *
     * @param string $verifier The OAuth verifier returned from the authorization page or the user.
     */
    public function getAccessToken($verifier)
    {
        $access_token = $this->_request(null, array('oauth_verifier' => $verifier), 'GET', self::API_ACCESS_TOKEN_URL, false, true);
        parse_str($access_token, $parsed);
        return $parsed;
    }

    /**
     * Get the URL of the authorization page.
     *
     * @param string $token The request token.
     * @param string $permission The level of permissions to request: read, write, or delete.
     * @param string $callback_url The URL to redirect the user back to, or oob for the default.
     * @return string The Authorization URL.
     */
    public function getAuthorizeUrl($token, $permission = 'read')
    {
        return self::API_AUTH_URL."?oauth_token={$token}&permission={$permission}";
    }

    /**
     * Get a request token.
     */
    public function getRequestToken($callback_url = 'oob')
    {
        $request_token = $this->_request(
            null,
            array('oauth_callback' => $callback_url),
            'GET',
            self::API_REQUEST_TOKEN_URL,
            false,
            false
        );

        parse_str($request_token, $parsed);
        return $parsed;
    }

    /**
     * Get the stored auth token.
     *
     * @return array An array with the token and token secret.
     */
    public function getToken()
    {
        return array($this->_token, $this->_token_secret);
    }

    /**
     * Set the OAuth token.
     *
     * @param string $token The OAuth token
     * @param string $token_secret The OAuth token secret
     * @param string $type The type of token, either request or access
     * @param boolean $session_store Store the token in a session variable
     * @return boolean true
     */
    public function setToken($token, $token_secret, $type = 'access', $session_store = false)
    {
        $this->_token = $token;
        $this->_token_secret = $token_secret;

        if ($session_store) {
            $_SESSION["{$type}_token"] = $token;
            $_SESSION["{$type}_token_secret"] = $token_secret;
        }

        return true;
    }

    /**
     * Upload a video in one piece.
     *
     * @param string $file_path The full path to the file
     * @param boolean $use_multiple_chunks Whether or not to split the file up into smaller chunks
     * @param string $chunk_temp_dir The directory to store the chunks in
     * @param int $size The size of each chunk in bytes (defaults to 2MB)
     * @return int The video ID
     */
    public function upload($file_path, $use_multiple_chunks = false, $chunk_temp_dir = '.', $size = 2097152, $replace_id = null)
    {
        if (!file_exists($file_path)) {
            return false;
        }

        // Figure out the filename and full size
        $path_parts = pathinfo($file_path);
        $file_name = $path_parts['basename'];
        $file_size = filesize($file_path);

        // Make sure we have enough room left in the user's quota
        $quota = $this->call('vimeo.videos.upload.getQuota');
        if ($quota->user->upload_space->free < $file_size) {
            throw new VimeoAPIException('The file is larger than the user\'s remaining quota.', 707);
        }

        // Get an upload ticket
        $params = array();

        if ($replace_id) {
            $params['video_id'] = $replace_id;
        }

        $rsp = $this->call('vimeo.videos.upload.getTicket', $params, 'GET', self::API_REST_URL, false);
        $ticket = $rsp->ticket->id;
        $endpoint = $rsp->ticket->endpoint;

        // Make sure we're allowed to upload this size file
        if ($file_size > $rsp->ticket->max_file_size) {
            throw new VimeoAPIException('File exceeds maximum allowed size.', 710);
        }

        // Split up the file if using multiple pieces
        $chunks = array();
        if ($use_multiple_chunks) {
            if (!is_writeable($chunk_temp_dir)) {
                throw new Exception('Could not write chunks. Make sure the specified folder has write access.');
            }

            // Create pieces
            $number_of_chunks = ceil(filesize($file_path) / $size);
            for ($i = 0; $i < $number_of_chunks; $i++) {
                $chunk_file_name = "{$chunk_temp_dir}/{$file_name}.{$i}";

                // Break it up
                $chunk = file_get_contents($file_path, FILE_BINARY, null, $i * $size, $size);
                $file = file_put_contents($chunk_file_name, $chunk);

                $chunks[] = array(
                    'file' => realpath($chunk_file_name),
                    'size' => filesize($chunk_file_name)
                );
            }
        }
        else {
            $chunks[] = array(
                'file' => realpath($file_path),
                'size' => filesize($file_path)
            );
        }

        // Upload each piece
        foreach ($chunks as $i => $chunk) {
            $params = array(
                'oauth_consumer_key'     => $this->_consumer_key,
                'oauth_token'            => $this->_token,
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_timestamp'        => time(),
                'oauth_nonce'            => $this->_generateNonce(),
                'oauth_version'          => '1.0',
                'ticket_id'              => $ticket,
                'chunk_id'               => $i
            );

            // Generate the OAuth signature
            $params = array_merge($params, array(
                'oauth_signature' => $this->_generateSignature($params, 'POST', self::API_REST_URL),
                'file_data'       => '@'.$chunk['file'] // don't include the file in the signature
            ));

            // Post the file
            $curl = curl_init($endpoint);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            $rsp = curl_exec($curl);
            curl_close($curl);
        }

        // Verify
        $verify = $this->call('vimeo.videos.upload.verifyChunks', array('ticket_id' => $ticket));

        // Make sure our file sizes match up
        foreach ($verify->ticket->chunks as $chunk_check) {
            $chunk = $chunks[$chunk_check->id];

            if ($chunk['size'] != $chunk_check->size) {
                // size incorrect, uh oh
                echo "Chunk {$chunk_check->id} is actually {$chunk['size']} but uploaded as {$chunk_check->size}<br>";
            }
        }

        // Complete the upload
        $complete = $this->call('vimeo.videos.upload.complete', array(
            'filename' => $file_name,
            'ticket_id' => $ticket
        ));

        // Clean up
        if (count($chunks) > 1) {
            foreach ($chunks as $chunk) {
                unlink($chunk['file']);
            }
        }

        // Confirmation successful, return video id
        if ($complete->stat == 'ok') {
            return $complete->ticket->video_id;
        }
        else if ($complete->err) {
            throw new VimeoAPIException($complete->err->msg, $complete->err->code);
        }
    }

    /**
     * Upload a video in multiple pieces.
     *
     * @deprecated
     */
    public function uploadMulti($file_name, $size = 1048576)
    {
        // for compatibility with old library
        return $this->upload($file_name, true, '.', $size);
    }

    /**
     * URL encode a parameter or array of parameters.
     *
     * @param array/string $input A parameter or set of parameters to encode.
     */
    public static function url_encode_rfc3986($input)
    {
        if (is_array($input)) {
            return array_map(array('SSFVimeo', 'url_encode_rfc3986'), $input);
        }
        else if (is_scalar($input)) {
            return str_replace(array('+', '%7E'), array(' ', '~'), rawurlencode($input));
        }
        else {
            return '';
        }
    }

  // Curl helper function for Vimeo access
  public static function curl_get($url) {  // added to class 4/30/12
  	$curl = curl_init($url);
  	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  	$return = curl_exec($curl);
  	curl_close($curl);
  	return $return;
  }

  public static function establishVimeoConnection() {  // added to class 4/30/12
    // Create the object and enable caching
//  $vimeo = new phpVimeo('CONSUMER_KEY', 'CONSUMER_SECRET');
    $vimeo = new SSFVimeo(self::VIMEO_CONSUMER_KEY, self::VIMEO_CONSUMER_SECRET);
//SSFDebug::globalDebugger()->belch('SSFVimeo::establishVimeoConnection() __FILE__', __FILE__, 1);
//SSFDebug::globalDebugger()->belch('SSFVimeo::establishVimeoConnection() SSFCodeBase-string(__FILE__)', SSFCodeBase::string(__FILE__), 1);
//    $vimeo->enableCache(self::CACHE_FILE, SSFCodeBase::string(__FILE__) . 'vimeoCache/', 300); 
//    $vimeo->enableCache(self::CACHE_FILE, SSFWebPageParts::getHostName() . 'bin/data/vimeoCache/', 300); // getHostName
    $vimeo->enableCache(self::CACHE_FILE, '/home/hamelbloom/sanssoucifest.org/bin/data/vimeoCache/', 300); // TODO: replace this string with a computed path.   
    // Clear session (from vimeoTest.php. Probably not needed here.)
    if (isset($_GET['clear']) && $_GET['clear'] == 'all') { session_destroy(); session_start(); } 
    // Set up variables
//    $state = $_SESSION['vimeo_state'];
//    $request_token = $_SESSION['oauth_request_token'];
//    $access_token = $_SESSION['oauth_access_token'];
    // Coming back
    if (!isset($_SESSION['vimeo_state']) || ($_SESSION['vimeo_state'] === NULL)) $_SESSION['vimeo_state'] = ''; // Added by DHL 5/4/12 to combat Diagnostic A below

//    if ($_REQUEST['oauth_token'] != NULL && $_SESSION['vimeo_state'] === 'start') { $_SESSION['vimeo_state'] = $state = 'returned'; }
    if (isset($_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] !== NULL && $_SESSION['vimeo_state'] == 'start') { $_SESSION['vimeo_state'] = 'returned'; }
    
    // If we have an access token, set it
    if (isset($_SESSION['oauth_access_token']) && $_SESSION['oauth_access_token'] != null) { $vimeo->setToken($_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']); }
    
    switch ($_SESSION['vimeo_state']) { // Diagnostic A occurs here when $_SESSION['vimeo_state'] is not set or NULL, probably because it timed out
      default:
        // Get a new request token
        $token = $vimeo->getRequestToken();
        // Store it in the session
        $_SESSION['oauth_request_token'] = $token['oauth_token'];
        $_SESSION['oauth_request_token_secret'] = $token['oauth_token_secret'];
        $_SESSION['vimeo_state'] = 'start';
        // Build authorize link
        $authorize_link = $vimeo->getAuthorizeUrl($token['oauth_token'], 'write');
        break;
      case 'returned':
        // Store it
        if ((!isset($_SESSION['oauth_access_token']) || $_SESSION['oauth_access_token'] === NULL) && $_SESSION['oauth_access_token_secret'] === NULL) {
          // Exchange for an access token
          $vimeo->setToken($_SESSION['oauth_request_token'], $_SESSION['oauth_request_token_secret']);
          $token = $vimeo->getAccessToken($_REQUEST['oauth_verifier']);
          // Store
          $_SESSION['oauth_access_token'] = $token['oauth_token'];
          $_SESSION['oauth_access_token_secret'] = $token['oauth_token_secret'];
          $_SESSION['vimeo_state'] = 'done';
          // Set the token
          $vimeo->setToken($_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
        }
        // Do an authenticated call
        try { $videos = $vimeo->call('vimeo.videos.getUploaded'); }
        catch (VimeoAPIException $e) { echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}"; }
        break;
    }
    self::$vimeoConnection = $vimeo;
    return $vimeo;
  }
  
  public static function objectToArray($class) { // from Vimeo's object_to_array   // added to class 4/30/12
    // Typecast to (array) automatically converts stdClass -> array.
    $class = (array)$class;
    // Iterate through the former properties looking for any stdClass properties. Recursively apply (array).
    foreach($class as $key => $value) {
      if (is_object($value) && get_class($value) == 'stdClass') { $class[$key] = self::objectToArray($value); }
      else if (is_array($value)) { $class[$key] = self::objectToArray($value); }
    }
    return $class;
  }

}

class VimeoAPIException extends Exception {}

class SSFVimeoVideoInfo {
  // get info API
  // More public get info functions are possible but not implemented.
  public function webAddress() { return $this->vimeoWebAddress; } // Vimeo video web address as input to constructor
  public function completeWebAddress() { return HTMLGen::getCompleteWebAddress($this->vimeoWebAddress); } // Vimeo video web address with leading http
  public function password() { return $this->vimeoPassword; }     // Vimeo video password as input to constructor
  public function computedId() { return $this->computedVimeoId; } // Vimeo video id as computed from vimeoWebAddress input to constructor
  public function id() { return $this->id; }             // Vimeo video id as returned from video
  public function width() { return $this->width; }       // integer video width in pixels
  public function height() { return $this->height; }     // integer video height in pixels
  public function duration() { return $this->duration; } // integer video length in seconds
  public function privacyCode() { return $this->privacy; }
  public function privacyDisplay() { return array_key_exists($this->privacy, self::$vimeoPrivacy) ? self::$vimeoPrivacy[$this->privacy] : ''; }
  public function embedPrivacy() { return $this->embedPrivacy; }
  public function isHD() { return $this->isHD; }                   // integer
  public function isTranscoding() { return $this->isTranscoding; } // integer
  public function uploadDate() { return $this->uploadDate; }
  public function modifiedDate() { return $this->modifiedDate; }

  /* 
  Vimeo privacy codes   Vimeo privacy settings   Meaning  as of 5/1/2012 from http://vimeo.com/api/docs/methods/vimeo.videos.setPrivacy
  -------------------   ----------------------   -------
  anybody               Anyone                   anybody can view the video
  nobody                Nobody else              only the owner can view the video
  contacts              My contacts              only the owner's contacts can view the video
  users                 People you choose        only specific users can view the video
  password              Password protected       the video will require a password
  disable                                        the video will not appear on Vimeo.com at all
  */
  
  // state metadata API
  public static function vimeoInfoMsgFor($index) { return self::$vimeoInfoMsgMap[$index]; }
  public function vimeoInfoMsg() { return self::$vimeoInfoMsgMap[$this->rawVimeoInfoState]; }
  public function infoState() { return $this->rawVimeoInfoState; }
  public function failureProbablyDueToPasswordProtection() { return ($this->rawVimeoInfoState == 8); }
  public function getInfoSuccess() { return (($this->rawVimeoInfoState == 2) || ($this->rawVimeoInfoState == 5)); }

  // diagnostics API
  //public function idIsValid() // returns true if the vimeo id is syntactically valid
  public function showBasicDiagnostics($debugCode) { $this->$showBasicDiagnostics = $debugCode; } // See SSFDebug.php for codes
  public function showVideoInfoFromVimeo($debugCode) { self::$showVideoInfoFromVimeo = $debugCode; } // See SSFDebug.php for codes
  
  public function webAddressIsForVimeo() {
    $vimeoWebAddressExists = ($this->vimeoWebAddress != '');
    $vimeoWebAddressIsVimeo = ($vimeoWebAddressExists 
                            && ((stripos($this->vimeoWebAddress, 'vimeo.com') !== false) || (stripos($this->vimeoWebAddress, 'vimeopro.com') !== false)));
    return $vimeoWebAddressIsVimeo;
  }

  public function getInfoString($includeDiagnostics) {
//    $includeDiagnostics = -1;
    $showBasicDiagnostics = -1;
    $showDetailedDiagnostics = -1;
    SSFDebug::globalDebugger()->belch('SSFVimeoVideoInfo::getInfoString() this 0', $this, $showDetailedDiagnostics);
    // vimeo publication info
    $vimeoInfoString = '';
    SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 1', $vimeoInfoString, $showDetailedDiagnostics);
    $vimeoWebAddressExists = (isset($this->vimeoWebAddress) && ($this->vimeoWebAddress != ''));
    if ($vimeoWebAddressExists) { 
// TODO: Find a way to make this work so non-URLs are not links. Maybe use the cURL library.
// get_headers generated an error saying I could only inspect the headers for URLs at sanssoucifest.org    
//      $file_headers = get_headers($this->vimeoWebAddress); 
//      $legitimateURL = ($file_headers !== false);
      $legitimateURL = true;
      if (!$legitimateURL) $vimeoInfoString = $this->vimeoWebAddress;
      else $vimeoInfoString = '<a href="' . $this->completeWebAddress() . '">' . $this->vimeoWebAddress . '</a>';
      SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 2', $vimeoInfoString, $showDetailedDiagnostics);
      if ($legitimateURL && !$this->webAddressIsForVimeo()) {
        $vimeoInfoString .= ' <span class="orangishHighlightDisplayColor">Not a Vimeo URL</span>';
        SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 2a', $vimeoInfoString, $showDetailedDiagnostics);
      }
    } else { // since there is no web address
      $vimeoInfoString = '<span class="orangishHighlightDisplayColor">None provided.</span>';
      SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 2b', $vimeoInfoString, $showDetailedDiagnostics);
    }
    SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 3', $vimeoInfoString, $showDetailedDiagnostics);
    if ($this->vimeoPassword != '') $vimeoInfoString .= ' (' . $this->vimeoPassword . ')';
    // Append any diagnostics if parameter $includeDiagnostics is true
    if ($includeDiagnostics) {
      SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 4', $vimeoInfoString, $showDetailedDiagnostics);
      SSFDebug::globalDebugger()->belch('SSFVimeoVideoInfo::getInfoString() this 1', $this, -1);
      if ($vimeoWebAddressExists && !$this->idIsValid()) {
        $vimeoInfoString = $vimeoInfoString . ' <span class="orangishHighlightDisplayColor" style="font-size:11px;">BAD Vimeo video id.</span>';
        SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 5', $vimeoInfoString, $showDetailedDiagnostics);
      }
      if (!$this->getInfoSuccess()) {
        SSFDebug::globalDebugger()->belch('vimeoVideoInfo->getInfoSuccess()', 'FAILURE', $showBasicDiagnostics);
        $vimeoInfoString .= ' <span class="orangishHighlightDisplayColor" style="font-size:11px;">(' . $this->vimeoInfoMsg() . ')</span>';
        SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 6', $vimeoInfoString, $showDetailedDiagnostics);
        if ($this->failureProbablyDueToPasswordProtection()) {
          $vimeoInfoString .= ' <span style="font-size:11px;">(Password protected?)</span>';
          SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 7', $vimeoInfoString, $showDetailedDiagnostics);
        }
      } else { // since there is SUCCESS
        SSFDebug::globalDebugger()->belch('vimeoVideoInfo->getInfoSuccess()', 'SUCCESS', $showBasicDiagnostics);
        if (($this->privacyCode() != 'anybody') && ($this->privacyCode() != '')) {
          $vimeoInfoString .= '<span style="font-size:11px;"> (Privacy: ' . $this->privacyDisplay()  . '.)</span>';
          SSFDebug::globalDebugger()->becho('SSFVimeoVideoInfo::getInfoString() $vimeoInfoString 8', $vimeoInfoString, $showDetailedDiagnostics);
        }
      }
    }
    return $vimeoInfoString;
  }
  
  public static function getInfoStringWithDiagnosticsX($includeDiagnostics) {
    $showBasicDiagnostics = -1;
    $vimeoInfoString = $this->getInfoString();
    if ($includeDiagnostics && !$this->idIsValid()) $vimeoInfoString .= ' <span style="font-size:11px;">BAD Vimeo video id.</span>';
    if (!$this->getInfoSuccess()) {
      SSFDebug::globalDebugger()->belch('vimeoVideoInfo->getInfoSuccess()', 'FAILURE', $showBasicDiagnostics);
      if ($includeDiagnostics) $vimeoInfoString .= ' <span style="font-size:11px;">(' . $vimeoVideoInfo->vimeoInfoMsg() . ')</span>';
      if ($includeDiagnostics && $vimeoVideoInfo->failureProbablyDueToPasswordProtection()) $vimeoInfoString .= ' <span style="font-size:11px;">(Password protected?)</span>';
    } else { // since there is SUCCESS
      SSFDebug::globalDebugger()->belch('vimeoVideoInfo->getInfoSuccess()', 'SUCCESS', $showBasicDiagnostics);
      // TODO height and width should not be cached in an HTMLGen instance variable
      self::$vimeoFrameWidthInPixels = $vimeoVideoInfo->width();
      self::$vimeoFrameHeightInPixels = $vimeoVideoInfo->height();
      if (($vimeoVideoInfo->privacyCode() != 'anybody') && ($vimeoVideoInfo->privacyCode() != '')) {
        $vimeoInfoString .= '<span style="font-size:11px;"> (Privacy: ' . $vimeoVideoInfo->privacyDisplay()  . '.)</span>';
      }
    }
    return $vimeoInfoString;
  }  
  
  public function idIsValid() {
    $showValidityDiagnostics = -1;
    SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid A', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
    if ($this->computedVimeoIdHasBeenComputed) return $this->computedVimeoIdIsValid;
    else {
      SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid B', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
      $this->computedVimeoIdIsValid = true;
      // assert($vimeoVideoId is 8 digits in ['0' - '9'])
      SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid C', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
      $idIsDigits = (strlen($this->computedVimeoId) >= 8);
      SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid D', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
      if ($idIsDigits) { 
        $chars = str_split($this->computedVimeoId);
        SSFDebug::globalDebugger()->belch('$chars ', $chars, -1);
        for($i = 0; $i < count($chars); $i++) { 
          if (($chars[$i] > '9') || ($chars[$i] < '0')) {
            $idIsDigits = false;
            $this->computedVimeoIdIsValid = false;
            SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid E', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
            break;
          }
        }
      } 
      SSFDebug::globalDebugger()->becho('this->computedVimeoIdIsValid F', (($this->computedVimeoIdIsValid) ? 'TRUE' : 'FALSE'), $showValidityDiagnostics);
      return $idIsDigits;
    }
  }
  
  // END public API

  
  // video items
  private $embedPrivacy = '';  // embed_privacy
  private $id = '';            // id
  private $isHD = 0;           // is_hd
  private $isTranscoding = 0;  // is_transcoding
  private $privacy = '';       // privacy
  private $title = '';         // title
  private $description = '';   // description
  private $uploadDate = '';    // upload_date
  private $modifiedDate = '';  // modified_date
  private $width = 0;          // width
  private $height = 0;         // height
  private $duration = 0;       // duration
  // video owner items
  private $ownerId = '';        // id
  private $ownerUsername = '';  // username
  private $ownerRealName = '';  // realname
  private $ownerIsPlus = '';    // is_plus
  private $ownerIsPro = '';     // is_pro

  private static $showVideoInfoFromVimeo = -1;
  private $vimeoWebAddress = '';
  private $vimeoPassword = '';
  private $computedVimeoId = '';
  private $computedVimeoIdIsValid = false;
  private $computedVimeoIdHasBeenComputed = false;
  private $rawVimeoInfoState = 2;
  
  private static $vimeoConnection = 0;
  
  private static $vimeoInfoMsgMap = array(0 => 'NOT SET', 1 => 'FALSE', 2 => 'SUCCESS', 3 => 'ARRAY', 4 => 'EMPTY ARRAY', 5 => 'OBJECT', 
                                          6 => 'STRING', 7 => 'UNRECOGNIZED DATA TYPE', 8 => '2nd READ REQRD', 9 => 'NOT STD-CLASS');
//                                                                                      8 => FAILURE OBJECT, aka 2nd READ REQUIRED

  private static $vimeoPrivacy = array('anybody' => 'Anyone', 'nobody' => 'Nobody else', 'contacts' => 'My contacts', 
                                       'users' => 'People you choose', 'password' => 'Password protected', 'disable' => 'Invisible', );

  // constructor
  public function __construct($vimeoWebAddressInput, $vimeoPasswordInput = '', $showBasicDiagnostics = -1) {
    $this->vimeoWebAddress = $vimeoWebAddressInput;
    $this->vimeoPassword = $vimeoPasswordInput;
    $this->rawVimeoInfoState = 2;
    $this->vimeoWebAddress = $vimeoWebAddressInput;
    $this->computedVimeoId = self::computeVideoId();
    $this->vimeoPassword = $vimeoPasswordInput;
    if (self::$vimeoConnection === 0) self::$vimeoConnection = SSFVimeo::establishVimeoConnection();
    $vimeoVideoIdIsValid = $this->idIsValid();
    SSFDebug::globalDebugger()->becho('this->idIsValid()', ($vimeoVideoIdIsValid) ? 'YES' : 'NO', -1);
    if (!$vimeoVideoIdIsValid) {
       SSFDebug::globalDebugger()->belch('INVALID Vimeo Id ', $this->computedVimeoId, $showBasicDiagnostics);
    } else try {
      // Call vimeo.videos.getInfo().
      $rawVimeoInfo = self::$vimeoConnection->call('vimeo.videos.getInfo', array('format' => 'php', 'video_id' => $this->computedVimeoId));
      // Analyze the result of the call, setting $rawVimeoInfoState (see $vimeoInfoMsgMap) and issuing a diagnostic message as appropriate.
      if (!isset($rawVimeoInfo)) { // The result of the call to vimeo.videos.getInfo() is not set, implying that the connection failed.
        $this->rawVimeoInfoState = 0;  // NOT SET
        SSFDebug::globalDebugger()->belch('Vimeo Connection Failed. $rawVimeoInfo is NOT SET.', '', $showBasicDiagnostics); 
      } else if ($rawVimeoInfo === false) { // The result of the call to vimeo.videos.getInfo() is FALSE
        SSFDebug::globalDebugger()->belch('getInfo() FAILED. Returned BOOL FALSE', $rawVimeoInfo, -1);
        $this->rawVimeoInfoState = 1; // FALSE
        SSFDebug::globalDebugger()->belch('rawVimeoInfo is BOOL', 'FALSE', $showBasicDiagnostics); 
      } else if (is_array($rawVimeoInfo)) { // The result of the call to vimeo.videos.getInfo() is an ARRAY
        $this->rawVimeoInfoState = 3; // ARRAY
        SSFDebug::globalDebugger()->belch('rawVimeoInfo is ARRAY', $rawVimeoInfo, $showBasicDiagnostics);
        if (count($rawVimeoInfo) == 0)  {  // The result of the call to vimeo.videos.getInfo() is an EMPTY ARRAY
          $this->rawVimeoInfoState = 4; // EMPTY ARRAY
          SSFDebug::globalDebugger()->belch('getInfo() FAILED. Returned EMPTY array', $rawVimeoInfo, $showBasicDiagnostics); 
        }
      } else if (is_string($rawVimeoInfo)) { // The result of the call to vimeo.videos.getInfo() is a STRING 
        $this->rawVimeoInfoState = 6; // STRING
        SSFDebug::globalDebugger()->belch('rawVimeoInfo is STRING', $rawVimeoInfo, $showBasicDiagnostics); 
      } else if (is_object($rawVimeoInfo)) { // The result of the call to vimeo.videos.getInfo() is an OBJECT as expected. 
        $this->rawVimeoInfoState = 5; // OBJECT
        SSFDebug::globalDebugger()->belch('rawVimeoInfo is OBJECT', SSFVimeo::objectToArray($rawVimeoInfo), $showBasicDiagnostics); 
        SSFDebug::globalDebugger()->belch('Hello Mary Lou', '', $showBasicDiagnostics); 
        // Now analyze the OBJECT returned from the call to vimeo.videos.getInfo().
        $infoClass = new ReflectionClass($rawVimeoInfo);
        SSFDebug::globalDebugger()->belch('Goodbye heart', '', $showBasicDiagnostics); 
        SSFDebug::globalDebugger()->belch('infoClass', $infoClass, $showBasicDiagnostics);
        SSFDebug::globalDebugger()->belch('O Mary Lou', '', $showBasicDiagnostics); 
        SSFDebug::globalDebugger()->belch('rawVimeoInfo 10', $rawVimeoInfo, $showBasicDiagnostics);
        SSFDebug::globalDebugger()->belch('Im so in love with you', '', $showBasicDiagnostics); 
        if ($infoClass->getName() == 'stdClass') { 
          // Convert the call result from an Object to an Array.
          $rawVimeoInfoAsArray = SSFVimeo::objectToArray($rawVimeoInfo);
          SSFDebug::globalDebugger()->belch('rawVimeoInfoAsArray 11', $rawVimeoInfoAsArray, $showBasicDiagnostics);
          // Make sure the object is not the Failure result and it really contains data.
          if (isset($rawVimeoInfoAsArray['stat']) && ($rawVimeoInfoAsArray['stat'] != NULL) && $rawVimeoInfoAsArray['stat'] == 'fail') { 
            // The result of the call to vimeo.videos.getInfo() is a Failure so issue a diagnostic as appropriate.
            $this->rawVimeoInfoState = 8; // FAILURE OBJECT, aka 2nd READ REQUIRED
            if (isset($rawVimeoInfoAsArray['err']['expl'])) { 
              SSFDebug::globalDebugger()->becho('* PASSWORD?', ('Vimeo video id: ' . $this->computedVimeoId . '; Code: ' .$rawVimeoInfoAsArray['err']['code'] . '; Expl: ' .$rawVimeoInfoAsArray['err']['expl']), $showBasicDiagnostics); 
            }
          } else { // Aha! We finally conclude that the result of the call to vimeo.videos.getInfo() is a SUCCESS.
            // Assign the vallues to the fields.
            $this->embedPrivacy = $rawVimeoInfoAsArray['video'][0]['embed_privacy'];
            $this->id = $rawVimeoInfoAsArray['video'][0]['id'];
            $this->isHD = $rawVimeoInfoAsArray['video'][0]['is_hd'];
            $this->isTranscoding = $rawVimeoInfoAsArray['video'][0]['is_transcoding'];
            $this->privacy = $rawVimeoInfoAsArray['video'][0]['privacy'];
            $this->title = $rawVimeoInfoAsArray['video'][0]['title'];
            $this->description = $rawVimeoInfoAsArray['video'][0]['description'];
            $this->uploadDate = $rawVimeoInfoAsArray['video'][0]['upload_date'];
            $this->modifiedDate = $rawVimeoInfoAsArray['video'][0]['modified_date'];
            $this->width = $rawVimeoInfoAsArray['video'][0]['width'];
            $this->height = $rawVimeoInfoAsArray['video'][0]['height'];
            $this->duration = $rawVimeoInfoAsArray['video'][0]['duration'];
            $this->ownerId = $rawVimeoInfoAsArray['video'][0]['owner']['id'];
            $this->ownerUsername = $rawVimeoInfoAsArray['video'][0]['owner']['username'];
            $this->ownerRealName = $rawVimeoInfoAsArray['video'][0]['owner']['realname'];
            $this->ownerIsPlus = $rawVimeoInfoAsArray['video'][0]['owner']['is_plus'];
            $this->ownerIsPro = $rawVimeoInfoAsArray['video'][0]['owner']['is_pro'];
            SSFDebug::globalDebugger()->belch('rawVimeoInfoAsArray', $rawVimeoInfoAsArray, self::$showVideoInfoFromVimeo);
          }
        } else { // since the Class of object returned is not stdClass, issue a diagnostic as appropriate
          $this->rawVimeoInfoState = 9; // 'NOT STD-CLASS'
          SSFDebug::globalDebugger()->becho('Vimeo Connection Failed', 'Class of object returned is not stdClass.', $showBasicDiagnostics);
        } // END else if is_object()
      } else { // The result of the call to vimeo.videos.getInfo() is SOMETHING ELSE that we didn't explicitly test for.
        $this->rawVimeoInfoState = 7; // SOMETHING ELSE, UNRECOGNIZED DATA TYPE
        SSFDebug::globalDebugger()->belch('rawVimeoInfo is SOMETHING ELSE, UNRECOGNIZED DATA TYPE', $rawVimeoInfo, $showBasicDiagnostics); 
      } // END of try block
    } catch (VimeoAPIException $e) { // The call to vimeo.videos.getInfo() generated an Exception.
      $this->rawVimeoInfoState = 10; // EXCEPTION
      SSFDebug::globalDebugger()->becho('Vimeo API EXCEPTION for getInfo(); code ', $e->getCode() . ' - ' . $e->getMessage(), -1);
    }
  }

  private function computeVideoId() {
    $lastSlashIndex = 0;
    $lastSlashIndex = strrpos($this->vimeoWebAddress, "/");
    $this->computedVimeoId = substr($this->vimeoWebAddress, $lastSlashIndex+1);
    if (strpos($this->vimeoWebAddress, 'http') === false) $computedVimeoId = 'http://' . $this->vimeoWebAddress;
    SSFDebug::globalDebugger()->becho('VIMEO Web Address EXISTS', $this->vimeoWebAddress, -1);
    // Sets $this->computedVimeoIdIsValid as a side-effect
    $this->computedVimeoIdIsValid = false; // Set to false before initialization because $computedVimeoIdIsValid is referenced in idIsValid().
    $this->computedVimeoIdIsValid = $this->idIsValid();
    $this->computedVimeoIdHasBeenComputed = true;
    return $this->computedVimeoId;
  }
  
  /*
  Try to screen scrape the web page fails because we need to be logged in.
    // See what we find when we load the vimeo video page. Looking only for "not available for download" at this time.
    // This didn't work because we need to somehow login first.
    $vimeoPage1Handle = fopen($vimeoWebAddress, "rb");
    $vimeoPage1Contents = '';
    while (!feof($vimeoPage1Handle)) {
      $vimeoPage1Contents .= fread($vimeoPage1Handle, 8192);
    }
    fclose($vimeoPage1Handle);
    SSFDebug::globalDebugger()->becho('contents', $vimeoPage1Contents, -1);
    $result = preg_match("/not available for download/", $vimeoPage1Contents, $matches);
    SSFDebug::globalDebugger()->belch('matches', $matches, -1);
    SSFDebug::globalDebugger()->belch('result', $result, -1);
  */    

} // END class vimeoVideoInfo
