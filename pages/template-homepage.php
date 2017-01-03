<?php
/*
Template Name: Homepage Template
*/
get_header(); ?>
<?php putRevSlider( 'gallery1' ) ?>
<div id="main">
	<a href="#main" class="skip-to-content"><i class="fa fa-angle-down"></i></a>
	<div class="holder">
		<?php while (have_posts()) : the_post(); ?>
		<article class="post" id="post-<?php the_ID(); ?>">
			<div class="content">
				<?php the_content(); ?>	
				<div class="caption">
					<?php if ( $header = get_field( 'gallery_title' ) ) : ?>
						<h2><?php echo $header; ?></h2>
					<?php endif; ?>
					<?php if ( get_field( 'donate_button_url','option' ) ) : ?>
						<a href="<?php the_field( 'donate_button_url','option' ); ?>" class="btn btn-yellow"><?php _e('Donate Now', 'sonsofcharity'); ?></a>
					<?php endif; ?>
					<?php if ( get_field( 'join_button_url' ) ) : ?>
						<a href="<?php the_field( 'join_button_url' ); ?>" class="btn"><?php _e('OR JOIN US', 'sonsofcharity'); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php edit_post_link( __( 'Edit', 'sonsofcharity' ) ); ?>
		</article>
		<?php endwhile; ?>
		<article class="about-us">
			<?php if ( $visual = get_field( 'about_visual' ) ) : ?>
				<div class="alignleft"><?php echo $visual; ?></div>
			<?php endif; ?>
			<div class="text"><?php if ( $content = get_field( 'about_text' ) ) : ?>
					<?php echo $content; ?>
				<?php endif; ?>
				<?php if ( get_field( 'about_button_url' ) &&  $linktext = get_field( 'about_button_text' )) : ?>
					<a href="<?php the_field( 'about_button_url' ); ?>" class="btn btn-blue-border"><?php echo $linktext; ?></a>
				<?php endif; ?>
			</div>
		</article>
	</div>
	<?php query_posts( array( 'posts_per_page' => 10, 'ignore_sticky_posts' => 1, 'post_type' => 'partner' ) );
		?>
		<?php if ( have_posts() ) : ?>
		<div class="grey-block">
			<div class="holder hasActive">
				<h2><?php _e('OUR COMMUNITY PARTNERS', 'sonsofcharity'); ?></h2>
				<ul id="content-slider" class="gallery content-slider cS-hidden">
					<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<?php if ( get_field( 'partner_url' ) ) : ?>
							<a href="<?php the_field( 'partner_url' ); ?>" target="_blank">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'medium' ); ?>
								<?php endif; ?>
								<?php the_title('<div class="partnername">', '</div>'); ?>
							</a>
						<?php endif; ?>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	<div class="holder">
		<div class="col events">
		<?php
			$currentdate = getdate()[0];
			query_posts( array( 'posts_per_page' => 3, 
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
				'order'	=> 'ASC',
				'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 )
			) );
		?>
		<?php if ( have_posts() ) : $i = 0; ?>
			<div class="heading">
				<h2><?php _e('LATEST Events', 'sonsofcharity'); ?></h2>
				<a href="<?php echo get_page_link(76); ?>" class="alignright"><?php _e('View all', 'sonsofcharity'); ?> &raquo;</a>
			</div>
			<ul class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li <?php if ( $i == 0 ) : ?> class="first" <?php endif; ?>>
						<div class="common"><?php if ( has_post_thumbnail() ) : ?>
								<div class="image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium' ); ?>
									</a>
								</div>
								<?php endif; ?>
								<div class="post-holder">
								<div class="meta">
									<time>
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
								<?php endif; ?></div>
						</div>
						<div class="text-content"><?php if ( $i == 0 ) theme_the_excerpt(); ?>
							<?php if ( $i == 0 ) : ?>  <a href="<?php the_permalink(); ?>" class="btn btn-yellow"><?php _e('Read more', 'sonsofcharity'); ?></a> <?php endif; ?>
						</div>
					</li>
				<?php $i++; endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
		<div class="col news">
		<?php
			query_posts( array( 'posts_per_page' => 4, 'ignore_sticky_posts' => 1 ) );
		?>
		<?php if ( have_posts() ) : ?>
			<div class="heading">
				<h2><?php _e('LATEST NEWS', 'sonsofcharity'); ?></h2>
				<a href="<?php echo get_page_link(21); ?>" class="alignright"><?php _e('View all', 'sonsofcharity'); ?> &raquo;</a>
			</div>
			<ul class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="image alignleft">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="post-holder">
							<div class="meta">
								<time datetime="<?php the_time( 'Y-m-d' ) ?>">
									<i class="fa fa-calendar"></i>
									<?php the_time( 'd M Y' ) ?>
								</time>
								<span class="categories">
									<i class="fa fa-folder-o"></i>
									<?php echo strip_tags( get_the_category_list( ', ' ) ); ?>
								</span>
							</div>
							<h2>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<?php theme_the_excerpt(); ?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>