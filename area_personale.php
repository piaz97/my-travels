<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="Area personale di Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
    <title>Area personale</title>
	<link rel="stylesheet" type="text/css" href="css/stile.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/area_personale_script.js"></script>
    <script src="scripts/area_personale_onload.js"></script>
</head>
<body>


    <div id="nav" class="nav-color">
        <?php
            session_start();
            include_once("include/navbar-content.php");
        ?>
    </div>
    <?php if (isset($_SESSION['username'])){
        include_once ("contenutoAreaPersonale.php");
    }
    else{
        echo "<div id=\"profileContainer\">";
        include_once("include/errore-non-loggato.php");
        echo "</div>";
    }
    ?>
    <?php
            include_once("include/footer.php");
            include_once("include/menuNoScript.php");
            include_once("include/backToTop.php");
    ?>

<script src="scripts/loginregistration.js"></script>
<script src="scripts/registrazione-check.js"></script>
<script src="scripts/selectProfileNavbar.js"></script>
</body>
</html>