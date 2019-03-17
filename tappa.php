<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Aggiunta tappa per un itinerario di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Aggiungi tappa</title>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/area_personale_script.js"></script>
</head>


<body>
<div id="nav" class="nav-color">
    <?php
    include_once("include/navbar-content.php");
    ?>
</div>

<div id="profileContainer">
    <?php
    include_once("include/profileNavbar.php");
    ?>

    <div id="rightTravels">
        <nav id="breadcrumb" aria-label="Breadcrumbs">
            <span>Ti trovi in:&nbsp;</span>
            <ol>
                <li><a href="area_personale.php">Area personale</a></li>
                <li><a href="miei_viaggi.php">I miei viaggi</a></li>
                <li>
                    <a href="visualizza_itinerario.php?idItinerario=<?php echo $_SESSION['iditinerario'];?>">
                        Visualizza itinerario <?php echo $_SESSION['iditinerario'];?>
                    </a>
                </li>
                <li>Inserisci nuova tappa</li>
            </ol>
        </nav>
        <div class="sr-only" id="contenutoPagina"></div>
        <?php if (isset($_SESSION['username'])){
            if(!isset($_SESSION['iditinerario'])){
                header("Location: lost.php");
            }
            include_once("tappa-content.php");
        }
        else{
            include_once("include/errore-non-loggato.php");
        }
        ?>

    </div>
</div>

<script src="scripts/mappa_tappa.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAKF6I6FaWFdnsDv6Rxxu6nxCQZNrTWaw&libraries=places&callback=initMap" async="async" defer="defer"></script>

    <?php
        include_once("include/menuNoScript.php");
        include_once("include/footer.php");
        include_once("include/backToTop.php");
    ?>

<script type="text/javascript" src="scripts/loginregistration.js"></script>
<script type="text/javascript" src="scripts/registrazione-check.js"></script>
<script type="text/javascript" src="scripts/getfilename.js"></script>
</body>
</html>