'use strict';

    const romanMap = {
      'あ':['a'], 'い':['i', 'yi'], 'う':['u', 'wu'], 'え':['e'], 'お':['o'],
      'か':['ka', 'ca'], 'き':['ki'], 'く':['ku', 'cu', 'qu'], 'け':['ke'], 'こ':['ko', 'co'],
      'さ':['sa'], 'し':['si', 'shi', 'ci'], 'す':['su'], 'せ':['se', 'ce'], 'そ':['so'],
      'た':['ta'], 'ち':['ti', 'chi'], 'つ':['tu', 'tsu'], 'て':['te'], 'と':['to'],
      'な':['na'], 'に':['ni'], 'ぬ':['nu'], 'ね':['ne'], 'の':['no'],
      'は':['ha'], 'ひ':['hi'], 'ふ':['fu', 'hu'], 'へ':['he'], 'ほ':['ho'],
      'ま':['ma'], 'み':['mi'], 'む':['mu'], 'め':['me'], 'も':['mo'],
      'や':['ya'], 'ゆ':['yu'], 'よ':['yo'],
      'ら':['ra'], 'り':['ri'], 'る':['ru'], 'れ':['re'], 'ろ':['ro'],
      'わ':['wa'], 'ゐ':['wyi'], 'ゑ':['wye'], 'を':['wo'], 'ん':['nn', 'xn', 'n'],
      'が':['ga'], 'ぎ':['gi'], 'ぐ':['gu'], 'げ':['ge'], 'ご':['go'],
      'ざ':['za'], 'じ':['ji', 'zi'], 'ず':['zu'], 'ぜ':['ze'], 'ぞ':['zo'],
      'だ':['da'], 'ぢ':['di'], 'づ':['du'], 'で':['de'], 'ど':['do'],
      'ば':['ba'], 'び':['bi'], 'ぶ':['bu'], 'べ':['be'], 'ぼ':['bo'],
      'ぱ':['pa'], 'ぴ':['pi'], 'ぷ':['pu'], 'ぺ':['pe'], 'ぽ':['po'],
      'うぁ':['wha'], 'うぃ':['whi'], 'うぇ':['whe'], 'うぉ':['who'],
      'きゃ':['kya'], 'きぃ':['kyi'], 'きゅ':['kyu'], 'きぇ':['kye'], 'きょ':['kyo'],
      'くぁ':['qa', 'qwa'], 'くぃ':['qi', 'qwi'], 'くぇ':['qe', 'qwe'], 'くぉ':['qo', 'qwo'], 'くゃ':['qya'], 'くゅ':['qyu'], 'くょ':['qyo'],
      'しゃ':['sya', 'sha'], 'しぃ':['syi'], 'しゅ':['syu', 'shu'], 'しぇ':['sye', 'she'], 'しょ':['syo', 'sho'],
      'つぁ':['tsa'], 'つぃ':['tsi'], 'つぇ':['tse'], 'つぉ':['tso'],
      'ちゃ':['tya', 'cha'], 'ちぃ':['tyi'], 'ちゅ':['tyu', 'chu'], 'ちぇ':['tye', 'che'], 'ちょ':['tyo', 'cho'],
      'てゃ':['tha'], 'てぃ':['thi'], 'てゅ':['thu'], 'てぇ':['the'], 'てょ':['tho'],
      'とぁ':['twa'], 'とぃ':['twi'], 'とぅ':['twu'], 'とぇ':['twe'], 'とぉ':['two'],
      'ひゃ':['hya'], 'ひぃ':['hyi'], 'ひゅ':['hyu'], 'ひぇ':['hye'], 'ひょ':['hyo'],
      'ふぁ':['fa'], 'ふぃ':['fi'], 'ふぇ':['fe'], 'ふぉ':['fo'],
      'にゃ':['nya'], 'にぃ':['nyi'], 'にゅ':['nyu'], 'にぇ':['nye'], 'にょ':['nyo'],
      'みゃ':['mya'], 'みぃ':['myi'], 'みゅ':['myu'], 'みぇ':['mye'], 'みょ':['myo'],
      'りゃ':['rya'], 'りぃ':['ryi'], 'りゅ':['ryu'], 'りぇ':['rye'], 'りょ':['ryo'],
      'ヴぁ':['va'], 'ヴぃ':['vi'], 'ヴ':['vu'], 'ヴぇ':['ve'], 'ヴぉ':['vo'],
      'ぎゃ':['gya'], 'ぎぃ':['gyi'], 'ぎゅ':['gyu'], 'ぎぇ':['gye'], 'ぎょ':['gyo'],
      'ぐぁ':['gwa'], 'ぐぃ':['gwi'], 'ぐぅ':['gwu'], 'ぐぇ':['gwe'], 'ぐぉ':['gwo'],
      'じゃ':['ja', 'zya'], 'じぃ':['jyi', 'zyi'], 'じゅ':['ju', 'zyu'], 'じぇ':['je', 'zye'], 'じょ':['jo', 'zyo'],
      'でゃ':['dha'], 'でぃ':['dhi'], 'でゅ':['dhu'], 'でぇ':['dhe'], 'でょ':['dho'],
      'ぢゃ':['dya'], 'ぢぃ':['dyi'], 'ぢゅ':['dyu'], 'ぢぇ':['dye'], 'ぢょ':['dyo'],
      'びゃ':['bya'], 'びぃ':['byi'], 'びゅ':['byu'], 'びぇ':['bye'], 'びょ':['byo'],
      'ぴゃ':['pya'], 'ぴぃ':['pyi'], 'ぴゅ':['pyu'], 'ぴぇ':['pye'], 'ぴょ':['pyo'],
      'ぁ':['la', 'xa'], 'ぃ':['li', 'xi'], 'ぅ':['lu', 'xu'], 'ぇ':['le', 'xe'], 'ぉ':['lo', 'xo'],
      'ゃ':['lya', 'xya'], 'ゅ':['lyu', 'xyu'], 'ょ':['lyo', 'xyo'], 
      'っ':['ltu', 'xtu'],
      'ー':['-'], ',':[','], '.':['.'], '、':[','], '。':['.'],
      '・':['/'], '&#12289;':[','], '&#12290;':['.'], '&#12539;':['/']
    };
    
    const E_words = [
      'A','B','C','D','E','F','G','H','I','J','K','L','M','N',
      'O','P','Q','R','S','T','U','V','W','X','Y','Z'];

      let output = document.getElementById('output');
      let text = document.getElementById('text');
    let greeting = [];
    let voice = [];
    let keys = Object.keys(romanMap);
    let vals = Object.values(romanMap);
    let output_array = [];
    const get = document.querySelectorAll('span');
  let quiz = document.getElementById('quiz');
    let kanaArray = Object.keys(romanMap);
    let kanaRoma = Object.values(romanMap);

       let children_text = document.querySelectorAll('#tap');
       let virtual_keyboard = document.getElementById('virtual-keyboard');
      let header = document.getElementById('header');
      const timer = document.getElementById('time');
      let startTime;
      let originTime = 10;
      let countCorrect = 0;
      let keyboard = document.querySelector('.keyboard');
     let countMiss = 0;
     let count = 0;
     let conta = document.getElementById('container');

     
     let q;
     for (let i = 0; i < obj.length; i++) {
       q = Object.values(obj[i]);
       greeting.push(q[2]);
       voice.push(q[3]);
      //  console.log(q[2]);
      //  console.log(q[3]);
     };

      //  let djoin = d.join("");
      //  console.log(djoin);
      //ただの変数宣言ではなく、空の文字列を用意しておくことで
      //文字列を結合していくときに、最初にundefinedが入らない
     
  document.addEventListener('keydown', logKey);
  let d;
     
    function split(){
     
      while(output.firstChild){
       output.removeChild(output.firstChild);
      }

      while(text.firstChild){
      text.removeChild(text.firstChild);
      }

      let random = Math.floor(Math.random() * voice.length);
      let sp = voice.splice(random,1)[0];
      console.log(sp);
      let spg = greeting.splice(random,1)[0];
      quiz.innerText = spg;
      //Q
      quiz.insertAdjacentHTML('afterbegin','<span>Q:</span>');

     let word = sp.split("");
    //  console.log(word);
     let chokin = "";
     for(let i=0;i<word.length;i++){
      let create = document.createElement('span');
       create.innerText = word[i];
       text.appendChild(create);
       //A
      }
      text.insertAdjacentHTML('afterbegin','<span>A:</span>');

       let cho_split;
       word.forEach((one)=>{
        chokin += romanMap[one][0];
        cho_split = chokin.split("");
        // console.log(cho_split);
    })

    for(let i=0;i<cho_split.length;i++){
      let write = document.createElement('span');
      write.innerText = cho_split[i].toUpperCase();
      output_array.push(cho_split[i]);
      output.appendChild(write);}

      d = document.querySelectorAll('#output span');
      d = Array.from(d);
      StartTimer();
       }
    split();

   
   
   

    let d_text ="";
    // console.log(d_text);
    let d_split;    
    let num = 0;

        function dloop(){
            for(let i=0;i<d.length;i++){
              d_text += d[i].textContent;                
              if(i === d.length-1){
               d_split = d_text.split("");
              //  console.log(d_text);
                console.log(d_split);
              // console.log(d_split.length);
              count += d_split.length;
              }
           }
           orange();
          }
            dloop();

  //下線をつけるよ
  function underLine(){
    if(d[num-1]){
      if(d[num-1].classList.contains('underLine')){
        // console.log(d[num-1]);
       d[num-1].classList.remove('underLine');
     }
    }
    if(d[num]){
      // console.log(d[num]);
      d[num].classList.add('underLine');
    }
  }
  underLine();
         
     function logKey(e) {
//  console.log('2回目');
         
         let gg = e.key.toUpperCase();
          //  console.log(gg);
          // console.log(d_split);
        
          if(d_split[0] !== gg){
            //間違えた時に一瞬だけ光って色をheader部分に入れる方にする
            header.classList.add('highlight');
            // console.log('miss');
            countMiss++;

            setTimeout(() => {
              header.classList.remove('highlight');
            }, 50);
          }
        if(d_split[0] === gg){
          //  console.log(d_split[0]);
          
          d[num].style.color = 'orange';
          num++;
           d_split.splice(0,1);

          console.log(d_split);
          if(d_split.length === 0){
           if(voice.length === 0){
           // 渡したいデータ
           let score = document.querySelector('[name="score"]');
           let miss = document.querySelector('[name="miss"]');
           let rate = document.querySelector('[name="rate"]');
           let level = document.querySelector('[name="level"]');
           
           let thr = document.getElementById('thr');
           
           score.value = count-countMiss;
           miss.value = countMiss;

            rate.value = Math.floor((count-countMiss)/count*100);
          
            if(rate.value === 100){
              level.value = 'SS';
            }else if(rate.value>=90){
             level.value='S';
            }else if(rate.value>=80){
                level.value='A';
            }else if(rate.value>=70){
             level.value = 'B';
             }else if(rate.value>=60){
                level.value='C';
            }else if(rate.value<60){
              level.value ='D';
            }
          thr.submit();
          thr.stopPropagation();
       }
      
              d_text = "";
              split();
              dloop();
              num = 0;
          }
          }
          orange();
          underLine();
     }


      function orange(){
        children_text.forEach((value) =>{
           if(value.classList.contains('keydown')){
             value.classList.remove('keydown');
           }
          // console.log(value.textContent);
          if(d_split[0] === value.textContent){
            // console.log('aa');
            value.classList.add('keydown');
          }
          
        })
        
      }
     

     


     //タイマー
    
     
     function StartTimer(){
         timer.innerText = originTime;
         startTime = new Date();
             setInterval(()=>{
                 timer.innerText = originTime - getTimerTime();
                 if(timer.innerText <= 0){
                  timer.innerHTML = 0;
                  if(voice.length === 0){
                         // 渡したいデータ
                         let score = document.querySelector('[name="score"]');
                         let miss = document.querySelector('[name="miss"]');
                         let rate = document.querySelector('[name="rate"]');
                         let level = document.querySelector('[name="level"]');
                         
                         let thr = document.getElementById('thr');

                         if(d_split.length>0){
                          countMiss += d_split.length;
                          console.log(countMiss);
                        }

                        if(countMiss > count){
                          countMiss = count;
                          console.log(countMiss);
                        }
                         
                         score.value = count-countMiss;
                         miss.value = countMiss;
              
                          rate.value = Math.floor((count-countMiss)/count*100);
                        
                          if(rate.value === 100){
                            level.value = 'SS';
                          }else if(rate.value>=90){
                           level.value='S';
                          }else if(rate.value>=80){
                              level.value='A';
                          }else if(rate.value>=70){
                           level.value = 'B';
                           }else if(rate.value>=60){
                              level.value='C';
                          }else if(rate.value<60){
                            level.value ='D';
                          }
                           thr.submit();
                           thr.stopPropagation();

                     }
                     if(d_split.length>=0){
                      countMiss += d_split.length;
                      console.log(countMiss);
                    }
            d_text = "";
            split();
            dloop();
            num = 0;
            underLine();
           } 
             },1000)
     
     }
     
     function getTimerTime(){
         return  Math.floor(( new Date() - startTime) / 1000);
     }
     

   
      console.log(obj);

       







   
  










   
   


   