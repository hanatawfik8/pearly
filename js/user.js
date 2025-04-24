
  const modal = document.getElementById("editProfileModal");
  const openBtn = document.querySelector(".edit-profile-btn");
  const closeBtn = document.querySelector(".close");
 
  
  openBtn.onclick = function () {
    modal.style.display = "block";
  }

  closeBtn.onclick = function () {
    modal.style.display = "none";
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }




