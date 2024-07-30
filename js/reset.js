const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  if (togglePassword.src.match("https://icons.veryicon.com/png/o/miscellaneous/hekr/action-hide-password.png")) {
    togglePassword.src ="https://static.thenounproject.com/png/4334035-200.png";
  } else {
    togglePassword.src ="https://icons.veryicon.com/png/o/miscellaneous/hekr/action-hide-password.png";
  }
});
document.getElementById('submitb').addEventListener('click', function(event) {
  console.log("here");
  let valid = true;
  const password = document.getElementById('password').value;
  const cpassword = document.getElementById('cpassword').value;

  document.getElementById('passwordError').innerHTML = '';
  document.getElementById('cpasswordError').innerHTML = '';


  if (!password) {
    document.getElementById('passwordError').innerHTML = '<span class="error">Please fill this field</span>';
    valid = false;
  }
  else if (password.length < 8 || !/\d/.test(password) || !/[A-Z]/.test(password) || !/[a-z]/.test(password)) {
    document.getElementById('passwordError').innerHTML = '<span class="error">Password must be at least 8 characters, contain a number, a capital letter, and a lowercase letter</span>';
    valid= false;
  }
  if (!cpassword) {
    document.getElementById('cpasswordError').innerHTML = '<span class="error">Please fill this field</span>';
    valid = false;
  }
  else if (password != cpassword) {
    document.getElementById('cpasswordError').innerHTML = '<span class="error">Passwords do not match</span>';
    valid= false;
  }

  if (!valid) {
    event.preventDefault();
  }
});

