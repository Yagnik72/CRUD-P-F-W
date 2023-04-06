<?php

/**
 * Admin API: Core Ajax handlers
 *
 * @since      1.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


/**
 * Get layouts list
 */
add_action('wp_ajax_nopriv_user_add_edit', 'user_add_edit_handler');
add_action('wp_ajax_user_add_edit', 'user_add_edit_handler');

function user_add_edit_handler() {
    header('Content-Type: application/json');
    $response = array();
    global $wpdb;

    $fname = isset($_POST['fname']) ? sanitize_text_field($_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? sanitize_text_field($_POST['lname']) : '';

    $table_name = $wpdb->prefix . "crud_table";
    $data = array('fname' => $fname, 'lname' => $lname);
    $format = array('%s','%s');
    $wpdb->insert($table_name, $data, $format);
    $my_id = $wpdb->insert_id;

    echo wp_json_encode($response);
    wp_die();
}
