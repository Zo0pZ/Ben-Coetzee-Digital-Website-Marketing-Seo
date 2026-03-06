# Ben Coetzee Digital — WordPress Theme

Custom WordPress theme converted from the static HTML/CSS/JS site. Pixel-faithful reproduction of the original dark design.

## Installation

1. Copy the `ben-coetzee-digital` folder to `wp-content/themes/` on your WordPress installation.
2. Activate the theme in **Appearance → Themes**.
3. Visit **Settings → Reading** and set your homepage to a static page — create a page called **Home** and set the front page to it. WordPress will use `front-page.php` automatically.

## Required Pages

Create these pages in WordPress, using the specified page template where noted:

| Page Title | Slug | Template |
|---|---|---|
| Home | `home` | _(set as front page in Settings → Reading)_ |
| About | `about` | **About Page** |
| Contact | `contact` | **Contact Page** |

## Services (Custom Post Type)

Each service from the static site becomes a **Service** post. Create them under **Services → Add New** in the WordPress admin.

For each service, fill in the **Service Details** meta box:

| Field | Example |
|---|---|
| Service Number | `01` |
| Hero Badge | `Service 01` |
| Hero Subtitle | `Every pixel purposeful...` |
| Card Icon SVG | Paste the `<svg>` tag from the static HTML |
| Stat 1–3 Number & Label | `100%` / `Custom-Built` |
| CTA Banner Heading | `Ready to Build Something Exceptional?` |
| CTA Banner Subtext | `Let's start with a conversation...` |

Set the **post excerpt** — this is used as the service card body text on the homepage.

Set **Menu Order** (in the Page Attributes box) to control the display order: 1, 2, 3, 4, 5.

The **post content** (WordPress editor) is output in the main body of the service page. Use it for the deliverables, process, and audience sections — format them with headings and the site's BEM classes via the HTML block editor.

## Contact Form

The contact form submits via `wp_mail()` to the site's admin email (`Settings → General → Administration Email Address`). No plugin required.

Query string `?contact=success` shows the success state; `?contact=error` shows the error state.

## Theme Structure

```
ben-coetzee-digital/
├── style.css              — Theme header (no styles here; CSS loaded from assets/)
├── functions.php          — Theme setup, CPT registration, meta boxes, form handler
├── header.php             — Site header + navigation
├── footer.php             — Site footer
├── front-page.php         — Homepage (hero, intro, services grid, why, CTA)
├── page.php               — Generic page fallback
├── page-about.php         — About page (slug: about)
├── page-contact.php       — Contact page (slug: contact)
├── single-service.php     — Individual service page
├── single.php             — Blog post
├── index.php              — Blog archive / fallback
├── 404.php                — 404 error page
├── template-parts/
│   └── cta-banner.php     — Reusable CTA banner section
└── assets/
    ├── css/style.css      — Full site stylesheet (all design tokens + components)
    └── js/main.js         — Nav toggle, scroll reveal, form validation, smooth scroll
```

## Design System

All CSS custom properties are defined in `assets/css/style.css`:
- Colours: `--clr-gold`, `--clr-surface`, `--clr-border`, `--clr-text-muted`
- Spacing: `--space-1` through `--space-16`
- Type scale: `--text-xs` through `--text-5xl`
- Fonts: Inter (body) + Playfair Display (headings) via Google Fonts
