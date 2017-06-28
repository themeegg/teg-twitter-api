<?php
/**
 * TEG Twitter API Product Settings
 *
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_Twitter_Api/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'TET_TA_Settings_API', false ) ) :

    /**
     * TET_TA_Settings_API.
     */
    class TET_TA_Settings_API extends TEG_TA_Settings_Page {

        /**
         * Constructor.
         */
        public function __construct() {

            $this->id    = 'products';
            $this->label = __( 'Products', 'teg-twitter-api' );

            add_filter( 'teg_twitter_api_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'teg_twitter_api_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'teg_twitter_api_settings_save_' . $this->id, array( $this, 'save' ) );
            add_action( 'teg_twitter_api_sections_' . $this->id, array( $this, 'output_sections' ) );
        }

        /**
         * Get sections.
         *
         * @return array
         */
        public function get_sections() {

            $sections = array(
                ''          	=> __( 'General', 'teg-twitter-api' ),
                'display'       => __( 'Display', 'teg-twitter-api' ),
                'inventory' 	=> __( 'Inventory', 'teg-twitter-api' ),
                'downloadable' 	=> __( 'Downloadable products', 'teg-twitter-api' ),
            );

            return apply_filters( 'teg_twitter_api_get_sections_' . $this->id, $sections );
        }

        /**
         * Output the settings.
         */
        public function output() {
            global $current_section;

            $settings = $this->get_settings( $current_section );

            TEG_TA_Admin_Settings::output_fields( $settings );
        }

        /**
         * Save settings.
         */
        public function save() {
            global $current_section;

            $settings = $this->get_settings( $current_section );
            TEG_TA_Admin_Settings::save_fields( $settings );
        }

        /**
         * Get settings array.
         *
         * @param string $current_section
         *
         * @return array
         */
        public function get_settings( $current_section = '' ) {
            if ( 'display' == $current_section ) {

                $settings = apply_filters( 'teg_twitter_api_product_settings', array(

                    array(
                        'title' => __( 'Shop &amp; product pages', 'teg-twitter-api' ),
                        'type' 	=> 'title',
                        'desc' 	=> '',
                        'id' 	=> 'catalog_options',
                    ),

                    array(
                        'title'    => __( 'Shop page', 'teg-twitter-api' ),
                        'desc'     => '<br/>' . sprintf( __( 'The base page can also be used in your <a href="%s">product permalinks</a>.', 'teg-twitter-api' ), admin_url( 'options-permalink.php' ) ),
                        'id'       => 'teg_twitter_api_shop_page_id',
                        'type'     => 'single_select_page',
                        'default'  => '',
                        'class'    => 'wc-enhanced-select-nostd',
                        'css'      => 'min-width:300px;',
                        'desc_tip' => __( 'This sets the base page of your shop - this is where your product archive will be.', 'teg-twitter-api' ),
                    ),

                    array(
                        'title'    => __( 'Shop page display', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls what is shown on the product archive.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_shop_page_display',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => '',
                        'type'     => 'select',
                        'options'  => array(
                            ''              => __( 'Show products', 'teg-twitter-api' ),
                            'subcategories' => __( 'Show categories', 'teg-twitter-api' ),
                            'both'          => __( 'Show categories &amp; products', 'teg-twitter-api' ),
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'    => __( 'Default category display', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls what is shown on category archives.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_category_archive_display',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => '',
                        'type'     => 'select',
                        'options'  => array(
                            ''              => __( 'Show products', 'teg-twitter-api' ),
                            'subcategories' => __( 'Show subcategories', 'teg-twitter-api' ),
                            'both'          => __( 'Show subcategories &amp; products', 'teg-twitter-api' ),
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'    => __( 'Default product sorting', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls the default sort order of the catalog.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_default_catalog_orderby',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => 'menu_order',
                        'type'     => 'select',
                        'options'  => apply_filters( 'teg_twitter_api_default_catalog_orderby_options', array(
                            'menu_order' => __( 'Default sorting (custom ordering + name)', 'teg-twitter-api' ),
                            'popularity' => __( 'Popularity (sales)', 'teg-twitter-api' ),
                            'rating'     => __( 'Average rating', 'teg-twitter-api' ),
                            'date'       => __( 'Sort by most recent', 'teg-twitter-api' ),
                            'price'      => __( 'Sort by price (asc)', 'teg-twitter-api' ),
                            'price-desc' => __( 'Sort by price (desc)', 'teg-twitter-api' ),
                        ) ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'         => __( 'Add to cart behaviour', 'teg-twitter-api' ),
                        'desc'          => __( 'Redirect to the cart page after successful addition', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_cart_redirect_after_add',
                        'default'       => 'no',
                        'type'          => 'checkbox',
                        'checkboxgroup' => 'start',
                    ),

                    array(
                        'desc'          => __( 'Enable AJAX add to cart buttons on archives', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_enable_ajax_add_to_cart',
                        'default'       => 'yes',
                        'type'          => 'checkbox',
                        'checkboxgroup' => 'end',
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'catalog_options',
                    ),

                    array(
                        'title' => __( 'Product images', 'teg-twitter-api' ),
                        'type' 	=> 'title',
                        'desc' 	=> sprintf( __( 'These settings affect the display and dimensions of images in your catalog - the display on the front-end will still be affected by CSS styles. After changing these settings you may need to <a target="_blank" href="%s">regenerate your thumbnails</a>.', 'teg-twitter-api' ), 'https://wordpress.org/plugins/regenerate-thumbnails/' ),
                        'id' 	=> 'image_options',
                    ),

                    array(
                        'title'    => __( 'Catalog images', 'teg-twitter-api' ),
                        'desc'     => __( 'This size is usually used in product listings. (W x H)', 'teg-twitter-api' ),
                        'id'       => 'shop_catalog_image_size',
                        'css'      => '',
                        'type'     => 'image_width',
                        'default'  => array(
                            'width'  => '300',
                            'height' => '300',
                            'crop'   => 1,
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'    => __( 'Single product image', 'teg-twitter-api' ),
                        'desc'     => __( 'This is the size used by the main image on the product page. (W x H)', 'teg-twitter-api' ),
                        'id'       => 'shop_single_image_size',
                        'css'      => '',
                        'type'     => 'image_width',
                        'default'  => array(
                            'width'  => '600',
                            'height' => '600',
                            'crop'   => 1,
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'    => __( 'Product thumbnails', 'teg-twitter-api' ),
                        'desc'     => __( 'This size is usually used for the gallery of images on the product page. (W x H)', 'teg-twitter-api' ),
                        'id'       => 'shop_thumbnail_image_size',
                        'css'      => '',
                        'type'     => 'image_width',
                        'default'  => array(
                            'width'  => '180',
                            'height' => '180',
                            'crop'   => 1,
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'image_options',
                    ),

                ));
            } elseif ( 'inventory' == $current_section ) {

                $settings = apply_filters( 'teg_twitter_api_inventory_settings', array(

                    array(
                        'title' => __( 'Inventory', 'teg-twitter-api' ),
                        'type' 	=> 'title',
                        'desc' 	=> '',
                        'id' 	=> 'product_inventory_options',
                    ),

                    array(
                        'title'   => __( 'Manage stock', 'teg-twitter-api' ),
                        'desc'    => __( 'Enable stock management', 'teg-twitter-api' ),
                        'id'      => 'teg_twitter_api_manage_stock',
                        'default' => 'yes',
                        'type'    => 'checkbox',
                    ),

                    array(
                        'title'             => __( 'Hold stock (minutes)', 'teg-twitter-api' ),
                        'desc'              => __( 'Hold stock (for unpaid orders) for x minutes. When this limit is reached, the pending order will be cancelled. Leave blank to disable.', 'teg-twitter-api' ),
                        'id'                => 'teg_twitter_api_hold_stock_minutes',
                        'type'              => 'number',
                        'custom_attributes' => array(
                            'min'           => 0,
                            'step'          => 1,
                        ),
                        'css'               => 'width: 80px;',
                        'default'           => '60',
                        'autoload'          => false,
                        'class'             => 'manage_stock_field',
                    ),

                    array(
                        'title'         => __( 'Notifications', 'teg-twitter-api' ),
                        'desc'          => __( 'Enable low stock notifications', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_notify_low_stock',
                        'default'       => 'yes',
                        'type'          => 'checkbox',
                        'checkboxgroup' => 'start',
                        'autoload'      => false,
                        'class'         => 'manage_stock_field',
                    ),

                    array(
                        'desc'          => __( 'Enable out of stock notifications', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_notify_no_stock',
                        'default'       => 'yes',
                        'type'          => 'checkbox',
                        'checkboxgroup' => 'end',
                        'autoload'      => false,
                        'class'         => 'manage_stock_field',
                    ),

                    array(
                        'title'    => __( 'Notification recipient(s)', 'teg-twitter-api' ),
                        'desc'     => __( 'Enter recipients (comma separated) that will receive this notification.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_stock_email_recipient',
                        'type'     => 'text',
                        'default'  => get_option( 'admin_email' ),
                        'css'      => 'width: 250px;',
                        'autoload' => false,
                        'desc_tip' => true,
                        'class'    => 'manage_stock_field',
                    ),

                    array(
                        'title'             => __( 'Low stock threshold', 'teg-twitter-api' ),
                        'desc'              => __( 'When product stock reaches this amount you will be notified via email.', 'teg-twitter-api' ),
                        'id'                => 'teg_twitter_api_notify_low_stock_amount',
                        'css'               => 'width:50px;',
                        'type'              => 'number',
                        'custom_attributes' => array(
                            'min'           => 0,
                            'step'          => 1,
                        ),
                        'default'           => '2',
                        'autoload'          => false,
                        'desc_tip'          => true,
                        'class'             => 'manage_stock_field',
                    ),

                    array(
                        'title'             => __( 'Out of stock threshold', 'teg-twitter-api' ),
                        'desc'              => __( 'When product stock reaches this amount the stock status will change to "out of stock" and you will be notified via email. This setting does not affect existing "in stock" products.', 'teg-twitter-api' ),
                        'id'                => 'teg_twitter_api_notify_no_stock_amount',
                        'css'               => 'width:50px;',
                        'type'              => 'number',
                        'custom_attributes' => array(
                            'min'           => 0,
                            'step'          => 1,
                        ),
                        'default'           => '0',
                        'desc_tip'          => true,
                        'class'             => 'manage_stock_field',
                    ),

                    array(
                        'title'    => __( 'Out of stock visibility', 'teg-twitter-api' ),
                        'desc'     => __( 'Hide out of stock items from the catalog', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_hide_out_of_stock_items',
                        'default'  => 'no',
                        'type'     => 'checkbox',
                    ),

                    array(
                        'title'    => __( 'Stock display format', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls how stock quantities are displayed on the frontend.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_stock_format',
                        'css'      => 'min-width:150px;',
                        'class'    => 'wc-enhanced-select',
                        'default'  => '',
                        'type'     => 'select',
                        'options'  => array(
                            ''           => __( 'Always show quantity remaining in stock e.g. "12 in stock"', 'teg-twitter-api' ),
                            'low_amount' => __( 'Only show quantity remaining in stock when low e.g. "Only 2 left in stock"', 'teg-twitter-api' ),
                            'no_amount'  => __( 'Never show quantity remaining in stock', 'teg-twitter-api' ),
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'product_inventory_options',
                    ),

                ));

            } elseif ( 'downloadable' == $current_section ) {
                $settings = apply_filters( 'teg_twitter_api_downloadable_products_settings', array(
                    array(
                        'title' => __( 'Downloadable products', 'teg-twitter-api' ),
                        'type' 	=> 'title',
                        'id' 	=> 'digital_download_options',
                    ),

                    array(
                        'title'    => __( 'File download method', 'teg-twitter-api' ),
                        'desc'     => __( 'Forcing downloads will keep URLs hidden, but some servers may serve large files unreliably. If supported, <code>X-Accel-Redirect</code>/ <code>X-Sendfile</code> can be used to serve downloads instead (server requires <code>mod_xsendfile</code>).', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_file_download_method',
                        'type'     => 'select',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => 'force',
                        'desc_tip' => true,
                        'options'  => array(
                            'force'     => __( 'Force downloads', 'teg-twitter-api' ),
                            'xsendfile' => __( 'X-Accel-Redirect/X-Sendfile', 'teg-twitter-api' ),
                            'redirect'  => __( 'Redirect only', 'teg-twitter-api' ),
                        ),
                        'autoload' => false,
                    ),

                    array(
                        'title'         => __( 'Access restriction', 'teg-twitter-api' ),
                        'desc'          => __( 'Downloads require login', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_downloads_require_login',
                        'type'          => 'checkbox',
                        'default'       => 'no',
                        'desc_tip'      => __( 'This setting does not apply to guest purchases.', 'teg-twitter-api' ),
                        'checkboxgroup' => 'start',
                        'autoload'      => false,
                    ),

                    array(
                        'desc'          => __( 'Grant access to downloadable products after payment', 'teg-twitter-api' ),
                        'id'            => 'teg_twitter_api_downloads_grant_access_after_payment',
                        'type'          => 'checkbox',
                        'default'       => 'yes',
                        'desc_tip'      => __( 'Enable this option to grant access to downloads when orders are "processing", rather than "completed".', 'teg-twitter-api' ),
                        'checkboxgroup' => 'end',
                        'autoload'      => false,
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'digital_download_options',
                    ),

                ));

            } else {
                $settings = apply_filters( 'teg_twitter_api_products_general_settings', array(
                    array(
                        'title' 	=> __( 'Measurements', 'teg-twitter-api' ),
                        'type' 		=> 'title',
                        'id' 		=> 'product_measurement_options',
                    ),

                    array(
                        'title'    => __( 'Weight unit', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls what unit you will define weights in.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_weight_unit',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => 'kg',
                        'type'     => 'select',
                        'options'  => array(
                            'kg'  => __( 'kg', 'teg-twitter-api' ),
                            'g'   => __( 'g', 'teg-twitter-api' ),
                            'lbs' => __( 'lbs', 'teg-twitter-api' ),
                            'oz'  => __( 'oz', 'teg-twitter-api' ),
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'title'    => __( 'Dimensions unit', 'teg-twitter-api' ),
                        'desc'     => __( 'This controls what unit you will define lengths in.', 'teg-twitter-api' ),
                        'id'       => 'teg_twitter_api_dimension_unit',
                        'class'    => 'wc-enhanced-select',
                        'css'      => 'min-width:300px;',
                        'default'  => 'cm',
                        'type'     => 'select',
                        'options'  => array(
                            'm'  => __( 'm', 'teg-twitter-api' ),
                            'cm' => __( 'cm', 'teg-twitter-api' ),
                            'mm' => __( 'mm', 'teg-twitter-api' ),
                            'in' => __( 'in', 'teg-twitter-api' ),
                            'yd' => __( 'yd', 'teg-twitter-api' ),
                        ),
                        'desc_tip' => true,
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'product_measurement_options',
                    ),

                    array(
                        'title' => __( 'Reviews', 'teg-twitter-api' ),
                        'type' 	=> 'title',
                        'desc' 	=> '',
                        'id' 	=> 'product_rating_options',
                    ),

                    array(
                        'title'           => __( 'Enable reviews', 'teg-twitter-api' ),
                        'desc'            => __( 'Enable product reviews', 'teg-twitter-api' ),
                        'id'              => 'teg_twitter_api_enable_reviews',
                        'default'         => 'yes',
                        'type'            => 'checkbox',
                        'checkboxgroup'   => 'start',
                        'show_if_checked' => 'option',
                    ),

                    array(
                        'desc'            => __( 'Show "verified owner" label on customer reviews', 'teg-twitter-api' ),
                        'id'              => 'teg_twitter_api_review_rating_verification_label',
                        'default'         => 'yes',
                        'type'            => 'checkbox',
                        'checkboxgroup'   => '',
                        'show_if_checked' => 'yes',
                        'autoload'        => false,
                    ),

                    array(
                        'desc'            => __( 'Reviews can only be left by "verified owners"', 'teg-twitter-api' ),
                        'id'              => 'teg_twitter_api_review_rating_verification_required',
                        'default'         => 'no',
                        'type'            => 'checkbox',
                        'checkboxgroup'   => 'end',
                        'show_if_checked' => 'yes',
                        'autoload'        => false,
                    ),

                    array(
                        'title'           => __( 'Product ratings', 'teg-twitter-api' ),
                        'desc'            => __( 'Enable star rating on reviews', 'teg-twitter-api' ),
                        'id'              => 'teg_twitter_api_enable_review_rating',
                        'default'         => 'yes',
                        'type'            => 'checkbox',
                        'checkboxgroup'   => 'start',
                        'show_if_checked' => 'option',
                    ),

                    array(
                        'desc'            => __( 'Star ratings should be required, not optional', 'teg-twitter-api' ),
                        'id'              => 'teg_twitter_api_review_rating_required',
                        'default'         => 'yes',
                        'type'            => 'checkbox',
                        'checkboxgroup'   => 'end',
                        'show_if_checked' => 'yes',
                        'autoload'        => false,
                    ),

                    array(
                        'type' 	=> 'sectionend',
                        'id' 	=> 'product_rating_options',
                    ),

                ));
            }

            return apply_filters( 'teg_twitter_api_get_settings_' . $this->id, $settings, $current_section );
        }
    }

endif;

return new TET_TA_Settings_API();
