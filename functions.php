<?php
/**
 * school-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package school-theme
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
function school_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on school-theme, use a find and replace
		* to change 'school-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'school-theme', get_template_directory() . '/languages' );

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

	//Our Custom Image Crop Sizes
	add_image_size( 'recent-news', 400, 200, true );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'school-theme' ),
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
			'school_theme_custom_background_args',
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
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	 // Add support for wide and full-width alignment
	 add_theme_support( 'align-wide' );

	 // Add other block editor features support
	 add_theme_support( 'wp-block-styles' );
	 add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'school_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function school_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'school_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'school_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function school_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'school-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'school-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'school_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function school_theme_scripts() {
	wp_enqueue_style( 'school-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'school-theme-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'school-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'school-theme-navigation', get_template_directory_uri() . '/js/nav.js', array(), _S_VERSION, true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'school_theme_scripts' );

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

require get_template_directory() . '/inc/cpt-taxonomy.php';

//Define a Block Editor Template for the Students CPT

function student_block_editor_template( $post_type, $post ) {
    if ( 'student' === $post_type ) {
        $template = array(
            array( 'core/paragraph', array(
                'placeholder' => 'Add student biography here...',
            ) ),
            array( 'core/button', array(
                'text' => 'Portfolio',
                'url'  => '', // Can be filled later by the user
            ) ),
        );

        $template_lock = 'all'; // Prevents adding, removing, and moving blocks

        //Set block template and lock the blocks
        add_filter( 'block_editor_settings_all', function( $settings ) use ( $template, $template_lock ) {
            $settings['template'] = $template;
            $settings['templateLock'] = $template_lock;
            return $settings;
        });
    }
}
add_action( 'add_meta_boxes', 'student_block_editor_template', 10, 2 );


// Change the placeholder for the title input field for Student CPT
function change_student_title_placeholder( $title ){
    $screen = get_current_screen();

    if ( 'student' == $screen->post_type ) {
        $title = 'Add student name';
    }

    return $title;
}
add_filter( 'enter_title_here', 'change_student_title_placeholder' );


// Create taxonomy terms Designer and Developer in Speciality taxonomy
function create_speciality_taxonomy_terms() {
    $terms = array( 'Designer', 'Developer' );
    $taxonomy = 'speciality';

    foreach ( $terms as $term ) {
        if ( ! term_exists( $term, $taxonomy ) ) {
            wp_insert_term( $term, $taxonomy );
        }
    }
}
add_action( 'init', 'create_speciality_taxonomy_terms' );

// Register a new image size for student featured images
function register_custom_image_sizes() {
    add_image_size( 'custom-size', 200, 300, true ); // Cropped image to exactly 200x300 pixels
}
add_action( 'after_setup_theme', 'register_custom_image_sizes' );



//change excerpt length to 20 words
function fwd_excerpt_length($length){
	return 25;
}

add_filter('excerpt_length', 'fwd_excerpt_length', 999);

function fwd_student_excerpt_more( $more ) {
    // Check if it's a student custom post type archive or a student list template
    if ( is_post_type_archive( 'student' ) || is_page_template( 'page-students.php' ) ) {
        $more = '<br>'.'<a class="read-more" href="' . esc_url( get_permalink() ) . '">' . __( 'Read More about the Student...', 'fwd' ) . '</a>';
    }
    return $more;
}
add_filter( 'excerpt_more', 'fwd_student_excerpt_more' );


function register_my_menus() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
}
add_action( 'init', 'register_my_menus' );

function allow_table_tags_in_acf() {
    global $allowedposttags;
    $allowedposttags['table'] = array();
    $allowedposttags['thead'] = array();
    $allowedposttags['tbody'] = array();
    $allowedposttags['tr'] = array();
    $allowedposttags['th'] = array(
        'colspan' => array(),
        'rowspan' => array(),
        'scope'   => array(),
    );
    $allowedposttags['td'] = array(
        'colspan' => array(),
        'rowspan' => array(),
        'headers' => array(),
    );
}
add_action('init', 'allow_table_tags_in_acf');


function change_staff_title_placeholder( $title, $post ) {
    if ( 'staff' == $post->post_type ) { // 'staff' is the post type slug
        $title = 'Add staff name';
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_staff_title_placeholder', 10, 2 );

// Change excerpt length to 25 words and custom "read more" link
function custom_trimmed_excerpt( $content, $post_id ) {
    $excerpt = wp_trim_words( $content, 25, '<a href="' . get_permalink( $post_id ) . '">' . __( 'Read More about the Student...', 'fwd' ) . '</a>' );
    return $excerpt;
}

function enqueue_aos_for_posts() {
    if ( is_singular( 'post' ) || is_home() || is_archive() ) {
		// Enqueue the main compiled CSS (which includes AOS styles from your SCSS)
        wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css', array(), '1.0.0' );
		
        // Enqueue the main CSS (which now includes AOS styles)
        wp_enqueue_style( 'aos-css', get_template_directory_uri() . '/aos/aos.css', array(), '3.0.0' );

        // Enqueue AOS JS
        wp_enqueue_script( 'aos-js', get_template_directory_uri() . '/aos/aos.js', array(), '3.0.0', true );

        // Initialize AOS
        wp_add_inline_script( 'aos-js', 'AOS.init();' );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_aos_for_posts' );


function enqueue_toggle_dropdown(){
	wp_enqueue_script( 'toggle-dropdown', get_template_directory_uri() . '/js/toggle-dropdown.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_toggle_dropdown' );


function school_theme_enqueue_styles() {
    // Enqueue Rubik Google Font
    wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap', false );
}
add_action( 'wp_enqueue_scripts', 'school_theme_enqueue_styles' );


?>
