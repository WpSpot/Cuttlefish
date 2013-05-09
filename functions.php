<?php
if ( ! isset( $content_width ) )
	$content_width = 518;

add_action( 'after_setup_theme', 'cuttlefish_setup' );

if ( ! function_exists( 'cuttlefish_setup' ) ):
function cuttlefish_setup() {
	add_theme_support( 'post-formats', array( 'gallery' ) );

	add_theme_support( 'automatic-feed-links' );

	load_theme_textdomain( 'cuttlefish', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}
	
	// Load up Cuttlefish options page and related code.
	require( get_template_directory() . '/options/theme-options.php' );

	add_editor_style();

	register_nav_menu( 'primary', __( 'Primary Menu', 'cuttlefish' ) );
}
endif;

function cuttlefish_widgets_init() {
	register_sidebar(
		array(
			'name'         => __( 'Right Sidebar', 'cuttlefish' ),
			'id'           => __( 'right-sidebar', 'cuttlefish' ),
			'description'  => __( 'Widgets in this area will be shown on the right-hand side.', 'cuttlefish' ),
			'before_title' => '<h2><span>',
			'after_title'  => '</span></h2>'
		)
	);
}
add_action( 'widgets_init', 'cuttlefish_widgets_init' );

function cuttlefish_scripts() {
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cuttlefish_scripts');

if ( ! function_exists( 'cuttlefish_image_dir_uri' ) ) :
function cuttlefish_image_dir_uri() {
	return get_stylesheet_directory_uri() . '/images';
}
endif;

if ( ! function_exists( 'cuttlefish_color_scheme_image_dir_uri' ) ) :
function cuttlefish_color_scheme_image_dir_uri() {
	$options = cuttlefish_get_theme_options();
	$color_scheme = $options['option_color_scheme'];
	
	if ( $color_scheme != 'default' ) {
		return get_template_directory_uri() . "/options/schemes/$color_scheme/images";
	}
	
	return cuttlefish_image_dir_uri();
}
endif;

if ( ! function_exists( 'cuttlefish_color_scheme_screenshot_uri' ) ) :
function cuttlefish_color_scheme_screenshot_uri( $color_scheme ) {
	if ( $color_scheme == 'default' ) {
		return get_template_directory_uri() . '/screenshot.png';
	}
	return get_template_directory_uri() . "/options/schemes/$color_scheme/screenshot.png";
}
endif;

if ( ! function_exists( 'cuttlefish_wp_nav_menu' ) ) :
function cuttlefish_wp_nav_menu() {
	return wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container_class' => 'menu',
			'items_wrap' => '<ul id="%1$s">%3$s</ul>',
			'echo' => 0,
			'depth' => 0
		)
	);
}
endif;

function cuttlefish_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'cuttlefish_page_menu_args' );

if ( ! function_exists( 'cuttlefish_comment' ) ) :
function cuttlefish_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' : ?>
			<li class="pingback"><p><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cuttlefish' ), ' ' ); ?></p><?php
			break;
		default : ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">

			<div class="comment-top">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 32 ); ?>
					<span><?php printf( '%s', get_comment_author_link() ); ?></span>
				</div>

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'cuttlefish' ), get_comment_date(), get_comment_time() ); ?></a>
					<?php edit_comment_link( __( '(Edit)', 'cuttlefish' ), ' ' ); ?>
				</div>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Your comment is awaiting moderation.', 'cuttlefish' ); ?></em><br />
			<?php endif; ?>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply"><?php
				$reply_link = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
				if ( $reply_link ) : ?>
					<span><img src="<?php echo cuttlefish_image_dir_uri(); ?>/comments.png" alt="" /></span>
					<?php echo $reply_link; ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
			break;
	endswitch;
}
endif;

