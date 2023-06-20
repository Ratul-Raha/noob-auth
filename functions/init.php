<?php
function noob_init()
{
    require_once plugin_dir_path(__FILE__) . 'folder_functions.php';
require_once plugin_dir_path(__FILE__) . 'organization_functions.php';
require_once plugin_dir_path(__FILE__) . 'item_functions.php';
require_once plugin_dir_path(__FILE__) . 'create_custom_table.php';


$folder_manager = new FolderManager();
$organization_manager = new OrganizationManager();
$item_manager = new ItemManager();




add_action('wp_ajax_add_folder', array($folder_manager, 'add_folder'));
add_action('wp_ajax_update_folder', array($folder_manager, 'update_folder'));
add_action('wp_ajax_delete_folder', array($folder_manager, 'delete_folder'));

add_action('wp_ajax_add_organization', array($organization_manager, 'add_organization'));
add_action('wp_ajax_update_organization', array($organization_manager, 'update_organization'));
add_action('wp_ajax_delete_organization', array($organization_manager, 'delete_organization'));

add_action('wp_ajax_add_item', array($item_manager, 'add_item'));
add_action('wp_ajax_update_item', array($item_manager, 'update_item'));
add_action('wp_ajax_delete_item', array($item_manager, 'delete_item'));
add_action('wp_ajax_export_items_csv', array($item_manager, 'export_items_csv'));


    add_action('admin_menu', 'my_plugin_add_menu');
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

    function noob_plugin_render()
    {
        include(plugin_dir_path(__FILE__) . '../main.php');
    }

    function noob_enqueue_scripts() {

        wp_enqueue_script('custom-scripts-1', plugin_dir_url(__FILE__) . '../js/folder.js', array('jquery'), '1.0', true);
        wp_enqueue_script('custom-scripts-2', plugin_dir_url(__FILE__) . '../js/organization.js', array('jquery'), '1.0', true);
        wp_enqueue_script('custom-scripts-3', plugin_dir_url(__FILE__) . '../js/item.js', array('jquery'), '1.0', true);
    
        wp_localize_script('myplugin-script', 'myplugin_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    
        wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . '../css/main.css');
    }
    add_action('admin_enqueue_scripts', 'noob_enqueue_scripts');
}
