<?php
session_start();
try {
  $db = new PDO('mysql:host=localhost;dbname=wp459266_quiz;charset=utf8', 'wp459266_wp1', 'gumi7070');
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $stmt = $db->prepare('SELECT * FROM ' . $_SESSION['title'] . '');
  $stmt->execute();
  $row = $stmt->fetchAll();
  $jsonArray = json_encode($row);
} catch (PDOException $e) {
  $e->getMessage();
}

if (isset($_POST['score'])) {
  if (empty($_SESSION['user_id'])) {
    $_SESSION['score'] =  $_POST['score'];
    $_SESSION['miss'] = $_POST['miss'];
    $_SESSION['rate'] = $_POST['rate'];
    $_SESSION['level'] = $_POST['level'];
    header('Location:scoreKey.php');
  } else {
    try {
      $db = new PDO('mysql:host=localhost;dbname=wp459266_infomation;charset=utf8', 'wp459266_wp1', 'gumi7070');
      $stmt = $db->prepare('SELECT * FROM score
      WHERE user_id = :user_id');
      $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
      $stmt->execute();
      if ($row = $stmt->fetch()) {
        $stmt = $db->prepare('UPDATE score SET 
      score = :score,miss = :miss,rate = :rate,
      level = :level  WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':score', $_POST['score'], PDO::PARAM_INT);
        $stmt->bindValue(':miss', $_POST['miss'], PDO::PARAM_INT);
        $stmt->bindValue(':rate', $_POST['rate'], PDO::PARAM_INT);
        $stmt->bindValue(':level', $_POST['level'], PDO::PARAM_STR);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO score 
       (user_id,score,miss,rate,level) VALUES (:user_id,:score,:miss,:rate,:level)');
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':score', $_POST['score'], PDO::PARAM_INT);
        $stmt->bindValue(':miss', $_POST['miss'], PDO::PARAM_INT);
        $stmt->bindValue(':rate', $_POST['rate'], PDO::PARAM_INT);
        $stmt->bindValue(':level', $_POST['level'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt = $db->prepare('SELECT * FROM score 
       WHERE user_id = :user_id');
        $stmt->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();
      }
      header('Location:scoreKey.php');
    } catch (PDOException $e) {
      $e->getMessage();
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
  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../../topPage/css/Top.css">
  <link rel="stylesheet" href="../../topPage/css/entire.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
  <link rel="icon" href="../../img/favicon.png" id="favicon">
  <style>
    body {
      background: rgb(220, 219, 219);
      z-index: 1;
    }
  </style>
</head>

<body>
  <?php if (!empty($_SESSION['user_name'])) {
    echo '<header>';
    require('../../hamburger/logHamburger.php');
    echo '</header>';
  } else {
    echo '<header>';
    require('../../hamburger/keyboardHam.php');
    echo '</header>';
  } ?>
  <div class="container" id="container">
    <div id="header">
      <p id="time">0</p>

      <p id="quiz"></p>
      <p id="text"></p>
      <p id="output"></p>

      <p> </p>
    </div>

    <div class="keyboard">
      <div id="virtual-keyboard">
        <div id="tap" class="deco_key1"></div>
        <div id="tap" class="key_1">1</div>
        <div id="tap" class="key_2">2</div>
        <div id="tap" class="key_3">3</div>
        <div id="tap" class="key_4">4</div>
        <div id="tap" class="key_5">5</div>
        <div id="tap" class="key_6">6</div>
        <div id="tap" class="key_7">7</div>
        <div id="tap" class="key_8">8</div>
        <div id="tap" class="key_9">9</div>
        <div id="tap" class="key_0">0</div>
        <div id="tap" class="key_hyphen">-</div>
        <div id="tap" class="deco_key2"></div>
        <div id="tap" class="deco_key3"></div>
        <div id="tap" class="deco_key4"></div>
        <div id="tap" class="deco_key5"></div>
        <div id="tap" class="key_q">Q</div>
        <div id="tap" class="key_w">W</div>
        <div id="tap" class="key_e">E</div>
        <div id="tap" class="key_r">R</div>
        <div id="tap" class="key_t">T</div>
        <div id="tap" class="key_y">Y</div>
        <div id="tap" class="key_u">U</div>
        <div id="tap" class="key_i">I</div>
        <div id="tap" class="key_o">O</div>
        <div id="tap" class="key_p">P</div>
        <div id="tap" class="key_atmark">@</div>
        <div id="tap" class="deco_key6"></div>
        <div id="tap" class="key_Enter"></div>
        <div id="tap" class="deco_key7"></div>
        <div id="tap" class="key_a">A</div>
        <div id="tap" class="key_s">S</div>
        <div id="tap" class="key_d">D</div>
        <div id="tap" class="key_f">F</div>
        <div id="tap" class="key_g">G</div>
        <div id="tap" class="key_h">H</div>
        <div id="tap" class="key_j">J</div>
        <div id="tap" class="key_k">K</div>
        <div id="tap" class="key_l">L</div>
        <div id="tap" class="key_semicolon">;</div>
        <div id="tap" class="key_colon">:</div>
        <div id="tap" class="deco_key8"></div>
        <div id="tap" class="key_lShift">shift</div>
        <div id="tap" class="key_z">Z</div>
        <div id="tap" class="key_x">X</div>
        <div id="tap" class="key_c">C</div>
        <div id="tap" class="key_v">V</div>
        <div id="tap" class="key_b">B</div>
        <div id="tap" class="key_n">N</div>
        <div id="tap" class="key_m">M</div>
        <div id="tap" class="key_comma">,</div>
        <div id="tap" class="key_period">.</div>
        <div id="tap" class="key_slash">/</div>
        <div id="tap" class="deco_key9"></div>
        <div id="tap" class="key_rShift">shift</div>
        <div id="tap" class="deco_key10"></div>
        <div id="tap" class="deco_key11"></div>
        <div id="tap" class="deco_key12"></div>
        <div id="tap" class="deco_key13"></div>
        <div id="tap" class="key_space">space</div>
        <div id="tap" class="deco_key14"></div>
        <div id="tap" class="deco_key15"></div>
        <div id="tap" class="deco_key16"></div>
        <div id="tap" class="deco_key17"></div>
        <div id="tap" class="deco_key18"></div>
      </div>
    </div>
  </div>


  <form action="" method="post" id="thr">
    <input type="hidden" name="score">
    <input type="hidden" name="miss">
    <input type="hidden" name="rate">
    <input type="hidden" name="level">
  </form>
  </form>

  <script>
    let obj = JSON.parse('<?php echo $jsonArray ?>');
  </script>
  <script src="../js/keyboard.js"></script>
  <script src="../js/close.js"></script>
  <script src="../../topPage/js/play.js"></script>
  <script src="../../topPage/js/notLog.js"></script>


</body>

</html>