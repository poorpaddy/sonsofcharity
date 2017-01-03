		</div></div>
		<footer id="footer">
			<a href="#header" class="back-to-top"><i class="fa fa-angle-up"></i></a>
			<div class="holder">
				<div class="alignleft">
					<div class="col">
						<h3><?php _e('About Us', 'sonsofcharity'); ?></h3>
						<?php if(has_nav_menu('footer1'))
						wp_nav_menu( array('container'       => '',
						'container_class' => false,
						'theme_location' => 'footer1',
						'menu_class' => 'footer-nav',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker' => new Custom_Walker_Nav_Menu) ); ?>
					</div>
					<div class="col">
						<h3><?php _e('Get Involved', 'sonsofcharity'); ?></h3>
						<?php if(has_nav_menu('footer2'))
						wp_nav_menu( array('container'       => '',
						'container_class' => false,
						'theme_location' => 'footer2',
						'menu_class' => 'footer-nav',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'walker' => new Custom_Walker_Nav_Menu) ); ?>
						<?php if ( get_field( 'donate_button_url','option' ) ) : ?>
							<a href="<?php the_field( 'donate_button_url','option' ); ?>" class="btn btn-yellow"><?php _e('Donate Now', 'sonsofcharity'); ?></a>
						<?php endif; ?>
					</div>
					<div class="col">
						<h3><?php _e('Contact', 'sonsofcharity'); ?></h3>
						<?php if ( $text = get_field( 'company_address','option' ) ) : ?>
							<address><i class="fa fa-map-marker"></i><?php echo $text; ?></address>
						<?php endif; ?>
						<?php if ( $text = get_field( 'company_email','option' ) ) : ?>
							<i class="fa fa-envelope-o"></i><a href="mailto:<?php echo $text; ?>" class="email"><?php echo $text; ?></a>
						<?php endif; ?>
					</div>
				</div>
				<div class="alignright">
					<h3><?php _e('GET CONNECTED', 'sonsofcharity'); ?></h3>
					<div class="social">
						<?php if ( get_field( 'facebook_url','option' ) ) : ?>
							<a href="<?php the_field( 'facebook_url','option' ); ?>" class="btn btn-yellow"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						<?php if ( get_field( 'twitter_url','option' ) ) : ?>
							<a href="<?php the_field( 'twitter_url','option' ); ?>" class="btn btn-yellow"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						<?php if ( get_field( 'linkedin_url','option' ) ) : ?>
							<a href="<?php the_field( 'linkedin_url','option' ); ?>" class="btn btn-yellow"><i class="fa fa-linkedin"></i></a>
						<?php endif; ?>
						<?php if ( get_field( 'instagram_url','option' ) ) : ?>
							<a href="<?php the_field( 'instagram_url','option' ); ?>" class="btn btn-yellow"><i class="fa fa-instagram"></i></a>
						<?php endif; ?>
					</div>
					<p>&copy; <?php echo date('Y') ?> <?php bloginfo('name'); ?>, <?php _e('Inc. All rights reserved. Site crafted by CMS Code, Inc.', 'sonsofcharity'); ?></p>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>