<?php
/**
 * Cuttlefish Theme Options.
 *
 * @package WpSpot
 * @subpackage Cuttlefish
 * @since Cuttlefish 2.0.0
 */

/**
 * Properly enqueue styles and scripts for Cuttlefish options page.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'cuttlefish-theme-options', get_template_directory_uri() . '/options/theme-options.css', false, '2012-07-21' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'cuttlefish_admin_enqueue_scripts' );


/**
 * Register the form setting for cuttlefish_options array.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_theme_options_init() {
	register_setting(
		'cuttlefish_options',
		'cuttlefish_theme_options',
		'cuttlefish_validate_theme_options'
	);

	add_settings_section( 'general', '', '__return_false', 'theme_options' );

	add_settings_field(
		'color_scheme',
		__( 'Color Scheme', 'cuttlefish' ),
		'cuttlefish_settings_field_color_scheme',
		'theme_options',
		'general'
	);
}
add_action( 'admin_init', 'cuttlefish_theme_options_init' );


/**
 * Change the capability required to save the 'cuttlefish_options' options group.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_cuttlefish_options', 'cuttlefish_option_page_capability' );


/**
 * Add our theme options page to the admin menu, including some help documentation.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'cuttlefish' ),
		__( 'Theme Options', 'cuttlefish' ),
		'edit_theme_options',
		'theme_options',
		'cuttlefish_render_theme_options_page'
	);

	if ( !$theme_page ) {
		return;
	}

	add_action( "load-$theme_page", 'cuttlefish_theme_options_help' );
}
add_action( 'admin_menu', 'cuttlefish_theme_options_add_page' );


/**
 * Help for the options page.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_theme_options_help() {
	$help = '<p>' . __( '<strong>Color Scheme</strong>: You can choose a color palette for your site.', 'cuttlefish' ) . '</p>' .
			'<p>' . __( 'Remember to click "Save Changes" to save any changes you have made to the theme options.', 'cuttlefish' ) . '</p>';

	$screen = get_current_screen();

	$screen->add_help_tab( array(
		'title' => __( 'Overview', 'cuttlefish' ),
		'id' => 'theme-options-help',
		'content' => $help,
		)
	);
}


/**
 * Returns an array of color schemes registered for Cuttlefish.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_color_schemes_options() {
	$color_scheme_options = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default', 'cuttlefish' )
		),
		'algae' => array(
			'value' => 'algae',
			'label' => __( 'Cuttlefish Algae', 'cuttlefish' )
		),
		'ashes' => array(
			'value' => 'ashes',
			'label' => __( 'Cuttlefish Ashes', 'cuttlefish' )
		),
		'ink' => array(
			'value' => 'ink',
			'label' => __( 'Cuttlefish Ink', 'cuttlefish' )
		),
		'komodo' => array(
			'value' => 'komodo',
			'label' => __( 'Cuttlefish Komodo', 'cuttlefish' )
		),
		'oil' => array(
			'value' => 'oil',
			'label' => __( 'Cuttlefish Oil', 'cuttlefish' )
		),
		'plum' => array(
			'value' => 'plum',
			'label' => __( 'Cuttlefish Plum', 'cuttlefish' )
		),
		'polar' => array(
			'value' => 'polar',
			'label' => __( 'Cuttlefish Polar', 'cuttlefish' )
		),
		'spring' => array(
			'value' => 'spring',
			'label' => __( 'Cuttlefish Spring', 'cuttlefish' )
		),
		'sunflower' => array(
			'value' => 'sunflower',
			'label' => __( 'Cuttlefish Sunflower', 'cuttlefish' )
		),
		'tumo' => array(
			'value' => 'tumo',
			'label' => __( 'Cuttlefish Tumo', 'cuttlefish' )
		),
		'turquoise' => array(
			'value' => 'turquoise',
			'label' => __( 'Cuttlefish Turquoise', 'cuttlefish' )
		)
	);

	return apply_filters( 'cuttlefish_color_schemes_options', $color_scheme_options );
}


/**
 * Returns the default theme options for Cuttlefish.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_get_default_theme_options() {
	$default_theme_options = array(
		'option_color_scheme' => 'default'
	);

	return apply_filters( 'cuttlefish_default_theme_options', $default_theme_options );
}


/**
 * Returns the options array for for Cuttlefish.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_get_theme_options() {
	return get_option( 'cuttlefish_theme_options', cuttlefish_get_default_theme_options() );
}


/**
 * Renders the Color Scheme setting field.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_settings_field_color_scheme() {
	$options = cuttlefish_get_theme_options();

	foreach ( cuttlefish_color_schemes_options() as $scheme ) { ?>
		<div class="image-radio-option">
		<label class="description">
			<input type="radio" name="cuttlefish_theme_options[option_color_scheme]" value="<?php echo esc_attr( $scheme['value'] ); ?>" <?php checked( $options['option_color_scheme'], $scheme['value'] ); ?> />
			<span>
				<img src="<?php echo esc_url( cuttlefish_color_scheme_screenshot_uri( $scheme['value'] ) ); ?>" width="300" height="225" alt="" />
				<?php echo $scheme['label']; ?>
			</span>
		</div>
		</label><?php
	}
}


/**
 * Displays options page for Cuttlefish.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_render_theme_options_page() { ?>
	<div class="wrap">
		<h2><?php printf( __( '%s Theme Options', 'cuttlefish' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'cuttlefish_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


/**
 * Sanitize and validate form input. Accepts an array, return a sanitized array.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_validate_theme_options( $input ) {
	$output = $defaults = cuttlefish_get_default_theme_options();

	if ( isset( $input['option_color_scheme'] ) && array_key_exists( $input['option_color_scheme'], cuttlefish_color_schemes_options() ) ) {
		$output['option_color_scheme'] = $input['option_color_scheme'];
	}

	return apply_filters( 'cuttlefish_validate_theme_options', $output, $input, $defaults );
}


/**
 * Enqueue the styles for the current color scheme.
 *
 * @since Cuttlefish 2.0.0
 */
function cuttlefish_enqueue_color_scheme() {
	$options = cuttlefish_get_theme_options();
	$color_scheme = $options['option_color_scheme'];

	if ( $color_scheme != 'default' ) {
		wp_enqueue_style( $color_scheme, get_template_directory_uri() . "/options/schemes/$color_scheme/style.css", array(), null );
		do_action( 'cuttlefish_enqueue_color_scheme', $color_scheme );
	}
}
add_action( 'wp_enqueue_scripts', 'cuttlefish_enqueue_color_scheme' );
?>