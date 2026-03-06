<?php get_header(); ?>

<main>

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="hero__bg">
      <div class="hero__grid"></div>
    </div>
    <div class="container hero__content">
      <div class="hero__badge">Digital Consultancy &bull; South West UK</div>
      <h1 class="hero__headline">
        Enterprise-Grade Digital Performance.<br />
        <span class="highlight">Tailored for Your Ambition.</span>
      </h1>
      <p class="hero__sub">
        I am Ben Coetzee, a Digital Website Manager delivering premium website design,
        data-led digital marketing, and complex technical upgrades. Based in the South West,
        I provide corporate-level digital infrastructure for national legal firms and
        ambitious local businesses alike.
      </p>
      <div class="hero__actions">
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Discuss Your Project</a>
        <a href="#services" class="btn btn--ghost">View Services</a>
      </div>
      <div class="hero__stats">
        <div class="stat">
          <span class="stat__number">15+</span>
          <span class="stat__label">Years Experience</span>
        </div>
        <div class="stat__divider"></div>
        <div class="stat">
          <span class="stat__number">100%</span>
          <span class="stat__label">Client Focus</span>
        </div>
        <div class="stat__divider"></div>
        <div class="stat">
          <span class="stat__number">UK-Wide</span>
          <span class="stat__label">Project Reach</span>
        </div>
      </div>
    </div>
    <div class="hero__scroll" aria-hidden="true">
      <div class="scroll-indicator"></div>
    </div>
  </section>

  <!-- Introduction Section -->
  <section class="intro section" id="intro">
    <div class="container intro__grid">
      <div class="intro__label">
        <span class="section-label">Introduction</span>
      </div>
      <div class="intro__body">
        <h2 class="intro__heading">Big-Budget Capability, Scaled for You.</h2>
        <h3 class="intro__sub-heading">Delivering Excellence, From Local Start-Ups to Corporate Enterprises.</h3>
        <p>
          With over 15 years in digital transformation and website management, I have a proven
          track record of delivering engaging corporate websites. Having managed multi-regional
          web presences for highly regulated industries, I bring rigorous, big-budget capability
          to businesses of all sizes across Weston-super-Mare, Bristol, and Somerset.
        </p>
        <p>
          Whether you are a growing local business taking your first major digital step, or a
          national legal practice requiring a complex, secure platform upgrade, I deliver
          exceptional digital experiences that align precisely with your commercial objectives.
        </p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="btn btn--outline">Learn About My Approach</a>
      </div>
      <div class="intro__visual" aria-hidden="true">
        <div class="intro__card intro__card--1">
          <div class="card-icon">&#9670;</div>
          <span>Strategy</span>
        </div>
        <div class="intro__card intro__card--2">
          <div class="card-icon">&#9632;</div>
          <span>Design</span>
        </div>
        <div class="intro__card intro__card--3">
          <div class="card-icon">&#9650;</div>
          <span>Growth</span>
        </div>
        <div class="intro__connector"></div>
      </div>
    </div>
  </section>

  <!-- Core Services Section -->
  <section class="services section section--dark" id="services">
    <div class="container">
      <div class="section-header">
        <span class="section-label section-label--light">Core Services</span>
        <h2 class="section-title section-title--light">Strategic Digital Solutions for Every Scale.</h2>
      </div>
      <div class="services__grid">
        <?php
        $services = new WP_Query( [
          'post_type'      => 'service',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
          'post_status'    => 'publish',
        ] );

        if ( $services->have_posts() ) :
          while ( $services->have_posts() ) : $services->the_post();
            $number   = bcd_get_service_meta( '_service_number' ) ?: '01';
            $icon_svg = bcd_get_service_meta( '_service_icon_svg' );
            $excerpt  = get_the_excerpt();
            ?>
            <article class="service-card">
              <div class="service-card__number"><?php echo esc_html( $number ); ?></div>
              <?php if ( $icon_svg ) : ?>
                <div class="service-card__icon"><?php echo $icon_svg; // Already sanitized on save ?></div>
              <?php endif; ?>
              <h3 class="service-card__title"><?php the_title(); ?></h3>
              <p class="service-card__body"><?php echo esc_html( $excerpt ); ?></p>
              <a href="<?php the_permalink(); ?>" class="service-card__link">Learn More &rarr;</a>
            </article>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p class="section-sub">Services coming soon.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Why Choose Me Section -->
  <section class="why section" id="why">
    <div class="container why__inner">
      <div class="why__content">
        <span class="section-label">Competitive Advantage</span>
        <h2 class="section-title">The Independent Partner with Enterprise Standards.</h2>
        <p>
          Many local digital agencies are equipped only for basic builds. Conversely, large
          corporate agencies carry massive overheads. I bridge this gap. You receive the direct
          accountability of an independent consultant, backed by the strategic mindset of a
          Senior Digital Manager.
        </p>
        <p>
          I am highly experienced in presenting to senior stakeholders and managing
          relationships across multiple business areas. From ensuring brand consistency to
          identifying intricate development needs, I safeguard your digital investment from
          inception to successful delivery.
        </p>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Work With Me</a>
      </div>
      <div class="why__pillars">
        <div class="pillar">
          <div class="pillar__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          </div>
          <h4>Corporate Expertise</h4>
          <p>Senior-level strategic thinking applied to every project, regardless of scale.</p>
        </div>
        <div class="pillar">
          <div class="pillar__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h4>Direct Accountability</h4>
          <p>One point of contact. No handoffs, no confusion. Your project, my responsibility.</p>
        </div>
        <div class="pillar">
          <div class="pillar__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          </div>
          <h4>Investment Protected</h4>
          <p>Rigorous approach to security, compliance, and quality at every stage of delivery.</p>
        </div>
        <div class="pillar">
          <div class="pillar__icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <h4>National Reach, Local Roots</h4>
          <p>Serving businesses across the South West and nationally, with a personal touch.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Banner -->
  <?php get_template_part( 'template-parts/cta-banner', null, [
    'heading' => 'Ready to Elevate Your Digital Presence?',
    'sub'     => 'From a first discovery call to full project delivery — let\'s talk about what\'s possible.',
  ] ); ?>

</main>

<?php get_footer(); ?>
