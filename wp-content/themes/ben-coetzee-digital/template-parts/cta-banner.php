<?php
/**
 * Template Part: CTA Banner
 *
 * Args:
 *   heading (string) — Banner heading
 *   sub     (string) — Banner subtext
 */
$heading = $args['heading'] ?? 'Ready to Elevate Your Digital Presence?';
$sub     = $args['sub']     ?? 'From a first discovery call to full project delivery — let\'s talk about what\'s possible.';
$contact_url = get_permalink( get_page_by_path( 'contact' ) );
?>
<section class="cta-banner section--dark" aria-label="Call to action">
  <div class="container cta-banner__inner">
    <div class="cta-banner__text">
      <h2><?php echo esc_html( $heading ); ?></h2>
      <p><?php echo esc_html( $sub ); ?></p>
    </div>
    <a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn--primary btn--lg">Discuss Your Project</a>
  </div>
</section>
