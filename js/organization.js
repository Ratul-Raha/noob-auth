jQuery(document).ready(function ($) {
  //Add Organization
  $("#addOrganizationForm").on("submit", function (e) {
    var organizationName = $("#organizationName").val();
    $.ajax({
      url: myplugin_ajax_object.ajaxurl,
      type: "POST",
      data: {
        action: "add_organization",
        organizationName: organizationName,
      },
      success: function (response) {
        if (response.success) {
          alert("Organization added successfully!");
          location.reload();
        } else {
          alert("Error: " + response.data.message);
        }
      },
      error: function (xhr, status, error) {
        alert("AJAX Error: " + error);
      },
    });
  });

  //Edit Organization
  $(document).on("click", ".edit-organization", function (e) {
    e.preventDefault();
    $("#listOrganizationsModal").modal("hide");
    var organizationId = $(this).data("id");
    var organizationName = $(this).data("organization-name");
    $("#editOrganizationName").val(organizationName);

    $("#saveEditOrganizationBtn").on("click", function () {
      organizationName = $("#editOrganizationName").val();
      $.ajax({
        url: myplugin_ajax_object.ajaxurl,
        type: "POST",
        data: {
          action: "update_organization",
          organizationId: organizationId,
          organizationName: organizationName,
        },
        success: function (response) {
          if (response.success) {
            location.reload();
          } else {
            alert("Error: " + response.data.message);
          }
        },
        error: function (xhr, status, error) {
          alert("AJAX Error: " + error);
        },
      });
    });
  });

  // Delete Organization
  $(document).on("click", ".delete-organization", function () {
    var organizationId = $(this).data("id");

    if (confirm("Are you sure you want to delete this organization?")) {
      $.ajax({
        url: myplugin_ajax_object.ajaxurl,
        type: "POST",
        data: {
          action: "delete_organization",
          organizationId: organizationId,
        },
        success: function (response) {
          if (response.success) {
            alert("Success: Deleted successfully");
            location.reload();
          } else {
            alert("Error: " + response.data.message);
          }
        },
        error: function (xhr, status, error) {
          alert("AJAX Error: " + error);
        },
      });
    }
  });
});
