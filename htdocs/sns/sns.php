<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
　<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>チャットルーム</title>
    <link rel="stylesheet" type="text/css" href="../CSS/sns.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
        window.onload = function (){
            autoScroll();
            update();
        }
        function autoScroll(){
            window.location.hash = "point";
        }
        function update(){
            <?php
                include '../dbconnect/pdo_connect.php';
                $sql = "UPDATE chat SET flag = 1 WHERE user_id = {$_SESSION['member_id']} AND request_id = {$_SESSION['user_id']}";
            ?>
        }
</script>
</head>
<body>
<div class="all-wrapper">
    <?php
              if(isset($_POST["id"])){
                  $_SESSION['member_id'] = $_POST["id"];
              }else{
              }
            include '../dbconnect/pdo_connect.php';
    // 既読処理
            $sql = "UPDATE chat SET flag = 1 WHERE user_id = {$_SESSION['member_id']} AND request_id = {$_SESSION['user_id']}";
            $res = $pdo -> query($sql);
    // アイコンの取り出し
            $sql = "SELECT * FROM users WHERE {$_SESSION['member_id']} = user_id";
            $stmt = $pdo -> query($sql);
                foreach ($stmt as $row) { ?>
                    <img src="../img-upload/img/mypage/test_id/<?php echo "{$row['user_img']}";?>" class="profileimg-chat" onclick="js_alert()">
                <script>
                    function js_alert(){
                        alert("<?php echo $row['user_name']; ?>さん");
                    }
                </script>
                <?php
                }
                ?>
    <button class="btn" onclick="location.href='./sns.php'">更新</button>
    <button class="btn" onclick="location.href='./index.php'">投稿画面へ</button>
    <button class="btn" onclick="location.href='../index.php'">TOPへ</button>
    <?php 
    if( strcmp ($_SESSION['browser'], "Chrome") == 0 ){
        echo "<div class='wrapper'>" ;
    }else{
        echo "<div class='wrappers'>" ;
    }
    ?>
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
        <a name="point" id="point">　</a>
    </div>
    <form method="post" action="request.php">
                <p><input type="hidden" name="request_id" value="<?php echo $_SESSION['member_id'];?>"></p>
                <textarea type="text" required maxlength="255" name="chat" cols="60" rows="5" class="textbox"></textarea><br>
                <button name="send" type="submit">送信</button>        
    </form>
    
    <script>
        var browser = " ";
        setInterval(function send(){
        //ajaxで読み出し
        $.ajax({
                            url:'./ajaxsns.php',
                            type:'POST',
                            data: {browser}
                        })
                        // Ajaxリクエストが成功した時発動
                        .done( (data) => {
                            $('.wrapper').html(data);
//                            alert('成功');
//                            window.location.hash = "point";
                        })
                        // Ajaxリクエストが失敗した時発動
            .fail( (data) => {
                            $('.wrapper').html(data);
                            console.log(data);
                        })
                        // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {

                        });
        },1000);
    </script>
	<script>
        var browser = "u";
        setInterval(function send(){
        //ajaxで読み出し
        $.ajax({
                            url:'./ajaxsns.php',
                            type:'POST',
                            data: {browser}
                        })
                        // Ajaxリクエストが成功した時発動
                        .done( (data) => {
                            $('.wrappers').html(data);
//                            alert('成功');
//                            window.location.hash = "point";
                        })
                        // Ajaxリクエストが失敗した時発動
            .fail( (data) => {
                            $('.wrappers').html(data);
                            console.log(data);
                        })
                        // Ajaxリクエストが成功・失敗どちらでも発動
            .always( (data) => {

                        });
        },1000);
    </script>
</div>
</div>
</body>
</html>