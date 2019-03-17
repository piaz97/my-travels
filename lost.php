<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <link rel="stylesheet" type="text/css" href="css/stile.css"/>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>Errore 404</title>
    <script  src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>
<div id="nav" class="nav-color">
    <?php
        session_start();
        include_once("include/navbar-content.php");
        ?>
</div>
<div class="page404Container">
    <div class="page404">
        <h1>Ops, sembra che qualcosa sia andato storto..</h1>
        <div id="compassBox"><span>4</span><img src="img/lost.gif" alt="Bussola che impazzisce"/><span>4</span></div>
        <h2>Ricorda, anche nelle migliori avventure ci si può inbattere in qualche intoppo. Non disperare, torna alla
        <a lang="en" href="index.php">Home</a>!
        </h2>
    </div>
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