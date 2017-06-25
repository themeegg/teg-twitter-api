<?php
if( ! defined('ABSPATH') ){
    exit;
}

function pp($args){
    echo '<pre>';
    print_r($args);
    echo '</pre>';
}

define('APIALL_TWITTER_FEEDS', plugin_dir_path(__FILE__) );

require_once 'autoloader.php';