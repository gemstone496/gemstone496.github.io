/** for tracking existing tiles */
var tiles = new Array();

/** an animable tile */
class Tile {
  /**
   * Default constructor
   * @param {HTMLDivElement} element 
   * @param {Number} theta 
   * @param {Array} bounds 
   */
  constructor(element, theta, bounds) {
    this.element = element;
    this.r = 0;
    this.theta = theta;
    this.bounds = bounds;
    this.stepId = null;
    this.active = false;
  }

  ddt() { return [this.r*Math.cos(this.theta), this.r*Math.sin(this.theta)]; }

  move() {
    var x = dimension(this.element.style.left); // where am i now
    var y = dimension(this.element.style.top);
    var ddt = this.ddt(); // evaluate once for now, update later when appropriate
    this.stepId = setInterval(step, 40); // 40ms <==> 25fps
    this.active = true;

    function step() {
      // check distance from center
      if (edgeFound(this.dx, this.dy)) { // edge of box
        console.log(`ending #${this.stepId} due to tile edge`);
        finishInterval(this.stepId);
      } else {
        x += ddt[0]; y += ddt[1]; // incr
        x = Math.max(bounds[0], Math.min(x, bounds[1]));
        y = Math.max(bounds[2], Math.min(y, bounds[3]));
        this.element.style.left = x + 'px';
        this.element.style.top = y + 'px';
      }
      
      /**
       * Decides whether an object is about to cross a bound
       * @returns {Boolean} whether tile should stop moving
       */
      function edgeFound() {
        return (ddt[0] < 0 && x <= bounds[0]) ||
               (ddt[0] > 0 && x >= bounds[1]) ||
               (ddt[1] < 0 && y <= bounds[2]) ||
               (ddt[1] > 0 && y >= bounds[3]);
      }
    }
  }
}

/**
 * Sets up the divs for each anima tile
 * @param {HTMLButtonElement} button the button that called this action
 */
function initAnimation(button) {
  let box, boxStyle, dir;
  console.log('Setting up...')

  button.textContent == 'Reset' ? purgeTiles() : button.textContent = 'Reset'; // set up once, then reset after
  stopAnimation();

  box = document.getElementById('animation-container');
  boxStyle = window.getComputedStyle(box);
  const count = box.dataset.count;
  dir = 0;
  const inc = 2*Math.PI / count; // if count == 0 this will throw an error and it should

  for (let i=0; i < count; i++) {
    let animable, animaStyle, rad, x, y;
    console.log(`Inserting animable #${i}.`)

    // set up container
    animable = document.createElement('div');
    animable.classList = 'animable';
    animable = box.appendChild(animable);
    animaStyle = window.getComputedStyle(animable);

    /* inscribed circle based on the size of box and animables 
       from single edit in code for varying widths of both.
       works for rectangular non-square objects of all sizes */
    const width = dimension(animaStyle.width), height = dimension(animaStyle.height);
    const eastBound = dimension(boxStyle.width) - width;
    const southBound = dimension(boxStyle.height) - height;
    rad = Math.min( eastBound / 2, southBound / 2);
    
    x = rad * Math.cos(dir) + eastBound / 2;
    y = rad * Math.sin(dir) + southBound / 2;
    animable.style.left = x + 'px';
    animable.style.top = y + 'px';

    const bounds = [0, eastBound, 0, southBound];
    tiles.push(new Tile(animable, dir+5*Math.PI/4, bounds));

    dir += inc;
  }
}

/**
 * Begins the entire animation sequence for all tiles
 * @param {HTMLButtonElement} button the button that called this action
 */
function begin(button) {
  console.log('Beginning animation...')

  button.disabled = true;
  const speed = document.getElementById('tile-speed').value;

  for (const tile of tiles) {
    tile.r = speed;
    tile.move();
  }
}

/**
 * @param {String} style the style element of the dimension (including 'px')
 * @returns {Number} The number of the dimension, w/o 'px'
 */
function dimension(style) {
  return Number(style.replace(/px$/, ''));
}

/**
 * Clears the interval of id, then re-enables the dance button if no more animations are running
 * @param {Number | undefined} id
 */
function finishInterval(id) {
  clearInterval(id); // finish
  tiles[id] = false;

  let finished = true;
  for (const tile of tiles) {
    if (entry[1]) {
      finished = false;
      break;
    }
  }
  
  if (finished) {
    document.getElementById('animate-start').disabled = false;
  }
}

/** removes all existing tiles and all intervals to prep for recreation */
function purgeTiles() {
  let tiles = document.getElementsByClassName('animable'), len = tiles.length;
  for(let i=0; i<len; i++) {
    console.log(`Removing tile #${i}`)
    tiles[0].parentNode.removeChild(tiles[0]);
  }
}

/** ends all animations */
function stopAnimation() {
  for (const tile of tiles) {
    if (tile.active) {
      console.log(`purging animation #${tile.stepId}...`)
      clearInterval(tile.stepId);
      tile.active = false;
    }
  }
  document.getElementById('animate-start').disabled = false;
}

/**
 * converts from polar to Cartesian coordinates
 * @param {Number} r 
 * @param {Number} theta 
 * @returns 
 */
function cartesian(r, theta) {
  return [r*Math.cos(theta), r*Math.sin(theta)];
}