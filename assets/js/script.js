let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides((slideIndex += n));
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides((slideIndex = n));
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (!slides || slides.length < 1 || !dots || dots.length < 1) return;
  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}

window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  const navSpansNC = document.getElementsByClassName("not-current-span");
  const navLinksNC = document.getElementsByClassName("not-current-link");
  const currentSpan = document.getElementById("current-span");
  const currentLink = document.getElementById("current-link");
  if (window.scrollY > 1) {
    // Adjust the value as needed
    navbar.classList.add("sticky");
    // currentSpan.classList.add("sticky");
    // currentLink.classList.add("sticky");
    // for (let i = 0; i < navSpansNC.length; i++) {
    //   navSpansNC[i].classList.add("sticky");
    //   navLinksNC[i].classList.add("sticky");
    // }
  } else {
    navbar.classList.remove("sticky");
    // currentSpan.classList.remove("sticky");
    // currentLink.classList.remove("sticky");
    // for (let i = 0; i < navSpansNC.length; i++) {
    //   navSpansNC[i].classList.remove("sticky");
    //   navLinksNC[i].classList.remove("sticky");
    // }
  }
});
