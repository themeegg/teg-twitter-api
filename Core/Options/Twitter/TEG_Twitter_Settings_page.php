<?php
namespace Core\Options\Twitter;
use \TEG_Design\Core\TEG_Option_Interface;
class TEG_Twitter_Settings_Page implements TEG_Option_Interface{

    function __construct(){

        defined('ABSPATH') or exit;

        $this->addActionHook();

    }

    public function addActionHook(){
        add_action("admin_menu", array($this, 'addOptionsPages') );
    }

    public function addOptionsPages(){

        add_submenu_page("themeegg-plugin-master", "Twitter Settings", "Twitter Settings", "manage_options", "teg-twitter-settings", array($this, 'templates'), null, 60);

        add_action( 'admin_init', array( $this, 'registerThemeOptionGroup' ) );

    }

    public function registerThemeOptionGroup(){
        /*twitter API KEYS*/
        register_setting( 'social_settings_options_group', 'social_settings_options_group_user' );
        register_setting( 'social_settings_options_group', 'social_settings_options_group_oauth_access_token' );
        register_setting( 'social_settings_options_group', 'social_settings_options_group_oauth_access_token_secret' );
        register_setting( 'social_settings_options_group', 'social_settings_options_group_consumer_key' );
        register_setting( 'social_settings_options_group', 'social_settings_options_group_consumer_secret' );

        /*Twitter General Settings*/
        register_setting( 'dg_twitter_settings_option_group_general', 'dg_twitter_settings_option_group_general_settings' );


    }

    public function templates(){

        ?>

        <div class="wrap">
            <h1>Twitter Settings page</h1>

            <?php require_once('Templates/settings-templates.php'); ?>

        </div>

        <?php

    }

    function __destruct(){

    }

}