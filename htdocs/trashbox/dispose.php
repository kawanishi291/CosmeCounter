<?php
    date_default_timezone_set('Asia/Tokyo');
    $z = date("Ym");
    $z = $z-1;
    include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = '{$_SESSION['user_id']}' AND flag NOT IN (1) AND start_day < end_day ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
        $_SESSION["id"] = $row['time'];
        $y = substr($row['end_day'], 0, 4);
        $x = substr($row['end_day'], 5, 2);
        $S = $y.$x;
            if($z > $S){
                include '../dbconnect/pdo_connect.php';
                $sql = "UPDATE pouch SET flag = 1 WHERE time = '{$_SESSION["id"]}'";
                $pdo -> query($sql);
            }else{
                
            }
        }
