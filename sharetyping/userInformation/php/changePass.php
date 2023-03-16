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
// if(isset($_POST['submit'])){
//     if(empty($_POST['mail'])){
//         $errors['mail'] = 'メールアドレスが未入力です';
//     }else{
//         //POSTされたデータを変数に入れる
//         $mail = isset($_POST['mail']) ? $_POST['mail'] :NULL;
//         $_SESSION['mail'] = $mail;

//         //メールアドレス構文チェック
//         if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
//             $errors['mail_check'] = "メールアドレスの形式が正しくありません";
//         }
//         $stmt = $db->prepare("SELECT user_id FROM user WHERE user_mail = :user_mail");
//         $stmt->bindValue(':user_mail',$mail,PDO::PARAM_STR);
//         $stmt->execute();
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
//         //userテーブルに同じメールアドレスがある場合、エラー表示
//         if(empty($result)){
//             $errors['user_check'] = "このメールアドレスは存在しません";
//         }
//     }

    //エラーがない場合、pre_userテーブルにインサート
    if(isset($_POST['submit'])){
        $user_pw = htmlspecialchars($_POST['user_pw'], ENT_QUOTES, "UTF-8");
        $pw_hash = password_hash($user_pw, PASSWORD_DEFAULT);
        $stmt = $db->prepare('UPDATE user SET user_pw = :user_pw 
        WHERE user_mail = :user_mail ');
        $stmt->bindValue(':user_pw',$pw_hash,PDO::PARAM_STR);
        $stmt->bindValue(':user_mail',$_SESSION['mail'],PDO::PARAM_STR);


        $urltoken = hash('sha256',uniqid(rand(),1));
        //ここどうするか後で検討する
 $url = "https://amateur-step.com/sharetyping/userInformation/php/login.php?urltoken=".$urltoken;

        // メール送信処理
        //登録されたメールアドレスへメールをお送りする
        //今回はメール送信しないためコメント


       $mailTo = $_SESSION['mail'];
         $body = <<< EOM
       パスワードの変更が完了しました。
       {$url}
     EOM;
        mb_language('ja');
        mb_internal_encoding('UTF-8');
       
    //    //FROMヘッダーを作成
       $companymail = 'sharetyping.info@gmail.com';
        $header = 'From:'. mb_encode_mimeheader('シェアタイピング'). '<'. $companymail . '>';
       $subject = 'パスワード変更完了';
       
        if(mb_send_mail($mailTo,$subject,$body,$header)){
    //     //セッション変数をすべて解除
        // $_SESSION = array();
    //     //クッキーの削除
        //  if(isset($_COOKIE["PHPSESSID"])){
        //      setcookie("PHPSESSID",'',time()-1800,'/');
        //  }

    //     //セッションを破壊する
        //  session_destroy();
         $message = 'パスワードの変更が完了しました'.'<br>'.'メールをお送りしたのでご確認ください';
        
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../css/form.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    body {
        overflow: hidden;
        background: rgb(220, 219, 219);
        z-index: 1;
    }


    .start {
        text-align: center;
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



    .font2 {
        font-size: 16px;
    }

    /* .textlen,.comfirming{
    text-align:left;
} */

    .b {
        margin-left: 0;
        margin-right: 0;
    }

    .a {
        margin-left: 53px;
        text-align: left;
    }

    .cau {
        color: #ff0000;
    }
    </style>
</head>

<body>
    <header><?php  require('../../hamburger/notLogHamburger.php') ?></header>
    <div class="wrapper">
        <div class="containers">

            <h3 class="lesson"><span class="sankaku"></span>パスワードの変更</h3>
            <?php if(isset($_POST['submit'])):?>
            <p><?=$message?></p>
            <?php else : ?>
            <form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="post" id="submit">
                <div>
                    <div class="start">
                        <div>
                            <div class="start a"><span class="hissu">※</span><span
                                    class="font2 textlen b">新しいパスワード(8文字以上)</span></div><br>
                            <div class="eye"><input type="password" name="user_pw" id="pass1" class="pw1"
                                    autocomplete="off" value="<?php if(isset($pw)){echo $pw;};?>" required><span
                                    id="buttonEye1" class="fa fa-eye-slash"></span></div>
                        </div>
                        <div>
                            <div class="start"><span class="hissu">※</span><span
                                    class="font2 comfirming">パスワード確認用</span></div><br>
                            <div class="eye"><input type="password" name="check" id="pass2" class="pw2"
                                    autocomplete="off" value="<?php if(isset($check)){echo $check;};?>" required><span
                                    id="buttonEye2" class="fa fa-eye-slash"></span></div>
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
    <script src="../js/eye.js"></script>
    <script src="../js/changePass.js"></script>


</body>

</html>