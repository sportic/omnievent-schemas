<?php
/**
 * Meta boxes for the omnievent_race post type.
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OmniEvent_Schema_Race_Meta
 */
class OmniEvent_Schema_Race_Meta {

	/**
	 * Fields definition.
	 *
	 * @var array
	 */
	private static $fields = array(
		'_omnievent_race_start_date'   => array( 'label' => 'Start Date',        'type' => 'datetime-local' ),
		'_omnievent_race_end_date'     => array( 'label' => 'End Date',          'type' => 'datetime-local' ),
		'_omnievent_race_event_status' => array( 'label' => 'Event Status',      'type' => 'select',
			'options' => array(
				''                 => '— Select status —',
				'EventScheduled'   => 'Scheduled',
				'EventCancelled'   => 'Cancelled',
				'EventMovedOnline' => 'Moved Online',
				'EventPostponed'   => 'Postponed',
				'EventRescheduled' => 'Rescheduled',
			),
		),
		'_omnievent_race_url'          => array( 'label' => 'Race URL',          'type' => 'url' ),
		'_omnievent_race_image'        => array( 'label' => 'Image URL',         'type' => 'url' ),
		'_omnievent_race_location'     => array( 'label' => 'Location (place name)', 'type' => 'text' ),
		'_omnievent_race_location_url' => array( 'label' => 'Location URL',      'type' => 'url' ),
		'_omnievent_race_external_id'  => array( 'label' => 'External ID',       'type' => 'text' ),
		'_omnievent_race_description'  => array( 'label' => 'Description',       'type' => 'textarea' ),
	);

	/**
	 * Hook into WordPress.
	 */
	public static function init() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post_omnievent_race', array( __CLASS__, 'save' ), 10, 2 );
	}

	/**
	 * Register meta boxes.
	 */
	public static function add_meta_boxes() {
		add_meta_box(
			'omnievent_race_details',
			__( 'Race Details', 'omnievent-schema' ),
			array( __CLASS__, 'render_details_box' ),
			'omnievent_race',
			'normal',
			'high'
		);
	}

	/**
	 * Render the race details meta box.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public static function render_details_box( $post ) {
		wp_nonce_field( 'omnievent_race_save', 'omnievent_race_nonce' );
		echo '<table class="form-table omnievent-meta-table">';
		foreach ( self::$fields as $key => $field ) {
			$value = get_post_meta( $post->ID, $key, true );
			$label = esc_html( $field['label'] );
			$type  = $field['type'];
			echo '<tr><th><label for="' . esc_attr( $key ) . '">' . $label . '</label></th><td>';
			if ( 'select' === $type ) {
				echo '<select id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" class="regular-text">';
				foreach ( $field['options'] as $opt_val => $opt_label ) {
					echo '<option value="' . esc_attr( $opt_val ) . '"' . selected( $value, $opt_val, false ) . '>' . esc_html( $opt_label ) . '</option>';
				}
				echo '</select>';
			} elseif ( 'textarea' === $type ) {
				echo '<textarea id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" rows="4" class="large-text">' . esc_textarea( $value ) . '</textarea>';
			} else {
				echo '<input type="' . esc_attr( $type ) . '" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" class="regular-text">';
			}
			echo '</td></tr>';
		}
		echo '</table>';
	}

	/**
	 * Save meta data.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post object.
	 */
	public static function save( $post_id, $post ) {
		if ( ! isset( $_POST['omnievent_race_nonce'] ) ||
			! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['omnievent_race_nonce'] ) ), 'omnievent_race_save' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		foreach ( self::$fields as $key => $field ) {
			if ( isset( $_POST[ $key ] ) ) {
				$value = sanitize_text_field( wp_unslash( $_POST[ $key ] ) );
				if ( 'textarea' === $field['type'] ) {
					$value = sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) );
				} elseif ( 'url' === $field['type'] ) {
					$value = esc_url_raw( wp_unslash( $_POST[ $key ] ) );
				}
				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}
	}
}
