<?php
namespace Core\Shortcodes;
class TEG_Shortcodes{

    function __construct(){


        if( ! defined('ABSPATH') ){

            exit;

        }

        $this->getAllShortcodes();

    }

    public function getAllShortcodes(){

        new \Core\Shortcodes\Twitter\TEG_Twitter_Shortcodes();

    }

    function __destruct(){

    }
}