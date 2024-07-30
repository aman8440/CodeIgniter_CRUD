<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/dashboard.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="forgot-pass-container" style="display:flex; flex-direction:column;">
    <div class="heading-top">
      <div class="logo-cebter"><a href="#"><img src="<?php echo base_url(); ?>images/at your service_banner.png"></a>
      </div>
    </div>
    <div class="forgot-pass-form">
      <h2>Forgot Password</h2>
      <form method="POST" action="designController/mail_verification">
        <?php if ($this->session->flashdata('errorMsg')) { ?>
          <div class="error-message-div error-msg"><img
              src="<?php echo base_url(); ?>images/unsucess-msg.png"><?php echo $this->session->flashdata('errorMsg'); ?>
          </div>
        <?php } ?>
        <div class="form-group12">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" class="form-control1" placeholder="Enter Email" required>
        </div>
        <?php echo form_error('email'); ?>
        <button type="submit" class="btn-send-mail">Send Mail</button>
      </form>
    </div>
  </div>
  <script>
    <?php if (isset($forgot_pass_mail) && $forgot_pass_mail): ?>
      Swal.fire({
        title: "Mail Sent!",
        text: "Check Your Inbox!",
        icon: "success",
        confirmButtonColor: "#FF651B",
        iconColor: "#FF651B"
      });
    <?php endif; ?>
  </script>
</body>

</html>