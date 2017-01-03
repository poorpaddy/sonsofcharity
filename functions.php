<?php

//Staging restrictions
if (file_exists(sys_get_temp_dir().'/staging-restrictions.php')) {
	define('STAGING_RESTRICTIONS', true);
	require_once sys_get_temp_dir().'/staging-restrictions.php';
}

include( get_template_directory() .'/classes.php' );
include( get_template_directory() .'/widgets.php' );

add_action('themecheck_checks_loaded', 'theme_disable_cheks');
function theme_disable_cheks() {
	$disabled_checks = array('TagCheck');
	global $themechecks;
	foreach ($themechecks as $key => $check) {
		if (is_object($check) && in_array(get_class($check), $disabled_checks)) {
			unset($themechecks[$key]);
		}
	}
}

add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 900;

remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'theme_localization' );
function theme_localization () {
	load_theme_textdomain( 'sonsofcharity', get_template_directory() . '/languages' );
}


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'default-sidebar',
		'name' => __('Default Sidebar', 'sonsofcharity'),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	));
	register_sidebar(array(
		'id' => 'page-sidebar',
		'name' => __('Page Sidebar', 'sonsofcharity'),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	));
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999, true );
}

register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'sonsofcharity' ),
	'footer1' => __( 'Footer About Us Navigation', 'sonsofcharity' ),
	'footer2' => __( 'Footer Get Involved Navigation', 'sonsofcharity' ),
) );


//Add [email]...[/email] shortcode
function shortcode_email($atts, $content) {
	$result = '';
	for ($i=0; $i<strlen($content); $i++) {
		$result .= '&#'.ord($content{$i}).';';
	}
	return $result;
}
add_shortcode('email', 'shortcode_email');

//Register tag [template-url]
function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

//Register tag [site-url]
function filter_site_url($text) {
	return str_replace('[site-url]',get_bloginfo('url'), $text);
}
add_filter('the_content', 'filter_site_url');
add_filter('get_the_content', 'filter_site_url');
add_filter('widget_text', 'filter_site_url');

//Replace standard wp menu classes
function change_menu_classes($css_classes) {
	return str_replace(array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor'), 'active', $css_classes);
}
add_filter('nav_menu_css_class', 'change_menu_classes');

//Replace standard wp body classes and post classes
function theme_body_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'body-class-' . $classes[$key];
		}
	}
	
	return $classes;
}
add_filter('body_class', 'theme_body_class', 9999);

function theme_post_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'post-class-' . $classes[$key];
		}
	}
	
	return $classes;
}
add_filter('post_class', 'theme_post_class', 9999);

//Allow tags in category description
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) {
    remove_filter($filter, 'wp_filter_kses');
}


//Make wp admin menu html valid
function wp_admin_bar_valid_search_menu( $wp_admin_bar ) {
	if ( is_admin() )
		return;

	$form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch"><div>';
	$form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search', 'sonsofcharity') . '"/>';
	$form .= '</div></form>';

	$wp_admin_bar->add_menu( array(
		'parent' => 'top-secondary',
		'id'     => 'search',
		'title'  => $form,
		'meta'   => array(
			'class'    => 'admin-bar-search',
			'tabindex' => -1,
		)
	) );
}

function fix_admin_menu_search() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
	add_action( 'admin_bar_menu', 'wp_admin_bar_valid_search_menu', 4 );
}

add_action( 'add_admin_bar_menus', 'fix_admin_menu_search' );

//Disable comments on pages by default
function theme_page_comment_status($post_ID, $post, $update) {
	if (!$update) {
		remove_action('save_post_page', 'theme_page_comment_status', 10);
		wp_update_post(array(
			'ID' => $post->ID,
			'comment_status' => 'closed',
		));
		add_action('save_post_page', 'theme_page_comment_status', 10, 3);
	}
}
add_action('save_post_page', 'theme_page_comment_status', 10, 3);

//custom excerpt
function theme_the_excerpt() {
	global $post;
	
	if (trim($post->post_excerpt)) {
		the_excerpt();
	} elseif (strpos($post->post_content, '<!--more-->') !== false) {
		the_content();
	} else {
		the_excerpt();
	}
}

/* advanced custom fields settings*/

//theme options tab in appearance
if(function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page(array(
		'title' => 'Theme Options',
		'parent' => 'themes.php',
	));
}

//theme password form
function theme_get_the_password_form() {
 $post = get_post( $post );
 $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
 $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
 <p>' . __( 'This content is password protected. To view it please enter your password below:' ) . '</p>
 <p><label for="' . $label . '">' . __( 'Password:' ) . '</label> <input name="post_password" id="' . $label . '" type="password" size="20" /> <input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" /></p></form>
 ';
 return $output;
}
add_filter( 'the_password_form', 'theme_get_the_password_form' );

