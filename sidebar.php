<div id="sidebar">
	<ul>
		<?php if ( !dynamic_sidebar( 'right-sidebar' ) ) : ?>
		<li class="widget widget_search">
			<h2><span><?php _e( 'Search', 'cuttlefish' ); ?></span></h2>
			<?php get_search_form(); ?>
		</li>
		<li class="widget widget_pages">
			<h2><span><?php _e( 'Pages', 'cuttlefish' ); ?></span></h2>
			<ul><?php wp_list_pages('title_li='); ?></ul>
		</li>
		<li class="widget widget_categories">
			<h2><span><?php _e( 'Categories', 'cuttlefish' ); ?></span></h2>
			<ul><?php wp_list_categories('title_li='); ?></ul>
		</li>
		<?php wp_list_bookmarks(
			array( 'title_before' => '<h2><span>', 'title_after'  => '</span></h2>' ) ); ?>
		<li class="widget widget_tag_cloud">
			<h2><span><?php _e( 'Tags', 'cuttlefish' ); ?></span></h2>
			<div class="tagcloud"><?php wp_tag_cloud(); ?></div>
		</li>
		<li class="widget widget_archive">
			<h2><span><?php _e( 'Archives', 'cuttlefish' ); ?></span></h2>
			<ul><?php wp_get_archives('type=monthly'); ?></ul>
		</li>
		<li class="widget widget_meta">
			<h2><span><?php _e( 'Meta', 'cuttlefish' ); ?></span></h2>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</li>
		<?php endif; ?>
	</ul>
	<ul>
		<li class="foot" >&nbsp;</li>
	</ul>
</div>