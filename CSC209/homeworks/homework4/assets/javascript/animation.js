// for tracking ongoing intervals
var intervals = new Map();

/**
 * Sets up the divs for each anima tile
 * @param {HTMLButtonElement} button the button that called this action
 */
function initAnimation(button) {
  let box, boxStyle, dir;
  console.log('Setting up...')

  button.textContent == 'Reset' ? purgeTiles() : button.textContent = 'Reset'; // set up once, then reset after

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

    /* so i just need the inscribed circle based on the size of the box 
        and also the size of the animables and i need to find it
        based on a single edit in code for varying widths of both
        and i want it to work for rectangular non-square objects of all sizes 
        what could go wrong */
    const width = dimension(animaStyle.width), height = dimension(animaStyle.height);
    rad = Math.min( (dimension(boxStyle.width) - width)/2, 
                    (dimension(boxStyle.height) - height)/2);
    
    x = rad * Math.cos(dir) + (dimension(boxStyle.width)-width)/2;
    y = rad * Math.sin(dir) + (dimension(boxStyle.height)-height)/2;
    animable.style.left = x + 'px';
    animable.style.top = y + 'px';
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
  const tiles = document.getElementsByClassName('animable');
  let dir = -Math.PI/2;
  const inc = 2*Math.PI / tiles.length;
  const speed = document.getElementById('tile-speed').value;

  for (const tile of tiles) {
    moveTile(tile, speed, dir);
    dir += inc;
  }
}

/**
 * Triggers the animation sequence for tile, with fixed direction dx/dt and dy/dt
 * @param {HTMLDivElement} tile The tile being animated
 * @param {Number} r polar radius
 * @param {Number} theta polar angle theta
 */
function moveTile(tile, r, theta) {
  let box, boxStyle;
  var tileStyle = window.getComputedStyle(tile);
  var ddt = cartesian(r, theta);

  // define bounds
  box = document.getElementById('animation-container');
  boxStyle = window.getComputedStyle(box);
  const left = 0, right = dimension(boxStyle.width) - dimension(tileStyle.width), 
        top = 0, bottom = dimension(boxStyle.height) - dimension(tileStyle.height);
  
  var x = dimension(tile.style.left); // where am i now
  var y = dimension(tile.style.top);
  var stepId = setInterval(step, 40); // 40ms <==> 25fps
  intervals[stepId] = true;

  function step() {
    // check distance from center
    if (edgeFound()) { // edge of box
      console.log(`ending #${stepId} due to tile edge`);
      finishInterval(stepId);
    } else {
      x += ddt[0]; y += ddt[1]; // incr
      x = Math.max(left, Math.min(x, right));
      y = Math.max(top, Math.min(y, bottom));
      tile.style.left = x + 'px';
      tile.style.top = y + 'px';
    }

    /**
     * Decides whether an object is about to cross a bound.
     * @returns {Boolean} whether tile should stop moving
     */
    function edgeFound(){
      let stop = (ddt[0] < 0 && x <= left) ||
                 (ddt[0] > 0 && x >= right) ||
                 (ddt[1] < 0 && y <= top) ||
                 (ddt[1] > 0 && y >= bottom);
      return stop;
    }
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
  intervals[id] = false;

  let finished = true;
  for (const entry of intervals.entries()) {
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

  stopAnimation();

  let tiles = document.getElementsByClassName('animable'), len = tiles.length;
  for(let i=0; i<len; i++) {
    console.log(`Removing tile #${i}`)
    tiles[0].parentNode.removeChild(tiles[0]);
  }
}

/** ends all animations */
function stopAnimation() {
  for (const [id, going] of intervals.entries()) {
    if (going) {
      console.log(`purging animation #${id}...`)
      clearInterval(id);
      intervals[id] = false;
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