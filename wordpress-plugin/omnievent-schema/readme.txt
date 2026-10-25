=== OmniEvent Schema ===
Contributors:      sportic
Tags:              schema, schema.org, structured data, json-ld, sports event, race
Requires at least: 6.0
Tested up to:      6.6
Requires PHP:      7.4
Stable tag:        1.0.0
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Publish OmniEvent structured data (schema.org SportsEvent) as JSON-LD metatags on any WordPress page.

== Description ==

OmniEvent Schema allows you to:

* Create **Event** records individually, with all schema.org SportsEvent fields (name, dates, status, location, organizer, image, URL, description).
* Create **Race** records individually and link them to Events as `subEvent` entries.
* On any page or post, choose one or more Events or Races to publish as `<script type="application/ld+json">` metatags automatically injected in `<head>`.

Unlike generic schema plugins, OmniEvent Schema is purpose-built for sports event organisers and platforms that need granular control over each event and its individual race distances.

**Features**

* Custom Post Types for Events and Races – manage them from a dedicated admin menu.
* Full schema.org SportsEvent fields including `eventStatus` (Scheduled, Cancelled, Postponed, Rescheduled, MovedOnline).
* Link multiple Races to an Event; they will appear as `subEvent` in the JSON-LD output.
* Per-page / per-post multi-select: choose any combination of Events and Races to emit as JSON-LD.
* Clean, minimal JSON-LD output with no visual front-end changes.
* Developer-friendly filter `omnievent_schema_page_post_types` to add additional post types to the schema selector.

== Installation ==

1. Upload the `omnievent-schema` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Go to **OmniEvent → Events** to create your first Event.
4. Go to **OmniEvent → Races** to create Race entries, then link them to Events.
5. Open any Page or Post, locate the **OmniEvent Schema** sidebar panel, and tick the Events/Races you want published on that page.

== Frequently Asked Questions ==

= What schema type does this plugin use? =

All records are output as `https://schema.org/SportsEvent` JSON-LD.

= Can I publish a Race without an Event? =

Yes. You can tick individual Races directly on a page/post, and they will be emitted as standalone `SportsEvent` JSON-LD blocks.

= How do I add the schema selector to custom post types? =

Add a filter to your theme or plugin:

`add_filter( 'omnievent_schema_page_post_types', function( $types ) { $types[] = 'my_cpt'; return $types; } );`

== Screenshots ==

1. Event editor with all schema.org fields.
2. Race editor.
3. Page editor with OmniEvent Schema sidebar panel.
4. JSON-LD output in page source.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
