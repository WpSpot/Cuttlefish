<?php get_header();?>
<div id="middle">
	<div id="container">
		<div id="posts">

			<?php if ( have_posts() ) : ?>
				<?php $curauth = ( get_query_var( 'author_name' ) ) ? get_user_by( 'slug' , get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); ?>
				<div class="archive-label"><span><?php printf( __( 'Posted by %s', 'cuttlefish' ), $curauth->display_name ); ?></span></div>
				<?php get_template_part( 'content', 'archive' ); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'notfound' ); ?>
			<?php endif; ?>

		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>