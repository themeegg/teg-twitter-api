<?php
namespace Core\Options;
class TEG_Options{

    function __construct(){

        defined('ABSPATH') or exit;

        $this->getOptions();

    }

    function getOptions(){

        new \Core\Options\Settings\TEG_Settings_Options();

        new \Core\Options\Twitter\TEG_Twitter_Options();

    }

    function __destruct(){



    }

}