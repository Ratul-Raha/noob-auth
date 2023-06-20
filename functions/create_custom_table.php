<?php
function create_custom_table()
{
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

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql_folders);
    dbDelta($sql_items);
    dbDelta($sql_organizations);
}
?>