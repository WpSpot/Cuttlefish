<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">
			<?php if ( have_posts() ) : ?>
				<div class="archive-label"><span><?php printf( __( 'Search Results for "%s"', 'cuttlefish' ), get_search_query() ); ?></span></div>
				<?php get_template_part( 'content', 'archive' ); ?>
			<?php else : ?>
				<div class="archive-label"><span><?php printf( __( 'Nothing Found for "%s"', 'cuttlefish' ), get_search_query() ); ?></span></div>
				<div class="entry">
					<div class="content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'cuttlefish' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>