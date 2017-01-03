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

	<?php if (have_posts()) : ?>

		<div class="post-inner">
			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('blocks/content', get_post_type()); ?>
			<?php endwhile; ?>
		</div>
		
		<?php get_template_part('blocks/pager'); ?>
	
	<?php else : ?>
		<?php get_template_part('blocks/not_found'); ?>
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>