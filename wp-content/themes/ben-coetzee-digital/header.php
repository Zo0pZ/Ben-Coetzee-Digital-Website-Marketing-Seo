<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <nav class="nav container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
      <span class="logo-mark">BC</span>
      <span class="logo-text">Ben Coetzee Digital</span>
    </a>

    <button class="nav__toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <ul class="nav__links" id="nav-links">
      <li>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__link <?php echo is_front_page() ? 'active' : ''; ?>">Home</a>
      </li>

      <li class="nav__item--dropdown">
        <a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="nav__link <?php echo get_post_type() === 'service' ? 'active' : ''; ?>" aria-haspopup="true" aria-expanded="false" id="services-toggle">Services</a>
        <ul class="nav__dropdown" aria-label="Services submenu">
          <?php
          $services = new WP_Query( [
            'post_type'      => 'service',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_status'    => 'publish',
          ] );
          if ( $services->have_posts() ) :
            while ( $services->have_posts() ) : $services->the_post(); ?>
              <li>
                <a href="<?php the_permalink(); ?>" <?php echo is_singular( 'service' ) && get_the_ID() === get_the_ID() ? 'class="active"' : ''; ?>>
                  <?php the_title(); ?>
                </a>
              </li>
            <?php endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </ul>
      </li>

      <li>
        <?php $about_url = get_permalink( get_page_by_path( 'about' ) ); ?>
        <a href="<?php echo esc_url( $about_url ); ?>" class="nav__link <?php echo is_page( 'about' ) ? 'active' : ''; ?>">About</a>
      </li>
      <li>
        <?php $contact_url = get_permalink( get_page_by_path( 'contact' ) ); ?>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="nav__link <?php echo is_page( 'contact' ) ? 'active' : ''; ?>">Contact</a>
      </li>
      <li>
        <a href="<?php echo esc_url( $contact_url ); ?>" class="nav__link nav__cta">Discuss Your Project</a>
      </li>
    </ul>
  </nav>
</header>
