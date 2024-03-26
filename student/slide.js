// Function for slideshow
let slideIndex = 0; // Sets the index of each image, starting from 0
showSlides();

function showSlides() {
  let i; // Loop counter
  let slides = document.getElementsByClassName("mySlides"); //Gets all the HTML elements that has "mySlides" class
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; // Sets all display to "none"
  }
  slideIndex++; // Increment the value of slideIndex to 1
  if (slideIndex > slides.length) {
    //Makes sure that the image will go back to the first image after it reaches the last
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block"; // Displays the image
  setTimeout(showSlides, 2000); // Changes image every 2 seconds
}
