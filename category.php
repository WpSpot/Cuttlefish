<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">

			<?php if ( have_posts() ) : ?>
				<div class="archive-label"><span><?php printf( __( 'Posted in %s', 'cuttlefish' ), single_cat_title( '', false ) ); ?></span></div>
				<?php get_template_part( 'content', 'archive' ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'notfound' ); ?>
			<?php endif; ?>

		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>