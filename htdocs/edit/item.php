<?php
session_start();
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>ジャンル追加</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>ジャンル追加</h1>
    </header>
    <div class="main">
        <button onclick="location.href='../edit/brand.php'">ブランド追加</button>
        <button onclick="location.href='../index.php'">Makeup room</button>
        <button onclick="location.href='../pouch/pouch.php'">new item</button>
    </div>
    <table>
        <tr>
            <th>number</th>
            <th>item_name</th>
            <th>genre</th>
            <th>genre_name</th>
        </tr>
    <?php
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM item_list ORDER BY number";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
    ?>
        <tr>
            <td><?= $row['number']?></td>
            <td><?= $row['item_name']?></td>
            <td><?= $row['genre']?></td>
            <td><?= $row['genre_name']?></td>
        </tr>
    <?php
        }
    ?>
    </table>
    <div class="main">
        <form method="post" action="./itemup.php">
            <input type="text" name="number" value="<?= $row['number']+1?>" size="4" required readonly>
            <input type="text" name="item_name" placeholder="<?= $row['item_name']?>" required>
            <input type="text" name="genre" placeholder="<?= $row['genre']?>" size="4" required>
            <input type="text" name="genre_name" placeholder="<?= $row['genre_name']?>" required>
            <input type="submit" name="submit" value="submit">
        </form>
    </div>
</div>
</body>
</html>