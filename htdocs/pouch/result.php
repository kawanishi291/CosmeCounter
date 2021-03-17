<?php
    header('Content-type: text/plain; charset= UTF-8');
    if(isset($_POST['class'])){
        $cls = $_POST['class'];
        $str = "AJAX REQUEST SUCCESS\nclass:".$cls."\n";
        $result = nl2br($str);
//        echo $result;
    }else{
        echo 'FAIL TO AJAX REQUEST';
    }
?>
<?php
    session_start();
?>
    <table>
        <tr>
            <th class="t-image">イメージ</th>
            <th class="t-genre">アイテム名</th>
            <th class="t-end-day">ジャンル</th>
            <th class="t-end-day">ブランド</th>
            <th class="t-end-day">型番</th>
<!--            <th class="t-comment">コメント</th>-->
            <th class="t-genre">期限</th>
        </tr>
    <?php
        include '../dbconnect/pdo_connect.php';
        $sql = "SELECT * FROM pouch WHERE user_id = {$_SESSION['user_id']} ORDER BY end_day ASC";
        $stmt = $pdo -> query($sql);
        foreach($stmt as $row){
    ?>
        <tr>
            <td class="t-image"><img class="item-img" src="./img/mypage/pouch_id/<?= $row['item_img']?>"></td>
            <td class="t-genre">
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
                    
                        <button class="search" id="class" name="class" value="<?= $row['item_name']?>">詳細</button>
                        <!--       詳細（下段に全種類表示）         -->
                <script type="text/javascript">
                    $(function(){
                        // Ajax button click
                        $('.search').on('click',function(){
                            $.ajax({
                                url:'./result.php',
                                type:'POST',
                                data:{
                                    'class':$('#class').val()
                                }
                            })
                            // Ajaxリクエストが成功した時発動
                            .done( (data) => {
                                $('.result').html(data);
                                console.log(data);
                            })
                            // Ajaxリクエストが失敗した時発動
                            .fail( (data) => {
                                $('.result').html(data);
                                console.log(data);
                            })
                            // Ajaxリクエストが成功・失敗どちらでも発動
                            .always( (data) => {

                            });
                        });
                    });
                </script>
                
                    <form method="post" action="./edit.php">
                        <button class="" type="submit" value="<?= $row['time']?>" name="time">編集</button>
                    </form>
            </td>
            <td class="t-end-day"><?= $row['genre']?></td>
            <td class="t-end-day"><?= $row['brand']?></td>
            <td class="t-end-day"><?= $row['model']?></td>
<!--
            <td class="t-comment">
                <?php
                if($row['comment'] == NULL){
                    echo "なし";

                }else{
                    echo $row['comment'];
                }
                ?>
            </td>
-->
            <td class="t-genre"><?= $row['end_day']?></td>
        </tr>
        <tr class="result"></tr>
    <?php
//        var_dump( $row );
    ?>
        
    <?php
        }
    ?>
    </table>