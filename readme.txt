=== Unique Query Loop Extension ===
Contributors: silvaitamar
Tags: query loop, gutenberg, block editor, posts, duplicate
Requires at least: 6.7
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Prevent duplicate posts across multiple Query Loop blocks on the same page.

== Description ==

**Unique Query Loop Extension** adds a single toggle to the native `core/query` (Query Loop) block so posts already shown by another Query Loop on the same page are not displayed again.

= How it works =

1. Edit a Query Loop block in the block editor.
2. In the sidebar, open **Unique posts on page** and enable **Make posts unique on page**.
3. Enable the same option on any other Query Loops that should respect prior results.
4. On the front end, each enabled loop excludes post IDs already rendered by previous enabled loops.

= Features =

* Extends the core Query Loop block — no custom block or variation required.
* Uses official hooks: `query_loop_block_query_vars` and `render_block`.
* No extra database queries; only adjusts existing query arguments.
* Per-request in-memory registry (no transients or options).

= Requirements =

* WordPress 6.7 or later
* PHP 7.4 or later

= Author =

Developed by [Itamar Silva](https://github.com/silvaitamar).

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/` or install from the WordPress.org plugin directory.
2. Activate **Unique Query Loop Extension** under **Plugins**.
3. Edit a Query Loop block and enable **Make posts unique on page** in the block sidebar.

== Frequently Asked Questions ==

= Do I need a separate block? =

No. The plugin extends the native `core/query` block only.

= Does this affect the editor preview? =

The `query_loop_block_query_vars` filter runs on the front end. The editor preview uses the REST API and does not simulate cross-loop exclusion on the same page.

= Do Query Loops without the option participate? =

No. Only loops with **Make posts unique on page** enabled register and exclude posts.

= Does this work with Advanced Query Loop or other Query Loop variations? =

Yes. Variations register on the native `core/query` block. This plugin extends the same block and uses official render hooks, so it works alongside extensions like Advanced Query Loop.

== Screenshots ==

1. Toggle control in the Query Loop sidebar (coming soon).

== Changelog ==

= 1.0.0 =
* Initial release: `uniqueOnPage` attribute, front-end exclusion, and rendered post registry.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
