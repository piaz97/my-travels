<div id="darkener"></div>
<div id="logo">
    <a href="index.php"> <img src="img/logo.svg" alt="logo MyTravels" /></a>
</div>
<div id="menuBurger">
    <div id="burger" onclick="openNav('menu');">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div id="menu">
        <a href="javascript:closeNav('menu')" class="exitButton"><img src="img/close.svg" alt="close menu"/></a>
        <ul>
            <li class="sr-only"><a tabindex="1" href="#contenutoPagina">Vai al contenuto della pagina</a></li>
            <li><a lang="en" href="index.php" class="active">Home</a></li>
            <li><a href="cerca.php">Cerca</a></li>
            <li><a href="viaggio.php">Inserisci</a></li>
            <li><a href="classifica.php">Classifica</a></li>
        </ul>
    </div>
</div>
<noscript><a id="mobileMenuReplacement" href="#mobileNoScriptMenu">JS disabilitato</a></noscript>
<div id="logo-mobile">
    <a href="index.php"><img src="img/logo.svg" alt="logo MyTravels"/></a>
</div>

<?php
    session_start();
    if(isset($_SESSION["username"]))
        include("include/login-data.php");
    else{
        include("include/login-menu.php");
    }
?>
