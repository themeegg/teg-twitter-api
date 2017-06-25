<?php
/*
 * @package social-share
 */
/*
Plugin Name: Twitter API Master
Plugin URI: http://themeegg.com/teg-twitter-api-master
Description: This plugin for Twitter Widgets Shortcodes and Many more.
Version: 1.0
Author: ThemeEgg Team
Author URI: http://themeegg.com
License: GPLv2 or later
Text Domain: teg-twitter-api
*/

if( ! defined('ABSPATH') ){
    exit;
}

require_once 'config.php';

new Core\TEG_Core();