/** Initializes the tabs */
function tabInit() {
  for (let i = 0; i < NRTABS; i++) { // want page numbers to 1-index
    addTab(i);
  }
}

/** 
 * adds a new tab
 * @param {Number} i the index of the tab
 */
function addTab(i) {
  let tabOpeners = document.getElementById('tab-openers');
  
  let button = document.createElement('button');
  button.classList.add('tablinks');
  button.textContent = `Page ${i+1}`;
  button.dataset.tabId = `img-${i+1}`;
  button.addEventListener("click", openPanel);
  tabOpeners.appendChild(button);

  let tabs = document.getElementById('tab-contents');
  let panel = document.createElement('div');
  panel.id = button.dataset.tabId; // make sure they're always the same
  panel.classList.add('tabcontent');
  panel.style.maxHeight = '500px';
  tabs.appendChild(panel);
  
  let link = document.createElement('img');
  link.src = IMG_PATH.replaceAll('INDEX', i+1);
  link.style.maxHeight = '500px';
  panel.appendChild(link);
}

function openPanel() {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active-panel", "");
  }
  document.getElementById(this.dataset.tabId).style.display = "block";
  this.classList += " active-panel";
}