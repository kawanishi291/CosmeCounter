<?php
session_start();
?>
<?php
function send_massage($mysqli){
}
 header('location: ./sns.php');
date_default_timezone_set('Asia/Tokyo');
echo date("Y/m/d - M (D) H:i:s");
echo date("Y/m/d/ H:i:s");
$date = date("Y/m/d/ H:i:s");
$_SESSION["time"] = $date;
$request_id = $_POST['request_id'];
$_SESSION["request_id"] = $request_id;
$chat = $_POST['chat'];
$_SESSION["chat"] = $chat;
echo $_SESSION["user_id"],$_SESSION["user_name"],$chat,$request_id;

      try{
        /*echo $_SESSION["user_id"];
        echo $_SESSION["user_name"];
        echo $_SESSION["user_img"];
        echo $_SESSION["request_id"];
        echo $_SESSION["chat"];*/
        include '../dbconnect/pdo_connect.php';
          $sql = "INSERT INTO chat VALUES ('{$_SESSION["user_id"]}','{$_SESSION["request_id"]}', '{$_SESSION["chat"]}', 0, '{$_SESSION["time"]}')";
          $pdo -> query($sql);
    }catch(PDOException $Exception){}
        ?>
<!--
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h1>投稿が完了しました。</h1>
    <a href="index.php">戻る</a>
    <p><?php
//        echo "<br> あなたのID:";
//        echo $_SESSION["user_id"];
//        echo "<br> あなたのなまえ:";
//        echo $_SESSION["user_name"];
//        echo "<br> あなたのプロフィール画像:";
//        echo $_SESSION["user_img"];
//        echo "<br> 相手のID:";
//        echo $_SESSION["request_id"];
//        echo "<br> チャット内容:";
//        echo $_SESSION["chat"];
    ?></p>

</body>
</html>
-->
