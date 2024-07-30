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
          <li>Welcome, <?php echo $user['username']; ?></li>
          <li><a href="<?php echo base_url('designController/logout'); ?>">Log Out</a></li>
        </ul>
      </div>
      <div class="nav_top">
        <ul>
          <li class="active"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
          <li><a href="">Users</a></li>
          <li><a href="">Setting</a></li>
          <li><a href="">Configuration</a></li>
        </ul>

      </div>
    </div>
  </div>
  <div class="clear"></div>
  <div class="clear"></div>
  <div class="content">
    <div class="wrapper">
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
        <h1>Dashboard</h1>
        <div class="tab">
          <ul>
            <li class="selected"><a href=""><span class="left"><img class="selected-act"
                    src="<?php echo base_url(); ?>images/dashboard-hover.png"><img
                    src="<?php echo base_url(); ?>images/dashboard.png" class="hidden" /></span><span
                  class="right">Dashboard</span></a></li>
            <li><a href=""><span class="left"><img class="selected-act"
                    src="<?php echo base_url(); ?>images/user-hover.png"><img class="hidden"
                    src="<?php echo base_url(); ?>images/user.png" /></span><span class="right">Users</span></a></li>
            <li><a href=""><span class="left"><img class="selected-act"
                    src="<?php echo base_url(); ?>images/setting-hover.png"><img class="hidden"
                    src="<?php echo base_url(); ?>images/setting.png" /></span><span class="right">Setting</span></a>
            </li>
            <li><a href=""><span class="left"><img class="selected-act"
                    src="<?php echo base_url(); ?>images/configuration-hover.png"><img class="hidden"
                    src="<?php echo base_url(); ?>images/configuration.png" /></span><span
                  class="right">Configuration</span></a>
            </li>

          </ul>
        </div>
      </div>

    </div>
  </div>
  <div class="footer">
    <div class="wrapper">
      <p>Copyright © 2014 yourwebsite.com. All rights reserved</p>
    </div>

  </div>
  <script>
    <?php if ($this->session->flashdata('successMsg')): ?>
      Swal.fire({
        title: 'Success!',
        text: "<?php echo $this->session->flashdata('successMsg'); ?>",
        icon: 'success',
        confirmButtonColor: '#FF651B',
        iconColor: '#FF651B'
      });
    <?php endif; ?>
  </script>
</body>

</html>