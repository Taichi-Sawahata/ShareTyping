
<?php 
session_start();

if(!empty($_SESSION['user_id'])){
    try{
        $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
       $stmt = $db->prepare('SELECT * FROM score
        WHERE user_id = :user_id');
        $stmt->bindValue(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
        $stmt->execute();
       $row = $stmt->fetch();
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
</head>

<body>


<div class="container">
<div class="strap">
    <div id="total">
            <p id="kekka"><span class="first">スコア:</span>
        <span>
            <?php
          if(!empty($_SESSION['user_id'])){  echo $row['score'];}else{ echo $_SESSION['score'];} ?></span>点
        </p>
        <p id="kekka">
            <span class="first">ミスの数:</span><span><?php if(!empty($_SESSION['user_id'])){ echo $row['miss'];}else{ echo $_SESSION['miss'];}?></span><span class="nagai">回</span></p>
            <p id="kekka"> <span class="first">  正答率:</span><span><?php if(!empty($_SESSION['user_id'])){ echo $row['rate'];}else{ echo $_SESSION['rate'];}?></span>%</p>
        <p id="kekka">
            あなたのレベルは<span class="red"><?php if(!empty($_SESSION['user_id'])){ echo $row['level'];}else{ echo $_SESSION['level'];}?></span>です</p>
    
            <div class="btnss">
                <div class="btns">
                    <a href="spaceKey.php">再挑戦</a>
                </div>
                <div class="btns">
                <a href="../../topPage/php/logTop.php">トップページへ</a>
                </div>
                    </div>
            </div>
</div>
       </div>
       <div class="low">
       <?php if(!empty($_SESSION['user_name'])){
    require('../../topPage/php/logTop.php');
}else{
    require('../../topPage/php/notLogTop.php');
} ?>
</div>

    <form action="" method="post" id="thr">
        <input type="hidden" name="score">
        <input type="hidden" name="miss">
        <input type="hidden" name="rate">
        <input type="hidden" name="level">
    </form>
        </form>
   

    <script src="../js/close.js"></script>
<script src="../../topPage/js/play.js"></script>
<script src="../../topPage/js/login.js"></script>


</body>
</html>