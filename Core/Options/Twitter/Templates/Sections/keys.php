<?php

defined('ABSPATH') or exit;

?>
<form method="post" action="options.php">
    <?php settings_fields( 'social_settings_options_group' ); ?>
    <?php do_settings_sections( 'social_settings_options_group' ); ?>
    <table class="form-table api_master_admin">

        <tr class="api_master_row_input" valign="top">
            <th scope="row">Twitter Username</th>
            <td>
                <input size="50" type="text" name="social_settings_options_group_user" value="<?php echo esc_attr( get_option('social_settings_options_group_user') ); ?>" />
            </td>
        </tr>
        <tr class="api_master_row_input" valign="top">
            <th scope="row">Twitter Oauth Access Token</th>
            <td>
                <input size="50" type="text" name="social_settings_options_group_oauth_access_token" value="<?php echo esc_attr( get_option('social_settings_options_group_oauth_access_token') ); ?>" />
            </td>
        </tr>
        <tr class="api_master_row_input" valign="top">
            <th scope="row">Twitter Oauth Access Token Secret</th>
            <td>
                <input size="50" type="text" name="social_settings_options_group_oauth_access_token_secret" value="<?php echo esc_attr( get_option('social_settings_options_group_oauth_access_token_secret') ); ?>" />
            </td>
        </tr>
        <tr class="api_master_row_input" valign="top">
            <th scope="row">Twitter Consumer Key</th>
            <td>
                <input size="50" type="text" name="social_settings_options_group_consumer_key" value="<?php echo esc_attr( get_option('social_settings_options_group_consumer_key') ); ?>" />
            </td>
        </tr>
        <tr class="api_master_row_input" valign="top">
            <th scope="row">Twitter Consumer Secret</th>
            <td>
                <input size="50" type="text" name="social_settings_options_group_consumer_secret" value="<?php echo esc_attr( get_option('social_settings_options_group_consumer_secret') ); ?>" />
            </td>
        </tr>

        <tr class="api_master_row_input" valign="top">
            <th colspan="2">
                <p>
                    For Tweet shortcode please type [twitter_tweets count="show no of tweets"] and default shortcode is [twitter_tweets count="5"]<br/>
                    For Trends shortcode please type [twitter_Trends count="show no of Trends" WOEID="WOEID"] and default shortcode is [twitter_trends count="5" WOEID="1"]<br/>
                </p>
            </th>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>