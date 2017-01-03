<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width">
		<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style.css"  />
		
		<script type="text/javascript">
			var pathInfo = {
				base: '<?php echo get_template_directory_uri(); ?>/',
				css: 'css/',
				js: 'js/',
				swf: 'swf/',
			}
		</script>
		
		<?php if ( is_singular() ) wp_enqueue_script( 'theme-comment-reply', get_template_directory_uri()."/js/comment-reply.js" ); ?>
		
		<?php wp_head(); ?>
		<?php wp_enqueue_script( 'theme-comment-main-js', get_template_directory_uri()."/js/jquery.main.js" ); ?>
		<?php wp_enqueue_script( 'theme-lightslider-plugin-js', get_template_directory_uri()."/js/lightslider.js" ); ?>
		<script type="text/javascript">
			jQuery.noConflict();
			jQuery( document ).ready(function( $ ) {

				var autoplaySlider = $('#content-slider').lightSlider({
				    item:3,
				    auto:true,
				    loop:true,
				    slideMove:2,
				    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
				    speed:5000,
				    pause:7000,
				    controls: false,
				    enableTouch: false,
				    enableDrag: false,
				    freeMove: false,

				    pager: false,
				    responsive : [
				        {
				            breakpoint:768,
				            settings: {
				                item:3,
				                slideMove:1,
				                slideMargin:6,
				              }
				        },
				        {
				            breakpoint:600,
				            settings: {
				                item:2,
				                slideMove:1
				              }
				        }
				    ],
				    onSliderLoad: function() {
				        $('#content-slider').removeClass('cS-hidden');
				    }
				});
				setTimeout(function () {
				    autoplaySlider.play();
				}, 2000);
				$('#content-slider').parent().on('mouseenter',function(){
				    autoplaySlider.pause();
				});
				$('#content-slider').parent().on('mouseleave',function(){
				    autoplaySlider.play();
				});
			});
		</script>
	</head>
	<body <?php body_class(); ?>>
	<div id="wrapper">
		
		
			<header id="header">
				<div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a></div>
				<?php if ( get_field( 'donate_button_url','option' ) ) : ?>
					<a href="<?php the_field( 'donate_button_url','option' ); ?>" class="btn btn-yellow alignright"><?php _e('Donate Now', 'sonsofcharity'); ?></a>
				<?php endif; ?>
				
				<?php if(has_nav_menu('primary'))
							wp_nav_menu( array('container' => 'nav',
		'theme_location' => 'primary',
		'menu_id' => 'navigation',
		'menu_class' => 'navigation',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'walker' => new Custom_Walker_Nav_Menu) ); ?></header><div id="container">