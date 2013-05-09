<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php cuttlefish_arrow(); ?>
	<h2><?php the_title(); ?></h2>
	<div class="entry">
		<?php cuttlefish_postmetatop(); ?>
		<div class="content"><?php the_content( '', false ); ?></div>
		<?php cuttlefish_wp_link_pages(); ?>
		<?php cuttlefish_postmetabtm(); ?>
	</div>
</div>
<?php comments_template(); ?>
<?php cuttlefish_single_navigation(); ?>