'use strict';

let startTime = new Date();
let timer = document.getElementById('timer');
function startTimer(){
  let set = setInterval(() => {
        timer.innerText = 4 - getTimerTime();
        if(timer.innerText <= 1){
            timer.innerHTML = 1;
            clearInterval(set);
            setInterval(() => {
 let go = document.getElementById('go');
      go.submit();    
        return false;
    }, 1000);
        }
    }, 1000);       
} 
function getTimerTime(){
    return Math.floor((new Date() - startTime)/1000);
}
startTimer();