<?php 
session_start();

$num;
$row;
$json = array();
$content = array();
$people = array();
$datepost = array();
try{
    $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
    $stmt = $db->prepare('SELECT count(*) FROM quiz');
   $stmt->execute();
   $num = $stmt->fetchColumn();

   $stmt = $db->prepare('SELECT * FROM quiz');
   $stmt->execute();
   $row = $stmt->fetchAll();
  for($i=0;$i<=$num-1;$i++){
array_push($json,$row[$i]['title']);
array_push($content,$row[$i]['content']);
array_push($people,$row[$i]['user_name']);
array_push($datepost,$row[$i]['datepost']);
 }

  $rows = json_encode($json);
  $contents = json_encode($content);
  $peoples = json_encode($people);
  $dateposts = json_encode($datepost);
   
}catch(PDOException $e){
    $e->getMessage();
}

  
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $_SESSION['title'] = $_POST['game'];
   header('Location:sharetyping/keyboard/php/spaceKey.php');
 }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>  
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sharetyping/topPage/css/entire.css">
    <link rel="stylesheet" href="sharetyping/topPage/css/Top.css">
</head>
<body>
<header><?php  require('sharetyping/hamburger/indexHamburger.php') ?></header>

        <div class="wrapper">
        <h3><span class="sankaku"></span>
          楽しくタイピングができる「シェアタイピング」</h3>
                <div class="back">
                  <div class="image">
                    <div class="kakomi">
                    <div class="mainText">
                        <h4>クイズ形式で練習できる</h4>
                        <h1>タイピングゲーム</h1>
                        <p>自分が勉強したいテーマを作成でき、問題形式のタイピングで遊べる</p>
                    </div>
                        <div class="mainBtn">
                    <div class="btn login">
                        <a href="sharetyping/userInformation/php/login.php">
                        ゲームを作成</a></div>
                    <p class="text">※レッスンPC専用です。
                    </p>                    
                    </div></div>
                  <div class="inner">
                  <h4>ShareTypingの道を進もう<br>
                    タイピング0から最短距離を歩んで
                      マスターしよう
                  </h4>
                  <img src="sharetyping/img/key.png" alt="" id="key">
                  </div>
                  <h3 class="secondh3"><span class="sankaku"></span>シェアタイピング一覧</h3>
                  
                          </div>
                          </div>
</div>

<div class="card-list" id="card-list">
                          </div>
    <div class="footer">Copyright &copy; ShareTyping</div>

      <script>
         const json = JSON.parse('<?php echo $rows ?>');
        const content = JSON.parse('<?php echo $contents ?>');
         const people = JSON.parse('<?php echo $peoples ?>');
         const datepost = JSON.parse('<?php echo $dateposts ?>');
      </script>
 <script src="sharetyping/userInformation/js/notIndexSummary.js"></script>
<script src="sharetyping/topPage/js/indexPlay.js"></script>

</body>
</html>