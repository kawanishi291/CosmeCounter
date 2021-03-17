<?php
    session_start();
    $data = $_POST['browser'];
?>

    <?php
//              if(isset($_POST["id"])){
//                  $_SESSION['member_id'] = $_POST["id"];
//              }else{
//              }
            include '../dbconnect/pdo_connect.php';
    // 既読処理
            $sql = "UPDATE chat SET flag = 1 WHERE user_id = {$_SESSION['member_id']} AND request_id = {$_SESSION['user_id']}";
            $res = $pdo -> query($sql);
    // アイコンの取り出し
            $sql = "SELECT * FROM users WHERE {$_SESSION['member_id']} = user_id";
            $stmt = $pdo -> query($sql);
                foreach ($stmt as $row) { ?>
                    <img src="../img-upload/img/mypage/test_id/<?php echo "{$row['user_img']}";?>" class="profileimg-chat" onclick="js_alert()">
                <?php
                }
                ?>
<!--<div class="wrapper">-->
        <?php
                $today = 0;
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM chat RIGHT OUTER JOIN users ON chat.user_id = users.user_id WHERE chat.user_id = {$_SESSION['member_id']} AND chat.request_id = {$_SESSION['user_id']} OR chat.user_id = {$_SESSION['user_id']} AND chat.request_id = {$_SESSION['member_id']} ORDER BY chat.time ASC";
            $stmt = $pdo -> query($sql);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($today != substr($row['time'], 0, 10)){
                        $today = mb_substr($row['time'], 0, 10);
                        $month = substr($row['time'], 5, 1);
                        $day = substr($row['time'], 8, 1);
                        if($month == "0" and $day == "0"){
                            // 月、日が一桁
                            echo '<p class="today">'.substr($row['time'], 6, 2);
                            echo substr($row['time'], 9, 1).'</p>';
                        }elseif($month == "0" and $day != "0"){
                            // 月が一桁,日が二桁
                            echo '<p class="today">'.substr($row['time'], 6, 4);
                        }elseif($month != "0" and $day != "0"){
                            // 月、日が二桁
                            echo '<p class="today">'.substr($row['time'], 5, 5);
                        }else{
                            // 月が二桁, 日が一桁
                            echo '<p class="today">'.substr($row['time'], 5, 3);
                            echo substr($row['time'], 9, 1).'</p>';
                        }
                    }else{
                        $today = mb_substr($row['time'], 0, 10);
                    }
        if($row['user_id'] == $_SESSION['user_id']){?>
        <div class="chatbox">
        <div class="my">
        <?php
            echo '<p class="time">';
//            echo $row['time'];
            $today = mb_substr($row['time'], 0, 10);
            echo substr($row['time'], 5);
            echo '</p><p class="name">';
            echo $row['user_name'];
            echo 'さんからのメッセージ</p><p class="chat">';
            echo $row['chat'];
            echo "</p>";?>
        </div><?php
        }else{?>
<!--            <img src="../img-upload/img/mypage/test_id/<?php echo "{$row['user_img']}";?>" class="profileimgs" width="60px" height="60px">-->
        <div class="you">
        <?php
            echo '<p class="time">';
//            echo $row['time'];
            $today = mb_substr($row['time'], 0, 10);
            echo mb_substr($row['time'], 5);
            echo '</p><p class="name">';
            echo $row['user_name'];
            echo 'さんからのメッセージ</p><p class="chat">';
            echo $row['chat'];
            echo "</p>";
        }?></div><?php
        }
        ?>
        <a name="point" id="point">　</a></div>
<!--</div>-->