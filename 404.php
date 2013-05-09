<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">
			<div class="archive-label"><span><?php _e( 'Oops, something is wrong here!', 'cuttlefish' ); ?></span></div>
			<div class="entry">
				<div class="content">
					<p><?php _e( 'The page you are looking for cannot be found. Did you try searching?', 'cuttlefish' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>