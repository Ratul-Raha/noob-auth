<?php
class ItemManager
{
    // Add Item
    function add_item()
    {
        global $wpdb;
        $folder = isset($_POST['folder']) ? sanitize_text_field($_POST['folder']) : '';
        $organization = isset($_POST['organization']) ? sanitize_text_field($_POST['organization']) : '';
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
        $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
        $url = isset($_POST['url']) ? sanitize_text_field($_POST['url']) : '';

        $table_name = $wpdb->prefix . 'items';
        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'url' => $url,
            'folder_id' => $folder,
            'organization_id' => $organization
        );
        $insert_result = $wpdb->insert($table_name, $data);

        if ($insert_result === false) {
            $response = array(
                'success' => false,
            );
        } else {
            $response = array(
                'success' => true,
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Update Item
    function update_item()
    {
        global $wpdb;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folder = isset($_POST['folder']) ? sanitize_text_field($_POST['folder']) : '';
            $organization = isset($_POST['organization']) ? sanitize_text_field($_POST['organization']) : '';
            $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
            $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
            $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
            $url = isset($_POST['url']) ? sanitize_text_field($_POST['url']) : '';
            $itemID = isset($_POST['itemID']) ? sanitize_text_field($_POST['itemID']) : '';

            $item_table_name = $wpdb->prefix . 'items';

            $result = $wpdb->update(
                $item_table_name,
                array(
                    'folder_id' => $folder,
                    'organization_id' => $organization,
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'url' => $url
                ),
                array('id' => $itemID)
            );

            if ($result !== false) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false);
            }

            header('Content-Type: application/json');
            return wp_send_json($response);
        }
    }

    // Delete Item
    function delete_item()
    {
        global $wpdb;
        $items_table_name = $wpdb->prefix . 'items';

        if (isset($_POST['itemId'])) {
            $itemId = sanitize_text_field($_POST['itemId']);

            $deleted = $wpdb->delete($items_table_name, array('id' => $itemId));

            if ($deleted) {
                $response = array(
                    'success' => true,
                );
            } else {
                $response = array(
                    'success' => false,
                );
            }

            wp_send_json($response);
        }
    }

    // Export as CSV
    function export_items_csv()
    {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Access Denied');
        }

        global $wpdb;
        $items_table_name = $wpdb->prefix . 'items';
        $folders_table_name = $wpdb->prefix . 'folders';
        $organizations_table_name = $wpdb->prefix . 'organizations';

        $items_query = "SELECT items.id, items.name, items.email, items.password, items.url, organizations.organization_name, folders.folder_name 
                  FROM $items_table_name AS items 
                  LEFT JOIN $organizations_table_name AS organizations ON items.organization_id = organizations.id 
                  LEFT JOIN $folders_table_name AS folders ON items.folder_id = folders.id";

        $items = $wpdb->get_results($items_query);
        $csv_data = array(
            array('ID', 'Name', 'Email', 'Password', 'URL', 'Organization', 'Folder'),
        );

        foreach ($items as $item) {
            $csv_data[] = array(
                $item->id,
                $item->name,
                $item->email,
                $item->password,
                $item->url,
                $item->organization_name,
                $item->folder_name,
            );
        }

        $temp_file = tempnam(sys_get_temp_dir(), 'items_export_');
        $handle = fopen($temp_file, 'w');

        foreach ($csv_data as $csv_row) {
            fputcsv($handle, $csv_row);
        }

        fclose($handle);

        $response = array(
            'file' => $temp_file,
            'filename' => 'items.csv',
        );

        wp_send_json_success($response);
    }
}
?>
