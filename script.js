function delegate(parent, child, when, what){
    function eventHandlerFunction(event){
        let eventTarget  = event.target
        let eventHandler = this
        let closestChild = eventTarget.closest(child)

        if(eventHandler.contains(closestChild)){
            what(event, closestChild)
        }
    }

    parent.addEventListener(when, eventHandlerFunction)
}

///////////////////////////////////////////////////////////////

const board = document.querySelector('#table_board');
const show = document.querySelector('#show')
const check_sol = document.querySelector('#check')
const scoreBoard = document.querySelector('#scoreboard')
const solution = boards["easy_sol"]
const show7 = document.querySelector('#but7x7');
const showAdv = document.querySelector('#A7x7');
const show10 = document.querySelector('#but10x10');
const timer = document.querySelector('#time')
const cast = document.querySelector('#cast')

///////////////////////////////////////////////////////////////

function createBoard(lev){
    board.querySelectorAll('tr').forEach(c => {
        c.remove();
      });
      let l = boards[lev].length
      for(let i = 0; i<l;i++){
          const newR = document.createElement('tr');
          for(let j = 0; j<l;j++){
            const newD = document.createElement('td');
            newD.dataset.rowIndex = i;
            newD.dataset.colIndex = j;
            newD.dataset.lamp = 0;
            newD.dataset.placedlamp = 0;
            if (boards[lev][i][j] > -1){
                //newD.style.color = "white";
                newD.style.backgroundColor = "black";
                newD.innerText = boards[lev][i][j];
                newD.dataset.allowedlamps = boards[lev][i][j];
            }
            if (boards[lev][i][j] <-1){
                //newD.style.color = "white";
                newD.style.backgroundColor = "black";
                
                //newD.innerText = boards["boardA_7x7"][i][j];
            }
            newR.appendChild(newD);
        }
        board.appendChild(newR)
    }


}

//////////////////////////////////////////////////////////////////////////////////////////


function doColoring2(event, element){
    const boardsize = Math.sqrt(board.querySelectorAll('td').length);
    //console.log(boardsize)
    if(element.style.backgroundColor == "black"){
        return;
    }
    
    if (element.innerHTML === ""){
        
        if(element.dataset.lamp != 0){
            element.classList.add('error'); 
            element.innerHTML = "<div>&#128161;</div>";
            return;
        }else{
            element.innerHTML = "<div>&#128161;</div>";
            element.dataset.placedlamp = 1;
            raw = element.dataset.rowIndex  ;
            col = element.dataset.colIndex  ;
  
            //const rows =document.querySelectorAll('tr')
            ti=200
            for(let i = parseInt(col)+1 ; i<boardsize ; i++){
                const place = '[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+i +"'" + ']'
                const tdata = board.querySelector(place);
                let iflamp = parseInt(tdata.dataset.lamp)

                if(tdata.style.backgroundColor === "black"){
                    break
                }else{
                    iflamp++
                    tdata.dataset.lamp = iflamp
                    setTimeout(() => {tdata.classList.add('luminate')},ti);
                }
                ti+=200
            }
            ti=200
            for(let i = parseInt(col)-1 ; i>=0 ; i--){
                
                const place = '[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+i +"'" + ']'
                const tdata = board.querySelector(place);
                let iflamp = parseInt(tdata.dataset.lamp)

                if(tdata.style.backgroundColor === "black"){
                    break
                }else{
                    iflamp++
                    tdata.dataset.lamp = iflamp
                    setTimeout(() => {tdata.classList.add('luminate')},ti);
                }
                ti+=200
            }
            ti=200
            for(let i = parseInt(raw)+1 ; i<boardsize ; i++){
                
                const place = '[data-row-Index=' +"'"+i +"'"+ '][data-col-Index='+"'"+col +"'" + ']'
                const tdata = board.querySelector(place);
                let iflamp = parseInt(tdata.dataset.lamp)

                if(tdata.style.backgroundColor === "black"){
                    break
                }else{
                    iflamp++
                    tdata.dataset.lamp = iflamp
                    setTimeout(() => {tdata.classList.add('luminate')},ti);
                }
                ti+=200
                
            }
            ti=200
            for(let i = parseInt(raw) ; i>=0 ; i--){
                
                const place = '[data-row-Index=' +"'"+i +"'"+ '][data-col-Index='+"'"+col +"'" + ']'
                const tdata = board.querySelector(place);
                let iflamp = parseInt(tdata.dataset.lamp)

                if(tdata.style.backgroundColor === "black"){
                    break
                }else{
                    iflamp++
                    tdata.dataset.lamp = iflamp
                    console.log(tdata.dataset.lamp)
                    setTimeout(() => {tdata.classList.add('luminate')},ti);
                }
                ti+=200
            }
            
        }
        
    }else{
        element.innerHTML = "";
        element.dataset.placedlamp = 0;
        if(element.classList.contains('error')){element.classList.remove('error'); return}
        raw = element.dataset.rowIndex  ;
        col = element.dataset.colIndex  ;
        
        //const rows =document.querySelectorAll('tr')
        for(let i = parseInt(col) ; i<boardsize ; i++){
            const place = '[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+i +"'" + ']'
            const tdata = board.querySelector(place);
            let iflamp = parseInt(tdata.dataset.lamp)
            if(tdata.style.backgroundColor === "black"){
                break
            }else{
                if (tdata.dataset.lamp == 1){
                    iflamp--
                    tdata.dataset.lamp = iflamp
                    tdata.classList.remove('luminate');
                    }else{
                        iflamp--
                        tdata.dataset.lamp = iflamp
                    }
            
            }
    
        }
        for(let i = parseInt(col)-1 ; i>=0 ; i--){
            const place = '[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+i +"'" + ']'
            const tdata = board.querySelector(place);
            let iflamp = parseInt(tdata.dataset.lamp)
            if(tdata.style.backgroundColor === "black"){
                break
            }else{
                if (tdata.dataset.lamp == 1){
                    iflamp--
                    tdata.dataset.lamp = iflamp
                    tdata.classList.remove('luminate');
                    }else{
                        iflamp--
                        tdata.dataset.lamp = iflamp
                    }
            
            }
    
        }
        for(let i = parseInt(raw)+1 ; i<boardsize ; i++){
            const place = '[data-row-Index=' +"'"+i +"'"+ '][data-col-Index='+"'"+col +"'" + ']'
            const tdata = board.querySelector(place);
            let iflamp = parseInt(tdata.dataset.lamp)
            if(tdata.style.backgroundColor === "black"){
                break
            }else{
                if (tdata.dataset.lamp == 1){
                    iflamp--
                    tdata.dataset.lamp = iflamp
                    tdata.classList.remove('luminate');
                    }else{
                        iflamp--
                        tdata.dataset.lamp = iflamp
                    }
            
            }
            
    
        }
        for(let i = parseInt(raw)-1 ; i>=0 ; i--){
            const place = '[data-row-Index=' +"'"+i +"'"+ '][data-col-Index='+"'"+col +"'" + ']'
            const tdata = board.querySelector(place);
            let iflamp = parseInt(tdata.dataset.lamp)
            if(tdata.style.backgroundColor === "black"){
                break
            }else{
                if (tdata.dataset.lamp == 1){
                    iflamp--
                    tdata.dataset.lamp = iflamp
                    tdata.classList.remove('luminate');
                    }else{
                        iflamp--
                        tdata.dataset.lamp = iflamp
                    }
            
            }
            
    
        
        
        }
             
                
    }}



