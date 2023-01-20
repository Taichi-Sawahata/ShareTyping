<?php 
if(isset($_POST['out'])){
    if($_POST['out'] === 'logout'){
        unset($_SESSION["user_id"]);
        unset($_SESSION["user_name"]);
        header('Location:../../../index.php');
    }
}

if(empty($_SESSION['user_name'])){
    header('Location:../../../index.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../hamburger/css/ham.css">
</head>
<body>
        <div class="header">
            <div class="left">
            <a href="../../topPage/php/logTop.php"><img src="../../img/logo.png" alt="" id="img"></a>
                <div class="anker"><a id="summary" href="../../topPage/php/summary.php">レッスン一覧</a></div>
                <div class="anker"><a href="#">ヘルプ</a></div>
            </div>
            <div class="right">
            <div class="name">
                <form action="" method="post" id="post">
           <select name="out" id="out">
             
            <option value="<?php echo $_SESSION['user_name']?>">
           <?php echo $_SESSION['user_name']?>
        </option>
          <option value="logout">ログアウト</option>
        </select>
        </form></div>
            <i class="bi bi-person-circle"></i>
            </div>
        </div>
</body>
</html>