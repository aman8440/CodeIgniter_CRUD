<?php
defined('BASEPATH') or exit('No direct script access allowed');
print_r($arr->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>CodeIgniter</title>
</head>

<body>
  <div id="id01" class="modal">
    <?php
    if (!empty($arr->id)) { ?>
      <?= form_open('crudController/update-data/', ['id' => 'addForm', 'class' => 'formClass', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>
    <?php } else { ?>
      <?= form_open('crudController/add-data/', ['id' => 'addForm', 'class' => 'formClass', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>
    <?php }
    ?>
    <div class="container">
      <p style="margin-bottom: 12px;"><span class="error">*Required field</span></p>
      <input type="hidden" name="id" value="<?= set_value('id', (!empty($arr->id) ? $arr->id : '')) ?>">
      <label for="name"><b>Full Name</b></label>
      <input type="text" id="name" name="name" value="<?= set_value('name', (!empty($arr->name) ? $arr->name : '')) ?>"
        placeholder="Enter Your Full Name" size="60" />
      <span id="nameError"></span>
      <?php echo form_error('name'); ?>

      <label for="email"><b>Email</b></label>
      <input type="email" id="email" name="email"
        value="<?= set_value('email', (!empty($arr->email) ? $arr->email : '')) ?>" placeholder="Enter Your Email"
        size="60" />
      <span id="emailError"></span>
      <?php echo form_error('email'); ?>

      <label for="phone"><b>Contact Number</b></label>
      <input type="tel" id="phone" name="phone"
        value="<?= set_value('phone', (!empty($arr->phone) ? $arr->phone : '')) ?>" placeholder="Enter Contact Number"
        size="60" />
      <span id="phoneError"></span>
      <?php echo form_error('phone'); ?>

      <label for="gender"><b>Gender</b></label>
      <div class="gender_style">
        <input type="radio" name="gender" value="female" <?= set_radio('gender', 'female', (!empty($arr->id) && $arr->gender == 'female')); ?>>Female
        <input type="radio" name="gender" value="male" <?= set_radio('gender', 'male', (!empty($arr->id) && $arr->gender == 'male')); ?>>Male
        <input type="radio" name="gender" value="other" <?= set_radio('gender', 'other', (!empty($arr->id) && $arr->gender == 'other')); ?>>Other
      </div>
      <span id="genderError"></span>
      <?php echo form_error('gender'); ?>

      <label for="file"><b>Choose File</b></label>
      <input type="file" name="file" value="" size="60" />
      <?php if (!empty($arr->id)) { ?>
        <img src="<?= base_url() ?>/uploads/<?= $arr->image ?>" alt="" height="100" width="100">

      <?php } ?>
      <span id="fileError"></span>
      <?php echo form_error('file'); ?>
      <input type="hidden" name="file_old" value="<?= !empty($arr->image) ? $arr->image : '' ?>">
      <?php
      if (!empty($err)) { ?>
        <div class="error" style="color:red; display:flex; flex-direction:row;">*
          <?php foreach ($err as $error) {
            echo $error;
          } ?>
        </div>
      <?php
      }
      ?>
      <?php
      if (!empty($arr->id)) { ?>
        <label for="status" style="display:block;"><b>Status</b></label>
        <div class="gender_style" style="display:block;">
          <input type="radio" id="status_yes" name="status" value="yes" <?= set_radio('status', 'yes', (!empty($arr->id) && $arr->status == 'yes')); ?> size="70">Yes
          <input type="radio" id="status_no" name="status" value="no" <?= set_radio('status', 'no', (!empty($arr->id) && $arr->status == 'no')); ?> size="70">No
        </div>
        <button type="submit" id="submitBtn" value="submit">Update</button>
        <button type="button" onclick="window.location.href='<?php echo base_url(); ?>crudController/all-data'"
          class="cancelbtn">Cancel</button>
      <?php } else { ?>
        <label for="password"><b>Password</b></label>
        <div class="password-field" style="display:flex; width:100%;">
          <input type="password" id="password" name="password" value="" placeholder="Enter Your Password" size="60" />
          <img src="https://static.thenounproject.com/png/4334035-200.png" width="1%" height="1%"
            style="display: inline; margin:auto; margin-left: -5%; vertical-align: middle; width: 20px; cursor:pointer;"
            id="togglePassword">
        </div>
        <span id="passwordError"></span>
        <?php echo form_error('password'); ?>

        <label for="passconf"><b>Confirm Password</b></label>
        <input type="password" id="passconf" name="passconf" value="" placeholder="Enter Your Confirm Password"
          size="60" />
        <span id="passconfError"></span>
        <?php echo form_error('passconf'); ?>
        <button type="submit" id="submitBtn" value="submit">Submit</button>
        <button type="button" onclick="window.location.href='<?php echo base_url(); ?>crudController/all-data'"
          class="cancelbtn">Cancel</button>
      <?php }
      ?>
    </div>
    <?= form_close(); ?>
  </div>
  <script>
    var baseUrl = '<?php echo base_url(); ?>';
  </script>
  <script type='text/javascript' src="<?php echo base_url(); ?>js/index.js"></script>
</body>

</html>