<?php
/**
 * 404 Template
 */
get_header(); ?>

<main>

  <section class="page-hero">
    <div class="page-hero__bg"><div class="hero__grid"></div></div>
    <div class="container page-hero__content">
      <span class="section-label section-label--light">404</span>
      <h1 class="page-hero__title">Page Not Found.</h1>
      <p class="page-hero__sub">The page you're looking for doesn't exist or has been moved.</p>
    </div>
  </section>

  <section class="section">
    <div class="container" style="text-align:center;padding-top:var(--space-10);padding-bottom:var(--space-16);">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">Return Home</a>
      &nbsp;
      <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--ghost">Contact Me</a>
    </div>
  </section>

</main>

<?php get_footer(); ?>
