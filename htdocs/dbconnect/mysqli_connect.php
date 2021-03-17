<?php
//データベースの接続と選択
$host = "mysqlのコンテナID";
$username = "root";
$password = "password";
$dbname = "sample_db";

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
	error_log($mysqli->connect_error);
	exit;
}
