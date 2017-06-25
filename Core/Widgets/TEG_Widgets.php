<?php
namespace Core\Widgets;
class TEG_Widgets{

    function __construct(){


        if( ! defined('ABSPATH') ){
            exit;
        }

        $this->getAllWidgets();

    }

    public function getAllWidgets(){

        new \Core\Widgets\Twitter\TEG_Twitter_Widgets();

    }

    function __destruct(){

    }
}