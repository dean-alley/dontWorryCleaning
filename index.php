<?php get_header(); ?>

<main>
  <h2><?php the_title(); ?></h2>
  <div class="content">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
        the_content();
      endwhile;
    else :
      echo '<p>No content found.</p>';
    endif;
    ?>
  </div>
</main>

<?php get_footer(); ?>

<!-- <abbr title="Search Engine Optimization - improving your website's visibility in search results">SEO</abbr> Optimization applied: 2025-06-26 12:59:53 -->
