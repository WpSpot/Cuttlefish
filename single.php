<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">
			<?php get_template_part( 'content', 'single' ); ?>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
