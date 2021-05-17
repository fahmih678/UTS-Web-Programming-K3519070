<?php 
    include_once('auth.php');
    login();
    if (isset($_COOKIE['username']) && !isset($_POST['loginAgain'])){
        header("Location: index.php");
    } else {
        setcookie('username');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <div id="container" >
        <div id="wrapper">
            <div id="login" class="animate form">
                <form  action="login.php" method="POST"> 
                    <h1>Log in</h1> 
                    <p> 
                        <label for="username" class="uname" data-icon="u" > Your username </label>
                        <input id="username" name="username" required="required" type="text" placeholder="username"/>
                    </p>
                    <p> 
                        <label for="email" class="email" data-icon="u" > Your email </label>
                        <input id="email" name="email" required="required" type="text" placeholder="email@gmail.com"/>
                    </p>
                    <p class="keeplogin"> 
                        <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                        <label for=" ">Keep me logged in</label>
                    </p>
                    <p class="login button"> 
                        <input type="submit" value="submit" name="submit" id="submit"/> 
                    </p>
                    
                </form>
            </div>

        </div>
    </div>  
</body>
</html>