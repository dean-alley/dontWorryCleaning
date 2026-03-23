<?php
// Theme setup
function dwc_theme_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('menus');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  add_theme_support('custom-logo');
  add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'dwc_theme_setup');

function dwc_register_menus()
{
  register_nav_menus([
    'primary' => __('Primary Menu', 'dontworrycleaning'),
    'footer' => __('Footer Menu', 'dontworrycleaning'),
  ]);
}
add_action('init', 'dwc_register_menus');

function dwc_enqueue_assets()
{
  $css_path = get_template_directory() . '/assets/css/main.css';
  $css_url = get_template_directory_uri() . '/assets/css/main.css';
  if (file_exists($css_path)) {
    $version = filemtime($css_path);
    wp_enqueue_style('dwc-main', $css_url, [], $version);
  } else {
    wp_enqueue_style('dwc-main', $css_url, [], time());
  }
  $js_path = get_template_directory() . '/assets/js/main.js';
  if (file_exists($js_path)) {
    wp_enqueue_script('dwc-scripts', get_template_directory_uri() . '/assets/js/main.js', [], '1.0', true);
  }
}
add_action('wp_enqueue_scripts', 'dwc_enqueue_assets');

function dwc_excerpt_length($length) { return 30; }
add_filter('excerpt_length', 'dwc_excerpt_length');

function dwc_excerpt_more($more)
{
  return '... <a href="' . get_permalink() . '" class="read-more">Read More</a>';
}
add_filter('excerpt_more', 'dwc_excerpt_more');

// Phone helpers
function dwc_get_phone()
{
  if (defined('DWC_PHONE')) return DWC_PHONE;
  $opt = get_option('dwc_phone');
  if (!empty($opt)) return $opt;
  return '+16125550123';
}

function dwc_normalize_phone($phone)
{
  return preg_replace('/[^0-9\+]/', '', $phone);
}

function dwc_tel_uri()
{
  $n = dwc_normalize_phone(dwc_get_phone());
  return 'tel:' . $n;
}

function dwc_sms_uri($body = '')
{
  $n = dwc_normalize_phone(dwc_get_phone());
  $q = $body ? '?body=' . rawurlencode($body) : '';
  return 'sms:' . $n . $q;
}

function dwc_get_phone_display()
{
  $p = dwc_normalize_phone(dwc_get_phone());
  if (preg_match('/^\+1(\d{10})$/', $p, $m)) {
    $d = $m[1];
    return sprintf('(%s) %s-%s', substr($d, 0, 3), substr($d, 3, 3), substr($d, 6));
  }
  return $p;
}

// Settings page
add_action('admin_menu', function () {
  add_options_page("Don't Worry Cleaning Settings", "DWC Settings", 'manage_options', 'dwc-settings', 'dwc_settings_page');
});

add_action('admin_init', function () {
  register_setting('dwc_settings_group', 'dwc_phone');
});

