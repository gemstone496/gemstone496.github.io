const CVS_WID = 500;
const CVS_HGT = 300;
const RADIUS = 5;
const MIN_VEL = 2;
const RANGE_VEL = 10; // [2, 12]
const HEX = '0123456789ABCDEF';
const ARW_SCALAR = 1.5; // 10 pixels * velocity
const ARH_LEN = 5; // arrowhead length
const ARH_ANG = 3*Math.PI / 4;
const FADE = '#ebe1ff33'
const FPS = 40; // 25fps
var stage;
var particles = [];
var freezer = []; // the thing that freezes initial poses

function begin() { stage.begin(); }
function freeze() { stage.stop(); }

function updateParts() {
  let input = document.getElementById('particle-count');
  input.value = Math.floor(input.value);
  let count = input.value;
  while (count != particles.length) {
    if (count < particles.length) {
      particles.pop();
      if (count == particles.length && stage.static) { // reset without new particles
        stage.clear();
        for (let particle of particles) {
          particle.draw();
        }
      }
    } else {
      particleBuilder();
    }
  }
}

/** 
 * Generates a Memory object with an initial information for a Particle, 
 * adds it to the list, then creates and returns the Particle
 */
function particleBuilder() {
  let r, x, y, v, theta, orient, rgb, color, memory;
  r = RADIUS;
  x = r + Math.floor(Math.random() * (stage.canvas.width -2*r +1)); // stay inside
  y = r + Math.floor(Math.random() * (stage.canvas.height -2*r +1));
  v = MIN_VEL + Math.floor(Math.random() * RANGE_VEL); // velocity
  theta = Math.random() * 2*Math.PI;
  orient = Math.floor(Math.random() * 2) == 1 ? 1 : -1; // how to orient the arrowhead

  rgb = [
    Math.floor(Math.random() * 13), // want all hex codes
    Math.floor(Math.random() * 16),
    Math.floor(Math.random() * 10), // to look darker than
    0, // also, bias purple
    Math.floor(Math.random() * 13), // background canvas
    Math.floor(Math.random() * 16)
  ];
  color = '#' + HEX.charAt(rgb[0]) + HEX.charAt(rgb[1]) + 
                HEX.charAt(rgb[2]) + HEX.charAt(rgb[3]) + 
                HEX.charAt(rgb[4]) + HEX.charAt(rgb[5]);
  
  let particle = new Particle(r, x, y, v, theta, orient, color);
  particles.push(particle);
  particle.draw();
  return particle;
}

function sceneSet() {
  stage = {
    canvas : document.createElement('canvas'),
    interval : null,
    static : true,
    begin : function() {
      this.stop();
      this.interval = setInterval(newFrame, FPS);
      this.static = false;
      document.getElementById('animate-start').disabled = true;
      document.getElementById('animate-stop').disabled = false;
    },
    stop : function() {
      clearInterval(this.interval);
      this.static = true;
      document.getElementById('animate-start').disabled = false;
      document.getElementById('animate-stop').disabled = true;
    },
    clear : function() {
      this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    redraw : function() {
      this.stop();
      this.clear();
      for (let particle of particles) {
        particle.reset();
      }
    },
    regenerate : function() {
      this.stop();
      this.clear();
      let count = document.getElementById('particle-count').value;
      particles = []; // reset
      for (let i = 0; i < count; i++) {// randomize a bunch of things
        let particle = particleBuilder();
        console.log(`Particle at (${particle.x}, ${particle.y}), color: ${particle.color}`);
      }
    }
  }
  stage.canvas.width = CVS_WID;
  stage.canvas.height = CVS_HGT;
  stage.context = stage.canvas.getContext('2d');
  document.getElementById('animation-container').appendChild(stage.canvas);
  console.log(`Stage set.`);
  stage.regenerate();
}

function newFrame() {
  let trace = document.getElementById("trace").value;
  if (trace == 1) {
    stage.context.fillStyle = FADE;
    stage.context.fillRect(0, 0, stage.canvas.width, stage.canvas.height);
  } else if (trace == 0) {
    stage.clear();
  }
  for (let particle of particles) {
    particle.inc();
  }
}

class Particle {
  constructor(r, x, y, v, theta, orient, color) {
    this.r = r;
    this.x = x;
    this.y = y;
    this.v = v;
    this.theta = theta;
    this.arwOrient = orient;
    this.color = color;
    this.init = [r, x, y, v, theta, orient, color];
    
    this.draw = function() {
      stage.context.beginPath();
      stage.context.strokeStyle = this.color;
      stage.context.lineWidth = 2;
      stage.context.arc(this.x, this.y, this.r, 0, 2*Math.PI);
      stage.context.stroke();

      let lineS = [this.x + this.r*Math.cos(this.theta), 
                  this.y + this.r*Math.sin(this.theta)];
      let lineE = [lineS[0] + ARW_SCALAR*this.v*Math.cos(this.theta),
                  lineS[1] + ARW_SCALAR*this.v*Math.sin(this.theta)];
      let arrowHead = [lineE[0] + ARH_LEN*Math.cos(this.theta +this.arwOrient*ARH_ANG),
                      lineE[1] + ARH_LEN*Math.sin(this.theta +this.arwOrient*ARH_ANG)];
      stage.context.beginPath();
      stage.context.strokeStyle = this.color;
      stage.context.lineWidth = 1;
      stage.context.moveTo(lineS[0], lineS[1]);
      stage.context.lineTo(lineE[0], lineE[1]);
      stage.context.lineTo(arrowHead[0], arrowHead[1]);
      stage.context.stroke();
    }

    this.inc = function() {
      let scalar = document.getElementById("temperature").value;
      let newX = this.x + scalar*this.v*Math.cos(this.theta);
      let newY = this.y + scalar*this.v*Math.sin(this.theta);
      let newPos = this.posEval(newX, newY);
      this.x = newPos[0];
      this.y = newPos[1];
      this.draw();
    }

    this.posEval = function(xNew, yNew) {
      if (xNew <= this.r && Math.cos(this.theta) < 0) {
        xNew = this.r; // condense to bound
        this.theta = Math.PI - this.theta;
      } else if (xNew >= stage.canvas.width -this.r && Math.cos(this.theta) > 0) {
        xNew = stage.canvas.width - this.r;
        this.theta = Math.PI - this.theta;
      } 
      if (yNew <= this.r && Math.sin(this.theta) < 0) {
        yNew = this.r;
        this.theta = -this.theta;
      } else if (yNew >= stage.canvas.height -this.r) {
        yNew = stage.canvas.height - this.r;
        this.theta = -this.theta;
      }
      return [xNew, yNew];
    }

    this.reset = function() {
      this.r = init[0];
      this.x = init[1];
      this.y = init[2];
      this.v = init[3];
      this.theta = init[4];
      this.arwOrient = init[5];
      this.color = init[6];
    }
  }
}

class Memory {
  constructor(r, x, y, v, theta, orient, color) {
    this.r = r;
    this.x = x;
    this.y = y;
    this.v = v;
    this.theta = theta;
    this.arwOrient = orient;
    this.color = color;
  }
}