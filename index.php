<?php get_header(); ?>
<div id="middle">
	<div id="container">
		<div id="posts">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				<?php cuttlefish_posts_navigation(); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'notfound' ); ?>
			<?php endif; ?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>