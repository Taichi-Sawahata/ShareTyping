<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){



   try{
      $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      $stmt = $db->prepare('INSERT INTO quiz(user_name,title,category,q_num,datepost,content)
       VALUES(:user_name,:title,:category,:q_num,CURRENT_DATE(),:content)');
       $stmt->bindValue(':user_name',$_SESSION['user_name'],PDO::PARAM_STR);
       $stmt->bindValue(':title',$_POST['title'],PDO::PARAM_STR);
       $stmt->bindValue(':category',$_POST['category'],PDO::PARAM_STR);
       $stmt->bindValue(':q_num',$_POST['num'],PDO::PARAM_INT);
       $stmt->bindValue(':content',$_POST['content'],PDO::PARAM_STR);
      $stmt->execute();
     $stmt = $db->prepare('SELECT * FROM quiz WHERE user_name = :user_name 
     AND title = :title');
           $stmt->bindValue(':user_name',$_SESSION['user_name'],PDO::PARAM_STR);
           $stmt->bindValue(':title',$_POST['title'],PDO::PARAM_STR);
           $stmt->execute();
           if($row = $stmt->fetch()){
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['title'] = $row['title'];
            $_SESSION['content'] = $row['content'];
           }

   }catch(PDOException $e){
      $e->getMessage();
   }

   try{
    $db = new PDO('mysql:host=localhost;dbname=wp459266_quiz;charset=utf8','wp459266_wp1','gumi7070');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
   $stmt = $db->prepare ('CREATE TABLE '.$_POST['title'].'  (
      question VARCHAR(20),
      answer  VARCHAR(20)
   )engine=innodb default charset=utf8');
  $stmt->execute();
  for($i=0;$i<=$_POST['num']-1;$i++){
  $stmt = $db->prepare('INSERT INTO '.$_POST['title'].'(question,answer) 
  VALUES(:question,:answer)');
  $stmt->bindValue(':question',$_POST['question'."$i"],PDO::PARAM_STR);
  $stmt->bindValue(':answer',$_POST['answer'."$i"],PDO::PARAM_STR);
  $stmt->execute(); 
}

 header('Location:../../keyboard/php/spaceKey.php');


 }catch(PDOException $e){
    $e->getMessage();
 }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareTyping</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">

    <style>
    body{
        position:relative;
      }
    .footer{
        position:absolute;
        bottom:0;
        left:50%;
        transform: translateX(-50%);
      }
      select {
  -moz-appearance: menulist;
  -webkit-appearance: menulist;
}

    .header,h3{
        background-repeat:repeat;
        box-sizing: unset;
    }

      </style>
</head>
<body>
<header><?php require('../../hamburger/logHamburger.php') ?></header>
<div class="wrapper">
    <h3 class="lesson"><span class="sankaku"></span>ゲームを作成</h3>
        <div class="container">
        <p class="caution">
                ※答えはひらがなで入力してください<br>
                ※答えは空白やスペースは受け付けません<br>
                ※コンテンツ内容は30文字以内、<br>その他は20文字以内で入力してください
            
            </p>
            <form action="" method="post" id="submit">
                <div><div class="start"><span class="btn">必須</span><span class="font2">タイトル</span></div>
                <div class="insert">
                <input type="text" class="count" name="title" id="input" autocomplete="off"></div></div>
                <div><div class="start"><span class="btn">必須</span><span class="font2">カテゴリ</span></div>
                <div class="insert"><input type="text" class="count" value="#" name="category" id="input"  autocomplete="off"></div></div>
                <div><div class="start"><span class="btn">必須</span><span class="font2">コンテンツ内容</span></div>
                <div><textarea name="content" id="textarea" rows="2" ></textarea></div></div>
                <div class="sakusei">
                    <div class="sakusei1">
                        問題を<input type="number" name="num" value="num" id="num" min="1">
                                問<span id="numbers"><a href="#" id="quiz">作成</a></span>
                    </div>

                      
                </div>
                
                <div class="dec">
                    <div id="decrease">
                                    1問削除
                                </div>
                                <div id="allDecrease">全問削除</div>
                </div>
   


        <div class="increase" id="increase">
   
        </div>
        <input type="submit"  value="ゲームを作成" id="mit">
            </form>
        </div>
    </div>
  
     <!-- 選択した作成数、問題をHTML表示 -->
     <!-- データベースに入れて、タイピング覧に表示されるまでを目標に -->
    </form>
</div>
</div>
<div class="footer" id="footer" style="margin-bottom:0">Copyright &copy; ShareTyping</div>
    <script src="../js/script.js"></script>
    <script src="../../topPage/js/login.js"></script>

</body>
</html>


