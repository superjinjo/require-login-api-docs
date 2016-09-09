<?php
/** Load WordPress Bootstrap */
require_once('wp-load.php');

if(!is_user_logged_in()) {
    auth_redirect();
}

if(current_user_can('read_docs')) {
    $file_location = ABSPATH.ltrim($_SERVER["REQUEST_URI"], '/');
    $file_location = str_replace('../', '', $file_location);
    if(is_dir($file_location)) {
        $file_location = rtrim($file_location, '/').'/index.html';
    }

    if(preg_match('/^.+\.(html|htm|txt|css|js)$/i', $file_location) && file_exists($file_location)) {
        echo file_get_contents($file_location);
        exit;
    }
}

echo file_get_contents(ABSPATH.'creeper.html');
