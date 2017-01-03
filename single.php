<?php get_header(); ?>
<div class="title">
	<h1><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>
</div>
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
	<?php if(function_exists('bcn_display'))
	{
		bcn_display();
	}?>
</div>
<div id="content">
	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('blocks/content', get_post_type()); ?>
		<div class="socials">
			<h3><?php _e('SHARE THIS POST', 'sonsofcharity'); ?></h3>
			<span class='st_facebook_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_twitter_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_linkedin_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_instagram_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
		</div>
		<?php get_template_part('blocks/pager-single', get_post_type()); ?>
		
		<?php comments_template(); ?>
		
	<?php endwhile; ?>
	
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>