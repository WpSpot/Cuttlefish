<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cuttlefish_arrow(); ?>
	<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<div class="entry">
		<?php cuttlefish_postmetatop(); ?>
		<div class="content">
			<?php the_content( '<span class="read-more">' . __( 'Read the rest of this entry', 'cuttlefish' ) . '</span>', false , ''); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cuttlefish' ), 'after' => '</div>' ) ); ?>
		</div>
		<?php cuttlefish_postmetabtm(); ?>
	</div>
</div>