<?php
/**
 * Plugin Name:       OmniEvent Schema
 * Plugin URI:        https://github.com/sportic/omnievent-schemas
 * Description:       Publish OmniEvent structured data (schema.org) as JSON-LD metatags on any WordPress page. Create Events and Races individually, link them together, and assign them to pages.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Sportic
 * Author URI:        https://sportic.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       omnievent-schema
 * Domain Path:       /languages
 *
 * @package OmniEvent_Schema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OMNIEVENT_SCHEMA_VERSION', '1.0.0' );
define( 'OMNIEVENT_SCHEMA_PLUGIN_FILE', __FILE__ );
define( 'OMNIEVENT_SCHEMA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'OMNIEVENT_SCHEMA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-post-types.php';
require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-event-meta.php';
require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-race-meta.php';
require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-page-schema-meta.php';
require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-schema-output.php';
require_once OMNIEVENT_SCHEMA_PLUGIN_DIR . 'includes/class-admin-assets.php';

/**
 * Initialise plugin components.
 */
function omnievent_schema_init() {
	OmniEvent_Schema_Post_Types::init();
	OmniEvent_Schema_Event_Meta::init();
	OmniEvent_Schema_Race_Meta::init();
	OmniEvent_Schema_Page_Schema_Meta::init();
	OmniEvent_Schema_Output::init();
	OmniEvent_Schema_Admin_Assets::init();
}
add_action( 'init', 'omnievent_schema_init' );

/**
 * Plugin activation – flush rewrite rules.
 */
function omnievent_schema_activate() {
	OmniEvent_Schema_Post_Types::register();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'omnievent_schema_activate' );

/**
 * Plugin deactivation – flush rewrite rules.
 */
function omnievent_schema_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'omnievent_schema_deactivate' );
