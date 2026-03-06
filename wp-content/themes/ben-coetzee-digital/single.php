<?php
/**
 * Single Post Template
 */
get_header(); ?>

<main>

  <?php while ( have_posts() ) : the_post(); ?>

    <section class="page-hero">
      <div class="page-hero__bg"><div class="hero__grid"></div></div>
      <div class="container page-hero__content">
        <span class="section-label section-label--light"><?php the_category( ', ' ); ?></span>
        <h1 class="page-hero__title"><?php the_title(); ?></h1>
        <p class="page-hero__sub" style="font-size:var(--text-sm);color:var(--clr-text-muted);">
          <?php echo esc_html( get_the_date() ); ?>
          <?php if ( get_the_author() ) : ?> &mdash; <?php the_author(); ?><?php endif; ?>
        </p>
      </div>
    </section>

    <section class="section">
      <div class="container" style="max-width:780px;">
        <div class="page-content">
          <?php the_content(); ?>
        </div>
        <div style="margin-top:3rem;">
          <?php the_post_navigation( [
            'prev_text' => '&larr; %title',
            'next_text' => '%title &rarr;',
          ] ); ?>
        </div>
      </div>
    </section>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>
