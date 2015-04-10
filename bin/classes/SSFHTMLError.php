<?php
// From http://wiki.dreamhost.com/Custom_error_pages (Advanced error.php) which, in turn
// is based on http://www.askapache.com/wordpress/wordpress-404.html
 
class SSFHTMLError { 
  private static $AA_REQUEST_METHOD = NULL;
  private static $AA_REASON_PHRASE = NULL;
  private static $AA_MESSAGE = NULL;
  private static $AA_STATUS_CODE = NULL;
  private static $hostname;
  private static $textColor;
  private static $ERROR_CODES = array(
    '400' => array('Bad Request', 'Your browser sent a request that this server could not understand.'),
    '401' => array('Authorization Required', 'This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn\'t understand how to supply the credentials required.'),
    '402' => array('Payment Required', 'INTERROR'),
//    '403' => array('Forbidden', 'You don\'t have permission to access REQURID on ' . self::$hostname . '.'),
//    '403' => array('Forbidden', 'You don\'t have permission to access REQURID at <hostname>.'),
    '403' => array('Forbidden', 'You don\'t have permission to access the REQURID index at <hostname>.'),
//    '404' => array('Not Found', 'We couldn\'t find <acronym title="REQURID">that uri</acronym> on our server, though it\'s most certainly not your fault.'),
//    '404' => array('Not Found', 'We couldn\'t find that web page at ' . self::$hostname . '.'),
    '404' => array('Not Found', 'We couldn\'t find the page REQURID at <hostname>.'),
    '405' => array('Method Not Allowed', 'The requested method THEREQMETH is not allowed for the URL REQURID.'),
    '406' => array('Not Acceptable', 'An appropriate representation of the requested resource REQURID could not be found on this server.'),
    '407' => array('Proxy Authentication Required', 'This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn\'t understand how to supply the credentials required.'),
    '408' => array('Request Time-out', 'Server timeout waiting for the HTTP request from the client.'),
    '409' => array('Conflict', 'INTERROR'),
    '410' => array('Gone', 'The requested resourceREQURIDis no longer available on this server and there is no forwarding address. Please remove all references to this resource.'),
    '411' => array('Length Required', 'A request of the requested method GET requires a valid Content-length.'),
    '412' => array('Precondition Failed', 'The precondition on the request for the URL REQURID evaluated to false.'),
    '413' => array('Request Entity Too Large', 'The requested resource REQURID does not allow request data with GET requests, or the amount of data provided in the request exceeds the capacity limit.'),
    '414' => array('Request-URI Too Large', 'The requested URL\'s length exceeds the capacity limit for this server.'),
    '415' => array('Unsupported Media Type', 'The supplied request data is not in a format acceptable for processing by this resource.'),
    '416' => array('Requested Range Not Satisfiable', ''),
    '417' => array('Expectation Failed', 'The expectation given in the Expect request-header field could not be met by this server. The client sent <code>Expect:</code>'),
    '422' => array('Unprocessable Entity', 'The server understands the media type of the request entity, but was unable to process the contained instructions.'),
    '423' => array('Locked', 'The requested resource is currently locked. The lock must be released or proper identification given before the method can be applied.'),
    '424' => array('Failed Dependency', 'The method could not be performed on the resource because the requested action depended on another action and that other action failed.'),
    '425' => array('No code', 'INTERROR'),
    '426' => array('Upgrade Required', 'The requested resource can only be retrieved using SSL. The server is willing to upgrade the current connection to SSL, but your client doesn\'t support it. Either upgrade your client, or try requesting the page using https://'),
    '500' => array('Internal Server Error', 'INTERROR'),
    '501' => array('Method Not Implemented', 'GET to REQURID not supported.'),
    '502' => array('Bad Gateway', 'The proxy server received an invalid response from an upstream server.'),
    '503' => array('Service Temporarily Unavailable', 'The server is temporarily unable to service your request due to maintenance downtime or capacity problems. Please try again later.'),
    '504' => array('Gateway Time-out', 'The proxy server did not receive a timely response from the upstream server.'),
    '505' => array('HTTP Version Not Supported', 'INTERROR'),
    '506' => array('Variant Also Negotiates', 'A variant for the requested resource <code>REQURID</code> is itself a negotiable resource. This indicates a configuration error.'),
    '507' => array('Insufficient Storage', 'The method could not be performed on the resource because the server is unable to store the representation needed to successfully complete the request. There is insufficient free space left in your storage allocation.'),
    '510' => array('Not Extended', 'A mandatory extension policy in the request is not accepted by the server for this resource.')
    );
  
