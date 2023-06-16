<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Including Custom CSS -->
  <link rel="stylesheet" href="css/main.css">

  <title>Noob Auth</title>
</head>

<body>
  <div class="container-fluid custom-class">
    <div class="row">
      <!-- Sidebar -->
      <?php include('includes/sidebar.php') ?>
      <!-- Main Content -->
      <div class="col-md-9">
        <?php include('dashboard.php'); ?>
      </div>
    </div>
  </div>

  <!-- Add Items Modal -->
  <?php include('includes/modals/add-item-modal.php') ?>
  <!-- Edit Items Modal -->
  <?php include('includes/modals/edit-item-modal.php'); ?>
  <!-- Add Folder Modal -->
  <?php include('includes/modals/add-folder-modal.php'); ?>
  <!-- Edit Folder Modal -->
  <?php include('includes/modals/edit-folder-modal.php'); ?>
  <!-- List Folder Modal -->
  <?php include('includes/modals/list-folder-modal.php'); ?>
  <!-- Add Organization Modal -->
  <?php include('includes/modals/add-organization-modal.php'); ?>
  <!-- Edit Organization Modal -->
  <?php include('includes/modals/edit-organization-modal.php'); ?>
  <!-- List organizations modal -->
  <?php include('includes/modals/list-organization-modal.php'); ?>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>