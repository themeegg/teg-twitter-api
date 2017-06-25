<?php
namespace API\Twitter;
use Api\Twitter\TwitterAPI\TwitterSettings;
use Api\Twitter\TwitterAPI\TwitterAPIExchange;
class TwitterPostTweets{

    public static $instance;

    public $url = 'https://api.twitter.com/1.1/statuses/update.json';

    public $requestMethod = 'POST';

    private $postFields = array();

    function __construct(){

        defined('ABSPATH') or exit;

        self::setInstance();

    }

    public static function setInstance(){

    }

    public static function getInstance(){

        return self::$instance;

    }

    public function setPostFields(Array $postFields){

        $this->postFields = $postFields;

    }

    public function getPostFields(){

        return $this->postFields;

    }


    public function postTweet(){

        $twitterSettings = new TwitterSettings();

        $twitter = new TwitterAPIExchange( $twitterSettings->getTwitterSettings() );

        $postFields = $this->getPostFields();

        $result = $twitter->buildOauth($this->url, $this->requestMethod)
                    ->setPostfields($postFields)
                    ->performRequest();

        return $result;

    }



    public function deleteTweets(){



    }


    function __destruct(){

    }

}