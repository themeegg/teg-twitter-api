<?php
namespace Core\Options\Twitter;
class TEG_Twitter_Options{

    function __construct(){

        defined('ABSPATH') or exit;

        $this->registerAllTwitterOptions();

    }

    public function registerAllTwitterOptions(){

        new \Core\Options\Twitter\Settings\TEG_Twitter_Settings();

        new TEG_Twitter_Settings_Page();

    }

    function __destruct(){

    }

}