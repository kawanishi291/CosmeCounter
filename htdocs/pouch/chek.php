<?php
  session_start();
?>
<?php
  if(isset($_SESSION['user_id'])){
  }else{
    header("Location: ../register_func-master/index.php");
  }
include '../transaction/flag_2.php';
$id = 5;
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
    <title>アイテム新規登録</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>Make pouch</h1>
    </header>
    <div class="main">
        <h3>会員名：<?php
            echo $_SESSION['user_name'];
        ?></h3>
        <button onclick="location.href='../index.php'">Makeup Room</button>
        <button onclick="location.href='../pouch/pouch.php'">new item</button>
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
                <p class="text">id : <?= $id ?></p>
          </div>
            <ul class="link">
                <?php
                    include '../dbconnect/pdo_connect.php';
//                    $sql = "SELECT * FROM item_list ORDER BY genre";
                    $sql = "SELECT DISTINCT item_list.item_name, item_list.genre_img FROM item_list JOIN pouch ON item_list.item_name = pouch.genre WHERE pouch.user_id = {$id} AND pouch.flag NOT IN (1) ORDER BY item_list.genre";
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
        $sql = "SELECT * FROM pouch WHERE user_id = {$id} AND pouch.flag NOT IN (1) ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
            $a = substr($row['end_day'], 0, 4);
            $b = substr($row['end_day'], 5, 2);
            $s = $a.$b;
    ?>  
        <tr>
            <th class="t-image" id="<?= $row['time']?>">イメージ</th>
            <th class="t-item">アイテム名</th>
            <th class="t-genre">ジャンル</th>
            <th class="t-brand">ブランド</th>
            <th class="t-model">型番</th>
<!--            <th class="t-comment">コメント</th>-->
            <th class="t-end-day">期限</th>
        </tr>
        <tr>
            <td class="t-image"><img class="item-img" src="./img/mypage/pouch_id/<?= $row['item_img']?>"></td>
            <td class="t-item">
            <?php
                $br = "\n";
                if($row['comment'] == NULL){
                    echo $row['item_name'];
                }else{
                    echo $row['item_name'];
            ?>
                    <br>
                    <button class="" id="<?php echo $row['comment']?>" type="submit" value="" name="" onclick="comment(this)">コメントを表示</button>
                        <!--       コメントを表示（アラート発火）         -->
            <?php
                }
            ?>
                    <form method="post" action="./edit.php">
                        <button class="" type="submit" value="<?= $row['time']?>" name="time">編集</button>
                    </form>
            </td>
            <td class="t-genre"><?= $row['genre']?></td>
            <td class="t-brand"><?= $row['brand']?></td>
            <td class="t-model"><?= $row['model']?></td>
            <td class="t-end-day">
            <?php
                if($row['start_day'] == $row['end_day']){
                    echo "未登録";
                }elseif($row['flag'] == 2){
                    echo "<a class=red href=../calendar/index.php?ym=".$s.">".$row['end_day']."</a>";
                }elseif($row['flag'] == 0){
                    echo "<a class=normal href=../calendar/index.php?ym=".$s.">".$row['end_day']."</a>";
                }else{
//                    echo "<p class=orange>".$row['end_day']."</p>";
                    echo "<a class=orange href=../calendar/index.php?ym=".$s.">".$row['end_day']."</a>";
                }
            ?>
            </td>
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