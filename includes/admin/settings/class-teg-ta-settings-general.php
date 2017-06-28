<?php
/**
 * WooCommerce General Settings
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Settings_General', false ) ) :

    /**
     * WC_Admin_Settings_General.
     */
    class WC_Settings_General extends TEG_TA_Settings_Page {

        /**
         * Constructor.
         */
        public function __construct() {

            $this->id    = 'general';
            $this->label = __( 'General', 'teg-twitter-api' );

            add_filter( 'teg_twitter_api_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'teg_twitter_api_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'teg_twitter_api_settings_save_' . $this->id, array( $this, 'save' ) );
        }

        /**
         * Get settings array.
         *
         * @return array
         */
        public function get_settings() {

            $currency_code_options =array();

            $settings = apply_filters( 'teg_twitter_api_general_settings', array(

                array( 'title' => __( 'General options', 'teg-twitter-api' ), 'type' => 'title', 'desc' => '', 'id' => 'general_options' ),

                array(
                    'title'    => __( 'Base location', 'teg-twitter-api' ),
                    'desc'     => __( 'This is the base location for your business. Tax rates will be based on this country.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_default_country',
                    'css'      => 'min-width:350px;',
                    'default'  => 'GB',
                    'type'     => 'single_select_country',
                    'desc_tip' => true,
                ),

                array(
                    'title'    => __( 'Selling location(s)', 'teg-twitter-api' ),
                    'desc'     => __( 'This option lets you limit which countries you are willing to sell to.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_allowed_countries',
                    'default'  => 'all',
                    'type'     => 'select',
                    'class'    => 'wc-enhanced-select',
                    'css'      => 'min-width: 350px;',
                    'desc_tip' => true,
                    'options'  => array(
                        'all'        => __( 'Sell to all countries', 'teg-twitter-api' ),
                        'all_except' => __( 'Sell to all countries, except for&hellip;', 'teg-twitter-api' ),
                        'specific'   => __( 'Sell to specific countries', 'teg-twitter-api' ),
                    ),
                ),

                array(
                    'title'   => __( 'Sell to all countries, except for&hellip;', 'teg-twitter-api' ),
                    'desc'    => '',
                    'id'      => 'teg_twitter_api_all_except_countries',
                    'css'     => 'min-width: 350px;',
                    'default' => '',
                    'type'    => 'multi_select_countries',
                ),

                array(
                    'title'   => __( 'Sell to specific countries', 'teg-twitter-api' ),
                    'desc'    => '',
                    'id'      => 'teg_twitter_api_specific_allowed_countries',
                    'css'     => 'min-width: 350px;',
                    'default' => '',
                    'type'    => 'multi_select_countries',
                ),

                array(
                    'title'    => __( 'Shipping location(s)', 'teg-twitter-api' ),
                    'desc'     => __( 'Choose which countries you want to ship to, or choose to ship to all locations you sell to.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_ship_to_countries',
                    'default'  => '',
                    'type'     => 'select',
                    'class'    => 'wc-enhanced-select',
                    'desc_tip' => true,
                    'options'  => array(
                        ''         => __( 'Ship to all countries you sell to', 'teg-twitter-api' ),
                        'all'      => __( 'Ship to all countries', 'teg-twitter-api' ),
                        'specific' => __( 'Ship to specific countries only', 'teg-twitter-api' ),
                        'disabled' => __( 'Disable shipping &amp; shipping calculations', 'teg-twitter-api' ),
                    ),
                ),

                array(
                    'title'   => __( 'Ship to specific countries', 'teg-twitter-api' ),
                    'desc'    => '',
                    'id'      => 'teg_twitter_api_specific_ship_to_countries',
                    'css'     => '',
                    'default' => '',
                    'type'    => 'multi_select_countries',
                ),

                array(
                    'title'    => __( 'Default customer location', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_default_customer_address',
                    'desc_tip' => __( 'This option determines a customers default location. The MaxMind GeoLite Database will be periodically downloaded to your wp-content directory if using geolocation.', 'teg-twitter-api' ),
                    'default'  => 'geolocation',
                    'type'     => 'select',
                    'class'    => 'wc-enhanced-select',
                    'options'  => array(
                        ''                 => __( 'No location by default', 'teg-twitter-api' ),
                        'base'             => __( 'Shop base address', 'teg-twitter-api' ),
                        'geolocation'      => __( 'Geolocate', 'teg-twitter-api' ),
                        'geolocation_ajax' => __( 'Geolocate (with page caching support)', 'teg-twitter-api' ),
                    ),
                ),

                array(
                    'title'   => __( 'Enable taxes', 'teg-twitter-api' ),
                    'desc'    => __( 'Enable taxes and tax calculations', 'teg-twitter-api' ),
                    'id'      => 'teg_twitter_api_calc_taxes',
                    'default' => 'no',
                    'type'    => 'checkbox',
                ),

                array(
                    'title'   => __( 'Store notice', 'teg-twitter-api' ),
                    'desc'    => __( 'Enable site-wide store notice text', 'teg-twitter-api' ),
                    'id'      => 'teg_twitter_api_demo_store',
                    'default' => 'no',
                    'type'    => 'checkbox',
                ),

                array(
                    'title'    => __( 'Store notice text', 'teg-twitter-api' ),
                    'desc'     => '',
                    'id'       => 'teg_twitter_api_demo_store_notice',
                    'default'  => __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'teg-twitter-api' ),
                    'type'     => 'textarea',
                    'css'     => 'width:350px; height: 65px;',
                    'autoload' => false,
                ),

                array( 'type' => 'sectionend', 'id' => 'general_options' ),

                array( 'title' => __( 'Currency options', 'teg-twitter-api' ), 'type' => 'title', 'desc' => __( 'The following options affect how prices are displayed on the frontend.', 'teg-twitter-api' ), 'id' => 'pricing_options' ),

                array(
                    'title'    => __( 'Currency', 'teg-twitter-api' ),
                    'desc'     => __( 'This controls what currency prices are listed at in the catalog and which currency gateways will take payments in.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_currency',
                    'css'      => 'min-width:350px;',
                    'default'  => 'GBP',
                    'type'     => 'select',
                    'class'    => 'wc-enhanced-select',
                    'desc_tip' => true,
                    'options'  => $currency_code_options,
                ),



                array(
                    'title'    => __( 'Thousand separator', 'teg-twitter-api' ),
                    'desc'     => __( 'This sets the thousand separator of displayed prices.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_price_thousand_sep',
                    'css'      => 'width:50px;',
                    'default'  => ',',
                    'type'     => 'text',
                    'desc_tip' => true,
                ),

                array(
                    'title'    => __( 'Decimal separator', 'teg-twitter-api' ),
                    'desc'     => __( 'This sets the decimal separator of displayed prices.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_price_decimal_sep',
                    'css'      => 'width:50px;',
                    'default'  => '.',
                    'type'     => 'text',
                    'desc_tip' => true,
                ),

                array(
                    'title'    => __( 'Number of decimals', 'teg-twitter-api' ),
                    'desc'     => __( 'This sets the number of decimal points shown in displayed prices.', 'teg-twitter-api' ),
                    'id'       => 'teg_twitter_api_price_num_decimals',
                    'css'      => 'width:50px;',
                    'default'  => '2',
                    'desc_tip' => true,
                    'type'     => 'number',
                    'custom_attributes' => array(
                        'min'  => 0,
                        'step' => 1,
                    ),
                ),

                array( 'type' => 'sectionend', 'id' => 'pricing_options' ),

            ) );

            return apply_filters( 'teg_twitter_api_get_settings_' . $this->id, $settings );
        }

        /**
         * Output a color picker input box.
         *
         * @param mixed $name
         * @param string $id
         * @param mixed $value
         * @param string $desc (default: '')
         */
        public function color_picker( $name, $id, $value, $desc = '' ) {
            echo '<div class="color_box">' . wc_help_tip( $desc ) . '
			<input name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" type="text" value="' . esc_attr( $value ) . '" class="colorpick" /> <div id="colorPickerDiv_' . esc_attr( $id ) . '" class="colorpickdiv"></div>
		</div>';
        }

        /**
         * Save settings.
         */
        public function save() {
            $settings = $this->get_settings();

            WC_Admin_Settings::save_fields( $settings );
        }
    }

endif;

return new WC_Settings_General();
