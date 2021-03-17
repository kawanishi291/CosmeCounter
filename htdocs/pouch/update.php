<?php
session_start();
?>
<?php
header('Location: ./index.php');
$flg = 0;
$log_1 = "";
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	
	/* 拡張子の取得。 */
	$ext = pathinfo($_FILES["upfile"]["name"], PATHINFO_EXTENSION);
    
	/* ファイルの保存先と保存名 */
	$file_pass = "./img/mypage/pouch_id/" . $_FILES["upfile"]["name"];
	
	/* ファイルの拡張子が「jpg」「jpeg」「png」「gif」か確認する */
	if($ext != "jpg" AND $ext != "jpeg" AND $ext !="gif" AND $ext != "png" ){
	    /* 画像ファイルでなければ保存しない。 */
	}else{
		/* 画像ファイルです */
	
		/* img/mypage/フォルダの中に各ユーザーidごとのフォルダを作る。 */
		$directory_path = "./img/mypage/pouch_id";
		/* 既にユーザーidのフォルダが存在していた場合は、新たに作らない。 */
		if(!is_dir($directory_path)){
			/* フォルダがなかったので新しく作る。 */
			mkdir($directory_path, 0777, TRUE);
		}else{
			/* フォルダが既にあるので、新たには作らない。 */
		}
		/* 画像ファイルを保存 */
    $new_img = md5(uniqid(mt_rand(), true)).'.'.$extension; 
		if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], "./img/mypage/pouch_id/" .$new_img)) {
			$log_1 =  $_FILES["upfile"]["name"] . "をアップロードしました。";
			$flg = 1;
		} else {
			$log_1 = "ファイルをアップロードできません。";
		}
	}
} else {
	$log_1 = "画像ファイルを選択してください。"; 
}
?>
<?php
date_default_timezone_set('Asia/Tokyo');
echo date("Y/m/d - M (D) H:i:s");
echo date("Y/m/d/ H:i:s");
$date = date("Y/m/d/ H:i:s");
$_SESSION["time"] = $date;

include '../dbconnect/mysqli_connect.php';
	$item_name = $mysqli->real_escape_string($_POST['item_name']);
    $_SESSION["item_name"] = $item_name;
    $day = $_POST['day'];
    $_SESSION["day"] = $day;
    $year = $_POST['year'];
    $_SESSION["year"] = $year;
    $month = $_POST['month'];
    $_SESSION["month"] = $month;
    $genre = $mysqli->real_escape_string($_POST['genre']);
    $_SESSION["genre"] = $genre;
    $brand = $mysqli->real_escape_string($_POST['brand']);
    $_SESSION["brand"] = $brand;
    $model = $mysqli->real_escape_string($_POST['model']);
    $_SESSION["model"] = $model;
    $comment = $mysqli->real_escape_string($_POST['comment']);
    $_SESSION["comment"] = $comment;

    $item_img = $new_img;
    $_SESSION['item_img'] = $item_img;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h1>投稿が完了しました。</h1>
    <h1><?= $_SESSION['user_id']?></h1>
    <h1><?= $_SESSION['user_name']?></h1>
    <h1><?= $_SESSION['item_name']?></h1>
    <h1><?= $_SESSION['item_img']?></h1>
    <h1><?= $_SESSION['day']?></h1>
    <h1><?= $_SESSION['year']?></h1>
    <h1><?= $_SESSION['month']?></h1>
    <h1><?= $_SESSION['genre']?></h1>
    <h1><?= $_SESSION['brand']?></h1>
    <h1><?= $_SESSION['model']?></h1>
    <h1><?= $_SESSION['time']?></h1>
    <a href="index.php">戻る</a>    
</body>
</html>
<!-- ここまでPOSTの受け渡し処理 -->
<!-- 使用期限日を求める -->
<?php
    $y = substr($day, 0, 4);
    $m = substr($day, 5, 2);
    $d = substr($day, 8);
    $month = $month + $m;
//年の繰り上がり
    if($month > 12){
        $y = $y +1;
        $month = $month - 12;
        echo "年の繰り上がり";
    }else{
        echo "年の繰り上がりなし";
    }
        
//4,6,9,11月かつ31日の場合
    if($d == 31 and $month == 4){
        $month++;
        $d = 1;
        echo "4月31日の場合";
    }elseif($d == 31 and $month == 6){
        echo $month;
        $month++;
        $d = 1;
        echo "6月31日の場合";
    }elseif($d == 31 and $month == 9){
        echo $month;
        $month++;
        $d = 1;
        echo "9月31日の場合";
    }elseif($d == 31 and $month == 11){
        echo $month;
        $month++;
        $d = 1;
        echo "11月31日の場合";
        
//29,30,31日かつ2月の場合
    }elseif($d >= 29 and $month == 2){
//うるう年
        if($y % 4 == 0){
            if($d == 29){
                $d = 29;
                echo "うるう年2/29";
            }else{
                $month++;
                $a = $d - 29;
                $d = 0;
                for($i = $a; $i > 0; $i--){
                    $d++;
                    echo "30,31日かつ,うるう年の2月の場合";
                }
            }
//うるう年でない        
        }else{
            if($d == 29){
                $d = 1;
                echo "うるう年でない2/29";
            }else{
                $month++;
                $a = $d - 28;
                $d = 0;
                for($i = $a; $i > 0; $i--){
                    $d++;
                    echo "30,31日かつ,うるう年でない2月の場合";
                }
            }
        }
    }else{
        echo "条件なし";
    }        
    $year = $year + $y;
    $endday = $year."-".$month."-".$d;
    echo $endday;
?>

<!-- ここからDBへのINSERT処理 -->
<?php
    try{
        include '../dbconnect/pdo_connect.php';
        $sql = "INSERT INTO pouch (user_id, item_name, start_day, end_day, genre, brand, model, item_img, comment, flag, time) VALUES ({$_SESSION['user_id']}, '$item_name', '$day', '$endday', '$genre', '$brand', '$model', '$item_img', '$comment', '0', '{$_SESSION['time']}')";
        $pdo -> query($sql);
    }catch(PDOException $Exception){
    }
    exit();
?>