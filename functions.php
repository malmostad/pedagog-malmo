<?php

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

/* Malmo helpers */
require_once('helpers/config.php');
require_once('helpers/Malmo.php');
require_once('helpers/AppLog.php');
require_once('helpers/Cache.php');
require_once('helpers/CacheApc.php');
require_once('helpers/RemoteAsset.php');
require_once('helpers.php');
/* Advanced Custom Fields */
define( 'ACF_LITE', true ); // Comment out to gain access to AFC GUI in admin
require_once('afc/teman.php');
require_once('afc/kategori.php');

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
    $content_width = 1024;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // WYSIWYG SIZES
    add_image_size('large', 750, '', false); // Large Thumbnail
    add_image_size('medium', 236, 150, true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    // THEME SIZES
    add_image_size('article-front', 768, 768, true);

    add_image_size('loop-image-large', 770, 360, true);
    add_image_size('tema-image-large', 1024, 534, true);
    add_image_size('tema-image-front', 768, 510, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('pedagog', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function pedagog_nav() {
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function pedagog_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        global $mconfig;


        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('pedagogplugins', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('pedagogplugins'); // Enqueue it!

        wp_register_script('pedagogscripts', get_template_directory_uri() . '/js/scripts.min.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('pedagogscripts'); // Enqueue it!

        //Malmö stad assets - external JS.
        wp_register_script('malmo-js', $mconfig['asset_host'] . 'malmo.js', false, '1.0.0', true);
        wp_enqueue_script('malmo-js');

    }
}
// Load HTML5 Blank conditional scripts
function pedagog_conditional_scripts() {

    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function pedagog_styles() {
    global $mconfig;

    wp_register_style('pedagog', get_template_directory_uri() . '/css/style.min.css', array(), '1.0', 'all');
    wp_enqueue_style('pedagog'); // Enqueue it!

    //Malmö stad assets - external css
    wp_register_style('malmo-css', $mconfig['asset_host'] . 'malmo.css', array(), '1.0', 'all');
    wp_enqueue_style('malmo-css');
}

// Register HTML5 Blank Navigation
function register_html5_menu() {
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'pedagog'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'pedagog'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'pedagog') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist) {
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'pedagog'),
        'description' => __('Description for this widget-area...', 'pedagog'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'pedagog'),
        'description' => __('Description for this widget-area...', 'pedagog'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination() {
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
function html5wp_index($length) {
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length) {
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '') {
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more) {
    global $post;
    //return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'pedagog') . '</a>';
    return '...';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function pedagoggravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}


/**
 * Custo exceprt outside the loop. Used for tema posts.
 * @param  [type] $text    [description]
 * @param  [type] $excerpt [description]
 * @return [type]          [description]
 */
function pedagog_custom_excerpt($text, $excerpt){
   if ($excerpt) return $excerpt;

   $text = strip_shortcodes( $text );

   $text = apply_filters('the_content', $text);
   $text = str_replace(']]>', ']]&gt;', $text);
   $text = strip_tags($text);
   $excerpt_length = apply_filters('excerpt_length', 30);
   $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
   $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
   if ( count($words) > $excerpt_length ) {
           array_pop($words);
           $text = implode(' ', $words);
           $text = $text . $excerpt_more;
   } else {
           $text = implode(' ', $words);
   }

   return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

/*-------------- TEMP FRÅN GAMLA TEMAT -------------------*/


/* New taxonomy "metadata" */
function create_theme_blog_taxonomies() {
  register_taxonomy('theme_blog', array('post'), array(
    'hierarchical' => true,
    'labels' => array(
      'name' => _x( 'Temabloggar', 'taxonomy general name' ),
      'singular_name' => _x( 'Temablogg', 'taxonomy singular name' ),
      'search_items' =>  __( 'Sök temabloggar' ),
      'all_items' => __( 'Alla fält' ),
      'edit_item' => __( 'Redigera fält' ),
      'update_item' => __( 'Uppdatera fält' ),
      'add_new_item' => __( 'Lägg till nytt fält' ),
      'new_item_name' => __( 'Nytt fält' ),
      'menu_name' => __( 'Temabloggar' ),
    ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'theme_blog' ),
  ));
}
add_action( 'init', 'create_theme_blog_taxonomies', 0 );

// File upload field for theme_blog taxonomy
require_once("Tax-meta-class/Tax-meta-class.php"); // Note: Monkey patched
if (is_admin()){
  $theme_blog_fields = new Tax_Meta_Class(array(
    'id' => 'theme_blog_fields',          // meta box id, unique per meta box
    'title' => 'Temabloggsfält',          // meta box title
    'pages' => array('theme_blog'),        // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'local_images' => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  ));
  $theme_blog_fields->addFile( 'profile_image', array( 'description' => "Beskrivning", 'name'=> 'Profilbild'), false );
}

/* New taxonomy for pages */
function create_artikelkategorier_taxonomies() {
  register_taxonomy(
    'artikelkategorier',
    'artiklar',
    array(
        'hierarchical' => true,
        'label' => 'Kategorier för artiklar',
        'query_var' => true,
        'rewrite' => true
    )
  );
};
add_action( 'init', 'create_artikelkategorier_taxonomies', 0 );

function author_name($author_id = false) {
  $name = get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
  if (strlen($name) < 2) {
    $name = get_the_author_meta('display_name', $author_id);
  }
  return $name;
}

// Get the first theme_blog meta array, if any
function theme_blog_meta($id) {
  $meta = get_the_terms( $id, 'theme_blog' );
  if (gettype($meta) == 'array' && !empty($meta)) {
    return array_slice($meta, 0,1);
  } else {
    return false;
  }
}

/*------END-------- TEMP FRÅN GAMLA TEMAT ----------END------*/

/**
 * Print the current week number
 * @return [type] [description]
 */
function get_current_week() {
  return 'Vecka ' . date(W);
}

/**
 * Change header text depending on page
 * @return [type] [description]
 */
function get_sub_header_text() {
  global $wp_query, $post;
  $theme_blog = theme_blog_meta($post->ID);
  $autorID = get_the_author_meta('ID');
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if(is_search()){
    echo get_bloginfo('description');
  }elseif(is_tax('artikelkategorier')){
    echo '<a class="button__back" href="/artiklar"></a>';
    single_cat_title( '', true );
    echo '<a class="rss-feed" href="'. $actual_link . '/feed"></a>';
  }elseif(is_category()){
    echo '<a class="button__back" href="/bloggar"></a>';
    single_cat_title( '', true );
    echo '<a class="rss-feed" href="'. $actual_link . '/feed"></a>';
  }elseif(is_front_page() && !$wp_query->query['post_type'] == 'post'){
    echo '<a href="/">' .  get_bloginfo('description') . '</a>';
  }elseif (is_author()) {
    echo '<a class="button__back" href="/bloggare"></a>';
    echo author_name($autorID);
    echo '<a class="rss-feed" href="'. $actual_link . '/feed"></a>';
  }elseif ( isset($wp_query->query['theme_blog']) ){
    echo '<a class="button__back" href="/bloggar"></a><a href="' . get_bloginfo('url') . '/theme_blog/' . $theme_blog[0]->slug . '">' . $wp_query->queried_object->name . '</a>';
    echo '<a class="rss-feed" href="'. $actual_link . '/feed"></a>';
  }elseif(!empty($theme_blog[0]->name)){
    echo '<a class="button__back" href="/bloggar"></a><a href="' . get_bloginfo('url') . '/theme_blog/' . $theme_blog[0]->slug . '">' . $theme_blog[0]->name . '</a>';
  }elseif ( is_post_type_archive('artiklar') || get_post_type() == 'artiklar' || is_post_type_archive('tema') || is_tax( 'artikelkategorier' ) ) {
    echo '<a href="/artiklar">Artiklar & Teman</a>';
    echo '<a class="rss-feed" href="/artiklar/feed"></a>';
  }elseif ( $wp_query->query['post_type'] == 'post' || $wp_query->query['pagename'] == 'temabloggar' || $wp_query->query['pagename'] == 'bloggare' || isset($wp_query->query['category_name']) || is_singular('post') ) {
    echo '<a href="/bloggar">Inlägg & Bloggar</a>';
    echo '<a class="rss-feed" href="/feed"></a>';
  }elseif ( $wp_query->query['pagename'] == 'filmer') {
    echo 'Filmer';
  }elseif ($wp_query->query['post_type'] == 'tribe_events') {
    echo 'Kalendarium';
  }else {
    echo get_bloginfo('description');
  }
}

/**
 * Get all the article categories
 * @return [type] [description]
 */
function get_the_categories($category_type) {
  global $wp_query;
  $current_term = $wp_query->queried_object->term_id;

  $args = array( 'hide_empty=0' );
  $terms = get_terms( $category_type, $args );

  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    $count = count( $terms );
    $subjects = [];
    $term_list = '<div id="filter-categories" class="filter-categories"><span>Verksamhet</span></div>';
    $term_list .= '<ul class="archive-categories">';
    foreach ( $terms as $term ) {
      $isSubject = get_field('is_subject', $term)[0];
      if($isSubject == 1){
        $subjects[] = $term;
      }else{
        $term_list .= '<li>';
        if ($current_term == $term->term_id) {
          $term_list .= '<a class="active-category term-item-' . $term->term_id . '" href="' . get_term_link( $term ) . '" title="Se alla poster under ' . $term->name  . '">' . $term->name . '</a>';
        }else {
          $term_list .= '<a class="term-item-' . $term->term_id . '" href="' . get_term_link( $term ) . '" title="Se alla poster under ' . $term->name  . '">' . $term->name . '</a>';
        }
      }
      $term_list .= '</li>';
    }
    $term_list .= '</ul>';
    $term_list .= '<div id="filter-categories" class="filter-categories"><span>Ämnen</span></div>';
    $term_list .= '<ul class="archive-categories">';
    foreach ( $subjects as $term ) {
      $term_list .= '<li>';
      if ($current_term == $term->term_id) {
        $term_list .= '<a class="active-category term-item-' . $term->term_id . '" href="' . get_term_link( $term ) . '" title="Se alla poster under ' . $term->name  . '">' . $term->name . '</a>';
      }else {
        $term_list .= '<a class="term-item-' . $term->term_id . '" href="' . get_term_link( $term ) . '" title="Se alla poster under ' . $term->name  . '">' . $term->name . '</a>';
      }
      $term_list .= '</li>';
    }
    $term_list .= '</ul>';
    return $term_list;
  }
}

/**
 * Add view-count meta field to single posts.
 * @param  [type] $postID [description]
 * @return [type]         [description]
 */
function pedagog_set_post_views($postID) {
    $count_key = 'pedagog_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'pedagog_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'pedagog_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'pedagog_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'create_post_type_pedagog_article'); // Add our HTML5 Blank Custom Post Type
add_action('init', 'create_post_type_pedagog_tema'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'pedagoggravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
//add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_type_pedagog_article() {
    register_taxonomy_for_object_type('category', 'artikel'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'artikel');
    register_post_type('artiklar', // Register Custom Post Type
        array(
        'yarpp_support' => true,
        'labels' => array(
            'name' => __('Artiklar', 'pedagog'), // Rename these to suit
            'singular_name' => __('Artikel', 'pedagog'),
            'add_new' => __('Skapa ny', 'pedagog'),
            'add_new_item' => __('Skapa ny artikel', 'pedagog'),
            'edit' => __('Redigera', 'pedagog'),
            'edit_item' => __('Redigera artikel', 'pedagog'),
            'new_item' => __('Ny artikel', 'pedagog'),
            'view' => __('Visa artikel', 'pedagog'),
            'view_item' => __('Visa artikel', 'pedagog'),
            'search_items' => __('Sök artikel', 'pedagog'),
            'not_found' => __('Inga artiklar hittade', 'pedagog'),
            'not_found_in_trash' => __('Inga artiklar hittade i papperskorgen', 'pedagog')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'capability_type'    => 'page',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'comments',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
function create_post_type_pedagog_tema() {
    register_taxonomy_for_object_type('category', 'tema'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'tema');
    register_post_type('tema', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Teman', 'pedagog'), // Rename these to suit
            'singular_name' => __('Tema', 'pedagog'),
            'add_new' => __('Skapa ny', 'pedagog'),
            'add_new_item' => __('Skapa nytt tema', 'pedagog'),
            'edit' => __('Redigera', 'pedagog'),
            'edit_item' => __('Redigera tema', 'pedagog'),
            'new_item' => __('Nytt tema', 'pedagog'),
            'view' => __('Visa tema', 'pedagog'),
            'view_item' => __('Visa tema', 'pedagog'),
            'search_items' => __('Sök teman', 'pedagog'),
            'not_found' => __('Inga teman hittade', 'pedagog'),
            'not_found_in_trash' => __('Inga teman hittade i papperskorgen', 'pedagog')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'capability_type'    => 'page',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

add_filter( 'the_content', 'remove_empty_p', 20, 1 );
function remove_empty_p( $content ){
  // clean up p tags around block elements
  $content = preg_replace( array(
    '#<p>\s*<(div|aside|section|article|header|footer)#',
    '#</(div|aside|section|article|header|footer)>\s*</p>#',
    '#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
    '#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
    '#<p>\s*</(div|aside|section|article|header|footer)#',
  ), array(
    '<$1',
    '</$1>',
    '</$1>',
    '<$1$2>',
    '</$1',
  ), $content );

  return preg_replace('#<p>(\s|&nbsp;)*+(<br\s*/*>)*(\s|&nbsp;)*</p>#i', '', $content);
}

require_once('custom/comments.php');
require_once('custom/comment_form.php');
require_once('custom/tinymce.php');
require_once('custom/yarpp.php');
?>
