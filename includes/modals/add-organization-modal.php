<div class="modal fade" id="addOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="addOrganizationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOrganizationModalLabel">Add Organization</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="addOrganizationForm">
            <div class="form-group">
              <label for="organizationName">Organization Name</label>
              <input type="text" class="form-control" id="organizationName" placeholder="Enter organization name">
            </div>
            <button type="submit" id="saveOrganizationBtn" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>