<?php
namespace  API\Twitter;
use Api\Twitter\TwitterAPI\TwitterSettings;
use Api\Twitter\TwitterAPI\TwitterAPIExchange;
class TwitterTweets{

    public $requestMethod = "GET";

    public $count = 5;

    public $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }

    }

    protected function getField($count=null){

        $twitterSettings = new TwitterSettings();

        if( !($count>=1 && $count<=$this->count ) ){

            $count = $this->count;

        }

        $getfield = "?screen_name=".$twitterSettings->getTwitterUser()."&count=$count";

        return $getfield;

    }

    public function getTweets($count=null){

        $twitterSettings = new TwitterSettings();

        $twitter = new TwitterAPIExchange( $twitterSettings->getTwitterSettings() );

        $string = json_decode($twitter->setGetfield($this->getField($count))->buildOauth($this->url, $this->requestMethod)->performRequest(),$assoc = TRUE);

        if(isset($string["errors"][0]["message"])) {

            echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";
            exit();

        }else{

            return $string;

        }

    }

    function __destruct(){

    }

}