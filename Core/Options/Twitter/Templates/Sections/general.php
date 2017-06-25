<?php
    defined('ABSPATH') or exit;
?>
<form method="post" action="options.php">
    <?php settings_fields( 'dg_twitter_settings_option_group_general' ); ?>
    <?php do_settings_sections( 'dg_twitter_settings_option_group_general' ); ?>
    <table class="form-table api_master_admin">
        <?php $dg_twitter_settings_option_group_general_settings = get_option('dg_twitter_settings_option_group_general_settings'); ?>
        <tr class="api_master_row_input" valign="top">
            <th scope="row">Post on Twitter</th>
            <td>
                <input size="50" type="checkbox" name="dg_twitter_settings_option_group_general_settings[post_tweet]" value="<?php $dg_twitter_settings_option_group_general_settings['post_tweet']; ?>" />
            </td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>