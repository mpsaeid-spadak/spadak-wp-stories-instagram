<?php
/**
 * View counting with unique visitors.
 *
 * @package Spadak_WP_Stories
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class Spadak_Stories_Views
 */
class Spadak_Stories_Views {

	const META_KEY = 'spadak_story_views';
	const COOKIE   = 'spadak_stories_seen';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_spadak_stories_view', array( $this, 'ajax_view' ) );
		add_action( 'wp_ajax_nopriv_spadak_stories_view', array( $this, 'ajax_view' ) );
	}

	/**
	 * Get view count.
	 *
	 * @param int $story_id Story ID.
	 * @return int
	 */
	public static function get_count( $story_id ) {
		return max( 0, (int) get_post_meta( $story_id, self::META_KEY, true ) );
	}

	/**
	 * AJAX: record a unique view.
	 */
	public function ajax_view() {
		check_ajax_referer( 'spadak_stories', 'nonce' );

		$story_id = isset( $_POST['story_id'] ) ? absint( $_POST['story_id'] ) : 0;
		if ( ! $story_id || Spadak_Stories_Post_Type::POST_TYPE !== get_post_type( $story_id ) ) {
			wp_send_json_error( array( 'message' => 'invalid' ), 400 );
		}

		if ( Spadak_Stories_Helper::require_login() && ! is_user_logged_in() ) {
			wp_send_json_error( array( 'message' => 'login_required' ), 403 );
		}

		$recorded = $this->record_view( $story_id );
		wp_send_json_success(
			array(
				'recorded' => $recorded,
				'views'    => self::get_count( $story_id ),
			)
		);
	}

	/**
	 * Record unique view (user ID or cookie).
	 *
	 * @param int $story_id Story ID.
	 * @return bool Whether a new view was counted.
	 */
	private function record_view( $story_id ) {
		$seen_key = 'spadak_story_seen_' . $story_id;

		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			$seen    = get_user_meta( $user_id, $seen_key, true );
			if ( $seen ) {
				return false;
			}
			update_user_meta( $user_id, $seen_key, time() );
		} else {
			$cookie = isset( $_COOKIE[ self::COOKIE ] ) ? sanitize_text_field( wp_unslash( $_COOKIE[ self::COOKIE ] ) ) : '';
			$ids    = $cookie ? array_filter( array_map( 'absint', explode( ',', $cookie ) ) ) : array();
			if ( in_array( $story_id, $ids, true ) ) {
				return false;
			}
			$ids[] = $story_id;
			$ids   = array_slice( array_unique( $ids ), -80 ); // Cap cookie size.
			setcookie(
				self::COOKIE,
				implode( ',', $ids ),
				time() + WEEK_IN_SECONDS,
				COOKIEPATH ? COOKIEPATH : '/',
				COOKIE_DOMAIN,
				is_ssl(),
				true
			);
		}

		$count = self::get_count( $story_id ) + 1;
		update_post_meta( $story_id, self::META_KEY, $count );
		return true;
	}
}
