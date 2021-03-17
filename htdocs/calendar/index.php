<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="../CSS/master.css">
  <script type="text/javascript" src="../JavaScript/jquery-3.3.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="../JavaScript/memo.js"></script>
  <?php include('./config.php'); ?>
  <title>Calender</title>
</head>
<body>
  <div class="top">
    <?php
    echo '<a href="index.php?ym='.$lastmonth.'">←</a>';
    echo $year; ?>年<?php echo $month;
    ?>月のカレンダー
    <?php
    echo '<a href="index.php?ym='.$nextmonth.'">→</a>';
    ?>
  </div>
<!-- ハンバーガーメニュー -->
        <div class="menu-trigger" href="">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <nav>
            <ul class="link">
                <a href="../index.php" class="none" id="top">Makeup room</a>
<!--            </ul>-->
        <?php
            include '../dbconnect/pdo_connect.php';
            $sql = "SELECT * FROM item_list JOIN pouch ON item_list.item_name = pouch.genre WHERE pouch.user_id = {$_SESSION['user_id']} AND pouch.flag NOT IN (1) ORDER BY pouch.end_day ASC";
            $stmt = $pdo -> query($sql);
            foreach($stmt as $row){
                $a = substr($row['end_day'], 0, 4);
                $b = substr($row['end_day'], 5, 2);
                $s = $a.$b;
        ?>
            <li>
<!--                <img class="genreimgs" src="../image/<?= $row['genre_img']?>">-->
                <a href="index.php?ym=<?= $s?>" class="none"><?= $row['item_name']?></a>
            </li>
        <?php
            }
        ?>
        </ul>
        </nav>
        <div class="overlay"></div>
<!-- ハンバーガーメニュー -->
<br>
<table>
    <tr>
        <th>日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th>土</th>
    </tr>

    <tr>
    <?php $cnt = 0; ?>
    <?php foreach ($calendar as $key => $value): ?>

        <td>
        <?php $cnt++; ?>
        <?php echo '<span class="date">'.$value['day'].'</span>'; ?>
        <?php
	  include('../dbconnect/pdo_connect.php');
          // echo $year.'-'.$month.'-'.$value["day"];
          $day = $value["day"];
          $id = $_SESSION['user_id'];
          if($month < 10){
              $yue = "0".$month;
          }else{
              $yue = $month;
          }
          if($day < 10){
              $ri = "0".$day;
          }else{
              $ri = $day;
          }
          $sql = "SELECT * FROM item_list RIGHT OUTER JOIN pouch ON item_list.item_name = pouch.genre WHERE pouch.end_day = '$year-$month-$day' AND pouch.user_id = {$_SESSION['user_id']} OR pouch.start_day = '$year-$month-$day' AND pouch.user_id = {$_SESSION['user_id']}";
//        $sql = "SELECT * FROM  RIGHT OUTER JOIN users ON chat.user_id = users.user_id WHERE chat.user_id = {$_SESSION['member_id']} AND chat.request_id = {$_SESSION['user_id']} OR chat.user_id = {$_SESSION['user_id']} AND chat.request_id = {$_SESSION['member_id']} ORDER BY chat.time ASC";
          // echo $sql;
          $stmt = $pdo->query($sql);
          // var_dump($stmt);
          echo "<ul class = 'e-item'>";
          foreach ($stmt as $row){
              if($row['end_day'] == $year."-".$yue."-".$ri){
          ?>
            <a class="e-item" href="../pouch/index.php#<?= $row['time']?>"><?= $row['item_name']?></a>
          <?php
              }else{
          ?>
            <a class="s-item" href="../pouch/index.php#<?= $row['time']?>"><?= $row['item_name']?></a>
          <?php
              }
          ?>
            <img src="../image/<?= $row['genre_img']?>">
          <?php
          }
          echo "</ul>";
          ?>
        </td>

    <?php if ($cnt == 7): ?>
    </tr>
    <tr>
    <?php $cnt = 0; ?>
    <?php endif; ?>

    <?php endforeach; ?>
    </tr>
</table>
</body>
</html>
