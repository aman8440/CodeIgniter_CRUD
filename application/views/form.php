<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeIgniter</title>
</head>
<body>
  <div id="id01" class="modal">
    <?= form_open('homeController/', ['id'=>'addForm', 'class'=>'formClass', 'method'=>'POST', 'enctype'=>'multipart/form-data']); ?>
      <h5>Name</h5>
      <input type="text" name="name" value="<?= set_value('name') ?>" placeholder="Enter Name" size="50" />
      <?php echo form_error('name'); ?> 

      <h5>Email Address</h5>
      <input type="email" name="email" value="<?= set_value('email') ?>" placeholder="Enter Email" size="50" />
      <?php echo form_error('email'); ?> 

      <h5>Contact Number</h5>
      <input type="tel" name="phone" value="<?= set_value('phone') ?>" placeholder="Enter Contact Number" size="50" />
      <?php echo form_error('phone'); ?> 

      <h5>Choose File</h5>
      <input type="file" name="file" size="50" />
      <?php echo form_error('file'); ?> 
      <?php 
        if(!empty($err)){ ?>
          <div class="error" style="color:red; display:flex; flex-direction:row;">*
            <?php foreach ($err as $error){
              echo $error;
            } ?>
          </div>  
        <?php  
        }
      ?>
      <h5>Password</h5>
      <input type="password" name="password" value="" placeholder="Enter Password" size="50" />
      <?php echo form_error('password'); ?> 

      <h5>Password Confirm</h5>
      <input type="password" name="passconf" value="" placeholder="Enter Confirm Password" size="50" />
      <?php echo form_error('passconf'); ?> 


      <div><button type="submit" value="submit" style="padding:12px; margin-top:12px; width:425px;">Submit</button></div>
    <?= form_close();?>
  </div>
</body>
</html>