<?php get_header(); ?>

<main>
  <section class="section hero-section">
    <div class="overlay-text">
      <h1 class="headline"><?php the_title(); ?></h1>
      <?php if (has_excerpt()) : ?>
        <p class="subtext text-muted"><?php echo esc_html(get_the_excerpt()); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="section info-section">
    <div class="text-container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; else : ?>
        <p>No content found.</p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
