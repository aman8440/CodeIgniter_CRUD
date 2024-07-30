<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div class="header">
    <div class="wrapper">
      <div class="logo"><a href="#"><img src="<?php echo base_url(); ?>images/logo.png"></a></div>


      <div class="right_side">
        <ul>
          <li> <?php if (isset($user)): ?>
              Welcome, <?php echo $user['username']; ?>
            <?php endif; ?>
          </li>
          <li><a href="<?php echo base_url('designController/logout'); ?>">Log Out</a></li>
        </ul>
      </div>
      <div class="nav_top">
        <ul>
          <li class="active"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
          <li><a href=" ">Users</a></li>
          <li><a href="  ">Setting</a></li>
          <li><a href=" ">Configuration</a></li>
        </ul>

      </div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="clear"></div>
  <div class="content">
    <div class="wrapper">
      <div class="bedcram">
        <ul>
          <li><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
          <li>List Users</li>
        </ul>
      </div>
      <div class="left_sidebr">
        <ul>
          <li><a href="<?php echo base_url('dashboard'); ?>" class="dashboard">Dashboard</a></li>
          <li><a href="" class="user">Users</a>
            <ul class="submenu">
              <li><a href="<?php echo base_url(); ?>list">Mange Users</a></li>

            </ul>

          </li>
          <li><a href="" class="Setting">Setting</a>
            <ul class="submenu">
              <li><a href="<?php echo base_url('send'); ?>">Chnage Password</a></li>
              <li><a href="">Mange Contact Request</a></li>
              <li><a href="#">Manage Login Page</a></li>

            </ul>

          </li>
          <li><a href="" class="social">Configuration</a>
            <ul class="submenu">
              <li><a href="">Payment Settings</a></li>
              <li><a href="">Manage Email Content</a></li>
              <li><a href="#">Manage Limits</a></li>
            </ul>

          </li>
        </ul>
      </div>
      <div class="right_side_content">
        <h1>List Users</h1>
        <div class="list-contet">
          <div class="form-left">
            <div class="form">
              <form role="form" id="search-form" method="GET" action="<?php echo base_url('list'); ?>">
                <div class="order-12" style="display:flex; flex-direction:row;">
                  <div class="sort-order" style="display:flex; flex-direction: column;">
                    <label>Sort By : </label>
                    <div class="select">
                      <select name="sort_by" onchange="this.form.submit()">
                        <option value="username" <?php echo $sort_by == 'username' ? 'selected' : ''; ?>>User Name
                        </option>
                        <option value="fname" <?php echo $sort_by == 'fname' ? 'selected' : ''; ?>>First Name</option>
                        <option value="lname" <?php echo $sort_by == 'lname' ? 'selected' : ''; ?>>Last Name</option>
                        <option value="email" <?php echo $sort_by == 'email' ? 'selected' : ''; ?>>E-Mail</option>
                        <option value="phone" <?php echo $sort_by == 'phone' ? 'selected' : ''; ?>>Phone</option>
                        <option value="country" <?php echo $sort_by == 'country' ? 'selected' : ''; ?>>Country</option>
                      </select>
                    </div>
                    <label>Sort Order : </label>
                    <div class="select">
                      <select name="sort_order" onchange="this.form.submit()">
                        <option value="asc" <?php echo $sort_order == 'asc' ? 'selected' : ''; ?>>Ascending</option>
                        <option value="desc" <?php echo $sort_order == 'desc' ? 'selected' : ''; ?>>Descending</option>
                      </select>
                    </div>
                  </div>
                  <div class="search12" style="margin-top:23px;">
                    <input type="text" class="search-box search-upper" name="search" placeholder="Search.."
                      value="<?php echo htmlspecialchars($this->input->get('search'), ENT_QUOTES, 'UTF-8'); ?>" />
                    <input type="submit" class="submit-btn" value="Search">
                  </div>
                </div>
              </form>
            </div>
            <a href="add" class="submit-btn add-user">Add More Users</a>
          </div>
          <?php if ($this->session->flashdata('errorMsg')) { ?>
            <div class="error-message-div error-msg"><img
                src="<?php echo base_url(); ?>images/unsucess-msg.png"><?php echo $this->session->flashdata('errorMsg'); ?>
            </div>
          <?php } ?>
          <table width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th width="10px">S.no</th>
                <th width="100px">User Name</th>
                <th width="98px">First Name</th>
                <th width="100px">Last Name</th>
                <th width="113px"> E-Mail</th>
                <th width="97px">Phone</th>
                <th width="97px">Country</th>
                <th width="50px" class="payment">Payment<br>Status</th>
                <th width="126px">Action</th>

              </tr>
              <tr>
                <?php if (!empty($users)) { ?>
                  <?php foreach ($users as $index => $user): ?>
                  <tr>
                    <td><?php echo $index + 1 + $offset; ?></td>
                    <td><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['lname'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($user['country'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="payment">
                      <img
                        src="<?php echo base_url(); ?>images/<?php echo ($user['payment'] == 'yes') ? 'correct' : 'cross'; ?>.png">
                    </td>
                    <td>
                      <a href="edit/<?= $user['id'] ?>"><img src="<?php echo base_url(); ?>images/edit-icon.png"></a>
                      <a href="javascript:void(0);" onclick="confirmDelete(<?= $user['id'] ?>)"><img
                          src="<?php echo base_url(); ?>images/cross.png"></a>
                      <a href="user/<?= $user['id'] ?>"><img src="images/view.png"></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php } else { ?>
                <tr>
                  <td colspan="9" style="text-align:center;">No users found.</td>
                </tr>
              <?php } ?>
              </tr>

            </tbody>
          </table>
          <div class="paginaton-div">
            <ul>
              <?php echo $links; ?>
            </ul>
          </div>

        </div>
      </div>

    </div>
  </div>
  <div class="footer">
    <div class="wrapper">
      <p>Copyright © 2014 yourwebsite.com. All rights reserved</p>
    </div>
    <script>
      function confirmDelete(id) {
        if (confirm('Do you want to delete?')) {
          window.location.href = 'designController/delete_data/' + id;
        }
      }
      <?php if ($this->session->flashdata('successMsg')) { ?>
        Swal.fire({
          title: 'Success!',
          text: "<?php echo $this->session->flashdata('successMsg'); ?>",
          icon: 'success',
          confirmButtonColor: '#FF651B',
          iconColor: '#FF651B'
        });
      <?php } else if ($this->session->flashdata('errorMsg')) { ?>
          Swal.fire({
            title: 'Error!',
            text: "<?php echo $this->session->flashdata('errorMsg'); ?>",
            icon: 'error',
            confirmButtonColor: '#FF651B',
            iconColor: '#FF651B'
          });
      <?php } ?>
    </script>
  </div>

</body>

</html>