<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>ブランド追加</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>ブランド追加</h1>
    </header>
    <div class="main">
        <button onclick="location.href='../edit/item.php'">ジャンル追加</button>
        <button onclick="location.href='../index.php'">Makeup room</button>
        <button onclick="location.href='../pouch/pouch.php'">new item</button>
    </div>
    <table>
        <tr>
            <th>number</th>
            <th>brand</th>
        </tr>
    <?php
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM brand_list ORDER BY number";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
    ?>
        <tr>
            <td><?= $row['number']?></td>
            <td><?= $row['brand']?></td>
        </tr>
    <?php
        }
    ?>
    </table>
    <div class="main">
        <form method="post" action="./brandup.php">
            <input type="text" name="number" value="<?= $row['number']+1?>" required readonly>
            <input type="text" name="brand" placeholder="<?= $row['brand']?>" required>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</div>
</body>
</html>