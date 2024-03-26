// Functions for opening and closing popup window form and that displays the popup when hovered
function popup() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show"); // Displays the popup
}

function openPopup() {
  document.getElementById("popup").style.display = "block"; // Makes the popup form visible
}

function closePopup() {
  document.getElementById("popup").style.display = "none"; // Makes the popup window form hidden
}
