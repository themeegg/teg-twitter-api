<?php
/**
 * Setup menus in WP admin.
 *
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_TA_Twitter_Api/Admin
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('TEG_TA_Admin_Menus', false)) :

    /**
     * TEG_TA_Admin_Menus Class.
     */
    class TEG_TA_Admin_Menus
    {

        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            // Add menus
            add_action('admin_menu', array($this, 'admin_menu'), 9);


        }

        /**
         * Add menu items.
         */
        public function admin_menu()
        {
            global $menu;


            $menu_array = array(


            );


            add_menu_page(  __('TEG Twitter', 'teg-twitter-api'),
                __('TEG Twitter', 'teg-twitter-api'),
                'manage_options',
                'extra-post-info',
                'extra_post_info_page',
                'dashicons-media-code',
                9);


        }


    }

endif;

return new TEG_TA_Admin_Menus();
