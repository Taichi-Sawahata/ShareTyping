<?php
session_start();
if(isset($_POST["user_mail"]) && isset($_POST['user_pw'])){


      try{
    
          $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');

    $stmt= $db->prepare("SELECT * FROM user 
    WHERE user_mail = :user_mail AND user_pw = :user_pw
   ");
 
   $stmt->bindValue(":user_mail",$_POST["user_mail"],PDO::PARAM_STR);
   $stmt->bindValue(":user_pw",$_POST["user_pw"],PDO::PARAM_STR);
   $stmt->execute();
    if($row = $stmt->fetch()){
   if($row['user_mail'] === $_POST["user_mail"] && $row['user_pw'] === $_POST["user_pw"] ){
   $_SESSION['user_id'] = $row['user_id'];
   $_SESSION['user_name'] = $row['user_name'];
    header("Location: ../../topPage/php/logTop.php");
}
}else{
    $error = '<span class="out">※メールアドレスもしくはパスワードが間違っています。</span>';
    }

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
    <title>ログインページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
<header><?php  require('../../hamburger/notLogHamburger.php') ?></header>

    <div class="wrapper">

    <h3 class="lesson"><span class="sankaku"></span>ログイン</h3>
        <div class="container">
        <?php if(isset($error)) {echo $error;}; ?>

            <form action="" method="post">
                <div><div class="start"><span class="btn">必須</span><span class="font2">メールアドレス</span></div>
                <div><input type="text" name="user_mail" id="input" autocomplete="off"></div></div>
                <div><div class="start"><span class="btn">必須</span><span class="font2">パスワード</span></div>
                <div class="eye"><input type="password" name="user_pw" id="pass1" class="pw1" autocomplete="off"><span id="buttonEye1" class="fa fa-eye-slash"></span></div></div>
                <input type="submit" value="ログイン">
            </form>
            <!-- -slashをつけると目に車線をつけられる -->
        </div>
    </div>

    <div class="footer">Copyright &copy; ShareTyping</div>
  <script src="../js/notSummary.js"></script>
  <script src="../js/eye.js"></script>
</body>
</html>