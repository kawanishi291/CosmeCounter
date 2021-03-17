<?php
ob_start();
// ここから、register.phpと同様
session_start();
if( isset($_SESSION['user_id']) != ""){
	header("Location: ../index.php");
}
include_once 'dbconnect.php';
// ここまで、register.phpと同様
?>

<?php
if(isset($_POST['login'])) {

	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$user_password = $mysqli->real_escape_string($_POST['user_password']);

	// クエリの実行
	$query = "SELECT * FROM users WHERE user_id='$user_id'";
	$result = $mysqli->query($query);
	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}

	// パスワード(暗号化済み）とユーザーIDの取り出し
	while ($row = $result->fetch_assoc()) {
		$db_hashed_pwd = $row['user_password'];
		$user_id = $row['user_id'];
	}

	// データベースの切断
	$result->close();

	// ハッシュ化されたパスワードがマッチするかどうかを確認
	if (password_verify($user_password, $db_hashed_pwd)) {
		$query = "SELECT * FROM users WHERE user_id='$user_id'";
		$result = $mysqli->query($query);
		foreach ($result as $row) {
			$_SESSION['user_id'] = $user_id;
			$_SESSION['user_name'] = $row['user_name'];
			$_SESSION['user_img'] = $row['user_img'];
		}
		header("Location: ../index.php");
		exit;
	} else { ?>
		<div class="alert alert-danger" role="alert">会員番号とパスワードが一致しません。</div>
	<?php }
} ?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>login</title>
<link rel="stylesheet" href="../CSS/login.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<style>
header {
	position: relative;
	/* height: 50vh */
}
header {
	background: url(../images/header01.jpg) center / cover;
}
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload = function(){
            checkBrowser();
        }
    </script>
</head>
<body>
<div class="wrapper">
    <header>
	   <h1>Cosme Counter</h1>
    </header>
	<!-- <div class="box"> -->
		<form method="post">
			<div class="inbox">
				<h1 class="form-top">Login</h1>
				<div class="form-group">
					<input type="user_id"  class="form-control" name="user_id" placeholder="会員番号" required />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="user_password" placeholder="パスワード" required />
				</div>
				<button type="submit" class="btn" name="login">ログインする</button>
			 </div>
		</form>
	<div class="under">
		<a href="register.php">会員登録はこちら</a>
	</div>
    <script type="text/javascript">
        function checkBrowser(){
          var result = '不明';

          var agent = window.navigator.userAgent.toLowerCase();
          var version = window.navigator.appVersion.toLowerCase();

          if(agent.indexOf("msie") > -1){
            if (version.indexOf("msie 6.") > -1){
//              result = 'IE6';
            }else if (version.indexOf("msie 7.") > -1){
//              result = 'IE7';
            }else if (version.indexOf("msie 8.") > -1){
//              result = 'IE8';
            }else if (version.indexOf("msie 9.") > -1){
//              result = 'IE9';
            }else if (version.indexOf("msie 10.") > -1){
//              result = 'IE10';
            }else{
//              result = 'IE(バージョン不明)';
            }
          }else if(agent.indexOf("trident/7") > -1){
//            result = 'IE11';
          }else if(agent.indexOf("edge") > -1){
//            result = 'Edge';
          }else if (agent.indexOf("chrome") > -1){
            result = 'Chrome';
          }else if (agent.indexOf("safari") > -1){
            result = 'Safari';
          }else if (agent.indexOf("opera") > -1){
//            result = 'Opera';
          }else if (agent.indexOf("firefox") > -1){
//            result = 'Firefox';
          }

//          alert("お使いのブラウザは「" + result + "」です。");
// send.phpにおくりたいデータをjSON形式で書く
var browser = result;
console.log(browser);       
        
//ajaxで読み出し
$.ajax({
                    url:'./send.php',
                    type:'POST',
                    data: {browser}
                })
                // Ajaxリクエストが成功した時発動
                .done( (data) => {
                    $('.result').html(data);
                    console.log(data);
//                    alert("送信完了！\nレスポンスデータ：" + data);
                })
                // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
                    $('.result').html(data);
                    console.log(data);
                })
                // Ajaxリクエストが成功・失敗どちらでも発動
    .always( (data) => {

                });}
    </script>
    <div class="result"></div>
    </div>
</body>
</html>