  private static function initialize($hostname, $color) {
    // method added by DHL 4/10/15
    
    self::$hostname = substr($hostname, 0, strlen($hostname)-1);
    self::$textColor = $color;
    
    self::$ERROR_CODES['403'][1] = str_replace('<hostname>', self::$hostname, self::$ERROR_CODES['403'][1]); 
    self::$ERROR_CODES['404'][1] = str_replace('<hostname>', self::$hostname, self::$ERROR_CODES['404'][1]); 

    // Tries to determine the error status code encountered by the server
    if(isset($_SERVER['REDIRECT_STATUS']) && $_SERVER['REDIRECT_STATUS']!='200') {
      self::$AA_STATUS_CODE = $_SERVER['REDIRECT_STATUS'];
    }
    
    if (isset(self::$AA_STATUS_CODE)) {
      self::$AA_REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
      $AA_THE_REQUEST = htmlentities(strip_tags($_SERVER['REQUEST_URI']));
      self::$AA_REASON_PHRASE = self::$ERROR_CODES[self::$AA_STATUS_CODE][0];
      $AA_M_SR = array(array('INTERROR','REQURID','THEREQMETH'), array('The server encountered an internal error or misconfiguration and was unable to complete your request.', $AA_THE_REQUEST, self::$AA_REQUEST_METHOD));
      self::$AA_MESSAGE = str_replace($AA_M_SR[0], $AA_M_SR[1], self::$ERROR_CODES[self::$AA_STATUS_CODE][1]);
    }

    /*
    // begin the output buffer to send headers and resonse
    ob_start();
    @header("HTTP/1.1 self::$AA_STATUS_CODE self::$AA_REASON_PHRASE",1);
    @header("Status: self::$AA_STATUS_CODE self::$AA_REASON_PHRASE",1);
    */
  }
      
  // prints out the html for the error, taking the status code as input
  private static function aa_print_html ($AA_C){     
    if($AA_C == '400'||$AA_C == '401'||$AA_C == '403'||$AA_C == '404'||$AA_C == '405'||$AA_C[0] == '5') {
        @header("Connection: close",1);
        
        if($AA_C=='405')@header('Allow: GET,HEAD,POST,OPTIONS,TRACE');
        
//        echo "<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">\n<html><head>";
//        echo "<title>$AA_C self::$AA_REASON_PHRASE</title>";
//        echo "<h1>self::$AA_REASON_PHRASE</h1>\n<p>self::$AA_MESSAGE<br>\n</p>\n</body></html>";
        echo '<div style="vertical-align:middle;margin:0px;margin-bottom:31px;padding:8px;padding-bottom:6px;border:1px solid ' . self::$textColor . ';width:580px;">' . PHP_EOL;
        echo '  <h1 style="padding:0;float:left;color:' . self::$textColor . ';vertical-align:middle;">' . self::$AA_REASON_PHRASE. '</h1>' . PHP_EOL;
        echo '  <div style="float:left;margin:0;margin-left:10px;padding-left:10px;width:430px;font-size:13px;line-height:110%;border-left:1px solid gray;vertical-align:middle;">HTML Error ' . $AA_C . '. ' . self::$AA_MESSAGE . ' You\'ve been redirected to the Welcome page. <b><i>Welcome!</i></b></div>' . PHP_EOL;
        echo '  <div style="clear:both;"></div>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
        return true;
    } else return false;
  }
  
  public static function displayHTMLErrorIfAny($hostname, $textColor) {
    self::initialize($hostname, $textColor);
    if (isset(self::$AA_STATUS_CODE)) { self::aa_print_html(self::$AA_STATUS_CODE, $textColor); }
  }
  
}
?>
