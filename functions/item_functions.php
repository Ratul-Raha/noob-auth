
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
}
?>
