<?php
session_start();




if(isset($_POST["user_mail"]) && isset($_POST['user_pw'])){
    if(isset($_POST["csrf_token"]) && 
    $_POST["csrf_token"] === $_SESSION['csrf_token']){

        
 $user_mail = htmlspecialchars($_POST["user_mail"], ENT_QUOTES, "UTF-8");
 $user_pw = htmlspecialchars($_POST['user_pw'], ENT_QUOTES, "UTF-8");
 

      try{
    
          $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');

    $stmt= $db->prepare("SELECT * FROM user 
    WHERE user_mail = :user_mail");
   $stmt->bindValue(":user_mail",$user_mail,PDO::PARAM_STR);
   $stmt->execute();
    if($row = $stmt->fetch()){   
   if($row['user_mail'] === $_POST["user_mail"]){
    if(password_verify($user_pw, $row['user_pw']))
   $_SESSION['user_id'] = $row['user_id'];
   $_SESSION['user_name'] = $row['user_name'];
    header("Location: ../../topPage/php/logTop.php");
}
}else{
    $error = '<span class="out">※メールアドレスもしくはパスワードが間違っています</span>';
    }

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
    <title>ログインページ</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
    <style>
    body {
        overflow: hidden;
        background: rgb(220, 219, 219);
        z-index: 1;
    }

    .forget {
        margin-top: 20px;
        font-size: 14px;
    }


    .containers {
        margin: 100px auto 0;
        width: 40%;
        border: 1px solid transparent;
        padding-bottom: 20px;
        background: #fff;
        z-index: 10;
        border-radius: 5px;

    }

    .out {
        color: #FF0000;
    }
    </style>
</head>

<body>
    <header><?php  require('../../hamburger/notLogHamburger.php') ?></header>

    <div class="wrapper">
        <div class="containers">

            <h3 class="lesson"><span class="sankaku"></span>ログイン</h3>
            <div class="container">
                <?php if(isset($error)) {echo $error;};
            //  echo $pw_hash;
            // echo var_dump($row);}; ?>

                <?php
            //   if(isset($_SESSION['success'])){
            //     echo '<p>'.$_SESSION['success'].'</p>';
            //   }
            ?>


                <form action="" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                    <div>
                        <div class="start"><span class="hissu">※</span><span class="font2">メールアドレス</span></div>
                        <div><input type="text" name="user_mail" id="input" required></div>
                    </div>
                    <div>
                        <div class="start"><span class="hissu">※</span><span class="font2">パスワード</span></div>
                        <div class="eye"><input type="password" name="user_pw" id="pass1" class="pw1" autocomplete="off"
                                required><span id="buttonEye1" class="fa fa-eye-slash"></span></div>
                    </div>
                    <input type="submit" value="ログイン">
                </form>
                <!-- -slashをつけると目に車線をつけられる -->

            </div>
            <div class="forget"><a href="forgetPass.php">パスワードをお忘れの場合</a></div>
        </div>
    </div>


    <script src="../js/notSummary.js"></script>
    <script src="../js/eye.js"></script>
</body>

</html>