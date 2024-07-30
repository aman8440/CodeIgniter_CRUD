<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeIgniter</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/table.css">
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/1/10/MS_Project_Logo.png"
    type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="main">
    <div class="card-header">
      <h1 class="heading">Users</h1>
      <div class="search-container">
        <form action="<?php echo base_url(); ?>crudController/all-data" method="GET">
          <input type="text" value="<?php echo $this->input->get('search'); ?>" placeholder="Search any details"
            name="search">
          <button type="submit"><i class="fa fa-search"></i>Search</button>
        </form>
      </div>
      <a href="add_data" class="btn-add btn" style="width:auto;">Add</a>
    </div>
    <div class="user_data">
      <?php if($this->session->flashdata('successMsg')){ ?>
              <div class="alert warning">
                <input type="checkbox" id="alert4" />
                <label class="close" title="close" for="alert4">
                  <i class="icon-remove">&#x2715;</i>
                </label>
                <p class="text">
                  <strong>Hey!</strong> <?=$this->session->flashdata('successMsg') ?>
                </p>
              </div>
       <?php }?> 
       <?php if($this->session->flashdata('updateMsg')){ ?>
              <div class="alert warning">
                <input type="checkbox" id="alert4" />
                <label class="close" title="close" for="alert4">
                  <i class="icon-remove">&#x2715;</i>
                </label>
                <p class="text">
                  <strong>Hey!</strong> <?=$this->session->flashdata('updateMsg') ?>
                </p>
              </div>
       <?php }?> 
       <?php if($this->session->flashdata('deleteMsg')){ ?>
              <div class="alert warning">
                <input type="checkbox" id="alert4" />
                <label class="close" title="close" for="alert4">
                  <i class="icon-remove">&#x2715;</i>
                </label>
                <p class="text">
                  <strong>Hey!</strong> <?=$this->session->flashdata('deleteMsg') ?>
                </p>
              </div>
       <?php }?> 
      <table class="table">
        <thead>
          <tr>
            <th><a href="?sort_by=id&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">ID<span
                  class="<?= $sort_by == 'id' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th><a
                href="?sort_by=name&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">Name<span
                  class="<?= $sort_by == 'name' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th><a
                href="?sort_by=email&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">Email<span
                  class="<?= $sort_by == 'email' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th><a
                href="?sort_by=phone&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">Contact
                Number<span class="<?= $sort_by == 'phone' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th><a
                href="?sort_by=gender&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">Gender<span
                  class="<?= $sort_by == 'gender' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th>File</th>
            <th><a
                href="?sort_by=status&order=<?php echo $this->input->get('order') == 'asc' ? 'desc' : 'asc'; ?>">Status<span
                  class="<?= $sort_by == 'status' ? ($order == 'asc' ? 'asc-icon' : 'desc-icon') : '' ?> sort-icon"></span></a></th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($arr)) {
            foreach ($arr as $key => $value) {
              ?>
              <tr>
                <td><?= $key+1+$offset ?></td>
                <td><?= $value->name ?></td>
                <td><?= $value->email ?></td>
                <td><?= $value->phone ?></td>
                <td><?= $value->gender ?></td>
                <td><img src="<?= base_url() ?>uploads/<?= $value->image ?>" alt="" height="100" width="100"></td>
                <td><?= $value->status ?></td>
                <td colspan='2'>
                  <div class="btn-action">
                    <a href="all-data/<?= $value->id ?>" class="btn-up btn-add" style="width:auto;">Edit</a>
                    <a href="javascript:void(0);" onclick="confirmDelete(<?= $value->id ?>)" class="btn-del btn-add" style="width:auto;">Delete</a>
                  </div>
                </td>
              </tr>
            <?php }
          } else {
            echo "<tr><td colspan='12' class='no-records'>No records found</td></tr>";
          } ?>
        </tbody>
      </table>
    </div>
    <div class="pagination">
      <?php echo '<a class="pagesBtn"' . $pagination . '</a>';?>
      <div class="dropdown">
        <form action="<?php echo base_url(); ?>crudController/all-data" method="GET">
          <select class="countryDropdown" name="limit" onchange="this.form.submit()">
            <option value="5" <?php echo $limit == 5 ? 'selected' : ''; ?>>5</option>
            <option value="10" <?php echo $limit == 10 ? 'selected' : ''; ?>>10</option>
            <option value="15" <?php echo $limit == 15 ? 'selected' : ''; ?>>15</option>
            <option value="20" <?php echo $limit == 20 ? 'selected' : ''; ?>>20</option>
          </select>
        </form>
      </div>
      <?php echo "Total Records: $total_records"; ?>  
  </div>
  </div>
  <script>
  function confirmDelete(id) {
    if (confirm('Do you want to delete?')) {
      window.location.href = 'delete-data/' + id;
    }
  }
</script>
</body>

</html>