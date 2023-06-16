<div class="modal fade" id="addFolderModal" tabindex="-1" role="dialog" aria-labelledby="addFolderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addFolderModalLabel">Add Folder</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addFolderForm" method="post">
            <div class="form-group">
              <label for="folderName">Folder Name</label>
              <input type="text" class="form-control" id="folderName" name="folderName" placeholder="Enter folder name" required>
            </div>
            <button type="submit" id="saveFolderBtn" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
