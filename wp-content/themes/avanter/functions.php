<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */
add_filter( 'woocommerce_is_purchasable','__return_false',10,2);



// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('progression-slider', 1500, 470, true);
add_image_size('progression-blog', 900, 400, true);
add_image_size('progression-portfolio-thumb', 600, 338, true); //600 wide by 338 tall Image is cropped due to true setting
add_image_size('progression-portfolio-single', 1200, 600, true);
add_image_size('progression-studios-woocommerce-single', 600, 600, true);

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 800; /* pixels */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
function progression_setup() {
	
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Custom template tags for this theme.  Blog Comments Found Here
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Registering Custom Meta Boxes 
	 * https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes
	 * Include the file that creates the class and a file that instantiates the class
	 */
	require( get_template_directory() . '/metaboxes/meta_box.php' );
	require( get_template_directory() . '/inc/custom_meta_boxes.php' );
	
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	
	// Shortcodes
	include_once('shortcodes.php');

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
	add_post_type_support( 'portfolio', 'post-formats' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
	) );
	
	



}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );






/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'progression' ),
		'id' => 'sidebar-shop',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-divider"></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Content Top', 'progression' ),
		'id' => 'homepage-widgets',
		'before_widget' => '',
		'after_widget' => '<div class="clearfix"></div>',
		'before_title' => '<h2 class="title-avanter">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Content Bottom', 'progression' ),
		'id' => 'homepage-widgets-2',
		'before_widget' => '',
		'after_widget' => '<div class="clearfix"></div>',
		'before_title' => '<h2 class="title-avanter">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Footer Widgets', 'progression' ),
		'id' => 'page-full-widgets',
		'before_widget' => '<div id="%1$s" class="widget-full-width widget %2$s">',
		'after_widget' => '</div><!-- close .width-container -->',
		'before_title' => '<div class="width-container"><h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
}
add_action( 'widgets_init', 'progression_widgets_init' );




// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}



function parameter_queryvars( $qvars ) {
    $qvars[] = 'your-subject';
    return $qvars;
}
add_filter('query_vars', 'parameter_queryvars' );

function echo_chalet() {
    global $wp_query;
        if (isset($wp_query->query_vars['your-subject']))
        {
            print $wp_query->query_vars['your-subject'];
        }
}



add_theme_support( 'woocommerce' );



// Change number or products per row to 3
add_filter('loop_shop_columns', 'progression_studios_loop_columns');
if (!function_exists('progression_studios_loop_columns')) {
	
	function progression_studios_loop_columns() {
		$col_count_progression = esc_attr( of_get_option('columns_per_row_iceberge', '4' ) );
		return $col_count_progression; // 3 products per row
	}
}


add_filter( 'woocommerce_output_related_products_args', 'progression_studios_related_products_args' );
  function progression_studios_related_products_args( $args ) {
	  $col_count_progression = esc_attr( of_get_option('columns_per_row_iceberge', '4' ) );
	$args['posts_per_page'] = $col_count_progression; // 4 related products
	$args['columns'] = $col_count_progression; // arranged in 2 columns
	return $args;
}



add_theme_support( 'wc-product-gallery-slider' );


// Display 24 products per page. Goes in functions.php
add_filter('loop_shop_per_page', create_function('$cols', 'return of_get_option("shop_per_page");;'));






/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function progression_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'progression' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'progression_wp_title', 10, 2 );



remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);





function progression_studios_plugin_google_maps_customizer( $wp_customize ) {
	$wp_customize->add_section( 'progression_studios_panel_google_Maps', array(
		'priority'    => 800,
       'title'       => esc_html__( 'Google Maps', 'invested-progression' ),
    ) );
	 
	$wp_customize->add_setting( 'progression_studios_google_maps_api' ,array(
		'default' =>  '',
		'sanitize_callback' => 'progression_studios_plugin_google_maps_sanitize_text',
	) );
	$wp_customize->add_control( 'progression_studios_google_maps_api', array(
		'label'          => 'Google Maps API Key',
		'description'    => 'See documentation under "Google Maps API Key" for directions. Get API key: https://developers.google.com/maps/documentation/javascript/get-api-key',
		'section' => 'progression_studios_panel_google_Maps',
		'type' => 'text',
		'priority'   => 10,
		)
	
	);
}
add_action( 'customize_register', 'progression_studios_plugin_google_maps_customizer' );
/* Sanitize Text */
function progression_studios_plugin_google_maps_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}





