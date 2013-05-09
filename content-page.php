<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cuttlefish_arrow(); ?>
	<h2><?php the_title(); ?></h2>
	<div class="entry">
		<?php cuttlefish_postmetatop( true ); ?>
		<div class="content"><?php the_content( '', false ); ?></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cuttlefish' ), 'after' => '</div>' ) ); ?>
		<div class="postmeta-btm"></div>
	</div>
</div>
<?php comments_template(); ?>