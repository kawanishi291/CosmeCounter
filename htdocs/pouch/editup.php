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
    if(empty($_POST['item_name'])){
        echo "空。";
        $item_name = $_SESSION["item_name"];
        $_SESSION['item_name'] = $item_name;
        echo "既存！";
        echo $_SESSION["item_name"];
    }else{
        echo "入ってる。";
        $item_name = $mysqli->real_escape_string($_POST['item_name']);
        $_SESSION['item_name'] = $item_name;
        echo "新！";
        echo $_SESSION["item_name"];
    }
    if(empty($_FILES["upfile"]["name"])){
        echo "空。";
        $item_img = $_SESSION["item_img"];
        $_SESSION['item_img'] = $item_img;
        echo "既存！";
        echo $_SESSION["item_img"];
    }else{
        echo "入ってる。";
        $item_img = $new_img;
        $_SESSION["item_img"] = $item_img;
        echo $_SESSION["item_img"] ;
    }
    if(empty($_POST['day'])){
        echo "空。";
        $day = $_SESSION["start_day"];
        $_SESSION['start_day'] = $day;
        echo "既存！";
        echo $_SESSION["start_day"];
    }else{
        echo "入ってる。";
        $day = $mysqli->real_escape_string($_POST['day']);
        $_SESSION['start_day'] = $day;
        echo "新！";
        echo $_SESSION["day"];
    }
    if(empty($_POST['end_day'])){
        echo "空。";
        $end_day = $_SESSION["end_day"];
        $_SESSION['end_day'] = $end_day;
        echo "既存！";
        echo $_SESSION["end_day"];
    }else{
        echo "入ってる。";
        $end_day = $mysqli->real_escape_string($_POST['end_day']);
        $_SESSION['end_day'] = $end_day;
        echo "新！";
        echo $_SESSION["end_day"];
    }
    $genre = $mysqli->real_escape_string($_POST['genre']);
    $_SESSION["genre"] = $genre;
    $brand = $mysqli->real_escape_string($_POST['brand']);
    $_SESSION["brand"] = $brand;
    if(empty($_POST['model'])){
        echo "空";
        $model = $_SESSION["model"];
        $_SESSION['model'] = $model;
        echo "既存";
        echo $_SESSION["model"];
    }else{
        echo "入ってる。";
        $model = $mysqli->real_escape_string($_POST['model']);
        $_SESSION['model'] = $model;
        echo "新！";
        echo $_SESSION["model"];
    }
    if(empty($_POST['comment'])){
        echo "空!";
        $comment = $_SESSION["comment"];
        $_SESSION['comment'] = $comment;
        echo "既存!";
        echo $_SESSION["comment"];
    }else{
        $comment = $mysqli->real_escape_string($_POST['comment']);
        $_SESSION['comment'] = $comment;
        echo "新！";
        echo $_SESSION['comment'];
    }
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h1>投稿が完了しました。</h1>
    <h1><?= $_SESSION['ID']?></h1>
    <h1><?= $_SESSION['user_id']?></h1>
    <h1><?= $_SESSION['user_name']?></h1>
    <h1><?= $_SESSION['item_name']?></h1>
    <h1><?= $_SESSION['item_img']?></h1>
    <img src='<?php echo "./img/mypage/pouch_id/{$_SESSION['item_img']}";?>'>
    <h1><?= $_SESSION['start_day']?></h1>
    <h1><?= $_SESSION['year']?></h1>
    <h1><?= $_SESSION['month']?></h1>
    <h1><?= $_SESSION['genre']?></h1>
    <h1><?= $_SESSION['brand']?></h1>
    <h1><?= $_SESSION['model']?></h1>
    <h1><?= $_SESSION['time']?></h1>
    <h1><?= $_SESSION['comment']?></h1>
    <a href="index.php">戻る</a>    
</body>
</html>
<!-- ここまでPOSTの受け渡し処理 -->


<!-- ここからDBへのUPDATE処理 -->
<?php
    try{
        include '../dbconnect/pdo_connect.php';
        $sql = "UPDATE pouch SET item_name = '{$_SESSION["item_name"]}', start_day = '{$_SESSION["start_day"]}', end_day = '{$_SESSION["end_day"]}', genre = '{$_SESSION["genre"]}', brand = '{$_SESSION["brand"]}', model = '{$_SESSION["model"]}', item_img = '{$_SESSION["item_img"]}', comment = '{$_SESSION["comment"]}', flag = '0' WHERE time = '{$_SESSION["ID"]}'";
        $pdo -> query($sql);
    }catch(PDOException $Exception){
    }
	exit();
?>