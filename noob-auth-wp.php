<?php

/*
 * Plugin Name:       Noob Auth
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Password management made easy.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Goutom Dash
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       noob
 * Domain Path:       /languages
 */


require_once plugin_dir_path( __FILE__ ) . 'functions/folder_functions.php';
require_once plugin_dir_path( __FILE__ ) . 'functions/organization_functions.php';
require_once plugin_dir_path( __FILE__ ) . 'functions/item_functions.php';

$folder_manager = new FolderManager();
$organization_manager = new OrganizationManager();
$item_manager = new ItemManager();


add_action('admin_menu', 'my_plugin_add_menu');

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}


function enqueue_custom_scripts() {
    wp_enqueue_script( 'custom-scripts-1', plugin_dir_url( __FILE__ ) . 'js/folder.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'custom-scripts-2', plugin_dir_url( __FILE__ ) . 'js/organization.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'custom-scripts-3', plugin_dir_url( __FILE__ ) . 'js/item.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_custom_scripts' );

add_action( 'wp_ajax_add_folder', array($folder_manager, 'add_folder' ) );
add_action('wp_ajax_update_folder', array($folder_manager, 'update_folder' ));
add_action('wp_ajax_delete_folder', array($folder_manager, 'delete_folder' ));

add_action( 'wp_ajax_add_organization', array($organization_manager, 'add_organization' ) );
add_action('wp_ajax_update_organization', array($organization_manager, 'update_organization' ));
add_action('wp_ajax_delete_organization', array($organization_manager, 'delete_organization' ));


add_action( 'wp_ajax_add_item', array($item_manager, 'add_item' ) );


function enqueue_custom_styles() {
    wp_enqueue_style( 'custom-style', plugin_dir_url( __FILE__ ) . 'css/main.css' );
}

add_action( 'admin_enqueue_scripts', 'enqueue_custom_styles');

function my_plugin_add_menu()
{
    add_menu_page(
        'Noob Auth',
        'Noob Auth',
        'manage_options',
        'noob-plugin',
        'noob_plugin_render'
    );
}

function noob_plugin_render (){
    include( plugin_dir_path( __FILE__ ) . 'main.php');
}

register_activation_hook( __FILE__, 'create_custom_table' );

function create_custom_table() {
    global $wpdb;

    $table_name_folders = $wpdb->prefix . 'folders'; 
    $table_name_items = $wpdb->prefix . 'items';
    $table_name_organizations = $wpdb->prefix . 'organizations';

    $charset_collate = $wpdb->get_charset_collate();

    $sql_folders = "CREATE TABLE $table_name_folders (
        id INT(11) NOT NULL AUTO_INCREMENT,
        folder_name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql_items = "CREATE TABLE $table_name_items (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        url VARCHAR(255) NOT NULL,
        folder_id INT(11) NOT NULL,
        organization_id INT(11) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (folder_id) REFERENCES $table_name_folders(id),
        FOREIGN KEY (organization_id) REFERENCES $table_name_organizations(id)
    ) $charset_collate;";

    $sql_organizations = "CREATE TABLE $table_name_organizations (
        id INT(11) NOT NULL AUTO_INCREMENT,
        organization_name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql_folders );
    dbDelta( $sql_items );
    dbDelta( $sql_organizations );
}
