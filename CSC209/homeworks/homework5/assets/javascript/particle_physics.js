const FPS = 40; // 25fps
const RADIUS = 10;
const MIN_VEL = 5;
const RANGE_VEL = 10; // [3, 15]
const ARW_SCALAR = 2; // 10 pixels * velocity
const ARH_LEN = 7; // arrowhead length
const ARH_ANG = 7*Math.PI / 8;
const HEX = '0123456789ABCDEF';
var stage;
var particles = [];

function reset() { stage.redraw(); }
function begin() { stage.begin(); }
function freeze() { stage.stop(); }

function sceneSet() {
  stage = {
    canvas : document.createElement('canvas'),
    interval : null,
    begin : function() {
      this.interval = setInterval(newFrame, FPS);
    },
    stop : function() {
      clearInterval(this.interval);
    },
    redraw : function() {
      this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
      let count = document.getElementById('particle-count').value;
      particles = []; // reset
      for (let i = 0; i < count; i++) {
        let particle = new Particle();
        console.log(`Generating particle ${i}`);
        particle.draw();
        particles.push(particle);
      }
    }
  }
  stage.canvas.width = 400;
  stage.canvas.height = 400;
  stage.context = stage.canvas.getContext('2d');
  document.getElementById('animation-container').appendChild(stage.canvas);
  console.log(`Stage set.`);
}

class Particle {
  constructor() {
    // randomize a bunch of things
    this.r = RADIUS;
    this.x = 
      this.r + Math.floor(Math.random() * (stage.canvas.width -2*this.r +1)); // stay inside
    this.y = 
      this.r + Math.floor(Math.random() * (stage.canvas.height -2*this.r +1));
    this.v = 
      MIN_VEL + Math.floor(Math.random() * RANGE_VEL); // velocity
    this.theta = Math.random() * 2*Math.PI;

    // how to orient the arrowhead, clockwise or counterclockwise
    this.arwOrient = Math.floor(Math.random() * 2) == 1 ? 1 : -1;

    this.color = '#000000';
    
    this.draw = function() {
      console.log(`Particle at (${this.x}, ${this.y}), color: ${this.color}`);

      stage.context.beginPath();
      stage.context.strokeStyle = this.color;
      stage.context.lineWidth = 3;
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

    this.newPos = function(xNew, yNew) {
      if (xNew <= this.r && Math.cos(this.theta) < 0) {
        xNew = this.r; // condense to bound
        this.theta = -this.theta;
      } else if (xNew >= stage.canvas.width -this.r && Math.cos(this.theta) > 0) {
        xNew = stage.canvas.width - this.r;
        this.theta = -this.theta;
      } 
      if (yNew <= this.r && Math.sin(this.theta) < 0) {
        yNew = this.r;
        this.theta = Math.PI - this.theta;
      } else if (yNew >= stage.canvas.height -this.r) {
        yNew = stage.canvas.height - this.r;
        this.theta = Math.PI - this.theta;
      }
      return [xNew, yNew];
    }

    this.inc = function() {
      let newX = this.x + this.v*Math.cos(this.theta);
      let newY = this.y + this.v*Math.sin(this.theta);
      let posEval = this.newPos(newX, newY);
      this.x = posEval[0];
      this.y = posEval[1];
      this.draw();
    }
  }
}