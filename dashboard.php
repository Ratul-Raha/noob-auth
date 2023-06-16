<h2>All Items</h2>
<table class="table table-striped">
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

    $items = $wpdb->get_results("SELECT items.id, items.name, items.email, items.password, items.url, organizations.organization_name, folders.folder_name, items.folder_id, items.organization_id 
                            FROM $items_table_name AS items 
                            LEFT JOIN $organizations_table_name AS organizations ON items.organization_id = organizations.id 
                            LEFT JOIN $folders_table_name AS folders ON items.folder_id = folders.id");
    $data_per_page = 5;
    $total_pages = ceil(count($items));

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
                <a href="delete_item.php?id=' . $item->id . '"><i class="fas fa-trash"></i></a>
              </td>';
      echo '</tr>';
    }
    ?>
  </tbody>
</table>