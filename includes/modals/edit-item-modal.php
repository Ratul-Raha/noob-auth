<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editItemForm" method="post">
                    <input type="hidden" id="editItemId" name="editItemId" value="">
                    <input type="hidden" id="editOrganizationId" name="editOrganizationId" value="">
                    <input type="hidden" id="editFolderId" name="editFolderId" value="">
                    <div class="form-group">
                        <label for="editFolder">Folder</label>
                        <select class="form-control" id="editFolder">
                            <option id="default-folder" value=""></option>
                            <?php
                            global $wpdb;
                            $folder_table_name = $wpdb->prefix . 'folders';
                            $folders = $wpdb->get_results("SELECT * FROM $folder_table_name");
                            foreach ($folders as $folder) {
                                echo '<option value="' . $folder->id . '" data-folder-id="' . $folder->id . '">' . $folder->folder_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editOrganization">Organization</label>
                        <select class="form-control" id="editOrganization">
                            <option id="default-organization" value=""></option>
                            <?php
                            global $wpdb;
                            $organization_table_name = $wpdb->prefix . 'organizations';
                            $organizations = $wpdb->get_results("SELECT * FROM $organization_table_name");
                            foreach ($organizations as $organization) {
                                echo '<option value="' . $organization->id . '" data-organization-id="' . $organization->id . '">' . $organization->organization_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" placeholder="Enter name" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <div class="password-input">
                            <input type="password" class="form-control" id="editPassword" placeholder="Enter password" required>
                            <span class="password-toggle-icon">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editURL">URL</label>
                        <input type="url" class="form-control" id="editURL" placeholder="Enter URL" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>