<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <title>Don't Worry Cleaning | Twin Cities House Cleaning | Minneapolis & St. Paul, MN</title>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="Professional house cleaning for busy Twin Cities families. Residential cleaning, deep cleaning, move-in/move-out & more. $50/hr. Serving Minneapolis, St. Paul & suburbs.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Critical CSS: light clean theme, above the fold -->
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    .skip-link { position: absolute; left: -9999px; top: -9999px; }
    .skip-link:focus {
      position: fixed; top: 10px; left: 10px; z-index: 100000;
      background: #2EC4B6; color: white; padding: 1rem; border-radius: 4px;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: #FFFFFF;
      color: #1a2e35;
      line-height: 1.6;
    }

    .site-header-wrap {
      background-color: #FFFFFF;
      border-bottom: 2px solid #2EC4B6;
      box-shadow: 0 2px 8px rgba(46, 196, 182, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .site-header {
      background-color: #FFFFFF;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
    }

    .site-logo img { max-height: 80px; height: auto; width: auto; }

    .site-logo-text {
      font-size: 1.5rem;
      font-weight: 800;
      color: #2EC4B6;
      text-decoration: none;
      letter-spacing: -0.5px;
    }
    .site-logo-text em { font-style: normal; color: #1a2e35; }

    .site-nav { display: flex; gap: 2rem; align-items: center; }

    .site-nav a {
      color: #1a2e35;
      text-decoration: none;
      font-weight: 500;
      font-size: 1rem;
      transition: color 0.2s;
    }
    .site-nav a:hover { color: #2EC4B6; }

    .btn-nav-cta {
      background: #2EC4B6 !important;
      color: white !important;
      padding: 0.65rem 1.4rem;
      border-radius: 6px;
      font-weight: 700;
      transition: all 0.2s !important;
    }
    .btn-nav-cta:hover {
      background: #20A89C !important;
      color: white !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(46, 196, 182, 0.3) !important;
    }

    .hero-section { min-height: 60vh; display: flex; align-items: center; justify-content: center; }
    .text-center { text-align: center; }

    @media (max-width: 768px) {
      .site-header { flex-direction: column; gap: 1rem; padding: 1rem; }
      .site-nav { flex-wrap: wrap; justify-content: center; gap: 1rem; }
    }
  </style>

  <?php wp_head(); ?>

  <!-- LocalBusiness Schema -->
  <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Don't Worry Cleaning",
  "description": "Professional residential cleaning services in Minneapolis, St. Paul and the Twin Cities metro. $50/hour, no contracts.",
  "url": "https://dontworrycleaning.com",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Minneapolis",
    "addressRegion": "MN",
    "addressCountry": "US"
  },
  "areaServed": [
    "Minneapolis", "St. Paul", "Bloomington", "Edina", "Plymouth",
    "Maple Grove", "Eagan", "Burnsville", "Richfield", "Hopkins",
    "Brooklyn Park", "Coon Rapids", "Anoka", "Blaine"
  ],
  "telephone": "<?php echo esc_js(dwc_get_phone()); ?>",
  "email": "hello@dontworrycleaning.com",
  "priceRange": "$$",
  "openingHours": "Mo-Sa 08:00-18:00",
  "serviceType": [
    "Residential House Cleaning",
    "Deep Cleaning",
    "Move-In / Move-Out Cleaning",
    "Recurring Cleaning Plans",
    "Post-Event Cleanup"
  ]
}
  </script>
</head>

<body <?php body_class(); ?>>
  <a href="#main-content" class="skip-link" tabindex="1">Skip to main content</a>

  <div class="site-header-wrap">
    <header class="site-header">
      <div class="site-logo">
        <a href="<?php echo home_url(); ?>">
          <?php if (file_exists(get_template_directory() . '/assets/images/logo.png')): ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
                 alt="Don't Worry Cleaning — Twin Cities House Cleaning">
          <?php else: ?>
            <span class="site-logo-text">Don't Worry <em>Cleaning</em></span>
          <?php endif; ?>
        </a>
      </div>

      <nav class="site-nav" aria-label="Site navigation">
        <a href="<?php echo home_url(); ?>">Home</a>
        <a href="<?php echo home_url('/services'); ?>">Services</a>
        <a href="<?php echo home_url('/about'); ?>">About</a>
        <a href="<?php echo home_url('/#faq'); ?>">FAQ</a>
        <?php $cta_href = wp_is_mobile() ? dwc_sms_uri('Hi! I\'d like a cleaning quote.') : '#'; ?>
        <a href="<?php echo esc_url($cta_href); ?>"
           class="btn-nav-cta <?php echo wp_is_mobile() ? '' : 'js-open-modal'; ?>">Get a Quote</a>
      </nav>
    </header>
  </div>
