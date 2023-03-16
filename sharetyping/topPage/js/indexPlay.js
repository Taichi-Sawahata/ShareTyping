'uses strict';


let container = document.getElementById('card-list');
let array = [];
let three_arrarys = [];

let three_arrary = [];
let zero = 0;
let card;
//行
let row = document.createElement('div');
row.classList.add('row');


for (let i = 0; i < json.length; i++) {

  //カード
  let card = document.createElement('div');
  card.classList.add('card');

  //カード画像、ランダムで出力。ユーザが好きな画像を登録できるようにしたい
  let img = document.createElement('img');
  let head = document.createElement('div');
  head.classList.add('head');
  console.log(file[i]);
  img.setAttribute('src', file[i]);
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
  datetime.classList.add('datetime');
  let foot = document.createElement('div');


  foot.appendChild(user);
  foot.appendChild(cardTitle);
  foot.appendChild(cardText);
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


  //カード5つで改行
  if (row.childElementCount === 4) {
    three_arrary.push(row);

    if (container.childElementCount < 3) {
      container.appendChild(row);
    }
    row = document.createElement('div');
    row.classList.add('row');

  }

  if (three_arrary.length === 3) {
    let item = three_arrary.splice(0, 3);
    three_arrarys.push(item);
  }


  if (row.childElementCount < 5 && json[i] === json[json.length - 1]) {
    three_arrary.push(row);
    let item = three_arrary.splice(0, 3);
    three_arrarys.push(item);
  }

  card.addEventListener('click', (e) => {
    form.submit();

  })
}


let current_page = 0;
let kazu = 0;


page();

let list = document.querySelectorAll('li');
let count = 1;

let li1 = document.getElementById('li1');
let li2 = document.getElementById('li2');
let li3 = document.getElementById('li3');
let li4 = document.getElementById('li4');
let li5 = document.getElementById('li5');

li1.addEventListener('click', () => {
  li1.innerHTML = li1.innerHTML;
  li2.innerHTML = Number(li1.innerHTML) + 1;
  li3.innerHTML = Number(li2.innerHTML) + 1;
  li5.innerHTML = three_arrarys.length;



  if (li3.innerHTML > three_arrarys.length) {
    li3.innerHTML = '...';
  }

  if (li2.innerHTML > three_arrarys.length) {
    li2.innerHTML = '...';
  }

  current_page = li1.innerHTML - 1;
  console.log(current_page);
  page();
})

li2.addEventListener('click', () => {

  if (li2.innerHTML === '...') {
    return;
  }

  li1.innerHTML = li2.innerHTML;
  li2.innerHTML = Number(li1.innerHTML) + 1;
  li3.innerHTML = Number(li2.innerHTML) + 1;
  li5.innerHTML = three_arrarys.length;


  if (li2.innerHTML > three_arrarys.length) {
    li2.innerHTML = '...';
  }


  if (li3.innerHTML > three_arrarys.length) {
    li3.innerHTML = '...';
  }

  current_page = li1.innerHTML - 1;
  console.log(current_page);
  page();
})

li3.addEventListener('click', () => {

  if (li3.innerHTML === '...') {
    return;
  }

  li1.innerHTML = li3.innerHTML;
  li2.innerHTML = Number(li1.innerHTML) + 1;
  li3.innerHTML = Number(li2.innerHTML) + 1;
  li5.innerHTML = three_arrarys.length;



  if (li2.innerHTML > three_arrarys.length) {
    li2.innerHTML = '...';
  }


  if (li3.innerHTML > three_arrarys.length) {
    li3.innerHTML = '...';
  }


  current_page = li1.innerHTML - 1;
  //  console.log(current_page);
  page();
})



li5.addEventListener('click', () => {
  li1.innerHTML = li5.innerHTML;
  li2.innerHTML = '...';
  li3.innerHTML = '...';
  li5.innerHTML = three_arrarys.length;
  current_page = li1.innerHTML - 1;
  //  console.log(current_page);
  page();
})







const prev = document.getElementById('prev');
const next = document.getElementById('next');

prev.addEventListener('click', () => {
  if (Number(li1.innerHTML) - 1 > 0) {
    li1.innerHTML = Number(li1.innerHTML) - 1;
    li2.innerHTML = Number(li1.innerHTML) + 1;
    li3.innerHTML = Number(li2.innerHTML) + 1;
    li5.innerHTML = three_arrarys.length;
  }


  if (li3.innerHTML > three_arrarys.length) {
    li3.innerHTML = '...';
  }

  if (li2.innerHTML > three_arrarys.length) {
    li2.innerHTML = '...';
  }




  if (current_page <= 0) {
    current_page = 0;
  } else {
    current_page--;
  }

  page();


});



let last = 0;


next.addEventListener('click', () => {
  last = Number(li1.innerHTML);
  if (last === three_arrarys.length) {
    return;
  }
  li1.innerHTML = Number(li1.innerHTML) + 1;
  li2.innerHTML = Number(li1.innerHTML) + 1;
  li3.innerHTML = Number(li2.innerHTML) + 1;
  li5.innerHTML = three_arrarys.length;


  if (li3.innerHTML > three_arrarys.length) {
    li3.innerHTML = '...';
  }

  if (li2.innerHTML > three_arrarys.length) {
    li2.innerHTML = '...';
  }


  if (three_arrarys.length < current_page) {
    current_page = three_arrarys.length;
  } else {
    current_page++;
  }

  page();

})


function page() {
  let a = document.querySelectorAll('.row');
  a.forEach((e) => {
    e.remove();
  })



  let els = three_arrarys[current_page];
  //   console.log(els);
  els.forEach((e) => {
    let row = document.createElement('div');
    row.classList.add('row');
    row.innerHTML = e.innerHTML;
    container.appendChild(row);

    let row_child = row.childNodes;
    row_child.forEach((el) => {

      el.addEventListener('click', () => {
        el.children[2].submit();
      })
    })

  })

  //   console.log(container);
}



//初期化
let initialize = document.getElementById('initialize');
initialize.addEventListener('click', () => {
  li1.innerHTML = 1;
  li2.innerHTML = 2;
  li3.innerHTML = 3;
  li4.innerHTML = '...';
  li5.innerHTML = three_arrarys.length;
  current_page = 0;
  page();
})