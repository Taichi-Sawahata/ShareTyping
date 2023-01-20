<?php 
 
 session_start();

        try{
            $db =new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
            $stmt = $db->prepare('SELECT * FROM quiz WHERE title = :title');
            $stmt->bindValue(':title',$_SESSION['title'],PDO::PARAM_STR);
            $stmt->execute();
           $row = $stmt->fetch();
        } catch(PDOException $e){
               $e->getMessage();
           }
    
    ?> 
 <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareTyping</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
     <h2><span class="naiyou"><?Php echo $row['title']?></span></h2> 
     <p>作成ユーザー:<span class="naiyou"><?php echo $row['user_name']?></span></p> 
     <p><span class="naiyou"><?php echo $row['content'] ?></span></p>
     <div class="start">
         <p>Game Start!</p>
             <p>スペースキーを押してください</p>
     </div>
 

</div>

<div class="low">
<?php if(!empty($_SESSION['user_name'])){
    require('../../topPage/php/logTop.php');
}else{
    require('../../topPage/php/notLogTop.php');
} 
    ?>
</div>
  
<script src="../js/close.js"></script>
<script src="../js/space.js"></script>
<script src="../../topPage/js/play.js"></script>
<script src="../../topPage/js/login.js"></script>

</body>
</html> 