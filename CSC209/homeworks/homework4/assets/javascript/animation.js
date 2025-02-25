/**
 * Sets up the divs for each anima tile
 */
function initAnimation() {
  let box, boxStyle, dir;
  console.log('Setting up...')

  document.getElementById('initializer').textContent = 'Reset'; // set up once, then reset after

  box = document.getElementById('animation-container');
  boxStyle = window.getComputedStyle(box);
  const count = box.dataset.count;
  dir = -3*Math.PI / 4;
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
    rad = dimension(boxStyle.width) - width < dimension(boxStyle.height) - height ? 
          (dimension(boxStyle.width) - width)/2 : (dimension(boxStyle.height) - height)/2;
    
    x = rad * Math.cos(dir) - width + dimension(boxStyle.width)/2;
    y = rad * Math.sin(dir) - height + dimension(boxStyle.height)/2;
    animable.style.left = x + 'px';
    animable.style.top = y + 'px';
    console.log(`dir: ${Math.cos(dir)}, inc: ${Math.cos(inc)}, x: ${animable.style.left}, y: ${animable.style.top}`)
    dir += inc;
  }
}

/**
 * Begins the entire animation sequence for all tiles
 */
function begin() {
  console.log('Beginning animation...')
  let tiles, dir;

  document.getElementById('animate-start').disabled = true;
  tiles = document.getElementsByClassName('animable');
  dir = Math.PI/4;
  const inc = 2*Math.PI / tiles.length;
  const speed = document.getElementById('tile-speed').value;

  for (let tile of tiles) {
    let ddt = [speed * Math.cos(dir), speed * Math.sin(dir)];
    moveTile(tile, ddt);
    dir += inc;
  }
}

/**
 * Triggers the animation sequence for tile, with fixed direction dx/dt and dy/dt
 * @param {HTMLDivElement} tile The tile being animated
 * @param {Array} ddt d/dt(<x, y>)
 */
function moveTile(tile, ddt) {
  let box, boxStyle;
  var tileStyle = window.getComputedStyle(tile);

  // define bounds
  box = document.getElementById('animation-container');
  boxStyle = window.getComputedStyle(box);
  const bounds = [0, boxStyle.width - tileStyle.width, 0, boxStyle.height - tileStyle.height];
  
  var x = tileStyle.left; // where am i now
  var y = tileStyle.top;
  var stepId = setInterval(step, 40); // 40ms <==> 25fps

  function step() {
    // check distance from center
    if (stopNow()) { // edge of box
      clearInterval(stepId); // finish
    } else {
      x += ddt[0]; y += ddt[1]; // incr
      tileStyle.left = x + 'px';
      tileStyle.top = y + 'px';
    }

    /**
     * Decides whether an object is about to cross a bound.
     * @returns whether tile should stop moving
     */
    function stopNow(){
      let stop = (ddt[0] < 0 && x <= bounds[0]) ||
                 (ddt[0] > 0 && x >= bounds[1]) ||
                 (ddt[1] < 0 && y <= bounds[2]) ||
                 (ddt[1] > 0 && y >= bounds[3]);
      return stop;
    }
  }
}

/**
 * 
 * @param {String} style the style element of the dimension (including 'px')
 * @returns {Number} The number
 */
function dimension(style){
  return Number(style.replace(/px$/, ''));
}