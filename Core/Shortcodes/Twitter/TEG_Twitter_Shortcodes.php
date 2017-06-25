<?php
namespace Core\Shortcodes\Twitter;
class TEG_Twitter_Shortcodes{

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }

        $this->registerAllTwitterShortcodes();

    }

    public function registerAllTwitterShortcodes(){

        add_shortcode('twitter_tweets', array( '\Core\Shortcodes\Twitter\TEG_Twitter_Tweets_Shortcode' , 'callback') );

        add_shortcode('twitter_trends', array( '\Core\Shortcodes\Twitter\TEG_Twitter_Trends_Shortcode' , 'callback') );

    }

    function __destruct(){

    }

}