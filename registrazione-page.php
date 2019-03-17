<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Registrazione per il sito Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Registrazione</title>

</head>
<body>
    <div id="nav" class="nav-color">
        <?php
        session_start();
        include_once("include/navbar-content.php");
        ?>
    </div>
    <div id="notLoggedContainer" class="half">
        <form id="registrationForm" action="registrazione.php"   autocomplete="on" method="post" class="<?php session_start(); if(isset($_SESSION["registrationSuccess"])) echo "hidden"; else echo "shown";?>">
            <div class=LoginInputContainer>
                <div class="LoginInputBox">
                    <img src="img/username.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="16" id="username" class="LoginInput" type="text" placeholder="Username" name="username" required/>
                </div>
                <div class="LoginInputBox">
                    <img src="img/envelope.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="17"  id="mail" class="LoginInput" type="email" placeholder="Email" name="mail" required/>
                </div>
                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="18" class="LoginInput" id="pwdreg" type="password" placeholder="Password" name="password"  required/>
                </div>
                <!-- An element to toggle between password visibility -->

                <div class="LoginInputBox">
                    <img src="img/locked.svg" alt="" class="LoginInputIcon"/>
                    <input tabindex="20" class="LoginInput" id="pwd-repeat" type="password" placeholder="Ripeti Password" name="passwordRepeat" required/>
                </div>
                <div id="registrationError" class="message danger <?php session_start(); if(isset($_SESSION["registrationError"])) echo "shown";?>">
                    <em>Errore:</em> <?php session_start(); if(isset($_SESSION["registrationError"])) echo $_SESSION["registrationError"];?>
                </div>
            </div>
            <hr class="LoginHr">
            <div class="LoginButtonContainer">
                <button tabindex="22" id="registerButton" type="submit" class="materialButton _70" >Registrati</button>
            </div>


            <p>Hai gia' un account?<a tabindex="23" class="LoginLink" href="login-page.php">Accedi</a></p>

        </form>
        <div id="registrationSuccess" class="message success <?php session_start(); if(isset($_SESSION["registrationSuccess"])) echo "shown";?>">
            <em>Evviva! </em> La registrazione è avvenuta con successo. <noscript><a tabindex="25" class="LoginLink" href="login-page.php">Accedi</a></noscript><a tabindex="26" href="javascript:openpopup('login')" class="LoginLink script">Accedi</a>
        </div>
    </div>
    <?php
    include_once("include/footer.php");
    include_once("include/backToTop.php");
    ?>
</body>
</html>