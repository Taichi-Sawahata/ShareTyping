<?php 
session_start();

$num;
$row;
$json = array();
$content = array();
$people = array();
$datepost = array();
$file = array();



try{
    $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8','wp459266_wp1','gumi7070');
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $stmt = $db->prepare('SELECT count(*) FROM quiz');
   $stmt->execute();
   $num = $stmt->fetchColumn();

   $stmt = $db->prepare('SELECT * FROM quiz');
   $stmt->execute();
   $row = $stmt->fetchAll();



  $stmt = $db->prepare('SELECT * FROM images');
  $stmt->execute();
  $images = $stmt->fetchAll();
  foreach($images as $img){
  array_push($file,$img['file_path_index'].$img['file_name']);
  }



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
      $files = json_encode($file);

   
}catch(PDOException $e){
    $e->getMessage();
}

  
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
   $_SESSION['title'] = $_POST['game'];
   header('Location:sharetyping/keyboard/php/spaceKey.php');
 }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Arimo&display=swap" rel="stylesheet">   
 <link rel="stylesheet" href="sharetyping/topPage/css/entire.css">
    <link rel="stylesheet" href="sharetyping/topPage/css/Top.css">
    <style>
      @media screen and (max-width: 1375px){
  .sankaku{
    border:none;
  }

} 

body{
 
 background: rgb(220, 219, 219);
 z-index: 1;
}

  
#prev,#next,#initialize,.li{
  cursor:pointer;

}

.li:active{
  background: #AFDFE4;
  opacity: .9;
}

,#initialize:active{
  opacity: .8;
}

/* .inner{
  display: flex;
  justify-content:space-around;
} */

.df{
  display: flex;
  width: 100%;
  justify-content:center;
margin-top: 30px;
}

.explain{
   padding-top: 100px; 
}

img{
  width:308px;
}


    </style>
</head>
<body>
<header><?php  require('sharetyping/hamburger/indexHamburger.php') ?></header>

        <div class="wrapper">
            <!--ページネーション-->                      
    <p class="count"></p>
    <ul class="card-list" id="card-list"></ul>

    
    <div class="page-list">
    <span id="prev"><<</span>
    <ul class="pagination" id="pagination">
      <li class="li" id="li1">1</li>
      <li class="li" id="li2">2</li>
      <li class="li" id="li3">3</li>
      <li class="li" id="li4">...</li>
      <li class="li" id="li5">5</li>
    </ul>
    <span id="next">>></span>
    <span id="initialize">最初のページに戻る</span>
    </div>

                 
                  
                          </div>
                          </div>
                          </div>
</div>




      <script>
         const json = JSON.parse('<?php echo $rows ?>');
        const content = JSON.parse('<?php echo $contents ?>');
         const people = JSON.parse('<?php echo $peoples ?>');
         const datepost = JSON.parse('<?php echo $dateposts ?>');
         const file = JSON.parse('<?php echo $files ?>');
      
      </script>
 <script src="sharetyping/userInformation/js/notIndexSummary.js"></script>
<script src="sharetyping/topPage/js/indexPlay.js"></script>

</body>
</html>