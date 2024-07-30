<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css"> 
  <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/1/10/MS_Project_Logo.png"
    type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>codeigniter</title>
</head>
<body>
  <div class="container-3">
    <h2 class="send-heading">Send Email</h2>
    <?php 
      echo $this->session->set_flashdata('email_sent');
    ?>
    <form action="sendEmailController/send_email" id="emailForm" class="formClass" method="POST">
      <input type = "email" name = "email" class="input-email" placeholder="Enter Mail" required />
      <input type="text" id="subject" name="subject" placeholder="Enter Subject" />
      <textarea name="message" id="message" rows="10" placeholder="Enter message here..." style="width:100%;"></textarea>
      <button type="submit" id="submitBtn" class="btn-email" value="submit">Send Mail</button>
    </form>
  </div>
</body>
</html>