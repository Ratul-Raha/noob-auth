<?php
 class OrganizationManager {
//Add organization
   function add_organization() {
    global $wpdb;

  
    $table_name = $wpdb->prefix . 'organizations';
  
    $organization_name = $_POST['organizationName'];
  
    $result = $wpdb->insert(
      $table_name,
      array(
        'organization_name' => $organization_name,
      )
    );
  
    if ($result) {
      wp_send_json_success(array('message' => 'organization added successfully.'));
    } else {
      wp_send_json_error(array('message' => 'Failed to add organization.'));
    }
  }

  // Update organization

  function update_organization() {
   
    $organization_id = $_POST['organizationId'];
    $organization_name = $_POST['organizationName'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'organizations';

    $data = array(
        'organization_name' => $organization_name
    );

    $where = array(
        'id' => $organization_id
    );

    $updated = $wpdb->update($table_name, $data, $where);

    if ($updated !== false) {
        $response = array(
            'success' => true,
            'message' => 'Successfully updated the organization',
            'db' => $updated
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Failed to update the organization'
        );
    }

    wp_send_json($response);
}

// Delete organization

function delete_organization() {
    if (isset($_POST['organizationId'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'organizations';
        $organization_id = $_POST['organizationId'];

        $result = $wpdb->delete($table_name, array('id' => $organization_id));

        if ($result !== false) {
            wp_send_json_success();
        } else {
            wp_send_json_error(array('message' => 'Failed to delete the organization.'));
        }
    } else {
        wp_send_json_error(array('message' => 'Invalid request.'));
    }
}

 }
