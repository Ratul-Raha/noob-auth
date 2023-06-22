<?php
class NoobAuthPlugin {
    public function __construct() {
        require_once plugin_dir_path(__FILE__) . 'folder_functions.php';
        require_once plugin_dir_path(__FILE__) . 'organization_functions.php';
        require_once plugin_dir_path(__FILE__) . 'item_functions.php';

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

        add_action('admin_menu', array($this, 'noob_add_menu'));
        add_action('admin_enqueue_scripts', array($this, 'noob_enqueue_scripts'));
    }

    public function noob_add_menu() {
        add_menu_page(
            'Noob Auth',
            'Noob Auth',
            'manage_options',
            'noob-plugin',
            array($this, 'noob_plugin_render')
        );
    }

    public function noob_plugin_render() {
        include(plugin_dir_path(__FILE__) . '../main.php');
    }

    public function noob_enqueue_scripts() {
        wp_enqueue_script('noob-scripts-1', MY_JS_FOLDER_PATH . 'folder.js', array('jquery'), '1.0', true);
        wp_enqueue_script('noob-scripts-2', MY_JS_FOLDER_PATH . 'organization.js', array('jquery'), '1.0', true);
        wp_enqueue_script('noob-scripts-3', MY_JS_FOLDER_PATH . 'item.js', array('jquery'), '1.0', true);

        wp_localize_script('noob-scripts-1', 'myplugin_ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));

        wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . '../css/main.css');
    }
}

function noob_init() {
    $noob_auth_plugin = new NoobAuthPlugin();
}
add_action('init', 'noob_init');
?>