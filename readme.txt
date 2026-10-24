=== Spadak WP Stories Instagram ===
Contributors: spadak
Tags: stories, instagram stories, story, reels, status, social
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 2.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

استوری‌های حرفه‌ای شبیه اینستاگرام برای وردپرس — تصویر و ویدیو، کاور خودکار، پلیر تمام‌صفحه، شمارنده بازدید و داشبورد مدرن.

== Description ==

**Spadak WP Stories Instagram** adds Instagram-style stories to any WordPress site.

* Circular story tray with gradient rings (seen stories turn gray)
* Fullscreen player: progress bars, hold to pause, swipe between authors, keyboard shortcuts
* Image and video stories (MP4/WebM)
* Automatic cover/poster for videos when available
* Unique view counting (cookie for guests, user meta for logged-in)
* Configurable lifetime (default 24h) and hourly auto-cleanup
* Modern responsive admin dashboard with stats
* Shortcode `[spadak_stories]` and widget
* RTL-ready, no jQuery on the frontend

== Installation ==

1. Upload the `spadak-wp-stories-instagram` folder to `/wp-content/plugins/`.
2. Activate the plugin.
3. Go to **Stories → Dashboard** and **Stories → Settings**.
4. Create stories under **Stories → Add New**.
5. Place `[spadak_stories]` on any page or use the Stories widget.

== Shortcode ==

`[spadak_stories limit="12" size="72" author="0" label=""]`

* `limit` — max authors
* `size` — avatar size in px
* `author` — single author ID (0 = all)
* `label` — optional heading

Legacy shortcode `[wp_stories]` still works.

== Changelog ==

= 2.0.0 =
* Rebranded to Spadak WP Stories Instagram
* Modern responsive admin dashboard with stats cards
* Improved Instagram-like UI (progress, hold-to-pause, swipe, mute)
* Better video media picker + auto cover support
* Unique view tracking and settings overhaul
* RTL and mobile polish

= 1.0.0 =
* Initial release (as WP Stories)
