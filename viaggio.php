<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Inserimento itineriario di viaggio per Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Aggiungi Viaggio</title>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/area_personale_script.js"></script>
</head>
<body>

<div id="nav" class="nav-trasparent">
    <?php
        include_once("include/navbar-content.php");
    ?>
</div>

<div id="ViaggioTitoloCover">
    <div id="ViaggioTitolo">
        <h1>Inizia un nuovo viaggio!</h1>
    </div>
</div>

<nav id="breadcrumb" aria-label="Breadcrumbs">
    <span>Ti trovi in:&nbsp;</span>
    <ol>
        <li>Inserisci nuovo itinerario</li>
    </ol>
</nav>
<div class="sr-only" id="contenutoPagina"></div>


<?php if (isset($_SESSION['username'])){
    include_once("viaggio-content.php");
}
else{
    include_once("include/errore-non-loggato.php");
}

?>

<?php
include_once("include/menuNoScript.php");
include_once("include/footer.php");
include_once("include/backToTop.php");

?>


<!-- leave it in the bottom to prevent errors, things must be loaded unless the script is not able to find them-->
<script src="scripts/loginregistration.js"></script>
<script src="scripts/registrazione-check.js"></script>
<script src="scripts/getfilename.js"></script>

</body>
</html>

