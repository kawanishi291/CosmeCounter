<?php
    session_start();
?>
<?php
    $data = $_POST['browser'];
    $_SESSION['browser'] = $data;
    echo $_SESSION['browser'];
?>