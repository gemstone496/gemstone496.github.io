const BOARD_HEIGHT = 20;
const BOARD_WIDTH = 60;
const TILE_DIM = 20; // square tiles
const FPS = 200; // 200ms = 5fps
const INIT = [    // initial configuration for a space-efficient glider gun
  [5, 1], [6, 1],
    [5, 2], [6, 2],
  [5, 11], [6, 11], [7, 11],
    [4, 12], [8, 12],
    [3, 13], [9, 13],
    [3, 14], [9, 14],
    [6, 15],
    [4, 16], [8, 16],
    [5, 17], [6, 17], [7, 17],
    [6, 18],
  [3, 21], [4, 21], [5, 21],
    [3, 22], [4, 22], [5, 22],
    [2, 23], [6, 23],
    [1, 25], [2, 25], [6, 25], [7, 25],
  [3, 35], [4, 35],
    [3, 36], [4, 36]
];
/** for tracking existing tiles. entries are (row, column) */
var game;

/** 
 * a diy deque class for expanding the game board beyond 
 *  visible tiles and ease of mutability.
 * has no pop or remove methods, because there is never a need
 *  to reduce the size of the gameboard representation
 */
class Deque {
  constructor(min, max, i) {
    this.fwd = new Array();
    this.bwd = new Array();
    this.length = 0;

    // for insertions
    if (min !== undefined && max !== undefined && i !== undefined) {
      for (let j = 0; j < max; j++) {
        this.push(new Tile(i, j, null))
      }
      for (let j = 1; j <= min; j++) {
        this.pushFirst(new Tile(i, -j, null))
      }
    }
  }

  push(obj) {
    this.fwd.push(obj);
    this.length++;
  }
  pushFirst(obj) {
    this.bwd.push(obj);
    this.length++;
  }
  get(i) {
    return i >= 0 ? this.fwd[i] : this.bwd[-(i+1)];
  }
  min() {
    return -this.bwd.length;
  }
  max() {
    return this.fwd.length;
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
    this.initial = 0;
    this.alive = 0;
    this.next = 0;

    this.tile = tile;
    this.i = i;
    this.j = j;
  }

  reset() {
    this.next = this.initial;
    this.draw();
  }
  toggle() {
    if (game.static) {
      this.alive = this.alive == 0 ? 1 : 0;
      this.initial = this.alive;
      this.tile.classList.toggle('alive');
      this.tile.classList.toggle('dead');
    }
  }
  countNeighbors() {
    let count = 0;
    for (let v = this.i-1; v <= this.i+1; v++) {
      if (v < game.tiles.min() || v >= game.tiles.max()) {
        if(this.alive == 0) {
          continue;
        }
        game.addRow(v); // if out of bounds reference, add the appropriate row
      }
      for (let h = this.j-1; h <= this.j+1; h++) {
        if (v !== this.i || h !== this.j) {
          if (h < game.tiles.get(0).min() || h >= game.tiles.get(0).max()) {
            if(this.alive == 0) {
              continue;
            }
            game.addCol(h);
          }
          count += game.tiles.get(v).get(h).alive;
        }
      }
    }
    return count;
  }
  draw() {
    if (this.next != this.alive && this.tile !== null) {
      this.tile.classList.toggle('alive');
      this.tile.classList.toggle('dead');
    }
    
    this.alive = this.next;
  }
}

/**
 * Sets up the board for the game to begin
 */
function setupGame() {
  let gameBoard;
  console.log('Setting up...');

  gameBoard = document.createElement('table');
  gameBoard.id = 'game-board';
  gameBoard.maxHeight = BOARD_HEIGHT*TILE_DIM;
  document.getElementById('game-container').appendChild(gameBoard);

  game = {
    board : gameBoard,
    static : true,
    interval : null,
    tiles : new Deque(),
    addRow : function(end) {
      console.log(`Adding row ${end}`);
      let newRow = new Deque(this.tiles.get(0).min(), this.tiles.get(0).max(), end);
      end < 0 ? this.tiles.pushFirst(newRow) : this.tiles.push(newRow);
    },
    addCol : function(end) {
      console.log(`Adding col ${end}`);
      for (let i = this.tiles.min(); i < this.tiles.max(); i++) {
        let tile = new Tile(i, end, null);
        end < 0 ? this.tiles.get(i).pushFirst(tile) : this.tiles.get(i).push(tile);
      }
    }
  }

  for (let i = 0; i < BOARD_HEIGHT; i++) {
    let row;

    game.tiles.push(new Deque()); // new row

    row = document.createElement('tr');
    row.id = `row-${i}`;
    row.classList = 'tile-row';
    row.maxHeight = TILE_DIM;
    game.board.appendChild(row); // add to DOM

    for (let j = 0; j < BOARD_WIDTH; j++) {
      console.log(`Inserting tile (${i}, ${j}).`);
      
      let domTile = document.createElement('td');
      domTile.classList = 'tile dead'; // todo randomize
      domTile.id = `${i}.${j}`;
      domTile.width = TILE_DIM;
      domTile.height = TILE_DIM;
      domTile.dataset.i = i;
      domTile.dataset.j = j;

      let tile = new Tile(i, j, domTile);
      domTile.addEventListener('click', () => tile.toggle());
      row.appendChild(domTile);

      game.tiles.get(i).push(tile); // new tile. constructor adds to DOM
    }
  }

  for (let coord of INIT) {
    game.tiles.get(coord[0]).get(coord[1]).toggle();
  }
}

/**
 * Begins the entire animation sequence for all tiles
 * @param {HTMLButtonElement} button the button that called this action
 */
function start(button) {
  console.log('Beginning game...')
  
  game.interval = setInterval(step, FPS);

  button.disabled = true;
  document.getElementById('game-stop').disabled = false;

  game.static = false;
}

/**
 * Calculates the next step of the game
 */
function step() {
  // calculate next state
  let row = game.tiles.max()
  for (let i = game.tiles.min(); i < row; i++) {
    let col = game.tiles.get(i).max();
    for (let j = game.tiles.get(i).min(); j < col; j++) {
      let tile, countNeighbors;
      tile = game.tiles.get(i).get(j);
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
  for (let i = 0; i < row; i++) { // haven't implemented zoom-out, so no need to expand back
    let col = game.tiles.get(i).max();
    for (let j = 0; j < col; j++) {
      game.tiles.get(i).get(j).draw();
    }
  }
}

function stop(button) {
  clearInterval(game.interval);
  game.interval = null;
  game.static = true;

  document.getElementById('game-start').disabled = false;
  button.disabled = true;
}

/** removes all existing tiles and all intervals to prep for recreation */
function reset() {
  stop(document.getElementById('game-stop'));

  let rowCap = game.tiles.max()
  for (let i = game.tiles.min(); i < rowCap; i++) {
    let row = game.tiles.get(i);
    let colCap = row.max();
    for (let j = row.min(); j < colCap; j++) {
      row.get(j).reset();
    }
  }
}