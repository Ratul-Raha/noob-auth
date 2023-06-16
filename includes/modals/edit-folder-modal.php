<div class="modal fade" id="editFolderModal" tabindex="-1" style="z-index:1060" role="dialog" aria-labelledby="editFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editFolderModalLabel">Edit Folder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="editFolderForm">
            <input type="hidden" id="editFolderId" value="">
            <div class="form-group">
              <label for="editFolderName">Folder Name</label>
              <input type="text" class="form-control" id="editFolderName" name="editFolderName" placeholder="Enter folder name">
            </div>
            <button type="button" class="btn btn-primary" id="saveEditFolderBtn">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>