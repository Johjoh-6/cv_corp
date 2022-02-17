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
    wp_enqueue_style('fonts-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap', array(), _S_VERSION);
    wp_enqueue_style('fonts-code', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700;900&display=swap', array(), _S_VERSION);

    //JS
    //JQUERY 
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js' , array(),'1.0.0', true);

    //VUE JS
    wp_enqueue_script('vuejs', 'https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js' , array(),'1.0.0', true);

	//BUNDLE MAIN
    wp_enqueue_script('mainjs', get_template_directory_uri() . '/public/dist/js/index.bundle.js', array(), _S_VERSION, true);

    //AJAX
    wp_add_inline_script('mainjs', 'const ajaxurl = ' . json_encode(admin_url('admin-ajax.php')), 'before');
}
add_action( 'wp_enqueue_scripts', 'cv_corp_scripts' );

// Remove admin bar for all user except admin
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// Redirection after login
function redirect_login_page() {
	$login_page  = home_url( '/login/' );
	$page_viewed = basename($_SERVER['REQUEST_URI']);
   
	if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
	  wp_redirect($login_page);
	  exit;
	}
  }
  add_action('init','redirect_login_page');

  // verification of user
  function login_failed() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . '?login=failed' );
	exit;
  }
  add_action( 'wp_login_failed', 'login_failed' );
   
  function verify_username_password( $user, $username, $password ) {
	$login_page  = home_url( '/login/' );
	  if( $username == "" || $password == "" ) {
		  wp_redirect( $login_page . "?login=empty" );
		  exit;
	  }
  }
  add_filter( 'authenticate', 'verify_username_password', 1, 3);

  //logout if not connected
  function logout_page() {
	$login_page  = home_url( '/login/' );
	wp_redirect( $login_page . "?login=false" );
	exit;
  }
  add_action('wp_logout','logout_page');
 
// access denied
function can_access(){
    $login_page  = home_url( '/login/' );

		//for dashboard
	$page_dashboard = 'template-dashboard.php';
	if (is_page_template($page_dashboard)) {
		if(is_user_logged_in()){
			$role = wp_get_current_user()->roles[0];
			if($role !== 'administrator' && $role !== 'recruiter'){
				wp_redirect( $login_page . "?login=denied" );
				exit;
			}
		} else{
			wp_redirect( $login_page . "?login=false" );
		exit;
		}
	}
	// mon compte
	$page_compte = 'template-compte.php';
	if (is_page_template($page_compte)) {
		if(is_user_logged_in()){
			$role = wp_get_current_user()->roles[0];
			if($role !== 'candidate' && $role !== 'recruiter'){
				wp_redirect( $login_page . "?login=denied" );
				exit;
			}
		} else{
			wp_redirect( $login_page . "?login=false" );
		exit;
		}
	}
	// mes cv
	$page_my_cv = 'template-my-cv.php';
	if (is_page_template($page_my_cv)) {
		if(is_user_logged_in()){
			$role = wp_get_current_user()->roles[0];
			if($role !== 'candidate'){
				wp_redirect( $login_page . "?login=denied" );
				exit;
			}
		} else{
			wp_redirect( $login_page . "?login=false" );
		exit;
		}
	}
	//detail cv
	$page_cv_detail = 'page-cv.php';
	if (is_page_template($page_cv_detail)) {
		if(is_user_logged_in()){
			$role = wp_get_current_user()->roles[0];
			if($role !== 'candidate' && $role !== 'recruiter' && $role !== 'administrator'){
				wp_redirect( $login_page . "?login=denied" );
				exit;
			}
		} else{
			wp_redirect( $login_page . "?login=false" );
		exit;
		}
	}
}
add_action( 'template_redirect', 'can_access' );

require get_template_directory() . '/inc/extra/template-tags.php';
require get_template_directory() . '/inc/extra/template-functions.php';


