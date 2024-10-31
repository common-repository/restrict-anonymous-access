<?php
/**
 * @package Restrict Anonymous Access
 * @author Christian Leuenberg <christian@l-net.biz>
 * @license GPLv3
 * @copyright 2017 by Christian Leuenberg
 */
/*
Plugin Name: Restrict Anonymous Access
Plugin URI: 
Description: Adds shortcode to restrict content from anonymous users
Author: Christian Leuenberg, L.net Web Solutions
Author URI: https://www.l-net.biz/
Version: 1.2
Text Domain: restrictanonymous
Domain Path: /languages/
License: GPLv3

	Restrict Anonymous Access for WordPress
    Copyright (C) 2017 Christian Leuenberg

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

//Load plugin textdomain
function raa_load_textdomain() {
	load_plugin_textdomain( 'restrictanonymous', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}
add_action( 'plugins_loaded', 'raa_load_textdomain' );

function raa_load_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'restrictanonymous_style', $plugin_url . 'css/styles.css' );
}
add_action( 'wp_enqueue_scripts', 'raa_load_scripts' );

//Shortcode for checking if user is logged in
function raa_member_check_shortcode( $atts, $content = null ) {

    //Attributes
    extract(shortcode_atts( array(
        'showinfo' => '1',
        'class' => '',
        'role' => '',
        'infotext' => get_option('raa_infotext', __('This section is only available to registered users.', 'restrictanonymous'))
    ), $atts ) );

    $user = wp_get_current_user();

    if (!empty($role)) {
        switch ($role) {
            case 'subscriber':
                if (current_user_can('read') && !is_null($content) && !is_feed()) {
                    //Show content
                    return wpautop(do_shortcode($content));
                } 
                break;

            case 'contributor':
                if (current_user_can('edit_posts') && !is_null($content) && !is_feed()) {
                    //Show content
                    return wpautop(do_shortcode($content));
                }
                break;

            case 'author':
                if (current_user_can('publish_posts') && !is_null($content) && !is_feed()) {
                    //Show content
                    return wpautop(do_shortcode($content));
                }
                break;

            case 'editor':
                if (current_user_can('publish_pages') && !is_null($content) && !is_feed()) {
                    //Show content
                    return wpautop(do_shortcode($content));
                }
                break;

            case 'admin':
            case 'administrator':
                if (current_user_can('manage_options') && !is_null($content) && !is_feed()) {
                    //Show content
                    return wpautop(do_shortcode($content));
                }
                break;

            default:
                if ( (in_array($role, (array) $user->roles)) || (current_user_can('manage_options') && !is_null($content) && !is_feed()) ) {
                    //Show content
                    return wpautop(do_shortcode($content));
                }
                break;
        }
    } else {
        if ( is_user_logged_in() && !is_null($content) && !is_feed() ) {
            //Show content for logged-in-users:
            return wpautop(do_shortcode($content));
        }
    }
    
    if ($showinfo=='1') {
        //Hide content but show info text
        return '<div class="raa-box-info ' . $class . '"><p>' . html_entity_decode($infotext) . '</p></div>';
    }
}
add_shortcode('member', 'raa_member_check_shortcode');

//Enqueue TinyMCE plugin script with its ID.
function raa_enqueue_plugin_scripts( $plugin_array ) {
    $plugin_array["shortcode_member_button"] =  plugin_dir_url(__FILE__) . "index.js";
    return $plugin_array;
}
add_filter("mce_external_plugins", "raa_enqueue_plugin_scripts");

//Register buttons with their id.
function raa_register_buttons_editor( $buttons ) {
    array_push($buttons, "member");
    return $buttons;
}
add_filter("mce_buttons", "raa_register_buttons_editor");