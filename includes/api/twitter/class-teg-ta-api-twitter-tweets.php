<?php

class TEG_TA_Api_Twitter_Tweets
{

    public $requestMethod = "GET";

    public $count = 5;

    public $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

    function __construct()
    {

        if (!defined('ABSPATH')) {
            exit;
        }

    }

    protected function getField($count = null)
    {

        $twitterSettings = new TEG_TA_Api_Lib_Settings();

        if ((int)$count < 0) {

            $count = $this->count;

        }

        $getfield = "?screen_name=" . $twitterSettings->getTwitterUser() . "&count=$count";

        return $getfield;

    }

    public function getTweets($count = null)
    {


        $twitterSettings = new TEG_TA_Api_Lib_Settings();

        $twitter = new TEG_TA_Api_Lib_Twitter_Api_Exchange($twitterSettings->getTwitterSettings());

        $string = json_decode($twitter->setGetfield($this->getField($count))->buildOauth($this->url, $this->requestMethod)->performRequest(), $assoc = TRUE);

        if (isset($string["errors"][0]["message"])) {

            echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string[errors][0]["message"] . "</em></p>";
            exit();

        } else {

            return $string;

        }

    }

    function __destruct()
    {

    }

}