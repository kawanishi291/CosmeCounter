<?php
    session_start();
?>
<?php
            $stack = array(0);
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT user_id, request_id, chat FROM chat WHERE user_id = {$_SESSION['user_id']} OR request_id = {$_SESSION['user_id']} ORDER BY time DESC";
            $stmt = $pdo -> query($sql);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['request_id'] == $_SESSION['user_id']){
                    $_SESSION['search_id'] = $row['user_id'];
                }else{
                    $_SESSION['search_id'] = $row['request_id'];
                }
                if(in_array($_SESSION['search_id'], $stack)){
                }else{
                    array_push($stack, $_SESSION['search_id']);
                    $query = "SELECT user_id, user_name, user_img FROM users WHERE user_id = {$_SESSION['search_id']}";
                    $res = $pdo -> query($query);
                    foreach($res as $data){
                    if($data['user_id'] == $_SESSION['user_id']){
                    }else{
        ?>
<!--                            <form method="post" action="browse-chat.php">-->
                                <form method="post" action="sns.php" class="form">
                                <img src="../img-upload/img/mypage/test_id/<?php echo "{$data['user_img']}";?>" class="profileimgs">
                                <input type="hidden" value="<?php echo $data['user_id']; ?>" name="id">
                        <?php
                            $_SESSION['member_id'] = $data['user_id'];
                        ?>
                                <p class="memberbtn"><?php echo $data['user_name']; ?></p>
                        <?php
                            include '../dbconnect/pdo_connect.php';
                            $sql = "SELECT COUNT(*) FROM chat WHERE flag = 0 AND user_id = {$data['user_id']} AND request_id = {$_SESSION['user_id']}";
                            $ans = $pdo -> query($sql);
//                            $count = $ans->fetch(PDO::FETCH_ASSOC);
                            while($count = $ans->fetch(PDO::FETCH_ASSOC)){
                                if($count['COUNT(*)'] == 0){
                                }else{
                        ?><p class="count"><?php echo $count['COUNT(*)']; ?></p>
                        <?php
                                }
                        } ?>
                            <input name="send" type="submit" value="<?php echo $row['chat']; ?>" class="rireki">
                            </form>
            <?php
                        }
                }
            }
            }
            ?>