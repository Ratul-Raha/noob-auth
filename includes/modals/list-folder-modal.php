<div class="modal fade" id="listFolderModal" tabindex="-1" role="dialog" aria-labelledby="listFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="listFolderModalLabel">List Folder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Table for Folders -->
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Folder Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              global $wpdb;
              $table_name = $wpdb->prefix . 'folders';
              $folders = $wpdb->get_results("SELECT * FROM $table_name");

              foreach ($folders as $folder) {
              ?>
                <tr>
                  <td><?php echo $folder->id; ?></td>
                  <td><?php echo $folder->folder_name; ?></td>
                  <td>
                    <a href="#" class="edit-folder" data-id="<?php echo $folder->id; ?>" data-folder-name="<?php echo $folder->folder_name; ?>" data-toggle="modal" data-target="#editFolderModal"><i class="fas fa-edit"></i></a>
                    <a href="#" class="delete-folder" data-id="<?php echo $folder->id; ?>"><i class="fas fa-trash"></i></a>
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