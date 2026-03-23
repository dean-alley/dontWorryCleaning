<?php get_header(); ?>

<main class="search-results">
  <div class="container">
    <header class="search-header">
      <h1>Search Results</h1>
      <?php if (have_posts()) : ?>
        <p>Found <?php echo $wp_query->found_posts; ?> result(s) for: <strong>"<?php echo get_search_query(); ?>"</strong></p>
      <?php else : ?>
        <p>No results found for: <strong>"<?php echo get_search_query(); ?>"</strong></p>
      <?php endif; ?>
    </header>

    <div class="search-content">
      <?php if (have_posts()) : ?>
        <div class="blog-posts">
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
                    <span class="post-type"><?php echo get_post_type(); ?></span>
                  </div>
                </header>
                
                <div class="post-excerpt">
                  <?php the_excerpt(); ?>
                </div>
                
                <footer class="post-footer">
                  <a href="<?php the_permalink(); ?>" class="read-more-btn">Read Full Post</a>
                </footer>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

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
        <div class="no-results">
          <h2>Try a different search</h2>
          <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
          
          <div class="search-suggestions">
            <h3>Search Suggestions:</h3>
            <ul>
              <li>Check your spelling</li>
              <li>Try different keywords</li>
              <li>Try more general keywords</li>
              <li>Try fewer keywords</li>
            </ul>
          </div>
          
          <div class="search-form-container">
            <h3>Search Again:</h3>
            <?php get_search_form(); ?>
          </div>
          
          <div class="recent-posts">
            <h3>Recent Posts:</h3>
            <?php
            $recent_posts = wp_get_recent_posts(array(
              'numberposts' => 5,
              'post_status' => 'publish'
            ));
            
            if ($recent_posts) :
            ?>
              <ul>
                <?php foreach ($recent_posts as $post) : ?>
                  <li>
                    <a href="<?php echo get_permalink($post['ID']); ?>">
                      <?php echo $post['post_title']; ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>

<!-- SEO Optimization applied: 2025-06-26 12:59:53 -->

<!-- SEO Optimization applied: 2025-06-26 16:09:21 -->
