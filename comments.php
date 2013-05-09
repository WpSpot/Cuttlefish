<div class="comments" id="comments">
	<?php if ( post_password_required() ) : ?>
</div>
<?php
		return;
	endif;
?>
	<?php if ( have_comments() ) : ?>
		<?php cuttlefish_arrow(); ?>

		<h3 id="comments-header">
			<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'cuttlefish' ),
				get_comments_number(), get_the_title() ); ?>
		</h3>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'cuttlefish_comment', 'type' => 'all' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<?php cuttlefish_comment_navigation(); ?>
		<?php endif; ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'cuttlefish' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>