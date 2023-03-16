<?php
session_start();
//クロスサイトリクエストフォージェリ
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
//クリックジャッキング対策
header("X-FRAME-OPTIONS: SAMEORIGIN");

//成功・エラーメッセージの初期化
$errors = array();


//DB接続
$db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

if(empty($_GET)){
    header("Location: registration_mail");
    exit();
}else{
    
    //GETデータを変数に入れる
    $urltoken = isset($_GET['urltoken']) ? $_GET["urltoken"] : NULL;
    //メール入力判定
    if($urltoken === ''){
        $errors['urltoken'] = "トークンがありません";
    }else{
        try{
    //DB接続
    //flagが0の未登録者 or 仮登録日から24時間以内
    $sql = "SELECT mail FROM pre_user WHERE urltoken=(:urltoken) 
    AND flag =0 AND date > now() - interval 24 hour";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':urltoken',$urltoken,PDO::PARAM_STR);
    $stmt->execute();

    //レコード件数取得
    $row_count = $stmt->rowCount();

    //24時間以内に仮登録され、本登録されていないトークンの場合
    if($row_count === 1){
        $mail_array = $stmt->fetch();
        $mail = $mail_array['mail'];
        // $_SESSION['mail'] = $mail;
    }else{
        $errors['urltoken_timeover'] = "このURLはご利用できません。有効期限が過ぎたかURLが間違えている可能性がございます。もう一度やりなおしてください";
    }
      //データベースの接続切断
      $stmt = null;
        }catch(PDOException $e){
            print('Error:' .$e->getMessage());
            die();
        }
    }

    if(isset($_POST['user_name'])){
try{

   //pre_userのflagを1にする(トークンの無効化)
   $sql = "UPDATE pre_user SET flag=1 WHERE mail=:mail";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':mail',$_SESSION['mail'],PDO::PARAM_STR);
   $stmt->execute();

    $stmt = $db->prepare("SELECT user_name,user_mail FROM user");
    $stmt->execute();

 if($rows = $stmt->fetchAll()){
    $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES, "UTF-8");
    $user_pw = htmlspecialchars($_POST['user_pw'], ENT_QUOTES, "UTF-8");
    $check = htmlspecialchars($_POST['check'], ENT_QUOTES, "UTF-8");

  foreach($rows as $row) {


    if($row['user_name'] === $_POST['user_name']){
        $user_error = '<span class="out"><br>※ユーザー名は既に使用されています</span>';
      $user_name = '';
     }
    //   if($row['user_mail'] === $_POST['user_mail']){
    //      $mail_error = '<span class="out"><br>※メールアドレスは既に使用されています</span>';
    //       $user_mail = '';
    //   }

    //   if( $_SESSION['mail'] === $_POST['user__mail']){
    //        $mail_error = '<span class="out"><br>※メールアドレスは既に使用されています</span>';
    //       $user_mail = '';
    //   }

    //   if($_SESSION['mail'] === $_POST['user__mail']){
    //     $mail_error = '<span class="out"><br>※仮登録されたメールアドレスをご使用ください</span>';
    //     $user_mail = '';
    //   }

  }
  
 }


 


 if(empty($user_error)){
    $pw_hash = password_hash($user_pw, PASSWORD_DEFAULT);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $stmt = $db->prepare("INSERT INTO user 
     (user_name,user_mail,user_pw)
      VALUES(:user_name,:user_mail,:user_pw)");
   
 $stmt->bindValue(':user_name',$user_name,PDO::PARAM_STR);
 $stmt->bindValue(':user_mail',$_SESSION['mail'],PDO::PARAM_STR);
 $stmt->bindValue(':user_pw',$pw_hash,PDO::PARAM_STR);
 $stmt->execute();
 
 /*
		 登録ユーザと管理者へ仮登録されたメール送信
       */
      $urltoken = hash('sha256',uniqid(rand(),1));
      //ここどうするか後で検討する
$url = "https://amateur-step.com/sharetyping/userInformation/php/login.php?urltoken=".$urltoken;

       $mailTo = $_SESSION['mail'];
       $body = <<< EOM
       この度はご登録いただきありがとうございます。
	   本登録を完了致しました。

       引き続きシェアタイピングをお楽しみください!
       {$url}
EOM;
       mb_language('ja');
       mb_internal_encoding('UTF-8');
       $subject = '会員登録のお願い';
       $companymail = 'sharetyping.info@gmail.com';
       //Fromヘッダーを作成
       $header = 'From: ' . mb_encode_mimeheader('シェアタイピング'). ' <' . $companymail. '>';
   
       if(mb_send_mail($mailTo, $subject, $body, $header)){          
           $message['success'] = "会員登録しました";
       }else{
           $errors['mail_error'] = "メールの送信に失敗しました。";
		}	

    //$_SESSION['success'] = '本登録が完了しました。ログインをお願いします。';
  header('Location:login.php');
 }
 	// //データベース接続切断
    //  $stm = null;

    //  //セッション変数を全て解除
    //  $_SESSION = array();
    //  //セッションクッキーの削除
    //  if (isset($_COOKIE["PHPSESSID"])) {
    //          setcookie("PHPSESSID", '', time() - 1800, '/');
    //  }
    //  //セッションを破棄する
    //  session_destroy();


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
    <title>アカウント作成</title>
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    body {
        background: rgb(220, 219, 219);
        z-index: 1;
        overflow: hidden;
    }

    .containers {
        margin: 60px auto 0;
        width: 40%;
        border: 1px solid transparent;
        padding-bottom: 20px;
        background: #fff;
        z-index: 10;
        border-radius: 5px;
    }

    .user {
        color: #363636;
        margin-left: 0;
    }

    .comfirming{
        margin-right: 0;

    }
    </style>
</head>

<body>
    <header><?php  require('../../hamburger/notLogHamburger.php') ?></header>
    <div class="wrapper">

        <div class="containers">
            <h3 class="lesson"><span class="sankaku"></span>アカウント作成</h3>
            <p class="attention">※ゲームを作成するには、ユーザー登録が必須必要になります。</p>
            <div class="container">
                <form action="" method="post" id="submit">
                    <input type="hidden" name="csrf_token" value="<?php  echo $csrf_token?>">
                    <div>
                        <div class="start"><span class="hissu">※</span><span
                                class="font2 user">ユーザー名</span><?php if(isset($user_error)){echo $user_error;}; ?></div>
                        <div><input type="text" name="user_name" id="user_name" autocomplete="off"
                                value="<?php if(isset($user_name)){echo $user_name;};?>" required></div>
                    </div>
                    <div>
                        <div class="start"><span class="hissu">※</span><span class="font2 texlen">パスワード</span></div>
                        <div class="eye"><input type="password" name="user_pw" id="pass1" class="pw1" autocomplete="off"
                                value="<?php if(isset($pw)){echo $pw;};?>" required><span id="buttonEye1"
                                class="fa fa-eye-slash"></span></div>
                    </div>
                    <div>
                        <div class="start"><span class="hissu">※</span><span class="font2 comfirming">パスワード確認用</span>
                        </div>
                        <div class="eye"><input type="password" name="check" id="pass2" class="pw2" autocomplete="off"
                                value="<?php if(isset($check)){echo $check;};?>" required><span id="buttonEye2"
                                class="fa fa-eye-slash"></span></div>
                    </div>
                    <input type="submit" value="登録">
                </form>
            </div>
        </div>
    </div>
    <script src="../js/notSummary.js"></script>
    <script src="../js/userValidation.js"></script>
    <script src="../js/eye.js"></script>

</body>

</html>