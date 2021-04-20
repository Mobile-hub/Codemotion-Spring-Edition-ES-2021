<?php
/**
 * fMovies functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @subpackage fmovies
 * @author tishonator
 * @since fmovies 1.0.0
 *
 */

/**
 * Set a constant that holds the theme's minimum supported PHP version.
 */
define( 'FMOVIES_MIN_PHP_VERSION', '5.6' );

/**
 * Immediately after theme switch is fired we we want to check php version and
 * revert to previously active theme if version is below our minimum.
 */
add_action( 'after_switch_theme', 'fmovies_test_for_min_php' );

/**
 * Switches back to the previous theme if the minimum PHP version is not met.
 */
function fmovies_test_for_min_php() {

	// Compare versions.
	if ( version_compare( PHP_VERSION, FMOVIES_MIN_PHP_VERSION, '<' ) ) {
		// Site doesn't meet themes min php requirements, add notice...
		add_action( 'admin_notices', 'fmovies_min_php_not_met_notice' );
		// ... and switch back to previous theme.
		switch_theme( get_option( 'theme_switched' ) );
		return false;

	};
}

if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
                do_action( 'wp_body_open' );
        }
}

/**
 * An error notice that can be displayed if the Minimum PHP version is not met.
 */
function fmovies_min_php_not_met_notice() {
	?>
	<div class="notice notice-error is_dismissable">
		<p>
			<?php esc_html_e( 'You need to update your PHP version to run this theme.', 'fmovies' ); ?> <br />
			<?php
			printf(
				/* translators: 1 is the current PHP version string, 2 is the minmum supported php version string of the theme */
				esc_html__( 'Actual version is: %1$s, required version is: %2$s.', 'fmovies' ),
				PHP_VERSION,
				FMOVIES_MIN_PHP_VERSION
			); // phpcs: XSS ok.
			?>
		</p>
	</div>
	<?php
}


require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );

if ( ! function_exists( 'fmovies_setup' ) ) :
/**
 * fmovies setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fmovies_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'fmovies', get_template_directory() . '/languages' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	

	// This theme uses wp_nav_menu() in header menu
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fmovies' ),
		'footer'    => __( 'Footer Menu', 'fmovies' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );

	// add the visual editor to resemble the theme style
	add_editor_style( 'css/editor-style.css' );

	// add custom background				 
	add_theme_support( 'custom-background', 
				   array ('default-color'  => '#ffffff')
				 );

	// add content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900;
	}

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'     => '#000000',
                       'wp-head-callback'       => 'fmovies_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 75,
                       'height'                 => 75,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );

    // Define and register starter content to showcase the theme on new sites.
	$starter_content = array(

		'widgets' => array(
			'sidebar-widget-area' => array(
				'search',
				'recent-posts',
				'categories',
				'archives',
			),

			'footer-column-1-widget-area' => array(
				'recent-comments'
			),

			'footer-column-2-widget-area' => array(
				'recent-posts'
			),

			'footer-column-3-widget-area' => array(
				'calendar'
			),
		),

		'posts' => array(
			'home',
			'blog',
			'about',
			'contact'
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'fmovies_slider_display' => 1,
			'fmovies_slide1_image' => esc_url( get_template_directory_uri() . '/images/slider/1.jpg' ),
			'fmovies_slide2_image' => esc_url( get_template_directory_uri() . '/images/slider/2.jpg' ),
			'fmovies_slide3_image' => esc_url( get_template_directory_uri() . '/images/slider/3.jpg' ),
			'fmovies_slide4_image' => esc_url( get_template_directory_uri() . '/images/slider/4.jpg' ),
		),

		'nav_menus' => array(

			// Assign a menu to the "primary" location.
			'primary' => array(
				'name' => __( 'Primary Menu', 'fmovies' ),
				'items' => array(
					'link_home',
					'page_blog',
					'page_contact',
					'page_about',
				),
			),

			// Assign a menu to the "footer" location.
			'footer' => array(
				'name' => __( 'Footer Menu', 'fmovies' ),
				'items' => array(
					'link_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	$starter_content = apply_filters( 'fmovies_starter_content', $starter_content );
	add_theme_support( 'starter-content', $starter_content );
}
endif; // fmovies_setup
add_action( 'after_setup_theme', 'fmovies_setup' );

if ( ! function_exists( 'fmovies_sanitize_checkbox' ) ) :
	/**
	 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
	 * as a boolean value, either TRUE or FALSE.
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function fmovies_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
endif; // fmovies_sanitize_checkbox

if ( ! function_exists( 'fmovies_sanitize_url' ) ) :

	function fmovies_sanitize_url( $url ) {
		return esc_url_raw( $url );
	}

endif; // fmovies_sanitize_url
/**
 * Register theme settings in the customizer
 */
