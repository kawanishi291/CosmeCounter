<?php
session_start();

include '../dbconnect/pdo_connect.php';
    $sql = "UPDATE pouch SET flag = 3 WHERE user_id = '{$_SESSION["user_id"]}' AND flag BETWEEN 3 AND 9";
    $pdo -> query($sql);
// logout.php?logoutにアクセスしたユーザーをログアウトする
if(isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user_id']);
//    setcookie("id", "", time()-60);
	header("Location: ./index.php");
} else {
	header("Location: ./index.php");
}
