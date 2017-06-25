<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TEG_TA_Shortcode_Interface
 *
 * Functions that must be defined shortcode classes.
 *
 * @version  1.0.0
 * @category Interface
 * @author   ThemeEgg
 */
interface TEG_TA_Shortcode_Interface
{
    function __construct();

    public function attribute(Array $args);

    public static function callback(Array $args);

    public function controller(Array $args);

    public function template(Array $data);

    function __destruct();
}