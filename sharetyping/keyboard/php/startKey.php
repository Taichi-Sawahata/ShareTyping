<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    header('Location:keyboard.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareTyping</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../topPage/css/Top.css">
    <link rel="stylesheet" href="../../topPage/css/entire.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
        body{
            background: rgb(220, 219, 219);
            z-index: 1;
        }
    </style>
</head>
<body>
<?php if(!empty($_SESSION['user_name'])){
echo '<header>';
  require('../../hamburger/logHamburger.php'); 
echo '</header>';
}else{
    echo '<header>';
    require('../../hamburger/keyboardHam.php');
    echo '</header>';
} ?>

<div class="container">

<div id="timer"></div>

</div>
</div>


<form action="" method="post" id="go">
    <input type="hidden" name="post">
</form>
<script src="../js/close.js"></script>
<script src="../js/countDown.js"></script>
<script src="../../topPage/js/play.js"></script>
<script src="../../topPage/js/notLog.js"></script>

</body>
</html>