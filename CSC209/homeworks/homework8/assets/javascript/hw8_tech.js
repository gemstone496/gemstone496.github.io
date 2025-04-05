var slideIndex;

function slideInit() {
  // start at slide 1
  slideIndex = 1;
  showSlides(slideIndex);
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  slideIndex = slideIndex ?? n;
  let i;
  let slides = document.getElementsByClassName("slide");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].classList.remove("active");  
    slides[i].classList.add("inactive");
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].classList.remove("active");
  }
  console.log(slideIndex);
  slides[slideIndex-1].classList.remove("inactive");
  slides[slideIndex-1].classList.add("active");  
  dots[slideIndex-1].classList.add("active");
}