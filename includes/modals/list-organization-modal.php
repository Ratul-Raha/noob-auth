<div class="modal fade" id="listOrganizationsModal" tabindex="-1" role="dialog" aria-labelledby="listOrganizationsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listOrganizationsModalLabel">List Organizations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Table for Organizations -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Organization Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'organizations';
                        $organizations = $wpdb->get_results("SELECT * FROM $table_name");

                        foreach ($organizations as $organization) {
                        ?>
                            <tr>
                                <td><?php echo $organization->id; ?></td>
                                <td><?php echo $organization->organization_name; ?></td>
                                <td>
                                    <a href="#" class="edit-organization" data-id="<?php echo $organization->id; ?>" data-organization-name="<?php echo $organization->organization_name; ?>" data-toggle="modal" data-target="#editOrganizationModal"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="delete-organization" data-id="<?php echo $organization->id; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>