'use strict';
let btn = document.getElementById('btn');
let decrease = document.getElementById('decrease');
let num = document.getElementById('num');
let numbers = document.getElementById('numbers');


numbers.addEventListener('click', (e) => {
    console.log(num.value);
    e.preventDefault();
    for (let i = 0; i <= num.value - 1; i++) {
        let increase = document.querySelector('.increase');
        // for(let i=0;i<qas.length;i++){
        let division = document.createElement('div');
        let division2 = document.createElement('div');
        let question = document.createElement('input');
        question.type = 'text';
        question.name = 'question' + i;
        let answer = document.createElement('input');
        answer.type = 'text';
        answer.name = 'answer' + i;
        division.appendChild(question);
        division2.appendChild(answer);
        increase.appendChild(division);
        increase.appendChild(division2);
        division.insertAdjacentHTML('beforebegin', '問題');
        division2.insertAdjacentHTML('beforebegin', '答え');
        console.log(question.name);
        console.log(answer.name);
    }
});


decrease.addEventListener('click', () => {
    while (increase.firstChild) {
        increase.removeChild(increase.firstChild);
    }

})