<?php get_header(); ?>

<div class="title">
	<h1><?php printf( __( 'Search Results for: %s', 'sonsofcharity' ), '<span>' . get_search_query() . '</span>'); ?></h1>
</div>
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
	<?php if(function_exists('bcn_display'))
	{
		bcn_display();
	}?>
</div>
<div id="content">
	<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>
		<?php get_template_part('blocks/content', get_post_type()); ?>
	<?php endwhile; ?>
	
	<?php get_template_part('blocks/pager'); ?>
	
	<?php else : ?>
		<?php get_template_part('blocks/not_found'); ?>
	<?php endif; ?>
	
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>