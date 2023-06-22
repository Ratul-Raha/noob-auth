<?php
class OrganizationManager {
    // Add organization
    function add_organization() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'organizations';

        $organization_name = isset($_POST['organizationName']) ? sanitize_text_field($_POST['organizationName']) : '';

        if (empty($organization_name)) {
            wp_send_json_error(array('message' => 'Organization name is required.'));
            return;
        }

        $result = $wpdb->insert(
            $table_name,
            array(
                'organization_name' => $organization_name,
            )
        );

        if ($result) {
            wp_send_json_success(array('message' => 'Organization added successfully.'));
        } else {
            wp_send_json_error(array('message' => 'Failed to add organization.'));
        }
    }

    // Update organization
    function update_organization() {
        if (isset($_POST['organizationId'], $_POST['organizationName'])) {
            $organization_id = $_POST['organizationId'];
            $organization_name = sanitize_text_field($_POST['organizationName']);

            if (empty($organization_name)) {
                wp_send_json_error(array('message' => 'Organization name is required.'));
                return;
            }

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
        } else {
            wp_send_json_error(array('message' => 'Invalid request.'));
        }
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

?>