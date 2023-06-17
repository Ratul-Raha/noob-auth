<div class="page-header">
  <h2 class="float-left">All Items</h2>
  <div class="export-btn float-right">
    <a href="#" class="btn btn-primary" id="export-csv-btn">Export CSV</a>
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
    <?php
    global $wpdb;
    $items_table_name = $wpdb->prefix . 'items';
    $folders_table_name = $wpdb->prefix . 'folders';
    $organizations_table_name = $wpdb->prefix . 'organizations';

    $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
    $items_per_page = 5;

    $items_query = "SELECT items.id, items.name, items.email, items.password, items.url, organizations.organization_name, folders.folder_name, items.folder_id, items.organization_id 
                    FROM $items_table_name AS items 
                    LEFT JOIN $organizations_table_name AS organizations ON items.organization_id = organizations.id 
                    LEFT JOIN $folders_table_name AS folders ON items.folder_id = folders.id";

    $total_items = $wpdb->get_var("SELECT COUNT(*) FROM ($items_query) AS total_items");

    $total_pages = ceil($total_items / $items_per_page);

    $current_page = min($current_page, $total_pages);

    $offset = ($current_page - 1) * $items_per_page;

    $items = $wpdb->get_results($items_query . " LIMIT $offset, $items_per_page");

    foreach ($items as $item) {
      echo '<tr>';
      echo '<th scope="row" class="item-id">' . $item->id . '</th>';
      echo '<td class="item-name">' . $item->name . '</td>';
      echo '<td class="item-email">' . $item->email . '</td>';
      echo '<td class="item-password">' . $item->password . '</td>';
      echo '<td class="item-url"><a href="' . $item->url . '">' . $item->url . '</a></td>';
      echo '<td class="item-organization" data-organization-id=" ' . $item->organization_id . ' ">' . $item->organization_name . '</td>';
      echo '<td class="item-folder" data-folder-id="' . $item->folder_id . '">' . $item->folder_name . '</td>';
      echo '<td>
                <a class="edit-item" data-toggle="modal" data-target="#editItemModal" href="edit_item.php?id=' . $item->id . '"><i class="fas fa-edit"></i></a>
                <a href="" class="delete-item" data-item-id="' . $item->id . '"><i class="fas fa-trash"></i></a>
              </td>';
      echo '</tr>';
    }
    ?>
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


