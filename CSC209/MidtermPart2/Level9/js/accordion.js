/** Initializes the table */
function accordionInit() {
  for (let i = 1; i <= NRIMAGES; i++) { // want page numbers to 1-index
    addSection(i);
  }
}

/** 
 * adds a new section to the end of the accordion 
 * @param {Number} i the index of the section
 */
function addSection(i) {
  let accordion = document.getElementById('accordion');
  
  let button = document.createElement('button');
  button.classList.add('accordion');
  button.textContent = `Page ${i}`;
  button.addEventListener("click", toggleFunction);
  accordion.appendChild(button);

  let panel = document.createElement('div');
  panel.classList.add('panel');
  accordion.appendChild(panel);
  
  let link = document.createElement('a');
  link.href = IMG_PATH.replaceAll('INDEX', i);
  link.textContent = `Download Page ${i}`;
  panel.appendChild(link);
}

function toggleFunction() {
  this.classList.toggle("active-panel");
  var panel = this.nextElementSibling;
  if (panel.style.maxHeight) {
    panel.style.maxHeight = null;
  } else {
    panel.style.maxHeight = panel.scrollHeight + "px";
  } 
}