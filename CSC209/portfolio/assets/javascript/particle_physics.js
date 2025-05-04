const CVS_WID = 500;
const CVS_HGT = 300;
const RADIUS = 5;
const MIN_VEL = 2;
const RANGE_VEL = 10; // [2, 12]
const HEX = '0123456789ABCDEF'; // hex code characters
const ARW_SCALAR = 1.5; // pixels * velocity
const ARH_LEN = 5; // arrowhead length
const ARH_ANG = 3*Math.PI / 4;
const FADE = '#ebe1ff33'
const FPS = 40; // 40ms = 25fps
var tracer;
var particles = [];

/**
 * toggles the state of the animation and updates the button accordingly
 * @param {HTMLButtonElement} button the button being pressed
 */
function toggleAnimation(button) {
  let mode = button.dataset.mode;
  mode == 'start' ? tracer.begin() : tracer.stop();
  button.textContent = mode == 'start' ? 'FREEZE' : 'Dance!';
  button.dataset.mode = mode == 'start' ? 'stop' : 'start';
}
function begin() {
  tracer.begin();
}
function freeze() {
  tracer.stop();
}

function updateParts() {
  let input = document.getElementById('particle-count');
  input.value = Math.max(1, Math.floor(input.value)); // no lower than 1, no decimals
  let count = input.value;
  while (count != particles.length) {
    if (count < particles.length) {
      particles.pop();
      if (count == particles.length && tracer.static) { // reset without purged particles
        tracer.clear();
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
 * Generates a Particle, adds it to the list, then returns it
 */
function particleBuilder() {
  // randomizer
  let r, x, y, v, theta, orient, rgb, color, particle, count;
  r = RADIUS;
  x = r + Math.floor(Math.random() * (tracer.canvas.width -2*r +1)); // stay inside
  y = r + Math.floor(Math.random() * (tracer.canvas.height -2*r +1));
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
  
  // construct
  particle = new Particle(r, x, y, v, theta, orient, color);

  // no overlap
  if (document.getElementById('collider').checked) {
    count = 0;
    while (particle.crashed(particles, 0) !== null) {
      if (count >= 50) { // too many particles
        console.error(`Saturation reached :(`);
        break;
      }
      particle.inc(); // sorta bad way to do this but i don't wanna do extra work
      count++;
    }
  }

  // push and draw
  particles.push(particle);
  particle.draw();
  return particle;
}

function sceneSet() {
  tracer = {
    canvas : document.createElement('canvas'),
    interval : null,
    static : true,
    begin : function() {
      this.stop();
      this.interval = setInterval(newFrame, FPS);
      this.static = false;
    },
    stop : function() {
      clearInterval(this.interval);
      this.static = true;
    },
    clear : function() {
      this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    redraw : function() {
      this.stop();
      this.clear();
      for (let particle of particles) {
        particle.reset();
        particle.draw();
      }
    },
    regenerate : function() {
      this.stop();
      this.clear();
      let count = document.getElementById('particle-count').value;
      particles = []; // reset
      for (let i = 0; i < count; i++) {// randomize a bunch of things
        let particle = particleBuilder();
      }
    }
  }
  tracer.canvas.width = CVS_WID;
  tracer.canvas.height = CVS_HGT;
  tracer.context = tracer.canvas.getContext('2d');
  document.getElementById('animation-container').appendChild(tracer.canvas);
  tracer.regenerate();
}

function newFrame() {
  let trace = document.getElementById("trace").value;
  if (trace == 1) {
    tracer.context.fillStyle = FADE;
    tracer.context.fillRect(0, 0, tracer.canvas.width, tracer.canvas.height);
  } else if (trace == 0) {
    tracer.clear();
  }

  // increment
  for (let particle of particles) {
    particle.inc();
  }
  
  // crash
  if (document.getElementById('collider').checked == true) {
    for (let i = 0; i < particles.length; i++){
      let particle = particles[i];
      let crasher = particle.crashed(particles, i);
      if (crasher !== null) {
        let d, rho_1, rho_2, phi, c, x_1, y_1, x_2, y_2, cot;

        radii = particle.r + crasher.r;
        d = Math.sqrt((crasher.x - particle.x)^2 + (crasher.y - particle.y)^2);
        rho_1 = Math.atan2(crasher.y - particle.y, crasher.x - particle.x);
        rho_2 = Math.PI - rho_1;

        // reflections
        particle.theta = 2*rho_1 + particle.theta;
        crasher.theta = 2*rho_2 - crasher.theta;

        // repositions
        // if (radii > d) {
        //   // particle reposition
        //   phi = particle.theta - rho_1;
        //   c = radii / Math.cos(phi) - d / Math.cos(phi);
        //   x_1 = c * Math.cos(Math.PI + particle.theta); 
        //   y_1 = c * Math.sin(Math.PI + particle.theta);

        //   // crasher reposition
        //   phi = crasher.theta - rho_2;
        //   c = radii / Math.cos(phi) - d / Math.cos(phi);
        //   x_2 = c * Math.cos(Math.PI + particle.theta); 
        //   y_2 = c * Math.sin(Math.PI + particle.theta);
          
        //   particle.x += x_1; particle.y += y_1;
        //   crasher.x += x_2; crasher.y += y_2;
        // }
      }
    }
  }

  // draw
  for (let particle of particles) {
    particle.draw();
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
      tracer.context.beginPath();
      tracer.context.strokeStyle = this.color;
      tracer.context.lineWidth = 2;
      tracer.context.arc(this.x, this.y, this.r, 0, 2*Math.PI);
      tracer.context.stroke();

      let lineS = [this.x + this.r*Math.cos(this.theta), 
                  this.y + this.r*Math.sin(this.theta)];
      let lineE = [lineS[0] + ARW_SCALAR*this.v*Math.cos(this.theta),
                  lineS[1] + ARW_SCALAR*this.v*Math.sin(this.theta)];
      let arrowHead = [lineE[0] + ARH_LEN*Math.cos(this.theta +this.arwOrient*ARH_ANG),
                      lineE[1] + ARH_LEN*Math.sin(this.theta +this.arwOrient*ARH_ANG)];
      tracer.context.beginPath();
      tracer.context.strokeStyle = this.color;
      tracer.context.lineWidth = 1;
      tracer.context.moveTo(lineS[0], lineS[1]);
      tracer.context.lineTo(lineE[0], lineE[1]);
      tracer.context.lineTo(arrowHead[0], arrowHead[1]);
      tracer.context.stroke();
    }

    this.inc = function() {
      let scalar = document.getElementById("temperature").value;
      let newX = this.x + scalar*this.v*Math.cos(this.theta);
      let newY = this.y + scalar*this.v*Math.sin(this.theta);
      let newPos = this.posEval(newX, newY);
      this.x = newPos[0];
      this.y = newPos[1];
    }

    this.posEval = function(xNew, yNew) {
      if (xNew <= this.r && Math.cos(this.theta) < 0) {
        xNew = this.r; // condense to bound
        this.theta = Math.PI - this.theta;
      } else if (xNew >= tracer.canvas.width -this.r && Math.cos(this.theta) > 0) {
        xNew = tracer.canvas.width - this.r;
        this.theta = Math.PI - this.theta;
      } 
      if (yNew <= this.r && Math.sin(this.theta) < 0) {
        yNew = this.r;
        this.theta = -this.theta;
      } else if (yNew >= tracer.canvas.height -this.r) {
        yNew = tracer.canvas.height - this.r;
        this.theta = -this.theta;
      }
      return [xNew, yNew];
    }

    this.reset = function() {
      this.r = this.init[0];
      this.x = this.init[1];
      this.y = this.init[2];
      this.v = this.init[3];
      this.theta = this.init[4];
      this.arwOrient = this.init[5];
      this.color = this.init[6];
    }

    this.crashed = function(particleList, start) {
      for (let i = start; i < particleList.length; i++){
        let otherParticle = particleList[i];
        if (this !== otherParticle && 
            Math.sqrt((otherParticle.x - this.x)**2 + (otherParticle.y - this.y)**2
            ) <= otherParticle.r + this.r) {
          return otherParticle;
        }
      }
      return null;
    }
  }
}