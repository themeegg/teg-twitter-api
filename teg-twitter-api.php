<?php
//require_once 'config.php';
//
//new Core\TEG_Core();


/**
 * Plugin Name: TEG Twitter API
 * Plugin URI: https://themeegg.com/plugins/teg-twitter-api
 * Description: This plugin for Twitter Widgets Shortcodes and Many more.
 * Version: 1.0.0
 * Author: ThemeEgg
 * Author URI: https://themeegg.com
 * Requires at least: 4.4
 * Tested up to: 4.7
 *
 * Text Domain: teg-twitter-api
 * Domain Path: /i18n/languages/
 *
 * @package TEGTwitterApi
 * @category Core
 * @author ThemeEgg
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('TEG_Twitter_Api')) :

    /**
     * Main TEG_Twitter_Api Class.
     *
     * @class TEG_Twitter_Api
     * @version    3.1.0
     */
    final class TEG_Twitter_Api
    {

        /**
         * TEG_Twitter_Api version.
         *
         * @var string
         */
        public $version = '1.0.0';

        /**
         * The single instance of the class.
         *
         * @var TEG_Twitter_Api
         * @since 2.1
         */
        protected static $_instance = null;

        /**
         * Main TEG_Twitter_Api Instance.
         *
         * Ensures only one instance of TEG_Twitter_Api is loaded or can be loaded.
         *
         * @since 2.1
         * @static
         * @see WC()
         * @return TEG_Twitter_Api - Main instance.
         */
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Cloning is forbidden.
         * @since 2.1
         */
        public function __clone()
        {
            wc_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'teg-twitter-api'), '2.1');
        }

        /**
         * Unserializing instances of this class is forbidden.
         * @since 2.1
         */
        public function __wakeup()
        {
            wc_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'teg-twitter-api'), '2.1');
        }

        /**
         * Auto-load in-accessible properties on demand.
         * @param mixed $key
         * @return mixed
         */
        public function __get($key)
        {

            return $this->$key();

        }

        /**
         * TEG_Twitter_Api Constructor.
         */
        public function __construct()
        {
            $this->define_constants();
            $this->includes();
            $this->init_hooks();

            do_action('teg_twitter_api_loaded');
        }

        /**
         * Hook into actions and filters.
         * @since  1.0
         */
        private function init_hooks()
        {
            register_activation_hook(__FILE__, array('TEG_TA_Install', 'install'));
            add_action('after_setup_theme', array($this, 'setup_environment'));
            add_action('after_setup_theme', array($this, 'include_template_functions'), 11);
            add_action('init', array($this, 'init'), 0);
            add_action('init', array('TEG_TA_Shortcodes', 'init'));


        }

        /**
         * Define TEG_TA Constants.
         */
        private function define_constants()
        {
            $upload_dir = wp_upload_dir();

            $this->define('TEG_TI_PLUGIN_FILE', __FILE__);
            $this->define('TEG_TI_ABSPATH', dirname(__FILE__) . '/');
            $this->define('TEG_TI_PLUGIN_BASENAME', plugin_basename(__FILE__));
            $this->define('TEG_TI_VERSION', $this->version);
            $this->define('TEG_TI_LOG_DIR', $upload_dir['basedir'] . '/teg-logs/');
            $this->define('TEG_TI_TEMPLATE_DEBUG_MODE', false);
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define($name, $value)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin, ajax, cron or frontend.
         * @return bool
         */
        private function is_request($type)
        {
            switch ($type) {
                case 'admin' :
                    return is_admin();
                case 'ajax' :
                    return defined('DOING_AJAX');
                case 'cron' :
                    return defined('DOING_CRON');
                case 'frontend' :
                    return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
            }
        }

        /**
         * Check the active theme.
         *
         * @since  2.6.9
         * @param  string $theme Theme slug to check
         * @return bool
         */
        private function is_active_theme($theme)
        {
            return get_template() === $theme;
        }

        /**
         * Include required core files used in admin and on the frontend.
         */
        public function includes()
        {
            /**
             * Class autoloader.
             */
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-autoloader.php');

            /**
             * Interfaces.
             */
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-abstract-order-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-coupon-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-customer-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-customer-download-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-object-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-order-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-order-item-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-order-item-product-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-order-item-type-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-order-refund-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-payment-token-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-product-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-product-variable-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-shipping-zone-data-store-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-logger-interface.php');
            include_once(TEG_TI_ABSPATH . 'includes/interfaces/class-wc-log-handler-interface.php');

            /**
             * Abstract classes.
             */
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-data.php'); // TEG_TI_Data for CRUD
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-object-query.php'); // TEG_TI_Object_Query for CRUD
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-payment-token.php'); // Payment Tokens
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-product.php'); // Products
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-order.php'); // Orders
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-settings-api.php'); // Settings API (for gateways, shipping, and integrations)
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-shipping-method.php'); // A Shipping method
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-payment-gateway.php'); // A Payment gateway
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-integration.php'); // An integration with a service
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-log-handler.php');
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-deprecated-hooks.php');
            include_once(TEG_TI_ABSPATH . 'includes/abstracts/abstract-wc-session.php');

            /**
             * Core classes.
             */
            include_once(TEG_TI_ABSPATH . 'includes/wc-core-functions.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-datetime.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-post-types.php'); // Registers post types
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-install.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-geolocation.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-download-handler.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-comments.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-post-data.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-ajax.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-emails.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-data-exception.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-query.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-order-factory.php'); // Order factory
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-order-query.php'); // Order query
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-product-factory.php'); // Product factory
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-payment-tokens.php'); // Payment tokens controller
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-shipping-zone.php');
            include_once(TEG_TI_ABSPATH . 'includes/gateways/class-wc-payment-gateway-cc.php'); // CC Payment Gateway
            include_once(TEG_TI_ABSPATH . 'includes/gateways/class-wc-payment-gateway-echeck.php'); // eCheck Payment Gateway
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-countries.php'); // Defines countries and states
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-integrations.php'); // Loads integrations
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-cache-helper.php'); // Cache Helper
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-https.php'); // https Helper
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-deprecated-action-hooks.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-deprecated-filter-hooks.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-background-emailer.php');

            /**
             * Data stores - used to store and retrieve CRUD object data from the database.
             */
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-data-store-wp.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-coupon-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-product-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-product-grouped-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-product-variable-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-product-variation-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/abstract-wc-order-item-type-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-coupon-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-fee-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-product-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-shipping-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-item-tax-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-payment-token-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-customer-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-customer-data-store-session.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-customer-download-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-shipping-zone-data-store.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/abstract-wc-order-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-data-store-cpt.php');
            include_once(TEG_TI_ABSPATH . 'includes/data-stores/class-wc-order-refund-data-store-cpt.php');

            /**
             * REST API.
             */
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-legacy-api.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-api.php'); // API Class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-auth.php'); // Auth Class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-register-wp-admin-settings.php');

            if (defined('WP_CLI') && WP_CLI) {
                include_once(TEG_TI_ABSPATH . 'includes/class-wc-cli.php');
            }

            if ($this->is_request('admin')) {
                include_once(TEG_TI_ABSPATH . 'includes/admin/class-wc-admin.php');
            }

            if ($this->is_request('frontend')) {
                $this->frontend_includes();
            }

            if ($this->is_request('frontend') || $this->is_request('cron')) {
                include_once(TEG_TI_ABSPATH . 'includes/class-wc-session-handler.php');
            }

            if ($this->is_request('cron') && 'yes' === get_option('teg_twitter_api_allow_tracking', 'no')) {
                include_once(TEG_TI_ABSPATH . 'includes/class-wc-tracker.php');
            }

            $this->query = new TEG_TI_Query();
            $this->api = new TEG_TI_API();
        }

        /**
         * Include required frontend files.
         */
        public function frontend_includes()
        {
            include_once(TEG_TI_ABSPATH . 'includes/wc-cart-functions.php');
            include_once(TEG_TI_ABSPATH . 'includes/wc-notice-functions.php');
            include_once(TEG_TI_ABSPATH . 'includes/wc-template-hooks.php');
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-template-loader.php');                // Template Loader
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-frontend-scripts.php');               // Frontend Scripts
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-form-handler.php');                   // Form Handlers
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-cart.php');                           // The main cart class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-tax.php');                            // Tax class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-shipping-zones.php');                 // Shipping Zones class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-customer.php');                       // Customer class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-shortcodes.php');                     // Shortcodes class
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-embed.php');                          // Embeds
            include_once(TEG_TI_ABSPATH . 'includes/class-wc-structured-data.php');                // Structured Data class

            if ($this->is_active_theme('twentyseventeen')) {
                include_once(TEG_TI_ABSPATH . 'includes/theme-support/class-wc-twenty-seventeen.php');
            }
        }

        /**
         * Function used to Init TEG_Twitter_Api Template Functions - This makes them pluggable by plugins and themes.
         */
        public function include_template_functions()
        {
            include_once(TEG_TI_ABSPATH . 'includes/wc-template-functions.php');
        }

        /**
         * Init TEG_Twitter_Api when WordPress Initialises.
         */
        public function init()
        {
            // Before init action.
            do_action('before_teg_twitter_api_init');

            // Set up localisation.
            $this->load_plugin_textdomain();

            // Load class instances.
            $this->product_factory = new TEG_TI_Product_Factory(); // Product Factory to create new product instances
            $this->order_factory = new TEG_TI_Order_Factory(); // Order Factory to create new order instances
            $this->countries = new TEG_TI_Countries(); // Countries class
            $this->integrations = new TEG_TI_Integrations(); // Integrations class
            $this->structured_data = new TEG_TI_Structured_Data(); // Structured Data class, generates and handles structured data
            $this->deprecated_hook_handlers['actions'] = new TEG_TI_Deprecated_Action_Hooks();
            $this->deprecated_hook_handlers['filters'] = new TEG_TI_Deprecated_Filter_Hooks();

            // Session class, handles session data for users - can be overwritten if custom handler is needed.
            if ($this->is_request('frontend') || $this->is_request('cron')) {
                $session_class = apply_filters('teg_twitter_api_session_handler', 'TEG_TI_Session_Handler');
                $this->session = new $session_class();
            }

            // Classes/actions loaded for the frontend and for ajax requests.
            if ($this->is_request('frontend')) {
                $this->cart = new TEG_TI_Cart();                                  // Cart class, stores the cart contents
                $this->customer = new TEG_TI_Customer(get_current_user_id(), true); // Customer class, handles data such as customer location
                add_action('shutdown', array($this->customer, 'save'), 10);          // Customer should be saved during shutdown.
            }

            $this->load_webhooks();

            // Init action.
            do_action('teg_twitter_api_init');
        }

        /**
         * Load Localisation files.
         *
         * Note: the first-loaded translation file overrides any following ones if the same translation is present.
         *
         * Locales found in:
         *      - WP_LANG_DIR/woocommerce/woocommerce-LOCALE.mo
         *      - WP_LANG_DIR/plugins/woocommerce-LOCALE.mo
         */
        public function load_plugin_textdomain()
        {
            $locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
            $locale = apply_filters('plugin_locale', $locale, 'woocommerce');

            unload_textdomain('woocommerce');
            load_textdomain('woocommerce', WP_LANG_DIR . '/woocommerce/woocommerce-' . $locale . '.mo');
            load_plugin_textdomain('woocommerce', false, plugin_basename(dirname(__FILE__)) . '/i18n/languages');
        }

        /**
         * Ensure theme and server variable compatibility and setup image sizes.
         */
        public function setup_environment()
        {
            /**
             * @deprecated 2.2 Use WC()->template_path()
             */
            $this->define('TEG_TI_TEMPLATE_PATH', $this->template_path());

            $this->add_thumbnail_support();
            $this->add_image_sizes();
        }

        /**
         * Ensure post thumbnail support is turned on.
         */
        private function add_thumbnail_support()
        {
            if (!current_theme_supports('post-thumbnails')) {
                add_theme_support('post-thumbnails');
            }
            add_post_type_support('product', 'thumbnail');
        }

        /**
         * Add WC Image sizes to WP.
         *
         * @since 2.3
         */
        private function add_image_sizes()
        {
            $shop_thumbnail = wc_get_image_size('shop_thumbnail');
            $shop_catalog = wc_get_image_size('shop_catalog');
            $shop_single = wc_get_image_size('shop_single');

            add_image_size('shop_thumbnail', $shop_thumbnail['width'], $shop_thumbnail['height'], $shop_thumbnail['crop']);
            add_image_size('shop_catalog', $shop_catalog['width'], $shop_catalog['height'], $shop_catalog['crop']);
            add_image_size('shop_single', $shop_single['width'], $shop_single['height'], $shop_single['crop']);
        }

        /**
         * Get the plugin url.
         * @return string
         */
        public function plugin_url()
        {
            return untrailingslashit(plugins_url('/', __FILE__));
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public function plugin_path()
        {
            return untrailingslashit(plugin_dir_path(__FILE__));
        }

        /**
         * Get the template path.
         * @return string
         */
        public function template_path()
        {
            return apply_filters('teg_twitter_api_template_path', 'woocommerce/');
        }

        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url()
        {
            return admin_url('admin-ajax.php', 'relative');
        }

        /**
         * Return the WC API URL for a given request.
         *
         * @param string $request
         * @param mixed $ssl (default: null)
         * @return string
         */
        public function api_request_url($request, $ssl = null)
        {
            if (is_null($ssl)) {
                $scheme = parse_url(home_url(), PHP_URL_SCHEME);
            } elseif ($ssl) {
                $scheme = 'https';
            } else {
                $scheme = 'http';
            }

            if (strstr(get_option('permalink_structure'), '/index.php/')) {
                $api_request_url = trailingslashit(home_url('/index.php/wc-api/' . $request, $scheme));
            } elseif (get_option('permalink_structure')) {
                $api_request_url = trailingslashit(home_url('/wc-api/' . $request, $scheme));
            } else {
                $api_request_url = add_query_arg('wc-api', $request, trailingslashit(home_url('', $scheme)));
            }

            return esc_url_raw(apply_filters('teg_twitter_api_api_request_url', $api_request_url, $request, $ssl));
        }

        /**
         * Load & enqueue active webhooks.
         *
         * @since 2.2
         */
        private function load_webhooks()
        {

            if (!is_blog_installed()) {
                return;
            }

            if (false === ($webhooks = get_transient('teg_twitter_api_webhook_ids'))) {
                $webhooks = get_posts(array(
                    'fields' => 'ids',
                    'post_type' => 'shop_webhook',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                ));
                set_transient('teg_twitter_api_webhook_ids', $webhooks);
            }
            foreach ($webhooks as $webhook_id) {
                $webhook = new TEG_TI_Webhook($webhook_id);
                $webhook->enqueue();
            }
        }

        /**
         * TEG_Twitter_Api Payment Token Meta API and Term/Order item Meta - set table names.
         */
        public function wpdb_table_fix()
        {
            global $wpdb;
            $wpdb->payment_tokenmeta = $wpdb->prefix . 'teg_twitter_api_payment_tokenmeta';
            $wpdb->order_itemmeta = $wpdb->prefix . 'teg_twitter_api_order_itemmeta';
            $wpdb->tables[] = 'teg_twitter_api_payment_tokenmeta';
            $wpdb->tables[] = 'teg_twitter_api_order_itemmeta';

            if (get_option('db_version') < 34370) {
                $wpdb->teg_twitter_api_termmeta = $wpdb->prefix . 'teg_twitter_api_termmeta';
                $wpdb->tables[] = 'teg_twitter_api_termmeta';
            }
        }

        /**
         * Get Checkout Class.
         * @return TEG_TI_Checkout
         */
        public function checkout()
        {
            return TEG_TI_Checkout::instance();
        }

        /**
         * Get gateways class.
         * @return TEG_TI_Payment_Gateways
         */
        public function payment_gateways()
        {
            return TEG_TI_Payment_Gateways::instance();
        }

        /**
         * Get shipping class.
         * @return TEG_TI_Shipping
         */
        public function shipping()
        {
            return TEG_TI_Shipping::instance();
        }

        /**
         * Email Class.
         * @return TEG_TI_Emails
         */
        public function mailer()
        {
            return TEG_TI_Emails::instance();
        }
    }

endif;

/**
 * Main instance of TEG_Twitter_Api.
 *
 * Returns the main instance of WC to prevent the need to use globals.
 *
 * @since  2.1
 * @return TEG_Twitter_Api
 */
function TEGTApi()
{
    return TEG_Twitter_Api::instance();
}

// Global for backwards compatibility.
$GLOBALS['teg_twitter_api'] = TEGTApi();
