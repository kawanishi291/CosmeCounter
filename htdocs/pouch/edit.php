<?php
    session_start();
?>
<?php
    include '../dbconnect/pdo_connect.php';
    $id = $_POST['time'];
    $_SESSION["ID"] = $id;
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript" src="../JavaScript/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../JavaScript/memo.js"></script>
    <link rel="stylesheet" href="../CSS/pouch.css">
    <title>アイテム編集</title>
</head>
<body>
<div class="wrapper">
    <header>
        <h1>Edit Item</h1>
    </header>
    <div class="main">
    <?php
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} AND time = '$id'";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
//            echo('<pre>');
//            var_dump( $row );
//            echo('</pre>');
            $_SESSION["item_name"] = $row['1'];
            $_SESSION["start_day"] = $row['2'];
            $_SESSION["end_day"] = $row['3'];
            $_SESSION["genre"] = $row['4'];
            $_SESSION["brand"] = $row['5'];
            $_SESSION["model"] = $row['6'];
            $_SESSION["item_img"] = $row['7'];
            $_SESSION["comment"] = $row['8'];
            $_SESSION["flag"] = $row['9'];
            $_SESSION["time"] = $row['10'];
        }
    ?>
        <h3>会員名：<?php
            echo $_SESSION['user_name'];
        ?></h3>
        <button onclick="location.href='../index.php'">Makeup room</button>
        <button onclick="location.href='../trashbox/index.php'">Trash box</button>

        
    <form method="post" action="./editup.php" enctype="multipart/form-data" id="phone">
        <li>イメージ:
            <input type="file" name="upfile" size="80px" id="upload" placeholder="<?= $_SESSION["item_img"]?>" accept="image/*">
            <img src="../pouch/img/mypage/pouch_id/<?= $_SESSION["item_img"]?>" height="100px" width="100px">
        </li>
        <li>アイテム名:
            <input type="text"  class="" name="item_name" placeholder="<?= $_SESSION["item_name"]?>" />
        </li>
        <li>使用開始日:
            <input type="date" name="day" value="<?= $_SESSION["start_day"]?>" />
            <?= $_SESSION["start_day"]?>
        </li>
        <li>使用期限日:
            <input type="date" name="end_day" value="<?= $_SESSION["end_day"]?>" />
            <?= $_SESSION["end_day"]?>
        </li>
        <li>ジャンル:
            <select name="genre">
        <?php
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT * FROM item_list ORDER BY number";
            $stmt = $pdo -> query($sql);
            foreach($stmt as $row){
        ?>
                <option value="<?= $row['item_name']?>" <?php
                if($row['item_name'] == $_SESSION["genre"]){
                    echo "selected";
                }else{
                    
                }
                ?>><?= $row['item_name']?></option>
        <?php
            }
        ?>
            </select>
        </li>
        <li>ブランド:
            <select name="brand">
        <?php
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT * FROM brand_list ORDER BY number";
            $stmt = $pdo -> query($sql);
            foreach($stmt as $row){
        ?>
                <option value="<?= $row['brand']?>" <?php
                if($row['brand'] == $_SESSION["brand"]){
                    echo "selected";
                }else{
                    
                }
                ?>><?= $row['brand']?></option>
        <?php
            }
        ?>
            </select>
        </li>
        <li>型番:
            <input type="text"  class="" name="model" placeholder="<?=$_SESSION["model"]?>" />
        </li>
            
        <li>コメント:
            <br><textarea name="comment" rows="4" cols="40" placeholder="<?php
                if($_SESSION["comment"] != NULL){
                    echo $_SESSION["comment"];
                }else{
                    echo "ここに自由にメモして下さい!";
                }
            ?>" maxlength="256"></textarea>
        </li>
        <input type="submit" name="submit" value="Upload" />
<!--        <input type="reset" value="リセット">-->
    </form>
        
    <form method="post" action="./editup.php" enctype="multipart/form-data" id="pc">
        <table>
            <tr>
                <th>イメージ</th>
                <th>アイテム名</th>
                <th>使用開始日</th>
            </tr>
            <tr>
                <td>
                    <input type="file" name="upfile" size="80px" id="upload" placeholder="<?= $_SESSION["item_img"]?>" accept="image/*">
                    <img src="../pouch/img/mypage/pouch_id/<?= $_SESSION["item_img"]?>" height="100px" width="100px">
                </td>


                <td>
                    <input type="text"  class="" name="item_name" placeholder="<?= $_SESSION["item_name"]?>" style="width:400px" />
                </td>

                <td>
                    <input type="date" name="day" value="<?= $_SESSION["start_day"]?>" />
                    <br><?= $_SESSION["start_day"]?>
                </td>
            </tr>
            <tr>
                <th>使用期限日</th>
                <th>ジャンル</th>
                <th>ブランド</th>
            </tr>
            <tr>
                <td>
                    <input type="date" name="end_day" value="<?= $_SESSION["end_day"]?>" />
                    <br><?= $_SESSION["end_day"]?>
                </td>
                <td>
                    <select name="genre">
                <?php
                    include '../dbconnect/pdo_connect.php';
                    $sql = "SELECT * FROM item_list ORDER BY number";
                    $stmt = $pdo -> query($sql);
                    foreach($stmt as $row){
                ?>
                        <option value="<?= $row['item_name']?>" <?php
                        if($row['item_name'] == $_SESSION["genre"]){
                            echo "selected";
                        }else{

                        }
                        ?>><?= $row['item_name']?></option>
                <?php
                    }
                ?>
                    </select>
                </td>
                <td>
                    <select name="brand">
                <?php
                    include '../dbconnect/pdo_connect.php';
                    $sql = "SELECT * FROM brand_list ORDER BY number";
                    $stmt = $pdo -> query($sql);
                    foreach($stmt as $row){
                ?>
                        <option value="<?= $row['brand']?>" <?php
                        if($row['brand'] == $_SESSION["brand"]){
                            echo "selected";
                        }else{

                        }
                        ?>><?= $row['brand']?></option>
                <?php
                    }
                ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>型番</th>
                <th>コメント</th>
                <th>upload</th>
            </tr>
            <tr>
                <td>
                    <input type="text"  class="" name="model" placeholder="<?=$_SESSION["model"]?>" />
                </td>
                <td>
                    <textarea name="comment" style="width:500px" rows="6" placeholder="<?php
                        if($_SESSION["comment"] != NULL){
                            echo $_SESSION["comment"];
                        }else{
                            echo "ここに自由にメモして下さい!";
                        }
                    ?>"></textarea>
                </td>
                <td>
                    <input type="submit" name="submit" value="Upload" />
                </td>
            </tr>

    <!--        <input type="reset" value="リセット">-->
        </table>
        </form>
    
    <input type="button" onclick="location.href='./delete.php'" value="Delete">
    </div>
    
</div>
</body>
</html>