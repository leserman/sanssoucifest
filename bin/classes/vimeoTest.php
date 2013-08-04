<?php
// Derived from vimeo files/vimeo-vimeo-php-lib-a32ff71/index.php.
require_once('vimeo.php');
include_once './SSFCodeBase.php'; 
include_once SSFCodeBase::autoloadClasses(__FILE__);
session_start();

// Create the object and enable caching
$vimeo = new phpVimeo('54567d028248068bc74b4e124fed601d', 'd8f03d9a623c902f');
$vimeo->enableCache(phpVimeo::CACHE_FILE, './vimeoCache', 300);

// Clear session
if ($_GET['clear'] == 'all') {
    session_destroy();
    session_start();
}

// Set up variables
$state = $_SESSION['vimeo_state'];
$request_token = $_SESSION['oauth_request_token'];
$access_token = $_SESSION['oauth_access_token'];

// Coming back
if ($_REQUEST['oauth_token'] != NULL && $_SESSION['vimeo_state'] === 'start') {
    $_SESSION['vimeo_state'] = $state = 'returned';
}

// If we have an access token, set it
if ($_SESSION['oauth_access_token'] != null) {
    $vimeo->setToken($_SESSION['oauth_access_token'], $_SESSION['oauth_access_token_secret']);
}

switch ($_SESSION['vimeo_state']) {
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
        if ($_SESSION['oauth_access_token'] === NULL && $_SESSION['oauth_access_token_secret'] === NULL) {
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
        try {
            $videos = $vimeo->call('vimeo.videos.getUploaded');
        }
        catch (VimeoAPIException $e) {
            echo "Encountered an API error -- code {$e->getCode()} - {$e->getMessage()}";
        }

        break;
}

function object_to_array($Class) // from Vimeo's object_to_array
    {
        # Typecast to (array) automatically converts stdClass -> array.
        $Class = (array)$Class;

        # Iterate through the former properties looking for any stdClass properties.
        # Recursively apply (array).
        foreach($Class as $key => $value){
            if(is_object($value) && get_class($value)=='stdClass') {
                $Class[$key] = object_to_array($value);
            } else {
                if (is_array($value)) {
                    $Class[$key] = object_to_array($value);
                }
            }
        }
        return $Class;
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Vimeo Advanced API OAuth Example</title>
</head>
<body>

    <h1>Vimeo Advanced API OAuth Example</h1>
    <p>This is a basic example of Vimeo's new OAuth authentication method. Everything is saved in session vars, so <a href="?clear=all">click here if you want to start over</a>.</p>

    <?php if ($_SESSION['vimeo_state'] == 'start'): ?>
        <p>Click the link to go to Vimeo to authorize your account.</p>
        <p><a href="<?php echo $authorize_link ?>"><?php echo $authorize_link ?></a></p> <!-- corrected by DHL 4/30/12 -->
    <?php endif ?>

    <?php if ($ticket): ?>
        <pre><?php print_r($ticket) ?></pre>
    <?php endif ?>

    <?php if ($videos): ?>
        <pre><?php print_r($videos) ?></pre>
    <?php endif ?>

    <?php 
        $rawVimeoInfo = $vimeo->call('vimeo.videos.getInfo', array('format' => 'php', 'video_id' => '33793066'));
        $vimeoVideoInfo = object_to_array($rawVimeoInfo); 
        $items = array('embed_privacy', 'id', 'is_hd', 'is_transcoding', 'privacy', 'title', 'description', 'upload_date', 'modified_date', 'width', 'height', 'duration');
        foreach ($items as $item) { $videoInfoFromVimeo[$item] = $vimeoVideoInfo['video'][0][$item]; }
        SSFDebug::globalDebugger()->belch('videoInfoFromVimeo', $videoInfoFromVimeo, 1);
    ?>

</body>
</html>
