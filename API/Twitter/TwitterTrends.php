<?php
namespace API\Twitter;
use Api\Twitter\TwitterAPI\TwitterSettings;
use Api\Twitter\TwitterAPI\TwitterAPIExchange;
class TwitterTrends{

    public $url = 'https://api.twitter.com/1.1/trends/place.json';

    public $availableUrl = 'GET https://api.twitter.com/1.1/trends/available.json';

    public $getfield = '?id=1';

    public $requestMethod = 'GET';

    function __construct(){

        defined('ABSPATH') or exit;

    }

    public function setGetField($locationID){

        $this->getfield = '?id='.$locationID;

    }

    public function getGetField(){

        return $this->getfield;

    }


    public function setAvailableUrl($availableUrl){

        $this->availableUrl = $availableUrl;

    }

    public function getAvailableUrl(){

        return $this->availableUrl;

    }

    public function setCurlUrl($curlUrl){

        $this->url = $curlUrl;

    }

    public function getCurlUrl(){

        return $this->url;

    }

    public function getTrends(){

        $twitterSettings = new TwitterSettings();

        $twitter = new TwitterAPIExchange( $twitterSettings->getTwitterSettings() );

        $trends =  $twitter->setGetfield( $this->getfield )->buildOauth( $this->url, $this->requestMethod )->performRequest();

        $trends_array = json_decode($trends);

        $trends_array = $trends_array[0]->trends;

        return $trends_array;

    }

    function __destruct(){

    }

}