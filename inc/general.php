<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

function cv_corp_setup() {
	
	load_theme_textdomain( 'cv-corp', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cv-corp' ),
		)
	);
}
add_action( 'after_setup_theme', 'cv_corp_setup' );


function cv_corp_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cv-corp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cv-corp' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cv_corp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cv_corp_scripts() {
    //CSS
	wp_enqueue_style( 'cv-corp-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style('stylebase', get_template_directory_uri() . '/public/dist/css/style.bundle.css', array(), _S_VERSION);
    // FONT

    //JS
    //JQUERY 
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js' , array(),'1.0.0', true);

	//BUNDLE MAIN
    wp_enqueue_script('mainjs', get_template_directory_uri() . '/public/dist/js/index.bundle.js', array(), _S_VERSION, true);

    //AJAX
    wp_add_inline_script('mainjs', 'const ajaxurl = ' . json_encode(admin_url('admin-ajax.php')), 'before');
}
add_action( 'wp_enqueue_scripts', 'cv_corp_scripts' );



require get_template_directory() . '/inc/extra/template-tags.php';
require get_template_directory() . '/inc/extra/template-functions.php';


