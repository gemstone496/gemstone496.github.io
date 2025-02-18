const slideStub = 
  `<div id="img-NUM" class="slide fade">
    <div class="numbertext">NUM / LEN</div>
    <img src="assets/images/bonfire/img-NUM.png" style="max-height:400px">
    <div class="text">Page NUM</div>
  </div>`;
const buttons = 
  `<a class="prev" onclick="plusSlides(-1)"><</a>
  <a class="next" onclick="plusSlides(1)">></a>`
const dotStub =
  `<span class="dot" onclick="currentSlide(NUM)"></span><br>`
var slideIndex;

function slideInit() {
  console.log("Init Call!")
  slideContainer = document.getElementById("slideshow-container")
  let slideCount = slideContainer.dataset.slideCount;

  // parse slide html
  let slideInsertion = "";
  for (let i = 1; i <= slideCount; i++) {
    slideInsertion += slideStub.replaceAll("NUM", i).replaceAll("LEN", slideCount);
  }
  slideInsertion += buttons;
  slideContainer.innerHTML = slideInsertion;
  console.log("Slides finalized.")

  // parse dot html
  let dotInsertion = "";
  slideCount = slideContainer.dataset.slideCount;
  for (let i = 1; i <= slideCount; i++) {
    console.log(`Round ${i}, ${slideCount}`)
    dotInsertion += dotStub.replaceAll("NUM", i);
  }
  document.getElementById("dots").innerHTML = dotInsertion;
  console.log("Dots inserted.")

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
  let i;
  let slides = document.getElementsByClassName("slide");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}