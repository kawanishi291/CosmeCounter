<?php
    session_start();
?>
<!-- ここからDBへのUPDATE処理 -->
<?php
    try{
        include '../dbconnect/pdo_connect.php';
        $sql = "UPDATE pouch SET flag = '1' WHERE time = '{$_SESSION["ID"]}'";
        $pdo -> query($sql);
    }catch(PDOException $Exception){
    }

    header('Location: ./index.php');
    exit();
?>