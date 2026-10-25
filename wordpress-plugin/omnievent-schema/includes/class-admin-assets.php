<?php
/**
 * Enqueue admin assets (CSS/JS).
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OmniEvent_Schema_Admin_Assets
 */
class OmniEvent_Schema_Admin_Assets {

	/**
	 * Hook into WordPress.
	 */
	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
	}

	/**
	 * Enqueue styles and scripts on relevant admin screens.
	 *
	 * @param string $hook_suffix Current admin page hook suffix.
	 */
	public static function enqueue( $hook_suffix ) {
		if ( ! in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		wp_enqueue_style(
			'omnievent-schema-admin',
			OMNIEVENT_SCHEMA_PLUGIN_URL . 'admin/css/admin.css',
			array(),
			OMNIEVENT_SCHEMA_VERSION
		);
	}
}
