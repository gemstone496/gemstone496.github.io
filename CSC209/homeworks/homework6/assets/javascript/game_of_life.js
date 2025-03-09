const TILE_DIM = 20; // square tiles
/** for tracking existing tiles. entries are (row, column) */
var game;

/** a diy deque class for expanding the game board beyond visible tiles */
class Deque {
  constructor() {
    this.fwd = new Array();
    this.bwd = new Array();
    this.length = 0;
  }

  push(obj) {
    this.fwd.push(obj);
    this.length++;
  }
  pop() {
    this.length--;
    return this.fwd.pop();
  }
  pushFirst(obj) {
    this.bwd.push(obj);
    this.length++;
  }
  popFirst() {
    this.length--;
    return this.bwd.pop();
  }
  get(i) {
    return i > 0 ? fwd[i] : bwd[-(i+1)];
  }

}

/** a tile in the game */
class Tile {
  /**
   * Default constructor
   * @param {Number} i The row in the table of the tile 
   * @param {Number} j The col in the table 
   * @param {HTMLTableCellElement} tile The DOM row to append the tile to
   */
  constructor(i, j, tile) {
    this.initial = 0; // todo randomize
    this.alive = 0;
    this.next = 0;

    this.tile = tile;
    this.i = i;
    this.j = j;
  }

  toggle() {
    this.initial = this.alive = !this.alive;
    console.log(`click changes: ${this.initial}, ${this.alive}`) // verify this works actually
  }
  countNeighbors() {
    let count = 0;
    for (let v = -1; v <= 1; v++) {
      for (let h = -1; h <= 1; h++) {
        if (v !== 0 || h !== 0) {
          count += game.tiles[this.i+v][this.j+h].alive;
        }
      }
    }
    return count;
  }
  draw() {
    if (this.next != this.alive) {
      this.tile.classList.toggle('alive');
      this.tile.classList.toggle('dead');
      this.alive = this.next;
    }
  }
}

/**
 * Sets up the board for the game to begin
 */
function setupGame() {
  let boardStyle;
  console.log('Setting up...')

  game = {
    board : document.getElementById('game-board'),
    interval : null,
    tiles : new Array()
  }

  boardStyle = window.getComputedStyle(game.board);
  const height = boardStyle.height / TILE_DIM;
  const width = boardStyle.width / TILE_DIM;

  for (let i = 0; i < height; i++) {
    let row;

    game.tiles.push(new Array()); // new row

    row = document.createElement('tr');
    row.classList = 'tile-row';
    row.maxHeight = TILE_DIM;
    game.board.appendChild(row); // add to DOM

    for (let j = 0; j < width; j++) {
      console.log(`Inserting tile (${i}, ${j}).`);
      
      let tile = document.createElement('td');
      tile.classList = 'tile dead'; // todo randomize
      tile.id = `${i}.${j}`;
      tile.addEventListener('click', this.toggle);
      tile.dataset.i = i;
      tile.dataset.j = j;
      row.appendChild(tile);

      game.tiles[i].push(new Tile(i, j, tile)); // new tile. constructor adds to DOM
    }
  }
}

/**
 * Begins the entire animation sequence for all tiles
 * @param {HTMLButtonElement} button the button that called this action
 */
function start(button) {
  console.log('Beginning game...')

  button.disabled = true;
  document.getElementById('game-stop').disabled = false;

  // todo set interval  
}

/**
 * Calculates the next step of the game
 */
function step() {
  // calculate next state
  for (let i = 0; i < game.tiles.length; i++) {
    for (let j = 0; j < game.tiles[i].length; j++) {
      let tile, countNeighbors;
      tile = game.tiles[i][j];
      countNeighbors = tile.countNeighbors();
      switch (countNeighbors) {
        case 2:
          tile.next = tile.alive; // always the same with 2 neighbors
          break;
        case 3:
          tile.next = 1; // always alive with 3 neighbors
          break;
        default:
          tile.next = 0; // always dead otherwise
      }
    }
  }

  // draw next state
  for (let i = 0; i < game.tiles.length; i++) {
    for (let j = 0; j < game.tiles[i].length; j++) {
      game.tiles[i][j].draw();
    }
  }
}

function stop(button) {
  clearInterval(game.interval);

  document.getElementById('game-start').disabled = false;
  button.disabled = true;
}

/** removes all existing tiles and all intervals to prep for recreation */
function reset() {
  for (let i = 0; i < game.tiles.length; i++) {
    for (let j = 0; j < game.tiles[i].length; j++) {
      // todo write
    }
  }
}