<?php

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	?> <p><?php _e('This post is password protected. Enter the password to view comments.', 'sonsofcharity'); ?></p> <?php
	return;
}
	
function theme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
	<div class="commentlist-item">
		<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<div class="avatar-holder"><?php echo get_avatar( $comment, 48 ); ?></div>
			<div class="commentlist-holder">
				<span class="name"><?php comment_author_link(); ?></span>
				<?php edit_comment_link( __( '(Edit)', 'sonsofcharity'), '<p class="edit-link">', '</p>' ); ?>
				<p class="meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php comment_date('F d, Y'); ?> <?php _e('at', 'sonsofcharity'); ?> <?php comment_time('g:i a'); ?></a>
				<?php
					comment_reply_link(array_merge( $args, array(
						'reply_text' => __('Reply', 'sonsofcharity'),
						'before' => '<span>',
						'after' => '</span>',
						'depth' => $depth,
						'max_depth' => $args['max_depth']
				))); ?></span>
				</p>
				<?php if ($comment->comment_approved == '0') : ?>
				<p><?php _e('Your comment is awaiting moderation.', 'sonsofcharity'); ?></p>
				<?php else: ?>
				<?php comment_text(); ?>
				<?php endif; ?>
			</div>
		</div>
	<?php }
	
	function theme_comment_end() { ?>
		</div>
	<?php }
?>

<?php if ( have_comments() ) : ?>

<div class="section comments"  id="comments">

	<h2><?php comments_number(__('No Comments', 'sonsofcharity'), __('1 Comment', 'sonsofcharity'), __('% Comments', 'sonsofcharity') );?></h2>

	<div class="commentlist">
		<?php wp_list_comments(array(
			'callback' => 'theme_comment',
			'end-callback' => 'theme_comment_end',
			'style' => 'div'
		)); ?>
	</div>

</div>

<?php endif; ?>
 

<?php if ( comments_open() ) : ?>

<div class="section respond">
	<?php
		$fields =  array(
			'author' => '<div class="fields"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . _x( 'Your name(required)', 'noun' ) . '" />',
			'email'  => '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . _x( 'Your e-mail(required)', 'noun' ) . '" /></div>',
			'url'    => '',
		); 
		$args = array(
				'fields' => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Your comment(required)', 'noun' ) . '"></textarea></p>',
				'title_reply' => __( 'Leave a Comment' )
				,'title_reply_to' => __( 'Leave a Reply to %s' ) 
				,'cancel_reply_link' => __( 'Cancel reply' ) 
				,'label_submit' => __( 'Submit' )
				,'comment_notes_after' => ''
			);
			comment_form( $args ); 
	?>
</div>

<?php else : ?>

	<?php if (is_singular(array('post'))) : ?>
	<p><?php _e('Comments are closed.', 'sonsofcharity'); ?></p>
	<?php endif; ?>
	
<?php endif; ?>