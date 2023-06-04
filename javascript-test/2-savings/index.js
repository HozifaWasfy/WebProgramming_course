
const form = document.querySelector('form');
const divContainer = document.querySelector('.container');

const calculateCi = (value, max, consumption) => (value / max) * consumption;
const sliders = [...document.querySelectorAll('input')];
const labels = [...document.querySelectorAll('label')];


let total_energy = 0;
function reload() {
  // ! task 1
let Tconsumptoin = 0
    for(let i in sliders){
        const cons = parseInt(sliders[i].dataset.consumption)
        Tconsumptoin += cons;
    }
    console.log(Tconsumptoin)
// ! task 2 
    sliders.forEach((v) => {
    const label = labels.filter(
      (l) => l.getAttribute('for') === v.id
    )[0];
    const ci = calculateCi(
      parseInt(v.value),
      parseInt(v.max),
      parseInt(v.dataset.consumption)
    );
    // task 3
    label.style.width = `${(ci / Tconsumptoin) * 100}%`;
    console.log(`consumption of input is:`, ci);
  });
};

reload();

// ! task 4
form.addEventListener('input', reload);







