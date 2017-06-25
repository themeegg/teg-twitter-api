<?php
namespace TEG_Design\Core;
interface TEG_Shortcode_Interface{
    function __construct();
    public function attribute(Array $args);
    public static function callback(Array $args);
    public function controller(Array $args);
    public function template(Array $data);
    function __destruct();
}