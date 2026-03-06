<?php
/**
 * Generic Page Template
 */
get_header(); ?>

<main>

  <section class="page-hero">
    <div class="page-hero__bg">
      <div class="hero__grid"></div>
    </div>
    <div class="container page-hero__content">
      <h1 class="page-hero__title"><?php the_title(); ?></h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="page-content">
          <?php the_content(); ?>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
