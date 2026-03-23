<?php get_header(); ?>

<main class="blog-home">
  <div class="container">
    <header class="blog-header">
      <h1>Blog</h1>
      <p>Latest posts and updates</p>
    </header>

    <div class="blog-posts">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="blog-post-preview">
            <?php if (has_post_thumbnail()) : ?>
              <div class="post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium'); ?>
                </a>
              </div>
            <?php endif; ?>

            <div class="post-content">
              <header class="post-header">
                <h2 class="post-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="post-meta">
                  <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                  </time>
                  <span class="author">by <?php the_author(); ?></span>
                  <?php if (has_category()) : ?>
                    <span class="categories">
                      in <?php the_category(', '); ?>
                    </span>
                  <?php endif; ?>
                </div>
              </header>

              <div class="post-excerpt">
                <?php the_excerpt(); ?>
              </div>

              <footer class="post-footer">
                <a href="<?php the_permalink(); ?>" class="read-more-btn">Read Full Post</a>
                <?php if (has_tag()) : ?>
                  <div class="post-tags">
                    <?php the_tags('Tags: ', ', ', ''); ?>
                  </div>
                <?php endif; ?>
              </footer>
            </div>
          </article>
        <?php endwhile; ?>

        <nav class="blog-pagination">
          <?php
          echo paginate_links(array(
            'prev_text' => '&laquo; Previous',
            'next_text' => 'Next &raquo;',
            'mid_size' => 2,
            'type' => 'list'
          ));
          ?>
        </nav>

      <?php else : ?>
        <div class="no-posts">
          <h2>No posts found</h2>
          <p>There are no blog posts to display at this time.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<!-- SEO Optimization applied: 2025-06-26 12:59:53 -->

<!-- SEO Optimization applied: 2025-06-26 16:09:21 -->
