<?php
namespace Core\Widgets\Twitter;
class TEG_Twitter_Widgets{

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }


        $this->addActionWidgets();

    }

    public function addActionWidgets(){

        add_action( 'widgets_init', array($this,'registerAllTwitterWidgets') );

    }

    public function registerAllTwitterWidgets(){

        register_widget( '\Core\Widgets\Twitter\TEG_Twitter_Feed_Widget' );

        register_widget( '\Core\Widgets\Twitter\TEG_Twitter_Trends_Widget' );

    }

    function __destruct(){

    }

}