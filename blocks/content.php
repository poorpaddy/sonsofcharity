<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="meta">
		<ul>
			<li>
				<time datetime="<?php the_time( 'Y-m-d' ) ?>">
					<i class="fa fa-calendar"></i>
					<?php the_time( 'd M Y' ) ?>
				</time>
			</li>
			<li><i class="fa fa-folder-o"></i> <?php the_category(', ') ?></li>
			<?php if ( is_single() ) : ?>
				<li><i class="fa fa-pencil-square-o"></i><?php the_author(); ?></li>
				<li><i class="fa fa-comment-o"></i><?php comments_popup_link(__('No Comments', 'sonsofcharity'), __('1 Comment', 'sonsofcharity'), __('% Comments', 'sonsofcharity')); ?></li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="post-title">
		<?php if ( is_single() ) :
			the_title( '<h1>', '</h1>' );
		else :
			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</div>
	<div class="content">
		<?php if (is_single()) :
			the_content();
		else:
			theme_the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>"><?php _e('View all', 'sonsofcharity'); ?> &raquo;</a>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'sonsofcharity' ), '<div>', '</div>' ); ?>
	</div>
	<?php wp_link_pages(); ?>
</article>
