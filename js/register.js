let signFName = document.querySelector(".signFName"),
  signFNameAlert = document.querySelector(".signFNameAlert"),
  fnameIcon = document.querySelector(".fnameIcon"),
  signLName = document.querySelector(".signLName"),
  lnameIcon = document.querySelector(".lnameIcon"),
  signLNameAlert = document.querySelector(".signLNameAlert"),
  signEmail = document.querySelector(".signEmail"),
  signEmailIcon = document.querySelector(".signEmailIcon"),
  signEmailAlert = document.querySelector(".signEmailAlert"),
  signPassword = document.querySelector(".signPassword"),
  signPassAlert = document.querySelector(".signPassAlert"),
  passToggleIcon = document.querySelector(".passToggleIcon"),
  passwordInput = document.querySelector(".passwordInput"),
  rePassToggleIcon = document.querySelector(".rePassToggleIcon"),
  signRePassword = document.querySelector(".signRePassword"),
  signRePassAlert = document.querySelector(".signRePassAlert"),
  phoneIcon = document.querySelector(".phoneIcon"),
  signPhoneAlert = document.querySelector(".signPhoneAlert"),
  signPhone = document.querySelector(".signPhone");

signFName.addEventListener("input", onInputSignFName);
signLName.addEventListener("input", onInputSignLName);
signEmail.addEventListener("input", onInputSignEmail);
signPassword.addEventListener("input", onInputSignPass);
passToggleIcon.addEventListener("click", togglePassword);
rePassToggleIcon.addEventListener("click", toggleRePassword);
signRePassword.addEventListener("input", checkRePass);
signPhone.addEventListener("input", onInputSignPhone);

function onInputSignFName() {
  let name = signFName.value.trim();
  if (isValidName(name)) {
    signFName.classList.remove("invalid");
    fnameIcon.classList.remove("fa-circle-exclamation");
    signFName.classList.add("valid");
    fnameIcon.classList.add("fa-circle-check");
    signFNameAlert.style.display = "none";
  } else {
    signFName.classList.remove("valid");
    fnameIcon.classList.remove("fa-circle-check");
    signFName.classList.add("invalid");
    fnameIcon.classList.add("fa-circle-exclamation");
    signFNameAlert.textContent = `Name can only contain uppercase and lowercase letters`;
    signFNameAlert.style.display = "block";
  }
}

function onInputSignLName() {
  let name = signLName.value.trim();
  if (isValidName(name)) {
    signLName.classList.remove("invalid");
    lnameIcon.classList.remove("fa-circle-exclamation");
    signLName.classList.add("valid");
    lnameIcon.classList.add("fa-circle-check");
    signLNameAlert.style.display = "none";
  } else {
    signLName.classList.remove("valid");
    lnameIcon.classList.remove("fa-circle-check");
    signLName.classList.add("invalid");
    lnameIcon.classList.add("fa-circle-exclamation");
    signLNameAlert.textContent = `Name can only contain uppercase and lowercase letters`;
    signLNameAlert.style.display = "block";
  }
}

function isValidName(name) {
  regex = /^[a-zA-Z ]+$/;
  return regex.test(name);
}

function onInputSignEmail() {
  email = signEmail.value.trim().toLowerCase();
  if (isValidEmail(email)) {
    signEmail.classList.remove("invalid");
    signEmailIcon.classList.remove("fa-circle-exclamation");
    signEmail.classList.add("valid");
    signEmailIcon.classList.add("fa-circle-check");
    signEmailAlert.style.display = "none";
  } else {
    signEmail.classList.remove("valid");
    signEmailIcon.classList.remove("fa-circle-check");
    signEmail.classList.add("invalid");
    signEmailIcon.classList.add("fa-circle-exclamation");
    signEmailAlert.textContent = `Invalid email pattern`;
    signEmailAlert.style.display = "block";
  }
}

function isValidEmail(email) {
  let regex = /^[a-z0-9][a-z0-9_-]{0,62}[a-z0-9]@[a-z]{1,63}(\.[a-z]{2,10})+$/;
  return regex.test(email);
}

function onInputSignPass() {
  pass = signPassword.value.trim();
  if (isValidPassword(pass)) {
    signPassword.classList.remove("invalid");
    signPassword.classList.add("valid");
    signPassAlert.style.display = "none";
  } else {
    signPassword.classList.remove("valid");
    signPassword.classList.add("invalid");
    signPassAlert.textContent = `Password must be 8-35 characters long, have at least 1 lowercase letter, 
                                    have at least 1 uppercase letter, have at least 1 number,
                                    have at least 1 special character (e.g., !, @).`;
    signPassAlert.style.display = "block";
  }
}

function isValidPassword(pass) {
  let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,35}$/;
  return regex.test(pass);
}

function togglePassword() {
  if (passToggleIcon.classList.contains("fa-eye")) {
    passToggleIcon.classList.replace("fa-eye", "fa-eye-slash");
    signPassword.setAttribute("type", "password");
  } else if (passToggleIcon.classList.contains("fa-eye-slash")) {
    passToggleIcon.classList.replace("fa-eye-slash", "fa-eye");
    signPassword.setAttribute("type", "text");
  }
}

function toggleRePassword() {
  if (rePassToggleIcon.classList.contains("fa-eye")) {
    rePassToggleIcon.classList.replace("fa-eye", "fa-eye-slash");
    signRePassword.setAttribute("type", "password");
  } else if (rePassToggleIcon.classList.contains("fa-eye-slash")) {
    rePassToggleIcon.classList.replace("fa-eye-slash", "fa-eye");
    signRePassword.setAttribute("type", "text");
  }
}

function checkRePass() {
  pass = signPassword.value.trim();
  repass = signRePassword.value.trim();
  if (pass === repass) {
    signRePassword.classList.remove("invalid");
    signRePassword.classList.add("valid");
    signRePassAlert.style.display = "none";
  } else {
    signRePassword.classList.remove("valid");
    signRePassword.classList.add("invalid");
    signRePassAlert.textContent = `Doesn't match password field`;
    signRePassAlert.style.display = "block";
  }
}

function onInputSignPhone() {
  let phone = signPhone.value.trim(); //
  if (isValidPhone(phone)) {
    //
    signPhone.classList.remove("invalid"); //
    phoneIcon.classList.remove("fa-circle-exclamation"); //
    signPhone.classList.add("valid"); //
    phoneIcon.classList.add("fa-circle-check"); //
    signPhoneAlert.style.display = "none"; //
  } else {
    signPhone.classList.remove("valid"); //
    phoneIcon.classList.remove("fa-circle-check"); //
    signPhone.classList.add("invalid"); //
    phoneIcon.classList.add("fa-circle-exclamation"); //
    signPhoneAlert.textContent = `Invalid phone number pattern`; //
    signPhoneAlert.style.display = "block";
  }
}

function isValidPhone(phone) {
  let regex = /^01[0125][0-9]{8}$/;
  return regex.test(phone);
}
