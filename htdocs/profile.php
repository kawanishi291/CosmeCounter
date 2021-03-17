<?php
  session_start();
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>プロフィール編集</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>my profile</h1>
    </header>
    <div class="main">
        <h3>会員名：<?php
            echo $_SESSION['user_name'];
        ?></h3>
        <div class="profile">
            <img src='<?php echo "./img-upload/img/mypage/test_id/".$_SESSION['user_img']; ?>'>
        </div>
        <form action="./img-upload/next.php" method="post" enctype="multipart/form-data">
	        <label>画像のアップロード（最大1MB）</label>
	        <p><input type="file" name="upfile" size="80px" id="upload" accept="image/*"></p>
                <dl>
                    <p>IDは<?= $_SESSION["user_id"] ?></p>
                </dl>
	        <p><input type="submit" name="submit" value="Upload" /></p>
        </form>
    </div>
</div>
</body>
</html>