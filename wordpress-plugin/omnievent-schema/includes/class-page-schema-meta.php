<?php
/**
 * Meta box on pages/posts to select schema records to publish.
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OmniEvent_Schema_Page_Schema_Meta
 */
class OmniEvent_Schema_Page_Schema_Meta {

	/**
	 * Supported post types where the meta box appears.
	 *
	 * @var array
	 */
	private static $post_types = array( 'page', 'post' );

	/**
	 * Hook into WordPress.
	 */
	public static function init() {
		/**
		 * Allow other plugins / themes to add more post types.
		 */
		self::$post_types = apply_filters( 'omnievent_schema_page_post_types', self::$post_types );

		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post',      array( __CLASS__, 'save' ), 10, 2 );
	}

	/**
	 * Register meta boxes on all relevant post types.
	 */
	public static function add_meta_boxes() {
		foreach ( self::$post_types as $post_type ) {
			add_meta_box(
				'omnievent_page_schema',
				__( 'OmniEvent Schema', 'omnievent-schema' ),
				array( __CLASS__, 'render' ),
				$post_type,
				'side',
				'default'
			);
		}
	}

	/**
	 * Render the meta box.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public static function render( $post ) {
		wp_nonce_field( 'omnievent_page_schema_save', 'omnievent_page_schema_nonce' );

		$selected_events = (array) get_post_meta( $post->ID, '_omnievent_schema_events', true );
		$selected_races  = (array) get_post_meta( $post->ID, '_omnievent_schema_races', true );

		$events = get_posts( array(
			'post_type'      => 'omnievent_event',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		) );

		$races = get_posts( array(
			'post_type'      => 'omnievent_race',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
		) );

		// Events.
		if ( ! empty( $events ) ) {
			echo '<p><strong>' . esc_html__( 'Events', 'omnievent-schema' ) . '</strong></p>';
			echo '<ul class="omnievent-schema-checklist">';
			foreach ( $events as $event ) {
				$checked = in_array( $event->ID, $selected_events, true ) ? ' checked' : '';
				echo '<li><label>';
				echo '<input type="checkbox" name="_omnievent_schema_events[]" value="' . esc_attr( $event->ID ) . '"' . $checked . '> ';
				echo esc_html( $event->post_title );
				echo '</label></li>';
			}
			echo '</ul>';
		} else {
			echo '<p class="description">' . esc_html__( 'No events found.', 'omnievent-schema' ) . '</p>';
		}

		// Races.
		if ( ! empty( $races ) ) {
			echo '<p><strong>' . esc_html__( 'Races', 'omnievent-schema' ) . '</strong></p>';
			echo '<ul class="omnievent-schema-checklist">';
			foreach ( $races as $race ) {
				$checked = in_array( $race->ID, $selected_races, true ) ? ' checked' : '';
				echo '<li><label>';
				echo '<input type="checkbox" name="_omnievent_schema_races[]" value="' . esc_attr( $race->ID ) . '"' . $checked . '> ';
				echo esc_html( $race->post_title );
				echo '</label></li>';
			}
			echo '</ul>';
		} else {
			echo '<p class="description">' . esc_html__( 'No races found.', 'omnievent-schema' ) . '</p>';
		}
	}

	/**
	 * Save meta data.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 */
	public static function save( $post_id, $post ) {
		if ( ! isset( $_POST['omnievent_page_schema_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['omnievent_page_schema_nonce'] ) ), 'omnievent_page_schema_save' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Events.
		$selected_events = array();
		if ( isset( $_POST['_omnievent_schema_events'] ) && is_array( $_POST['_omnievent_schema_events'] ) ) {
			$selected_events = array_map( 'absint', $_POST['_omnievent_schema_events'] );
		}
		update_post_meta( $post_id, '_omnievent_schema_events', $selected_events );

		// Races.
		$selected_races = array();
		if ( isset( $_POST['_omnievent_schema_races'] ) && is_array( $_POST['_omnievent_schema_races'] ) ) {
			$selected_races = array_map( 'absint', $_POST['_omnievent_schema_races'] );
		}
		update_post_meta( $post_id, '_omnievent_schema_races', $selected_races );
	}
}
