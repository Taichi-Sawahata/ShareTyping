'uses strict';

     
let container = document.getElementById('card-list');

 let images = [['sharetyping/img/cardimg/christmas-tree-g8fad31f1e_1280.jpg'],

['sharetyping/img/cardimg/city-ge897208ff_1280.jpg'], ['sharetyping/img/cardimg/ferris-wheel-g417b7539d_1280.jpg'],

['sharetyping/img/cardimg/harvest-g7122a39ec_1280.jpg'],['sharetyping/img/cardimg/hd-wallpaper-g81054e8b6_1280.jpg'],

['sharetyping/img/cardimg/house-gefaddc750_1280.jpg'],

['sharetyping/img/cardimg/laptop-g435964f97_1280.jpg'],

['sharetyping/img/cardimg/little-panda-g4371da3a2_1280.jpg'],

 ['sharetyping/img/cardimg/tel-aviv-gff7958b54_1280.jpg'],['sharetyping/img/cardimg/woman-g8d0263664_1280.jpg']

];

//行
let row =document.createElement('row');
row.classList.add('row');


for(let i=0;i<json.length;i++){
 let imageNo = Math.floor(Math.random() * images.length);

 //カード
 let card = document.createElement('div');
 card.classList.add('card');

//カード画像、ランダムで出力。ユーザが好きな画像を登録できるようにしたい
 let img = document.createElement('img');
 let head = document.createElement('div');
 head.classList.add('head');
 img.src = images[imageNo];
//   images.splice(imageNo,1);
 head.appendChild(img);
 

 
 //カードタイトル
  let cardTitle = document.createElement('div');
  cardTitle.textContent = json[i];
  cardTitle.classList.add('card-title');

  //カード概要
  let cardText = document.createElement('div');
      cardText.classList.add('card-text');
      cardText.textContent = content[i];


  //カードが投稿された日時と作成ユーザ  
  let user = document.createElement('span');
  user.textContent = people[i];
  user.classList.add('user');
  let datetime = document.createElement('span');
  datetime.textContent = datepost[i];
  let foot = document.createElement('div');



  foot.appendChild(cardTitle);
  foot.appendChild(cardText);
  foot.appendChild(user);
  foot.appendChild(datetime);
  foot.classList.add('foot');
  

         
   //フォーム作成
  let form = document.createElement('form');
  form.method = 'post';
  form.id = 'start';
  let input = document.createElement('input');
  input.type = "hidden";
  input.value = json[i];
  input.name = 'game';
  input.classList.add('btn');
  form.appendChild(input);


  //カードに挿入
  card.appendChild(head);
  card.appendChild(foot);
  card.appendChild(form);

 
 row.appendChild(card);


 //カード四つで改行
 if(row.childElementCount === 5){
      row =document.createElement('row');
     row.classList.add('row');
     console.log(row.childElementCount);
 }



 container.appendChild(row);


 card.addEventListener('click',(e)=>{
           form.submit();
       
 })
}


