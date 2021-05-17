<?php 

    session_start();
    include_once('auth.php');
    auth();
    include('game.php');
    // menset angka random untuk ditebak
    

    
    if(!isset($_SESSION['hasilRandom'])){
        $_SESSION['angkaRandom1'] = rand(1, 100);
        $_SESSION['angkaRandom2'] = rand(1, 100);
        
        function hasilRandom($rand1, $rand2){
            $_SESSION['hasilRandom'] = $rand1 + $rand2;
            return $_SESSION['hasilRandom'];
        }
        $hasil = hasilRandom($_SESSION['angkaRandom1'], $_SESSION['angkaRandom2']);
    } elseif (isset($_SESSION['statusJawaban'] )){
        if ($_SESSION['statusJawaban']=== 'Benar') {
            unsetSession();
        }
    }
    $hasil = $_SESSION['hasilRandom'];
    
    
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
        <h2>Hallo, <?= $_SESSION['username']; ?>, selamat datang kembali di permainan ini!!!</h2>
    </div>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="inputJawaban">Berapakah <?= $_SESSION['angkaRandom1'] . ' + ' . $_SESSION['angkaRandom2'] .' =' ?> </label>
        <input type="number" name="angkaJawaban" id="inputJawaban" placeholder="Jawaban anda" required>

        <button type="submit" name="submitJawaban">Jawab</button>
        <?= $hasil;?>
    </form>
    
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
                echo "Selamat ya… Anda benar, saya telah memilih bilangan ". $hasil ."<br>";

                echo "<a href='index.php'>Next</a>";
            } else {
                // angka Jawaban terlalu besar atau terlalu kecil
                $_SESSION['statusJawaban'] = ($angkaJawaban > $hasil) ? 'Terlalu Besar' : 'Terlalu Kecil';
                echo $_SESSION['statusJawaban'];
            }
        }
    } else {  
        echo "Menset angka random";
    };
?>
</body>
</html>