<?php
session_start();

$rows;
$img;
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //ファイル関連の取得
 $file = $_FILES['img'];
 //ディレクトリトラバーサル
 $filename = basename($file['name']);
 $tmp_path = $file['tmp_name'];
 $file_err = $file['error'];
 $filesize = $file['size'];
 $upload_dir = '../../image/';
 $upload_dir_index = 'sharetyping/image/';
 $save_filename = date('YmdHis') . $filename;
 $err_msgs = array();


//  var_dump($file);
 //ファイルサイズが1MB以下か
 if($filesize > 1048576 || $file_err === 2){
    echo 'ファイルサイズは1MB未満にしてください.<br>';
 }

 //拡張子は画像形式か
$allow_ext = array('jpg','jpeg','png');

$file_ext = pathinfo($filename,PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)){
    array_push($err_msgs,'画像ファイルを添付してください.<br>');
}

//ファイルはあるかどうか
if(count($err_msgs) === 0){


if(is_uploaded_file($tmp_path)){
    if(move_uploaded_file($tmp_path,$upload_dir.$save_filename)){
        echo $filename . 'を'. $upload_dir .'アップしました';
    }else{
        echo 'ファイルが保存できませんでした';
    }
}else{
    echo 'ファイルが選択されてません.<br>';
}

}else{
   
        echo $err_msgs.'<br>';
}


    if(isset($_POST["csrf_token"]) && 
    $_POST["csrf_token"] === $_SESSION['csrf_token']){
   try{
      $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);


      $stmt= $db->prepare('SELECT title FROM quiz');
      $stmt->execute();
      $quizs = $stmt->fetchAll();
      foreach($quizs as $quiz){
         if($_POST['title'] === $quiz['title']){
             $twice = '<p class="twice">※このゲーム名は存在しています<br>
             もう一度ゲームを作成してください</p>';
             $_SESSION['twice'] = $twice;
             header('Location:quizCreate.php');
             exit();
           }
      }

      
      $stmt = $db->prepare('INSERT INTO images(file_name,file_path,file_path_index)
      VALUES(:file_name,:file_path,:file_path_index) ');
             $stmt->bindValue(':file_name', $save_filename,PDO::PARAM_STR);
             $stmt->bindValue(':file_path',$upload_dir,PDO::PARAM_STR);
             $stmt->bindValue(':file_path_index',$upload_dir_index,PDO::PARAM_STR);
             $stmt->execute();
    
            //  $stmt= $db->prepare('SELECT title FROM quiz');
            //  $stmt->execute();
            //  $quizs = $stmt->fetchAll();
            //  foreach($quizs as $quiz){
            //     if($_POST['title'] === $quiz['title']){
            //         $twice = '<p class="twice">※このゲーム名は存在しています</p>';
            //       }
            //  }
             
            
       
     $stmt = $db->prepare('INSERT INTO quiz(user_name,title,category,q_num,datepost,content,image)
       VALUES(:user_name,:title,:category,:q_num,CURRENT_DATE(),:content,:image)');
       $stmt->bindValue(':user_name',$_SESSION['user_name'],PDO::PARAM_STR);
       $stmt->bindValue(':title',$_POST['title'],PDO::PARAM_STR);
       $stmt->bindValue(':category',$_POST['category'],PDO::PARAM_STR);
       $stmt->bindValue(':q_num',$_POST['num'],PDO::PARAM_INT);
       $stmt->bindValue(':content',$_POST['content'],PDO::PARAM_STR);
       $stmt->bindValue(':image',$img['images_id'],PDO::PARAM_STR);
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
  $stmt->execute();  }

  header('Location:../../keyboard/php/spaceKey.php');


 }catch(PDOException $e){
    $e->getMessage();
 }
}
}



$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
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

    <style>
    body{
        background: rgb(220, 219, 219);
        z-index: 1;
      }
      select {
  -moz-appearance: menulist;
  -webkit-appearance: menulist;
}

    .header,h3{
        background-repeat:repeat;
        box-sizing: unset;
    }

