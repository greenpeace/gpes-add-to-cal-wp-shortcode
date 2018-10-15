<?php
/**
 * @package Add_to_cal
 * @version 0.1
 */
/*
Plugin Name: Add event to calendar
Plugin URI: https://github.com/greenpeace/gpes-add-to-cal-wp-shortcode/
Description: Shortcode to import an html file uploaded in the media library. For example: [add_to_cal date='' time='' duration='' title='' description='']
Author: Osvaldo Gago
Version: 0.1
Author URI: https://osvaldo.pt
*/

/**
 * Shortcode to add links that add an event to the user's calendar
 * [add_to_cal date='' time='' duration='' title='' description='']
 * @param  array $params  Shortcode attributes
 * @return string Templated data
 */
function shortcode_add_to_cal($atts = [], $content = null, $tag = '') {

    wp_enqueue_script('add_to_cal', plugin_dir_url(__FILE__) . 'add-to-cal.js', array(), '0.1');

    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $attributes = shortcode_atts([
        'title' => 'Please add a title to the event',
        'description' => 'Please add a description to the event',
        'date' => '2018-12-25',
        'time' => '12:01:00',
        'duration' => '60',

    ], $atts, $tag);

    $output = '';
    $output .= $attributes['title'];

    return $output;

}

add_shortcode('add_to_cal', 'shortcode_add_to_cal');

?>
