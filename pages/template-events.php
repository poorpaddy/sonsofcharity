<?php
/*
Template Name: Events Template
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
		$currentdate = getdate()[0];
		query_posts( array( 'posts_per_page' => 6, 
			'ignore_sticky_posts' => 1, 
			'post_type' => 'events',
			'meta_query' => array(
					array(
						'key' => 'event_start_date',
						'compare' => '>=',
						'value' => $currentdate,
						'type' => 'numeric',
						)
					),
			'meta_key' => 'event_start_date',
			'orderby' => 'meta_value_num',
			'order'	=> 'ASC'
		) );
	?>
	
	
	
	<?php if ( have_posts() ) : ?>
		<ul class="post-list">
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="image alignleft">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'large' ); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="post-holder">
					<div class="meta">
						<time datetime="<?php the_field('event_start_date') ?>">
							<i class="fa fa-calendar"></i>
							<?php the_field('event_start_date') ?>
						</time>
					</div>
					<h2>
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<?php if ( $text = get_field( 'event_location' ) ) : ?>
						<address><i class="fa fa-map-marker"></i><?php echo $text; ?></address>
					<?php endif; ?>
				</div>
				<div class="text-content"><?php theme_the_excerpt(); ?>
					<a href="<?php the_permalink(); ?>" class="btn btn-yellow-border"><?php _e('Read more', 'sonsofcharity'); ?></a>
				</div>
			</li>
		<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<?php 
	$shortcode = '[ajax_load_more post_type="events" meta_key="event_start_date" meta_value=' . $currentdate . ' meta_compare="&gt;=" order="ASC" orderby="meta_value_num" offset="6" posts_per_page="1" pause="true" scroll="false" button_label="Load More"]';
	echo do_shortcode($shortcode);?>
	
	
</div>

<?php get_footer(); ?>