  <footer class="site-footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__logo">
          <span class="logo-mark">BC</span>
          <span class="logo-text">Ben Coetzee Digital</span>
        </a>
        <p>Enterprise-grade digital performance, tailored for your ambition. Based in the South West, serving the UK.</p>
      </div>

      <nav class="footer__nav" aria-label="Footer navigation">
        <h3>Navigation</h3>
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
          <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>">About</a></li>
          <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>">Contact</a></li>
        </ul>
      </nav>

      <div class="footer__services">
        <h3>Services</h3>
        <ul>
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
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </ul>
      </div>

      <div class="footer__contact">
        <h3>Location</h3>
        <p>South West, UK<br />Weston-super-Mare &bull; Bristol &bull; Somerset</p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--outline btn--sm">Get in Touch</a>
      </div>
    </div>

    <div class="footer__bottom">
      <div class="container">
        <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>
</body>
</html>
