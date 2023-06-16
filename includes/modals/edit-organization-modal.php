<div class="modal fade" id="editOrganizationModal" tabindex="-1" style="z-index:1060" role="dialog" aria-labelledby="editOrganizationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOrganizationModalLabel">Edit Organization</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="editOrganizationForm">
          <input type="hidden" id="editOrganizationId" value="">
          <div class="form-group">
            <label for="editOrganizationName">Organization Name</label>
            <input type="text" class="form-control" id="editOrganizationName" name="editOrganizationName" placeholder="Enter organization name">
          </div>
          <button type="button" class="btn btn-primary" id="saveEditOrganizationBtn">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