/////////////////////////////////////////////////////////////////////////////////////////////



function placeLamps(event,element){
    raw = element.dataset.rowIndex  ;
    col = element.dataset.colIndex  ;
    ind = raw*col
    //const rows =document.querySelectorAll('tr')
    for(let i = parseInt(col)+1 ; i<7 ; i++){
        const place = '[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+i +"'" + ']'
        const tdata = board.querySelector(place);
        console.log(place)
        console.log(tdata);
        if(tdata.style.backgroundColor === "black"){
            break
        }else{
            tdata.classList.add('luminate');
        }

    }
    // for (let i in board.querySelectorAll('td')){
    //     console.log(board.querySelectorAll('td')[i])
    // }
}





/////////////////////////////////////////////////////////////////////////////////////////////



function check(){
    let allIluminated = false
    let allTiles = true
    let sol = Array.from(board.querySelectorAll('td')).filter(x => x.style.backgroundColor != "black" );
    const blacktiles = Array.from(board.querySelector('td')).filter(x => x.style.backgroundColor === "black");
    if(
        sol.every( x => x.dataset.lamp != 0) && surround()
    ){
        sol.forEach( x => x.style.backgroundColor = "lightgreen")
        addScore();
    }else{
            sol.forEach( x => x.style.backgroundColor = "lightcoral")

        }
   

}

