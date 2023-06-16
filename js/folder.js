jQuery(document).ready(function ($) {

  //Add Folder
  $("#saveFolderBtn").on("click", function () {
    var folderName = $("#folderName").val();
    console.log(ajaxurl);
    $.ajax({
      url: ajaxurl,
      type: "POST",
      data: {
        action: "add_folder",
        folderName: folderName,
      },
      success: function (response) {
        if (response.success) {
          alert('Success: ' + 'Added successfully!');
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

  //Edit Folder
  $(document).on("click", ".edit-folder", function (e) {
    e.preventDefault();
    $('#listFolderModal').modal("hide");
    var folderId = $(this).data("id");
    var folderName = $(this).data("folder-name");
    $('#editFolderName').val(folderName);

    $('#saveEditFolderBtn').on('click', function() {
      var folderName = $('#editFolderName').val();
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'update_folder',
          folderId: folderId,
          folderName: folderName
        },
        success: function(response) {
          if (response.success) {
            alert('Success: ' + 'Updated successfully!');
            location.reload();
          } else {
            alert('Error: ' + response.data.message);
          }
        },
        error: function(xhr, status, error) {
          alert('AJAX Error: ' + error);
        }
      });
    });
  });

  //Delete Folder

  $('.delete-folder').on('click', function (e) {
    e.preventDefault();
    var folderId = $(this).data('id');
    if (confirm('Are you sure you want to delete this folder?')) {
      $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
          action: 'delete_folder',
          folderId: folderId,
        },
        success: function (response) {
          if (response.success) {
            location.reload();
          } else {
            alert('Error: ' + response.data.message);
          }
        },
        error: function (xhr, status, error) {
          alert('AJAX Error: ' + error);
        }
      });
    }
  });

});