//acf theme functions placeholders
if(!class_exists('acf') && !is_admin()) {
	function get_field_reference( $field_name, $post_id ) {return '';}
	function get_field_objects( $post_id = false, $options = array() ) {return false;}
	function get_fields( $post_id = false) {return false;}
	function get_field( $field_key, $post_id = false, $format_value = true )  {return false;}
	function get_field_object( $field_key, $post_id = false, $options = array() ) {return false;}
	function the_field( $field_name, $post_id = false ) {}
	function have_rows( $field_name, $post_id = false ) {return false;}
	function the_row() {}
	function reset_rows( $hard_reset = false ) {}
	function has_sub_field( $field_name, $post_id = false ) {return false;}
	function get_sub_field( $field_name ) {return false;}
	function the_sub_field($field_name) {}
	function get_sub_field_object( $child_name ) {return false;}
	function acf_get_child_field_from_parent_field( $child_name, $parent ) {return false;}
	function register_field_group( $array ) {}
	function get_row_layout() {return false;}
	function acf_form_head() {}
	function acf_form( $options = array() ) {}
	function update_field( $field_key, $value, $post_id = false ) {return false;}
	function delete_field( $field_name, $post_id ) {}
	function create_field( $field ) {}
	function reset_the_repeater_field() {}
	function the_repeater_field($field_name, $post_id = false) {return false;}
	function the_flexible_field($field_name, $post_id = false) {return false;}
	function acf_filter_post_id( $post_id ) {return $post_id;}
}
function my_acf_save_post( $post_id ) {
    
    // Set the date time field name
    // change with the field key if it doesn't work
    $date_time_field_name = 'event_start_date';
    
    // get the saved date time value
    $datetime = get_field($date_time_field_name, $post_id, false);
    
    // if it exists
    if( $datetime ){
        
        // convert it to timestamp
        $datetime_timestamp = strtotime($datetime);
        
        // Update the value in the database
        update_field( $date_time_field_name, $datetime_timestamp, $post_id );
        
    }
    
}

// run after ACF saves the $_POST['acf'] data
add_action('acf/save_post', 'my_acf_save_post', 20);

/*function my_scripts_method() {
    wp_register_script( 'jquery' );
    wp_enqueue_script( 'jquery' );
}    
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );*/

function new_excerpt_more($more) {
    global $post;
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('the_content_more_link', 'new_excerpt_more');

function create_post_type() {
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Events' ),
		'new_item' => __( 'New Event' ),
		'add_new_item' => __( 'Add New Event' )
      ),
      'public' => true,
	  'has_archive' => true,
	  'rewrite' => array('slug' => 'events'),
	  'supports' => array('title','thumbnail','editor','custom-fields','excerpt' )
    )
  );
  register_post_type( 'case_study',
    array(
      'labels' => array(
        'name' => __( 'Case Studies' ),
        'singular_name' => __( 'Case Study' ),
		'new_item' => __( 'New Case Study' ),
		'add_new_item' => __( 'Add New Case Study' )
      ),
      'public' => true,
	  'has_archive' => true,
	  'rewrite' => array('slug' => 'case_study'),
	  'supports' => array('title','thumbnail','editor','custom-fields','excerpt' )
    )
  );
  register_post_type( 'member',
    array(
      'labels' => array(
        'name' => __( 'Members' ),
        'singular_name' => __( 'Member' ),
		'new_item' => __( 'New Member' ),
		'add_new_item' => __( 'Add New Member' )
      ),
      'public' => true,
	  'has_archive' => true,
	  'rewrite' => array('slug' => 'member'),
	  'supports' => array('title','thumbnail','editor','custom-fields','excerpt' )
    )
  );
  register_post_type( 'partner',
    array(
      'labels' => array(
        'name' => __( 'Partners' ),
        'singular_name' => __( 'Partner' ),
		'new_item' => __( 'New Partner' ),
		'add_new_item' => __( 'Add New Partner' )
      ),
      'public' => true,
	  'has_archive' => true,
	  'rewrite' => array('slug' => 'partner'),
	  'supports' => array('title','thumbnail','editor','custom-fields','excerpt' )
    )
  );
}
add_action( 'init', 'create_post_type' );

function create_my_taxonomies() {
    register_taxonomy(
        'member_category',
        'member',
        array(
            'labels' => array(
                'name' => 'Member Category',
                'add_new_item' => 'Add New Member Category',
                'new_item_name' => "New Member Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true,
			'rewrite' => array('slug' => 'members')
        )
    );
}
add_action( 'init', 'create_my_taxonomies', 0 );

/**
 * Remove shipping name from the label in Cart and Checkout pages
 */
add_filter( 'woocommerce_cart_shipping_method_full_label', 'wc_custom_shipping_labels', 10, 2 );
function wc_custom_shipping_labels( $label, $method ) {
    if ( $method->cost > 0 ) {
        if ( WC()->cart->tax_display_cart == 'excl' ) {
            $label = wc_price( $method->cost );
            if ( $method->get_shipping_tax() > 0 && WC()->cart->prices_include_tax ) {
                $label .= ' <small>' . WC()->countries->ex_tax_or_vat() . '</small>';
            }
        } else {
            $label = wc_price( $method->cost + $method->get_shipping_tax() );
            if ( $method->get_shipping_tax() > 0 && ! WC()->cart->prices_include_tax ) {
                $label = ' <small>' . WC()->countries->inc_tax_or_vat() . '</small>';
            }
        }
    }

    return $label;
}