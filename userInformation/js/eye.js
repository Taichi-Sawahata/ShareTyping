'use strict';

const buttonEye1 = document.getElementById('buttonEye1');
const buttonEye2 = document.getElementById('buttonEye2');

buttonEye1.addEventListener('click',()=>{
  if(pass1.type === "password"){
    pass1.setAttribute('type', 'text');
    buttonEye1.classList.remove('fa-eye-slash');
    buttonEye1.classList.add('fa-eye');
  }else{
    pass1.setAttribute('type', 'password');
    buttonEye1.classList.remove('fa-eye');
    buttonEye1.classList.add('fa-eye-slash');
  }
})

buttonEye2.addEventListener('click',()=>{
  if(pass2.type === "password"){
    pass2.setAttribute('type', 'text');
    buttonEye2.classList.remove('fa-eye-slash');
    buttonEye2.classList.add('fa-eye');
  }else{
    pass2.setAttribute('type', 'password');
    buttonEye2.classList.remove('fa-eye');
    buttonEye2.classList.add('fa-eye-slash');
  }
})