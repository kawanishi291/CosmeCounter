<?php
  session_start();
?>
<?php
include './dispose.php';
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript" src="../JavaScript/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../JavaScript/memo.js"></script>
    <link rel="stylesheet" href="../CSS/pouch.css">
    <title>Trash Box</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>Trash Box</h1>
    </header>
    <div class="main">
        <h3>会員名：<?php
            echo $_SESSION['user_name'];
        ?></h3>
        <button onclick="location.href='../index.php'">Makeup room</button>
<!-- ハンバーガーメニュー -->
        <div class="menu-trigger" href="">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav>
          <div class="profile">
          <p class="text">my profile</p>
                <img src='<?php echo "../img-upload/img/mypage/test_id/" . $_SESSION["user_img"]; ?>' class="profileimg" width="100px" height="100px">
                <p class="text">name : <?= $_SESSION["user_name"] ?></p>
                <p class="text">id : <?= $_SESSION["user_id"] ?></p>
          </div>
            <ul class="link">
                <?php
                    include '../dbconnect/pdo_connect.php';
//                    $sql = "SELECT * FROM item_list ORDER BY genre";
                    $sql = "SELECT DISTINCT item_list.item_name, item_list.genre_img FROM item_list JOIN pouch ON item_list.item_name = pouch.genre WHERE pouch.user_id = {$_SESSION['user_id']} AND pouch.flag = 1 ORDER BY item_list.genre";
                    $stmt = $pdo -> query($sql);
                    foreach($stmt as $row){
                ?>
            <li>
                <form method="post" action="./select.php">
                    <img class="genreimgs" src="../image/<?= $row['genre_img']?>" height="120px" width="120px">
                    <input class="select" type="submit" value="<?= $row['item_name']?>" name="item_name">
                <?php
                    }
                ?>
                </form>
            </li>
            </ul>
        </nav>
        <div class="overlay"></div>
<!-- ハンバーガーメニュー -->
    </div>
    <table>
    <?php
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} AND pouch.flag = 1 ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
    ?>  
        <tr>
            <th class="t-image">イメージ</th>
            <th class="t-item">アイテム名</th>
            <th class="t-genre">ジャンル</th>
            <th class="t-brand">ブランド</th>
            <th class="t-model">型番</th>
<!--            <th class="t-comment">コメント</th>-->
            <th class="t-end-day">期限</th>
        </tr>
        <tr>
            <td class="t-image"><img class="item-img" src="../pouch/img/mypage/pouch_id/<?= $row['item_img']?>"></td>
            <td class="t-item">
            <?php
                $br = "\n";
                if($row['comment'] == NULL){
                    echo $row['item_name'];
                }else{
                    echo $row['item_name'];
            ?>
                    <br>
                    <button class="" id="<?php echo 'コメント'. $br .$row['comment']?>" type="submit" value="" name="" onclick="comment(this)">コメントを表示</button>
                        <!--       コメントを表示（アラート発火）         -->
            <?php
                }
            ?>
            </td>
            <td class="t-genre"><?= $row['genre']?></td>
            <td class="t-brand"><?= $row['brand']?></td>
            <td class="t-model"><?= $row['model']?></td>
            <td class="t-end-day"><?= $row['end_day']?></td>
        </tr>
    <tr class="th-phone">
        <th class="s-genre">ジャンル</th>
        <th class="s-brand">ブランド</th>
        <th class="s-model">型番</th>
    </tr>
    <tr class="th-phone">
        <td class="s-genre"><?= $row['genre']?></td>
        <td class="s-brand"><?= $row['brand']?></td>
        <td class="s-model"><?= $row['model']?></td>
    </tr>
    <?php
//        var_dump( $row );
    ?>
        
    <?php
        }
    ?>
    </table>
    <script>
        function comment(ele){
            var id_val = ele.id;
            alert(id_val);
        }
    </script>
</div>
</body>
</html>