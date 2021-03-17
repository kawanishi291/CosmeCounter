<?php
session_start();

/* 画像がアップロードされたら立てるフラグを初期化。 */
$flg = 0;
/* メッセージ用変数を初期化。 */
$log_1 = "";

/* ファイルを選択し、submitボタンを押した際の処理。 */
/* POST でアップロードされたファイルかどうかを調べる。 */

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	
	/* 拡張子の取得。 */
	$ext = pathinfo($_FILES["upfile"]["name"], PATHINFO_EXTENSION);
    
	/* ファイルの保存先と保存名 */
	$file_pass = "./img/mypage/test_id/" . $_FILES["upfile"]["name"];
	
	/* ファイルの拡張子が「jpg」「jpeg」「png」「gif」か確認する */
	if($ext != "jpg" AND $ext != "jpeg" AND $ext !="gif" AND $ext != "png" ){
	    /* 画像ファイルでなければ保存しません。 */
	}else{
		/* 画像ファイルです */
	
		/* img/mypage/フォルダの中に各ユーザーidごとのフォルダを作ります。 */
		$directory_path = "./img/mypage/test_id";
		/* 既にユーザーidのフォルダが存在していた場合は、新たに作りません。 */
		if(!is_dir($directory_path)){
			/* フォルダがなかったので新しく作ります。 */
			mkdir($directory_path, 0777, TRUE);
		}else{
			/* フォルダが既にあるので、新たには作りません。 */
		}
		
		/* 画像ファイルを保存 */
		if (move_uploaded_file ($_FILES["upfile"]["tmp_name"], "./img/mypage/test_id/" . $_FILES["upfile"]["name"])) {
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
    

      try{
    include '../dbconnect/pdo_connect.php';
//          $pdo = new PDO('mysql:host=localhost;dbname=o-hara-test;charset=UTF8','root','');
//          $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        $dbh = new PDO('mysql:host=localhost;dbname=o-hara-test;charset=UTF8','root','');
//        $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE users SET user_img = '{$_FILES["upfile"]["name"]}' WHERE user_id = '{$_SESSION["user_id"]}'" ;
      $res = $pdo->query($sql);
    }catch(PDOException $Exception){}
    $user_img = $_FILES["upfile"]["name"];
    $_SESSION["user_img"] = $user_img;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像をアップロード</title>
</head>
<body>

<p>id=<?php echo $_SESSION["user_id"]; ?></p>
   
    <img src='<?php echo "./img/mypage/test_id/" . $_FILES["upfile"]["name"]; ?>'>
    <a href="../index.php">top</a>
</body>
</html>