<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cuttlefish_arrow(); ?>
	<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<div class="entry">
		<?php cuttlefish_postmetatop(); ?>
		<div class="content">
			<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
			if ( $images ) :
				$total_images = count( $images );
				$image = array_shift( $images );
				$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
				<div class="gallery-thumb">
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</div>
				<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'cuttlefish' ),
					'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'cuttlefish' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
					$total_images ); ?></em></p>
			<?php endif; ?>
			<?php the_excerpt(); ?>
			<?php cuttlefish_wp_link_pages(); ?>
		</div>
		<?php cuttlefish_postmetabtm(); ?>
	</div>
</div>