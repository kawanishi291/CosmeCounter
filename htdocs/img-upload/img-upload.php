<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像をアップロード</title>
</head>
<body>
    <div>
        <form action="./next.php" method="post" enctype="multipart/form-data">
	        <label>画像のアップロード（最大1MB）</label>
	        <p><input type="file" name="upfile" size="80px" id="upload" accept="image/*"></p>
                <dl>
                    <p>IDは<?= $_SESSION["user_id"] ?></p>
                </dl>
	        <p><input type="submit" name="submit" value="Upload" /></p>
        </form>
</div>
</body>
</html>