<?php
require_once 'functions/DashBoardPage.php'; //
?>


<head>
  <title>Dashboard</title>
</head>

<body>
  <div class="page-content">
    <div class="page-header">
      <h2 class="float-left">All Items</h2>
      <div class="export-btn float-right">
        <!-- <a href="#" class="btn btn-primary" id="export-csv-btn">Export CSV</a> -->
      </div>
      <div class="clearfix"></div>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">URL</th>
          <th scope="col">Organization</th>
          <th scope="col">Folder</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($items as $item) { ?>
          <tr>
            <th scope="row" class="item-id"><?php echo $item['id']; ?></th>
            <td class="item-name"><?php echo $item['name']; ?></td>
            <td class="item-email"><?php echo $item['email']; ?></td>
            <td class="item-password"><?php echo $item['password']; ?></td>
            <td class="item-url"><a href="<?php echo $item['url']; ?>"><?php echo $item['url']; ?></a></td>
            <td class="item-organization" data-organization-id="<?php echo $item['organization_id']; ?>"><?php echo $item['organization_name']; ?></td>
            <td class="item-folder" data-folder-id="<?php echo $item['folder_id']; ?>"><?php echo $item['folder_name']; ?></td>
            <td>
              <a class="edit-item" data-toggle="modal" data-target="#editItemModal" href="edit_item.php?id=<?php echo $item['id']; ?>"><i class="fas fa-edit"></i></a>
              <a href="" class="delete-item" data-item-id="<?php echo $item['id']; ?>"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="pagination-box">
      <?php
      // Display pagination links
      $pagination_args = array(
        'base' => add_query_arg('paged', '%#%'),
        'format' => '',
        'total' => $total_pages,
        'current' => $current_page,
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 2,
        'prev_next' => true,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
      );
      echo '<div class="pagination">';
      echo paginate_links($pagination_args);
      echo '</div>';
      ?>
    </div>
  </div>
</body>