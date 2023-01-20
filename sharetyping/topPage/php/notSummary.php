<?php 
session_start();

$num;
$row;
$json = array();
$content = array();
$people = array();
$datepost = array();
try{
    $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
    $stmt = $db->prepare('SELECT count(*) FROM quiz');
   $stmt->execute();
   $num = $stmt->fetchColumn();


   $stmt = $db->prepare('SELECT * FROM quiz');
   $stmt->execute();
   $row = $stmt->fetchAll();
  for($i=0;$i<=$num-1;$i++){
array_push($json,$row[$i]['title']);
array_push($content,$row[$i]['content']);
array_push($people,$row[$i]['user_name']);
array_push($datepost,$row[$i]['datepost']);
 }

  $rows = json_encode($json);
  $contents = json_encode($content);
  $peoples = json_encode($people);
  $dateposts = json_encode($datepost);
   
}catch(PDOException $e){
    $e->getMessage();
}

  

if(isset($_POST['game'])){
   $_SESSION['title'] = $_POST['game'];
   header('Location:../../keyboard/php/spaceKey.php');
 }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>  
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/entire.css">
    <link rel="stylesheet" href="../css/Top.css">

    <style>

body{
  position:relative;
}

h3{
  text-align: center;
  width: 725px;

}

.row:first-child{
        margin: 0;
        padding-top:30px;
      }


.footer{
  position:absolute;
  bottom:0;
  left:50%;
  transform: translateX(-50%);
  margin: 0;
}

</style>
</head>
<body>
<header><?php  require('../../hamburger/notLogHamburger.php') ?></header>
<h3 class="summary"><span class="sankaku"></span>
          シェアタイピング一覧</h3>   
<div class="summary-list" id="card-list">
                     
         </div>
            <div class="top">
        <a href="logTop.php">トップへ戻る</a>
      </div> 
      <div class="footer" style="margin:0">Copyright &copy; ShareTyping</div>

          <script>
         const json = JSON.parse('<?php echo $rows ?>');
        const content = JSON.parse('<?php echo $contents ?>');
         const people = JSON.parse('<?php echo $peoples ?>');
         const datepost = JSON.parse('<?php echo $dateposts ?>');
      </script>
<script src="../js/play.js"></script>
<script src="../js/login.js"></script>


</body>
</html>