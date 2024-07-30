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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
          <li class="active"><a href=" <?php echo base_url('dashboard'); ?> ">Dashboard</a></li>
          <li><a href="">Users</a></li>
          <li><a href="  ">Setting</a></li>
          <li><a href="  ">Configuration</a></li>
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
          <li><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
          <li><a href="<?php echo base_url(); ?>list">List Users</a></li>
          <?php
              if (empty($arr->id)) { ?>
                  <li>Add Users</li>
            <?php }
            else{?>
                  <li>Edit Users</li>
          <?php }?>
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
        <?php
          if (empty($arr->id)) { ?>
              <h1>Add Users</h1>
        <?php }
        else{?>
              <h1>Edit Users</h1>
        <?php }?>
        <div class="list-contet">
          <?php
          if (!empty($arr->id)) { ?>
            <?= form_open('designController/update_data', ['id' => 'addForm', 'class' => 'form-edit', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>
          <?php } else { ?>
            <?= form_open('designController/add_data', ['id' => 'addForm', 'class' => 'form-edit', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>
          <?php }
          ?>
          <?php if ($this->session->flashdata('errorMsg')){ ?>
            <div class="error-message-div error-msg"><img
                src="<?php echo base_url(); ?>images/unsucess-msg.png"><?php echo $this->session->flashdata('errorMsg'); ?>
            </div>
          <?php }?>
          <input type="hidden" name="id" value="<?= set_value('id', (!empty($arr->id) ? $arr->id : '')) ?>">
          <div class="form-row">
            <div class="form-label">
              <label>User Name : <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="username" id="username"
                value="<?= set_value('username', (!empty($arr->username) ? $arr->username : '')) ?>"
                placeholder="Enter Username" />
            </div>
            <span id="usernameError1"></span>
            <?php echo form_error('username'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>First Name : <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="fname" id="fname"
                value="<?= set_value('fname', (!empty($arr->fname) ? $arr->fname : '')) ?>"
                placeholder="Enter First Name" />
            </div>
            <span id="fnameError"></span>
            <?php echo form_error('fname'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Last Name : <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="lname" id="lname"
                value="<?= set_value('lname', (!empty($arr->lname) ? $arr->lname : '')) ?>"
                placeholder="Enter Last Name" />
            </div>
            <span id="lnameError"></span>
            <?php echo form_error('lname'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Email: <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="email" id="email"
                value="<?= set_value('email', (!empty($arr->email) ? $arr->email : '')) ?>" placeholder="Enter Email" />
            </div>
            <span id="emailError"></span>
            <?php echo form_error('email'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Security Email: <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="semail" id="semail"
                value="<?= set_value('semail', (!empty($arr->semail) ? $arr->semail : '')) ?>"
                placeholder="Enter Security Email" />
            </div>
            <span id="semailError"></span>
            <?php echo form_error('semail'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Time Lag: <span></span></label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="timelag" id="timelag"
                value="<?= set_value('timelag', (!empty($arr->timelag) ? $arr->timelag : '')) ?>"
                placeholder="Enter Time Lag" />
            </div>
            <span id="timelagError"></span>
            <?php echo form_error('timelag'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Registration type: <span></span> </label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="register" id="register"
                value="<?= set_value('register', (!empty($arr->register) ? $arr->register : '')) ?>"
                placeholder="Enter Registration Type" />
            </div>
            <span id="registerError"></span>
            <?php echo form_error('register'); ?>
          </div>
          <div class="form-row radio-row">
            <div class="form-label">
              <label>Zero Knowledge: <span></span> </label>
            </div>
            <div class="input-field">
              <label><input type="radio" name="zeroknow" value="yes" <?= set_radio('zeroknow', 'yes', (!empty($arr->id) && $arr->zeroknow == 'yes')); ?>> <span>Yes </span></label><label> <input type="radio" name="zeroknow"
                  value="no" <?= set_radio('zeroknow', 'no', (!empty($arr->id) && $arr->zeroknow == 'no')); ?>>
                <span>No</span> </label>
            </div>
            <span id="zeroknowError"></span>
            <?php echo form_error('zeroknow'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Phone: <span></span> </label>
            </div>
            <div class="input-field">
              <input type="text" class="search-box" name="phone" id="phone"
                value="<?= set_value('phone', (!empty($arr->phone) ? $arr->phone : '')) ?>" placeholder="Enter Phone" />
            </div>
            <span id="phoneError"></span>
            <?php echo form_error('phone'); ?>
          </div>
          <div class="form-row">
            <div class="form-label">
              <label>Country: <span></span> </label>
            </div>
            <div class="input-field">
              <div class="select">
                <select name="country">
                  <option value="India" <?= set_select('country', 'India', (!empty($arr->id) && $arr->country == 'India')); ?>>India</option>
                  <option value="UK" <?= set_select('country', 'UK', (!empty($arr->id) && $arr->country == 'UK')); ?>>UK
                  </option>
                  <option value="USA" <?= set_select('country', 'USA', (!empty($arr->id) && $arr->country == 'USA')); ?>>
                    USA</option>
                  <option value="Russia" <?= set_select('country', 'Russia', (!empty($arr->id) && $arr->country == 'Russia')); ?>>Russia</option>
                  <option value="China" <?= set_select('country', 'China', (!empty($arr->id) && $arr->country == 'China')); ?>>China</option>
                </select>
              </div>
            </div>
            <span id="countryError"></span>
            <?php echo form_error('country'); ?>
          </div>
          <?php
          if (empty($arr->id)) { ?>
            <div class="form-row radio-row">
              <div class="form-label">
                <label>Admin: <span></span> </label>
              </div>
              <div class="input-field">
                <label><input type="radio" name="is_admin" value="yes" <?= set_radio('is_admin', 'yes', (!empty($arr->id) && $arr->is_admin == 'yes')); ?>> <span>Yes </span></label><label> <input type="radio" name="is_admin"
                    value="no" <?= set_radio('is_admin', 'no', (!empty($arr->id) && $arr->is_admin == 'no')); ?>>
                  <span>No</span> </label>
              </div>
              <span id="is_adminError"></span>
              <?php echo form_error('is_admin'); ?>
            </div>
            <div class="form-row">
              <div class="form-label">
                <label>Password: <span></span></label>
              </div>
              <div class="input-field">
                <input type="password" class="search-box" name="password" id="password1" placeholder="Enter Password" />
                <img src="https://static.thenounproject.com/png/4334035-200.png" width="1%" height="1%"
                  style="display: inline; margin:auto; margin-left: -5%; margin-top: 10px; vertical-align: middle; width: 14px; cursor:pointer; height:15px;"
                  id="togglePassword1">
              </div>
              <span id="passwordError"></span>
              <?php echo form_error('password'); ?>
            </div>
          <?php } ?>
          <?php
          if (!empty($arr->id)) { ?>
              <div class="form-row radio-row">
                <div class="form-label">
                  <label>Payment Status: <span></span> </label>
                </div>
                <div class="input-field">
                  <label><input type="radio" name="payment" value="yes" <?= set_radio('payment', 'yes', (!empty($arr->id) && $arr->payment == 'yes')); ?>> <span>Yes </span></label><label> <input type="radio" name="payment"
                      value="no" <?= set_radio('payment', 'no', (!empty($arr->id) && $arr->payment == 'no')); ?>>
                    <span>No</span> </label>
                </div>
              </div>
          <?php } ?>
          <div class="form-row">
            <div class="form-label">
              <label><span></span> </label>
            </div>
            <div class="input-field">
              <input type="submit" id="submitBtn" class="submit-btn" value="Save">
            </div>
          </div>
          <?= form_close(); ?>
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
    var baseUrl = '<?php echo base_url(); ?>';
  </script>
  <script type='text/javascript' src="<?php echo base_url(); ?>js/main.js"></script>
</body>

</html>

