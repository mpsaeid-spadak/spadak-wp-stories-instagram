<?php
/**
 * Uninstall cleanup for Spadak WP Stories Instagram.
 *
 * @package Spadak_WP_Stories
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

wp_clear_scheduled_hook( 'spadak_stories_cleanup' );

delete_option( 'spadak_stories_expiry_hours' );
delete_option( 'spadak_stories_access' );
delete_option( 'spadak_stories_delete_expired' );
delete_option( 'spadak_stories_image_duration' );

global $wpdb;

// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
$wpdb->query(
	"DELETE FROM {$wpdb->postmeta} WHERE meta_key IN ( 'spadak_story_views', 'spadak_story_video', 'spadak_story_video_id', 'spadak_story_seen_ids' )"
);
