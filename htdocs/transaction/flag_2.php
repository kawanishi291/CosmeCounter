<!-- 期限外1ヶ月 -->
<?php
    date_default_timezone_set('Asia/Tokyo');
    $t_year = date("Y");
    $t_month = date("m");
    $t_day = date("d");

if($t_month == 1 AND $t_day == 1){
    $start_year = $t_year - 1;
    $start_month = 12;
    $start_day = $t_day;
    
    $end_year = $t_year - 1;
    $end_month = 12;
    $end_day = 31;
    $flag = 1;
}elseif($t_month == 1){
    $start_year = $t_year - 1;
    $start_month = 12;
    $start_day = $t_day;
    
    $end_year = $t_year;
    $end_month = $t_month;
    $end_day = $t_day - 1;
    $flag = 2;
}elseif($t_day == 1){
    $start_year = $t_year;
    $start_month = $t_month - 1;
    $start_day = $t_day;
    
    $end_year = $t_year;
    $end_month = $t_month - 1;
    $end_day = 31;
    $flag = 3;
}else{
    $start_year = $t_year;
    $start_month = $t_month - 1;
    $start_day = $t_day;
    
    $end_year = $t_year;
    $end_month = $t_month;
    $end_day = $t_day - 1;
    $flag = 0;
}

switch ($flag){
case 0:
    if($start_month < 10){
        $start_month = '0'.$start_month;
    }else{
    }
  break;
case 1:
    if($end_day < 10){
        $end_day = '0'.$end_day;
    }else{
    }
  break;
case 2:
    if($start_month < 10){

        $start_month = '0'.$start_month;
        $end_month = '0'.$end_month;
    }else{
    }
  break;
//default:
}

$start = $start_year.$start_month.$start_day;
$end = $end_year.$end_month.$end_day;

    include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} AND flag NOT IN (1, 2) AND start_day < end_day AND end_day BETWEEN '$start' AND '$end' ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
            if(isset($row['time'])){
                $_SESSION["id"] = $row['time'];
                $comment = "使用期限が切れています!!\n".$row['comment'];
                $sql = "UPDATE pouch SET flag = 2, comment = '$comment' WHERE time = '{$_SESSION["id"]}'";
                $pdo -> query($sql);
            }else{
                
            }
        }