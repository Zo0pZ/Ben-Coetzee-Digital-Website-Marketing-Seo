<?php
/**
 * Template Name: Contact Page
 */
get_header();

$submitted = isset( $_GET['contact'] ) ? sanitize_key( $_GET['contact'] ) : '';
?>

<main>

  <!-- Page Hero -->
  <section class="page-hero">
    <div class="page-hero__bg">
      <div class="hero__grid"></div>
    </div>
    <div class="container page-hero__content">
      <span class="section-label section-label--light">Get in Touch</span>
      <h1 class="page-hero__title">
        Ready to Elevate Your<br />
        <span class="highlight">Digital Presence?</span>
      </h1>
      <p class="page-hero__sub">
        Located in the South West and available for consultations across Weston-super-Mare,
        Bristol, Somerset, and beyond. Whether you are a local business looking to scale or
        a corporate firm planning a major migration, let us discuss how we can secure and
        grow your digital footprint.
      </p>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact section" id="contact">
    <div class="container contact__grid">

      <!-- Contact Form -->
      <div class="contact__form-wrap">
        <h2>Send an Enquiry</h2>
        <p class="contact__intro">All enquiries are welcomed — from first digital steps to complex enterprise migrations. I'll respond within one business day.</p>

        <?php if ( $submitted === 'success' ) : ?>
          <div class="form-success" role="alert" aria-live="assertive" tabindex="-1">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <p>Thank you for your enquiry! I'll be in touch within one business day.</p>
          </div>
        <?php else : ?>
          <?php if ( $submitted === 'error' ) : ?>
            <p class="form-error" role="alert">There was a problem with your submission. Please check all fields and try again.</p>
          <?php endif; ?>

          <form class="contact-form" id="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
            <?php wp_nonce_field( 'bcd_contact_form', 'bcd_contact_nonce' ); ?>
            <input type="hidden" name="action" value="bcd_contact" />

            <div class="form-group">
              <label for="name">Full Name <span class="required" aria-hidden="true">*</span></label>
              <input type="text" id="name" name="name" placeholder="Your full name" required autocomplete="name" value="<?php echo esc_attr( $_POST['name'] ?? '' ); ?>" />
              <span class="form-error" id="name-error" role="alert"></span>
            </div>

            <div class="form-group">
              <label for="company-size">Company Size <span class="required" aria-hidden="true">*</span></label>
              <div class="select-wrap">
                <select id="company-size" name="company_size" required>
                  <option value="" disabled selected>Select your organisation type</option>
                  <option value="local">Local Business (1–10 employees)</option>
                  <option value="sme">SME (11–50 employees)</option>
                  <option value="regional">Regional Business (51–250 employees)</option>
                  <option value="national">National Enterprise (250+ employees)</option>
                  <option value="legal">National Legal Practice</option>
                  <option value="other">Other / Not Sure</option>
                </select>
                <div class="select-arrow" aria-hidden="true">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
              </div>
              <span class="form-error" id="company-size-error" role="alert"></span>
            </div>

            <div class="form-group">
              <label for="email">Email Address <span class="required" aria-hidden="true">*</span></label>
              <input type="email" id="email" name="email" placeholder="your@email.com" required autocomplete="email" value="<?php echo esc_attr( $_POST['email'] ?? '' ); ?>" />
              <span class="form-error" id="email-error" role="alert"></span>
            </div>

            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="+44 (0) 7700 000000" autocomplete="tel" value="<?php echo esc_attr( $_POST['phone'] ?? '' ); ?>" />
            </div>

            <div class="form-group">
              <label for="project">Project Overview <span class="required" aria-hidden="true">*</span></label>
              <textarea id="project" name="project_overview" placeholder="Tell me about your project, your goals, current challenges, and any relevant timelines or budget parameters..." rows="6" required><?php echo esc_textarea( $_POST['project_overview'] ?? '' ); ?></textarea>
              <span class="form-error" id="project-error" role="alert"></span>
            </div>

            <div class="form-group form-group--checkbox">
              <label class="checkbox-label">
                <input type="checkbox" name="consent" id="consent" required />
                <span class="checkbox-custom"></span>
                <span>I agree to my data being used to respond to this enquiry. <span class="required" aria-hidden="true">*</span></span>
              </label>
              <span class="form-error" id="consent-error" role="alert"></span>
            </div>

            <button type="submit" class="btn btn--primary btn--full" id="submit-btn">
              <span class="btn__label">Send Enquiry</span>
              <span class="btn__loading" hidden aria-live="polite">Sending&hellip;</span>
            </button>
          </form>
        <?php endif; ?>
      </div>

      <!-- Contact Info -->
      <div class="contact__info">
        <div class="info-card">
          <h3>Location &amp; Coverage</h3>
          <ul class="info-list">
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>South West, United Kingdom</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
              <span>UK-wide project coverage</span>
            </li>
          </ul>
          <div class="location-tags">
            <span class="location-tag">Weston-super-Mare</span>
            <span class="location-tag">Bristol</span>
            <span class="location-tag">Somerset</span>
            <span class="location-tag">National</span>
          </div>
        </div>

        <div class="info-card">
          <h3>Response Times</h3>
          <ul class="info-list">
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span>Enquiries: within 1 business day</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span>Discovery calls available remotely</span>
            </li>
          </ul>
        </div>

        <div class="info-card info-card--accent">
          <h3>What to Expect</h3>
          <ol class="process-list">
            <li>
              <span class="process-num">01</span>
              <div>
                <strong>Initial Enquiry</strong>
                <p>Submit your project overview. I'll review and respond promptly.</p>
              </div>
            </li>
            <li>
              <span class="process-num">02</span>
              <div>
                <strong>Discovery Call</strong>
                <p>A focused conversation to understand your goals, constraints, and vision.</p>
              </div>
            </li>
            <li>
              <span class="process-num">03</span>
              <div>
                <strong>Tailored Proposal</strong>
                <p>A clear, transparent proposal aligned to your exact requirements.</p>
              </div>
            </li>
          </ol>
        </div>
      </div>

    </div>
  </section>

</main>

<?php get_footer(); ?>
