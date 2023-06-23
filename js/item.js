$(document).ready(function () {
  //Generate Password
  function generatePassword(length) {
    
    var chars =
      "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_-+=";
    var password = "";
    for (var i = 0; i < length; i++) {
      var randomIndex = Math.floor(Math.random() * chars.length);
      password += chars[randomIndex];
    }
    return password;
  }

  // Handle Generate Password button click event
  $(document).on("click", "#generatePasswordBtn", function () {
    var generatedPassword = generatePassword(12); 
    $("#password").val(generatedPassword);
  });

  $(document).on("click", "#generatePasswordBtn2", function () {
    var generatedPassword = generatePassword(12);
    $("#editPassword").val(generatedPassword);
  });

  // Form submission
  $("#addItemForm").submit(function (event) {
    event.preventDefault();
    if (validateForm()) {
      console.log("Form is valid");
      $.ajax({
        type: "POST",
        url: myplugin_ajax_object.ajaxurl,
        data: {
          action: "add_item",
          folder: $("#folder").val(),
          organization: $("#organization").val(),
          name: $("#name").val(),
          email: $("#email").val(),
          password: $("#password").val(),
          url: $("#url").val(),
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            alert("Item added successfully");
            $("#addItemModal").hide();
            location.reload();
          } else {
            alert("Failed to add item. Please try again.");
          }
        },
        error: function () {
          alert("An error occurred while adding the item.");
        },
      });
    } else {
      console.log("Form is not valid");
    }
  });

  // Password visibility toggle
  $(document).on("click", ".password-toggle-icon", function () {
    var passwordField = $(this).find("i");
    var passwordInputs = $(".password-input");
  
    passwordInputs.each(function () {
      var passwordInput = $(this);
      var inputType = passwordInput.attr("type");
  
      if (inputType === "password") {
        passwordInput.attr("type", "text");
        passwordField.removeClass("fa-eye");
        passwordField.addClass("fa-eye-slash");
      } else if (inputType === "text") {
        passwordInput.attr("type", "password");
        passwordField.removeClass("fa-eye-slash");
        passwordField.addClass("fa-eye");
      }
    });
  });
  
  
    // Form validation
  function validateForm() {
    var valid = true;
    var nameInput = $("#name");
    var emailInput = $("#email");
    var passwordInput = $("#password");
    var urlInput = $("#url");

    // Validate Name
    if (nameInput.val().length > 20) {
      nameInput.addClass("is-invalid");
      valid = false;
    } else {
      nameInput.removeClass("is-invalid");
    }

    // Validate Email
    if (!isValidEmail(emailInput.val())) {
      emailInput.addClass("is-invalid");
      valid = false;
    } else {
      emailInput.removeClass("is-invalid");
    }

    // Validate URL
    if (!isValidURL(urlInput.val())) {
      urlInput.addClass("is-invalid");
      valid = false;
    } else {
      urlInput.removeClass("is-invalid");
    }

    return valid;
  }

  // Email validation using regular expression
  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // URL validation using regular expression
  function isValidURL(url) {
    var urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
    return urlRegex.test(url);
  }

  //Fill Edit Modal with Data
  $(".edit-item").on("click", function () {
    // Get the row data
    var $row = $(this).closest("tr");
    var itemId = $row.find(".item-id").text();
    var folder = $row.find(".item-folder").text();
    var folderId = $row.find(".item-folder").data("folder-id");
    var organization = $row.find(".item-organization").text();
    var organizationId = $row
      .find(".item-organization")
      .data("organization-id");
    var name = $row.find(".item-name").text();
    var email = $row.find(".item-email").text();
    var password = $row.find(".item-password").text();
    var url = $row.find(".item-url a").attr("href");

    // Populate the form fields in the modal with the retrieved data
    $("#editFolderId").val(folderId);
    $("#editOrganizationId").val(organizationId);
    $("#editItemModal #editItemId").val(itemId);
    $("#editItemModal #default-folder").val(folder).text(folder);
    $("#editItemModal #default-organization")
      .val(organization)
      .text(organization);
    $("#editItemModal #editName").val(name);
    $("#editItemModal #editEmail").val(email);
    $("#editItemModal #editPassword").val(password);
    $("#editItemModal #editURL").val(url);

    // Open the modal
    $("#editItemModal").modal("show");
  });

  // Edit Item
  $("#editItemForm").submit(function (event) {
    event.preventDefault();
    var itemID = $("#editItemId").val();
    var folder =
      $("#editFolder option:selected").data("folder-id") ||
      $("#editFolderId").val();
    var organization =
      $("#editOrganization option:selected").data("organization-id") ||
      $("#editOrganizationId").val();
    console.log(folder, organization);
    var name = $("#editName").val();
    var email = $("#editEmail").val();
    var password = $("#editPassword").val();
    var url = $("#editURL").val();

    $.ajax({
      type: "POST",
      url: ajaxurl,
      data: {
        action: "update_item",
        folder: folder,
        organization: organization,
        name: name,
        email: email,
        password: password,
        url: url,
        itemID: itemID,
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          alert("Item updated successfully");
          $("#editItemModal").hide();
        } else {
          alert("Failed to update item. Please try again.");
        }
      },
      error: function (err) {
        console.log("vvvv", err);
        alert("An error occurred while updating the item.");
      },
    });
  });

  //Delete Item
  $(document).on("click", ".delete-item", function () {
    var itemId = $(this).data("item-id");
    alert("SDDF")
    if (confirm("Are you sure you want to delete this item?")) {
      $.ajax({
        type: "POST",
        url: myplugin_ajax_object.ajaxurl,
        data: {
          action: "delete_item",
          itemId: itemId,
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            alert("Item deleted successfully");
          } else {
            alert("Failed to delete item. Please try again.");
          }
        },
        error: function () {
          alert("An error occurred while deleting the item.");
        },
      });
    }
  });

  //Export Csv

    $('#export-csv-btn').on('click', function(e) {
      e.preventDefault();
      exportItemsCSV();
    });
  
    function exportItemsCSV() {
      $.post(
        myplugin_ajax_object.ajaxurl,
        {
          action: 'export_items_csv',
        },
        function(response) {
          // Create a temporary link to trigger the download
          var link = document.createElement('a');
          link.href = response.data.file;
          link.download = response.data.filename;
          link.style.display = 'none';
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        },
        'json'
      );
    }

      // Make table headers draggable
 
    



});
