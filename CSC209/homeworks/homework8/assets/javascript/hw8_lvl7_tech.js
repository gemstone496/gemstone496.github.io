var slideSet = 'bonfire';
var slideIndex = 1;

function updateSet(newSet) {
  showSlides(slideIndex = 1); // reset before leaving

  let oldSlides = document.getElementById(`${slideSet}-slides`);
  let newSlides = document.getElementById(`${newSet}-slides`);
  let oldDots = document.getElementById(`${slideSet}-dots`);
  let newDots = document.getElementById(`${newSet}-dots`);
  activate(oldSlides, false, "show", "hide");
  activate(oldDots, false, "show", "hide");
  activate(newSlides, true, "show", "hide");
  activate(newDots, true, "show", "hide");

  slideSet = newSet;

  showSlides(1);
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
  let slides = document.getElementById(`${slideSet}-slides`).children;
  let dots = document.getElementById(`${slideSet}-dots`).getElementsByTagName("span");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}

  for (i = 0; i < slides.length; i++) {
    activate(slides[i], false);
  }
  for (i = 0; i < dots.length; i++) {
    activate(dots[i], false);
  }
  activate(slides[slideIndex-1], true);
  activate(dots[slideIndex-1], true);
}

/**
 * activates or deactivates an element based on input
 * @param {HTMLElement} element the element to [de]activate
 * @param {Boolean} activate whether to activate or deactivate, defaults deactivate
 * @param {String} on the classname to add when on
 * @param {String} off the classname to add when off
 */
function activate(element, activate = false, on = "active", off = "inactive") {
  element.classList.remove(activate ? off : on);
  element.classList.add(activate ? on : off);
}