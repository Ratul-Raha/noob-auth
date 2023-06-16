
<?php
class ItemManager
{
    //Add Item
    function add_item()
    {
        global $wpdb;
        $folder = $_POST['folder'];
        $organization = $_POST['organization'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $url = $_POST['url'];

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

    //update item

    function update_item()
    {

        global $wpdb;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $folder = $_POST['folder'];
            $organization = $_POST['organization'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $url = $_POST['url'];
            $itemID = $_POST['itemID'];

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
            echo json_encode($response);
        }
    }
}
?>
