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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  <div class="login_section">
    <div class="wrapper relative">
      <div style="display:none" class="meassage_successful_login">You have Successfull Edit </div>
      <div class="heading-top">
        <div class="logo-cebter"><a href="#"><img src="<?php echo base_url(); ?>images/at your service_banner.png"></a>
        </div>
      </div>
      <div class="box">
        <div class="outer_div">

          <h2>Admin <span>Login</span></h2>
          <?php if ($this->session->flashdata('errorMsg')): ?>
            <div class="error-message-div error-msg"><img
                src="<?php echo base_url(); ?>images/unsucess-msg.png"><?php echo $this->session->flashdata('errorMsg'); ?>
            </div>
          <?php endif; ?>
          <form class="margin_bottom" role="form" action="designController/login" method="POST" id="loginform">
            <div class="form-group">
              <label for="exampleInputEmail1">User Name</label>
              <input type="text" name="username" id="username" class="form-control "
                value="<?php echo set_value('username'); ?>" />
              <span id="usernameError"></span>
              <?php echo form_error('username'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <div class="pass" style="display:flex; width:inherit;">
                <input type="password" name="password" id="password" class="form-control"
                  value="<?php echo set_value('password'); ?>" />
                <img src="https://static.thenounproject.com/png/4334035-200.png" width="1%" height="1%"
                  style="display: inline; margin:auto; margin-left: -5%; vertical-align: middle; width: 14px; cursor:pointer; height:15px;"
                  id="togglePassword">
              </div>
              <span id="passwordError"></span>
              <?php echo form_error('password'); ?>
            </div>
            <button type="submit" id="submitbt" name="submit" value="submit" class="btn_login">Login</button>
          </form>
        </div>
      </div>
    </div>
    <script>
      var baseUrl = '<?php echo base_url(); ?>';
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
    </script>
    <script type='text/javascript' src="<?php echo base_url(); ?>js/login.js"></script>
</body>

</html>