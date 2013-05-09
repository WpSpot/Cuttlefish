<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">

			<?php if ( have_posts() ) : ?>
					<div class="archive-label"><span><?php printf( __( 'Tagged with %s', 'cuttlefish' ), single_tag_title( '', false ) ); ?></span></div>
			<?php endif; ?>

			<?php get_template_part( 'content', 'archive' ); ?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>