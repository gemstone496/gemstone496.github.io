const CV_MAX_RADIUS = 15;
const FPA = 8; // "frames per animation" (balance animations to end in 8 frames)
const FPS = 100; // 100ms == 10 fps
const TRACER_ID = "tracer";
var tracer;

/**
 * fades out the tracer object on an interval-length callback
 */
function tracerFade() {
  tracer.count += 1;
  tracer.circlet.style.opacity = tracer.maxOpacity - tracer.count*tracer.maxOpacity/FPA;
  if (tracer.count === FPA) {
    tracer.count = 0;
    clearInterval(tracer.interval);
  }
}

/**
 * loads the tracer canvas and sets up for user cursor tracing
 */
function tracerLoad() {
  tracer = {
    circlet : document.querySelector(`#${TRACER_ID}`),
    count : 0,
    interval : null,
    maxOpacity : 0.8,
    clear : function() {
      clearInterval(this.interval);
      this.ctx.clearRect(0, 0, this.width, this.height);
    }
  }
  tracer.height = window.getComputedStyle(tracer.circlet).height; // styles shouldn't change, ever
  tracer.width = window.getComputedStyle(tracer.circlet).width; // no really, don't change the styles
  document.body.addEventListener("mousemove", tracerUpdate);
}

/**
 * updates the tracer with a new location
 * @param {MouseEvent} e the mousemove event updating the tracer
 */
function tracerUpdate(e) {
  let left = e.x - dimension(tracer.width)/2; // center tracer
  let top = e.y - dimension(tracer.height)/2; // center tracer
  tracer.circlet.style.left = left + "px";
  tracer.circlet.style.top = top + "px";
  tracer.circlet.style.opacity = tracer.maxOpacity;
  
  tracer.count = 0;
  clearInterval(tracer.interval); // always clear before setting again
  tracer.interval = setInterval(tracerFade, FPS)
}