<?php
/**
 * multisite_demo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package multisite_demo
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
function multisite_demo_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on multisite_demo, use a find and replace
		* to change 'multisite_demo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'multisite_demo', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'multisite_demo' ),
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
			'multisite_demo_custom_background_args',
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
add_action( 'after_setup_theme', 'multisite_demo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function multisite_demo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'multisite_demo_content_width', 640 );
}
add_action( 'after_setup_theme', 'multisite_demo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function multisite_demo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'multisite_demo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'multisite_demo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'multisite_demo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function multisite_demo_scripts() {
	wp_enqueue_style( 'multisite_demo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'multisite_demo-style', 'rtl', 'replace' );
	wp_enqueue_style( 'multisite_demo-main', get_stylesheet_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'multisite_demo-media', get_stylesheet_directory_uri() . '/css/media.css' );
	wp_enqueue_style('multisite_demo-all-min-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css');
	wp_enqueue_style('multisite_demo-slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('multisite_demo-slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
	wp_enqueue_style('multisite_demo-jquery-magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/magnific-popup.css');

	wp_enqueue_script( 'multisite_demo-jquery-3-6-4-min', get_template_directory_uri() . '/js/jquery-3.6.4.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'multisite_demo-zoom-js', get_template_directory_uri() . '/js/zoom.js', array(), _S_VERSION, true );
    wp_enqueue_script('multisite_demo-slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
	wp_enqueue_script('multisite_demo-all-min-js', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js', array('jquery'), '1.8.1', true);
	wp_enqueue_script('multisite_demo-jquery-magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/jquery.magnific-popup.js', array('jquery'), '1.8.1', true);
	wp_enqueue_script( 'multisite_demo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'multisite_demo-custom', get_template_directory_uri() . '/js/custom.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'multisite_demo_scripts' );

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

function year_shortcode() {
	$year = date('Y');
	return $year;
  }
add_shortcode('year', 'year_shortcode');
function custom_theme_setup() {
    add_image_size('custom-size', 150, 250, true);
}
add_action('after_setup_theme', 'custom_theme_setup');


function filter_posts_by_category() {
    $category_id = isset($_POST['category_id']) ? sanitize_text_field($_POST['category_id']) : '';

    $args = array(
        'post_type' => 'news',
        'posts_per_page' => 8,
        'post_status' => 'publish',
    );

    if ($category_id && $category_id != 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id', // Use 'term_id' instead of 'slug'
                'terms' => $category_id,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()): $query->the_post();
            ?>
            <div class="news-post">
                <a href="<?php the_permalink(); ?>">
                    <div class="blog-content">
                        <?php 
                        if (has_post_thumbnail()) : 
                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        else : 
                            $thumbnail_url = get_template_directory_uri() . '/images/dummy-image.png';
                        endif;
                        ?>
                        <div class="post-thumbnail" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');"></div>
                        <div class="post-content">
                            <p class="post-title"><?php the_title(); ?></p>
                            <div class="post-dic">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
    else:
        echo '<p>No posts found.</p>';
    endif;

    wp_reset_postdata();
    die;
}


add_action('wp_ajax_filter_posts_by_category', 'filter_posts_by_category');
add_action('wp_ajax_nopriv_filter_posts_by_category', 'filter_posts_by_category');

function blog_scripts() {
    // Enqueue script
    wp_enqueue_script('load-more-script', get_template_directory_uri() . '/js/load-more.js', array('jquery'), null, true);

    // Localize script with nonce and ajax URL
    wp_localize_script('load-more-script', 'blog', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('load_more_posts'),
    ));
}
add_action('wp_enqueue_scripts', 'blog_scripts');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    $args = array(
        'post_type' => 'news',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'paged' => $paged,
    );

    $blog_posts = new WP_Query($args);

    if ($blog_posts->have_posts()) :
        while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
            <div class="news-post">
                <a href="<?php the_permalink(); ?>">
                    <div class="blog-content">
						<?php 
                            if (has_post_thumbnail()) : 
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            else : 
                                $thumbnail_url = get_template_directory_uri() . '/images/dummy-image.png';
                            endif;
                            ?>
                            <div class="post-thumbnail" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                            </div>
                            <div class="post-content <?php echo esc_attr($text_align); ?>">
                                <p class="post-title"><?php the_title(); ?></p>
								<div class="post-dic">
                                    <?php the_excerpt(); ?>
                                </div>
                        	</div>
                    </div>
                </a>            
            </div>
        <?php endwhile;
    else :
        echo '<p class="no-posts-message">No more posts</p>';
    endif;

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

add_action('wp_ajax_filter_matches', 'filter_matches');
add_action('wp_ajax_nopriv_filter_matches', 'filter_matches');

function filter_matches() {
    $team_option = isset($_POST['team_option']) ? sanitize_text_field($_POST['team_option']) : '';

    ob_start();

    if (have_rows('schedule_match')) :
        while (have_rows('schedule_match')) : the_row();
            if (get_sub_field('team_option') == $team_option || $team_option == '') {

                // Output match details (same as in the displaying section)
                // ...
            }
        endwhile;
    else :
        echo 'No matches found.';
    endif;

    wp_die(ob_get_clean());
}


function enqueue_custom_scripts() {
    // Enqueue your script
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), null, true);

    // Localize the script with new data
    wp_localize_script('custom-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}

add_action('woocommerce_single_product_summary', 'display_custom_field', 20);

function display_custom_field() {
    global $product;
    $custom_field = get_post_meta($product->get_id(), '_custom_field_key', true);
    if ($custom_field) {
        echo '<p>' . esc_html($custom_field) . '</p>';
    }
}