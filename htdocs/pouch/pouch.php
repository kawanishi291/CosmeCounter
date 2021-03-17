<?php
  session_start();
?>
<?php
    date_default_timezone_set('Asia/Tokyo');
//    echo date("Y/m/d - M (D) H:i:s");
//    echo date("Y/m/d/ H:i:s");
    $date = date("Y/m/d/ H:i:s");
    $_SESSION["time"] = $date;
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>アイテム新規登録</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>new Item</h1>
    </header>
    <div class="main">
        <h3>会員名：<?php
            echo $_SESSION['user_name'];
        ?></h3>
        <button onclick="location.href='../index.php'">Makeup Room</button>
        <p>TIME:<?= $_SESSION['time']?></p>
    </div>
    <form method="post" action="./update.php" enctype="multipart/form-data">
        <li>イメージ:
            <input type="file" name="upfile" size="80px" id="upload" accept="image/*" required />
        </li>
        <li>アイテム名:
            <input type="text"  class="" name="item_name" placeholder="商品名" required />
        </li>
        <li>使用開始日:
            <input type="date" name="day" placeholder="<?=date("Y/m/d")?>" required />
        </li>
        <li>使用期限:
            <select name="year">
                <?php
                for($y = 0; $y <= 5; $y++){?>
                    <option value="<?= $y?>"><?= $y?>年</option>
                <?php
                }
                ?>
            </select>
            <select name="month">
                <?php
                for ($m = 0; $m <= 11; $m++){
                ?>
                <option value="<?= $m?>"><?= $m%12?>ヶ月</option>
                <?php
                }
                ?>
            </select>
        </li>
        <li>ジャンル:
            <select name="genre">
        <?php
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT * FROM item_list ORDER BY number";
            $stmt = $pdo -> query($sql);
            foreach($stmt as $row){
        ?>
                <option value="<?= $row['item_name']?>"><?= $row['item_name']?></option>
        <?php
            }
        ?>
            </select>
            <button onclick="location.href='../edit/item.php'">その他</button>
        </li>
        <li>ブランド:
            <select name="brand">
        <?php
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT * FROM brand_list ORDER BY number";
            $stmt = $pdo -> query($sql);
            foreach($stmt as $row){
        ?>
                <option value="<?= $row['brand']?>"><?= $row['brand']?></option>
        <?php
            }
        ?>
            </select>
            <button onclick="location.href='../edit/brand.php'">その他</button>      
        </li>
        <li>型番:
            <input type="text"  class="" name="model" placeholder="型番" />
        </li>
            
        <li>コメント:
            <br><textarea name="comment" rows="4" cols="40" placeholder="ここに自由にメモして下さい!" maxlength="256"></textarea>
        </li>
        <input type="submit" name="submit" value="Upload" />
    </form>
</div>
</body>
</html>