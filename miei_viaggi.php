<!DOCTYPE html>
<html lang="it">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico"/>
    <meta name="description" content="I viaggi personali caricati dall'utente iscritto a Mytravels"/>
    <meta name="keywords" content="travels, journey, adventure"/>
    <meta name="author" content="MyTravels Corporation"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="theme-color" content="#035c6e" />
	<link rel="stylesheet" type="text/css" href="css/stile.css"/>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <title>I miei viaggi</title>
    <script src="scripts/menu-mobile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="scripts/selectProfileNavbar.js"></script>
</head>

<body>
    <div id="nav" class="nav-color">
        <?php
        session_start();
        include_once("include/navbar-content.php");
        ?>
    </div>
    <?php
        session_start();
        if (isset($_SESSION['username'])){
            include_once ("contenutoMieiViaggi.php");
        }
        else{
            echo "<div id=\"profileContainer\">";
            include_once("include/errore-non-loggato.php");
            echo "</div>";
        }

        include_once("include/menuNoScript.php");
        include_once("include/footer.php");
        include_once("include/backToTop.php");
    ?>

    <script src="scripts/loginregistration.js"></script>
    <script src="scripts/registrazione-check.js"></script>




</body>
</html>