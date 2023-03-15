<?php
session_start();
//クロスサイトリクエストフォージェリ対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
//DB接続
$db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$errors = array();
//送信ボタンをクリックしたときの処理
if(isset($_POST['submit'])){
    if(empty($_POST['mail'])){
        $errors['mail'] = 'メールアドレスが未入力です';
    }else{
        //POSTされたデータを変数に入れる
        $mail = isset($_POST['mail']) ? $_POST['mail'] :NULL;
        $_SESSION['mail'] = $mail;

        //メールアドレス構文チェック
        if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
            $errors['mail_check'] = "メールアドレスの形式が正しくありません";
        }
        $stmt = $db->prepare("SELECT user_id FROM user WHERE user_mail = :user_mail");
        $stmt->bindValue(':user_mail',$mail,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        //userテーブルに同じメールアドレスがある場合、エラー表示
        if(empty($result)){
            $errors['user_check'] = "このメールアドレスは存在しません";
        }
    }

    //エラーがない場合、pre_userテーブルにインサート
    if(count($errors) === 0){
        $urltoken = hash('sha256',uniqid(rand(),1));
        //ここどうするか後で検討する
 $url = "https://amateur-step.com/sharetyping/userInformation/php/changePass.php?urltoken=".$urltoken;

        // メール送信処理
        //登録されたメールアドレスへメールをお送りする
        //今回はメール送信しないためコメント


       $mailTo = $_POST['mail'];
         $body = <<< EOM
        リンクに入っていただき、
        パスワードの変更を行ってください。
         {$url}
     EOM;
        mb_language('ja');
        mb_internal_encoding('UTF-8');
       
    //    //FROMヘッダーを作成
       $companymail = 'sharetyping.info@gmail.com';
        $header = 'From:'. mb_encode_mimeheader('シェアタイピング'). '<'. $companymail . '>';
       $subject = 'パスワードの変更';
       
        if(mb_send_mail($mailTo,$subject,$body,$header)){
    //     //セッション変数をすべて解除
        // $_SESSION = array();
    //     //クッキーの削除
        //  if(isset($_COOKIE["PHPSESSID"])){
        //      setcookie("PHPSESSID",'',time()-1800,'/');
        //  }

    //     //セッションを破壊する
        //  session_destroy();
         $message = 'メールをお送りしました。24時間以内にメールに記載されたURLからパスワードをご変更ください。';
        
        // header('Location:changePass.php');
        }
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
    <style>

body{
    overflow:hidden;
 background: rgb(220, 219, 219);
 z-index: 1;
}


.mar{
    margin-top: 10px;
}

        .start{
            text-align: center;
        }

        .eroor{
            color:#3333cc;
        }

        /* .font2{
            padding-bottom: 10px;
        } */

        .containers{
    margin:100px auto 0;
    width: 40%;
    border:1px solid transparent;
    padding-bottom: 20px;
    background: #fff;
    z-index: 10;
    border-radius:5px;
}
    </style>
</head>

<body>
<header><?php  require('../../hamburger/notLogHamburger.php') ?></header>
    <div class="wrapper">
 <div class="containers">
         
         <h3 class="lesson"><span class="sankaku"></span>パスワードをお忘れの方へ</h3>
         <?php if(isset($_POST['submit']) && count($errors) === 0):?>
        <div class="start">
            <div><span class="hissu">//</span><span class="font2 email">メール送信完了画面</span></div>
        </div>
        <p><?=$message?></p>
        <?php else: ?>
         <!-- 登録画面 -->
         <?php if(count($errors) > 0): ?>
        <?php
        foreach($errors as $value){
          echo "<p class='eroor'>".$value."</p>";
        }
         ?>
         <?php endif; ?>
         <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post">
         <div>
        <div class="start">
        <span class="hissu">※</span><span class="font2 email">メールアドレスを入力</span>
        <div class="mar">
            <input type="text" name="mail" size="50"
                 value="<?php if(!empty($_POST['mail'])){ echo $_POST['mail'];}?>">
        </div>
        </div>
         </div>
     <input type="hidden" name="token" value="<?=$token?>">
     <input type="submit" name="submit" value="送信">
     </form>
     <?php endif;?>
 </div>

    </div>
  <script src="../js/notSummary.js"></script>
  <script src="../js/userValidation.js"></script>
  <script src="../js/eye.js"></script>

</body>
</html>