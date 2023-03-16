'use strict';

//ログアウトしたとき
let post = document.getElementById('post');
let out = document.getElementById('out');
out.addEventListener('change', () => {
    // console.log('yy');
    post.submit();
})
//ロゴをくりっくしたとき
let img = document.getElementById('img');
img.addEventListener('click', () => {
    window.location.href = 'login_topPage.php';
})


