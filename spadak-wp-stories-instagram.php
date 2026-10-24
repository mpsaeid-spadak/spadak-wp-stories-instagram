<?php
/**
 * Plugin Name:       Spadak WP Stories Instagram
 * Plugin URI:        https://spadak.ir/wp-stories
 * Description:       استوری‌های حرفه‌ای شبیه اینستاگرام برای وردپرس — تصویر و ویدیو، کاور خودکار، پلیر تمام‌صفحه، شمارنده بازدید و داشبورد مدرن.
 * Version:           2.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Spadak
 * Author URI:        https://spadak.ir
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       spadak-wp-stories
 * Domain Path:       /languages
 *
 * @package Spadak_WP_Stories
 */

defined( 'ABSPATH' ) || exit;

define( 'SPADAK_STORIES_VERSION', '2.0.0' );
define( 'SPADAK_STORIES_FILE', __FILE__ );
define( 'SPADAK_STORIES_PATH', plugin_dir_path( __FILE__ ) );
define( 'SPADAK_STORIES_URL', plugin_dir_url( __FILE__ ) );
define( 'SPADAK_STORIES_BASENAME', plugin_basename( __FILE__ ) );

require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-helper.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-post-type.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-meta.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-views.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-settings.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-shortcode.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories-widget.php';
require_once SPADAK_STORIES_PATH . 'includes/class-spadak-stories.php';
require_once SPADAK_STORIES_PATH . 'admin/class-spadak-stories-admin.php';

/**
 * Main plugin instance.
 *
 * @return Spadak_Stories
 */
function spadak_stories() {
	return Spadak_Stories::instance();
}

add_action( 'plugins_loaded', 'spadak_stories' );

/**
 * Activation: register CPT, flush rewrite, schedule cleanup.
 */
function spadak_stories_activate() {
	Spadak_Stories_Post_Type::register();
	flush_rewrite_rules();

	if ( ! wp_next_scheduled( 'spadak_stories_cleanup' ) ) {
		wp_schedule_event( time() + HOUR_IN_SECONDS, 'hourly', 'spadak_stories_cleanup' );
	}

	// Default options.
	if ( false === get_option( 'spadak_stories_expiry_hours' ) ) {
		update_option( 'spadak_stories_expiry_hours', 24 );
	}
	if ( false === get_option( 'spadak_stories_access' ) ) {
		update_option( 'spadak_stories_access', 'public' );
	}
	if ( false === get_option( 'spadak_stories_delete_expired' ) ) {
		update_option( 'spadak_stories_delete_expired', true );
	}
	if ( false === get_option( 'spadak_stories_image_duration' ) ) {
		update_option( 'spadak_stories_image_duration', 5 );
	}
}
register_activation_hook( __FILE__, 'spadak_stories_activate' );

/**
 * Deactivation: clear cron.
 */
function spadak_stories_deactivate() {
	wp_clear_scheduled_hook( 'spadak_stories_cleanup' );
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'spadak_stories_deactivate' );
