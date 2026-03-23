<?php
/*
Template Name: About Page
*/

get_header(); ?>

<main class="about-page">
  <!-- Hero Section -->
  <section class="hero-section bg-hero-clean">
    <div class="overlay-text">
      <h1 class="hero-title">About Don't Worry Cleaning</h1>
      <p class="hero-subtitle">Named with love. Cleaned with care. Serving the Twin Cities community.</p>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="section info-section bg-surface">
    <div class="text-container">
      <div class="split two-col balanced-layout">
        <div class="col left">
          <h2 class="headline gradient-headline">Our Story</h2>
          <p class="subtext text-muted">
            Don't Worry Cleaning &mdash; DWC &mdash; isn't just a business name. It's a tribute. The initials carry deep personal meaning, honoring someone special who taught us that a clean, cared-for home is an act of love.
          </p>
          <p class="subtext text-muted">
            That spirit lives in every home we clean. When Christi started DWC, the goal was simple: bring that same warmth, reliability, and attention to detail to busy Twin Cities families who need a hand keeping up with life.
          </p>
          <p class="subtext text-muted">
            We're not a big corporate cleaning company. We're your neighbor. We remember your preferences, we treat your home with respect, and we show up when we say we will. Because that's what family does.
          </p>
        </div>
        <div class="col right">
          <div class="local-image">
            <img src="https://images.unsplash.com/photo-1584820927498-cfe5211fd8bf?auto=format&fit=crop&w=800&q=80"
              alt="Clean kitchen — Don't Worry Cleaning Twin Cities" loading="lazy">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Meet Christi Section -->
  <section class="section info-section">
    <div class="text-container text-center">
      <h2 class="headline gradient-headline">Meet Christi</h2>
      <p class="subtext text-muted" style="max-width: 700px; margin: 0 auto 2rem;">
        Christi is the heart and hands behind Don't Worry Cleaning. A Twin Cities local with a passion for making spaces shine, she brings genuine care and meticulous attention to every home she cleans. Her clients quickly become regulars &mdash; not because of contracts, but because of trust.
      </p>
    </div>
  </section>

  <!-- Values Section -->
  <section class="section info-section bg-surface">
    <div class="text-container text-center">
      <h2 class="headline gradient-headline">What We Stand For</h2>
    </div>
    <div class="text-container">
      <div class="services-grid services-grid-three">
        <div class="service-card">
          <h3>Personal Care</h3>
          <p>Every home is treated like our own. We learn your preferences and deliver consistent, thoughtful cleaning every visit.</p>
        </div>
        <div class="service-card">
          <h3>Reliability</h3>
          <p>We show up on time, every time. Consistent scheduling, same cleaner, and fast communication you can count on.</p>
        </div>
        <div class="service-card">
          <h3>Community</h3>
          <p>We're proud to serve the Twin Cities. From Minneapolis to St. Paul and the suburbs in between, this is our home too.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="section info-section">
    <div class="text-container text-center">
      <h2 class="headline gradient-headline">Ready to Experience the DWC Difference?</h2>
      <p class="subtext text-muted" style="margin-bottom: 1.5rem;">Let us take the worry out of cleaning. Book your first session today.</p>
      <a href="#" class="btn btn-accent btn-large js-open-modal">Get a Free Quote</a>
      <p class="subtext text-muted" style="margin-top: 1rem;">
        Or call us: <strong><a href="<?php echo dwc_tel_uri(); ?>" style="color: var(--color-accent);"><?php echo esc_html(dwc_get_phone_display()); ?></a></strong>
      </p>
    </div>
  </section>
</main>

<?php get_footer(); ?>
