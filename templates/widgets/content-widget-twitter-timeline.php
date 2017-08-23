<?php
/**
 * The template for displaying Twitter timelines
 *
 * This template can be overridden by copying it to yourtheme/teg-twitter-api/content-widget-twitter-timeline.php
 *
 * HOWEVER, on occasion TEG Twitter API will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.themeegg.com/document/template-structure/
 * @author  ThemeEgg
 * @package TEGTwitterApi/Templates
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<a class="twitter-timeline" href="https://twitter.com/<?php echo esc_attr( $handle ); ?>"></a>
<script async src="http://platform.twitter.com/widgets.js" charset="utf-8"></script>