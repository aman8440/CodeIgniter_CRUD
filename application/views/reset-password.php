<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dashboard.css">
</head>

<body>
  <div class="forgot-pass-container" style="display:flex; flex-direction:column;">
    <div class="heading-top">
      <div class="logo-cebter"><a href="#"><img src="<?php echo base_url(); ?>images/at your service_banner.png"></a></div>
    </div>
    <div class="forgot-pass-form">
      <h2>Reset Password</h2>
      <form method="POST" action="<?php echo base_url('designController/update_password'); ?>">
        <div class="form-group12">
          <input type="hidden" name="token" value="<?= $token; ?>">
          <label for="password">New Password:</label>
          <div class="passw" style="display:flex; flex-direction:row;">
            <input type="password" id="password" name="password" class="form-control1" placeholder="Enter Password" required>
            <img src="https://static.thenounproject.com/png/4334035-200.png" width="1%" height="1%"
                    style="display: inline; margin:auto; margin-left: -7%; margin-top: 10px; vertical-align: middle; width: 14px; cursor:pointer; height:15px;"
                    id="togglePassword">
          </div>
          <span id="passwordError"></span>
          <label for="cpassword">Confirm Password:</label>
          <input type="password" id="cpassword" name="cpassword" class="form-control1" placeholder="Enter Confirm Password" required>
          <span id="cpasswordError"></span>
        </div>
        <button type="submit" name="submit" id="submitb" class="btn-send-mail">Change Password</button>
      </form>
    </div>
  </div>
  <script type='text/javascript' src="<?php echo base_url(); ?>js/reset.js"></script>
</body>

</html>