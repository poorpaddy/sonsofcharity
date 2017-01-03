<?php get_header(); ?>
<div class="title">
	<h1><?php 
		$parent_title = get_the_title( $post->post_parent );
		echo $parent_title; 
	?></h1>
</div>
	<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
<div id="content">
	<?php if ( $parent_title != the_title( '', '', false ) ) {
		echo '<h2>' . the_title( '', '', false ) . '</h2>';
	} ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<?php the_content(); ?>
		
		<?php edit_post_link( __( 'Edit', 'sonsofcharity' ) ); ?>	
	<?php endwhile; ?>
	<div class="socials">
		<h3><?php _e('SHARE THIS Page', 'sonsofcharity'); ?></h3>
		<span class='st_facebook_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
		<span class='st_twitter_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
		<span class='st_linkedin_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
		<span class='st_instagram_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
	</div>
	
	<?php wp_link_pages(); ?>
	
	<?php comments_template(); ?>
	<?php get_template_part('blocks/pager-single', get_post_type()); ?>
	
</div>

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>