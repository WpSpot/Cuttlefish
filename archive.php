<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">

			<?php if ( have_posts() ) : ?>
				<?php if ( is_month() ) { ?>
					<div class="archive-label"><span><?php printf( __( '%s Archive', 'cuttlefish' ), get_the_time( 'F, Y' ) ); ?></span></div>
				<?php } elseif ( is_day() ) { ?>
					<div class="archive-label"><span><?php printf( __( '%s Archive', 'cuttlefish' ), get_the_time( 'F jS, Y' ) ); ?></span></div>
				<?php } elseif ( is_year() ) { ?>
					<div class="archive-label"><span><?php printf( __( '%s Archive', 'cuttlefish' ), get_the_time( 'Y' ) ); ?></span></div>
				<?php } ?>
				<?php get_template_part( 'content', 'archive' ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'notfound' ); ?>
			<?php endif; ?>

		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>