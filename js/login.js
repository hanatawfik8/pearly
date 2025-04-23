let logEmail = document.querySelector(".logEmail"),
  logEmailIcon = document.querySelector(".logEmailIcon"),
  logEmailAlert = document.querySelector(".logEmailAlert"),
  logPassword = document.querySelector(".logPassword"),
  logPassAlert = document.querySelector(".logPassAlert"),
  passToggleIcon = document.querySelector(".passToggleIcon");

logEmail.addEventListener("input", onInputLogEmail);
logPassword.addEventListener("input", onInputLoginPass);
passToggleIcon.addEventListener("click", togglePassword);

function onInputLogEmail() {
  email = logEmail.value.trim().toLowerCase();
  if (isValidEmail(email)) {
    logEmail.classList.remove("invalid");
    logEmailIcon.classList.remove("fa-circle-exclamation");
    logEmail.classList.add("valid");
    logEmailIcon.classList.add("fa-circle-check");
    logEmailAlert.style.display = "none";
  } else {
    logEmail.classList.remove("valid");
    logEmailIcon.classList.remove("fa-circle-check");
    logEmail.classList.add("invalid");
    logEmailIcon.classList.add("fa-circle-exclamation");
    logEmailAlert.textContent = `Invalid email pattern`;
    logEmailAlert.style.display = "block";
  }
}

function isValidEmail(email) {
  let regex = /^[a-z0-9][a-z0-9_-]{0,62}[a-z0-9]@[a-z]{1,63}(\.[a-z]{2,10})+$/;
  return regex.test(email);
}

function onInputLoginPass() {
  pass = logPassword.value.trim();
  if (isValidPassword(pass)) {
    logPassword.classList.remove("invalid");
    logPassword.classList.add("valid");
    logPassAlert.style.display = "none";
  } else {
    logPassword.classList.remove("valid");
    logPassword.classList.add("invalid");
    logPassAlert.textContent = `Password must be 8-35 characters long, have at least 1 lowercase letter,
                                    have at least 1 uppercase letter, have at least 1 number,
                                    have at least 1 special character (e.g., !, @).`;
    logPassAlert.style.display = "block";
  }
}

function isValidPassword(pass) {
  let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,35}$/;
  return regex.test(pass);
}

function togglePassword() {
  if (passToggleIcon.classList.contains("fa-eye")) {
    passToggleIcon.classList.replace("fa-eye", "fa-eye-slash");
    logPassword.setAttribute("type", "password");
  } else if (passToggleIcon.classList.contains("fa-eye-slash")) {
    passToggleIcon.classList.replace("fa-eye-slash", "fa-eye");
    logPassword.setAttribute("type", "text");
  }
}
