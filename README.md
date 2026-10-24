# Spadak WP Stories Instagram

**Instagram-style stories for WordPress** — image & video, auto cover, fullscreen player, unique view tracking, and a modern responsive admin dashboard.

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-GPL--2.0%2B-green.svg)](LICENSE)
[![Version](https://img.shields.io/badge/Version-2.0.0-orange.svg)](https://github.com/mpsaeid-spadak/spadak-wp-stories-instagram)

---

## Features

| Feature | Description |
|--------|-------------|
| **Story tray** | Circular avatars with Instagram-like gradient rings; seen stories turn gray |
| **Fullscreen player** | Progress bars, hold-to-pause, swipe between authors, keyboard shortcuts |
| **Image & video** | Featured image stories or MP4/WebM video with optional poster |
| **Auto cover** | When a video is selected from the Media Library, cover is set when available |
| **Unique views** | Cookie for guests, user meta for logged-in users |
| **Expiry** | Configurable lifetime (default 24h); optional hourly auto-delete via cron |
| **Admin dashboard** | Stats cards, modern UI, RTL-ready, responsive |
| **Display** | Shortcode `[spadak_stories]` + widget (legacy `[wp_stories]` supported) |
| **No jQuery** | Vanilla JS on the frontend |

---

## Requirements

- WordPress **6.0+**
- PHP **7.4+**
- Modern browser (ES5+)

---

## Installation

1. Download or clone this repository into `wp-content/plugins/spadak-wp-stories-instagram`
2. Activate **Spadak WP Stories Instagram** in WordPress Admin → Plugins
3. Open **Stories → Dashboard** and **Stories → Settings**
4. Create stories under **Stories → Add New**
5. Place the shortcode or widget where you want the tray

```bash
# Clone
git clone https://github.com/mpsaeid-spadak/spadak-wp-stories-instagram.git \
  wp-content/plugins/spadak-wp-stories-instagram
```

---

## Shortcode

```
[spadak_stories]
[spadak_stories limit="12" size="72" author="0" label="Stories"]
```

| Attribute | Default | Description |
|-----------|---------|-------------|
| `limit` | `12` | Max number of authors in the tray |
| `size` | `72` | Avatar diameter in pixels (48–120) |
| `author` | `0` | Restrict to one author ID (`0` = all) |
| `label` | `''` | Optional heading above the tray |

Legacy shortcode **`[wp_stories]`** still works with the same attributes.

---

## Admin

- **Stories → Dashboard** — active/total stats, how-to, tips  
- **Stories → All Stories** — list with preview, type, views, expiry  
- **Stories → Add New** — title, featured image (cover), video URL / Media Library  
- **Stories → Settings** — lifetime, access (public / logged-in), image duration, auto-delete  

---

## Player controls

| Input | Action |
|-------|--------|
| Tap left / ← | Previous story |
| Tap right / → | Next story |
| Hold center | Pause |
| Swipe left/right | Next/previous author |
| Swipe down | Close |
| Space | Pause / resume |
| M | Mute / unmute |
| Esc | Close |

---

## Plugin structure

```
spadak-wp-stories-instagram/
├── spadak-wp-stories-instagram.php   # Bootstrap
├── uninstall.php
├── readme.txt                        # WordPress.org style
├── admin/
│   └── class-spadak-stories-admin.php
├── includes/
│   ├── class-spadak-stories.php
│   ├── class-spadak-stories-helper.php
│   ├── class-spadak-stories-post-type.php
│   ├── class-spadak-stories-meta.php
│   ├── class-spadak-stories-views.php
│   ├── class-spadak-stories-settings.php
│   ├── class-spadak-stories-shortcode.php
│   └── class-spadak-stories-widget.php
├── assets/
│   ├── css/admin.css
│   ├── css/spadak-stories.css
│   ├── js/admin.js
│   └── js/spadak-stories.js
└── languages/
```

---

## Roadmap — next 3 versions

### v2.1.0 — Experience & content

- **Gutenberg block** — drag-and-drop Stories block with live preview  
- **Multiple media per story** — sequence of images/videos in one story item  
- **Text overlays** — optional caption / sticker text on image stories  
- **Persian (fa_IR) complete translation** + `.pot` for other languages  
- **REST API** endpoints for headless / SPA frontends  
- Better **auto-generated video posters** (first-frame extraction when server allows)

### v2.2.0 — Engagement & analytics

- **Reactions** (like / emoji) on stories with aggregate counts  
- **Story replies** (optional, moderated)  
- **Admin analytics** — views over time, top stories, top authors  
- **Export / CSV** of view data  
- **Highlight archives** — pin expired stories into permanent “Highlights”  
- Optional **email digest** of story performance

### v3.0.0 — Scale & integrations

- **Multi-author “circles”** and group stories  
- **WooCommerce** — product stories / shoppable stickers  
- **Scheduled publishing** of stories  
- **CDN-friendly** media handling and lazy loading improvements  
- **Accessibility** audit (ARIA, reduced motion, screen reader labels)  
- **WordPress.org** submission-ready packaging and security review  

Feedback and PRs are welcome — open an issue or discussion on this repo.

---

## Development

Coding standards: WordPress PHP Coding Standards, escaping/sanitization by default, nonces + capability checks on all write paths.

```bash
# Optional: PHPCS
composer require --dev wp-coding-standards/wpcs
phpcs --standard=WordPress .
```

---

## Changelog

### 2.0.0

- Rebranded to **Spadak WP Stories Instagram**
- Modern responsive admin dashboard with stats
- Instagram-like player (progress, hold-to-pause, swipe, mute)
- Video media picker + auto cover support
- Unique view tracking and settings overhaul
- RTL and mobile polish

### 1.0.0

- Initial release (as WP Stories)

---

## License

GPL-2.0-or-later — see [LICENSE](LICENSE) (or WordPress core license terms).

## Author

**Spadak** — [mpsaeid-spadak](https://github.com/mpsaeid-spadak)

---

Made for WordPress sites that want a native, lightweight Instagram Stories experience.
