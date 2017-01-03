<?php get_header(); ?>
<?php if (have_posts()) : ?>
	<div class="title">
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1><?php printf(__( 'Archive for the &#8216;%s&#8217; Category', 'sonsofcharity' ), single_cat_title('', false)); ?></h1>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>			
		<h1><?php printf(__( 'Posts Tagged &#8216;%s&#8217;', 'sonsofcharity' ), single_tag_title('', false)); ?></h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1><?php _e('Archive for', 'sonsofcharity'); ?> <?php the_time('F jS, Y'); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1><?php _e('Archive for', 'sonsofcharity'); ?> <?php the_time('F, Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1><?php _e('Archive for', 'sonsofcharity'); ?> <?php the_time('Y'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1><?php _e('Author Archive', 'sonsofcharity'); ?></h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1><?php _e('Blog Archives', 'sonsofcharity'); ?></h1>
		<?php } ?>
	</div>
	<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
		<?php if(function_exists('bcn_display'))
		{
			bcn_display();
		}?>
	</div>
<div id="content">
	<div class="post-inner">
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part('blocks/content', get_post_type()); ?>
		<?php endwhile; ?>
	</div>
	
	<?php get_template_part('blocks/pager'); ?>
</div>	
<?php else : ?>
	<div id="content"><?php get_template_part('blocks/not_found'); ?></div>
<?php endif; ?>
	


<?php get_sidebar(); ?>

<?php get_footer(); ?>