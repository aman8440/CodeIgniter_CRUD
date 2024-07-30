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
document.getElementById('submitbt').addEventListener('click', function(event) {
  console.log("here");
  let valid = true;
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;

  document.getElementById('usernameError').innerHTML = '';
  document.getElementById('passwordError').innerHTML = '';

  if (!username) {
    document.getElementById('usernameError').innerHTML = '<span class="error">Please fill this field</span>';
    valid = false;
  }

  if (!password) {
    document.getElementById('passwordError').innerHTML = '<span class="error">Please fill this field</span>';
    valid = false;
  }

  if (!valid) {
    event.preventDefault();
  }
});
