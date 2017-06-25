<?php

if( ! defined('ABSPATH') ){
    exit;
}

spl_autoload_register(function($className){
    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $filePath = plugin_dir_path(__FILE__).''.$className.'.php';
    if(file_exists($filePath)):
        require_once($filePath);
    else:
       /* echo '<h1>';
        echo $filePath.' File not found';
        echo '</h1>';*/
    endif;
});