function dwc_settings_page()
{
  if (!current_user_can('manage_options')) return;
  ?>
  <div class="wrap">
    <h1>Don't Worry Cleaning Settings</h1>
    <form method="post" action="options.php">
      <?php settings_fields('dwc_settings_group'); do_settings_sections('dwc_settings_group'); ?>
      <table class="form-table" role="presentation">
        <tr>
          <th scope="row"><label for="dwc_phone">Business Phone (E.164)</label></th>
          <td>
            <input name="dwc_phone" id="dwc_phone" type="text"
              value="<?php echo esc_attr(get_option('dwc_phone', dwc_get_phone())); ?>" class="regular-text" />
            <p class="description">Used for call and SMS CTAs across the site.</p>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

// Ensure core pages exist
function dwc_ensure_core_pages()
{
  $pages = array(
    'services' => 'Our Services',
    'about' => 'About Us',
    'contact' => 'Contact',
  );
  foreach ($pages as $slug => $title) {
    if (!get_page_by_path($slug, OBJECT, 'page')) {
      wp_insert_post(array(
        'post_title' => $title,
        'post_name' => $slug,
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_content' => ''
      ));
    }
  }
}

function dwc_ensure_core_pages_on_init()
{
  if (!get_option('dwc_core_pages_created')) {
    dwc_ensure_core_pages();
    update_option('dwc_core_pages_created', 1);
  }
}
add_action('init', 'dwc_ensure_core_pages_on_init');
add_action('after_switch_theme', 'dwc_ensure_core_pages');

// SEO
function dwc_add_seo_meta()
{
  global $post;
  $site_name = "Don't Worry Cleaning";
  $page_title = $site_name;
  $meta_description = '';
  $canonical_url = '';
  $og_type = 'website';

  if (is_front_page()) {
    $page_title = "Don't Worry Cleaning | Twin Cities House Cleaning | Minneapolis & St. Paul, MN";
    $meta_description = "Professional house cleaning in Minneapolis, St. Paul & the Twin Cities metro. Residential cleaning, deep cleaning, move-in/move-out. $50/hr. Book today!";
    $canonical_url = home_url();
  } elseif (is_page('services')) {
    $page_title = "House Cleaning Services | " . $site_name;
    $meta_description = "Twin Cities residential cleaning: regular cleaning, deep cleaning, move-in/move-out, post-event cleanup. Serving Minneapolis, St. Paul & surrounding suburbs.";
    $canonical_url = get_permalink();
    $og_type = 'article';
  } elseif (is_page('about')) {
    $page_title = "About Christi & DWC | " . $site_name;
    $meta_description = "Meet Christi at Don't Worry Cleaning. Professional, reliable house cleaning for busy Twin Cities families. Named with love, cleaned with care.";
    $canonical_url = get_permalink();
    $og_type = 'article';
  } elseif (is_single() || is_page()) {
    $page_title = get_the_title() . ' | ' . $site_name;
    $meta_description = get_the_excerpt() ? wp_strip_all_tags(get_the_excerpt()) : wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $post)), 25);
    $canonical_url = get_permalink();
    $og_type = 'article';
  }

  if ($meta_description) echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
  if ($canonical_url) echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
  echo '<meta property="og:title" content="' . esc_attr($page_title) . '">' . "\n";
  echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
  echo '<meta property="og:url" content="' . esc_url($canonical_url) . '">' . "\n";
  echo '<meta property="og:type" content="' . esc_attr($og_type) . '">' . "\n";
  echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
  echo '<meta name="twitter:card" content="summary_large_image">' . "\n";

  if (is_front_page()) dwc_add_local_business_schema();
}
add_action('wp_head', 'dwc_add_seo_meta');

function dwc_add_local_business_schema()
{
  $schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => "Don't Worry Cleaning",
    'description' => "Professional house cleaning services in Minneapolis, St. Paul & the Twin Cities metro area. $50/hr.",
    'url' => home_url(),
    'areaServed' => array(
      array('@type' => 'City', 'name' => 'Minneapolis', 'containedInPlace' => array('@type' => 'State', 'name' => 'Minnesota')),
      array('@type' => 'City', 'name' => 'St. Paul', 'containedInPlace' => array('@type' => 'State', 'name' => 'Minnesota')),
      array('@type' => 'Place', 'name' => 'Twin Cities Metro Area')
    ),
    'serviceType' => array('House Cleaning', 'Residential Cleaning', 'Deep Cleaning', 'Move-In/Move-Out Cleaning', 'Recurring Cleaning'),
    'priceRange' => '$$'
  );
  echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

// Technical SEO
function dwc_technical_seo()
{
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'dwc_technical_seo');

function dwc_add_preload_links()
{
  echo '<link rel="preload" href="' . get_template_directory_uri() . '/assets/css/main.css" as="style">' . "\n";
  echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
}
add_action('wp_head', 'dwc_add_preload_links', 1);
