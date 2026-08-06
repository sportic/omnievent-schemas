<?php
/**
 * Registers custom post types.
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OmniEvent_Schema_Post_Types
 */
class OmniEvent_Schema_Post_Types {

	/**
	 * Hook into WordPress init.
	 *
	 * Calls register() directly because this method is already invoked
	 * during the 'init' action — scheduling another 'init' callback at
	 * that point would never fire.
	 */
	public static function init() {
		self::register();
	}

	/**
	 * Register all custom post types.
	 */
	public static function register() {
		self::register_event();
		self::register_race();
	}

	/**
	 * Register the omnievent_event post type.
	 */
	private static function register_event() {
		$labels = array(
			'name'               => _x( 'Events', 'post type general name', 'omnievent-schema' ),
			'singular_name'      => _x( 'Event', 'post type singular name', 'omnievent-schema' ),
			'menu_name'          => _x( 'OmniEvent', 'admin menu', 'omnievent-schema' ),
			'add_new'            => __( 'Add New', 'omnievent-schema' ),
			'add_new_item'       => __( 'Add New Event', 'omnievent-schema' ),
			'edit_item'          => __( 'Edit Event', 'omnievent-schema' ),
			'new_item'           => __( 'New Event', 'omnievent-schema' ),
			'view_item'          => __( 'View Event', 'omnievent-schema' ),
			'search_items'       => __( 'Search Events', 'omnievent-schema' ),
			'not_found'          => __( 'No events found', 'omnievent-schema' ),
			'not_found_in_trash' => __( 'No events found in trash', 'omnievent-schema' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_icon'           => 'dashicons-calendar-alt',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'rewrite'             => false,
			'show_in_rest'        => true,
		);

		register_post_type( 'omnievent_event', $args );
	}

	/**
	 * Register the omnievent_race post type.
	 */
	private static function register_race() {
		$labels = array(
			'name'               => _x( 'Races', 'post type general name', 'omnievent-schema' ),
			'singular_name'      => _x( 'Race', 'post type singular name', 'omnievent-schema' ),
			'menu_name'          => _x( 'Races', 'admin menu', 'omnievent-schema' ),
			'add_new'            => __( 'Add New', 'omnievent-schema' ),
			'add_new_item'       => __( 'Add New Race', 'omnievent-schema' ),
			'edit_item'          => __( 'Edit Race', 'omnievent-schema' ),
			'new_item'           => __( 'New Race', 'omnievent-schema' ),
			'view_item'          => __( 'View Race', 'omnievent-schema' ),
			'search_items'       => __( 'Search Races', 'omnievent-schema' ),
			'not_found'          => __( 'No races found', 'omnievent-schema' ),
			'not_found_in_trash' => __( 'No races found in trash', 'omnievent-schema' ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => 'edit.php?post_type=omnievent_event',
			'capability_type' => 'post',
			'hierarchical'    => false,
			'supports'        => array( 'title' ),
			'rewrite'         => false,
			'show_in_rest'    => true,
		);

		register_post_type( 'omnievent_race', $args );
	}
}
