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
    $user_id = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';

    $table_name = $wpdb->prefix . "crud_table";
    $data = array('user_fname' => $fname, 'user_lname' => $lname);

    if ($user_id != 0) {
        // Update
        $wpdb->update($table_name, $data, array('user_id' => $user_id));
    } else {
        // Insert
        $ins_format = array('%s','%s');
        $wpdb->insert($table_name, $data, $ins_format);
        $my_id = $wpdb->insert_id;
    }

    echo wp_json_encode($response);
    wp_die();
}
