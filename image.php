<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts-attachment">
			<?php the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php cuttlefish_arrow(); ?>
				<h2><?php the_title(); ?></h2>
				<div class="entry">
					<?php cuttlefish_postmetatop(); ?>
					<div class="content">
					<?php
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ));

						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
						}
						$k++;

						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) ) {
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							} else {
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							}
						} else {
							$next_attachment_url = wp_get_attachment_url();
						}
					?>
						<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'full' ); ?></a>

					<?php if ( ! empty( $post->post_excerpt ) ) : ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>

					</div>
					<?php cuttlefish_wp_link_pages(); ?>
					<div class="postmeta-btm"></div>
				</div>
			</div>
			<?php comments_template(); ?>
			<?php cuttlefish_img_navigation(); ?>
		</div>
<?php get_footer(); ?>