function fmovies_customize_register( $wp_customize ) {

	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fmovies_slider_section',
		array(
			'title'       => __( 'Slider', 'fmovies' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add display slider option
	$wp_customize->add_setting(
			'fmovies_slider_display',
			array(
					'default'           => 0,
					'sanitize_callback' => 'fmovies_sanitize_checkbox',
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmovies_slider_display',
							array(
								'label'          => __( 'Display Slider on a Static Front Page', 'fmovies' ),
								'section'        => 'fmovies_slider_section',
								'settings'       => 'fmovies_slider_display',
								'type'           => 'checkbox',
							)
						)
	);
	
	for ($i = 1; $i <= 4; ++$i) {
	
		$slideImageId = 'fmovies_slide'.$i.'_image';
		$defaultSliderImagePath = get_template_directory_uri().'/images/slider/'.$i.'.jpg';
	
		// Add Slide Background Image
		$wp_customize->add_setting( $slideImageId,
			array(
				'default' => $defaultSliderImagePath,
				'sanitize_callback' => 'fmovies_sanitize_url'
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
				array(
					'label'   	 => sprintf( esc_html__( 'Slide #%s Image', 'fmovies' ), $i ),
					'section' 	 => 'fmovies_slider_section',
					'settings'   => $slideImageId,
				) 
			)
		);
	}

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fmovies_footer_section',
		array(
			'title'       => __( 'Footer', 'fmovies' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fmovies_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fmovies_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fmovies' ),
            'section'        => 'fmovies_footer_section',
            'settings'       => 'fmovies_footer_copyright',
            'type'           => 'text',
            )
        )
	);
	
	/**
	 * Add Animations Section
	 */
	$wp_customize->add_section(
		'fmovies_animations_display',
		array(
			'title'       => __( 'Animations', 'fmovies' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Add display Animations option
	$wp_customize->add_setting(
			'fmovies_animations_display',
			array(
					'default'           => 1,
					'sanitize_callback' => 'fmovies_sanitize_checkbox',
			)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						'fmovies_animations_display',
							array(
								'label'          => __( 'Enable Animations', 'fmovies' ),
								'section'        => 'fmovies_animations_display',
								'settings'       => 'fmovies_animations_display',
								'type'           => 'checkbox',
							)
						)
	);
}

add_action('customize_register', 'fmovies_customize_register');

/**
 * Displays the slider
 */
function fmovies_display_slider() {

?>
	<section class="slider">
        <div class="flexslider">
          <ul class="slides">

<?php
			// display slides
			for ( $i = 1; $i <= 4; ++$i ) {
					
					$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';

					$slideImage = get_theme_mod( 'fmovies_slide'.$i.'_image', $defaultSlideImage );

				?>
					<li>
						<img src="<?php echo esc_url( $slideImage ); ?>" />
					</li>
<?php		} ?>

		  </ul><!-- .slides -->
		</div><!-- .flexslider -->
	</section><!-- .slider -->
<?php
}

/**
 *	Load google font url used in the fmovies theme
 */
function fmovies_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Abel, translate this to 'off'. Do not translate
    * into your own language.
    */
    $cantarell = _x( 'on', 'Abel font: on or off', 'fmovies' );

    if ( 'off' !== $cantarell ) {
        $font_families = array();
 
        $font_families[] = 'Abel';
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 * the main function to load scripts in the fmovies theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fmovies_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css', array( ) );
	wp_enqueue_style( 'fmovies-style', get_stylesheet_uri(), array() );
	
	wp_enqueue_style( 'fmovies-fonts', fmovies_fonts_url(), array(), null );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Load Utilities JS Script
	wp_enqueue_script( 'viewportchecker', get_template_directory_uri() . '/js/viewportchecker.js', array( 'jquery' ) );

	wp_enqueue_script( 'fmovies-utilities', get_template_directory_uri() . '/js/utilities.js', array( 'jquery', 'viewportchecker' ) );

	$data = array(
		'loading_effect' => ( get_theme_mod('fmovies_animations_display', 1) == 1 ),
	);
	wp_localize_script('fmovies-utilities', 'fmovies_options', $data);
	
	// Load Slider JS Script
	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js',
		array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'fmovies_load_scripts' );

/**
 * Display website's logo image
 */
function fmovies_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1 class="entry-title">' . esc_html( get_bloginfo('name') ) . '</h1>';
        echo '</a>';
        echo '<strong>' . esc_html( get_bloginfo('description') ) . '</strong>';
        echo '</div>';
    }
}

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fmovies_widgets_init() {
	
	// Register Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fmovies'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fmovies'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fmovies' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fmovies' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fmovies' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fmovies' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fmovies' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fmovies' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}

add_action( 'widgets_init', 'fmovies_widgets_init' );

/**
 *	Displays the copyright text.
 */
function fmovies_show_copyright_text() {

	$footerText = get_theme_mod('fmovies_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

function fmovies_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main-fixed {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main-fixed, #header-main-fixed h1.entry-title {color: #<?php echo sanitize_hex_color_no_hash( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function fmovies_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'fmovies_skip_link_focus_fix' );

?>
