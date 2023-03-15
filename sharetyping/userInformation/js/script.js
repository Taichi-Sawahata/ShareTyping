'use strict';
//クイズを作っていくjs
//クイズのバリデーション
let btn = document.getElementById('btn');
let decrease = document.getElementById('decrease');
let num = document.getElementById('num');
let numbers = document.getElementById('numbers');
let footer = document.getElementById('footer');
let quiz = document.getElementById('quiz');
let sub = document.getElementById('submit');
let allDecrease = document.getElementById('allDecrease');
let counts = document.getElementsByClassName('count');
let textarea = document.getElementById('textarea');
let mit = document.getElementById('mit');
let count = Array.from(counts);
let q = 0;
let a = 0;
let i = 0;
let v = 0;

numbers.addEventListener('click',(e)=>{
    console.log(num.value);
     e.preventDefault();
     let deles = document.getElementsByClassName('delete');
     let dele = Array.from(deles);

    //  if(dele.length >0){
    //     console.log(v);
    //  }
    for(let i=0;i<=num.value-1;i++){
      let increase = document.querySelector('.increase');
      // for(let i=0;i<qas.length;i++){
          let division = document.createElement('div');
          let division2 = document.createElement('div');
           let question = document.createElement('input');
           question.type = 'text';
           question.name = 'question'+ i;
           question.classList.add('question');
           let answer = document.createElement('input');
           answer.type = 'text';
           answer.name = 'answer' + i;
           answer.classList.add('answer');
          division.appendChild(question);
          division2.appendChild(answer);
          division.classList.add('delete');
          division2.classList.add('delete');
          increase.appendChild(division);
          increase.appendChild(division2);
          division.insertAdjacentHTML('afterbegin','問題'+Number(v+i+1));
          division2.insertAdjacentHTML('afterbegin','答え'+Number(v+i+1));
      }
      v += Number(num.value);
  
  });



    function cancel(event){
        let answers = document.getElementsByClassName('answer');
        let answer = Array.from(answers);
        let questions = document.getElementsByClassName('question');
        let question = Array.from(questions);


        question.forEach(function(e){
            if(e.value.length > 20 || e.value.length === 0){
                  e.style.border = '1px solid red';             
                event.stopPropagation();
                event.preventDefault();
          }
  
             if(e.value.length <= 20){
              if(e.value.length > 0){
                  e.style.border = '1px solid #dbdbdb';
              }
              }
         
      })



        answer.forEach(function(e){
          if(e.value.length > 20 ){
                e.style.border = '1px solid red';
              event.stopPropagation();
              event.preventDefault();
        }

        if(e.value.length <= 20){
            if(e.value.length > 0){
                e.style.border = '1px solid #dbdbdb';
            }
          }

          if(e.value.match(/^[ぁ-んー]*$/)){   
            e.style.border = '1px solid #dbdbdb';
          }else{
                e.style.border = '1px solid red';             
                event.stopPropagation();
                event.preventDefault();
            }
        

         if(e.value.length === 0){
            e.style.border = '1px solid red';             
            event.stopPropagation();
            event.preventDefault();
         }
          })

        count.forEach(function(e){
            // e.addEventListener('input',()=>{
           if(e.value.length > 20 || e.value.length === 0 || e.value === "#"){
            e.style.border = '1px solid red';
        //    e.insertAdjacentHTML('beforebegin','<span class="cau">※20文字以内で入力してください</span>');
        event.stopPropagation();
        event.preventDefault();
           }
           if(e.value.length <= 20){
            if(e.value.length > 0 && e.value !== "#"){
                e.style.border = '1px solid #dbdbdb';
            }
           }
         
         })


         if(textarea.value.length > 30 || textarea.value.length === 0 ){
            textarea.style.border = '1px solid red';
          event.stopPropagation();
          event.preventDefault();
    }

    if(textarea.value.length <= 30){
        if(textarea.value.length > 0){
            textarea.style.border = '1px solid #dbdbdb';
        }
      }


      let deles = document.getElementsByClassName('delete');
      let dele = Array.from(deles);
     if(dele.length === 0){
       mit.insertAdjacentHTML('beforebegin','<p class="cau">クイズを作成してください</p>')
        event.stopPropagation();
        event.preventDefault();
     }
         }


    sub.addEventListener('submit',cancel);

    
    

 decrease.addEventListener('click',()=>{
   let deles = document.getElementsByClassName('delete');
   let dele = Array.from(deles);
 v--;
  dele.forEach(function(e){
    i++;
    
   if(dele.length-1 === i){
         e.remove();
    console.log(dele.length);
    console.log(i);
   }

   if(dele.length === i){
    e.remove();
    i=0;
   }
})
 })

 
 allDecrease.addEventListener('click',()=>{
    let deles = document.getElementsByClassName('delete');
    let dele = Array.from(deles);
    v=0;
   
    dele.forEach(function(e){
        e.remove();
    })

})





