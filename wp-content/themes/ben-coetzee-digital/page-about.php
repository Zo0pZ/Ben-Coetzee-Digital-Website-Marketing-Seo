<?php
/**
 * Template Name: About Page
 */
get_header(); ?>

<main>

  <!-- Page Hero -->
  <section class="page-hero">
    <div class="page-hero__bg">
      <div class="hero__grid"></div>
    </div>
    <div class="container page-hero__content">
      <span class="section-label section-label--light">About Ben Coetzee</span>
      <h1 class="page-hero__title">
        Driving Digital Transformation<br />
        <span class="highlight">Across the UK and the South West.</span>
      </h1>
    </div>
  </section>

  <!-- About Main -->
  <section class="about section" id="about">
    <div class="container about__grid">
      <div class="about__portrait" aria-hidden="true">
        <div class="portrait-placeholder">
          <div class="portrait-initials">BC</div>
          <div class="portrait-label">Ben Coetzee</div>
          <div class="portrait-sub">Digital Website Manager</div>
        </div>
        <div class="about__credentials">
          <div class="credential">
            <span class="credential__number">15+</span>
            <span class="credential__label">Years in Digital Transformation</span>
          </div>
          <div class="credential">
            <span class="credential__icon">&#10003;</span>
            <span class="credential__label">WordPress &amp; Umbraco Expert</span>
          </div>
          <div class="credential">
            <span class="credential__icon">&#10003;</span>
            <span class="credential__label">Google Analytics Proficient</span>
          </div>
          <div class="credential">
            <span class="credential__icon">&#10003;</span>
            <span class="credential__label">Senior Stakeholder Experience</span>
          </div>
          <div class="credential">
            <span class="credential__icon">&#10003;</span>
            <span class="credential__label">WCAG Accessibility Standards</span>
          </div>
        </div>
      </div>

      <div class="about__body">
        <h2 class="about__heading">An Experienced Digital Leader.</h2>
        <?php the_content(); ?>
        <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn--primary">Start a Conversation</a>
      </div>
    </div>
  </section>

  <!-- Expertise Grid -->
  <section class="expertise section section--light" id="expertise">
    <div class="container">
      <div class="section-header">
        <span class="section-label">Areas of Expertise</span>
        <h2 class="section-title">Capabilities Built Over 15+ Years.</h2>
      </div>
      <div class="expertise__grid">
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18M9 21V9"/></svg>
            <h3>CMS Development</h3>
          </div>
          <p>Deep expertise in WordPress and Umbraco, including custom theme development, plugin architecture, and enterprise-grade configurations.</p>
        </div>
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 3v18h18"/><path d="M7 16l4-4 4 4 4-8"/></svg>
            <h3>SEO &amp; Analytics</h3>
          </div>
          <p>Proficient in Google Analytics, Search Console, and advanced SEO tooling. Proven track record of improving organic visibility and measurable performance.</p>
        </div>
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
            <h3>UX Strategy</h3>
          </div>
          <p>Creating and implementing UX strategies that optimise user journeys from landing to conversion, with a commitment to inclusive, accessible design.</p>
        </div>
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
            <h3>Technical Migrations</h3>
          </div>
          <p>Expert leadership of complex platform migrations, managing risk, timelines, and cross-functional teams to ensure seamless, zero-downtime transitions.</p>
        </div>
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg>
            <h3>CRO &amp; A/B Testing</h3>
          </div>
          <p>Building and executing Conversion Rate Optimisation programmes, including structured A/B testing frameworks to continuously improve engagement and revenue.</p>
        </div>
        <div class="expertise-item">
          <div class="expertise-item__header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <h3>Accessibility Compliance</h3>
          </div>
          <p>Ensuring websites meet WCAG standards, critical for legal compliance in regulated sectors and for building trust and inclusivity with all users.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Who I Work With -->
  <section class="clients section section--dark" id="clients">
    <div class="container">
      <div class="section-header">
        <span class="section-label section-label--light">Who I Work With</span>
        <h2 class="section-title section-title--light">From Local Businesses to National Enterprises.</h2>
      </div>
      <div class="clients__grid">
        <div class="client-type">
          <div class="client-type__icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          </div>
          <h3>Local &amp; Regional Businesses</h3>
          <p>Growing businesses in Weston-super-Mare, Bristol, and Somerset who are ready to take a major digital step and want it done to the highest standard from day one.</p>
        </div>
        <div class="client-type">
          <div class="client-type__icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
          </div>
          <h3>National Legal Practices</h3>
          <p>Regulated legal firms requiring complex, secure, and fully compliant digital platforms — managed with the precision, confidentiality, and rigour the sector demands.</p>
        </div>
        <div class="client-type">
          <div class="client-type__icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
          </div>
          <h3>Corporate Enterprises</h3>
          <p>Large organisations seeking a seasoned digital manager who can navigate complex stakeholder environments and deliver multi-regional web transformations on time and on budget.</p>
        </div>
      </div>
    </div>
  </section>

  <?php get_template_part( 'template-parts/cta-banner', null, [
    'heading' => 'Let\'s Build Something Exceptional Together.',
    'sub'     => 'Every project starts with a conversation. Get in touch to discuss your requirements.',
  ] ); ?>

</main>

<?php get_footer(); ?>
