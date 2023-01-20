'use strict';

//ログアウトしたとき
let out = document.getElementById('out');
out.addEventListener('click',()=>{
        // console.log('yy');
      swal('ゲーム中にログアウトできません');
})
//ロゴをくりっくしたとき
let img = document.getElementById('img');
img.addEventListener('click',()=>{
    window.location.href = 'login_topPage.php';
})


