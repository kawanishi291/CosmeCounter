<!-- 3~9のflag設定変更 -->
<?php
    $flag_3 = false;
    $flag_9 = false;
    $set_flag = false;
    $count = 0;
    include './dbconnect/pdo_connect.php';
    $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} AND flag BETWEEN 3 AND 9 ORDER BY flag ASC";
    $stmt = $pdo -> query($sql);
    foreach($stmt as $row){
        if($row['flag'] == 3){
            $flag_3 = true;
        }elseif($row['flag'] == 9){
            $flag_9 = true;
        }else{
            $set_flag = $row['flag'];
        }
        $count ++;
    }
$set_flag = $set_flag + 1;
$alert0 = "<script type='text/javascript'>alert('期限1ヶ月前のアイテムが";
$alert1 = "点あります');</script>";
if($flag_3 == true){
    echo $alert0.$count.$alert1;
    $sql = "UPDATE pouch SET flag = 4 WHERE user_id = '{$_SESSION["user_id"]}' AND flag BETWEEN 3 AND 9";
    $pdo -> query($sql);
}elseif($flag_9 == true){
    $sql = "UPDATE pouch SET flag = 3 WHERE user_id = '{$_SESSION["user_id"]}' AND flag BETWEEN 3 AND 9";
    $pdo -> query($sql);
}else{
    $sql = "UPDATE pouch SET flag = '$set_flag' WHERE user_id = '{$_SESSION["user_id"]}' AND flag BETWEEN 3 AND 9";
    $pdo -> query($sql);
}