/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array( 'style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );





/**
 * Registering Custom Post Type
 */
add_action('init', 'pyre_init');
function pyre_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-type'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_type', 'portfolio', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
}




/* remove more link jump */
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );




function sensica_slider_insert()
{
    ?>
 	<?php if(of_get_option('custom_js')): ?>
		<?php echo '<script type="text/javascript">'; ?>
		<?php echo of_get_option('custom_js'); ?>
		<?php echo '</script>'; ?>
	<?php endif; ?>
	<?php if(of_get_option('tracking_code')): ?>
		<?php echo '<script type="text/javascript">'; ?>
		<?php echo of_get_option('tracking_code'); ?>
		<?php echo '</script>'; ?>
	<?php endif; ?>

<?php if( is_page_template('homepage.php') || is_page_template('page-blog-slider.php') ): ?>	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
	    $('#homepage-slider').flexslider({
			animation: "fade",              //String: Select your animation type, "fade" or "slide"
			slideshow: <?php echo of_get_option('slider_autoplay_play', true); ?>,                //Boolean: Animate slider automatically
			slideshowSpeed: <?php echo of_get_option('slider_autoplay', 8500); ?>,           //Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 250,         //Integer: Set the speed of animations, in milliseconds
			directionNav: <?php echo of_get_option('slider_navigation', false); ?>,             //Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: <?php echo of_get_option('slider_bullets', true); ?>,               //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
			keyboardNav: true,              //Boolean: Allow slider navigating via keyboard left/right keys
			mousewheel: false,              //Boolean: Allow slider navigating via mousewheel
			prevText: "Previous",           //String: Set the text for the "previous" directionNav item
			nextText: "Next",               //String: Set the text for the "next" directionNav item
			pausePlay: false,               //Boolean: Create pause/play dynamic element
			pauseText: 'Pause',             //String: Set the text for the "pause" pausePlay item
			playText: 'Play',               //String: Set the text for the "play" pausePlay item
			randomize: false,               //Boolean: Randomize slide order
			slideToStart: 0,                //Integer: The slide that the slider should start on. Array notation (0 = first slide)
			useCSS: true,
			animationLoop: true,            //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
			pauseOnAction: true,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
			pauseOnHover: false            //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
	    });
	});
	</script>
	<?php endif; ?>

    <?php
}
add_action('wp_footer', 'sensica_slider_insert');




