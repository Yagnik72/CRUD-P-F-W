<?php

/**
 * Plugin Name:       CRUD
 * Plugin URI:        #
 * Description:       CRUD for WordPress.
 * Version:           1.0
 * Author:            Yagnik
 * Author URI:        #
 * Text Domain:       crud-text
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define some constant.
 * Plugin URL and Directory Path.
 */
define('CRUD_URL', plugins_url('/', __FILE__));  // Define Plugin URL.
define('CRUD_DIR', plugin_dir_path(__FILE__));  // Define Plugin Directory Path.
define('CRUD_TEXTDOMAIN', 'crud-text');    // Define Plugin Textdomain.

/**
 * Plugin's main class.
 */
class CRUD_APP {

    /**
     * Main constructor.
     * The main plugin actions registered for WordPress.
     * 
     * @since 1.0
     */
    public function __construct() {
        $this->hooks();
        register_activation_hook(__FILE__, array($this, 'cbdb_function_to_run'));
        add_action('init', array($this, 'cbdb_include_files'));
    }

    /**
     * Hooks initialization.
     * 
     * @since 1.0
     */
    public function hooks() {
        add_action('admin_enqueue_scripts', array($this, 'cbdb_admin_scripts'));
    }

    /**
     * Create a new database table on plugin activation.
     * https://github.com/bhavinp311/creative-blog/blob/master/inc/cbdb-front-ajax-actions.php
     * @since 1.0
     */
    public function cbdb_function_to_run() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . "crud_table";

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
          user_id mediumint(9) NOT NULL AUTO_INCREMENT,
          user_fname varchar(100) NOT NULL,
          user_lname varchar(100) NOT NULL,
          user_email varchar(100) NOT NULL,
          user_gender varchar(2) NOT NULL,
          user_city varchar(100) NOT NULL,
          user_registered datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          PRIMARY KEY  (user_id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Load necessary files.
     * 
     * @since 1.0
     */
    public function cbdb_include_files() {

        // Include ajax actions file
        require_once(CRUD_DIR . 'admin/crud-admin-ajax-actions.php');
        require_once(CRUD_DIR . 'admin/crud-menu.php');
    }

    /**
     * Register/Enqueue backend required css/js on plugin screens.
     */
    public function cbdb_admin_scripts($hook) {
 
        if ($hook == 'toplevel_page_users-list' || $hook == "users-manage_page_add-edit-user") {

            // Backend style
            wp_register_style('admin-style', CRUD_URL . 'admin/assets/css/admin-style.css', array(), time(), false);
            wp_enqueue_style('admin-style');

            wp_register_style('admin-datatable-css', 'https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css', array(), time(), false);
            wp_enqueue_style('admin-datatable-css');

            wp_register_style('admin-bootstarp-css', 'https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css', array(), time(), false);

            wp_register_script('admin-datable-js', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js', array(), time(), false);
            wp_enqueue_script('admin-datable-js');

            // Backend script
            wp_register_script('admin-script', CRUD_URL . 'admin/assets/js/admin-script.js', array('jquery', 'wp-color-picker'), time(), true);
            wp_localize_script('admin-script', 'admin_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
            wp_enqueue_script('admin-script');
        }
    }

}

/*
 * Starts our plugin class, easy!
 */
new CRUD_APP();
