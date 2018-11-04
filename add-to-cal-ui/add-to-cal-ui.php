<?php
/**
 * Plugin Name: Add to call UI
 * Plugin URI: https://github.com/greenpeace/gpes-add-to-cal-wp-shortcode
 * Version: 2.0
 * Description: Adds an GUI to use the [add_to_cal] shortcode. This plugin requires the plugin Shortcake (Shortcode UI)
 * Author: Osvaldo Gago
 * Author URI: https://osvaldo.pt
 * Text Domain: add-to-cal-ui
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die( 'You can\'t do that !' );

/**
 * Initiate plugin's translations
 */
function add_to_cal_load_plugin_textdomain() {
    load_plugin_textdomain( 'add-to-cal-ui', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'add_to_cal_load_plugin_textdomain' );

/**
 * Shortcake UI detection
 */
function shortcode_ui_add_to_cal_detection() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		add_action( 'admin_notices', 'shortcode_ui_add_to_cal_notices' );
	}
}

function shortcode_ui_add_to_cal_notices() {
	if ( current_user_can( 'activate_plugins' ) ) {
		?>
		<div class="error message">
			<p><?php __('Shortcode UI plugin must be active for Shortcode UI Add to Cal plugin to function.', 'add-to-cal-ui') ?></p>
		</div>
		<?php
	}
}

add_action( 'init', 'shortcode_ui_add_to_cal_detection' );

/**
 * UI for the shortcode add_to_cal
 */
function shortcode_ui_add_to_cal() {
    
    $add_to_cal_fields = array(
        array(
			'label'  => __('Event title', 'add-to-cal-ui'),
			// 'description'  => __('', 'add-to-cal-ui'),
			'attr'   => 'title',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'Please add a title to the event',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Description', 'add-to-cal-ui'),
			// 'description'  => __('', 'add-to-cal-ui'),
			'attr'   => 'description',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'Please add a description to the event',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Start date', 'add-to-cal-ui'),
			'description'  => __('In this format <strong>2018-12-25</strong>', 'add-to-cal-ui'),
			'attr'   => 'date',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => 'YYYY-MM-DD',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Start time', 'add-to-cal-ui'),
			'description'  => __('Please respect the format <strong>16:01:00</strong>', 'add-to-cal-ui'),
			'attr'   => 'time',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '16:01:00',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Duration', 'add-to-cal-ui'),
			'description'  => __('In minutes', 'add-to-cal-ui'),
			'attr'   => 'duration',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '60',
				'data-test'   => 1,
			),
		),
        array(
			'label'  => __('Address', 'add-to-cal-ui'),
			// 'description'  => __('', 'add-to-cal-ui'),
			'attr'   => 'address',
			'type'   => 'text',
			'encode' => false,
			'meta'   => array(
				'placeholder' => '',
				'data-test'   => 1,
			),
		),
    );
    
    $add_to_cal_args = array(
		'label' => __('Add to cal', 'add-to-cal-ui'),
		'listItemImage' => 'dashicons-calendar-alt',
		'attrs' => $add_to_cal_fields,
	);
        
    shortcode_ui_register_for_shortcode( 'add_to_cal', $add_to_cal_args );
}

add_action( 'register_shortcode_ui', 'shortcode_ui_add_to_cal' );

?>
