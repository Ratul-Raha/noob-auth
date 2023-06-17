<div class="modal fade" id="addItemsModal" tabindex="-1" role="dialog" aria-labelledby="addItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemsModalLabel">Add Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addItemForm">
                    <div class="form-group">
                        <label for="folder">Folder</label>
                        <select class="form-control" id="folder">
                            <option value="">Select a folder</option>
                            <?php
                            global $wpdb;
                            $folder_table_name = $wpdb->prefix . 'folders';
                            $folders = $wpdb->get_results("SELECT * FROM $folder_table_name");
                            foreach ($folders as $folder) {
                                echo '<option value="' . $folder->id . '">' . $folder->folder_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="organization">Organization</label>
                        <select class="form-control" id="organization">
                            <option value="">Select an organization</option>
                            <?php
                            $organization_table_name = $wpdb->prefix . 'organizations';
                            $organizations = $wpdb->get_results("SELECT * FROM $organization_table_name");
                            foreach ($organizations as $organization) {
                                echo '<option value="' . $organization->id . '">' . $organization->organization_name . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-input">
                            <input type="password" class="form-control" id="password" placeholder="Enter password" required>
                            <span class="password-toggle-icon">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary" id="generatePasswordBtn">Generate Password</button>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" class="form-control" id="url" placeholder="Enter URL" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>