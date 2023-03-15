'use strict';

const sub = document.getElementById('submit');
const pass1 = document.getElementById('pass1');
const pass2 = document.getElementById('pass2');
const textLen = document.querySelector('.texlen');
const comfirming = document.querySelector('.comfirming');


sub.addEventListener('submit',(event)=>{
    if(pass1.value < 8 || pass2.value < 8){
        swal('正しい形式で入力してください');
        event.stopPropagation();
       event.preventDefault();
    } })


    pass1.addEventListener('change',()=>{
        if(pass1.value.length < 8){
            let textlen = document.getElementsByClassName('textlen')[0];
    
            if(textlen){
                textlen.innerHTML = "";
            }
        
            textlen.insertAdjacentHTML('afterend','<div class="cau">※パスワードは8文字以上で入力してください</div>')
            pass1.style.border = '1px solid red';  
        }
    
        // if(pass1.value.length >= 8){
        //     let textlen = document.getElementsByClassName('textlen')[0];
        //     textlen.innerHTML = "";
        //     pass1.style.border = '1px solid #dbdbdb';
        // }
    
        if(!pass1.value.match(/^[A-Za-z0-9]*$/)){
            textlen.insertAdjacentHTML('afterend','<div class="hankaku1">※パスワードは半角で入力してください</div>');
            pass1.style.border = '1px solid red';  
        }
    })
    
    
    pass2.addEventListener('change',()=>{
        if(pass1.value !== pass2.value){
        let cau = document.getElementsByClassName('cau')[0];
    
        if(cau){
            cau.innerHTML = "";
        }
            comfirming.insertAdjacentHTML('afterend','<div class="cau">※パスワードが一致していません</div>')
            pass2.style.border = '1px solid red';  
        }
    
        if(pass1.value === pass2.value){
            let cau = document.getElementsByClassName('cau')[0];
            cau.innerHTML = "";
            pass2.style.border = '1px solid #dbdbdb';  
        }
        if(!pass2.value.match(/^[A-Za-z0-9]*$/)){
            comfirming.insertAdjacentHTML('afterend','<div class="hankaku2">※パスワードは半角で入力してください</div>');
            pass2.style.border = '1px solid red';  
        }
    })
    
    
    
        pass1.addEventListener('change',()=>{
            if(pass2.value.length >= 1){
            if(pass1.value !== pass2.value){
                let cau = document.getElementsByClassName('cau')[0];
    
                if(cau){
                    cau.innerHTML = "";
                }
            
                comfirming.insertAdjacentHTML('afterend','<div class="cau">※パスワードが一致しません</div>')
                pass2.style.border = '1px solid red';  
            }
        
            if(pass1.value === pass2.value){
                let cau = document.getElementsByClassName('cau')[0];
                cau.innerHTML = "";
                pass2.style.border = '1px solid #dbdbdb';  
            }
        }
        });
    