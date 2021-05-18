<?php 
    include_once('config.php');
    session_start();
    $email = $_COOKIE['email'];
    $skor = $_SESSION['skor'];
    // echo $skor;
    if ($_SESSION['live'] === 0 && isset($_COOKIE['username'])){
        $sql = "UPDATE player SET skor='$skor' WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            // echo "Record updated successfully";  
        } else {
            echo "Error updating record: " . $conn->error;
        }
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
    <?php if($_GET['gameOver'] === 'true') { ?>
        <div>
            <center>Hello, <?= $_COOKIE['username'] ?>... Sayang permainan sudah selesai. Semoga kali lain bisa lebih baik. Score Anda : 
            <?= $skor            
            ?></center> 
        </div>
    <?php } else { ?>
        <div>
            <h1><center>Top 10 Score</center> </h1>
            <div>
                <table border="1" align="center">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Score</td>
                    </tr>
                    <?php 
                        $sql = "SELECT id, nama, email, skor 
                                FROM player 
                                ORDER BY skor DESC 
                                LIMIT 10";
                        $result = $conn->query($sql);
                        $no = 1;
                        if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>". $no. "</td> <td>" . $row['nama'] . "</td><td>" . $row['email'] . "</td><td>" . $row['skor'] . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        }else{
                            echo "0 results";
                        }
                    ?>
                </table>    
            </div>
        </div>
    <?php } ?>
    <?php
        $_SESSION['skor'] = 0;
        $_SESSION['live'] = 5;
        $_SESSION['ready'] = false;
        $conn->close();
    ?>
    <br>
    <br>
    <center>Mau main lagi??? <a href="login.php">Mau dong!!!</a> </center> 
</body>
</html>