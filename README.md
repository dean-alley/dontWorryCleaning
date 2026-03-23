# Don't Worry Cleaning — WordPress Theme

**DWC** — Professional house cleaning for busy Twin Cities families.

> *Named with love.* The initials DWC honor Christi's mom. Every home we clean carries that same care.

---

## What This Is

A custom WordPress theme for **Don't Worry Cleaning**, a $50/hour residential cleaning service serving Minneapolis, St. Paul, and the Twin Cities metro. Forked and fully adapted from the Modern Life Maintenance base theme.

**Rate:** $50/hour | **No contracts** | **Text-first booking**

---

## Quick Start (Local Dev)

```powershell
# Start WordPress locally on http://localhost:8081
docker compose up -d
```

First run: complete the WordPress install at `http://localhost:8081`, then go to **Appearance → Themes** and activate **Don't Worry Cleaning**.

---

## Build for Deployment

```powershell
# Creates dist/dontworrycleaning_v1.zip
.\build.ps1
```

Then upload via **WP Admin → Appearance → Themes → Add New → Upload Theme**.

---

## Christi's Setup Checklist

After activating the theme, Christi (or Dean) needs to:

1. **Phone number** — WP Admin → Settings → DWC Settings → enter phone in E.164 format (e.g., `+16125550123`)
2. **Formspree form** — Sign up at formspree.io (free), get a form ID, update `template-parts/modal-contact.php` with your `$formspree_id`
3. **Logo** — Drop a `logo.png` into `assets/images/` (if no logo, the site shows a text fallback automatically)
4. **Email** — Search/replace `hello@dontworrycleaning.com` if using a different address
5. **Domain** — Update `https://dontworrycleaning.com` in functions.php and header.php schema if domain differs
6. **WordPress Pages** — In WP Admin, create pages with these slugs and templates:
   - `/` — set as static front page
   - `/services` — assign "Services Page" template
   - `/about` — assign "About Page" template

---

## Project Structure

```
dontworrycleaning/
├── style.css              # Theme header (v1.0)
├── functions.php          # Theme setup, DWC helpers, SEO, schema
├── header.php             # Sticky header, nav, schema JSON-LD
├── footer.php             # Footer with service areas + modal JS
├── front-page.php         # Homepage: hero, services, why-us, FAQ
├── page-about.php         # About Christi & DWC story
├── page-services.php      # Full services grid (6 services)
├── page-contact.php       # Contact redirect to modal
├── page-privacy-policy.php
├── template-parts/
│   └── modal-contact.php  # Quote request form (Formspree)
├── assets/
│   ├── css/
│   │   └── main.css       # Light teal theme (#2EC4B6)
│   └── images/
│       └── logo.png       # Drop your logo here (optional)
├── build.ps1              # Build ZIP for WordPress upload
├── docker-compose.yml     # Local dev on port 8081
└── README.md              # This file
```

---

## Color Palette

| Name | Hex | Use |
|------|-----|-----|
| Teal Primary | `#2EC4B6` | Buttons, accents, borders |
| Teal Dark | `#20A89C` | Hover states, footer headers |
| Teal Light | `#5ED3CB` | Hero highlights |
| Background | `#FFFFFF` | Page background |
| Surface | `#F0FAFA` | Card/section backgrounds |
| Text Primary | `#1a2e35` | Body text |
| Text Muted | `#5A6A72` | Subtitles, descriptions |
| Border | `#D0E8E6` | Card borders |

---

## Service Areas

Minneapolis · St. Paul · Bloomington · Edina · Plymouth · Maple Grove · Eagan · Burnsville · Richfield · Hopkins · Brooklyn Park · Coon Rapids · Anoka · Blaine

---

## Services Offered

- Regular House Cleaning (weekly/biweekly)
- Deep Cleaning
- Move-In / Move-Out Cleaning
- Recurring Cleaning Plans
- Post-Event Cleanup
- Organizing & Tidying

---

## SEO Strategy

Targeting:
- "Twin Cities house cleaning"
- "Minneapolis cleaning service"
- "St. Paul residential cleaning"
- "house cleaning Minneapolis MN"
- "move out cleaning Twin Cities"

Schema markup: `LocalBusiness` + `FAQPage` JSON-LD on all pages.

---

## Tech Notes

- **Form handling:** Formspree (free tier works fine for low volume)
- **Modal:** Vanilla JS, zero dependencies
- **Images:** Unsplash URLs as placeholders — swap in real photos later
- **Port:** 8081 locally (avoids conflict with MLM theme on 8080)
- **PHP:** 8.2+ / WordPress 6.6+

---

*Built by Dean Alley for Christi. In memory of D.W.C.*
