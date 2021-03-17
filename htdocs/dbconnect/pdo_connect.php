<?php
//データベースの接続と選択
$hostdbname = 'mysql:host=mysqlのコンテナID;dbname=sample_db;charset=UTF8';
$username = "root";
$password = "password";
$pdo = new PDO($hostdbname, $username, $password);
$pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
