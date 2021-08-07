<?php
/**
 * This is a Pop Up Block for the Gutenberg editor
 *
 * @package Ultimate PopUp
 * @since 1.0.0
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 *
 * @since 1.0.0
 */
function ultimate_popup_block_assets() {

	wp_enqueue_script(
		'ultimate_popup-block-animations',
		plugins_url( 'animation.js', dirname( __FILE__ ) ),
		array( 'jquery' ),
		true,
		true
	);
	wp_enqueue_style(
		'ultimate_popup-block-editor-bootstrap-css',
		plugins_url( 'bootstrap-modal.css', dirname( __FILE__ ) ),
		array( 'wp-edit-blocks' ),
		true
	);
   
}

add_action( 'enqueue_block_assets', 'ultimate_popup_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * `wp-blocks`: includes block type registration and related functions.
 * `wp-element`: includes the WordPress Element abstraction for describing the structure of your blocks.
 * `wp-i18n`: To internationalize the block's text.
 *
 * @since 1.0.0
 */
function ultimate_popup_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'ultimate_popup-block-js',
		plugins_url( '/build/index.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		true,
		true
	);
    wp_enqueue_style(
        'ultimate_popup-block-css', // Handle.
        plugins_url( '/build/style-index.css', dirname( __FILE__ ) ), // Block style CSS.
        array(),
        true,
		true
    );
}

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'ultimate_popup_editor_assets' );

/**
 * Render the Pop Up block
 *
 * @param array  $attributes Attributes set in the Gutenberg editor.
 * @param string $content HTML saved in the Gutenberg block save method.
 * @return string
 */
function block_party_render_pop_up_block( $attributes, $content ) {
	$button_style = 'background-color: ' . $attributes['buttonColor'] . '; color: ' . $attributes['buttonTextColor'];
	$modal_header_style = 'background-color: ' . $attributes['titleBackgroundColor'] . '; border-radius: ' . $attributes['borderRadius'] . 'px ' . $attributes['borderRadius'] . 'px 0 0';
	$modal_title_style = 'color: ' . $attributes['titleColor'];
	ob_start();
	?>
	<div>
		<input 
			id="demoA"
			type="button"
			class='trigger_popup_fricc'
			value="<?php echo $attributes['buttonText']; ?>"
			style="<?php echo esc_attr( $button_style ); ?>"
		/>
		<div class="hover_bkgr_fricc">
			<span class="helper"></span>
			<div style="<?php echo esc_attr( $modal_header_style ); ?>">
				<div class="popupCloseButton">&times;</div>
				<?php echo wp_kses_post( $content ); ?>
				<p style="<?php echo esc_attr( $modal_title_style ); ?>">
					<?php echo $attributes['title']; ?>
				</p>
			</div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
/**
 * Register the Pop Up block
 *
 * @return void
 */
function block_party_register_pop_up_block() {
	if ( \function_exists( 'register_block_type' ) ) {
		$attributes                         = [];
		$attributes['title']                = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['buttonText']           = [
			'type'    => 'string',
			'default' => 'Click Me',
		];
		$attributes['align']                = [
			'type'    => 'string',
			'default' => 'left',
		];
		$attributes['randomKey']            = [
			'type'    => 'string',
			'default' => 'myModal',
		];
		$attributes['size']                 = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['textBackgroundColor']  = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['titleBackgroundColor'] = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['textColor']            = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['titleColor']           = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['buttonColor']          = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['buttonTextColor']      = [
			'type'    => 'string',
			'default' => '',
		];
		$attributes['borderRadius']         = [
			'type'    => 'number',
			'default' => 6,
		];
		$attributes['animation']            = [
			'type'    => 'string',
			'default' => 'fadeIn',
		];
		\register_block_type(
			'ultimate-popup/block-ultimate-popup',
			array(
				'attributes'      => $attributes,
				'render_callback' => 'block_party_render_pop_up_block',
			)
		);
	}
}
add_action( 'init', 'block_party_register_pop_up_block' );