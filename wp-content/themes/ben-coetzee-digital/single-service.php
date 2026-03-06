<?php
/**
 * Single Service Template
 * Used for the 'service' custom post type.
 *
 * Required post meta:
 *   _service_number, _service_badge, _service_hero_subtitle,
 *   _service_icon_svg, _service_stat_{1|2|3}_{num|label},
 *   _service_cta_heading, _service_cta_sub
 */
get_header();

while ( have_posts() ) : the_post();

  $badge    = bcd_get_service_meta( '_service_badge' ) ?: 'Service';
  $subtitle = bcd_get_service_meta( '_service_hero_subtitle' );
  $stat1n   = bcd_get_service_meta( '_service_stat_1_num' );
  $stat1l   = bcd_get_service_meta( '_service_stat_1_label' );
  $stat2n   = bcd_get_service_meta( '_service_stat_2_num' );
  $stat2l   = bcd_get_service_meta( '_service_stat_2_label' );
  $stat3n   = bcd_get_service_meta( '_service_stat_3_num' );
  $stat3l   = bcd_get_service_meta( '_service_stat_3_label' );
  $cta_h    = bcd_get_service_meta( '_service_cta_heading' ) ?: 'Ready to Get Started?';
  $cta_s    = bcd_get_service_meta( '_service_cta_sub' )     ?: 'Let\'s start with a conversation about what you need and where you want to go.';
  $contact  = get_permalink( get_page_by_path( 'contact' ) );
  ?>

<main>

  <!-- Page Hero -->
  <section class="page-hero">
    <div class="page-hero__bg"><div class="hero__grid"></div></div>
    <div class="container page-hero__content">
      <div class="svc-breadcrumb">
        <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>">Services</a>
        <span aria-hidden="true">/</span>
        <span><?php the_title(); ?></span>
      </div>
      <div class="svc-hero-inner">
        <div class="svc-hero-text">
          <span class="section-label section-label--light"><?php echo esc_html( $badge ); ?></span>
          <h1 class="page-hero__title"><?php the_title(); ?></h1>
          <?php if ( $subtitle ) : ?>
            <p class="page-hero__sub"><?php echo esc_html( $subtitle ); ?></p>
          <?php endif; ?>
          <div class="hero__actions">
            <a href="<?php echo esc_url( $contact ); ?>" class="btn btn--primary">Start a Project</a>
            <a href="#overview" class="btn btn--ghost">Learn More</a>
          </div>
        </div>
        <?php if ( $stat1n || $stat2n || $stat3n ) : ?>
          <div class="svc-hero-stats">
            <?php if ( $stat1n ) : ?>
              <div class="svc-stat">
                <span class="svc-stat__num"><?php echo esc_html( $stat1n ); ?></span>
                <span class="svc-stat__label"><?php echo esc_html( $stat1l ); ?></span>
              </div>
            <?php endif; ?>
            <?php if ( $stat2n ) : ?>
              <div class="svc-stat">
                <span class="svc-stat__num"><?php echo esc_html( $stat2n ); ?></span>
                <span class="svc-stat__label"><?php echo esc_html( $stat2l ); ?></span>
              </div>
            <?php endif; ?>
            <?php if ( $stat3n ) : ?>
              <div class="svc-stat">
                <span class="svc-stat__num"><?php echo esc_html( $stat3n ); ?></span>
                <span class="svc-stat__label"><?php echo esc_html( $stat3l ); ?></span>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="svc-deliverables section" id="overview">
    <div class="container">
      <?php the_content(); ?>
    </div>
  </section>

  <!-- Related Services -->
  <?php
  $related = new WP_Query( [
    'post_type'      => 'service',
    'posts_per_page' => 3,
    'post__not_in'   => [ get_the_ID() ],
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
  ] );

  if ( $related->have_posts() ) : ?>
    <section class="related-services section" id="related">
      <div class="container">
        <div class="section-header">
          <span class="section-label">Complementary Services</span>
          <h2 class="section-title">Extend Your Digital Investment.</h2>
        </div>
        <div class="related-grid">
          <?php
          $related_icon_svg = '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 3v18h18"/><path d="M7 16l4-4 4 4 4-8"/></svg>';
          while ( $related->have_posts() ) : $related->the_post();
            $r_icon = bcd_get_service_meta( '_service_icon_svg' ) ?: $related_icon_svg;
            ?>
            <a href="<?php the_permalink(); ?>" class="related-card">
              <div class="related-card__icon"><?php echo $r_icon; ?></div>
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html( get_the_excerpt() ); ?></p>
              <span class="related-card__arrow">&rarr;</span>
            </a>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <!-- CTA Banner -->
  <?php get_template_part( 'template-parts/cta-banner', null, [
    'heading' => $cta_h,
    'sub'     => $cta_s,
  ] ); ?>

</main>

<?php endwhile; ?>

<?php get_footer(); ?>
