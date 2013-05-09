<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cuttlefish_arrow(); ?>
	<h2><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<div class="entry">
		<?php cuttlefish_postmetatop(); ?>
		<div class="content">
			<?php the_content( cuttlefish_more_link_text(), false ); ?>
			<?php cuttlefish_wp_link_pages(); ?>
		</div>
		<?php cuttlefish_postmetabtm(); ?>
	</div>
</div>