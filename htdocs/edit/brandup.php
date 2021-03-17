<?php
include '../dbconnect/mysqli_connect.php';
    $number = $_POST['number'];
	$brand = $mysqli->real_escape_string($_POST['brand']);
?>
<?php
    header('Location: ../pouch/pouch.php');
    try{
        include '../dbconnect/pdo_connect.php';
        $sql = "INSERT INTO brand_list (number, brand) VALUES ('$number','$brand')";
        $pdo -> query($sql);
    }catch(PDOException $Exception){
        //$sql = "SELECT * FROM item_list";
        //$stmt = $pdo -> query($sql);
        //    foreach($stmt as $row){
        //    }
    }
    exit();
?>