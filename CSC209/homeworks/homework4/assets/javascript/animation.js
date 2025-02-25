function initAnimation() {
  document.getElementById("initializer").textContent = "Reset";
  let tiles
}

function begin() {
  document.getElementById("animate-start").disabled = true;
  let tiles = document.getElementsByClassName("anima");
  let speed = document.getElementById("tile-speed").value;
  let dir = Math.PI/4, inc = 2*Math.PI / tiles.length;

  for (let tile of tiles) {
    let dx = speed * Math.cos(dir);
    let dy = speed * Math.sin(dir);
    moveTile(tile, dx, dy);
    dir += inc;
  }
}

function moveTile(tile, dx, dy) {
  var x = tile.style.left;
  var y = tile.style.top;
  var stepId = setInterval(step, 40); // 25fps

  function step() {
    if (pos == 350) {
      clearInterval(stepId);
    } else {
      x += dx; y += dy; // incr
      tile.style.top = y + 'px';
      tile.style.left = x + 'px';
    }
  }
}


