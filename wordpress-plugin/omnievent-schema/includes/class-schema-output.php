<?php
/**
 * Outputs the JSON-LD schema metatags in the page <head>.
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class OmniEvent_Schema_Output
 */
class OmniEvent_Schema_Output {

	/**
	 * Hook into WordPress.
	 */
	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'output_schema' ) );
	}

	/**
	 * Build and print JSON-LD blocks for the current page/post.
	 */
	public static function output_schema() {
		if ( ! is_singular() ) {
			return;
		}

		$post_id = get_the_ID();
		if ( ! $post_id ) {
			return;
		}

		$schemas = array();

		// Collect selected events.
		$selected_events = (array) get_post_meta( $post_id, '_omnievent_schema_events', true );
		foreach ( $selected_events as $event_id ) {
			$event_id = absint( $event_id );
			if ( ! $event_id ) {
				continue;
			}
			$schema = self::build_event_schema( $event_id );
			if ( $schema ) {
				$schemas[] = $schema;
			}
		}

		// Collect selected standalone races.
		$selected_races = (array) get_post_meta( $post_id, '_omnievent_schema_races', true );
		foreach ( $selected_races as $race_id ) {
			$race_id = absint( $race_id );
			if ( ! $race_id ) {
				continue;
			}
			$schema = self::build_race_schema( $race_id );
			if ( $schema ) {
				$schemas[] = $schema;
			}
		}

		foreach ( $schemas as $schema ) {
			echo "\n" . '<script type="application/ld+json">' . "\n";
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
			echo "\n" . '</script>' . "\n";
		}
	}

	/**
	 * Build a SportsEvent schema array for an event post.
	 *
	 * @param int $event_id Post ID of omnievent_event.
	 * @return array|null
	 */
	private static function build_event_schema( $event_id ) {
		$post = get_post( $event_id );
		if ( ! $post || 'omnievent_event' !== $post->post_type ) {
			return null;
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'SportsEvent',
			'name'     => $post->post_title,
		);

		$start_date   = get_post_meta( $event_id, '_omnievent_start_date', true );
		$end_date     = get_post_meta( $event_id, '_omnievent_end_date', true );
		$event_status = get_post_meta( $event_id, '_omnievent_event_status', true );
		$url          = get_post_meta( $event_id, '_omnievent_url', true );
		$image        = get_post_meta( $event_id, '_omnievent_image', true );
		$location     = get_post_meta( $event_id, '_omnievent_location', true );
		$location_url = get_post_meta( $event_id, '_omnievent_location_url', true );
		$organizer    = get_post_meta( $event_id, '_omnievent_organizer', true );
		$organizer_url= get_post_meta( $event_id, '_omnievent_organizer_url', true );
		$description  = get_post_meta( $event_id, '_omnievent_description', true );

		if ( $start_date ) {
			$schema['startDate'] = self::format_date( $start_date );
		}
		if ( $end_date ) {
			$schema['endDate'] = self::format_date( $end_date );
		}
		if ( $event_status ) {
			$schema['eventStatus'] = 'https://schema.org/' . $event_status;
		}
		if ( $url ) {
			$schema['url'] = $url;
		}
		if ( $image ) {
			$schema['image'] = $image;
		}
		if ( $description ) {
			$schema['description'] = $description;
		}
		if ( $location ) {
			$schema['location'] = array(
				'@type' => 'Place',
				'name'  => $location,
			);
			if ( $location_url ) {
				$schema['location']['url'] = $location_url;
			}
		}
		if ( $organizer ) {
			$schema['organizer'] = array(
				'@type' => 'Organization',
				'name'  => $organizer,
			);
			if ( $organizer_url ) {
				$schema['organizer']['url'] = $organizer_url;
			}
		}

		// Linked races as subEvents.
		$linked_races = (array) get_post_meta( $event_id, '_omnievent_linked_races', true );
		$sub_events   = array();
		foreach ( $linked_races as $race_id ) {
			$race_schema = self::build_race_schema( absint( $race_id ) );
			if ( $race_schema ) {
				// Remove @context from nested objects.
				unset( $race_schema['@context'] );
				$sub_events[] = $race_schema;
			}
		}
		if ( ! empty( $sub_events ) ) {
			$schema['subEvent'] = $sub_events;
		}

		return $schema;
	}

	/**
	 * Build a SportsEvent schema array for a race post.
	 *
	 * @param int $race_id Post ID of omnievent_race.
	 * @return array|null
	 */
	private static function build_race_schema( $race_id ) {
		$post = get_post( $race_id );
		if ( ! $post || 'omnievent_race' !== $post->post_type ) {
			return null;
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'SportsEvent',
			'name'     => $post->post_title,
		);

		$start_date   = get_post_meta( $race_id, '_omnievent_race_start_date', true );
		$end_date     = get_post_meta( $race_id, '_omnievent_race_end_date', true );
		$event_status = get_post_meta( $race_id, '_omnievent_race_event_status', true );
		$url          = get_post_meta( $race_id, '_omnievent_race_url', true );
		$image        = get_post_meta( $race_id, '_omnievent_race_image', true );
		$location     = get_post_meta( $race_id, '_omnievent_race_location', true );
		$location_url = get_post_meta( $race_id, '_omnievent_race_location_url', true );
		$external_id  = get_post_meta( $race_id, '_omnievent_race_external_id', true );
		$description  = get_post_meta( $race_id, '_omnievent_race_description', true );

		if ( $start_date ) {
			$schema['startDate'] = self::format_date( $start_date );
		}
		if ( $end_date ) {
			$schema['endDate'] = self::format_date( $end_date );
		}
		if ( $event_status ) {
			$schema['eventStatus'] = 'https://schema.org/' . $event_status;
		}
		if ( $url ) {
			$schema['url'] = $url;
		}
		if ( $image ) {
			$schema['image'] = $image;
		}
		if ( $description ) {
			$schema['description'] = $description;
		}
		if ( $location ) {
			$schema['location'] = array(
				'@type' => 'Place',
				'name'  => $location,
			);
			if ( $location_url ) {
				$schema['location']['url'] = $location_url;
			}
		}
		if ( $external_id ) {
			$schema['identifier'] = $external_id;
		}

		return $schema;
	}

	/**
	 * Format a datetime-local value (YYYY-MM-DDTHH:MM) to ISO 8601.
	 *
	 * Appends ':00' only when the time portion contains exactly one colon
	 * (i.e., HH:MM), so that values already including seconds are not
	 * mangled into an invalid timestamp like '2024-06-15T10:30:00:00'.
	 *
	 * @param string $date Raw date string.
	 * @return string
	 */
	private static function format_date( $date ) {
		$t_pos = strpos( $date, 'T' );
		if ( false !== $t_pos ) {
			$time_part = substr( $date, $t_pos + 1 );
			// Only append seconds when the time portion is HH:MM (one colon).
			if ( 1 === substr_count( $time_part, ':' ) ) {
				return $date . ':00';
			}
		}
		return $date;
	}
}
