<?php
namespace Core\Options\Settings;
class TEG_Settings_Options{

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }

        $this->registerAllSettingsOptions();

    }

    public function registerAllSettingsOptions(){

        new TEG_Main_Settings_Page();

    }

    function __destruct(){

    }

}