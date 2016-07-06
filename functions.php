<?php
/**
 * lakesmtb functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lakesmtb
 */

if ( ! function_exists( 'lakesmtb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lakesmtb_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lakesmtb, use a find and replace
	 * to change 'lakesmtb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lakesmtb', get_template_directory() . '/languages' );

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
	add_image_size( 'banner', 728, 90, true ); // Banner Image
	add_image_size( 'slider', 1600, 581, true ); // Slider Image
	add_image_size( 'shot-week', 382, 255, true ); // Shot of the Week
	add_image_size( 'article', 633, 281, true ); // Article Preview
	add_image_size( 'route-square', 560, 560, true ); // Shot of the Week

	add_image_size( 'article-medium', 640, 480, true ); // Shot of the Week



	add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'lakesmtb' ),
		'footer' => esc_html__( 'Footer', 'lakesmtb' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lakesmtb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'lakesmtb_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lakesmtb_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lakesmtb_content_width', 640 );
}
add_action( 'after_setup_theme', 'lakesmtb_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lakesmtb_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lakesmtb' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lakesmtb' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lakesmtb_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lakesmtb_scripts() {
	wp_enqueue_style( 'lakesmtb-style', get_stylesheet_uri() );
	wp_enqueue_style( 'lakesmtb-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'lakesmtb-googlefont', 'https://fonts.googleapis.com/css?family=Lato: 300,700' );

	wp_enqueue_style( 'lakesmtb-slick-css', get_template_directory_uri() . '/slick/slick.css' );
    wp_enqueue_style( 'lakesmtb-slick-css-theme', get_template_directory_uri() . '/slick/slick-theme.css' );

    wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'lakesmtb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'lakesmtb-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'lakesmtb-custom', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true );
	wp_enqueue_script( 'lakesmtb-slick-js', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lakesmtb_scripts' );

/**
 * Implement the Custom Header feature.

require get_template_directory() . '/inc/custom-header.php'; */

/**
 * Custom options page for this theme.
 */
require get_template_directory() . '/inc/options.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Custom Post Types.
 */
require get_template_directory() . '/inc/ctps.php';

/**
 * Add new user profile fields
 *
 */
if ( ! function_exists( 'lakesmtb_modify_contact_methods' ) ) :

    function lakesmtb_modify_contact_methods( $contactmethods ) {
        $contactmethods['instagram'] = __( 'Instagram (without @)' );

        return $contactmethods;
    }
    add_filter('user_contactmethods','lakesmtb_modify_contact_methods', 10, 1);

endif;

/**
 * Now you can upload GPX files...
 *
 */
function gpx_upload($mime_types){

    $mime_types['gpx'] = 'application/gpx+xml'; //Adding gpx extension

    return $mime_types;
}
add_filter('upload_mimes', 'gpx_upload', 1, 1);


// custom excerpt length
function lakesmtb_custom_excerpt_length( $length ) {
   return 30;
}
add_filter( 'excerpt_length', 'lakesmtb_custom_excerpt_length', 999 );

// add more link to excerpt
function lakesmtb_custom_excerpt_more($more) {
   global $post;
   return '<a class="more-link" href="'. get_permalink($post->ID) . '">'. __('Read the full article...', 'lakesmtb') .'</a>';
}
add_filter('excerpt_more', 'lakesmtb_custom_excerpt_more');

