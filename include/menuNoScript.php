<noscript id="mobileNoScript">
    <!--in case mobile javascript is disabled, include this file-->
    <nav class="mobileNoScriptContainer">
        <?php
            session_start();
            if (!isset($_SESSION["username"]))
                echo "<a class=\"mobileNoScriptTile\" id=\"mobileNoScriptLogin\" href=\"login-page.php\">
                        <img alt=\"icona login\" src=\"img/log-in.svg\" />Accedi
                    </a>
                    <a  class=\"mobileNoScriptTile\" href=\"registrazione-page.php\">
                        <img alt=\"icona registrazione\" src=\"img/add-user.svg\" />Registrati
                    </a>";
            else
                echo "<a class=\"mobileNoScriptTile\" id=\"mobileNoScriptLogin\" href=\"logout.php\">
                        <img alt=\"icona logout\" src=\"img/log-out.svg\" />Logout
                    </a>
                    <a class=\"mobileNoScriptTile\" href=\"area_personale.php\">
                        <img alt=\"icona area personale\" src=\"img/user.svg\" />Area Personale
                    </a>";
        ?>

        <a class="mobileNoScriptTile" id="mobileNoScriptMenu" href="index.php">
            <img alt="icona home" src="img/home.svg" />Home
        </a>
        <a class="mobileNoScriptTile"  href="cerca.php">
            <img alt="icona cerca" src="img/binoculars.svg" />Cerca
        </a>
        <a  class="mobileNoScriptTile" href="viaggio.php">
            <img alt="icona inserisci viaggio" src="img/pin.svg" />Inserisci
        </a>
        <a class="mobileNoScriptTile"  href="classifica.php">
            <img alt="icona classifica" src="img/medal.svg" />Classifica
        </a>
    </nav>
</noscript>