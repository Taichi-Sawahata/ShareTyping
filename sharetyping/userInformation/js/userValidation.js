'use strict';

const email = document.getElementById('email');
const mail = document.querySelector('.email');
const pass1 = document.getElementById('pass1');
const pass2 = document.getElementById('pass2');
// const buttonEye1 = document.getElementById('buttonEye1');
// const buttonEye2 = document.getElementById('buttonEye2');
const pattern = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/;
const sub = document.getElementById('submit');
const comfirming = document.querySelector('.comfirming');
const textLen = document.querySelector('.texlen');
const user_name = document.getElementById('user_name');
const user = document.querySelector('.user');
// const user_sub = document.getElementById('user_sub');
// const mail_sub = document.getElementById('mail_sub');
// const submitBtn = document.getElementById('subBtn');


    sub.addEventListener('submit',(event)=>{
        if(user_name.value.length > 0 && email.value.match(pattern) && pass1.value.length >= 8 && pass1.value === pass2.value 
         && pass1.value.match(/^[A-Za-z0-9]*$/) && pass2.value.match(/^[A-Za-z0-9]*$/)){
            sub.submit();
         }else{
                 swal('正しい形式で入力してください');
                 event.stopPropagation();
                event.preventDefault();
             }})


        


 user_name.addEventListener('change',()=>{
 


     if(user_name.value.length === 0){
        let userlen = document.getElementsByClassName('userlen')[0];

        if(userlen){
            userlen.innerHTML = "";
        }
    
         user.insertAdjacentHTML('afterend','<span class="userlen">※ユーザネームを確認してください</span>');
         user_name.style.border = '1px solid red'; 
     }   

     if(user_name.value.length > 0){
     let userlen = document.getElementsByClassName('userlen')[0];
     userlen.innerHTML = "";
     user_name.style.border = '1px solid #dbdbdb';
     }



 })





email.addEventListener('change',(event)=>{
    let caution = document.getElementsByClassName('caution')[0];

    if(caution){
        caution.innerHTML = "";
    }

    if (!email.value.match(pattern)){
        mail.insertAdjacentHTML('afterend','<span class="caution">※メールアドレスを確認してください</span>');
        email.style.border = '1px solid red';  
                }
               

    if(email.value.match(pattern)) {
        let caution = document.getElementsByClassName('caution')[0];
        caution.innerHTML = "";
        email.style.border = '1px solid #dbdbdb';
    }
})


pass1.addEventListener('change',()=>{
    if(pass1.value.length < 8){
        let textlen = document.getElementsByClassName('textlen')[0];

        if(textlen){
            textlen.innerHTML = "";
        }
    
        textLen.insertAdjacentHTML('afterend','<span class="textlen">※パスワードは8文字以上で入力してください</span>')
        pass1.style.border = '1px solid red';  
    }

    if(pass1.value.length >= 8){
        let textlen = document.getElementsByClassName('textlen')[0];
        textlen.innerHTML = "";
        pass1.style.border = '1px solid #dbdbdb';
    }

    if(!pass1.value.match(/^[A-Za-z0-9]*$/)){
        textLen.insertAdjacentHTML('afterend','<span class="hankaku1">※パスワードは半角で入力してください</span>');
        pass1.style.border = '1px solid red';  
    }
})


pass2.addEventListener('change',()=>{
    if(pass1.value !== pass2.value){
    let cau = document.getElementsByClassName('cau')[0];

    if(cau){
        cau.innerHTML = "";
    }

        comfirming.insertAdjacentHTML('afterend','<span class="cau">※パスワードが一致していません</span>')
        pass2.style.border = '1px solid red';  
    }

    if(pass1.value === pass2.value){
        let cau = document.getElementsByClassName('cau')[0];
        cau.innerHTML = "";
        pass2.style.border = '1px solid #dbdbdb';  
    }
    if(!pass2.value.match(/^[A-Za-z0-9]*$/)){
        comfirming.insertAdjacentHTML('afterend','<span class="hankaku2">※パスワードは半角で入力してください</span>');
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
        
            comfirming.insertAdjacentHTML('afterend','<span class="cau">※パスワードが一致しません</span>')
            pass2.style.border = '1px solid red';  
        }
    
        if(pass1.value === pass2.value){
            let cau = document.getElementsByClassName('cau')[0];
            cau.innerHTML = "";
            pass2.style.border = '1px solid #dbdbdb';  
        }
    }
    });







