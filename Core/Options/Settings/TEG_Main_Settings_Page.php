<?php
namespace Core\Options\Settings;
use \TEG_Design\Core\TEG_Option_Interface;
class TEG_Main_Settings_Page implements TEG_Option_Interface{

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }

        $this->addActionHook();
    }

    public function addActionHook(){
        add_action("admin_menu", array($this, 'addOptionsPages') );
    }

    public function addOptionsPages(){
    
        add_menu_page("ThemeEgg Settings", "ThemeEgg Settings", "manage_options", "themeegg-plugin-master", array($this, 'templates'), null, 60);

        add_action( 'admin_init', array( $this, 'registerThemeOptionGroup' ) );

    }

    public function registerThemeOptionGroup(){

    }

    public function templates(){

        ?>

        <h2>API Master Settings</h2>

        <?php

    }

    function __destruct(){

    }

}