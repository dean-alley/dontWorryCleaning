<?php get_header(); ?>

<main class="single-post">
  <div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <article class="blog-post">
        <header class="post-header">
  <meta name="description" content="Professional digital marketing services for Minnesota businesses. Contact NorthCurrent Digital for SEO, PPC, and local marketing solutions.">
  <title>NorthCurrent Digital | Minnesota Digital Marketing</title>
          <?php if (has_post_thumbnail()) : ?>
            <div class="post-featured-image">
              <?php the_post_thumbnail('large'); ?>
            </div>
          <?php endif; ?>

          <h1 class="post-title"><?php the_title(); ?></h1>

          <div class="post-meta">
            <time datetime="<?php echo get_the_date('c'); ?>" class="post-date">
              <?php echo get_the_date(); ?>
            </time>
            <span class="post-author">by <?php the_author(); ?></span>

            <?php if (has_category()) : ?>
              <div class="post-categories">
                Categories: <?php the_category(', '); ?>
              </div>
            <?php endif; ?>

            <?php if (has_tag()) : ?>
              <div class="post-tags">
                <?php the_tags('Tags: ', ', ', ''); ?>
              </div>
            <?php endif; ?>
          </div>
        </header>

        <div class="post-content">
          <?php the_content(); ?>
        </div>

        <footer class="post-footer">
          <?php
          // Post navigation
          $prev_post = get_previous_post();
          $next_post = get_next_post();

          if ($prev_post || $next_post) :
          ?>
            <nav class="post-navigation">
              <h3>More Posts</h3>
              <div class="nav-links">
                <?php if ($prev_post) : ?>
                  <div class="nav-previous">
                    <a href="<?php echo get_permalink($prev_post); ?>">
                      <span class="nav-subtitle">&laquo; Previous Post</span>
                      <span class="nav-title"><?php echo get_the_title($prev_post); ?></span>
                    </a>
                  </div>
                <?php endif; ?>

                <?php if ($next_post) : ?>
                  <div class="nav-next">
                    <a href="<?php echo get_permalink($next_post); ?>">
                      <span class="nav-subtitle">Next Post &raquo;</span>
                      <span class="nav-title"><?php echo get_the_title($next_post); ?></span>
                    </a>
                  </div>
                <?php endif; ?>
              </div>
            </nav>
          <?php endif; ?>

          <div class="back-to-blog">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="back-link">
              &laquo; Back to Blog
            </a>
          </div>
        </footer>
      </article>

      <?php
      // Comments section
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;
      ?>

    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>

<!-- SEO Optimization applied: 2025-06-26 12:59:53 -->
