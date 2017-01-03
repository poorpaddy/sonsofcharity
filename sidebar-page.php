<?php if (is_active_sidebar('page-sidebar')) : ?>
<aside id="sidebar" class="aside">
	<?php dynamic_sidebar('page-sidebar'); ?>	
	<?php if ( get_field( 'donate_button_url','option' ) ) : ?>
		<a href="<?php the_field( 'donate_button_url','option' ); ?>" class="btn btn-yellow"><?php _e('Donate Now', 'sonsofcharity'); ?></a>
	<?php endif; ?>
</aside>
<?php endif; ?>