'use strict';
//レッスン一覧ボタンはどこでもつけるから、ファイルにする
//summary.php Notsummary.php二つに分ける
let summary = document.getElementById('summary');
summary.addEventListener('click',()=>{
  window.location.href="../../topPage/php/Notsummary.php";
})

