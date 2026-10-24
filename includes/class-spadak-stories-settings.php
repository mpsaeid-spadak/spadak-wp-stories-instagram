<?php
/**
 * Settings (also used by modern dashboard).
 *
 * @package Spadak_WP_Stories
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Spadak_Stories_Settings
 */
class Spadak_Stories_Settings {

	const PAGE = 'spadak-stories-settings';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'register' ) );
	}

	/**
	 * Register settings.
	 */
	public function register() {
		$opts = array(
			'spadak_stories_expiry_hours'   => array(
				'type'              => 'integer',
				'sanitize_callback' => array( $this, 'sanitize_expiry' ),
				'default'           => 24,
			),
			'spadak_stories_access'         => array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_access' ),
				'default'           => 'public',
			),
			'spadak_stories_delete_expired' => array(
				'type'              => 'boolean',
				'sanitize_callback' => 'rest_sanitize_boolean',
				'default'           => true,
			),
			'spadak_stories_image_duration' => array(
				'type'              => 'integer',
				'sanitize_callback' => array( $this, 'sanitize_duration' ),
				'default'           => 5,
			),
		);

		foreach ( $opts as $name => $args ) {
			register_setting( 'spadak_stories_settings', $name, $args );
		}
	}

	/**
	 * @param mixed $value Value.
	 * @return int
	 */
	public function sanitize_expiry( $value ) {
		$value = absint( $value );
		return max( 1, min( 8760, $value ) );
	}

	/**
	 * @param mixed $value Value.
	 * @return string
	 */
	public function sanitize_access( $value ) {
		return in_array( $value, array( 'public', 'logged_in' ), true ) ? $value : 'public';
	}

	/**
	 * @param mixed $value Value.
	 * @return int
	 */
	public function sanitize_duration( $value ) {
		$value = absint( $value );
		return max( 2, min( 30, $value ) );
	}

	/**
	 * Whether expired stories should be deleted by cron.
	 *
	 * @return bool
	 */
	public static function should_delete_expired() {
		return (bool) get_option( 'spadak_stories_delete_expired', true );
	}
}
