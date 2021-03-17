<?php
include '../dbconnect/mysqli_connect.php';
    $number = $_POST['number'];
	$item_name = $mysqli->real_escape_string($_POST['item_name']);
    $genre = $mysqli->real_escape_string($_POST['genre']);
    $genre_name = $mysqli->real_escape_string($_POST['genre_name']);
?>
<?php
    header('Location: ../pouch/pouch.php');
    try{
        include '../dbconnect/pdo_connect.php';
        $sql = "INSERT INTO item_list (number, item_name, genre, genre_name) VALUES ('$number','$item_name','$genre','$genre_name')";
        $pdo -> query($sql);
    }catch(PDOException $Exception){
        //$sql = "SELECT * FROM item_list";
        //$stmt = $pdo -> query($sql);
        //    foreach($stmt as $row){
        //    }
    }
    exit();
?>