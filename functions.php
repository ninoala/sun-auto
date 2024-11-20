<?php
/**
 * sun-auto-mitsuke functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sun-auto-mitsuke
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sun_auto_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on sun-auto-mitsuke, use a find and replace
		* to change 'sun-auto' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'sun-auto', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'sun-auto' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'sun-auto' )
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'sun_auto_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sun_auto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sun_auto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sun_auto_content_width', 640 );
}
add_action( 'after_setup_theme', 'sun_auto_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sun_auto_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sun-auto' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sun-auto' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sun_auto_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sun_auto_scripts() {
	wp_enqueue_style( 'sun-auto-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'sun-auto-style', 'rtl', 'replace' );
	wp_enqueue_script('font-awesome', '//kit.fontawesome.com/9fa7db7f27.js');
	wp_enqueue_script( 'sun-auto-news-card-adjuster', get_template_directory_uri() . '/js/news-card-adjuster.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sun-auto-observer', get_template_directory_uri() . '/js/observer.js', array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sun_auto_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function sunauto_features() {
  register_nav_menu('header_menu_location', 'Header Menu Location');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('service-thumb', 600, 600, true);
}
add_action('after_setup_theme', 'sunauto_features');


function sunauto_add_scripts() {
	wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAwgvWN8YEpK6pvPFMi3Zhy5WOiuC6_q8s', array(), '3', true );
	wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/js/google-map.js', array('google-map', 'jquery'), '0.1', true );
}
add_action( 'wp_enqueue_scripts', 'sunauto_add_scripts' );

function fetch_service_post() {
  // Verify nonce
  if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'fetch_service_nonce')) {
    wp_send_json_error('Invalid nonce');
    return;
  }

  $post_id = intval($_POST['post_id']);
  $post = get_post($post_id);

  if ($post) {
    // Get the post thumbnail URL
    $thumbnail_url = get_the_post_thumbnail_url($post, 'service-thumb');

    // Get the ACF fields 'popup_text' and 'button_text'
    $popup_text = get_field('popup_text', $post_id); // Use get_field() for ACF
		$button_text = get_field('button_text', $post_id);
		$button_link =  get_field('button_link', $post_id);
		$additional_image_url = get_field('additional_image', $post_id);

    // Prepare the response array
    $response = array(
      'title' => get_the_title($post),
      'popup_text' => apply_filters('the_content', $popup_text),
			'button_text' => $button_text,
      'featured_image_url' => $thumbnail_url,
      'link' => get_permalink($post),
			'button_link' => $button_link,
			'additional_image_url' => $additional_image_url,
    );

    wp_send_json_success($response);
  } else {
    wp_send_json_error('Post not found');
  }
}
add_action('wp_ajax_fetch_service_post', 'fetch_service_post');
add_action('wp_ajax_nopriv_fetch_service_post', 'fetch_service_post');

function popup_script() {
	wp_enqueue_script('popup-handler', get_template_directory_uri() . '/js/popup-handler.js', array('jquery'), null, true);

	// Localize the script with new data
	$script_data_array = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('fetch_service_nonce'), // Add nonce
	);
	wp_localize_script('popup-handler', 'custom_data', $script_data_array);
}
add_action('wp_enqueue_scripts', 'popup_script');
 
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyAwgvWN8YEpK6pvPFMi3Zhy5WOiuC6_q8s';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function add_smooth_scroll() {
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            for (let link of links) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetID = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetID);
                    if (targetSection) {
                        window.scrollTo({
                            top: targetSection.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'add_smooth_scroll');

function fetch_service_post_hiring() {
    check_ajax_referer('custom_nonce', 'nonce');

    $post_id = intval($_POST['post_id']);
    $post = get_post($post_id);

    if ($post) {
        $data = [
            'title' => $post->post_title,
            'content' => apply_filters('the_content', $post->post_content),
            'featured_image_url' => get_the_post_thumbnail_url($post_id, 'full'),
            'link' => get_permalink($post_id),
        ];
        wp_send_json_success($data);
    } else {
        wp_send_json_error('Post not found');
    }
}
add_action('wp_ajax_fetch_service_post', 'fetch_service_post_hiring');
add_action('wp_ajax_nopriv_fetch_service_post', 'fetch_service_post_hiring');

function enqueue_font_awesome_kit() {
    echo '<script src="https://kit.fontawesome.com/9fa7db7f27.js" crossorigin="anonymous"></script>';
}
add_action('wp_head', 'enqueue_font_awesome_kit');

function theme_enqueue_styles() {
    wp_enqueue_style(
        'theme-style', 
        get_stylesheet_uri(), 
        array(), 
        filemtime(get_template_directory() . '/style.css') // Cache-busting timestamp
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');