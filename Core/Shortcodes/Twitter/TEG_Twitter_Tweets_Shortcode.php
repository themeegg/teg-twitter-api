<?php
namespace Core\Shortcodes\Twitter;
use TEG_Design\Core\TEG_Shortcode_Interface;
class TEG_Twitter_Tweets_Shortcode implements TEG_Shortcode_Interface{

    private static $instance;

    function __construct(){

        if( ! defined('ABSPATH') ){
            exit;
        }

    }

    public function attribute(Array $atts){

        $defaultAttr = array(
            'count'=>5,
            'title'=>'Twitter Tweets',
        );

        return wp_parse_args($atts, $defaultAttr);

    }

    public static function callback(Array $atts){

        if (self::$instance == null) {

            self::$instance = new self();

        }

        self::$instance->controller($atts);

    }

    public function controller(Array $atts){

        $atts = $this->attribute($atts);

        $data['attribute'] = $atts;

        if( $atts['count']<1 ){

            $atts['count'] = 5;

        }

        $twitterObj = new \Api\Twitter\TwitterTweets();

        $tweetsArray = $twitterObj->getTweets( $atts['count'] );

        $data['twitter'] = $tweetsArray;
        $data['attribute'] = $atts;

        $this->template($data);

    }

    public function template(Array $data){

        $twitterArray = $data['twitter'];

        extract($data['attribute']);

        ?>

        <div class="twitter-content">

            <h2><?php echo $title; ?></h2>

            <div class="twitter-tweets">

                <?php foreach( $twitterArray as $singleTweet ){ ?>

                    <p><?php echo $singleTweet['text']; ?></p>

                <?php } ?>

            </div>

        </div>

        <?php
    }

    function __destruct(){

    }

}