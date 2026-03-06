<?php
/**
 * Fallback index — used for blog/post archives if no other template matches.
 */
get_header(); ?>

<main>

  <section class="page-hero">
    <div class="page-hero__bg"><div class="hero__grid"></div></div>
    <div class="container page-hero__content">
      <span class="section-label section-label--light">Latest</span>
      <h1 class="page-hero__title"><?php
        if ( is_archive() ) {
          the_archive_title();
        } elseif ( is_search() ) {
          printf( 'Search Results for: %s', '<span class="highlight">' . get_search_query() . '</span>' );
        } else {
          echo 'Blog';
        }
      ?></h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php if ( have_posts() ) : ?>
        <div class="services__grid">
          <?php while ( have_posts() ) : the_post(); ?>
            <article class="service-card" id="post-<?php the_ID(); ?>">
              <h3 class="service-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="service-card__body"><?php the_excerpt(); ?></p>
              <a href="<?php the_permalink(); ?>" class="service-card__link">Read More &rarr;</a>
            </article>
          <?php endwhile; ?>
        </div>
        <div style="margin-top:3rem;">
          <?php the_posts_pagination(); ?>
        </div>
      <?php else : ?>
        <p>Nothing found.</p>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
