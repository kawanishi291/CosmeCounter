<?php
session_start();
if(isset($_SESSION['user_id'])){
}else{
    header("Location: ./register_func-master/index.php");
}
?>
 <?php
    include './transaction/flag_3.php';
    include './dbconnect/pdo_connect.php';
    $sql = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
    $stmt = $pdo -> query($sql);
    foreach($stmt as $row){
        $_SESSION['user_name'] = $row['user_name'];
    }
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Cosme Counter</title>
    <link rel="shortcut icon" href="./favicon.ico">
    <link rel="apple-touch-icon" href="./icon.jpg" />
</head>
<body>
<div class="wrapper">
    <header>
        <h1>Makeup Room</h1>
    </header>
    <div class="main">
        <button class="btn-miller" onclick="location.href='./profile.php'">Cosme Miller</button>
        <button class="btn-pouch" onclick="location.href='./pouch/index.php'">Make Pouch</button>
        <button class="btn-calendar" onclick="location.href='./calendar/index.php'">Calender</button>
        <button class="btn-genre" onclick="location.href='./trashbox/index.php'">Trash Box</button>
        <br>
        <button class="btn-logout" value="logout" onclick="location.href='./register_func-master/logout.php?logout'">Go Out</button>
        <button class="btn-brand" onclick="location.href='./sns/index.php'">Support</button>
<!--        <input type="button" onclick="location.href='./register_func-master/logout.php?logout'" value="logout">-->
    </div>
</div>
<?php
    include './transaction/flag_4.php';
?>
<?php
    if($_SESSION['user_id'] == 1){
        echo "<button onclick=location.href='./pouch/chek.php'>Make Pouch</button>";
    }else{
        
    }
?>
</body>
</html>