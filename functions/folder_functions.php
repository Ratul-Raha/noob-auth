<?php
 class FolderManager {
//Add Folder
   function add_folder() {
    global $wpdb;
  
    $table_name = $wpdb->prefix . 'folders';
  
    $folder_name = $_POST['folderName'];
  
    $result = $wpdb->insert(
      $table_name,
      array(
        'folder_name' => $folder_name,
      )
    );
  
    if ($result) {
      wp_send_json_success(array('message' => 'Folder added successfully.'));
    } else {
      wp_send_json_error(array('message' => 'Failed to add folder.'));
    }
  }

  // Update Folder

  function update_folder() {
    $folder_id = $_POST['folderId'];
    $folder_name = $_POST['folderName'];

    global $wpdb;
    $table_name = $wpdb->prefix . 'folders';

    $data = array(
        'folder_name' => $folder_name
    );

    $where = array(
        'id' => $folder_id
    );

    $updated = $wpdb->update($table_name, $data, $where);

    if ($updated !== false) {
        $response = array(
            'success' => true
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Failed to update the folder'
        );
    }

    wp_send_json($response);
}

// Delete Folder

function delete_folder() {
    if (isset($_POST['folderId'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'folders';
        $folder_id = $_POST['folderId'];

        $result = $wpdb->delete($table_name, array('id' => $folder_id));

        if ($result !== false) {
            wp_send_json_success();
        } else {
            wp_send_json_error(array('message' => 'Failed to delete the folder.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Invalid request.'));
    }
}

 }


?>