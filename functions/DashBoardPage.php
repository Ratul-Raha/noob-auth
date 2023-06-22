<?php
namespace NoobAuthWp;
class DashboardPage {

    public function getItems() {
        $items = array();

        global $wpdb;
        $items_table_name = $wpdb->prefix . 'items';
        $folders_table_name = $wpdb->prefix . 'folders';
        $organizations_table_name = $wpdb->prefix . 'organizations';

        $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
        $items_per_page = 5;

        $items_query = "SELECT items.id, items.name, items.email, items.password, items.url, items.folder_id, items.organization_id 
                        FROM $items_table_name AS items";

        if ($wpdb->get_var("SELECT COUNT(*) FROM $items_table_name") > 0) {
            $items_query = "SELECT items.id, items.name, items.email, items.password, items.url, organizations.organization_name, folders.folder_name, items.folder_id, items.organization_id 
                            FROM $items_table_name AS items 
                            LEFT JOIN $organizations_table_name AS organizations ON items.organization_id = organizations.id 
                            LEFT JOIN $folders_table_name AS folders ON items.folder_id = folders.id";
        }

        $total_items = $wpdb->get_var("SELECT COUNT(*) FROM ($items_query) AS total_items");

        $total_pages = ceil($total_items / $items_per_page);

        $current_page = min($current_page, $total_pages);

        $offset = ($current_page - 1) * $items_per_page;
        $offset = max(0, $offset);

        $items_data = $wpdb->get_results($items_query . " LIMIT $offset, $items_per_page");

        if (!empty($items_data)) {
            foreach ($items_data as $item) {
                $items[] = array(
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'password' => $item->password,
                    'url' => $item->url,
                    'organization_name' => $item->organization_name,
                    'folder_name' => $item->folder_name,
                    'folder_id' => $item->folder_id,
                    'organization_id' => $item->organization_id,
                );
            }
        }

        return array(
            'items' => $items,
            'total_pages' => $total_pages,
            'current_page' => $current_page
        );
    }
}

$dashboard = new DashboardPage();
$items_data = $dashboard->getItems();
$items = $items_data['items'];
$total_pages = $items_data['total_pages'];
$current_page = $items_data['current_page'];
?>