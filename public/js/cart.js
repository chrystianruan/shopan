var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function hideInvalidQuantity() {
    let invalid = document.getElementById("invalid");
    invalid.style.display = 'none';
}

setTimeout(hideInvalidQuantity, 2000);

let infosCard= document.querySelector(".infos-card");
let options = document.querySelectorAll(".type");
let infos = document.querySelectorAll(".infos");

let btnConfirm = document.getElementById("button-confirm");
function showOrRideOptionsCreditCart() {
      for(let option of options) {
        if (option.checked) {
          if (option.value == 3) {
            infosCard.style.display = "block";
            for (let info of infos) {
              info.setAttribute("required", "required");
            }
          } else {
            infosCard.style.display = "none";
            for (let info of infos) {
              info.removeAttribute("required", "required");
            }
          }
      }

  }
}

btnConfirm.addEventListener("click", showOrRideOptionsCreditCart);

