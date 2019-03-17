w<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="login per il sito di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Login</title>

</head>
<body>


    <div id="nav" class="nav-color">
        <?php
        session_start();
        include_once("include/navbar-content.php");
        ?>
    </div>
    <div id="notLoggedContainer" class="half">
        <form action="login.php" method="post">
            <div class=LoginInputContainer>
                <div class="LoginInputBox">
                    <img src="img/username.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="10"  id="loginUsername"  class="LoginInput" type="text" placeholder="Username" name="username" required>
                </div>
                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="11"  class="LoginInput" id="loginPassword" type="password" placeholder="Password" name="password"  required>
                </div>
            </div>
            <hr class="LoginHr">

            <div id="loginError" class="message danger <?php session_start(); if(isset($_SESSION["loginMessage"])) echo "shown";?>">
                <em>Errore:</em> Le credenziali inserite non sono corrette
            </div>
            <div class="LoginButtonContainer">
                <noscript>
                    <button tabindex="13"  type="submit" class="materialButton _50">Accedi</button>
                </noscript>

            </div>

            <p>Non hai un account?<a tabindex="14" class="LoginLink" href="registrazione-page.php">Registrati</a></p>


        </form>
    </div>
    <?php
    include_once("include/footer.php");
    include_once("include/backToTop.php");
    ?>
</body>
</html>

