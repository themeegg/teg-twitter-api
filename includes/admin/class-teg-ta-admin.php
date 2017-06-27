<?php
/**
 * TEG_Twitter_Api Admin
 *
 * @class    TEG_TA_Admin
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_Twitter_Api/Admin
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * WC_Admin class.
 */
class TEG_TA_Admin
{

    /**
     * Constructor.
     */
    public function __construct()
    {

        add_action('init', array($this, 'includes'));

    }

    public function includes()
    {

        teg_ta_include(dirname(__FILE__) . '/class-teg-ta-admin-menus.php');


    }

}

return new TEG_TA_Admin();
