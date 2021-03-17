<?php
//データベースの接続と選択
$host = "2ebfe18cb345";
$username = "root";
$password = "password";
$dbname = "sample_db";

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}
