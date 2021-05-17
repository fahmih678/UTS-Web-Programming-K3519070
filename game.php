<?php 
// session_start();

function unsetSession(){
    // $_SESSION['hasilRandom'] = "";
    unset($_SESSION['hasilRandom']);
    unset($_SESSION['angkaRandom1']);
    unset($_SESSION['angkaRandom2']);
    unset($_SESSION['statusJawaban']);
    header('Location:index.php');
}

?>