function surround(){
    const blacktiles = Array.from(board.querySelectorAll('td')).filter(x => x.style.backgroundColor === "black" && parseInt(x.dataset.allowedlamps)>=0);
    for(let blacktile in blacktiles) {
        console.log(blacktiles[blacktile])
        raw = parseInt(blacktiles[blacktile].dataset.rowIndex)
        col = parseInt(blacktiles[blacktile].dataset.colIndex)
        allowed = blacktiles[blacktile].dataset.allowedlamps
        flag = true;
        let cnt = 0;
        let up,dn,rt,lft;
        if (raw == 0){
              up = 0
              dn = document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              rt = document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
              lft = document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
              console.log(dn)
              console.log(rt)
              console.log(lft)
             cnt = parseInt(dn)+parseInt(lft)+parseInt(rt)
             console.log(cnt)
        }else if(raw == 6){
              dn = 0
              up = document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              rt = document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col+1) +"'" + ']').dataset.placedlamp
              lft = document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
             cnt = parseInt(lft)+parseInt(rt)+parseInt(up)
             console.log(cnt)
        
        }
        else if (col == 0){
              lft = 0
              dn =  document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              rt =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col+1) +"'" + ']').dataset.placedlamp
              up =  document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
             cnt = parseInt(dn)+parseInt(lft)+parseInt(rt)+parseInt(up)
             console.log(cnt)
        }else if(col == 6){
              rt = 0
              dn =  document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              up =  document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              lft =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
             cnt = parseInt(dn)+parseInt(lft)+parseInt(up)
             console.log(cnt)
        }
        else if(col == 6 && raw ==6){
              rt = 0
              dn = 0
              up =  document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              lft =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
             cnt = parseInt(lft)+parseInt(up)
             console.log(cnt)
        }
        else if(col == 0 && raw ==0){
              dn =  document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              rt =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col+1) +"'" + ']').dataset.placedlamp
              up =  0
              lft =  0
             cnt = parseInt(dn)+parseInt(rt)
             console.log(cnt)
        }
        else if(col == 0 && raw ==6){
              up =  document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              rt =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col+1) +"'" + ']').dataset.placedlamp
              dn =  0
              lft =  0
             cnt = parseInt(rt)+parseInt(up)
             console.log(cnt)
        }
        else if(col == 6 && raw ==0){
              dn =  document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              lft =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
              up =  0
              rt =  0
             cnt = parseInt(dn)+parseInt(lft)
             console.log(cnt)
        }else{
              dn =  document.querySelector('[data-row-Index=' +"'"+(raw+1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              up =  document.querySelector('[data-row-Index=' +"'"+(raw-1) +"'"+ '][data-col-Index='+"'"+col +"'" + ']').dataset.placedlamp
              lft =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col-1) +"'" + ']').dataset.placedlamp
              rt =  document.querySelector('[data-row-Index=' +"'"+raw +"'"+ '][data-col-Index='+"'"+(col+1) +"'" + ']').dataset.placedlamp
             cnt = parseInt(dn)+parseInt(lft)+parseInt(rt)+parseInt(up)
             console.log(cnt)
        }
        flag = flag && (cnt == allowed)
        console.log(flag)
     }
     return flag
    
}


function addScore(){
    const time = document.querySelector('a').innerText;
    const name = document.querySelector('#score').querySelector('input').value;
    const newrow = document.createElement('tr')
    const newname = document.createElement('th')
    const newscore = document.createElement('th')
    const newlvl = document.createElement('th')
    newname.innerText = name;
    newscore.innerText = time;
    newlvl.innerText = lev;
    newrow.appendChild(newname);
    newrow.appendChild(newscore);
    newrow.appendChild(newlvl);
    document.getElementById('score_table').appendChild(newrow);
    clearInterval(intervalId);

}



function startTimer(){
    const time = timer.querySelector('a')
}
        


////////////////////////////////////////////////////////////////////

//show.addEventListener('click',createBoard)
//delegate(board, 'td', 'click', doColoring)
delegate(board, 'td', 'click', doColoring2)
delegate(board, 'td', 'contextmenu', (event,element)=>{
    element.style.backgroundColor = "black";
})
// delegate(board, 'td', 'click', placeLamps)


////////////////////////////////////////////////////////////////////
let lev = "";
let lvl = "";
show7.addEventListener('click', event => {
     lev = "easy";
     lvl = "easy_sol"
    createBoard(lev);
    time = -1;
    incrementTime();
    intervalId = setInterval(incrementTime, 1000);
})
show10.addEventListener('click', event => {
    lev = "extreme";
    createBoard(lev);
    time = -1;
    incrementTime();
    intervalId = setInterval(incrementTime, 1000);
})
showAdv.addEventListener('click', event => {
    lev = "advanced";
    createBoard(lev);
    time = -1;
    incrementTime();
    intervalId = setInterval(incrementTime, 1000);
})



dim = document.createElement('input');
dim.setAttribute("type", "text");
dim.setAttribute("value", "Enter Dimention");
but = document.createElement('button');
but.setAttribute('id','sub');
but.innerText = "submit"

cast.addEventListener('click',()=>{
   document.querySelector('#selectB').appendChild(dim)
   document.querySelector('#selectB').appendChild(but)

})

but.addEventListener('click',()=>{
    
    lev = "Costum";
    board.querySelectorAll('tr').forEach(c => {
        c.remove();
      });
      let l = parseInt(dim.value)
      console.log(l)
      for(let i = 0; i<l;i++){
          const newR = document.createElement('tr');
          for(let j = 0; j<l;j++){
            const newD = document.createElement('td');
            newD.dataset.rowIndex = i;
            newD.dataset.colIndex = j;
            newD.dataset.lamp = 0;

            newR.appendChild(newD);
        }
        board.appendChild(newR)
    }
    document.querySelector('[type="text"]').remove()
    document.querySelector('[id="sub"]').remove()

})

check_sol.addEventListener('click', event => {
    check();
 
  
})

