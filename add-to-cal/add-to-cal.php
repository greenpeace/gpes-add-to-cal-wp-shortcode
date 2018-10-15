<?php
/**
 * @package Add_to_cal
 * @version 0.1
 */
/*
Plugin Name: Add event to calendar
Plugin URI: https://github.com/greenpeace/gpes-add-to-cal-wp-shortcode/
Description: Shortcode to import an html file uploaded in the media library. For example: [add_to_cal date='2018-12-25' time='12:01:00' duration='60' title='Please add a title to the event' description='Please add a description to the event' address='Please add an address to the event']
Author: Osvaldo Gago
Version: 0.1
Author URI: https://osvaldo.pt
*/

/**
 * Shortcode to add links that add an event to the user's calendar
 * [add_to_cal date='2018-12-25' time='12:01:00' duration='60' title='Please add a title to the event' description='Please add a description to the event' address='Please add an address to the event']
 * @param  array $atts  Shortcode attributes
 * @param  array $content  Shortcode content
 * @param  array $tag  Shortcode tag
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
        'address' => 'Please add the address to the event'

    ], $atts, $tag);
    

    $output = '';
    $output .= '<div id="addToCalendar"><strong>Add to calendar:</strong></div>';
    $output .= '<ul id="addToCal">';
    $output .= '<li><a target="_blank" id="addToGoogle">Google Calendar</a></li>';
    $output .= '<li><a target="_blank" id="addToYahoo">Yahoo Calendar</a></li>';
    $output .= '<li><a target="_blank" id="addToApple">Apple Calendar</a></li>';
    $output .= '<li><a target="_blank" id="addToAndroid">Android Calendar</a></li>';
    $output .= '<li><a target="_blank" id="addToOutlook">Outlook Calendar</a></li>';
    $output .= '</ul>';
    $output .= '<script>';
    $output .= '
    
            document.addEventListener("DOMContentLoaded", function(){
                var eventData = {
                    title: "' . esc_attr($attributes["title"]) . '", // Event title
                    start: new Date("'. esc_attr($attributes["date"]) . 'T' . esc_attr($attributes["time"]) .'"), // Event start date
                    duration: ' . esc_attr($attributes["duration"]) . ', // Event duration (IN MINUTES)
                    address: "' . esc_attr($attributes["address"]) . '",
                    description: "' . esc_attr($attributes["description"]) . '"
                };

                var GoogleResult = addToCalendarUrls.google(eventData);
                var YahooResult = addToCalendarUrls.yahoo(eventData);
                var AppleOutlookResult = addToCalendarUrls.ics(eventData);

                var addToGoogle = document.getElementById("addToGoogle");
                    addToGoogle.setAttribute("href", GoogleResult);
                    addToGoogle.addEventListener("click", function(){
                        if (typeof(gtag) === "function") {
                            gtag("event", "click", {
                              "event_category": "addToCalendar",
                              "event_label": "addToGoogle"
                            });
                        }
                    });
                var addToYahoo = document.getElementById("addToYahoo");
                    addToYahoo.setAttribute("href", YahooResult);
                    addToYahoo.addEventListener("click", function(){
                        if (typeof(gtag) === "function") {
                            gtag("event", "click", {
                              "event_category": "addToCalendar",
                              "event_label": "addToYahoo"
                            });
                        }
                    });
                var addToApple = document.getElementById("addToApple");
                    addToApple.setAttribute("href", AppleOutlookResult);
                    addToApple.addEventListener("click", function(){
                        if (typeof(gtag) === "function") {
                            gtag("event", "click", {
                              "event_category": "addToCalendar",
                              "event_label": "addToApple"
                            });
                        }
                    });
                var addToAndroid = document.getElementById("addToAndroid");
                    addToGoogle.setAttribute("href", GoogleResult);
                    addToGoogle.addEventListener("click", function(){
                        if (typeof(gtag) === "function") {
                            gtag("event", "click", {
                              "event_category": "addToCalendar",
                              "event_label": "addToAndroid"
                            });
                        }
                    });
                var addToOutlook = document.getElementById("addToOutlook");
                    addToOutlook.setAttribute("href", AppleOutlookResult);
                    addToOutlook.addEventListener("click", function(){
                        if (typeof(gtag) === "function") {
                            gtag("event", "click", {
                              "event_category": "addToCalendar",
                              "event_label": "addToOutlook"
                            });
                        }
                    });
            });

    ';
    $output .= '</script>';

    return $output;

}

add_shortcode('add_to_cal', 'shortcode_add_to_cal');

?>
