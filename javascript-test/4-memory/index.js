const inputCircleNumber = document.querySelector("#circle-number");
const parent = inputCircleNumber.parentElement;
const buttonStart = document.querySelector("#start");
const divContainer = document.querySelector("#container");
const divOutput = document.querySelector("#output");




// Application state

let canGuess = false;
let solution = [];
let series = [];

// ========= Utility functions =========

function random(a, b) {
  return Math.floor(Math.random() * (b - a + 1)) + a;
}

function toggleHighlight(node) {
  node.classList.toggle("highlight")
  node.addEventListener("animationend", function (e) {
    node.classList.remove("highlight");
  }, {once: true});
}

// =====================================

const drawCircles = () => {
  //console.log(inputCircleNumber.value)
  document.querySelectorAll('.circle').forEach(c => {
    c.remove();
  });
  for(let i= 1;inputCircleNumber.value>i;i++){
  const newCircle = document.createElement("a");
  newCircle.classList.add("circle");
  newCircle.innerText = i;
  divContainer.appendChild(newCircle);

}
}
inputCircleNumber.addEventListener('input',drawCircles)
const startgame = (e) => {
 
    const circles = [...divContainer.querySelectorAll('a')];
    series = Array.from(Array(circles.length), (e, i) => random(i,7));
    solution = [];
    console.log(series);

    const flash = (i) => {
      if (i < circles.length) {
        toggleHighlight(circles[i]);
        setTimeout(() => {
          flash(i + 1);
        }, 1000);

        if (i < circles.length - 1) {
          divOutput.innerText = 'Flashing Circles...';
        } else {
          divOutput.innerText = 'Now, your turn...';
          canGuess = false;
        }
      }
    };
 
    flash(0);
  
};

buttonStart.addEventListener('click', startgame);

