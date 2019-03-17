<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Elimina un itinerario</title>
    <script  src="scripts/menu-mobile.js"></script>
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<div id="nav" class="nav-color">
    <?php
    session_start();
    include_once("include/navbar-content.php");
    ?>
</div>
    <nav id="breadcrumb" aria-label="Breadcrumbs">
        <span>Ti trovi in:&nbsp;</span>
        <ol>
            <li><a href="area_personale.php">Area personale</a></li>
            <li><a href="miei_viaggi.php">I miei viaggi</a></li>
            <li>Eliminazione itinerario <?php echo $_POST['itinerarioId'];?></li>
        </ol>
    </nav>
    <div id="confermaContainer">
        <div id="contenutoPagina" class="sr-only"></div>
        <h1>Sei sicuro di voler eliminare l'itinerario?</h1>
        <h2>Una volta eliminato l'itinerario non potrà più essere recuperato!</h2>
        <?php
            session_start();
            include_once ('funzioni.php');
            $itinerario = getItinerarioById($_POST['itinerarioId']);
            echo printItinerario($itinerario,2);
            ?>
    </div>

<?php
include_once("include/menuNoScript.php");
include_once("include/footer.php");
include_once("include/backToTop.php");
?>
<script type="text/javascript" src="scripts/loginregistration.js"></script>
<script type="text/javascript" src="scripts/registrazione-check.js"></script>
<script type="text/javascript" src="scripts/slidertext.js"></script>
</body>
</html>