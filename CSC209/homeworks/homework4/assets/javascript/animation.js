/**
 * Sets up the divs for each anima tile
 */
function initAnimation() {
  console.log("Setting up...")
  let box, dir;

  document.getElementById("initializer").textContent = "Reset"; // set up once, then reset after

  box = document.getElementById("animation-container")
  const count = box.dataset.count;
  dir = -3*Math.PI / 4;
  const inc = 2*Math.PI / count; // if count == 0 this will throw an error and it should

  for (let i=0; i < count; i++) {
    console.log(`Inserting anima[ble] #${count}.`)

    // set up container
    let anima = document.createElement("div");
    anima.classList = "anima";

    /* so i just need the inscribed circle based on the size of the box 
        and also the size of the animables and i need to find it
        based on a single edit in code for varying widths of both
        and i want it to work for rectangular non-square objects of all sizes 
        what could go wrong */
    const width = anima.style.width/2, height = anima.style.height/2;
    let rad = box.style.width - width < box.style.height - height ? 
              box.style.width - width : box.style.height - height;
    
    let x = rad * Math.cos(dir) - width;
    let y = rad * Math.sin(dir) - height;
    anima.style.left = x;
    anima.style.top = y;
    box.appendChild(anima);
    dir += inc; 
  }
}

/**
 * Begins the entire animation sequence for all tiles
 */
function begin() {
  console.log("Beginning animation...")
  let tiles, dir;

  document.getElementById("animate-start").disabled = true;
  tiles = document.getElementsByClassName("anima");
  dir = Math.PI/4;
  const inc = 2*Math.PI / tiles.length;
  const speed = document.getElementById("tile-speed").value;

  for (let tile of tiles) {
    let dx = speed * Math.cos(dir);
    let dy = speed * Math.sin(dir);
    moveTile(tile, dx, dy);
    dir += inc;
  }
}

/**
 * Triggers the animation sequence for tile, with fixed direction dx/dt and dy/dt
 * @param {*} tile The tile being animated
 * @param {*} dx dx/dt
 * @param {*} dy dy/dt
 */
function moveTile(tile, dx, dy) {
  var x = tile.style.left; // where am i now
  var y = tile.style.top;
  var stepId = setInterval(step, 40); // 40ms <==> 25fps

  function step() {
    if (x == 350 || y == 350) { // edge of box
      clearInterval(stepId); // finish
    } else {
      x += dx; y += dy; // incr
      tile.style.top = y + 'px';
      tile.style.left = x + 'px';
    }
  }
}

function fuck_math(anima) {
}