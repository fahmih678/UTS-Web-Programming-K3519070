<?php 

    session_start();
    include_once('auth.php');
    auth();
    include('game.php');
    // menset angka random untuk ditebak
    if (isset($_POST['startGame'])){
        $_SESSION['ready'] = true; 
    }
    if ($_SESSION['live'] > 0){
        if(!isset($_SESSION['hasilRandom'])){
            $_SESSION['angkaRandom1'] = rand(1, 100);
            $_SESSION['angkaRandom2'] = rand(1, 100);
            
            function hasilRandom($rand1, $rand2){
                $_SESSION['hasilRandom'] = $rand1 + $rand2;
                return $_SESSION['hasilRandom'];
            }
            $hasil = hasilRandom($_SESSION['angkaRandom1'], $_SESSION['angkaRandom2']);
        } elseif (isset($_SESSION['statusJawaban'] )){
            if ($_SESSION['statusJawaban'] === "Benar") {
                $_SESSION['skor'] +=10;
            } elseif ($_SESSION['statusJawaban'] === 'Salah'){
                $_SESSION['skor'] -=2;
                $_SESSION['live'] -=1;
            }
            unsetSession();
        }
        $hasil = $_SESSION['hasilRandom'];
    } else{
        header("Location: topten.php?gameOver=true");
    }

    
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game hitung</title>
</head>
<body>
    <div>
        <h1>Game Penjumlahan</h1>
    </div>
<?php if(!$_SESSION['ready']) { ?>
    <div>
        
        <h2>Hallo, <?= $_COOKIE['username']; ?>, selamat datang kembali di permainan ini!!!</h2>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <button type="submit" name="startGame">[Start Game]</button><br>
            
        </form>
        <form action="login.php" method="POST">
            <p> Bukan Anda? <button type="submit" name="loginAgain">klik disini</button>
        </form>
    </div>
    <div>
        <form action="topten.php" method="GET">
            <button type="submit" name="gameOver" value="false">
                Lihat top 10 skor
            </button>  
        </form>
    </div>
<?php } else { ?>
    <div>
        <p><b>Hello <?= $_COOKIE['username']; ?>, tetap semangat ya... you can do the best</b>
        <br>Lives: <?= $_SESSION['live']; ?> | Skor: <?= $_SESSION['skor']; ?></p> 
       
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="inputJawaban">Berapakah <?= $_SESSION['angkaRandom1'] . ' + ' . $_SESSION['angkaRandom2'] .' =' ?> </label>
            <input type="number" name="angkaJawaban" id="inputJawaban" placeholder="Jawaban anda" required>

            <button type="submit" name="submitJawaban">Jawab</button>
            <?php
                // echo $hasil;
            ?>
        </form>
        <br>
    </div>
<?php } ?>
    
<?php 
    // jika ada angka random
    if (isset($_SESSION['angkaRandom1']) && isset($_SESSION['angkaRandom2'])) {
        // jika ada Jawaban sudah tersubmit dan terdapat angka Jawaban user
        if (isset($_POST['submitJawaban']) && isset($_POST['angkaJawaban'])) {
            $angkaJawaban = intval($_POST['angkaJawaban']);
            // mencek apakah angka Jawaban benar, terlalu besar atau terlalu kecil
            if ($angkaJawaban === $hasil) {
                // angka Jawaban benar
                $_SESSION['statusJawaban'] = 'Benar';               
                echo "Hello " . $_COOKIE['username'] . " Selamat ya… , Jawaban anda Benar<br>";
                echo "Skor: +10";
                

            } else {
                $_SESSION['statusJawaban'] = 'Salah';
                // angka Jawaban terlalu besar atau terlalu kecil
                echo "Hello ". $_COOKIE['username'] .", sayang jawaban Anda salah… tetap semangat ya !!!,<br>jawaban yang benar adalah = ". $hasil ."<br>";
                echo "Lives: -1 | Skor: -2";
            }
            echo "<br><br><a href='index.php'>[Soal Selanjutnya]</a>";

        }
    } else {  
        echo "Menset angka random";
    };
?>
</body>
</html>