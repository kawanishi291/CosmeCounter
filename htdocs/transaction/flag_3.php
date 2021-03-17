<!-- 期限1ヶ月前 -->
<?php
    date_default_timezone_set('Asia/Tokyo');
    $t_year = date("Y");
    $t_month = date("m");
    $t_day = date("d");

if($t_month == 12){    
    $end_year = $t_year + 1;
    $end_month =  1;
}else{
    $end_year = $t_year;
    $end_month = $t_month + 1;
}

if($end_month < 10){
    $end_month = '0'.$end_month;
}else{
    
}
$start = $t_year.$t_month.$t_day;
$end = $end_year.$end_month.$t_day;

    include './dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} AND flag = 0 AND start_day < end_day AND end_day BETWEEN '$start' AND '$end' ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
            if(isset($row['time'])){
                $_SESSION["id"] = $row['time'];
                $sql = "UPDATE pouch SET flag = 3 WHERE time = '{$_SESSION["id"]}'";
                $pdo -> query($sql);
            }else{
            }
        }