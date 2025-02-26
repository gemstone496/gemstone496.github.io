const FPS = 40; // 25fps
const RADIUS = 20;
const MAX_SPEED = 21; // [0, 20]
var stage;
var particles = [];

function freeze() { stage.stop(); }
function begin() { stage.begin(); }

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
        let x = Math.floor(Math.random() * (this.canvas.width -RADIUS +1) ); // stay inside
        let y = Math.floor(Math.random() * (this.canvas.height -RADIUS +1));
        let vector = Math.floor(Math.random() * MAX_SPEED);
        let dir = Math.random() * 2*Math.PI;
        let particle = new Particle(x, y, RADIUS, vector, dir, '#ffffff');
        particle.draw;
        particles.push(particle);
      }
    }
  }
  stage.canvas.width = 400;
  stage.canvas.height = 400;
  stage.context = stage.getContext('2d')
  document.getElementById('animation-container').appendChild(stage.canvas);
  stage.redraw();
}

class Particle {
  constructor(x, y, radius, speed, theta, color) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.speed = speed;
    this.theta = theta;
    this.color = color;
    this.draw = function() {

    }
  }
}