function avanter_customize_register($wp_customize)
{
	
	$wp_customize->add_section( 'avanter_text_scheme' , array(
	    'title'      => __('Font Colors','progression'),
	    'priority'   => 35,
	) );
	
	$wp_customize->add_setting('body_text', array(
	    'default'     => '#888888'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text', array(
		'label'        => __( 'Body Default Font Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'body_text',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('navigation_selected_text', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_selected_text', array(
		'label'        => __( 'Navigation Selected/Hover Font Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'navigation_selected_text',
		'priority'   => 22,
	)));
	
	$wp_customize->add_setting('navigation_text', array(
	    'default'     => '#949698'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text', array(
		'label'        => __( 'Navigation Font Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'navigation_text',
		'priority'   => 20,
	)));
	
	
	
	$wp_customize->add_setting('page_title_text', array(
	    'default'     => '#4a4d4c'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_text', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'page_title_text',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'Default Link Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'link_color',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('link_hover_color', array(
	    'default'     => '#f87071'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label'        => __( 'Default Link Hover Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'link_hover_color',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('headings_default_color', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_default_color', array(
		'label'        => __( 'Headings Text Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'headings_default_color',
		'priority'   => 60,
	)));
	
	
	$wp_customize->add_setting('button_font_default', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_font_default', array(
		'label'        => __( 'Red Button Text Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'button_font_default',
		'priority'   => 65,
	)));
	
	$wp_customize->add_setting('button_font_hover', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_font_hover', array(
		'label'        => __( 'Red Button Text Hover Color', 'progression' ),
		'section'    => 'avanter_text_scheme',
		'settings'   => 'button_font_hover',
		'priority'   => 66,
	)));
	
	

	
	$wp_customize->add_section( 'avanter_color_scheme' , array(
	    'title'      => __('Background Colors','progression'),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting('header_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
		'label'        => __( 'Header Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'header_bg',
		'priority'   => 1,
	)));
	
	
	$wp_customize->add_setting('navigation_sub', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_sub', array(
		'label'        => __( 'Navigation Sub-Menu Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'navigation_sub',
		'priority'   => 8,
	)));
	
	
	$wp_customize->add_setting('page_title_background', array(
	    'default'     => '#e9edeb'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_background', array(
		'label'        => __( 'Page Title Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'page_title_background',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('body_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_bg', array(
		'label'        => __( 'Body Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'body_bg',
		'priority'   => 20,
	)));
	
	
	$wp_customize->add_setting('featured_bg', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'featured_bg', array(
		'label'        => __( 'Featured Widget Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'featured_bg',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('button_bg', array(
	    'default'     => '#f44647'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg', array(
		'label'        => __( 'Red Button Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'button_bg',
		'priority'   => 35,
	)));
	
	
	$wp_customize->add_setting('button_hover_bg', array(
	    'default'     => '#f66061'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg', array(
		'label'        => __( 'Red Button Hover Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'button_hover_bg',
		'priority'   => 38,
	)));
	
	$wp_customize->add_setting('pagination_hover', array(
	    'default'     => '#fc7979'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'pagination_hover', array(
		'label'        => __( 'Pagination Hover Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'pagination_hover',
		'priority'   => 40,
	)));
	
	
	
	$wp_customize->add_setting('footer_bg', array(
	    'default'     => '#353736'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg', array(
		'label'        => __( 'Footer Base Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'footer_bg',
		'priority'   => 50,
	)));
	
	
	$wp_customize->add_setting('footer_top_bg', array(
	    'default'     => '#3b3d3c'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_top_bg', array(
		'label'        => __( 'Footer Widget Area Background Color', 'progression' ),
		'section'    => 'avanter_color_scheme',
		'settings'   => 'footer_top_bg',
		'priority'   => 42,
	)));
	
	

	
}
add_action('customize_register', 'avanter_customize_register');


function avanter_customize_css()
{
    ?>
 
<style type="text/css">
	body #logo, body #logo img {width:<?php echo of_get_option('logo_width', '377'); ?>px;}
	.sf-menu a {padding-top:<?php echo of_get_option('navigation_height', '54'); ?>px; padding-bottom:<?php echo of_get_option('navigation_height', '54'); ?>px;}
	header {background-color:<?php echo get_theme_mod('header_bg', '#ffffff'); ?>; }
	.sf-menu a, .sf-menu a:visited  {border-color:<?php echo get_theme_mod('header_bg', '#ffffff'); ?>;}
	.sf-menu ul {background:<?php echo get_theme_mod('navigation_sub', '#f44647'); ?>;}
	.sf-menu ul li a, .sf-menu ul li a:visited {border-color:<?php echo get_theme_mod('navigation_sub', '#f44647'); ?>;}
	.sf-menu li.current-menu-item a, .sf-menu li.current-menu-item a:visited {border-color:<?php echo get_theme_mod('navigation_sub', '#f44647'); ?>; }
	#page-title {background-color:<?php echo get_theme_mod('page_title_background', '#e9edeb'); ?>;}
	#main {background-color:<?php echo get_theme_mod('body_bg', '#ffffff'); ?>;}
	#footer-widgets {background-color:<?php echo get_theme_mod('footer_top_bg', '#3b3d3c'); ?>;}
	footer {background-color:<?php echo get_theme_mod('footer_bg', '#353736'); ?>;}
	#featured-avanter, #featured-avanter-button {background-color:<?php echo get_theme_mod('featured_bg', '#f44647'); ?>;}
	body #main input.wpcf7-submit, body #main a.progression-red, body .flexslider a.progression-red, body #respond input#submit,
	body #main #container a.button, body #main #sidebar a.button, body #main button.button, body #main #container input#submit, body #main #container input.submit, body #main input.button,
	body .pagination a:hover, body .pagination a.selected {background-color:<?php echo get_theme_mod('button_bg', '#f44647'); ?>;}
	#portfolio-sub-nav select, .woocommerce-ordering select.orderby {background-color:<?php echo get_theme_mod('button_bg', '#f44647'); ?>;}
	body .pagination a {background: <?php echo get_theme_mod('pagination_hover', '#fc7979'); ?>;}
	body #main input.wpcf7-submit, body #main a.progression-red, body .flexslider a.progression-red, body #respond input#submit,
	body #main #container a.button, body #main #sidebar a.button, body #main button.button, body #main #container input#submit, body #main #container input.submit, body #main input.button,
	body #main .width-container .woocommerce .button
	{background:<?php echo get_theme_mod('button_bg', '#f44647'); ?> !important;  	border-color:<?php echo get_theme_mod('button_bg', '#f44647'); ?>; color:<?php echo get_theme_mod('button_font_default', '#ffffff'); ?> !important;}
	body #main a.progression-red:hover, body #main input.wpcf7-submit:hover, body #respond input#submit:hover, body .flexslider a.progression-red:hover,
	body #main #container a.button:hover, body #main #sidebar a.button:hover, body #main button.button:hover, body #main #container input#submit:hover, body #main #container input#submit:hover, body #main input.button:hover,
	body #main .width-container .woocommerce .button:hover {
		background: <?php echo get_theme_mod('button_hover_bg', '#f66061'); ?> !important;
		border-color:<?php echo get_theme_mod('button_hover_bg', '#f66061'); ?>;
		color:<?php echo get_theme_mod('button_font_hover', '#ffffff'); ?> !important;
	}
	body, .home-child-boxes a, .home-child-boxes a:hover {color:<?php echo get_theme_mod('body_text', '#888888'); ?>;}
	.sf-menu a, .sf-menu a:visited  {color:<?php echo get_theme_mod('navigation_text', '#949698'); ?>;}
	.sf-menu li.current-menu-item a, .sf-menu li.current-menu-item a:visited {color:<?php echo get_theme_mod('navigation_selected_text', '#f44647'); ?>;}
	.sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited {color:<?php echo get_theme_mod('navigation_selected_text', '#f44647'); ?>;}
	h1, h2, h3, h4, h5, h6 {color:<?php echo get_theme_mod('headings_default_color', '#f44647'); ?>;}
	h1, h2 {color:<?php echo get_theme_mod('page_title_text', '#4a4d4c'); ?>;}
	a, .avanter-post-meta .genericon, .avanter-post-meta a:hover, .avanter-post-meta .genericon.genericon-chat {color:<?php echo get_theme_mod('link_color', '#f44647'); ?>;}
	a:hover {color:<?php echo get_theme_mod('link_hover_color', '#f87071'); ?>;}
	#twitter-avanter .icons a .genericon, #twitter-avanter .icons a .genericon:hover {color:<?php echo get_theme_mod('link_color', '#f44647'); ?>;}
	<?php if(of_get_option('custom_css')): ?>
		<?php echo of_get_option('custom_css'); ?>
	<?php endif; ?>
</style>
    <?php
}
add_action('wp_head', 'avanter_customize_css');


/**
 * Load Plugin Activiation
 */
require get_template_directory() . '/tgm-plugin-activation/plugin-activation.php';
