<?php
session_start();

if(isset($_POST["user_name"]) && isset($_POST["user_mail"]) && isset($_POST["user_pw"]) && isset($_POST["check"])){
    try{
        $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');


        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $stmt = $db->prepare("SELECT user_name,user_mail FROM user");
        $stmt->execute();

     if($rows = $stmt->fetchAll()){
      foreach($rows as $row) {

        if($row['user_name'] === $_POST['user_name'] || $row['user_mail'] === $_POST['user_mail']){
            $user_name = $_POST["user_name"];
            $user_mail = $_POST["user_mail"];
            $pw = $_POST["user_pw"];
            $check = $_POST["check"];
        }

        if($row['user_name'] === $_POST['user_name']){
            $user_error = '<span class="out"><br>※ユーザー名は既に使用されています</span>';
          $user_name = '';
         }
          if($row['user_mail'] === $_POST['user_mail']){
             $mail_error = '<span class="out"><br>※メールアドレスは既に使用されています</span>';
              $user_mail = '';
          }
      }
     }


     if(empty($user_error) && empty($mail_error)){
         $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
         $stmt = $db->prepare("INSERT INTO user 
         (user_name,user_mail,user_pw)
          VALUES(:user_name,:user_mail,:user_pw)");
       
     $stmt->bindValue(':user_name',$_POST["user_name"],PDO::PARAM_STR);
     $stmt->bindValue(':user_mail',$_POST["user_mail"],PDO::PARAM_STR);
     $stmt->bindValue(':user_pw',$_POST["user_pw"],PDO::PARAM_STR);
     $stmt->execute();
     header('Location:login.php');
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
    <title>アカウント作成</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../../topPage/css/entire.css">
   <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body>
<header><?php  require('../../hamburger/notLogHamburger.php') ?></header>
    <div class="wrapper">
        <h3 class="lesson"><span class="sankaku"></span>アカウント作成</h3>
        <p class="attention">※ゲームを作成するには、ユーザー登録が必須必要になります。</p>
        <div class="container">
            <form action="" method="post" id="submit">
              
                    <div><div class="start"><span class="btn">必須</span><span class="font2 user">ユーザー名</span><?php if(isset($user_error)){echo $user_error;}; ?></div>
                    <div><input type="text" name="user_name" id="user_name" autocomplete="off" value="<?php if(isset($user_name)){echo $user_name;};?>"></div></div>
                
     
                    <div><div class="start"><span class="btn">必須</span><span class="font2 email">メールアドレス</span><?php if(isset($mail_error)){echo $mail_error;}; ?></div>
                    <div><input type="text" name="user_mail" id="email" autocomplete="off" value="<?php if(isset($user_mail)){echo $user_mail;};?>"></div></div>
                
                <div><div class="start"><span class="btn">必須</span><span class="font2 texlen">パスワード</span></div>
                <div class="eye"><input type="password" name="user_pw" id="pass1" class="pw1" autocomplete="off" value="<?php if(isset($pw)){echo $pw;};?>"><span id="buttonEye1" class="fa fa-eye-slash"></span></div></div>
                <div><div class="start"><span class="btn">必須</span><span class="font2 comfirming">パスワード確認用</span></div>
                <div class="eye"><input type="password" name="check" id="pass2" class="pw2" autocomplete="off" value="<?php if(isset($check)){echo $check;};?>"><span id="buttonEye2" class="fa fa-eye-slash"></span></div></div>
                <input type="submit" value="登録">
            </form>
        </div>
    </div>
    <div class="footer">Copyright &copy; ShareTyping</div>
  <script src="../js/notSummary.js"></script>
  <script src="../js/userValidation.js"></script>
  <script src="../js/eye.js"></script>

</body>
</html>