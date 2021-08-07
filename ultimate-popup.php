<?php
/**
 * Plugin Name:     Ultimate Popup
 * Plugin URI:      https://github.com/AbhijitNage123
 * Description:     Easy popup.
 * Version:         1.0.0
 * Author:          AbhijitNage123
 * Author URI:      https://github.com/AbhijitNage123
 * Text Domain:     ultimate-popup
 */

 // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'UP_FILE', __FILE__ );
define( 'UP_ROOT', dirname( plugin_basename( UP_FILE ) ) );

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';