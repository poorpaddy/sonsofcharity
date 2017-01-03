<?php
/*
Template Name: Contact Template
*/
get_header(); ?>

<?php the_title('<div class="title"><h1>', '</h1></div>'); ?>
	<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
<div id="main">
	<div class="col form">
		<h2><i class="fa fa-envelope-o"></i><?php _e('SEND US A MESSAGE', 'sonsofcharity'); ?></h2>
		<?php while (have_posts()) : the_post(); ?>
		
			<?php the_content(); ?>
			
			<?php edit_post_link( __( 'Edit', 'sonsofcharity' ) ); ?>	
		<?php endwhile; ?>
	</div>
	<div class="col contacts">
		<?php if ( $text = get_field( 'company_address','option' ) ) : ?>
			<address><i class="fa fa-map-marker"></i><?php echo $text; ?></address>
		<?php endif; ?>
		<?php if ( $text = get_field( 'company_tel','option' ) ) : ?>
			<span class="tel"><i class="fa fa-phone"></i><?php echo $text; ?></span>
		<?php endif; ?>
		<?php if ( $text = get_field( 'company_email','option' ) ) : ?>
			<i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $text; ?>" class="email"><?php echo $text; ?></a>
		<?php endif; ?>
		<?php if ( $image = get_field( 'contact_image' ) ) : ?>
			<div class="image">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
		<?php endif; ?>
	</div>
	
</div>

<?php get_footer(); ?>