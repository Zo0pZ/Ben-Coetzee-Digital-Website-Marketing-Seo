# Ben Coetzee Digital — Marketing & SEO Website

The official website for **Ben Coetzee Digital Consultancy**, a digital consultancy based in the South West UK providing enterprise-grade website design, digital marketing, SEO, and technical services to businesses across Weston-super-Mare, Bristol, Somerset, and nationally.

---

## Overview

This is a static HTML/CSS/JS website deployed to **GitHub Pages**. It is built without frameworks or build tools — pure HTML5, CSS, and vanilla JavaScript — making it fast, lightweight, and easy to maintain.

---

## Pages

| File | Description |
|---|---|
| `index.html` | Homepage — hero, services overview, USP pillars, CTA |
| `about.html` | About page — bio, expertise grid, client types |
| `contact.html` | Contact page — enquiry form |
| `service-bespoke-design.html` | Service page — Bespoke Website Design |
| `service-digital-marketing.html` | Service page — Digital Marketing & CRO |
| `service-platform-migrations.html` | Service page — Platform Migrations & CMS Expertise |
| `service-ux-accessibility.html` | Service page — UX & Accessibility Compliance |

---

## Project Structure

```
/
├── index.html
├── about.html
├── contact.html
├── service-bespoke-design.html
├── service-digital-marketing.html
├── service-platform-migrations.html
├── service-ux-accessibility.html
├── assets/
│   ├── css/
│   │   └── style.css        # All site styles
│   └── js/
│       └── main.js          # Navigation, scroll behaviour, interactions
└── .github/
    └── workflows/
        └── pages.yml        # GitHub Actions — auto-deploy to GitHub Pages
```

---

## Services

1. **Bespoke Website Design** — Custom responsive websites and WordPress themes built from scratch.
2. **Digital Marketing & CRO** — SEO, Google Analytics, Search Console, and A/B testing programmes.
3. **Platform Migrations & CMS Expertise** — Complex migrations between platforms including Umbraco and WordPress.
4. **UX & Accessibility Compliance** — WCAG-compliant, inclusive design for legal and commercial clients.

---

## Deployment

The site is deployed automatically via **GitHub Actions** on every push to `main`.

**Workflow:** `.github/workflows/pages.yml`

- Triggers on push to `main` or manual dispatch
- Uploads the entire repository root as the Pages artifact
- Deploys to GitHub Pages

No build step is required — the site deploys as-is.

---

## Local Development

No dependencies or build tools needed. Simply open any HTML file in a browser, or serve locally with any static file server:

```bash
# Python
python -m http.server 8000

# Node (npx)
npx serve .
```

Then visit `http://localhost:8000`.

---

## Tech Stack

- **HTML5** — semantic markup throughout
- **CSS** — custom properties, BEM-style naming, responsive grid/flexbox layouts
- **JavaScript** — vanilla JS for navigation toggle, scroll effects, and dynamic year in footer
- **Fonts** — Inter (body) and Playfair Display (headings) via Google Fonts
- **Hosting** — GitHub Pages
- **CI/CD** — GitHub Actions

---

## Contact

For project enquiries, visit the [contact page](contact.html) on the live site or reach out through the website.

&copy; 2026 Ben Coetzee Digital Consultancy. All rights reserved.
