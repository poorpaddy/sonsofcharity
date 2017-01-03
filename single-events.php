<?php get_header(); ?>
<div class="title">
	<h1><?php _e('Upcoming Events', 'sonsofcharity'); ?></h1>
</div>
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
	<?php if(function_exists('bcn_display'))
	{
		bcn_display();
	}?>
</div>
<div id="main">
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<div class="post-holder">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'large' ); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="meta">
					<span class="caption"><?php _e('START', 'sonsofcharity'); ?></span>
					<time>
						<?php the_field('event_start_date') ?>
					</time>
				</div>
				<?php if ( get_field( 'event_end_date' ) ) : ?>
				<div class="meta">
				<span class="caption"><?php _e('END', 'sonsofcharity'); ?></span>
					<time>
						<?php the_field('event_end_date') ?>
					</time>
				</div>
				<?php endif; ?>
				<?php if ( $text = get_field( 'event_location' ) ) : ?>
					<div class="meta">
						<address><i class="fa fa-map-marker"></i><?php echo $text; ?></address>
					</div>
				<?php endif; ?>
				<?php if ( $text = get_field( 'event_tel' ) ) : ?>
					<div class="meta">
						<i class="fa fa-phone"></i></i><?php echo $text; ?>
					</div>
				<?php endif; ?>
				<?php if ( $text = get_field( 'event_email') ) : ?>
					<div class="meta">
						<i class="fa fa-envelope"></i><a href="mailto:<?php echo $text; ?>" class="email"><?php echo $text; ?></a>
					</div>
				<?php endif; ?>
				<?php if ( get_field( 'register_url' ) ) : ?>
					<div class="meta">
						<a href="<?php the_field( 'register_url' ); ?>" class="btn btn-yellow-border" target="<?php the_field( 'register_location' ); ?>"><?php _e('Register Today', 'sonsofcharity'); ?></a>
					</div>
				<?php endif; ?>
				<div class="socials">
					<h3><?php _e('SHARE THIS EVENT', 'sonsofcharity'); ?></h3>
					<span class='st_facebook_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
					<span class='st_twitter_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
					<span class='st_linkedin_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
					<span class='st_instagram_large' st_url='<?php the_permalink(); ?>' st_title='<?php the_title(); ?>'></span>
				</div>
			</div>
			<div class="text-content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</article>
		<?php get_template_part('blocks/pager-event', get_post_type()); ?>
		
	<?php endwhile; ?>
	
	
</div>

<?php get_footer(); ?>