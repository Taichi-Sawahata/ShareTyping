<?php 
session_start();
try{
    $db = new PDO('mysql:host=localhost;dbname=meta;charset=utf8','root');
    $stmt=$db->prepare('SELECT * FROM score 
    WHERE user_id = :user_id ');
    $stmt->bindValue(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
    $stmt->execute();
    if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $score1_1 = $row['score1_1'];
    }
    $stmt=$db->prepare('SELECT * FROM user
    WHERE user_id = :user_id
    ');
    $stmt->bindValue(':user_id',$_SESSION['user_id'],PDO::PARAM_INT);
    $stmt->execute();
    if($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $user_name = $row['user_name'];
    }

}catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <p>ユーザーネーム:
         <?php 
         echo $user_name;
         ?>

        </p>
        <p>スコア:
            <?php 
            echo $score1_1;
            ?>
        </p>
    </div>
</body>
</html>