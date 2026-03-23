<?php
/**
 * Modal Contact Form for Don't Worry Cleaning
 */

$form_status = isset($_GET['contact_status']) ? sanitize_text_field($_GET['contact_status']) : '';
$form_message = '';

if ($form_status === 'success') {
    $form_message = 'Thanks! Your message has been sent. We will contact you shortly.';
} elseif ($form_status === 'error') {
    $form_message = 'There was an error sending your message. Please try again or text us directly.';
}
?>

<div id="contact-modal" class="modal" aria-hidden="true">
    <div class="modal-overlay" tabindex="-1" data-micromodal-close>
        <div class="modal-container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <header class="modal-header">
                <h2 id="modal-title" class="headline text-lg">Get a Free Cleaning Quote</h2>
                <button class="modal-close" aria-label="Close modal" data-micromodal-close>&times;</button>
            </header>

            <div class="modal-content">
                <p class="subtext text-muted" style="margin-bottom: 1.5rem;">
                    Tell us about your home and we'll get back to you within a few hours with a quote.
                </p>

                <?php if ($form_message): ?>
                    <div class="alert alert-<?php echo esc_attr($form_status); ?>"
                        style="margin-bottom: 1rem; padding: 1rem; border-radius: 4px; <?php echo $form_status === 'success' ? 'background: rgba(76, 175, 80, 0.1); color: #4CAF50;' : 'background: rgba(244, 67, 54, 0.1); color: #F44336;'; ?>">
                        <?php echo esc_html($form_message); ?>
                    </div>
                <?php endif; ?>

                <?php
                // TODO: Replace with your Formspree ID
                $formspree_id = 'YOUR_FORMSPREE_ID';
                $action_url = "https://formspree.io/f/" . $formspree_id;
                ?>

                <form method="post" action="<?php echo $action_url; ?>" class="lead-form">
                    <input type="hidden" name="_subject" value="New Lead from Don't Worry Cleaning Website">
                    <input type="hidden" name="_next"
                        value="<?php echo esc_url(home_url('/?contact_status=success')); ?>">
                    <input type="text" name="_gotcha" style="display:none">

                    <div class="form-group">
                        <label for="modal-name">Your Name *</label>
                        <input type="text" name="name" id="modal-name" required placeholder="Jane Smith">
                    </div>

                    <div class="form-group">
                        <label for="modal-email">Email Address *</label>
                        <input type="email" name="email" id="modal-email" required placeholder="jane@example.com">
                    </div>

                    <div class="form-group">
                        <label for="modal-phone">Phone Number *</label>
                        <input type="tel" name="phone" id="modal-phone" required placeholder="(612) 555-0123">
                    </div>

                    <div class="form-group">
                        <label for="modal-service">Service Needed</label>
                        <select name="service" id="modal-service">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Regular Cleaning">Regular House Cleaning</option>
                            <option value="Deep Cleaning">Deep Cleaning</option>
                            <option value="Move-In/Out">Move-In / Move-Out</option>
                            <option value="Recurring Plan">Recurring Cleaning Plan</option>
                            <option value="Post-Event">Post-Event Cleanup</option>
                            <option value="Other">Other / Not Sure</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modal-bedrooms">Home Size</label>
                        <select name="bedrooms" id="modal-bedrooms">
                            <option value="">Select...</option>
                            <option value="Studio/1BR">Studio / 1 Bedroom</option>
                            <option value="2BR">2 Bedrooms</option>
                            <option value="3BR">3 Bedrooms</option>
                            <option value="4BR+">4+ Bedrooms</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="modal-message">Anything else we should know?</label>
                        <textarea name="message" id="modal-message" rows="3"
                            placeholder="Tell us about your home, preferred schedule, special requests..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Request</button>
                </form>
            </div>

            <div class="modal-footer" style="margin-top: 1rem; text-align: center; font-size: 0.9rem;">
                <p style="margin-bottom: 0.5rem;">Or text us directly: <a href="<?php echo dwc_sms_uri('Hi! I\'d like a cleaning quote.'); ?>"><strong><?php echo esc_html(dwc_get_phone_display()); ?></strong></a></p>
                <p>Email: <a href="mailto:hello@dontworrycleaning.com">hello@dontworrycleaning.com</a></p>
            </div>
        </div>
    </div>
</div>
