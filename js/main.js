const id= document.querySelector('input[name="id"]');
if(id && isEmpty(id.value)){
  const toggle = document.querySelector('#togglePassword1');
  const password = document.querySelector('#password1');
  toggle.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    if (toggle.src.match("https://icons.veryicon.com/png/o/miscellaneous/hekr/action-hide-password.png")) {
      toggle.src ="https://static.thenounproject.com/png/4334035-200.png";
    } else {
      toggle.src ="https://icons.veryicon.com/png/o/miscellaneous/hekr/action-hide-password.png";
    }
  }); 
}
function isEmpty(str) {
  return !str || str.trim() === '';
}

$(document).ready(function() {
  $('#email').blur(function() {
    var email = $(this).val();
    $.ajax({
      url: baseUrl + 'designController/check_email',
      method: 'POST',
      data: { email: email },
      dataType: 'html',
      error: function() {
        $('#emailError').html("An error has occurred.");
      },
      success: function(response) {
        $('#emailError').html(response);
      }
    });
  });

  $('#semail').blur(function() {
    var semail = $(this).val();
    $.ajax({
      url: baseUrl + 'designController/check_semail',
      method: 'POST',
      data: { semail: semail },
      dataType: 'html',
      error: function() {
        $('#semailError').html("An error has occurred.");
      },
      success: function(response) {
        $('#semailError').html(response);
      }
    });
  });

  $('#phone').blur(function() {
    var phone = $(this).val();
    $.ajax({
      url: baseUrl + 'designController/check_phone',
      method: 'POST',
      data: { phone: phone },
      dataType: 'html',
      error: function() {
        $('#phoneError').html("An error has occurred.");
      },
      success: function(response) {
        $('#phoneError').html(response);
      }
    });
  });

  $('#username').blur(function() {
    var username = $(this).val();
    $.ajax({
      url: baseUrl + 'designController/check_username',
      method: 'POST',
      data: { username: username },
      dataType: 'html',
      error: function() {
        $('#usernameError1').html("An error has occurred.");
      },
      success: function(response) {
        $('#usernameError1').html(response);
      }
    });
  });
});

document.getElementById('submitBtn').addEventListener('click', function(event) {
  console.log('here');
  let valid = true;
  const username = document.getElementById('username').value;
  const fname = document.getElementById('fname').value;
  const lname = document.getElementById('lname').value;
  const email = document.getElementById('email').value;
  const semail = document.getElementById('semail').value;
  const timelag = document.getElementById('timelag').value;
  const register = document.getElementById('register').value;
  const zeroknow = document.querySelector('input[name="zeroknow"]:checked');
  const phone = document.getElementById('phone').value;
  const country = document.querySelector('select[name="country"]').value;
  const is_admin = document.querySelector('input[name="is_admin"]:checked');
  const password = document.getElementById('password1').value;

  document.getElementById('usernameError1').innerHTML = '';
  document.getElementById('fnameError').innerHTML = '';
  document.getElementById('lnameError').innerHTML = '';
  document.getElementById('emailError').innerHTML = '';
  document.getElementById('semailError').innerHTML = '';
  document.getElementById('timelagError').innerHTML = '';
  document.getElementById('registerError').innerHTML = '';
  document.getElementById('zeroknowError').innerHTML = '';
  document.getElementById('phoneError').innerHTML = '';
  document.getElementById('countryError').innerHTML = '';
  document.getElementById('is_adminError').innerHTML = '';
  document.getElementById('passwordError').innerHTML = '';

  if (!username) {
    document.getElementById('usernameError1').innerHTML = '<span class="error">*Please enter your username</span>';
    valid = false;
  }
  if (!fname) {
    document.getElementById('fnameError').innerHTML = '<span class="error">*Please enter your first name</span>';
    valid = false;
  }
  else if (!/^[a-zA-Z-' ]*$/.test(fname)) {
    document.getElementById('fnameError').innerHTML = '<span class="error">*Only letters and white space allowed</span>';
    return false;
  }
  if (!lname) {
    document.getElementById('lnameError').innerHTML = '<span class="error">*Please enter your last name</span>';
    valid = false;
  }
  else if (!/^[a-zA-Z-' ]*$/.test(lname)) {
    document.getElementById('lnameError').innerHTML = '<span class="error">*Only letters and white space allowed</span>';
    return false;
  }
  if (!email) {
    document.getElementById('emailError').innerHTML = '<span class="error">*Please enter your email</span>';
    valid = false;
  }
  else if (!/\S+@\S+\.\S+/.test(email)) {
    document.getElementById('emailError').innerHTML = '<span class="error">*Invalid email format</span>';
    return false;
  }
  if (!semail) {
    document.getElementById('semailError').innerHTML = '<span class="error">*Please enter your security email</span>';
    valid = false;
  }
  else if (!/\S+@\S+\.\S+/.test(semail)) {
    document.getElementById('semailError').innerHTML = '<span class="error">*Invalid email format</span>';
    return false;
  }
  if (!timelag) {
    document.getElementById('timelagError').innerHTML = '<span class="error">*Please enter your timelag</span>';
    valid = false;
  }

  if (!register) {
    document.getElementById('registerError').innerHTML = '<span class="error">*Please select your register type</span>';
    valid = false;
  }
  if (!zeroknow) {
    document.getElementById('zeroknowError').innerHTML = '<span class="error">*Please select your knowledge</span>';
    valid = false;
  }
  if (!phone) {
    document.getElementById('phoneError').innerHTML = '<span class="error">*Please enter your contact number</span>';
    valid = false;
  }
  else if (!/^[0-9]{10}$/.test(phone)) {
    document.getElementById('phoneError').innerHTML = '<span class="error">*Invalid phone number format</span>';
    return false;
  }
  if (!country) {
    document.getElementById('countryError').innerHTML = '<span class="error">*Please select your country</span>';
    valid = false;
  }
  if (!is_admin) {
    document.getElementById('is_adminError').innerHTML = '<span class="error">*Please select your admin</span>';
    valid = false;
  }

  if (!password) {
    document.getElementById('passwordError').innerHTML = '<span class="error">*Please enter your password</span>';
    valid = false;
  }
  else if (password.length < 8 || !/\d/.test(password) || !/[A-Z]/.test(password) || !/[a-z]/.test(password)) {
    document.getElementById('passwordError').innerHTML = '<span class="error">*Password must be at least 8 characters, contain a number, a capital letter, and a lowercase letter</span>';
    valid = false;
  }

  if (!valid) {
    event.preventDefault();
  }
});