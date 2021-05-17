<?php 
    include_once('config.php');
    session_start();
    $email = $_COOKIE['email'];
    $skor = $_SESSION['skor'];
    echo $skor;
    $sql = "UPDATE player SET skor='$skor' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        $_SESSION['skor'] = 0;
        $_SESSION['live'] = 5;
        $_SESSION['ready'] = false;
    } else {
        echo "Error updating record: " . $conn->error;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall of Fame</title>
</head>
<body>
    Top 10 skor
    <a href="login.php">Main Lagi</a>
</body>
</html>