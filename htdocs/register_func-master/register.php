<?php
session_start();
if( isset($_SESSION['user']) != "") {
	// ログイン済みの場合はリダイレクト
	header("Location: home.php");
}

// DBとの接続
include '../dbconnect/pdo_connect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PHPの会員登録</title>
<link rel="stylesheet" href="../CSS/touroku.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<?php
// signupがPOSTされたときに下記を実行
if(isset($_POST['signup'])) {

	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$user_birthday = $_POST['user_birthday'];
	$user_password = $_POST['user_password'];
	$user_password = password_hash($user_password, PASSWORD_BCRYPT);
	$alert0 = "<script type='text/javascript'>alert('あなたの会員番号は";
    	$alert1 = "です。');</script>";
    	echo $alert0.$user_id.$alert1;
	echo ($user_name.$user_birthday);
	// POSTされた情報をDBに格納する
	// $sql = "INSERT INTO users(user_id,user_name,user_birthday,user_password) VALUES('$user_id','$user_name','$user_birthday','$user_password')";
	$sql = "INSERT INTO users(user_name,user_birthday,user_password) VALUES('$user_name','$user_birthday','$user_password')";
	if($pdo -> query($sql)) {  ?>
		<div class="alert alert-success" role="alert">登録しました</div>
		<?php } else { ?>
		<div class="alert alert-danger" role="alert">エラーが発生しました。</div>
		<?php
		var_dump($sql);
	}
} ?>
<div class="wrapper">
	<form method="post">
		<div class="inbox">
			<h1>会員登録フォーム</h1>
			<p>会員番号</p>
			<div class="form-group">
                <?php
                    include '../dbconnect/pdo_connect.php';
                    $sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";
                    $stmt = $pdo -> query($sql);
					foreach($stmt as $row){
                        $number = $row['user_id']+1;
                    }
					if ($number == ''){
						// echo ("no");
						$number = 1;
					}else{
						// echo ("yes");
					}
                ?>
                <?= $number?>
                <input type="hidden" class="form-control" name="user_id" value="<?= $number ?>">
			</div>
			<p>ニックネーム</p>
			<div class="form-group">
				<input type="text" class="form-control" name="user_name" placeholder="ニックネーム" required />
			</div>
            <p>誕生日</p>
            <div>
                <input type="date" class="form-control" name="user_birthday" required />
            </div>
			<p>パスワード</p>
			<div class="form-group">
				<input type="password" class="form-control" name="user_password" placeholder="パスワード" required />
			</div>
			<button type="submit" class="btn" name="signup">会員登録する</button>
			<a href="index.php">ログインはこちら</a>
        </div>
	</form>
    <p>※会員番号は忘れないようにして下さい！！</p>
</div>

</div>
</body>
</html>
