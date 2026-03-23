<footer class="site-footer" role="contentinfo" aria-label="Site Footer">
  <div class="footer-content">
    <h2>A Clean Home, A Clear Mind</h2>

    <!-- Business Information -->
    <div class="footer-section footer-business">
      <h3>Don't Worry Cleaning</h3>
      <div class="business-info">
        <p class="service-area"><strong>Serving:</strong> Minneapolis, St. Paul & the entire Twin Cities metro</p>
        <p class="phone">
          <strong>Text:</strong> <a href="<?php echo dwc_sms_uri('Hi! I\'d like a cleaning quote.'); ?>">Start a text</a>
          &nbsp; | &nbsp;
          <strong>Call:</strong> <a href="<?php echo dwc_tel_uri(); ?>"><?php echo esc_html(dwc_get_phone_display()); ?></a>
        </p>
        <p class="email">
          <strong>Email:</strong> <a href="mailto:hello@dontworrycleaning.com">hello@dontworrycleaning.com</a>
        </p>
        <p><strong>Rate:</strong> $50/hour &mdash; no contracts, no surprises</p>
      </div>
    </div>

    <!-- Services -->
    <div class="footer-section footer-services">
      <h3>Our Services</h3>
      <ul>
        <li><a href="<?php echo home_url('/services'); ?>">Regular House Cleaning</a></li>
        <li><a href="<?php echo home_url('/services'); ?>">Deep Cleaning</a></li>
        <li><a href="<?php echo home_url('/services'); ?>">Move-In / Move-Out</a></li>
        <li><a href="<?php echo home_url('/services'); ?>">Recurring Cleaning Plans</a></li>
        <li><a href="<?php echo home_url('/services'); ?>">Post-Event Cleanup</a></li>
        <li><a href="<?php echo home_url('/services'); ?>">Organizing & Tidying</a></li>
      </ul>
    </div>

    <!-- Service Areas -->
    <div class="footer-section footer-areas">
      <h3>Service Areas</h3>
      <ul>
        <li>Minneapolis</li>
        <li>St. Paul</li>
        <li>Bloomington &amp; Edina</li>
        <li>Plymouth &amp; Maple Grove</li>
        <li>Eagan &amp; Burnsville</li>
        <li>Richfield &amp; Hopkins</li>
        <li>Brooklyn Park &amp; Coon Rapids</li>
        <li>Anoka &amp; Blaine</li>
        <li>And surrounding suburbs</li>
      </ul>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="footer-content">
      <p>&copy; <?php echo date('Y'); ?> Don't Worry Cleaning. All rights reserved.</p>
      <p><em>Named with love. Cleaned with care.</em> | Serving the Twin Cities Metro</p>
    </div>
  </div>
</footer>

<?php get_template_part('template-parts/modal-contact'); ?>

<!-- Modal JS — lightweight, no dependencies -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  var modal = document.getElementById('contact-modal');
  if (!modal) return;

  function openModal() {
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    var first = modal.querySelector('input, select, textarea, button');
    if (first) first.focus();
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  }

  document.querySelectorAll('.js-open-modal').forEach(function (el) {
    el.addEventListener('click', function (e) {
      e.preventDefault();
      openModal();
    });
  });

  modal.querySelectorAll('[data-micromodal-close]').forEach(function (el) {
    el.addEventListener('click', closeModal);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) {
      closeModal();
    }
  });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