if ( ! function_exists( 'cuttlefish_postmetatop' ) ) :
function cuttlefish_postmetatop( $page = false ) { ?>
	<div class="postmeta-top">
		<?php if ( ! $page && 'post' == get_post_type() ) : ?>
			<?php printf( __( 'Posted by %s on', 'cuttlefish' ), '<a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '">' . get_the_author() . '</a>'); ?>
			<img src="<?php echo cuttlefish_color_scheme_image_dir_uri(); ?>/calendar.png" alt=""/><a href="<?php echo get_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
		<?php endif; ?>
		<?php edit_post_link( __( '(Edit Page)', 'cuttlefish' ), ' '); ?>
		<?php if ( comments_open() ) : ?>
			<span>
				<img src="<?php echo cuttlefish_image_dir_uri(); ?>/comments.png" alt="" />
				<a href="<?php comments_link(); ?>"><?php comments_number( __( 'No comments', 'cuttlefish' ), __( 'One comment', 'cuttlefish' ), __( '% comments', 'cuttlefish' ) ); ?></a>
			</span>
		<?php endif; ?>
	</div><?php
}
endif;

if ( ! function_exists( 'cuttlefish_postmetabtm' ) ) :
function cuttlefish_postmetabtm() { ?>
	<div class="postmeta-btm">
		<div class="post-meta-item"><img src="<?php echo cuttlefish_image_dir_uri(); ?>/category.png" alt="" /><?php _e( 'Categories', 'cuttlefish' ); ?>: <?php the_category( ', ' ); ?>.</div>
		<?php if ( get_the_tags() ) : ?>
			<div class="post-meta-item"><img src="<?php echo cuttlefish_image_dir_uri(); ?>/tag.png" alt="" /><?php the_tags(); ?>.</div>
		<?php endif; ?>
	</div><?php
}
endif;

if ( ! function_exists( 'cuttlefish_posts_navigation' ) ) :
function cuttlefish_posts_navigation() {
	if ( get_next_posts_link() || get_previous_posts_link() ) { ?>
		<div class="pnavigation">
			<div class="nprev"><?php next_posts_link( __( '&nbsp;&laquo; Previous Posts', 'cuttlefish' ) ); ?></div>
			<div class="nnext"><?php previous_posts_link( __( 'Next Posts &raquo;&nbsp;', 'cuttlefish' ) ); ?></div>
		</div><?php
	}
}
endif;

if ( ! function_exists( 'cuttlefish_single_navigation' ) ) :
function cuttlefish_single_navigation() { ?>
	<div class="pnavigation">
		<div class="nprev"><?php previous_post_link( '%link', __( '&nbsp;&laquo; Previous Post', 'cuttlefish' )); ?></div>
		<div class="nnext"><?php next_post_link( '%link', __( 'Next Post &raquo;&nbsp;', 'cuttlefish' )); ?></div>
	</div><?php
}
endif;

if ( ! function_exists( 'cuttlefish_img_navigation' ) ) :
function cuttlefish_img_navigation() { ?>
	<div class="pnavigation">
		<div class="nprev"><?php previous_image_link( false, __( '&nbsp;&laquo; Previous Image' , 'cuttlefish' ) ); ?></div>
		<div class="nnext"><?php next_image_link( false, __( 'Next Image &raquo;&nbsp;' , 'cuttlefish' ) ); ?></div>
	</div><?php
}
endif;

if ( ! function_exists( 'cuttlefish_comment_navigation' ) ) :
function cuttlefish_comment_navigation() { ?>
	<div class="cnavigation">
		<div class="nprev"><?php previous_comments_link( __( '&nbsp;&laquo; Previous Comments', 'cuttlefish' ) ); ?></div>
		<div class="nnext"><?php next_comments_link( __( 'Next Comments &raquo;&nbsp;', 'cuttlefish' ) ); ?></div>
	</div><?php
}
endif;

if ( ! function_exists( 'cuttlefish_arrow' ) ) :
function cuttlefish_arrow() { ?>
	<span class="arrow"><img src="<?php echo cuttlefish_color_scheme_image_dir_uri(); ?>/arrow.gif" alt="" title="" /></span><?php
}
endif;

if ( ! function_exists( 'cuttlefish_more_link_text' ) ) :
function cuttlefish_more_link_text() {
	return '<span class="read-more">' . __( 'Read the rest of this entry', 'cuttlefish' ) . '</span>';
}
endif;

if ( ! function_exists( 'cuttlefish_wp_link_pages' ) ) :
function cuttlefish_wp_link_pages() {
	wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cuttlefish' ), 'after' => '</div>' ) );
}
endif;
?>