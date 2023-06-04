const task1 = document.querySelector('#task1');
const task2 = document.querySelector('#task2');
const task3 = document.querySelector('#task3');
const task4 = document.querySelector('#task4');

const game = [
  "XXO  ad",
  "OOX",
  "OOO",
];
// task 1
ifEqual = game.map(x=>x.length).every(raw => raw == game[0].length )
task1.innerText = `${ifEqual}`

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}

// task 2
isXO = [...new Set(game[0])]
onlyXO = isXO.every(x=> ['X','O'].includes(x))
task2.innerText = `${onlyXO}`

//task 3
function countX(x){
  let cnt =0
  for (let char in x){
    if (x[char] == "X"){
      cnt++;
    }
  }
  return cnt;
}
function countO(x){
  let cnt =0
  for (char in x){
    if (x[char] == "O"){
      cnt++;
    }
  }
  return cnt;
}

Xs = game.map(countX).reduce((x,y) => x+y,0)
Os = game.map(countO).reduce((x,y) => x+y,0)

task3.innerText = "X/O = " + `${Xs}` + "/" + `${Os}`


// task 4

raws_conseq = game.map(x => x.includes("XXX") || x.includes("OOO")).reduce(
  (out, bool, index) => bool ? out.concat(index) : out, 
  []
)
console.log(raws_conseq)
task4.innerText = `${raws_conseq}`






