<?php
/*
Template Name: Board Template
*/
get_header(); ?>

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
		
		<div class="content"><?php the_content(); ?></div>
		
		<?php edit_post_link( __( 'Edit', 'sonsofcharity' ) ); ?>	
	<?php endwhile; ?>
	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts( array( 'posts_per_page' => 5, 
			'post_type' => 'member',
			'paged' => $paged
		) );
	?>
	<?php if ( have_posts() ) : ?>
		<ul class="members">
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="image">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
				<?php if ( $header = get_field( 'member_position' ) ) : ?>
					<h3><?php echo $header; ?></h3>
				<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		<div class="socials">
			<h3><?php _e('SHARE THIS PAGE', 'sonsofcharity'); ?></h3>
			<span class='st_facebook_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_twitter_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_linkedin_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
			<span class='st_instagram_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
		</div>
		<?php get_template_part('blocks/pager-case_studies'); ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	
</div>
<?php get_sidebar('page'); ?>

<?php get_footer(); ?>