.start{
    margin-top: 10px;
}

.Df{
    display: flex;
  justify-content:center;
  text-align: center;
}
#mit{
    margin-top:30px;
}



.s{
    margin: 0 auto;
}

.makeImage{
    margin-top: 50px;
}

#allDecrease{
    padding-left: 30px;
}



.All{
    /* border:2px solid #dbdbdb; */
    width: 90%;
    margin: 20px auto 0;
    border-radius:7px;
    padding-top: 20px ;
}

.title,.category,.content,.makeImage{
    width: 100%;
}


.title{
    padding-left: 30px;
}

.hissu{
    padding-left:50px;
}



.mainTopic{
    display: flex;
    margin: 5px auto 0;
    width: 60%;
    justify-content:space-between;
}

.lesson{
    margin-right: 0;
    margin-left: 0;
    width: 100%;
}

.containers{
    margin:100px auto 0;
    width: 70%;
    border:1px solid transparent;
    padding-bottom: 20px;
    background: #fff;
    z-index: 10;
    border-radius:5px;
}
.contents2{
    margin-right: 0;
}

.wrapper{
    height: 800px;
}

#decrease,#allDecrease{
    color:#3333cc;
    font-weight:bold;
}

.delete{
    text-align: center;
    margin: 30px auto 0;
    width: 100%;
}

.delete:last-child{
    margin-bottom: 30px;
}

.increase{
margin: 0 auto;
}


.lesson{
    margin-top: 50px;
}

.cau{
    font-weight:bold
    color:#3333cc;
}

.twice{
    color:#ff0000;
}

      </style>
</head>
<body>
<header><?php require('../../hamburger/logHamburger.php') ?></header>
<div class="wrapper">
   
    <div class="containers">
        <div class="mainTopic">
            <h3 class="lesson"><span class="sankaku"></span>ゲームを作成</h3>
                <p class="caution">
                        <span class="caus">※答えはひらがなで入力してください</span><br>
                        <span class="caus">※答えは空白やスペースは受け付けません</span><br>
                        <span class="caus">※コンテンツ内容は30文字以内、</span><br><span class="caus">その他は20文字以内で入力してください</span>
        
                    </p>
        </div>
                <!-- <?php if(isset($img)){  ?>
                <img src="<?php echo $img['file_path'].$img['file_name'] ;?>" alt="">
                <?php print_r($img); ?>
            <?php } ;?> -->
          <?php if(isset($_SESSION['twice'])){
              echo $_SESSION['twice'];
          };?>
            <div class="All">

                <form action="" method="post" id="submit" enctype="multipart/form-data" >
                <input type="hidden" name="csrf_token" value="<?php echo$csrf_token?>">
                    <div class="Df">
                        <div class="title"><div class="start"><span class="hissu">※</span><span class="font2">タイトル</span></div>
                        <div class="insert">
                        <input type="text" class="count" name="title" id="input" autocomplete="off"></div></div>
                        <div class="category"><div class="start"><span class="hissu hissuCate">※</span><span class="font2">カテゴリ</span></div>
                        <div class="insert"><input type="text" class="count" value="#" name="category" id="input"  autocomplete="off"></div></div>
                    </div>
                    <div class="Df">
                        <div class="content"><div class="start"><span class="hissu">※</span><span class="font2 contents2">コンテンツ内容</span></div>
                        <div><textarea name="content" id="textarea" rows="2" ></textarea></div></div>
                        <div class="makeImage"><span>画像を選択</span><input type="file" name="img" accept="image/* required>
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                                    </div>
                
        
              
                </div>
    
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
    </div>
     <!-- 選択した作成数、問題をHTML表示 -->
     <!-- データベースに入れて、タイピング覧に表示されるまでを目標に -->
    <script src="../js/script.js"></script>
    <script src="../../topPage/js/login.js"></script>

</body>
</html>


