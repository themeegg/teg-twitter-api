<?php
namespace Core\Shortcodes\Twitter;
use TEG_Design\Core\TEG_Shortcode_Interface;
class TEG_Twitter_Trends_Shortcode implements TEG_Shortcode_Interface
{

    private static $instance;

    function __construct()
    {

        if (!defined('ABSPATH')) {
            exit;
        }

    }

    public function attribute(Array $atts)
    {
        $defaultAttr = array(
            'count' => 5,
            'woeid' => 1,
            'title' => 'Twitter Trends',
        );

        return wp_parse_args($atts, $defaultAttr);

    }

    public static function callback(Array $atts)
    {

        if (self::$instance == null) {

            self::$instance = new self();

        }

        self::$instance->controller($atts);

    }

    public function controller(Array $atts)
    {

        $atts = $this->attribute($atts);

        $twitterObj = new \Api\Twitter\TwitterTrends();

        if(is_numeric($atts['woeid'])){
            $twitterObj->setGetField($atts['woeid']);
        }

        $trendArr = $twitterObj->getTrends();

        $data['twitter'] = $trendArr;

        $data['attributes'] = $atts;

        $this->template($data);

    }

    public function template(Array $data){

        if( isset( $data['attributes']['data'] ) ){

            echo '<h2>Sorry There is no data attribute in this shortcode.</h2>';

            return;

        }

        extract($data['attributes']);

        if ($count < 1) {
            $count = 5;
        }

        $twitterArr = $data['twitter'];

        ?>

        <ul class="twitter-trends">

            <h2><?php echo $title; ?></h2>

            <?php
            foreach ($twitterArr as $key=>$singleTrends) {
                if($key>=$count){
                    break;
                }
                ?>

                <li>
                    <a target="_blank" href="<?php echo $singleTrends->url; ?>">
                        <b><?php echo $singleTrends->name; ?></b>
                    </a>
                    <?php if($singleTrends->tweet_volume): ?>
                        <span>(<?php echo $singleTrends->tweet_volume; ?>)</span>
                    <?php endif; ?>
                </li>

            <?php } ?>

        </ul>


        <?php
    }

    function __destruct()
    {

    }

}