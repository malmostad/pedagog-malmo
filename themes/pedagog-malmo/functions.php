<?php
/**
 * Functions and definitions for the Pedagog Malmo theme
 *
 * @package WordPress
 * @subpackage Malmo_Theme
 *
 */

/* Malmo helpers */
require_once('helpers/config.php');
require_once('helpers/Malmo.php');
require_once('helpers/AppLog.php');
require_once('helpers/Cache.php');
require_once('helpers/CacheApc.php');
require_once('helpers/RemoteAsset.php');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 511;

/** Tell WordPress to run malmo_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'malmo_setup' );

if ( ! function_exists( 'malmo_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override malmo_setup() in a child theme, add your own malmo_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 */
function malmo_setup() {

  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'malmo', TEMPLATEPATH . '/languages' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Navigation', 'malmo' ),
  ) );
}
endif;

add_image_size( 'article_full', 511, 9999 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 */
function malmo_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'malmo_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 */
function malmo_excerpt_length( $length ) {
  return 55;
}
add_filter( 'excerpt_length', 'malmo_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function malmo_continue_reading_link() {
  return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'malmo' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and malmo_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @return string An ellipsis
 */
function malmo_auto_excerpt_more( $more ) {
  return ' &hellip;' . malmo_continue_reading_link();
}
add_filter( 'excerpt_more', 'malmo_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function malmo_custom_excerpt_more( $output ) {
  if ( has_excerpt() && ! is_attachment() ) {
    $output .= malmo_continue_reading_link();
  }
  return $output;
}
add_filter( 'get_the_excerpt', 'malmo_custom_excerpt_more' );

if ( ! function_exists( 'malmo_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own malmo_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function malmo_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case '' :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
        <?php echo comments_author_link($comment, get_avatar( $comment, 40 )); ?>
        <?php printf( __( '%s <span class="says">says:</span>', 'malmo' ), sprintf( '<cite class="fn">%s</cite>', comments_author_link($comment, $comment->comment_author)) ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em><?php _e( 'Your comment is awaiting moderation.', 'malmo' ); ?></em>
      <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
        /* translators: 1: date, 2: time */
        printf( __( '%1$s at %2$s', 'malmo' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'malmo' ), ' ' );
      ?>
    </div><!-- .comment-meta .commentmetadata -->

    <div class="comment-body"><?php comment_text(); ?></div>

    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div><!-- .reply -->
  </div><!-- #comment-##  -->

  <?php
      break;
    case 'pingback'  :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'malmo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'malmo'), ' ' ); ?></p>
  <?php
      break;
  endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override malmo_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function malmo_widgets_init() {
  register_sidebar( array(
    'name' => 'Sidokolumn',
    'id' => 'primary-widget-area',
    'description' => __( 'You can add widgets to this area', 'malmo' ),
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  register_sidebar( array(
    'name' => 'Sidfot',
    'id' => 'footer-widget-area',
    'description' => "Om tjänsten",
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );
  register_sidebar( array(
    'name' => 'Starsidan topp kolumn 1',
    'id' => 'home-top-1-widget-area',
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
  register_sidebar( array(
    'name' => 'Starsidan topp kolumn 2',
    'id' => 'home-top-2-widget-area',
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ));
  register_sidebar( array(
    'name' => 'Starsidan bloggar kolumn 1',
    'id' => 'home-blogs-1-widget-area',
    'description' => __( 'You can add more widgets to this area', 'malmo' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar( array(
    'name' => 'Starsidan bloggar kolumn 2',
    'id' => 'home-blogs-2-widget-area',
    'description' => __( 'You can add more widgets to this area', 'malmo' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar( array(
    'name' => 'Starsidan kalendar', 'malmo',
    'id' => 'home-calendar-widget-area',
    'description' => __( 'You can add more widgets to this area', 'malmo' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
  register_sidebar( array(
    'name' => 'Senaste blogginläggen',
    'id' => 'latest-post-page',
    'description' => __( 'You can add more widgets to this area', 'malmo' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'malmo_widgets_init' );

/**
 * Prints HTML with meta information for the author
 */
function posted_by() {
  printf( '<a class="url fn n" href="%1$s">%2$s</a>',
    get_author_posts_url( get_the_author_meta( 'ID' ) ),
    author_name()
  );
}

function loop_posted_on($show_time = false) {
  printf('%3$s %1$s %2$s',
    get_the_date(),
    $show_time ? get_the_time() : '',
    sprintf( '<a href="%1$s">%2$s</a>',
      get_author_posts_url( get_the_author_meta( 'ID' ) ),
      author_name()
    )
  );
}

function loop_page_posted_on() {
  printf('Publicerad %1$s av %2$s',
    get_the_date(),
    author_name()
  );
}

/**
 * Print comment's author link around $content
 *
 * @param array $comment The comment object
 * @param string $content The content text/code to wrap in the link tag
 */
function comments_author_link($comment, $content) {
  $url = false;
  // user is logged in
  if ($comment->user_id) {
    $url = get_author_posts_url($comment->user_id);
  }
  // user is not logged in but has a home page
  elseif ($comment->comment_author_url) {
    $url = $comment->comment_author_url;
  }

  if ($url) {
    printf('<a href="%1$s">%2$s</a>',
      $url,
      $content
    );
  }
  else {
    echo $content;
  }
}

function truncate_excerpt($text, $limit, $more_link = null) {
  if (strlen($text) > $limit) {
    $clean = strip_tags($text);
    $short = explode('_split_', wordwrap($clean, $limit, "_split_", true));
    $text = $short[0];
    if (count($short) > 1) {
      $text .= '&hellip;';
    }
  }
  if ($more_link) {
    $text .= sprintf('… <a href="%1$s">%2$s</a>',
      $more_link,
       __('Continue reading <span class=\"meta-nav\">&rarr;</span>', 'malmo')
    );
  }
  return $text;
}

/* Set SAVEQUERIES in wp-config to log sql queries */
function log_db_queries() {
  if ( SAVEQUERIES ) {
    global $wpdb;
    error_log(var_export($wpdb->queries, true));
    $sum = 0;
    foreach ($wpdb->queries as $query) { $sum +=  $query[1]; }
    error_log("TOTAL SQL TIME: " . $sum);
  }
}

// Prints HTML with categories
function posted_categories() {
  $cat_list = get_the_category_list( ', ');
  printf( __( '%1$s ', 'malmo'), $cat_list);
}

// Prints HTML with tags
function posted_tags() {
  $tag_list = get_the_tag_list( '', ', ' );
  printf( __( '%1$s', 'malmo'), $tag_list);
}

/**
 *
 * Return data wrapped in markup for posts by the same author or in the same categories as the displayed post
 *
 * @param    array    $catObjects      Array with category objects that a post belongs to
 * @param    int      $authorID        ID for the author of the post
 * @param    int      $postID          ID for current post, used to not display it again
 * @param    int      $max             Max posts by author/in categories
 * @param    boolean  $return_duplicates  Returns the same post in both related blocks
 * @return   array    Hash with two keys, by_author and in_categories with markup and data
 */
function get_related_posts($catObjects, $authorID, $postID, $max = 5, $return_duplicates = false) {
  
  $exclude = array($postID);
  $authorPosts = query_posts(array(
	  'author'         => $authorID,
    'posts_per_page' => $max,
    'post__not_in'   => $exclude
  ));

  if (!$return_duplicates) {
    // Don't featch the same posts again
    foreach ($authorPosts as $post) {
      $exclude[] = $post->ID;
    }
  }

  $cats = array();
  foreach ($catObjects as $cat) {
    $cats[] = $cat->cat_ID;
  }
  $catPosts = query_posts(array(
  	'category__in'   => $cats,
    'posts_per_page' => $max,
    'post__not_in'   => $exclude
  ));

  return array(
  	'by_author'     => $authorPosts,
  	'in_categories' => $catPosts
  );

}


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 */
function malmo_remove_recent_comments_style() {
  global $wp_widget_factory;
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'malmo_remove_recent_comments_style' );

/* Add gravatar image to rss feed */
add_action("do_feed_rss2","wp_rss_img_do_feed",5,1);

function wp_rss_img_do_feed(){
  add_action('rss2_item', 'wp_rss_img_include');
  add_action('commentrss2_item', 'wp_rss_img_include');
}
function wp_rss_img_include($comment) {
  $email = $comment ? get_comment_author_email() : get_the_author_meta('user_email');
	$email = md5( strtolower( trim($email) ) );
	if ( is_ssl() ) {
		$avatar_url = 'https://secure.gravatar.com';
	} else {
		$avatar_url = 'http://1.gravatar.com';
	}
	$avatar_url .= '/avatar/' . $email . '?d=mm&amp;s=100.jpg';
	echo '<enclosure url="' . $avatar_url . '" type="image/jpeg"/>';
}

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
function create_page_categories_taxonomies() {
  register_taxonomy(
    'page_categories',
    'page',
    array(
    	'hierarchical' => true,
    	'label' => 'Kategorier för sidor',
    	'query_var' => true,
    	'rewrite' => true
    )
  );
};
add_action( 'init', 'create_page_categories_taxonomies', 0 );

// Get the first theme_blog meta array, if any
function theme_blog_meta($id) {
  $meta = get_the_terms( $id, 'theme_blog' );
  if (gettype($meta) == 'array' && !empty($meta)) {
    return array_slice($meta, 0,1); 
  } else {
    return false;
  }
}

// Include a file from the partials directory
function partial($name, $vars = null) {
  $name = preg_replace(array('/\.\./', '/^\//', '/~/', '/\.php/'), '', $name);
  if (isset($vars)) {
    extract($vars);
  }
  include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . $name . '.php';
}

function author_name($author_id = false) {
  $name = get_the_author_meta('first_name', $author_id) . ' ' . get_the_author_meta('last_name', $author_id);
  if (strlen($name) < 2) {
    $name = get_the_author_meta('display_name', $author_id);
  }
  return $name;
}

