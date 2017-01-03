<?php
/*
Template Name: Partners Template
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
<?php
		query_posts( array( 'posts_per_page' => 5, 
			'post_type' => 'partner'
		) );
	?>
	
	
	
	<?php if ( have_posts() ) : ?>
		<ul class="post-list">
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="image alignleft">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
				<?php endif; ?>
				<div class="post-holder">
					<h2><?php the_title(); ?></h2>
					<?php if ( $text = get_field( 'partner_location' ) ) : ?>
						<address><i class="fa fa-map-marker"></i><?php echo $text; ?></address>
					<?php endif; ?>
				</div>
				<div class="text-content">
					<?php theme_the_excerpt(); ?>
					<?php if ( get_field( 'partner_url' ) ) : ?>
						<a href="<?php the_field( 'partner_url' ); ?>" class="btn btn-blue"><?php _e('Visit Site', 'sonsofcharity'); ?></a>
					<?php endif; ?>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<?php 
	$shortcode = '[ajax_load_more post_type="partner" offset="5" posts_per_page="1" pause="true" scroll="false" button_label="Load More"]';
	echo do_shortcode($shortcode);?>
	
	
</div>

<?php get_footer(); ?>