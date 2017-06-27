<?php
/**
 * Installation related functions and actions.
 *
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_TA_Twitter_Api/Classes
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TEG_TA_Install Class.
 */
class TEG_TA_Install
{

    /** @var object Background update class */
    private static $background_updater;

    /** @var array DB updates and callbacks that need to be run per version */
    private static $db_updates = array();

    /**
     * Hook in tabs.
     */
    public static function init()
    {
        add_action('init', array(__CLASS__, 'check_version'), 5);
        add_action('admin_init', array(__CLASS__, 'install_actions'));

    }

    /**
     * Check TEG_TA_Twitter_Api version and run the updater is required.
     *
     * This check is done on all requests and runs if the versions do not match.
     */
    public static function check_version()
    {
        if (!defined('IFRAME_REQUEST') && get_option('teg_ta_version') !== TEGTApi()->version) {
            self::install();
            do_action('teg_twitter_api_updated');
        }
    }

    /**
     * Install actions when a update button is clicked within the admin area.
     *
     * This function is hooked into admin_init to affect admin only.
     */
    public static function install_actions()
    {

    }

    /**
     * Install TEG_Twitter_Api.
     */
    public static function install()
    {
        global $wpdb;

        if (!is_blog_installed()) {
            return;
        }

        if (!defined('TEG_TA_INSTALLING')) {
            define('TEG_TA_INSTALLING', true);
        }


        // Trigger action
        do_action('teg_twitter_api_installed');
    }


}

TEG_TA_Install::init();
